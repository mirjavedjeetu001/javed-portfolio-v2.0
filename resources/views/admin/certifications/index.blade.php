@extends('admin.layout')

@section('title', 'Manage Certifications')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-certificate text-white text-xl"></i>
                </div>
                Certifications & Licenses
            </h1>
            <p class="text-gray-600 mt-2 ml-16">Manage your professional certifications and credentials</p>
        </div>
        <a href="{{ route('admin.certifications.create') }}" class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 text-white px-6 py-3 rounded-xl transition flex items-center font-semibold">
                <i class="fas fa-plus mr-2"></i>Add Certification
            </div>
        </a>
    </div>
</div>

@if($certifications->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($certifications as $cert)
        <div class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-2xl transform group-hover:scale-105 transition duration-500 opacity-75 blur"></div>
            <div class="relative bg-gradient-to-br from-cyan-600 to-blue-600 p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 text-white h-full flex flex-col">
                <div class="flex items-start mb-4">
                    <div class="w-14 h-14 bg-white bg-opacity-25 rounded-xl flex items-center justify-center mr-3 transform group-hover:rotate-12 transition duration-500 flex-shrink-0">
                        <i class="fas fa-certificate text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white mb-1">{{ $cert->name }}</h3>
                        <p class="font-semibold text-cyan-100">{{ $cert->organization }}</p>
                    </div>
                </div>
                
                <div class="mb-4 space-y-2">
                    <div class="flex items-center text-cyan-100 text-sm">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>Issued: {{ \Carbon\Carbon::parse($cert->issue_date)->format('M Y') }}</span>
                    </div>
                    @if($cert->expiry_date)
                    <div class="flex items-center text-cyan-100 text-sm">
                        <i class="fas fa-calendar-check mr-2"></i>
                        <span>Expires: {{ \Carbon\Carbon::parse($cert->expiry_date)->format('M Y') }}</span>
                    </div>
                    @else
                    <div class="flex items-center">
                        <i class="fas fa-infinity mr-2 text-green-300"></i>
                        <span class="inline-flex items-center bg-white text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                            No Expiry
                        </span>
                    </div>
                    @endif
                    @if($cert->credential_id)
                    <div class="flex items-center text-cyan-100 text-sm">
                        <i class="fas fa-id-card mr-2"></i>
                        <span class="font-mono text-xs">{{ $cert->credential_id }}</span>
                    </div>
                    @endif
                </div>
                
                <div class="flex gap-2 mt-auto">
                    @if($cert->credential_url)
                    <a href="{{ $cert->credential_url }}" target="_blank" class="flex-1 bg-white hover:bg-cyan-50 text-cyan-700 px-4 py-2 rounded-lg transition text-center font-semibold">
                        <i class="fas fa-external-link-alt mr-1"></i>View
                    </a>
                    @else
                    <a href="{{ route('admin.certifications.edit', $cert) }}" class="flex-1 bg-white hover:bg-cyan-50 text-cyan-700 px-4 py-2 rounded-lg transition text-center font-semibold">
                        <i class="fas fa-edit mr-1"></i>Edit
                    </a>
                    @endif
                    <form action="{{ route('admin.certifications.destroy', $cert) }}" method="POST" class="flex-1" onsubmit="event.preventDefault(); showDeleteModal(this);">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-transparent hover:bg-white hover:bg-opacity-20 text-white px-4 py-2 rounded-lg transition font-semibold border-2 border-white">
                            <i class="fas fa-trash mr-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-r from-cyan-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-certificate text-cyan-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">No Certifications Yet</h3>
        <p class="text-gray-600 mb-6">Add your professional certifications and licenses to showcase your expertise.</p>
        <a href="{{ route('admin.certifications.create') }}" class="group inline-block relative">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-xl blur group-hover:blur-lg transition"></div>
            <div class="relative bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 text-white px-8 py-4 rounded-xl transition flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Your First Certification
            </div>
        </a>
    </div>
@endif
@endsection
