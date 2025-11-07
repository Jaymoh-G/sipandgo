@extends('storefront.layout')

@section('title', 'Checkout - Sip & Go')
@section('description', 'Complete your order')

@section('content')
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Checkout</h1>
            <p class="text-lg text-gray-600">Complete your order information</p>
        </div>

        @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Checkout Form -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Customer Information -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Customer Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('first_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('last_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth *</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required max="{{ date('Y-m-d', strtotime('-18 years')) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <p class="text-xs text-gray-500 mt-1">Must be 21+ to purchase alcohol</p>
                                @error('date_of_birth')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Billing Address -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Billing Address</h2>

                        <div class="space-y-6">
                            <div>
                                <label for="billing_address_line_1" class="block text-sm font-medium text-gray-700 mb-2">Address Line 1 *</label>
                                <input type="text" id="billing_address_line_1" name="billing_address_line_1" value="{{ old('billing_address_line_1') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('billing_address_line_1')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="billing_address_line_2" class="block text-sm font-medium text-gray-700 mb-2">Address Line 2</label>
                                <input type="text" id="billing_address_line_2" name="billing_address_line_2" value="{{ old('billing_address_line_2') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('billing_address_line_2')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="billing_city" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                    <input type="text" id="billing_city" name="billing_city" value="{{ old('billing_city') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                    @error('billing_city')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="billing_state" class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                                    <input type="text" id="billing_state" name="billing_state" value="{{ old('billing_state') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                    @error('billing_state')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="billing_postal_code" class="block text-sm font-medium text-gray-700 mb-2">Postal Code *</label>
                                    <input type="text" id="billing_postal_code" name="billing_postal_code" value="{{ old('billing_postal_code') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                    @error('billing_postal_code')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="billing_country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                                    <input type="text" id="billing_country" name="billing_country" value="{{ old('billing_country', 'United States') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                    @error('billing_country')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Shipping Address</h2>

                        <div class="space-y-6">
                            <div>
                                <label for="shipping_address_line_1" class="block text-sm font-medium text-gray-700 mb-2">Address Line 1 *</label>
                                <input type="text" id="shipping_address_line_1" name="shipping_address_line_1" value="{{ old('shipping_address_line_1') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('shipping_address_line_1')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="shipping_address_line_2" class="block text-sm font-medium text-gray-700 mb-2">Address Line 2</label>
                                <input type="text" id="shipping_address_line_2" name="shipping_address_line_2" value="{{ old('shipping_address_line_2') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                @error('shipping_address_line_2')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                    <input type="text" id="shipping_city" name="shipping_city" value="{{ old('shipping_city') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                    @error('shipping_city')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="shipping_state" class="block text-sm font-medium text-gray-700 mb-2">State *</label>
                                    <input type="text" id="shipping_state" name="shipping_state" value="{{ old('shipping_state') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                    @error('shipping_state')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700 mb-2">Postal Code *</label>
                                    <input type="text" id="shipping_postal_code" name="shipping_postal_code" value="{{ old('shipping_postal_code') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                    @error('shipping_postal_code')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="shipping_country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                                    <input type="text" id="shipping_country" name="shipping_country" value="{{ old('shipping_country', 'United States') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                    @error('shipping_country')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Payment Method</h2>

                        <div>
                            <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Select Payment Method *</label>
                            <select id="payment_method" name="payment_method" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="">Select a payment method</option>
                                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="debit_card" {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                            </select>
                            @error('payment_method')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <input type="checkbox" id="terms_accepted" name="terms_accepted" value="1" required class="mt-1 h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                                <label for="terms_accepted" class="ml-2 text-sm text-gray-700">
                                    I agree to the <a href="#" class="text-amber-600 hover:text-amber-700">Terms and Conditions</a> and <a href="#" class="text-amber-600 hover:text-amber-700">Privacy Policy</a> *
                                </label>
                            </div>
                            @error('terms_accepted')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror

                            <div class="flex items-start">
                                <input type="checkbox" id="age_verified" name="age_verified" value="1" required class="mt-1 h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                                <label for="age_verified" class="ml-2 text-sm text-gray-700">
                                    I confirm that I am 21 years of age or older and that I am legally allowed to purchase alcohol products *
                                </label>
                            </div>
                            @error('age_verified')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 sticky top-4">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Order Summary</h2>

                        <!-- Order Items -->
                        <div class="mb-6 space-y-3">
                            @foreach($items as $item)
                            <div class="flex justify-between items-start text-sm">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $item['product']->name }}</p>
                                    <p class="text-gray-600">Qty: {{ $item['quantity'] }} × ${{ number_format($item['unit_price'], 2) }}</p>
                                </div>
                                <p class="font-semibold text-gray-900">${{ number_format($item['total'], 2) }}</p>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-300 pt-4 space-y-2">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax (10%)</span>
                                <span>${{ number_format($taxAmount, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span>${{ number_format($shippingAmount, 2) }}</span>
                            </div>
                            <div class="border-t border-gray-300 pt-2 mt-2">
                                <div class="flex justify-between text-lg font-bold text-gray-900">
                                    <span>Total</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white py-3 px-4 rounded-lg font-semibold transition-colors mt-6">
                            <i class="fas fa-lock mr-2"></i>Place Order
                        </button>

                        <a href="{{ route('cart.index') }}" class="block text-center text-amber-600 hover:text-amber-700 font-semibold mt-4">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

