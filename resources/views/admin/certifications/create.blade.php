@extends('admin.layout')

@section('title', 'Add Certification')

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
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                Add New Certification
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Create a new professional certification entry</p>
        </div>
    </div>
</div>

<div class="max-w-4xl">
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-blue-100">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-certificate text-blue-600 mr-3"></i>
                    Certification Information
                </h3>
            </div>
            
            <form action="{{ route('admin.certifications.store') }}" method="POST" class="p-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-award text-blue-600 mr-2"></i>Certification Name *
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('name') border-red-500 @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required
                               placeholder="e.g., AWS Certified Solutions Architect">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="organization" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-building text-blue-600 mr-2"></i>Issuing Organization *
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('organization') border-red-500 @enderror" 
                               id="organization" 
                               name="organization" 
                               value="{{ old('organization') }}" 
                               required
                               placeholder="e.g., Amazon Web Services">
                        @error('organization')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="issue_date" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>Issue Date *
                        </label>
                        <input type="date" 
                               class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('issue_date') border-red-500 @enderror" 
                               id="issue_date" 
                               name="issue_date" 
                               value="{{ old('issue_date') }}" 
                               required>
                        @error('issue_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="expiry_date" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-calendar-check text-blue-600 mr-2"></i>Expiry Date
                        </label>
                        <input type="date" 
                               class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('expiry_date') border-red-500 @enderror" 
                               id="expiry_date" 
                               name="expiry_date" 
                               value="{{ old('expiry_date') }}">
                        @error('expiry_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1 flex items-center">
                            <i class="fas fa-info-circle mr-1"></i>Leave blank if no expiration
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="credential_id" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-id-card text-blue-600 mr-2"></i>Credential ID
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('credential_id') border-red-500 @enderror" 
                               id="credential_id" 
                               name="credential_id" 
                               value="{{ old('credential_id') }}"
                               placeholder="e.g., ABC123XYZ">
                        @error('credential_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="credential_url" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-link text-blue-600 mr-2"></i>Credential URL
                        </label>
                        <input type="url" 
                               class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('credential_url') border-red-500 @enderror" 
                               id="credential_url" 
                               name="credential_url" 
                               value="{{ old('credential_url') }}"
                               placeholder="https://example.com/verify/abc123">
                        @error('credential_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-blue-600 mr-2"></i>Description
                    </label>
                    <textarea class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('description') border-red-500 @enderror" 
                              id="description" 
                              name="description" 
                              rows="4"
                              placeholder="Skills and competencies covered in this certification...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="order" class="block text-sm font-bold text-gray-700 mb-2">
                        <i class="fas fa-sort text-blue-600 mr-2"></i>Display Order
                    </label>
                    <input type="number" 
                           class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition @error('order') border-red-500 @enderror" 
                           id="order" 
                           name="order" 
                           value="{{ old('order', 0) }}"
                           placeholder="0">
                    @error('order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.certifications.index') }}" class="group relative">
                        <div class="absolute inset-0 bg-gray-400 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i>Back
                        </div>
                    </a>
                    <button type="submit" class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-xl blur group-hover:blur-lg transition"></div>
                        <div class="relative bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                            <i class="fas fa-save mr-2"></i>Create Certification
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
