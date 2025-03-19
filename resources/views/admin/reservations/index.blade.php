@extends('admin.dashboard')

@section('content')
<div class="container">
    <h2>All Reservations</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Room</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->room->room_name }}</td>
                    <td>{{ $reservation->checkin_date }}</td>
                    <td>{{ $reservation->checkout_date }}</td>
                    <td>
                        <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="btn btn-info">View</a>
                        <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
