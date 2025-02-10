@extends('layouts.app')

@section('content')

<style>
    body, html {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .image-container {
        position: relative;
        width: 100%;
        height: 100vh; /* Full screen */
        overflow: hidden;
    }

    .image-container img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1s ease-in-out, clip-path 1s ease-in-out;
    }

    /* Split transition effect */
    .split-transition {
        clip-path: inset(0 50% 0 50%);
    }

    .show {
        transform: translateY(0);
        clip-path: inset(0 0 0 0);
    }

    .hide {
        transform: translateY(-100%);
    }
</style>

<body>

    <div class="image-container">
        <img src="{{ asset('build/assets/images/dish.png') }}" class="image show">
        <img src="{{ asset('build/assets/images/dish.png') }}" class="image">
        <img src="{{ asset('build/assets/images/dish.png') }}" class="image">
    </div>

    <script>
        let images = document.querySelectorAll(".image");
        let currentIndex = 0;

        window.addEventListener("wheel", function(event) {
            if (event.deltaY > 0) { 
                // Scroll Down
                if (currentIndex < images.length - 1) {
                    images[currentIndex].classList.add("split-transition");
                    setTimeout(() => {
                        images[currentIndex].classList.remove("show");
                        images[currentIndex].classList.add("hide");
                        images[currentIndex + 1].classList.add("show");
                    }, 300);
                    currentIndex++;
                }
            } else {
                // Scroll Up
                if (currentIndex > 0) {
                    images[currentIndex].classList.add("split-transition");
                    setTimeout(() => {
                        images[currentIndex].classList.remove("show");
                        images[currentIndex - 1].classList.remove("hide");
                        images[currentIndex - 1].classList.add("show");
                    }, 300);
                    currentIndex--;
                }
            }
        });
    </script>

</body>







{{-- <div class="container mt-5 py-5">
    <h2 class="text-center">Menu of the Day</h2>
    <p class="text-center">Enjoy our special meals prepared fresh every day.</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/dish.png') }}" class="card-img-top" alt="Food Image">
                <div class="card-body">
                    <h5 class="card-title">Special Dish Name</h5>
                    <p class="card-text">Delicious meal with fresh ingredients.</p>
                    <p><strong>Price:</strong> $12.99</p>
                </div>
            </div>
        </div>
        <!-- Add more dishes here -->
    </div>
</div> --}}
@endsection
