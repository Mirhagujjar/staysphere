@extends('admin.dashboard')
@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <h2>All Rooms</h2>
        </div>
        <div class="col-12 col-md-6 text-md-end">
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">+ Add New Room</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Room Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Capacity</th>
                    <th class="d-none d-lg-table-cell">Facilities</th>
                    <th class="d-none d-md-table-cell">View</th>
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
                    <td class="d-none d-lg-table-cell">{{ $room->facilities }}</td>
                    <td class="d-none d-md-table-cell">{{ $room->has_view ? 'Yes' : 'No' }}</td>
                    <td>
                        <img src="{{ asset($room->image) }}" alt="{{ $room->room_name }}" class="img-thumbnail" style="max-width: 80px; height: auto;">
                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-1">
                            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-sm btn-primary">Edit</a>      
                            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection