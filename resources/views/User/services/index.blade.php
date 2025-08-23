@extends('layouts.app')

@section('content')
<style>
    .hero-section {
        background: url('{{ asset('build/assets/images/service4.jpg') }}') no-repeat center center;
        background-size: cover;
        color: white;
        text-align: center;
        padding: 100px 20px;
    }
    .cardstyle {
        width: 90%;
        max-width: 500px;
        background: white;
        bottom: -70px;
    }
</style>

<div class="hero-section"
     style="background: url('{{ $hero && $hero->hero_background ? asset('storage/' . $hero->hero_background) : asset('default-hero.jpg') }}') center/cover no-repeat;">
    
    <div class="overlay-text">
        <h1>{{ $hero->hero_title ?? 'Services' }}</h1>
        <p>{{ $hero->hero_subtitle ?? '"Experience Luxury, Comfort, and Excellence – Our Services, Your Satisfaction!"' }}</p>
        
        <div class="breadcrumb-container">
            <a href="{{ url('/') }}">Home</a> > Services
        </div>
    </div>
</div>

@foreach($services as $service)
<div class="container my-5 py-5">
    <div class="position-relative col-md-8 mx-auto">
        <div class="image">
            <img src="{{ asset('storage/' . $service->thumbnail) }}" class="img-fluid rounded" alt="Service Image">
        </div>

        <div class="position-absolute start-50 translate-middle-x p-4 shadow-lg rounded cardstyle">
            <small style="color: #b2956e; font-weight: bold;">FROM {{ $service->price }}</small>
            <h2 class="mt-2 text-dark">{{ $service->title }}</h2>
            <p class="text-muted">{{ $service->short_description }}</p>
           <div class="d-flex justify-content-start gap-4 mb-4">
                <div>
                    <h6 class="mb-2">Facilities:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($service->formatted_facilities as $facility)
                            <span class="badge bg-light text-dark border py-2 px-3">
                                <i class="bi bi-check-circle me-1 text-success"></i>
                                {{ $facility }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                {{-- <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#modal{{ $service->id }}">
                    {{ $service->modal_button_text ?? 'Get Services Now' }}
                </button> --}}
                <a href="{{ route('user.services.create') }}" class="btn btn-warning mt-3">
                    {{ $service->modal_button_text ?? 'Get Services Now' }}
                </a>

                <a href="{{ route('services.show', $service->slug) }}" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal{{ $service->id }}">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <h4 class="mb-3">Request for {{ $service->title }}</h4>
                    <form action="{{ route('services.submit') }}" method="POST">
                        @csrf

                        <!-- User Name -->
                        {{-- <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                        </div> --}}
                         <!-- name -->
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            @auth
                                <input type="text" name="name" class="form-control" 
                                    value="{{ Auth::user()->name }}" readonly required>
                            @else
                                <input type="text" name="name" class="form-control" 
                                    placeholder="Enter your full name" required>
                            @endauth
                        </div>

                        <!-- Email -->
                        {{-- <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                        </div> --}}

                         <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            @auth
                                <input type="email" name="email" class="form-control" 
                                    value="{{ Auth::user()->email }}" readonly required>
                            @else
                                <input type="email" name="email" class="form-control" 
                                    placeholder="Enter your email address" required>
                            @endauth
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="e.g. 0300-1234567" required>
                        </div>

                        <!-- Room Number -->
                        <div class="mb-3">
                            <label class="form-label">Room Number</label>
                            <input type="text" name="room_number" class="form-control" placeholder="Your room number" required>
                        </div>

                        <!-- Select Service -->
                        <div class="mb-3">
                            <label class="form-label">Select Service</label>
                            <select name="service_id" class="form-select" required>
                                <option value="">-- Select a Service --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Additional Notes -->
                        <div class="mb-3">
                            <label class="form-label">Additional Notes (Optional)</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Any special instructions?"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </form>

        </div>
    </div>
</div>
@endforeach
@endsection
