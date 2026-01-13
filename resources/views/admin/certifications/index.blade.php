@extends('admin.layout')

@section('page-title', 'Certifications')

@section('content')
<div class="container-fluid">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Certifications & Licenses</h1>
            <p class="text-gray-600 mt-1">Manage your professional certifications and licenses</p>
        </div>
    </div>

    @if($certifications->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($certifications as $cert)
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition p-6">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-certificate text-blue-600 text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $cert->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $cert->organization }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar-alt text-gray-400 w-5"></i>
                            <span>Issued: {{ \Carbon\Carbon::parse($cert->issue_date)->format('M Y') }}</span>
                        </div>
                        @if($cert->expiry_date)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-calendar-check text-gray-400 w-5"></i>
                                <span>Expires: {{ \Carbon\Carbon::parse($cert->expiry_date)->format('M Y') }}</span>
                            </div>
                        @else
                            <div class="flex items-center text-sm">
                                <i class="fas fa-infinity text-green-500 w-5"></i>
                                <span class="text-green-600 font-medium">No Expiry</span>
                            </div>
                        @endif
                        @if($cert->credential_id)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-id-card text-gray-400 w-5"></i>
                                <span>ID: {{ $cert->credential_id }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex gap-2 pt-4 border-t border-gray-200">
                        @if($cert->credential_url)
                            <a href="{{ $cert->credential_url }}" target="_blank" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg text-sm transition">
                                <i class="fas fa-external-link-alt mr-2"></i>View
                            </a>
                        @endif
                        <form action="{{ route('admin.certifications.destroy', $cert) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this certification?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg text-sm transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-500 text-2xl mr-4"></i>
                <div>
                    <h3 class="text-lg font-semibold text-blue-800 mb-1">No Certifications Found</h3>
                    <p class="text-blue-700">Upload your resume with AI to automatically import your certifications!</p>
                    <a href="{{ route('admin.resumes.create') }}" class="inline-block mt-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                        <i class="fas fa-upload mr-2"></i>Upload Resume
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
