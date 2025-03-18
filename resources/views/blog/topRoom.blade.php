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

{{-- ------------ Hero Section ----------- --}}
<div class="hero-section">
    <div class="hero-overlay">
        <h1 class="fw-bold">Ultimate Comfort: Top Room Picks</h1>
        <p class="mb-0">By Stay Sphere | Published on Feb 09, 2025</p>
        <div class="link-container">
            <a href="{{ route('blog.blog') }}">blog</a> >TopRoom
        </div>
    </div>
</div>

{{-- ----------- Blog Content Section ------------- --}}
<div class="container my-5">
    <div class="row">

        <div class="col-lg-8">
            <div class="blog-content">
                <p class="lead">Planning your stay? Here are the best room choices to ensure a relaxing and luxurious experience at Stay Sphere.</p>
                <p>"Experience elegance and relaxation with our carefully designed rooms, tailored for every type of traveler."</p>

                <h4>Top Room Picks for Ultimate Comfort</h4>
                <ul>
                    <p>"Deluxe Suite – Perfect for a luxurious experience with top-tier amenities."</p>
                    <p>"Family Room – Spacious and comfortable for a perfect family getaway."</p>
                    <p>"Executive Room – Ideal for business travelers seeking comfort and convenience."</p>
                    <p>"Cozy Single Room – A budget-friendly yet stylish option for solo travelers."</p>
                    <p>"Penthouse Suite – The ultimate luxury experience with breathtaking views."</p>
                </ul>


                <div class="cta-box mt-4">
                    <h5>Exclusive Offer: 20% Off on Deluxe Rooms!</h5>
                    <p>Book now and enjoy a luxurious stay with us.</p>
                    <a href="{{ route('reservations.create') }}" class="btn btn-warning">Book Now</a>
                </div>
            </div>
        </div>

        {{-- ----------- Sidebar Section --------- --}}
        <div class="col-lg-4">
            <div class="sidebar-section mb-4">
                <h4>Related Blogs</h4>
                <ul class="list-unstyled">
                    <li><a href="{{ route('blog.chefSpecial') }}"> Chef’s Special</a></li>
                    <li><a href="{{ route('blog.guest') }}">Guest Experiences</a></li>
                    <li><a href="{{ route('blog.hosting') }}"> Hosting an Event?</a></li>
                </ul>
            </div>

            <div class="sidebar-section">
                <h4>Room Picks</h4>
                <p><b>Experience luxury</b>, comfort, and elegance with our top-rated rooms, designed for a perfect stay.</p>
                <a href="{{route('rooms')}}" class="btn btn-warning text-dark">Learn More</a>
            </div>
        </div>
    </div>

{{-- ---------- Image Gallery Section --------- --}}
<section class="gallery-section">
    <h2>Our Luxury Room</h2>
    <div class="gallery-grid">
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/R1.jpg') }}" alt="room 1"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/R2.jpg') }}" alt="room 2"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/R3.jpg') }}" alt="room 3"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/R4.jpg') }}" alt="room 4"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/R5.jpg') }}" alt="room 5"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/R6.jpg') }}" alt="room 6"></div>
    </div>
</section>

    {{-- ----------- Comments Section --------- --}}
    <div class="comment-section mt-5">
        <h4>Leave a Comment</h4>
        <form>
            <div class="mb-3">
                <label for="comment" class="form-label">Your Comment</label>
                <textarea class="form-control" id="comment" rows="3" placeholder="Write your thoughts..."></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Submit</button>
        </form>
    </div>
</div>

@endsection

