@extends('admin.layout')

@section('title', 'Google Analytics Settings')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-chart-bar text-white text-xl"></i>
                </div>
                Analytics Settings
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Configure Google Analytics and Search Console verification</p>
        </div>
        <a href="{{ route('admin.seo.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
        </a>
    </div>
</div>

@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

<form action="{{ route('admin.seo.analytics.update') }}" method="POST">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Google Analytics -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-xl font-bold mb-6 flex items-center border-b pb-4">
                <i class="fab fa-google text-red-500 mr-2"></i>Google Analytics 4
            </h3>
            
            <div class="space-y-5">
                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border-2 border-blue-200">
                    <div>
                        <p class="font-semibold text-gray-700">Enable Google Analytics</p>
                        <p class="text-sm text-gray-500">Track visitors and analyze traffic</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="ga_enabled" value="1" {{ $seo->ga_enabled ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-14 h-8 bg-gray-300 peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-key text-gray-500 mr-1"></i>GA4 Measurement ID
                    </label>
                    <input type="text" name="ga_measurement_id" value="{{ old('ga_measurement_id', $seo->ga_measurement_id) }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="G-XXXXXXXXXX">
                    <p class="text-xs text-gray-500 mt-1">
                        Find this in Google Analytics > Admin > Data Streams > Your Stream
                    </p>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-building text-gray-500 mr-1"></i>GA Property ID (Optional)
                    </label>
                    <input type="text" name="ga_property_id" value="{{ old('ga_property_id', $seo->ga_property_id) }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="123456789">
                </div>
                
                <!-- Setup Guide -->
                <div class="bg-blue-50 rounded-xl p-4 mt-4">
                    <h4 class="font-semibold text-blue-800 mb-2">
                        <i class="fas fa-info-circle mr-1"></i>How to get your Measurement ID:
                    </h4>
                    <ol class="text-sm text-blue-700 list-decimal list-inside space-y-1">
                        <li>Go to <a href="https://analytics.google.com" target="_blank" class="underline">Google Analytics</a></li>
                        <li>Click Admin (gear icon) at bottom left</li>
                        <li>Click "Data Streams" under Property column</li>
                        <li>Select your web stream</li>
                        <li>Copy the Measurement ID (starts with G-)</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Search Console & Webmaster -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-xl font-bold mb-6 flex items-center border-b pb-4">
                <i class="fas fa-search text-green-500 mr-2"></i>Search Console Verification
            </h3>
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fab fa-google text-blue-500 mr-1"></i>Google Search Console
                    </label>
                    <input type="text" name="google_site_verification" value="{{ old('google_site_verification', $seo->google_site_verification) }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="Your verification code">
                    <p class="text-xs text-gray-500 mt-1">
                        The content value from the meta tag provided by Google Search Console
                    </p>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fab fa-microsoft text-blue-600 mr-1"></i>Bing Webmaster Tools
                    </label>
                    <input type="text" name="bing_site_verification" value="{{ old('bing_site_verification', $seo->bing_site_verification) }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="Your verification code">
                    <p class="text-xs text-gray-500 mt-1">
                        The content value from the meta tag provided by Bing Webmaster Tools
                    </p>
                </div>
                
                <!-- Status Indicators -->
                <div class="mt-6 space-y-3">
                    <h4 class="font-semibold text-gray-700">Verification Status:</h4>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fab fa-google text-blue-500 mr-2"></i>
                            <span>Google Search Console</span>
                        </div>
                        @if($seo->google_site_verification)
                            <span class="text-green-500 flex items-center"><i class="fas fa-check-circle mr-1"></i>Configured</span>
                        @else
                            <span class="text-gray-400 flex items-center"><i class="fas fa-minus-circle mr-1"></i>Not Set</span>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fab fa-microsoft text-blue-600 mr-2"></i>
                            <span>Bing Webmaster</span>
                        </div>
                        @if($seo->bing_site_verification)
                            <span class="text-green-500 flex items-center"><i class="fas fa-check-circle mr-1"></i>Configured</span>
                        @else
                            <span class="text-gray-400 flex items-center"><i class="fas fa-minus-circle mr-1"></i>Not Set</span>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-chart-line text-purple-500 mr-2"></i>
                            <span>Google Analytics</span>
                        </div>
                        @if($seo->ga_enabled && $seo->ga_measurement_id)
                            <span class="text-green-500 flex items-center"><i class="fas fa-check-circle mr-1"></i>Active</span>
                        @else
                            <span class="text-gray-400 flex items-center"><i class="fas fa-minus-circle mr-1"></i>Inactive</span>
                        @endif
                    </div>
                </div>
                
                <!-- Tips -->
                <div class="bg-green-50 rounded-xl p-4 mt-4">
                    <h4 class="font-semibold text-green-800 mb-2">
                        <i class="fas fa-lightbulb mr-1"></i>Tips:
                    </h4>
                    <ul class="text-sm text-green-700 list-disc list-inside space-y-1">
                        <li>After adding verification codes, verify in respective consoles</li>
                        <li>Submit your sitemap URL to improve indexing</li>
                        <li>Monitor search performance regularly</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Submit Button -->
    <div class="mt-8">
        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-8 py-4 rounded-xl font-bold flex items-center justify-center transition shadow-xl">
            <i class="fas fa-save mr-2"></i>Save Analytics Settings
        </button>
    </div>
</form>
@endsection
