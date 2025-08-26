@extends('user.layout.master')

@section('content')
<style>
    .reservation-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        border-left: 4px solid transparent;
    }
    .group-card {
        border-left: 4px solid #0d6efd;
    }
    .room-card {
        background-color: #f8f9fa;
        border-radius: 8px;
        height: 100%;
    }
    .room-img-container {
        height: 120px;
        overflow: hidden;
    }
    .room-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .section-title {
        font-weight: 600;
        color: #2d3748;
        margin: 2rem 0 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-weight: 500;
    }
    .status-confirmed { background-color: #e6f7ee; color: #28a745; }
    .status-pending { background-color: #fff8e6; color: #ffc107; }
    .status-cancelled { background-color: #fdecea; color: #dc3545; }
    .status-checked_out, .status-completed { background-color: #e6f3ff; color: #007bff; }

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

    .search-container {
        max-width: 400px;
        margin-left: auto;
    }

    .reservation-card.confirmed { border-left-color: #28a745; }
    .reservation-card.pending { border-left-color: #ffc107; }
    .reservation-card.cancelled { border-left-color: #dc3545; }
    .reservation-card.completed { border-left-color: #007bff; }

    .no-reservations {
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }
    .room-number {
        font-weight: 600;
        color: #1e88e5;
    }
    .card-actions {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding-top: 1rem;
        margin-top: 1rem;
    }
    .action-btn {
        border-radius: 6px;
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }

    /* 📱 Mobile responsiveness */
    @media (max-width: 767.98px) {
        .search-container {
            max-width: 100%;
            margin-top: 1rem;
        }
        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: stretch;
        }
        .card-body h5 {
            font-size: 1rem;
        }
        .room-img-container {
            height: 180px;
        }
    }

    .pagination-sm .pagination { font-size: 0.875rem; }
    .pagination-sm .page-link { padding: 0.25rem 0.5rem; }
    .pagination-sm .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    .detail-item {
        margin-bottom: 0.75rem;
        color: #6c757d;
        display: flex;
        flex-wrap: wrap;
    }
    .detail-label {
        color: #495057;
        font-weight: 500;
        min-width: 100px;
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
            <a href="{{ route('user.rooms.index') }}" class="btn btn-primary px-4">
                <i class="fas fa-door-open me-2"></i> Browse Rooms
            </a>
        </div>
    @else
        <!-- Current Reservations -->
        <h4 class="section-title">
            <i class="fas fa-calendar-check me-2"></i> Upcoming Reservations
        </h4>

        @php
            // Separate group reservations into true groups and singles
            $trueGroups = $groupedReservations->filter(function($group) {
                return $group->children->count() > 1;
            });

            $singleReservations = $groupedReservations->filter(function($group) {
                return $group->children->count() == 1;
            });
        @endphp

        @if($trueGroups->isEmpty() && $singleReservations->isEmpty() && $currentReservations->isEmpty())
            <div class="alert alert-info shadow-sm">
                <i class="fas fa-info-circle me-2"></i> You don't have any upcoming reservations.
            </div>
        @else
            <div class="row">
                {{-- Group Reservations (2+ rooms) --}}
                @foreach($trueGroups as $group)
                    <div class="col-12 mb-4">
                        <div class="card reservation-card group-card {{ $group->status }}">
                            <div class="card-header bg-light">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1"><i class="fas fa-users me-2"></i> Group Reservation #{{ $group->id }}</h5>
                                        <small class="text-muted">{{ $group->check_in->format('M d, Y') }} - {{ $group->check_out->format('M d, Y') }}</small>
                                    </div>
                                    <span class="status-badge status-{{ str_replace(' ', '_', $group->status) }}">
                                        {{ ucfirst($group->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-user me-2"></i>Name:</span>
                                            <span>{{ $group->name }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-envelope me-2"></i>Email:</span>
                                            <span>{{ $group->email }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-phone me-2"></i>Phone:</span>
                                            <span>{{ $group->phone }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-user-friends me-2"></i>Total Guests:</span>
                                            <span>{{ $group->children->sum('guests') }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-door-open me-2"></i>Total Rooms:</span>
                                            <span>{{ $group->children->count() }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-hashtag me-2"></i>Reference:</span>
                                            <span>{{ $group->reference_number }}</span>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="mb-3"><i class="fas fa-door-open me-2"></i> Rooms in this Group:</h6>
                                <div class="row g-3">
                                    @foreach($group->children as $child)
                                    <div class="col-md-4">
                                        <div class="room-card p-3">
                                            <h6>{{ $child->room_type }}</h6>
                                            @if($child->room && $child->room->image)
                                            <div class="room-img-container mb-2 rounded">
                                                <img src="{{ asset($child->room->image) }}" class="room-img" alt="Room">
                                            </div>
                                            @endif
                                            <div class="detail-item">
                                                <span class="detail-label"><i class="fas fa-user-friends me-2"></i>Guests:</span>
                                                <span>{{ $child->guests }}</span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label"><i class="fas fa-calendar-check me-2"></i>Check-in:</span>
                                                <span>{{ $child->check_in->format('M d, Y') }}</span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label"><i class="fas fa-calendar-check me-2"></i>Check-out:</span>
                                                <span>{{ $child->check_out->format('M d, Y') }}</span>
                                            </div>
                                            @if($child->room && $child->status === 'confirmed')
                                            <div class="detail-item">
                                                <span class="detail-label"><i class="fas fa-hashtag me-2"></i>Room:</span>
                                                <span class="room-number">{{ $child->room->room_name }}</span>
                                            </div>
                                            @endif

                                            <div class="d-flex flex-wrap mt-2">
                                                <a href="{{ route('user.reservations.show', $child->id) }}" 
                                                class="btn btn-sm btn-outline-secondary me-2 mb-2">
                                                    <i class="fas fa-eye"></i> Details
                                                </a>
                                                @if($child->status == 'pending')
                                                    <a href="{{ route('user.reservations.edit', $child->id) }}" 
                                                    class="btn btn-sm btn-outline-primary me-2 mb-2">
                                                        <i class="fas fa-edit"></i> Modify
                                                    </a>
                                                    <form action="{{ route('user.reservations.destroy', $child->id) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger mb-2">
                                                            <i class="fas fa-times"></i> Cancel
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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

                {{-- Single Room Reservations --}}
                @foreach($singleReservations as $reservation)
                    @php
                        $roomReservation = $reservation->children->first();
                    @endphp
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="card reservation-card {{ $roomReservation->status }}">
                            <div class="position-relative">
                                @if($roomReservation->room && $roomReservation->room->image)
                                <img src="{{ asset($roomReservation->room->image) }}" class="card-img-top" alt="Room image" style="height: 180px; object-fit: cover;">
                                @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <span class="text-muted">No image</span>
                                </div>
                                @endif
                            </div>

                            <div class="card-body">
                                <h5>{{ $roomReservation->room_type }}</h5>
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fas fa-user-friends me-2"></i>Guests:</span>
                                    <span>{{ $roomReservation->guests }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fas fa-calendar-check me-2"></i>Check-in:</span>
                                    <span>{{ $roomReservation->check_in->format('M d, Y') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fas fa-calendar-check me-2"></i>Check-out:</span>
                                    <span>{{ $roomReservation->check_out->format('M d, Y') }}</span>
                                </div>
                                @if($roomReservation->room && $roomReservation->status === 'confirmed')
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fas fa-hashtag me-2"></i>Room:</span>
                                    <span class="room-number">{{ $roomReservation->room->room_name }}</span>
                                </div>
                                @endif

                                <div class="d-flex flex-wrap mt-3">
                                    <a href="{{ route('user.reservations.show', $roomReservation->id) }}" 
                                    class="btn btn-sm btn-outline-secondary me-2 mb-2">
                                        <i class="fas fa-eye"></i> Details
                                    </a>
                                    <a href="{{ route('user.reservations.invoice', $roomReservation->id) }}" 
                                    class="btn btn-sm btn-outline-primary me-2 mb-2">
                                        <i class="fas fa-file-invoice"></i> Invoice
                                    </a>
                                    @if($roomReservation->status == 'pending')
                                        <a href="{{ route('user.reservations.edit', $roomReservation->id) }}" 
                                        class="btn btn-sm btn-outline-info me-2 mb-2">
                                            <i class="fas fa-edit"></i> Modify
                                        </a>
                                        <form action="{{ route('user.reservations.destroy', $roomReservation->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger mb-2">
                                                <i class="fas fa-times"></i> Cancel
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            {{-- @if($currentReservations->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    <div class="pagination-sm">
                        {{ $currentReservations->withQueryString()->links() }}
                    </div>
                </div>
            @endif --}}
        @endif

        <!-- Past Reservations -->
        @if($pastReservations->isNotEmpty())
            <h4 class="section-title">
                <i class="fas fa-history me-2"></i> Past Reservations
            </h4>
            <div class="row">
                @foreach($pastReservations as $reservation)
                <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <div class="card reservation-card">
                        <div class="position-relative">
                            @if($reservation->room && $reservation->room->image)
                            <img src="{{ asset($reservation->room->image) }}" class="card-img-top" alt="Room image" style="height: 180px; object-fit: cover;">
                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                <span class="text-muted">No image available</span>
                            </div>
                            @endif
                            <span class="position-absolute top-0 end-0 m-2 badge rounded-pill bg-secondary">
                                Completed
                            </span>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $reservation->room_type }}</h5>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="small text-muted mb-1">Check-in</p>
                                        <p><i class="fas fa-calendar-day me-1"></i> {{ $reservation->check_in->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="small text-muted mb-1">Check-out</p>
                                        <p><i class="fas fa-calendar-day me-1"></i> {{ $reservation->check_out->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <p class="mb-1"><i class="fas fa-user-friends me-1"></i> {{ $reservation->guests }} guest{{ $reservation->guests > 1 ? 's' : '' }}</p>
                                @if($reservation->room)
                                <p class="mb-1"><i class="fas fa-hashtag me-1"></i> Room {{ $reservation->room->room_name }}</p>
                                @endif
                            </div>
                            
                            <div class="d-flex flex-wrap border-top pt-3">
                                <a href="{{ route('user.reservations.show', $reservation->id) }}" class="btn btn-outline-secondary me-2">
                                    <i class="fas fa-eye me-1"></i> Details
                                </a>
                                <a href="{{ route('user.reservations.invoice', $reservation->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-file-invoice me-1"></i> Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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