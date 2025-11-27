@extends('storefront.layout')
@section('title', $product->name . ' - Sip & Go')
@section('description', $product->short_description)
@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Product Details</h6>
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
                <li class="text-sm">
                    <a href="{{ route('shop') }}" class="text-main-600 flex-align gap-8">
                        Shop
                    </a>
                </li>
                <li class="flex-align text-gray-500">
                    <i class="ph ph-caret-right"></i>
                </li>
                @if($product->category)
                <li class="text-sm">
                    <a href="{{ route('categories.show', $product->category->slug) }}" class="text-main-600 flex-align gap-8">
                        {{ $product->category->name }}
                    </a>
                </li>
                <li class="flex-align text-gray-500">
                    <i class="ph ph-caret-right"></i>
                </li>
                @endif
                <li class="text-sm text-neutral-600">
                    {{ $product->name }}
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<section class="product-details py-80">
    <div class="container container-lg">
        <div class="row gy-4">
            <div class="col-lg-9">
                <div class="row gy-4">
                    <div class="col-xl-6">
                        <div class="product-details__left">

                            <div class="product-details__thumb-slider border border-gray-100 rounded-16">
                                @if($product->primary_image_url)
                                <div class="">
                                    <div class="product-details__thumb flex-center h-100">
                                        <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}">
                                    </div>
                                </div>
                                @endif
                                @if($product->images && is_array($product->images))
                                    @foreach(array_slice($product->images, 0, 4) as $image)
                                        @php
                                            $imageUrl = is_string($image) ? trim($image) : ($image['url'] ?? null);
                                        @endphp
                                        @if(!empty($imageUrl))
                                        <div class="">
                                            <div class="product-details__thumb flex-center h-100">
                                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="product-details__content">
                            <h5 class="mb-12">{{ $product->name }}</h5>
                            <div class="flex-align flex-wrap gap-12">
                                <div class="flex-align gap-12 flex-wrap">
                                    <div class="flex-align gap-8">
                                        @for($i = 0; $i < 5; $i++)
                                        <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                        @endfor
                                    </div>
                                    <span class="text-sm fw-medium text-neutral-600">4.7 Star Rating</span>
                                    <span class="text-sm fw-medium text-gray-500">({{ rand(100, 1000) }})</span>
                                </div>
                                <span class="text-sm fw-medium text-gray-500">|</span>
                                <span class="text-gray-900"> <span class="text-gray-400">SKU:</span>{{ $product->sku }} </span>
                            </div>
                            <span class="mt-32 pt-32 text-gray-700 border-top border-gray-100 d-block"></span>
                            <p class="text-gray-700">{{ $product->short_description ?? $product->description }}</p>
                            <div class="mt-32 flex-align flex-wrap gap-32">
                                <div class="flex-align gap-8">
                                    <h4 class="mb-0">{{ $product->formatted_price }}</h4>
                                    @if($product->compare_price)
                                    <span class="text-md text-gray-500">Ksh {{ number_format($product->compare_price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                            <span class="mt-32 pt-32 text-gray-700 border-top border-gray-100 d-block"></span>

                            @if($product->track_inventory && ($product->quantity ?? 0) > 0 && ($product->quantity ?? 0) < 50)
                            <div class="mb-24">
                                <div class="mt-32 flex-align gap-12 mb-16">
                                    <span class="w-32 h-32 bg-white flex-center rounded-circle text-main-600 box-shadow-xl"><i class="ph-fill ph-lightning"></i></span>
                                    <h6 class="text-md mb-0 fw-bold text-gray-900">Products are almost sold out</h6>
                                </div>
                                @php
                                    $stockPercentage = min(100, (($product->quantity ?? 0) / 50) * 100);
                                @endphp
                                <div class="progress w-100 bg-gray-100 rounded-pill h-8" role="progressbar" aria-label="Stock" aria-valuenow="{{ $stockPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-main-two-600 rounded-pill" style="width: {{ $stockPercentage }}%"></div>
                                </div>
                                <span class="text-sm text-gray-700 mt-8">Available only: {{ $product->quantity ?? 0 }}</span>
                            </div>
                            @endif

                            @if(!$product->isInStock())
                            <div class="alert alert-warning mb-24 bg-warning-50 border border-warning-200 text-warning-800 px-24 py-16 rounded-8">
                                <i class="ph ph-warning-circle me-8"></i>This product is currently out of stock.
                            </div>
                            @endif

                            <span class="text-gray-900 d-block mb-8">Quantity:</span>
                            <div class="flex-between gap-16 flex-wrap">
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-align flex-wrap gap-16">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="border border-gray-100 rounded-pill py-9 px-16 flex-align">
                                        <button type="button" class="quantity__minus p-4 text-gray-700 hover-text-main-600 flex-center"><i class="ph ph-minus"></i></button>
                                        <input type="number" name="quantity" id="product-quantity" class="quantity__input border-0 text-center w-32" value="1" min="{{ $product->isInStock() ? 1 : 0 }}" max="{{ $product->isInStock() ? max(1, ($product->quantity ?? 99)) : 0 }}" {{ !$product->isInStock() ? 'disabled' : '' }}>
                                        <button type="button" class="quantity__plus p-4 text-gray-700 hover-text-main-600 flex-center"><i class="ph ph-plus"></i></button>
                                    </div>
                                    <button type="submit" class="btn btn-main rounded-pill flex-align d-inline-flex gap-8 px-48" {{ !$product->isInStock() ? 'disabled' : '' }}>
                                        <i class="ph ph-shopping-cart"></i> {{ $product->isInStock() ? 'Add To Cart' : 'Out of Stock' }}
                                    </button>
                                </form>

                                <div class="flex-align gap-12">
                                    @if($product->isInStock())
                                        @if(in_array($product->id, $wishlistItems ?? []))
                                        <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-52 h-52 bg-main-600 text-white text-xl hover-bg-main-800 flex-center rounded-circle border-0" title="Remove from Wishlist">
                                                <i class="ph ph-heart-fill text-white"></i>
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('wishlist.add') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="w-52 h-52 bg-main-50 text-main-600 text-xl hover-bg-main-600 hover-text-white flex-center rounded-circle border-0" title="Add to Wishlist">
                                                <i class="ph ph-heart"></i>
                                            </button>
                                        </form>
                                        @endif
                                    @else
                                    <button type="button" class="w-52 h-52 bg-gray-100 text-gray-400 text-xl flex-center rounded-circle border-0 cursor-not-allowed" title="Out of Stock" disabled>
                                        <i class="ph ph-heart"></i>
                                    </button>
                                    @endif
                                    <a href="#" class="w-52 h-52 bg-main-50 text-main-600 text-xl hover-bg-main-600 hover-text-white flex-center rounded-circle" title="Compare">
                                        <i class="ph ph-shuffle"></i>
                                    </a>
                                    <a href="#" class="w-52 h-52 bg-main-50 text-main-600 text-xl hover-bg-main-600 hover-text-white flex-center rounded-circle" title="Share">
                                        <i class="ph ph-share-network"></i>
                                    </a>
                                </div>
                            </div>

                            <span class="mt-32 pt-32 text-gray-700 border-top border-gray-100 d-block"></span>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-80">
            <div class="product-dContent border rounded-24">
                <div class="product-dContent__header border-bottom border-gray-100 flex-between flex-wrap gap-16">
                    <ul class="nav common-tab nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-description-tab" data-bs-toggle="pill" data-bs-target="#pills-description" type="button" role="tab" aria-controls="pills-description" aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-reviews-tab" data-bs-toggle="pill" data-bs-target="#pills-reviews" type="button" role="tab" aria-controls="pills-reviews" aria-selected="false">Reviews</button>
                        </li>
                    </ul>
                    <a href="#" class="btn bg-color-one rounded-16 flex-align gap-8 text-main-600 hover-bg-main-600 hover-text-white">
                        <img src="{{ asset('assets/images/icon/satisfaction-icon.png') }}" alt="">
                        100% Satisfaction Guaranteed
                    </a>
                </div>
                <div class="product-dContent__box">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab" tabindex="0">
                            <div class="mb-40">
                                <h6 class="mb-24">Product Description</h6>
                                <p>{{ $product->description }}</p>
                            </div>
                            <div class="mb-40">
                                <h6 class="mb-24">Product Specifications</h6>
                                <ul class="mt-32">
                                    @if($product->brand)
                                    <li class="text-gray-400 mb-14 flex-align gap-14">
                                        <span class="w-20 h-20 bg-main-50 text-main-600 text-xs flex-center rounded-circle">
                                            <i class="ph ph-check"></i>
                                        </span>
                                        <span class="text-heading fw-medium">
                                            Brand:
                                            <span class="text-gray-500"> {{ $product->brand }}</span>
                                        </span>
                                    </li>
                                    @endif
                                    @if($product->alcohol_content)
                                    <li class="text-gray-400 mb-14 flex-align gap-14">
                                        <span class="w-20 h-20 bg-main-50 text-main-600 text-xs flex-center rounded-circle">
                                            <i class="ph ph-check"></i>
                                        </span>
                                        <span class="text-heading fw-medium">
                                            Alcohol Content:
                                            <span class="text-gray-500"> {{ $product->alcohol_content }}</span>
                                        </span>
                                    </li>
                                    @endif
                                    @if($product->volume)
                                    <li class="text-gray-400 mb-14 flex-align gap-14">
                                        <span class="w-20 h-20 bg-main-50 text-main-600 text-xs flex-center rounded-circle">
                                            <i class="ph ph-check"></i>
                                        </span>
                                        <span class="text-heading fw-medium">
                                            Volume:
                                            <span class="text-gray-500"> {{ $product->volume }}</span>
                                        </span>
                                    </li>
                                    @endif
                                    @if($product->origin_country)
                                    <li class="text-gray-400 mb-14 flex-align gap-14">
                                        <span class="w-20 h-20 bg-main-50 text-main-600 text-xs flex-center rounded-circle">
                                            <i class="ph ph-check"></i>
                                        </span>
                                        <span class="text-heading fw-medium">
                                            Origin:
                                            <span class="text-gray-500"> {{ $product->origin_country }}</span>
                                        </span>
                                    </li>
                                    @endif
                                    <li class="text-gray-400 mb-14 flex-align gap-14">
                                        <span class="w-20 h-20 bg-main-50 text-main-600 text-xs flex-center rounded-circle">
                                            <i class="ph ph-check"></i>
                                        </span>
                                        <span class="text-heading fw-medium">
                                            SKU:
                                            <span class="text-gray-500"> {{ $product->sku }}</span>
                                        </span>
                                    </li>
                                    <li class="text-gray-400 mb-14 flex-align gap-14">
                                        <span class="w-20 h-20 bg-main-50 text-main-600 text-xs flex-center rounded-circle">
                                            <i class="ph ph-check"></i>
                                        </span>
                                        <span class="text-heading fw-medium">
                                            Age Requirement:
                                            <span class="text-gray-500"> {{ $product->min_age }}+</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab" tabindex="0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <h6 class="mb-24">Product Reviews</h6>
                                    <p class="text-gray-700">No reviews yet. Be the first to review this product!</p>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ms-xxl-5">
                                        <h6 class="mb-24">Customers Feedback</h6>
                                        <div class="d-flex flex-wrap gap-44">
                                            <div class="border border-gray-100 rounded-8 px-40 py-52 flex-center flex-column flex-shrink-0 text-center">
                                                <h2 class="mb-6 text-main-600">4.8</h2>
                                                <div class="flex-center gap-8">
                                                    @for($i = 0; $i < 5; $i++)
                                                    <span class="text-xs fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                    @endfor
                                                </div>
                                                <span class="mt-16 text-gray-500">Average Product Rating</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================== Similar Product Start ============================= -->
@if($relatedProducts && $relatedProducts->count() > 0)
<section class="new-arrival pb-80">
    <div class="container container-lg">
        <div class="section-heading">
            <div class="flex-between flex-wrap gap-8">
                <h5 class="mb-0">You Might Also Like</h5>
                <div class="flex-align gap-16">
                    <a href="{{ route('shop') }}" class="text-sm fw-medium text-gray-700 hover-text-main-600 hover-text-decoration-underline">All Products</a>
                    <div class="flex-align gap-8">
                        <button type="button" id="new-arrival-prev" class="slick-prev slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1" >
                            <i class="ph ph-caret-left"></i>
                        </button>
                        <button type="button" id="new-arrival-next" class="slick-next slick-arrow flex-center rounded-circle border border-gray-100 hover-border-main-600 text-xl hover-bg-main-600 hover-text-white transition-1" >
                            <i class="ph ph-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="new-arrival__slider arrow-style-two">
            @foreach($relatedProducts as $relatedProduct)
            <div>
                <div class="product-card h-100 p-8 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                    <a href="{{ route('products.show', $relatedProduct->slug) }}" class="product-card__thumb flex-center overflow-hidden">
                        @if($relatedProduct->primary_image_url)
                            <img src="{{ $relatedProduct->primary_image_url }}" alt="{{ $relatedProduct->name }}">
                        @else
                            <img src="{{ asset('assets/images/thumbs/product-img1.png') }}" alt="{{ $relatedProduct->name }}">
                        @endif
                    </a>
                    <div class="product-card__content p-sm-2 w-100">
                        <h6 class="title text-lg fw-semibold mt-12 mb-8">
                            <a href="{{ route('products.show', $relatedProduct->slug) }}" class="link text-line-2">{{ Str::limit($relatedProduct->name, 50) }}</a>
                        </h6>
                        @if($relatedProduct->category)
                        <div class="flex-align gap-4">
                            <span class="text-main-600 text-md d-flex"><i class="ph-fill ph-storefront"></i></span>
                            <span class="text-gray-500 text-xs">By {{ $relatedProduct->category->name }}</span>
                        </div>
                        @endif

                        <div class="product-card__content mt-12">
                            <div class="product-card__price mb-8">
                                <span class="text-heading text-md fw-semibold ">{{ $relatedProduct->formatted_price }} <span class="text-gray-500 fw-normal">/Qty</span> </span>
                                @if($relatedProduct->compare_price)
                                <span class="text-gray-400 text-md fw-semibold text-decoration-line-through"> Ksh {{ number_format($relatedProduct->compare_price, 2) }}</span>
                                @endif
                            </div>
                            <div class="flex-align gap-6">
                                <span class="text-xs fw-bold text-gray-600">4.8</span>
                                <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                <span class="text-xs fw-bold text-gray-600">({{ rand(10, 100) }}k)</span>
                            </div>
                            <div class="flex-align gap-8 mt-24">
                                @if($relatedProduct->isInStock())
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="product-card__cart btn bg-main-50 text-main-600 hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 w-100 justify-content-center">
                                        Add To Cart <i class="ph ph-shopping-cart"></i>
                                    </button>
                                </form>
                                <form action="{{ route('wishlist.add') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                                    <button type="submit" class="w-48 h-48 bg-main-50 text-main-600 hover-bg-main-600 hover-text-white flex-center rounded-circle border-0" title="Add to Wishlist">
                                        <i class="ph ph-heart"></i>
                                    </button>
                                </form>
                                @else
                                <button type="button" class="product-card__cart btn bg-gray-100 text-gray-400 py-11 px-24 rounded-pill flex-align gap-8 w-100 justify-content-center cursor-not-allowed" disabled>
                                    Out of Stock
                                </button>
                                <button type="button" class="w-48 h-48 bg-gray-100 text-gray-400 flex-center rounded-circle border-0 cursor-not-allowed" title="Out of Stock" disabled>
                                    <i class="ph ph-heart"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<!-- ========================== Similar Product End ============================= -->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('product-quantity');
    const decreaseBtn = document.querySelector('.quantity__minus');
    const increaseBtn = document.querySelector('.quantity__plus');

    if (decreaseBtn && quantityInput) {
        decreaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    }

    if (increaseBtn && quantityInput) {
        increaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            const maxValue = parseInt(quantityInput.getAttribute('max')) || 99;
            if (currentValue < maxValue) {
                quantityInput.value = currentValue + 1;
            }
        });
    }
});
</script>
@endpush
@endsection
