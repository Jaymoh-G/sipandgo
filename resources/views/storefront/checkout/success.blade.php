@extends('storefront.layout')

@section('title', 'Order Confirmation - Sip & Go')
@section('description', 'Your order has been placed successfully')

@section('content')
<div class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
        @endif

        <!-- Success Header -->
        <div class="text-center mb-12">
            <div class="inline-block bg-green-100 rounded-full p-4 mb-4">
                <i class="fas fa-check-circle text-6xl text-green-600"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Order Confirmed!</h1>
            <p class="text-lg text-gray-600">Thank you for your order. We've sent a confirmation email to {{ $order->customer->email }}</p>
        </div>

        <!-- Order Details -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Order Number</p>
                    <p class="text-lg font-bold text-gray-900">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Order Date</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $order->created_at->format('F j, Y g:i A') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Status</p>
                    <p class="text-lg font-semibold text-gray-900 capitalize">{{ $order->status }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Payment Status</p>
                    <p class="text-lg font-semibold text-gray-900 capitalize">{{ $order->payment_status }}</p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Order Items</h3>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex justify-between items-start pb-4 border-b border-gray-100">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">{{ $item->product_name }}</p>
                            <p class="text-sm text-gray-600">SKU: {{ $item->product_sku }}</p>
                            <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                        </div>
                        <p class="font-semibold text-gray-900">${{ number_format($item->total_price, 2) }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary -->
            <div class="border-t border-gray-200 pt-6 mt-6">
                <div class="space-y-2">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Tax</span>
                        <span>${{ number_format($order->tax_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span>${{ number_format($order->shipping_amount, 2) }}</span>
                    </div>
                    <div class="border-t border-gray-300 pt-2 mt-2">
                        <div class="flex justify-between text-xl font-bold text-gray-900">
                            <span>Total</span>
                            <span class="text-amber-600">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Shipping Address</h2>
            <p class="text-gray-700">
                {{ $order->shipping_address['name'] }}<br>
                {{ $order->shipping_address['address_line_1'] }}<br>
                @if($order->shipping_address['address_line_2'])
                    {{ $order->shipping_address['address_line_2'] }}<br>
                @endif
                {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['state'] }} {{ $order->shipping_address['postal_code'] }}<br>
                {{ $order->shipping_address['country'] }}
            </p>
        </div>

        <!-- Next Steps -->
        <div class="bg-amber-50 border border-amber-200 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-bold text-amber-900 mb-2">What's Next?</h3>
            <ul class="space-y-2 text-amber-800">
                <li><i class="fas fa-check-circle mr-2"></i>You'll receive an order confirmation email shortly</li>
                <li><i class="fas fa-check-circle mr-2"></i>We'll send you tracking information once your order ships</li>
                <li><i class="fas fa-check-circle mr-2"></i>Valid ID will be required upon delivery (21+ only)</li>
            </ul>
        </div>

        <!-- Actions -->
        <div class="text-center space-x-4">
            <a href="{{ route('shop') }}" class="inline-block bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                <i class="fas fa-shopping-bag mr-2"></i>Continue Shopping
            </a>
            <a href="{{ route('home') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-3 rounded-lg font-semibold transition-colors">
                <i class="fas fa-home mr-2"></i>Back to Home
            </a>
        </div>
    </div>
</div>
@endsection

