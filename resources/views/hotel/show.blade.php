@extends('layouts.master')

@section('content')
<div class="container mt-4">
    {{-- <h2>{{ $hotel->room_type }}</h2> --}}
    <h1>{{ $hotel->name }}</h1>  <!-- Example of accessing hotel properties -->

    <h2>{{ $hotel->room_type }}</h2>

    <p><strong>Guests:</strong> {{ $hotel->guests }}</p>
    <p><strong>Check-in:</strong> {{ $hotel->check_in }}</p>
    <p><strong>Check-out:</strong> {{ $hotel->check_out }}</p>
    <p><strong>Phone:</strong> {{ $hotel->phone }}</p>
    <a href="{{ route('hotel.index') }}" class="btn btn-secondary">Back to Home</a>
</div>
@endsection