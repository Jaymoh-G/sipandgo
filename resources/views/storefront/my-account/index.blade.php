@extends('storefront.layout')

@section('title', 'My Account - Sip & Go')
@section('description', 'Manage your account information and view your orders')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">My Account</h6>
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
                    My Account
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ============================ My Account Section Start =============================== -->
<section class="my-account py-80">
    <div class="container container-lg">
        <!-- Header -->
        <div class="section-heading text-center mb-32">
            <h2 class="text-heading-two mb-8">My Account</h2>
            <p class="text-gray-600 max-w-700 mx-auto">
                Manage your account information, view your orders, and update your profile.
            </p>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-green-50 border border-green-200 text-green-800 rounded-8 p-16 mb-32">
                <i class="ph ph-check-circle me-8"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger bg-red-50 border border-red-200 text-red-800 rounded-8 p-16 mb-32">
                <i class="ph ph-warning-circle me-8"></i>{{ session('error') }}
            </div>
        @endif

        @guest('customer')
            <div class="alert alert-warning bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-8 p-16 mb-32 text-center">
                <i class="ph ph-warning-circle me-8"></i>Please <a href="{{ route('login') }}" class="text-main-600 hover-text-decoration-underline fw-semibold">login</a> to view and manage your account.
            </div>
        @endguest

        @auth('customer')
        <div class="row g-4">
            <!-- Profile Information -->
            <div class="col-lg-8">
                <div class="product-card border border-gray-100 rounded-16 p-32">
                    <h3 class="text-heading-two mb-24">Profile Information</h3>

                    <form action="{{ route('my-account.update') }}" method="POST" class="d-flex flex-column gap-24">
                        @csrf

                        <div class="row gy-24">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label text-gray-900 fw-medium mb-8">First Name</label>
                                <input type="text" id="first_name" name="first_name" required
                                       class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                       placeholder="Enter your first name" value="{{ old('first_name', $customer->first_name ?? '') }}">
                                @error('first_name')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="last_name" class="form-label text-gray-900 fw-medium mb-8">Last Name</label>
                                <input type="text" id="last_name" name="last_name" required
                                       class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                       placeholder="Enter your last name" value="{{ old('last_name', $customer->last_name ?? '') }}">
                                @error('last_name')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="form-label text-gray-900 fw-medium mb-8">Email Address</label>
                            <input type="email" id="email" name="email" required
                                   class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                   placeholder="Enter your email address" value="{{ old('email', $customer->email ?? '') }}">
                            @error('email')
                                <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="form-label text-gray-900 fw-medium mb-8">Phone Number</label>
                            <input type="tel" id="phone" name="phone"
                                   class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                   placeholder="Enter your phone number" value="{{ old('phone', $customer->phone ?? '') }}">
                            @error('phone')
                                <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="border-top border-gray-100 pt-24 mt-8">
                            <h4 class="text-lg fw-semibold text-heading mb-16">Address Information</h4>

                            <div>
                                <label for="address_line_1" class="form-label text-gray-900 fw-medium mb-8">Address Line 1</label>
                                <input type="text" id="address_line_1" name="address_line_1"
                                       class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                       placeholder="Enter your address" value="{{ old('address_line_1', $customer->address_line_1 ?? '') }}">
                                @error('address_line_1')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-16">
                                <label for="address_line_2" class="form-label text-gray-900 fw-medium mb-8">Address Line 2 (Optional)</label>
                                <input type="text" id="address_line_2" name="address_line_2"
                                       class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                       placeholder="Apartment, suite, etc." value="{{ old('address_line_2', $customer->address_line_2 ?? '') }}">
                                @error('address_line_2')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row gy-24 mt-16">
                                <div class="col-md-6">
                                    <label for="city" class="form-label text-gray-900 fw-medium mb-8">City</label>
                                    <input type="text" id="city" name="city"
                                           class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                           placeholder="Enter your city" value="{{ old('city', $customer->city ?? '') }}">
                                    @error('city')
                                        <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="form-label text-gray-900 fw-medium mb-8">State/Province</label>
                                    <input type="text" id="state" name="state"
                                           class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                           placeholder="Enter your state" value="{{ old('state', $customer->state ?? '') }}">
                                    @error('state')
                                        <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row gy-24 mt-16">
                                <div class="col-md-6">
                                    <label for="postal_code" class="form-label text-gray-900 fw-medium mb-8">Postal Code</label>
                                    <input type="text" id="postal_code" name="postal_code"
                                           class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                           placeholder="Enter your postal code" value="{{ old('postal_code', $customer->postal_code ?? '') }}">
                                    @error('postal_code')
                                        <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="country" class="form-label text-gray-900 fw-medium mb-8">Country</label>
                                    <input type="text" id="country" name="country"
                                           class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                           placeholder="Enter your country" value="{{ old('country', $customer->country ?? '') }}">
                                    @error('country')
                                        <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="border-top border-gray-100 pt-24 mt-8">
                            <h4 class="text-lg fw-semibold text-heading mb-16">Change Password</h4>

                            <div>
                                <label for="password" class="form-label text-gray-900 fw-medium mb-8">New Password</label>
                                <input type="password" id="password" name="password"
                                       class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                       placeholder="Leave blank to keep current password">
                                @error('password')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-16">
                                <label for="password_confirmation" class="form-label text-gray-900 fw-medium mb-8">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-control common-input px-16 py-12 border border-gray-100 rounded-8 focus-border-main-600"
                                       placeholder="Confirm your new password">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-main rounded-pill w-100 d-inline-flex align-items-center justify-content-center gap-8 mt-16">
                            Update Profile <i class="ph ph-check"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Account Menu -->
            <div class="col-lg-4">
                <div class="product-card border border-gray-100 rounded-16 p-32">
                    <h3 class="text-heading-two mb-24">Account Menu</h3>
                    <ul class="d-flex flex-column gap-16">
                        <li>
                            <a href="{{ route('my-account.index') }}" class="text-heading hover-text-main-600 d-flex align-items-center gap-12">
                                <i class="ph ph-user text-xl"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('order.tracking') }}" class="text-heading hover-text-main-600 d-flex align-items-center gap-12">
                                <i class="ph ph-package text-xl"></i>
                                <span>Order Tracking</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('wishlist.index') }}" class="text-heading hover-text-main-600 d-flex align-items-center gap-12">
                                <i class="ph ph-heart text-xl"></i>
                                <span>My Wishlist</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index') }}" class="text-heading hover-text-main-600 d-flex align-items-center gap-12">
                                <i class="ph ph-shopping-cart-simple text-xl"></i>
                                <span>My Cart</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endauth
    </div>
</section>
<!-- ============================ My Account Section End =============================== -->

@endsection

