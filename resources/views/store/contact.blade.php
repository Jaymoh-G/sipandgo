@extends('store.layout') @section('title', 'Contact Us - Sip & Go')
@section('description', 'Get in touch with Sip & Go for questions about our
products, orders, or any other inquiries') @section('content')
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Contact Us</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Have questions about our products or need assistance with your
                order? We're here to help! Get in touch with our team.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Information -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-8">
                    Get in Touch
                </h2>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div
                            class="bg-amber-100 w-12 h-12 rounded-full flex items-center justify-center mr-4"
                        >
                            <i class="fas fa-map-marker-alt text-amber-600"></i>
                        </div>
                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-900 mb-1"
                            >
                                Address
                            </h3>
                            <p class="text-gray-600">
                                123 Premium Spirits Lane<br />
                                Beverage City, BC 12345<br />
                                United States
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div
                            class="bg-amber-100 w-12 h-12 rounded-full flex items-center justify-center mr-4"
                        >
                            <i class="fas fa-phone text-amber-600"></i>
                        </div>
                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-900 mb-1"
                            >
                                Phone
                            </h3>
                            <p class="text-gray-600">(555) 123-SIP (747)</p>
                            <p class="text-sm text-gray-500">
                                Mon-Fri: 9AM-6PM EST
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div
                            class="bg-amber-100 w-12 h-12 rounded-full flex items-center justify-center mr-4"
                        >
                            <i class="fas fa-envelope text-amber-600"></i>
                        </div>
                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-900 mb-1"
                            >
                                Email
                            </h3>
                            <p class="text-gray-600">info@sipandgo.com</p>
                            <p class="text-sm text-gray-500">
                                We'll respond within 24 hours
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div
                            class="bg-amber-100 w-12 h-12 rounded-full flex items-center justify-center mr-4"
                        >
                            <i class="fas fa-clock text-amber-600"></i>
                        </div>
                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-900 mb-1"
                            >
                                Store Hours
                            </h3>
                            <p class="text-gray-600">
                                Monday - Friday: 9:00 AM - 8:00 PM<br />
                                Saturday: 10:00 AM - 6:00 PM<br />
                                Sunday: 12:00 PM - 5:00 PM
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Follow Us
                    </h3>
                    <div class="flex space-x-4">
                        <a
                            href="#"
                            class="bg-blue-600 hover:bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors"
                        >
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a
                            href="#"
                            class="bg-blue-400 hover:bg-blue-500 text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors"
                        >
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a
                            href="#"
                            class="bg-pink-600 hover:bg-pink-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors"
                        >
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a
                            href="#"
                            class="bg-red-600 hover:bg-red-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition-colors"
                        >
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-8">
                    Send us a Message
                </h2>

                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                for="first_name"
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >First Name</label
                            >
                            <input
                                type="text"
                                id="first_name"
                                name="first_name"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            />
                        </div>
                        <div>
                            <label
                                for="last_name"
                                class="block text-sm font-medium text-gray-700 mb-2"
                                >Last Name</label
                            >
                            <input
                                type="text"
                                id="last_name"
                                name="last_name"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            />
                        </div>
                    </div>

                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Email Address</label
                        >
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                        />
                    </div>

                    <div>
                        <label
                            for="phone"
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Phone Number</label
                        >
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                        />
                    </div>

                    <div>
                        <label
                            for="subject"
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Subject</label
                        >
                        <select
                            id="subject"
                            name="subject"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                        >
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="order">Order Question</option>
                            <option value="product">Product Information</option>
                            <option value="shipping">
                                Shipping & Delivery
                            </option>
                            <option value="returns">Returns & Exchanges</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label
                            for="message"
                            class="block text-sm font-medium text-gray-700 mb-2"
                            >Message</label
                        >
                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="Tell us how we can help you..."
                        ></textarea>
                    </div>

                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="age_verification"
                            name="age_verification"
                            required
                            class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded"
                        />
                        <label
                            for="age_verification"
                            class="ml-2 block text-sm text-gray-700"
                        >
                            I confirm that I am 21 years of age or older
                        </label>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-amber-600 hover:bg-amber-700 text-white py-3 px-6 rounded-lg font-semibold transition-colors"
                    >
                        Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">
                Frequently Asked Questions
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        Do you ship nationwide?
                    </h3>
                    <p class="text-gray-600">
                        Yes, we ship to most states in the US. Some restrictions
                        may apply based on local laws.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        What is your return policy?
                    </h3>
                    <p class="text-gray-600">
                        We offer returns within 30 days of purchase, subject to
                        our return policy terms.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        Do you offer age verification?
                    </h3>
                    <p class="text-gray-600">
                        Yes, we require age verification for all alcohol
                        purchases. You must be 21+ to order.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        How long does shipping take?
                    </h3>
                    <p class="text-gray-600">
                        Standard shipping takes 3-5 business days. Express
                        shipping options are available.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
















