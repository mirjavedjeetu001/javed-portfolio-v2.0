@extends('admin.layout')

@section('title', 'Edit Project')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3">Edit Project</h1>
        <p class="text-muted">Update project details</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Project Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $project->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Short Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="2" required>{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Brief summary (displayed in cards)</small>
                        </div>

                        <div class="mb-3">
                            <label for="long_description" class="form-label">Detailed Description</label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror" 
                                      id="long_description" name="long_description" rows="5">{{ old('long_description', $project->long_description) }}</textarea>
                            @error('long_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Full project details (optional)</small>
                        </div>

                        <div class="mb-3">
                            <label for="technologies" class="form-label">Technologies Used</label>
                            <input type="text" class="form-control @error('technologies') is-invalid @enderror" 
                                   id="technologies" name="technologies" 
                                   value="{{ old('technologies', is_array($project->technologies) ? implode(', ', $project->technologies) : '') }}" 
                                   placeholder="Laravel, Vue.js, MySQL, etc.">
                            @error('technologies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Separate with commas</small>
                        </div>

                        @if($project->image)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div>
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="image" class="form-label">{{ $project->image ? 'Replace Image' : 'Project Image' }}</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Recommended: 800x600px (max 2MB)</small>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="demo_url" class="form-label">Demo URL</label>
                                <input type="url" class="form-control @error('demo_url') is-invalid @enderror" 
                                       id="demo_url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" 
                                       placeholder="https://demo.example.com">
                                @error('demo_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="github_url" class="form-label">GitHub URL</label>
                                <input type="url" class="form-control @error('github_url') is-invalid @enderror" 
                                       id="github_url" name="github_url" value="{{ old('github_url', $project->github_url) }}" 
                                       placeholder="https://github.com/username/repo">
                                @error('github_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured" 
                                           value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">
                                        <i class="fas fa-star text-warning me-1"></i> Featured Project
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="order" class="form-label">Display Order</label>
                                <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                       id="order" name="order" value="{{ old('order', $project->order) }}" min="0">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
