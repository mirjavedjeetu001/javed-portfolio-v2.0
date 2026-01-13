@extends('admin.layout')

@section('page-title', 'Activities')

@section('content')
<div class="container-fluid">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Professional Activities</h1>
            <p class="text-gray-600 mt-1">Volunteer work, community involvement, and professional activities</p>
        </div>
    </div>

    @if($activities->count() > 0)
        <div class="space-y-4">
            @foreach($activities as $activity)
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition p-6 border-l-4 {{ $activity->is_current ? 'border-green-500' : 'border-gray-300' }}">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start flex-1">
                            <div class="{{ $activity->is_current ? 'bg-green-100' : 'bg-gray-100' }} p-3 rounded-lg mr-4">
                                <i class="fas {{ $activity->is_current ? 'fa-tasks text-green-600' : 'fa-check-circle text-gray-600' }} text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-bold text-gray-800">{{ $activity->title }}</h3>
                                    @if($activity->is_current)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <i class="fas fa-circle text-green-500 text-xs mr-1"></i>Active
                                        </span>
                                    @endif
                                </div>
                                <p class="text-gray-700 font-medium mb-2">{{ $activity->organization }}</p>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                    <span>
                                        {{ $activity->start_date ? \Carbon\Carbon::parse($activity->start_date)->format('M Y') : 'N/A' }}
                                        -
                                        {{ $activity->is_current ? 'Present' : ($activity->end_date ? \Carbon\Carbon::parse($activity->end_date)->format('M Y') : 'N/A') }}
                                    </span>
                                </div>
                                @if($activity->description)
                                    <p class="text-gray-600 text-sm bg-gray-50 p-3 rounded">{{ $activity->description }}</p>
                                @endif
                            </div>
                        </div>
                        <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Delete this activity?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg text-sm transition ml-4">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-purple-50 border-l-4 border-purple-500 p-6 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-tasks text-purple-500 text-3xl mr-4"></i>
                <div>
                    <h3 class="text-lg font-semibold text-purple-800 mb-1">No Activities Found</h3>
                    <p class="text-purple-700">Upload your resume with AI to automatically import your volunteer work and activities!</p>
                    <a href="{{ route('admin.resumes.create') }}" class="inline-block mt-3 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm transition">
                        <i class="fas fa-upload mr-2"></i>Upload Resume
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
