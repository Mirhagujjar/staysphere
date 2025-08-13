@extends('user.layout.master')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Your Service Requests</h2>

    @if($requests->isEmpty())
        <div class="alert alert-info">You haven't requested any services yet.</div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Room #</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Requested At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $index => $request)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $request->service->title ?? 'N/A' }}</td>
                    <td>{{ $request->room_number }}</td>
                    <td>{{ $request->phone }}</td>
                    <td>
                        <span class="badge bg-{{ $request->status == 'approved' ? 'success' : ($request->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($request->status) }}
                        </span>
                    </td>
                    <td>{{ $request->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
