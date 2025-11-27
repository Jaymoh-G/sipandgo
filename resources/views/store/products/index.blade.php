@extends('store.layout')

@section('title', 'All Products - Sip & Go')
@section('description', 'Browse our complete collection of premium spirits, wines, and liquors')

@section('content')
<section class="shop py-80">
    <div class="container container-lg">
        <div class="row">
            <!-- Sidebar Start -->
            <div class="col-lg-3">
                <div class="shop-sidebar position-relative">
                    <button type="button" class="shop-sidebar__close d-lg-none d-flex w-32 h-32 flex-center border border-gray-100 rounded-circle hover-bg-main-600 position-absolute inset-inline-end-0 me-10 mt-8 hover-text-white hover-border-main-600">
                        <i class="ph ph-x"></i>
                    </button>

                    <!-- Product Category -->
                    <div class="shop-sidebar__box border border-gray-100 rounded-8 p-32 mb-32">
                        <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Product Category</h6>
                        <ul class="max-h-540 overflow-y-auto scroll-sm">
                            <li class="mb-24">
                                <a href="{{ route('products.index') }}" class="{{ !request('category') ? 'text-main-600' : 'text-gray-900 hover-text-main-600' }}">All Categories</a>
                            </li>
                            @foreach($categories as $category)
                            <li class="mb-24">
                                <a href="{{ route('products.index', ['category' => $category->slug] + request()->except('page')) }}" class="{{ request('category') === $category->slug ? 'text-main-600' : 'text-gray-900 hover-text-main-600' }}">{{ $category->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Price Filter -->
                    <div class="shop-sidebar__box border border-gray-100 rounded-8 p-32 mb-32">
                        <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Filter by Price</h6>
                        <form method="GET" action="{{ route('products.index') }}">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <div class="custom--range">
                                <div id="slider-range"></div>
                                <div class="flex-between flex-wrap-reverse gap-8 mt-24 ">
                                    <button type="submit" class="btn btn-main h-40 flex-align">Filter</button>
                                    <div class="custom--range__content flex-align gap-8">
                                        <span class="text-gray-500 text-md flex-shrink-0">Price:</span>
                                        <input type="text" class="custom--range__prices text-neutral-600 text-start text-md fw-medium" id="amount" readonly>
                                    </div>
                                </div>
                                <input type="hidden" name="min_price" id="min_price_input" value="{{ request('min_price', 0) }}">
                                <input type="hidden" name="max_price" id="max_price_input" value="{{ request('max_price', 1000) }}">
                            </div>
                        </form>
                    </div>

                    @if(request()->hasAny(['category', 'search', 'min_price', 'max_price']))
                    <div class="shop-sidebar__box border border-gray-100 rounded-8 p-24 mb-32">
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover-text-main-600">Clear All Filters</a>
                    </div>
                    @endif

                    <!-- Filter by Brand -->
                    @if(isset($brands) && $brands->count() > 0)
                    <div class="shop-sidebar__box border border-gray-100 rounded-8 p-32 mb-32">
                        <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Filter by Brand</h6>
                        <ul class="max-h-540 overflow-y-auto scroll-sm">
                            <li class="mb-24">
                                <a href="{{ route('products.index', array_merge(request()->except(['page','brand']), [])) }}" class="{{ !request('brand') ? 'text-main-600' : 'text-gray-900 hover-text-main-600' }}">All Brands</a>
                            </li>
                            @foreach($brands as $brand)
                            <li class="mb-24">
                                <a href="{{ route('products.index', array_merge(request()->except('page'), ['brand' => $brand])) }}" class="{{ request('brand') === $brand ? 'text-main-600' : 'text-gray-900 hover-text-main-600' }}">{{ $brand }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Sidebar End -->

            <!-- Content Start -->
            <div class="col-lg-9">
                <!-- Top Start -->
                <div class="flex-between gap-16 flex-wrap mb-40 ">
                    <span class="text-gray-900">Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} result</span>
                    <div class="position-relative flex-align gap-16 flex-wrap">
                        <div class="list-grid-btns flex-align gap-16">
                            <button type="button" class="w-44 h-44 flex-center border border-gray-100 rounded-6 text-2xl list-btn">
                                <i class="ph-bold ph-list-dashes"></i>
                            </button>
                            <button type="button" class="w-44 h-44 flex-center border border-main-600 text-white bg-main-600 rounded-6 text-2xl grid-btn">
                                <i class="ph ph-squares-four"></i>
                            </button>
                        </div>
                        <div class="position-relative text-gray-500 flex-align gap-4 text-14">
                            <label for="sorting" class="text-inherit flex-shrink-0">Sort by: </label>
                            <select id="sorting" class="form-control common-input px-14 py-14 text-inherit rounded-6 w-auto" onchange="window.location.href=this.value">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => 'asc']) }}" {{ request('sort')=='name' && request('direction')=='asc' ? 'selected' : '' }}>Name A-Z</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => 'desc']) }}" {{ request('sort')=='name' && request('direction')=='desc' ? 'selected' : '' }}>Name Z-A</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'asc']) }}" {{ request('sort')=='price' && request('direction')=='asc' ? 'selected' : '' }}>Price Low to High</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => 'desc']) }}" {{ request('sort')=='price' && request('direction')=='desc' ? 'selected' : '' }}>Price High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Top End -->

                @if($products->count() > 0)
                <div class="list-grid-wrapper">
                    <div class="row g-3 g-md-4" id="productsGrid">
                        @foreach($products as $product)
                        <div class="col-12 col-md-6 col-lg-3 product-col">
                            <div class="product-card h-100 p-16 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2">
                                <a href="{{ route('products.show', $product) }}" class="product-card__thumb flex-center rounded-8 bg-gray-50 position-relative overflow-hidden">
                                    @if($product->primary_image_url)
                                        <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}">
                                    @else
                                        <i class="fas fa-wine-bottle text-6xl text-gray-400"></i>
                                    @endif
                                </a>
                                <div class="product-card__content mt-16">
                                    <h6 class="title text-lg fw-semibold mt-12 mb-8">
                                        <a href="{{ route('products.show', $product) }}" class="link text-line-2">{{ $product->name }}</a>
                                    </h6>
                                    <div class="flex-align mb-12 gap-6">
                                        <span class="text-xs fw-medium text-gray-500">{{ $product->category->name }}</span>
                                    </div>
                                    <div class="product-card__price my-12 d-flex align-items-center gap-8">
                                        <span class="text-heading text-md fw-semibold ">{{ $product->formatted_price }}</span>
                                        @if($product->compare_price)
                                            <span class="text-gray-400 text-md fw-semibold text-decoration-line-through">${{ number_format($product->compare_price, 2) }}</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('products.show', $product) }}" class="product-card__cart btn bg-gray-50 text-heading hover-bg-main-600 hover-text-white py-11 px-24 rounded-8 flex-center gap-8 fw-medium">
                                        View Details <i class="ph ph-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination Start -->
                <div class="mt-32">
                    {{ $products->appends(request()->query())->links('vendor.pagination.marketpro') }}
                </div>
                <!-- Pagination End -->
                @else
                <div class="text-center py-80">
                    <i class="ph ph-magnifying-glass text-6xl text-gray-300 mb-4 d-inline-flex"></i>
                    <h3 class="text-xl fw-semibold text-gray-900 mb-2">No products found</h3>
                    <p class="text-gray-600 mb-4">Try adjusting your search or filter criteria</p>
                    <a href="{{ route('products.index') }}" class="btn bg-main-600 hover-bg-main-800 text-white px-24 py-12 rounded-8 fw-semibold">View All Products</a>
                </div>
                @endif
            </div>
            <!-- Content End -->
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.querySelector('.list-grid-wrapper');
    const gridBtn = document.querySelector('.grid-btn');
    const listBtn = document.querySelector('.list-btn');
    const productCols = document.querySelectorAll('#productsGrid .product-col');

    function setGrid() {
        wrapper.classList.remove('list-view');
        productCols.forEach(function (col) {
            col.classList.remove('col-lg-6');
            col.classList.remove('col-lg-12');
            col.classList.remove('list-item');
            col.classList.add('col-12');
            col.classList.add('col-md-6');
            col.classList.add('col-lg-3');
        });
        gridBtn.classList.add('bg-main-600','text-white','border-main-600');
        gridBtn.classList.remove('bg-white');
        listBtn.classList.remove('bg-main-600','text-white','border-main-600');
    }

    function setList() {
        wrapper.classList.add('list-view');
        productCols.forEach(function (col) {
            col.classList.remove('col-lg-3');
            col.classList.remove('col-lg-12');
            col.classList.add('col-12');
            col.classList.add('col-md-6');
            col.classList.add('col-lg-6');
            col.classList.add('list-item');
        });
        listBtn.classList.add('bg-main-600','text-white','border-main-600');
        gridBtn.classList.remove('bg-main-600','text-white','border-main-600');
    }

    if (gridBtn && listBtn) {
        gridBtn.addEventListener('click', setGrid);
        listBtn.addEventListener('click', setList);
    }

    // Price range slider (jQuery UI) like shop.html
    if (window.jQuery && jQuery.ui && document.getElementById('slider-range')) {
        const $ = window.jQuery;
        const minDefault = Number(document.getElementById('min_price_input')?.value || 0);
        const maxDefault = Number(document.getElementById('max_price_input')?.value || 1000);

        $('#slider-range').slider({
            range: true,
            min: 0,
            max: 1000,
            values: [minDefault, maxDefault],
            slide: function(event, ui) {
                const text = '$' + ui.values[0] + ' - $' + ui.values[1];
                document.getElementById('amount').value = text;
            },
            change: function(event, ui) {
                document.getElementById('min_price_input').value = ui.values[0];
                document.getElementById('max_price_input').value = ui.values[1];
            }
        });

        const initVals = $('#slider-range').slider('values');
        document.getElementById('amount').value = '$' + initVals[0] + ' - $' + initVals[1];
    }
});
</script>
@endsection








