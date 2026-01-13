<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 overflow-y-auto">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Portfolio Admin</h1>
            </div>
            <nav class="mt-6 pb-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.about.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.about.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-user mr-3"></i>
                    About Me
                </a>
                <a href="{{ route('admin.experiences.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.experiences.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-briefcase mr-3"></i>
                    Experience
                </a>
                <a href="{{ route('admin.education.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.education.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-graduation-cap mr-3"></i>
                    Education
                </a>
                <a href="{{ route('admin.skills.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.skills.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-cogs mr-3"></i>
                    Skills
                </a>
                <a href="{{ route('admin.projects.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.projects.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-project-diagram mr-3"></i>
                    Projects
                </a>
                <a href="{{ route('admin.certifications.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.certifications.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-certificate mr-3"></i>
                    Certifications
                </a>
                <a href="{{ route('admin.awards.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.awards.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-trophy mr-3"></i>
                    Awards
                </a>
                <a href="{{ route('admin.activities.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.activities.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-tasks mr-3"></i>
                    Activities
                </a>
                <a href="{{ route('admin.resumes.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.resumes.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-file-pdf mr-3"></i>
                    Resume / CV (AI)
                </a>
                <a href="{{ route('admin.menu.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.menu.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-bars mr-3"></i>
                    Menu Management
                </a>
                <a href="{{ route('admin.sections.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.sections.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-eye mr-3"></i>
                    Section Visibility
                </a>
                <a href="{{ route('admin.messages.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.messages.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-envelope mr-3"></i>
                    Contact Messages
                </a>
                @if(auth()->check() && auth()->user()->isSuperAdmin())
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    User Management
                </a>
                @endif
                <a href="{{ route('admin.theme.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.theme.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-palette mr-3"></i>
                    Theme Settings
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-cog mr-3"></i>
                    General Settings
                </a>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center px-6 py-3 hover:bg-gray-800 mt-4 border-t border-gray-700">
                    <i class="fas fa-external-link-alt mr-3"></i>
                    View Portfolio
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <h2 class="text-2xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    <div class="flex items-center space-x-4">
                        @if(auth()->check())
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-600">{{ auth()->user()->name }}</span>
                            @if(auth()->user()->isSuperAdmin())
                            <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Super Admin</span>
                            @else
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Admin</span>
                            @endif
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        @endif
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
