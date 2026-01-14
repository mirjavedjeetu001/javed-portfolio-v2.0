@extends('admin.layout')

@section('title', 'Add Award')

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
                <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                Add New Award
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Create a new award or recognition entry</p>
        </div>
    </div>
</div>

<div class="max-w-4xl">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 px-8 py-6 border-b border-yellow-100">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-trophy text-yellow-600 mr-3"></i>
                    Award Information
                </h3>
            </div>
            
            <form action="{{ route('admin.awards.store') }}" method="POST" class="p-8">
                @csrf
                
                <div class="mb-6">
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-award text-yellow-600 mr-2"></i>Award Title *
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-yellow-200 rounded-xl focus:ring-4 focus:ring-yellow-200 focus:border-yellow-500 transition @error('title') border-red-500 @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
                           required
                           placeholder="e.g., Best Innovation Award">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="organization" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-building text-yellow-600 mr-2"></i>Awarding Organization *
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-yellow-200 rounded-xl focus:ring-4 focus:ring-yellow-200 focus:border-yellow-500 transition @error('organization') border-red-500 @enderror" 
                           id="organization" 
                           name="organization" 
                           value="{{ old('organization') }}" 
                           required
                           placeholder="e.g., XYZ Competition Committee">
                    @error('organization')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="date" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt text-yellow-600 mr-2"></i>Award Date *
                    </label>
                    <input type="date" 
                           class="w-full px-4 py-3 border-2 border-yellow-200 rounded-xl focus:ring-4 focus:ring-yellow-200 focus:border-yellow-500 transition @error('date') border-red-500 @enderror" 
                           id="date" 
                           name="date" 
                           value="{{ old('date') }}" 
                           required>
                    @error('date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-yellow-600 mr-2"></i>Description
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-yellow-200 rounded-xl focus:ring-4 focus:ring-yellow-200 focus:border-yellow-500 transition @error('description') border-red-500 @enderror" 
                              id="description" 
                              name="description" 
                              rows="4"
                              placeholder="Details about the award, achievement, or recognition...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="order" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-sort text-yellow-600 mr-2"></i>Display Order
                    </label>
                    <input type="number" 
                           class="w-full px-4 py-3 border-2 border-yellow-200 rounded-xl focus:ring-4 focus:ring-yellow-200 focus:border-yellow-500 transition @error('order') border-red-500 @enderror" 
                           id="order" 
                           name="order" 
                           value="{{ old('order', 0) }}"
                           placeholder="0">
                    @error('order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.awards.index') }}" class="group relative">
                        <div class="absolute inset-0 bg-gray-400 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i>Back
                        </div>
                    </a>
                    <button type="submit" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-yellow-600 to-orange-600 hover:from-yellow-700 hover:to-orange-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-save mr-2"></i>Create Award
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
