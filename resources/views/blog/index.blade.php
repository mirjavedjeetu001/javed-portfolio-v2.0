<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - {{ $about->name ?? 'Portfolio' }}</title>
    
    @if($about && $about->image)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $about->image) }}">
    @endif
    
    <!-- SEO Meta Tags -->
    @include('partials.seo-meta')
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Analytics & AdSense Scripts -->
    @include('partials.analytics-scripts')
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
        
        .gradient-bg {
            background: linear-gradient(135deg, {{ $theme->primary_color ?? '#3498db' }} 0%, {{ $theme->secondary_color ?? '#2ecc71' }} 100%);
        }
        .text-primary { color: {{ $theme->primary_color ?? '#3498db' }}; }
        .bg-primary { background-color: {{ $theme->primary_color ?? '#3498db' }}; }
        .hover\:bg-primary:hover { background-color: {{ $theme->primary_color ?? '#3498db' }}; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Navigation -->
    <nav class="fixed w-full bg-white shadow-md z-50">
        <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="text-xl sm:text-2xl font-bold text-primary">
                    {{ $about->name ?? 'Portfolio' }}
                </a>
                <div class="hidden md:flex space-x-8">
                    @foreach($menuItems as $menuItem)
                        <a href="{{ str_starts_with($menuItem->url, '#') ? '/' . $menuItem->url : $menuItem->url }}" class="text-gray-700 hover:text-primary transition">{{ $menuItem->label }}</a>
                    @endforeach
                </div>
                <button class="md:hidden text-primary" id="mobile-menu-btn">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="gradient-bg text-white pt-32 pb-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                <i class="fas fa-blog mr-3"></i>Blog & Articles
            </h1>
            <p class="text-xl md:text-2xl text-white/90">Insights, tutorials, and thoughts</p>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Sidebar -->
                <aside class="lg:w-1/4">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                        <h3 class="text-xl font-bold mb-4 text-gray-800">
                            <i class="fas fa-filter text-primary mr-2"></i>Categories
                        </h3>
                        <div class="space-y-2">
                            <a href="/blog" class="flex items-center justify-between px-4 py-2 rounded-lg bg-primary text-white">
                                <span>All Posts</span>
                                <span class="text-sm">{{ $blogs->total() }}</span>
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('blog.category', $cat->slug) }}" 
                                   class="flex items-center justify-between px-4 py-2 rounded-lg hover:bg-gray-100">
                                    <span>
                                        <i class="{{ $cat->icon }} mr-2" style="color: {{ $cat->color }}"></i>
                                        {{ $cat->name }}
                                    </span>
                                    <span class="text-sm text-gray-500">{{ $cat->blogs_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </aside>

                <!-- Posts -->
                <div class="lg:w-3/4">
                    @if($featuredBlogs->count() > 0)
                    <div class="mb-12">
                        <h2 class="text-3xl font-bold mb-6 text-gray-800">
                            <i class="fas fa-star text-yellow-500 mr-2"></i>Featured Posts
                        </h2>
                        <div class="grid md:grid-cols-3 gap-6">
                            @foreach($featuredBlogs as $featured)
                                <a href="{{ route('blog.show', $featured->slug) }}" class="group">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2">
                                        @if($featured->featured_image)
                                            <img src="{{ asset($featured->featured_image) }}" alt="{{ $featured->title }}" class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                                <i class="fas fa-blog text-6xl text-white/50"></i>
                                            </div>
                                        @endif
                                        <div class="p-6">
                                            <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background: {{ $featured->category->color }}20; color: {{ $featured->category->color }}">
                                                {{ $featured->category->name }}
                                            </span>
                                            <h3 class="text-lg font-bold mt-3 mb-2 group-hover:text-primary transition line-clamp-2">
                                                {{ $featured->title }}
                                            </h3>
                                            <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit(strip_tags($featured->content), 100) }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <h2 class="text-3xl font-bold mb-6 text-gray-800">
                        <i class="fas fa-newspaper text-primary mr-2"></i>All Posts
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        @forelse($blogs as $blog)
                            <a href="{{ route('blog.show', $blog->slug) }}" class="group">
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2 h-full flex flex-col">
                                    @if($blog->featured_image)
                                        <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-56 object-cover">
                                    @else
                                        <div class="w-full h-56 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <i class="fas fa-blog text-8xl text-white/50"></i>
                                        </div>
                                    @endif
                                    <div class="p-6 flex-1 flex flex-col">
                                        <div class="flex items-center gap-2 mb-3">
                                            <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background: {{ $blog->category->color }}20; color: {{ $blog->category->color }}">
                                                <i class="{{ $blog->category->icon }} mr-1"></i>{{ $blog->category->name }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                <i class="far fa-calendar mr-1"></i>{{ $blog->published_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                        <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition line-clamp-2">
                                            {{ $blog->title }}
                                        </h3>
                                        <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-3">
                                            {{ Str::limit(strip_tags($blog->content), 150) }}
                                        </p>
                                        <div class="flex items-center justify-between text-sm text-gray-500 pt-4 border-t">
                                            <span><i class="fas fa-eye mr-1"></i>{{ $blog->views }}</span>
                                            <span><i class="fas fa-heart mr-1"></i>{{ $blog->likes_count }}</span>
                                            <span><i class="fas fa-comments mr-1"></i>{{ $blog->comments_count }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-2 text-center py-12">
                                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500 text-lg">No blog posts found.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($blogs->hasPages())
                        <div class="mt-8">{{ $blogs->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm sm:text-base">&copy; {{ date('Y') }} {{ $about->name ?? 'Portfolio' }}. All Rights Reserved.</p>
            <div class="flex justify-center space-x-6 mt-4">
                @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" class="text-white hover:text-primary transition">
                        <i class="{{ $link->icon }} text-xl"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </footer>

    <button id="back-to-top" class="fixed bottom-8 right-8 bg-primary text-white w-12 h-12 rounded-full shadow-lg hover:shadow-xl transition opacity-0 invisible">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        const backToTop = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTop.classList.remove('opacity-0', 'invisible');
            } else {
                backToTop.classList.add('opacity-0', 'invisible');
            }
        });
        backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    </script>
</body>
</html>
