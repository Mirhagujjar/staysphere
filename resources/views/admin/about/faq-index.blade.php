@extends('admin.dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">FAQs Management</h3>
        <div class="card-tools">
            <a href="{{ route('admin.about.faq.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New FAQ
            </a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th style="width: 50px">#</th>
                    <th>Question</th>
                    <th style="width: 120px">Order</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $index => $faq)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($faq->question, 70) }}</td>
                    <td>{{ $faq->order }}</td>
                    <td>
                        <a href="{{ route('admin.about.faq.edit', $faq->id) }}" 
                           class="btn btn-sm btn-info" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.about.faq.destroy', $faq->id) }}" 
                              method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    title="Delete" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No FAQs found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('css')
<style>
    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }
    .table thead th {
        background-color: #f8f9fa;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        margin: 0 2px;
    }
</style>
@endsection