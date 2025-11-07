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
            <input type="text" name="search" class="form-control py-16 px-24 text-xl rounded-pill pe-64" placeholder="Search for a product or brand" value="{{ request('search') }}">
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

@include('storefront.partials.scripts')

@stack('scripts')
</body>
</html>

