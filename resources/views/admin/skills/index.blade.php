@extends('admin.layout')

@section('title', 'Manage Skills')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-code text-white text-xl"></i>
                </div>
                Skills Management
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Manage your technical and professional skills</p>
        </div>
        <a href="{{ route('admin.skills.create') }}" class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                <i class="fas fa-plus mr-2"></i>Add Skill
            </div>
        </a>
    </div>
</div>

@if($categories->count() > 0)
    @foreach($categories as $category)
        <div class="mb-8">
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-t-2xl px-6 py-4 shadow-xl">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-layer-group mr-3"></i>{{ $category->name }}
                </h2>
            </div>
            <div class="bg-white rounded-b-2xl shadow-xl p-6">
                @if($category->skills->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($category->skills as $skill)
                        <div class="group relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
                            <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 h-full flex flex-col">
                                <div class="flex items-start mb-4">
                                    @if($skill->icon)
                                        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-3 transform group-hover:rotate-12 transition duration-500 flex-shrink-0">
                                            <i class="{{ $skill->icon }} text-white text-2xl"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-800 mb-1 group-hover:text-green-600 transition">{{ $skill->name }}</h3>
                                        @if($skill->years_experience)
                                            <p class="text-emerald-600 text-sm font-semibold">{{ $skill->years_experience }} years exp</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-4 flex-grow">
                                    <div class="flex justify-between mb-2">
                                        <span class="text-sm text-gray-600 font-semibold">Proficiency</span>
                                        <span class="text-sm text-green-700 font-bold">{{ $skill->proficiency }}%</span>
                                    </div>
                                    <div class="h-3 bg-gray-200 rounded-full overflow-hidden shadow-inner">
                                        <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full transition-all duration-500" style="width: {{ $skill->proficiency }}%;"></div>
                                    </div>
                                </div>
                                
                                <div class="flex gap-2 mt-auto">
                                    <a href="{{ route('admin.skills.edit', $skill) }}" class="flex-1 bg-gradient-to-r from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 text-green-700 px-4 py-2 rounded-lg transition text-center font-semibold border-2 border-green-200 hover:border-green-400">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="flex-1" onsubmit="event.preventDefault(); showDeleteModal(this);">
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
                    <p class="text-gray-500 text-center py-8">No skills in this category yet.</p>
                @endif
            </div>
        </div>
    @endforeach
@else
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-r from-green-100 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-code text-green-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Skills Added Yet</h3>
        <p class="text-gray-600 mb-6">Start showcasing your expertise by adding your technical and professional skills.</p>
        <a href="{{ route('admin.skills.create') }}" class="group inline-block relative">
            <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-8 py-4 rounded-xl transition flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Your First Skill
            </div>
        </a>
    </div>
@endif
@endsection
