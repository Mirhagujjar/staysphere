@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h2>Edit Event</h2>

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
        </div>

        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control" required>{{ $event->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Event Date:</label>
            <input type="date" name="event_date" class="form-control" value="{{ $event->event_date }}" required>
        </div>

        <div class="mb-3">
            <label>Location:</label>
            <input type="text" name="location" class="form-control" value="{{ $event->location }}" required>
        </div>

        <div class="mb-3">
            <label>Current Image:</label><br>
            <img src="{{ asset('build/assets/images/events/' . $event->image) }}" width="100">
        </div>

        <div class="mb-3">
            <label>New Image (optional):</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
