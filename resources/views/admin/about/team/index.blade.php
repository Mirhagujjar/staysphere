@extends('admin.dashboard')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Team Members</h3>
        <div class="card-tools">
            <a href="{{ route('admin.about.team.create') }}" class="btn btn-primary">Add New Member</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teamMembers as $member)
                <tr>
                    <td>
                        @if($member->image)
                        <img src="{{ asset($member->image) }}" width="50" class="img-circle">
                        @endif
                    </td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->position }}</td>
                    <td>{{ $member->order }}</td>
                    <td>
                        <a href="{{ route('admin.team.edit', $member->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection