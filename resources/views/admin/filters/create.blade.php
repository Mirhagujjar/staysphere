<!-- resources/views/admin/filters/create.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="h3">Create New Filter</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.filters.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Filters
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.filters.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Filter Name*</label>
                            <input type="text" name="name" id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="text-muted">Example: Room Type, Facilities, View Type</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type" class="font-weight-bold">Filter Type*</label>
                            <select name="type" id="type" 
                                    class="form-control @error('type') is-invalid @enderror" required>
                                <option value="">Select Filter Type</option>
                                <option value="checkbox" {{ old('type') == 'checkbox' ? 'selected' : '' }}>
                                    Checkbox (Multiple Selection)
                                </option>
                                <option value="dropdown" {{ old('type') == 'dropdown' ? 'selected' : '' }}>
                                    Dropdown (Single Selection)
                                </option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug" class="font-weight-bold">Slug*</label>
                            <input type="text" name="slug" id="slug" 
                                   class="form-control @error('slug') is-invalid @enderror" 
                                   value="{{ old('slug') }}" required>
                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="text-muted">URL-friendly identifier (auto-generated if empty)</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Status</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" checked>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                            <small class="text-muted">Inactive filters won't show on user side</small>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save"></i> Create Filter
                    </button>
                    <a href="{{ route('admin.filters.index') }}" class="btn btn-secondary ml-2">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from name
    const nameField = document.getElementById('name');
    const slugField = document.getElementById('slug');
    
    nameField.addEventListener('blur', function() {
        if (!slugField.value) {
            slugField.value = this.value.toLowerCase()
                .replace(/\s+/g, '-')    // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                .replace(/\-\-+/g, '-')   // Replace multiple - with single
                .replace(/^-+/, '')       // Trim - from start
                .replace(/-+$/, '');      // Trim - from end
        }
    });
});
</script>
@endpush