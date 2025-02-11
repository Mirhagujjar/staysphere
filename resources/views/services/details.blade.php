{{-- @extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="card">
        <img src="{{ asset('images/' . $service->image) }}" class="card-img-top" alt="{{ $service->name }}">
        <div class="card-body">
            <h2 class="card-title">{{ $service->name }}</h2>
            <ul>
                @foreach ($service->details as $detail)
                <li>{{ $detail }}</li>
                @endforeach
            </ul>
            <a href="{{ route('services') }}" class="btn btn-secondary">Back to Services</a>
        </div>
    </div>
</div>
@endsection --}}
