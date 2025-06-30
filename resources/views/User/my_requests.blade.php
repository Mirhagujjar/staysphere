@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">My Service Requests</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Service</th>
                <th>Status</th>
                <th>Requested At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr>
                    <td>{{ $request->service->title ?? 'N/A' }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>{{ $request->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
