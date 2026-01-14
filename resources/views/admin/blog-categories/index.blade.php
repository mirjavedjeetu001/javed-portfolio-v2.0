@extends('admin.layout')

@section('title', 'Blog Categories')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-600 via-pink-500 to-red-500 rounded-3xl shadow-2xl p-8 mb-8 transform hover:scale-[1.01] transition duration-300">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-extrabold text-white mb-2 flex items-center">
                    <i class="fas fa-folder-open mr-4"></i>
                    Blog Categories
                </h1>
                <p class="text-purple-100 text-lg">Organize your blog posts by categories</p>
            </div>
            <a href="{{ route('admin.blog-categories.create') }}" class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-yellow-400 via-orange-400 to-pink-400 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                <button class="relative bg-white text-purple-600 px-8 py-3 rounded-xl font-bold flex items-center hover:bg-gray-50 transition shadow-xl">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Add New Category
                </button>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-6 shadow-lg animate-pulse">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-2xl mr-3"></i>
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 shadow-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-2xl mr-3"></i>
                <p class="font-semibold">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if($categories->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="group relative bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden border-2 border-gray-100 hover:border-{{ $category->color ?? 'blue' }}-300">
                    <!-- Category Color Strip -->
                    <div class="h-2 bg-gradient-to-r from-{{ $category->color ?? 'blue' }}-400 to-{{ $category->color ?? 'blue' }}-600"></div>
                    
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                @if($category->icon)
                                    <div class="w-12 h-12 bg-gradient-to-br from-{{ $category->color ?? 'blue' }}-100 to-{{ $category->color ?? 'blue' }}-200 rounded-xl flex items-center justify-center mr-3">
                                        <i class="{{ $category->icon }} text-{{ $category->color ?? 'blue' }}-600 text-xl"></i>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-{{ $category->color ?? 'blue' }}-600 transition">
                                        {{ $category->name }}
                                    </h3>
                                    <p class="text-xs text-gray-500">{{ $category->slug }}</p>
                                </div>
                            </div>
                            
                            <!-- Status Badge -->
                            @if($category->is_active)
                                <span class="px-3 py-1 bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 text-xs font-bold rounded-full border border-green-300">
                                    <i class="fas fa-check-circle mr-1"></i>Active
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-600 text-xs font-bold rounded-full border border-gray-300">
                                    <i class="fas fa-times-circle mr-1"></i>Inactive
                                </span>
                            @endif
                        </div>

                        <!-- Description -->
                        @if($category->description)
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $category->description }}
                            </p>
                        @endif

                        <!-- Stats -->
                        <div class="flex items-center justify-between mb-4 p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-blog text-{{ $category->color ?? 'blue' }}-500 mr-2"></i>
                                <span class="text-sm font-semibold text-gray-700">
                                    {{ $category->blogs_count }} Posts
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-sort text-{{ $category->color ?? 'blue' }}-500 mr-2"></i>
                                <span class="text-sm font-semibold text-gray-700">
                                    Order: {{ $category->order }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('admin.blog-categories.edit', $category) }}" class="flex-1 bg-gradient-to-r from-blue-50 to-cyan-50 hover:from-blue-100 hover:to-cyan-100 text-blue-700 px-4 py-2 rounded-xl transition text-center font-semibold border-2 border-blue-200 hover:border-blue-400">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.blog-categories.destroy', $category) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-gradient-to-r from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 text-red-700 px-4 py-2 rounded-xl transition font-semibold border-2 border-red-200 hover:border-red-400">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-16 text-center shadow-xl">
            <div class="mb-6">
                <i class="fas fa-folder-open text-9xl text-gray-300"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-700 mb-4">No Categories Yet</h3>
            <p class="text-gray-500 text-lg mb-8">Start organizing your blog by creating your first category!</p>
            <a href="{{ route('admin.blog-categories.create') }}" class="group inline-block relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                <button class="relative bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-4 rounded-xl font-bold flex items-center hover:from-purple-700 hover:to-pink-700 transition shadow-xl">
                    <i class="fas fa-plus-circle mr-2 text-xl"></i>
                    Create Your First Category
                </button>
            </a>
        </div>
    @endif
</div>
@endsection
