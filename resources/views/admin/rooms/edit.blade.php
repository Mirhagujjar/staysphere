@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <h2 class="mb-4">Edit Room</h2>
            <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Room Name:</label>
                        <input type="text" name="room_name" class="form-control" value="{{ $room->room_name }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Room Type:</label>
                        <input type="text" name="room_type" class="form-control" value="{{ $room->room_type }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Price:</label>
                        <input type="number" name="price" class="form-control" value="{{ $room->price }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Room Capacity:</label>
                        <input type="number" name="room_capacity" class="form-control" value="{{ $room->room_capacity }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Facilities:</label>
                        <input type="text" name="facilities" class="form-control" value="{{ $room->facilities }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Has View:</label>
                        <select name="has_view" class="form-select">
                            <option value="1" {{ $room->has_view ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$room->has_view ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Upload New Image (Optional):</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Current Room Image:</label><br>
                        <img src="{{ asset($room->image) }}" alt="{{ $room->room_name }}" class="img-thumbnail" style="max-width: 300px; height: auto;">
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Update Room</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection