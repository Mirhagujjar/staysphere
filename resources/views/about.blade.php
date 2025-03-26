@extends('layouts.app')

@section('content')
    <style>
        * {

            box-sizing: border-box;
        }

        html,
        body {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* ------------------------------- Top Banner ------------------------ */
        .half-screen-image {
            background: url('{{ asset('build/assets/images/about1.jpg') }}') center/cover no-repeat;
            position: relative;
            height: 75vh;

        }

        .overlay-text {

            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #F8F9FA;
        }

        .overlay-text h1 {
            font-size: 4rem;
            margin: 0;
        }

        p.lead {
            font-size: 18px;
            line-height: 32px;
            margin-top: 0;
            font-weight: 300;
        }

        .breadcrumb-container {
            margin-top: 10px;
            font-size: 20px;
            font-weight: 500;
            color: #F8F9FA;
        }

        .breadcrumb-container a {
            text-decoration: none;
            color: #F1C40F;
        }

        .breadcrumb-container a:hover {
            color: #1ABC9C;
        }


        /* -------------------------2------------------------ */

        .section-container {
            padding: 120px 0 95px;
        }

        .rounded-img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
        }

        .position-relative .overlay-img {
            position: absolute;
            width: 50%;
            top: 50%;
            right: -115px;
            transform: translateY(-50%);
            border: 5px solid white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .margin {
            margin-right: 1em;
            margin-left: 1em;
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

        /* Responsiveness*/
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


        /* ---------------------------------3------------------------------ */
        .testimonial-section {
            position: relative;
            padding: 100px 0;
            color: white;
            overflow: hidden;
        }

        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .section-clients {
            font-size: 2rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .testimonial-card {
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            max-width: 600px;
            border-radius: 10px;
        }

        .comment {
            font-style: italic;
            color: #ddd;
            font-size: 0.9rem;
        }

        .dot {
            width: 12px;
            height: 12px;
            margin: 5px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            display: inline-block;
            cursor: pointer;
        }

        .dot.active {
            background-color: white;
        }

        /* ----------------------------4------------------------ */
        .our-team-section {
            background-color: #f8f9fa;
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
            background-color: #343A40;
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
            color: #ffffff;
        }

        .social-links a {
            color: #ffffff;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #1ABC9C;
        }

        /* ------------------------------------5---------------------------- */

        .faq-section {
            margin-top: 50px;
            background-color: #343A40;
            padding: 50px 0;
        }

        .title small {
            color: #ffffff;
            font-size: 0.9rem;
        }

        .title h3 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ffffff;
        }

        .title p {
            color: #ffffff;
        }

        .accordion .card {
            border: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .accordion .card-header {
            background-color: #fff;
            border-bottom: none;
            padding: 15px 20px;
        }

        .accordion .btn-link {
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            color: #2c3e50;
            display: flex;
            align-items: center;
        }

        .accordion .btn-link i {
            transition: transform 0.3s ease;
        }

        .accordion .btn-link.collapsed i {
            transform: rotate(0deg);
        }

        .accordion .btn-link:not(.collapsed) i {
            transform: rotate(45deg);
        }

        .accordion .card-body {
            background-color: #fff;
            color: #6c757d;
            padding: 20px;
            font-size: 0.95rem;
        }
    </style>

    {{-- Top Banner --}}
    <div class="half-screen-image">
        <div class="half-screen-image">
            <div class="overlay-text">
                <p class="mt-3 lead">Luxury Hotel Experience</p>
                <h1>ABOUT US</h1>

                <div class="breadcrumb-container">
                    <a href="/">Home</a> > AboutUs
                </div>
            </div>
        </div>
    </div>


    {{-- --------------------2------------------------- --}}

    <div class="container section-container">
        <div class="row align-items-center">
            {{-- -- Left---- --}}
            <div class="col-lg-5 col-md-6 position-relative text-center ">
                <img src="{{ asset('build/assets/images/about3.jpg') }}" alt="Main Image" class="img-fluid rounded-img main-img">
                <img src="{{ asset('build/assets/images/about2.jpg') }}" alt="Overlay Image"
                    class="img-fluid rounded-img overlay-img">
            </div>
            {{-- ------- Right----- --}}
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

    {{-- -----------------------3-------------------- --}}
    <div class="testimonial-section position-relative">
        {{-- - Video Background -- --}}
        <video autoplay muted loop class="video-background">
            <source src="{{ asset('build/assets/videos/v1.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>



        <div class="container text-center">
            <h3 class="section-clients">What Clients Say</h3>


            <div id="testimonialCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="testimonial-card mx-auto shadow-lg p-4 rounded">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('build/assets/images/client1.jpg') }}" alt="Client 1" class="rounded-circle"
                                    style="width: 70px; height: 70px; object-fit: cover; margin-right: 15px;">
                                <div>
                                    <h5 class="mb-0">Roberta</h5>
                                    <small>12 Oct</small>
                                </div>
                            </div>
                            <p class="comment mt-3">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad
                                minim veniam."</p>
                        </div>
                    </div>


                    <div class="carousel-item">
                        <div class="testimonial-card mx-auto shadow-lg p-4 rounded">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('build/assets/images/client2.jpg') }}" alt="Client 2" class="rounded-circle"
                                    style="width: 70px; height: 70px; object-fit: cover; margin-right: 15px;">
                                <div>
                                    <h5 class="mb-0">John</h5>
                                    <small>22 Nov</small>
                                </div>
                            </div>
                            <p class="comment mt-3">"Curabitur blandit tempus porttitor. Praesent commodo cursus magna."</p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="testimonial-card mx-auto shadow-lg p-4 rounded">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('build/assets/images/client3.jpg') }}" alt="Client 3" class="rounded-circle"
                                    style="width: 70px; height: 70px; object-fit: cover; margin-right: 15px;">
                                <div>
                                    <h5 class="mb-0">Sarah</h5>
                                    <small>5 Dec</small>
                                </div>
                            </div>
                            <p class="comment mt-3">"Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor."
                            </p>
                        </div>
                    </div>


                    <div class="carousel-item">
                        <div class="testimonial-card mx-auto shadow-lg p-4 rounded">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('build/assets/images/client3.jpg') }}" alt="Client 4"
                                    class="rounded-circle"
                                    style="width: 70px; height: 70px; object-fit: cover; margin-right: 15px;">
                                <div>
                                    <h5 class="mb-0">Emily</h5>
                                    <small>18 Dec</small>
                                </div>
                            </div>
                            <p class="comment mt-3">"Aenean lacinia bibendum nulla sed consectetur. Nulla vitae elit
                                libero."</p>
                        </div>
                    </div>
                </div>


                <div class="testimonial-dots mt-4">
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="dot"
                        aria-current="true"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"
                        class="dot"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2"
                        class="dot"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="3"
                        class="dot"></button>
                </div>
            </div>
        </div>
    </div>

    {{-- ---------------------------------4-------------------------- --}}
    <div class="our-team-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Meet Our Team</h2>
                <p class="section-subtitle">A dedicated team of professionals bringing luxury and comfort to your stay.</p>
            </div>
            <div class="row gy-4">


                <div class="col-md-4">
                    <div class="team-card text-center p-4 shadow rounded">
                        <div class="team-image">
                            <img src="{{ asset('build/assets/images/team1.jpg') }}" alt="Team Member 1"
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


                <div class="col-md-4">
                    <div class="team-card text-center p-4 shadow rounded">
                        <div class="team-image">
                            <img src="{{ asset('build/assets/images/team1.jpg') }}" alt="Team Member 2"
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

    {{-- -----------------------5--------------------------- --}}

    <div class="faq-section py-5">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-4">
                    <div class="title mb-4">
                        <small>StaySphere FAQ</small>
                        <h3 class="mb-3">Frequently Asked Questions</h3>
                        <p>Can’t find your question in the list? Let us know your queries, and we’ll get back to you!</p>
                        <a href="{{ route('contact.index') }}" class="btn btn-warning mt-3">Contact Us</a>
                    </div>
                </div>


                <div class="col-lg-7">
                    <div class="accordion" id="faqAccordion">

                        <div class="card mb-3">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <i class="bi bi-plus-circle me-2"></i> What is your cancellation policy?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    We offer a 24-hour cancellation policy. Any cancellations made within 24 hours will be
                                    charged a cancellation fee.
                                </div>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="bi bi-plus-circle me-2"></i> How can I make a payment?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    Payments can be made online using your credit card or through bank transfers. We also
                                    accept payment upon check-in.
                                </div>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <i class="bi bi-plus-circle me-2"></i> What are the check-in and check-out timings?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    Check-in starts at 2:00 PM, and check-out is until 11:00 AM. Early check-in or late
                                    check-out can be arranged upon request.
                                </div>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        <i class="bi bi-plus-circle me-2"></i> Is your hotel accessible for disabled
                                        guests?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                data-bs-parent="#faqAccordion">
                                <div class="card-body">
                                    Yes, our hotel is fully accessible for disabled guests, with wheelchair ramps,
                                    elevators, and specially designed rooms.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
