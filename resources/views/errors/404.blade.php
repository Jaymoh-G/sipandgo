@extends('storefront.layout')

@section('title', '404 - Page Not Found | Sip & Go')
@section('description', 'The page you are looking for could not be found.')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">404 - Page Not Found</h6>
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
                    404 Error
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ============================ 404 Error Section Start =============================== -->
<section class="error-404 py-80 bg-gray-50">
    <div class="container container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <div class="error-404__content" data-aos="fade-up" data-aos-duration="400">
                    <!-- Error Icon/Image -->
                    <div class="error-404__icon mb-40">
                        <div class="w-200 h-200 bg-main-50 rounded-circle flex-center mx-auto mb-32">
                            <i class="ph ph-warning-circle text-8xl text-main-600"></i>
                        </div>
                    </div>

                    <!-- Error Code -->
                    <h1 class="error-404__code text-9xl fw-bold text-main-600 mb-16" style="font-size: 120px; line-height: 1;">
                        404
                    </h1>

                    <!-- Error Title -->
                    <h2 class="text-heading-two mb-16">Oops! Page Not Found</h2>

                    <!-- Error Message -->
                    <p class="text-gray-600 text-lg mb-40 max-w-500 mx-auto">
                        The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                    </p>

                    <!-- Action Buttons -->
                    <div class="error-404__actions d-flex flex-wrap justify-content-center gap-16 mb-40">
                        <a href="{{ route('home') }}" class="btn btn-main rounded-pill d-inline-flex align-items-center gap-8 px-40 py-16">
                            <i class="ph ph-house"></i>
                            Go to Homepage
                        </a>
                        <a href="{{ route('products.index') }}" class="btn bg-white text-main-600 border border-main-600 hover-bg-main-600 hover-text-white rounded-pill d-inline-flex align-items-center gap-8 px-40 py-16 transition-2">
                            <i class="ph ph-shopping-cart-simple"></i>
                            Browse Products
                        </a>
                    </div>

                    <!-- Quick Links -->
                    <div class="error-404__quick-links">
                        <p class="text-gray-600 mb-24">Or try one of these pages:</p>
                        <div class="d-flex flex-wrap justify-content-center gap-16">
                            <a href="{{ route('categories.index') }}" class="text-main-600 hover-text-main-800 hover-text-decoration-underline">
                                <i class="ph ph-folder"></i> Categories
                            </a>
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('about') }}" class="text-main-600 hover-text-main-800 hover-text-decoration-underline">
                                <i class="ph ph-info"></i> About Us
                            </a>
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('contact') }}" class="text-main-600 hover-text-main-800 hover-text-decoration-underline">
                                <i class="ph ph-envelope"></i> Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ============================ 404 Error Section End =============================== -->

@push('styles')
<style>
    .error-404 {
        min-height: 60vh;
        display: flex;
        align-items: center;
    }

    .error-404__code {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.8;
        }
    }

    .error-404__icon {
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .error-404__actions .btn {
        transition: all 0.3s ease;
    }

    .error-404__actions .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .error-404__quick-links a {
        transition: all 0.3s ease;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .error-404__code {
            font-size: 80px !important;
        }

        .error-404__icon .w-200 {
            width: 120px !important;
            height: 120px !important;
        }

        .error-404__icon .text-8xl {
            font-size: 60px !important;
        }
    }
</style>
@endpush

@endsection

