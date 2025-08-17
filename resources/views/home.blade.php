@extends('layouts.app')
@section('content')
    <style>
        /* General Reset */
        html,
        body {
            overflow-x: hidden;
            /* Prevent horizontal overflow */
            margin: 0;
            /* Reset default margin */
            padding: 0;
            /* Reset default padding */
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            /* Ensure consistent box sizing */
        }

        /* -----------------slider-------------- */
        .carousel-inner img {
            width: 100%;
            height: 90vh;
            object-fit: cover;
        }

        .carousel-caption {
            bottom: 40%;
        }

        @media (max-width: 768px) {
            .carousel-caption {
                bottom: 15%;
                font-size: 14px;
            }
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #f1c40f;
            border: none;
            margin: 5px;
        }

        .reservation-form {
            position: absolute;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .reservation-form form {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }

        .reservation-form input {
            flex: 1;
            min-width: 100px;
        }

        @media (max-width: 768px) {
            .reservation-form {
                width: 90%;
                padding: 10px;
            }

            .reservation-form form {
                flex-direction: column;
                gap: 10px;
            }
        }

        /* --------------about us section------------------ */
        .section-container {
            padding: 120px 0 95px;
        }

        .rounded-img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
            /* Make height auto for responsiveness */
        }

        .position-relative .overlay-img {
            position: absolute;
            width: 50%;
            height: auto;
            /* Make height auto for responsiveness */
            top: 70%;
            right: -115px;
            transform: translateY(-50%);
            border: 5px solid white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .history-title {
            font-family: "Montserrat", Helvetica, sans-serif;
        }

        .history-title small {
            color: #000000;
            font-weight: bold;
            text-transform: uppercase;
        }

        .history-title h2 {
            margin-top: 10px;
            margin-left: 5px;
            font-size: 2rem;
            font-weight: bold;
        }

        .history-text {
            line-height: 1.8;
            color: #000000;
        }

        .row.align-items-center {
            gap: 150px;
        }

        @media (max-width: 1200px) {
            .row.align-items-center {
                gap: 100px;
            }

            .position-relative .overlay-img {
                right: -90px;
            }
        }

        @media (max-width: 760px) {
            .position-relative .overlay-img {
                position: relative;
                width: 70%;
                margin-top: 15px;
                right: 0;
                transform: translateY(0);
            }

            .row.align-items-center {
                gap: 100px;
                margin-left: 3px;
                margin-right: 3px;
            }
        }

        /* ------------------rooms--------------------- */
        .card-hover {
            position: relative;
            overflow: hidden;
        }

        .card-hover .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .card-hover:hover .card-overlay {
            opacity: 1;
        }

        .card-overlay .details {
            font-size: 0.9rem;
            margin-bottom: 10px;
            text-align: center;
        }

        .card-overlay .btn-book {
            background-color: #F1C40F;
            color: white;
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .section-heading {
            text-align: left;
            font-weight: bold;
            font-size: 28px;
        }

        .room-card {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 400px;
        }

        .room-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
            transition: transform 0.3s ease-in-out;
        }

        .room-info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 15px;
            color: white;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0));
            border-radius: 0 0 15px 15px;
        }

        .room-card:hover img {
            transform: scale(1.05);
        }

        .room-info p {
            margin: 0;
            font-size: 14px;
        }

        .room-info h3 {
            font-size: 20px;
            font-weight: bold;
        }

        /---------------------- Hotel Services----------------------/
        .hotel-services {
            padding: 5rem 0;
            background-color: white;
        }

        .service-container {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
        }

        .service-container h2 {
            margin-bottom: 2rem;
            font-weight: bold;
            color: black;
        }

        .service-card {
            border: none;
            background: #343A40;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
            height: 100%;
            color: white;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .icon-wrapper2 {
            width: 70px;
            height: 70px;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f1c40f;
        }

        /* ------------------reviews---------------- */
        .testimonial-section {
            height: 75vh;
            width: 100%;
            background: url('build/assets/images/home/R1.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 50px;
            margin-top: 50px;
        }

        .testimonial-overlay {
            background-color: rgba(245, 238, 238, 0.7);
            border-radius: 110px 110px 0 0;
            box-shadow: 0 4px 6px rgba(245, 243, 243, 0.2);
            color: black;
        }

        .blockquote {
            font-size: 1.5rem;
            font-style: italic;
            line-height: 1.3;
        }

        .blockquote-footer {
            font-size: 1rem;
            font-weight: bold;
            color: #f1c40f;
            background-color: #2C3E50;
        }

        .py-6 {
            padding-top: 3rem;
            padding-bottom: 12rem;
        }

        /* --------------our team---------------- */
        .our-team-section {
            background-color: #ecf0f5;
            color: #ffffff;
        }

        .section-title {
            font-size: 2rem;
            font-weight: bold;
            color: #050505;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #000000;
            margin-top: 10px;
        }

        .team-card {
            background-color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #ddd;
            height: 100%;
        }

        .team-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
        }

        .team-image img {
            width: 120px;
            height: 120px;
            border: 5px solid #1ABC9C;
            padding: 5px;
        }

        .team-description {
            font-size: 0.9rem;
            color: black;
        }

        .social-links a {
            color: black;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #1ABC9C;
        }

        /* -------------------form----------------- */
        .margin_120_95 {
            padding-top: 120px;
            padding-bottom: 95px;
        }

        .title small {
            text-transform: uppercase;
            color: #2C3E50;
            letter-spacing: 3px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .title h2 {
            font-weight: 700;
            font-size: 2.375rem;
            color: #333;
            margin-bottom: 15px;
        }

        .phone_element a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #978667;
        }

        .phone_element a i {
            margin-right: 15px;
            font-size: 1.875rem;
            color: #2C3E50;
        }

        .phone_element a span {
            font-size: 1.125rem;
            font-weight: 600;
            color: #2C3E50;
        }

        .booking_wrapper {
            background-color: rgba(151, 134, 103, 0.05);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #booking_section .row {
            margin: 0;

        }

        #booking_section .col-lg-6 {
            padding: 15px;

        }
    </style>

    {{-- ----------------------- slider---------------- --}}
    {{-- <div id="carouselExampleDark" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
                <img src="{{ asset('build/assets/images/home/slide1.jpg') }}" class="d-block w-100" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h1>StaySphere</h1>
                    <h4>"Experience the Art of Hospitality"</h4>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="2000">
                <img src="{{ asset('build/assets/images/home/slide2.jpg') }}" class="d-block w-100" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h1>StaySphere</h1>
                    <h4>"Stay Easy, Live Luxuriously"</h4>
                </div>
            </div>

            <div class="carousel-item" data-bs-interval="2000">
                <img src="{{ asset('build/assets/images/home/slide3.jpg') }}" class="d-block w-100" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h1>StaySphere</h1>
                    <h4>"Your Stay, Our Priority"</h4>
                </div>
            </div>
        </div>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></button>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>

        <!-- Reservation Form -->
        <div class="reservation-form">
            <form>
                <label for="date" class="me-2">Date</label>
                <input type="date" class="form-control me-2" id="date" required>

                <label for="adults" class="me-2">Adults</label>
                <input type="number" class="form-control me-2" id="adults" min="1" value="1" required>

                <label for="children" class="me-2">Children</label>
                <input type="number" class="form-control me-2" id="children" min="0" value="0">

                <a href="{{ route('user.rooms.index') }}" class="btn btn-warning">Check Availability</a>
            </form>
        </div>
    </div> --}}
    <div id="mainCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    @if($sliders->count() > 0)
        <!-- Indicators -->
        <div class="carousel-indicators">
            @foreach($sliders as $key => $slider)
                <button type="button"
                        data-bs-target="#mainCarousel"
                        data-bs-slide-to="{{ $key }}"
                        class="{{ $key == 0 ? 'active' : '' }}"></button>
            @endforeach
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            @foreach($sliders as $key => $slider)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="3000">
                    <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>{{ $slider->title }}</h1>
                        <h4>"{{ $slider->subtitle }}"</h4>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation -->
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @else
        <!-- Fallback if no sliders -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="d-block w-100 bg-light" style="height: 500px;"></div>
            </div>
        </div>
    @endif
    </div>


    {{-- ---------------------- about us-------------- --}}
    <div class="container section-container">
        <div class="row align-items-center">
            <!-- Left Column: Images -->
            <div class="col-lg-5 col-md-6 position-relative text-center ">
                <img src="{{ asset('build/assets/images/home/A1.jpg') }}" alt="Main Image"
                    class="img-fluid rounded-img main-img">
                <img src="{{ asset('build/assets/images/home/A2.jpg') }}" alt="Overlay Image"
                    class="img-fluid rounded-img overlay-img">
            </div>
            <!-- Right Column: Content -->
            <div class="col-lg-5 col-md-6 margin">
                <div class="history-title">
                    <small>StaySphere Hotel</small>
                    <h2>Our History</h2>
                </div>
                <p class="history-text"> "Where comfort meets luxury" – Stay Sphere has been a sanctuary for travelers
                    seeking warmth and elegance.</p>
                <p class="history-text"> Since its inception, the hotel has embraced a rich tradition of hospitality,
                    blending modern amenities with timeless charm. Designed to offer unforgettable experiences, every detail
                    reflects our commitment to excellence, ensuring a stay that feels like home.</p>
                <p class="history-text"> Creating memories through unparalleled service and exceptional comfort.</p>
            </div>
        </div>
    </div>


    {{-- ----------------------rooms=--------------------- --}}
    <div class="container py-5">
        <h2 class="section-heading">Rooms & Suites</h2>
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-3">
                <div class="room-card card-hover">
                    <img src="{{ asset('build/assets/images/home/R-1.jpg') }}" class="card-img-top" alt="Luxury Room">
                    <div class="room-info">
                        <h5 class="card-title">Luxury Room</h5>
                        <p class="card-text">30000 / Per Night</p>
                    </div>
                    <div class="card-overlay">
                        <div class="details">
                            <p>4 Guests</p>
                            <p>70ft Room Size</p>
                            <p>30000 / Per Night</p>
                        </div>
                        <a href="{{ route('user.reservations.create') }}" class="btn-book">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="room-card card-hover">
                    <img src="{{ asset('build/assets/images/room12.jpg') }}" class="card-img-top" alt="Deluxe Room">
                    <div class="room-info">
                        <h5 class="card-title">Deluxe Room</h5>
                        <p class="card-text">25000 / Per Night</p>
                    </div>
                    <div class="card-overlay">
                        <div class="details">
                            <p>2 Guests</p>
                            <p>35ft Room Size</p>
                            <p>25000 / Per Night</p>
                        </div>
                        <a href="{{ route('user.reservations.create') }}" class="btn-book">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="room-card card-hover">
                    <img src="{{ asset('build/assets/images/room14.jpg') }}" class="card-img-top" alt="Family Suite">
                    <div class="room-info">
                        <h5 class="card-title">Family Suite</h5>
                        <p class="card-text">20000 / Per Night</p>
                    </div>
                    <div class="card-overlay">
                        <div class="details">
                            <p>4 Guests</p>
                            <p>60ft Room Size</p>
                            <p>20000 / Per Night</p>
                        </div>
                        <a href="{{ route('user.reservations.create') }}" class="btn-book">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('user.rooms.index') }}" class="btn btn-warning">View all Rooms</a>
        </div>
    </div>

    {{-- ------------------ Hotel Services------------------ --}}
    <div class="hotel-services py-2">
        <div class="position-relative ">
            <div class="container position-relative service-container">
                <h2 class="text-center">Main Facilities</h2>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <div class="icon-wrapper2">
                                    <i class="bi bi-house-door fs-1"></i>
                                </div>
                                <h4 class="mt-3">Luxurious Rooms</h4>
                                <p>Comfortable, spacious rooms with breathtaking views.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <div class="icon-wrapper2">
                                    <i class="bi bi-water fs-1"></i>
                                </div>
                                <h4 class="mt-3">Swimming Pool</h4>
                                <p>Relax and rejuvenate in our luxurious pool area.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <div class="icon-wrapper2">
                                    <i class="bi bi-bar-chart fs-1"></i>
                                </div>
                                <h4 class="mt-3">Fitness Center</h4>
                                <p>Stay active with state-of-the-art fitness equipment.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <div class="icon-wrapper2">
                                    <i class="bi bi-headset fs-1"></i>
                                </div>
                                <h4 class="mt-3">24/7 Customer Service</h4>
                                <p>We're here to assist you at all times.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <div class="icon-wrapper2">
                                    <i class="bi bi-briefcase fs-1"></i>
                                </div>
                                <h4 class="mt-3">Meeting Room</h4>
                                <p>Host professional meetings with state-of-the-art facilities.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <div class="icon-wrapper2">
                                    <i class="bi bi-calendar-event fs-1"></i>
                                </div>
                                <h4 class="mt-3">Event Management</h4>
                                <p>Manage events like conferences, weddings, and parties.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- --------------------- reviews------------------ --}}
    <section class="testimonial-section">
        <div class="container text-center text-light">
            <div class="text-center mb-5">
                <h2>Reviews</h2>
            </div>

            <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-10 col-lg-8">
                                <div class="testimonial-overlay text-center p-4">
                                    <blockquote class="blockquote">
                                        "The hotel exceeded our expectations with its exceptional service and cozy ambiance.
                                        A perfect stay!"
                                    </blockquote>
                                    <footer class="blockquote-footer text-warning mt-3">
                                        Donette Fondren
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item" data-bs-interval="2000">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-10 col-lg-8">
                                <div class="testimonial-overlay text-center p-4">
                                    <blockquote class="blockquote">
                                        "The staff was incredibly attentive and made our stay truly special. Highly
                                        recommend!"
                                    </blockquote>
                                    <footer class="blockquote-footer text-warning mt-3">
                                        John Doe
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item" data-bs-interval="2000">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-10 col-lg-8">
                                <div class="testimonial-overlay text-center p-4">
                                    <blockquote class="blockquote">
                                        "A perfect getaway! The amenities were top-notch and the ambiance was relaxing."
                                    </blockquote>
                                    <footer class="blockquote-footer text-warning mt-3">
                                        Jane Smith
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

                <!-- Carousel Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
            </div>
        </div>
    </section>

    {{-- ----------------------our team----------------- --}}
    <div class="our-team-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Meet Our Team</h2>
                <p class="section-subtitle">A dedicated team of professionals bringing luxury and comfort to your stay.</p>
            </div>
            <div class="row gy-4 text-dark">
                {{-- --1 -- --}}
                <div class="col-md-4">
                    <div class="team-card text-center p-4 shadow rounded">
                        <div class="team-image">
                            <img src="{{ asset('build/assets/images/client2.jpg') }}" alt="Team Member 1"
                                class="img-fluid rounded-circle">
                        </div>
                        <h5 class="mt-3">John Doe</h5>
                        <p>CEO & Founder</p>
                        <p class="team-description">John has 15+ years of experience in hospitality, ensuring top-notch
                            service and luxury for every guest.</p>
                        <div class="social-links mt-3">
                            <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                {{-- -- 2 -- --}}
                <div class="col-md-4">
                    <div class="team-card text-center p-4 shadow rounded">
                        <div class="team-image">
                            <img src="{{ asset('build/assets/images/client3.jpg') }}" alt="Team Member 2"
                                class="img-fluid rounded-circle">
                        </div>
                        <h5 class="mt-3">Jane Smith</h5>
                        <p>General Manager</p>
                        <p class="team-description">Jane is an expert in managing operations and ensuring a smooth
                            experience for all our guests.</p>
                        <div class="social-links mt-3">
                            <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                {{-- -- 3 -- --}}
                <div class="col-md-4">
                    <div class="team-card text-center p-4 shadow rounded">
                        <div class="team-image">
                            <img src="{{ asset('build/assets/images/client1.jpg') }}" alt="Team Member 3"
                                class="img-fluid rounded-circle">
                        </div>
                        <h5 class="mt-3">Emily Rose</h5>
                        <p>Head of Marketing</p>
                        <p class="team-description">Emily crafts exceptional marketing strategies that bring the Stay
                            Sphere experience to the world.</p>
                        <div class="social-links mt-3">
                            <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- -------------------------form---------------------- --}}
    <div class="container py-5" id="booking_section">
        <div class="row justify-content-between align-items-start">
            <div class="col-lg-6 mb-4">
                <div class="title">
                    <small>StaySphere Hotel</small>
                    <h2>Check Availability</h2>
                </div>
                <p>Discover the ultimate luxury experience. Book your stay with us for unforgettable memories.</p>
                <p class="phone_element no_borders">
                    <a href="tel://423424234">
                        <i class="bi bi-telephone-fill"></i>
                        <span>
                            <em>Info and bookings</em> <br>+92 123 456 7890
                        </span>
                    </a>
                </p>
            </div>

            <div class="col-lg-6">
                <div class="booking_wrapper bg-light p-4 rounded shadow">
                    <form>
                        <div class="mb-3">
                            <input type="date" class="form-control" id="date_booking" name="date_booking"
                                placeholder="Select Date" required>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <select class="form-select" required>
                                    <option value="" disabled selected>Select Room</option>
                                    <option>Double Room</option>
                                    <option>Deluxe Room</option>
                                    <option>Superior Room</option>
                                    <option>Junior Suite</option>
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" class="form-control" id="adults_booking"
                                            placeholder="Adults" min="1" required>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control" id="childs_booking"
                                            placeholder="Children" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="rounded-pill px-4 py-2">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
