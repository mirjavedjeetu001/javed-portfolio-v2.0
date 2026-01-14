@extends('admin.layout')

@section('title', 'Theme Settings')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-purple-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-palette text-white text-xl"></i>
                </div>
                Theme Customization
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Personalize your portfolio with custom colors and fonts</p>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-pink-400 to-purple-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-pink-50 to-purple-50 px-8 py-6 border-b border-pink-100">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-paintbrush text-pink-600 mr-3"></i>
                    Color & Typography Settings
                </h3>
                <p class="text-gray-600 mt-1">Customize the visual appearance of your portfolio</p>
            </div>
            
            <form action="{{ route('admin.theme.update') }}" method="POST" class="p-8">
                @csrf
                
                <!-- Color Scheme Section -->
                <div class="mb-8">
                    <h4 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-swatchbook text-white"></i>
                        </div>
                        Color Scheme
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="group p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border-2 border-blue-200 hover:border-blue-400 transition duration-300">
                            <label for="primary_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-circle text-blue-600 mr-2"></i>Primary Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-blue-300 cursor-pointer hover:scale-110 transition" id="primary_color" 
                                       name="primary_color" value="{{ old('primary_color', $theme->primary_color ?? '#3498db') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-blue-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition" value="{{ old('primary_color', $theme->primary_color ?? '#3498db') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-blue-500 mr-2"></i>Used for links, buttons, and primary accents</p>
                        </div>
                        
                        <div class="group p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border-2 border-green-200 hover:border-green-400 transition duration-300">
                            <label for="secondary_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-circle text-green-600 mr-2"></i>Secondary Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-green-300 cursor-pointer hover:scale-110 transition" id="secondary_color" 
                                       name="secondary_color" value="{{ old('secondary_color', $theme->secondary_color ?? '#2ecc71') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-green-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-green-200 focus:border-green-500 transition" value="{{ old('secondary_color', $theme->secondary_color ?? '#2ecc71') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-green-500 mr-2"></i>Secondary accents and highlights</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="group p-6 bg-gradient-to-br from-red-50 to-red-100 rounded-xl border-2 border-red-200 hover:border-red-400 transition duration-300">
                            <label for="accent_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-circle text-red-600 mr-2"></i>Accent Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-red-300 cursor-pointer hover:scale-110 transition" id="accent_color" 
                                       name="accent_color" value="{{ old('accent_color', $theme->accent_color ?? '#e74c3c') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-red-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-red-200 focus:border-red-500 transition" value="{{ old('accent_color', $theme->accent_color ?? '#e74c3c') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-red-500 mr-2"></i>Special highlights and CTAs</p>
                        </div>
                        
                        <div class="group p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200 hover:border-gray-400 transition duration-300">
                            <label for="text_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-circle text-gray-600 mr-2"></i>Text Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-gray-300 cursor-pointer hover:scale-110 transition" id="text_color" 
                                       name="text_color" value="{{ old('text_color', $theme->text_color ?? '#333333') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-gray-200 focus:border-gray-500 transition" value="{{ old('text_color', $theme->text_color ?? '#333333') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-gray-500 mr-2"></i>Main text color</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border-2 border-purple-200 hover:border-purple-400 transition duration-300">
                            <label for="background_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-circle text-purple-600 mr-2"></i>Background Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-purple-300 cursor-pointer hover:scale-110 transition" id="background_color" 
                                       name="background_color" value="{{ old('background_color', $theme->background_color ?? '#ffffff') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-purple-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition" value="{{ old('background_color', $theme->background_color ?? '#ffffff') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-purple-500 mr-2"></i>Page background color</p>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Colors Section -->
                <div class="mb-8 border-t-2 border-gray-100 pt-8">
                    <h4 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-blue-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-mobile-alt text-white"></i>
                        </div>
                        Mobile Menu Colors
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border-2 border-purple-200 hover:border-purple-400 transition duration-300">
                            <label for="mobile_menu_bg_from" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-circle text-purple-600 mr-2"></i>Menu Gradient Start
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-purple-300 cursor-pointer hover:scale-110 transition" id="mobile_menu_bg_from" 
                                       name="mobile_menu_bg_from" value="{{ old('mobile_menu_bg_from', $theme->mobile_menu_bg_from ?? '#9333ea') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-purple-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition" value="{{ old('mobile_menu_bg_from', $theme->mobile_menu_bg_from ?? '#9333ea') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-purple-500 mr-2"></i>Mobile sidebar gradient start color</p>
                        </div>
                        
                        <div class="group p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border-2 border-blue-200 hover:border-blue-400 transition duration-300">
                            <label for="mobile_menu_bg_via" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-circle text-blue-600 mr-2"></i>Menu Gradient Middle
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-blue-300 cursor-pointer hover:scale-110 transition" id="mobile_menu_bg_via" 
                                       name="mobile_menu_bg_via" value="{{ old('mobile_menu_bg_via', $theme->mobile_menu_bg_via ?? '#2563eb') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-blue-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition" value="{{ old('mobile_menu_bg_via', $theme->mobile_menu_bg_via ?? '#2563eb') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-blue-500 mr-2"></i>Mobile sidebar gradient middle color</p>
                        </div>
                        
                        <div class="group p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border-2 border-purple-200 hover:border-purple-400 transition duration-300">
                            <label for="mobile_menu_bg_to" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-circle text-purple-700 mr-2"></i>Menu Gradient End
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-purple-300 cursor-pointer hover:scale-110 transition" id="mobile_menu_bg_to" 
                                       name="mobile_menu_bg_to" value="{{ old('mobile_menu_bg_to', $theme->mobile_menu_bg_to ?? '#7c3aed') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-purple-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition" value="{{ old('mobile_menu_bg_to', $theme->mobile_menu_bg_to ?? '#7c3aed') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-purple-500 mr-2"></i>Mobile sidebar gradient end color</p>
                        </div>
                        
                        <div class="group p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200 hover:border-gray-400 transition duration-300">
                            <label for="mobile_menu_text" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-font text-gray-600 mr-2"></i>Menu Text Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-gray-300 cursor-pointer hover:scale-110 transition" id="mobile_menu_text" 
                                       name="mobile_menu_text" value="{{ old('mobile_menu_text', $theme->mobile_menu_text ?? '#ffffff') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-gray-200 focus:border-gray-500 transition" value="{{ old('mobile_menu_text', $theme->mobile_menu_text ?? '#ffffff') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-gray-500 mr-2"></i>Mobile menu text and icon color</p>
                        </div>
                    </div>
                </div>

                <!-- Section Background Colors -->
                <div class="mb-8 border-t-2 border-gray-100 pt-8">
                    <h4 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-layer-group text-white"></i>
                        </div>
                        Section Background Colors
                    </h4>
                    
                    <!-- Info Alert -->
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 p-4 rounded-xl mb-6">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-info-circle text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-700"><strong>Note:</strong> Hero and Contact sections use <strong>Primary & Secondary colors</strong> for gradient backgrounds. Customize them in the "Color Scheme" section above.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- About Section -->
                        <div class="group p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200 hover:border-gray-400 transition duration-300">
                            <label for="about_bg_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-user text-gray-600 mr-2"></i>About Section
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-gray-300 cursor-pointer hover:scale-110 transition" id="about_bg_color" 
                                       name="about_bg_color" value="{{ old('about_bg_color', $theme->about_bg_color ?? '#f9fafb') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl font-mono text-sm focus:ring-4 focus:ring-gray-200 focus:border-gray-500 transition" value="{{ old('about_bg_color', $theme->about_bg_color ?? '#f9fafb') }}" readonly>
                            </div>
                        </div>
                        
                        <!-- Experience Section -->
                        <div class="group p-6 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl border-2 border-indigo-200 hover:border-indigo-400 transition duration-300">
                            <label for="experience_bg_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-briefcase text-indigo-600 mr-2"></i>Experience Section
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-indigo-300 cursor-pointer hover:scale-110 transition" id="experience_bg_color" 
                                       name="experience_bg_color" value="{{ old('experience_bg_color', $theme->experience_bg_color ?? '#eef2ff') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-indigo-200 rounded-xl font-mono text-sm focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition" value="{{ old('experience_bg_color', $theme->experience_bg_color ?? '#eef2ff') }}" readonly>
                            </div>
                        </div>
                        
                        <!-- Education Section -->
                        <div class="group p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl border-2 border-yellow-200 hover:border-yellow-400 transition duration-300">
                            <label for="education_bg_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-graduation-cap text-yellow-600 mr-2"></i>Education Section
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-yellow-300 cursor-pointer hover:scale-110 transition" id="education_bg_color" 
                                       name="education_bg_color" value="{{ old('education_bg_color', $theme->education_bg_color ?? '#fef3c7') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-yellow-200 rounded-xl font-mono text-sm focus:ring-4 focus:ring-yellow-200 focus:border-yellow-500 transition" value="{{ old('education_bg_color', $theme->education_bg_color ?? '#fef3c7') }}" readonly>
                            </div>
                        </div>
                        
                        <!-- Certifications Section -->
                        <div class="group p-6 bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl border-2 border-teal-200 hover:border-teal-400 transition duration-300">
                            <label for="certifications_bg_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-certificate text-teal-600 mr-2"></i>Certifications
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-teal-300 cursor-pointer hover:scale-110 transition" id="certifications_bg_color" 
                                       name="certifications_bg_color" value="{{ old('certifications_bg_color', $theme->certifications_bg_color ?? '#ecfdf5') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-teal-200 rounded-xl font-mono text-sm focus:ring-4 focus:ring-teal-200 focus:border-teal-500 transition" value="{{ old('certifications_bg_color', $theme->certifications_bg_color ?? '#ecfdf5') }}" readonly>
                            </div>
                        </div>
                        
                        <!-- Skills Section -->
                        <div class="group p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border-2 border-green-200 hover:border-green-400 transition duration-300">
                            <label for="skills_bg_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-code text-green-600 mr-2"></i>Skills Section
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-green-300 cursor-pointer hover:scale-110 transition" id="skills_bg_color" 
                                       name="skills_bg_color" value="{{ old('skills_bg_color', $theme->skills_bg_color ?? '#dcfce7') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-green-200 rounded-xl font-mono text-sm focus:ring-4 focus:ring-green-200 focus:border-green-500 transition" value="{{ old('skills_bg_color', $theme->skills_bg_color ?? '#dcfce7') }}" readonly>
                            </div>
                        </div>
                        
                        <!-- Projects Section -->
                        <div class="group p-6 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl border-2 border-orange-200 hover:border-orange-400 transition duration-300">
                            <label for="projects_bg_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-project-diagram text-orange-600 mr-2"></i>Projects Section
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-orange-300 cursor-pointer hover:scale-110 transition" id="projects_bg_color" 
                                       name="projects_bg_color" value="{{ old('projects_bg_color', $theme->projects_bg_color ?? '#ffedd5') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-orange-200 rounded-xl font-mono text-sm focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition" value="{{ old('projects_bg_color', $theme->projects_bg_color ?? '#ffedd5') }}" readonly>
                            </div>
                        </div>
                        
                        <!-- Awards Section -->
                        <div class="group p-6 bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl border-2 border-pink-200 hover:border-pink-400 transition duration-300">
                            <label for="awards_bg_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-trophy text-pink-600 mr-2"></i>Awards Section
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-pink-300 cursor-pointer hover:scale-110 transition" id="awards_bg_color" 
                                       name="awards_bg_color" value="{{ old('awards_bg_color', $theme->awards_bg_color ?? '#fce7f3') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-pink-200 rounded-xl font-mono text-sm focus:ring-4 focus:ring-pink-200 focus:border-pink-500 transition" value="{{ old('awards_bg_color', $theme->awards_bg_color ?? '#fce7f3') }}" readonly>
                            </div>
                        </div>
                        
                        <!-- Activities Section -->
                        <div class="group p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border-2 border-blue-200 hover:border-blue-400 transition duration-300">
                            <label for="activities_bg_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-tasks text-blue-600 mr-2"></i>Activities Section
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-blue-300 cursor-pointer hover:scale-110 transition" id="activities_bg_color" 
                                       name="activities_bg_color" value="{{ old('activities_bg_color', $theme->activities_bg_color ?? '#dbeafe') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-blue-200 rounded-xl font-mono text-sm focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition" value="{{ old('activities_bg_color', $theme->activities_bg_color ?? '#dbeafe') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Text Colors -->
                <div class="mb-8 border-t-2 border-gray-100 pt-8">
                    <h4 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-text-height text-white"></i>
                        </div>
                        Section Text Colors
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border-2 border-blue-200 hover:border-blue-400 transition duration-300">
                            <label for="hero_text_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-font text-blue-600 mr-2"></i>Hero Text Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-blue-300 cursor-pointer hover:scale-110 transition" id="hero_text_color" 
                                       name="hero_text_color" value="{{ old('hero_text_color', $theme->hero_text_color ?? '#ffffff') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-blue-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition" value="{{ old('hero_text_color', $theme->hero_text_color ?? '#ffffff') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-blue-500 mr-2"></i>Hero section text and name color</p>
                        </div>
                        
                        <div class="group p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200 hover:border-gray-400 transition duration-300">
                            <label for="section_heading_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-heading text-gray-700 mr-2"></i>Section Heading Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-gray-300 cursor-pointer hover:scale-110 transition" id="section_heading_color" 
                                       name="section_heading_color" value="{{ old('section_heading_color', $theme->section_heading_color ?? '#1f2937') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-gray-200 focus:border-gray-500 transition" value="{{ old('section_heading_color', $theme->section_heading_color ?? '#1f2937') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-gray-500 mr-2"></i>All section headings (About, Skills, etc.)</p>
                        </div>
                        
                        <div class="group p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border-2 border-slate-200 hover:border-slate-400 transition duration-300">
                            <label for="section_text_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-paragraph text-slate-600 mr-2"></i>Section Text Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-slate-300 cursor-pointer hover:scale-110 transition" id="section_text_color" 
                                       name="section_text_color" value="{{ old('section_text_color', $theme->section_text_color ?? '#4b5563') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-slate-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-slate-200 focus:border-slate-500 transition" value="{{ old('section_text_color', $theme->section_text_color ?? '#4b5563') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-slate-500 mr-2"></i>General section paragraph text</p>
                        </div>
                        
                        <div class="group p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border-2 border-purple-200 hover:border-purple-400 transition duration-300">
                            <label for="contact_text_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-font text-purple-600 mr-2"></i>Contact Text Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-purple-300 cursor-pointer hover:scale-110 transition" id="contact_text_color" 
                                       name="contact_text_color" value="{{ old('contact_text_color', $theme->contact_text_color ?? '#ffffff') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-purple-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition" value="{{ old('contact_text_color', $theme->contact_text_color ?? '#ffffff') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-purple-500 mr-2"></i>Contact form labels and text</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Colors Section -->
                <div class="mb-8 border-t-2 border-gray-100 pt-8">
                    <h4 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-gray-700 to-gray-900 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-arrow-down text-white"></i>
                        </div>
                        Footer Colors
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border-2 border-gray-200 hover:border-gray-400 transition duration-300">
                            <label for="footer_bg_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-fill-drip text-gray-700 mr-2"></i>Footer Background
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-gray-300 cursor-pointer hover:scale-110 transition" id="footer_bg_color" 
                                       name="footer_bg_color" value="{{ old('footer_bg_color', $theme->footer_bg_color ?? '#111827') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-gray-200 focus:border-gray-500 transition" value="{{ old('footer_bg_color', $theme->footer_bg_color ?? '#111827') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-gray-500 mr-2"></i>Footer background color</p>
                        </div>
                        
                        <div class="group p-6 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border-2 border-slate-200 hover:border-slate-400 transition duration-300">
                            <label for="footer_text_color" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-font text-slate-600 mr-2"></i>Footer Text Color
                            </label>
                            <div class="flex items-center gap-3">
                                <input type="color" class="w-16 h-16 rounded-xl border-2 border-slate-300 cursor-pointer hover:scale-110 transition" id="footer_text_color" 
                                       name="footer_text_color" value="{{ old('footer_text_color', $theme->footer_text_color ?? '#ffffff') }}">
                                <input type="text" class="flex-1 px-4 py-3 border-2 border-slate-200 rounded-xl font-mono text-lg focus:ring-4 focus:ring-slate-200 focus:border-slate-500 transition" value="{{ old('footer_text_color', $theme->footer_text_color ?? '#ffffff') }}" readonly>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-slate-500 mr-2"></i>Footer text and link colors</p>
                        </div>
                    </div>
                </div>

                <!-- Typography Section -->
                <div class="mb-8 border-t-2 border-gray-100 pt-8">
                    <h4 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-font text-white"></i>
                        </div>
                        Typography
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group p-6 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl border-2 border-indigo-200 hover:border-indigo-400 transition duration-300">
                            <label for="font_family" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-text-height text-indigo-600 mr-2"></i>Body Font
                            </label>
                            <select name="font_family" id="font_family" class="w-full px-4 py-3 border-2 border-indigo-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition text-lg font-semibold">
                                <option value="Inter, sans-serif" {{ ($theme->font_family ?? '') == 'Inter, sans-serif' ? 'selected' : '' }}>Inter</option>
                                <option value="Roboto, sans-serif" {{ ($theme->font_family ?? '') == 'Roboto, sans-serif' ? 'selected' : '' }}>Roboto</option>
                                <option value="Open Sans, sans-serif" {{ ($theme->font_family ?? '') == 'Open Sans, sans-serif' ? 'selected' : '' }}>Open Sans</option>
                                <option value="Lato, sans-serif" {{ ($theme->font_family ?? '') == 'Lato, sans-serif' ? 'selected' : '' }}>Lato</option>
                                <option value="Poppins, sans-serif" {{ ($theme->font_family ?? '') == 'Poppins, sans-serif' ? 'selected' : '' }}>Poppins</option>
                            </select>
                        </div>
                        
                        <div class="group p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border-2 border-purple-200 hover:border-purple-400 transition duration-300">
                            <label for="heading_font" class="block text-sm font-bold text-gray-700 mb-3 flex items-center">
                                <i class="fas fa-heading text-purple-600 mr-2"></i>Heading Font
                            </label>
                            <select name="heading_font" id="heading_font" class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition text-lg font-semibold">
                                <option value="Poppins, sans-serif" {{ ($theme->heading_font ?? '') == 'Poppins, sans-serif' ? 'selected' : '' }}>Poppins</option>
                                <option value="Montserrat, sans-serif" {{ ($theme->heading_font ?? '') == 'Montserrat, sans-serif' ? 'selected' : '' }}>Montserrat</option>
                                <option value="Raleway, sans-serif" {{ ($theme->heading_font ?? '') == 'Raleway, sans-serif' ? 'selected' : '' }}>Raleway</option>
                                <option value="Playfair Display, serif" {{ ($theme->heading_font ?? '') == 'Playfair Display, serif' ? 'selected' : '' }}>Playfair Display</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Info Alert -->
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 p-6 rounded-xl mb-6">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-info-circle text-white"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 mb-1">Preview Your Changes</h5>
                            <p class="text-gray-600">Click "Save Changes" then visit your portfolio to see the new theme in action.</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <button type="submit" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-pink-600 to-purple-600 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-700 hover:to-purple-700 text-white px-8 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Sync color picker with text input
document.querySelectorAll('input[type="color"]').forEach(colorInput => {
    colorInput.addEventListener('input', function() {
        // Find the text input which is the next input element after this color picker
        const container = this.parentElement;
        const textInput = container.querySelector('input[type="text"]');
        if (textInput) {
            textInput.value = this.value;
        }
    });
});

// Also sync text input back to color picker
document.querySelectorAll('input[type="text"][readonly]').forEach(textInput => {
    const container = textInput.parentElement;
    const colorInput = container.querySelector('input[type="color"]');
    if (colorInput) {
        textInput.addEventListener('change', function() {
            colorInput.value = this.value;
        });
    }
});
</script>
@endsection
