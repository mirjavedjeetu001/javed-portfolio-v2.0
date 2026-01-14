<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('category')
            ->withCount(['comments', 'likes'])
            ->latest('created_at')
            ->paginate(15);
        
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::where('is_active', true)
            ->orderBy('name')
            ->get();
        
        return view('admin.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author_name' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'social_link' => 'nullable|url|max:255',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['published_at'] = $validated['is_published'] ? ($validated['published_at'] ?? now()) : null;

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . Str::slug($validated['title']) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
            $validated['featured_image'] = 'uploads/blogs/' . $imageName;
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return redirect()->route('admin.blogs.edit', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::where('is_active', true)
            ->orderBy('name')
            ->get();
        
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author_name' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'social_link' => 'nullable|url|max:255',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['published_at'] = $validated['is_published'] ? ($validated['published_at'] ?? $blog->published_at ?? now()) : null;

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image && file_exists(public_path($blog->featured_image))) {
                unlink(public_path($blog->featured_image));
            }
            
            $image = $request->file('featured_image');
            $imageName = time() . '_' . Str::slug($validated['title']) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
            $validated['featured_image'] = 'uploads/blogs/' . $imageName;
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete image
        if ($blog->featured_image && file_exists(public_path($blog->featured_image))) {
            unlink(public_path($blog->featured_image));
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Blog $blog)
    {
        $blog->is_featured = !$blog->is_featured;
        $blog->save();

        return back()->with('success', 'Featured status updated!');
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(Blog $blog)
    {
        $blog->is_published = !$blog->is_published;
        $blog->published_at = $blog->is_published ? ($blog->published_at ?? now()) : null;
        $blog->save();

        return back()->with('success', 'Publish status updated!');
    }

    /**
     * Manage comments
     */
    public function comments()
    {
        $comments = BlogComment::with(['blog', 'replies'])
            ->whereNull('parent_id')
            ->latest()
            ->paginate(20);
        
        return view('admin.blogs.comments', compact('comments'));
    }

    /**
     * Approve comment
     */
    public function approveComment(BlogComment $comment)
    {
        $comment->is_approved = true;
        $comment->save();

        return back()->with('success', 'Comment approved!');
    }

    /**
     * Delete comment
     */
    public function deleteComment(BlogComment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted!');
    }
}
