@extends('admin.dashboard')
@section('content')
<div class="container">
    <h2>All Rooms</h2>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">+ Add New Room</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Room Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Capacity</th>
                <th>Facilities</th>
                <th>View</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>{{ $room->room_name }}</td>
                <td>{{ $room->room_type }}</td>
                <td>Rs. {{ number_format($room->price) }}</td>
                <td>{{ $room->room_capacity }} Persons</td>
                <td>{{ $room->facilities }}</td>
                <td>{{ $room->has_view ? 'Yes' : 'No' }}</td>
                <td>
                    <img src="{{ url('storage/room_images' . $room->image) }}" width="80">
                </td>
                <td>
                    <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-primary">Edit</a>      

                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
