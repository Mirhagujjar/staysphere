@extends('admin.dashboard')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manage Sliders</h1>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Slider
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($sliders->isEmpty())
        <div class="alert alert-info">
            No sliders found. <a href="{{ route('admin.sliders.create') }}">Create your first slider</a>.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th width="80px">Preview</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th width="100px">Order</th>
                        <th width="120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                    <tr>
                        <td><img src="{{ asset($slider->image) }}" width="70" class="img-thumbnail"></td>
                        <td>{{ $slider->title }}</td>
                        <td>{{ $slider->subtitle }}</td>
                        <td>{{ $slider->order }}</td>
                        <td>
    <div class="d-flex gap-2"> <!-- Flexbox for proper spacing -->
        <!-- Edit Button -->
        <a href="{{ route('admin.sliders.edit', $slider->id) }}"
           class="btn btn-primary btn-sm"
           title="Edit">
            <i class="fas fa-edit"></i>
        </a>

        <!-- Delete Button -->
        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Delete this slider?')"
                    title="Delete">
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
    @endif
</div>
@endsection
