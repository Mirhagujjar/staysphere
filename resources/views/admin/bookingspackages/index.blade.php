@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="mb-3 mb-md-0">All Bookings</h2>
        </div>
        {{-- <div class="col-md-6 text-md-end">
            <a href="" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Create New Booking
            </a>
        </div> --}}
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th class="d-none d-md-table-cell">Package</th>
                            {{-- <th>Image</th> --}}
                            <th>Price</th>
                            <th class="d-none d-lg-table-cell">Dates</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->full_name }}</td>
                            <td class="d-none d-md-table-cell">{{ $booking->package->name ?? 'N/A' }}</td>
                            {{-- <td>
                                <img src="{{ asset($booking->image ?? 'uploads/packages/' . ($booking->package->image ?? '')) }}" 
                                     alt="{{ $booking->package->name ?? 'Booking image' }}" 
                                     class="img-thumbnail" 
                                     style="width: 60px; height: auto;">
                            </td> --}}
                            <td>Rs. {{ number_format($booking->package->price ?? 0, 2) }}</td>
                            <td class="d-none d-lg-table-cell">
                                {{ date('M d, Y', strtotime($booking->check_in)) }} - 
                                {{ date('M d, Y', strtotime($booking->check_out)) }}
                            </td>
                            <td>
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <select name="status" class="form-control">
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <!-- Single status form -->
                    <form method="POST" action="{{ route('admin.bookingspackages.updatestatus', $booking->id)}}" class="d-flex mb-2">
                        @csrf 
                        @method('PATCH')
                        <select name="status" class="form-select form-select-sm me-2 status-select"
                            data-id="{{ $booking->id }}"
                            data-roomtype="{{ $booking->package->type ?? '' }}">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>

                        <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
                    </form>


                                <div class="d-flex flex-wrap gap-2">
                                    {{-- <a href="{{ route('admin.bookingspackages.edit', $booking->id) }}"" class="btn btn-sm btn-primary" title="Edit">Edit
                                        <i class="fas fa-edit"></i>
                                    </a> --}}
                                    <form action="{{ route('admin.bookingspackages.destroy', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this booking?')"
                                                title="Delete">Delete
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- @push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // First, extract room type for each reservation and add it as a data attribute
    document.querySelectorAll('.status-select').forEach(function(select) {
        const form = select.closest('form');
        const roomTypeInput = form.querySelector('input[name="room_type"]');
        if (roomTypeInput) {
            select.dataset.roomtype = roomTypeInput.value;
        }
    });

    document.querySelectorAll('.status-select').forEach(function(select) {
        select.addEventListener('change', function() {
            const status = this.value;
            const reservationId = this.dataset.id;
            const roomType = this.dataset.roomtype; // Get room type from data attribute
            const form = this.closest('form');

            const modal = new bootstrap.Modal(document.getElementById('assignRoomModal'));
            const modalForm = document.getElementById('assignRoomForm');
            const reasonContainer = document.getElementById('reasonContainer');
            const roomSelect = document.getElementById('room_id');
            const roomSelectContainer = roomSelect.closest('.mb-3');

            modalForm.action = `/admin/reservations/${reservationId}/update-status`;
            document.getElementById('modal_status').value = status;

            // Reset validation and visibility
            roomSelect.required = false;
            document.getElementById('reason').required = false;
            roomSelectContainer.classList.add('d-none');
            reasonContainer.classList.add('d-none');

            if (status === 'confirmed') {
                // Show loading state
                const saveButton = form.querySelector('button[type="submit"]');
                const originalText = saveButton.innerHTML;
                saveButton.innerHTML = 'Loading...';
                saveButton.disabled = true;
                
                // Check if roomType is available
                if (!roomType) {
                    alert('Error: Room type information is missing');
                    this.value = 'pending';
                    saveButton.innerHTML = originalText;
                    saveButton.disabled = false;
                    return;
                }
                
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
                    roomSelect.innerHTML = '<option value="">-- Select a Room --</option>';
                    
                    if (data.rooms && data.rooms.length > 0) {
                        data.rooms.forEach(room => {
                            const option = document.createElement('option');
                            option.value = room.id;
                            option.textContent = `Room ${room.room_name} (${room.room_type})`;
                            roomSelect.appendChild(option);
                        });
                        
                        roomSelect.required = true;
                        roomSelectContainer.classList.remove('d-none');
                        reasonContainer.classList.add('d-none');
                        modal.show();
                    } else {
                        throw new Error(data.message || 'No available rooms found for this room type');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert(`Error: ${error.message}`);
                    this.value = 'pending';
                })
                .finally(() => {
                    saveButton.innerHTML = originalText;
                    saveButton.disabled = false;
                });
            }
            // else if (status === 'checked_out') {
            //     roomSelect.required = true;
            //     roomSelectContainer.classList.remove('d-none');
            //     reasonContainer.classList.add('d-none');
            //     modal.show();
            // }
            else if (status === 'cancelled') {
                document.getElementById('reason').required = true;
                reasonContainer.classList.remove('d-none');
                roomSelectContainer.classList.add('d-none');
                modal.show();
            }
            else {
                // pending or others → submit form directly
                form.submit();
            }
        });
    });
});
</script>
@endpush --}}

<!-- Modal -->
<div class="modal fade" id="assignRoomModal" tabindex="-1" aria-labelledby="assignRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="assignRoomForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" id="modal_status">

                <div class="modal-header">
                    <h5 class="modal-title">Update Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="room_id" class="form-label">Select Room</label>
                        <select name="room_id" id="room_id" class="form-select">
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
@endsection