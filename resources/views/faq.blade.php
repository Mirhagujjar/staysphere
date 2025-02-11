@extends('layouts.app') {{-- Use your main layout if available --}}

@section('content')

<!-- FAQ Section -->
<div class="container mt-5 py-5">
    <h2 class="text-center mb-4">Frequently Asked Questions</h2>

    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    What is the check-in and check-out time?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Check-in time is <strong>2:00 PM</strong>, and check-out time is <strong>12:00 PM</strong>.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faqTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                    Do you offer free Wi-Fi?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes! We provide <strong>free high-speed Wi-Fi</strong> in all rooms and public areas.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faqThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                    How can I contact customer support?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    You can reach us via phone at <strong>+123 456 789</strong> or email at <strong>support@staysphere.com</strong>.
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
