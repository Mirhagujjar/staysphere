@extends('layouts.app')

@section('content')
    <style>

        section {
            padding: 60px 0;
        }

        .section-heading {
            font-size: 2.8rem;
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        .section-description {
            text-align: center;
            color: #777;
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        /* History Section Styles */
        .history-section {
            background-color: #eee;
            padding: 40px 0;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .history-section img {
            width: 100%;
            height: 400px;
            object-fit:cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .history-section h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .history-section p {
            color:  #333;
            font-size: 1.2rem;
            line-height: 1.8;
            text-align: justify;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            text-align: center;
        }

        /* Services Section Styles */
        .services-section {
            background-color: #fff;
            border-radius: 8px;
            padding: 40px 0;
            text-align: center;
        }

        .services-section h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }

        .services-section .service-card {
            border: none;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 25px;

        }
        .service-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .service-card h4 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .service-card p {
            color: #666;
            font-size: 1.2rem;
        }


    </style>

    <!-- History Section -->
    <section id="history" class="history-section">
        <div class="container">
            <h2 class="section-heading">Our History</h2>
            <img src="{{ asset('assets/images/bg2.png') }}" alt="History Image">
            <p class="section-description">
                Our company was founded with a vision to bring innovation and customer satisfaction. Over the years, we have grown, expanding our reach and services to new heights. Our mission is simple: to provide the best solutions and build lasting relationships with our clients.
            </p>
        </div>
    </section>


    <section id="team">
        <h2 class="text-center">Meet Our Team</h2>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="assets/images/img1.jpg" class="card-img-top" alt="Team Member 1">
                    <div class="card-body">
                        <h5 class="card-title">Team Member 1</h5>
                        <p class="card-text">Role: CEO</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="assets/images/img2.jpg" class="card-img-top" alt="Team Member 2">
                    <div class="card-body">
                        <h5 class="card-title">Team Member 2</h5>
                        <p class="card-text">Role: Manager</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="assets/images/img3.jpg" class="card-img-top" alt="Team Member 3">
                    <div class="card-body">
                        <h5 class="card-title">Team Member 3</h5>
                        <p class="card-text">Role: Developer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <h2 class="section-heading">Our Services</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('assets/images/img1.jpg') }}" alt="Service 1">
                        <h4>Service 1</h4>
                        <p>We provide high-quality service 1 tailored to meet your specific needs. Discover our unique approach to solving problems.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('assets/images/img1.jpg') }}" alt="Service 2">
                        <h4>Service 2</h4>
                        <p>Our team of experts will work with you to implement service 2, ensuring smooth and effective results. Reach new heights with our services.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('assets/images/img1.jpg') }}" alt="Service 3">
                        <h4>Service 3</h4>
                        <p>Explore the latest in technology with our service 3. We offer solutions that are not only efficient but also future-proof.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection





































{{-- @extends('layouts.master')

@section('content')
    <style>

        section {
            padding: 60px 0;
        }

        .section-heading {
            font-size: 2.8rem;
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        .section-description {
            text-align: center;
            color: #777;
            font-size: 1.1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        /* History Section Styles */
        .history-section {
            background-color: #eee;
            padding: 40px 0;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .history-section img {
            width: 100%;
            height: 400px;
            object-fit:cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .history-section h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .history-section p {
            color:  #333;
            font-size: 1.2rem;
            line-height: 1.8;
            text-align: justify;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            text-align: center;
        }

        /* Services Section Styles */
        .services-section {
            background-color: #fff;
            border-radius: 8px;
            padding: 40px 0;
            text-align: center;
        }

        .services-section h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }

        .services-section .service-card {
            border: none;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 25px;

        }
        .service-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .service-card h4 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }

        .service-card p {
            color: #666;
            font-size: 1.2rem;
        }


    </style> --}}

    <!-- History Section -->
    {{-- <section id="history" class="history-section">
        <div class="container">
            <h2 class="section-heading">Our History</h2>
            <img src="{{ asset('build/assets/images/slider7.jpg') }}" alt="History Image">
            <p class="section-description">
                Our company was founded with a vision to bring innovation and customer satisfaction. Over the years, we have grown, expanding our reach and services to new heights. Our mission is simple: to provide the best solutions and build lasting relationships with our clients.
            </p>
        </div>
    </section> --}}

{{-- 
    <section id="team">
        <h2 class="text-center">Meet Our Team</h2>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <img src="{{ asset('build/assets/images/d.jpeg') }}" class="card-img-top" alt="Team Member 1">
                    <div class="card-body">
                        <h5 class="card-title">Team Member 1</h5>
                        <p class="card-text">Role: CEO</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <img src="{{ asset('build/assets/images/d1.jpeg') }}" class="card-img-top" alt="Team Member 2">
                    <div class="card-body">
                        <h5 class="card-title">Team Member 2</h5>
                        <p class="card-text">Role: Manager</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <img src="{{ asset('build/assets/images/d2.jpeg') }}" class="card-img-top" alt="Team Member 3">
                    <div class="card-body">
                        <h5 class="card-title">Team Member 3</h5>
                        <p class="card-text">Role: Developer</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}




    <!-- Services Section -->
    {{-- <section id="services" class="services-section">
        <div class="container h-100">
            <h2 class="section-heading">Our Services</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('build/assets/images/room33.jpg') }}" alt="Service 1">
                        <h4>Service 1</h4>
                        <p>We provide high-quality service 1 tailored to meet your specific needs. Discover our unique approach to solving problems.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('build/assets/images/room32.jpg') }}" alt="Service 2">
                        <h4>Service 2</h4>
                        <p>Our team of experts will work with you to implement service 2, ensuring smooth and effective results. Reach new heights with our services.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <img src="{{ asset('build/assets/images/room31.jpg') }}" alt="Service 3">
                        <h4>Service 3</h4>
                        <p>Explore the latest in technology with our service 3. We offer solutions that are not only efficient but also future-proof.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container mt-4">

        <div class="row">
            <div class="col-md-12">
                <h3>Basic Hotel Services</h3>
                <ul>
                    <li>Room Service</li>
                    <li>Housekeeping</li>
                    <li>Concierge</li>
                    <li>Reception/Front Desk</li>
                    <li>Wi-Fi/Internet Access</li>
                </ul>
            </div>
            <div class="col-md-12">
                <h3>Food & Beverage Services</h3>
                <ul>
                    <li>Restaurants</li>
                    <li>Bars and Lounges</li>
                    <li>Cafes and Snack Bars</li>
                    <li>In-Room Dining</li>
                </ul>
            </div>
            <div class="col-md-12">
                <h3>Recreational & Wellness</h3>
                <ul>
                    <li>Swimming Pool</li>
                    <li>Fitness Center</li>
                    <li>Spa & Massage</li>
                    <li>Sauna & Steam Room</li>
                </ul>
            </div>
        </div>
    
        <h2>Our Services</h2>
        <p>We offer a variety of services to ensure a comfortable and enjoyable stay:</p>
        <ul>
            <li>Room Service</li>
            <li>Free Wi-Fi</li>
            <li>Swimming Pool</li>
            <li>Spa and Wellness Center</li>
            <li>Restaurant and Bar</li>
            <li>Concierge Service</li>
            <li>Airport Shuttle</li>
        </ul>
    
    </div>
@endsection --}}