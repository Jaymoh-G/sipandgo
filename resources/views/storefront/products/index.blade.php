@extends('storefront.layout')

@section('title', 'All Products - Sip & Go')
@section('description', 'Browse our complete collection of premium spirits, wines, and liquors')

@section('content')
<section class="shop pb-80" style="padding-top: 0 !important; margin-top: 0 !important;">
    <div class="container container-lg" style="padding-top: 0 !important; margin-top: 0 !important;">
        <div class="row" style="margin-top: 0 !important;">
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
                                <a href="{{ route('products.index', ['category' => $category->slug] + request()->except('page')) }}" class="{{ request('category') === $category->slug ? 'text-main-600' : 'text-gray-900 hover-text-main-600' }}">{{ $category->name }} <span class="text-gray-500">({{ $category->products_count ?? 0 }})</span></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Price Filter -->
                    <div class="shop-sidebar__box border border-gray-100 rounded-8 p-32 mb-32">
                        <h6 class="text-xl border-bottom border-gray-100 pb-24 mb-24">Filter by Price</h6>
                        <form method="GET" action="{{ route('products.index') }}" id="price-filter-form">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            @if(request('brand'))
                                <input type="hidden" name="brand" value="{{ request('brand') }}">
                            @endif
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                            @endif
                            @if(request('direction'))
                                <input type="hidden" name="direction" value="{{ request('direction') }}">
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
                                <input type="hidden" name="max_price" id="max_price_input" value="{{ request('max_price', 50000) }}">
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
                            @foreach($brands as $brand => $count)
                            <li class="mb-24">
                                <a href="{{ route('products.index', array_merge(request()->except('page'), ['brand' => $brand])) }}" class="{{ request('brand') === $brand ? 'text-main-600' : 'text-gray-900 hover-text-main-600' }}">{{ $brand }} <span class="text-gray-500">({{ $count }})</span></a>
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
                                <a href="{{ route('products.show', $product->slug) }}" class="product-card__thumb flex-center rounded-8 bg-gray-50 position-relative overflow-hidden">
                                    @if($product->primary_image_url)
                                        <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                                    @else
                                        <div class="w-100 h-100 flex-center">
                                            <i class="fas fa-wine-bottle text-6xl text-gray-400"></i>
                                        </div>
                                    @endif
                                </a>
                                <div class="product-card__content mt-16">
                                    <h6 class="title text-lg fw-semibold mt-12 mb-8">
                                        <a href="{{ route('products.show', $product->slug) }}" class="link text-line-2 hover-text-main-600">{{ $product->name }}</a>
                                    </h6>
                                    <div class="flex-align mb-12 gap-6">
                                        <span class="text-xs fw-medium text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                    </div>
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
                                            <button type="submit" class="w-48 h-48 bg-main-600 text-white hover-bg-main-800 flex-center rounded-8 border-0" title="Remove from Wishlist">
                                                <i class="ph ph-heart-fill text-white"></i>
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

@push('styles')
<style>
    /* Remove white space at top of products page */
    main .shop {
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    .shop .container {
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    .shop .row {
        margin-top: 0 !important;
    }

    /* Remove spacing from header on products page */
    .header-middle {
        margin-bottom: 0 !important;
    }

    main {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    /* Ensure no gap between header and content */
    .header-middle + main,
    .header + main {
        margin-top: 0 !important;
    }

    /* Remove any default spacing */
    .shop {
        position: relative;
        top: 0;
    }

    /* Aggressive fix for mobile - remove all spacing */
    @media (max-width: 991px) {
        .shop {
            margin-top: -30px !important;
            padding-top: 0 !important;
        }

        .shop .container {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }

        .shop .row {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        /* Reduce header spacing on mobile */
        .header-middle {
            padding: 4px 0 !important;
            margin-bottom: 0 !important;
        }

        .header-top {
            padding: 4px 0 !important;
        }
    }

    /* Desktop fix - minimal spacing */
    @media (min-width: 992px) {
        .shop {
            margin-top: -10px !important;
            padding-top: 0 !important;
        }
    }

    /* Ensure both slider handles are visible and draggable */
    .custom--range {
        position: relative;
        padding: 20px 0 !important;
        overflow: visible !important;
    }

    #slider-range.ui-slider {
        position: relative !important;
        margin: 20px 0 !important;
        overflow: visible !important;
    }

    #slider-range .ui-slider-handle {
        width: 20px !important;
        height: 20px !important;
        background-color: var(--main-600) !important;
        border: 3px solid #ffffff !important;
        cursor: grab !important;
        z-index: 10 !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.3) !important;
        position: absolute !important;
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        margin-left: -10px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
    }

    #slider-range .ui-slider-handle:active {
        cursor: grabbing !important;
        transform: translateY(-50%) scale(1.5) !important;
        z-index: 15 !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.5) !important;
    }

    #slider-range .ui-slider-handle:hover {
        transform: translateY(-50%) scale(1.3) !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.4) !important;
        z-index: 12 !important;
    }

    /* Ensure the second handle (max) is always visible */
    #slider-range .ui-slider-handle:last-of-type {
        z-index: 11 !important;
    }

    #slider-range .ui-slider-handle:last-of-type:hover {
        z-index: 13 !important;
    }

    #slider-range .ui-slider-handle:last-of-type:active {
        z-index: 16 !important;
    }

    /* Ensure range bar doesn't hide handles */
    #slider-range .ui-slider-range {
        z-index: 1 !important;
    }

    /* Style the price display input */
    .custom--range__prices {
        width: auto !important;
        min-width: 180px !important;
        max-width: 220px !important;
        padding: 8px 12px !important;
        border: 1px solid var(--gray-200) !important;
        border-radius: 8px !important;
        background-color: #ffffff !important;
        color: var(--main-600) !important;
        font-weight: 600 !important;
        font-size: 14px !important;
        text-align: center !important;
        transition: all 0.3s ease !important;
    }

    .custom--range__prices:focus {
        outline: none !important;
        border-color: var(--main-600) !important;
        box-shadow: 0 0 0 3px rgba(225, 167, 67, 0.1) !important;
    }

    .custom--range__content {
        flex-wrap: wrap !important;
        gap: 8px !important;
    }

    .custom--range__content span {
        white-space: nowrap !important;
    }

    @media (max-width: 576px) {
        .custom--range__prices {
            min-width: 150px !important;
            max-width: 180px !important;
            font-size: 13px !important;
            padding: 6px 10px !important;
        }
    }
</style>
@endpush

@push('scripts')
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

    // Price range slider (jQuery UI) - Override main.js initialization with KES
    function initPriceSlider() {
        if (window.jQuery && jQuery.ui && document.getElementById('slider-range')) {
            const $ = window.jQuery;
            let minDefault = Number(document.getElementById('min_price_input')?.value || 0);
            let maxDefault = Number(document.getElementById('max_price_input')?.value || 50000);

            // Ensure min and max are different and valid
            if (minDefault >= maxDefault) {
                minDefault = 0;
                maxDefault = 50000;
            }
            if (minDefault < 0) minDefault = 0;
            if (maxDefault > 50000) maxDefault = 50000;

            // Destroy existing slider if it exists (from main.js)
            if ($('#slider-range').hasClass('ui-slider')) {
                $('#slider-range').slider('destroy');
            }

            // Initialize with KES currency - ensure both handles are draggable
            $('#slider-range').slider({
                range: true,
                min: 0,
                max: 50000,
                step: 100, // Add step for smoother dragging
                values: [minDefault, maxDefault],
                slide: function(event, ui) {
                    // Prevent handles from crossing each other
                    if (ui.values[0] >= ui.values[1]) {
                        return false;
                    }
                    const text = 'Ksh ' + ui.values[0].toLocaleString() + ' - Ksh ' + ui.values[1].toLocaleString();
                    $('#amount').val(text);
                    // Update hidden inputs immediately on slide
                    $('#min_price_input').val(ui.values[0]);
                    $('#max_price_input').val(ui.values[1]);
                },
                change: function(event, ui) {
                    // Ensure values are set when slider changes
                    $('#min_price_input').val(ui.values[0]);
                    $('#max_price_input').val(ui.values[1]);
                }
            });

            // Ensure both handles are visible and draggable
            setTimeout(function() {
                const handles = $('#slider-range .ui-slider-handle');
                if (handles.length === 2) {
                    handles.each(function(index) {
                        $(this).css({
                            'cursor': 'grab',
                            'z-index': '3',
                            'display': 'block',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    });
                }
            }, 50);

            // Set initial display value with KES
            const initVals = $('#slider-range').slider('values');
            $('#amount').val('Ksh ' + initVals[0].toLocaleString() + ' - Ksh ' + initVals[1].toLocaleString());

            // Update hidden inputs with initial values
            $('#min_price_input').val(initVals[0]);
            $('#max_price_input').val(initVals[1]);
        }
    }

    // Run immediately and also after a short delay to override main.js
    initPriceSlider();
    setTimeout(initPriceSlider, 100);

    // Ensure values are set before form submission
    const priceFilterForm = document.getElementById('price-filter-form');
    if (priceFilterForm) {
        priceFilterForm.addEventListener('submit', function(e) {
            const slider = $('#slider-range');
            if (slider.hasClass('ui-slider')) {
                const values = slider.slider('values');
                $('#min_price_input').val(values[0]);
                $('#max_price_input').val(values[1]);
            }
        });
    }
});
</script>
@endpush
@endsection

