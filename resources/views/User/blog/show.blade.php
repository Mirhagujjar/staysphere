@extends('layouts.app')

@section('content')
<style>
    /*-------------- Hero Section------------- */
    .hero-section {
        position: relative;
        background: url('{{ asset('build/assets/images/blog/R0.jpg') }}') no-repeat center center;
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
    /*------------ Blog Content ------------*/
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

    /*--------------- Sidebar--------------- */
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
        color:#1ABC9C;
    }

    /*---------------Action Box---------- */
    .cta-box {
        background: #FFF3CD;
        padding: 15px;
        border-left: 5px solid #F1C40F;
        border-radius: 10px;
        text-align: center;
    }

    .cta-box h5 {
        font-weight: bold;
        color: #2C3E50;
    }

    .cta-box p {
        color: #666;
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


    /* .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }


    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .gallery-grid {
            grid-template-columns: 1fr;
        }
    } */


    /*---------- Comments Section --------------*/
    .comment-section {
        background: #f8f8f8;
        padding: 20px;
        border-radius: 10px;
    }

    .comment-section h4 {
        color: #2C3E50;
        font-weight: bold;
    }

    /* -------------Responsive-------------- */
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

<div class="hero-section" style="background: url('{{ asset('storage/' . ($blog->hero_image ?? 'build/assets/images/blog/R0.jpg')) }}') no-repeat center center; background-size: cover;">
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
        <div class="col-lg-8">
            <div class="blog-content">
                {!! $blog->content !!}

                @if($blog->gallery->count() > 0)
                {{-- <section class="gallery-section">
                    <h2>Gallery</h2>
                    <div class="gallery-grid">
                        @foreach($blog->gallery as $image)
                        <div class="gallery-item">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->alt_text ?? 'Gallery image' }}">
                        </div>
                        @endforeach
                    </div>
                </section> --}}
                @endif
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar-section mb-4">
                <h4>Related Blogs</h4>
                <ul class="list-unstyled">
                    @foreach($related as $post)
                    <li><a href="{{ route('user.blogs.show', $post) }}">{{ $post->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- <div class="sidebar-section">
                <h4>Categories</h4>
                <ul class="list-unstyled">
                    @foreach($blog->categories as $category)
                    <li><a href="{{ route('user.blogs.category', $category) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div> --}}

            {{-- <div class="cta-box mt-4">
                <h5>Exclusive Offer: 20% Off on Deluxe Rooms!</h5>
                <p>Book now and enjoy a luxurious stay with us.</p>
                <a href="{{ route('user.reservations.create') }}" class="btn btn-warning">Book Now</a>
            </div> --}}
        </div>
    </div>
</div>
@endsection