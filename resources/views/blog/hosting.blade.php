@extends('layouts.app')

@section('content')

<style>
/*------------- Hero Section ------------*/
.hero-section {
    position: relative;
    background: url('{{ asset('build/assets/images/blog/H0.jpg') }}') no-repeat center center;
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
/* Blog Content */
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

/* ----------------Sidebar-------------- */
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

/*----------------Action Box--------------- */
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
/*----------- Comments Section--------- */
.comment-section {
    background: #f8f8f8;
    padding: 20px;
    border-radius: 10px;
}

.comment-section h4 {
    color: #2C3E50;
    font-weight: bold;
}

/* ------------Responsive-------- */
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

{{-- --------------- Hero Section ------------- --}}
<div class="hero-section">
    <div class="hero-overlay">
        <h1 class="fw-bold">Hosting an Event? Book a Hall at Stay Sphere</h1>
        <p class="mb-0">By Stay Sphere | Published on Feb 09, 2025</p>
        <div class="link-container">
            <a href="{{ route('blog.blog') }}">Blog</a> >Hosting
        </div>
    </div>
</div>

{{-- -------------- Blog Content Section ----------- --}}
<div class="container my-5">
    <div class="row">

        <div class="col-lg-8">
            <div class="blog-content">
                <p class="lead">Planning a special occasion? Stay Sphere offers elegant halls for all kinds of events, ensuring a seamless experience.</p>
                <p>"Celebrate in style with our spacious, well-equipped event halls!"</p>

                <h4>Book a Hall at Stay Sphere</h4>
                <ul>
                    <p> "Perfect for weddings, corporate meetings, and private gatherings."</p>
                    <p> "Equipped with sound systems, projectors, and comfortable seating."</p>
                    <p> "Enjoy delicious meals and refreshments for your guests."</p>
                    <p> "Whether it's a business conference or a birthday bash, we've got you covered."</p>
                    <p> "Book Your Event Space Today! Contact us to customize your booking as per your needs."</p></p>
                </ul>

                <div class="cta-box mt-4">
                    <h5>Exclusive Offer: 20% Off on Deluxe Rooms!</h5>
                    <p>Book now and enjoy a luxurious stay with us.</p>
                    <a href="{{ route('user.reservations.create') }}" class="btn btn-warning">Book Now</a>
                </div>
            </div>
        </div>

        {{-- ----------- Sidebar Section ------------- --}}
        <div class="col-lg-4">
            <div class="sidebar-section mb-4">
                <h4>Related Blogs</h4>
                <ul class="list-unstyled">
                    <li><a href="{{ route('blog.topRoom') }}"> Ultimate Comfort</a></li>
                    <li><a href="{{ route('blog.guest') }}">Guest Experiences</a></li>
                    <li><a href="{{ route('blog.chefSpecial') }}"> Chef’s Special</a></li>
                </ul>
            </div>

            <div class="sidebar-section">
                <h4>Planning a special event!</h4>
                <p> Our <b>elegant halls </b>provide the perfect venue for meetings, celebrations, and gatherings.</p>
                <a href="{{ route('user.event.index') }}" class="btn btn-warning text-dark">Learn More</a>
            </div>
        </div>
    </div>

{{-- --------- Image Gallery Section ------------- --}}
<section class="gallery-section">
    <h2>Organize Events</h2>
    <div class="gallery-grid">
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/H1.jpg') }}" alt="event 1"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/H2.jpg') }}" alt="event 2"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/events/saminar.jpg') }}" alt="event 3"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/H3.jpg') }}" alt="event 4"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/events/professionalconference.jpg') }}" alt="event 5"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/H4.jpg') }}" alt="event 6"></div>
    </div>
<<<<<<< Updated upstream
</section>
    
=======
  </section>
>>>>>>> Stashed changes
</div>

@endsection


