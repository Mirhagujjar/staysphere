@extends('admin.dashboard')

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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($review as $review)
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


{{-- @extends('admin.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">All Reviews</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($review as $review)
            <tr>
                <td>{{ $review->name }}</td>
                <td>{{ $review->email }}</td>
                <td>{{ $review->comment }}</td>
                <td>{{ $review->status }}</td>
                <td>
                    @if($review->status != 'approved')
                        <a href="{{ route('admin.review.approve', $review->id) }}">Approve</a>
                    @endif
                    @if($review->status != 'rejected')
                        <a href="{{ route('admin.review.reject', $review->id) }}">Reject</a>
                    @endif
                    <form action="{{ route('admin.review.delete', $review->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>


@endsection --}}
