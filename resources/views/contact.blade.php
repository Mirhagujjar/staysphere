@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Contact Us</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Our Address</h4>
            <p>123, Hotel Street, City, Country</p>
            <p>Email: support@hotel.com</p>
            <p>Phone: +123456789</p>
        </div>
        <div class="col-md-6">
            <h4>Send a Message</h4>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="mb-3">
                    <textarea name="message" class="form-control" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection
