@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Reservation Details</h1>
                <a href="{{ route('user.reservations.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Reservations
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <!-- Room Image Column -->
                        <div class="col-md-4 mb-4 mb-md-0">
                            @if ($reservation->room && $reservation->room->image)
                                <div class="ratio ratio-1x1 rounded overflow-hidden bg-light">
                                    <img src="{{ asset($reservation->room->image) }}" 
                                         class="img-fluid object-fit-cover" 
                                         alt="Room Image">
                                </div>
                            @else
                                <div class="ratio ratio-1x1 rounded overflow-hidden bg-light d-flex align-items-center justify-content-center">
                                    <span class="text-muted">No image available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Reservation Details Column -->
                        <div class="col-md-8">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h3 class="h5 mb-0">{{ $reservation->name }}</h3>
                                <span class="badge rounded-pill bg-{{ 
                                    $reservation->status == 'pending' ? 'warning' : (
                                    $reservation->status == 'confirmed' ? 'success' : (
                                    $reservation->status == 'checked_out' ? 'primary' : 'danger')) 
                                }} text-capitalize">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </div>

                            <hr class="my-3">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Email</p>
                                        <p class="mb-0">{{ $reservation->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Phone</p>
                                        <p class="mb-0">{{ $reservation->phone }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Check-in</p>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($reservation->check_in)->format('M j, Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Check-out</p>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($reservation->check_out)->format('M j, Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Room Type</p>
                                        <p class="mb-0">{{ $reservation->room ? $reservation->room->room_type : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Guests</p>
                                        <p class="mb-0">{{ $reservation->guests }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection