@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="mb-3 mb-md-0">All Bookings</h2>
        </div>
        {{-- <div class="col-md-6 text-md-end">
            <a href="" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Create New Booking
            </a>
        </div> --}}
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th class="d-none d-md-table-cell">Package</th>
                            {{-- <th>Image</th> --}}
                            <th>Price</th>
                            <th class="d-none d-lg-table-cell">Dates</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->full_name }}</td>
                            <td class="d-none d-md-table-cell">{{ $booking->package->name ?? 'N/A' }}</td>
                            {{-- <td>
                                <img src="{{ asset($booking->image ?? 'uploads/packages/' . ($booking->package->image ?? '')) }}" 
                                     alt="{{ $booking->package->name ?? 'Booking image' }}" 
                                     class="img-thumbnail" 
                                     style="width: 60px; height: auto;">
                            </td> --}}
                            <td>Rs. {{ number_format($booking->package->price ?? 0, 2) }}</td>
                            <td class="d-none d-lg-table-cell">
                                {{ date('M d, Y', strtotime($booking->check_in)) }} - 
                                {{ date('M d, Y', strtotime($booking->check_out)) }}
                            </td>
                            <td>
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <select name="status" class="form-control">
                                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    {{-- <a href="{{ route('admin.bookingspackages.edit', $booking->id) }}"" class="btn btn-sm btn-primary" title="Edit">Edit
                                        <i class="fas fa-edit"></i>
                                    </a> --}}
                                    <form action="{{ route('admin.bookingspackages.destroy', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this booking?')"
                                                title="Delete">Delete
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection