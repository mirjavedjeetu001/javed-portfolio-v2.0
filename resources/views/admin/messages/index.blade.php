@extends('admin.layout')

@section('title', 'Contact Messages')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-envelope text-white text-xl"></i>
                </div>
                Contact Messages
            </h1>
            <p class="text-gray-600 mt-2 ml-16">View and manage messages from your portfolio visitors</p>
        </div>
    </div>
</div>

@if($messages->count() > 0)
    <div class="space-y-4">
        @foreach($messages as $message)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-{{ $message->is_read ? 'gray' : 'blue' }}-400 to-{{ $message->is_read ? 'gray' : 'cyan' }}-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
            <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-start flex-1">
                        <div class="w-12 h-12 bg-gradient-to-br from-{{ $message->is_read ? 'gray' : 'blue' }}-500 to-{{ $message->is_read ? 'gray' : 'cyan' }}-600 rounded-xl flex items-center justify-center mr-4 transform group-hover:rotate-12 transition duration-500 flex-shrink-0">
                            <i class="fas fa-{{ $message->is_read ? 'envelope-open' : 'envelope' }} text-white"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-xl font-bold text-gray-800">{{ $message->name }}</h3>
                                @if(!$message->is_read)
                                    <span class="inline-flex items-center bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-circle text-blue-500 mr-1 animate-pulse"></i>New
                                    </span>
                                @endif
                            </div>
                            <p class="text-blue-600 font-semibold mb-1">
                                <i class="fas fa-at mr-1"></i>{{ $message->email }}
                            </p>
                            @if($message->subject)
                                <p class="text-gray-600 font-semibold mb-2">
                                    <i class="fas fa-tag mr-1"></i>{{ $message->subject }}
                                </p>
                            @endif
                            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($message->message, 150) }}</p>
                            <p class="text-gray-500 text-xs">
                                <i class="fas fa-clock mr-1"></i>{{ $message->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-2 ml-4">
                        <a href="{{ route('admin.messages.show', $message) }}" class="bg-gradient-to-r from-blue-50 to-cyan-50 hover:from-blue-100 hover:to-cyan-100 text-blue-700 px-4 py-2 rounded-lg transition font-semibold border-2 border-blue-200 hover:border-blue-400">
                            <i class="fas fa-eye mr-1"></i>View
                        </a>
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gradient-to-r from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 text-red-700 px-4 py-2 rounded-lg transition font-semibold border-2 border-red-200 hover:border-red-400">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
@else
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-r from-blue-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-envelope text-blue-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Messages Yet</h3>
        <p class="text-gray-600 mb-6">You haven't received any messages from visitors yet.</p>
    </div>
@endif
@endsection
