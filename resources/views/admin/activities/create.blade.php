@extends('admin.layout')

@section('title', 'Add Activity')

@section('content')
<div class="mb-6">
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <h4 class="font-bold mb-2">Please fix the following errors:</h4>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                Add New Activity
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Create a new extracurricular activity entry</p>
        </div>
    </div>
</div>

<div class="max-w-4xl">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-8 py-6 border-b border-purple-100">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-running text-purple-600 mr-3"></i>
                    Activity Information
                </h3>
            </div>
            
            <form action="{{ route('admin.activities.store') }}" method="POST" class="p-8">
                @csrf
                
                <div class="mb-6">
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-tasks text-purple-600 mr-2"></i>Activity Title *
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('title') border-red-500 @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
                           required
                           placeholder="e.g., Volunteer Coordinator">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="organization" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-building text-purple-600 mr-2"></i>Organization *
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('organization') border-red-500 @enderror" 
                           id="organization" 
                           name="organization" 
                           value="{{ old('organization') }}" 
                           required
                           placeholder="e.g., Red Cross Society">
                    @error('organization')
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
                               value="{{ old('start_date') }}" 
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
                               value="{{ old('end_date') }}">
                        @error('end_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               class="w-5 h-5 text-purple-600 border-2 border-purple-300 rounded focus:ring-4 focus:ring-purple-200 transition @error('is_current') border-red-500 @enderror" 
                               id="is_current" 
                               name="is_current" 
                               value="1"
                               {{ old('is_current') ? 'checked' : '' }}>
                        <span class="ml-3 text-sm font-bold text-gray-700">
                            <i class="fas fa-clock text-purple-600 mr-2"></i>Currently Active
                        </span>
                    </label>
                    @error('is_current')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1 ml-8 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>Check if still participating in this activity
                    </p>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-purple-600 mr-2"></i>Description
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('description') border-red-500 @enderror" 
                              id="description" 
                              name="description" 
                              rows="4"
                              placeholder="Responsibilities, achievements, and contributions...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="order" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-sort text-purple-600 mr-2"></i>Display Order
                    </label>
                    <input type="number" 
                           class="w-full px-4 py-3 border-2 border-purple-200 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition @error('order') border-red-500 @enderror" 
                           id="order" 
                           name="order" 
                           value="{{ old('order', 0) }}"
                           placeholder="0">
                    @error('order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.activities.index') }}" class="group relative">
                        <div class="absolute inset-0 bg-gray-400 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i>Back
                        </div>
                    </a>
                    <button type="submit" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-save mr-2"></i>Create Activity
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
