@extends('admin.layout')

@section('title', 'Blog Posts')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-500 rounded-3xl shadow-2xl p-8 mb-8 transform hover:scale-[1.01] transition duration-300">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-extrabold text-white mb-2 flex items-center">
                    <i class="fas fa-blog mr-4"></i>
                    Blog Posts
                </h1>
                <p class="text-cyan-100 text-lg">Manage your blog articles and updates</p>
            </div>
            <a href="{{ route('admin.blogs.create') }}" class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-yellow-400 via-orange-400 to-pink-400 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                <button class="relative bg-white text-blue-600 px-8 py-3 rounded-xl font-bold flex items-center hover:bg-gray-50 transition shadow-xl">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Create New Post
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

    @if($blogs->count() > 0)
        <div class="space-y-4">
            @foreach($blogs as $blog)
                <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden border-2 border-gray-100 hover:border-blue-300">
                    <div class="flex flex-col md:flex-row">
                        <!-- Featured Image -->
                        <div class="md:w-1/4 h-48 md:h-auto relative overflow-hidden">
                            @if($blog->featured_image)
                                <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-{{ $blog->category->color ?? 'blue' }}-100 to-{{ $blog->category->color ?? 'blue' }}-300 flex items-center justify-center">
                                    <i class="fas fa-image text-6xl text-{{ $blog->category->color ?? 'blue' }}-500 opacity-50"></i>
                                </div>
                            @endif
                            
                            <!-- Featured Badge -->
                            @if($blog->is_featured)
                                <div class="absolute top-3 left-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center">
                                    <i class="fas fa-star mr-1"></i> Featured
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="md:w-3/4 p-6">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <!-- Category Badge -->
                                    <span class="inline-block px-3 py-1 bg-gradient-to-r from-{{ $blog->category->color ?? 'blue' }}-100 to-{{ $blog->category->color ?? 'blue' }}-200 text-{{ $blog->category->color ?? 'blue' }}-700 text-xs font-bold rounded-full mb-2">
                                        @if($blog->category->icon)
                                            <i class="{{ $blog->category->icon }} mr-1"></i>
                                        @endif
                                        {{ $blog->category->name }}
                                    </span>
                                    
                                    <!-- Title -->
                                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-blue-600 transition mb-2">
                                        {{ $blog->title }}
                                    </h3>
                                    
                                    <!-- Excerpt -->
                                    @if($blog->excerpt)
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $blog->excerpt }}</p>
                                    @endif

                                    <!-- Meta Info -->
                                    <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                                        <span class="flex items-center">
                                            <i class="fas fa-user mr-1 text-blue-500"></i>
                                            {{ $blog->author_name ?? 'Admin' }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar mr-1 text-blue-500"></i>
                                            {{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Not published' }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-eye mr-1 text-blue-500"></i>
                                            {{ $blog->views }} views
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-heart mr-1 text-red-500"></i>
                                            {{ $blog->likes_count }} likes
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-comments mr-1 text-green-500"></i>
                                            {{ $blog->comments_count }} comments
                                        </span>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                @if($blog->is_published)
                                    <span class="px-3 py-1 bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 text-xs font-bold rounded-full border border-green-300 flex items-center shrink-0 ml-4">
                                        <i class="fas fa-check-circle mr-1"></i>Published
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-600 text-xs font-bold rounded-full border border-gray-300 flex items-center shrink-0 ml-4">
                                        <i class="fas fa-pen mr-1"></i>Draft
                                    </span>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2 mt-4 pt-4 border-t border-gray-200">
                                <a href="{{ route('admin.blogs.edit', $blog) }}" class="flex-1 bg-gradient-to-r from-blue-50 to-cyan-50 hover:from-blue-100 hover:to-cyan-100 text-blue-700 px-4 py-2 rounded-xl transition text-center font-semibold border-2 border-blue-200 hover:border-blue-400">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.blogs.toggle-featured', $blog) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full bg-gradient-to-r from-yellow-50 to-orange-50 hover:from-yellow-100 hover:to-orange-100 text-yellow-700 px-4 py-2 rounded-xl transition font-semibold border-2 border-yellow-200 hover:border-yellow-400">
                                        <i class="fas fa-star mr-1"></i> {{ $blog->is_featured ? 'Unfeature' : 'Feature' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.blogs.toggle-publish', $blog) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full bg-gradient-to-r from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 text-green-700 px-4 py-2 rounded-xl transition font-semibold border-2 border-green-200 hover:border-green-400">
                                        <i class="fas fa-{{ $blog->is_published ? 'times' : 'check' }}-circle mr-1"></i> {{ $blog->is_published ? 'Unpublish' : 'Publish' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-gradient-to-r from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 text-red-700 px-4 py-2 rounded-xl transition font-semibold border-2 border-red-200 hover:border-red-400">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $blogs->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-16 text-center shadow-xl">
            <div class="mb-6">
                <i class="fas fa-blog text-9xl text-gray-300"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-700 mb-4">No Blog Posts Yet</h3>
            <p class="text-gray-500 text-lg mb-8">Start sharing your thoughts by creating your first blog post!</p>
            <a href="{{ route('admin.blogs.create') }}" class="group inline-block relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                <button class="relative bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-4 rounded-xl font-bold flex items-center hover:from-blue-700 hover:to-cyan-700 transition shadow-xl">
                    <i class="fas fa-plus-circle mr-2 text-xl"></i>
                    Create Your First Post
                </button>
            </a>
        </div>
    @endif
</div>
@endsection
