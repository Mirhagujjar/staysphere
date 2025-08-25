@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">All Reviews</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Booking ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->name }}</td>
                <td>{{ $review->email }}</td>
                <td>{{ $review->comment }}</td>
                <td>
                    @if($review->is_approved)
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-secondary">Not Approved</span>
                    @endif
                </td>
                <td>{{ $review->reservation_id }}</td>

                <td>
                    @if(!$review->is_approved)
                        <a href="{{ route('admin.review.approve', $review->id) }}" class="btn btn-sm btn-success">Approve</a>
                    @else
                        <a href="{{ route('admin.review.reject', $review->id) }}" class="btn btn-sm btn-warning">Reject</a>
                    @endif

                    <form action="{{ route('admin.review.delete', $review->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection



