@extends('storefront.layout')

@section('title', 'Shopping Cart - Sip & Go')
@section('description', 'Review your shopping cart items')

@section('content')
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Shopping Cart</h1>
            <p class="text-lg text-gray-600">Review your items before checkout</p>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
        @endif

        @if(empty($items))
        <!-- Empty Cart -->
        <div class="text-center py-16">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-600 mb-6">Start shopping to add items to your cart</p>
            <a href="{{ route('shop') }}" class="inline-block bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Continue Shopping
            </a>
        </div>
        @else
        <!-- Cart Items -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items List -->
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <div class="divide-y divide-gray-200">
                        @foreach($items as $item)
                        <div class="p-6 flex flex-col sm:flex-row gap-4">
                            <!-- Product Image -->
                            <div class="flex-shrink-0">
                                <a href="{{ route('products.show', $item['product']->slug) }}" class="block w-24 h-24 bg-gray-100 rounded-lg overflow-hidden">
                                    @if($item['product']->primary_image_url)
                                        <img src="{{ $item['product']->primary_image_url }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-wine-bottle text-2xl text-gray-400"></i>
                                        </div>
                                    @endif
                                </a>
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                            <a href="{{ route('products.show', $item['product']->slug) }}" class="hover:text-amber-600 transition-colors">
                                                {{ $item['product']->name }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-500 mb-2">
                                            {{ $item['product']->category->name ?? 'Uncategorized' }}
                                        </p>
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ '$' . number_format($item['unit_price'], 2) }}
                                        </p>
                                    </div>
                                    <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST" class="ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Remove item">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- Quantity Controls -->
                                <div class="mt-4 flex items-center gap-4">
                                    <label for="quantity-{{ $item['product_id'] }}" class="text-sm font-medium text-gray-700">Quantity:</label>
                                    <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="quantity-btn-decrease w-8 h-8 flex items-center justify-center border border-gray-300 rounded hover:bg-gray-100" data-product-id="{{ $item['product_id'] }}">
                                            <i class="fas fa-minus text-xs"></i>
                                        </button>
                                        <input type="number"
                                               id="quantity-{{ $item['product_id'] }}"
                                               name="quantity"
                                               value="{{ $item['quantity'] }}"
                                               min="1"
                                               max="99"
                                               class="w-16 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500"
                                               onchange="this.form.submit()">
                                        <button type="button" class="quantity-btn-increase w-8 h-8 flex items-center justify-center border border-gray-300 rounded hover:bg-gray-100" data-product-id="{{ $item['product_id'] }}">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                    </form>
                                    <div class="ml-auto">
                                        <p class="text-lg font-bold text-gray-900">
                                            {{ '$' . number_format($item['total'], 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Continue Shopping -->
                <div class="mt-6">
                    <a href="{{ route('shop') }}" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>Continue Shopping
                    </a>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Order Summary</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ $count }} {{ Str::plural('item', $count) }})</span>
                            <span class="font-semibold">{{ '$' . number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="font-semibold">Calculated at checkout</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span class="font-semibold">Calculated at checkout</span>
                        </div>
                        <div class="border-t border-gray-300 pt-4">
                            <div class="flex justify-between text-lg font-bold text-gray-900">
                                <span>Total</span>
                                <span>{{ '$' . number_format($subtotal, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('checkout') }}" class="block w-full bg-amber-600 hover:bg-amber-700 text-white text-center py-3 px-4 rounded-lg font-semibold transition-colors">
                            <i class="fas fa-lock mr-2"></i>Proceed to Checkout
                        </a>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 text-center py-2 px-4 rounded-lg font-semibold transition-colors" onclick="return confirm('Are you sure you want to clear your cart?')">
                                <i class="fas fa-trash-alt mr-2"></i>Clear Cart
                            </button>
                        </form>
                    </div>

                    <!-- Age Verification Notice -->
                    <div class="mt-6 p-4 bg-amber-50 border border-amber-200 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-amber-600 mr-2 mt-1"></i>
                            <div>
                                <p class="text-sm font-semibold text-amber-800">Age Verification Required</p>
                                <p class="text-xs text-amber-700 mt-1">You must be 21+ to purchase alcohol products.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity increase/decrease buttons
    document.querySelectorAll('.quantity-btn-increase').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const input = document.getElementById('quantity-' + productId);
            const currentValue = parseInt(input.value);
            if (currentValue < 99) {
                input.value = currentValue + 1;
                input.form.submit();
            }
        });
    });

    document.querySelectorAll('.quantity-btn-decrease').forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const input = document.getElementById('quantity-' + productId);
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                input.form.submit();
            }
        });
    });
});
</script>
@endpush
@endsection

