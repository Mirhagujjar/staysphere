@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Your Notifications</h4>
    @forelse($notifications as $notification)
        <div class="alert alert-secondary mb-3">
            <div class="d-flex justify-content-between">
                <div>
                <span>
                    {{ $notification->data['message'] ?? 'No message' }}
                    <br>
                    {{-- Reason: {{ $notification->data['reason'] ?? 'N/A' }} --}}
                </span>               
                     <br>
                    <small class="text-muted">{{ $notification->created_at->format('M d, Y (l)') }}</small>
                </div>
                <div>
                    @if(!empty($notification->data['reservation_id']))
    <a href="{{ route('user.reservations.show', $notification->data['reservation_id']) }}" class="btn btn-sm btn-primary">
        View
    </a>
@endif


                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger ms-2">×</button>
                    </form>
                </div>

            </div>
        </div>
    @empty
        <p>No notifications found.</p>
    @endforelse

    {{ $notifications->links() }}
</div>
@endsection
