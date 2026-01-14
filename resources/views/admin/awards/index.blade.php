@extends('admin.layout')

@section('page-title', 'Awards')

@section('content')
<div class="container-fluid">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Awards & Honors</h1>
            <p class="text-gray-600 mt-1">Your achievements and recognitions</p>
        </div>
    </div>

    @if($awards->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($awards as $award)
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-lg shadow-lg hover:shadow-xl transition p-6 border-l-4 border-yellow-500">
                    <div class="flex items-start mb-4">
                        <div class="bg-yellow-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-trophy text-yellow-600 text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $award->title }}</h3>
                            <p class="text-gray-700 font-medium mb-1">{{ $award->organization }}</p>
                            <div class="flex items-center text-sm text-gray-600 mb-3">
                                <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                <span>{{ $award->date->format('F d, Y') }}</span>
                            </div>
                            @if($award->description)
                                <p class="text-gray-600 text-sm bg-white/50 p-3 rounded">{{ $award->description }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-2 pt-4 border-t border-yellow-200">
                        <form action="{{ route('admin.awards.destroy', $award) }}" method="POST" onsubmit="event.preventDefault(); showDeleteModal(this);">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg text-sm transition">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-trophy text-yellow-500 text-3xl mr-4"></i>
                <div>
                    <h3 class="text-lg font-semibold text-yellow-800 mb-1">No Awards Found</h3>
                    <p class="text-yellow-700">Upload your resume with AI to automatically import your awards and honors!</p>
                    <a href="{{ route('admin.resumes.create') }}" class="inline-block mt-3 bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg text-sm transition">
                        <i class="fas fa-upload mr-2"></i>Upload Resume
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
