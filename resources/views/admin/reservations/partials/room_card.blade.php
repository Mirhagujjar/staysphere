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
    .status-badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }
    .detail-item {
        margin-bottom: 0.5rem;
    }
    .detail-label {
        font-weight: 500;
        color: #495057;
        min-width: 100px;
        display: inline-block;
    }
</style>

<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0"><i class="fas fa-calendar-alt me-2"></i> Reservations Management</h1>
        <div>
            <a href="{{ route('admin.reservations.create-group') }}" class="btn btn-sm btn-success me-2">
                <i class="fas fa-plus-circle me-1"></i> Add Group
            </a>
            <form method="GET" action="{{ route('admin.reservations.index') }}" class="d-flex mb-0">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control form-control-sm me-2" 
                       placeholder="Search reservations..." 
                       style="width: 200px;">
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
                                <small class="text-muted">
                                    {{ $group->check_in->format('M d, Y') }} - {{ $group->check_out->format('M d, Y') }}
                                    | Status: <span class="badge status-badge bg-{{ $group->status == 'confirmed' ? 'success' : ($group->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($group->status) }}
                                    </span>
                                </small>
                            </div>
                            <div class="d-flex align-items-center">
                                <form method="POST" action="{{ route('admin.reservations.updatestatus', $group->id) }}" class="d-flex">
                                    @csrf @method('PATCH')
                                    <select name="status" class="form-select form-select-sm me-2">
                                        @foreach(['pending', 'confirmed', 'checked_out', 'cancelled'] as $status)
                                            <option value="{{ $status }}" {{ $group->status == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label">Group Name:</span>
                                        <span>{{ $group->name }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Email:</span>
                                        <span>{{ $group->email }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Phone:</span>
                                        <span>{{ $group->phone }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label">Total Guests:</span>
                                        <span>{{ $group->children->sum('guests') }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Total Rooms:</span>
                                        <span>{{ $group->children->count() }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Reference:</span>
                                        <span>{{ $group->reference_number }}</span>
                                    </div>
                                </div>
                            </div>

                            <h6 class="mb-3"><i class="fas fa-door-open me-2"></i> Rooms in this Group:</h6>
                            <div class="row g-3">
                                @foreach($group->children as $child)
                                    <div class="col-md-4">
                                        <div class="room-card p-3 border rounded">
                                            @include('admin.reservations.partials.room_card', ['reservation' => $child])
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

    <!-- Single Reservations -->
    <h4 class="section-title"><i class="fas fa-calendar-check me-2"></i> Single Reservations</h4>
    <div class="row">
        @forelse($singleReservations as $reservation)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                <div class="card reservation-card h-100">
                    <div class="position-relative">
                        @if($reservation->room && $reservation->room->image)
                            <img src="{{ asset($reservation->room->image) }}" 
                                 class="card-img-top" 
                                 alt="Room image" 
                                 style="height: 180px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                <span class="text-muted">No image available</span>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        @include('admin.reservations.partials.room_card', ['reservation' => $reservation])
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No single reservations found.</div>
            </div>
        @endforelse
    </div>
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
    // Status change handler
    document.querySelectorAll('.status-select').forEach(function(select) {
        select.addEventListener('change', function() {
            const status = this.value;
            const reservationId = this.dataset.id;
            const roomType = this.dataset.roomtype;
            const form = this.closest('form');
            
            if (status === 'confirmed') {
                handleConfirmedStatus(reservationId, roomType, this);
            } else if (status === 'checked_out') {
                setupStatusModal(reservationId, status, false);
            } else if (status === 'cancelled') {
                setupStatusModal(reservationId, status, true);
            } else {
                form.submit();
            }
        });
    });
    
    // Handle confirmed status with room assignment
    function handleConfirmedStatus(reservationId, roomType, selectElement) {
        const originalText = selectElement.nextElementSibling.innerHTML;
        selectElement.nextElementSibling.innerHTML = 'Loading...';
        selectElement.disabled = true;
        
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
                    setupStatusModal(reservationId, 'confirmed', false);
                } else {
                    throw new Error(data.message || 'No available rooms found');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(`Error: ${error.message}`);
                selectElement.value = 'pending';
            })
            .finally(() => {
                selectElement.nextElementSibling.innerHTML = originalText;
                selectElement.disabled = false;
            });
    }
    
    // Setup modal for status changes
    function setupStatusModal(reservationId, status, showReason) {
        const modal = new bootstrap.Modal(document.getElementById('assignRoomModal'));
        const modalForm = document.getElementById('assignRoomForm');
        const roomSelectContainer = document.querySelector('#room_id').closest('.mb-3');
        const reasonContainer = document.getElementById('reasonContainer');
        
        modalForm.action = `/admin/reservations/${reservationId}/update-status`;
        document.getElementById('modal_status').value = status;
        
        if (showReason) {
            reasonContainer.classList.remove('d-none');
            roomSelectContainer.classList.add('d-none');
        } else {
            reasonContainer.classList.add('d-none');
            roomSelectContainer.classList.remove('d-none');
        }
        
        modal.show();
    }
});
</script>
@endpush

@endsection