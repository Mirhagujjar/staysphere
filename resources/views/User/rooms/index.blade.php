@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<style>
    * {
        font-family: "Montserrat", Helvetica, sans-serif;
        box-sizing: border-box;
    }

    html,
    body {
        overflow-x: hidden;
        margin: 0;
        padding: 0;

    }

    /* <!------------------------------- Top Banner ------------------------> */

    .hero-dynamic {
        background-image: url('{{ asset($heroImage ?? 'build/assets/images/r.jpg') }}') !important;
    }
    .half-screen-image {
        position: relative;
        height: 70vh;
        background: url('{{ asset('build/assets/images/r.jpg') }}') center/cover no-repeat;
    }

    .overlay-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #F8F9FA;
    }

    .overlay-text h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    .link-container {
        margin-top: 10px;
        font-size: 20px;
        font-weight: 500;
        color: #F8F9FA;
    }

    .link-container a {
        text-decoration: none;
        color: #F1C40F;
    }

    .link-container a:hover {
        color: #1ABC9C;
    }

    /* <!--------------------- Room Section -------------------------------> */
    .section-title h2 {
        font-size: 35px;
        font-weight: 600;
        margin-top: 0;
        line-height: 1.4;
        color: #2C3E50;
        margin-bottom: 0;
    }

    .text-center {
        text-align: center;
    }

    /* ---------------------------------cards------------------------------ */
    .g-4 {
        padding: 10px;
    }

    .card {
        margin-top: 60px;
        position: relative;
        background-color: #343A40;
        color: #F8F9FA;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        text-align: center;
    }

    .card-text {
        text-align: center;
        font-size: 1rem;
    }

    /* ----------------Badges-----------------------*/
    .badge {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px 10px;
        font-size: 0.9rem;
    }

    /* ----------------------Card Hover------------------------ */
    .card-hover {
        position: relative;
        overflow: hidden;
    }

    .card-hover .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .card-hover:hover .card-overlay {
        opacity: 1;
    }

    .card-overlay .details {
        font-size: 0.9rem;
        margin-bottom: 10px;
        text-align: center;
    }

    .card-overlay .btn-book {
        background-color: #F1C40F;
        color: white;
        padding: 8px 15px;
        font-size: 0.9rem;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    /* -----------------------Facilities----------------------------- */
   .facilities-section {
        margin-top: 100px;
        margin-bottom: 100px;
        padding: 50px 20px;
        position: relative;
        color: #fff;
        /* Background is now handled inline via dynamic image */
    }

    .facilities-section h2 {
        font-size: 4rem;
        text-align: center;
        margin-bottom: 30px;
        color: #ffffff; /* Changed from #111111 for better contrast on dark bg */
        text-shadow: 1px 1px 3px rgba(0,0,0,0.5); /* Added for better readability */
    }

    /* Facility Cards - Black Version */
    .facility-item {
        background-color: rgba(0, 0, 0, 0.85); /* Semi-transparent black */
        padding: 25px 20px;
        border-radius: 8px;
        transition: all 0.3s ease;
        color: #ffffff;
        height: 100%;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .facility-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        background-color: rgba(0, 0, 0, 0.9); /* Slightly darker on hover */
    }

    .facility-item i {
        font-size: 2.2rem;
        color: #F1C40F; /* Gold accent color */
        margin-bottom: 15px;
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .facility-item:hover i {
        transform: scale(1.1);
    }

    .facility-item h5 {
        color: #ffffff;
        margin-bottom: 12px;
        font-weight: 600;
    }

    .facility-item p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        margin-bottom: 0;
    }
    /* -------------------last----------------- */
    .margin_120_95 {
        padding-top: 120px;
        padding-bottom: 95px;
    }

    .title small {
        text-transform: uppercase;
        color: #2C3E50;
        letter-spacing: 3px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .title h2 {
        font-weight: 700;
        font-size: 2.375rem;
        color: #333;
        margin-bottom: 15px;
    }

    .phone_element a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #978667;
    }

    .phone_element a i {
        margin-right: 15px;
        font-size: 1.875rem;
        color: #2C3E50;
    }

    .phone_element a span {
        font-size: 1.125rem;
        font-weight: 600;
        color: #2C3E50;
    }

    .booking_wrapper {
        background-color: rgba(151, 134, 103, 0.05);
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* -----------------------filters- */
    .filters-sidebar {
        position: sticky;
        top: 100px;
        background: #343A40;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        margin-left: 20px;
    }
</style>

    <!------------------------------- Top Banner ------------------------>
    <div class="half-screen-image" style="background-image: url('{{ asset($hero_image) }}')">
        <div class="overlay-text">
            <h1>{{ $hero_title }}</h1>
            <p>{{ $hero_description }}</p>
            <div class="link-container">
                <a href="/">Home</a> > <a href="{{ route('user.rooms.index') }}">Rooms</a>
            </div>
        </div>
    </div>

  

    <!--------------------- Room Section ------------------------------->
    <div class="container my-5">
        <div class="section-title text-center">
            <h2>Our Rooms & Rates</h2>
        </div>

        
        <div class="row g-4">
            <!-- Filters Sidebar -->
            <div class="col-lg-3">
                <div class="card p-3 shadow-sm filter-card">
                    <h4>Filters</h4>
                    <hr>
                    <form method="GET" action="{{ route('user.rooms.index') }}" id="filter-form">
                        <!-- Price Range -->
                        <div class="filter-group">
                            <h6 class="fw-bold">Price Range (Rs.)</h6>
                            <div class="row g-2">
                                <div class="col">
                                    <input type="number" name="min_price" class="form-control" 
                                           placeholder="Min" value="{{ request('min_price') }}">
                                </div>
                                <div class="col">
                                    <input type="number" name="max_price" class="form-control" 
                                           placeholder="Max" value="{{ request('max_price') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Room Type -->
                        @if($roomTypeFilter = $filters->where('slug', 'room-type')->first())
                        <div class="filter-group">
                            <h6 class="fw-bold">Room Type</h6>
                            <select name="room_type" class="form-select">
                                <option value="">All Room Types</option>
                                @foreach($roomTypeFilter->options as $option)
                                    <option value="{{ $option->value }}" {{ request('room_type') == $option->value ? 'selected' : '' }}>
                                        {{ $option->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- View Type -->
                        @if($viewTypeFilter = $filters->where('slug', 'view-type')->first())
                        <div class="filter-group">
                            <h6 class="fw-bold">View Type</h6>
                            <select name="view_type" class="form-select">
                                <option value="">All Views</option>
                                @foreach($viewTypeFilter->options as $option)
                                    <option value="{{ $option->value }}" {{ request('view_type') == $option->value ? 'selected' : '' }}>
                                        {{ $option->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- Other Filters -->
                        @foreach($filters->whereNotIn('slug', ['room-type', 'view-type']) as $filter)
                            @if($filter->is_active && $filter->options->count() > 0)
                            <div class="filter-group">
                                <h6 class="fw-bold">{{ $filter->name }}</h6>
                                
                                @if($filter->type == 'checkbox')
                                    <div class="filter-options">
                                        @foreach($filter->options as $option)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="filters[{{ $filter->slug }}][]"
                                                       value="{{ $option->id }}"
                                                       id="filter-{{ $filter->slug }}-{{ $option->id }}"
                                                       {{ in_array($option->id, (array)request('filters.'.$filter->slug, [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="filter-{{ $filter->slug }}-{{ $option->id }}">
                                                    {{ $option->label }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <select name="filters[{{ $filter->slug }}]" class="form-select">
                                        <option value="">All {{ $filter->name }}</option>
                                        @foreach($filter->options as $option)
                                            <option value="{{ $option->id }}"
                                                {{ request('filters.'.$filter->slug) == $option->id ? 'selected' : '' }}>
                                                {{ $option->label }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            @endif
                        @endforeach

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        <a href="{{ route('user.rooms.index') }}" class="btn btn-outline-secondary w-100 mt-2" 
                           onclick="event.preventDefault(); document.getElementById('reset-form').submit();">
                           Reset
                        </a>
                    </form>

                    <!-- Hidden reset form -->
                    <form id="reset-form" action="{{ route('user.rooms.index') }}" method="GET" style="display: none;"></form>
                </div>
            </div>

            <!-- Rooms Listing -->
            <div class="col-lg-9">
                @if($rooms->count() > 0)
                    <div class="row g-4">
                        @foreach($rooms as $room)
                        <div class="col-md-4">
                            <div class="card card-hover h-80">
                                <!-- Room Image -->
                                <div class="position-relative" style="height: 200px; overflow: hidden;">
                                    @if($room->is_new)
                                    <span class="badge text-bg-success position-absolute top-0 start-0 m-2">NEW</span>
                                    @endif
                                    @if($room->on_sale)
                                    <span class="badge text-bg-danger position-absolute top-0 end-0 m-2">SALE</span>
                                    @endif
                                    <img src="{{ asset($room->image ?: 'assets/images/default-room.jpg') }}"
                                        class="w-100 h-100 object-fit-cover"
                                        alt="{{ $room->room_name }}">
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $room->room_name }}</h5>
                                    <p class="card-text">Rs. {{ number_format($room->price) }} / Per Night</p>
                                    <div class="card-overlay mt-auto">
                                        <div class="details">
                                            <p>{{ $room->room_capacity }} Guests</p>
                                            @if($room->size)
                                                <p>{{ $room->size }} ft² Room Size</p>
                                            @endif
                                            <p>Rs. {{ number_format($room->price) }} / Per Night</p>
                                        </div>
                                        <a href="{{ route('user.rooms.show', $room->id) }}" class="btn-book">View Details</a>
                                    </div>
                                </div>

                                @if(!$room->isBooked())
                                <div class="card-footer text-center">
                                    <a href="{{ route('user.reservations.create', ['room_id' => $room->id]) }}"
                                    class="btn btn-primary">
                                        Book Now
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $rooms->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="alert alert-info">
                        No rooms found matching your filters. 
                        <a href="{{ route('user.rooms.index') }}">Clear filters</a> to see all rooms.
                    </div>
                @endif
            </div>
        </div>
    </div>

   {{-- ----------------------------Facilities------------------------------ --}}
   <div class="facilities-section py-5" 
     style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
             url('{{ $facilitiesBackground ? asset('storage/' . $facilitiesBackground) : asset('build/assets/images/default-facilities-bg.jpg') }}'); 
             background-size: cover; background-position: center;">
    <div class="container">
        <h2 class="text-center text-white mb-5">Our Premium Facilities</h2>
        <div class="row g-4">
            @foreach($facilities as $facility)
            <div class="col-lg-3 col-md-6">
                <div class="facility-item text-center">
                    <i class="bi {{ $facility->icon }}"></i>
                    <h5>{{ $facility->title }}</h5>
                    <p>{{ $facility->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
