@extends('admin.layout')

@section('title', 'About Section')
@section('page-title', 'About Me Management')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-user text-white text-xl"></i>
                </div>
                About Me Management
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Manage your personal information and portfolio details</p>
        </div>
        @if(!$about)
            <a href="{{ route('admin.about.create') }}" class="group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-xl blur group-hover:blur-lg transition"></div>
                <div class="relative bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl transition flex items-center">
                    <i class="fas fa-plus mr-2"></i>Create About Section
                </div>
            </a>
        @endif
    </div>
</div>

<div class="max-w-5xl mx-auto">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-indigo-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 overflow-hidden">
        
        @if($about)
            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-8 py-6 border-b border-purple-100">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-user-edit text-purple-600 mr-3"></i>
                    Personal Information
                </h3>
                <p class="text-gray-600 mt-1">Update your portfolio details and statistics</p>
            </div>
            
            <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-signature text-purple-500 mr-2"></i>Full Name *
                        </label>
                        <input type="text" name="name" value="{{ old('name', $about->name) }}" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition duration-300 group-hover:border-purple-300">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-briefcase text-indigo-500 mr-2"></i>Professional Title *
                        </label>
                        <input type="text" name="title" value="{{ old('title', $about->title) }}" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition duration-300 group-hover:border-indigo-300">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-6 group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-pen-fancy text-purple-500 mr-2"></i>Biography *
                    </label>
                    <textarea name="bio" required rows="5" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition duration-300 group-hover:border-purple-300 resize-none">{{ old('bio', $about->bio) }}</textarea>
                    @error('bio')
                        <p class="mt-1 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-envelope text-blue-500 mr-2"></i>Email
                        </label>
                        <input type="email" name="email" value="{{ old('email', $about->email) }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition duration-300 group-hover:border-blue-300">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-phone text-green-500 mr-2"></i>Phone
                        </label>
                        <input type="text" name="phone" value="{{ old('phone', $about->phone) }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition duration-300 group-hover:border-green-300">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-6 group">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>Address
                    </label>
                    <input type="text" name="address" value="{{ old('address', $about->address) }}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-red-200 focus:border-red-500 transition duration-300 group-hover:border-red-300">
                    @error('address')
                        <p class="mt-1 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6 p-6 bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl border-2 border-purple-100">
                    <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                        <i class="fas fa-image text-purple-600 mr-2"></i>Profile Image
                    </label>
                    @if($about->image)
                        <div class="mb-4 flex justify-center">
                            <div class="group relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl transform group-hover:scale-105 transition duration-300 blur"></div>
                                <img src="{{ asset('storage/' . $about->image) }}" alt="Current Image" class="relative w-32 h-32 object-cover rounded-2xl shadow-lg">
                            </div>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition duration-300 bg-white">
                    <p class="mt-2 text-sm text-gray-600 flex items-center"><i class="fas fa-info-circle text-purple-500 mr-2"></i>Upload a new image (max 2MB)</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="border-t-2 border-gray-100 pt-8 mb-6">
                    <h4 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        Portfolio Statistics
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="group">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl border-2 border-blue-200 hover:border-blue-400 transition duration-300">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-clock text-blue-600 mr-2"></i>Years Experience
                                </label>
                                <input type="number" name="years_experience" value="{{ old('years_experience', $about->years_experience) }}" class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition duration-300">
                            </div>
                        </div>
                        
                        <div class="group">
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl border-2 border-green-200 hover:border-green-400 transition duration-300">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-project-diagram text-green-600 mr-2"></i>Projects Completed
                                </label>
                                <input type="number" name="projects_completed" value="{{ old('projects_completed', $about->projects_completed) }}" class="w-full px-4 py-3 border-2 border-green-200 rounded-lg focus:ring-4 focus:ring-green-200 focus:border-green-500 transition duration-300">
                            </div>
                        </div>
                        
                        <div class="group">
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border-2 border-purple-200 hover:border-purple-400 transition duration-300">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-code text-purple-600 mr-2"></i>Technologies Used
                                </label>
                                <input type="number" name="technologies_used" value="{{ old('technologies_used', $about->technologies_used) }}" class="w-full px-4 py-3 border-2 border-purple-200 rounded-lg focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition duration-300">
                            </div>
                        </div>
                        
                        <div class="group">
                            <div class="bg-gradient-to-br from-pink-50 to-pink-100 p-4 rounded-xl border-2 border-pink-200 hover:border-pink-400 transition duration-300">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-globe text-pink-600 mr-2"></i>Countries Visited
                                </label>
                                <input type="number" name="countries_visited" value="{{ old('countries_visited', $about->countries_visited) }}" class="w-full px-4 py-3 border-2 border-pink-200 rounded-lg focus:ring-4 focus:ring-pink-200 focus:border-pink-500 transition duration-300">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border-t-2 border-gray-100 pt-8 mb-6">
                    <h4 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-rose-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-share-alt text-white"></i>
                        </div>
                        Social Media Links
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="group">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl border-2 border-blue-200 hover:border-blue-400 transition duration-300">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook URL
                                </label>
                                <input type="url" name="facebook" value="{{ old('facebook', $about->facebook) }}" placeholder="https://facebook.com/username" class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition duration-300">
                            </div>
                        </div>
                        
                        <div class="group">
                            <div class="bg-gradient-to-br from-sky-50 to-sky-100 p-4 rounded-xl border-2 border-sky-200 hover:border-sky-400 transition duration-300">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fab fa-twitter text-sky-600 mr-2"></i>Twitter URL
                                </label>
                                <input type="url" name="twitter" value="{{ old('twitter', $about->twitter) }}" placeholder="https://twitter.com/username" class="w-full px-4 py-3 border-2 border-sky-200 rounded-lg focus:ring-4 focus:ring-sky-200 focus:border-sky-500 transition duration-300">
                            </div>
                        </div>
                        
                        <div class="group">
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-4 rounded-xl border-2 border-blue-300 hover:border-indigo-400 transition duration-300">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fab fa-linkedin text-blue-700 mr-2"></i>LinkedIn URL
                                </label>
                                <input type="url" name="linkedin" value="{{ old('linkedin', $about->linkedin) }}" placeholder="https://linkedin.com/in/username" class="w-full px-4 py-3 border-2 border-blue-300 rounded-lg focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition duration-300">
                            </div>
                        </div>
                        
                        <div class="group">
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-xl border-2 border-gray-300 hover:border-gray-400 transition duration-300">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fab fa-github text-gray-800 mr-2"></i>GitHub URL
                                </label>
                                <input type="url" name="github" value="{{ old('github', $about->github) }}" placeholder="https://github.com/username" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-4 focus:ring-gray-200 focus:border-gray-500 transition duration-300">
                            </div>
                        </div>
                        
                        <div class="group">
                            <div class="bg-gradient-to-br from-pink-50 to-rose-100 p-4 rounded-xl border-2 border-pink-200 hover:border-pink-400 transition duration-300">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fab fa-instagram text-pink-600 mr-2"></i>Instagram URL
                                </label>
                                <input type="url" name="instagram" value="{{ old('instagram', $about->instagram) }}" placeholder="https://instagram.com/username" class="w-full px-4 py-3 border-2 border-pink-200 rounded-lg focus:ring-4 focus:ring-pink-200 focus:border-pink-500 transition duration-300">
                            </div>
                        </div>
                        
                        <div class="group">
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-xl border-2 border-red-200 hover:border-red-400 transition duration-300">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                    <i class="fab fa-youtube text-red-600 mr-2"></i>YouTube URL
                                </label>
                                <input type="url" name="youtube" value="{{ old('youtube', $about->youtube) }}" placeholder="https://youtube.com/@username" class="w-full px-4 py-3 border-2 border-red-200 rounded-lg focus:ring-4 focus:ring-red-200 focus:border-red-500 transition duration-300">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4">
                    <button type="submit" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-8 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </div>
                    </button>
                </div>
            </form>
        @else
            <div class="p-16 text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-purple-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-user-circle text-purple-600 text-6xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">No About Section Created</h3>
                <p class="text-gray-600 mb-6">Create your about section to display personal information on your portfolio</p>
                <a href="{{ route('admin.about.create') }}" class="group inline-block relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-xl blur group-hover:blur-lg transition"></div>
                    <div class="relative bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-8 py-4 rounded-xl transition flex items-center">
                        <i class="fas fa-plus mr-2"></i>Create About Section
                    </div>
                </a>
            </div>
        @endif
    </div>
</div>
</div>
@endsection
