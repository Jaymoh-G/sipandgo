<!-- ==================== Header Start Here ==================== -->
<header class="header bg-white border-bottom-0 box-shadow-3xl py-10 z-2">
    <div class="container container-lg">
        <nav class="header-inner d-flex justify-content-between gap-8">
            <div class="flex-align menu-category-wrapper position-relative">

                <!-- Category Dropdown Start -->
                <div class="">
                    <button type="button" class="category-button d-flex align-items-center gap-12 text-white bg-main-600 px-20 py-16 rounded-6 hover-bg-main-700 transition-2">
                        <span class="text-xl line-height-1"><i class="ph ph-squares-four"></i></span>
                        <span class="">Browse Categories</span>
                        <span class="line-height-1 icon transition-2"><i class="ph-bold ph-caret-down"></i></span>
                    </button>

                    <!-- Dropdown Start -->
                    <div class="category-dropdown border border-main-200 shadow bg-white p-16 rounded-16 w-100 max-w-472 position-absolute inset-block-start-100 inset-inline-start-0 z-99 transition-2">
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
                        <li class="on-hover-item nav-menu__item has-submenu {{ request()->routeIs('home') ? 'activePage' : '' }}">
                            <a href="javascript:void(0)" class="nav-menu__link text-heading-two">Home</a>
                            <ul class="on-hover-dropdown common-dropdown nav-submenu scroll-sm">
                                <li class="common-dropdown__item nav-submenu__item {{ request()->routeIs('home') ? 'activePage' : '' }}">
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
                            <a href="{{ route('about') }}" class="nav-menu__link text-heading-two {{ request()->routeIs('about') ? 'activePage' : '' }}">About</a>
                        </li>
                        <li class="nav-menu__item">
                            <a href="{{ route('contact') }}" class="nav-menu__link text-heading-two {{ request()->routeIs('contact') ? 'activePage' : '' }}">Contact Us</a>
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

