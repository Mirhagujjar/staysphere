@extends('layouts.app')

@section('content')
<style>
    .reservation-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s;
        height: 100%;
    }
    .reservation-card:hover {
        transform: translateY(-3px);
    }
    .card-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f0f0f0;
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        background-color: #f8f9fa;
        color: #495057;
    }
    .status-approved {
        background-color: #e6f7ee;
        color: #28a745;
    }
    .status-pending {
        background-color: #fff8e6;
        color: #ffc107;
    }
    .status-cancelled {
        background-color: #fdecea;
        color: #dc3545;
    }
    .detail-item {
        margin-bottom: 0.5rem;
        color: #6c757d;
    }
    .detail-label {
        color: #495057;
        font-weight: 500;
    }
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
        background-color: #f8f9fa;
        border-radius: 10px;
    }
    .action-btn {
        border-radius: 6px;
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
    }
</style>

<div class="container py-4">
    <h2 class="text-center mb-4" style="font-weight: 600; color: #2d3748;">My Reservations</h2>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($reservations->isEmpty())
        <div class="empty-state">
            <p style="font-size: 1.1rem;">You have no reservations yet.</p>
            <a href="{{ route('user.rooms.index') }}" class="btn btn-primary mt-3">
                Browse Available Rooms
            </a>
        </div>
    @else
        <div class="row g-4">
            @foreach($reservations as $reservation)
                <div class="col-md-6 col-lg-4">
                    <div class="reservation-card card">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                {{ $reservation->room->name ?? 'Reservation #'.str_pad($reservation->id, 3, '0', STR_PAD_LEFT) }}
                                <span class="status-badge status-{{ $reservation->status }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </h5>

                            <div class="mb-3">
                                <div class="detail-item">
                                    <span class="detail-label">Check-in:</span>
                                    {{ \Carbon\Carbon::parse($reservation->check_in)->format('M j, Y') }}
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Check-out:</span>
                                    {{ \Carbon\Carbon::parse($reservation->check_out)->format('M j, Y') }}
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Guests:</span>
                                    {{ $reservation->guests }}
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Room_name:</span>
                                    {{ $reservation->room->room_name }}
                                </div>
                            </div>

                            <div class="d-flex justify-content-between pt-2">
                                <a href="{{ route('user.reservations.show', $reservation->id) }}" class="action-btn btn btn-sm btn-outline-secondary">
                                    Details
                                </a>
                                @if(!\Carbon\Carbon::parse($reservation->check_out)->isPast())
                                    <a href="{{ route('user.reservations.edit', $reservation->id) }}" class="action-btn btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                                @endif
                                <form action="{{ route('user.reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="action-btn btn btn-sm btn-outline-danger" onclick="return confirm('Cancel this reservation?')">
                                        Cancel
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection