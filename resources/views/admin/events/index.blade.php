@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📋 Manage Event Page Content</h2>

    {{-- Hero Section --}}
    <h4>Hero Section</h4>
    @if($hero)
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $hero->hero_title }}</td>
                    <td>{{ $hero->hero_description }}</td>
                    <td><img src="{{ asset('storage/' . $hero->hero_image) }}" class="img-thumbnail" width="120"></td>
                    <td class="text-center">
                        {{-- <a href="{{ route('admin.hero.edit', $hero->id) }}" class="btn btn-sm btn-warning me-1">
                            ✏️ Edit
                        </a> --}}
                        <form action="{{ route('admin.hero.delete', $hero->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this hero section?')">
                                🗑 Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <p class="text-muted">No hero section added yet.</p>
        <a href="{{ route('admin.hero.create') }}" class="btn btn-primary btn-sm">➕ Add Hero Section</a>
    @endif

    {{-- Experience Cards --}}
    <h4 class="mt-5">Experience Cards</h4>
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($experiences as $index => $exp)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $exp->title }}</td>
                    <td>{{ $exp->description }}</td>
                    <td><img src="{{ asset('storage/experiences/' . $exp->image) }}" class="img-thumbnail" width="100"></td>
                    <td class="text-center">
                        {{-- <a href="{{ route('admin.experience.edit', $exp->id) }}" class="btn btn-sm btn-warning me-1">
                            ✏️ Edit
                        </a> --}}
                        <form action="{{ route('admin.experience.delete', $exp->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this card?')">
                                🗑 Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No experience cards yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{-- <a href="{{ route('admin.experience.create') }}" class="btn btn-primary btn-sm">➕ Add Experience Card</a> --}}

    {{-- Events --}}
    <h4 class="mt-5">Events</h4>
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Location</th>
                <th>Image</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $index => $event)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->event_date }}</td>
                    <td>{{ $event->location }}</td>
                    <td><img src="{{ asset('storage/events/' . $event->image) }}" class="img-thumbnail" width="100"></td>
                    <td class="text-center">
                        {{-- <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-info text-white me-1">
                            👁 View
                        </a> --}}
                        {{-- <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-warning me-1">
                            ✏️ Edit
                        </a> --}}
                        <form action="{{ route('admin.event.delete', $event->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?')">
                                🗑 Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted">No events added yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('admin.event.page') }}" class="btn btn-primary btn-sm">➕ Add Event</a>
</div>
@endsection
