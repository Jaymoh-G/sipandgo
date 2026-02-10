<!-- ==================== Footer Two Start Here ==================== -->
<footer class="footer py-80 overflow-hidden" style="background-color: #0a1d3e;">
    <div class="container container-lg">
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-3 footer-item" data-aos="fade-up" data-aos-duration="200">
                <div class="footer-item__logo mb-24">
                    <a href="{{ route('home') }}">
                        @if($siteLogo ?? null)
                            <img src="{{ $siteLogo }}" alt="{{ $siteName ?? 'Logo' }}" style="max-height: 80px;">
                        @else
                            <img src="{{ asset('assets/images/logo/sip-n-go-logo.png') }}" alt="{{ $siteName ?? 'Sip N Go Logo' }}" style="max-height: 80px;">
                        @endif
                    </a>
                </div>
                <p class="mb-24 text-gray-300">{{ $settings->site_description ?? 'Sip & Go become the largest premium spirits, wine, and craft beverages retailer. We offer an extensive collection of the world\'s finest liquors with exceptional service.' }}</p>
                <div class="flex-align gap-16">
                    @if($settings->facebook_url ?? null)
                    <a href="{{ $settings->facebook_url }}" target="_blank" class="w-44 h-44 flex-center text-white text-xl rounded-8 transition-2" style="background-color: #1877F2;" onmouseover="this.style.backgroundColor='#166FE5'" onmouseout="this.style.backgroundColor='#1877F2'">
                        <i class="ph-fill ph-facebook-logo"></i>
                    </a>
                    @endif
                    @if($settings->twitter_url ?? null)
                    <a href="{{ $settings->twitter_url }}" target="_blank" class="w-44 h-44 flex-center text-white text-xl rounded-8 transition-2" style="background-color: #000000;" onmouseover="this.style.backgroundColor='#1DA1F2'" onmouseout="this.style.backgroundColor='#000000'">
                        <i class="ph-fill ph-twitter-logo"></i>
                    </a>
                    @endif
                    @if($settings->instagram_url ?? null)
                    <a href="{{ $settings->instagram_url }}" target="_blank" class="w-44 h-44 flex-center text-white text-xl rounded-8 transition-2" style="background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                        <i class="ph-fill ph-instagram-logo"></i>
                    </a>
                    @endif
                    @if($settings->linkedin_url ?? null)
                    <a href="{{ $settings->linkedin_url }}" target="_blank" class="w-44 h-44 flex-center text-white text-xl rounded-8 transition-2" style="background-color: #0077B5;" onmouseover="this.style.backgroundColor='#005885'" onmouseout="this.style.backgroundColor='#0077B5'">
                        <i class="ph-fill ph-linkedin-logo"></i>
                    </a>
                    @endif
                    @if($settings->youtube_url ?? null)
                    <a href="{{ $settings->youtube_url }}" target="_blank" class="w-44 h-44 flex-center text-white text-xl rounded-8 transition-2" style="background-color: #FF0000;" onmouseover="this.style.backgroundColor='#CC0000'" onmouseout="this.style.backgroundColor='#FF0000'">
                        <i class="ph-fill ph-youtube-logo"></i>
                    </a>
                    @endif
                    @if($settings->tiktok_url ?? null)
                    <a href="{{ $settings->tiktok_url }}" target="_blank" class="w-44 h-44 flex-center text-white text-xl rounded-8 transition-2" style="background-color: #000000;" onmouseover="this.style.backgroundColor='#333333'" onmouseout="this.style.backgroundColor='#000000'">
                        <i class="ph-fill ph-tiktok-logo"></i>
                    </a>
                    @endif
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-2 footer-item" data-aos="fade-up" data-aos-duration="400">
                <h6 class="footer-item__title text-white">About us</h6>
                <ul class="footer-menu">
                    <li class="mb-16">
                        <a href="{{ route('about') }}" class="text-gray-300 hover-text-main-600">Company Profile</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('products.index') }}" class="text-gray-300 hover-text-main-600">All Products</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('contact') }}" class="text-gray-300 hover-text-main-600">Contact Us</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('order.tracking') }}" class="text-gray-300 hover-text-main-600">Order Tracking</a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-6 col-lg-2 footer-item" data-aos="fade-up" data-aos-duration="600">
                <h6 class="footer-item__title text-white">Customer Support</h6>
                <ul class="footer-menu">
                    <li class="mb-16">
                        <a href="{{ route('contact') }}" class="text-gray-300 hover-text-main-600">Contact Us</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('faq') }}" class="text-gray-300 hover-text-main-600">FAQs</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('order.tracking') }}" class="text-gray-300 hover-text-main-600">Track Your Order</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('products.index') }}" class="text-gray-300 hover-text-main-600">Browse Products</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('about') }}" class="text-gray-300 hover-text-main-600">About Us</a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-6 col-lg-2 footer-item" data-aos="fade-up" data-aos-duration="800">
                <h6 class="footer-item__title text-white">My Account</h6>
                <ul class="footer-menu">
                    @auth('customer')
                    <li class="mb-16">
                        <a href="{{ route('my-account.index') }}" class="text-gray-300 hover-text-main-600">My Account</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('order.tracking') }}" class="text-gray-300 hover-text-main-600">Order Tracking</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('wishlist.index') }}" class="text-gray-300 hover-text-main-600">My Wishlist</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('cart.index') }}" class="text-gray-300 hover-text-main-600">Shopping Cart</a>
                    </li>
                    @else
                    <li class="mb-16">
                        <a href="{{ route('login') }}" class="text-gray-300 hover-text-main-600">Login</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('order.tracking') }}" class="text-gray-300 hover-text-main-600">Order Tracking</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('wishlist.index') }}" class="text-gray-300 hover-text-main-600">My Wishlist</a>
                    </li>
                    <li class="mb-16">
                        <a href="{{ route('cart.index') }}" class="text-gray-300 hover-text-main-600">Shopping Cart</a>
                    </li>
                    @endauth
                </ul>
            </div>

            <div class="col-12 col-md-6 col-lg-3 footer-item" data-aos="fade-up" data-aos-duration="1000">
                <h6 class="footer-item__title text-white mb-24">Contact Us</h6>
                @if($settings->phone ?? null)
                <div class="flex-align gap-16 mb-16">
                    <span class="w-32 h-32 flex-center rounded-circle border border-gray-600 text-gray-100 text-md flex-shrink-0">
                        <i class="ph-fill ph-phone-call"></i>
                    </span>
                    <a
                        href="tel:{{ $settings->phone }}"
                        class="text-md text-gray-300"
                        onmouseover="this.style.color='#a6d1f1'"
                        onmouseout="this.style.color='#D1D5DB'"
                    >
                        {{ $settings->phone }}
                    </a>
                </div>
                @endif
                @if($settings->email ?? null)
                <div class="flex-align gap-16 mb-16">
                    <span class="w-32 h-32 flex-center rounded-circle border border-gray-600 text-gray-100 text-md flex-shrink-0">
                        <i class="ph-fill ph-envelope"></i>
                    </span>
                    <a
                        href="mailto:{{ $settings->email }}"
                        class="text-md text-gray-300"
                        onmouseover="this.style.color='#a6d1f1'"
                        onmouseout="this.style.color='#D1D5DB'"
                    >
                        {{ $settings->email }}
                    </a>
                </div>
                @endif
                @if($settings->address ?? null || $settings->city ?? null || $settings->country ?? null)
                    @php
                        $locationText = trim(
                            ($settings->address ?? '') . ' ' .
                            ($settings->city ?? '') . ' ' .
                            ($settings->country ?? '')
                        );
                    @endphp
                    @if(!empty($locationText))
                    <div class="flex-align gap-16 mb-16">
                        <span class="w-32 h-32 flex-center rounded-circle border border-gray-600 text-gray-100 text-md flex-shrink-0">
                            <i class="ph-fill ph-map-pin"></i>
                        </span>
                        <span class="text-md text-gray-300">
                            <a
                                href="https://www.google.com/maps/search/?api=1&query={{ urlencode($locationText) }}"
                                target="_blank"
                                rel="noopener"
                                class="text-md text-gray-300 text-decoration-underline"
                                onmouseover="this.style.color='#a6d1f1'"
                                onmouseout="this.style.color='#D1D5DB'"
                            >
                                {{ $settings->address ?? '' }}{{ $settings->address && ($settings->city || $settings->country) ? ', ' : '' }}{{ $settings->city ?? '' }}{{ $settings->city && $settings->country ? ', ' : '' }}{{ $settings->country ?? '' }}
                            </a>
                        </span>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</footer>

<!-- bottom Footer -->
<div class="bottom-footer py-8" style="background-color: #a6d1f1;">
    <div class="container container-lg">
        <div class="bottom-footer__inner flex-between flex-wrap gap-16 py-16">
            <p class="bottom-footer__text wow fadeInLeftBig text-gray-900">{{ $siteName ?? 'Sip & Go' }} eCommerce &copy; {{ date('Y') }}. All Rights Reserved. Must be 18+ to purchase alcohol.</p>
            <div class="flex-align gap-8 flex-wrap wow fadeInRightBig" style="margin-left: -15px;">
                <span class="text-heading text-sm text-gray-900">We Are Accepting</span>
                @php
                    $paymentImage = $settings->payment_methods_image ?? null;
                    if ($paymentImage && !empty(trim($paymentImage))) {
                        // Check if it's already a full URL
                        if (filter_var($paymentImage, FILTER_VALIDATE_URL)) {
                            $paymentImageUrl = $paymentImage;
                        } else {
                            // Remove leading slash if present and ensure proper path
                            $paymentImage = ltrim($paymentImage, '/');
                            // Ensure the path is not empty
                            if (!empty($paymentImage)) {
                                $paymentImageUrl = asset('storage/' . $paymentImage);
                            } else {
                                $paymentImageUrl = asset('assets/images/thumbs/payment-method.png');
                            }
                        }
                    } else {
                        $paymentImageUrl = asset('assets/images/thumbs/payment-method.png');
                    }
                @endphp
                <img src="{{ $paymentImageUrl }}" alt="Payment Methods" style="max-height: 40px; width: auto;">
            </div>
        </div>
    </div>
</div>
<!-- ==================== Footer Two End Here ==================== -->

