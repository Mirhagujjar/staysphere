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
        background-color: rgba(255, 255, 255, 0.9);
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
</style>

<div class="form-page">
    <div class="form-container">
        <h2 class="text-center heading mb-4">Edit Your Reservation</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('user.reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="room_id" value="{{ $reservation->room->id }}">

            <div class="mb-3">
                <label class="form-label">Your Name</label>
                <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Your Email</label>
                <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $reservation->phone) }}" required>
            </div>

            <div id="rooms-container">
                <div class="room-block border p-3 mb-4 rounded">
                    <h5>Room 1</h5>
                    <div class="mb-3">
                        <label class="form-label">Room Type</label>
                        <select name="rooms[0][room_type]" class="form-control" required>
                            <option value="">-- Select Room Type --</option>
                            @foreach($roomTypes as $type)
                                <option value="{{ $type->label }}"
                                    {{ $reservation->room->roomType && $reservation->room->roomType->label == $type->label ? 'selected' : '' }}>
                                    {{ $type->label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Guests</label>
                        <input type="number" name="rooms[0][guests]" class="form-control"
                               min="1" value="{{ old('rooms.0.guests', $reservation->guests) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Optional Service</label>
                        <select name="rooms[0][service_id]" class="form-control">
                            <option value="">-- None --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ $reservation->service_id == $service->id ? 'selected' : '' }}>
                                    {{ $service->title }} ({{ $service->price }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Note: For edit, adding more rooms dynamically usually doesn’t make sense. If you want it, keep the button. --}}
            {{-- <button type="button" id="add-room" class="btn btn-secondary mb-3">+ Add Another Room</button> --}}

            <div class="mb-3">
                <label class="form-label">Check-in</label>
                <input type="date" name="check_in" class="form-control"
                       value="{{ old('check_in', $reservation->check_in->format('Y-m-d')) }}"
                       required min="{{ now()->toDateString() }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Check-out</label>
                <input type="date" name="check_out" class="form-control"
                       value="{{ old('check_out', $reservation->check_out->format('Y-m-d')) }}"
                       required min="{{ now()->toDateString() }}">
            </div>

            <button type="submit" class="btn btn-submit w-100">Update Reservation</button>
        </form>
    </div>
</div>

{{-- If you really want dynamic room blocks for edit too, you can uncomment and reuse this script --}}
{{-- 
<script>
let roomIndex = 1;
document.getElementById('add-room').addEventListener('click', function() {
    const container = document.getElementById('rooms-container');
    const newRoom = container.firstElementChild.cloneNode(true);
    newRoom.querySelector('h5').innerText = `Room ${roomIndex + 1}`;

    newRoom.querySelectorAll('select, input').forEach(input => {
        input.name = input.name.replace(/\[\d+\]/, `[${roomIndex}]`);
        if (input.tagName === 'INPUT') input.value = '';
        if (input.tagName === 'SELECT') input.selectedIndex = 0;
    });

    container.appendChild(newRoom);
    roomIndex++;
});
</script>
--}}

@endsection
