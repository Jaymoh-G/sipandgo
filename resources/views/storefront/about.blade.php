@extends('storefront.layout')

@section('title', 'About Us - Sip & Go')
@section('description', 'Learn about Sip & Go, your premier destination for premium spirits, wine, and craft beverages')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">About Us</h6>
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
                    About Us
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ============================ About Section Start =============================== -->
<section class="about py-80">
    <div class="container container-lg">
        <!-- Header -->
        <div class="section-heading text-center mb-56">
            <h2 class="text-heading-two mb-16">About Sip & Go</h2>
            <p class="text-gray-600 max-w-700 mx-auto">
                Your premier destination for premium spirits, wine, and craft beverages.
                We're passionate about bringing you the world's finest liquors with exceptional service.
            </p>
        </div>

        <!-- Story Section -->
        <div class="row align-items-center mb-80">
            <div class="col-lg-6 mb-32 mb-lg-0" data-aos="fade-right" data-aos-duration="400">
                <h3 class="text-heading mb-24">Our Story</h3>
                <p class="text-gray-600 text-lg mb-24">
                    Founded with a passion for exceptional spirits, Sip & Go has been curating the world's finest
                    collection of premium liquors for discerning customers. Our journey began with a simple mission:
                    to make exceptional spirits accessible to everyone.
                </p>
                <p class="text-gray-600 text-lg mb-24">
                    Today, we're proud to offer an extensive selection of whiskey, vodka, rum, tequila, gin, wine,
                    and more, all carefully selected for their quality and character.
                </p>
                <a href="{{ route('products.index') }}" class="btn btn-main rounded-pill d-inline-flex align-items-center gap-8">
                    Explore Our Collection <i class="ph ph-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="400">
                <div class="bg-main-50 rounded-16 p-40 h-100 flex-center">
                    <div class="text-center">
                        <i class="ph ph-wine text-9xl text-main-600 mb-16 d-inline-flex"></i>
                        <h4 class="text-heading mb-8">Premium Selection</h4>
                        <p class="text-gray-600">Curated by experts, for connoisseurs</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="mb-80">
            <div class="section-heading text-center mb-56">
                <h2 class="text-heading-two mb-16">Our Values</h2>
                <p class="text-gray-600">What drives us every day</p>
            </div>
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="400">
                    <div class="product-card h-100 p-32 border border-gray-100 rounded-16 text-center transition-2 hover-border-main-600">
                        <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                            <i class="ph ph-star text-4xl text-main-600"></i>
                        </div>
                        <h4 class="text-heading mb-16">Quality First</h4>
                        <p class="text-gray-600">
                            We carefully curate every product in our collection, ensuring only the finest spirits
                            make it to our shelves.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="600">
                    <div class="product-card h-100 p-32 border border-gray-100 rounded-16 text-center transition-2 hover-border-main-600">
                        <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                            <i class="ph ph-users text-4xl text-main-600"></i>
                        </div>
                        <h4 class="text-heading mb-16">Customer Service</h4>
                        <p class="text-gray-600">
                            Our knowledgeable team is here to help you find the perfect spirit for any occasion
                            or preference.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800">
                    <div class="product-card h-100 p-32 border border-gray-100 rounded-16 text-center transition-2 hover-border-main-600">
                        <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                            <i class="ph ph-shield-check text-4xl text-main-600"></i>
                        </div>
                        <h4 class="text-heading mb-16">Responsible Service</h4>
                        <p class="text-gray-600">
                            We promote responsible consumption and ensure all customers meet legal age requirements
                            for alcohol purchase.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ============================ About Section End =============================== -->

@endsection
