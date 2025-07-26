@extends('layouts.admin')

@section('content')
<h2>Manage Event Page Content</h2>

{{-- Hero Section Form --}}
<form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h4>Add Hero Section</h4>
    <input type="text" name="hero_title" placeholder="Title">
    <textarea name="hero_description" placeholder="Description"></textarea>
    <input type="file" name="hero_image">
    <button type="submit">Add Hero</button>
</form>

{{-- Show existing Hero --}}
@if($hero)
    <div>
        <h5>{{ $hero->hero_title }}</h5>
        <p>{{ $hero->hero_description }}</p>
        <img src="{{ asset('storage/' . $hero->hero_image) }}" width="100">
        <a href="{{ route('admin.hero.delete', $hero->id) }}">Delete</a>
    </div>
@endif

<hr>

{{-- Experience Card Form --}}
<form action="{{ route('admin.experience.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h4>Add Experience Card</h4>
    <input type="text" name="title" placeholder="Title">
    <textarea name="description" placeholder="Description"></textarea>
    <input type="file" name="image">
    <button type="submit">Add Card</button>
</form>

{{-- List of Cards --}}
@foreach($experiences as $card)
    <div>
        <h5>{{ $card->title }}</h5>
        <p>{{ $card->description }}</p>
        <img src="{{ asset('storage/experiences/' . $card->image) }}" width="100">
        <a href="{{ route('admin.experience.delete', $card->id) }}">Delete</a>
    </div>
@endforeach

<hr>

{{-- Event Form --}}
<form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h4>Add Event</h4>
    <input type="text" name="title" placeholder="Title">
    <textarea name="description" placeholder="Description"></textarea>
    <input type="date" name="event_date">
    <input type="text" name="location" placeholder="Location (Optional)">
    <input type="file" name="image">
    <button type="submit">Add Event</button>
</form>

{{-- List of Events --}}
@foreach($events as $event)
    <div>
        <h5>{{ $event->title }} ({{ $event->event_date }})</h5>
        <p>{{ $event->description }}</p>
        <img src="{{ asset('storage/events/' . $event->image) }}" width="100">
        <a href="{{ route('admin.event.delete', $event->id) }}">Delete</a>
    </div>
@endforeach

@endsection
