@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary">Reservation Details</h4>
                        <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back to Reservations
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Room Image with Status Badge -->
                    <div class="position-relative mb-4 rounded overflow-hidden">
                        @if ($reservation->room && $reservation->room->image)
                            <img src="{{ asset($reservation->room->image) }}" 
                                 class="img-fluid w-100" 
                                 alt="Room Image"
                                 style="height: 220px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 220px;">
                                <span class="text-muted">
                                    <i class="bi bi-image me-1"></i> No image available
                                </span>
                            </div>
                        @endif
                        <span class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-{{ 
                            $reservation->status == 'pending' ? 'warning text-dark' : (
                            $reservation->status == 'confirmed' ? 'success' : (
                            $reservation->status == 'checked_out' ? 'primary' : 'danger')) 
                        }} py-2 px-3 fs-6 shadow-sm">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </div>

                    <!-- Guest Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h3 class="h4 mb-3">{{ $reservation->name }}</h3>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-envelope me-2 text-muted"></i>
                                <span>{{ $reservation->email }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-telephone me-2 text-muted"></i>
                                <span>{{ $reservation->phone }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <h5 class="h6 text-muted mb-3">Reservation Summary</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Room Type:</span>
                                    <span class="fw-medium">{{ $reservation->room_type }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Guests:</span>
                                    <span class="fw-medium">{{ $reservation->guests }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Check-in:</span>
                                    <span class="fw-medium">{{ date('M d, Y', strtotime($reservation->check_in)) }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Check-out:</span>
                                    <span class="fw-medium">{{ date('M d, Y', strtotime($reservation->check_out)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Details Section -->
                    <div class="border-top pt-4 mt-4">
                        <h5 class="h6 text-uppercase text-muted mb-3">Additional Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-calendar-check me-2 mt-1 text-primary"></i>
                                    <div>
                                        <h6 class="mb-1">Reservation Date</h6>
                                        <p class="mb-0">{{ $reservation->created_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-credit-card me-2 mt-1 text-primary"></i>
                                    <div>
                                        <h6 class="mb-1">Payment Status</h6>
                                        <p class="mb-0">
                                            <span class="badge bg-{{ $reservation->payment_status ? 'success' : 'warning' }}">
                                                {{ $reservation->payment_status ? 'Paid' : 'Pending' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if($reservation->special_requests)
                            <div class="col-12">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-chat-square-text me-2 mt-1 text-primary"></i>
                                    <div>
                                        <h6 class="mb-1">Special Requests</h6>
                                        <p class="mb-0 text-muted">{{ $reservation->special_requests }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        @if($reservation->status == 'pending')
                        <form action="{{ route('admin.reservations.confirm', $reservation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Confirm
                            </button>
                        </form>
                        @endif
                        
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-printer me-1"></i> Print
                        </a>
                        
                        {{-- <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-outline-primary">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection