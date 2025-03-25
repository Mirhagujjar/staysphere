@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Add New Event</h1>

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Description:</label>
        <textarea name="description" required></textarea>

        <label>Date:</label>
        <input type="date" name="event_date" required>

        <label>Location:</label>
        <input type="text" name="location" required>

        <label>Image:</label>
        <input type="file" name="image">

        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
@endsection
