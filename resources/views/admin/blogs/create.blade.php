@extends('admin.layout')

@section('title', 'Create Blog Post')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-500 rounded-3xl shadow-2xl p-8 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-extrabold text-white mb-2 flex items-center">
                    <i class="fas fa-pen-fancy mr-4"></i>
                    Create New Blog Post
                </h1>
                <p class="text-cyan-100 text-lg">Share your thoughts and ideas with the world</p>
            </div>
            <a href="{{ route('admin.blogs.index') }}" class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-white to-gray-200 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                <button class="relative bg-white text-blue-600 px-6 py-3 rounded-xl font-bold flex items-center hover:bg-gray-50 transition shadow-xl">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Posts
                </button>
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-2 border-gray-100">
        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-6 border-b-2 border-blue-100">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-file-alt text-blue-600 mr-3"></i>
                Post Content
            </h2>
        </div>

        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content (2/3) -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <i class="fas fa-heading text-blue-500 mr-2"></i>
                            Post Title *
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition @error('title') border-red-500 @enderror"
                            placeholder="Enter an engaging title for your blog post">
                        @error('title')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <i class="fas fa-quote-left text-blue-500 mr-2"></i>
                            Excerpt (Short Description)
                        </label>
                        <textarea name="excerpt" rows="3"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition"
                            placeholder="A brief summary of your post (shown in listings)">{{ old('excerpt') }}</textarea>
                    </div>

                    <!-- Content Editor -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                            Post Content *
                        </label>
                        <textarea name="content" id="content" rows="20"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition @error('content') border-red-500 @enderror"
                            placeholder="Write your amazing content here...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-2">💡 Tip: Use the editor toolbar for formatting, images, and links</p>
                    </div>
                </div>

                <!-- Sidebar (1/3) -->
                <div class="space-y-6">
                    <!-- Featured Image -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-2xl border-2 border-gray-200">
                        <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <i class="fas fa-image text-blue-500 mr-2"></i>
                            Featured Image
                        </label>
                        <input type="file" name="featured_image" accept="image/*" id="featured_image"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition text-sm">
                        <p class="text-gray-500 text-xs mt-2">Max 2MB (JPEG, PNG, GIF, WebP)</p>
                        <div id="image-preview" class="mt-3 hidden">
                            <img src="" alt="Preview" class="w-full rounded-xl shadow-lg">
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-2xl border-2 border-gray-200">
                        <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <i class="fas fa-folder text-blue-500 mr-2"></i>
                            Category *
                        </label>
                        <select name="category_id" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition @error('category_id') border-red-500 @enderror">
                            <option value="">Select a category...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author Name -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-2xl border-2 border-gray-200">
                        <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <i class="fas fa-user text-blue-500 mr-2"></i>
                            Author Name
                        </label>
                        <input type="text" name="author_name" value="{{ old('author_name', auth()->user()->name ?? '') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition"
                            placeholder="e.g., John Doe">
                    </div>

                    <!-- Tags -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-2xl border-2 border-gray-200">
                        <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <i class="fas fa-tags text-blue-500 mr-2"></i>
                            Tags
                        </label>
                        <input type="text" name="tags" value="{{ old('tags') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition"
                            placeholder="e.g., technology, coding, web">
                        <p class="text-gray-500 text-xs mt-2">Separate tags with commas</p>
                    </div>

                    <!-- Social Link -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-2xl border-2 border-gray-200">
                        <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <i class="fas fa-share-alt text-blue-500 mr-2"></i>
                            Social Media Link
                        </label>
                        <input type="url" name="social_link" value="{{ old('social_link') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition"
                            placeholder="https://twitter.com/yourpost">
                        <p class="text-gray-500 text-xs mt-2">Link to related social media post</p>
                    </div>

                    <!-- Publish Date -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-2xl border-2 border-gray-200">
                        <label class="block text-gray-700 text-sm font-bold mb-2 flex items-center">
                            <i class="fas fa-calendar text-blue-500 mr-2"></i>
                            Publish Date
                        </label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:outline-none transition">
                    </div>

                    <!-- Status Options -->
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-2xl border-2 border-blue-200">
                        <h3 class="font-bold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-cog text-blue-600 mr-2"></i>
                            Publication Options
                        </h3>
                        
                        <label class="flex items-center cursor-pointer group mb-3">
                            <div class="relative">
                                <input type="checkbox" name="is_published" value="1" class="sr-only peer">
                                <div class="w-14 h-8 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-blue-600 peer-checked:to-cyan-600"></div>
                            </div>
                            <span class="ml-3 text-sm font-semibold text-gray-700">Publish immediately</span>
                        </label>

                        <label class="flex items-center cursor-pointer group">
                            <div class="relative">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                                <div class="w-14 h-8 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-yellow-500 peer-checked:to-orange-500"></div>
                            </div>
                            <span class="ml-3 text-sm font-semibold text-gray-700">Mark as featured</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-8 pt-6 border-t-2 border-gray-100 flex gap-4">
                <button type="submit" class="flex-1 group relative overflow-hidden">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                    <div class="relative bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-8 py-4 rounded-xl font-bold flex items-center justify-center transition shadow-xl">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Publish Blog Post
                    </div>
                </button>
                <a href="{{ route('admin.blogs.index') }}" class="flex-1 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 px-8 py-4 rounded-xl font-bold flex items-center justify-center transition shadow-lg">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<!-- TinyMCE Rich Text Editor -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image | code | help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif; font-size: 16px; line-height: 1.6; }',
        branding: false,
        promotion: false
    });

    // Image preview
    document.getElementById('featured_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('image-preview');
                preview.querySelector('img').src = event.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
