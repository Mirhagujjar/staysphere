
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Contact Page Settings</h3>
                    <p class="mb-0 small">Configure the contact page content and appearance</p>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <h5 class="alert-heading">Validation Errors</h5>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.contact-settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Banner Section -->
                            <div class="col-md-12 mb-4">
                                <h5 class="section-title">Banner Settings</h5>
                                <div class="form-group">
                                    <label for="banner_heading" class="form-label">Banner Heading</label>
                                    <input type="text" class="form-control" id="banner_heading" name="banner_heading"
                                           placeholder="Enter banner heading" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="breadcrumb" class="form-label">Breadcrumb Text</label>
                                    <input type="text" class="form-control" id="breadcrumb" name="breadcrumb"
                                           placeholder="e.g., Home / Contact" required>
                                </div>
                            </div>

                            <!-- Left Section -->
                            <div class="col-md-6 mb-4">
                                <h5 class="section-title">Left Section</h5>
                                <div class="form-group">
                                    <label for="left_section_text" class="form-label">Content Text</label>
                                    <textarea class="form-control" id="left_section_text" name="left_section_text"
                                              rows="5" placeholder="Enter your contact page content" required></textarea>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="half_page_image" class="form-label">Half Page Image</label>
                                    <input type="file" class="form-control" id="half_page_image" name="half_page_image">
                                    <small class="text-muted">Recommended size: 800x600px</small>
                                </div>
                            </div>

                            <!-- Right Section -->
                            <div class="col-md-6 mb-4">
                                <h5 class="section-title">Right Section</h5>
                                <div class="form-group">
                                    <label for="right_section_address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="right_section_address"
                                           name="right_section_address" placeholder="Enter your address" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="right_section_phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="right_section_phone"
                                           name="right_section_phone" placeholder="Enter phone number" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="right_section_email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="right_section_email"
                                           name="right_section_email" placeholder="Enter email address" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="contact_section_image" class="form-label">Contact Section Image</label>
                                    <input type="file" class="form-control" id="contact_section_image"
                                           name="contact_section_image">
                                    <small class="text-muted">Recommended size: 400x300px</small>
                                </div>
                            </div>

                            <!-- Contact Info Section -->
                            <div class="col-md-12 mb-4">
                                <h5 class="section-title">Contact Information</h5>
                                <div class="form-group">
                                    <label for="contact_info_heading" class="form-label">Section Heading</label>
                                    <input type="text" class="form-control" id="contact_info_heading"
                                           name="contact_info_heading" placeholder="Enter section heading" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="reset" class="btn btn-outline-secondary">Reset Form</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .section-title {
        color: #3b7ddd;
        border-bottom: 1px solid #eee;
        padding-bottom: 8px;
        margin-bottom: 20px;
        font-weight: 600;
    }
    .card {
        border-radius: 10px;
        border: none;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    .form-control {
        border-radius: 5px;
        padding: 10px 15px;
    }
    .form-control:focus {
        border-color: #3b7ddd;
        box-shadow: 0 0 0 0.2rem rgba(59, 125, 221, 0.25);
    }
    .btn-primary {
        background-color: #3b7ddd;
        border-color: #3b7ddd;
        padding: 8px 20px;
    }
</style>
@endsection
