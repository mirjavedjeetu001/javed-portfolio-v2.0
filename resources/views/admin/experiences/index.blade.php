@extends('admin.layout')

@section('title', 'Manage Experiences')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-briefcase text-white text-xl"></i>
                </div>
                Professional Experience
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Manage your work experience timeline</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                <i class="fas fa-plus mr-2"></i>Add Experience
            </div>
        </a>
    </div>
</div>

@if($experiences->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($experiences as $experience)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
            <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 h-full flex flex-col">
                <div class="flex items-start mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-3 transform group-hover:rotate-12 transition duration-500 flex-shrink-0">
                        <i class="fas fa-briefcase text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        @if($experience->is_current)
                            <span class="inline-flex items-center bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold mb-2">
                                <i class="fas fa-circle text-green-500 mr-1 animate-pulse"></i>Currently Working
                            </span>
                        @else
                            <span class="inline-flex items-center bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold mb-2">
                                <i class="fas fa-check-circle mr-1"></i>Past Role
                            </span>
                        @endif
                        <h3 class="text-xl font-bold text-gray-800 mb-1 group-hover:text-blue-600 transition">{{ $experience->job_title }}</h3>
                        <p class="text-blue-600 font-semibold">{{ $experience->company }}</p>
                    </div>
                </div>
                
                <div class="mb-4 space-y-2">
                    <div class="flex items-center text-gray-600 text-sm">
                        <i class="fas fa-calendar-alt mr-2 text-indigo-500"></i>
                        <span>{{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - 
                            @if($experience->is_current)
                                <span class="font-semibold text-green-600">Present</span>
                            @else
                                {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'N/A' }}
                            @endif
                        </span>
                    </div>
                    @if($experience->location)
                    <div class="flex items-center text-gray-600 text-sm">
                        <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                        <span>{{ $experience->location }}</span>
                    </div>
                    @endif
                </div>
                
                @if($experience->description)
                <p class="text-gray-600 text-sm mb-4 flex-grow">
                    {{ Str::limit($experience->description, 100) }}
                </p>
                @endif
                
                <div class="flex gap-2 mt-auto">
                    <a href="{{ route('admin.experiences.edit', $experience) }}" class="flex-1 bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 text-blue-700 px-4 py-2 rounded-lg transition text-center font-semibold border-2 border-blue-200 hover:border-blue-400">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                    <form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST" class="flex-1" onsubmit="event.preventDefault(); showDeleteModal(this);">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-gradient-to-r from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 text-red-700 px-4 py-2 rounded-lg transition font-semibold border-2 border-red-200 hover:border-red-400">
                            <i class="fas fa-trash mr-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-briefcase text-blue-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Experiences Added Yet</h3>
        <p class="text-gray-600 mb-6">Start building your professional timeline by adding your work experience.</p>
        <a href="{{ route('admin.experiences.create') }}" class="group inline-block relative">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-4 rounded-xl transition flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Your First Experience
            </div>
        </a>
    </div>
@endif
@endsection
