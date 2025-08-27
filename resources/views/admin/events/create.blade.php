@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4">Manage Event Page Content</h2>

    {{-- Hero Section --}}
    <div class="card mb-4">
        <div class="card-header">
            <h4>Hero Section</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="hero_title" class="form-control" placeholder="Enter hero title">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="hero_description" class="form-control" rows="3" placeholder="Enter hero description"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hero Image</label>
                    <input type="file" name="hero_image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save Hero Section</button>
            </form>

            @if($hero)
                <div class="mt-4 p-3 border rounded bg-light">
                    <h5>{{ $hero->hero_title }}</h5>
                    <p>{{ $hero->hero_description }}</p>
                    <img src="{{ asset('storage/' . $hero->hero_image) }}" class="img-thumbnail" width="150">
                    <div class="mt-2">
                        <a href="{{ route('admin.hero.delete', $hero->id) }}" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Experience Section --}}
    <div class="card mb-4">
        <div class="card-header">
            <h4>Experience Cards</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.experience.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter card title">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter card description"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Card Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Add Experience</button>
            </form>

            <div class="row mt-4">
                @foreach($experiences as $card)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/experiences/' . $card->image) }}" class="card-img-top" height="150">
                            <div class="card-body">
                                <h5 class="card-title">{{ $card->title }}</h5>
                                <p class="card-text">{{ $card->description }}</p>
                                <a href="{{ route('admin.experience.delete', $card->id) }}" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Events Section --}}
    <div class="card">
        <div class="card-header">
            <h4>Events</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Event Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter event title">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter event description"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Event Date</label>
                        <input type="date" name="event_date" class="form-control">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Location (Optional)</label>
                        <input type="text" name="location" class="form-control" placeholder="Enter location">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Event Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Add Event</button>
            </form>

            <div class="row mt-4">
                @foreach($events as $event)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/events/' . $event->image) }}" class="card-img-top" height="150">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text"><strong>Date:</strong> {{ $event->event_date }}</p>
                                <p class="card-text">{{ $event->description }}</p>
                                @if($event->location)
                                    <p class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
                                @endif
                                <a href="{{ route('admin.event.delete', $event->id) }}" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
