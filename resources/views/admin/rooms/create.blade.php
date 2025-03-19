@extends('admin.dashboard')

@section('content')
<div class="container">
    <h2>Add New Room</h2>
    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Room Name:</label>
            <input type="text" name="room_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Room Type:</label>
            <input type="text" name="room_type" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Price:</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Room Capacity:</label>
            <input type="number" name="room_capacity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Facilities:</label>
            <input type="text" name="facilities" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Has View:</label>
            <select name="has_view" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Room Image:</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Add Room</button>
    </form>
</div>
@endsection
