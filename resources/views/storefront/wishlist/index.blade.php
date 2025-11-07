@extends('storefront.layout')

@section('title', 'My Wishlist - Sip & Go')
@section('description', 'View your wishlist items')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">My Wishlist</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="{{ route('home') }}" class="text-gray-900 flex-align gap-8 hover-text-main-600">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-main-600"> Wishlist </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ================================ Cart Section Start ================================ -->
<section class="cart py-80">
    <div class="container container-lg">
        @if(session('success'))
        <div class="alert alert-success mb-32 bg-success-50 border border-success-200 text-success-800 px-24 py-16 rounded-8">
            <i class="ph ph-check-circle me-8"></i>{{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger mb-32 bg-danger-50 border border-danger-200 text-danger-800 px-24 py-16 rounded-8">
            <i class="ph ph-warning-circle me-8"></i>{{ session('error') }}
        </div>
        @endif

        @if(session('info'))
        <div class="alert alert-info mb-32 bg-info-50 border border-info-200 text-info-800 px-24 py-16 rounded-8">
            <i class="ph ph-info me-8"></i>{{ session('info') }}
        </div>
        @endif

        @if(empty($items))
        <!-- Empty Wishlist -->
        <div class="text-center py-80">
            <div class="mb-24">
                <i class="ph ph-heart text-6xl text-gray-400"></i>
            </div>
            <h2 class="text-heading-two mb-16">Your wishlist is empty</h2>
            <p class="text-gray-600 mb-32">Start adding products to your wishlist</p>
            <a href="{{ route('products.index') }}" class="btn btn-main rounded-pill d-inline-flex align-items-center gap-8">
                <i class="ph ph-arrow-left"></i> Continue Shopping
            </a>
        </div>
        @else
        <div class="row gy-4">
            <div class="col-lg-11">
                <div class="cart-table border border-gray-100 rounded-8">
                    <div class="overflow-x-auto scroll-sm scroll-sm-horizontal">
                        <table class="table rounded-8 overflow-hidden">
                            <thead>
                                <tr class="border-bottom border-neutral-100">
                                    <th class="h6 mb-0 text-lg fw-bold px-40 py-32 border-end border-neutral-100">Delete</th>
                                    <th class="h6 mb-0 text-lg fw-bold px-40 py-32 border-end border-neutral-100">Product Name</th>
                                    <th class="h6 mb-0 text-lg fw-bold px-40 py-32 border-end border-neutral-100">Unit Price</th>
                                    <th class="h6 mb-0 text-lg fw-bold px-40 py-32 border-end border-neutral-100">Stock Status</th>
                                    <th class="h6 mb-0 text-lg fw-bold px-40 py-32"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td class="px-40 py-32 border-end border-neutral-100">
                                        <form action="{{ route('wishlist.remove', $item['product_id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-tr-btn flex-align gap-12 hover-text-danger-600">
                                                <i class="ph ph-x-circle text-2xl d-flex"></i>
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-40 py-32 border-end border-neutral-100">
                                        <div class="table-product d-flex align-items-center gap-24">
                                            <a href="{{ route('products.show', $item['product']->slug) }}" class="table-product__thumb border border-gray-100 rounded-8 flex-center">
                                                @if($item['product']->primary_image_url)
                                                    <img src="{{ $item['product']->primary_image_url }}" alt="{{ $item['product']->name }}">
                                                @else
                                                    <div class="w-100 h-100 flex-center bg-gray-50">
                                                        <i class="ph ph-wine-bottle text-4xl text-gray-400"></i>
                                                    </div>
                                                @endif
                                            </a>
                                            <div class="table-product__content text-start">
                                                <h6 class="title text-lg fw-semibold mb-8">
                                                    <a href="{{ route('products.show', $item['product']->slug) }}" class="link text-line-2 hover-text-main-600">{{ $item['product']->name }}</a>
                                                </h6>
                                                <div class="flex-align gap-16 mb-16">
                                                    <div class="flex-align gap-6">
                                                        <span class="text-md fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                        <span class="text-md fw-semibold text-gray-900">4.8</span>
                                                    </div>
                                                    <span class="text-sm fw-medium text-gray-200">|</span>
                                                    <span class="text-neutral-600 text-sm">{{ $item['product']->category->name ?? 'Uncategorized' }}</span>
                                                </div>
                                                <div class="flex-align gap-16">
                                                    <a href="{{ route('products.show', $item['product']->slug) }}" class="product-card__cart btn bg-gray-50 text-heading text-sm hover-bg-main-600 hover-text-white py-7 px-8 rounded-8 flex-center gap-8 fw-medium">
                                                        View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-40 py-32 border-end border-neutral-100">
                                        <span class="text-lg h6 mb-0 fw-semibold">{{ $item['product']->formatted_price }}</span>
                                    </td>
                                    <td class="px-40 py-32 border-end border-neutral-100">
                                        @if($item['product']->is_low_stock)
                                            <span class="text-lg h6 mb-0 fw-semibold text-warning-600">Low Stock</span>
                                        @elseif($item['product']->current_stock > 0)
                                            <span class="text-lg h6 mb-0 fw-semibold text-success-600">In Stock</span>
                                        @else
                                            <span class="text-lg h6 mb-0 fw-semibold text-danger-600">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td class="px-40 py-32">
                                        <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-main-two rounded-8 px-64">
                                                Add To Cart <i class="ph ph-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- ================================ Cart Section End ================================ -->

@endsection

