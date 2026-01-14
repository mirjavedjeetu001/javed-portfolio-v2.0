@extends('admin.layout')

@section('title', 'Database Management')
@section('page-title', 'Database Management')

@section('content')
<!-- Page Header -->
<div class="mb-6 sm:mb-8">
    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 flex items-center">
        <div class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mr-3 sm:mr-4">
            <i class="fas fa-database text-white text-lg sm:text-2xl"></i>
        </div>
        Database Management
    </h1>
    <p class="text-sm sm:text-base text-gray-600 mt-2 ml-13 sm:ml-18">Export, import, and restore your database</p>
</div>

<!-- Action Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
    <!-- Export Database -->
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white p-6 rounded-2xl shadow-xl">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-download text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Export Database</h3>
                    <p class="text-gray-600 text-sm">Download current database as SQL file</p>
                </div>
            </div>
            <a href="{{ route('admin.database.export') }}" download class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl transition font-semibold flex items-center justify-center">
                <i class="fas fa-file-export mr-2"></i>Export Now
            </a>
        </div>
    </div>

    <!-- Import Database -->
    <div class="group relative">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-cyan-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
        <div class="relative bg-white p-6 rounded-2xl shadow-xl">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-upload text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Import Database</h3>
                    <p class="text-gray-600 text-sm">Upload and import SQL file</p>
                </div>
            </div>
            <form action="{{ route('admin.database.import') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('⚠️ WARNING: This will replace ALL current data with the imported database. This cannot be undone! Are you sure?');">
                @csrf
                <input type="file" name="sql_file" accept=".sql,.txt" required class="w-full mb-3 px-4 py-2 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-6 py-3 rounded-xl transition font-semibold flex items-center justify-center">
                    <i class="fas fa-file-import mr-2"></i>Import SQL File
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Saved Backups -->
<div class="group relative">
    <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-purple-100">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-archive text-purple-600 mr-3"></i>
                Saved Database Backups
            </h3>
            <p class="text-gray-600 text-sm mt-1">Restore from previously saved backups</p>
        </div>

        <div class="p-6">
            @if(count($backups) > 0)
                <div class="space-y-4">
                    @foreach($backups as $backup)
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                            <div class="flex items-center mb-3 sm:mb-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-database text-white"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $backup['name'] }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ date('M d, Y H:i:s', $backup['date']) }} • 
                                        {{ number_format($backup['size'] / 1024, 2) }} KB
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-2 w-full sm:w-auto">
                                <form action="{{ route('admin.database.restore', $backup['name']) }}" method="POST" class="flex-1 sm:flex-none" onsubmit="return confirm('⚠️ WARNING: This will restore the database to this backup state. All current data will be replaced! Are you sure?');">
                                    @csrf
                                    <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-4 py-2 rounded-lg transition font-semibold text-sm flex items-center justify-center">
                                        <i class="fas fa-redo mr-2"></i>Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.database.delete', $backup['name']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this backup?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition font-semibold text-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-database text-gray-400 text-3xl"></i>
                    </div>
                    <p class="text-gray-600 font-semibold mb-2">No backups found</p>
                    <p class="text-gray-500 text-sm">Export your database to create a backup</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Important Notes -->
<div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-6">
    <div class="flex items-start">
        <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
            <i class="fas fa-exclamation-triangle text-white"></i>
        </div>
        <div>
            <h4 class="font-bold text-gray-800 mb-2">Important Notes:</h4>
            <ul class="text-sm text-gray-700 space-y-1">
                <li>• <strong>Export:</strong> Downloads your entire database as a .sql file</li>
                <li>• <strong>Import:</strong> Replaces ALL current data with the uploaded SQL file</li>
                <li>• <strong>Restore:</strong> Restores database from a saved backup file</li>
                <li>• <strong>Backup Location:</strong> Files are stored in <code class="bg-yellow-100 px-2 py-1 rounded">storage/app/backups/</code></li>
                <li>• <strong>Always create a backup before importing or restoring!</strong></li>
            </ul>
        </div>
    </div>
</div>
@endsection
