@extends('admin.layout')

@section('title', 'Manage Projects')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-project-diagram text-white text-xl"></i>
                </div>
                Projects Portfolio
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Showcase your work and accomplishments</p>
            @php
                $featuredCount = $projects->where('is_featured', true)->count();
            @endphp
            @if($featuredCount > 0)
                <div class="ml-16 mt-2 inline-flex items-center bg-gradient-to-r from-yellow-100 to-orange-100 text-orange-800 px-4 py-2 rounded-lg text-sm font-semibold">
                    <i class="fas fa-star text-yellow-500 mr-2"></i>
                    {{ $featuredCount }} of 3 projects featured on homepage
                </div>
            @endif
        </div>
        <a href="{{ route('admin.projects.create') }}" class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                <i class="fas fa-plus mr-2"></i>Add Project
            </div>
        </a>
    </div>
</div>

@if($projects->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-orange-400 to-red-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
            <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 overflow-hidden flex flex-col h-full">
                @if($project->image)
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500" alt="{{ $project->title }}">
                        @if($project->featured)
                            <span class="absolute top-3 right-3 bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center">
                                <i class="fas fa-star mr-1 animate-pulse"></i>Featured
                            </span>
                        @endif
                    </div>
                @else
                    <div class="relative h-48 bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center">
                        <i class="fas fa-project-diagram text-white text-6xl opacity-50"></i>
                        @if($project->featured)
                            <span class="absolute top-3 right-3 bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center">
                                <i class="fas fa-star mr-1 animate-pulse"></i>Featured
                            </span>
                        @endif
                    </div>
                @endif
                
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-orange-600 transition">{{ $project->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->description, 100) }}</p>
                    
                    @if($project->technologies)
                        <div class="mb-4 flex-grow">
                            <div class="flex flex-wrap gap-2">
                                @foreach(is_array($project->technologies) ? $project->technologies : json_decode($project->technologies) as $tech)
                                    <span class="bg-gradient-to-r from-orange-100 to-red-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex gap-2 mt-auto">
                        <!-- Featured Toggle Button -->
                        <form action="{{ route('admin.projects.toggle-featured', $project) }}" method="POST" class="flex-shrink-0">
                            @csrf
                            <button type="submit" class="@if($project->is_featured) bg-gradient-to-r from-yellow-400 to-orange-400 text-white @else bg-gradient-to-r from-gray-50 to-slate-50 text-gray-600 border-2 border-gray-200 @endif hover:scale-105 px-3 py-2 rounded-lg transition font-semibold shadow-md" title="@if($project->is_featured) Remove from Featured @else Add to Featured @endif">
                                <i class="fas fa-star @if(!$project->is_featured) opacity-50 @endif"></i>
                            </button>
                        </form>
                        
                        @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="bg-gradient-to-r from-cyan-50 to-blue-50 hover:from-cyan-100 hover:to-blue-100 text-cyan-700 px-3 py-2 rounded-lg transition text-center font-semibold border-2 border-cyan-200 hover:border-cyan-400 flex-shrink-0" title="View Demo">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        @endif
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="bg-gradient-to-r from-gray-50 to-slate-50 hover:from-gray-100 hover:to-slate-100 text-gray-700 px-3 py-2 rounded-lg transition text-center font-semibold border-2 border-gray-200 hover:border-gray-400 flex-shrink-0" title="GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                        @endif
                        <a href="{{ route('admin.projects.edit', $project) }}" class="flex-1 bg-gradient-to-r from-orange-50 to-red-50 hover:from-orange-100 hover:to-red-100 text-orange-700 px-4 py-2 rounded-lg transition text-center font-semibold border-2 border-orange-200 hover:border-orange-400">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="event.preventDefault(); showDeleteModal(this);" class="flex-shrink-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gradient-to-r from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 text-red-700 px-3 py-2 rounded-lg transition font-semibold border-2 border-red-200 hover:border-red-400">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-r from-orange-100 to-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-project-diagram text-orange-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Projects Added Yet</h3>
        <p class="text-gray-600 mb-6">Start showcasing your work by adding your first project.</p>
        <a href="{{ route('admin.projects.create') }}" class="group inline-block relative">
            <div class="absolute inset-0 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white px-8 py-4 rounded-xl transition flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Your First Project
            </div>
        </a>
    </div>
@endif
@endsection
