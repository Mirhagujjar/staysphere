@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 mb-0">
                        <i class="fas {{ isset($facility) ? 'fa-edit' : 'fa-plus-circle' }} me-2"></i>
                        {{ isset($facility) ? 'Edit' : 'Add' }} Facility
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ isset($facility) ? route('admin.facilities.update', $facility->id) : route('admin.facilities.store') }}" 
                          method="POST" enctype="multipart/form-data" id="facility-form">
                        @csrf
                        @if(isset($facility)) @method('PUT') @endif

                        <div class="row g-3">
                            <!-- Title -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Title*</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $facility->title ?? '') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Icon -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Icon* (Bootstrap Icon class)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i id="icon-preview" class="{{ old('icon', $facility->icon ?? 'bi-question-circle') }}"></i></span>
                                    <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" 
                                           value="{{ old('icon', $facility->icon ?? '') }}" required
                                           placeholder="e.g. bi-wifi">
                                </div>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror" 
                                          rows="3">{{ old('description', $facility->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            {{-- <div class="col-md-6">
                                <label class="form-label fw-bold">Image</label>
                                <div class="image-upload-container">
                                    @if(isset($facility) && $facility->image)
                                        <div class="image-preview mb-2" id="image-preview">
                                            <img id="preview-image" src="{{ asset($facility->image) }}" 
                                                 alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" 
                                           id="image-upload" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Recommended: 800x600px, Max 2MB</small>
                                </div>
                            </div> --}}

                            <!-- Sort Order -->
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                                       value="{{ old('sort_order', $facility->sort_order ?? 0) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Status</label>
                                <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                                    <option value="1" {{ old('is_active', $facility->is_active ?? true) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !old('is_active', $facility->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 mt-4">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.facilities.index') }}" class="btn btn-outline-secondary me-2">
                                        <i class="fas fa-times me-2"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i> Save Facility
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include("components.summernote")
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.querySelector('input[name="icon"]');
    const iconPreview = document.getElementById('icon-preview');
    
    if (iconInput && iconPreview) {
        iconInput.addEventListener('input', function() {
            iconPreview.className = this.value || 'bi-question-circle';
        });
    }

    // const imageUpload = document.getElementById('image-upload');
    // const previewImage = document.getElementById('preview-image');
    // const imagePreview = document.getElementById('image-preview');

    // if (imageUpload) {
    //     imageUpload.addEventListener('change', function(e) {
    //         const file = e.target.files[0];
    //         if (file) {
    //             const reader = new FileReader();
    //             reader.onload = function(event) {
    //                 if (previewImage) {
    //                     previewImage.src = event.target.result;
    //                     imagePreview.style.display = 'block';
    //                 }
    //             };
    //             reader.readAsDataURL(file);
    //         }
    //     });
    // }
});
</script>
@endpush

{{-- @push('styles')
<style>
    .image-upload-container {
        border: 2px dashed #dee2e6;
        border-radius: 5px;
        padding: 15px;
        text-align: center;
    }
    .image-preview img {
        max-width: 100%;
        height: auto;
    }
    .input-group-text i {
        width: 1.2em;
        text-align: center;
    }
</style>
@endpush --}}
