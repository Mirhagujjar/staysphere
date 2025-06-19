@extends('layouts.app')

@section('content')
<style>
 /* ---------------hero section------------- */
    .hero-section {
        position: relative;
        background: url('{{ asset('build/assets/images/blog/blog.jpg') }}') no-repeat center center;
        background-size: cover;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        color:white;
        text-align: center;
    }
    .link-container {
        margin-top: 10px;
        font-size: 20px;
        font-weight: 500;
        color: #e8ecf0;
    }
    .link-container a {
        text-decoration: none;
        color:white ;
    }
    .link-container a:hover {
        color:#1ABC9C ;
    }
    .card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }
    .card img {
        height: 220px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .card-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #2C3E50;
    }
    .card-text {
        color: #666;
        font-size: 0.9rem;
    }
    .btn-custom {
        background: #F1C40F;
        color: #2C3E50;
        font-weight: bold;
        transition: 0.3s ease;
    }
    .btn-custom:hover {
        background: #1ABC9C;
        color: white;
    }
    .sidebar-section {
        background: #2C3E50;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }
    .sidebar-section h4 {
        font-weight: bold;
        color: white;
    }
    .sidebar-section a {
        color:  #F1C40F;
        text-decoration: none;
    }
    .sidebar-section a:hover {
        color:#1ABC9C;
    }
    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            height: 250px;
        }
        .hero-content h1 {
            font-size: 1.8rem;
        }
    }

    .gallery-section {
        text-align: center;
        margin: 40px 0;
    }
    .gallery-section h2 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        padding: 20px;
    }

    .gallery-item {
        overflow: hidden;
        border-radius: 10px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .gallery-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.3s ease-in-out;
    }
</style>

{{-- @php
    $settings = [
        'hero_image' => 'path/to/your/image.jpg',
        'title' => 'Blog Title',
        'subtitle' => 'Welcome to the Blog',
        'gallery_images' => [],
    ];
@endphp --}}


<div class="hero-section" 
     style="background: url('{{ str_contains($settings['hero_image'], 'build/assets') ? asset($settings['hero_image']) : asset('storage/'.$settings['hero_image']) }}') no-repeat center center; background-size: cover;">
    <div class="hero-content">
        <h1 class="fw-bold">{{ $settings['title'] }}</h1>
        <p class="mb-0">{{ $settings['subtitle'] }}</p>
        <div class="link-container">
            <a href="/">Home</a> > Blog
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <h3 class="fw-bold mb-4">Latest Articles</h3>
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" class="card-img-top" alt="{{ $blog->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="text-muted small">{{ $blog->published_date->format('M d, Y') }} | By {{ $blog->author }}</p>
                            <p class="card-text">{{ $blog->excerpt }}</p>
                            <a href="{{ route('user.blogs.show', $blog) }}" class="btn btn-custom w-100">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
           {{-- Remove all other gallery sections and keep this one --}}
            {{-- @if(!empty($settings['gallery_images']))
            <section class="gallery-section">
                <h2>Gallery</h2>
                <div class="gallery-grid">
                    @foreach($settings['gallery_images'] as $image)
                        @php
                            $cleanPath = str_replace('\/', '/', $image);
                            $fullPath = 'storage/'.$cleanPath;
                        @endphp
                        
                        @if(file_exists(public_path($fullPath)))
                            <div class="gallery-item">
                                <img src="{{ asset($fullPath) }}" 
                                    alt="Gallery image"
                                    class="img-fluid">
                            </div>
                        @else
                            <div class="gallery-item text-center">
                                <small class="text-danger">Missing: {{ $cleanPath }}</small>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section> --}}
            {{-- @endif --}}
            
            {{ $blogs->links() }}
        </div>

        

        <div class="col-lg-4">
            <div class="sidebar-section mb-4">
                <h4>Search Blog</h4>
                <form action="{{ route('user.blogs.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Search blog articles...">
                        <button type="submit" class="btn btn-custom"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>

            {{-- <div class="sidebar-section mb-4">
                <h4>Categories</h4>
                <ul class="list-unstyled">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('user.blogs.category', $category) }}">
                            {{ $category->name }} ({{ $category->blogs_count }})
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div> --}}

            {{-- <div class="sidebar-section mb-4">
                <h4>Popular Posts</h4>
                <ul class="list-unstyled">
                    @foreach($featured as $post)
                    <li><a href="{{ route('user.blogs.show', $post) }}">{{ $post->title }}</a></li>
                    @endforeach
                </ul>
            </div> --}}

            {{-- <div class="sidebar-section text-light">
                <h4>Special Offers</h4>
                <p>Get 20% off on your first booking. Limited time only!</p>
                <a href="{{ route('user.reservations.create') }}" class="btn btn-custom w-100 text-dark">Book Now</a>
            </div> --}}
        </div>

        {{-- @if(isset($gallery) && count($gallery) > 0)
        <section class="gallery-section">
            <h2>Gallery</h2>
            <div class="gallery-grid">
                @foreach($gallery as $image)
                <div class="gallery-item">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->alt_text ?? 'Gallery image' }}">
                </div>
                @endforeach
            </div>
        </section>
        @endif --}}
    </div>
</div>
@endsection