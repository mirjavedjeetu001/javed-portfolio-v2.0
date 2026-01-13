@extends('admin.layout')

@section('title', 'Resumes')
@section('page-title', 'Resume Management')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-800">Uploaded Resumes</h3>
        <a href="{{ route('admin.resumes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Upload New Resume
        </a>
    </div>
    
    <div class="p-6">
        @if($resumes->count() > 0)
            <div class="space-y-4">
                @foreach($resumes as $resume)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-file-pdf text-red-500 text-3xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $resume->filename }}</h4>
                                    <p class="text-sm text-gray-500">
                                        Uploaded {{ $resume->created_at->diffForHumans() }}
                                        @if($resume->parsed_at)
                                            • Parsed {{ $resume->parsed_at->diffForHumans() }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                @if($resume->is_active)
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full">Active</span>
                                @endif
                                
                                <a href="{{ route('admin.resumes.show', $resume->id) }}" class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                                
                                <form action="{{ route('admin.resumes.destroy', $resume->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $resumes->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-file-pdf text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">No Resumes Uploaded</h3>
                <p class="text-gray-500 mb-4">Upload your resume to get started with AI-powered parsing</p>
                <a href="{{ route('admin.resumes.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                    <i class="fas fa-upload mr-2"></i>Upload Your First Resume
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
