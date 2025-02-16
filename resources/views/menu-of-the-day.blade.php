@extends('layouts.app')
@section('content')
<style>

    .half-screen-image {
    position: relative;
    height: 70vh;
    background: url('{{ asset('build/assets/images/menu/1.jpg') }}')  center/cover no-repeat;
}
.overlay-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #2C3E50;
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

/* General Styling */
.container {
    max-width: 1100px;
}

/* -- Search and Filter Section - */
.box1{
    background-color: #ecebe6;
}
.box2{
    background-color: #ecebe6;
}
/* Menu Categories */
.nav-tabs .nav-link {
    color: #333;
    font-weight: bold;
    padding: 10px 20px;
    transition: 0.3s ease;
}

.nav-tabs .nav-link.active {
    background-color: #F1C40F;
    color: white;
    border-radius: 5px;
}

/* Menu Cards */
.card {
    border: none;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    margin-bottom: 2.5rem;
}

.card:hover {
    transform: scale(1.05);
}

.card-img-top {
    height: 250px;
    object-fit: cover;
}


.button {
    background-color:#F1C40F;
    color: white;
    width: 100%;
    border: none;
    font-size: 16px;
    border-radius: 8px;
    padding: 10px;

}

.button:hover {
    background-color: #1ABC9C ;
    color: white ;
}



</style>
<div class="half-screen-image">
    <div class="half-screen-image">
        <div class="overlay-text">
            <h1>Menu</h1>
            <p >Delicious flavors, unforgettable moments!</p>
            <div class="link-container">
                <a href="/">Home</a> >Menu
            </div>
        </div>
    </div>
</div>

 <!-- Search and Filter Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Menu of the Day</h2>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <input type="text" class="box1 form-control w-50" placeholder="Search for a dish..." />
        <select class="box2 form-select w-25">
            <option selected>Sort by Price</option>
            <option>Low to High</option>
            <option>High to Low</option>
            <option>Non-Veg </option>
            <option>Veg </option>
        </select>
    </div>

    <!-- Menu Categories -->
    <ul class="nav nav-tabs" id="menuTabs">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#breakfast">Breakfast</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#lunch">Lunch</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#dinner">Dinner</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#drinks">Drinks</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#desserts">Desserts</a></li>
    </ul>




<!-------------------------- menu--------------------- -->

    <div class="tab-content mt-4">
        <div class="tab-pane fade show active" id="breakfast">
            <div class="row">

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/breakfast/2.jpg') }}" class="card-img-top" alt="Breakfast Item">
                        <div class="card-body">
                            <h5 class="card-title">Pancakes & Syrup</h5>
                            <p class="card-text">Soft, fluffy, and sweet perfection!</p>
                            <p class="text-danger fw-bold">$10</p>
                            {{-- <button class="button">Add to Cart</button> --}}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/breakfast/3.jpg') }}" class="card-img-top" alt="Breakfast Item">
                        <div class="card-body">
                            <h5 class="card-title">Cheese Omelette</h5>
                            <p class="card-text">Delicious morning meal to start your day.</p>
                            <p class="text-danger fw-bold">$10</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/breakfast/4.jpg') }}" class="card-img-top" alt="Breakfast Item">
                        <div class="card-body">
                            <h5 class="card-title">Aloo Paratha</h5>
                            <p class="card-text">Crispy, buttery, and full of flavor!</p>
                            <p class="text-danger fw-bold">$10</p>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/breakfast/5.jpg') }}" class="card-img-top" alt="Breakfast Item">
                        <div class="card-body">
                            <h5 class="card-title">French Toast</h5>
                            <p class="card-text">Golden, sweet, and irresistibly good!</p>
                            <p class="text-danger fw-bold">$10</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/breakfast/6.jpg') }}" class="card-img-top" alt="Breakfast Item">
                        <div class="card-body">
                            <h5 class="card-title">Fruit Bowl</h5>
                            <p class="card-text">Fresh, juicy, and naturally sweet!</p>
                            <p class="text-danger fw-bold">$10</p>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/breakfast/7.jpg') }}" class="card-img-top" alt="Breakfast Item">
                        <div class="card-body">
                            <h5 class="card-title">Chana Puri</h5>
                            <p class="card-text">A spicy, crispy, and filling breakfast!"</p>
                            <p class="text-danger fw-bold">$10</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-------------------------- Lunch--------------------- -->
        <div class="tab-pane fade" id="lunch">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/lunch/1.jpg') }}" class="card-img-top" alt="Lunch Item">
                        <div class="card-body">
                            <h5 class="card-title">Chicken Biryani </h5>
                            <p class="card-text">Aromatic, spicy, and full of flavors!"</p>
                            <p class="text-danger fw-bold">$15</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/lunch/2.jpg') }}" class="card-img-top" alt="Lunch Item">
                        <div class="card-body">
                            <h5 class="card-title">Shripms Rice </h5>
                            <p class="card-text">Aromatic, spicy, and full of flavors!</p>
                            <p class="text-danger fw-bold">$15</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/lunch/3.jpg') }}" class="card-img-top" alt="Lunch Item">
                        <div class="card-body">
                            <h5 class="card-title">Chicken Curry</h5>
                            <p class="card-text">A perfect combo!</p>
                            <p class="text-danger fw-bold">$15</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/lunch/4.jpg') }}" class="card-img-top" alt="Lunch Item">
                        <div class="card-body">
                            <h5 class="card-title">Club Sandwich</h5>
                            <p class="card-text">Stacked with flavor in every bite!</p>
                            <p class="text-danger fw-bold">$15</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/lunch/5.jpg') }}" class="card-img-top" alt="Lunch Item">
                        <div class="card-body">
                            <h5 class="card-title">Spaghetti Alfredo</h5>
                            <p class="card-text">Creamy, cheesy, and simply delicious!</p>
                            <p class="text-danger fw-bold">$15</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/lunch/6.jpg') }}" class="card-img-top" alt="Lunch Item">
                        <div class="card-body">
                            <h5 class="card-title">Daal Chawal </h5>
                            <p class="card-text">Simple, homely, and comforting!</p>
                            <p class="text-danger fw-bold">$15</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!------------------------ Dinner--------------------- -->
        <div class="tab-pane fade" id="dinner">
            <div class="row">

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/dinner/1.jpg') }}" class="card-img-top" alt="Dinner Item">
                        <div class="card-body">
                            <h5 class="card-title">BBQ Platter</h5>
                            <p class="card-text">Smoky, juicy, and perfectly grilled!</p>
                            <p class="text-danger fw-bold">$20</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/dinner/2.jpg') }}" class="card-img-top" alt="Dinner Item">
                        <div class="card-body">
                            <h5 class="card-title">Butter Chicken</h5>
                            <p class="card-text">Rich, creamy, and full of spice!</p>
                            <p class="text-danger fw-bold">$20</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/dinner/3.jpg') }}" class="card-img-top" alt="Dinner Item">
                        <div class="card-body">
                            <h5 class="card-title">Grilled Fish</h5>
                            <p class="card-text">Light, flavorful, and perfectly cooked!</p>
                            <p class="text-danger fw-bold">$20</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/dinner/4.jpg') }}" class="card-img-top" alt="Dinner Item">
                        <div class="card-body">
                            <h5 class="card-title">Steak & Mash</h5>
                            <p class="card-text">Tender steak with creamy mashed potatoes!</p>
                            <p class="text-danger fw-bold">$20</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/dinner/5.jpg') }}" class="card-img-top" alt="Dinner Item">
                        <div class="card-body">
                            <h5 class="card-title">Paneer Handi</h5>
                            <p class="card-text">Soft paneer in a creamy, spicy gravy!</p>
                            <p class="text-danger fw-bold">$20</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/dinner/6.jpg') }}" class="card-img-top" alt="Dinner Item">
                        <div class="card-body">
                            <h5 class="card-title">Mutton Karahi</h5>
                            <p class="card-text">Spicy, tender, and full of aroma!</p>
                            <p class="text-danger fw-bold">$20</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!--------------------- Drinks---------------------------------- -->
        <div class="tab-pane fade" id="drinks">
            <div class="row">

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/drinks/1.jpg') }}"class="card-img-top" alt="Drink Item">
                        <div class="card-body">
                            <h5 class="card-title">Mint Cooler</h5>
                            <p class="card-text">Refreshing, zesty, and ice-cold!</p>
                            <p class="text-danger fw-bold">$5</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/drinks/2.jpg') }}"class="card-img-top" alt="Drink Item">
                        <div class="card-body">
                            <h5 class="card-title">Blue Berry Shake</h5>
                            <p class="card-text">Smooth, creamy, and energizing!</p>
                            <p class="text-danger fw-bold">$5</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/drinks/3.jpg') }}"class="card-img-top" alt="Drink Item">
                        <div class="card-body">
                            <h5 class="card-title">Mango Smoothie</h5>
                            <p class="card-text">Thick, fruity, and summer-perfect!</p>
                            <p class="text-danger fw-bold">$5</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/drinks/4.jpg') }}"class="card-img-top" alt="Drink Item">
                        <div class="card-body">
                            <h5 class="card-title">Strawberry Lemonade</h5>
                            <p class="card-text">Sweet, tangy, and super refreshing!</p>
                            <p class="text-danger fw-bold">$5</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/drinks/5.jpg') }}"class="card-img-top" alt="Drink Item">
                        <div class="card-body">
                            <h5 class="card-title">Pina Colada</h5>
                            <p class="card-text">Tropical vibes in every sip!</p>
                            <p class="text-danger fw-bold">$5</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/drinks/6.jpg') }}"class="card-img-top" alt="Drink Item">
                        <div class="card-body">
                            <h5 class="card-title">Coffee</h5>
                            <p class="card-text">Rich, creamy, and chocolatey!</p>
                            <p class="text-danger fw-bold">$5</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!--------------------------- Desserts------------------------- -->
        <div class="tab-pane fade" id="desserts">
            <div class="row">

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/deserts/1.jpg') }}" class="card-img-top" alt="Dessert Item">
                        <div class="card-body">
                            <h5 class="card-title">Lava Cake</h5>
                            <p class="card-text">Warm, gooey, and chocolatey bliss!</p>
                            <p class="text-danger fw-bold">$8</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/deserts/2.jpg') }}" class="card-img-top" alt="Dessert Item">
                        <div class="card-body">
                            <h5 class="card-title">Gulab Jamun</h5>
                            <p class="card-text">Soft, sweet, and melt-in-mouth delight!</p>
                            <p class="text-danger fw-bold">$8</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/deserts/3.jpg') }}" class="card-img-top" alt="Dessert Item">
                        <div class="card-body">
                            <h5 class="card-title">Cheesecake</h5>
                            <p class="card-text">Creamy, rich, and perfectly baked!</p>
                            <p class="text-danger fw-bold">$8</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/deserts/4.jpg') }}" class="card-img-top" alt="Dessert Item">
                        <div class="card-body">
                            <h5 class="card-title">Oreo Brownie</h5>
                            <p class="card-text">Crunchy, fudgy, and chocolate-loaded!</p>
                            <p class="text-danger fw-bold">$8</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/deserts/5.jpg') }}" class="card-img-top" alt="Dessert Item">
                        <div class="card-body">
                            <h5 class="card-title">Ice Cream</h5>
                            <p class="card-text">Sweet, creamy, and mango-filled joy!</p>
                            <p class="text-danger fw-bold">$8</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('build/assets/images/menu/deserts/6.jpg') }}" class="card-img-top" alt="Dessert Item">
                        <div class="card-body">
                            <h5 class="card-title">Kheer</h5>
                            <p class="card-text">Traditional, creamy, and utterly delicious!</p>
                            <p class="text-danger fw-bold">$8</p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Cart Section -->
{{-- <div class="cart-section mt-5">
    <h2 class="text-center">🛒 Your Cart</h2>

    <div class="row">
        <div class="col-md-8">
            <div class="card p-3">
                <h5>Items in Cart:</h5>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        Mixed Item Breakfast - $30
                        <button class="btn btn-sm btn-danger">❌</button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        Lasagna - $33
                        <button class="btn btn-sm btn-danger">❌</button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h4>Total: <span class="text-danger">$63</span></h4>
                <button class="button">Confirm Order</button>
            </div>
        </div>
    </div>
</div> --}}



{{-- <div class="container mt-4">
    <h2 class="text-center">🛒 Your Cart</h2>

    <div class="row">
        <div class="col-md-8">
            <div class="cart-items">
                <!-- Cart Items Will Be Added Here -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h4>Total Amount: <span class="text-danger" id="total-price">$0</span></h4>
                <button class="btn btn-primary w-100 mt-3" id="checkout-btn">Proceed to Checkout</button>

            </div>
        </div>
    </div>
</div> --}}
@endsection