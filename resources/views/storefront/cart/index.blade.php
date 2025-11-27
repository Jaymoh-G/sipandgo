@extends('storefront.layout')

@section('title', 'Shopping Cart - Sip & Go')
@section('description', 'Review your shopping cart items')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Cart</h6>
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
                    Product Cart
                </li>
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

        @if(empty($items))
        <!-- Empty Cart -->
        <div class="text-center py-80">
            <div class="mb-24">
                <i class="ph ph-shopping-cart text-6xl text-gray-400"></i>
            </div>
            <h2 class="text-heading-two mb-16">Your cart is empty</h2>
            <p class="text-gray-600 mb-32">Start shopping to add items to your cart</p>
            <a href="{{ route('products.index') }}" class="btn btn-main rounded-pill d-inline-flex align-items-center gap-8">
                <i class="ph ph-arrow-left"></i> Continue Shopping
            </a>
        </div>
        @else
        <div class="row gy-4">
            <div class="col-xl-9 col-lg-8">
                <div class="cart-table border border-gray-100 rounded-8 px-40 py-48">
                    <div class="overflow-x-auto scroll-sm scroll-sm-horizontal">
                        <table class="table style-three">
                            <thead>
                                <tr>
                                    <th class="h6 mb-0 text-lg fw-bold">Delete</th>
                                    <th class="h6 mb-0 text-lg fw-bold">Product Name</th>
                                    <th class="h6 mb-0 text-lg fw-bold">Price</th>
                                    <th class="h6 mb-0 text-lg fw-bold">Quantity</th>
                                    <th class="h6 mb-0 text-lg fw-bold">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>
                                        <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-tr-btn flex-align gap-12 hover-text-danger-600">
                                                <i class="ph ph-x-circle text-2xl d-flex"></i>
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="table-product d-flex align-items-center gap-24">
                                            <a href="{{ route('products.show', $item['product']->slug) }}" class="table-product__thumb border border-gray-100 rounded-8 flex-center">
                                                @if($item['product']->primary_image_url)
                                                    <img src="{{ $item['product']->primary_image_url }}" alt="{{ $item['product']->name }}" class="w-100 h-100 object-fit-cover">
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
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-lg h6 mb-0 fw-semibold">{{ $item['product']->formatted_price }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="d-flex rounded-4 overflow-hidden">
                                                <button type="button" class="quantity__minus border border-end border-gray-100 flex-shrink-0 h-48 w-48 text-neutral-600 flex-center hover-bg-main-600 hover-text-white" onclick="decreaseQuantity({{ $item['product_id'] }})">
                                                    <i class="ph ph-minus"></i>
                                                </button>
                                                <input type="number"
                                                       name="quantity"
                                                       id="quantity-{{ $item['product_id'] }}"
                                                       value="{{ $item['quantity'] }}"
                                                       min="1"
                                                       max="99"
                                                       class="quantity__input flex-grow-1 border border-gray-100 border-start-0 border-end-0 text-center w-32 px-4"
                                                       onchange="this.form.submit()">
                                                <button type="button" class="quantity__plus border border-end border-gray-100 flex-shrink-0 h-48 w-48 text-neutral-600 flex-center hover-bg-main-600 hover-text-white" onclick="increaseQuantity({{ $item['product_id'] }})">
                                                    <i class="ph ph-plus"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <span class="text-lg h6 mb-0 fw-semibold">Ksh {{ number_format($item['total'], 2) }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex-between flex-wrap gap-16 mt-32">
                        <a href="{{ route('products.index') }}" class="text-lg text-gray-500 hover-text-main-600 d-flex align-items-center gap-8">
                            <i class="ph ph-arrow-left"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="cart-sidebar border border-gray-100 rounded-8 px-24 py-40">
                    <h6 class="text-xl mb-32">Cart Totals</h6>
                    <div class="bg-color-three rounded-8 p-24">
                        <div class="mb-32 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two">Subtotal</span>
                            <span class="text-gray-900 fw-semibold">Ksh {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="mb-32 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two">Estimated Delivery</span>
                            <span class="text-gray-900 fw-semibold">Free</span>
                        </div>
                        <div class="mb-0 flex-between gap-8">
                            <span class="text-gray-900 font-heading-two">Estimated Tax</span>
                            <span class="text-gray-900 fw-semibold">Calculated at checkout</span>
                        </div>
                    </div>
                    <div class="bg-color-three rounded-8 p-24 mt-24">
                        <div class="flex-between gap-8">
                            <span class="text-gray-900 text-xl fw-semibold">Total</span>
                            <span class="text-gray-900 text-xl fw-semibold">Ksh {{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-main mt-40 py-18 w-100 rounded-8">Proceed to checkout</a>

                    <!-- Age Verification Notice -->
                    <div class="mt-24 p-16 bg-main-50 border border-main-200 rounded-8">
                        <div class="flex-align gap-12">
                            <i class="ph ph-warning text-main-600 text-xl"></i>
                            <div>
                                <p class="text-sm fw-semibold text-gray-900 mb-4">Age Verification Required</p>
                                <p class="text-xs text-gray-600 mb-0">You must be 18+ to purchase alcohol products.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- ================================ Cart Section End ================================ -->

@push('scripts')
<script>
function increaseQuantity(productId) {
    const input = document.getElementById('quantity-' + productId);
    const currentValue = parseInt(input.value);
    if (currentValue < 99) {
        input.value = currentValue + 1;
        input.form.submit();
    }
}

function decreaseQuantity(productId) {
    const input = document.getElementById('quantity-' + productId);
    const currentValue = parseInt(input.value);
    if (currentValue > 1) {
        input.value = currentValue - 1;
        input.form.submit();
    }
}
</script>
@endpush
@endsection
