@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Event</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        class="form-control @error('title') is-invalid @enderror" 
                        value="{{ old('title', $event->title) }}" 
                        required
                    >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea 
                        name="description" 
                        class="form-control @error('description') is-invalid @enderror" 
                        rows="4" 
                        required>{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Event Date --}}
                <div class="mb-3">
                    <label class="form-label">Event Date</label>
                    <input 
                        type="date" 
                        name="event_date" 
                        class="form-control @error('event_date') is-invalid @enderror" 
                        value="{{ old('event_date', $event->event_date) }}" 
                        required
                    >
                    @error('event_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Location --}}
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input 
                        type="text" 
                        name="location" 
                        class="form-control @error('location') is-invalid @enderror" 
                        value="{{ old('location', $event->location) }}" 
                        required
                    >
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Current Image --}}
                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    @if($event->image)
                        <img src="{{ asset('storage/events/' . $event->image) }}" class="img-thumbnail" width="150">
                    @else
                        <p class="text-muted">No image uploaded</p>
                    @endif
                </div>

                {{-- New Image --}}
                <div class="mb-3">
                    <label class="form-label">Upload New Image (optional)</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-success">Update Event</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
