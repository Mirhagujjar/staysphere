@extends('admin.dashboard')

@push('styles')
<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<!-- Select2 CSS (for categories) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.3.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')
<style>
    .form-control:focus {
        border-color: #3c8dbc !important;
        box-shadow: none !important;
        caret-color: #000 !important;
    }
    .note-editable {
        caret-color: #000 !important;
        color: #000 !important;
        background-color: #fff !important;
        z-index: 1 !important;
        position: relative;
    }
    .note-editor.note-frame {
        z-index: 10 !important;
    }
</style>

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ isset($blog) ? 'Edit' : 'Create' }} Blog Post</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ isset($blog) ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($blog))
                    @method('PUT')
                @endif

                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title ?? '') }}" required>
                </div>

                <!-- Excerpt -->
                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" class="form-control" rows="3" required>{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                </div>

                <!-- Summernote Content -->
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control summernote" rows="10" required>{{ old('content', $blog->content ?? '') }}</textarea>
                </div>

                <!-- Images -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="featured_image">Featured Image</label>
                            <input type="file" name="featured_image" id="featured_image" class="form-control-file" {{ isset($blog) ? '' : 'required' }}>
                            @if(isset($blog) && $blog->featured_image)
                                <img src="{{ asset('storage/' . $blog->featured_image) }}" style="max-height:150px" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hero_image">Hero Image</label>
                            <input type="file" name="hero_image" id="hero_image" class="form-control-file">
                            @if(isset($blog) && $blog->hero_image)
                                <img src="{{ asset('storage/' . $blog->hero_image) }}" style="max-height:150px" class="mt-2">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Date and Author -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="published_date">Published Date</label>
                            <input type="date" name="published_date" id="published_date" class="form-control"
                                value="{{ old('published_date', isset($blog) ? $blog->published_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" id="author" class="form-control"
                                value="{{ old('author', $blog->author ?? 'Admin') }}" required>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                {{-- <div class="form-group">
                    <label for="categories">Categories</label>
                    <select name="categories[]" id="categories" class="form-control select2" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ isset($blog) && $blog->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                <!-- Gallery -->
                <div class="form-group">
                    <label for="gallery_images">Gallery Images</label>
                    <input type="file" name="gallery_images[]" id="gallery_images" class="form-control-file" multiple>
                    @if(isset($blog) && $blog->gallery->count() > 0)
                        <div class="row mt-3">
                            @foreach($blog->gallery as $image)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid">
                                    <button type="button" class="btn btn-sm btn-danger btn-block mt-2" onclick="deleteImage({{ $image->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Meta SEO -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control"
                                value="{{ old('meta_title', $blog->meta_title ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="2">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Is Featured -->
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_featured" id="is_featured" class="custom-control-input"
                            {{ old('is_featured', isset($blog) && $blog->is_featured) ? 'checked' : '' }}>
                        <label for="is_featured" class="custom-control-label">Featured Post</label>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary">{{ isset($blog) ? 'Update' : 'Create' }} Blog Post</button>
            </form>
        </div>
    </div>
</div>
@endsection

{{-- @push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });

    $('.select2').select2({
        theme: 'bootstrap4',
        placeholder: 'Select categories'
    });
});

function deleteImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        fetch(`/admin/blog-gallery/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}
</script>
@endpush --}}
