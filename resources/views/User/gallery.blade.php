@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">{{ $title }}</h1>
        <p class="lead text-muted">{{ $subtitle }}</p>
    </div>

    <!-- Main Gallery Images -->
    @if(count($mainGallery) > 0)
        <div class="mb-5">
            <h3 class="mb-4"> Images</h3>
            <div class="row gallery-grid">
                @foreach($mainGallery as $image)
                    <div class="col-md-4 mb-4 gallery-item">
                        <a href="{{ asset($image) }}" data-lightbox="gallery">
                            <img src="{{ asset($image) }}" 
                                 alt="Gallery image" 
                                 class="img-fluid rounded shadow-sm"
                                 style="height: 250px; width: 100%; object-fit: cover;">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Blog Post Galleries -->
    {{-- @foreach($blogs as $blog)
        @if($blog->gallery->count() > 0)
            <div class="mb-5">
                <h3 class="mb-4">{{ $blog->title }}</h3>
                <div class="row gallery-grid">
                    @foreach($blog->gallery as $image)
                        <div class="col-md-4 mb-4 gallery-item">
                            <a href="{{ asset($image->image_path) }}" data-lightbox="gallery-{{ $blog->id }}">
                                <img src="{{ asset($image->image_path) }}" 
                                     alt="{{ $blog->title }}" 
                                     class="img-fluid rounded shadow-sm"
                                     style="height: 250px; width: 100%; object-fit: cover;">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-end mt-2">
                    <a href="{{ route('user.blogs.show', $blog->slug) }}" class="btn btn-sm btn-outline-primary">
                        View Post <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        @endif
    @endforeach

    @if(count($mainGallery) === 0 && $blogs->count() === 0)
        <div class="alert alert-info text-center">
            No gallery images available yet. Please check back later.
        </div>
    @endif --}}
</div>
@endsection

@section('styles')
<style>
    .gallery-item {
        transition: transform 0.3s ease;
    }
    .gallery-item:hover {
        transform: scale(1.02);
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }
</style>
@endsection

@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'albumLabel': 'Image %1 of %2'
    });
</script>
@endsection
