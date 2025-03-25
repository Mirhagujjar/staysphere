@extends('layouts.admin')

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
@endsection
