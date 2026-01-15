<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorAnalytic;
use App\Models\VisitorDailyStat;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Only track GET requests to non-admin pages
        if ($request->method() !== 'GET' || 
            $request->is('admin/*') || 
            $request->is('api/*') ||
            $request->ajax()) {
            return $response;
        }
        
        // Don't track static assets
        $path = $request->path();
        if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2|ttf|map)$/i', $path)) {
            return $response;
        }
        
        try {
            $this->trackVisit($request);
        } catch (\Exception $e) {
            // Silently fail - don't break the site for tracking errors
            \Log::error('Visitor tracking error: ' . $e->getMessage());
        }
        
        return $response;
    }
    
    /**
     * Track the visit
     */
    private function trackVisit(Request $request)
    {
        $sessionId = session()->getId() ?? Str::random(40);
        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();
        
        // Check if this is a new visitor
        $existingVisit = VisitorAnalytic::where('session_id', $sessionId)
            ->whereDate('created_at', Carbon::today())
            ->first();
        
        $isNewVisitor = !$existingVisit;
        
        // Parse user agent
        $deviceType = $this->getDeviceType($userAgent);
        $browser = $this->getBrowser($userAgent);
        $os = $this->getOS($userAgent);
        
        // Get country (simplified - in production use IP geolocation API)
        $country = $this->getCountry($ipAddress);
        
        // Create visitor record
        VisitorAnalytic::create([
            'session_id' => $sessionId,
            'ip_address' => $ipAddress,
            'country' => $country,
            'city' => null,
            'device_type' => $deviceType,
            'browser' => $browser,
            'os' => $os,
            'referrer' => $request->header('referer'),
            'landing_page' => $isNewVisitor ? $request->fullUrl() : null,
            'page_url' => $request->path(),
            'page_title' => null,
            'is_new_visitor' => $isNewVisitor,
        ]);
        
        // Update daily stats
        $this->updateDailyStats($deviceType, $isNewVisitor);
    }
    
    /**
     * Update daily statistics
     */
    private function updateDailyStats($deviceType, $isNewVisitor)
    {
        $today = Carbon::today();
        
        $stats = VisitorDailyStat::firstOrCreate(
            ['date' => $today],
            [
                'total_visits' => 0,
                'unique_visitors' => 0,
                'page_views' => 0,
                'new_visitors' => 0,
                'returning_visitors' => 0,
                'mobile_visits' => 0,
                'desktop_visits' => 0,
                'tablet_visits' => 0,
            ]
        );
        
        $stats->increment('page_views');
        
        if ($isNewVisitor) {
            $stats->increment('total_visits');
            $stats->increment('unique_visitors');
            $stats->increment('new_visitors');
        } else {
            $stats->increment('returning_visitors');
        }
        
        // Device stats
        switch ($deviceType) {
            case 'mobile':
                $stats->increment('mobile_visits');
                break;
            case 'tablet':
                $stats->increment('tablet_visits');
                break;
            default:
                $stats->increment('desktop_visits');
                break;
        }
    }
    
    /**
     * Get device type from user agent
     */
    private function getDeviceType($userAgent)
    {
        if (preg_match('/mobile|android|iphone|ipod|blackberry|opera mini|iemobile/i', $userAgent)) {
            return 'mobile';
        }
        if (preg_match('/tablet|ipad|playbook|silk/i', $userAgent)) {
            return 'tablet';
        }
        return 'desktop';
    }
    
    /**
     * Get browser from user agent
     */
    private function getBrowser($userAgent)
    {
        if (preg_match('/Edge|Edg/i', $userAgent)) return 'Edge';
        if (preg_match('/Chrome/i', $userAgent)) return 'Chrome';
        if (preg_match('/Firefox/i', $userAgent)) return 'Firefox';
        if (preg_match('/Safari/i', $userAgent)) return 'Safari';
        if (preg_match('/Opera|OPR/i', $userAgent)) return 'Opera';
        if (preg_match('/MSIE|Trident/i', $userAgent)) return 'IE';
        return 'Other';
    }
    
    /**
     * Get OS from user agent
     */
    private function getOS($userAgent)
    {
        if (preg_match('/Windows NT 10/i', $userAgent)) return 'Windows 10';
        if (preg_match('/Windows NT 6.3/i', $userAgent)) return 'Windows 8.1';
        if (preg_match('/Windows NT 6.2/i', $userAgent)) return 'Windows 8';
        if (preg_match('/Windows NT 6.1/i', $userAgent)) return 'Windows 7';
        if (preg_match('/Windows/i', $userAgent)) return 'Windows';
        if (preg_match('/Mac OS X/i', $userAgent)) return 'macOS';
        if (preg_match('/Linux/i', $userAgent)) return 'Linux';
        if (preg_match('/Android/i', $userAgent)) return 'Android';
        if (preg_match('/iPhone|iPad|iPod/i', $userAgent)) return 'iOS';
        return 'Other';
    }
    
    /**
     * Get country from IP (simplified version)
     */
    private function getCountry($ip)
    {
        // In production, use a proper IP geolocation service
        // like MaxMind, IP-API, or ipinfo.io
        
        // For now, return null or try a free API
        try {
            if ($ip === '127.0.0.1' || $ip === '::1') {
                return 'Local';
            }
            
            // Optional: Use free IP-API (limited requests)
            // $response = file_get_contents("http://ip-api.com/json/{$ip}?fields=country");
            // $data = json_decode($response, true);
            // return $data['country'] ?? 'Unknown';
            
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
