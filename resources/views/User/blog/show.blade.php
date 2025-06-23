@extends('layouts.app')

@section('content')
<style>
    .hero-section {
        position: relative;
        background-size: cover;
        height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .hero-overlay {
        background: rgba(0, 0, 0, 0.6);
        padding: 30px 50px;
        border-radius: 10px;
    }

    .link-container {
        margin-top: 10px;
        font-size: 15px;
        font-weight: 300;
        color: #F8F9FA;
    }

    .link-container a {
        text-decoration: none;
        color: #F1C40F;
    }

    .link-container a:hover {
        color: #1ABC9C;
    }

    .blog-content {
        line-height: 1.8;
        color: #444;
    }

    .blog-content h4 {
        font-weight: bold;
        color: #2C3E50;
        margin-top: 20px;
    }

    .blog-content ul {
        padding-left: 20px;
    }

    .blog-content ul li {
        margin-bottom: 8px;
    }

    .sidebar-section {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }

    .sidebar-section h4 {
        font-weight: bold;
        color: #2C3E50;
    }

    .sidebar-section a {
        text-decoration: none;
        color: #F1C40F;
    }

    .sidebar-section a:hover {
        color: #1ABC9C;
    }

    @media (max-width: 768px) {
        .hero-section {
            height: 300px;
        }

        .hero-overlay {
            padding: 20px 30px;
        }

        .hero-overlay h1 {
            font-size: 1.8rem;
        }
    }
</style>

<div class="hero-section" style="background: url('{{ asset($blog->hero_image ?? 'build/assets/images/blog/R0.jpg') }}') no-repeat center center; background-size: cover;">
    <div class="hero-overlay">
        <h1 class="fw-bold">{{ $blog->title }}</h1>
        <p class="mb-0">By {{ $blog->author }} | Published on {{ $blog->published_date->format('M d, Y') }}</p>
        <div class="link-container">
            <a href="{{ route('user.blogs.index') }}">Blog</a> > {{ Str::limit($blog->title, 20) }}
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="blog-content">
                {!! $blog->content !!}
            </div>

            {{-- Optional: Uncomment if gallery is needed inside blog --}}
            {{-- @if($blog->gallery->count() > 0)
                <section class="gallery-section mt-5">
                    <h2 class="text-center">Gallery</h2>
                    <div class="gallery-grid">
                        @foreach($blog->gallery as $image)
                            <div class="gallery-item">
                                <img src="{{ asset($image->image_path) }}" alt="Gallery Image">
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif --}}
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-section mb-4">
                <h4>Related Blogs</h4>
                <ul class="list-unstyled">
                    @foreach($related as $post)
                        <li><a href="{{ route('user.blogs.show', $post) }}">{{ $post->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Optional: Blog Categories --}}
            {{-- <div class="sidebar-section">
                <h4>Categories</h4>
                <ul class="list-unstyled">
                    @foreach($blog->categories as $category)
                        <li><a href="{{ route('user.blogs.category', $category) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div> --}}

            {{-- Optional: CTA box --}}
            {{-- <div class="cta-box mt-4">
                <h5>Exclusive Offer: 20% Off on Deluxe Rooms!</h5>
                <p>Book now and enjoy a luxurious stay with us.</p>
                <a href="{{ route('user.reservations.create') }}" class="btn btn-warning">Book Now</a>
            </div> --}}
        </div>
    </div>
</div>
@endsection
