@foreach($groupedReservations as $group)
    @foreach($group->children as $child)
        <div class="modal fade" id="assignRoomModal-{{ $child->id }}" tabindex="-1" aria-labelledby="assignRoomModalLabel-{{ $child->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.reservations.updatestatus', $child->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="modal-header">
                            <h5 class="modal-title" id="assignRoomModalLabel-{{ $child->id }}">Assign Room to {{ $child->name ?? 'Guest' }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="room_id-{{ $child->id }}" class="form-label">Select Room</label>
                                <select name="room_id" id="room_id-{{ $child->id }}" class="form-select">
                                    @foreach($availableRooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->room_name }} ({{ $room->room_type }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status-{{ $child->id }}" class="form-label">Status</label>
                                <select name="status" id="status-{{ $child->id }}" class="form-select">
                                    <option value="confirmed">Confirmed</option>
                                    <option value="pending">Pending</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endforeach


{{-- Single reservations --}}
@foreach($reservations as $reservation)
    <div class="modal fade" id="assignRoomModal-{{ $reservation->id }}" tabindex="-1" aria-labelledby="assignRoomModalLabel-{{ $reservation->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.reservations.updatestatus', $reservation->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="modal-header">
                        <h5 class="modal-title" id="assignRoomModalLabel-{{ $reservation->id }}">Assign Room to {{ $reservation->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="room_id-{{ $reservation->id }}" class="form-label">Select Room</label>
                            <select name="room_id" id="room_id-{{ $reservation->id }}" class="form-select">
                                @foreach($availableRooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->room_name }} ({{ $room->room_type ?? 'N/A' }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status-{{ $reservation->id }}" class="form-label">Status</label>
                            <select name="status" id="status-{{ $reservation->id }}" class="form-select">
                                <option value="confirmed">Confirmed</option>
                                <option value="pending">Pending</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
