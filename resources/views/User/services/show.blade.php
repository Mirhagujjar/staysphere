@extends('layouts.app')

@section('content')
<style>
    .hero-section {
        background: url('{{ asset('storage/' . $service->detail_image) }}') no-repeat center center;
        background-size: cover;
        color: white;
        text-align: center;
        padding: 100px 20px;
    }
</style>
<style>
    .service-description {
        line-height: 1.8;
        color: #555;
    }
    
    .service-description p {
        margin-bottom: 1.2rem;
    }
    
    .service-description ul, 
    .service-description ol {
        padding-left: 1.5rem;
        margin-bottom: 1.2rem;
    }
    
    .service-description li {
        margin-bottom: 0.5rem;
    }
</style>

<div class="hero-section">
    <h1 class="display-4">{{ $service->title }}</h1>
    <p class="lead">{{ $service->short_description }}</p>
    <div class="breadcrumb-container">
        <a href="{{ route('user.services.index') }}">Services</a> > {{ $service->title }}
    </div>
    <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#modal{{ $service->id }}">
        {{ $service->modal_button_text ?? 'Get Service Now' }}
    </button>
</div>

<div class="container-fluid mt-4 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-12 p-2">
            <div class="card shadow-lg p-2">
                <img src="{{ asset('storage/' . $service->detail_image) }}" class="card-img-top" alt="Service Image">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">{{ $service->title }}</h2>
                    <div class="service-description">
                        {!! $service->long_description !!}
                    </div>
                    
                    @if(!empty($service->facilities))
                    <h4 class="mt-5 mb-3">Our Facilities</h4>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($service->formatted_facilities as $facility)
                            <span class="badge bg-light text-dark border py-2 px-3">
                                <i class="bi bi-check-circle me-1 text-success"></i> 
                                {{ $facility }}
                            </span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card shadow-lg p-3">
                <h4 class="text-center">Other Services</h4>
                <ul class="list-group list-group-flush">
                    @foreach($otherServices as $s)
                        <li class="list-group-item">
                            <a href="{{ route('services.show', $s->slug) }}" class="text-warning text-decoration-none fw-bold">
                                {{ $s->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
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
                        <input type="{{ $field == 'email' ? 'email' : 'text' }}" 
                            class="form-control" 
                            name="{{ $field }}" 
                            placeholder="Enter {{ ucwords(str_replace('_', ' ', $field)) }}" 
                            required>
                        @endif
                    </div>
                @endforeach
                <button type="submit" class="btn btn-warning w-100">Submit Request</button>
            </form>
        </div>
    </div>
</div>
@endsection
