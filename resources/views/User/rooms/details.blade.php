@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #2C3E50;
        --secondary-color: #1ABC9C;
        --accent-color: #F1C40F;
        --dark-color: #343A40;
        --light-color: #F8F9FA;
        --text-dark: #2C3E50;
        --text-light: #F8F9FA;
        --text-muted: #6C757D;
    }

    .room-detail-hero {
        height: 70vh;
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                    url('{{ asset($room->image) }}') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: var(--text-light);
    }

    .room-detail-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .breadcrumb {
        background: transparent;
        justify-content: center;
    }

    .breadcrumb-item a {
        color: var(--accent-color);
        text-decoration: none;
        transition: color 0.3s;
    }

    .breadcrumb-item a:hover {
        color: var(--secondary-color);
    }

    .breadcrumb-item.active {
        color: var(--text-light);
    }

    .room-feature-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .room-feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .feature-icon {
        font-size: 1.5rem;
        margin-right: 10px;
        color: var(--secondary-color);
    }

    .booking-card {
        background-color: rgba(241, 196, 15, 0.05);
        border-radius: 15px;
        border: 1px solid rgba(0,0,0,0.1);
    }

    .btn-book {
        background-color: var(--accent-color);
        color: var(--text-dark);
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 50px;
        transition: all 0.3s;
    }

    .btn-book:hover {
        background-color: var(--secondary-color);
        color: var(--text-light);
        transform: translateY(-2px);
    }

    .amenity-badge {
        background-color: var(--secondary-color);
        color: white;
        padding: 5px 15px;
        border-radius: 50px;
        margin-right: 10px;
        margin-bottom: 10px;
        display: inline-block;
    }

    .price-display {
        font-size: 2rem;
        font-weight: 700;
        color: var(--secondary-color);
    }

    .availability-badge {
        font-size: 1rem;
        padding: 8px 15px;
    }
</style>

<!-- Hero Section -->
<section class="room-detail-hero">
    <div class="container">
        <h1>{{ $room->room_name }}</h1>
        <p class="lead mb-4">{{ $room->short_description ?? 'Experience unparalleled comfort and luxury' }}</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.rooms.index') }}">Rooms</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $room->room_name }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Room Details Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Room Image -->
            <div class="col-lg-7">
                <div class="room-feature-card shadow-sm">
                    <img src="{{ asset($room->image) }}" alt="{{ $room->room_name }}" class="img-fluid rounded-3 w-100">
                </div>
            </div>

            <!-- Room Info -->
            <div class="col-lg-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">{{ $room->room_name }}</h2>
                    @if(isset($checkIn) && isset($checkOut) && $room->isBooked($checkIn, $checkOut))
                        <span class="badge bg-danger availability-badge">Booked</span>
                    @else
                        <span class="badge bg-success availability-badge">Available</span>
                    @endif
                </div>

                <div class="price-display mb-4">Rs. {{ number_format($room->price) }} <small class="text-muted">/ night</small></div>

                <!-- Description -->
                <div class="mb-5">
                    <h4 class="mb-3"><i class="bi bi-card-text feature-icon"></i>Description</h4>
                    <p class="text-muted">{{ $room->description }}</p>
                </div>

                <!-- Room Specifications -->
                <div class="mb-5">
                    <h4 class="mb-3"><i class="bi bi-info-circle feature-icon"></i>Room Specifications</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-people-fill text-primary me-2"></i> 
                                <strong>Capacity:</strong> {{ $room->room_capacity }} Persons</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-arrows-angle-expand text-primary me-2"></i> 
                                <strong>Size:</strong> {{ $room->size }} ft²</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-building text-primary me-2"></i> 
                                <strong>Type:</strong> {{ $room->roomType->label ?? $room->room_type }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><i class="bi bi-binoculars-fill text-primary me-2"></i> 
                                <strong>View:</strong> {{ $room->viewType->label ?? 'Not specified' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Book Now Button -->
                @unless(isset($checkIn) && isset($checkOut) && $room->isBooked($checkIn, $checkOut))
                    <a href="{{ route('user.reservations.create', ['room_id' => $room->id]) }}" 
                       class="btn btn-book w-100 py-3">
                       <i class="bi bi-calendar-check me-2"></i> Book Now
                    </a>
                @endunless
            </div>
        </div>
    </div>
</section>

<!-- Amenities Section -->
@if($room->filterOptions->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 mb-3">Amenities & Features</h2>
            <p class="text-muted">Everything you need for a comfortable stay</p>
        </div>

        <div class="row g-4">
            @foreach($room->filterOptions->groupBy('filter.name') as $filterName => $options)
            <div class="col-md-6 col-lg-4">
                <div class="room-feature-card bg-white p-4 h-100">
                    <h4 class="mb-4"><i class="bi bi-star-fill text-warning me-2"></i>{{ $filterName }}</h4>
                    <ul class="list-unstyled">
                        @foreach($options as $option)
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $option->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection