@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>View Message</h2>

    <p><strong>Email:</strong> {{ $message->email }}</p>
    <p><strong>Phone:</strong> {{ $message->phone }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $message->message }}</p>

    <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
