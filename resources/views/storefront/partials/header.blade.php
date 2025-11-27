<!-- ======================= Middle Top Start ========================= -->
<div class="header-top bg-main-600 flex-between">
    <div class="container container-lg">
        <div class="flex-between flex-wrap gap-8">
            <ul class="flex-align flex-wrap">
                @if($settings->email ?? null)
                <li class="border-right-item pe-12 me-12 d-none d-md-flex">
                    <a href="mailto:{{ $settings->email }}" class="text-white text-sm d-flex align-items-center gap-4 hover-text-decoration-underline">
                        <i class="ph ph-envelope text-md"></i>
                        <span class="">{{ $settings->email }}</span>
                    </a>
                </li>
                @endif
                @if($settings->whatsapp_number ?? null)
                <li class="border-right-item pe-12 me-12">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp_number) }}" target="_blank" class="text-white text-sm d-flex align-items-center gap-4 hover-text-decoration-underline fw-semibold">
                        <i class="ph-fill ph-whatsapp-logo text-xl"></i>
                        <span class="">WhatsApp</span>
                    </a>
                </li>
                @endif
                @if($settings->city ?? null || $settings->country ?? null)
                <li class="border-right-item pe-12 me-12 d-none d-lg-flex">
                    <a href="https://maps.google.com" target="_blank" class="text-white text-sm d-flex align-items-center gap-4 hover-text-decoration-underline">
                        <i class="ph ph-map-pin text-md"></i>
                        <span class="">{{ $settings->city ?? '' }}{{ $settings->city && $settings->country ? ', ' : '' }}{{ $settings->country ?? '' }}</span>
                    </a>
                </li>
                @endif
            </ul>

            <ul class="header-top__right flex-align flex-wrap gap-16 w-auto">
                <li class="d-lg-flex d-none">
                    <a href="{{ route('contact') }}" class="text-white text-sm hover-text-decoration-underline">Contact Us</a>
                </li>
                  <li class="d-lg-flex d-none">
                    <a href="{{ route('about') }}" class="text-white text-sm hover-text-decoration-underline">About Us</a>
                </li>
                <li class="d-lg-flex d-none">
                    <a href="{{ route('order.tracking') }}" class="text-white text-sm hover-text-decoration-underline">Order Tracking</a>
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
                    @if($siteLogo ?? null)
                        <img src="{{ $siteLogo }}" alt="{{ $siteName ?? 'Logo' }}" style="max-height: 80px;">
                    @else
                        <img src="{{ asset('assets/images/logo/sip-n-go-logo.png') }}" alt="{{ $siteName ?? 'Sip N Go Logo' }}" style="max-height: 80px;">
                    @endif
                </a>
            </div>
            <!-- Logo End  -->

            <!-- Menu Start  -->
            <div class="header-menu d-lg-block d-none" style="flex: 1; margin-right: 20px;">
                <!-- Nav Menu Start -->
                <ul class="nav-menu flex-align" style="gap: 24px;">
                    <li class="nav-menu__item">
                        <a href="{{ route('home') }}" class="nav-menu__link text-heading-two {{ request()->routeIs('home') ? 'activePage' : '' }}" style="padding: 16px 16px; font-weight: 600; letter-spacing: 0.3px; transition: all 0.3s ease;">
                            <i class="ph ph-house me-2" style="font-size: 18px;"></i>Home
                        </a>
                    </li>
                    <li class="on-hover-item nav-menu__item has-submenu {{ request()->routeIs('products.index') || request()->routeIs('categories.index') ? 'activePage' : '' }}">
                        <a href="{{ route('products.index') }}" class="nav-menu__link text-heading-two" style="padding: 16px 16px; font-weight: 600; letter-spacing: 0.3px; transition: all 0.3s ease;">
                            <i class="ph ph-shopping-bag me-2" style="font-size: 18px;"></i>Shop
                        </a>
                        <ul class="on-hover-dropdown common-dropdown nav-submenu scroll-sm">
                            <li class="common-dropdown__item nav-submenu__item {{ request()->routeIs('products.index') ? 'activePage' : '' }}">
                                <a href="{{ route('products.index') }}" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100">All Products</a>
                            </li>
                            <li class="common-dropdown__item nav-submenu__item {{ request()->routeIs('categories.index') ? 'activePage' : '' }}">
                                <a href="{{ route('categories.index') }}" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100">Categories</a>
                            </li>
                        </ul>
                    </li>


                    <li class="on-hover-item nav-menu__item has-submenu position-relative">
                        <button type="button" class="category-button d-flex align-items-center gap-12 text-white bg-main-600 px-20 py-16 rounded-6 hover-bg-main-700 transition-2">
                            <span class="text-xl line-height-1"><i class="ph ph-squares-four"></i></span>
                            <span class="">Browse Categories</span>
                            <span class="line-height-1 icon transition-2"><i class="ph-bold ph-caret-down"></i></span>
                        </button>
                        <!-- Category Dropdown Start -->
                        <div class="category-dropdown border border-main-200 shadow bg-white p-16 rounded-16 w-100 max-w-472 position-absolute inset-block-start-100 inset-inline-start-0 z-99 transition-2">
                            <div class="d-grid grid-cols-3-repeat gap-4 max-h-350 overflow-y-auto">
                                @forelse($headerCategories ?? [] as $category)
                                    <a href="{{ route('categories.show', $category->slug) }}" class="py-16 px-8 rounded-8 hover-bg-main-50 d-flex flex-column align-items-center text-center border border-white hover-border-main-100">
                                        <span class="">
                                            @if($category->image)
                                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-40">
                                            @else
                                                <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="{{ $category->name }}" class="w-40">
                                            @endif
                                        </span>
                                        <span class="fw-semibold text-heading mt-16 text-sm">{{ $category->name }}</span>
                                    </a>
                                @empty
                                    <div class="col-span-3 text-center py-16">
                                        <p class="text-gray-500 text-sm">No categories available</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <!-- Category Dropdown End -->
                    </li>
                </ul>
                <!-- Nav Menu End -->
            </div>
            <!-- Menu End  -->

            <!-- form location Start -->
            <form action="{{ route('products.index') }}" class="flex-align flex-wrap form-location-wrapper" method="GET" style="flex: 0 0 auto; margin-right: 20px;">
                <div class="search-form d-sm-flex d-none text-heading-two text-sm" style="width: 300px;">
                    <div class="search-form__wrapper position-relative flex-grow-1">
                        <input type="text" name="search" class="common-input border border-neutral-40 py-18 ps-16 pe-76 rounded-pill pe-44 placeholder-italic placeholder-text-sm" placeholder="Search for products or brands..." value="{{ request('search') }}">
                        <button type="submit" class="w-64 h-44 bg-main-600 hover-bg-main-800 rounded-pill flex-center text-xl text-white position-absolute top-50 translate-middle-y inset-inline-end-0 me-6"><i class="ph ph-magnifying-glass"></i></button>
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
                    <a href="{{ route('wishlist.index') }}" class="flex-align gap-4 item-hover">
                        <span class="text-xl text-gray-700 d-flex position-relative me-6 mt-6 item-hover__text">
                            <i class="ph ph-heart"></i>
                            <span class="w-16 h-16 flex-center rounded-circle bg-main-600 text-white text-xs position-absolute top-n6 end-n4 wishlist-count">{{ $wishlistCount ?? 0 }}</span>
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
                    @auth('customer')
                        <div class="on-hover-item has-submenu position-relative">
                            <a href="{{ route('my-account.index') }}" class="flex-align gap-4 item-hover">
                                <span class="text-xl text-gray-700 d-flex position-relative item-hover__text">
                                    <i class="ph ph-user"></i>
                                </span>
                                <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">My Account</span>
                            </a>
                            <!-- My Account Dropdown Start -->
                            <ul class="on-hover-dropdown common-dropdown nav-submenu scroll-sm position-absolute inset-block-start-100 inset-inline-end-0 z-99 mt-8 min-w-200 bg-white border border-gray-100 rounded-8 shadow-lg py-8">
                                <li class="common-dropdown__item nav-submenu__item">
                                    <a href="{{ route('my-account.index') }}" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100 d-flex align-items-center gap-12 py-12 px-16">
                                        <i class="ph ph-user text-lg"></i>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <li class="common-dropdown__item nav-submenu__item">
                                    <a href="{{ route('order.tracking') }}" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100 d-flex align-items-center gap-12 py-12 px-16">
                                        <i class="ph ph-package text-lg"></i>
                                        <span>Order Tracking</span>
                                    </a>
                                </li>
                                <li class="common-dropdown__item nav-submenu__item">
                                    <a href="{{ route('wishlist.index') }}" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100 d-flex align-items-center gap-12 py-12 px-16">
                                        <i class="ph ph-heart text-lg"></i>
                                        <span>My Wishlist</span>
                                    </a>
                                </li>
                                <li class="common-dropdown__item nav-submenu__item">
                                    <a href="{{ route('cart.index') }}" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100 d-flex align-items-center gap-12 py-12 px-16">
                                        <i class="ph ph-shopping-cart-simple text-lg"></i>
                                        <span>My Cart</span>
                                    </a>
                                </li>
                                <li class="common-dropdown__item nav-submenu__item border-top border-gray-100 mt-8 pt-8">
                                    <form action="{{ route('logout') }}" method="POST" class="mb-0">
                                        @csrf
                                        <button type="submit" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100 d-flex align-items-center gap-12 w-100 text-start border-0 bg-transparent p-0 py-12 px-16">
                                            <i class="ph ph-sign-out text-lg"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                            <!-- My Account Dropdown End -->
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="flex-align gap-4 item-hover">
                            <span class="text-xl text-gray-700 d-flex position-relative item-hover__text">
                                <i class="ph ph-sign-in"></i>
                            </span>
                            <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Login</span>
                        </a>
                    @endauth
                    @if($settings->phone ?? null)
                    <a href="tel:{{ $settings->phone }}" class="d-lg-flex align-items-center gap-12 d-none item-hover" style="border-left: 1px solid #e5e7eb; padding-left: 20px; margin-left: 8px;">
                        <span class="d-flex text-2xl text-gray-700">
                            <i class="ph ph-phone"></i>
                        </span>
                        <span class="">
                            <span class="d-block text-heading text-sm fw-medium">Need any Help! call Us</span>
                            <span class="d-block fw-bold text-main-600 hover-text-decoration-underline text-sm">{{ $settings->phone }}</span>
                        </span>
                    </a>
                    @endif
                </div>
            </div>
            <!-- Header Middle Right End  -->
        </nav>
    </div>
</header>
<!-- ======================= Middle Header End ========================= -->

