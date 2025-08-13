@extends('layouts.admin')

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
</style>

<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0"><i class="fas fa-calendar-alt me-2"></i> Reservations Management</h1>
        <div>
            
            <form method="GET" action="{{ route('admin.reservations.index') }}" class="d-flex mb-0">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm me-2" placeholder="Search reservations..." style="width: 200px;">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-search me-1"></i> Search
                </button>
            </form>
        </div>
    </div>

    <!-- Group Reservations -->
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
                        <select name="status" class="form-select form-select-sm me-2">
                            <option value="pending" {{ $group->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $group->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="checked_out" {{ $group->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                            <option value="cancelled" {{ $group->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-outline-primary">
                            Update
                        </button>
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
                            <p><strong>Total Guests:</strong> {{ $group->children->sum('guests') }}</p>
                            <p><strong>Total Rooms:</strong> {{ $group->children->count() }}</p>
                            <p><strong>Reference:</strong> {{ $group->reference_number }}</p>
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
                                <p><i class="fas fa-user-friends me-1"></i> {{ $child->guests }} guests</p>
                                <p>Check-in: {{ $child->check_in->format('M d, Y') }}</p>
                                <p>Check-out: {{ $child->check_out->format('M d, Y') }}</p>

                                <!-- Child status form -->
                                <form method="POST" action="{{ route('admin.reservations.updatestatus', $child->id) }}" class="d-flex mb-2">
                                    @csrf @method('PATCH')
                                    <select name="status" class="form-select form-select-sm me-2 status-select"
                                        data-id="{{ $child->id }}"
                                        data-roomtype="{{ $child->room_type }}">
                                        <option value="pending" {{ $child->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $child->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="checked_out" {{ $child->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                        <option value="cancelled" {{ $child->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                                </form>

                                <div class="d-flex flex-wrap">
                                    <a href="{{ route('admin.reservations.show', $child->id) }}" class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.reservations.destroy', $child->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
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

    <!-- Individual Reservations -->
    <h4 class="section-title"><i class="fas fa-calendar-check me-2"></i> Single Reservations</h4>
    <div class="row">
        @forelse($reservations as $reservation)
        <div class="col-xl-4 col-lg-6 col-md-6 mb-4 ">
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
                    <h5>{{ $reservation->name }}</h5>
                    <p><strong>Room Type:</strong> {{ $reservation->room_type }}</p>
                    <p><i class="fas fa-user-friends me-1"></i> {{ $reservation->guests }} guests</p>
                    <p>Check-in: {{ $reservation->check_in->format('M d, Y') }}</p>
                    <p>Check-out: {{ $reservation->check_out->format('M d, Y') }}</p>
                    <p><strong>Contact:</strong> {{ $reservation->email }} | {{ $reservation->phone }}</p>

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



                        <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                    </form>

                    <div class="d-flex flex-wrap">
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
                        
                        <div class="d-flex flex-wrap border-top pt-3">
                            <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-eye me-1"></i> Details
                            </a>
                            {{-- <a href="{{ route('admin.reservations.invoice', $reservation->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-file-invoice me-1"></i> Invoice
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>



<!-- Room Assignment Modal -->
<div class="modal fade" id="assignRoomModal" tabindex="-1" aria-labelledby="assignRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignRoomModalLabel">Assign Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="assignRoomForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" id="modal_status" value="">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="room_id" class="form-label">Select Room</label>
                            <select name="room_id" id="room_id" class="form-select" required>
                            <option value="">-- Select a Room --</option>
                            <!-- Rooms will be populated via JavaScript -->
                        </select>
                    </div>
                    <div id="reasonContainer" class="mb-3 d-none">
                        <label for="reason" class="form-label">Cancellation Reason</label>
                        <textarea name="reason" id="reason" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-select').forEach(function(select) {
        select.addEventListener('change', function() {
            const status = this.value;
            const reservationId = this.dataset.id;
            const roomType = this.dataset.roomtype;
            const form = this.closest('form');
            
            if (status === 'confirmed') {
                // Show loading state
                const originalText = this.nextElementSibling.innerHTML;
                this.nextElementSibling.innerHTML = 'Loading...';
                this.disabled = true;
                
                fetch(`/admin/reservations/available-rooms/${encodeURIComponent(roomType)}`)
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.message || `Server returned ${response.status}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    const roomSelect = document.getElementById('room_id');
                    roomSelect.innerHTML = '<option value="">-- Select a Room --</option>';
                    
                    if (data.rooms && data.rooms.length > 0) {
                        data.rooms.forEach(room => {
                            const option = document.createElement('option');
                            option.value = room.id;
                            option.textContent = `Room ${room.room_name} (${room.room_type})`;

                            roomSelect.appendChild(option);
                        });
                        
                    } else {
                        throw new Error(data.message || 'No available rooms found');
                    }
                    
                    const modal = new bootstrap.Modal(document.getElementById('assignRoomModal'));
                    const modalForm = document.getElementById('assignRoomForm');
                    const reasonContainer = document.getElementById('reasonContainer');
                    
                    modalForm.action = `/admin/reservations/${reservationId}/update-status`;
                    document.getElementById('modal_status').value = status;
                    document.querySelector('#room_id').closest('.mb-3').classList.remove('d-none');
                    reasonContainer.classList.add('d-none');
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert(`Error: ${error.message}`);
                    this.value = 'pending';
                })
                .finally(() => {
                    this.nextElementSibling.innerHTML = originalText;
                    this.disabled = false;
                });
        
         
            }
            // ... rest of your code
            else if (status === 'checked_out') {
                // Set up the modal for check-out
                const modal = new bootstrap.Modal(document.getElementById('assignRoomModal'));
                const modalForm = document.getElementById('assignRoomForm');
                const roomSelectContainer = document.querySelector('#room_id').closest('.mb-3');
                const reasonContainer = document.getElementById('reasonContainer');
                
                // Update form action
                modalForm.action = `/admin/reservations/${reservationId}/update-status`;
                document.getElementById('modal_status').value = status;
                
                // Hide reason, show room select
                reasonContainer.classList.add('d-none');
                roomSelectContainer.classList.remove('d-none');
                
                // Show modal
                modal.show();
            } 
            else if (status === 'cancelled') {
                // Set up the modal for cancellation
                const modal = new bootstrap.Modal(document.getElementById('assignRoomModal'));
                const modalForm = document.getElementById('assignRoomForm');
                const roomSelectContainer = document.querySelector('#room_id').closest('.mb-3');
                const reasonContainer = document.getElementById('reasonContainer');
                
                // Update form action
                modalForm.action = `/admin/reservations/${reservationId}/update-status`;
                document.getElementById('modal_status').value = status;
                
                // Show reason, hide room select
                reasonContainer.classList.remove('d-none');
                roomSelectContainer.classList.add('d-none');
                
                // Show modal
                modal.show();
            } 
            else {
                // For other statuses, submit the form directly
                form.submit();
            }
        });
    });
    
    // Handle modal form submission
    document.getElementById('assignRoomForm')?.addEventListener('submit', function(e) {
        // The form will submit to the updateStatus route with all necessary data
        // No need for additional JavaScript handling here
    });
});

</script>
@endpush

@endsection