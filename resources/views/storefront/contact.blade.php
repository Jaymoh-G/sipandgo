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

        <div class="row gy-4 mb-80">
            <!-- Contact Information -->
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="400">
                <h3 class="text-heading mb-32">Get in Touch</h3>

                <div class="d-flex flex-column gap-24">
                    <div class="d-flex align-items-start gap-16">
                        <div class="w-64 h-64 bg-main-50 rounded-circle flex-center flex-shrink-0">
                            <i class="ph ph-map-pin text-2xl text-main-600"></i>
                        </div>
                        <div>
                            <h4 class="text-lg fw-semibold text-heading mb-8">Address</h4>
                            <p class="text-gray-600 mb-0">
                                123 Premium Spirits Lane<br />
                                Beverage City, BC 12345<br />
                                United States
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-16">
                        <div class="w-64 h-64 bg-main-50 rounded-circle flex-center flex-shrink-0">
                            <i class="ph ph-phone text-2xl text-main-600"></i>
                        </div>
                        <div>
                            <h4 class="text-lg fw-semibold text-heading mb-8">Phone</h4>
                            <p class="text-gray-600 mb-4">(555) 123-SIP (747)</p>
                            <p class="text-sm text-gray-500 mb-0">
                                Mon-Fri: 9AM-6PM EST
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-16">
                        <div class="w-64 h-64 bg-main-50 rounded-circle flex-center flex-shrink-0">
                            <i class="ph ph-envelope text-2xl text-main-600"></i>
                        </div>
                        <div>
                            <h4 class="text-lg fw-semibold text-heading mb-8">Email</h4>
                            <p class="text-gray-600 mb-4">info@sipandgo.com</p>
                            <p class="text-sm text-gray-500 mb-0">
                                We'll respond within 24 hours
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-16">
                        <div class="w-64 h-64 bg-main-50 rounded-circle flex-center flex-shrink-0">
                            <i class="ph ph-clock text-2xl text-main-600"></i>
                        </div>
                        <div>
                            <h4 class="text-lg fw-semibold text-heading mb-8">Store Hours</h4>
                            <p class="text-gray-600 mb-0">
                                Monday - Friday: 9:00 AM - 8:00 PM<br />
                                Saturday: 10:00 AM - 6:00 PM<br />
                                Sunday: 12:00 PM - 5:00 PM
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="mt-40">
                    <h4 class="text-lg fw-semibold text-heading mb-24">Follow Us</h4>
                    <div class="d-flex align-items-center gap-16">
                        @if($settings->facebook_url ?? null)
                        <a href="{{ $settings->facebook_url }}" target="_blank" class="w-48 h-48 text-white rounded-circle flex-center transition-2" style="background-color: #1877F2;" onmouseover="this.style.backgroundColor='#166FE5'" onmouseout="this.style.backgroundColor='#1877F2'">
                            <i class="ph-fill ph-facebook-logo text-xl"></i>
                        </a>
                        @endif
                        @if($settings->twitter_url ?? null)
                        <a href="{{ $settings->twitter_url }}" target="_blank" class="w-48 h-48 text-white rounded-circle flex-center transition-2" style="background-color: #000000;" onmouseover="this.style.backgroundColor='#1DA1F2'" onmouseout="this.style.backgroundColor='#000000'">
                            <i class="ph-fill ph-twitter-logo text-xl"></i>
                        </a>
                        @endif
                        @if($settings->instagram_url ?? null)
                        <a href="{{ $settings->instagram_url }}" target="_blank" class="w-48 h-48 text-white rounded-circle flex-center transition-2" style="background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                            <i class="ph-fill ph-instagram-logo text-xl"></i>
                        </a>
                        @endif
                        @if($settings->youtube_url ?? null)
                        <a href="{{ $settings->youtube_url }}" target="_blank" class="w-48 h-48 text-white rounded-circle flex-center transition-2" style="background-color: #FF0000;" onmouseover="this.style.backgroundColor='#CC0000'" onmouseout="this.style.backgroundColor='#FF0000'">
                            <i class="ph-fill ph-youtube-logo text-xl"></i>
                        </a>
                        @endif
                        @if($settings->linkedin_url ?? null)
                        <a href="{{ $settings->linkedin_url }}" target="_blank" class="w-48 h-48 text-white rounded-circle flex-center transition-2" style="background-color: #0077B5;" onmouseover="this.style.backgroundColor='#005885'" onmouseout="this.style.backgroundColor='#0077B5'">
                            <i class="ph-fill ph-linkedin-logo text-xl"></i>
                        </a>
                        @endif
                        @if($settings->tiktok_url ?? null)
                        <a href="{{ $settings->tiktok_url }}" target="_blank" class="w-48 h-48 text-white rounded-circle flex-center transition-2" style="background-color: #000000;" onmouseover="this.style.backgroundColor='#333333'" onmouseout="this.style.backgroundColor='#000000'">
                            <i class="ph-fill ph-tiktok-logo text-xl"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="400">
                <div class="product-card h-100 p-32 border border-gray-100 rounded-16">
                    <h3 class="text-heading mb-32">Send us a Message</h3>

                    <form action="#" method="POST" class="d-flex flex-column gap-24">
                        @csrf
                        <div class="row gy-24">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label text-gray-900 fw-medium mb-8">First Name</label>
                                <input type="text" id="first_name" name="first_name" required class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600">
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label text-gray-900 fw-medium mb-8">Last Name</label>
                                <input type="text" id="last_name" name="last_name" required class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="form-label text-gray-900 fw-medium mb-8">Email Address</label>
                            <input type="email" id="email" name="email" required class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600">
                        </div>

                        <div>
                            <label for="phone" class="form-label text-gray-900 fw-medium mb-8">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600">
                        </div>

                        <div>
                            <label for="subject" class="form-label text-gray-900 fw-medium mb-8">Subject</label>
                            <select id="subject" name="subject" required class="form-select common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600">
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="order">Order Question</option>
                                <option value="product">Product Information</option>
                                <option value="shipping">Shipping & Delivery</option>
                                <option value="returns">Returns & Exchanges</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="form-label text-gray-900 fw-medium mb-8">Message</label>
                            <textarea id="message" name="message" rows="6" required class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600" placeholder="Tell us how we can help you..."></textarea>
                        </div>

                        <div>
                            <label for="year_of_birth" class="form-label text-gray-900 fw-medium mb-8 d-block">Year of Birth *</label>
                            <select id="year_of_birth"
                                   name="year_of_birth"
                                   required
                                   class="form-select common-input border-gray-100 @error('year_of_birth') border-danger-500 @enderror">
                                <option value="">Select Year of Birth</option>
                                @for($year = date('Y') - 18; $year >= date('Y') - 100; $year--)
                                    <option value="{{ $year }}" {{ old('year_of_birth') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                            <p class="text-xs text-gray-500 mt-8">You must be 18 years or older to contact us</p>
                            @error('year_of_birth')
                            <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-main rounded-pill w-100 d-inline-flex align-items-center justify-content-center gap-8">
                            Send Message <i class="ph ph-paper-plane-tilt"></i>
                        </button>
                    </form>
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
