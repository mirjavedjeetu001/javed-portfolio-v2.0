@extends('admin.layout')

@section('title', 'Edit Skill')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3">Edit Skill</h1>
        <p class="text-muted">Update skill details</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category *</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('category_id', $skill->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Skill Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $skill->name) }}" required
                                   placeholder="e.g., JavaScript, Project Management, etc.">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="proficiency" class="form-label">Proficiency Level * (0-100)</label>
                            <input type="range" class="form-range" id="proficiency" name="proficiency" 
                                   min="0" max="100" value="{{ old('proficiency', $skill->proficiency) }}" 
                                   oninput="document.getElementById('proficiencyValue').textContent = this.value + '%'">
                            <div class="text-center mt-2">
                                <span class="badge bg-primary fs-5" id="proficiencyValue">{{ old('proficiency', $skill->proficiency) }}%</span>
                            </div>
                            @error('proficiency')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="years_experience" class="form-label">Years of Experience</label>
                            <input type="number" class="form-control @error('years_experience') is-invalid @enderror" 
                                   id="years_experience" name="years_experience" value="{{ old('years_experience', $skill->years_experience) }}" 
                                   min="0" step="0.5" placeholder="e.g., 3">
                            @error('years_experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon Class (Font Awesome)</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                   id="icon" name="icon" value="{{ old('icon', $skill->icon) }}" 
                                   placeholder="e.g., fab fa-js, fas fa-code">
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Find icons at <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com</a>
                            </small>
                            <div id="iconPreview" class="mt-2">
                                @if($skill->icon)
                                    <i class="{{ $skill->icon }} fa-3x"></i>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Skill
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('icon').addEventListener('input', function() {
    const iconPreview = document.getElementById('iconPreview');
    if (this.value) {
        iconPreview.innerHTML = `<i class="${this.value} fa-3x"></i>`;
    } else {
        iconPreview.innerHTML = '';
    }
});
</script>
@endsection
