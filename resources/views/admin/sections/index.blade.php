@extends('admin.layout')

@section('title', 'Section Visibility')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-eye text-white text-xl"></i>
                </div>
                Section Visibility
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Control which sections appear on your portfolio</p>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-2xl mr-3"></i>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    </div>
@endif

@if($sections->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($sections as $section)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
            <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-{{ $section->is_visible ? 'green' : 'gray' }}-500 to-{{ $section->is_visible ? 'emerald' : 'gray' }}-600 rounded-xl flex items-center justify-center transform group-hover:rotate-12 transition duration-500">
                        <i class="fas fa-{{ $section->is_visible ? 'eye' : 'eye-slash' }} text-white text-xl"></i>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" {{ $section->is_visible ? 'checked' : '' }}
                            onchange="document.getElementById('toggle-{{ $section->id }}').submit()">
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-green-600 peer-checked:to-emerald-600"></div>
                    </label>
                </div>
                
                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-600 transition">{{ $section->section_name }}</h3>
                <p class="text-gray-500 text-sm mb-3 flex items-center">
                    <i class="fas fa-hashtag mr-2 text-emerald-500"></i>{{ $section->section_id }}
                </p>
                
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                        <i class="fas fa-sort mr-1"></i>Order: {{ $section->order }}
                    </span>
                    @if($section->is_visible)
                        <span class="inline-flex items-center bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-eye mr-1"></i>Visible
                        </span>
                    @else
                        <span class="inline-flex items-center bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-eye-slash mr-1"></i>Hidden
                        </span>
                    @endif
                </div>
                
                <form id="toggle-{{ $section->id }}" action="{{ route('admin.sections.toggle', $section) }}" method="POST" class="hidden">
                    @csrf
                    @method('PATCH')
                </form>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-r from-green-100 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-eye-slash text-green-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Sections Configured</h3>
        <p class="text-gray-600">Section visibility settings will appear here</p>
    </div>
@endif
@endsection
