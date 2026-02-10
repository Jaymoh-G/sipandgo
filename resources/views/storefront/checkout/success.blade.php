@extends('storefront.layout')

@section('title', 'Order Confirmation - Sip & Go')
@section('description', 'Your order has been placed successfully')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Order Confirmation</h6>
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
                    Order Confirmation
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ================================= Order Success Page Start ===================================== -->
<section class="checkout py-80">
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

        <!-- Success Header -->
        <div class="text-center mb-48" data-aos="fade-up" data-aos-duration="400">
            <div class="inline-block bg-success-50 rounded-circle p-32 mb-24">
                <i class="ph ph-check-circle text-6xl text-success-600"></i>
            </div>
            <h1 class="text-heading-two mb-16">Order Confirmed!</h1>
            <p class="text-lg text-gray-600">
                Thank you for your order.
                @if($order->customer->email && !str_ends_with($order->customer->email, '@sipandgo.local'))
                    We've sent a confirmation email to <span class="fw-semibold text-gray-900">{{ $order->customer->email }}</span>
                @else
                    We'll contact you shortly to confirm your order.
                @endif
            </p>
        </div>

        <div class="row gy-4">
            <!-- Order Details -->
            <div class="col-xl-8 col-lg-7">
                <div class="border border-gray-100 rounded-8 px-40 py-48 mb-32" data-aos="fade-up" data-aos-duration="400">
                    <h2 class="text-heading mb-32">Order Details</h2>

                    <div class="row gy-3 mb-32">
                        <div class="col-sm-6">
                            <p class="text-sm text-gray-600 mb-8">Order Number</p>
                            <p class="text-lg fw-bold text-gray-900">{{ $order->order_number }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-sm text-gray-600 mb-8">Order Date</p>
                            <p class="text-lg fw-semibold text-gray-900">{{ $order->created_at->format('F j, Y g:i A') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-sm text-gray-600 mb-8">Status</p>
                            <span class="badge bg-main-50 text-main-600 px-16 py-8 rounded-pill fw-semibold text-sm capitalize">{{ $order->status }}</span>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-sm text-gray-600 mb-8">Payment Status</p>
                            <span class="badge bg-warning-50 text-warning-600 px-16 py-8 rounded-pill fw-semibold text-sm capitalize">{{ $order->payment_status }}</span>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="border-top border-gray-100 pt-32 mt-32">
                        <h3 class="text-xl fw-bold text-gray-900 mb-24">Order Items</h3>
                        <div class="space-y-24">
                            @foreach($order->items as $item)
                            <div class="flex-between align-items-start pb-24 border-bottom border-gray-100">
                                <div class="flex-1">
                                    <p class="fw-semibold text-gray-900 mb-8">{{ $item->product_name }}</p>
                                    <div class="flex-align gap-16 mb-8">
                                        <span class="text-sm text-gray-600">SKU: {{ $item->product_sku }}</span>
                                        <span class="text-sm text-gray-600">|</span>
                                        <span class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</span>
                                    </div>
                                </div>
                                <p class="fw-bold text-gray-900 text-lg">Ksh {{ number_format($item->total_price, 2) }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="border-top border-gray-100 pt-32 mt-32">
                        <h3 class="text-xl fw-bold text-gray-900 mb-24">Order Summary</h3>
                        <div class="bg-color-three rounded-8 p-24">
                            <div class="mb-24 flex-between gap-8">
                                <span class="text-gray-900 font-heading-two">Subtotal</span>
                                <span class="text-gray-900 fw-semibold">Ksh {{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            <div class="mb-24 flex-between gap-8">
                                <span class="text-gray-900 font-heading-two">Tax (10%)</span>
                                <span class="text-gray-900 fw-semibold">Ksh {{ number_format($order->tax_amount, 2) }}</span>
                            </div>
                            <div class="mb-24 flex-between gap-8">
                                <span class="text-gray-900 font-heading-two">Shipping</span>
                                <span class="text-gray-900 fw-semibold">Ksh {{ number_format($order->shipping_amount, 2) }}</span>
                            </div>
                            <div class="border-top border-gray-200 pt-24 mt-24">
                                <div class="flex-between gap-8">
                                    <span class="text-gray-900 text-xl fw-semibold">Total</span>
                                    <span class="text-gray-900 text-xl fw-bold text-main-600">Ksh {{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="border border-gray-100 rounded-8 px-40 py-48 mb-32" data-aos="fade-up" data-aos-duration="600">
                    <h2 class="text-heading mb-24">Shipping Address</h2>
                    <div class="bg-color-three rounded-8 p-24">
                        <p class="text-gray-700 mb-0">
                            @if(isset($order->shipping_address['name']))
                                <span class="fw-semibold text-gray-900">{{ $order->shipping_address['name'] }}</span><br>
                            @endif
                            @if(isset($order->shipping_address['address_line_1']))
                                {{ $order->shipping_address['address_line_1'] }}<br>
                            @elseif(isset($order->shipping_address['address']))
                                {{ $order->shipping_address['address'] }}<br>
                            @endif
                            @if(isset($order->shipping_address['address_line_2']) && $order->shipping_address['address_line_2'])
                                {{ $order->shipping_address['address_line_2'] }}<br>
                            @endif
                            @if(isset($order->shipping_address['phone']))
                                Phone: {{ $order->shipping_address['phone'] }}<br>
                            @endif
                            @if(isset($order->shipping_address['city']) || isset($order->shipping_address['state']) || isset($order->shipping_address['postal_code']))
                                @php
                                    $parts = array_filter([
                                        $order->shipping_address['city'] ?? null,
                                        $order->shipping_address['state'] ?? null,
                                        $order->shipping_address['postal_code'] ?? null
                                    ]);
                                @endphp
                                @if(!empty($parts))
                                    {{ implode(', ', $parts) }}<br>
                                @endif
                            @endif
                            @if(isset($order->shipping_address['country']))
                                {{ $order->shipping_address['country'] }}
                            @endif
                            @if(!isset($order->shipping_address['address_line_1']) && !isset($order->shipping_address['address']) && !isset($order->shipping_address['city']))
                                <span class="text-gray-500">Delivery address not provided</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-5">
                <!-- Next Steps -->
                <div class="border border-gray-100 rounded-8 px-24 py-40 mb-32" data-aos="fade-up" data-aos-duration="400">
                    <h3 class="text-lg fw-bold text-gray-900 mb-24">What's Next?</h3>
                    <div class="space-y-16">
                        <div class="flex-align gap-12">
                            <span class="w-32 h-32 flex-center rounded-circle bg-success-50 text-success-600 flex-shrink-0">
                                <i class="ph ph-check-circle text-xl"></i>
                            </span>
                            <p class="text-gray-700 mb-0">You'll receive an order confirmation email shortly</p>
                        </div>
                        <div class="flex-align gap-12">
                            <span class="w-32 h-32 flex-center rounded-circle bg-main-50 text-main-600 flex-shrink-0">
                                <i class="ph ph-truck text-xl"></i>
                            </span>
                            <p class="text-gray-700 mb-0">We'll send you tracking information once your order ships</p>
                        </div>
                        <div class="flex-align gap-12">
                            <span class="w-32 h-32 flex-center rounded-circle bg-warning-50 text-warning-600 flex-shrink-0">
                                <i class="ph ph-identification-card text-xl"></i>
                            </span>
                            <p class="text-gray-700 mb-0">Valid ID will be required upon delivery (18+ only)</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="border border-gray-100 rounded-8 px-24 py-40 mb-32" data-aos="fade-up" data-aos-duration="600">
                    <h3 class="text-lg fw-bold text-gray-900 mb-24">Payment Information</h3>
                    <div class="bg-color-three rounded-8 p-24">
                        <div class="mb-16">
                            <p class="text-sm text-gray-600 mb-4">Payment Method</p>
                            <p class="fw-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                        </div>
                        <div class="mb-0">
                            <p class="text-sm text-gray-600 mb-4">Payment Status</p>
                            <span class="badge bg-warning-50 text-warning-600 px-16 py-8 rounded-pill fw-semibold text-sm capitalize">{{ $order->payment_status }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex flex-column gap-16" data-aos="fade-up" data-aos-duration="800">
                    @if($order->customer->email && !str_ends_with($order->customer->email, '@sipandgo.local'))
                    <form action="{{ route('checkout.resend-email', $order->order_number) }}" method="POST" class="w-100">
                        @csrf
                        <button type="submit" class="btn bg-gray-100 text-gray-900 hover-bg-gray-200 w-100 py-18 rounded-8 d-flex align-items-center justify-content-center gap-8">
                            <i class="ph ph-envelope-simple"></i> Resend confirmation email
                        </button>
                    </form>
                    @endif
                    <a href="{{ route('products.index') }}" class="btn btn-main w-100 py-18 rounded-8 d-flex align-items-center justify-content-center gap-8">
                        <i class="ph ph-shopping-bag"></i> Continue Shopping
                    </a>
                    <a href="{{ route('home') }}" class="btn bg-gray-100 text-gray-900 hover-bg-gray-200 w-100 py-18 rounded-8 d-flex align-items-center justify-content-center gap-8">
                        <i class="ph ph-house"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================================= Order Success Page End ===================================== -->

@endsection
