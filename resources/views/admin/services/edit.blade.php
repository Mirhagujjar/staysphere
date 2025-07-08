@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Service</h2>
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.services.form')
        <button class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
