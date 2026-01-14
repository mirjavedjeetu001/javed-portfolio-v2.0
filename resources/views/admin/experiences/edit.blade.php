@extends('admin.layout')

@section('title', 'Edit Experience')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                Edit Experience
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Update professional work experience details</p>
        </div>
    </div>
</div>

<div class="max-w-4xl">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-400 to-pink-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-indigo-50 to-pink-50 px-8 py-6 border-b border-indigo-100">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-briefcase text-indigo-600 mr-3"></i>
                    Experience Information
                </h3>
            </div>
            
            <form action="{{ route('admin.experiences.update', $experience) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="job_title" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-user-tie text-indigo-600 mr-2"></i>Job Title *
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border-2 border-indigo-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition @error('job_title') border-red-500 @enderror" 
                               id="job_title" 
                               name="job_title" 
                               value="{{ old('job_title', $experience->job_title) }}" 
                               required>
                        @error('job_title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="company" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-building text-indigo-600 mr-2"></i>Company *
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border-2 border-indigo-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition @error('company') border-red-500 @enderror" 
                               id="company" 
                               name="company" 
                               value="{{ old('company', $experience->company) }}" 
                               required>
                        @error('company')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="location" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-indigo-600 mr-2"></i>Location
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-indigo-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition @error('location') border-red-500 @enderror" 
                           id="location" 
                           name="location" 
                           value="{{ old('location', $experience->location) }}" 
                           placeholder="e.g., New York, NY">
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="start_date" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i>Start Date *
                        </label>
                        <input type="date" 
                               class="w-full px-4 py-3 border-2 border-indigo-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition @error('start_date') border-red-500 @enderror" 
                               id="start_date" 
                               name="start_date" 
                               value="{{ old('start_date', $experience->start_date) }}" 
                               required>
                        @error('start_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="end_date" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-calendar-check text-indigo-600 mr-2"></i>End Date
                        </label>
                        <input type="date" 
                               class="w-full px-4 py-3 border-2 border-indigo-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition @error('end_date') border-red-500 @enderror" 
                               id="end_date" 
                               name="end_date" 
                               value="{{ old('end_date', $experience->end_date) }}" 
                               {{ $experience->is_current ? 'disabled' : '' }}>
                        @error('end_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex items-center">
                        <input class="w-5 h-5 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2" 
                               type="checkbox" 
                               id="is_current" 
                               name="is_current" 
                               value="1" 
                               {{ old('is_current', $experience->is_current) ? 'checked' : '' }}>
                        <label class="ml-3 text-sm font-bold text-gray-700 flex items-center" for="is_current">
                            <i class="fas fa-check-circle text-indigo-600 mr-2"></i>I currently work here
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-indigo-600 mr-2"></i>Job Description
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-indigo-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition @error('description') border-red-500 @enderror" 
                              id="description" 
                              name="description" 
                              rows="3">{{ old('description', $experience->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="responsibilities" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-tasks text-indigo-600 mr-2"></i>Key Responsibilities
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-indigo-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition @error('responsibilities') border-red-500 @enderror" 
                              id="responsibilities" 
                              name="responsibilities" 
                              rows="4" 
                              placeholder="Enter each responsibility on a new line">{{ old('responsibilities', $experience->responsibilities) }}</textarea>
                    @error('responsibilities')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="achievements" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-trophy text-indigo-600 mr-2"></i>Achievements
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-indigo-200 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 transition @error('achievements') border-red-500 @enderror" 
                              id="achievements" 
                              name="achievements" 
                              rows="4"
                              placeholder="Enter each achievement on a new line">{{ old('achievements', $experience->achievements) }}</textarea>
                    @error('achievements')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.experiences.index') }}" class="group relative">
                        <div class="absolute inset-0 bg-gray-400 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i>Back
                        </div>
                    </a>
                    <button type="submit" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-pink-500 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-indigo-600 to-pink-600 hover:from-indigo-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-save mr-2"></i>Update Experience
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('is_current').addEventListener('change', function() {
    const endDateInput = document.getElementById('end_date');
    if (this.checked) {
        endDateInput.disabled = true;
        endDateInput.value = '';
    } else {
        endDateInput.disabled = false;
    }
});
</script>
@endsection
