@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h2>All Event Bookings</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Guests</th>
                <th>Date</th>
                <th>Type</th>
                <th>Title</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->full_name }}</td>
                <td>{{ $booking->email }}</td>
                <td>{{ $booking->phone }}</td>
                <td>{{ $booking->guests }}</td>
                <td>{{ $booking->event_date }}</td>
                <td>{{ $booking->event_type }}</td>
                <td>{{ $booking->title }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>
                    @if($booking->status === 'pending')
                        <a href="{{ route('admin.event-bookings.approve', $booking->id) }}" class="btn btn-success btn-sm">Approve</a>
                        <a href="{{ route('admin.event-bookings.reject', $booking->id) }}" class="btn btn-danger btn-sm">Reject</a>
                    @else
                        {{ ucfirst($booking->status) }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
