@extends('admin.dashboard')

@section('content')
<div class="container">
    <h2>All Packages</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Package Price (PKR)</th>
                <th>Regular Price (PKR)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>
                        <img src="{{ asset('storage/packages/' . $package->image) }}" width="100">
                    </td>
                    <td>{{ $package->name }}</td>
                    <td>PKR {{ number_format($package->price, 2) }}</td>
                    <td>PKR {{ number_format($package->price, 2) }}</td>
                    <td>
                        <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.package.delete', $package->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
