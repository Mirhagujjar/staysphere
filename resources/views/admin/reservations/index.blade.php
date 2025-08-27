@extends('layouts.admin')

@section('content')
<style>
    .reservation-card { border: none; border-radius:10px; box-shadow:0 3px 10px rgba(0,0,0,0.08); margin-bottom:1.5rem; border-left:4px solid transparent; }
    .group-card { border-left:4px solid #0d6efd; }
    .room-card { background-color:#f8f9fa; border-radius:8px; height:100%; }
    .room-img-container { height:120px; overflow:hidden; }
    .room-img { width:100%; height:100%; object-fit:cover; }
    .section-title { font-weight:600; color:#2d3748; margin:2rem 0 1.5rem; padding-bottom:0.75rem; border-bottom:1px solid rgba(0,0,0,0.1); }
    .reason-box {
        background-color: #f8f9fa;
        border-left: 4px solid #6c757d;
        padding: 10px;
        border-radius: 4px;
        margin-top: 10px;
    }
    .reason-label {
        font-weight: 600;
        color: #495057;
    }
</style>

<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0"><i class="fas fa-calendar-alt me-2"></i> Reservations Management</h1>
        <form method="GET" action="{{ route('admin.reservations.index') }}" class="d-flex mb-0">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm me-2" placeholder="Search reservations..." style="width:200px;">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search me-1"></i> Search</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Group Reservations --}}
    @if($groupedReservations->isNotEmpty())
    <h4 class="section-title"><i class="fas fa-users me-2"></i> Group Reservations</h4>
    <div class="row">
        @foreach($groupedReservations as $group)
        <div class="col-12 mb-4">
            <div class="card reservation-card group-card">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1"><i class="fas fa-users me-2"></i> Group #{{ $group->id }}</h5>
                        <small class="text-muted">{{ $group->check_in->format('M d, Y') }} - {{ $group->check_out->format('M d, Y') }}</small>
                    </div>
                    <form method="POST" action="{{ route('admin.reservations.updatestatus', $group->id) }}" class="d-flex align-items-center">
                        @csrf @method('PATCH')
                        <select name="status" class="form-select form-select-sm me-2 group-status-select">
                            <option value="pending" {{ $group->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $group->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="checked_out" {{ $group->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                            <option value="cancelled" {{ $group->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <div class="me-2">
                            <input type="text" name="reason" class="form-control form-control-sm" placeholder="Reason (if cancelling)" 
                                   value="{{ $group->reason }}" style="width: 200px;">
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                    </form>
                    <a href="{{ route('admin.reservations.grouped-reservations', $group->id) }}" class="btn btn-sm btn-outline-secondary me-2">
                        <i class="fas fa-eye"></i> View Group
                    </a>
                    <a href="{{ route('admin.reservations.invoice', $group->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-file-invoice me-1"></i> Invoice
                    </a>
                    <form action="{{ route('admin.reservations.destroy', $group->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Group Name:</strong> {{ $group->name }}</p>
                            <p><strong>Email:</strong> {{ $group->email }}</p>
                            <p><strong>Phone:</strong> {{ $group->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <span class="position-absolute top-0 end-0 m-2 badge rounded-pill 
                                @if($group->status == 'confirmed') bg-success
                                @elseif($group->status == 'pending') bg-warning
                                @elseif($group->status == 'cancelled') bg-danger
                                @elseif($group->status == 'checked_out') bg-secondary
                                @else bg-light text-dark
                                @endif">
                                {{ ucfirst($group->status) }}
                            </span>
                            <p><strong>Total Guests:</strong> {{ $group->children->sum('guests') }}</p>
                            <p><strong>Total Rooms:</strong> {{ $group->children->count() }}</p>
                        </div>
                    </div>

                    <!-- Display reason if exists -->
                    @if($group->reason)
                    <div class="reason-box mb-3">
                        <span class="reason-label">Reason:</span> {{ $group->reason }}
                    </div>
                    @endif

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
                                <p><i class="fas fa-user-friends me-1"></i> {{ $child->guests }} guests</p>
                                <p>Check-in: {{ $child->check_in->format('M d, Y') }}</p>
                                <p>Check-out: {{ $child->check_out->format('M d, Y') }}</p>

                                <!-- Display child reason if exists -->
                                @if($child->reason)
                                <div class="reason-box mb-2">
                                    <span class="reason-label">Reason:</span> {{ $child->reason }}
                                </div>
                                @endif

                                {{-- Child status form --}}
                                <form method="POST" action="{{ route('admin.reservations.updatestatus', $child->id) }}" class="d-flex mb-2">
                                    @csrf @method('PATCH')
                                    <select name="status" class="form-select form-select-sm me-2 status-select" data-id="{{ $child->id }}" data-roomtype="{{ $child->room_type }}">
                                        <option value="pending" {{ $child->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $child->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="checked_out" {{ $child->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                        <option value="cancelled" {{ $child->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <div class="me-2">
                                        <input type="text" name="reason" class="form-control form-control-sm" placeholder="Reason" 
                                               value="{{ $child->reason }}" style="width: 120px;">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                                </form>

                                <button type="button" 
                                        class="btn btn-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#assignRoomModal-{{ $child->id }}">
                                    Assign Room
                                </button>

                                <a href="{{ route('admin.reservations.invoice', $child->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-file-invoice me-1"></i> Invoice
                                </a>

                                <div class="d-flex flex-wrap mt-2">
                                    <a href="{{ route('admin.reservations.show', $child->id) }}" class="btn btn-sm btn-outline-secondary me-2"><i class="fas fa-eye"></i></a>
                                    <form action="{{ route('admin.reservations.destroy', $child->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Single Reservations --}}
    <h4 class="section-title"><i class="fas fa-calendar-check me-2"></i> Single Reservations</h4>
    <div class="row">
        @forelse($reservations as $reservation)
        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
            <div class="card reservation-card h-100">
                <div class="position-relative">
                    @if($reservation->room && $reservation->room->image)
                    <img src="{{ asset($reservation->room->image) }}" class="card-img-top" alt="Room image" style="height: 180px; object-fit: cover;">
                    @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                        <span class="text-muted">No image</span>
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    <span class="position-absolute top-0 end-0 m-2 badge rounded-pill 
                        @if($reservation->status == 'confirmed') bg-success
                        @elseif($reservation->status == 'pending') bg-warning
                        @elseif($reservation->status == 'cancelled') bg-danger
                        @elseif($reservation->status == 'checked_out') bg-secondary
                        @else bg-light text-dark
                        @endif">
                        {{ ucfirst($reservation->status) }}
                    </span>
                    <h5>{{ $reservation->name }}</h5>
                    <p><strong>Room Type:</strong> {{ $reservation->room_type }}</p>
                    <p><i class="fas fa-user-friends me-1"></i> {{ $reservation->guests }} guests</p>
                    <p>Check-in: {{ $reservation->check_in->format('M d, Y') }}</p>
                    <p>Check-out: {{ $reservation->check_out->format('M d, Y') }}</p>
                    <p><strong>Contact:</strong> {{ $reservation->email }} | {{ $reservation->phone }}</p>

                    <!-- Display reason if exists -->
                    @if($reservation->reason)
                    <div class="reason-box mb-3">
                        <span class="reason-label">Reason:</span> {{ $reservation->reason }}
                    </div>
                    @endif

                    <!-- Single status form -->
                    <form method="POST" action="{{ route('admin.reservations.updatestatus', $reservation->id) }}" class="d-flex mb-2">
                        @csrf @method('PATCH')
                        <select name="status" class="form-select form-select-sm me-2 status-select"
                            data-id="{{ $reservation->id }}"
                            data-roomtype="{{ $reservation->room_type }}">
                            <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="checked_out" {{ $reservation->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                            <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <div class="me-2">
                            <input type="text" name="reason" class="form-control form-control-sm" placeholder="Reason" 
                                   value="{{ $reservation->reason }}" style="width: 120px;">
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                    </form>

                    <button type="button" 
                            class="btn btn-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#assignRoomModal-{{ $reservation->id }}">
                        Assign Room
                    </button>

                    <div class="d-flex flex-wrap mt-2">
                        <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="btn btn-sm btn-outline-secondary me-2">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.reservations.invoice', $reservation->id) }}" 
                        class="btn btn-sm btn-outline-secondary me-2">
                            <i class="fas fa-file-invoice"></i> Invoice
                        </a>
                        <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">No single reservations found.</p>
        @endforelse
    </div>

    <!-- Past Reservations -->
    @if($pastReservations->isNotEmpty())
        <h4 class="section-title">
            <i class="fas fa-history me-2"></i> Past Reservations
        </h4>
        <div class="row">
            @foreach($pastReservations as $reservation)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                <div class="card reservation-card h-100">
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
                        <h5 class="card-title">{{ $reservation->name }}</h5>
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

                        <!-- Display reason if exists -->
                        @if($reservation->reason)
                        <div class="reason-box mb-3">
                            <span class="reason-label">Reason:</span> {{ $reservation->reason }}
                        </div>
                        @endif
                        
                        <div class="d-flex flex-wrap border-top pt-3">
                            <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-eye me-1"></i> Details
                            </a>
                            <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                            <a href="{{ route('admin.reservations.invoice', $reservation->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-file-invoice me-1"></i> Invoice
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

@include('admin.reservations.partials.assign-room-modal')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners for status changes
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const reservationId = this.getAttribute('data-id');
            const roomType = this.getAttribute('data-roomtype');
            const newStatus = this.value;
            
            // You can add additional logic here if needed
            console.log(`Reservation ${reservationId} (${roomType}) status changed to: ${newStatus}`);
        });
    });
});
</script>
@endsection