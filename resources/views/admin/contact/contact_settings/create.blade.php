@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Add Contact Page Settings</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.contact-settings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- text fields --}}
        <input type="text" name="banner_heading" placeholder="Banner Heading" required>
        <input type="text" name="breadcrumb" placeholder="Breadcrumb" required>
        <textarea name="left_section_text" placeholder="Left Section Text" required></textarea>
        <input type="text" name="right_section_address" placeholder="Address" required>
        <input type="text" name="right_section_phone" placeholder="Phone" required>
        <input type="email" name="right_section_email" placeholder="Email" required>
        <input type="text" name="contact_info_heading" placeholder="Contact Info Heading" required>

        {{-- images --}}
        <label>Half page Image</label>
        <input type="file" name="half_page_image">

        <label>Contact Section Image</label>
        <input type="file" name="contact_section_image">

        <button type="submit" class="btn btn-success mt-3">Save</button>
    </form>
</div>
@endsection
