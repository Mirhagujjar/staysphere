@extends('user.layout.master')

@section('content')
<div class="container">
    <h2>Book an Event</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('user.event-booking.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Number of Guests</label>
            <input type="number" name="guests" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Event Date</label>
            <input type="date" name="event_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Event Type</label>
            <select name="event_type" class="form-control" required>
                <option value="">-- Select Type --</option>
                <option value="Wedding">Wedding</option>
                <option value="Meeting">Meeting</option>
                <option value="Conference">Conference</option>
                <option value="Birthday">Birthday</option>
                <option value="Corporate">Corporate</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Event Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Book Event</button>
    </form>
</div>
@endsection
