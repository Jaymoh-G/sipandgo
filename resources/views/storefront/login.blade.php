@extends('storefront.layout')

@section('title', 'Login - Sip & Go')
@section('description', 'Login to your account to manage your orders and profile')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-main-two-50">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">My Account</h6>
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
                <li class="text-sm text-main-600">Account</li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ============================ Account Section Start =============================== -->
<section class="account py-80">
    <div class="container container-lg">
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

        <div class="row gy-4">
            <!-- Login Card Start -->
            <div class="col-xl-6 pe-xl-5">
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="border border-gray-100 hover-border-main-600 transition-1 rounded-16 px-24 py-40 h-100">
                        <h6 class="text-xl mb-8">Login</h6>
                        <p class="text-gray-600 text-sm mb-32">Login if you already have an account with us.</p>
                        <div class="mb-24">
                            <label for="email" class="text-neutral-900 text-lg mb-8 fw-medium">Username or email address <span class="text-danger">*</span></label>
                            <input type="email" class="common-input" id="email" name="email" placeholder="Enter your email address" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-24">
                            <label for="password" class="text-neutral-900 text-lg mb-8 fw-medium">Password</label>
                            <div class="position-relative">
                                <input type="password" class="common-input" id="password" name="password" placeholder="Enter Password" required>
                                <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y cursor-pointer ph ph-eye-slash" data-target="#password"></span>
                            </div>
                            @error('password')
                                <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-24 mt-48">
                            <div class="flex-align gap-48 flex-wrap">
                                <button type="submit" class="btn btn-main py-18 px-40">Log in</button>
                                <div class="form-check common-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                                    <label class="form-check-label flex-grow-1" for="remember">Remember me</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-48">
                            <a href="#" class="text-danger-600 text-sm fw-semibold hover-text-decoration-underline">Forgot your password?</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Login Card End -->

                <!-- Register Card Start -->
                <div class="col-xl-6">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="border border-gray-100 hover-border-main-600 transition-1 rounded-16 px-24 py-40">
                            <h6 class="text-xl mb-8">Register</h6>
                            <p class="text-gray-600 text-sm mb-32">Register if you are a new customer and want to create an account.</p>
                            <div class="mb-24">
                                <label for="register_first_name" class="text-neutral-900 text-lg mb-8 fw-medium">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="common-input" id="register_first_name" name="first_name" placeholder="Enter your first name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-24">
                                <label for="register_last_name" class="text-neutral-900 text-lg mb-8 fw-medium">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="common-input" id="register_last_name" name="last_name" placeholder="Enter your last name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-24">
                                <label for="register_email" class="text-neutral-900 text-lg mb-8 fw-medium">Email address <span class="text-danger">*</span></label>
                                <input type="email" class="common-input" id="register_email" name="email" placeholder="Enter Email Address" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-24">
                                <label for="register_date_of_birth" class="text-neutral-900 text-lg mb-8 fw-medium">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="common-input" id="register_date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                @error('date_of_birth')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-24">
                                <label for="register_password" class="text-neutral-900 text-lg mb-8 fw-medium">Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" class="common-input" id="register_password" name="password" placeholder="Enter Password" required>
                                    <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y cursor-pointer ph ph-eye-slash" data-target="#register_password"></span>
                                </div>
                                @error('password')
                                    <span class="text-red-600 text-sm mt-2 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-24">
                                <label for="register_password_confirmation" class="text-neutral-900 text-lg mb-8 fw-medium">Confirm Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" class="common-input" id="register_password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                                    <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y cursor-pointer ph ph-eye-slash" data-target="#register_password_confirmation"></span>
                                </div>
                            </div>
                            <div class="my-48">
                                <p class="text-gray-500">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our
                                    <a href="#" class="text-main-600 text-decoration-underline">privacy policy</a>.
                                </p>
                            </div>
                            <div class="mt-48">
                                <button type="submit" class="btn btn-main py-18 px-40">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Register Card End -->
        </div>
    </div>
</section>
<!-- ============================ Account Section End =============================== -->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.querySelector(targetId);
            if (input) {
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('ph-eye-slash');
                    this.classList.add('ph-eye');
                } else {
                    input.type = 'password';
                    this.classList.remove('ph-eye');
                    this.classList.add('ph-eye-slash');
                }
            }
        });
    });
});
</script>
@endpush

@endsection

