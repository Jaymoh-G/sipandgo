<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', 'Sip & Go - Premium Liquor Store')</title>
    <meta name="description" content="@yield('description', 'Premium liquor store offering the finest selection of whiskey, vodka, rum, tequila, gin, wine, and more. Age verification required.')" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- select 2 -->
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <!-- Jquery Ui -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- AOS Animation -->
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- Theme Color Override - Ensure Golden/Tan colors are applied -->
    <style>
        :root {
            /* template main color - Golden/Tan #e1a743 */
            --main-h: 38 !important;
            --main-s: 72% !important;
            --main-l: 57% !important;
            --main: var(--main-h) var(--main-s) var(--main-l) !important;

            /* template main color - Darker golden for secondary */
            --main-two-h: 38 !important;
            --main-two-s: 72% !important;
            --main-two-l: 45% !important;
            --main-two: var(--main-two-h) var(--main-two-s) var(--main-two-l) !important;

            /* Red accent color #c90207 */
            --accent-h: 357 !important;
            --accent-s: 98% !important;
            --accent-l: 40% !important;
            --accent: var(--accent-h) var(--accent-s) var(--accent-l) !important;
        }

        /* Enhanced Menu Items Styling */
        .nav-menu__item:first-child .nav-menu__link,
        .nav-menu__item:nth-child(2) .nav-menu__link {
            display: inline-flex;
            align-items: center;
            border-radius: 8px;
            position: relative;
        }

        .nav-menu__item:first-child .nav-menu__link:hover,
        .nav-menu__item:nth-child(2) .nav-menu__link:hover {
            background-color: rgba(225, 167, 67, 0.1);
            transform: translateY(-2px);
        }

        .nav-menu__item.activePage .nav-menu__link {
            background-color: rgba(225, 167, 67, 0.15);
            color: hsl(var(--main)) !important;
        }

        .nav-menu__item.activePage .nav-menu__link i {
            color: hsl(var(--main)) !important;
        }

        /* Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            left: 20px;
            background-color: #25D366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
            animation: pulse 2s infinite;
        }

        .whatsapp-float:hover {
            background-color: #20BA5A;
            transform: scale(1.1);
            box-shadow: 2px 2px 20px rgba(37, 211, 102, 0.5);
        }

        .whatsapp-float i {
            font-size: 32px;
        }

        .whatsapp-tooltip {
            position: absolute;
            left: 70px;
            background-color: #333;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .whatsapp-tooltip::before {
            content: '';
            position: absolute;
            left: -5px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 5px 5px 5px 0;
            border-style: solid;
            border-color: transparent #333 transparent transparent;
        }

        .whatsapp-float:hover .whatsapp-tooltip {
            opacity: 1;
            visibility: visible;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        @media (max-width: 768px) {
            .whatsapp-float {
                width: 56px;
                height: 56px;
                bottom: 15px;
                left: 15px;
            }

            .whatsapp-float i {
                font-size: 28px;
            }

            .whatsapp-tooltip {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
<!--==================== Overlay Start ====================-->
<div class="overlay"></div>
<!--==================== Overlay End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

<!-- ==================== Scroll to Top End Here ==================== -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- ==================== Scroll to Top End Here ==================== -->

<!-- ==================== Search Box Start Here ==================== -->
<form action="{{ route('products.index') }}" class="search-box" method="GET">
    <button type="button" class="search-box__close position-absolute inset-block-start-0 inset-inline-end-0 m-16 w-48 h-48 border border-gray-100 rounded-circle flex-center text-white hover-text-gray-800 hover-bg-white text-2xl transition-1">
        <i class="ph ph-x"></i>
    </button>
    <div class="container">
        <div class="position-relative">
            <input type="text" name="search" class="form-control py-16 px-24 text-xl rounded-pill pe-64" placeholder="Search for products or brands" value="{{ request('search') }}">
            <button type="submit" class="w-48 h-48 bg-main-600 rounded-circle flex-center text-xl text-white position-absolute top-50 translate-middle-y inset-inline-end-0 me-8">
                <i class="ph ph-magnifying-glass"></i>
            </button>
        </div>
    </div>
</form>
<!-- ==================== Search Box End Here ==================== -->

@include('storefront.partials.header')
@include('storefront.partials.navbar')

<!-- Main Content -->
<main>
    @yield('content')
</main>

@include('storefront.partials.footer')

<!-- Floating WhatsApp Button -->
@if($settings->whatsapp_number ?? null)
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" target="_blank" class="whatsapp-float" title="Chat on WhatsApp">
    <i class="ph-fill ph-whatsapp-logo"></i>
    <span class="whatsapp-tooltip">Chat with us</span>
</a>
@endif

@include('storefront.partials.scripts')

@stack('scripts')
</body>
</html>

