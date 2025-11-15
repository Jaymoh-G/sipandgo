@extends('store.layout') @section('title', 'About Us - Sip & Go')
@section('description', 'Learn about Sip & Go, your premier destination for
premium spirits, wine, and craft beverages') @section('content')
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">
                About Sip & Go
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Your premier destination for premium spirits, wine, and craft
                beverages. We're passionate about bringing you the world's
                finest liquors with exceptional service.
            </p>
        </div>

        <!-- Story Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                <p class="text-lg text-gray-600 mb-6">
                    Founded with a passion for exceptional spirits, Sip & Go has
                    been curating the world's finest collection of premium
                    liquors for discerning customers. Our journey began with a
                    simple mission: to make exceptional spirits accessible to
                    everyone.
                </p>
                <p class="text-lg text-gray-600">
                    Today, we're proud to offer an extensive selection of
                    whiskey, vodka, rum, tequila, gin, wine, and more, all
                    carefully selected for their quality and character.
                </p>
            </div>
            <div
                class="bg-gradient-to-br from-amber-100 to-amber-200 rounded-lg h-96 flex items-center justify-center"
            >
                <i class="fas fa-wine-glass-alt text-8xl text-amber-600"></i>
            </div>
        </div>

        <!-- Values Section -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">
                Our Values
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div
                        class="bg-amber-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6"
                    >
                        <i class="fas fa-star text-3xl text-amber-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">
                        Quality First
                    </h3>
                    <p class="text-gray-600">
                        We carefully curate every product in our collection,
                        ensuring only the finest spirits make it to our shelves.
                    </p>
                </div>

                <div class="text-center">
                    <div
                        class="bg-amber-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6"
                    >
                        <i class="fas fa-users text-3xl text-amber-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">
                        Customer Service
                    </h3>
                    <p class="text-gray-600">
                        Our knowledgeable team is here to help you find the
                        perfect spirit for any occasion or preference.
                    </p>
                </div>

                <div class="text-center">
                    <div
                        class="bg-amber-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6"
                    >
                        <i
                            class="fas fa-shield-alt text-3xl text-amber-600"
                        ></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">
                        Responsible Service
                    </h3>
                    <p class="text-gray-600">
                        We promote responsible consumption and ensure all
                        customers meet legal age requirements for alcohol
                        purchase.
                    </p>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="bg-gray-50 rounded-lg p-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Meet Our Team</h2>
            <p class="text-lg text-gray-600 mb-8">
                Our passionate team of spirits experts is dedicated to helping
                you discover your next favorite drink.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg p-6 shadow-md">
                    <div
                        class="bg-gradient-to-br from-amber-100 to-amber-200 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4"
                    >
                        <i class="fas fa-user text-3xl text-amber-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        James Smith
                    </h3>
                    <p class="text-gray-600 mb-2">Store Manager</p>
                    <p class="text-sm text-gray-500">
                        15+ years in spirits retail
                    </p>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-md">
                    <div
                        class="bg-gradient-to-br from-amber-100 to-amber-200 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4"
                    >
                        <i class="fas fa-user text-3xl text-amber-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        Sarah Johnson
                    </h3>
                    <p class="text-gray-600 mb-2">Wine Specialist</p>
                    <p class="text-sm text-gray-500">Certified sommelier</p>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-md">
                    <div
                        class="bg-gradient-to-br from-amber-100 to-amber-200 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4"
                    >
                        <i class="fas fa-user text-3xl text-amber-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        Mike Davis
                    </h3>
                    <p class="text-gray-600 mb-2">Spirits Expert</p>
                    <p class="text-sm text-gray-500">Whiskey connoisseur</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection















