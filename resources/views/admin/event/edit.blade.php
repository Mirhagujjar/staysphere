@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Edit Event</h1>

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Title:</label>
        <input type="text" name="title" value="{{ $event->title }}" required>

        <label>Description:</label>
        <textarea name="description" required>{{ $event->description }}</textarea>

        <label>Date:</label>
        <input type="date" name="event_date" value="{{ $event->event_date }}" required>

        <label>Location:</label>
        <input type="text" name="location" value="{{ $event->location }}" required>

        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
@endsection
