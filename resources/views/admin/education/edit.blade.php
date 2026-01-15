@extends('admin.layout')

@section('title', 'Edit Education')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                Edit Education Entry
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Update educational qualification details</p>
        </div>
    </div>
</div>

<div class="max-w-4xl">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-8 py-6 border-b border-purple-100">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-graduation-cap text-purple-600 mr-3"></i>
                    Education Information
                </h3>
            </div>
            
            <form action="{{ route('admin.education.update', $education) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="degree" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-certificate text-purple-600 mr-2"></i>Degree/Certification *
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('degree') border-red-500 @enderror" 
                               id="degree" 
                               name="degree" 
                               value="{{ old('degree', $education->degree) }}" 
                               required
                               placeholder="e.g., Bachelor of Science">
                        @error('degree')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="field_of_study" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-book text-purple-600 mr-2"></i>Field of Study
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('field_of_study') border-red-500 @enderror" 
                               id="field_of_study" 
                               name="field_of_study" 
                               value="{{ old('field_of_study', $education->field_of_study) }}"
                               placeholder="e.g., Computer Science">
                        @error('field_of_study')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="institution" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-university text-purple-600 mr-2"></i>Institution *
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('institution') border-red-500 @enderror" 
                           id="institution" 
                           name="institution" 
                           value="{{ old('institution', $education->institution) }}" 
                           required
                           placeholder="e.g., University of XYZ">
                    @error('institution')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="location" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-purple-600 mr-2"></i>Location
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('location') border-red-500 @enderror" 
                           id="location" 
                           name="location" 
                           value="{{ old('location', $education->location) }}"
                           placeholder="e.g., Savar, Dhaka">
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="start_date" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-purple-600 mr-2"></i>Start Date *
                        </label>
                        <input type="date" 
                               class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('start_date') border-red-500 @enderror" 
                               id="start_date" 
                               name="start_date" 
                               value="{{ old('start_date', $education->start_date ? $education->start_date->format('Y-m-d') : '') }}" 
                               required>
                        @error('start_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="end_date" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-calendar-check text-purple-600 mr-2"></i>End Date
                        </label>
                        <input type="date" 
                               class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('end_date') border-red-500 @enderror" 
                               id="end_date" 
                               name="end_date" 
                               value="{{ old('end_date', $education->end_date ? $education->end_date->format('Y-m-d') : '') }}">
                        @error('end_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-info-circle mr-1"></i>Leave blank if currently studying
                        </p>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="grade" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-trophy text-purple-600 mr-2"></i>Grade/GPA
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('grade') border-red-500 @enderror" 
                           id="grade" 
                           name="grade" 
                           value="{{ old('grade', $education->grade) }}"
                           placeholder="CGPA: 2.85/4.00">
                    @error('grade')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-purple-600 mr-2"></i>Description
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('description') border-red-500 @enderror" 
                              id="description" 
                              name="description" 
                              rows="4"
                              placeholder="Key courses, projects, achievements, etc.">{{ old('description', $education->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.education.index') }}" class="group relative">
                        <div class="absolute inset-0 bg-gray-400 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i>Back
                        </div>
                    </a>
                    <button type="submit" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-save mr-2"></i>Update Education
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
