@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <h1>{{ $about->title }}</h1>
    <p>{{ $about->description }}</p> --}}
    <h1>{{ $about->title ?? 'No Title Available' }}</h1>
<p>{{ $about->description ?? 'No Description Available' }}</p>

    @if ($about->image)
        <img src="{{ asset('storage/' . $about->image) }}" alt="About Us" width="300">
    @endif
</div>
@endsection
