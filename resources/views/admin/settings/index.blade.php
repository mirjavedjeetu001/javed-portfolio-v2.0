@extends('admin.layout')

@section('title', 'General Settings')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-cog text-white text-xl"></i>
                </div>
                General Settings
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Configure your portfolio's general settings</p>
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-cyan-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-8 py-6 border-b border-blue-100">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-sliders-h text-blue-600 mr-3"></i>
                    Portfolio Configuration
                </h3>
                <p class="text-gray-600 mt-1">Update your site information and preferences</p>
            </div>
            
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                <!-- Site Identity Section -->
                <div class="mb-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-id-card text-white text-sm"></i>
                        </div>
                        Site Identity
                    </h4>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="group">
                            <label for="site_name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-signature text-purple-500 mr-2"></i>Site Name
                            </label>
                            <input type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition duration-300 group-hover:border-purple-300" id="site_name" name="site_name" 
                                   value="{{ old('site_name', $settings->where('key', 'site_name')->first()->value ?? '') }}" 
                                   placeholder="Your Portfolio Name">
                            <p class="mt-2 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-purple-500 mr-2"></i>This will appear in the browser title and navigation</p>
                        </div>

                        <div class="group">
                            <label for="site_tagline" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-quote-right text-pink-500 mr-2"></i>Site Tagline
                            </label>
                            <input type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-pink-200 focus:border-pink-500 transition duration-300 group-hover:border-pink-300" id="site_tagline" name="site_tagline" 
                                   value="{{ old('site_tagline', $settings->where('key', 'site_tagline')->first()->value ?? '') }}" 
                                   placeholder="Your professional tagline">
                            <p class="mt-2 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-pink-500 mr-2"></i>A short description of what you do</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="mb-8 border-t-2 border-gray-100 pt-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-address-book text-white text-sm"></i>
                        </div>
                        Contact Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="contact_email" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-envelope text-blue-500 mr-2"></i>Contact Email
                            </label>
                            <input type="email" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition duration-300 group-hover:border-blue-300" id="contact_email" name="contact_email" 
                                   value="{{ old('contact_email', $settings->where('key', 'contact_email')->first()->value ?? '') }}" 
                                   placeholder="contact@example.com">
                            <p class="mt-2 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-blue-500 mr-2"></i>Where contact form submissions will be sent</p>
                        </div>

                        <div class="group">
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-phone text-green-500 mr-2"></i>Phone Number
                            </label>
                            <input type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition duration-300 group-hover:border-green-300" id="phone" name="phone" 
                                   value="{{ old('phone', $settings->where('key', 'phone')->first()->value ?? '') }}" 
                                   placeholder="+1 (555) 123-4567">
                        </div>

                        <div class="group md:col-span-2">
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>Address
                            </label>
                            <textarea class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-red-200 focus:border-red-500 transition duration-300 group-hover:border-red-300 resize-none" id="address" name="address" rows="2" 
                                      placeholder="Your location or city">{{ old('address', $settings->where('key', 'address')->first()->value ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Content & Files Section -->
                <div class="mb-8 border-t-2 border-gray-100 pt-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-file-alt text-white text-sm"></i>
                        </div>
                        Content & Files
                    </h4>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="group">
                            <label for="footer_text" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-copyright text-orange-500 mr-2"></i>Footer Copyright Text
                            </label>
                            <input type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition duration-300 group-hover:border-orange-300" id="footer_text" name="footer_text" 
                                   value="{{ old('footer_text', $settings->where('key', 'footer_text')->first()->value ?? '') }}" 
                                   placeholder="© 2026 Your Name. All rights reserved.">
                        </div>

                        <div class="group p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border-2 border-blue-200 hover:border-blue-400 transition duration-300">
                            <label for="resume_pdf" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-file-pdf text-red-600 mr-2"></i>Resume PDF File
                            </label>
                            @php
                                $currentResume = $settings->where('key', 'resume_pdf_path')->first();
                            @endphp
                            @if($currentResume && $currentResume->value)
                                <div class="mb-4 p-4 bg-white rounded-lg border-2 border-blue-200 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle text-green-500 mr-3 text-2xl"></i>
                                        <div>
                                            <p class="font-semibold text-gray-800">Current Resume Uploaded</p>
                                            <p class="text-sm text-gray-600">{{ basename($currentResume->value) }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ asset('storage/' . $currentResume->value) }}" target="_blank" class="text-blue-600 hover:text-blue-700 font-semibold">
                                        <i class="fas fa-external-link-alt mr-1"></i>View
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="resume_pdf" id="resume_pdf" accept=".pdf" class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition duration-300 bg-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-2 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-blue-500 mr-2"></i>Upload your resume PDF (max 10MB). This will be available for download on your portfolio.</p>
                        </div>

                        <div class="group">
                            <label for="resume_download_url" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-download text-red-500 mr-2"></i>Resume Download URL
                            </label>
                            <input type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-red-200 focus:border-red-500 transition duration-300 group-hover:border-red-300" id="resume_download_url" name="resume_download_url" 
                                   value="{{ old('resume_download_url', $settings->where('key', 'resume_download_url')->first()->value ?? '') }}" 
                                   placeholder="/storage/resume.pdf">
                            <p class="mt-2 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-red-500 mr-2"></i>Link to your downloadable resume file</p>
                        </div>
                    </div>
                </div>

                <!-- Animation & Effects Section -->
                <div class="mb-8 border-t-2 border-gray-100 pt-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-magic text-white text-sm"></i>
                        </div>
                        Animation & Effects
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group p-6 bg-gradient-to-br from-cyan-50 to-blue-100 rounded-xl border-2 border-cyan-200 hover:border-cyan-400 transition duration-300">
                            <label for="enable_hero_animation" class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" id="enable_hero_animation" name="enable_hero_animation" value="1" 
                                           {{ old('enable_hero_animation', $settings->where('key', 'enable_hero_animation')->first()->value ?? '1') == '1' ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-14 h-8 bg-gray-300 rounded-full peer peer-checked:bg-gradient-to-r peer-checked:from-cyan-500 peer-checked:to-blue-500 transition-all duration-300"></div>
                                    <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition-all duration-300 peer-checked:translate-x-6 shadow-md"></div>
                                </div>
                                <div class="ml-4">
                                    <span class="text-sm font-bold text-gray-800 flex items-center">
                                        <i class="fas fa-sparkles text-cyan-600 mr-2"></i>Enable Hero Animation
                                    </span>
                                    <p class="text-xs text-gray-600 mt-1">Tech-style typing effect and floating particles in hero section</p>
                                </div>
                            </label>
                        </div>

                        <div class="group p-6 bg-gradient-to-br from-purple-50 to-pink-100 rounded-xl border-2 border-purple-200 hover:border-purple-400 transition duration-300">
                            <label for="enable_preloader" class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" id="enable_preloader" name="enable_preloader" value="1" 
                                           {{ old('enable_preloader', $settings->where('key', 'enable_preloader')->first()->value ?? '1') == '1' ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-14 h-8 bg-gray-300 rounded-full peer peer-checked:bg-gradient-to-r peer-checked:from-purple-500 peer-checked:to-pink-500 transition-all duration-300"></div>
                                    <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition-all duration-300 peer-checked:translate-x-6 shadow-md"></div>
                                </div>
                                <div class="ml-4">
                                    <span class="text-sm font-bold text-gray-800 flex items-center">
                                        <i class="fas fa-spinner text-purple-600 mr-2"></i>Enable Preloader
                                    </span>
                                    <p class="text-xs text-gray-600 mt-1">Show technical preloader animation before page loads</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- SEO & Analytics Section -->
                <div class="mb-8 border-t-2 border-gray-100 pt-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-chart-line text-white text-sm"></i>
                        </div>
                        SEO & Analytics
                    </h4>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="group">
                            <label for="meta_description" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-file-alt text-indigo-500 mr-2"></i>Meta Description (SEO)
                            </label>
                            <textarea class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition duration-300 group-hover:border-indigo-300 resize-none" id="meta_description" name="meta_description" rows="2" 
                                      placeholder="A brief description for search engines">{{ old('meta_description', $settings->where('key', 'meta_description')->first()->value ?? '') }}</textarea>
                            <p class="mt-2 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-indigo-500 mr-2"></i>Appears in search engine results (150-160 characters recommended)</p>
                        </div>

                        <div class="group">
                            <label for="meta_keywords" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-tags text-purple-500 mr-2"></i>Meta Keywords (SEO)
                            </label>
                            <input type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition duration-300 group-hover:border-purple-300" id="meta_keywords" name="meta_keywords" 
                                   value="{{ old('meta_keywords', $settings->where('key', 'meta_keywords')->first()->value ?? '') }}" 
                                   placeholder="developer, portfolio, web design, etc.">
                            <p class="mt-2 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-purple-500 mr-2"></i>Comma-separated keywords</p>
                        </div>

                        <div class="group">
                            <label for="google_analytics_id" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fab fa-google text-blue-600 mr-2"></i>Google Analytics ID
                            </label>
                            <input type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition duration-300 group-hover:border-blue-300" id="google_analytics_id" name="google_analytics_id" 
                                   value="{{ old('google_analytics_id', $settings->where('key', 'google_analytics_id')->first()->value ?? '') }}" 
                                   placeholder="G-XXXXXXXXXX">
                            <p class="mt-2 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-blue-500 mr-2"></i>Optional: For tracking website visitors</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-8 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-save mr-2"></i>Save Settings
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
