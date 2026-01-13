@extends('admin.layout')

@section('title', 'View Message')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-envelope-open text-white text-xl"></i>
                </div>
                Message Details
            </h1>
            <p class="text-gray-600 mt-2 ml-16">View complete message information</p>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-500 to-gray-600 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Messages
            </div>
        </a>
    </div>
</div>

<div class="max-w-4xl mx-auto">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-cyan-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-8 py-6 border-b border-blue-100">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $message->name }}</h3>
                        <p class="text-blue-600 font-semibold">
                            <i class="fas fa-at mr-2"></i>{{ $message->email }}
                        </p>
                    </div>
                    @if(!$message->is_read)
                        <span class="inline-flex items-center bg-blue-500 text-white px-4 py-2 rounded-full font-semibold">
                            <i class="fas fa-circle mr-2 animate-pulse"></i>Unread
                        </span>
                    @else
                        <span class="inline-flex items-center bg-gray-500 text-white px-4 py-2 rounded-full font-semibold">
                            <i class="fas fa-check-circle mr-2"></i>Read
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="p-8">
                @if($message->subject)
                <div class="mb-6 p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl">
                    <p class="text-sm font-semibold text-gray-600 mb-1">
                        <i class="fas fa-tag text-purple-500 mr-2"></i>Subject
                    </p>
                    <p class="text-lg font-bold text-gray-800">{{ $message->subject }}</p>
                </div>
                @endif

                <div class="mb-6">
                    <p class="text-sm font-semibold text-gray-600 mb-3">
                        <i class="fas fa-comment text-blue-500 mr-2"></i>Message
                    </p>
                    <div class="bg-gray-50 p-6 rounded-xl border-2 border-gray-200">
                        <p class="text-gray-800 whitespace-pre-wrap">{{ $message->message }}</p>
                    </div>
                </div>

                <div class="flex items-center text-gray-500 text-sm mb-6">
                    <i class="fas fa-clock mr-2 text-blue-500"></i>
                    Received {{ $message->created_at->format('F j, Y \a\t g:i A') }} 
                    ({{ $message->created_at->diffForHumans() }})
                </div>

                <div class="flex gap-3 border-t-2 border-gray-100 pt-6">
                    @if(!$message->is_read)
                        <form action="{{ route('admin.messages.mark-read', $message) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-gradient-to-r from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 text-green-700 px-6 py-3 rounded-lg transition font-semibold border-2 border-green-200 hover:border-green-400">
                                <i class="fas fa-check mr-2"></i>Mark as Read
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.messages.mark-unread', $message) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-gradient-to-r from-yellow-50 to-orange-50 hover:from-yellow-100 hover:to-orange-100 text-yellow-700 px-6 py-3 rounded-lg transition font-semibold border-2 border-yellow-200 hover:border-yellow-400">
                                <i class="fas fa-undo mr-2"></i>Mark as Unread
                            </button>
                        </form>
                    @endif

                    <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject ?? 'Your Message' }}" class="bg-gradient-to-r from-blue-50 to-cyan-50 hover:from-blue-100 hover:to-cyan-100 text-blue-700 px-6 py-3 rounded-lg transition font-semibold border-2 border-blue-200 hover:border-blue-400">
                        <i class="fas fa-reply mr-2"></i>Reply via Email
                    </a>

                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');" class="ml-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-gradient-to-r from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 text-red-700 px-6 py-3 rounded-lg transition font-semibold border-2 border-red-200 hover:border-red-400">
                            <i class="fas fa-trash mr-2"></i>Delete Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
