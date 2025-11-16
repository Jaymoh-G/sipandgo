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

<!-- ======================= Middle Top Start ========================= -->
<div class="header-top bg-main-600 flex-between">
    <div class="container container-lg">
        <div class="flex-between flex-wrap gap-8">
            <div class="d-flex align-items-center gap-10">
                <div class="d-flex align-items-center gap-10" id="countdown25">
                    <div class="d-flex align-items-center gap-4 text-white">
                        <strong class="text-md fw-semibold days">35</strong>
                        <span class="text-xs">Days</span>
                    </div>
                    <div class="d-flex align-items-center gap-4 text-white">
                        <strong class="text-md fw-semibold hours">14</strong>
                        <span class="text-xs">Hours</span>
                    </div>
                    <div class="d-flex align-items-center gap-4 text-white">
                        <strong class="text-md fw-semibold minutes">54</strong>
                        <span class="text-xs">Minutes</span>
                    </div>
                    <div class="d-flex align-items-center gap-4 text-white">
                        <strong class="text-md fw-semibold seconds">28</strong>
                        <span class="text-xs">Sec.</span>
                    </div>
                </div>
            </div>

            <ul class="flex-align flex-wrap d-none d-xl-flex">
                <li class="border-right-item pe-12 me-12">
                    <span class="text-white text-sm">
                    Buy one get one free on
                    <span class="text-yellow">first order</span> </span>
                </li>
                <li class="border-right-item pe-12 me-12">
                    <a href="javascript:void(0)" class="text-white text-sm d-flex align-items-center gap-4 hover-text-decoration-underline">
                        <img src="{{ asset('assets/images/icon/track-icon.png') }}" alt="Track Icon">
                        <span class="">Track Your Order</span>
                    </a>
                </li>
            </ul>

            <ul class="header-top__right flex-align flex-wrap gap-16 w-auto">
                <li class="d-lg-flex d-none">
                    <a href="#shipping" class="text-white text-sm hover-text-decoration-underline">Order Tracking</a>
                </li>
                <li class="d-lg-flex d-none">
                    <a href="{{ route('about') }}" class="text-white text-sm hover-text-decoration-underline">About Us</a>
                </li>
                <li class="on-hover-item has-submenu arrow-white">
                    <a href="javascript:void(0)" class="selected-text text-white text-sm py-8">Eng</a>
                    <ul class="selectable-text-list on-hover-dropdown common-dropdown common-dropdown--sm max-h-200 scroll-sm px-0 py-8">
                        <li>
                            <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                <img src="{{ asset('assets/images/thumbs/flag1.png') }}" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                English
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="on-hover-item has-submenu arrow-white">
                    <a href="javascript:void(0)" class="selected-text text-white text-sm py-8">USD</a>
                    <ul class="selectable-text-list on-hover-dropdown common-dropdown common-dropdown--sm max-h-200 scroll-sm px-0 py-8">
                        <li>
                            <a href="javascript:void(0)" class="hover-bg-gray-100 text-gray-500 text-xs py-6 px-16 flex-align gap-8 rounded-0">
                                <img src="{{ asset('assets/images/thumbs/flag1.png') }}" alt="" class="w-16 h-12 rounded-4 border border-gray-100">
                                USD
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ======================= Middle Top End ========================= -->

<!-- ======================= Middle Header Start ========================= -->
<header class="header-middle border-bottom border-gray-100">
    <div class="container container-lg">
        <nav class="header-inner flex-between gap-8">
            <!-- Logo Start -->
            <div class="logo">
                <a href="{{ route('home') }}" class="link">
                    <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Sip & Go Logo">
                </a>
            </div>
            <!-- Logo End  -->

            <!-- form location Start -->
            <form action="{{ route('products.index') }}" class="flex-align flex-wrap form-location-wrapper max-w-840 w-100" method="GET">
                <div class="search-category select-style-one d-flex select-border-end-0 search-form d-sm-flex d-none text-heading-two text-sm w-100">
                    <select class="js-example-basic-single border border-neutral-40 border-end-0" name="category">
                        <option value="" selected disabled>All categories</option>
                        <option value="whisky-whiskey">Whisky & Whiskey</option>
                        <option value="vodka">Vodka</option>
                        <option value="rum">Rum</option>
                        <option value="gin">Gin</option>
                        <option value="tequila-mezcal">Tequila & Mezcal</option>
                        <option value="wine">Wine</option>
                        <option value="beer">Beer</option>
                        <option value="ready-to-drink">Ready-to-Drink</option>
                    </select>

                    <div class="search-form__wrapper position-relative border-half-start flex-grow-1">
                        <input type="text" name="search" class="common-input border-neutral-40 py-18 ps-16 pe-76 rounded-0 rounded-end pe-44 placeholder-italic placeholder-text-sm border-start-0" placeholder="Search for products, categories or brands..." value="{{ request('search') }}">
                        <button type="submit" class="w-64 h-44 bg-main-600 hover-bg-main-800 rounded-4 flex-center text-xl text-white position-absolute top-50 translate-middle-y inset-inline-end-0 me-6"><i class="ph ph-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
            <!-- form location start -->

            <!-- Header Middle Right start -->
            <div class="header-right flex-align flex-shrink-0">
                <div class="flex-align gap-20">
                    <button type="button" class="search-icon flex-align d-lg-none d-flex gap-4 item-hover">
                        <span class="text-2xl text-gray-700 d-flex position-relative item-hover__text">
                            <i class="ph ph-magnifying-glass"></i>
                        </span>
                    </button>
                    <a href="javascript:void(0)" class="flex-align gap-4 item-hover">
                        <span class="text-xl text-gray-700 d-flex position-relative item-hover__text">
                            <i class="ph ph-user"></i>
                        </span>
                        <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Profile</span>
                    </a>
                    <a href="#" class="flex-align gap-4 item-hover">
                        <span class="text-xl text-gray-700 d-flex position-relative me-6 mt-6 item-hover__text">
                            <i class="ph ph-heart"></i>
                            <span class="w-16 h-16 flex-center rounded-circle bg-main-600 text-white text-xs position-absolute top-n6 end-n4">2</span>
                        </span>
                        <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Wishlist</span>
                    </a>
                    <a href="#" class="flex-align gap-4 item-hover">
                        <span class="text-xl text-gray-700 d-flex position-relative me-6 mt-6 item-hover__text">
                            <i class="ph ph-shopping-cart-simple"></i>
                            <span class="w-16 h-16 flex-center rounded-circle bg-main-600 text-white text-xs position-absolute top-n6 end-n4">0</span>
                        </span>
                        <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Cart</span>
                    </a>
                </div>
            </div>
            <!-- Header Middle Right End  -->
        </nav>
    </div>
</header>
<!-- ======================= Middle Header End ========================= -->

<!-- ==================== Header Start Here ==================== -->
<header class="header bg-white border-bottom-0 box-shadow-3xl py-10 z-2">
    <div class="container container-lg">
        <nav class="header-inner d-flex justify-content-between gap-8">
            <div class="flex-align menu-category-wrapper position-relative">

                <!-- Category Dropdown Start -->
                <div class="">
                    <button type="button" class="category-button d-flex align-items-center gap-12 text-white bg-success-600 px-20 py-16 rounded-6 hover-bg-success-700 transition-2">
                        <span class="text-xl line-height-1"><i class="ph ph-squares-four"></i></span>
                        <span class="">Browse Categories</span>
                        <span class="line-height-1 icon transition-2"><i class="ph-bold ph-caret-down"></i></span>
                    </button>

                    <!-- Dropdown Start -->
                    <div class="category-dropdown border border-success-200 shadow bg-white p-16 rounded-16 w-100 max-w-472 position-absolute inset-block-start-100 inset-inline-start-0 z-99 transition-2">
                        <div class="d-grid grid-cols-3-repeat gap-4 max-h-350 overflow-y-auto">
                            <a href="{{ route('categories.show', ['category' => 'whisky-whiskey']) }}" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                <span class="">
                                    <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="Icon" class="w-40">
                                </span>
                                <span class="fw-semibold text-heading mt-16 text-sm">Whisky & Whiskey</span>
                            </a>
                            <a href="{{ route('categories.show', ['category' => 'vodka']) }}" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                <span class="">
                                    <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="Icon" class="w-40">
                                </span>
                                <span class="fw-semibold text-heading mt-16 text-sm">Vodka</span>
                            </a>
                            <a href="{{ route('categories.show', ['category' => 'rum']) }}" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                <span class="">
                                    <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="Icon" class="w-40">
                                </span>
                                <span class="fw-semibold text-heading mt-16 text-sm">Rum</span>
                            </a>
                            <a href="{{ route('categories.show', ['category' => 'gin']) }}" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                <span class="">
                                    <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="Icon" class="w-40">
                                </span>
                                <span class="fw-semibold text-heading mt-16 text-sm">Gin</span>
                            </a>
                            <a href="{{ route('categories.show', ['category' => 'tequila-mezcal']) }}" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                <span class="">
                                    <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="Icon" class="w-40">
                                </span>
                                <span class="fw-semibold text-heading mt-16 text-sm">Tequila & Mezcal</span>
                            </a>
                            <a href="{{ route('categories.show', ['category' => 'wine']) }}" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                <span class="">
                                    <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="Icon" class="w-40">
                                </span>
                                <span class="fw-semibold text-heading mt-16 text-sm">Wine</span>
                            </a>
                            <a href="{{ route('categories.show', ['category' => 'beer']) }}" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                <span class="">
                                    <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="Icon" class="w-40">
                                </span>
                                <span class="fw-semibold text-heading mt-16 text-sm">Beer</span>
                            </a>
                            <a href="{{ route('categories.show', ['category' => 'ready-to-drink']) }}" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                <span class="">
                                    <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="Icon" class="w-40">
                                </span>
                                <span class="fw-semibold text-heading mt-16 text-sm">Ready-to-Drink</span>
                            </a>
                        </div>
                    </div>
                    <!-- Dropdown End -->
                </div>
                <!-- Category Dropdown End -->

                <!-- Menu Start  -->
                <div class="header-menu d-lg-block d-none">
                    <!-- Nav Menu Start -->
                    <ul class="nav-menu flex-align">
                        <li class="on-hover-item nav-menu__item has-submenu activePage">
                            <a href="javascript:void(0)" class="nav-menu__link text-heading-two">Home</a>
                            <ul class="on-hover-dropdown common-dropdown nav-submenu scroll-sm">
                                <li class="common-dropdown__item nav-submenu__item activePage">
                                    <a href="{{ route('home') }}" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100">Home Liquor Store</a>
                                </li>
                            </ul>
                        </li>
                        <li class="on-hover-item nav-menu__item has-submenu">
                            <a href="javascript:void(0)" class="nav-menu__link text-heading-two">Shop</a>
                            <ul class="on-hover-dropdown common-dropdown nav-submenu scroll-sm">
                                <li class="common-dropdown__item nav-submenu__item">
                                    <a href="{{ route('products.index') }}" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100">All Products</a>
                                </li>
                                <li class="common-dropdown__item nav-submenu__item">
                                    <a href="{{ route('categories.index') }}" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100">Categories</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-menu__item">
                            <a href="{{ route('about') }}" class="nav-menu__link text-heading-two">About</a>
                        </li>
                        <li class="nav-menu__item">
                            <a href="{{ route('contact') }}" class="nav-menu__link text-heading-two">Contact Us</a>
                        </li>
                    </ul>
                    <!-- Nav Menu End -->
                </div>
                <!-- Menu End  -->
            </div>

            <!-- Header Right start -->
            <div class="header-right flex-align gap-20">
                <a href="tel:+1234567890" class="d-sm-flex align-items-center gap-16 d-none">
                    <span class="d-flex text-32">
                        <img src="{{ asset('assets/images/icon/mobile.png') }}" alt="Mobile Icon">
                    </span>
                    <span class="">
                        <span class="d-block text-heading fw-medium">Need any Help! call Us</span>
                        <span class="d-block fw-bold text-main-600 hover-text-decoration-underline">+1 234 567 890</span>
                    </span>
                </a>
                <button type="button" class="toggle-mobileMenu d-lg-none ms-3n text-gray-800 text-4xl d-flex"> <i class="ph ph-list"></i> </button>
            </div>
            <!-- Header Right End  -->
        </nav>
    </div>
</header>
<!-- ==================== Header End Here ==================== -->

<!-- Age Verification Banner -->
<div class="age-warning text-white py-2 text-center" style="background: linear-gradient(45deg, #f59e0b, #d97706);">
    <div class="container">
        <i class="ph ph-warning mr-2"></i>
        <strong>Age Verification Required:</strong> You must be 21 or older to purchase alcohol. By continuing, you confirm that you are of legal drinking age.
    </div>
</div>

        <!-- Main Content -->
        <main>@yield('content')</main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <i
                                class="fas fa-wine-glass-alt text-2xl text-amber-600 mr-2"
                            ></i>
                            <span class="text-xl font-bold">Sip & Go</span>
                        </div>
                        <p class="text-gray-400 mb-4">
                            Your premier destination for premium spirits, wine,
                            and craft beverages. We offer an extensive
                            collection of the world's finest liquors with
                            exceptional service and competitive prices.
                        </p>
                        <div class="flex space-x-4 mb-6">
                            <a
                                href="#"
                                class="text-gray-400 hover:text-white transition-colors"
                            >
                                <i class="fab fa-facebook text-xl"></i>
                            </a>
                            <a
                                href="#"
                                class="text-gray-400 hover:text-white transition-colors"
                            >
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a
                                href="#"
                                class="text-gray-400 hover:text-white transition-colors"
                            >
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a
                                href="#"
                                class="text-gray-400 hover:text-white transition-colors"
                            >
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        </div>

                        <!-- Contact Info -->
                        <div class="space-y-2 text-sm text-gray-400">
                            <div class="flex items-center">
                                <i class="fas fa-phone mr-2"></i>
                                <span>+00 123 456 789</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-2"></i>
                                <span>support24@sipandgo.com</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>789 Inner Lane, California, USA</span>
                            </div>
                        </div>
                    </div>

                    <!-- Shopping -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Shopping</h3>
                        <ul class="space-y-2">
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Careers</a
                                >
                            </li>
                            <li>
                                <a
                                    href="{{ route('about') }}"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >About Sip & Go</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Investor Relations</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Sip & Go Devices</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Customer Reviews</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Privacy Policy</a
                                >
                            </li>
                            <li>
                                <a
                                    href="{{ route('contact') }}"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Contact Us</a
                                >
                            </li>
                        </ul>
                    </div>

                    <!-- Information -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Information</h3>
                        <ul class="space-y-2">
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Pricing</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Reviews</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Affiliate program</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Referral program</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Roadmap</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Wall of fame</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >System status</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Sitemap</a
                                >
                            </li>
                        </ul>
                    </div>

                    <!-- Company -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Company</h3>
                        <ul class="space-y-2">
                            <li>
                                <a
                                    href="{{ route('categories.show', ['category' => 'whisky-whiskey']) }}"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Whisky & Whiskey</a
                                >
                            </li>
                            <li>
                                <a
                                    href="{{ route('categories.show', ['category' => 'vodka']) }}"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Vodka</a
                                >
                            </li>
                            <li>
                                <a
                                    href="{{ route('categories.show', ['category' => 'rum']) }}"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Rum</a
                                >
                            </li>
                            <li>
                                <a
                                    href="{{ route('categories.show', ['category' => 'gin']) }}"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Gin</a
                                >
                            </li>
                            <li>
                                <a
                                    href="{{ route('categories.show', ['category' => 'tequila-mezcal']) }}"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Tequila & Mezcal</a
                                >
                            </li>
                            <li>
                                <a
                                    href="{{ route('categories.show', ['category' => 'wine']) }}"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Wine</a
                                >
                            </li>
                            <li>
                                <a
                                    href="{{ route('categories.show', ['category' => 'beer']) }}"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Beer</a
                                >
                            </li>
                            <li>
                                <a
                                    href="{{ route('categories.show', ['category' => 'ready-to-drink']) }}"
                                    class="text-gray-400 hover:text-white transition-colors"
                                    >Ready-to-Drink</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-gray-800 mt-8 pt-8">
                    <div
                        class="flex flex-col md:flex-row justify-between items-center"
                    >
                        <div
                            class="text-center md:text-left text-gray-400 mb-4 md:mb-0"
                        >
                            <p>
                                &copy; {{ date("Y") }} Sip & Go. All rights
                                reserved. Must be 21+ to purchase alcohol.
                            </p>
                        </div>

                        <!-- Language & Payment -->
                        <div
                            class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6"
                        >
                            <div
                                class="flex items-center space-x-4 text-sm text-gray-400"
                            >
                                <span>English (US)</span>
                                <span>Bangla</span>
                                <span>Urdu</span>
                                <span>Spanish</span>
                                <span>Arabic</span>
                            </div>

                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-400"
                                    >Payment Method:</span
                                >
                                <div class="flex space-x-2">
                                    <i
                                        class="fab fa-cc-visa text-xl text-gray-400"
                                    ></i>
                                    <i
                                        class="fab fa-cc-mastercard text-xl text-gray-400"
                                    ></i>
                                    <i
                                        class="fab fa-cc-paypal text-xl text-gray-400"
                                    ></i>
                                    <i
                                        class="fab fa-cc-amex text-xl text-gray-400"
                                    ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <!-- jQuery -->
        <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('assets/js/boostrap.bundle.min.js') }}"></script>
        <!-- Slick -->
        <script src="{{ asset('assets/js/slick.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ asset('assets/js/select2.min.js') }}"></script>
        <!-- jQuery UI -->
        <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
        <!-- AOS -->
        <script src="{{ asset('assets/js/aos.js') }}"></script>
        <!-- Counter -->
        <script src="{{ asset('assets/js/counter.min.js') }}"></script>
        <!-- Countdown -->
        <script src="{{ asset('assets/js/count-down.js') }}"></script>
        <!-- Marquee -->
        <script src="{{ asset('assets/js/marque.min.js') }}"></script>
        <!-- Vanilla Tilt -->
        <script src="{{ asset('assets/js/vanilla-tilt.min.js') }}"></script>
        <!-- WOW -->
        <script src="{{ asset('assets/js/wow.min.js') }}"></script>
        <!-- Phosphor Icons -->
        <script src="{{ asset('assets/js/phosphor-icon.js') }}"></script>
        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>
