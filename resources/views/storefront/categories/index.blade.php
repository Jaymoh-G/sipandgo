@extends('storefront.layout')

@section('title', 'Categories - Sip & Go')
@section('description', 'Browse all product categories')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">All Categories</h6>
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
                    Categories
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ============================ Category Section Start =============================== -->
<section class="category py-80">
    <div class="container container-lg">
        <div class="section-heading text-center mb-56">
            <h2 class="text-heading-two mb-16">Browse All Categories</h2>
            <p class="text-gray-600">Explore our premium collection organized by spirit type</p>
        </div>

        <div class="row gy-4">
            @foreach($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-duration="400">
                <div class="product-card h-100 p-8 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                    <a href="{{ route('categories.show', $category->slug ?? $category) }}" class="product-card__thumb flex-center overflow-hidden rounded-16 mb-16">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <div class="w-100 h-200 bg-main-50 flex-center rounded-16">
                                <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="{{ $category->name }}" class="w-80">
                            </div>
                        @endif
                    </a>
                    <div class="product-card__content text-center">
                        <h6 class="title text-lg fw-semibold mb-8">
                            <a href="{{ route('categories.show', $category->slug ?? $category) }}" class="link text-heading hover-text-main-600">
                                {{ $category->name }} <span class="text-main-600">({{ $category->products_count ?? 0 }})</span>
                            </a>
                        </h6>
                        @if($category->description)
                        <p class="text-gray-600 text-sm mb-16">
                            {{ Str::limit($category->description, 80) }}
                        </p>
                        @endif
                        <a href="{{ route('categories.show', $category->slug ?? $category) }}" class="btn bg-main-50 text-main-600 hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 w-100 justify-content-center">
                            Shop Now <i class="ph ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($categories->isEmpty())
        <div class="text-center py-80">
            <div class="mb-24">
                <i class="ph ph-folder-open text-6xl text-gray-400"></i>
            </div>
            <h4 class="text-heading mb-16">No Categories Available</h4>
            <p class="text-gray-600 mb-32">Check back soon for our premium collection!</p>
            <a href="{{ route('home') }}" class="btn btn-main rounded-pill">
                <i class="ph ph-house me-2"></i> Go to Home
            </a>
        </div>
        @endif
    </div>
</section>
<!-- ============================ Category Section End =============================== -->

@endsection

