<!-- ======================= Middle Top Start ========================= -->
<div class="header-top bg-main-600 flex-between">
    <div class="container container-lg">
        <div class="flex-between flex-wrap gap-8">
            <div class="d-flex align-items-center gap-10">
                <span class="text-md fw-medium text-white d-none d-md-flex">Until the end of the sale:</span>
                <span class="text-md fw-medium text-white d-flex d-md-none">Sale end:</span>
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
                    <img src="{{ asset('assets/images/logo/sip-n-go-logo.png') }}" alt="Sip N Go Logo" style="max-height: 60px;">
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
                    <a href="{{ route('cart.index') }}" class="flex-align gap-4 item-hover">
                        <span class="text-xl text-gray-700 d-flex position-relative me-6 mt-6 item-hover__text">
                            <i class="ph ph-shopping-cart-simple"></i>
                            <span class="w-16 h-16 flex-center rounded-circle bg-main-600 text-white text-xs position-absolute top-n6 end-n4 cart-count">{{ $cartCount ?? 0 }}</span>
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

