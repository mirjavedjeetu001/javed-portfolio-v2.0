@extends('admin.layout')

@section('title', 'SEO & Analytics Dashboard')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                SEO & Analytics Dashboard
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Monitor your website performance and SEO health</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.seo.settings') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                <i class="fas fa-cog mr-2"></i>SEO Settings
            </a>
            <a href="{{ route('admin.seo.analytics') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                <i class="fas fa-chart-bar mr-2"></i>Analytics
            </a>
            <a href="{{ route('admin.seo.adsense') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                <i class="fas fa-ad mr-2"></i>AdSense
            </a>
        </div>
    </div>
</div>

<!-- SEO Health Score -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-xl p-6 col-span-1">
        <h3 class="text-xl font-bold mb-4 flex items-center">
            <i class="fas fa-heartbeat text-red-500 mr-2"></i>SEO Health Score
        </h3>
        <div class="text-center py-4">
            <div class="relative inline-block">
                <svg class="w-32 h-32 transform -rotate-90">
                    <circle cx="64" cy="64" r="56" stroke="#e5e7eb" stroke-width="12" fill="none"/>
                    <circle cx="64" cy="64" r="56" stroke="{{ $seoHealth['grade']['color'] == 'green' ? '#10b981' : ($seoHealth['grade']['color'] == 'blue' ? '#3b82f6' : ($seoHealth['grade']['color'] == 'yellow' ? '#f59e0b' : ($seoHealth['grade']['color'] == 'orange' ? '#f97316' : '#ef4444'))) }}" stroke-width="12" fill="none" stroke-dasharray="{{ $seoHealth['percentage'] * 3.51 }} 351" stroke-linecap="round"/>
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-3xl font-bold text-gray-800">{{ $seoHealth['grade']['grade'] }}</span>
                </div>
            </div>
            <p class="mt-4 text-2xl font-bold text-gray-800">{{ $seoHealth['percentage'] }}%</p>
            <p class="text-gray-500">{{ $seoHealth['score'] }}/{{ $seoHealth['max_score'] }} points</p>
        </div>
        
        <div class="mt-4 space-y-2 max-h-48 overflow-y-auto">
            @foreach($seoHealth['checks'] as $key => $check)
            <div class="flex items-center text-sm">
                @if($check['status'] == 'success')
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                @elseif($check['status'] == 'warning')
                    <i class="fas fa-exclamation-circle text-yellow-500 mr-2"></i>
                @else
                    <i class="fas fa-times-circle text-red-500 mr-2"></i>
                @endif
                <span class="text-gray-600">{{ $check['message'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="col-span-2 grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Realtime Visitors -->
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl p-5 text-white">
            <div class="flex items-center justify-between mb-2">
                <span class="text-green-100 text-sm font-medium">Live Now</span>
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
                </span>
            </div>
            <p class="text-3xl font-bold">{{ $realtimeVisitors }}</p>
            <p class="text-green-100 text-sm">Active visitors</p>
        </div>

        <!-- Today's Visits -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-5 text-white">
            <div class="flex items-center justify-between mb-2">
                <span class="text-blue-100 text-sm font-medium">Today</span>
                <i class="fas fa-calendar-day text-blue-200"></i>
            </div>
            <p class="text-3xl font-bold">{{ number_format($todayStats->total_visits ?? 0) }}</p>
            <p class="text-blue-100 text-sm">
                @php
                    $change = ($todayStats->total_visits ?? 0) - ($yesterdayStats->total_visits ?? 0);
                    $changePercent = $yesterdayStats->total_visits > 0 ? round(($change / $yesterdayStats->total_visits) * 100) : 0;
                @endphp
                @if($change >= 0)
                    <i class="fas fa-arrow-up"></i> +{{ $changePercent }}%
                @else
                    <i class="fas fa-arrow-down"></i> {{ $changePercent }}%
                @endif
                vs yesterday
            </p>
        </div>

        <!-- This Week -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-5 text-white">
            <div class="flex items-center justify-between mb-2">
                <span class="text-purple-100 text-sm font-medium">This Week</span>
                <i class="fas fa-calendar-week text-purple-200"></i>
            </div>
            <p class="text-3xl font-bold">{{ number_format($weekStats->visits ?? 0) }}</p>
            <p class="text-purple-100 text-sm">{{ number_format($weekStats->unique_visitors ?? 0) }} unique</p>
        </div>

        <!-- This Month -->
        <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl p-5 text-white">
            <div class="flex items-center justify-between mb-2">
                <span class="text-pink-100 text-sm font-medium">This Month</span>
                <i class="fas fa-calendar-alt text-pink-200"></i>
            </div>
            <p class="text-3xl font-bold">{{ number_format($monthStats->visits ?? 0) }}</p>
            <p class="text-pink-100 text-sm">{{ number_format($monthStats->page_views ?? 0) }} page views</p>
        </div>

        <!-- All Time -->
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-5 text-white">
            <div class="flex items-center justify-between mb-2">
                <span class="text-indigo-100 text-sm font-medium">All Time</span>
                <i class="fas fa-infinity text-indigo-200"></i>
            </div>
            <p class="text-3xl font-bold">{{ number_format($allTimeStats->visits ?? 0) }}</p>
            <p class="text-indigo-100 text-sm">Total visits</p>
        </div>

        <!-- Page Views -->
        <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl p-5 text-white">
            <div class="flex items-center justify-between mb-2">
                <span class="text-cyan-100 text-sm font-medium">Page Views</span>
                <i class="fas fa-eye text-cyan-200"></i>
            </div>
            <p class="text-3xl font-bold">{{ number_format($allTimeStats->page_views ?? 0) }}</p>
            <p class="text-cyan-100 text-sm">All time</p>
        </div>

        <!-- Analytics Status -->
        <div class="bg-gradient-to-br {{ $seo->ga_enabled ? 'from-green-500 to-green-600' : 'from-gray-500 to-gray-600' }} rounded-xl p-5 text-white">
            <div class="flex items-center justify-between mb-2">
                <span class="text-white/80 text-sm font-medium">Analytics</span>
                <i class="fab fa-google text-white/60"></i>
            </div>
            <p class="text-xl font-bold">{{ $seo->ga_enabled ? 'Active' : 'Inactive' }}</p>
            <p class="text-white/80 text-sm">{{ $seo->ga_measurement_id ?? 'Not configured' }}</p>
        </div>

        <!-- AdSense Status -->
        <div class="bg-gradient-to-br {{ $seo->adsense_enabled ? 'from-orange-500 to-orange-600' : 'from-gray-500 to-gray-600' }} rounded-xl p-5 text-white">
            <div class="flex items-center justify-between mb-2">
                <span class="text-white/80 text-sm font-medium">AdSense</span>
                <i class="fas fa-ad text-white/60"></i>
            </div>
            <p class="text-xl font-bold">{{ $seo->adsense_enabled ? 'Active' : 'Inactive' }}</p>
            <p class="text-white/80 text-sm">{{ $seo->adsense_publisher_id ?? 'Not configured' }}</p>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Visitors Chart -->
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <h3 class="text-xl font-bold mb-4 flex items-center">
            <i class="fas fa-chart-area text-blue-500 mr-2"></i>Visitors (Last 30 Days)
        </h3>
        <canvas id="visitorsChart" height="200"></canvas>
    </div>

    <!-- Device Distribution -->
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <h3 class="text-xl font-bold mb-4 flex items-center">
            <i class="fas fa-mobile-alt text-purple-500 mr-2"></i>Device Distribution
        </h3>
        <div class="flex items-center justify-center">
            <canvas id="deviceChart" height="200" width="200"></canvas>
        </div>
        <div class="flex justify-center gap-6 mt-4">
            @foreach($deviceStats as $device)
            <div class="text-center">
                <i class="fas fa-{{ $device->device_type == 'mobile' ? 'mobile-alt' : ($device->device_type == 'tablet' ? 'tablet-alt' : 'desktop') }} text-2xl text-gray-600"></i>
                <p class="font-semibold">{{ ucfirst($device->device_type ?? 'Unknown') }}</p>
                <p class="text-sm text-gray-500">{{ number_format($device->count) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Tables Row -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Top Pages -->
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <h3 class="text-xl font-bold mb-4 flex items-center">
            <i class="fas fa-file-alt text-green-500 mr-2"></i>Top Pages
        </h3>
        <div class="space-y-3">
            @forelse($topPages as $page)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-700 truncate flex-1" title="{{ $page->page_url }}">{{ Str::limit($page->page_url, 30) }}</span>
                <span class="text-gray-500 font-semibold ml-2">{{ number_format($page->views) }}</span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">No data yet</p>
            @endforelse
        </div>
    </div>

    <!-- Top Browsers -->
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <h3 class="text-xl font-bold mb-4 flex items-center">
            <i class="fas fa-globe text-blue-500 mr-2"></i>Top Browsers
        </h3>
        <div class="space-y-3">
            @forelse($browserStats as $browser)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <i class="fab fa-{{ strtolower($browser->browser) == 'chrome' ? 'chrome' : (strtolower($browser->browser) == 'firefox' ? 'firefox' : (strtolower($browser->browser) == 'safari' ? 'safari' : (strtolower($browser->browser) == 'edge' ? 'edge' : 'globe'))) }} text-xl mr-2 text-gray-600"></i>
                    <span class="text-gray-700">{{ $browser->browser ?? 'Unknown' }}</span>
                </div>
                <span class="text-gray-500 font-semibold">{{ number_format($browser->count) }}</span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">No data yet</p>
            @endforelse
        </div>
    </div>

    <!-- Top Countries -->
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <h3 class="text-xl font-bold mb-4 flex items-center">
            <i class="fas fa-flag text-red-500 mr-2"></i>Top Countries
        </h3>
        <div class="space-y-3">
            @forelse($countryStats as $country)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-700">{{ $country->country ?? 'Unknown' }}</span>
                <span class="text-gray-500 font-semibold">{{ number_format($country->count) }}</span>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">No data yet</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Visitors Chart
const visitorsCtx = document.getElementById('visitorsChart').getContext('2d');
new Chart(visitorsCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartData->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))) !!},
        datasets: [{
            label: 'Visits',
            data: {!! json_encode($chartData->pluck('total_visits')) !!},
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            fill: true,
            tension: 0.4
        }, {
            label: 'Unique Visitors',
            data: {!! json_encode($chartData->pluck('unique_visitors')) !!},
            borderColor: '#10b981',
            backgroundColor: 'rgba(16, 185, 129, 0.1)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// Device Chart
const deviceCtx = document.getElementById('deviceChart').getContext('2d');
new Chart(deviceCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($deviceStats->pluck('device_type')->map(fn($d) => ucfirst($d ?? 'Unknown'))) !!},
        datasets: [{
            data: {!! json_encode($deviceStats->pluck('count')) !!},
            backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        cutout: '70%'
    }
});
</script>
@endsection
