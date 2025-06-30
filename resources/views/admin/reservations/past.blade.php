@extends('layouts.admin')

@section('content')
<h3>Past Reservations</h3>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Room</th>
            <th>Guest</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pastReservations as $res)
        <tr>
            <td>{{ $res->id }}</td>
            <td>{{ $res->room->room_type ?? 'N/A' }}</td>
            <td>{{ $res->name }}</td>
            <td>{{ $res->check_in }}</td>
            <td>{{ $res->check_out }}</td>
            <td>{{ $res->status }}</td>
            <td>
                <form action="{{ route('admin.reservations.forceDelete', $res->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Permanently Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
