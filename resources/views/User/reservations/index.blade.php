@extends('layouts.app')

@section('content')
<style>
    .reservation-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        margin-bottom: 1.5rem;
        border-left: 4px solid transparent;
    }
    .reservation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .card-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.75rem;
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
    .status-checked_out, .status-completed {
        background-color: #e6f3ff;
        color: #007bff;
    }
    .detail-item {
        margin-bottom: 0.75rem;
        color: #6c757d;
        display: flex;
    }
    .detail-label {
        color: #495057;
        font-weight: 500;
        min-width: 100px;
    }
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
        background-color: #f8f9fa;
        border-radius: 10px;
        margin: 2rem 0;
    }
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        color: #adb5bd;
    }
    .action-btn {
        border-radius: 6px;
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
    .room-badge {
        background-color: #f0f8ff;
        color: #1e88e5;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        display: inline-block;
    }
    .search-container {
        max-width: 400px;
        margin-left: auto;
    }
    .section-title {
        font-weight: 600;
        color: #2d3748;
        margin: 2.5rem 0 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        position: relative;
    }
    .section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -1px;
        width: 50px;
        height: 2px;
        background: #007bff;
    }
    .reservation-card.confirmed {
        border-left-color: #28a745;
    }
    .reservation-card.pending {
        border-left-color: #ffc107;
    }
    .reservation-card.cancelled {
        border-left-color: #dc3545;
    }
    .reservation-card.completed {
        border-left-color: #007bff;
    }
    .no-reservations {
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }
    .room-number {
        font-weight: 600;
        color: #1e88e5;
    }
    .date-range {
        font-weight: 500;
    }
    .guest-count {
        font-weight: 500;
    }
    .card-actions {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding-top: 1rem;
        margin-top: 1rem;
    }
    @media (max-width: 767.98px) {
        .search-container {
            max-width: 100%;
            margin-top: 1rem;
        }
        .d-flex.justify-content-between {
            flex-direction: column;
        }
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <h2 class="mb-3 mb-md-0" style="font-weight: 600; color: #2d3748;">
            <i class="fas fa-calendar-alt me-2"></i> My Reservations
        </h2>
        
        <div class="search-container">
            <form method="GET" action="{{ route('user.reservations.index') }}" class="input-group shadow-sm">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control border-end-0" placeholder="Search reservations..." 
                       aria-label="Search reservations">
                <button type="submit" class="btn btn-primary border-start-0">
                    <i class="fas fa-search"></i>
                </button>
                @if(request('search'))
                    <a href="{{ route('user.reservations.index') }}" class="btn btn-outline-secondary ms-2">
                        Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($groupedReservations->isEmpty() && $currentReservations->isEmpty() && $pastReservations->isEmpty())
        <div class="empty-state shadow-sm">
            <i class="fas fa-calendar-times"></i>
            <h4 class="no-reservations">You have no reservations yet</h4>
            <p class="mb-4">Start by browsing our available rooms and make your first reservation</p>
            <a href="{{ route('rooms.index') }}" class="btn btn-primary px-4">
                <i class="fas fa-door-open me-2"></i> Browse Rooms
            </a>
        </div>
    @else
        <!-- Current Reservations -->
        <h4 class="section-title">
            <i class="fas fa-calendar-check me-2"></i> Upcoming Reservations
        </h4>
        
        @if($groupedReservations->isEmpty() && $currentReservations->isEmpty())
            <div class="alert alert-info shadow-sm">
                <i class="fas fa-info-circle me-2"></i> You don't have any upcoming reservations.
            </div>
        @else
            <div class="row">
                @foreach($groupedReservations as $group)
                    <div class="col-md-12">
                        <div class="reservation-card card {{ $group->status }}">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    <span>
                                        <i class="fas fa-users me-2"></i> Group Reservation #{{ $group->id }}
                                    </span>
                                    <span class="status-badge status-{{ str_replace(' ', '_', $group->status) }}">
                                        {{ ucfirst($group->status) }}
                                    </span>
                                </h5>

                                <div class="row">
                                    <!-- Group Summary -->
                                    <div class="col-md-4">
                                        <div class="group-summary mb-4">
                                            <div class="detail-item">
                                                <span class="detail-label"><i class="far fa-calendar-alt me-2"></i>Dates:</span>
                                                <span class="date-range">
                                                    {{ $group->check_in->format('M j, Y') }} - {{ $group->check_out->format('M j, Y') }}
                                                </span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label"><i class="fas fa-user-friends me-2"></i>Total Guests:</span>
                                                <span class="guest-count">
                                                    {{ $group->children->sum('guests') }}
                                                </span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label"><i class="fas fa-door-open me-2"></i>Total Rooms:</span>
                                                <span class="room-count">
                                                    {{ $group->children->count() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Individual Rooms -->
                                    <div class="col-md-8">
                                        <h6 class="mb-3"><i class="fas fa-door-open me-2"></i>Rooms in this reservation:</h6>
                                        <div class="rooms-container">
                                            @foreach($group->children as $roomReservation)
                                                <div class="room-card mb-3 p-3 border rounded">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <strong>{{ $roomReservation->room_type }}</strong>
                                                            <span class="ms-2 badge bg-light text-dark">
                                                                {{ $roomReservation->guests }} guest(s)
                                                            </span>
                                                            @if($roomReservation->room && $roomReservation->status === 'confirmed')
                                                                <span class="ms-2 room-number">
                                                                    <i class="fas fa-hashtag"></i> {{ $roomReservation->room->room_number }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <span class="status-badge status-{{ str_replace(' ', '_', $roomReservation->status) }}">
                                                            {{ ucfirst($roomReservation->status) }}
                                                        </span>
                                                    </div>
                                                    <div class="mt-2">
                                                        <small class="text-muted">
                                                            <i class="far fa-calendar-alt me-1"></i>
                                                            {{ $roomReservation->check_in->format('M j, Y') }} - {{ $roomReservation->check_out->format('M j, Y') }}
                                                        </small>
                                                    </div>
                                                    <div class="mt-2 room-actions">
                                                        <a href="{{ route('user.reservations.show', $roomReservation->id) }}" 
                                                        class="btn btn-sm btn-outline-secondary">
                                                            <i class="fas fa-eye"></i> Details
                                                        </a>
                                                        @if($roomReservation->status == 'pending')
                                                            <a href="{{ route('user.reservations.edit', $roomReservation->id) }}" 
                                                            class="btn btn-sm btn-outline-primary ms-1">
                                                                <i class="fas fa-edit"></i> Modify
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="card-actions d-flex flex-wrap mt-3">
                                    <a href="{{ route('user.reservations.show', $group->id) }}" 
                                    class="action-btn btn btn-outline-secondary">
                                        <i class="fas fa-eye me-1"></i> Group Details
                                    </a>
                                    <a href="{{ route('user.reservations.invoice', $group->id) }}" 
                                    class="action-btn btn btn-outline-primary">
                                        <i class="fas fa-file-invoice me-1"></i> Group Invoice
                                    </a>
                                    @if($group->status == 'pending')
                                    <a href="{{ route('user.reservations.edit', $group->id) }}" 
                                    class="action-btn btn btn-outline-info">
                                        <i class="fas fa-edit me-1"></i> Edit Group
                                    </a>
                                    <form action="{{ route('user.reservations.destroy', $group->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="action-btn btn btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to cancel this entire group reservation?')">
                                            <i class="fas fa-times me-1"></i> Cancel Group
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($currentReservations->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $currentReservations->withQueryString()->links() }}
                </div>
            @endif
        @endif

        <!-- Past Reservations -->
        @if($pastReservations->isNotEmpty())
            <h4 class="section-title">
                <i class="fas fa-history me-2"></i> Past Reservations
            </h4>
            <div class="row">
                @foreach($pastReservations as $reservation)
                    <!-- Your past reservation card stays the same -->
                @endforeach
            </div>

            @if($pastReservations->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $pastReservations->withQueryString()->links() }}
                </div>
            @endif
        @endif
    @endif
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add confirmation for cancellation buttons
    document.querySelectorAll('form[action*="destroy"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            const isGroup = form.getAttribute('action').includes('group');
            if (!confirm(`Are you sure you want to cancel this ${isGroup ? 'group ' : ''}reservation?`)) {
                e.preventDefault();
            }
        });
    });
});
</script>

@endsection



