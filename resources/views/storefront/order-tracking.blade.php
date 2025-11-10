@extends('storefront.layout')

@section('title', 'Order Tracking - Sip & Go')
@section('description', 'Track your order status and delivery information')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Order Tracking</h6>
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
                    Order Tracking
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ============================ Order Tracking Section Start =============================== -->
<section class="order-tracking py-80">
    <div class="container container-lg">
        <!-- Header -->
        <div class="section-heading text-center mb-32">
            <h2 class="text-heading-two mb-8">Track Your Order</h2>
            <p class="text-gray-600 max-w-700 mx-auto">
                Enter your order number and email address to track your order status and delivery information.
            </p>
        </div>

        <!-- Search Form -->
        <div class="row mb-40">
            <div class="col-12">
                <div class="p-16 border border-gray-100 rounded-16 bg-white">
                    <form action="{{ route('order.tracking.search') }}" method="POST">
                        @csrf

                        @if(session('error'))
                            <div class="alert alert-danger bg-red-50 border border-red-200 text-red-800 rounded-8 p-12 mb-16">
                                <i class="ph ph-warning-circle me-8"></i>{{ session('error') }}
                            </div>
                        @endif

                        <div class="row g-3 align-items-end">
                            <div class="col-md-5">
                                <label for="order_number" class="form-label text-gray-900 fw-medium mb-4">Order Number</label>
                                <input type="text" id="order_number" name="order_number" required
                                       class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                       placeholder="Enter your order number" value="{{ old('order_number') }}">
                                @error('order_number')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label for="email" class="form-label text-gray-900 fw-medium mb-4">Email Address</label>
                                <input type="email" id="email" name="email" required
                                       class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                       placeholder="Enter your email address" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-main rounded-8 w-100 d-inline-flex align-items-center justify-content-center gap-8 py-12">
                                    Track <i class="ph ph-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Details (if order found) -->
        @if(isset($order))
        <div class="row g-4">
            <!-- Column 1: Order Information, Addresses & Delivery -->
            <div class="col-lg-6">
                <div class="product-card border border-gray-100 rounded-16 p-32 h-100">
                    <div class="mb-24">
                        <h3 class="text-heading-two mb-8">Order #{{ $order->order_number }}</h3>
                        <p class="text-gray-600 mb-16">
                            Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}
                        </p>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'processing' => 'bg-blue-100 text-blue-800',
                                'shipped' => 'bg-purple-100 text-purple-800',
                                'delivered' => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-red-100 text-red-800',
                                'refunded' => 'bg-gray-100 text-gray-800',
                            ];
                            $statusColor = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <div class="mb-24">
                            <span class="badge px-16 py-8 rounded-8 fw-semibold text-sm {{ $statusColor }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row g-4 mb-24">
                        <div class="col-md-6">
                            <div class="border-top border-gray-100 pt-24">
                                <h4 class="text-lg fw-semibold text-heading mb-16">Billing Address</h4>
                                @if($order->billing_address)
                                    <p class="text-gray-600 mb-0">
                                        {{ $order->billing_address['first_name'] ?? '' }} {{ $order->billing_address['last_name'] ?? '' }}<br>
                                        {{ $order->billing_address['address_line_1'] ?? '' }}<br>
                                        @if($order->billing_address['address_line_2'] ?? '')
                                            {{ $order->billing_address['address_line_2'] }}<br>
                                        @endif
                                        {{ $order->billing_address['city'] ?? '' }}, {{ $order->billing_address['state'] ?? '' }} {{ $order->billing_address['postal_code'] ?? '' }}<br>
                                        {{ $order->billing_address['country'] ?? '' }}
                                    </p>
                                @else
                                    <p class="text-gray-500">No billing address available</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border-top border-gray-100 pt-24">
                                <h4 class="text-lg fw-semibold text-heading mb-16">Shipping Address</h4>
                                @if($order->shipping_address)
                                    <p class="text-gray-600 mb-0">
                                        {{ $order->shipping_address['first_name'] ?? '' }} {{ $order->shipping_address['last_name'] ?? '' }}<br>
                                        {{ $order->shipping_address['address_line_1'] ?? '' }}<br>
                                        @if($order->shipping_address['address_line_2'] ?? '')
                                            {{ $order->shipping_address['address_line_2'] }}<br>
                                        @endif
                                        {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} {{ $order->shipping_address['postal_code'] ?? '' }}<br>
                                        {{ $order->shipping_address['country'] ?? '' }}
                                    </p>
                                @else
                                    <p class="text-gray-500">No shipping address available</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Information -->
                    @if($order->delivery)
                    <div class="border-top border-gray-100 pt-24">
                        <h4 class="text-lg fw-semibold text-heading mb-16">Delivery Information</h4>
                        <div class="d-flex flex-column gap-16">
                            @if($order->delivery->tracking_number)
                            <div>
                                <p class="text-gray-600 mb-4">
                                    <strong class="text-heading">Tracking Number:</strong>
                                </p>
                                <p class="text-main-600 fw-semibold mb-0">{{ $order->delivery->tracking_number }}</p>
                            </div>
                            @endif
                            @if($order->delivery->carrier)
                            <div>
                                <p class="text-gray-600 mb-4">
                                    <strong class="text-heading">Carrier:</strong>
                                </p>
                                <p class="text-gray-600 mb-0">{{ $order->delivery->carrier }}</p>
                            </div>
                            @endif
                            @if($order->delivery->status)
                            <div>
                                <p class="text-gray-600 mb-4">
                                    <strong class="text-heading">Delivery Status:</strong>
                                </p>
                                <span class="badge px-12 py-6 rounded-6 fw-semibold text-sm bg-main-100 text-main-800">
                                    {{ ucfirst(str_replace('_', ' ', $order->delivery->status)) }}
                                </span>
                            </div>
                            @endif
                            @if($order->delivery->estimated_delivery_date)
                            <div>
                                <p class="text-gray-600 mb-4">
                                    <strong class="text-heading">Estimated Delivery:</strong>
                                </p>
                                <p class="text-gray-600 mb-0">{{ $order->delivery->estimated_delivery_date->format('F d, Y') }}</p>
                            </div>
                            @endif
                            @if($order->delivery->shipped_at)
                            <div>
                                <p class="text-gray-600 mb-4">
                                    <strong class="text-heading">Shipped On:</strong>
                                </p>
                                <p class="text-gray-600 mb-0">{{ $order->delivery->shipped_at->format('F d, Y \a\t g:i A') }}</p>
                            </div>
                            @endif
                            @if($order->delivery->delivered_at)
                            <div>
                                <p class="text-gray-600 mb-4">
                                    <strong class="text-heading">Delivered On:</strong>
                                </p>
                                <p class="text-gray-600 mb-0">{{ $order->delivery->delivered_at->format('F d, Y \a\t g:i A') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="border-top border-gray-100 pt-24">
                        <p class="text-gray-500">No delivery information available yet.</p>
                    </div>
                    @endif

                    @if($order->payment_method)
                    <div class="border-top border-gray-100 pt-24 mt-24">
                        <h4 class="text-lg fw-semibold text-heading mb-16">Payment Information</h4>
                        <p class="text-gray-600 mb-8">
                            <strong class="text-heading">Payment Method:</strong><br>
                            {{ ucfirst($order->payment_method) }}
                        </p>
                        <p class="text-gray-600 mb-0">
                            <strong class="text-heading">Payment Status:</strong><br>
                            <span class="badge px-12 py-6 rounded-6 fw-semibold text-sm {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Column 2: Order Items & Summary -->
            <div class="col-lg-6">
                <div class="product-card border border-gray-100 rounded-16 p-32 h-100">
                    <h4 class="text-lg fw-semibold text-heading mb-16">Order Items</h4>
                    <div class="d-flex flex-column gap-16 mb-24">
                        @foreach($order->items as $item)
                        <div class="border-bottom border-gray-100 pb-16">
                            <div class="d-flex align-items-start gap-12 mb-8">
                                @if($item->product && $item->product->primary_image_url)
                                    <img src="{{ $item->product->primary_image_url }}" alt="{{ $item->product_name }}" class="w-48 h-48 object-fit-cover rounded-8 flex-shrink-0">
                                @endif
                                <div class="flex-grow-1">
                                    <h6 class="text-heading mb-4">{{ $item->product_name }}</h6>
                                    @if($item->product_sku)
                                        <p class="text-gray-500 text-xs mb-4">SKU: {{ $item->product_sku }}</p>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-gray-600 text-sm">Qty: {{ $item->quantity }}</span>
                                        <span class="text-heading fw-semibold">Ksh {{ number_format($item->total_price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-top border-gray-100 pt-24">
                        <h4 class="text-lg fw-semibold text-heading mb-16">Order Summary</h4>
                        <div class="d-flex flex-column gap-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="text-heading fw-medium">Ksh {{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            @if($order->tax_amount > 0)
                            <div class="d-flex justify-content-between">
                                <span class="text-gray-600">Tax:</span>
                                <span class="text-heading fw-medium">Ksh {{ number_format($order->tax_amount, 2) }}</span>
                            </div>
                            @endif
                            @if($order->shipping_amount > 0)
                            <div class="d-flex justify-content-between">
                                <span class="text-gray-600">Shipping:</span>
                                <span class="text-heading fw-medium">Ksh {{ number_format($order->shipping_amount, 2) }}</span>
                            </div>
                            @endif
                            @if($order->discount_amount > 0)
                            <div class="d-flex justify-content-between">
                                <span class="text-gray-600">Discount:</span>
                                <span class="text-heading fw-medium text-green-600">-Ksh {{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                            @endif
                            <div class="d-flex justify-content-between border-top border-gray-100 pt-16 mt-8">
                                <span class="text-heading fw-semibold text-lg">Total:</span>
                                <span class="text-heading fw-bold text-lg">Ksh {{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- ============================ Order Tracking Section End =============================== -->

@endsection

