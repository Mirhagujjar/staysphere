@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📋 Manage Event Page Content</h2>

    {{-- Hero Section --}}
    <h4>Hero Section</h4>
    @if($hero)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $hero->hero_title }}</td>
                    <td>{{ $hero->hero_description }}</td>
                    <td><img src="{{ asset('storage/' . $hero->hero_image) }}" width="100"></td>
                    <td>
                        {{-- Add edit route if needed --}}
                        <a href="{{ route('admin.hero.delete', $hero->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <p>No hero section added.</p>
    @endif

    {{-- Experience Cards --}}
    <h4 class="mt-5">Experience Cards</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($experiences as $index => $exp)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $exp->title }}</td>
                    <td>{{ $exp->description }}</td>
                    <td><img src="{{ asset('storage/experiences/' . $exp->image) }}" width="100"></td>
                    <td>
                        {{-- Add edit link here if needed --}}
                        <a href="{{ route('admin.experience.delete', $exp->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Events --}}
    <h4 class="mt-5">Events</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Location</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $index => $event)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->event_date }}</td>
                    <td>{{ $event->location }}</td>
                    <td><img src="{{ asset('storage/events/' . $event->image) }}" width="100"></td>
                    <td>
                        {{-- Add edit route if needed --}}
                        <a href="{{ route('admin.event.delete', $event->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
