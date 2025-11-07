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

        <div class="border border-gray-100 rounded-8 px-30 py-20 mb-40">
            <span class="">Have a coupon? <a href="{{ route('cart.index') }}" class="fw-semibold text-gray-900 hover-text-decoration-underline hover-text-main-600">Click here to enter your code</a> </span>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="pe-xl-5">
                        <div class="row gy-3">
                            <div class="col-sm-6 col-xs-6">
                                <input type="text"
                                       id="first_name"
                                       name="first_name"
                                       value="{{ old('first_name') }}"
                                       required
                                       class="common-input border-gray-100 @error('first_name') border-danger-500 @enderror"
                                       placeholder="First Name *">
                                @error('first_name')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <input type="text"
                                       id="last_name"
                                       name="last_name"
                                       value="{{ old('last_name') }}"
                                       required
                                       class="common-input border-gray-100 @error('last_name') border-danger-500 @enderror"
                                       placeholder="Last Name *">
                                @error('last_name')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       class="common-input border-gray-100 @error('email') border-danger-500 @enderror"
                                       placeholder="Email Address *">
                                @error('email')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="tel"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       class="common-input border-gray-100 @error('phone') border-danger-500 @enderror"
                                       placeholder="Phone">
                                @error('phone')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="date"
                                       id="date_of_birth"
                                       name="date_of_birth"
                                       value="{{ old('date_of_birth') }}"
                                       required
                                       max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                                       class="common-input border-gray-100 @error('date_of_birth') border-danger-500 @enderror"
                                       placeholder="Date of Birth *">
                                <p class="text-xs text-gray-500 mt-8">Must be 18+ to purchase alcohol</p>
                                @error('date_of_birth')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="text"
                                       id="billing_country"
                                       name="billing_country"
                                       value="{{ old('billing_country', 'Kenya') }}"
                                       required
                                       class="common-input border-gray-100 @error('billing_country') border-danger-500 @enderror"
                                       placeholder="Country *">
                                @error('billing_country')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="text"
                                       id="billing_address_line_1"
                                       name="billing_address_line_1"
                                       value="{{ old('billing_address_line_1') }}"
                                       required
                                       class="common-input border-gray-100 @error('billing_address_line_1') border-danger-500 @enderror"
                                       placeholder="House number and street name *">
                                @error('billing_address_line_1')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="text"
                                       id="billing_address_line_2"
                                       name="billing_address_line_2"
                                       value="{{ old('billing_address_line_2') }}"
                                       class="common-input border-gray-100 @error('billing_address_line_2') border-danger-500 @enderror"
                                       placeholder="Apartment, suite, unit, etc. (Optional)">
                                @error('billing_address_line_2')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="text"
                                       id="billing_city"
                                       name="billing_city"
                                       value="{{ old('billing_city') }}"
                                       required
                                       class="common-input border-gray-100 @error('billing_city') border-danger-500 @enderror"
                                       placeholder="City *">
                                @error('billing_city')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="text"
                                       id="billing_state"
                                       name="billing_state"
                                       value="{{ old('billing_state') }}"
                                       required
                                       class="common-input border-gray-100 @error('billing_state') border-danger-500 @enderror"
                                       placeholder="State/County *">
                                @error('billing_state')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="text"
                                       id="billing_postal_code"
                                       name="billing_postal_code"
                                       value="{{ old('billing_postal_code') }}"
                                       required
                                       class="common-input border-gray-100 @error('billing_postal_code') border-danger-500 @enderror"
                                       placeholder="Post Code *">
                                @error('billing_postal_code')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="my-40">
                                    <h6 class="text-lg mb-24">Shipping Address</h6>
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <input type="text"
                                                   id="shipping_address_line_1"
                                                   name="shipping_address_line_1"
                                                   value="{{ old('shipping_address_line_1') }}"
                                                   required
                                                   class="common-input border-gray-100 @error('shipping_address_line_1') border-danger-500 @enderror"
                                                   placeholder="House number and street name *">
                                            @error('shipping_address_line_1')
                                            <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <input type="text"
                                                   id="shipping_address_line_2"
                                                   name="shipping_address_line_2"
                                                   value="{{ old('shipping_address_line_2') }}"
                                                   class="common-input border-gray-100 @error('shipping_address_line_2') border-danger-500 @enderror"
                                                   placeholder="Apartment, suite, unit, etc. (Optional)">
                                            @error('shipping_address_line_2')
                                            <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <input type="text"
                                                   id="shipping_city"
                                                   name="shipping_city"
                                                   value="{{ old('shipping_city') }}"
                                                   required
                                                   class="common-input border-gray-100 @error('shipping_city') border-danger-500 @enderror"
                                                   placeholder="City *">
                                            @error('shipping_city')
                                            <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <input type="text"
                                                   id="shipping_state"
                                                   name="shipping_state"
                                                   value="{{ old('shipping_state') }}"
                                                   required
                                                   class="common-input border-gray-100 @error('shipping_state') border-danger-500 @enderror"
                                                   placeholder="State/County *">
                                            @error('shipping_state')
                                            <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <input type="text"
                                                   id="shipping_postal_code"
                                                   name="shipping_postal_code"
                                                   value="{{ old('shipping_postal_code') }}"
                                                   required
                                                   class="common-input border-gray-100 @error('shipping_postal_code') border-danger-500 @enderror"
                                                   placeholder="Post Code *">
                                            @error('shipping_postal_code')
                                            <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <input type="text"
                                                   id="shipping_country"
                                                   name="shipping_country"
                                                   value="{{ old('shipping_country', 'Kenya') }}"
                                                   required
                                                   class="common-input border-gray-100 @error('shipping_country') border-danger-500 @enderror"
                                                   placeholder="Country *">
                                            @error('shipping_country')
                                            <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="my-40">
                                    <h6 class="text-lg mb-24">Additional Information</h6>
                                    <input type="text"
                                           id="order_notes"
                                           name="order_notes"
                                           value="{{ old('order_notes') }}"
                                           class="common-input border-gray-100"
                                           placeholder="Notes about your order, e.g. special notes for delivery.">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="checkout-sidebar">
                        <div class="bg-color-three rounded-8 p-24 text-center">
                            <span class="text-gray-900 text-xl fw-semibold">Your Orders</span>
                        </div>

                        <div class="border border-gray-100 rounded-8 px-24 py-40 mt-24">
                            <div class="mb-32 pb-32 border-bottom border-gray-100 flex-between gap-8">
                                <span class="text-gray-900 fw-medium text-xl font-heading-two">Product</span>
                                <span class="text-gray-900 fw-medium text-xl font-heading-two">Subtotal</span>
                            </div>

                            @foreach($items as $item)
                            <div class="flex-between gap-24 mb-32">
                                <div class="flex-align gap-12">
                                    <span class="text-gray-900 fw-normal text-md font-heading-two w-144 text-line-2">{{ $item['product']->name }}</span>
                                    <span class="text-gray-900 fw-normal text-md font-heading-two"><i class="ph-bold ph-x"></i></span>
                                    <span class="text-gray-900 fw-semibold text-md font-heading-two">{{ $item['quantity'] }}</span>
                                </div>
                                <span class="text-gray-900 fw-bold text-md font-heading-two">Ksh {{ number_format($item['total'], 2) }}</span>
                            </div>
                            @endforeach

                            <div class="border-top border-gray-100 pt-30 mt-30">
                                <div class="mb-32 flex-between gap-8">
                                    <span class="text-gray-900 font-heading-two text-xl fw-semibold">Subtotal</span>
                                    <span class="text-gray-900 font-heading-two text-md fw-bold">Ksh {{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="mb-32 flex-between gap-8">
                                    <span class="text-gray-900 font-heading-two text-xl fw-semibold">Tax (10%)</span>
                                    <span class="text-gray-900 font-heading-two text-md fw-bold">Ksh {{ number_format($taxAmount, 2) }}</span>
                                </div>
                                <div class="mb-32 flex-between gap-8">
                                    <span class="text-gray-900 font-heading-two text-xl fw-semibold">Shipping</span>
                                    <span class="text-gray-900 font-heading-two text-md fw-bold">Ksh {{ number_format($shippingAmount, 2) }}</span>
                                </div>
                                <div class="mb-0 flex-between gap-8">
                                    <span class="text-gray-900 font-heading-two text-xl fw-semibold">Total</span>
                                    <span class="text-gray-900 font-heading-two text-md fw-bold">Ksh {{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-32">
                            <h6 class="text-lg mb-24">Payment Method</h6>
                            <div class="payment-item">
                                <div class="form-check common-check common-radio py-16 mb-0">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment1" value="bank_transfer" {{ old('payment_method', 'bank_transfer') == 'bank_transfer' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold text-neutral-600" for="payment1">Direct Bank transfer</label>
                                </div>
                                <div class="payment-item__content px-16 py-24 rounded-8 bg-main-50 position-relative">
                                    <p class="text-gray-800">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                </div>
                            </div>
                            <div class="payment-item">
                                <div class="form-check common-check common-radio py-16 mb-0">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment2" value="mpesa" {{ old('payment_method') == 'mpesa' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold text-neutral-600" for="payment2">M-Pesa</label>
                                </div>
                                <div class="payment-item__content px-16 py-24 rounded-8 bg-main-50 position-relative">
                                    <p class="text-gray-800">Pay via M-Pesa mobile money. You will receive payment instructions via SMS after placing your order.</p>
                                </div>
                            </div>
                            <div class="payment-item">
                                <div class="form-check common-check common-radio py-16 mb-0">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment3" value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold text-neutral-600" for="payment3">Cash on delivery</label>
                                </div>
                                <div class="payment-item__content px-16 py-24 rounded-8 bg-main-50 position-relative">
                                    <p class="text-gray-800">Pay with cash upon delivery. Please have exact change ready for the delivery person.</p>
                                </div>
                            </div>
                            @error('payment_method')
                            <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-32 pt-32 border-top border-gray-100">
                            <div class="mb-16">
                                <div class="form-check common-check">
                                    <input class="form-check-input" type="checkbox" id="terms_accepted" name="terms_accepted" value="1" required {{ old('terms_accepted') ? 'checked' : '' }}>
                                    <label class="form-check-label text-gray-500 text-sm" for="terms_accepted">
                                        I agree to the <a href="#" class="text-main-600 text-decoration-underline">Terms and Conditions</a> and <a href="#" class="text-main-600 text-decoration-underline">Privacy Policy</a> *
                                    </label>
                                </div>
                                @error('terms_accepted')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-0">
                                <div class="form-check common-check">
                                    <input class="form-check-input" type="checkbox" id="age_verified" name="age_verified" value="1" required {{ old('age_verified') ? 'checked' : '' }}>
                                    <label class="form-check-label text-gray-500 text-sm" for="age_verified">
                                        I confirm that I am 18 years of age or older and that I am legally allowed to purchase alcohol products *
                                    </label>
                                </div>
                                @error('age_verified')
                                <p class="text-danger-500 text-sm mt-8">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-main mt-40 py-18 w-100 rounded-8 mt-56">
                            <i class="ph ph-lock me-8"></i>Place Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- ================================= Checkout Page End ===================================== -->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle payment method radio buttons to show/hide content
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    const paymentContents = document.querySelectorAll('.payment-item__content');

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Hide all payment content
            paymentContents.forEach(content => {
                content.style.display = 'none';
            });
            // Show selected payment content
            if (this.checked) {
                const content = this.closest('.payment-item').querySelector('.payment-item__content');
                if (content) {
                    content.style.display = 'block';
                }
            }
        });

        // Show content for initially checked radio
        if (radio.checked) {
            const content = radio.closest('.payment-item').querySelector('.payment-item__content');
            if (content) {
                content.style.display = 'block';
            }
        }
    });
});
</script>
@endpush
@endsection
