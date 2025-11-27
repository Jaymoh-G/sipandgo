@extends('storefront.layout')
@section('title', 'Frequently Asked Questions - ' . ($siteName ?? 'Sip & Go'))
@section('description', 'Find answers to common questions about delivery, payment, returns, and more at Sip & Go.')
@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Frequently Asked Questions</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="{{ route('home') }}" class="text-main-600 flex-align gap-8">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align text-gray-500">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-neutral-600">
                    FAQs
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<section class="faq py-80">
    <div class="container container-lg">
        <div class="section-heading text-center mb-56">
            <h2 class="text-heading-two mb-16">Frequently Asked Questions</h2>
            <p class="text-gray-600">Find answers to common questions about our products, delivery, and services</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item border border-gray-100 rounded-16 mb-16 bg-white" data-aos="fade-up" data-aos-duration="200">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold text-heading" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
                                1. Do you deliver everywhere in Kenya?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-gray-600">
                                We deliver within Nairobi same-day and countrywide through courier partners.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="accordion-item border border-gray-100 rounded-16 mb-16 bg-white" data-aos="fade-up" data-aos-duration="300">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold text-heading" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                2. What are your delivery charges?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-gray-600">
                                Delivery fees vary by location. Some Nairobi orders qualify for free delivery.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="accordion-item border border-gray-100 rounded-16 mb-16 bg-white" data-aos="fade-up" data-aos-duration="400">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold text-heading" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                3. What payment methods do you accept?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-gray-600">
                                We accept M-Pesa, cards, bank transfer, and cash on delivery (selected areas).
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="accordion-item border border-gray-100 rounded-16 mb-16 bg-white" data-aos="fade-up" data-aos-duration="500">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold text-heading" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                4. Do I need to be 18+ to order?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-gray-600">
                                Yes. ID verification may be required upon delivery.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="accordion-item border border-gray-100 rounded-16 mb-16 bg-white" data-aos="fade-up" data-aos-duration="600">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold text-heading" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
                                5. Are your products authentic?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-gray-600">
                                Yes. All items are sourced from licensed distributors and approved importers.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 6 -->
                    <div class="accordion-item border border-gray-100 rounded-16 mb-16 bg-white" data-aos="fade-up" data-aos-duration="700">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold text-heading" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" aria-controls="faq6">
                                6. Can I return alcohol?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-gray-600">
                                Returns are accepted only for damaged or incorrect items delivered.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 7 -->
                    <div class="accordion-item border border-gray-100 rounded-16 mb-16 bg-white" data-aos="fade-up" data-aos-duration="800">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold text-heading" type="button" data-bs-toggle="collapse" data-bs-target="#faq7" aria-expanded="false" aria-controls="faq7">
                                7. How long does delivery take?
                            </button>
                        </h2>
                        <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-gray-600">
                                Same-day in Nairobi; 1–3 days for up-country deliveries.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 8 -->
                    <div class="accordion-item border border-gray-100 rounded-16 mb-16 bg-white" data-aos="fade-up" data-aos-duration="900">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold text-heading" type="button" data-bs-toggle="collapse" data-bs-target="#faq8" aria-expanded="false" aria-controls="faq8">
                                8. Do you handle bulk or corporate orders?
                            </button>
                        </h2>
                        <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-gray-600">
                                Yes, we supply events, parties, and corporate clients with special pricing.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 9 -->
                    <div class="accordion-item border border-gray-100 rounded-16 mb-16 bg-white" data-aos="fade-up" data-aos-duration="1000">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold text-heading" type="button" data-bs-toggle="collapse" data-bs-target="#faq9" aria-expanded="false" aria-controls="faq9">
                                9. What if I'm unavailable during delivery?
                            </button>
                        </h2>
                        <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-gray-600">
                                We'll reschedule delivery; extra charges may apply.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 10 -->
                    <div class="accordion-item border border-gray-100 rounded-16 mb-16 bg-white" data-aos="fade-up" data-aos-duration="1100">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold text-heading" type="button" data-bs-toggle="collapse" data-bs-target="#faq10" aria-expanded="false" aria-controls="faq10">
                                10. Do you offer offers or discounts?
                            </button>
                        </h2>
                        <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-gray-600">
                                Yes—look out for promotions, bundle and holiday deals.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact CTA -->
                <div class="text-center mt-56">
                    <div class="bg-main-50 rounded-16 p-40">
                        <h4 class="text-heading mb-16">Still have questions?</h4>
                        <p class="text-gray-600 mb-24">Can't find the answer you're looking for? Please get in touch with our friendly team.</p>
                        <a href="{{ route('contact') }}" class="btn btn-main rounded-pill px-48">
                            Contact Us <i class="ph ph-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

