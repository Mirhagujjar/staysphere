@extends('layouts.app')

@section('content')
<style>
    .reservation-container {
        border-radius: 0.375rem;
        overflow: hidden;
    }
    .reservation-header {
        background-color: #4f46e5;
        color: white;
        padding: 1.5rem;
    }
    .status-badge {
        font-size: 0.8rem;
        padding: 0.4rem 0.9rem;
        border-radius: 50px;
        font-weight: 500;
    }
    .status-confirmed {
        background-color: #e6f7ee;
        color: #28a745;
    }
    .status-pending {
        background-color: #fff8e6;
        color: #ffc107;
    }
    .status-cancelled {
        background-color: #fdecea;
        color: #dc3545;
    }
    .status-completed {
        background-color: #e6f3ff;
        color: #007bff;
    }
    .detail-section {
        margin-bottom: 2rem;
    }
    .section-title {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    .room-image-container {
        height: 200px;
        overflow: hidden;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        background-color: #f8f9fa;
    }
    .room-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .assigned-room {
        background-color: #e6ffed;
        border-left: 3px solid #28a745;
        padding: 1rem;
        border-radius: 0.375rem;
    }
    .unassigned-room {
        background-color: #fff8e6;
        border-left: 3px solid #ffc107;
        padding: 1rem;
        border-radius: 0.375rem;
    }
    .service-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px dashed #dee2e6;
    }
    .total-price {
        font-weight: 600;
        font-size: 1.1rem;
    }
    .action-btn {
        border-radius: 6px;
        padding: 0.6rem 1rem;
        margin-right: 0.75rem;
        margin-bottom: 0.75rem;
        font-weight: 500;
    }
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>

<div class="container py-4">
    <div class="reservation-container card shadow-sm">
        <!-- Header Section -->
        <div class="reservation-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h3 class="mb-1">
                        @if($reservation->is_parent)
                            <i class="fas fa-users me-2"></i> Group Reservation #{{ $reservation->id }}
                        @else
                            <i class="fas fa-door-open me-2"></i> Reservation #{{ $reservation->id }}
                        @endif
                    </h3>
                    <span class="status-badge status-{{ str_replace(' ', '_', $reservation->status) }}">
                        {{ ucfirst($reservation->status) }}
                    </span>
                </div>
                <div class="mt-2 mt-md-0 no-print">
                    <a href="{{ route('user.reservations.invoice.pdf', $reservation->id) }}" 
                       class="btn btn-light">
                        <i class="fas fa-file-pdf me-1"></i> Download PDF
                    </a>
                    <a href="{{ route('user.reservations.index') }}" 
                       class="btn btn-outline-light">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!-- Guest and Reservation Info -->
            <div class="row detail-section">
                <div class="col-md-6">
                    <h5 class="section-title">Guest Information</h5>
                    <p><strong>Name:</strong> {{ $reservation->name }}</p>
                    <p><strong>Email:</strong> {{ $reservation->email }}</p>
                    <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="section-title">Reservation Dates</h5>
                    <p><strong>Check-in:</strong> {{ $reservation->check_in->format('d M Y, h:i A') }}</p>
                    <p><strong>Check-out:</strong> {{ $reservation->check_out->format('d M Y, h:i A') }}</p>
                    <p><strong>Duration:</strong> {{ $reservation->check_in->diffInDays($reservation->check_out) }} nights</p>
                </div>
            </div>

            <!-- Room Details -->
            <div class="detail-section">
                <h5 class="section-title">Room Details</h5>
                @if($reservation->is_parent)
                    <!-- Group Reservation Rooms -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Room Type</th>
                                    <th>Guests</th>
                                    <th>Status</th>
                                    <th>Room Name</th>
                                    <th>Price/Night</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservation->children as $child)
                                <tr>
                                    <td>{{ $child->room_type }}</td>
                                    <td>{{ $child->guests }}</td>
                                    <td>
                                        @if($child->room)
                                            <span class="badge bg-success">Assigned</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $child->room->room_name ?? '-' }}</td>
                                    <td>Rs {{ number_format($child->room->price ?? 0, 2) }}</td>
                                    <td>Rs {{ number_format(($child->room->price ?? 0) * $reservation->check_in->diffInDays($reservation->check_out), 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Single Reservation Room -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="room-image-container">
                                @if($reservation->room)
                                    <img src="{{ asset($reservation->room->image ?? 'images/default-room.jpg') }}" 
                                         class="room-image" 
                                         alt="{{ $reservation->room_type }} Room">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            @if($reservation->room)
                                <div class="assigned-room">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h5>{{ $reservation->room->room_name }}</h5>
                                        <span class="badge bg-success">Assigned</span>
                                    </div>
                                    <p><strong>Type:</strong> {{ $reservation->room_type }}</p>
                                    <p><strong>Capacity:</strong> {{ $reservation->room->room_capacity }} guests</p>
                                    <p><strong>Price/Night:</strong> Rs {{ number_format($reservation->room->price, 2) }}</p>
                                    <p><strong>Facilities:</strong> {{ $reservation->room->facilities ?? 'Standard amenities' }}</p>
                                </div>
                            @else
                                <div class="unassigned-room">
                                    <h5 class="mb-3">{{ $reservation->room_type }}</h5>
                                    <p class="mb-2"><strong>Guests:</strong> {{ $reservation->guests }}</p>
                                    <div class="alert alert-warning mb-0">
                                        <i class="fas fa-clock me-2"></i> Room assignment pending
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Services -->
            @if($reservation->services->count() > 0)
            <div class="detail-section">
                <h5 class="section-title">Additional Services</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Service</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservation->services as $service)
                            <tr>
                                <td>{{ $service->title }}</td>
                                <td>Rs {{ number_format($service->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Pricing Summary -->
            <div class="detail-section">
                <h5 class="section-title">Pricing Summary</h5>
                <div class="row justify-content-end">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                @if($reservation->is_parent)
                                    @php
                                        $roomTotal = $reservation->children->sum(function($child) use ($reservation) {
                                            return ($child->room ? $child->room->price : 0) * $reservation->check_in->diffInDays($reservation->check_out);
                                        });
                                    @endphp
                                @else
                                    @php
                                        $roomTotal = ($reservation->room ? $reservation->room->price : 0) * $reservation->check_in->diffInDays($reservation->check_out);
                                    @endphp
                                @endif
                                
                                @php
                                    $servicesTotal = $reservation->services->sum('price');
                                    $subtotal = $roomTotal + $servicesTotal;
                                    $tax = $subtotal * 0.10;
                                    $grandTotal = $subtotal + $tax;
                                @endphp
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Room Charges:</span>
                                    <span>Rs {{ number_format($roomTotal, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Services:</span>
                                    <span>Rs {{ number_format($servicesTotal, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-top pt-2 mb-2">
                                    <span>Subtotal:</span>
                                    <span>Rs {{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Tax (10%):</span>
                                    <span>Rs {{ number_format($tax, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-2 mt-2">
                                    <span>Total:</span>
                                    <span>Rs {{ number_format($grandTotal, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions (Non-printable) -->
            <div class="no-print">
                <div class="d-flex flex-wrap mt-4">
                    @if($reservation->status == 'pending')
                        <a href="{{ route('user.reservations.edit', $reservation->id) }}" 
                           class="action-btn btn btn-outline-primary mb-2">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <form action="{{ route('user.reservations.destroy', $reservation->id) }}" 
                              method="POST" class="mb-2">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn btn btn-outline-danger" 
                                    onclick="return confirm('Are you sure you want to cancel this reservation?')">
                                <i class="fas fa-times me-1"></i> Cancel
                            </button>
                        </form>
                    @endif
                    
                    @if($reservation->status == 'confirmed' && $reservation->check_in <= now() && $reservation->check_out >= now())
                        <a href="#" class="action-btn btn btn-primary mb-2">
                            <i class="fas fa-concierge-bell me-1"></i> Request Service
                        </a>
                    @endif
                    
                    <a href="#" class="action-btn btn btn-outline-secondary mb-2">
                        <i class="fas fa-question-circle me-1"></i> Get Help
                    </a>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light no-print">
            <small class="text-muted">Last updated: {{ $reservation->updated_at->format('d M Y H:i') }}</small>
        </div>
    </div>
</div>
@endsection