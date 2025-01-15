@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Upcoming Events</h2>

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('images/' . $event['image']) }}" class="card-img-top" alt="{{ $event['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event['title'] }}</h5>
                        <p class="text-muted">{{ $event['date'] }}</p>
                        <p class="card-text">{{ $event['description'] }}</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
