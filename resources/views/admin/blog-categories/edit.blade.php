@extends('admin.layout')

@section('title', 'Edit Blog Category')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 via-pink-500 to-red-500 rounded-3xl shadow-2xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-extrabold text-white mb-2 flex items-center">
                    <i class="fas fa-edit mr-4"></i>
                    Edit Category
                </h1>
                <p class="text-purple-100 text-lg">Update {{ $blogCategory->name }} category details</p>
            </div>
            <a href="{{ route('admin.blog-categories.index') }}" class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-white to-gray-200 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                <button class="relative bg-white text-purple-600 px-6 py-3 rounded-xl font-bold flex items-center hover:bg-gray-50 transition shadow-xl">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Categories
                </button>
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-2 border-gray-100">
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 border-b-2 border-purple-100">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-info-circle text-purple-600 mr-3"></i>
                Category Details
            </h2>
        </div>

        <form action="{{ route('admin.blog-categories.update', $blogCategory) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Category Name -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                        <i class="fas fa-tag text-purple-500 mr-2"></i>
                        Category Name *
                    </label>
                    <input type="text" name="name" value="{{ old('name', $blogCategory->name) }}" required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none transition @error('name') border-red-500 @enderror"
                        placeholder="e.g., Technology, Lifestyle, Travel">
                    @error('name')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                        <i class="fas fa-align-left text-purple-500 mr-2"></i>
                        Description
                    </label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none transition @error('description') border-red-500 @enderror"
                        placeholder="Brief description of this category">{{ old('description', $blogCategory->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Color Picker -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                        <i class="fas fa-palette text-purple-500 mr-2"></i>
                        Color Theme
                    </label>
                    <div class="flex gap-2 flex-wrap">
                        @foreach(['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'purple', 'pink'] as $color)
                            <label class="cursor-pointer">
                                <input type="radio" name="color" value="{{ $color }}" class="hidden peer" {{ old('color', $blogCategory->color) == $color ? 'checked' : '' }}>
                                <div class="w-10 h-10 rounded-full bg-{{ $color }}-500 border-4 border-transparent peer-checked:border-gray-800 hover:scale-110 transition shadow-lg"></div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Icon Selection -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                        <i class="fas fa-icons text-purple-500 mr-2"></i>
                        Icon (Font Awesome)
                    </label>
                    <select name="icon" class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none transition">
                        <option value="">Select an icon...</option>
                        <option value="fas fa-laptop-code" {{ old('icon', $blogCategory->icon) == 'fas fa-laptop-code' ? 'selected' : '' }}>💻 Code</option>
                        <option value="fas fa-heart" {{ old('icon', $blogCategory->icon) == 'fas fa-heart' ? 'selected' : '' }}>❤️ Heart</option>
                        <option value="fas fa-plane" {{ old('icon', $blogCategory->icon) == 'fas fa-plane' ? 'selected' : '' }}>✈️ Travel</option>
                        <option value="fas fa-book" {{ old('icon', $blogCategory->icon) == 'fas fa-book' ? 'selected' : '' }}>📚 Book</option>
                        <option value="fas fa-camera" {{ old('icon', $blogCategory->icon) == 'fas fa-camera' ? 'selected' : '' }}>📷 Camera</option>
                        <option value="fas fa-music" {{ old('icon', $blogCategory->icon) == 'fas fa-music' ? 'selected' : '' }}>🎵 Music</option>
                        <option value="fas fa-gamepad" {{ old('icon', $blogCategory->icon) == 'fas fa-gamepad' ? 'selected' : '' }}>🎮 Gaming</option>
                        <option value="fas fa-utensils" {{ old('icon', $blogCategory->icon) == 'fas fa-utensils' ? 'selected' : '' }}>🍴 Food</option>
                        <option value="fas fa-dumbbell" {{ old('icon', $blogCategory->icon) == 'fas fa-dumbbell' ? 'selected' : '' }}>💪 Fitness</option>
                        <option value="fas fa-lightbulb" {{ old('icon', $blogCategory->icon) == 'fas fa-lightbulb' ? 'selected' : '' }}>💡 Ideas</option>
                    </select>
                </div>

                <!-- Order -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                        <i class="fas fa-sort text-purple-500 mr-2"></i>
                        Display Order
                    </label>
                    <input type="number" name="order" value="{{ old('order', $blogCategory->order) }}" min="0"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none transition"
                        placeholder="0">
                    <p class="text-gray-500 text-xs mt-1">Lower numbers appear first</p>
                </div>

                <!-- Active Status -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                        <i class="fas fa-toggle-on text-purple-500 mr-2"></i>
                        Status
                    </label>
                    <label class="flex items-center cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $blogCategory->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-14 h-8 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-purple-600 peer-checked:to-pink-600"></div>
                        </div>
                        <span class="ml-3 text-sm font-semibold text-gray-700 group-hover:text-purple-600 transition">Active</span>
                    </label>
                    <p class="text-gray-500 text-xs mt-1">Only active categories are shown to visitors</p>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 pt-6 border-t-2 border-gray-100 flex gap-4">
                <button type="submit" class="flex-1 group relative overflow-hidden">
                    <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                    <div class="relative bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-4 rounded-xl font-bold flex items-center justify-center transition shadow-xl">
                        <i class="fas fa-save mr-2"></i>
                        Update Category
                    </div>
                </button>
                <a href="{{ route('admin.blog-categories.index') }}" class="flex-1 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 px-8 py-4 rounded-xl font-bold flex items-center justify-center transition shadow-lg">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
