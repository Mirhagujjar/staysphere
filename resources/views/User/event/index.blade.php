@extends('layouts.app')

@section('content')
<h1>Upcoming Events</h1>
@foreach ($events as $event)
    <div>
        <h2>{{ $event->title }}</h2>
        <p>{{ $event->description }}</p>
        <p><strong>Date:</strong> {{ $event->event_date }}</p>
        <p><strong>Location:</strong> {{ $event->location }}</p>
        <a href="{{ route('events.show', $event->id) }}">View Details</a>
    </div>
@endforeach
@endsection
