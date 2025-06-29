@extends('layouts.app')

@section('content')
<style>
    .hero-section {
        background: url('{{ asset('build/assets/images/service4.jpg') }}') no-repeat center center;
        background-size: cover;
        color: white;
        text-align: center;
        padding: 100px 20px;
    }
    .cardstyle {
        width: 90%;
        max-width: 500px;
        background: white;
        bottom: -70px;
    }
</style>

<div class="hero-section">
    <div class="overlay-text">
        <h1>Services</h1>
        <p>"Experience Luxury, Comfort, and Excellence <br> Our Services, Your Satisfaction!"</p>
        <div class="breadcrumb-container">
            <a href="{{ asset('home') }}">Home</a> > services
        </div>
    </div>
</div>

@foreach($services as $service)
<div class="container my-5 py-5">
    <div class="position-relative col-md-8 mx-auto">
        <div class="image">
            <img src="{{ asset('storage/' . $service->thumbnail) }}" class="img-fluid rounded" alt="Service Image">
        </div>

        <div class="position-absolute start-50 translate-middle-x p-4 shadow-lg rounded cardstyle">
            <small style="color: #b2956e; font-weight: bold;">FROM {{ $service->price }}</small>
            <h2 class="mt-2 text-dark">{{ $service->title }}</h2>
            <p class="text-muted">{{ $service->short_description }}</p>
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                @foreach(explode(',', $service->facilities) as $facility)
                    <li><i class="bi bi-check-circle"></i> {{ trim($facility) }}</li>
                @endforeach
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#modal{{ $service->id }}">
                    {{ $service->modal_button_text ?? 'Get Services Now' }}
                </button>
                <a href="{{ route('services.show', $service->slug) }}" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal{{ $service->id }}">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <h4 class="mb-3">Request for {{ $service->title }}</h4>
            <form>
                @csrf
                @foreach($service->modal_fields as $field)
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                        @if($field == 'service_type')
                            <select class="form-control" name="{{ $field }}">
                                <option value="Option 1">Option 1</option>
                                <option value="Option 2">Option 2</option>
                            </select>
                        @else
                            <input type="text" class="form-control" name="{{ $field }}" required>
                        @endif
                    </div>
                @endforeach
                <button type="submit" class="btn btn-warning w-100">Submit Request</button>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection