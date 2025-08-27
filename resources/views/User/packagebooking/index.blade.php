@extends('user.layout.master') {{-- Replace with your actual layout --}}


@section('content')
<div class="container">
    <h2 class="mb-4">My Booked Packages</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Package Name</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Status</th>
                <th>Admin Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->package->name ?? 'N/A' }}</td>
                    <td>{{ $booking->check_in }}</td>
                    <td>{{ $booking->check_out }}</td>
                    <td>{{ $booking->status }}</td>
                   
                    <td>
                        @if($booking->status == 'confirmed')
                            <span class="badge bg-success">Confirmed</span>
                        @elseif($booking->status == 'cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
