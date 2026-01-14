@extends('admin.layout')

@section('title', 'Add Project')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                Add New Project
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Showcase a new project in your portfolio</p>
        </div>
    </div>
</div>

<div class="max-w-4xl">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-orange-400 to-red-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-orange-50 to-red-50 px-8 py-6 border-b border-orange-100">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-rocket text-orange-600 mr-3"></i>
                    Project Information
                </h3>
            </div>
            
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                <div class="mb-6">
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-heading text-orange-600 mr-2"></i>Project Title *
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition @error('title') border-red-500 @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-orange-600 mr-2"></i>Short Description *
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition @error('description') border-red-500 @enderror" 
                              id="description" 
                              name="description" 
                              rows="2" 
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>Brief summary (displayed in cards)
                    </p>
                </div>

                <div class="mb-6">
                    <label for="long_description" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-file-alt text-orange-600 mr-2"></i>Detailed Description
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition @error('long_description') border-red-500 @enderror" 
                              id="long_description" 
                              name="long_description" 
                              rows="5">{{ old('long_description') }}</textarea>
                    @error('long_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>Full project details (optional)
                    </p>
                </div>

                <div class="mb-6">
                    <label for="technologies" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-code text-orange-600 mr-2"></i>Technologies Used
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition @error('technologies') border-red-500 @enderror" 
                           id="technologies" 
                           name="technologies" 
                           value="{{ old('technologies') }}" 
                           placeholder="Laravel, Vue.js, MySQL, etc.">
                    @error('technologies')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>Separate with commas
                    </p>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-image text-orange-600 mr-2"></i>Project Image
                    </label>
                    <input type="file" 
                           class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition @error('image') border-red-500 @enderror" 
                           id="image" 
                           name="image" 
                           accept="image/*">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>Recommended: 800x600px (max 2MB)
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="demo_url" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-external-link-alt text-orange-600 mr-2"></i>Demo URL
                        </label>
                        <input type="url" 
                               class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition @error('demo_url') border-red-500 @enderror" 
                               id="demo_url" 
                               name="demo_url" 
                               value="{{ old('demo_url') }}" 
                               placeholder="https://demo.example.com">
                        @error('demo_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="github_url" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fab fa-github text-orange-600 mr-2"></i>GitHub URL
                        </label>
                        <input type="url" 
                               class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition @error('github_url') border-red-500 @enderror" 
                               id="github_url" 
                               name="github_url" 
                               value="{{ old('github_url') }}" 
                               placeholder="https://github.com/username/repo">
                        @error('github_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <div class="flex items-center">
                            <input class="w-5 h-5 text-orange-600 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 focus:ring-2" 
                                   type="checkbox" 
                                   id="featured" 
                                   name="featured" 
                                   value="1" 
                                   {{ old('featured') ? 'checked' : '' }}>
                            <label class="ml-3 text-sm font-bold text-gray-700 flex items-center" for="featured">
                                <i class="fas fa-star text-orange-600 mr-2"></i>Featured Project
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label for="order" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-sort-numeric-down text-orange-600 mr-2"></i>Display Order
                        </label>
                        <input type="number" 
                               class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition @error('order') border-red-500 @enderror" 
                               id="order" 
                               name="order" 
                               value="{{ old('order', 0) }}" 
                               min="0">
                        @error('order')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.projects.index') }}" class="group relative">
                        <div class="absolute inset-0 bg-gray-400 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i>Back
                        </div>
                    </a>
                    <button type="submit" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-save mr-2"></i>Save Project
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
