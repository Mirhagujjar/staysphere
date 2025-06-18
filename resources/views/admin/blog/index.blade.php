@extends('admin.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Blog Management</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Blog
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->author }}</td>
                        <td>{{ \Carbon\Carbon::parse($blog->published_date)->format('M d, Y') }}</td>
                        <td>
                            <form action="{{ route('admin.blogs.toggle-status', $blog) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-{{ $blog->status ? 'success' : 'secondary' }}">
                                    {{ $blog->status ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $blogs->links() }}
        </div>
    </div>
</div>
@endsection