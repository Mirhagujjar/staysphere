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
                 <a href="{{ route('user.reservations.invoice', $reservation->id) }}" class="btn btn-primary">
                View Invoice
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
                                <h3 class="h5 mb-0">{{ $reservation->room->name ?? 'Room not specified' }}
                                </h3>
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
                                        <p class="mb-0">{{ $reservation->email ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Room Name</p>
                                        <p class="mb-0">{{ $reservation->room->room_name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Phone</p>
                                        <p class="mb-0">{{ $reservation->phone ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Check-in</p>
                                        <p class="mb-0">{{ $reservation->check_in ? \Carbon\Carbon::parse($reservation->check_in)->format('M j, Y') : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Check-out</p>
                                        <p class="mb-0">{{ $reservation->check_out ? \Carbon\Carbon::parse($reservation->check_out)->format('M j, Y') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Room Type</p>
                                        <p class="mb-0">{{ $reservation->room && $reservation->room->roomType ? $reservation->room->roomType->label : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="text-muted small mb-1">Guests</p>
                                        <p class="mb-0">{{ $reservation->guests ?? 'N/A' }}</p>
                                    </div>
                                    <div class="detail-item">
                                        <h5>Services:</h5>
                                        <ul>
                                            @if($reservation->service)
                                                <li>{{ $reservation->service->name }}</li>
                                            @else
                                                <li>No services selected</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- col-md-8 -->
                    </div> <!-- row -->
                </div> <!-- card-body -->

                <div class="card-footer text-muted">
                    <p class="mb-0">Reservation ID: {{ $reservation->id }}</p>
                    <p class="mb-0">Created At: {{ $reservation->created_at->format('M j, Y h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
