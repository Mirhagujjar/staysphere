@extends('layouts.app')

@section('content')
<h1>Rooms</h1>

<!-- Filter Form -->
<form method="GET" action="{{ route('rooms') }}">
    <select name="room_type">
        <option value="">Select Room Type</option>
        <option value="Deluxe">Deluxe</option>
        <option value="Standard">Standard</option>
    </select>

    <input type="number" name="min_price" placeholder="Min Price">
    <input type="number" name="max_price" placeholder="Max Price">

    <input type="text" name="facilities" placeholder="Enter facilities (WiFi,TV)">

    <select name="sort">
        <option value="asc">Price: Low to High</option>
        <option value="desc">Price: High to Low</option>
    </select>

    <button type="submit">Apply Filters</button>
</form>

<!-- Show Rooms -->
@foreach ($rooms as $room)
    <div>
        <img src="{{ asset('storage/' . $room->image) }}" width="100">
        <h2>{{ $room->room_type }}</h2>
        <p>Price: ${{ $room->price }}</p>
        <p>Facilities: {{ implode(', ', json_decode($room->facilities)) }}</p>
        <a href="{{ route('room.show', $room->id) }}">View Details</a>
    </div>
@endforeach
@endsection
