@extends('layouts.app')

@section('content')

<style>
    .form-page {
        height: 60%;
        background: url({{ asset('build/assets/images/bg2.jpg') }});
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .form-container {
        margin-top: 15px;
        margin-bottom: 15px;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 30px;
        border-radius: 15px;
        width: 100%;
        max-width: 700px;
    }
    .form-label, .heading {
        color: #2C3E50;
    }
    .btn-submit {
        background-color: #F1C40F;
        color: #2C3E50;
        font-size: 16px;
        border: none;
        border-radius: 5px;
    }
    .btn-submit:hover {
        background-color: #1ABC9C;
        color: white;
    }
    .room-calculation .alert {
        padding: 8px 12px;
        margin-bottom: 0;
        font-size: 0.9rem;
    }
    .room-block {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #f8f9fa;
    }
</style>

<div class="form-page">
    <div class="form-container">
        <h2 class="text-center heading mb-4">Book Your Rooms</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Please fix the following errors:
                <ul class="mt-2 mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.reservations.store') }}" method="POST" id="reservation-form">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">

            <div class="mb-3">
                <label class="form-label">Your Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Your Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>

            <div id="rooms-container">
                <div class="room-block border p-3 mb-4 rounded">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Room 1</h5>
                        <button type="button" class="btn btn-sm btn-danger remove-room" style="display: none;">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Room Type</label>
                        <select name="rooms[0][room_type]" class="form-control room-type-select" required>
                            <option value="">-- Select Room Type --</option>
                            @foreach($roomTypes as $type)
                                <option value="{{ $type->label }}" 
                                    data-capacity="{{ $type->capacity ?? 2 }}"
                                    {{ $room->roomType && $room->roomType->label == $type->label ? 'selected' : '' }}>
                                    {{ $type->label }} (Capacity: {{ $type->capacity ?? 2 }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Number of Guests</label>
                        <input type="number" name="rooms[0][guests]" class="form-control guest-count" 
                               min="1" value="{{ old('rooms.0.guests', 1) }}" required>
                        <div class="room-calculation mt-2"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Optional Service</label>
                        <div>
                            @foreach($services as $service)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="rooms[0][service_ids][]" 
                                        id="service_{{ $service->id }}" value="{{ $service->id }}">
                                    <label class="form-check-label" for="service_{{ $service->id }}">
                                        {{ $service->title }} (Rs. {{ $service->price }})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="add-room" class="btn btn-outline-primary mb-4">
                <i class="bi bi-plus-circle me-1"></i> Add Another Room
            </button>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Check-in</label>
                    <input type="date" name="check_in" class="form-control" 
                           value="{{ old('check_in') }}" required 
                           min="{{ now()->toDateString() }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Check-out</label>
                    <input type="date" name="check_out" class="form-control" 
                           value="{{ old('check_out') }}" required 
                           min="{{ now()->addDay()->toDateString() }}">
                </div>
            </div>

            <div class="alert alert-info mb-4">
                <i class="bi bi-info-circle me-2"></i>
                Rooms will be automatically added if your guest count exceeds room capacity.
                Specific room numbers will be assigned after confirmation by our staff.
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">
                <i class="bi bi-check-circle me-1"></i> Submit Reservation
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let roomIndex = 1;
    const container = document.getElementById('rooms-container');
    
    // Update room calculations
    function updateRoomCalculations(roomBlock) {
        const typeSelect = roomBlock.querySelector('.room-type-select');
        const guestInput = roomBlock.querySelector('.guest-count');
        const calculationDiv = roomBlock.querySelector('.room-calculation');
        
        const selectedOption = typeSelect.options[typeSelect.selectedIndex];
        const roomCapacity = parseInt(selectedOption.getAttribute('data-capacity')) || 2;
        const guests = parseInt(guestInput.value) || 0;
        
        if (guests > 0) {
            const roomsNeeded = Math.ceil(guests / roomCapacity);
            const fullRooms = Math.floor(guests / roomCapacity);
            const partialGuests = guests % roomCapacity;
            
            let message = '';
            if (guests > roomCapacity) {
                message = `<strong>${roomsNeeded} room(s) will be booked:</strong> `;
                if (fullRooms > 0) message += `${fullRooms} full room(s)`;
                if (partialGuests > 0) {
                    if (fullRooms > 0) message += ' and ';
                    message += `1 room with ${partialGuests} guest(s)`;
                }
                calculationDiv.innerHTML = `<div class="alert alert-warning p-2 mb-0 small">${message}</div>`;
            } else {
                calculationDiv.innerHTML = `<div class="alert alert-success p-2 mb-0 small">1 room will be booked for ${guests} guest(s)</div>`;
            }
        } else {
            calculationDiv.innerHTML = '';
        }
    }
    
    // Add new room block
    document.getElementById('add-room').addEventListener('click', function() {
        const newRoom = container.firstElementChild.cloneNode(true);
        const newIndex = roomIndex++;
        
        // Update all names and IDs
        newRoom.querySelectorAll('[name]').forEach(el => {
            const name = el.getAttribute('name').replace(/\[\d+\]/, `[${newIndex}]`);
            el.setAttribute('name', name);
            el.value = '';
        });
        
        // Update room number and show remove button
        newRoom.querySelector('h5').textContent = `Room ${newIndex + 1}`;
        newRoom.querySelector('.remove-room').style.display = 'block';
        
        // Clear calculations
        newRoom.querySelector('.room-calculation').innerHTML = '';
        
        container.appendChild(newRoom);
        
        // Add event listeners to new elements
        newRoom.querySelector('.room-type-select').addEventListener('change', function() {
            updateRoomCalculations(newRoom);
        });
        
        newRoom.querySelector('.guest-count').addEventListener('input', function() {
            updateRoomCalculations(newRoom);
        });
        
        newRoom.querySelector('.remove-room').addEventListener('click', function() {
            if (container.children.length > 1) {
                newRoom.remove();
                // Renumber remaining rooms
                document.querySelectorAll('.room-block').forEach((block, index) => {
                    block.querySelector('h5').textContent = `Room ${index + 1}`;
                });
            }
        });
    });
    
    // Add event listeners to initial room
    const initialRoom = container.firstElementChild;
    initialRoom.querySelector('.room-type-select').addEventListener('change', function() {
        updateRoomCalculations(initialRoom);
    });
    
    initialRoom.querySelector('.guest-count').addEventListener('input', function() {
        updateRoomCalculations(initialRoom);
    });
    
    // Date validation
    const checkInInput = document.querySelector('input[name="check_in"]');
    const checkOutInput = document.querySelector('input[name="check_out"]');
    
    checkInInput.addEventListener('change', function() {
        if (checkInInput.value) {
            const nextDay = new Date(checkInInput.value);
            nextDay.setDate(nextDay.getDate() + 1);
            checkOutInput.min = nextDay.toISOString().split('T')[0];
            
            if (checkOutInput.value && checkOutInput.value <= checkInInput.value) {
                checkOutInput.value = '';
            }
        }
    });
    
    // Initialize calculations for initial room if values exist
    if (initialRoom.querySelector('.guest-count').value) {
        updateRoomCalculations(initialRoom);
    }
});
</script>

@endsection