@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Reservations Management</h1>
        <form method="GET" action="{{ route('admin.reservations.index') }}" class="d-flex mb-0">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm me-2" placeholder="Search reservations..." style="width: 200px;">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="bi bi-search me-1"></i> Search
            </button>
        </form>
    </div>

    <div class="row g-4">
        @forelse($reservations as $reservation)
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <!-- Room Image + Status -->
                <div class="position-relative">
                    @if ($reservation->room && $reservation->room->image)
                        <img src="{{ asset($reservation->room->image) }}"
                             class="card-img-top object-fit-cover"
                             alt="Room Image"
                             style="height: 180px; width: 100%;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height: 180px; width: 100%;">
                            <span class="text-muted">No image available</span>
                        </div>
                    @endif
                    <span class="position-absolute top-0 end-0 m-2 badge rounded-pill
                        bg-{{ $reservation->status == 'pending' ? 'warning text-dark' : (
                            $reservation->status == 'confirmed' ? 'success' : (
                                $reservation->status == 'checked_out' ? 'primary' : 'danger')) }}">
                        {{ ucfirst($reservation->status) }}
                    </span>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-title mb-0">{{ $reservation->name }}</h5>
                        <small class="text-muted">#{{ $reservation->id }}</small>
                    </div>

                    <!-- Room Info -->
                    <div class="mb-3">
                        <h6 class="text-primary mb-2">
                            <i class="bi bi-building me-1"></i>
                            {{ $reservation->room->name ?? 'Room not specified' }}
                            <small class="text-muted d-block">
                                {{ $reservation->roomType->name ?? $reservation->room_type }}
                            </small>
                        </h6>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="small text-muted mb-1">Check-in</p>
                                <p class="mb-2">
                                    <i class="bi bi-calendar-event me-1 text-primary"></i>
                                    {{ \Carbon\Carbon::parse($reservation->check_in)->format('M d, Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="small text-muted mb-1">Check-out</p>
                                <p class="mb-2">
                                    <i class="bi bi-calendar-event me-1 text-primary"></i>
                                    {{ \Carbon\Carbon::parse($reservation->check_out)->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                        <p class="mb-0">
                            <i class="bi bi-people me-1 text-primary"></i>
                            {{ $reservation->guests }} guest{{ $reservation->guests > 1 ? 's' : '' }}
                        </p>
                    </div>

                    <!-- Guest Contact -->
                    <div class="mb-3 p-3 bg-light rounded">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope text-muted me-2"></i>
                            <a href="mailto:{{ $reservation->email }}" class="text-decoration-none">
                                {{ $reservation->email }}
                            </a>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-telephone text-muted me-2"></i>
                            <a href="tel:{{ $reservation->phone }}" class="text-decoration-none">
                                {{ $reservation->phone }}
                            </a>
                        </div>
                    </div>

                    <!-- Status Management -->
                    <form action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PATCH')
                        <div class="input-group input-group-sm">
                            <select name="status" class="form-select form-select-sm">
                                <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Accepted</option>
                                <option value="checked_out" {{ $reservation->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="bi bi-arrow-repeat me-1"></i> Update
                            </button>
                        </div>
                    </form>

                    <!-- Actions -->
                    <div class="d-flex justify-content-between border-top pt-3">
                        {{-- <a href="{{ route('admin.reservations.edit', $reservation->id) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a> --}}
                        <div class="d-flex">
                            <a href="{{ route('admin.reservations.show', $reservation->id) }}"
                               class="btn btn-sm btn-outline-secondary me-2">
                                <i class="bi bi-eye me-1"></i> View
                            </a>
                            <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this reservation?')">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="bi bi-calendar-x fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No reservations found</h5>
                    <p class="text-muted">When new reservations are made, they will appear here.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    @if(method_exists($reservations, 'links'))
    <div class="d-flex justify-content-center mt-4">
        {{ $reservations->links() }}
    </div>
    @endif
</div>
@endsection
