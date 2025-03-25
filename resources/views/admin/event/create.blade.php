{{-- @extends('layouts.admin')

@section('content')
<h1>Create Event</h1>
<form action="{{ route('admin.events.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="date" name="event_date" required>
    <input type="text" name="location" placeholder="Location" required>
    <button type="submit">Save</button>
</form>
@endsection --}}

@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Add New Event</h1>
    <form action="#" method="POST">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" required>

        <label>Date:</label>
        <input type="date" name="event_date" required>

        <label>Location:</label>
        <input type="text" name="location" required>

        <button type="submit">Create Event</button>
    </form>
</div>
@endsection
