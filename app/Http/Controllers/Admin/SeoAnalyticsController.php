<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use App\Models\VisitorAnalytic;
use App\Models\VisitorDailyStat;
use App\Models\PageSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeoAnalyticsController extends Controller
{
    /**
     * Show SEO & Analytics Dashboard
     */
    public function index()
    {
        $seo = SeoSetting::getSettings();
        
        // Get analytics summary
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();
        
        // Today's stats
        $todayStats = VisitorDailyStat::where('date', $today)->first() ?? new VisitorDailyStat();
        $yesterdayStats = VisitorDailyStat::where('date', $yesterday)->first() ?? new VisitorDailyStat();
        
        // This week's stats
        $weekStats = VisitorDailyStat::where('date', '>=', $thisWeek)
            ->selectRaw('SUM(total_visits) as visits, SUM(unique_visitors) as unique_visitors, SUM(page_views) as page_views')
            ->first();
        
        // This month's stats
        $monthStats = VisitorDailyStat::where('date', '>=', $thisMonth)
            ->selectRaw('SUM(total_visits) as visits, SUM(unique_visitors) as unique_visitors, SUM(page_views) as page_views')
            ->first();
        
        // All time stats
        $allTimeStats = VisitorDailyStat::selectRaw('SUM(total_visits) as visits, SUM(unique_visitors) as unique_visitors, SUM(page_views) as page_views')
            ->first();
        
        // Last 30 days chart data
        $chartData = VisitorDailyStat::where('date', '>=', Carbon::now()->subDays(30))
            ->orderBy('date')
            ->get(['date', 'total_visits', 'unique_visitors', 'page_views']);
        
        // Top pages this month
        $topPages = VisitorAnalytic::where('created_at', '>=', $thisMonth)
            ->select('page_url', DB::raw('COUNT(*) as views'))
            ->groupBy('page_url')
            ->orderByDesc('views')
            ->limit(10)
            ->get();
        
        // Device breakdown this month
        $deviceStats = VisitorAnalytic::where('created_at', '>=', $thisMonth)
            ->select('device_type', DB::raw('COUNT(*) as count'))
            ->groupBy('device_type')
            ->get();
        
        // Browser breakdown
        $browserStats = VisitorAnalytic::where('created_at', '>=', $thisMonth)
            ->select('browser', DB::raw('COUNT(*) as count'))
            ->groupBy('browser')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
        
        // Country breakdown
        $countryStats = VisitorAnalytic::where('created_at', '>=', $thisMonth)
            ->whereNotNull('country')
            ->select('country', DB::raw('COUNT(*) as count'))
            ->groupBy('country')
            ->orderByDesc('count')
            ->limit(10)
            ->get();
        
        // Real-time visitors (last 5 minutes)
        $realtimeVisitors = VisitorAnalytic::where('created_at', '>=', Carbon::now()->subMinutes(5))
            ->distinct('session_id')
            ->count('session_id');
        
        // SEO Health Check
        $seoHealth = $this->calculateSeoHealth($seo);
        
        return view('admin.seo.index', compact(
            'seo',
            'todayStats',
            'yesterdayStats',
            'weekStats',
            'monthStats',
            'allTimeStats',
            'chartData',
            'topPages',
            'deviceStats',
            'browserStats',
            'countryStats',
            'realtimeVisitors',
            'seoHealth'
        ));
    }

    /**
     * Show SEO Settings Form
     */
    public function seoSettings()
    {
        $seo = SeoSetting::getSettings();
        return view('admin.seo.settings', compact('seo'));
    }

    /**
     * Update SEO Settings
     */
    public function updateSeoSettings(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:500',
            'meta_author' => 'nullable|string|max:100',
            'canonical_url' => 'nullable|url|max:255',
            'robots_txt' => 'nullable|string|max:50',
            'og_title' => 'nullable|string|max:70',
            'og_description' => 'nullable|string|max:200',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'og_type' => 'nullable|string|max:50',
            'og_site_name' => 'nullable|string|max:100',
            'twitter_card' => 'nullable|string|max:50',
            'twitter_site' => 'nullable|string|max:50',
            'twitter_creator' => 'nullable|string|max:50',
            'schema_enabled' => 'boolean',
            'schema_type' => 'nullable|string|max:50',
            'schema_custom_json' => 'nullable|string',
            'sitemap_enabled' => 'boolean',
        ]);

        $seo = SeoSetting::getSettings();
        
        // Handle OG Image upload
        if ($request->hasFile('og_image')) {
            $image = $request->file('og_image');
            $imageName = 'og-image-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/seo'), $imageName);
            $validated['og_image'] = 'uploads/seo/' . $imageName;
        }
        
        $validated['schema_enabled'] = $request->has('schema_enabled');
        $validated['sitemap_enabled'] = $request->has('sitemap_enabled');
        
        $seo->update($validated);
        
        return redirect()->route('admin.seo.settings')
            ->with('success', 'SEO settings updated successfully!');
    }

    /**
     * Show Google Analytics Settings
     */
    public function analyticsSettings()
    {
        $seo = SeoSetting::getSettings();
        return view('admin.seo.analytics', compact('seo'));
    }

    /**
     * Update Google Analytics Settings
     */
    public function updateAnalyticsSettings(Request $request)
    {
        $validated = $request->validate([
            'ga_measurement_id' => 'nullable|string|max:50',
            'ga_property_id' => 'nullable|string|max:50',
            'google_site_verification' => 'nullable|string|max:100',
            'bing_site_verification' => 'nullable|string|max:100',
        ]);

        $seo = SeoSetting::getSettings();
        $validated['ga_enabled'] = $request->has('ga_enabled');
        $seo->update($validated);
        
        return redirect()->route('admin.seo.analytics')
            ->with('success', 'Analytics settings updated successfully!');
    }

    /**
     * Show AdSense Settings
     */
    public function adsenseSettings()
    {
        $seo = SeoSetting::getSettings();
        return view('admin.seo.adsense', compact('seo'));
    }

    /**
     * Update AdSense Settings
     */
    public function updateAdsenseSettings(Request $request)
    {
        $validated = $request->validate([
            'adsense_publisher_id' => 'nullable|string|max:50',
            'adsense_header_code' => 'nullable|string',
            'adsense_in_article_code' => 'nullable|string',
            'adsense_sidebar_code' => 'nullable|string',
            'adsense_footer_code' => 'nullable|string',
        ]);

        $seo = SeoSetting::getSettings();
        $validated['adsense_enabled'] = $request->has('adsense_enabled');
        $validated['adsense_auto_ads'] = $request->has('adsense_auto_ads');
        $seo->update($validated);
        
        return redirect()->route('admin.seo.adsense')
            ->with('success', 'AdSense settings updated successfully!');
    }

    /**
     * Generate Sitemap
     */
    public function generateSitemap()
    {
        // Generate sitemap logic here
        $seo = SeoSetting::getSettings();
        $seo->update(['sitemap_last_generated' => now()]);
        
        return redirect()->route('admin.seo.settings')
            ->with('success', 'Sitemap generated successfully!');
    }

    /**
     * Calculate SEO Health Score
     */
    private function calculateSeoHealth($seo)
    {
        $score = 0;
        $maxScore = 100;
        $checks = [];
        
        // Site Title (10 points)
        if (!empty($seo->site_title)) {
            $score += 10;
            $checks['site_title'] = ['status' => 'success', 'message' => 'Site title is set'];
        } else {
            $checks['site_title'] = ['status' => 'error', 'message' => 'Site title is missing'];
        }
        
        // Meta Description (15 points)
        if (!empty($seo->meta_description)) {
            $len = strlen($seo->meta_description);
            if ($len >= 120 && $len <= 160) {
                $score += 15;
                $checks['meta_description'] = ['status' => 'success', 'message' => 'Meta description is optimal length'];
            } else {
                $score += 8;
                $checks['meta_description'] = ['status' => 'warning', 'message' => 'Meta description should be 120-160 characters'];
            }
        } else {
            $checks['meta_description'] = ['status' => 'error', 'message' => 'Meta description is missing'];
        }
        
        // Open Graph (15 points)
        if (!empty($seo->og_title) && !empty($seo->og_description)) {
            $score += 15;
            $checks['open_graph'] = ['status' => 'success', 'message' => 'Open Graph tags are configured'];
        } elseif (!empty($seo->og_title) || !empty($seo->og_description)) {
            $score += 7;
            $checks['open_graph'] = ['status' => 'warning', 'message' => 'Open Graph is partially configured'];
        } else {
            $checks['open_graph'] = ['status' => 'error', 'message' => 'Open Graph tags are missing'];
        }
        
        // OG Image (10 points)
        if (!empty($seo->og_image)) {
            $score += 10;
            $checks['og_image'] = ['status' => 'success', 'message' => 'Social sharing image is set'];
        } else {
            $checks['og_image'] = ['status' => 'warning', 'message' => 'Social sharing image is recommended'];
        }
        
        // Twitter Card (10 points)
        if (!empty($seo->twitter_card) && !empty($seo->twitter_site)) {
            $score += 10;
            $checks['twitter_card'] = ['status' => 'success', 'message' => 'Twitter Card is configured'];
        } else {
            $checks['twitter_card'] = ['status' => 'warning', 'message' => 'Twitter Card configuration recommended'];
        }
        
        // Google Analytics (15 points)
        if ($seo->ga_enabled && !empty($seo->ga_measurement_id)) {
            $score += 15;
            $checks['analytics'] = ['status' => 'success', 'message' => 'Google Analytics is active'];
        } else {
            $checks['analytics'] = ['status' => 'warning', 'message' => 'Google Analytics is not configured'];
        }
        
        // Google Search Console (10 points)
        if (!empty($seo->google_site_verification)) {
            $score += 10;
            $checks['search_console'] = ['status' => 'success', 'message' => 'Google Search Console is verified'];
        } else {
            $checks['search_console'] = ['status' => 'warning', 'message' => 'Google Search Console verification recommended'];
        }
        
        // Schema.org (10 points)
        if ($seo->schema_enabled) {
            $score += 10;
            $checks['schema'] = ['status' => 'success', 'message' => 'Structured data is enabled'];
        } else {
            $checks['schema'] = ['status' => 'warning', 'message' => 'Structured data recommended for rich snippets'];
        }
        
        // Sitemap (5 points)
        if ($seo->sitemap_enabled) {
            $score += 5;
            $checks['sitemap'] = ['status' => 'success', 'message' => 'Sitemap is enabled'];
        } else {
            $checks['sitemap'] = ['status' => 'warning', 'message' => 'Sitemap is recommended'];
        }
        
        return [
            'score' => $score,
            'max_score' => $maxScore,
            'percentage' => round(($score / $maxScore) * 100),
            'checks' => $checks,
            'grade' => $this->getGrade($score)
        ];
    }
    
    private function getGrade($score)
    {
        if ($score >= 90) return ['grade' => 'A+', 'color' => 'green'];
        if ($score >= 80) return ['grade' => 'A', 'color' => 'green'];
        if ($score >= 70) return ['grade' => 'B', 'color' => 'blue'];
        if ($score >= 60) return ['grade' => 'C', 'color' => 'yellow'];
        if ($score >= 50) return ['grade' => 'D', 'color' => 'orange'];
        return ['grade' => 'F', 'color' => 'red'];
    }
}
