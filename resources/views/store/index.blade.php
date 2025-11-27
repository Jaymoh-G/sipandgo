@extends('store.layout')
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
                                    <h6 class="text-danger-600 mb-0">$29.99</h6>
                                </div>
                            </div>
                        </div>
                        <div class="banner-item__thumb animate-scale animation-delay-12">
                            <img src="{{ asset('assets/images/thumbs/banner-img3.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="banner-slider__item">
                    <div class="banner-slider__inner flex-between position-relative">
                        <div class="banner-item__content">
                            <span class="fw-semibold text-success-600 text-capitalize mb-8 animate-left-right animation-delay-08">Premium spirits collection</span>
                            <h2 class="banner-item__title max-w-700 mb-30 animate-left-right animation-delay-1">World's Finest <span class="text-main-600">Whiskey</span> & Spirits</h2>
                            <div class="d-flex align-items-center gap-16 animate-left-right animation-delay-12">
                                <a href="{{ route('categories.show', ['category' => 'whisky-whiskey']) }}" class="btn btn-main d-inline-flex align-items-center rounded-pill gap-8">
                                    Shop Whiskey <span class="icon text-xl d-flex"><i class="ph ph-shopping-cart-simple"></i></span>
                                </a>
                                <div class="d-flex align-items-end gap-8">
                                    <span class="text-heading fst-italic text-sm">Starting at</span>
                                    <h6 class="text-danger-600 mb-0">$49.99</h6>
                                </div>
                            </div>
                        </div>
                        <div class="banner-item__thumb animate-scale animation-delay-12">
                            <img src="{{ asset('assets/images/thumbs/banner-img1.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
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
                <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="400">
                    <div class="feature-item__thumb rounded-circle">
                        <a href="{{ route('categories.show', ['category' => 'whisky-whiskey']) }}" class="w-100 h-100 flex-center">
                            <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="">
                        </a>
                    </div>
                    <div class="feature-item__content mt-16">
                        <h6 class="text-lg mb-8"><a href="{{ route('categories.show', ['category' => 'whisky-whiskey']) }}" class="text-inherit">Whisky & Whiskey</a></h6>
                        <span class="text-sm text-gray-400">Premium Collection</span>
                    </div>
                </div>
                <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="600">
                    <div class="feature-item__thumb rounded-circle">
                        <a href="{{ route('categories.show', ['category' => 'vodka']) }}" class="w-100 h-100 flex-center">
                            <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="">
                        </a>
                    </div>
                    <div class="feature-item__content mt-16">
                        <h6 class="text-lg mb-8"><a href="{{ route('categories.show', ['category' => 'vodka']) }}" class="text-inherit">Vodka</a></h6>
                        <span class="text-sm text-gray-400">Premium Collection</span>
                    </div>
                </div>
                <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="800">
                    <div class="feature-item__thumb rounded-circle">
                        <a href="{{ route('categories.show', ['category' => 'rum']) }}" class="w-100 h-100 flex-center">
                            <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="">
                        </a>
                    </div>
                    <div class="feature-item__content mt-16">
                        <h6 class="text-lg mb-8"><a href="{{ route('categories.show', ['category' => 'rum']) }}" class="text-inherit">Rum</a></h6>
                        <span class="text-sm text-gray-400">Premium Collection</span>
                    </div>
                </div>
                <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="1000">
                    <div class="feature-item__thumb rounded-circle">
                        <a href="{{ route('categories.show', ['category' => 'gin']) }}" class="w-100 h-100 flex-center">
                            <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="">
                        </a>
                    </div>
                    <div class="feature-item__content mt-16">
                        <h6 class="text-lg mb-8"><a href="{{ route('categories.show', ['category' => 'gin']) }}" class="text-inherit">Gin</a></h6>
                        <span class="text-sm text-gray-400">Premium Collection</span>
                    </div>
                </div>
                <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="1200">
                    <div class="feature-item__thumb rounded-circle">
                        <a href="{{ route('categories.show', ['category' => 'tequila-mezcal']) }}" class="w-100 h-100 flex-center">
                            <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="">
                        </a>
                    </div>
                    <div class="feature-item__content mt-16">
                        <h6 class="text-lg mb-8"><a href="{{ route('categories.show', ['category' => 'tequila-mezcal']) }}" class="text-inherit">Tequila & Mezcal</a></h6>
                        <span class="text-sm text-gray-400">Premium Collection</span>
                    </div>
                </div>
                <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="1400">
                    <div class="feature-item__thumb rounded-circle">
                        <a href="{{ route('categories.show', ['category' => 'wine']) }}" class="w-100 h-100 flex-center">
                            <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="">
                        </a>
                    </div>
                    <div class="feature-item__content mt-16">
                        <h6 class="text-lg mb-8"><a href="{{ route('categories.show', ['category' => 'wine']) }}" class="text-inherit">Wine</a></h6>
                        <span class="text-sm text-gray-400">Premium Collection</span>
                    </div>
                </div>
                <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="1600">
                    <div class="feature-item__thumb rounded-circle">
                        <a href="{{ route('categories.show', ['category' => 'beer']) }}" class="w-100 h-100 flex-center">
                            <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="">
                        </a>
                    </div>
                    <div class="feature-item__content mt-16">
                        <h6 class="text-lg mb-8"><a href="{{ route('categories.show', ['category' => 'beer']) }}" class="text-inherit">Beer</a></h6>
                        <span class="text-sm text-gray-400">Premium Collection</span>
                    </div>
                </div>
                <div class="feature-item text-center wow bounceIn" data-aos="fade-up" data-aos-duration="1800">
                    <div class="feature-item__thumb rounded-circle">
                        <a href="{{ route('categories.show', ['category' => 'ready-to-drink']) }}" class="w-100 h-100 flex-center">
                            <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="">
                        </a>
                    </div>
                    <div class="feature-item__content mt-16">
                        <h6 class="text-lg mb-8"><a href="{{ route('categories.show', ['category' => 'ready-to-drink']) }}" class="text-inherit">Ready-to-Drink</a></h6>
                        <span class="text-sm text-gray-400">Premium Collection</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Feature Section End =============================== -->

<!-- Featured Categories Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                Shop by Category
            </h2>
            <p class="text-lg text-gray-600">
                Explore our premium collection organized by spirit type
            </p>
        </div>

        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
        >
            @foreach($categories->take(8) as $category)
            <div
                class="product-card bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300"
            >
                <div
                    class="h-48 bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center relative"
                >
                    <i
                        class="fas fa-wine-glass-alt text-6xl text-amber-600"
                    ></i>
                    <div
                        class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold"
                    >
                        New
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ $category->name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">
                        {{ Str::limit($category->description, 80) }}
                    </p>
                    <a
                        href="{{ route('categories.show', $category) }}"
                        class="inline-flex items-center text-amber-600 hover:text-amber-700 font-semibold group"
                    >
                        Shop {{ $category->name }}
                        <i
                            class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"
                        ></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a
                href="{{ route('categories.index') }}"
                class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold transition-colors"
            >
                View All Categories
            </a>
        </div>
    </div>
</section>

<!-- Deal of the Week Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                Deal of The Week
            </h2>
            <p class="text-lg text-gray-600">
                Limited time offers on premium spirits
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProducts->take(3) as $product)
            <div
                class="product-card bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300"
            >
                <div
                    class="h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center relative"
                >
                    <i class="fas fa-wine-bottle text-8xl text-gray-400"></i>

                </div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-1">
                        {{ $product->category->name }}
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        {{ $product->name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">
                        {{ Str::limit($product->short_description, 80) }}
                    </p>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <span
                                class="text-2xl font-bold text-gray-900"
                                >{{ $product->formatted_price }}</span
                            >
                            @if($product->compare_price)
                            <span
                                class="text-lg text-gray-500 line-through"
                                >{{ '$' . number_format($product->compare_price, 2) }}</span
                            >
                            @endif
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $product->alcohol_content ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm ml-2"
                                >(4.8)</span
                            >
                        </div>
                        <span class="text-sm text-gray-500"
                            >Fulfilled by Sip & Go</span
                        >
                    </div>

                    <a
                        href="{{ route('products.show', $product) }}"
                        class="w-full bg-amber-600 hover:bg-amber-700 text-white py-3 px-4 rounded-lg font-semibold transition-colors text-center block mt-4"
                    >
                        Add to Cart
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a
                href="{{ route('products.index') }}"
                class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold transition-colors"
            >
                View All Deals
            </a>
        </div>
    </div>
</section>

<!-- Featured Products Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                Featured Products
            </h2>
            <p class="text-lg text-gray-600">
                Handpicked premium selections from our collection
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
            <div
                class="product-card bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300"
            >
                <div
                    class="h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center relative"
                >
                    <i class="fas fa-wine-bottle text-6xl text-gray-400"></i>

                </div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-1">
                        {{ $product->category->name }}
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        {{ $product->name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">
                        {{ Str::limit($product->short_description, 80) }}
                    </p>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <span
                                class="text-2xl font-bold text-gray-900"
                                >{{ $product->formatted_price }}</span
                            >
                            @if($product->compare_price)
                            <span
                                class="text-lg text-gray-500 line-through"
                                >{{ '$' . number_format($product->compare_price, 2) }}</span
                            >
                            @endif
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $product->alcohol_content ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm ml-2"
                                >(4.8)</span
                            >
                        </div>
                        <span class="text-sm text-gray-500"
                            >Delivered by Aug 02</span
                        >
                    </div>

                    <a
                        href="{{ route('products.show', $product) }}"
                        class="w-full bg-amber-600 hover:bg-amber-700 text-white py-2 px-4 rounded-lg font-semibold transition-colors text-center block"
                    >
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a
                href="{{ route('products.index') }}"
                class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold transition-colors"
            >
                View All Products
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div
                    class="bg-amber-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                >
                    <i class="fas fa-shipping-fast text-2xl text-amber-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    Free Shipping
                </h3>
                <p class="text-gray-600">Free shipping all over the US</p>
            </div>

            <div class="text-center">
                <div
                    class="bg-amber-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                >
                    <i class="fas fa-check-circle text-2xl text-amber-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    100% Satisfaction
                </h3>
                <p class="text-gray-600">Quality guarantee on all products</p>
            </div>

            <div class="text-center">
                <div
                    class="bg-amber-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                >
                    <i class="fas fa-shield-alt text-2xl text-amber-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    Secure Payments
                </h3>
                <p class="text-gray-600">Safe and encrypted transactions</p>
            </div>

            <div class="text-center">
                <div
                    class="bg-amber-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                >
                    <i class="fas fa-headset text-2xl text-amber-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                    24/7 Support
                </h3>
                <p class="text-gray-600">Round-the-clock customer service</p>
            </div>
        </div>
    </div>
</section>

<script>
    // Simple countdown timer
    function updateCountdown() {
        const now = new Date().getTime();
        const endTime =
            now +
            35 * 24 * 60 * 60 * 1000 +
            14 * 60 * 60 * 1000 +
            54 * 60 * 1000 +
            28 * 1000;

        const timer = setInterval(function () {
            const now = new Date().getTime();
            const distance = endTime - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor(
                (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            const minutes = Math.floor(
                (distance % (1000 * 60 * 60)) / (1000 * 60)
            );
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;

            if (distance < 0) {
                clearInterval(timer);
                document.getElementById("days").innerHTML = "0";
                document.getElementById("hours").innerHTML = "0";
                document.getElementById("minutes").innerHTML = "0";
                document.getElementById("seconds").innerHTML = "0";
            }
        }, 1000);
    }

    // Start countdown when page loads
    document.addEventListener("DOMContentLoaded", updateCountdown);
</script>
@endsection
