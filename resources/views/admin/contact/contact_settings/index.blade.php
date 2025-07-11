@extends('layouts.admin')

@section('content')



<div class="container mt-4">
    <h2>Contact Page Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($settings)
        {{-- Banner --}}
        <div class="card p-3 mb-3">
            <h4>Banner</h4>
            <p><strong>Heading:</strong> {{ $settings->banner_heading }}</p>
            <p><strong>Breadcrumb:</strong> {{ $settings->breadcrumb }}</p>
            <p><strong>Half Page Image:</strong></p>
            @if($settings->half_page_image)
                <img src="{{ asset($settings->half_page_image) }}" width="200">
            @else
                <p>No image uploaded</p>
            @endif
            <a href="{{ route('admin.contact-settings.edit', $settings->id) }}" class="btn btn-primary btn-sm mt-2">Edit</a>
        </div>

        {{-- Left Section --}}
        <div class="card p-3 mb-3">
            <h4>Left Section</h4>
            <p>{{ $settings->left_section_text }}</p>
            <a href="{{ route('admin.contact-settings.edit', $settings->id) }}" class="btn btn-primary btn-sm mt-2">Edit</a>
        </div>

        {{-- Right Section --}}
        <div class="card p-3 mb-3">
            <h4>Right Section</h4>
            <p><strong>Contact Info Heading:</strong> {{ $settings->contact_info_heading }}</p>
            <p><strong>Address:</strong> {{ $settings->right_section_address }}</p>
            <p><strong>Phone:</strong> {{ $settings->right_section_phone }}</p>
            <p><strong>Email:</strong> {{ $settings->right_section_email }}</p>
            <p><strong>Contact Image:</strong></p>
            @if($settings->contact_section_image)
                <img src="{{ asset($settings->contact_section_image) }}" width="200">
            @else
                <p>No image uploaded</p>
            @endif
            <a href="{{ route('admin.contact-settings.edit', $settings->id) }}" class="btn btn-primary btn-sm mt-2">Edit</a>
        </div>

    @else
        <div class="alert alert-info">No settings found.</div>
        <a href="{{ route('admin.contact-settings.create') }}" class="btn btn-success">Add Settings</a>
    @endif
</div>
@endsection
