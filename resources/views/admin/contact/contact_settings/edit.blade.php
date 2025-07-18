@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Contact Page Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.contact-settings.update', $settings->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Banner Section --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Banner Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Banner Heading</label>
                    <input type="text" name="banner_heading" class="form-control" value="{{ $settings->banner_heading }}" required>
                </div>
                <div class="mb-3">
                    <label>Breadcrumb</label>
                    <input type="text" name="breadcrumb" class="form-control" value="{{ $settings->breadcrumb }}" required>
                </div>
                <div class="mb-3">
                    <label>Half Page Image</label><br>
                    @if($settings->half_page_image)
                        <img src="{{ asset($settings->half_page_image) }}" alt="" width="150"><br><br>
                    @endif
                    <input type="file" name="banner_image" class="form-control">
                </div>
            </div>
        </div>

        {{-- Left Section --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">Left Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Left Section Text</label>
                    <textarea name="left_section_text" class="form-control" rows="4" required>{{ $settings->left_section_text }}</textarea>
                </div>
            </div>
        </div>

        {{-- Right Section --}}
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">Right Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Right Section Address</label>
                    <input type="text" name="right_section_address" class="form-control" value="{{ $settings->right_section_address }}" required>
                </div>

                <div class="mb-3">
                    <label>Right Section Phone</label>
                    <input type="text" name="right_section_phone" class="form-control" value="{{ $settings->right_section_phone }}" required>
                </div>

                <div class="mb-3">
                    <label>Right Section Email</label>
                    <input type="email" name="right_section_email" class="form-control" value="{{ $settings->right_section_email }}" required>
                </div>
            </div>
        </div>

        {{-- Info Box Section --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Info Box Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Contact Info Heading</label>
                    <input type="text" name="contact_info_heading" class="form-control" value="{{ $settings->contact_info_heading }}">
                </div>
                <div class="mb-3">
                    <label>Contact Section Image</label><br>
                    @if($settings->contact_section_image)
                        <img src="{{ asset($settings->contact_section_image) }}" alt="" width="150"><br><br>
                    @endif
                    <input type="file" name="contact_section_image" class="form-control">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100">Update All Settings</button>
    </form>
</div>
@endsection
