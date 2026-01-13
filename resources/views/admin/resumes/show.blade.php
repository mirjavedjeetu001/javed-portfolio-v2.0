@extends('admin.layout')

@section('title', 'Resume Details')
@section('page-title', 'Resume Details')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $resume->filename }}</h3>
                    <p class="text-sm text-gray-500">Uploaded {{ $resume->created_at->format('M d, Y') }}</p>
                </div>
                <div class="flex items-center space-x-2">
                    @if($resume->is_active)
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full">Active</span>
                    @endif
                    <a href="{{ asset('storage/' . $resume->file_path) }}" target="_blank" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                        <i class="fas fa-download mr-1"></i> Download
                    </a>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            @if(!$resume->parsed_data)
                <div class="text-center py-8">
                    <i class="fas fa-robot text-blue-500 text-5xl mb-4"></i>
                    <h4 class="text-xl font-semibold text-gray-800 mb-2">Ready to Parse with AI</h4>
                    <p class="text-gray-600 mb-6">Click the button below to extract data from this resume using AI</p>
                    
                    <form action="{{ route('admin.resumes.parse', $resume->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg transition">
                            <i class="fas fa-magic mr-2"></i>Parse with AI
                        </button>
                    </form>
                </div>
            @else
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-gray-800">Parsed Data</h4>
                        <div class="flex space-x-2">
                            @if(!$resume->is_active)
                                <form action="{{ route('admin.resumes.apply', $resume->id) }}" method="POST" onsubmit="return confirm('This will update your portfolio with this data. Continue?');">
                                    @csrf
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition">
                                        <i class="fas fa-check mr-2"></i>Apply to Portfolio
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.resumes.parse', $resume->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-100 text-blue-700 px-6 py-2 rounded-lg hover:bg-blue-200 transition">
                                    <i class="fas fa-sync-alt mr-2"></i>Re-parse
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <pre class="text-sm text-gray-700 overflow-auto max-h-96">{{ json_encode($resume->parsed_data, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                </div>

                <!-- Personal Info Preview -->
                @if(isset($resume->parsed_data['personal_info']))
                <div class="mb-6 border-t border-gray-200 pt-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Personal Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($resume->parsed_data['personal_info'] as $key => $value)
                            @if($value)
                                <div>
                                    <p class="text-sm text-gray-500 capitalize">{{ str_replace('_', ' ', $key) }}</p>
                                    <p class="font-medium text-gray-800">{{ is_string($value) ? $value : json_encode($value) }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Experience Preview -->
                @if(isset($resume->parsed_data['experiences']) && count($resume->parsed_data['experiences']) > 0)
                <div class="mb-6 border-t border-gray-200 pt-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Experience ({{ count($resume->parsed_data['experiences']) }} positions)</h4>
                    <div class="space-y-3">
                        @foreach($resume->parsed_data['experiences'] as $exp)
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h5 class="font-semibold text-gray-800">{{ $exp['job_title'] ?? $exp['position'] ?? 'N/A' }}</h5>
                                <p class="text-sm text-gray-600">{{ $exp['company'] ?? 'N/A' }}</p>
                                @if(isset($exp['start_date']) || isset($exp['end_date']))
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $exp['start_date'] ?? 'N/A' }} - {{ $exp['is_current'] ? 'Present' : ($exp['end_date'] ?? 'N/A') }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Skills Preview -->
                @if(isset($resume->parsed_data['skills']) && count($resume->parsed_data['skills']) > 0)
                <div class="mb-6 border-t border-gray-200 pt-6">
                    @php
                        // Group skills by category
                        $skillsByCategory = [];
                        foreach ($resume->parsed_data['skills'] as $skill) {
                            $category = $skill['category'] ?? 'General';
                            if (!isset($skillsByCategory[$category])) {
                                $skillsByCategory[$category] = [];
                            }
                            $skillsByCategory[$category][] = $skill;
                        }
                    @endphp
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Skills ({{ count($skillsByCategory) }} categories)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($skillsByCategory as $category => $skills)
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h5 class="font-semibold text-gray-800 mb-2">{{ $category }}</h5>
                                <div class="space-y-1">
                                    @foreach($skills as $skill)
                                        <p class="text-sm text-gray-600">• {{ $skill['name'] }} ({{ $skill['proficiency'] ?? 80 }}%)</p>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Certifications Preview -->
                @if(isset($resume->parsed_data['certifications']) && count($resume->parsed_data['certifications']) > 0)
                <div class="mb-6 border-t border-gray-200 pt-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Certifications ({{ count($resume->parsed_data['certifications']) }})</h4>
                    <div class="space-y-3">
                        @foreach($resume->parsed_data['certifications'] as $cert)
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h5 class="font-semibold text-gray-800">{{ $cert['name'] ?? 'N/A' }}</h5>
                                <p class="text-sm text-gray-600">{{ $cert['issuing_organization'] ?? $cert['organization'] ?? 'N/A' }}</p>
                                @if(isset($cert['issue_date']))
                                    <p class="text-xs text-gray-500 mt-1">{{ $cert['issue_date'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Awards Preview -->
                @if(isset($resume->parsed_data['awards']) && count($resume->parsed_data['awards']) > 0)
                <div class="mb-6 border-t border-gray-200 pt-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Awards ({{ count($resume->parsed_data['awards']) }})</h4>
                    <div class="space-y-3">
                        @foreach($resume->parsed_data['awards'] as $award)
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h5 class="font-semibold text-gray-800">{{ $award['title'] ?? 'N/A' }}</h5>
                                <p class="text-sm text-gray-600">{{ $award['organization'] ?? 'N/A' }}</p>
                                @if(isset($award['date']))
                                    <p class="text-xs text-gray-500 mt-1">{{ $award['date'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Activities Preview -->
                @if(isset($resume->parsed_data['activities']) && count($resume->parsed_data['activities']) > 0)
                <div class="mb-6 border-t border-gray-200 pt-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Activities ({{ count($resume->parsed_data['activities']) }})</h4>
                    <div class="space-y-3">
                        @foreach($resume->parsed_data['activities'] as $activity)
                            <div class="bg-white border border-gray-200 rounded-lg p-4">
                                <h5 class="font-semibold text-gray-800">{{ $activity['title'] ?? 'N/A' }}</h5>
                                <p class="text-sm text-gray-600">{{ $activity['organization'] ?? 'N/A' }}</p>
                                @if(isset($activity['start_date']))
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $activity['start_date'] }} - {{ $activity['is_current'] ? 'Present' : ($activity['end_date'] ?? 'N/A') }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endif
        </div>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('admin.resumes.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-2"></i>Back to Resumes
        </a>
    </div>
</div>
@endsection
