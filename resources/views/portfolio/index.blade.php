<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $about->name ?? 'Portfolio' }} - {{ $about->title ?? 'Professional Portfolio' }}</title>
    
    {{-- Dynamic SEO Meta Tags --}}
    @include('partials.seo-meta', ['pageTitle' => ($about->name ?? 'Portfolio') . ' - ' . ($about->title ?? 'Professional Portfolio')])
    
    <!-- Favicon - Dynamic Profile Picture -->
    @if($about && $about->image)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $about->image) }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('storage/' . $about->image) }}">
        <link rel="apple-touch-icon" href="{{ asset('storage/' . $about->image) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @endif
    
    {{-- Google Analytics & AdSense --}}
    @include('partials.analytics-scripts')
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, {{ $theme->primary_color ?? '#3498db' }} 0%, {{ $theme->secondary_color ?? '#2ecc71' }} 100%);
        }
        
        .text-primary {
            color: {{ $theme->primary_color ?? '#3498db' }};
        }
        
        .bg-primary {
            background-color: {{ $theme->primary_color ?? '#3498db' }};
        }
        
        .border-primary {
            border-color: {{ $theme->primary_color ?? '#3498db' }};
        }
        
        .hover\:bg-primary:hover {
            background-color: {{ $theme->primary_color ?? '#3498db' }};
        }
        
        /* Dynamic Section Colors */
        @if($theme)
        /* Mobile Menu Colors */
        #mobile-menu {
            background: linear-gradient(to bottom right, {{ $theme->mobile_menu_bg_from ?? '#9333ea' }}, {{ $theme->mobile_menu_bg_via ?? '#2563eb' }}, {{ $theme->mobile_menu_bg_to ?? '#7c3aed' }}) !important;
        }
        
        #mobile-menu,
        #mobile-menu .mobile-menu-link,
        #mobile-menu h2,
        #mobile-menu p,
        #mobile-menu button,
        #mobile-menu i {
            color: {{ $theme->mobile_menu_text ?? '#ffffff' }} !important;
        }
        
        /* Hero Section - Uses Primary & Secondary Colors for Gradient */
        /* Hero text color can be customized */
        #home h1,
        #home p,
        #home a:not(.bg-white) {
            color: {{ $theme->hero_text_color ?? '#ffffff' }} !important;
        }
        
        /* About Section */
        #about {
            background-color: {{ $theme->about_bg_color ?? '#f9fafb' }} !important;
        }
        
        /* Experience Section */
        #experience {
            background-color: {{ $theme->experience_bg_color ?? '#eef2ff' }} !important;
        }
        
        /* Education Section */
        #education {
            background-color: {{ $theme->education_bg_color ?? '#fef3c7' }} !important;
        }
        
        /* Certifications Section */
        #certifications {
            background-color: {{ $theme->certifications_bg_color ?? '#ecfdf5' }} !important;
        }
        
        /* Skills Section */
        #skills {
            background-color: {{ $theme->skills_bg_color ?? '#dcfce7' }} !important;
        }
        
        /* Projects Section */
        #projects {
            background-color: {{ $theme->projects_bg_color ?? '#ffedd5' }} !important;
        }
        
        /* Awards Section */
        #awards {
            background-color: {{ $theme->awards_bg_color ?? '#fce7f3' }} !important;
        }
        
        /* Activities Section */
        #activities {
            background-color: {{ $theme->activities_bg_color ?? '#dbeafe' }} !important;
        }
        
        /* Contact Section - Uses Primary & Secondary Colors for Gradient */
        /* Contact text color can be customized */
        #contact h2,
        #contact label,
        #contact p,
        #contact i {
            color: {{ $theme->contact_text_color ?? '#ffffff' }} !important;
        }
        
        /* Section Headings */
        section:not(#home):not(#contact) h2 {
            color: {{ $theme->section_heading_color ?? '#1f2937' }} !important;
        }
        
        /* Section Text */
        section:not(#home):not(#contact) p {
            color: {{ $theme->section_text_color ?? '#4b5563' }} !important;
        }
        
        /* Footer Colors */
        footer {
            background-color: {{ $theme->footer_bg_color ?? '#111827' }} !important;
        }
        
        footer,
        footer p,
        footer a {
            color: {{ $theme->footer_text_color ?? '#ffffff' }} !important;
        }
        @endif
        
        .smooth-scroll {
            scroll-behavior: smooth;
        }
        
        section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 80px 0;
        }
        
        .skill-bar {
            transition: width 1s ease-in-out;
        }
        
        /* Preloader Styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, {{ $theme->primary_color ?? '#3498db' }} 0%, {{ $theme->secondary_color ?? '#2ecc71' }} 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s, visibility 0.5s;
        }
        
        #preloader.hide {
            opacity: 0;
            visibility: hidden;
        }
        
        .loader {
            position: relative;
            width: 120px;
            height: 120px;
        }
        
        .loader-circle {
            position: absolute;
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        .loader-circle:nth-child(1) {
            width: 120px;
            height: 120px;
            animation-duration: 1.5s;
        }
        
        .loader-circle:nth-child(2) {
            width: 90px;
            height: 90px;
            top: 15px;
            left: 15px;
            animation-duration: 1s;
            animation-direction: reverse;
        }
        
        .loader-circle:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 30px;
            left: 30px;
            animation-duration: 0.75s;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Hero Animation Styles */
        .typing-effect {
            overflow: hidden;
            border-right: 3px solid white;
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink-caret .75s step-end infinite;
            display: inline-block;
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: white }
        }
        
        .particle {
            position: absolute;
            background: white;
            border-radius: 50%;
            opacity: 0.7;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); }
            25% { transform: translateY(-20px) translateX(10px); }
            50% { transform: translateY(-40px) translateX(-10px); }
            75% { transform: translateY(-20px) translateX(10px); }
        }
        
        /* Mobile Menu Styles */
        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
        
        .mobile-menu-backdrop {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        .mobile-menu-backdrop.active {
            opacity: 1;
            visibility: visible;
        }
        
        .menu-item-animation {
            opacity: 0;
            transform: translateX(30px);
            animation: slideInRight 0.4s forwards;
        }
        
        @keyframes slideInRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="smooth-scroll">
    @php
        $enablePreloader = $settings->where('key', 'enable_preloader')->first()->value ?? '1';
    @endphp
    
    @if($enablePreloader == '1')
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader">
            <div class="loader-circle"></div>
            <div class="loader-circle"></div>
            <div class="loader-circle"></div>
        </div>
    </div>
    @endif
    
    <!-- Mobile Menu Backdrop -->
    <div id="mobile-menu-backdrop" class="mobile-menu-backdrop fixed inset-0 bg-black bg-opacity-50 z-40"></div>
    
    <!-- Navigation -->
    <nav class="fixed w-full bg-white shadow-md z-50">
        <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4">
            <div class="flex items-center justify-between">
                <a href="#home" class="text-xl sm:text-2xl font-bold text-primary">
                    {{ $about->name ?? 'Portfolio' }}
                </a>
                
                <div class="hidden md:flex space-x-8">
                    @foreach($menuItems as $menuItem)
                        <a href="{{ $menuItem->url }}" class="text-gray-700 hover:text-primary transition">{{ $menuItem->label }}</a>
                    @endforeach
                </div>
                
                <button class="md:hidden text-primary hover:text-purple-700 transition-colors" id="mobile-menu-button">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>
    
    <!-- Premium Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu fixed top-0 right-0 h-full w-80 bg-gradient-to-br from-purple-600 via-blue-600 to-purple-700 shadow-2xl z-50 overflow-y-auto">
        <div class="p-6">
            <!-- Menu Header -->
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-white">Menu</h2>
                <button id="mobile-menu-close" class="text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <!-- Profile Section -->
            @if($about && $about->image)
            <div class="mb-8 text-center">
                <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->name }}" class="w-20 h-20 rounded-full mx-auto mb-3 border-4 border-white shadow-lg object-cover">
                <p class="text-white font-semibold">{{ $about->name ?? 'Portfolio' }}</p>
                <p class="text-purple-100 text-sm">{{ $about->title ?? '' }}</p>
            </div>
            @endif
            
            <!-- Menu Items -->
            <nav class="space-y-2">
                @foreach($menuItems as $menuItem)
                    <a href="{{ $menuItem->url }}" class="mobile-menu-link flex items-center space-x-4 px-4 py-3 text-white hover:bg-white/20 rounded-lg transition-all duration-200 transform hover:translate-x-2">
                        <i class="fas {{ $menuItem->section_id ? 'fa-' . str_replace('#', '', $menuItem->section_id) : 'fa-link' }} w-6"></i>
                        <span class="font-medium">{{ $menuItem->label }}</span>
                    </a>
                @endforeach
            </nav>
            
            <!-- Social Links -->
            @if($about && ($about->facebook || $about->twitter || $about->linkedin || $about->github || $about->instagram || $about->youtube))
            <div class="mt-8 pt-6 border-t border-white/20">
                <p class="text-white text-sm font-semibold mb-4">Connect With Me</p>
                <div class="flex justify-center space-x-4">
                    @if($about->facebook)
                        <a href="{{ $about->facebook }}" target="_blank" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all transform hover:scale-110">
                            <i class="fab fa-facebook"></i>
                        </a>
                    @endif
                    @if($about->twitter)
                        <a href="{{ $about->twitter }}" target="_blank" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all transform hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                    @if($about->linkedin)
                        <a href="{{ $about->linkedin }}" target="_blank" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all transform hover:scale-110">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    @endif
                    @if($about->github)
                        <a href="{{ $about->github }}" target="_blank" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all transform hover:scale-110">
                            <i class="fab fa-github"></i>
                        </a>
                    @endif
                    @if($about->instagram)
                        <a href="{{ $about->instagram }}" target="_blank" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all transform hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if($about->youtube)
                        <a href="{{ $about->youtube }}" target="_blank" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all transform hover:scale-110">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Hero Section -->
    <section id="home" class="gradient-bg text-white" style="position: relative; overflow: visible;">
        @php
            $enableAnimation = $settings->where('key', 'enable_hero_animation')->first()->value ?? '1';
        @endphp
        
        @if($enableAnimation == '1')
        <!-- Floating Particles -->
        <div class="particle" style="width: 8px; height: 8px; top: 20%; left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="width: 6px; height: 6px; top: 40%; left: 20%; animation-delay: 1s;"></div>
        <div class="particle" style="width: 10px; height: 10px; top: 60%; left: 80%; animation-delay: 2s;"></div>
        <div class="particle" style="width: 7px; height: 7px; top: 30%; left: 70%; animation-delay: 1.5s;"></div>
        <div class="particle" style="width: 5px; height: 5px; top: 80%; left: 30%; animation-delay: 0.5s;"></div>
        <div class="particle" style="width: 9px; height: 9px; top: 50%; left: 90%; animation-delay: 2.5s;"></div>
        @endif
        
        <div class="container mx-auto px-6 text-center" style="position: relative; z-index: 1;">
            <div>
                @if($about && $about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->name }}" class="w-40 h-40 rounded-full mx-auto mb-6 border-4 border-white shadow-2xl object-cover">
                @else
                    <div class="w-40 h-40 rounded-full mx-auto mb-6 bg-white/20 flex items-center justify-center">
                        <i class="fas fa-user text-6xl text-white/50"></i>
                    </div>
                @endif
                
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-4">{{ $about->name ?? 'Your Name' }}</h1>
                <p class="text-xl sm:text-2xl md:text-3xl mb-8 font-light">{{ $about->title ?? 'Your Title' }}</p>
                
                @if($about && ($about->facebook || $about->twitter || $about->linkedin || $about->github || $about->instagram || $about->youtube))
                <div class="flex flex-wrap justify-center gap-4 sm:gap-6 mb-8">
                    @if($about->facebook)
                        <a href="{{ $about->facebook }}" target="_blank" class="text-white hover:scale-110 transition transform" title="Facebook">
                            <i class="fab fa-facebook text-3xl"></i>
                        </a>
                    @endif
                    @if($about->twitter)
                        <a href="{{ $about->twitter }}" target="_blank" class="text-white hover:scale-110 transition transform" title="Twitter">
                            <i class="fab fa-twitter text-3xl"></i>
                        </a>
                    @endif
                    @if($about->linkedin)
                        <a href="{{ $about->linkedin }}" target="_blank" class="text-white hover:scale-110 transition transform" title="LinkedIn">
                            <i class="fab fa-linkedin text-3xl"></i>
                        </a>
                    @endif
                    @if($about->github)
                        <a href="{{ $about->github }}" target="_blank" class="text-white hover:scale-110 transition transform" title="GitHub">
                            <i class="fab fa-github text-3xl"></i>
                        </a>
                    @endif
                    @if($about->instagram)
                        <a href="{{ $about->instagram }}" target="_blank" class="text-white hover:scale-110 transition transform" title="Instagram">
                            <i class="fab fa-instagram text-3xl"></i>
                        </a>
                    @endif
                    @if($about->youtube)
                        <a href="{{ $about->youtube }}" target="_blank" class="text-white hover:scale-110 transition transform" title="YouTube">
                            <i class="fab fa-youtube text-3xl"></i>
                        </a>
                    @endif
                </div>
                @endif
                
                <div class="flex flex-col sm:flex-row flex-wrap justify-center gap-4">
                    <a href="#contact" class="bg-white text-blue-600 px-6 sm:px-8 py-3 rounded-full font-semibold hover:shadow-lg transition text-center">
                        Get In Touch
                    </a>
                    @php
                        $resumePath = $settings['resume_pdf_path'] ?? null;
                    @endphp
                    @if($resumePath)
                        <a href="{{ route('download.resume') }}" class="border-2 border-white text-white px-6 sm:px-8 py-3 rounded-full font-semibold transition text-center hover:shadow-lg hover:scale-105">
                            <i class="fas fa-download mr-2"></i>Download Resume
                        </a>
                    @elseif($about && $about->cv_file)
                        <a href="{{ asset('storage/' . $about->cv_file) }}" download class="border-2 border-white text-white px-6 sm:px-8 py-3 rounded-full font-semibold transition text-center hover:shadow-lg hover:scale-105">
                            <i class="fas fa-download mr-2"></i>Download Resume
                        </a>
                    @endif
                    @if($latestBlogs && $latestBlogs->count() > 0)
                        <a href="#blog" class="border-2 border-white text-white px-6 sm:px-8 py-3 rounded-full font-semibold transition text-center hover:shadow-lg hover:scale-105">
                            <i class="fas fa-blog mr-2"></i>Check My Blog
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    @if($about && (!isset($sectionVisibility['about']) || $sectionVisibility['about']))
    <section id="about" class="bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-8 sm:mb-12">About Me</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div>
                    <p class="text-base sm:text-lg text-gray-700 leading-relaxed mb-6">
                        {{ $about->bio }}
                    </p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-6">
                        <div>
                            <p class="text-sm sm:text-base text-gray-600"><i class="fas fa-envelope mr-2 text-primary"></i> Email</p>
                            <p class="font-semibold text-sm sm:text-base break-all">{{ $about->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm sm:text-base text-gray-600"><i class="fas fa-phone mr-2 text-primary"></i> Phone</p>
                            <p class="font-semibold text-sm sm:text-base">{{ $about->phone }}</p>
                        </div>
                        <div class="sm:col-span-2">
                            <p class="text-sm sm:text-base text-gray-600"><i class="fas fa-map-marker-alt mr-2 text-primary"></i> Location</p>
                            <p class="font-semibold text-sm sm:text-base">{{ $about->address }}</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div class="grid grid-cols-2 gap-4 sm:gap-6">
                        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg text-center">
                            <p class="text-3xl sm:text-4xl font-bold text-primary mb-2">{{ $about->years_experience }}+</p>
                            <p class="text-sm sm:text-base text-gray-600">Years Experience</p>
                        </div>
                        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg text-center">
                            <p class="text-3xl sm:text-4xl font-bold text-primary mb-2">{{ $about->projects_completed }}+</p>
                            <p class="text-sm sm:text-base text-gray-600">Projects Completed</p>
                        </div>
                        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg text-center">
                            <p class="text-3xl sm:text-4xl font-bold text-primary mb-2">{{ $about->technologies_used }}+</p>
                            <p class="text-sm sm:text-base text-gray-600">Technologies Used</p>
                        </div>
                        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg text-center">
                            <p class="text-3xl sm:text-4xl font-bold text-primary mb-2">{{ $about->countries_visited }}+</p>
                            <p class="text-sm sm:text-base text-gray-600">Countries Visited</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Experience Section -->
    @if($experiences->count() > 0 && (!isset($sectionVisibility['experience']) || $sectionVisibility['experience']))
    <section id="experience" class="bg-gradient-to-br from-indigo-50 via-white to-pink-50 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 right-20 w-96 h-96 bg-indigo-500 rounded-full filter blur-3xl animate-pulse"></div>
        </div>
        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-8 sm:mb-12">
                <div class="inline-block mb-4">
                    <span class="px-3 sm:px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-xs sm:text-sm font-semibold">Career Journey</span>
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-indigo-600 to-pink-600 bg-clip-text text-transparent">Professional Experience</h2>
                <p class="text-gray-600 text-base sm:text-lg">Building innovative solutions and leading teams</p>
            </div>
            
            <div class="max-w-4xl mx-auto relative">
                <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gradient-to-b from-indigo-500 to-pink-500 hidden md:block"></div>
                @foreach($experiences as $experience)
                    <div class="mb-8 sm:mb-12 relative">
                        <div class="absolute left-6 w-5 h-5 bg-gradient-to-r from-indigo-500 to-pink-500 rounded-full hidden md:block transform -translate-x-2"></div>
                        <div class="md:ml-16 group">
                            <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 transform hover:-translate-y-2 border border-gray-100">
                                <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-4">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-indigo-500 to-pink-500 rounded-lg flex items-center justify-center mr-3 sm:mr-4">
                                                <i class="fas fa-briefcase text-white text-sm sm:text-base"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-2xl font-bold text-gray-800 group-hover:text-indigo-600 transition">{{ $experience->position }}</h3>
                                                <p class="text-lg font-semibold text-indigo-600">{{ $experience->company }}</p>
                                            </div>
                                        </div>
                                        @if($experience->location)
                                            <p class="text-gray-600 flex items-center mt-2"><i class="fas fa-map-marker-alt mr-2 text-pink-500"></i>{{ $experience->location }}</p>
                                        @endif
                                    </div>
                                    <span class="inline-flex items-center bg-gradient-to-r from-indigo-100 to-pink-100 text-indigo-700 px-4 py-2 rounded-full text-sm font-semibold mt-4 md:mt-0">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        {{ $experience->start_date->format('M Y') }} - {{ $experience->is_current ? 'Present' : $experience->end_date->format('M Y') }}
                                    </span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $experience->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Education Section -->
    @if($education->count() > 0 && (!isset($sectionVisibility['education']) || $sectionVisibility['education']))
    <section id="education" class="bg-gradient-to-br from-purple-50 via-white to-blue-50 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute bottom-20 left-20 w-96 h-96 bg-purple-500 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-12">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold">Academic Background</span>
                </div>
                <h2 class="text-5xl font-bold mb-4 bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">Education</h2>
                <p class="text-gray-600 text-lg">Building knowledge through academic excellence</p>
            </div>
            
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($education as $edu)
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-blue-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
                        <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 transform group-hover:-translate-y-2 border border-gray-100">
                            <div class="flex items-start mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 transform group-hover:rotate-6 transition duration-500">
                                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-1 group-hover:text-purple-600 transition">{{ $edu->degree }}</h3>
                                    @if($edu->field_of_study)
                                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-book mr-2 text-purple-500"></i>{{ $edu->field_of_study }}</p>
                                    @endif
                                    <p class="text-lg font-semibold text-purple-600 flex items-center">
                                        <i class="fas fa-university mr-2"></i>{{ $edu->institution }}
                                    </p>
                                    @if($edu->location)
                                        <p class="text-gray-600 text-sm mt-1 flex items-center">
                                            <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>{{ $edu->location }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            
                            @if($edu->grade)
                                <div class="mb-3">
                                    <span class="inline-flex items-center bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-star mr-2"></i>Grade: {{ $edu->grade }}
                                    </span>
                                </div>
                            @endif
                            
                            @if($edu->end_date)
                                <p class="text-gray-600 text-sm flex items-center">
                                    <i class="fas fa-calendar-check mr-2 text-purple-500"></i>
                                    Graduated: {{ $edu->end_date->format('M Y') }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Certifications Section -->
    @if($certifications->count() > 0 && (!isset($sectionVisibility['certifications']) || $sectionVisibility['certifications']))
    <section id="certifications" class="bg-gradient-to-br from-blue-50 via-white to-purple-50 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-10 left-10 w-72 h-72 bg-blue-500 rounded-full filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-purple-500 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-12">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold">Professional Credentials</span>
                </div>
                <h2 class="text-5xl font-bold mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Certifications</h2>
                <p class="text-gray-600 text-lg">Verified credentials and professional certifications</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($certifications as $cert)
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
                        <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 transform group-hover:-translate-y-2">
                            <div class="flex items-start mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 transform group-hover:rotate-12 transition duration-500">
                                    <i class="fas fa-certificate text-white text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-1 group-hover:text-blue-600 transition">{{ $cert->name }}</h3>
                                    <p class="text-blue-600 font-semibold text-sm flex items-center">
                                        <i class="fas fa-building mr-2"></i>{{ $cert->organization }}
                                    </p>
                                </div>
                            </div>
                            
                            @if($cert->description)
                                <p class="text-gray-600 mb-4 text-sm leading-relaxed">{{ Str::limit($cert->description, 100) }}</p>
                            @endif
                            
                            <div class="border-t border-gray-200 pt-4 mt-4">
                                <div class="flex items-center justify-between text-sm mb-3">
                                    <span class="text-gray-600 flex items-center">
                                        <i class="fas fa-calendar-check mr-2 text-blue-500"></i>
                                        {{ \Carbon\Carbon::parse($cert->issue_date)->format('M Y') }}
                                    </span>
                                    @if($cert->expiry_date)
                                        <span class="bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
                                            <i class="fas fa-clock mr-1"></i>Exp: {{ \Carbon\Carbon::parse($cert->expiry_date)->format('M Y') }}
                                        </span>
                                    @else
                                        <span class="bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            <i class="fas fa-infinity mr-1"></i>No Expiry
                                        </span>
                                    @endif
                                </div>
                                
                                @if($cert->credential_id)
                                    <p class="text-gray-500 text-xs mb-3 font-mono bg-gray-50 px-2 py-1 rounded">ID: {{ $cert->credential_id }}</p>
                                @endif
                                
                                @if($cert->credential_url)
                                    <a href="{{ $cert->credential_url }}" target="_blank" class="inline-flex items-center text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 px-4 py-2 rounded-lg text-sm font-semibold transition duration-300 transform hover:scale-105">
                                        <i class="fas fa-external-link-alt mr-2"></i>View Certificate
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Skills Section -->
    @if($skillCategories->count() > 0 && (!isset($sectionVisibility['skills']) || $sectionVisibility['skills']))
    <section id="skills" class="bg-gradient-to-br from-green-50 via-white to-teal-50 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-10 right-10 w-72 h-72 bg-green-500 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-10 left-10 w-96 h-96 bg-teal-500 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1.5s;"></div>
        </div>
        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-8 sm:mb-12">
                <div class="inline-block mb-4">
                    <span class="px-3 sm:px-4 py-2 bg-green-100 text-green-600 rounded-full text-xs sm:text-sm font-semibold">Technical Expertise</span>
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">Skills & Technologies</h2>
                <p class="text-gray-600 text-base sm:text-lg">Mastering tools and technologies for building amazing products</p>
            </div>
            
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-8">
                @foreach($skillCategories as $category)
                    <div class="bg-white rounded-2xl shadow-xl p-4 sm:p-6 md:p-8 hover:shadow-2xl transition duration-500 transform hover:-translate-y-2">
                        <div class="flex items-center mb-4 sm:mb-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-lg flex items-center justify-center mr-3 sm:mr-4">
                                <i class="fas fa-code text-white text-sm sm:text-base"></i>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent">{{ $category->name }}</h3>
                        </div>
                        
                        <div class="space-y-4 sm:space-y-5">
                            @foreach($category->skills as $skill)
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="text-sm sm:text-base text-gray-800 font-semibold flex items-center">
                                            <i class="fas fa-check-circle text-green-500 mr-2 text-xs sm:text-sm"></i>{{ $skill->name }}
                                        </span>
                                        <span class="text-sm sm:text-base text-teal-600 font-bold">{{ $skill->percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2 sm:h-3 overflow-hidden">
                                        <div class="skill-bar h-2 sm:h-3 rounded-full bg-gradient-to-r from-green-500 to-teal-600 transform transition-all duration-1000 ease-out" data-width="{{ $skill->percentage }}" style="width: 0%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Projects Section -->
    @if($projects->count() > 0 && (!isset($sectionVisibility['projects']) || $sectionVisibility['projects']))
    <section id="projects" class="bg-gradient-to-br from-orange-50 via-white to-red-50 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 left-20 w-96 h-96 bg-orange-500 rounded-full filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-72 h-72 bg-red-500 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-8 sm:mb-12">
                <div class="inline-block mb-4">
                    <span class="px-3 sm:px-4 py-2 bg-orange-100 text-orange-600 rounded-full text-xs sm:text-sm font-semibold">Portfolio Showcase</span>
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">Featured Projects</h2>
                <p class="text-gray-600 text-base sm:text-lg">Transforming ideas into impactful digital solutions</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8" id="projects-grid">
                @php
                    // Show featured projects first (max 3), then all other projects
                    $visibleProjects = $featuredProjects->count() > 0 ? $featuredProjects : $projects->take(3);
                    $hiddenProjects = $projects->diff($visibleProjects);
                @endphp
                
                @foreach($visibleProjects as $project)
                    <div class="group relative will-change-transform">
                        <div class="absolute inset-0 bg-gradient-to-r from-orange-400 to-red-500 rounded-2xl transform group-hover:scale-105 transition-transform duration-300 opacity-75 blur"></div>
                        <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 transform group-hover:-translate-y-2">
                            @if($project->image)
                                <div class="relative overflow-hidden h-56">
                                    <img 
                                        src="{{ asset('storage/' . $project->image) }}" 
                                        alt="{{ $project->title }}" 
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            @else
                                <div class="w-full h-56 bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center relative overflow-hidden">
                                    <i class="fas fa-project-diagram text-white text-6xl transform group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500"></i>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2 group-hover:text-orange-600 transition-colors duration-200">{{ $project->title }}</h3>
                                <p class="text-gray-600 mb-4 leading-relaxed line-clamp-3">{{ Str::limit($project->description, 100) }}</p>
                                
                                @if($project->technologies)
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach(is_array($project->technologies) ? $project->technologies : json_decode($project->technologies) as $tech)
                                            <span class="bg-gradient-to-r from-orange-100 to-red-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                
                                @if($project->url)
                                    <a href="{{ $project->url }}" target="_blank" class="inline-flex items-center text-white bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 px-4 py-2 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105">
                                        <i class="fas fa-external-link-alt mr-2"></i>View Project
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                
                @foreach($hiddenProjects as $project)
                    <div class="group relative will-change-transform project-item hidden" data-hidden-project>
                        <div class="absolute inset-0 bg-gradient-to-r from-orange-400 to-red-500 rounded-2xl transform group-hover:scale-105 transition-transform duration-300 opacity-75 blur"></div>
                        <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300 transform group-hover:-translate-y-2">
                            @if($project->image)
                                <div class="relative overflow-hidden h-56">
                                    <img 
                                        src="{{ asset('storage/' . $project->image) }}" 
                                        alt="{{ $project->title }}" 
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                        loading="lazy"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            @else
                                <div class="w-full h-56 bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center relative overflow-hidden">
                                    <i class="fas fa-project-diagram text-white text-6xl transform group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500"></i>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2 group-hover:text-orange-600 transition-colors duration-200">{{ $project->title }}</h3>
                                <p class="text-gray-600 mb-4 leading-relaxed line-clamp-3">{{ Str::limit($project->description, 100) }}</p>
                                
                                @if($project->technologies)
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach(is_array($project->technologies) ? $project->technologies : json_decode($project->technologies) as $tech)
                                            <span class="bg-gradient-to-r from-orange-100 to-red-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                
                                @if($project->url)
                                    <a href="{{ $project->url }}" target="_blank" class="inline-flex items-center text-white bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 px-4 py-2 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105">
                                        <i class="fas fa-external-link-alt mr-2"></i>View Project
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($projects->count() > 3)
            <div class="text-center mt-8 sm:mt-12">
                <button id="show-all-projects" class="inline-flex items-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-orange-500 to-red-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl hover:from-orange-600 hover:to-red-700 transform hover:scale-105 transition-all duration-300">
                    <span id="show-all-text">Show All Projects</span>
                    <i class="fas fa-arrow-down ml-2" id="show-all-icon"></i>
                </button>
            </div>
            @endif
        </div>
    </section>
    @endif

    <!-- Awards Section -->
    @if($awards->count() > 0 && (!isset($sectionVisibility['awards']) || $sectionVisibility['awards']))
    <section id="awards" class="bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12">Awards & Honors</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($awards as $award)
                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                        <div class="flex items-start mb-4">
                            <i class="fas fa-trophy text-yellow-600 text-3xl mr-4"></i>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800">{{ $award->title }}</h3>
                                @if($award->organization)
                                    <p class="text-yellow-700 font-medium">{{ $award->organization }}</p>
                                @endif
                            </div>
                        </div>
                        
                        @if($award->description)
                            <p class="text-gray-600 mb-4 text-sm">{{ $award->description }}</p>
                        @endif
                        
                        @if($award->date)
                            <p class="text-gray-600 text-sm">
                                <i class="fas fa-calendar mr-2"></i>{{ \Carbon\Carbon::parse($award->date)->format('M Y') }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Activities Section -->
    @if($activities->count() > 0 && (!isset($sectionVisibility['activities']) || $sectionVisibility['activities']))
    <section id="activities" class="bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12">Activities & Volunteer Work</h2>
            
            <div class="max-w-4xl mx-auto space-y-6">
                @foreach($activities as $activity)
                    <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-start flex-1">
                                <i class="fas fa-hands-helping text-green-600 text-3xl mr-4"></i>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800">{{ $activity->title }}</h3>
                                    @if($activity->organization)
                                        <p class="text-green-700 font-medium">{{ $activity->organization }}</p>
                                    @endif
                                </div>
                            </div>
                            @if($activity->is_current)
                                <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-semibold">Active</span>
                            @else
                                <span class="bg-gray-400 text-white px-3 py-1 rounded-full text-sm">Completed</span>
                            @endif
                        </div>
                        
                        @if($activity->description)
                            <p class="text-gray-600 mb-4">{{ $activity->description }}</p>
                        @endif
                        
                        <div class="text-gray-600 text-sm">
                            <i class="fas fa-calendar mr-2"></i>
                            {{ \Carbon\Carbon::parse($activity->start_date)->format('M Y') }} - 
                            @if($activity->is_current)
                                Present
                            @elseif($activity->end_date)
                                {{ \Carbon\Carbon::parse($activity->end_date)->format('M Y') }}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Blog Section -->
    @if($latestBlogs && $latestBlogs->count() > 0 && (!isset($sectionVisibility['blog']) || $sectionVisibility['blog']))
    <section id="blog" class="min-h-screen flex items-center py-20 bg-gradient-to-br from-purple-50 via-blue-50 to-pink-50">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">
                    <i class="fas fa-blog mr-3"></i>Latest Blog Posts
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Insights, tutorials, and thoughts from my latest articles
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-12" data-aos="fade-up" data-aos-delay="200">
                @foreach($latestBlogs as $blog)
                    <a href="{{ route('blog.show', $blog->slug) }}" class="group">
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-full flex flex-col">
                            @if($blog->featured_image)
                                <div class="h-56 overflow-hidden">
                                    <img src="{{ asset($blog->featured_image) }}" 
                                         alt="{{ $blog->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @else
                                <div class="h-56 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                    <i class="fas fa-blog text-8xl text-white/30"></i>
                                </div>
                            @endif
                            
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full" 
                                          style="background: {{ $blog->category->color }}20; color: {{ $blog->category->color }}">
                                        <i class="{{ $blog->category->icon }} mr-1"></i>{{ $blog->category->name }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        <i class="far fa-calendar mr-1"></i>{{ $blog->published_at->format('M d, Y') }}
                                    </span>
                                </div>
                                
                                <h3 class="text-xl font-bold mb-3 group-hover:text-primary transition line-clamp-2">
                                    {{ $blog->title }}
                                </h3>
                                
                                <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-3">
                                    {{ Str::limit(strip_tags($blog->content), 120) }}
                                </p>
                                
                                <div class="flex items-center justify-between text-sm text-gray-500 pt-4 border-t">
                                    <span><i class="fas fa-eye mr-1"></i>{{ $blog->views }}</span>
                                    <span><i class="fas fa-heart mr-1"></i>{{ $blog->likes_count }}</span>
                                    <span><i class="fas fa-comments mr-1"></i>{{ $blog->comments_count }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <a href="/blog" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full font-semibold hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <span>View All Blog Posts</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Contact Section -->
    <section id="contact" class="gradient-bg text-white">
        <div class="container mx-auto px-4 sm:px-6">
            <h2 class="text-3xl sm:text-4xl font-bold text-center mb-8 sm:mb-12">Get In Touch</h2>
            
            <div class="max-w-2xl mx-auto">
                @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-6 flex items-center animate-fade-in">
                        <i class="fas fa-check-circle text-xl sm:text-2xl mr-3"></i>
                        <div>
                            <p class="font-semibold text-sm sm:text-base">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                        <p class="font-semibold mb-2 text-sm sm:text-base"><i class="fas fa-exclamation-circle mr-2"></i>Please fix the following errors:</p>
                        <ul class="list-disc list-inside text-sm sm:text-base">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('contact.store') }}" method="POST" class="bg-white/10 backdrop-blur-lg p-4 sm:p-6 md:p-8 rounded-lg">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">
                        <div>
                            <label class="block text-white mb-2 text-sm sm:text-base">Full Name</label>
                            <input type="text" name="name" required inputmode="text" autocomplete="name" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white text-sm sm:text-base" placeholder="Your Name">
                        </div>
                        <div>
                            <label class="block text-white mb-2 text-sm sm:text-base">Email Address</label>
                            <input type="email" name="email" required inputmode="email" autocomplete="email" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white text-sm sm:text-base" placeholder="your@email.com">
                        </div>
                    </div>
                    
                    <div class="mb-4 sm:mb-6">
                        <label class="block text-white mb-2 text-sm sm:text-base">Subject</label>
                        <input type="text" name="subject" inputmode="text" autocomplete="off" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white text-sm sm:text-base" placeholder="Subject">
                    </div>
                    
                    <div class="mb-4 sm:mb-6">
                        <label class="block text-white mb-2 text-sm sm:text-base">Message</label>
                        <textarea name="message" required rows="5" inputmode="text" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg bg-white/20 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white text-sm sm:text-base" placeholder="Your message..."></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-white text-blue-600 px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-semibold hover:shadow-lg transition text-sm sm:text-base">
                        Send Message <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 sm:py-8">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <p class="text-sm sm:text-base">&copy; {{ date('Y') }} {{ $about->name ?? 'Portfolio' }}. All Rights Reserved.</p>
            @if($about && ($about->facebook || $about->twitter || $about->linkedin || $about->github || $about->instagram || $about->youtube))
            <div class="flex justify-center flex-wrap space-x-4 sm:space-x-6 mt-4">
                @if($about->facebook)
                    <a href="{{ $about->facebook }}" target="_blank" class="text-white hover:text-primary transition" title="Facebook">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                @endif
                @if($about->twitter)
                    <a href="{{ $about->twitter }}" target="_blank" class="text-white hover:text-primary transition" title="Twitter">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                @endif
                @if($about->linkedin)
                    <a href="{{ $about->linkedin }}" target="_blank" class="text-white hover:text-primary transition" title="LinkedIn">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                @endif
                @if($about->github)
                    <a href="{{ $about->github }}" target="_blank" class="text-white hover:text-primary transition" title="GitHub">
                        <i class="fab fa-github text-xl"></i>
                    </a>
                @endif
                @if($about->instagram)
                    <a href="{{ $about->instagram }}" target="_blank" class="text-white hover:text-primary transition" title="Instagram">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                @endif
                @if($about->youtube)
                    <a href="{{ $about->youtube }}" target="_blank" class="text-white hover:text-primary transition" title="YouTube">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                @endif
            </div>
            @endif
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button 
        id="back-to-top" 
        class="fixed bottom-4 right-4 sm:bottom-8 sm:right-8 bg-gradient-to-r from-purple-600 to-blue-600 text-white w-12 h-12 sm:w-14 sm:h-14 rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-300 opacity-0 invisible z-50 flex items-center justify-center group"
        aria-label="Back to top"
    >
        <i class="fas fa-arrow-up text-xl group-hover:animate-bounce"></i>
    </button>

    <script>
        // Preloader
        @php
            $enablePreloader = $settings->where('key', 'enable_preloader')->first()->value ?? '1';
        @endphp
        @if($enablePreloader == '1')
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                setTimeout(() => {
                    preloader.classList.add('hide');
                }, 1000);
            }
        });
        @endif
        
        // Scroll to contact section if redirected after form submission
        @if(session('scroll_to'))
        window.addEventListener('load', function() {
            setTimeout(() => {
                const element = document.getElementById('{{ session('scroll_to') }}');
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }, 500);
        });
        @endif
        
        // Animate skill bars
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const skillBars = entry.target.querySelectorAll('.skill-bar');
                    skillBars.forEach(bar => {
                        const width = bar.getAttribute('data-width');
                        setTimeout(() => {
                            bar.style.width = width + '%';
                        }, 100);
                    });
                    // Unobserve after animation
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        const skillsSection = document.getElementById('skills');
        if (skillsSection) {
            observer.observe(skillsSection);
        }
        
        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
        const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');
        
        function openMobileMenu() {
            mobileMenu.classList.add('active');
            mobileMenuBackdrop.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Animate menu items
            mobileMenuLinks.forEach((link, index) => {
                link.style.animationDelay = `${index * 0.1}s`;
                link.classList.add('menu-item-animation');
            });
        }
        
        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            mobileMenuBackdrop.classList.remove('active');
            document.body.style.overflow = '';
            
            // Reset animations
            mobileMenuLinks.forEach(link => {
                link.classList.remove('menu-item-animation');
                link.style.animationDelay = '';
            });
        }
        
        mobileMenuButton?.addEventListener('click', openMobileMenu);
        mobileMenuClose?.addEventListener('click', closeMobileMenu);
        mobileMenuBackdrop?.addEventListener('click', closeMobileMenu);
        
        // Close menu when clicking on a link
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                closeMobileMenu();
            });
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Back to Top Button
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Show All Projects Button
        const showAllButton = document.getElementById('show-all-projects');
        const hiddenProjects = document.querySelectorAll('[data-hidden-project]');
        let allProjectsVisible = false;

        if (showAllButton) {
            showAllButton.addEventListener('click', function() {
                allProjectsVisible = !allProjectsVisible;
                const buttonText = document.getElementById('show-all-text');
                const buttonIcon = document.getElementById('show-all-icon');
                
                if (allProjectsVisible) {
                    // Show all projects
                    hiddenProjects.forEach((project, index) => {
                        setTimeout(() => {
                            project.classList.remove('hidden');
                            project.style.animation = 'fadeIn 0.5s ease-in-out';
                        }, index * 100);
                    });
                    buttonText.textContent = 'Show Less';
                    buttonIcon.classList.remove('fa-arrow-down');
                    buttonIcon.classList.add('fa-arrow-up');
                } else {
                    // Hide extra projects
                    hiddenProjects.forEach(project => {
                        project.classList.add('hidden');
                    });
                    buttonText.textContent = 'Show All Projects';
                    buttonIcon.classList.remove('fa-arrow-up');
                    buttonIcon.classList.add('fa-arrow-down');
                    
                    // Scroll to projects section
                    document.getElementById('projects')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        }
    </script>
</body>
</html>
