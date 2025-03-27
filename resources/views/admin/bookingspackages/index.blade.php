@extends('admin.dashboard')

@section('content')
    <h2>All Bookings</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Package</th>
                <th>Images</th>
                <th>Price</th>
                {{-- <th>Status</th> --}}
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->full_name }}</td>
                    <td>{{ $booking->package->name ?? 'N/A' }}</td>
                    <td>{{ $booking->status }}</td>
                    <td><img src="{{ asset('storage/room_images'. $booking->package->image) }}" width="100"></td>
                    {{-- <td><img src="{{ asset('uploads/packages/' . $booking->package->image) }}" width="100"></td> --}}
                    {{-- <img src="{{ asset('storage/' . $booking->image) }}" width="100" class="mt-2"> --}}

                    <td>{{ $booking->package->name }}</td>
                    <td>{{ $booking->package->price }}</td>
                    <td>{{ $booking->check_in }} - {{ $booking->check_out }}</td>
                    <td>
                        <a href="#" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.bookingspackages.destroy', $booking->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
