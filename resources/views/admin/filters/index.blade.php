<!-- resources/views/admin/filters/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="h3">Filters Management</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.filters.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Filter
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover sortable-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Slug</th>
                            <th>Options</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="sortable-container">
                        @foreach($filters as $filter)
                        <tr class="sortable-row" data-id="{{ $filter->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $filter->name }}</td>
                            <td>{{ ucfirst($filter->type) }}</td>
                            <td>{{ $filter->slug }}</td>
                            <td>{{ $filter->options->count() }}</td>
                            <td>
                                <a href="{{ route('admin.filters.options', $filter) }}" 
                                   class="btn btn-sm btn-info" title="Manage Options">
                                    <i class="fas fa-cog"></i>
                                </a>
                                <a href="{{ route('admin.filters.edit', $filter) }}" 
                                   class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.filters.destroy', $filter) }}" 
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Are you sure?')" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
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

@push('scripts')
<script>
$(function() {
    $('.sortable-table').sortable({
        containerSelector: '.sortable-container',
        itemSelector: '.sortable-row',
        handle: 'td',
        tolerance: 'pointer',
        placeholder: '<tr class="placeholder"><td colspan="6"></td></tr>',
        update: function(event, ui) {
            var order = [];
            $('.sortable-row').each(function(index, element) {
                order.push({
                    id: $(element).data('id'),
                    position: index + 1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.filters.update-order') }}",
                data: {
                    order: order,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        }
    });
});
</script>
@endpush