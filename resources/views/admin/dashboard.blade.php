@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Page Header -->
<div class="mb-6 sm:mb-8">
    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 flex items-center">
        <div class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mr-3 sm:mr-4">
            <i class="fas fa-tachometer-alt text-white text-lg sm:text-2xl"></i>
        </div>
        Dashboard
    </h1>
    <p class="text-sm sm:text-base text-gray-600 mt-2 ml-13 sm:ml-18">Welcome back! Here's your portfolio overview</p>
</div>

<!-- Reset Data Buttons -->
<div class="mb-4 sm:mb-6 flex flex-col sm:flex-row gap-3 sm:gap-4">
    <form action="{{ route('admin.reset-data') }}" method="POST" onsubmit="return confirm('⚠️ WARNING: This will permanently delete ALL portfolio data (Experiences, Education, Skills, Projects, Certifications, Awards, Activities). This cannot be undone! Are you absolutely sure?');">
        @csrf
        <button type="submit" class="group relative w-full sm:w-auto">
            <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-pink-600 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl transition flex items-center justify-center font-semibold text-sm sm:text-base">
                <i class="fas fa-trash-alt mr-2"></i><span class="hidden sm:inline">Reset All Portfolio Data</span><span class="sm:hidden">Reset Portfolio</span>
            </div>
        </button>
    </form>
    
    <form action="{{ route('admin.reset-blog-data') }}" method="POST" onsubmit="return confirm('⚠️ WARNING: This will permanently delete ALL blog data (Blog Posts, Categories, Comments, Likes). This cannot be undone! Are you absolutely sure?');">
        @csrf
        <button type="submit" class="group relative w-full sm:w-auto">
            <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-red-600 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-xl transition flex items-center justify-center font-semibold text-sm sm:text-base">
                <i class="fas fa-blog mr-2"></i><span class="hidden sm:inline">Reset All Blog Data</span><span class="sm:hidden">Reset Blog</span>
            </div>
        </button>
    </form>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Experience Card -->
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-cyan-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-2">Experiences</p>
                    <p class="text-4xl font-bold text-gray-800">{{ $stats['experiences'] }}</p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center transform group-hover:rotate-12 transition duration-500">
                    <i class="fas fa-briefcase text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Card -->
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-2">Projects</p>
                    <p class="text-4xl font-bold text-gray-800">{{ $stats['projects'] }}</p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center transform group-hover:rotate-12 transition duration-500">
                    <i class="fas fa-project-diagram text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Skills Card -->
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-2">Skills</p>
                    <p class="text-4xl font-bold text-gray-800">{{ $stats['skills'] }}</p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center transform group-hover:rotate-12 transition duration-500">
                    <i class="fas fa-cogs text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Education Card -->
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-2">Education</p>
                    <p class="text-4xl font-bold text-gray-800">{{ $stats['education'] }}</p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center transform group-hover:rotate-12 transition duration-500">
                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Posts Card -->
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-red-400 to-rose-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-2">Blog Posts</p>
                    <p class="text-4xl font-bold text-gray-800">{{ $stats['blogs'] }}</p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-rose-500 rounded-2xl flex items-center justify-center transform group-hover:rotate-12 transition duration-500">
                    <i class="fas fa-blog text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages Card -->
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-400 to-blue-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-semibold uppercase tracking-wide mb-2">Unread Messages</p>
                    <p class="text-4xl font-bold text-gray-800">{{ $stats['contact_messages'] }}</p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-2xl flex items-center justify-center transform group-hover:rotate-12 transition duration-500">
                    <i class="fas fa-envelope text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Quick Actions -->
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-6 py-4 border-b border-blue-100">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-bolt text-blue-600 mr-3"></i>Quick Actions
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('admin.resumes.create') }}" class="group/item flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl transition duration-300">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3 group-hover/item:scale-110 transition">
                                <i class="fas fa-upload text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Upload Resume with AI Parsing</span>
                        </div>
                        <i class="fas fa-arrow-right text-blue-600 group-hover/item:translate-x-2 transition"></i>
                    </a>

                    <a href="{{ route('admin.about.index') }}" class="group/item flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 rounded-xl transition duration-300">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3 group-hover/item:scale-110 transition">
                                <i class="fas fa-user-edit text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Edit About Section</span>
                        </div>
                        <i class="fas fa-arrow-right text-green-600 group-hover/item:translate-x-2 transition"></i>
                    </a>

                    <a href="{{ route('admin.theme.index') }}" class="group/item flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-xl transition duration-300">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 group-hover/item:scale-110 transition">
                                <i class="fas fa-palette text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Customize Theme Colors</span>
                        </div>
                        <i class="fas fa-arrow-right text-purple-600 group-hover/item:translate-x-2 transition"></i>
                    </a>

                    <a href="{{ route('home') }}" target="_blank" class="group/item flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100 hover:from-gray-100 hover:to-gray-200 rounded-xl transition duration-300">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-gray-600 rounded-lg flex items-center justify-center mr-3 group-hover/item:scale-110 transition">
                                <i class="fas fa-eye text-white"></i>
                            </div>
                            <span class="font-semibold text-gray-800">Preview Portfolio</span>
                        </div>
                        <i class="fas fa-external-link-alt text-gray-600 group-hover/item:translate-x-2 transition"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Resumes -->
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-pink-400 to-orange-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-pink-50 to-orange-50 px-6 py-4 border-b border-pink-100">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-file-pdf text-pink-600 mr-3"></i>Recent Resumes
                </h3>
            </div>
            <div class="p-6">
                @if($recentResumes->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentResumes as $resume)
                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl hover:from-gray-100 hover:to-gray-200 transition">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-orange-500 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-file-pdf text-white"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm">{{ $resume->filename }}</p>
                                        <p class="text-xs text-gray-500">{{ $resume->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @if($resume->is_active)
                                    <span class="px-3 py-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs rounded-full font-semibold">Active</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-pink-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-file-upload text-pink-600 text-2xl"></i>
                        </div>
                        <p class="text-gray-600 font-semibold mb-2">No resumes uploaded yet</p>
                        <a href="{{ route('admin.resumes.create') }}" class="inline-flex items-center text-pink-600 hover:text-pink-700 font-semibold">
                            Upload your first resume <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


@if($about)
<div class="mt-8 group relative">
    <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-teal-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
    <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
        <div class="bg-gradient-to-r from-cyan-50 to-teal-50 px-6 py-4 border-b border-cyan-100">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-user-circle text-cyan-600 mr-3"></i>Current Portfolio Info
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl">
                    <p class="text-sm text-blue-700 font-semibold mb-1 flex items-center">
                        <i class="fas fa-user mr-2"></i>Name
                    </p>
                    <p class="font-bold text-gray-800 text-lg">{{ $about->name ?? 'Not set' }}</p>
                </div>
                <div class="p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl">
                    <p class="text-sm text-purple-700 font-semibold mb-1 flex items-center">
                        <i class="fas fa-briefcase mr-2"></i>Title
                    </p>
                    <p class="font-bold text-gray-800 text-lg">{{ $about->title ?? 'Not set' }}</p>
                </div>
                <div class="p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl">
                    <p class="text-sm text-green-700 font-semibold mb-1 flex items-center">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </p>
                    <p class="font-bold text-gray-800 text-lg">{{ $about->email ?? 'Not set' }}</p>
                </div>
                <div class="p-4 bg-gradient-to-r from-pink-50 to-pink-100 rounded-xl">
                    <p class="text-sm text-pink-700 font-semibold mb-1 flex items-center">
                        <i class="fas fa-phone mr-2"></i>Phone
                    </p>
                    <p class="font-bold text-gray-800 text-lg">{{ $about->phone ?? 'Not set' }}</p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-8 pt-8 border-t-2 border-gray-100">
                <div class="text-center group/stat">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover/stat:scale-110 transition duration-300">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <p class="text-4xl font-bold text-blue-600 mb-2">{{ $about->years_experience }}+</p>
                    <p class="text-sm text-gray-600 font-semibold">Years Experience</p>
                </div>
                <div class="text-center group/stat">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover/stat:scale-110 transition duration-300">
                        <i class="fas fa-project-diagram text-white text-2xl"></i>
                    </div>
                    <p class="text-4xl font-bold text-green-600 mb-2">{{ $about->projects_completed }}+</p>
                    <p class="text-sm text-gray-600 font-semibold">Projects</p>
                </div>
                <div class="text-center group/stat">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover/stat:scale-110 transition duration-300">
                        <i class="fas fa-code text-white text-2xl"></i>
                    </div>
                    <p class="text-4xl font-bold text-purple-600 mb-2">{{ $about->technologies_used }}+</p>
                    <p class="text-sm text-gray-600 font-semibold">Technologies</p>
                </div>
                <div class="text-center group/stat">
                    <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover/stat:scale-110 transition duration-300">
                        <i class="fas fa-globe text-white text-2xl"></i>
                    </div>
                    <p class="text-4xl font-bold text-orange-600 mb-2">{{ $about->countries_visited }}+</p>
                    <p class="text-sm text-gray-600 font-semibold">Countries</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
