@extends('user.layout.master') {{-- ya aapka layout file --}}

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">My Event Bookings</h3>

    @if($bookings->count())
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Event Type</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Guests</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->event_type }}</td>
                        <td>{{ $booking->title }}</td>
                        <td>{{ $booking->event_date }}</td>
                        <td>{{ $booking->guests }}</td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($booking->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">You have not booked any events yet.</div>
    @endif
</div>
@endsection
