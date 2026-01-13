@extends('admin.layout')

@section('title', 'Edit Education')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3">Edit Education Entry</h1>
        <p class="text-muted">Update educational qualification details</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.education.update', $education) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="degree" class="form-label">Degree/Certification *</label>
                                <input type="text" class="form-control @error('degree') is-invalid @enderror" 
                                       id="degree" name="degree" value="{{ old('degree', $education->degree) }}" required
                                       placeholder="e.g., Bachelor of Science">
                                @error('degree')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="field_of_study" class="form-label">Field of Study</label>
                                <input type="text" class="form-control @error('field_of_study') is-invalid @enderror" 
                                       id="field_of_study" name="field_of_study" value="{{ old('field_of_study', $education->field_of_study) }}"
                                       placeholder="e.g., Computer Science">
                                @error('field_of_study')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="institution" class="form-label">Institution *</label>
                            <input type="text" class="form-control @error('institution') is-invalid @enderror" 
                                   id="institution" name="institution" value="{{ old('institution', $education->institution) }}" required
                                   placeholder="e.g., University of XYZ">
                            @error('institution')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                   id="location" name="location" value="{{ old('location', $education->location) }}"
                                   placeholder="e.g., New York, NY">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date *</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date', $education->start_date) }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" value="{{ old('end_date', $education->end_date) }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Leave blank if currently studying</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="grade" class="form-label">Grade/GPA</label>
                            <input type="text" class="form-control @error('grade') is-invalid @enderror" 
                                   id="grade" name="grade" value="{{ old('grade', $education->grade) }}"
                                   placeholder="e.g., 3.8/4.0, First Class, A">
                            @error('grade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4"
                                      placeholder="Key courses, projects, achievements, etc.">{{ old('description', $education->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.education.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Education
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
