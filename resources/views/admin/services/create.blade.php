@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Add New Service</h2>
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        @include('admin.services.form')
        <button class="btn btn-success mt-3">Create</button>
    </form>
</div>
@endsection
