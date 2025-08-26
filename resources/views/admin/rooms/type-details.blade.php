@extends('layouts.admin')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h6 class="m-0 font-weight-bold">{{ $type }} - All Rooms</h6>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Capacity</th>
                    <th>Price</th>
                    <th>Booked</th>
                    <th>Available</th>
                    <th>Size</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->room_name  }}</td>
                        <td>{{ $room->room_capacity }}</td>
                        <td>{{ $room->price }}</td>
                        <td>{{ $room->booked_quantity }}</td>
                        <td>{{ $room->total_quantity - $room->booked_quantity }}</td>
                        <td>{{ $room->room_size }}</td>
                        <td>{{ $room->view_type }}
                            <a href="{{ route('admin.rooms.details', $room->room_type) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection