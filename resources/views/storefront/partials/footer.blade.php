<!-- ==================== Footer Two Start Here ==================== -->
<footer class="footer py-80 overflow-hidden" style="background-color: #070705;">
    <div class="container container-lg">
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-3 footer-item" data-aos="fade-up" data-aos-duration="200">
                <div class="footer-item__logo mb-24">
                    <a href="{{ route('home') }}"> <img src="{{ asset('assets/images/logo/sip-n-go-logo.png') }}" alt="Sip N Go Logo" style="max-height: 80px;"></a>
                </div>
                <p class="mb-24 text-gray-300">Sip & Go become the largest premium spirits, wine, and craft beverages retailer. We offer an extensive collection of the world's finest liquors with exceptional service.</p>
                <div class="flex-align gap-16">
                    <a href="https://www.facebook.com" class="w-44 h-44 flex-center bg-main-two-50 text-main-two-600 text-xl rounded-8 hover-bg-main-two-600 hover-text-white">
                        <i class="ph-fill ph-facebook-logo"></i>
                    </a>
                    <a href="https://www.twitter.com" class="w-44 h-44 flex-center bg-main-two-50 text-main-two-600 text-xl rounded-8 hover-bg-main-two-600 hover-text-white">
                        <i class="ph-fill ph-twitter-logo"></i>
                    </a>
                    <a href="https://www.instagram.com" class="w-44 h-44 flex-center bg-main-two-50 text-main-two-600 text-xl rounded-8 hover-bg-main-two-600 hover-text-white">
                        <i class="ph-fill ph-instagram-logo"></i>
                    </a>
                    <a href="https://www.linkedin.com" class="w-44 h-44 flex-center bg-main-two-50 text-main-two-600 text-xl rounded-8 hover-bg-main-two-600 hover-text-white">
                        <i class="ph-fill ph-linkedin-logo"></i>
                    </a>
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
                <div class="flex-align gap-16 mb-16">
                    <span class="w-32 h-32 flex-center rounded-circle border border-gray-600 text-main-600 text-md flex-shrink-0"><i class="ph-fill ph-phone-call"></i></span>
                    <a href="tel:+00123456789" class="text-md text-gray-300 hover-text-main-600">+00 123 456 789</a>
                </div>
                <div class="flex-align gap-16 mb-16">
                    <span class="w-32 h-32 flex-center rounded-circle border border-gray-600 text-main-600 text-md flex-shrink-0"><i class="ph-fill ph-envelope"></i></span>
                    <a href="mailto:support24@sipandgo.com" class="text-md text-gray-300 hover-text-main-600">support24@sipandgo.com</a>
                </div>
                <div class="flex-align gap-16 mb-16">
                    <span class="w-32 h-32 flex-center rounded-circle border border-gray-600 text-main-600 text-md flex-shrink-0"><i class="ph-fill ph-map-pin"></i></span>
                    <span class="text-md text-gray-300">789 Inner Lane, California, USA</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- bottom Footer -->
<div class="bottom-footer py-8" style="background-color: #e1a743;">
    <div class="container container-lg">
        <div class="bottom-footer__inner flex-between flex-wrap gap-16 py-16">
            <p class="bottom-footer__text wow fadeInLeftBig text-gray-900">Sip & Go eCommerce &copy; {{ date('Y') }}. All Rights Reserved. Must be 18+ to purchase alcohol.</p>
            <div class="flex-align gap-8 flex-wrap wow fadeInRightBig">
                <span class="text-heading text-sm text-gray-900">We Are Accepting</span>
                <img src="{{ asset('assets/images/thumbs/payment-method.png') }}" alt="Payment Methods">
            </div>
        </div>
    </div>
</div>
<!-- ==================== Footer Two End Here ==================== -->

