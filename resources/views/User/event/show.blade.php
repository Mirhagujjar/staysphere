@extends('layouts.app')

@section('content')
<h1>{{ $event->title }}</h1>
<p>{{ $event->description }}</p>
<p><strong>Date:</strong> {{ $event->event_date }}</p>
<p><strong>Location:</strong> {{ $event->location }}</p>
@endsection
