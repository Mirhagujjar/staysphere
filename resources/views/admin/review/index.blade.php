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

{{-- @extends('admin.dashboard')

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

    <!-- Header Section -->
    <div class="mt-5">
        <h3>Header Section</h3>
        <a href="{{ route('admin.review.header.create') }}" class="btn btn-primary">Add New Header</a>
        @foreach($headers as $headerItem)
        <div class="card mb-3">
            <img src="{{ asset('images/'.$headerItem->image) }}" class="card-img-top" alt="{{ $headerItem->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $headerItem->title }}</h5>
                <p class="card-text">{{ $headerItem->description }}</p>
                <a href="{{ route('admin.review.header.edit', $headerItem->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Carousel Section -->
    <div class="mt-5">
        <h3>Carousel Section</h3>
        <a href="{{ route('admin.review.carousel.create') }}" class="btn btn-primary">Add New Carousel Item</a>
        @foreach($carouselItems as $carouselItem)
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/'.$carouselItem->image) }}" class="d-block w-100" alt="{{ $carouselItem->title }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $carouselItem->title }}</h5>
                        <p>{{ $carouselItem->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
 --}}



