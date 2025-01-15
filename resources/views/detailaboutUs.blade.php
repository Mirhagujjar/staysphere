@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">{{ $about->title }}</h2>
    <p class="text-center text-muted">{{ $about->created_at->format('M d, Y') }}</p>
    
    <div class="card">
        <img src="{{ asset('storage/'.$about->image) }}" class="card-img-top" alt="Hotel Image">
        <div class="card-body">
            <p>{{ $about->full_description }}</p>
        </div>
    </div>

    {{-- <a href="{{ route('hotel.about') }}" class="btn btn-secondary mt-3">Back to About Us</a> --}}
    <a href="{{ route('aboutUs') }}" class="btn btn-secondary">Back to About Us</a>
    <a href="{{ route('detailaboutUs', $about->id) }}" class="btn btn-primary">Read More</a>


</div>
@endsection

