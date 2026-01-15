@extends('admin.layout')

@section('title', 'Google AdSense Settings')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-ad text-white text-xl"></i>
                </div>
                AdSense Settings
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Configure Google AdSense to monetize your portfolio</p>
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

<form action="{{ route('admin.seo.adsense.update') }}" method="POST">
    @csrf
    
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h3 class="text-xl font-bold mb-6 flex items-center border-b pb-4">
                <i class="fab fa-google text-orange-500 mr-2"></i>AdSense Configuration
            </h3>
            
            <div class="space-y-6">
                <!-- Master Toggle -->
                <div class="flex items-center justify-between p-6 bg-gradient-to-r from-orange-50 to-red-50 rounded-xl border-2 border-orange-200">
                    <div>
                        <p class="text-lg font-bold text-gray-800">Enable Google AdSense</p>
                        <p class="text-sm text-gray-500">Show ads on your portfolio and blog pages</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="adsense_enabled" value="1" {{ $seo->adsense_enabled ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-16 h-9 bg-gray-300 peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[5px] after:bg-white after:rounded-full after:h-7 after:w-7 after:transition-all peer-checked:bg-green-500"></div>
                    </label>
                </div>
                
                <!-- Publisher ID -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-id-card text-orange-500 mr-2"></i>AdSense Publisher ID
                    </label>
                    <input type="text" name="adsense_publisher_id" value="{{ old('adsense_publisher_id', $seo->adsense_publisher_id) }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:outline-none transition text-lg"
                        placeholder="ca-pub-XXXXXXXXXXXXXXXX">
                    <p class="text-sm text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>Find this in your AdSense account under Account > Account Information
                    </p>
                </div>
                
                <!-- Status Display -->
                <div class="bg-{{ $seo->adsense_enabled && $seo->adsense_publisher_id ? 'green' : 'gray' }}-50 rounded-xl p-5 mt-6">
                    <div class="flex items-center">
                        <div class="w-14 h-14 bg-{{ $seo->adsense_enabled && $seo->adsense_publisher_id ? 'green' : 'gray' }}-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-{{ $seo->adsense_enabled && $seo->adsense_publisher_id ? 'check-circle' : 'times-circle' }} text-{{ $seo->adsense_enabled && $seo->adsense_publisher_id ? 'green' : 'gray' }}-500 text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-gray-700">
                                Status: {{ $seo->adsense_enabled && $seo->adsense_publisher_id ? 'Active' : 'Inactive' }}
                            </p>
                            <p class="text-sm text-gray-500">
                                @if($seo->adsense_enabled && $seo->adsense_publisher_id)
                                    <span class="text-green-600">✓ Ads are being displayed on your site</span>
                                @else
                                    Enable AdSense and add your Publisher ID to start monetizing
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-5">
                    <h4 class="font-bold text-blue-800 mb-2">
                        <i class="fas fa-lightbulb mr-2"></i>How it works
                    </h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• When enabled, Google AdSense auto ads will be displayed</li>
                        <li>• Ads appear on your blog pages automatically</li>
                        <li>• Google optimizes ad placement for best performance</li>
                    </ul>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-8 py-4 rounded-xl font-bold flex items-center justify-center transition shadow-xl">
                    <i class="fas fa-save mr-2"></i>Save AdSense Settings
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
