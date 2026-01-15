<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogLike;
use App\Models\About;
use App\Models\ThemeSetting;
use App\Models\MenuItem;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Get common data for all blog views
     */
    private function getCommonData()
    {
        return [
            'about' => About::first(),
            'theme' => ThemeSetting::first(),
            'menuItems' => MenuItem::where('is_visible', true)->orderBy('order')->get(),
            'socialLinks' => SocialLink::where('is_active', true)->orderBy('order')->get(),
        ];
    }

    /**
     * Display all blog posts
     */
    public function index()
    {
        $blogs = Blog::with('category')
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(12);
        
        $categories = BlogCategory::where('is_active', true)
            ->withCount(['blogs' => function ($query) {
                $query->where('is_published', true);
            }])
            ->orderBy('order')
            ->get();
        
        $featuredBlogs = Blog::where('is_published', true)
            ->where('is_featured', true)
            ->latest('published_at')
            ->take(3)
            ->get();
        
        $data = array_merge($this->getCommonData(), compact('blogs', 'categories', 'featuredBlogs'));
        
        return view('blog.index', $data);
    }

    /**
     * Display blogs by category
     */
    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        
        $blogs = Blog::with('category')
            ->where('category_id', $category->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate(12);
        
        $categories = BlogCategory::where('is_active', true)
            ->withCount(['blogs' => function ($query) {
                $query->where('is_published', true);
            }])
            ->orderBy('order')
            ->get();
        
        $data = array_merge($this->getCommonData(), compact('blogs', 'category', 'categories'));
        
        return view('blog.category', $data);
    }

    /**
     * Display a single blog post
     */
    public function show($slug)
    {
        $blog = Blog::with(['category', 'comments' => function ($query) {
            $query->where('is_approved', true)
                ->whereNull('parent_id')
                ->with('replies')
                ->latest();
        }])
        ->where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();
        
        // Increment view count
        $blog->increment('views');
        
        // Get related posts from same category
        $relatedBlogs = Blog::where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();
        
        // Check if user has already liked this post
        $hasLiked = BlogLike::where('blog_id', $blog->id)
            ->where('ip_address', request()->ip())
            ->exists();
        
        $data = array_merge($this->getCommonData(), compact('blog', 'relatedBlogs', 'hasLiked'));
        
        return view('blog.show', $data);
    }

    /**
     * Like a blog post
     */
    public function like(Request $request, Blog $blog)
    {
        $ipAddress = $request->ip();
        
        $existingLike = BlogLike::where('blog_id', $blog->id)
            ->where('ip_address', $ipAddress)
            ->first();
        
        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $blog->decrement('likes_count');
            $liked = false;
        } else {
            // Like
            BlogLike::create([
                'blog_id' => $blog->id,
                'ip_address' => $ipAddress,
                'user_agent' => $request->userAgent()
            ]);
            $blog->increment('likes_count');
            $liked = true;
        }
        
        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $blog->likes_count
        ]);
    }

    /**
     * Add a comment to a blog post
     */
    public function comment(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:blog_comments,id'
        ]);
        
        BlogComment::create([
            'blog_id' => $blog->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'comment' => $validated['comment'],
            'parent_id' => $validated['parent_id'] ?? null,
            'is_approved' => false
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Your comment has been submitted and is awaiting approval!'
        ]);
    }
}

