@extends('storefront.layout')

@section('title', 'Contact Us - Sip & Go')
@section('description', 'Get in touch with Sip & Go for questions about our products, orders, or any other inquiries')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Contact Us</h6>
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
                    Contact Us
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ============================ Contact Section Start =============================== -->
<section class="contact py-80">
    <div class="container container-lg">
        <!-- Header -->
        <div class="section-heading text-center mb-56">
            <h2 class="text-heading-two mb-16">Contact Us</h2>
            <p class="text-gray-600 max-w-700 mx-auto">
                Have questions about our products or need assistance with your order?
                We're here to help! Get in touch with our team.
            </p>
        </div>

        <!-- Map and Contact Information Section -->
        <div class="row gy-4 mb-80">
            <!-- Contact Information Cards - Left Side -->
            <div class="col-lg-6">
                <div class="row gy-4">
                    <div class="col-md-6" data-aos="fade-up" data-aos-duration="400">
                        <div class="product-card h-100 p-32 border border-gray-100 rounded-16 text-center transition-2 hover-border-main-600">
                            <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                                <i class="ph ph-map-pin text-4xl text-main-600"></i>
                            </div>
                            <h4 class="text-heading mb-16">Address</h4>
                            <p class="text-gray-600 mb-0">
                                @if($settings->address ?? null)
                                    {{ $settings->address }}@if($settings->city ?? null), {{ $settings->city }}@endif<br />
                                    @if($settings->state ?? null){{ $settings->state }}@endif
                                    @if($settings->postal_code ?? null){{ $settings->postal_code }}@endif<br />
                                    @if($settings->country ?? null){{ $settings->country }}@endif
                                @else
                                    Address not configured
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-duration="600">
                        <div class="product-card h-100 p-32 border border-gray-100 rounded-16 text-center transition-2 hover-border-main-600">
                            <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                                <i class="ph ph-phone text-4xl text-main-600"></i>
                            </div>
                            <h4 class="text-heading mb-16">Phone</h4>
                            @if($settings->phone ?? null)
                                <p class="text-gray-600 mb-8">{{ $settings->phone }}</p>
                            @elseif($settings->mobile ?? null)
                                <p class="text-gray-600 mb-8">{{ $settings->mobile }}</p>
                            @else
                                <p class="text-gray-600 mb-8">Phone not configured</p>
                            @endif
                            <p class="text-sm text-gray-500 mb-0">
                                Available during business hours
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-duration="800">
                        <div class="product-card h-100 p-32 border border-gray-100 rounded-16 text-center transition-2 hover-border-main-600">
                            <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                                <i class="ph ph-envelope text-4xl text-main-600"></i>
                            </div>
                            <h4 class="text-heading mb-16">Email</h4>
                            @if($settings->email ?? null)
                                <p class="text-gray-600 mb-8">
                                    <a href="mailto:{{ $settings->email }}" class="text-main-600 text-decoration-none">{{ $settings->email }}</a>
                                </p>
                            @else
                                <p class="text-gray-600 mb-8">Email not configured</p>
                            @endif
                            <p class="text-sm text-gray-500 mb-0">
                                We'll respond within 24 hours
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-duration="1000">
                        <div class="product-card h-100 p-32 border border-gray-100 rounded-16 text-center transition-2 hover-border-main-600">
                            <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                                <i class="ph ph-clock text-4xl text-main-600"></i>
                            </div>
                            <h4 class="text-heading mb-16">Store Hours</h4>
                            @if($settings->store_hours ?? null)
                                <p class="text-gray-600 mb-0 text-sm">
                                    {!! nl2br(e($settings->store_hours)) !!}
                                </p>
                            @else
                                <p class="text-gray-600 mb-0 text-sm">
                                    Store hours not configured
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Social Media Section -->
                <div class="mt-32" data-aos="fade-up" data-aos-duration="400">
                    <div class="d-flex align-items-center gap-16 flex-wrap">
                        <h3 class="text-heading mb-0">Follow Us</h3>
                        <div class="d-flex align-items-center gap-16 flex-wrap">
                            @if($settings->facebook_url ?? null)
                            <a href="{{ $settings->facebook_url }}" target="_blank" class="w-56 h-56 text-white rounded-circle flex-center transition-2 hover-scale-110" style="background-color: #1877F2;" onmouseover="this.style.backgroundColor='#166FE5'" onmouseout="this.style.backgroundColor='#1877F2'">
                                <i class="ph-fill ph-facebook-logo text-2xl"></i>
                            </a>
                            @endif
                            @if($settings->twitter_url ?? null)
                            <a href="{{ $settings->twitter_url }}" target="_blank" class="w-56 h-56 text-white rounded-circle flex-center transition-2 hover-scale-110" style="background-color: #000000;" onmouseover="this.style.backgroundColor='#1DA1F2'" onmouseout="this.style.backgroundColor='#000000'">
                                <i class="ph-fill ph-twitter-logo text-2xl"></i>
                            </a>
                            @endif
                            @if($settings->instagram_url ?? null)
                            <a href="{{ $settings->instagram_url }}" target="_blank" class="w-56 h-56 text-white rounded-circle flex-center transition-2 hover-scale-110" style="background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                <i class="ph-fill ph-instagram-logo text-2xl"></i>
                            </a>
                            @endif
                            @if($settings->youtube_url ?? null)
                            <a href="{{ $settings->youtube_url }}" target="_blank" class="w-56 h-56 text-white rounded-circle flex-center transition-2 hover-scale-110" style="background-color: #FF0000;" onmouseover="this.style.backgroundColor='#CC0000'" onmouseout="this.style.backgroundColor='#FF0000'">
                                <i class="ph-fill ph-youtube-logo text-2xl"></i>
                            </a>
                            @endif
                            @if($settings->linkedin_url ?? null)
                            <a href="{{ $settings->linkedin_url }}" target="_blank" class="w-56 h-56 text-white rounded-circle flex-center transition-2 hover-scale-110" style="background-color: #0077B5;" onmouseover="this.style.backgroundColor='#005885'" onmouseout="this.style.backgroundColor='#0077B5'">
                                <i class="ph-fill ph-linkedin-logo text-2xl"></i>
                            </a>
                            @endif
                            @if($settings->tiktok_url ?? null)
                            <a href="{{ $settings->tiktok_url }}" target="_blank" class="w-56 h-56 text-white rounded-circle flex-center transition-2 hover-scale-110" style="background-color: #000000;" onmouseover="this.style.backgroundColor='#333333'" onmouseout="this.style.backgroundColor='#000000'">
                                <i class="ph-fill ph-tiktok-logo text-2xl"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Google Maps - Right Side -->
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="400">
                <div class="border border-gray-100 rounded-16 overflow-hidden h-100">
                    @php
                        // Build address string for Google Maps
                        $addressParts = array_filter([
                            $settings->address ?? null,
                            $settings->city ?? null,
                            $settings->state ?? null,
                            $settings->postal_code ?? null,
                            $settings->country ?? null,
                        ]);
                        $fullAddress = !empty($addressParts) ? implode(', ', $addressParts) : 'Nairobi, Kenya';
                        $encodedAddress = urlencode($fullAddress);
                    @endphp
                    <div class="position-relative" style="height: 600px; width: 100%;">
                        <iframe
                            src="https://www.google.com/maps?q={{ $encodedAddress }}&output=embed"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="position-absolute top-0 start-0 w-100 h-100">
                        </iframe>
                    </div>
                    @if($settings->address ?? null)
                    <div class="p-24 bg-gray-50 border-top border-gray-100">
                        <div class="d-flex align-items-center gap-16 flex-wrap">
                            <div class="flex-align gap-12">
                                <div class="w-48 h-48 bg-main-600 rounded-circle flex-center flex-shrink-0">
                                    <i class="ph ph-map-pin text-white text-xl"></i>
                                </div>
                                <div>
                                    <h6 class="text-heading mb-4">Our Location</h6>
                                    <p class="text-gray-600 mb-0 text-sm">
                                        {{ $settings->address }}@if($settings->city ?? null), {{ $settings->city }}@endif
                                        @if($settings->state ?? null), {{ $settings->state }}@endif
                                        @if($settings->postal_code ?? null) {{ $settings->postal_code }}@endif
                                        @if($settings->country ?? null), {{ $settings->country }}@endif
                                    </p>
                                </div>
                            </div>
                            <div class="ms-auto">
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $encodedAddress }}" target="_blank" class="btn btn-main rounded-pill px-32 flex-align gap-8">
                                    <i class="ph ph-arrow-square-out"></i> Get Directions
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="bg-gray-50 rounded-16 p-40">
            <div class="section-heading text-center mb-56">
                <h2 class="text-heading-two mb-16">Frequently Asked Questions</h2>
                <p class="text-gray-600">Common questions about our products and services</p>
            </div>
            <div class="row gy-4">
                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="400">
                    <div class="product-card h-100 p-24 border border-gray-100 rounded-16 bg-white">
                        <h4 class="text-lg fw-semibold text-heading mb-12">Do you deliver everywhere in Kenya?</h4>
                        <p class="text-gray-600 mb-0">
                            We deliver within Nairobi same-day and countrywide through courier partners.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="600">
                    <div class="product-card h-100 p-24 border border-gray-100 rounded-16 bg-white">
                        <h4 class="text-lg fw-semibold text-heading mb-12">What are your delivery charges?</h4>
                        <p class="text-gray-600 mb-0">
                            Delivery fees vary by location. Some Nairobi orders qualify for free delivery.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="800">
                    <div class="product-card h-100 p-24 border border-gray-100 rounded-16 bg-white">
                        <h4 class="text-lg fw-semibold text-heading mb-12">What payment methods do you accept?</h4>
                        <p class="text-gray-600 mb-0">
                            We accept M-Pesa, cards, bank transfer, and cash on delivery (selected areas).
                        </p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                    <div class="product-card h-100 p-24 border border-gray-100 rounded-16 bg-white">
                        <h4 class="text-lg fw-semibold text-heading mb-12">Do I need to be 18+ to order?</h4>
                        <p class="text-gray-600 mb-0">
                            Yes. ID verification may be required upon delivery.
                        </p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-40">
                <a href="{{ route('faq') }}" class="btn btn-outline-main rounded-pill px-48">
                    View All FAQs <i class="ph ph-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- ============================ Contact Section End =============================== -->

@endsection
