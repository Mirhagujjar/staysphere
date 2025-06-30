@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="mb-3 mb-md-0">All Packages</h2>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Create New Package
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="d-none d-md-table-cell">Image</th>
                            <th>Name</th>
                            <th>Package Price</th>
                            <th class="d-none d-sm-table-cell">Regular Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                            <tr>
                                <td class="d-none d-md-table-cell">
                                    <img src="{{ asset('assets/images/packages/' . $package->image) }}" 
                                         alt="Package Image" 
                                         class="img-thumbnail" 
                                         style="width: 80px; height: auto;">
                                </td>
                                <td>{{ $package->name }}</td>
                                <td>PKR {{ number_format($package->price, 2) }}</td>
                                <td class="d-none d-sm-table-cell">PKR {{ number_format($package->price, 2) }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="{{ route('admin.packages.edit', $package->id) }}" 
                                           class="btn btn-sm btn-primary"
                                           title="Edit">Edit
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.package.delete', $package->id) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this package?')"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>delete
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