@extends('user.layout.master') {{-- ya jo aapka user layout ho --}}

@section('content')
<div class="container py-4">
    <h2 class="mb-4">My Room Reservations</h2>

    @if($reservations->isEmpty())
        <p>No reservations found.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Guests</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->room->room_number ?? 'N/A' }}</td>
                            <td>{{ $reservation->guests }}</td>
                            <td>{{ $reservation->check_in }}</td>
                            <td>{{ $reservation->check_out }}</td>
                            <td>{{ ucfirst($reservation->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
