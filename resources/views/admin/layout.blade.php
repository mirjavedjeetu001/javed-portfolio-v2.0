<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Portfolio</title>
    
    <!-- Favicon - Dynamic Profile Picture -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
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
        <aside id="sidebar" class="w-64 bg-gray-900 text-white flex-shrink-0 overflow-y-auto h-full">
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
                
                <!-- Blog Section -->
                <div class="px-6 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Blog Management</div>
                <a href="{{ route('admin.blog-categories.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.blog-categories.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-folder mr-3"></i>
                    Blog Categories
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.blogs.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-blog mr-3"></i>
                    Blog Posts
                </a>
                <a href="{{ route('admin.blog-comments.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.blog-comments.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-comments mr-3"></i>
                    Blog Comments
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
                <a href="{{ route('admin.database.index') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->routeIs('admin.database.*') ? 'bg-gray-800 border-l-4 border-blue-500' : '' }}">
                    <i class="fas fa-database mr-3"></i>
                    Database Backup
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
                            <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
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

    <!-- Premium Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4" style="backdrop-filter: blur(8px);">
        <div class="relative max-w-md w-full animate-modal-pop">
            <div class="absolute inset-0 bg-gradient-to-r from-red-400 to-pink-500 rounded-2xl transform scale-105 opacity-75 blur-xl"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-4 border-b border-red-100">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Confirm Deletion</h3>
                    </div>
                </div>
                <div class="px-6 py-6">
                    <p class="text-gray-700 mb-2 font-semibold">Are you sure you want to delete this item?</p>
                    <p class="text-gray-600 text-sm">This action cannot be undone and all related data will be permanently removed.</p>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                    <button onclick="closeDeleteModal()" class="px-6 py-2 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-100 transition font-semibold">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                    <button onclick="confirmDelete()" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white px-6 py-2 rounded-xl transition font-semibold flex items-center">
                            <i class="fas fa-trash mr-2"></i>Delete
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes modal-pop {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-modal-pop {
            animation: modal-pop 0.3s ease-out;
        }
    </style>

    <script>
        let deleteForm = null;

        function showDeleteModal(form) {
            deleteForm = form;
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
            deleteForm = null;
        }

        function confirmDelete() {
            if (deleteForm) {
                deleteForm.submit();
            }
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
                closeDeleteModal();
            }
        });

        // Close modal on backdrop click
        document.getElementById('deleteModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
