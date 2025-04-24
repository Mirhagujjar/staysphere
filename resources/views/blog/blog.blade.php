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

{{-- -- Hero Section -- --}}
<div class="hero-section">
    <div class="hero-content">
        <h1 class="fw-bold">Blog</h1>
        <p class="mb-0">Latest travel tips, exclusive offers & hotel updates.</p>
        <div class="link-container">
            <a href="/">Home</a> >Blog
        </div>
    </div>
</div>

{{-- -- Blog Content Section -- --}}
<div class="container my-5">
    <div class="row">

        <div class="col-lg-8">
            <h3 class="fw-bold mb-4">Latest Articles</h3>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('build/assets/images/blog/R0.jpg') }}" class="card-img-top" alt="Blog">
                        <div class="card-body">
                            <h5 class="card-title">Ultimate Comfort: Top Room Picks</h5>
                            <p class="text-muted small">Feb 09, 2025 |  By Admin</p>
                            <p class="card-text">Stay Sphere offers premium rooms with breathtaking views, modern amenities, and ultimate comfort for a memorable stay.</p>
                            <a href="{{ route('blog.topRoom') }}" class="btn btn-custom w-100">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('build/assets/images/blog/M0.jpg') }}" class="card-img-top" alt="Blog">
                        <div class="card-body">
                            <h5 class="card-title"> Chef’s Special: Must-Try Dishes at Stay Sphere</h5>
                            <p class="text-muted small"> Feb 04, 2025 |  By Admin</p>
                            <p class="card-text">Indulge in our chef’s finest creations, from signature gourmet dishes to local favorites, at our luxury dining experience.</p>
                            <a href="{{ route('blog.chefSpecial') }}" class="btn btn-custom w-100">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('build/assets/images/blog/G0.jpg') }}" class="card-img-top" alt="Blog">
                        <div class="card-body">
                            <h5 class="card-title">Guest Experiences: Real Stories from Our Visitors</h5>
                            <p class="text-muted small"> Feb 04, 2025 |  By Admin</p>
                            <p class="card-text">Read what our guests experience and how we make their stay unforgettable.</p>
                            <a href="{{ route('blog.guest') }}" class="btn btn-custom w-100">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('build/assets/images/blog/H0.jpg') }}" class="card-img-top" alt="Blog">
                        <div class="card-body">
                            <h5 class="card-title"> Hosting an Event? Book a Hall at Stay Sphere</h5>
                            <p class="text-muted small"> Feb 04, 2025 |  By Admin</p>
                            <p class="card-text">Need a venue for your next event? Our halls and meeting rooms are available for booking.</p>
                            <a href="{{ route('blog.hosting') }}" class="btn btn-custom w-100">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- -- Sidebar -- --}}
        <div class="col-lg-4">

            <div class="sidebar-section mb-4">
                <h4>Search Blog</h4>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search blog articles...">
                    <button class="btn btn-custom"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <div class="sidebar-section mb-4">
                <h4>Popular Posts</h4>
                <ul class="list-unstyled">
                    <li><a href="{{ route('user.rooms.index') }}">Best Room Choices at Stay Sphere</a></li>
                    <li><a href="{{ route('blog.topRoom') }}">Stay Sphere Exclusive Deals</a></li>
                    <li><a href="{{ route('events') }}">Events at Stay Sphere</a></li>
                </ul>
            </div>


            <div class="sidebar-section text-light">
                <h4>Special Offers</h4>
                <p>Get 20% off on your first booking. Limited time only!</p>
                <a href="{{ route('user.reservations.create') }}" class="btn btn-custom w-100 text-dark">Book Now</a>
            </div>
        </div>

               {{-- ------- Image Gallery--------- --}}
        <section class="gallery-section">
            <h2>Gallery</h2>
            <div class="gallery-grid">
                <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/R1.jpg') }}" alt="room 1"></div>
                <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/H1.jpg') }}" alt="room 2"></div>
                <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/G2.jpg') }}" alt="room 3"></div>
                <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/H3.jpg') }}" alt="room 4"></div>
                <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/G1.jpg') }}" alt="room 5"></div>
                <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/R6.jpg') }}" alt="room 6"></div>
            </div>
        </section>
    </div>
</div>

@endsection

