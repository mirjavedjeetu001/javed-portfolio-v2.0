@extends('admin.layout')

@section('title', 'SEO Settings')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-search text-white text-xl"></i>
                </div>
                SEO Settings
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Configure search engine optimization for your portfolio</p>
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

<form action="{{ route('admin.seo.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Basic SEO -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-xl font-bold mb-6 flex items-center border-b pb-4">
                <i class="fas fa-tag text-blue-500 mr-2"></i>Basic SEO Meta Tags
            </h3>
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Site Title (max 70 characters)</label>
                    <input type="text" name="site_title" value="{{ old('site_title', $seo->site_title ?? '') }}" maxlength="70"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="Your Portfolio - Web Developer">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Meta Description (120-160 characters)</label>
                    <textarea name="meta_description" rows="3" maxlength="160"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="A brief description of your portfolio...">{{ old('meta_description', $seo->meta_description ?? '') }}</textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Meta Keywords (comma separated)</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $seo->meta_keywords ?? '') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="web developer, portfolio, laravel">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Meta Author</label>
                    <input type="text" name="meta_author" value="{{ old('meta_author', $seo->meta_author ?? '') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="Your Name">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Canonical URL</label>
                    <input type="url" name="canonical_url" value="{{ old('canonical_url', $seo->canonical_url ?? '') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="https://yourdomain.com">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Robots Directive</label>
                    <select name="robots_txt" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition">
                        <option value="index, follow" {{ ($seo->robots_txt ?? '') == 'index, follow' ? 'selected' : '' }}>Index, Follow (Recommended)</option>
                        <option value="index, nofollow" {{ ($seo->robots_txt ?? '') == 'index, nofollow' ? 'selected' : '' }}>Index, No Follow</option>
                        <option value="noindex, follow" {{ ($seo->robots_txt ?? '') == 'noindex, follow' ? 'selected' : '' }}>No Index, Follow</option>
                        <option value="noindex, nofollow" {{ ($seo->robots_txt ?? '') == 'noindex, nofollow' ? 'selected' : '' }}>No Index, No Follow</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Open Graph -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-xl font-bold mb-6 flex items-center border-b pb-4">
                <i class="fab fa-facebook text-blue-600 mr-2"></i>Open Graph (Social Sharing)
            </h3>
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">OG Title</label>
                    <input type="text" name="og_title" value="{{ old('og_title', $seo->og_title ?? '') }}" maxlength="70"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="Title shown when shared on social media">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">OG Description</label>
                    <textarea name="og_description" rows="3" maxlength="200"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="Description shown when shared on social media">{{ old('og_description', $seo->og_description ?? '') }}</textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">OG Type</label>
                    <select name="og_type" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition">
                        <option value="website" {{ ($seo->og_type ?? '') == 'website' ? 'selected' : '' }}>Website</option>
                        <option value="profile" {{ ($seo->og_type ?? '') == 'profile' ? 'selected' : '' }}>Profile</option>
                        <option value="article" {{ ($seo->og_type ?? '') == 'article' ? 'selected' : '' }}>Article</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">OG Site Name</label>
                    <input type="text" name="og_site_name" value="{{ old('og_site_name', $seo->og_site_name ?? '') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="Your Portfolio Name">
                </div>
            </div>
        </div>

        <!-- Twitter Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-xl font-bold mb-6 flex items-center border-b pb-4">
                <i class="fab fa-twitter text-blue-400 mr-2"></i>Twitter Card
            </h3>
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Card Type</label>
                    <select name="twitter_card" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition">
                        <option value="summary_large_image" {{ ($seo->twitter_card ?? '') == 'summary_large_image' ? 'selected' : '' }}>Summary with Large Image</option>
                        <option value="summary" {{ ($seo->twitter_card ?? '') == 'summary' ? 'selected' : '' }}>Summary</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Twitter Site Handle</label>
                    <input type="text" name="twitter_site" value="{{ old('twitter_site', $seo->twitter_site ?? '') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="@yourusername">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Twitter Creator Handle</label>
                    <input type="text" name="twitter_creator" value="{{ old('twitter_creator', $seo->twitter_creator ?? '') }}"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition"
                        placeholder="@yourusername">
                </div>
            </div>
        </div>

        <!-- Schema Settings -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-xl font-bold mb-6 flex items-center border-b pb-4">
                <i class="fas fa-code text-green-500 mr-2"></i>Structured Data
            </h3>
            
            <div class="space-y-5">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                    <div>
                        <p class="font-semibold text-gray-700">Enable Schema.org</p>
                        <p class="text-sm text-gray-500">Helps search engines understand your content</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="schema_enabled" value="1" {{ ($seo->schema_enabled ?? false) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-14 h-8 bg-gray-300 rounded-full peer peer-checked:bg-green-500 after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:after:translate-x-full"></div>
                    </label>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Schema Type</label>
                    <select name="schema_type" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition">
                        <option value="Person" {{ ($seo->schema_type ?? '') == 'Person' ? 'selected' : '' }}>Person</option>
                        <option value="Organization" {{ ($seo->schema_type ?? '') == 'Organization' ? 'selected' : '' }}>Organization</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Submit Button -->
    <div class="mt-8">
        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-8 py-4 rounded-xl font-bold flex items-center justify-center transition shadow-xl">
            <i class="fas fa-save mr-2"></i>Save SEO Settings
        </button>
    </div>
</form>
@endsection
