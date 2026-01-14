@extends('storefront.layout')

@section('title', 'Checkout - Sip & Go')
@section('description', 'Complete your order')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">Checkout</h6>
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
                    Checkout
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ================================= Checkout Page Start ===================================== -->
<section class="checkout py-80">
    <div class="container container-lg">
        @if(session('error'))
        <div class="alert alert-danger mb-32 bg-danger-50 border border-danger-200 text-danger-800 px-24 py-16 rounded-8">
            <i class="ph ph-warning-circle me-8"></i>{{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success mb-32 bg-success-50 border border-success-200 text-success-800 px-24 py-16 rounded-8">
            <i class="ph ph-check-circle me-8"></i>{{ session('success') }}
        </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
            @csrf
            <div class="row gy-4 align-items-start">
                <div class="col-lg-6">
                    <div class="bg-white border border-gray-100 rounded-16 shadow-sm p-32">
                        <h5 class="mb-12 text-gray-900">Pay with M-Pesa</h5>
                        <p class="text-sm text-gray-600 mb-24">
                            Enter the M-Pesa number to receive the STK push. Delivery address is optional.
                        </p>
                        <div class="mb-20">
                            <label class="form-label text-sm text-gray-500">M-Pesa Number *</label>
                            <input
                                type="tel"
                                id="mpesa_number"
                                name="mpesa_number"
                                value="{{ old('mpesa_number') }}"
                                required
                                class="common-input @error('mpesa_number') border-danger-500 @enderror"
                                placeholder="e.g. 0712 345678"
                            >
                            @error('mpesa_number')
                            <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-24">
                            <label class="form-label text-sm text-gray-500">Delivery Address (optional)</label>
                            <textarea
                                id="delivery_address"
                                name="delivery_address"
                                rows="4"
                                class="common-input @error('delivery_address') border-danger-500 @enderror"
                                placeholder="Estate, house number, delivery notes"
                            >{{ old('delivery_address') }}</textarea>
                            @error('delivery_address')
                            <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-main w-100 py-12 rounded-pill fw-semibold">
                            <i class="ph ph-lightning me-2"></i>Send STK Push
                        </button>
                        <p class="text-xs text-gray-500 text-center mt-12 mb-0">
                            You’ll receive an M-Pesa prompt on your phone to complete the payment.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white border border-gray-100 rounded-16 shadow-sm p-24">
                        <h5 class="mb-20 text-gray-900">Order Summary</h5>
                        <div class="space-y-3 mb-24">
                            @foreach($items as $item)
                                <div class="d-flex justify-content-between align-items-start border-bottom border-gray-100 pb-2">
                                    <div>
                                        <p class="mb-1 text-sm text-gray-800 fw-semibold">{{ $item['product']->name }}</p>
                                        <span class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</span>
                                    </div>
                                    <span class="text-sm fw-bold text-gray-900">Ksh {{ number_format($item['total'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-top border-gray-100 pt-3">
                            <div class="d-flex justify-content-between text-sm mb-2">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="text-gray-900 fw-semibold">Ksh {{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between text-sm mb-2">
                                <span class="text-gray-600">Tax (10%)</span>
                                <span class="text-gray-900 fw-semibold">Ksh {{ number_format($taxAmount, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between text-sm mb-2">
                                <span class="text-gray-600">Shipping</span>
                                <span class="text-gray-900 fw-semibold">Ksh {{ number_format($shippingAmount, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top border-gray-100">
                                <span class="fw-bold text-gray-900">Total</span>
                                <span class="fw-bold text-gray-900">Ksh {{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        <ul class="list-unstyled mt-24 text-sm text-gray-600">
                            <li class="d-flex align-items-center mb-8">
                                <i class="ph ph-check-circle text-main-600 me-2"></i>M-Pesa STK push for instant payment
                            </li>
                            <li class="d-flex align-items-center mb-8">
                                <i class="ph ph-truck text-main-600 me-2"></i>Fast dispatch after payment
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="ph ph-shield-check text-main-600 me-2"></i>Verified Secure checkout experience
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- ================================= Checkout Page End ===================================== -->

@endsection

