@extends('admin.layout')

@section('title', 'Menu Management')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-bars text-white text-xl"></i>
                </div>
                Navigation Menu
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Manage your website navigation menu items</p>
        </div>
        <button onclick="document.getElementById('addMenuModal').classList.remove('hidden')" 
                class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Add Menu Item
        </button>
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

@if($menuItems->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($menuItems as $item)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
            <div class="relative bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center transform group-hover:rotate-12 transition duration-500">
                        <i class="fas fa-link text-white text-xl"></i>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" {{ $item->is_visible ? 'checked' : '' }}
                            onchange="document.getElementById('toggle-{{ $item->id }}').submit()">
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-purple-600 peer-checked:to-pink-600"></div>
                    </label>
                </div>
                
                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-purple-600 transition">{{ $item->label }}</h3>
                <p class="text-gray-600 text-sm mb-2 flex items-center">
                    <i class="fas fa-link mr-2 text-purple-500"></i>{{ $item->url }}
                </p>
                @if($item->section_id)
                    <p class="text-gray-500 text-sm mb-3 flex items-center">
                        <i class="fas fa-hashtag mr-2 text-pink-500"></i>{{ $item->section_id }}
                    </p>
                @endif
                
                <div class="flex items-center gap-2 mb-4">
                    <span class="inline-flex items-center bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                        <i class="fas fa-sort mr-1"></i>Order: {{ $item->order }}
                    </span>
                    @if($item->is_visible)
                        <span class="inline-flex items-center bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-eye mr-1"></i>Visible
                        </span>
                    @else
                        <span class="inline-flex items-center bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-eye-slash mr-1"></i>Hidden
                        </span>
                    @endif
                </div>
                
                <div class="flex gap-2">
                    <button onclick="openEditModal{{ $item->id }}()" 
                            class="flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-4 py-2 rounded-lg font-semibold transition transform hover:scale-105">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </button>
                    <form action="{{ route('admin.menu.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this menu item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-4 py-2 rounded-lg font-semibold transition transform hover:scale-105">
                            <i class="fas fa-trash mr-1"></i>Delete
                        </button>
                    </form>
                </div>
                
                <form id="toggle-{{ $item->id }}" action="{{ route('admin.menu.toggle', $item) }}" method="POST" class="hidden">
                    @csrf
                    @method('PATCH')
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal{{ $item->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Edit Menu Item</h3>
                    <button onclick="closeEditModal{{ $item->id }}()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <form action="{{ route('admin.menu.update', $item) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Label</label>
                            <input type="text" name="label" value="{{ $item->label }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">URL</label>
                            <input type="text" name="url" value="{{ $item->url }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Section ID (optional)</label>
                            <input type="text" name="section_id" value="{{ $item->section_id }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Order</label>
                            <input type="number" name="order" value="{{ $item->order }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_visible" value="1" {{ $item->is_visible ? 'checked' : '' }}
                                   class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                            <label class="ml-3 text-sm font-semibold text-gray-700">Visible</label>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button type="button" onclick="closeEditModal{{ $item->id }}()"
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-3 rounded-lg font-semibold transition">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-4 py-3 rounded-lg font-semibold transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openEditModal{{ $item->id }}() {
                document.getElementById('editModal{{ $item->id }}').classList.remove('hidden');
            }
            function closeEditModal{{ $item->id }}() {
                document.getElementById('editModal{{ $item->id }}').classList.add('hidden');
            }
        </script>
        @endforeach
    </div>
@else
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-bars text-purple-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Menu Items Yet</h3>
        <p class="text-gray-600 mb-6">Create your first navigation menu item to get started</p>
        <button onclick="document.getElementById('addMenuModal').classList.remove('hidden')"
                class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-3 rounded-lg font-semibold shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Add Menu Item
        </button>
    </div>
@endif

<!-- Add Modal -->
<div id="addMenuModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Add Menu Item</h3>
            <button onclick="document.getElementById('addMenuModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        <form action="{{ route('admin.menu.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Label</label>
                    <input type="text" name="label" required placeholder="Home"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">URL</label>
                    <input type="text" name="url" required placeholder="#home"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Section ID (optional)</label>
                    <input type="text" name="section_id" placeholder="home"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Order</label>
                    <input type="number" name="order" value="0" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_visible" value="1" checked
                           class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                    <label class="ml-3 text-sm font-semibold text-gray-700">Visible</label>
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="document.getElementById('addMenuModal').classList.add('hidden')"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-3 rounded-lg font-semibold transition">
                    Cancel
                </button>
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-4 py-3 rounded-lg font-semibold transition">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
