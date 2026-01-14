@extends('admin.layout')

@section('title', 'Blog Comments')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-600 via-teal-500 to-cyan-500 rounded-3xl shadow-2xl p-8 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-extrabold text-white mb-2 flex items-center">
                    <i class="fas fa-comments mr-4"></i>
                    Blog Comments
                </h1>
                <p class="text-teal-100 text-lg">Moderate and manage comments on your blog posts</p>
            </div>
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

    @if($comments->count() > 0)
        <div class="space-y-4">
            @foreach($comments as $comment)
                <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden border-2 {{ $comment->is_approved ? 'border-green-200 hover:border-green-400' : 'border-yellow-200 hover:border-yellow-400' }}">
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center flex-1">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                    {{ strtoupper(substr($comment->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                        {{ $comment->name }}
                                        @if($comment->is_approved)
                                            <span class="ml-2 px-2 py-1 bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 text-xs font-bold rounded-full border border-green-300">
                                                <i class="fas fa-check-circle mr-1"></i>Approved
                                            </span>
                                        @else
                                            <span class="ml-2 px-2 py-1 bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-700 text-xs font-bold rounded-full border border-yellow-300">
                                                <i class="fas fa-clock mr-1"></i>Pending
                                            </span>
                                        @endif
                                    </h3>
                                    <p class="text-sm text-gray-500">{{ $comment->email }}</p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Related Blog Post -->
                        <div class="mb-4 p-3 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl border-l-4 border-blue-400">
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-blog text-blue-500 mr-2"></i>
                                On post: <a href="{{ route('admin.blogs.edit', $comment->blog) }}" class="font-semibold text-blue-600 hover:underline">{{ $comment->blog->title }}</a>
                            </p>
                        </div>

                        <!-- Comment Content -->
                        <div class="mb-4 p-4 bg-gray-50 rounded-xl">
                            <p class="text-gray-700 leading-relaxed">{{ $comment->comment }}</p>
                        </div>

                        <!-- Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="mb-4 pl-8 border-l-4 border-gray-200">
                                <p class="text-sm font-semibold text-gray-600 mb-2">
                                    <i class="fas fa-reply mr-1"></i>
                                    {{ $comment->replies->count() }} {{ $comment->replies->count() === 1 ? 'Reply' : 'Replies' }}
                                </p>
                                @foreach($comment->replies as $reply)
                                    <div class="mb-2 p-3 bg-gray-100 rounded-lg">
                                        <div class="flex items-center mb-1">
                                            <span class="font-semibold text-sm text-gray-800">{{ $reply->name }}</span>
                                            @if($reply->is_approved)
                                                <i class="fas fa-check-circle text-green-500 text-xs ml-2"></i>
                                            @else
                                                <i class="fas fa-clock text-yellow-500 text-xs ml-2"></i>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $reply->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            @if(!$comment->is_approved)
                                <form action="{{ route('admin.blog-comments.approve', $comment) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full bg-gradient-to-r from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 text-green-700 px-4 py-2 rounded-xl transition font-semibold border-2 border-green-200 hover:border-green-400">
                                        <i class="fas fa-check mr-1"></i> Approve
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.blog-comments.destroy', $comment) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this comment?');">
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

        <!-- Pagination -->
        <div class="mt-8">
            {{ $comments->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-16 text-center shadow-xl">
            <div class="mb-6">
                <i class="fas fa-comments text-9xl text-gray-300"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-700 mb-4">No Comments Yet</h3>
            <p class="text-gray-500 text-lg">When readers comment on your blog posts, they'll appear here for moderation.</p>
        </div>
    @endif
</div>
@endsection
