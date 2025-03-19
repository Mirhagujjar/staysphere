@extends('admin.dashboard')

@section('content')
<div class="container">
    <h2>Edit Room</h2>
    <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Room Name:</label>
            <input type="text" name="room_name" class="form-control" value="{{ $room->room_name }}" required>
        </div>

        <div class="mb-3">
            <label>Room Type:</label>
            <input type="text" name="room_type" class="form-control" value="{{ $room->room_type }}" required>
        </div>

        <div class="mb-3">
            <label>Price:</label>
            <input type="number" name="price" class="form-control" value="{{ $room->price }}" required>
        </div>

        <div class="mb-3">
            <label>Room Capacity:</label>
            <input type="number" name="room_capacity" class="form-control" value="{{ $room->room_capacity }}" required>
        </div>

        <div class="mb-3">
            <label>Facilities:</label>
            <input type="text" name="facilities" class="form-control" value="{{ $room->facilities }}" required>
        </div>

        <div class="mb-3">
            <label>Has View:</label>
            <select name="has_view" class="form-control">
                <option value="1" {{ $room->has_view ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$room->has_view ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Current Room Image:</label><br>
            <img src="{{ url('storage/' . $room->image) }}" width="80">
        </div>

        <div class="mb-3">
            <label>Upload New Image (Optional):</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Room</button>
    </form>
</div>
@endsection
