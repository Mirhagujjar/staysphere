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
    @media (max-width: 768px) {
        .hero-section {
            height: 250px;
        }
        .hero-content h1 {
            font-size: 1.8rem;
        }
    }
</style>

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
            @if(request('query'))
                <h3 class="fw-bold mb-4">Search Results for: "{{ request('query') }}"</h3>
                <div class="row">
                    @forelse($blogs as $blog)
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
                    @empty
                        <div class="alert alert-info">No articles found matching your search criteria.</div>
                    @endforelse
                </div>
            @else
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
            @endif

            {{ $blogs->links() }}
        </div>

        <div class="col-lg-4">
            <div class="sidebar-section mb-4">
                <h4>Search Blog</h4>
                <form action="{{ route('user.blogs.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Search blog articles..." value="{{ request('query') }}">
                        <button type="submit" class="btn btn-custom"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
