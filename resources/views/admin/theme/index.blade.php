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
        const textInput = this.nextElementSibling;
        textInput.value = this.value;
    });
});
</script>
@endsection
