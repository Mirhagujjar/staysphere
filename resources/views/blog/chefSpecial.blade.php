@extends('layouts.app')

@section('content')

<style>
/* Hero Section */
.hero-section {
    position: relative;
    background: url('{{ asset('build/assets/images/blog/3.jpg') }}') no-repeat center center;
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

/* Sidebar */
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
    /* font-weight: bold; */
}

.sidebar-section a:hover {
    color:#1ABC9C;
}

/* Call-to-Action Box */
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

/* Gallery Section */

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

/* Grid Layout */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    padding: 20px;
}

/* Gallery Images */
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

/* Comments Section */
.comment-section {
    background: #f8f8f8;
    padding: 20px;
    border-radius: 10px;
}

.comment-section h4 {
    color: #2C3E50;
    font-weight: bold;
}

/* Responsive */
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

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-overlay">
        <h1 class="fw-bold">Chef’s Special: Must-Try Dishes at Stay Sphere</h1>
        <p class="mb-0">By Stay Sphere | Published on 📅 Feb 09, 2025</p>
        <div class="link-container">
            <a href="{{ route('blog.blog') }}">Blog</a> >chefSpecial
        </div>
    </div>
</div>

<!-- Blog Content Section -->
<div class="container my-5">
    <div class="row">
        <!-- Blog Main Content -->
        <div class="col-lg-8">
            <div class="blog-content">
                <p class="lead">Indulge in a delightful culinary experience with our chef’s top recommendations. Savor the flavors of our finest dishes, made with love and fresh ingredients.</p>
                <p>"Experience a fusion of taste and tradition with our handpicked specialties."</p>

                <h4>Top Must-Try Dishes</h4>
                <ul>
                    <p>👨‍🍳 Signature Stay Sphere Platter – A perfect mix of grilled meats, seafood, and veggies.</p>
                    <p>🥘 Royal Biryani – Fragrant basmati rice layered with aromatic spices and tender meat.</p>
                    <p>🍝 Creamy Alfredo Pasta – A rich, cheesy delight with a touch of garlic and herbs.</p>
                    <p>🥩 Sizzling Steak – Juicy, perfectly grilled steak served with signature sauce.</p>
                    <p>🍰 Chocolate Lava Cake – A sweet ending with warm, gooey chocolate indulgence.</p></p>
                </ul>

                <!-- Hotel Promotion Section -->
                <div class="cta-box mt-4">
                    <h5>Exclusive Offer: 20% Off on Deluxe Rooms!</h5>
                    <p>Book now and enjoy a luxurious stay with us.</p>
                    <a href="{{ route('reservations.create') }}" class="btn btn-warning">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Sidebar Section -->
        <div class="col-lg-4">
            <div class="sidebar-section mb-4">
                <h4>Related Blogs</h4>
                <ul class="list-unstyled">
                    <li><a href="{{ route('blog.topRoom') }}">🛏️ Ultimate Comfort</a></li>
                    <li><a href="{{ route('blog.guest') }}">⭐Guest Experiences</a></li>
                    <li><a href="{{ route('blog.hosting') }}">🎉 Hosting an Event?</a></li>
                    <li><a href="{{ route('blog.topRoom') }}">💰 Special Winter Discount</a></li>
                </ul>
            </div>

            <div class="sidebar-section">
                <h4>Must-Try Dishes</h4>
                <p>Indulge in our <b>chef’s finest creations</b>, crafted to give you an unforgettable dining experience.</p>
                <a href="{{ route('menu') }}" class="btn btn-warning text-dark">Learn More</a>
            </div>
        </div>
    </div>

<!-- Image Gallery Section -->
<section class="gallery-section">
    <h2>Chef’s Special</h2>
    <div class="gallery-grid">
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/f1.jpg') }}" alt="menu 1"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/f2.jpg') }}" alt="menu 2"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/f3.jpg') }}" alt="menu 3"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/blog/f4.jpg') }}" alt="menu 4"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/menu/dinner/3.jpg') }}" alt="menu 5"></div>
        <div class="gallery-item"><img src="{{ asset('build/assets/images/menu/lunch/4.jpg') }}" alt="menu 6"></div>
    </div>
</section>
    <!-- Comments Section -->
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