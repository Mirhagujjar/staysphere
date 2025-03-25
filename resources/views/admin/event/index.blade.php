@extends('layouts.admin')

@section('content')
<h1>Manage Events</h1>
<a href="{{ route('admin.events.create') }}">Create New Event</a>

@foreach ($events as $event)
    <div>
        <h2>{{ $event->title }}</h2>
        <a href="{{ route('admin.events.edit', $event->id) }}">Edit</a>
        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach
@endsection
