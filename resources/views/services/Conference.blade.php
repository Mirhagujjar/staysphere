@extends('layouts.app')

@section('content')

<style>
    .half-screen-image {
        position: relative;
        height: 70vh;
        background: url('{{ asset('build/assets/images/meeting1.jpg') }}') bottom/cover no-repeat;
    }

    .overlay-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: rgb(7, 7, 31);
    }

    .overlay-text h1 {
        font-size: 3rem;
        margin: 0;
    }

    .breadcrumb-container {
        margin-top: 10px;
        font-size: 18px;
        font-weight: 500;
        color: #798684;
    }

    .breadcrumb-container a {
        text-decoration: none;
        color: #546d68;
    }

    .breadcrumb-container a:hover {
        color: #58f0d1;
    }

    .hover-effect:hover {
        color: #cc8800 !important;
    }

    .card-img-top {
        width: 100%;
        height: auto;
    }

    .floating-box {
        width: 90%;
        max-width: 500px;
        background: white;
        bottom: -50px;
    }

    .facilities-list {
        display: flex;
        justify-content: start;
        gap: 4px;
        margin-bottom: 4px;
    }
</style>

<div class="main">
    <div class="half-screen-image">
        <div class="overlay-text">
            <h1>Event & Conference Services</h1>
            <h3>"Experience Luxury, Comfort, and Excellence <br> Our Services, Your Satisfaction!"</h3>
            <div class="breadcrumb-container">
                <a href="{{ route('services') }}">Home</a> > services
            </div>
        </div>
    </div>
</div>

<div class="container mt-4 py-5">
    <div class="row justify-content-center">
        <h2 class="text-center mb-4" style="color: #2C3E50;">Our Hotel Services</h2>
        <div class="col-lg-8 p-2">
            <div class="card shadow-lg p-2">
                <img src="{{asset('build/assets/images/mr7.jpg')}}" class="card-img-top" alt="Hotel Service">
                <div class="card-body p-2">
                    <h2 class="card-title">Event & Conference Services</h2>
                    <p>Our Event & Conference Services provide the perfect venue for hosting memorable gatherings, business meetings, and grand celebrations.</p>
                    <blockquote class="blockquote">
                        <p>"Your Vision, Our Expertise – Perfectly Planned Events."</p>
                    </blockquote>
                    <h4>Our Facilities</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle"></i> Spacious Banquet Halls & Conference Rooms – Ideal for corporate and social events.</li>
                        <li><i class="bi bi-check-circle"></i> State-of-the-Art Audiovisual Equipment – High-tech solutions for seamless presentations.</li>
                        <li><i class="bi bi-check-circle"></i> Professional Event Planning – Expert assistance in organizing and managing events.</li>
                        <li><i class="bi bi-check-circle"></i> Customized Catering Services – Diverse menu options tailored to suit any occasion.</li>
                        <li><i class="bi bi-check-circle"></i> High-Speed Wi-Fi & Business Support – Ensuring smooth communication and productivity.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-lg p-3">
                <h4 class="text-center">Other Services</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ url('/services/housekeeping') }}" class="text-warning text-decoration-none fw-bold hover-effect">Housekeeping Services</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Dining') }}" class="text-warning text-decoration-none fw-bold hover-effect">Food & Dining</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Fitness') }}" class="text-warning text-decoration-none fw-bold hover-effect">Wellness & Fitness Services</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Conference') }}" class="text-warning text-decoration-none fw-bold hover-effect">Event & Conference Services</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Security') }}" class="text-warning text-decoration-none fw-bold hover-effect">Guest Assistance & Security</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/mr0.jpg') }}" class="card-img-top" alt="Service 1">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/mr4.jpg') }}" class="card-img-top" alt="Service 2">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/mr5.jpg') }}" class="card-img-top" alt="Service 3">
            </div>
        </div>
    </div>
</div>

<div class="container my-5 py-5">
    <div class="position-relative col-md-8">
        <div style="width: 500px; height: 400px; overflow: hidden;">
            <img src="{{asset('build/assets/images/mr3.jpg')}}" class="img-fluid rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="position-absolute start-50 p-4 shadow-lg rounded floating-box">
            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2" style="color: #2C3E50;">Event & Conference Services</h2>
            <p class="text-muted">"Professional Spaces for Productive Meetings"</p>
            <div class="facilities-list">
                <h6>Facilities:</h6>
                <span><i class="bi bi-music-note-beamed"></i> Venue for weddings, parties, and events.</span>
                <span><i class="bi bi-gift"></i> Special celebrations with decorations.</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('events') }}" class="btn btn-warning rounded-pill">
                    <i class="bi bi-arrow-right-circle"></i> Book Now
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
