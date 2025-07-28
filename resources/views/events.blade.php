@extends('layouts.app')
@section('content')

<style>

    .hero-section {
    background-size: cover;
    background-position: center;
    height: 450px; /* 👈 Increase this value for more height */
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
}

.hero-text h1 {
    font-size: 48px;
    margin-bottom: 10px;
}

.hero-text p {
    font-size: 20px;
}

    /* ------------------------------2nd section------------------------ */
    .card-text-overlay {
        position: absolute;
        bottom: 10px;
        left: 10px;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }

    .card-text-overlay button {
        background: transparent;
        border: none;
        color: rgb(12, 11, 11);
        font-size: 1.2rem;
        cursor: pointer;
    }

    .carousel-indicators {
        position: absolute;
        bottom: -50px;
    }

    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgb(3, 3, 3);
    }

    .section-title {
        font-size: 2rem;
        margin-bottom: 30px;
        text-align: center;
        font-weight: bold;
    }

    /* ----------------------3rd section------------------ */
    .card-container1 {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-top: 50px;
    }

    .custom-card1 {
        position: relative;
        width: 23%; /* 4 cards in a row with space */
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px; /* Added margin for spacing */
    }

    .custom-card1 img {
        width: 100%;
        height: auto; /* Changed to auto for better responsiveness */
        object-fit: cover;
    }

    .custom-card1 .bottom-text1 {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }

    /* -------------------------4th section---------------------- */
    .text-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px;
        text-align: center;
    }

    .text-section h2 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .text-section p {
        font-size: 1rem;
        color: #555;
        line-height: 1.6;
    }

    .image-section img {
        width: 100%;
        height: auto; /* Changed to auto for better responsiveness */
        border-radius: 10px;
        object-fit: cover;
    }

    .row:nth-child(even) .image-section {
        order: 2;
    }

    .row:nth-child(even) .text-section {
        order: 1;
    }

    .mb-5 {
        margin-right: 10px;
        margin-left: 10px;
    }

    /* --------------------form section-------------- */
    .booking-form {
        background: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .booking-form .form-control,
    .booking-form .form-select {
        font-size: 14px;
        padding: 8px;
    }

    .booking-form .btn {
        background-color: #F1C40F;
        border: none;
        font-size: 16px;
        font-weight: bold;
    }

    .booking-form .btn:hover {
        background-color: #148F77;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-section {
            padding: 100px 10px; /* Adjust padding for smaller screens */
        }

        .hero-section h1 {
            font-size: 2rem; /* Adjust font size for smaller screens */
        }

        .custom-card1 {
            width: 48%; /* Two cards in a row on smaller screens */
        }

        .text-section h2 {
            font-size: 1.5rem; /* Adjust heading size for smaller screens */
        }

        .text-section p {
            font-size: 0.9rem; /* Adjust paragraph size for smaller screens */
        }
    }

    @media (max-width: 576px) {
        .custom-card1 {
            width: 100%; /* Stack cards on extra small screens */
        }
    }
</style>

<!----------------- Hero Section ------------->
{{-- <div class="hero-section">
    <h1>Plan Your Events</h1>
    <p>Discover venues and services that make your events unforgettable.</p>
    <div class="breadcrumb-container">
        <a href="/">Home</a> > Events
    </div>
</div> --}}
<section class="hero-section" style="background-image: url('{{ asset('storage/' . $hero->hero_image) }}')">
    <div class="hero-text">
        <h1>{{ $hero->hero_title }}</h1>
        <p>{{ $hero->hero_description }}</p>
        <a href="/">Home</a> > Events

    </div>
</section>


<!------------------2nd Section------------------------ -->
{{-- <div class="container mt-5">
    <div class="text-section mt-3">
        <h2>Social Events</h2>
        <p>Celebrate special moments, big and small.</p>
    </div>
    <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner mb-5">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="{{ asset('build/assets/images/events/2.jpg') }}" height="234vh" class="card-img-top" alt="Business Meetings">
                            <div class="card-text-overlay">
                                <h5>Business Meetings</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="{{ asset('build/assets/images/events/saminar.jpg') }}" height="234vh" class="card-img-top" alt="Seminars">
                            <div class="card-text-overlay">
                                <h5>Seminars</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="{{ asset('build/assets/images/events/private.jpg') }}" height="234vh" class="card-img-top" alt="gathring">
                            <div class="card-text-overlay">
                                <h5>Private Gathering</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="{{ asset('build/assets/images/events/sufinight.jpg') }}" height="234vh" class="card-img-top" alt="sufi night">
                            <div class="card-text-overlay">
                                <h5>Sufi Night</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="{{ asset('build/assets/images/events/bayan.jpg') }}" height="234vh" class="card-img-top" alt="bayan">
                            <div class="card-text-overlay">
                                <h5>Islamic Conference</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card position-relative">
                            <img src="{{ asset('build/assets/images/events/exhibition.jpg') }}" height="234vh" class="card-img-top" alt="Exhibitions">
                            <div class="card-text-overlay">
                                <h5>Exhibitions</h5>
                                <button><i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
    </div>
</div> --}}

<!--  .......................3rd section........................  -->
<div class="container py-5">
    <div class="text-section mt-3">
        <h1>Trends & Highlights</h1>
        <p>Get inspired: Trends, tips and more.</p>
    </div>
    <div class="card-container1">
        @foreach($events as $event)
            <div class="custom-card1">
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">

                {{-- <img src="{{ asset('build/assets/images/events/' . $event->image) }}" alt="{{ $event->title }}"> --}}
                <div class="bottom-text1">{{ $event->title }}</div>
            </div>
        @endforeach
    </div>


    {{-- <div class="card-container1">
        <!-- Card 1 -->
        <div class="custom-card1">
            <img src="{{ asset('build/assets/images/events/manageevents.jpg') }}" alt="Card Image 1">
            <div class="bottom-text1">Manage Event</div>
        </div>
        <!-- Card 2 -->
        <div class="custom-card1">
            <img src="{{ asset('build/assets/images/events/meetings1.jpg') }}" alt="Card Image 2">
            <div class="bottom-text1">Meetings</div>
        </div>
        <!-- Card 3 -->
        <div class="custom-card1">
            <img src="{{ asset('build/assets/images/events/smallevents.jpg') }}" alt="Card Image 3">
            <div class="bottom-text1">Small Event</div>
        </div>
        <!-- Card 4 -->
        <div class="custom-card1">
            <img src="{{ asset('build/assets/images/events/Exhibition1.jpg') }}" alt="Card Image 4">
            <div class="bottom-text1">Exhibitions</div>
        </div>
    </div> --}}
</div>


<!--  ............................4th section............................  -->
<div class="alternate py-6">
    <div class="text-section text-center mb-5">
        <h1 class="fw-bold">Exclusive Experiences</h1>
        <p>Enhance your stay with our thoughtfully curated events and experiences.</p>
    </div>



    @foreach($experiences as $index => $experience)
    <div class="row align-items-center mb-5">
        @if($index % 2 === 0)
            <div class="col-md-6 image-section">
                <img src="{{ asset('storage/' . $experience->image) }}" alt="{{ $experience->title }}">

                {{-- <img src="{{ asset('storage/experiences/' . $experience->image) }}" alt="{{ $experience->title }}" class="img-fluid rounded"> --}}
                {{-- <img src="{{ asset('storage/events/experiences/' . $experience->image) }}"> --}}

            </div>
            <div class="col-md-6 text-section text-center">
                <h2>{{ $experience->title }}</h2>
                <p>{{ $experience->description }}</p>
            </div>
        @else
            <div class="col-md-6 order-md-2 text-section text-center">
                <h2>{{ $experience->title }}</h2>
                <p>{{ $experience->description }}</p>
            </div>
            <div class="col-md-6 order-md-1 image-section">
                <img src="{{ asset('storage/' . $experience->image) }}" alt="{{ $experience->title }}">
                {{-- <img src="{{ asset('storage/experiences/' . $experience->image) }}" alt="{{ $experience->title }}" class="img-fluid rounded"> --}}
            </div>
        @endif
    </div>
@endforeach


    {{-- <!-- First Row -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6 image-section">
            <img src="{{ asset('build/assets/images/events/professionalconference.jpg') }}" alt="Business Meetings" class="img-fluid rounded">
        </div>
        <div class="col-md-6 text-section text-center">
            <h2>Professional Conferences</h2>
            <p>Host business meetings and corporate events with top-tier facilities, ensuring productive and impactful engagements.</p>
        </div>
    </div>

    <!-- Second Row -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6 order-md-2 text-section text-center">
            <h2>Luxury Gatherings</h2>
            <p>Celebrate your special moments in a grand setting, designed for elegance and comfort.</p>
        </div>
        <div class="col-md-6 order-md-1 image-section">
            <img src="{{ asset('build/assets/images/events/luxurygathering.jpg') }}" alt="Luxury Gatherings" class="img-fluid rounded">
        </div>
    </div> --}}

    <!-- Third Row -->
    {{-- <div class="row align-items-center mb-5">
        <div class="col-md-6 image-section">
            <img src="{{ asset('build/assets/images/events/13.jpg') }}" alt="Cultural Nights" class="img-fluid rounded">
        </div>
        <div class="col-md-6 text-section text-center">
            <h2>Cultural Evenings</h2>
            <p>Experience mesmerizing Sufi musical performances and explore rich cultural traditions.</p>
        </div>
    </div> --}}
</div>

<!--  ....................form section....................................  -->
{{-- <div class="container mt-5">
    <div class="booking-form p-3">
        <form class="row g-2 align-items-center">
            <div class="col-md-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" required>
            </div>
            <div class="col-md-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" required>
            </div>
            <div class="col-md-2">
                <label for="eventType" class="form-label">Event Type</label>
                <select class="form-select" id="eventType">
                    <option selected disabled>Type</option>
                    <option>Wedding</option>
                    <option>Conference</option>
                    <option>Birthday</option>
                    <option>Corporate</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" required>
            </div>
            <div class="col-md-2">
                <label for="guests" class="form-label">Guests</label>
                <input type="number" class="form-control" id="guests" placeholder="No. of Guests" required>
            </div>
            <div class="col-md-12 text-end mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div> --}}

@endsection
