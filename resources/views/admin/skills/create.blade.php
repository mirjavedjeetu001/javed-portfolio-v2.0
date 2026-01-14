@extends('admin.layout')

@section('title', 'Add Skill')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                Add New Skill
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Add a new technical or professional skill</p>
        </div>
    </div>
</div>

<div class="max-w-4xl">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-teal-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-green-50 to-teal-50 px-8 py-6 border-b border-green-100">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-cogs text-green-600 mr-3"></i>
                    Skill Information
                </h3>
            </div>
            
            <form action="{{ route('admin.skills.store') }}" method="POST" class="p-8">
                @csrf
                
                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-folder text-green-600 mr-2"></i>Category *
                    </label>
                    <select class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition @error('category_id') border-red-500 @enderror" 
                            id="category_id" 
                            name="category_id" 
                            required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>If you don't see the category you need, it will be created automatically when you upload your resume.
                    </p>
                </div>

                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-tag text-green-600 mr-2"></i>Skill Name *
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition @error('name') border-red-500 @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required
                           placeholder="e.g., JavaScript, Project Management, etc.">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="percentage" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-chart-line text-green-600 mr-2"></i>Percentage Level * (0-100)
                    </label>
                    <input type="range" 
                           class="w-full h-3 bg-green-100 rounded-lg appearance-none cursor-pointer" 
                           id="percentage" 
                           name="percentage" 
                           min="0" 
                           max="100" 
                           value="{{ old('percentage', 50) }}" 
                           oninput="document.getElementById('percentageValue').textContent = this.value + '%'">
                    <div class="text-center mt-3">
                        <span class="inline-block bg-gradient-to-r from-green-600 to-teal-600 text-white px-6 py-2 rounded-xl font-bold text-lg" id="percentageValue">{{ old('percentage', 50) }}%</span>
                    </div>
                    @error('percentage')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="years_experience" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-calendar text-green-600 mr-2"></i>Years of Experience
                    </label>
                    <input type="number" 
                           class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition @error('years_experience') border-red-500 @enderror" 
                           id="years_experience" 
                           name="years_experience" 
                           value="{{ old('years_experience') }}" 
                           min="0" 
                           step="0.5" 
                           placeholder="e.g., 3">
                    @error('years_experience')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="icon" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-icons text-green-600 mr-2"></i>Icon Class (Font Awesome)
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition @error('icon') border-red-500 @enderror" 
                           id="icon" 
                           name="icon" 
                           value="{{ old('icon') }}" 
                           placeholder="e.g., fab fa-js, fas fa-code">
                    @error('icon')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>Find icons at <a href="https://fontawesome.com/icons" target="_blank" class="text-green-600 hover:text-green-700 underline">fontawesome.com</a>
                    </p>
                    <div id="iconPreview" class="mt-3 p-4 bg-green-50 rounded-xl border-2 border-green-200 text-center">
                        <!-- Icon preview will appear here -->
                    </div>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.skills.index') }}" class="group relative">
                        <div class="absolute inset-0 bg-gray-400 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i>Back
                        </div>
                    </a>
                    <button type="submit" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-save mr-2"></i>Save Skill
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('icon').addEventListener('input', function() {
    const iconPreview = document.getElementById('iconPreview');
    if (this.value) {
        iconPreview.innerHTML = `<i class="${this.value} fa-3x text-green-600"></i>`;
    } else {
        iconPreview.innerHTML = '<span class="text-gray-400 text-sm">Icon preview will appear here</span>';
    }
});
</script>
@endsection
