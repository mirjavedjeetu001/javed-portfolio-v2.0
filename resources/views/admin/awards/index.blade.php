@extends('admin.layout')

@section('title', 'Manage Awards')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-trophy text-white text-xl"></i>
                </div>
                Awards & Honors
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Celebrate your achievements and recognitions</p>
        </div>
        <a href="{{ route('admin.awards.create') }}" class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-yellow-600 to-orange-600 hover:from-yellow-700 hover:to-orange-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                <i class="fas fa-plus mr-2"></i>Add Award
            </div>
        </a>
    </div>
</div>

@if($awards->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($awards as $award)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
            <div class="relative bg-gradient-to-br from-yellow-600 to-orange-600 p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 text-white h-full flex flex-col">
                <div class="flex items-start mb-4">
                    <div class="w-14 h-14 bg-white bg-opacity-25 rounded-xl flex items-center justify-center mr-3 transform group-hover:rotate-12 transition duration-500 flex-shrink-0">
                        <i class="fas fa-trophy text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white mb-1">{{ $award->title }}</h3>
                        <p class="font-semibold text-yellow-100">{{ $award->organization }}</p>
                    </div>
                </div>
                
                <div class="mb-4 space-y-2">
                    <div class="flex items-center text-yellow-100 text-sm">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>{{ \Carbon\Carbon::parse($award->date)->format('F d, Y') }}</span>
                    </div>
                </div>
                
                @if($award->description)
                <p class="text-yellow-100 text-sm mb-4 flex-grow">
                    {{ Str::limit($award->description, 120) }}
                </p>
                @endif
                
                <div class="flex gap-2 mt-auto">
                    <a href="{{ route('admin.awards.edit', $award) }}" class="flex-1 bg-white hover:bg-yellow-50 text-yellow-700 px-4 py-2 rounded-lg transition text-center font-semibold">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                    <form action="{{ route('admin.awards.destroy', $award) }}" method="POST" class="flex-1" onsubmit="event.preventDefault(); showDeleteModal(this);">
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
        <div class="w-24 h-24 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-trophy text-yellow-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Awards Yet</h3>
        <p class="text-gray-600 mb-6">Showcase your achievements by adding awards and honors you've received.</p>
        <a href="{{ route('admin.awards.create') }}" class="group inline-block relative">
            <div class="absolute inset-0 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-yellow-600 to-orange-600 hover:from-yellow-700 hover:to-orange-700 text-white px-8 py-4 rounded-xl transition flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Your First Award
            </div>
        </a>
    </div>
@endif
@endsection
