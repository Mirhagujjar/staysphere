{{-- <div class="container mt-4">
    <div class="row">
        @foreach($rooms as $room)
        <div class="col-md-4">
            <a href="{{ route('hotel.detailaboutUs', $room->id) }}" class="text-decoration-none">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('assets/images/'.$room->image) }}" class="card-img-top" alt="Room Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->name }}</h5>
                        <p class="card-text">Capacity: {{ $room->capacity }} Guests</p>
                        <p class="card-text">Price: ${{ $room->price }} per night</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div> --}}
