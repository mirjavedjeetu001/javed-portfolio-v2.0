@extends('admin.layout')

@section('title', 'Add Experience')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3">Add New Experience</h1>
        <p class="text-muted">Add a professional work experience entry</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.experiences.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="job_title" class="form-label">Job Title *</label>
                                <input type="text" class="form-control @error('job_title') is-invalid @enderror" 
                                       id="job_title" name="job_title" value="{{ old('job_title') }}" required>
                                @error('job_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="company" class="form-label">Company *</label>
                                <input type="text" class="form-control @error('company') is-invalid @enderror" 
                                       id="company" name="company" value="{{ old('company') }}" required>
                                @error('company')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                   id="location" name="location" value="{{ old('location') }}" 
                                   placeholder="e.g., New York, NY">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date *</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" value="{{ old('end_date') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_current" name="is_current" 
                                       value="1" {{ old('is_current') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_current">
                                    I currently work here
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Job Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="responsibilities" class="form-label">Key Responsibilities</label>
                            <textarea class="form-control @error('responsibilities') is-invalid @enderror" 
                                      id="responsibilities" name="responsibilities" rows="4" 
                                      placeholder="Enter each responsibility on a new line">{{ old('responsibilities') }}</textarea>
                            @error('responsibilities')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="achievements" class="form-label">Achievements</label>
                            <textarea class="form-control @error('achievements') is-invalid @enderror" 
                                      id="achievements" name="achievements" rows="4"
                                      placeholder="Enter each achievement on a new line">{{ old('achievements') }}</textarea>
                            @error('achievements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Experience
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('is_current').addEventListener('change', function() {
    const endDateInput = document.getElementById('end_date');
    if (this.checked) {
        endDateInput.disabled = true;
        endDateInput.value = '';
    } else {
        endDateInput.disabled = false;
    }
});
</script>
@endsection
