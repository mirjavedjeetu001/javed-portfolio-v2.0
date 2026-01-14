@extends('admin.layout')

@section('title', 'Manage Activities')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-tasks text-white text-xl"></i>
                </div>
                Professional Activities
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Track your volunteer work and community involvement</p>
        </div>
        <a href="{{ route('admin.activities.create') }}" class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                <i class="fas fa-plus mr-2"></i>Add Activity
            </div>
        </a>
    </div>
</div>

@if($activities->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($activities as $activity)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
            <div class="relative bg-gradient-to-br from-emerald-600 to-teal-600 p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 text-white h-full flex flex-col">
                <div class="flex items-start mb-4">
                    <div class="w-14 h-14 bg-white bg-opacity-25 rounded-xl flex items-center justify-center mr-3 transform group-hover:rotate-12 transition duration-500 flex-shrink-0">
                        <i class="fas {{ $activity->is_current ? 'fa-tasks' : 'fa-check-circle' }} text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        @if($activity->is_current)
                            <span class="inline-flex items-center bg-white text-emerald-700 px-3 py-1 rounded-full text-xs font-semibold mb-2">
                                <i class="fas fa-circle text-green-500 mr-1 animate-pulse"></i>Active
                            </span>
                        @else
                            <span class="inline-flex items-center bg-white bg-opacity-25 text-white px-3 py-1 rounded-full text-xs font-semibold mb-2">
                                <i class="fas fa-check-circle mr-1"></i>Completed
                            </span>
                        @endif
                        <h3 class="text-xl font-bold text-white mb-1">{{ $activity->title }}</h3>
                        <p class="font-semibold text-emerald-100">{{ $activity->organization }}</p>
                    </div>
                </div>
                
                <div class="mb-4 space-y-2">
                    <div class="flex items-center text-emerald-100 text-sm">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($activity->start_date)->format('M Y') }} - 
                            {{ $activity->is_current ? 'Present' : ($activity->end_date ? \Carbon\Carbon::parse($activity->end_date)->format('M Y') : 'N/A') }}
                        </span>
                    </div>
                </div>
                
                @if($activity->description)
                <p class="text-emerald-100 text-sm mb-4 flex-grow">
                    {{ Str::limit($activity->description, 120) }}
                </p>
                @endif
                
                <div class="flex gap-2 mt-auto">
                    <a href="{{ route('admin.activities.edit', $activity) }}" class="flex-1 bg-white hover:bg-emerald-50 text-emerald-700 px-4 py-2 rounded-lg transition text-center font-semibold">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                    <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" class="flex-1" onsubmit="event.preventDefault(); showDeleteModal(this);">
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
        <div class="w-24 h-24 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-tasks text-emerald-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Activities Yet</h3>
        <p class="text-gray-600 mb-6">Add your volunteer work, community involvement, and professional activities.</p>
        <a href="{{ route('admin.activities.create') }}" class="group inline-block relative">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-8 py-4 rounded-xl transition flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Your First Activity
            </div>
        </a>
    </div>
@endif
@endsection
