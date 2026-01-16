<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }} - {{ $about->name ?? 'Portfolio' }}</title>
    
    @if($about && $about->image)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $about->image) }}">
    @endif
    
    <!-- SEO Meta Tags -->
    @include('partials.seo-meta', ['pageTitle' => $blog->title, 'pageDescription' => $blog->excerpt, 'pageImage' => $blog->featured_image ? asset($blog->featured_image) : null])
    
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
        .prose { max-width: 100%; }
        .prose img { max-width: 100%; height: auto; border-radius: 0.75rem; margin: 1.5rem 0; }
        .prose p { margin-bottom: 1rem; line-height: 1.8; }
        .prose h2 { font-size: 1.875rem; font-weight: bold; margin-top: 2rem; margin-bottom: 1rem; }
        .prose h3 { font-size: 1.5rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; }
        .prose a { color: {{ $theme->primary_color ?? '#3498db' }}; text-decoration: underline; }
        .prose ol, .prose ul { margin: 1rem 0 1rem 2rem; }
        .prose li { margin-bottom: 0.5rem; }
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
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="gradient-bg text-white pt-32 pb-16">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="inline-block px-4 py-2 rounded-full mb-4" style="background: {{ $blog->category->color }}40;">
                <i class="{{ $blog->category->icon }} mr-2"></i>{{ $blog->category->name }}
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $blog->title }}</h1>
            <div class="flex flex-wrap gap-6 text-white/90 text-sm">
                <span><i class="far fa-calendar mr-2"></i>{{ $blog->published_at->format('M d, Y') }}</span>
                <span><i class="fas fa-eye mr-2"></i>{{ $blog->views }} views</span>
                <span><i class="fas fa-user mr-2"></i>By Admin</span>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-16">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="grid lg:grid-cols-3 gap-8">
                
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                        @if($blog->featured_image)
                            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-96 object-cover">
                        @endif
                        
                        <div class="p-8 prose">
                            {!! $blog->content !!}
                        </div>
                        
                        <!-- AdSense In-Article Ad -->
                        @include('partials.adsense', ['position' => 'in_article'])

                        <!-- Like Button -->
                        <div class="px-8 py-6 border-t flex items-center gap-4">
                            <button onclick="likeBlog({{ $blog->id }})" class="flex items-center gap-2 px-6 py-3 rounded-lg {{ $hasLiked ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-700' }} hover:shadow-lg transition" id="like-btn">
                                <i class="fas fa-heart"></i>
                                <span id="like-count">{{ $blog->likes_count }}</span> Likes
                            </button>
                        </div>

                        <!-- Comments Section -->
                        <div class="px-8 py-6 border-t">
                            <h3 class="text-2xl font-bold mb-6">
                                <i class="fas fa-comments text-primary mr-2"></i>Comments
                            </h3>

                            <!-- Comment Form -->
                            <form onsubmit="submitComment(event, {{ $blog->id }})" class="mb-8 p-6 bg-gray-50 rounded-lg">
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    <input type="text" name="name" placeholder="Your Name" required class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                    <input type="email" name="email" placeholder="Your Email" required class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                </div>
                                <textarea name="comment" placeholder="Share your thoughts..." rows="4" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary resize-none"></textarea>
                                <button type="submit" class="mt-4 px-6 py-2 bg-primary text-white rounded-lg hover:shadow-lg transition">Post Comment</button>
                            </form>

                            <!-- Comments List -->
                            <div class="space-y-6">
                                @forelse($blog->comments as $comment)
                                    <div class="p-6 bg-gray-50 rounded-lg">
                                        <div class="flex items-center justify-between mb-3">
                                            <div>
                                                <p class="font-semibold">{{ $comment->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <p class="text-gray-700">{{ $comment->comment }}</p>

                                        <!-- Nested Replies -->
                                        @if($comment->replies->count() > 0)
                                            <div class="mt-4 space-y-4 border-l-4 border-primary pl-4">
                                                @foreach($comment->replies as $reply)
                                                    <div class="p-4 bg-white rounded">
                                                        <div>
                                                            <p class="font-semibold text-sm">{{ $reply->name }}</p>
                                                            <p class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                                        </div>
                                                        <p class="text-gray-700 text-sm mt-2">{{ $reply->comment }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-center text-gray-500 py-8">No comments yet. Be the first to comment!</p>
                                @endforelse
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <aside class="lg:col-span-1">
                    <!-- About Post -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                        <h3 class="text-xl font-bold mb-4">Post Stats</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Views</span>
                                <span class="font-semibold">{{ $blog->views }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Likes</span>
                                <span class="font-semibold text-red-500">{{ $blog->likes_count }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Comments</span>
                                <span class="font-semibold">{{ $blog->comments_count }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Related Posts -->
                    @if($relatedBlogs->count() > 0)
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold mb-4">
                            <i class="fas fa-link text-primary mr-2"></i>Related
                        </h3>
                        <div class="space-y-4">
                            @foreach($relatedBlogs as $related)
                                <a href="{{ route('blog.show', $related->slug) }}" class="group block p-3 rounded-lg hover:bg-gray-50 transition">
                                    <h4 class="font-semibold text-sm group-hover:text-primary transition line-clamp-2">{{ $related->title }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">{{ $related->published_at->format('M d, Y') }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-16">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm sm:text-base">{!! $settings['footer_text'] ?? '&copy; ' . date('Y') . ' ' . ($about->name ?? 'Portfolio') . '. All Rights Reserved.' !!}</p>
            <div class="flex justify-center space-x-6 mt-4">
                @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" class="text-white hover:text-primary transition">
                        <i class="{{ $link->icon }} text-xl"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </footer>

    <script>
        function likeBlog(blogId) {
            fetch(`/blog/${blogId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(r => r.json())
            .then(data => {
                document.getElementById('like-count').textContent = data.likes_count;
                document.getElementById('like-btn').classList.toggle('bg-red-100');
                document.getElementById('like-btn').classList.toggle('text-red-600');
            });
        }

        function submitComment(e, blogId) {
            e.preventDefault();
            const form = e.target;
            fetch(`/blog/${blogId}/comment`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name: form.name.value,
                    email: form.email.value,
                    comment: form.comment.value
                })
            })
            .then(r => r.json())
            .then(data => {
                if(data.success) {
                    form.reset();
                    alert('Comment submitted! It will appear after approval.');
                } else {
                    alert('Error submitting comment');
                }
            });
        }
    </script>
</body>
</html>
