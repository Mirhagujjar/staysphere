@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ isset($teamMember) ? 'Edit' : 'Add' }} Team Member</h3>
    </div>
    <form action="{{ isset($teamMember) ? route('admin.team.update', $teamMember->id) : route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($teamMember)) @method('PUT') @endif
        <div class="card-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $teamMember->name ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Position</label>
                <input type="text" name="position" class="form-control" value="{{ old('position', $teamMember->position ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea id="summernote" name="description" class="form-control" rows="3" required>{{ old('description', $teamMember->description ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control-file">
                @if(isset($teamMember) && $teamMember->image)
                <img src="{{ asset($teamMember->image) }}" width="100" class="mt-2">
                @endif
            </div>
            <div class="form-group">
                <label>Facebook URL</label>
                <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $teamMember->facebook ?? '') }}">
            </div>
            <div class="form-group">
                <label>Twitter URL</label>
                <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $teamMember->twitter ?? '') }}">
            </div>
            <div class="form-group">
                <label>LinkedIn URL</label>
                <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $teamMember->linkedin ?? '') }}">
            </div>
            <div class="form-group">
                <label>Order</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $teamMember->order ?? 0) }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.team.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>
@include("components.summernote")
@endsection