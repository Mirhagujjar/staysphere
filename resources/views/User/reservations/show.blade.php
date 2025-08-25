@extends('layouts.app')

@section('content')
<style>
    .reservation-container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    .reservation-header {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        background-color: #f8f9fa;
    }
    .reservation-body {
        padding: 1.5rem;
    }
    .reservation-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
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
    .detail-item {
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .detail-label {
        color: #495057;
        font-weight: 500;
        margin-bottom: 0.3rem;
    }
    .detail-value {
        color: #6c757d;
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
        transition: transform 0.3s ease;
    }
    .room-image-container:hover .room-image {
        transform: scale(1.05);
    }
    .no-image {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #adb5bd;
    }
    .action-btn {
        border-radius: 6px;
        padding: 0.6rem 1rem;
        margin-right: 0.75rem;
        margin-bottom: 0.75rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    .room-badge {
        background-color: #f0f8ff;
        color: #1e88e5;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        margin-right: 0.75rem;
        margin-bottom: 0.75rem;
        display: inline-flex;
        align-items: center;
        font-weight: 500;
    }
    .room-badge i {
        margin-right: 0.4rem;
    }
    .assigned-room {
        background-color: #e6ffed;
        color: #28a745;
        border-left: 3px solid #28a745;
        padding-left: 1rem;
    }
    .unassigned-room {
        background-color: #fff8e6;
        color: #ffc107;
        border-left: 3px solid #ffc107;
        padding-left: 1rem;
    }
    .service-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
    }
    .total-price {
        font-weight: 600;
        font-size: 1.1rem;
        color: #2d3748;
    }
    .divider {
        height: 1px;
        background-color: rgba(0, 0, 0, 0.1);
        margin: 1.5rem 0;
    }
    .timeline {
        position: relative;
        padding-left: 1.5rem;
    }
    .timeline:before {
        content: '';
        position: absolute;
        left: 7px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e9ecef;
    }
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    .timeline-item:last-child {
        padding-bottom: 0;
    }
    .timeline-dot {
        position: absolute;
        left: 0;
        top: 0;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: #007bff;
        z-index: 1;
    }
    .timeline-content {
        padding-left: 1.5rem;
    }
    .timeline-date {
        font-size: 0.85rem;
        color: #6c757d;
    }
    .timeline-title {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }
    @media (max-width: 767.98px) {
        .reservation-header,
        .reservation-body {
            padding: 1rem;
        }
        .action-btn {
            width: 100%;
            margin-right: 0;
        }
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0" style="font-weight: 600; color: #2d3748;">
            <i class="fas fa-calendar-alt me-2 text-primary"></i> Reservation Details
        </h2>
        <a href="{{ route('user.reservations.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Reservations
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="reservation-container">
        <div class="reservation-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h3 class="reservation-title mb-1">
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
            <div class="mt-2 mt-md-0">
                <a href="{{ route('user.reservations.invoice', $reservation->id) }}" 
                   class="btn btn-primary">
                    <i class="fas fa-file-invoice me-1"></i> View Invoice
                </a>
            </div>
            <div class="mt-2 mt-md-0">
                <a href="{{ route('user.review.review', $reservation->id) }}" 
                   class="btn btn-primary">
                    <i class="fas fa-file-invoice me-1"></i> Review
                </a>
            </div>
        </div>

        <div class="reservation-body">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Reservation Details -->
                    <div class="detail-item">
                        <div class="detail-label">Guest Information</div>
                        <div class="detail-value">
                            <div><strong>{{ $reservation->name }}</strong></div>
                            <div>{{ $reservation->email }}</div>
                            <div>{{ $reservation->phone }}</div>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Reservation Dates</div>
                        <div class="detail-value">
                            <div>
                                <i class="far fa-calendar-check me-2"></i>
                                <strong>Check-in:</strong> 
                                {{ $reservation->check_in->format('l, F j, Y') }} (After 2:00 PM)
                            </div>
                            <div class="mt-2">
                                <i class="far fa-calendar-times me-2"></i>
                                <strong>Check-out:</strong> 
                                {{ $reservation->check_out->format('l, F j, Y') }} (Before 12:00 PM)
                            </div>
                            <div class="mt-2 text-primary">
                                <i class="far fa-clock me-2"></i>
                                <strong>Duration:</strong> 
                                {{ $reservation->check_in->diffInDays($reservation->check_out) }} nights
                            </div>
                        </div>
                    </div>

                    @if($reservation->is_parent)
                        <!-- Group Reservation Details -->
                        <div class="detail-item">
                            <div class="detail-label">Room Details</div>
                            <div class="detail-value">
                                <div class="mb-2">
                                    <strong>Total Guests:</strong> {{ $reservation->children->sum('guests') }}
                                </div>
                                <div>
                                    @foreach($reservation->children as $child)
                                        <div class="mb-3 p-3 {{ $child->room ? 'assigned-room' : 'unassigned-room' }}">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong>
                                                    <i class="fas fa-bed me-2"></i>
                                                    {{ $child->room_type }} ({{ $child->guests }} guests)
                                                </strong>
                                                @if($child->room)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i> Assigned
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="fas fa-clock me-1"></i> Pending
                                                    </span>
                                                @endif
                                            </div>
                                            @if($child->room)
                                                <div class="mt-2">
                                                    <strong>Room Name:</strong> {{ $child->room->room_name }}
                                                </div>
                                                <div>
                                                    <strong>Size:</strong> {{ $child->room->size ?? 'N/A' }}ft²
                                                </div>
                                            @else
                                                <div class="mt-2 text-muted">
                                                    Your room will be assigned soon. We'll notify you once confirmed.
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Single Reservation Details -->
                        <div class="detail-item">
                            <div class="detail-label">Room Details</div>
                            <div class="detail-value">
                                <div class="mb-2">
                                    <strong>Room Type:</strong> {{ $reservation->room_type }}
                                </div>
                                <div class="mb-2">
                                    <strong>Guests:</strong> {{ $reservation->guests }}
                                </div>
                                @if($reservation->room)
                                    <div class="p-3 assigned-room mt-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <strong>
                                                <i class="fas fa-check-circle me-2"></i>
                                                Room Assigned
                                            </strong>
                                            <span class="badge bg-success">
                                                {{ $reservation->room->room_name ?? 'N/A' }}
                                            </span>
                                        </div>
                                        <p>Room Name: {{ $reservation->room->room_name ?? 'N/A' }}</p>
                                        {{-- <div class="mt-2">
                                            <strong>Size:</strong> {{ $reservation->room->size ?? 'N/A' }}
                                        </div> --}}
                                        <div>
                                            <strong>Features:</strong> 
                                            {{ $reservation->room->facilities ?? 'Standard amenities' }}
                                        </div>
                                    </div>
                                 @elseif($reservation->status === 'cancelled')
                                 <h5 class="timeline-title">Reservation Cancelled</h5>
                                            <p class="text-danger">Cancel Reason: {{ $reservation->reason ?? 'No reason provided' }}</p>
                                @else
                                    <div class="p-3 unassigned-room mt-3">
                                        <strong>
                                            <i class="fas fa-clock me-2"></i>
                                            Room Assignment Pending
                                        </strong>
                                        <div class="mt-2 text-muted">
                                            Your room will be assigned soon. We'll notify you once confirmed.
                                        </div>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    @endif

                    <!-- Services -->
                    @if($reservation->services->count() > 0)
                        <div class="detail-item">
                            <div class="detail-label">Additional Services</div>
                            <div class="detail-value">
                                @foreach($reservation->services as $service)
                                    <div class="service-item">
                                        <span>{{ $service->title }}</span>
                                        <span>Rs. {{ number_format((float)$service->price, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Reservation Timeline -->
                    <div class="detail-item">
                        <div class="detail-label">Reservation Timeline</div>
                        <div class="detail-value">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <div class="timeline-date">
                                            {{ $reservation->created_at->format('M j, Y \a\t g:i A') }}
                                        </div>
                                        <h5 class="timeline-title">Reservation Created</h5>
                                        <p class="mb-0">Your reservation request was submitted</p>
                                    </div>
                                </div>
                                
                                @if($reservation->status === 'confirmed')
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <div class="timeline-date">
                                            {{ $reservation->updated_at->format('M j, Y \a\t g:i A') }}
                                        </div>
                                        <h5 class="timeline-title">Reservation Confirmed</h5>
                                        <p class="mb-0">Your reservation has been confirmed by our staff</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if($reservation->status === 'cancelled')
                                <div class="timeline-item">
                                    <div class="timeline-dot bg-danger"></div>
                                    <div class="timeline-content">
                                        <div class="timeline-date">
                                            {{ $reservation->updated_at->format('M j, Y \a\t g:i A') }}
                                        </div>
                                        <h5 class="timeline-title">Reservation Cancelled</h5>
                                         @if($reservation->status === 'cancelled')
                                            <p class="text-danger">Cancel Reason: {{ $reservation->reason ?? 'No reason provided' }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                
                                @if($reservation->check_out < now())
                                <div class="timeline-item">
                                    <div class="timeline-dot bg-secondary"></div>
                                    <div class="timeline-content">
                                        <div class="timeline-date">
                                            {{ $reservation->check_out->format('M j, Y \a\t g:i A') }}
                                        </div>
                                        <h5 class="timeline-title">Stay Completed</h5>
                                        <p class="mb-0">Your reservation has been completed</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Room Image -->
                    <div class="room-image-container">
                        @if($reservation->room)
                            <img src="{{ asset($reservation->room->image ?? 'images/default-room.jpg') }}" 
                                 class="room-image" 
                                 alt="{{ $reservation->room_type }} Room">
                        @elseif($reservation->is_parent && $reservation->children->first() && $reservation->children->first()->room)
                            <img src="{{ asset($reservation->children->first()->room->image ?? 'images/default-room.jpg') }}" 
                                 class="room-image" 
                                 alt="{{ $reservation->children->first()->room_type }} Room">
                        @else
                            <div class="no-image">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Pricing Summary -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Pricing Summary</h5>
                        </div>
                        <div class="card-body">
                            @if($reservation->is_parent)
                                @foreach($reservation->children as $child)
                                    <div class="service-item">
                                        <span>{{ $child->room_type }} ({{ $child->guests }} guests)</span>
                                        <span>Rs. {{ number_format($child->room->price ?? 0, 2) }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="service-item">
                                    <span>{{ $reservation->room_type }} Room</span>
                                    <span>Rs. {{ number_format($reservation->room->price ?? 0, 2) }}</span>
                                </div>
                            @endif
                            
                            @if($reservation->services->count() > 0)
                                <div class="divider"></div>
                                @foreach($reservation->services as $service)
                                    <div class="service-item">
                                        <span>{{ $service->title }}</span>
                                        <span>Rs. {{ number_format($service->price, 2) }}</span>
                                    </div>
                                @endforeach
                            @endif
                            
                            <div class="divider"></div>
                            <div class="service-item">
                                <span>Number of Nights</span>
                                <span>{{ $reservation->check_in->diffInDays($reservation->check_out) }}</span>
                            </div>
                            
                            <div class="divider"></div>
                            <div class="service-item total-price">
                                <span>Total Amount</span>
                                <span>
                                    Rs. {{ number_format(
                                        ($reservation->is_parent ? 
                                            $reservation->children->sum(function($child) { 
                                                return $child->room ? $child->room->price : 0; 
                                            }) : 
                                            ($reservation->room ? $reservation->room->price : 0)) * 
                                        $reservation->check_in->diffInDays($reservation->check_out) + 
                                        $reservation->services->sum('price'), 
                                        2
                                    ) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Reservation Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap">
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
                                
                                <a href="{{ route('user.reservations.invoice', $reservation->id) }}" 
                                   class="action-btn btn btn-outline-success mb-2">
                                    <i class="fas fa-file-invoice me-1"></i> Invoice
                                </a>
                                
                                @if($reservation->status == 'confirmed' && $reservation->check_in <= now() && $reservation->check_out >= now())
                                    <a href="{{route('user.services.index')}}" class="action-btn btn btn-primary mb-2">
                                        <i class="fas fa-concierge-bell me-1"></i> Request Service
                                    </a>
                                @endif
                                
                                <a href="{{route('user.contact')}}" class="action-btn btn btn-outline-secondary mb-2">
                                    <i class="fas fa-question-circle me-1"></i> Get Help
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection