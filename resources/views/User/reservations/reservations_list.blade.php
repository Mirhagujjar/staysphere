@extends('user.layouts.app')

@section('content')
<div class="container">
    <h2>My Reservations</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($reservations->isEmpty())
        <p>No reservations found.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->room->title ?? 'N/A' }}</td>
                            <td>{{ $reservation->check_in }}</td>
                            <td>{{ $reservation->check_out }}</td>
                            <td>{{ $reservation->guests }}</td>
                            <td>{{ ucfirst($reservation->status) }}</td>
                            <td>
                                <a href="{{ route('user.reservations.show', $reservation->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('user.reservations.edit', $reservation->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('user.reservations.destroy', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
