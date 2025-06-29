@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="h3">Manage Options for: {{ $filter->name }}</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('admin.filters.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Filters
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="h5 mb-0">Add New Option</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.filters.options.store', $filter) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="label">Display Label</label>
                            <input type="text" name="label" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="value">Filter Value</label>
                            <input type="text" name="value" class="form-control" required>
                            <small class="text-muted">This value will be used in filtering</small>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add Option
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="h5 mb-0">Existing Options</h4>
                </div>
                <div class="card-body">
                    @if($options->isEmpty())
                        <p class="text-muted">No options added yet.</p>
                    @else
                        <ul class="list-group sortable-options">
                            @foreach($options as $option)
                            <li class="list-group-item d-flex justify-content-between align-items-center sortable-item" data-id="{{ $option->id }}">
                                <div>
                                    <strong>{{ $option->label }}</strong>
                                    <br>
                                    <small class="text-muted">Value: {{ $option->value }}</small>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary edit-option" 
                                            data-id="{{ $option->id }}"
                                            data-label="{{ $option->label }}"
                                            data-value="{{ $option->value }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.filters.options.delete', $option) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Option Modal -->
<div class="modal fade" id="editOptionModal" tabindex="-1" aria-labelledby="editOptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editOptionForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editOptionModalLabel">Edit Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_label">Display Label</label>
                        <input type="text" name="label" id="edit_label" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_value">Filter Value</label>
                        <input type="text" name="value" id="edit_value" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Bootstrap modal
    var editOptionModal = new bootstrap.Modal(document.getElementById('editOptionModal'));
    
    // Edit option button click handler
    $('.edit-option').on('click', function() {
        var id = $(this).data('id');
        var label = $(this).data('label');
        var value = $(this).data('value');
        
        $('#edit_label').val(label);
        $('#edit_value').val(value);
        
        // Update form action URL
        var url = "{{ route('admin.filters.options.update', ['option' => ':id']) }}";
        url = url.replace(':id', id);
        $('#editOptionForm').attr('action', url);
        
        // Show modal
        editOptionModal.show();
    });

    // Initialize sortable
    new Sortable(document.querySelector('.sortable-options'), {
        animation: 150,
        onEnd: function() {
            var order = [];
            $('.sortable-item').each(function(index, element) {
                order.push({
                    id: $(element).data('id'),
                    position: index + 1
                });
            });

            $.ajax({
                type: "POST",
                url: "{{ route('admin.filters.options.update-order') }}",
                data: {
                    order: order,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('Order updated successfully');
                    }
                },
                error: function(xhr) {
                    toastr.error('Error updating order');
                }
            });
        }
    });
});
</script>
@endpush