@extends('storefront.layout')
@section('title', $category->name . ' - Sip & Go')
@section('description', $category->description)
@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">{{ $category->name }}</h6>
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
                    <a href="{{ route('categories.index') }}" class="text-main-600 flex-align gap-8">
                        Categories
                    </a>
                </li>
                <li class="flex-align text-gray-500">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-neutral-600">
                    {{ $category->name }}
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<section class="shop py-80">
    <div class="container container-lg">
        <div class="row">
            <!-- Sidebar Start -->
            <div class="col-lg-3">
                <div class="shop-sidebar position-relative">
                    <button type="button" class="shop-sidebar__close d-lg-none d-flex w-32 h-32 flex-center border border-gray-100 rounded-circle hover-bg-main-600 position-absolute inset-inline-end-0 me-10 mt-8 hover-text-white hover-border-main-600">
                        <i class="ph ph-x"></i>
                    </button>

                    <!-- Category Info -->
                    <div class="shop-sidebar__box border border-gray-100 rounded-8 p-32 mb-32">
                        <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Category Information</h6>
                        <div class="mb-24">
                            @if($category->image)
                            <div class="mb-16">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-100 rounded-8">
                            </div>
                            @endif
                            <h5 class="text-heading mb-12">{{ $category->name }}</h5>
                            @if($category->description)
                            <p class="text-gray-600 text-sm">{{ $category->description }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Product Category -->
                    <div class="shop-sidebar__box border border-gray-100 rounded-8 p-32 mb-32">
                        <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">All Categories</h6>
                        <ul class="max-h-540 overflow-y-auto scroll-sm">
                            <li class="mb-24">
                                <a href="{{ route('shop') }}" class="{{ !request('category') ? 'text-main-600' : 'text-gray-900 hover-text-main-600' }}">All Categories</a>
                            </li>
                            @foreach($categories ?? [] as $cat)
                            <li class="mb-24">
                                <a href="{{ route('categories.show', $cat->slug ?? $cat) }}" class="{{ ($cat->id ?? $cat->slug ?? $cat) === ($category->id ?? $category->slug ?? $category) ? 'text-main-600' : 'text-gray-900 hover-text-main-600' }}">
                                    {{ $cat->name }} <span class="text-gray-500">({{ $cat->products_count ?? 0 }})</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Sidebar End -->

            <!-- Product Grid Start -->
            <div class="col-lg-9">
                <div class="shop-topbar flex-between flex-wrap gap-16 mb-32">
                    <div class="flex-align gap-16 flex-wrap">
                        <h5 class="mb-0">{{ $category->name }}</h5>
                        <span class="text-gray-600">({{ $products->total() }} products)</span>
                    </div>
                    <div class="flex-align gap-16 flex-wrap">
                        <div class="flex-align gap-8">
                            <span class="text-gray-600 text-sm">Sort by:</span>
                            <select class="js-example-basic-single border border-gray-100 rounded-8 py-8 px-16 text-sm" id="sort-select">
                                <option value="latest">Latest</option>
                                <option value="price-low">Price: Low to High</option>
                                <option value="price-high">Price: High to Low</option>
                                <option value="name-asc">Name: A to Z</option>
                                <option value="name-desc">Name: Z to A</option>
                            </select>
                        </div>
                    </div>
                </div>

                @if($products->count() > 0)
                <div class="row gy-4">
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="400">
                        <div class="product-card h-100 p-8 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                            <a href="{{ route('products.show', $product->slug) }}" class="product-card__thumb flex-center overflow-hidden rounded-16 mb-16">
                                @if($product->primary_image_url)
                                    <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}">
                                @else
                                    <div class="w-100 h-200 bg-main-50 flex-center rounded-16">
                                        <i class="ph ph-wine text-4xl text-main-600"></i>
                                    </div>
                                @endif
                            </a>
                            <div class="product-card__content">
                                <h6 class="title text-lg fw-semibold mb-8">
                                    <a href="{{ route('products.show', $product->slug) }}" class="link text-line-2 text-heading hover-text-main-600">
                                        {{ Str::limit($product->name, 50) }}
                                    </a>
                                </h6>
                                @if($product->category)
                                <div class="flex-align gap-4 mb-12">
                                    <span class="text-main-600 text-md d-flex"><i class="ph-fill ph-storefront"></i></span>
                                    <span class="text-gray-500 text-xs">{{ $product->category->name }}</span>
                                </div>
                                @endif
                                <div class="product-card__price mb-16">
                                    <span class="text-heading text-md fw-semibold">{{ $product->formatted_price }}</span>
                                    @if($product->compare_price && $product->is_on_sale)
                                    <span class="text-gray-400 text-md fw-semibold text-decoration-line-through ms-8">Ksh {{ number_format($product->compare_price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="flex-align gap-6 mb-16">
                                    <span class="text-xs fw-bold text-gray-600">4.8</span>
                                    <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                    <span class="text-xs fw-bold text-gray-600">({{ rand(10, 100) }}k)</span>
                                </div>
                                <div class="flex-align gap-8">
                                    @if($product->isInStock())
                                    <form action="{{ route('cart.add') }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="product-card__cart btn bg-main-50 text-main-600 hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 w-100 justify-content-center">
                                            Add To Cart <i class="ph ph-shopping-cart"></i>
                                        </button>
                                    </form>
                                    @if(in_array($product->id, $wishlistItems ?? []))
                                    <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-48 h-48 bg-main-600 text-white hover-bg-main-800 flex-center rounded-pill border-0" title="Remove from Wishlist">
                                            <i class="ph ph-heart-fill text-white"></i>
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('wishlist.add') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="w-48 h-48 bg-main-50 text-main-600 hover-bg-main-600 hover-text-white flex-center rounded-pill border-0" title="Add to Wishlist">
                                            <i class="ph ph-heart"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @else
                                    <button type="button" class="product-card__cart btn bg-gray-100 text-gray-400 py-11 px-24 rounded-pill flex-align gap-8 w-100 justify-content-center cursor-not-allowed" disabled>
                                        Out of Stock
                                    </button>
                                    <button type="button" class="w-48 h-48 bg-gray-100 text-gray-400 flex-center rounded-pill border-0 cursor-not-allowed" title="Out of Stock" disabled>
                                        <i class="ph ph-heart"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                <div class="mt-56">
                    <div class="pagination flex-center gap-8 flex-wrap">
                        {{ $products->appends(request()->query())->links('vendor.pagination.marketpro') }}
                    </div>
                </div>
                @endif
                @else
                <div class="text-center py-80">
                    <div class="mb-24">
                        <i class="ph ph-package text-6xl text-gray-400"></i>
                    </div>
                    <h4 class="text-heading mb-16">No Products Found</h4>
                    <p class="text-gray-600 mb-32">There are no products in this category yet. Check back soon!</p>
                    <div class="flex-center gap-16 flex-wrap">
                        <a href="{{ route('categories.index') }}" class="btn btn-main rounded-pill">
                            <i class="ph ph-arrow-left me-2"></i>View All Categories
                        </a>
                        <a href="{{ route('shop') }}" class="btn btn-outline-main rounded-pill">
                            <i class="ph ph-shopping-cart me-2"></i>Browse All Products
                        </a>
                    </div>
                </div>
                @endif
            </div>
            <!-- Product Grid End -->
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', this.value);
            window.location.href = url.toString();
        });
    }
});
</script>
@endpush
@endsection
