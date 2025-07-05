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
</style>

<div class="form-page">
    <div class="form-container">
        <h2 class="text-center heading mb-4">Book Your Rooms</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('user.reservations.store') }}" method="POST">
            @csrf

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
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div id="rooms-container">
                <div class="room-block border p-3 mb-4 rounded">
                    <h5>Room 1</h5>
                    <div class="mb-3">
                        <label class="form-label">Room Type</label>
                        <select name="rooms[0][room_type]" class="form-control" required>
                            <option value="">-- Select Room Type --</option>
                            @foreach($roomTypes as $type)
                                <option value="{{ $type->label }}">{{ $type->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Guests</label>
                        <input type="number" name="rooms[0][guests]" class="form-control" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Optional Service</label>
                        <select name="rooms[0][service_id]" class="form-control">
                            <option value="">-- None --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->title }} ({{ $service->price }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="button" id="add-room" class="btn btn-secondary mb-3">+ Add Another Room</button>

            <div class="mb-3">
                <label class="form-label">Check-in</label>
                <input type="date" name="check_in" class="form-control" required min="{{ now()->toDateString() }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Check-out</label>
                <input type="date" name="check_out" class="form-control" required min="{{ now()->toDateString() }}">
            </div>

            <button type="submit" class="btn btn-submit w-100">Book Now</button>
        </form>
    </div>
</div>

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

@endsection
