@extends('admin.dashboard')


@section('content')
<div class="container">
    <h1>About Us Management</h1>

    <a href="{{ route('admin.about.create') }}" class="btn btn-primary mb-3">Add New</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aboutData as $about)
            <tr>
                <td>{{ $about->title }}</td>
                <td>{{ Str::limit($about->description, 100) }}</td>
                <td>
                    <a href="{{ route('admin.about.edit', $about->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.about.destroy', $about->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this record?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

