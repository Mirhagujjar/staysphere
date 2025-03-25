{{-- @extends('layouts.admin')

@section('content')
<h1>Manage Events</h1>
<a href="{{ route('admin.event.create') }}">Create New Event</a>

@foreach ($events as $event)
    <div>
        <h2>{{ $event->title }}</h2>
        <a href="{{ route('admin.event.edit', $event->id) }}">Edit</a>
        <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach
@endsection --}}
@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>All Events</h1>
    <a href="{{ route('admin.createEvent') }}" class="btn btn-primary">+ Add New Event</a>

    <table class="table">
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Location</th>
        </tr>
        @foreach ($events as $event)
        <tr>
            <td>{{ $event->title }}</td>
            <td>{{ $event->event_date }}</td>
            <td>{{ $event->location }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
