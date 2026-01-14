@extends('admin.layout')

@section('title', 'Manage Education')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                </div>
                Education History
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Manage your academic qualifications</p>
        </div>
        <a href="{{ route('admin.education.create') }}" class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                <i class="fas fa-plus mr-2"></i>Add Education
            </div>
        </a>
    </div>
</div>

@if($education->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($education as $edu)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
            <div class="relative bg-gradient-to-br from-purple-600 to-pink-600 p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 text-white h-full flex flex-col">
                <div class="flex items-start mb-4">
                    <div class="w-14 h-14 bg-white bg-opacity-25 rounded-xl flex items-center justify-center mr-3 transform group-hover:rotate-12 transition duration-500 flex-shrink-0">
                        <i class="fas fa-university text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white mb-1">{{ $edu->degree }}</h3>
                        @if($edu->field_of_study)
                            <p class="mb-2 text-purple-100">{{ $edu->field_of_study }}</p>
                        @endif
                        <p class="font-semibold text-white">{{ $edu->institution }}</p>
                    </div>
                </div>
                
                <div class="mb-4 space-y-2">
                    <div class="flex items-center text-purple-100 text-sm">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($edu->start_date)->format('M Y') }} - 
                            {{ $edu->end_date ? \Carbon\Carbon::parse($edu->end_date)->format('M Y') : 'Present' }}
                        </span>
                    </div>
                    @if($edu->location)
                    <div class="flex items-center text-purple-100 text-sm">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $edu->location }}</span>
                    </div>
                    @endif
                    @if($edu->grade)
                    <div class="flex items-center">
                        <i class="fas fa-star mr-2 text-yellow-300"></i>
                        <span class="inline-flex items-center bg-white text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">
                            Grade: {{ $edu->grade }}
                        </span>
                    </div>
                    @endif
                </div>
                
                @if($edu->description)
                <p class="text-purple-100 text-sm mb-4 flex-grow">
                    {{ Str::limit($edu->description, 120) }}
                </p>
                @endif
                
                <div class="flex gap-2 mt-auto">
                    <a href="{{ route('admin.education.edit', $edu) }}" class="flex-1 bg-white hover:bg-purple-50 text-purple-700 px-4 py-2 rounded-lg transition text-center font-semibold">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                    <form action="{{ route('admin.education.destroy', $edu) }}" method="POST" class="flex-1" onsubmit="event.preventDefault(); showDeleteModal(this);">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-transparent hover:bg-white hover:bg-opacity-20 text-white px-4 py-2 rounded-lg transition font-semibold border-2 border-white">
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
        <div class="w-24 h-24 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-graduation-cap text-purple-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Education Entries Yet</h3>
        <p class="text-gray-600 mb-6">Start building your academic portfolio by adding your education history.</p>
        <a href="{{ route('admin.education.create') }}" class="group inline-block relative">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-4 rounded-xl transition flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Your First Education
            </div>
        </a>
    </div>
@endif
@endsection
