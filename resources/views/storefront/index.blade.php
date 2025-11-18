@extends('storefront.layout')
@section('title', 'Sip & Go - Premium Liquor Store')
@section('description', 'Premium liquor store offering the finest selection of whiskey, vodka, rum, tequila, gin, wine, and more. Age verification required.')
@section('content')

<!-- ============================ Banner Section start =============================== -->
<div class="banner">
    <div class="container container-lg">
        <div class="banner-item rounded-24 overflow-hidden position-relative arrow-center">
            <a href="#featureSection" class="scroll-down w-84 h-84 text-center flex-center bg-main-600 rounded-circle border border-5 text-white border-white position-absolute start-50 translate-middle-x bottom-0 hover-bg-main-800">
                <span class="icon line-height-0"><i class="ph ph-caret-double-down"></i></span>
            </a>
            @if($sliders->isNotEmpty())
                @if($sliders->first()->background_image)
                    <img src="{{ asset('storage/' . $sliders->first()->background_image) }}" alt="" class="banner-img position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1 object-fit-cover rounded-24">
                @else
                    <img src="{{ asset('assets/images/bg/banner-bg.png') }}" alt="" class="banner-img position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1 object-fit-cover rounded-24">
                @endif

                <div class="flex-align">
                    <button type="button" id="banner-prev" class="slick-prev slick-arrow flex-center rounded-circle box-shadow-4xl bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                        <i class="ph ph-caret-left"></i>
                    </button>
                    <button type="button" id="banner-next" class="slick-next slick-arrow flex-center rounded-circle box-shadow-4xl bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                        <i class="ph ph-caret-right"></i>
                    </button>
                </div>

                <div class="banner-slider">
                    @foreach($sliders as $slider)
                    <div class="banner-slider__item">
                        <div class="banner-slider__inner flex-between position-relative">
                            <div class="banner-item__content">
                                @if($slider->subtitle)
                                <span class="fw-semibold text-success-600 text-capitalize mb-8 animate-left-right animation-delay-08">{{ $slider->subtitle }}</span>
                                @endif
                                <h2 class="banner-item__title max-w-700 mb-30 animate-left-right animation-delay-1">{!! $slider->title !!}</h2>
                                <div class="d-flex align-items-center gap-16 animate-left-right animation-delay-12">
                                    @if($slider->button_text && $slider->button_link)
                                    <a href="{{ $slider->button_link }}" class="btn btn-main d-inline-flex align-items-center rounded-pill gap-8">
                                        {{ $slider->button_text }} <span class="icon text-xl d-flex"><i class="ph ph-shopping-cart-simple"></i></span>
                                    </a>
                                    @endif
                                    @if($slider->price_text)
                                    <div class="d-flex align-items-end gap-8">
                                        <span class="text-heading fst-italic text-sm text-white">Starting at</span>
                                        <h6 class="text-danger-600 mb-0 fw-bold" style="font-size: 1.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">{{ $slider->price_text }}</h6>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @if($slider->image)
                            <div class="banner-item__thumb animate-scale animation-delay-12">
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}">
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                {{-- Fallback to default slider if no sliders in database --}}
                <img src="{{ asset('assets/images/bg/banner-bg.png') }}" alt="" class="banner-img position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 z-n1 object-fit-cover rounded-24">

                <div class="flex-align">
                    <button type="button" id="banner-prev" class="slick-prev slick-arrow flex-center rounded-circle box-shadow-4xl bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                        <i class="ph ph-caret-left"></i>
                    </button>
                    <button type="button" id="banner-next" class="slick-next slick-arrow flex-center rounded-circle box-shadow-4xl bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                        <i class="ph ph-caret-right"></i>
                    </button>
                </div>

                <div class="banner-slider">
                    <div class="banner-slider__item">
                        <div class="banner-slider__inner flex-between position-relative">
                            <div class="banner-item__content">
                                <span class="fw-semibold text-success-600 text-capitalize mb-8 animate-left-right animation-delay-08">Save up to 50% off on your first order</span>
                                <h2 class="banner-item__title max-w-700 mb-30 animate-left-right animation-delay-1">Premium Liquor Store and Get <span class="text-main-600">Express</span> Delivery</h2>
                                <div class="d-flex align-items-center gap-16 animate-left-right animation-delay-12">
                                    <a href="{{ route('products.index') }}" class="btn btn-main d-inline-flex align-items-center rounded-pill gap-8">
                                        Explore Shop <span class="icon text-xl d-flex"><i class="ph ph-shopping-cart-simple"></i></span>
                                    </a>
                                    <div class="d-flex align-items-end gap-8">
                                        <span class="text-heading fst-italic text-sm">Starting at</span>
                                        <h6 class="text-danger-600 mb-0">Ksh 29.99</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="banner-item__thumb animate-scale animation-delay-12">
                                <img src="{{ asset('assets/images/thumbs/banner-img3.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- ============================ Banner Section End =============================== -->

<!-- ============================ Feature Section start =============================== -->
<div class="feature" id="featureSection">
    <div class="container container-lg">
        <div class="position-relative arrow-center gradient-shadow">
            <div class="flex-align">
                <button type="button" id="feature-item-wrapper-prev" class="slick-prev slick-arrow flex-center rounded-circle bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-left"></i>
                </button>
                <button type="button" id="feature-item-wrapper-next" class="slick-next slick-arrow flex-center rounded-circle bg-white text-xl hover-bg-main-600 hover-text-white transition-1">
                    <i class="ph ph-caret-right"></i>
                </button>
            </div>
            <div class="feature-item-wrapper">
                @forelse($categories as $index => $category)
                <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="{{ 400 + ($index * 200) }}">
                    <div class="feature-item__thumb rounded-circle">
                        <a href="{{ route('categories.show', $category->slug ?? $category) }}" class="w-100 h-100 flex-center">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-100 h-100 object-fit-cover rounded-circle">
                            @else
                                <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="{{ $category->name }}">
                            @endif
                        </a>
                    </div>
                    <div class="feature-item__content mt-16">
                        <h6 class="text-lg mb-8">
                            <a href="{{ route('categories.show', $category->slug ?? $category) }}" class="text-inherit">{{ $category->name }}</a>
                        </h6>
                        <span class="text-sm text-gray-400">
                            @if($category->products_count > 0)
                                {{ $category->products_count }} {{ Str::plural('Product', $category->products_count) }}
                            @else
                                Premium Collection
                            @endif
                        </span>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-40">
                    <p class="text-gray-600">No categories available at the moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- ============================ Feature Section End =============================== -->

<!-- ============================ Deal of the Week Section Start =============================== -->
<section class="deal py-80 bg-gray-50">
    <div class="container container-lg">
        <div class="section-heading text-center mb-56">
            <h2 class="text-heading-two mb-16">Deal of The Week</h2>
            <p class="text-gray-600">Limited time offers on premium spirits</p>
        </div>

        <div class="row gy-4">
            @foreach($featuredProducts->take(4) as $product)
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="400">
                <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2 bg-white">
                    <a href="{{ route('products.show', $product->slug) }}" class="product-card__thumb flex-center rounded-8 bg-gray-50 position-relative overflow-hidden">
                        @if($product->is_on_sale)
                        <span class="product-card__badge bg-main-600 px-8 py-4 text-sm text-white position-absolute inset-inline-start-0 inset-block-start-0 z-1">
                            {{ $product->discount_percentage }}% OFF
                        </span>
                        @endif
                        @if($product->is_featured)
                        <span class="product-card__badge bg-success-600 px-8 py-4 text-sm text-white position-absolute inset-inline-end-0 inset-block-start-0 z-1">
                            Best Seller
                        </span>
                        @endif
                        @if($product->primary_image_url)
                            <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <div class="w-100 h-100 flex-center">
                                <i class="ph ph-wine-bottle text-6xl text-gray-400"></i>
                            </div>
                        @endif
                    </a>
                    <div class="product-card__content mt-16">
                        <div class="flex-align mb-12 gap-6">
                            <span class="text-xs fw-medium text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</span>
                        </div>
                        <h6 class="title text-lg fw-semibold mt-12 mb-8">
                            <a href="{{ route('products.show', $product->slug) }}" class="link text-line-2 hover-text-main-600">{{ $product->name }} <span class="text-gray-500">({{ $product->quantity ?? 0 }})</span></a>
                        </h6>
                        @if($product->short_description)
                        <p class="text-gray-600 text-sm mb-12">
                            {{ Str::limit($product->short_description, 80) }}
                        </p>
                        @endif
                        <div class="product-card__price my-12 d-flex align-items-center gap-8">
                            <span class="text-heading text-md fw-semibold">{{ $product->formatted_price }}</span>
                            @if($product->compare_price && $product->is_on_sale)
                                <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">Ksh {{ number_format($product->compare_price, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex-align gap-8">
                            @if($product->isInStock())
                            <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 px-24 rounded-8 flex-center gap-8 fw-medium w-100">
                                    <i class="ph ph-shopping-cart-simple"></i> Add to Cart
                                </button>
                            </form>
                            @if(in_array($product->id, $wishlistItems ?? []))
                            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-48 h-48 bg-main-600 text-white hover-bg-main-800 hover-text-white flex-center rounded-8 border-0" title="Remove from Wishlist">
                                    <i class="ph ph-heart-fill" style="color: #ffffff !important; fill: #ffffff !important;"></i>
                                </button>
                            </form>
                            @else
                            <form action="{{ route('wishlist.add') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="w-48 h-48 bg-gray-50 text-heading hover-bg-main-600 hover-text-white flex-center rounded-8 border-0" title="Add to Wishlist">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </form>
                            @endif
                            @else
                            <button type="button" class="product-card__cart btn bg-gray-100 text-gray-400 py-11 px-24 rounded-8 flex-center gap-8 fw-medium w-100 cursor-not-allowed" disabled>
                                Out of Stock
                            </button>
                            <button type="button" class="w-48 h-48 bg-gray-100 text-gray-400 flex-center rounded-8 border-0 cursor-not-allowed" title="Out of Stock" disabled>
                                <i class="ph ph-heart"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-40">
            <a href="{{ route('products.index') }}" class="btn btn-main rounded-pill d-inline-flex align-items-center gap-8">
                View All Deals <i class="ph ph-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<!-- ============================ Deal of the Week Section End =============================== -->

<!-- ============================ Featured Products Section Start =============================== -->
<section class="featured-products py-80">
    <div class="container container-lg">
        <div class="section-heading text-center mb-56">
            <h2 class="text-heading-two mb-16">Featured Products</h2>
            <p class="text-gray-600">Handpicked premium selections from our collection</p>
        </div>

        <div class="row gy-4">
            @foreach($featuredProducts as $product)
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="400">
                <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2 d-flex flex-column">
                    <a href="{{ route('products.show', $product->slug) }}" class="product-card__thumb flex-center rounded-8 bg-gray-50 position-relative overflow-hidden mb-16" style="height: 250px; width: 100%;">
                        @if($product->is_on_sale)
                        <span class="product-card__badge bg-main-600 px-8 py-4 text-sm text-white position-absolute inset-inline-start-0 inset-block-start-0 z-1">
                            {{ $product->discount_percentage }}% OFF
                        </span>
                        @endif
                        @if($product->primary_image_url)
                            <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <div class="w-100 h-100 flex-center">
                                <i class="ph ph-wine-bottle text-6xl text-gray-400"></i>
                            </div>
                        @endif
                    </a>
                    <div class="product-card__content flex-grow-1 d-flex flex-column">
                        <div class="flex-align mb-12 gap-6">
                            <span class="text-xs fw-medium text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</span>
                        </div>
                        <h6 class="title text-lg fw-semibold mt-12 mb-8">
                            <a href="{{ route('products.show', $product->slug) }}" class="link text-line-2 hover-text-main-600">{{ $product->name }} <span class="text-gray-500">({{ $product->quantity ?? 0 }})</span></a>
                        </h6>
                        @if($product->short_description)
                        <p class="text-gray-600 text-sm mb-12">
                            {{ Str::limit($product->short_description, 80) }}
                        </p>
                        @endif
                        <div class="product-card__price my-12 d-flex align-items-center gap-8">
                            <span class="text-heading text-md fw-semibold">{{ $product->formatted_price }}</span>
                            @if($product->compare_price && $product->is_on_sale)
                                <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">Ksh {{ number_format($product->compare_price, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex-align gap-8">
                            @if($product->isInStock())
                            <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 px-24 rounded-8 flex-center gap-8 fw-medium w-100">
                                    <i class="ph ph-shopping-cart-simple"></i> Add to Cart
                                </button>
                            </form>
                            @if(in_array($product->id, $wishlistItems ?? []))
                            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-48 h-48 bg-main-600 text-white hover-bg-main-800 hover-text-white flex-center rounded-8 border-0" title="Remove from Wishlist">
                                    <i class="ph ph-heart-fill" style="color: #ffffff !important; fill: #ffffff !important;"></i>
                                </button>
                            </form>
                            @else
                            <form action="{{ route('wishlist.add') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="w-48 h-48 bg-gray-50 text-heading hover-bg-main-600 hover-text-white flex-center rounded-8 border-0" title="Add to Wishlist">
                                    <i class="ph ph-heart"></i>
                                </button>
                            </form>
                            @endif
                            @else
                            <button type="button" class="product-card__cart btn bg-gray-100 text-gray-400 py-11 px-24 rounded-8 flex-center gap-8 fw-medium w-100 cursor-not-allowed" disabled>
                                Out of Stock
                            </button>
                            <button type="button" class="w-48 h-48 bg-gray-100 text-gray-400 flex-center rounded-8 border-0 cursor-not-allowed" title="Out of Stock" disabled>
                                <i class="ph ph-heart"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-40">
            <a href="{{ route('products.index') }}" class="btn btn-main rounded-pill d-inline-flex align-items-center gap-8">
                View All Products <i class="ph ph-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<!-- ============================ Featured Products Section End =============================== -->

<!-- ============================ Newsletter Section Start =============================== -->
<section class="newsletter py-80 bg-main-600">
    <div class="container container-lg">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-32 mb-lg-0" data-aos="fade-right" data-aos-duration="400">
                <div class="d-flex align-items-center gap-16 mb-24">
                    <div class="w-80 h-80 bg-white bg-opacity-20 rounded-circle flex-center flex-shrink-0">
                        <i class="ph ph-envelope-simple text-4xl text-white"></i>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-heading-two text-white mb-8">Join Our Newsletter</h2>
                        <p class="text-white text-lg mb-24">Get 10% off your first order</p>
                        <div class="d-flex flex-column gap-16">
                            <div class="d-flex align-items-center gap-12">
                                <i class="ph ph-check-circle text-2xl text-white"></i>
                                <span class="text-white">Exclusive deals and discounts</span>
                            </div>
                            <div class="d-flex align-items-center gap-12">
                                <i class="ph ph-check-circle text-2xl text-white"></i>
                                <span class="text-white">New product announcements</span>
                            </div>
                            <div class="d-flex align-items-center gap-12">
                                <i class="ph ph-check-circle text-2xl text-white"></i>
                                <span class="text-white">Premium spirits recommendations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="400">
                <div class="bg-white rounded-24 p-40 box-shadow-lg">
                    <h3 class="text-heading mb-16 text-center">Subscribe Now</h3>
                    <p class="text-gray-600 text-center mb-32">
                        Stay updated with our latest premium spirits and exclusive offers
                    </p>
                    <form action="#" method="POST" class="d-flex flex-column gap-16">
                        @csrf
                        <div class="position-relative">
                            <i class="ph ph-envelope position-absolute start-0 top-50 translate-middle-y ms-24 text-gray-400 text-xl"></i>
                            <input type="email" name="email" placeholder="Enter your email address" required class="form-control common-input ps-64 pe-24 py-16 rounded-pill border border-gray-200 focus-border-main-600 w-100" />
                        </div>
                        <button type="submit" class="btn btn-main rounded-pill w-100 py-16 fw-semibold d-flex align-items-center justify-content-center gap-8">
                            <i class="ph ph-paper-plane-tilt"></i> Subscribe Now
                        </button>
                        <p class="text-sm text-gray-500 text-center mb-0">
                            <i class="ph ph-lock-key"></i> We respect your privacy. Unsubscribe at any time.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ============================ Newsletter Section End =============================== -->

<!-- ============================ Features Section Start =============================== -->
<section class="features py-80 bg-white">
    <div class="container container-lg">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="400">
                <div class="text-center">
                    <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                        <i class="ph ph-truck text-3xl text-main-600"></i>
                    </div>
                    <h4 class="text-heading mb-12">Free Shipping</h4>
                    <p class="text-gray-600 mb-0">Free shipping all over the US</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="600">
                <div class="text-center">
                    <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                        <i class="ph ph-check-circle text-3xl text-main-600"></i>
                    </div>
                    <h4 class="text-heading mb-12">100% Satisfaction</h4>
                    <p class="text-gray-600 mb-0">Quality guarantee on all products</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="800">
                <div class="text-center">
                    <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                        <i class="ph ph-shield-check text-3xl text-main-600"></i>
                    </div>
                    <h4 class="text-heading mb-12">Secure Payments</h4>
                    <p class="text-gray-600 mb-0">Safe and encrypted transactions</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1000">
                <div class="text-center">
                    <div class="w-80 h-80 bg-main-50 rounded-circle flex-center mx-auto mb-24">
                        <i class="ph ph-headphones text-3xl text-main-600"></i>
                    </div>
                    <h4 class="text-heading mb-12">24/7 Support</h4>
                    <p class="text-gray-600 mb-0">Round-the-clock customer service</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ============================ Features Section End =============================== -->

@push('styles')
<style>
    /* Slider image dimensions */
    .banner-item {
        min-height: 450px !important;
        height: 490px !important;
        padding-bottom: 40px !important;
        overflow: visible !important;
    }

    .banner .banner-img {
        width: 100% !important;
        height: 490px !important;
        min-height: 490px !important;
        max-height: 490px !important;
        object-fit: cover !important;
        object-position: center bottom !important;
        bottom: -40px !important;
        top: auto !important;
    }

    .banner-item__thumb {
        max-width: 400px !important;
        width: 100% !important;
        height: auto !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .banner-item__thumb img {
        width: 100% !important;
        height: auto !important;
        max-width: 400px !important;
        max-height: 400px !important;
        object-fit: contain !important;
        object-position: center !important;
    }

    @media (max-width: 992px) {
        .banner-item {
            min-height: 400px !important;
            height: 430px !important;
            padding-bottom: 30px !important;
        }

        .banner .banner-img {
            height: 430px !important;
            min-height: 430px !important;
            max-height: 430px !important;
            object-position: center bottom !important;
            bottom: -30px !important;
        }

        .banner-item__thumb {
            max-width: 350px !important;
        }

        .banner-item__thumb img {
            max-width: 350px !important;
            max-height: 350px !important;
        }
    }

    @media (max-width: 768px) {
        .banner {
            margin-bottom: 40px !important;
            padding-bottom: 0 !important;
        }

        .banner-item {
            min-height: 350px !important;
            height: auto !important;
            padding-bottom: 20px !important;
            margin-bottom: 30px !important;
            overflow: hidden !important;
        }

        .banner .banner-img {
            height: 370px !important;
            min-height: 370px !important;
            max-height: 370px !important;
            object-position: center bottom !important;
            bottom: 0 !important;
        }

        /* Make slider inner stack with image first, price on left, content below */
        .banner-slider__inner {
            flex-direction: column !important;
            align-items: center !important;
            gap: 15px !important;
            padding: 20px 10px !important;
            position: relative !important;
        }

        /* Image container - first, with price positioned to its left */
        .banner-item__thumb {
            max-width: 200px !important;
            width: 100% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            order: 1 !important;
            position: relative !important;
            z-index: 2 !important;
            margin: 0 auto 15px !important;
        }

        .banner-item__thumb img {
            max-width: 200px !important;
            max-height: 200px !important;
            width: auto !important;
            height: auto !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Content container - below image */
        .banner-item__content {
            width: 100% !important;
            max-width: 100% !important;
            text-align: center !important;
            order: 2 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            position: relative !important;
        }

        /* Price wrapper - extract price and position it to left of image */
        .banner-item__content > .d-flex.align-items-center.gap-16 {
            position: absolute !important;
            top: -80px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            width: 100% !important;
            max-width: 300px !important;
            justify-content: flex-start !important;
            padding-left: 0 !important;
            z-index: 3 !important;
            order: 0 !important;
        }

        /* Price positioned to the left of image */
        .banner-item__content .d-flex.align-items-end.gap-8 {
            position: absolute !important;
            left: -90px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            z-index: 4 !important;
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 4px !important;
            white-space: nowrap !important;
        }

        .banner-item__content .d-flex.align-items-end.gap-8 span {
            font-size: 0.7rem !important;
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .banner-item__content .d-flex.align-items-end.gap-8 h6 {
            font-size: 1.1rem !important;
        }

        /* Hide button from price wrapper */
        .banner-item__content > .d-flex.align-items-center.gap-16 .btn {
            display: none !important;
        }

        /* Title and subtitle */
        .banner-item__content > .fw-semibold {
            order: 1 !important;
            text-align: center !important;
            margin-bottom: 8px !important;
        }

        .banner-item__content > .banner-item__title {
            order: 2 !important;
            text-align: center !important;
            margin-bottom: 15px !important;
        }

        /* Button - show separately below title */
        .banner-item__content .btn {
            order: 3 !important;
            margin: 0 auto !important;
            display: inline-flex !important;
        }

        /* Ensure feature section has proper spacing on mobile */
        .feature {
            margin-top: 40px !important;
            padding-top: 40px !important;
        }

        .feature .container {
            padding-top: 20px !important;
        }
    }

    @media (max-width: 576px) {
        .banner {
            margin-bottom: 30px !important;
        }

        .banner-item {
            min-height: 300px !important;
            height: auto !important;
            padding-bottom: 15px !important;
            margin-bottom: 25px !important;
        }

        .banner .banner-img {
            height: 320px !important;
            min-height: 320px !important;
            max-height: 320px !important;
            bottom: 0 !important;
        }

        .banner-slider__inner {
            gap: 15px !important;
            padding: 15px 5px !important;
        }

        .banner-item__content {
            padding: 0 10px !important;
        }

        .banner-item__title {
            font-size: 1.5rem !important;
            margin-bottom: 15px !important;
        }

        .banner-item__thumb {
            max-width: 180px !important;
            width: 100% !important;
        }

        .banner-item__thumb img {
            max-width: 180px !important;
            max-height: 180px !important;
            width: auto !important;
            height: auto !important;
        }

        /* Adjust price position for smaller screens */
        .banner-item__content .d-flex.align-items-end.gap-8 {
            left: -70px !important;
        }

        .banner-item__content .d-flex.align-items-end.gap-8 span {
            font-size: 0.65rem !important;
        }

        .banner-item__content .d-flex.align-items-end.gap-8 h6 {
            font-size: 1rem !important;
        }

        .feature {
            margin-top: 30px !important;
            padding-top: 30px !important;
        }
    }

    /* Ensure banner slider arrows are visible and functional */
    .banner .slick-arrow {
        position: absolute !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        z-index: 10 !important;
        width: 48px !important;
        height: 48px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background-color: rgba(255, 255, 255, 0.95) !important;
        border: none !important;
        border-radius: 50% !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .banner .slick-arrow:hover {
        background-color: var(--main-600) !important;
        color: #ffffff !important;
        transform: translateY(-50%) scale(1.1) !important;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25) !important;
    }

    .banner .slick-arrow:active {
        transform: translateY(-50%) scale(0.95) !important;
    }

    .banner #banner-prev {
        left: 20px !important;
        right: auto !important;
    }

    .banner #banner-next {
        right: 20px !important;
        left: auto !important;
    }

    .banner .slick-arrow i {
        font-size: 20px !important;
        color: var(--main-600) !important;
        transition: color 0.3s ease !important;
    }

    .banner .slick-arrow:hover i {
        color: #ffffff !important;
    }

    .banner .slick-arrow.slick-disabled {
        opacity: 0.5 !important;
        cursor: not-allowed !important;
    }

    @media (max-width: 768px) {
        .banner .slick-arrow {
            width: 40px !important;
            height: 40px !important;
        }

        .banner #banner-prev {
            left: 10px !important;
        }

        .banner #banner-next {
            right: 10px !important;
        }

        .banner .slick-arrow i {
            font-size: 18px !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Ensure banner slider arrows are properly initialized
    document.addEventListener('DOMContentLoaded', function() {
        // Wait for slick to initialize, then ensure arrows are visible
        setTimeout(function() {
            const bannerSlider = $('.banner-slider');
            if (bannerSlider.length && typeof bannerSlider.slick === 'function') {
                // Reinitialize if needed to ensure arrows work
                if (!bannerSlider.hasClass('slick-initialized')) {
                    bannerSlider.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 4000,
                        speed: 1000,
                        dots: false,
                        pauseOnHover: true,
                        fade: true,
                        cssEase: 'linear',
                        arrows: true,
                        draggable: true,
                        infinite: true,
                        nextArrow: '#banner-next',
                        prevArrow: '#banner-prev',
                    });
                }

                // Ensure arrows are visible
                $('#banner-prev, #banner-next').css({
                    'display': 'flex',
                    'visibility': 'visible',
                    'opacity': '1'
                });
            }
        }, 100);
    });

    // Simple countdown timer
    function updateCountdown() {
        const now = new Date().getTime();
        const endTime = now + 35 * 24 * 60 * 60 * 1000 + 14 * 60 * 60 * 1000 + 54 * 60 * 1000 + 28 * 1000;

        const timer = setInterval(function () {
            const now = new Date().getTime();
            const distance = endTime - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const daysEl = document.querySelector('.days');
            const hoursEl = document.querySelector('.hours');
            const minutesEl = document.querySelector('.minutes');
            const secondsEl = document.querySelector('.seconds');

            if (daysEl) daysEl.innerHTML = days;
            if (hoursEl) hoursEl.innerHTML = hours;
            if (minutesEl) minutesEl.innerHTML = minutes;
            if (secondsEl) secondsEl.innerHTML = seconds;

            if (distance < 0) {
                clearInterval(timer);
                if (daysEl) daysEl.innerHTML = "0";
                if (hoursEl) hoursEl.innerHTML = "0";
                if (minutesEl) minutesEl.innerHTML = "0";
                if (secondsEl) secondsEl.innerHTML = "0";
            }
        }, 1000);
    }

    // Start countdown when page loads
    document.addEventListener("DOMContentLoaded", updateCountdown);

    // Ensure category slider auto-plays
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const featureSlider = $('.feature-item-wrapper');
            if (featureSlider.length && typeof featureSlider.slick === 'function') {
                // Check if already initialized
                if (featureSlider.hasClass('slick-initialized')) {
                    // Reinitialize with autoplay enabled
                    featureSlider.slick('unslick');
                }

                // Initialize with autoplay
                featureSlider.slick({
                    slidesToShow: 10,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    speed: 800,
                    dots: false,
                    pauseOnHover: true,
                    arrows: true,
                    draggable: true,
                    infinite: true,
                    nextArrow: '#feature-item-wrapper-next',
                    prevArrow: '#feature-item-wrapper-prev',
                    responsive: [
                        {
                            breakpoint: 1699,
                            settings: {
                                slidesToShow: 9,
                            }
                        },
                        {
                            breakpoint: 1599,
                            settings: {
                                slidesToShow: 8,
                            }
                        },
                        {
                            breakpoint: 1399,
                            settings: {
                                slidesToShow: 6,
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 5,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 4,
                            }
                        },
                        {
                            breakpoint: 575,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 424,
                            settings: {
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 359,
                            settings: {
                                slidesToShow: 1,
                            }
                        },
                    ]
                });
            }
        }, 200);
    });
</script>
@endpush
@endsection
