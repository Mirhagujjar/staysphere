@extends('layouts.app')
@section('content')

<style>
    /* ------------- 1. Header Section ----------- */
    .review-header {
       background: url('{{ asset('build/assets/images/reviews/1.jpg') }}')center/cover;
    }
    .review-card {
        padding: 10px;
        background-color:#343A40;
        /* background-color: rgb(232, 235, 235); */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }
    /* ------------- 3. Filters & Search Bar------------- - */
    .box1{
        background-color: #ecebe6;
    }
    .box2{
        background-color: #ecebe6;
    }
    /* --------------- 2. Rating------------------ -- */
    .rating-circle {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background-color: #ffcc00;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 1.5rem;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        margin: 0 auto;
    }
    .rating-circle h2 {
        margin-bottom: 5px;
    }
    .progress {
        height: 12px;
        border-radius: 6px;
        background-color: #f8f9fa;
    }
    .progress-bar {
        border-radius: 6px;
    }
    /* ------------------5. Featured Section---------- */
    .feature-card {
        position: relative;
        width: 100%;
        height: 350px;
        border-radius: 15px;
        overflow: hidden;
    }
    .feature-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
    }
    .feature-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        width: 80%;
        z-index: 2;
    }
    .feature-overlay h3 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }
    .feature-overlay p {

        font-size: 16px;
        font-weight: 400;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

</style>

<!------------- 1. Header Section ----------->

<div class="review-header text-center text-white py-5">
    <h1>What Our Guests Say About Us</h1>
    <p>Real experiences from our valued guests.</p>
    <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#reviewModal">Write a Review</button>
</div>



<!--------------- 2. Rating------------------ -->
{{-- <div class="container my-5">
    <div class="row align-items-center text-center">
        <!------------ Left-------------->
        <div class="col-md-4">
            <div class="rating-circle">
                <h2 class="fw-bold">4.8</h2>
                <p class="text-warning">⭐⭐⭐⭐⭐</p>
                <small class="text-muted">Based on 250+ reviews</small>
            </div>
        </div>

        <!----------------- Right----------- -->
        <div class="col-md-8">
            <h5 class="fw-bold mb-3">Guest Rating Breakdown</h5>
            <div class="rating-bars">
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2">⭐⭐⭐⭐⭐</span>
                    <div class="progress flex-grow-1">
                        <div class="progress-bar bg-warning" style="width: 80%"></div>
                    </div>
                    <span class="ms-2 fw-bold">80%</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2">⭐⭐⭐⭐☆</span>
                    <div class="progress flex-grow-1">
                        <div class="progress-bar bg-warning" style="width: 15%"></div>
                    </div>
                    <span class="ms-2 fw-bold">15%</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2">⭐⭐⭐☆☆</span>
                    <div class="progress flex-grow-1">
                        <div class="progress-bar bg-warning" style="width: 3%"></div>
                    </div>
                    <span class="ms-2 fw-bold">3%</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2">⭐⭐☆☆☆</span>
                    <div class="progress flex-grow-1">
                        <div class="progress-bar bg-warning" style="width: 1%"></div>
                    </div>
                    <span class="ms-2 fw-bold">1%</span>
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-2">⭐☆☆☆☆</span>
                    <div class="progress flex-grow-1">
                        <div class="progress-bar bg-warning" style="width: 1%"></div>
                    </div>
                    <span class="ms-2 fw-bold">1%</span>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!------------- 3. Filters & Search Bar------------- -->
{{-- <div class="container my-4">
    <div class="d-flex justify-content-between">
        <input type="text" class="box1 form-control w-50" placeholder="Search reviews...">
        <select class="box2 form-select w-25">
            <option>Newest</option>
            <option>Highest Rated</option>
            <option>Lowest Rated</option>
        </select>
    </div>
</div> --}}
<!------------- 3. Filters & Search Bar------------- -->
{{-- <div class="container my-4">
    <div class="d-flex justify-content-between">
        <form method="GET" action="{{ route('user.review.review') }}" class="w-25">
            <select name="sort" class="box2 form-select" onchange="this.form.submit()">
                <option value="">Sort by</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Highest Rated</option>
                <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Lowest Rated</option>
            </select>
        </form>
    </div>
</div> --}}


<!------------- 4. Customer Reviews Section ------------>
<div class="container">
    <div class="row">
        @foreach( $reviews as $review)
        <div class="col-md-6 mb-4 text-white">
            <div class="review-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                    <div>
                    <h5 class="mb-2">{{ $review->name }}</h5>
                    </div>
                    </div>
                    <p>
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                ⭐
                            @else
                                ☆
                            @endif
                        @endfor
                    </p>

                    <p>"{{ $review->comment }}"</p>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!----------------------5. carousalSection-------------------->

<div class="container my-5">

 <div class="container my-5">

 <div class="container my-5">

    <h2 class="text-center fw-bold mb-4">🏆 Why Guests Love Stay Sphere</h2>
    <p class="text-center text-muted mb-4">Our commitment to excellence makes every stay memorable.</p>

    <div id="hotelExcellenceCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <!-- Card 1 -->
            <div class="carousel-item active">
                <div class="feature-card">
                    <div class="feature-overlay">
                        <h3>5-Star Guest Rated</h3>
                        <p>95% of our guests recommend Stay Sphere for its premium service and hospitality.</p>
                    </div>
                    <img src="{{ asset('build/assets/images/reviews/3.jpg') }}" class="feature-img" alt="Award">
                </div>
            </div>



            <!-- Card 2 -->
            <div class="carousel-item">
                <div class="feature-card">
                    <div class="feature-overlay">
                        <h3>Best Fine Dining</h3>
                        <p>Indulge in exquisite cuisines prepared by top chefs at our award-winning restaurant.</p>
                    </div>
                    <img src="{{ asset('build/assets/images/reviews/4.jpg') }}" class="feature-img" alt="Fine Dining">
                </div>
            </div>

            <!-- Card 3 -->
            <div class="carousel-item ">
                <div class="feature-card">
                    <div class="feature-overlay">
                        <h3>Luxury & Comfort</h3>
                        <p>Elegant suites and world-class facilities designed for your ultimate comfort.</p>
                    </div>
                    <img src="{{ asset('build/assets/images/reviews/5.jpg') }}" class="feature-img" alt="Luxury Rooms">
                </div>
            </div>

            <!-- Card 4 -->
            <div class="carousel-item">
                <div class="feature-card">
                    <div class="feature-overlay">
                        <h3>Personalized Experience</h3>
                        <p>We tailor every stay to meet your needs, ensuring a unique and memorable visit.</p>
                    </div>
                    <img src="{{ asset('build/assets/images/reviews/6.jpg') }}" class="feature-img" alt="Personalized Service">
                </div>
            </div>

        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#hotelExcellenceCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon>" aria-hidden="true"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#hotelExcellenceCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</div>

<!------------6. Write a Review Form---------------->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-4 rounded-4 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('review.store') }}" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    {{-- Booking Selector --}}
                    <div class="mb-3">
                        <label for="reservation_id" class="form-label">Select Booking</label>
                        <select name="reservation_id" id="reservation_id" class="form-select" required>
                            @forelse($completedBookings as $booking)
                                <option value="{{ $booking->id }}">
                                    Booking #{{ $booking->id }} - {{ $booking->room_type }} 
                                    ({{ $booking->check_in->format('M d, Y') }} to {{ $booking->check_out->format('M d, Y') }})
                                </option>
                            @empty
                                <option value="" disabled selected>No completed bookings available for review</option>
                            @endforelse
                        </select>
                        @error('reservation_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name', auth()->user()->name ?? '') }}" 
                               required minlength="2" maxlength="100">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                               value="{{ old('email', auth()->user()->email ?? '') }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Rating --}}
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select name="rating" class="form-control" required>
                            <option value="">Select rating</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                        @error('rating')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Comment --}}
                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Review</label>
                        <textarea name="comment" id="comment" class="form-control" rows="5"
                                  required minlength="10" maxlength="1000">{{ old('comment') }}</textarea>
                        <small class="form-text text-muted">Minimum 10 characters.</small>
                        @error('comment')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Consent --}}
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="consent" name="consent" 
                               {{ old('consent') ? 'checked' : '' }} required>
                        <label class="form-check-label" for="consent">
                            I confirm this review is based on my personal experience.
                        </label>
                        @error('consent')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="fas fa-paper-plane me-2"></i> Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Star Rating Styles --}}
<style>
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
        font-size: 1.5rem;
    }
    .star-rating input {
        display: none;
    }
    .star-rating label {
        color: #ddd;
        cursor: pointer;
        margin: 0 2px;
    }
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
</style>

{{-- Client-side Validation Script --}}
<script>
    (() => {
        'use strict';
        window.addEventListener('load', () => {
            const forms = document.getElementsByClassName('needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            });
        });
    })();
</script>



<!--------------7. Footer CTA -------------->
<div class="text-center my-5">
    <h4>Want to stay with us?</h4>
    <a href="{{route('user.rooms.index')}}" class="btn btn-warning">Check Room Availability</a>
</div>

@endsection
