@extends('store.layout') @section('title', $product->name . ' - Sip & Go')
@section('description', $product->short_description) @section('content')
<div class="bg-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a
                        href="{{ route('home') }}"
                        class="text-gray-700 hover:text-amber-600"
                    >
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a
                            href="{{ route('categories.show', $product->category) }}"
                            class="text-gray-700 hover:text-amber-600"
                        >
                            {{ $product->category->name }}
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-500">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Image -->
            <div>
                <div
                    class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center mb-6"
                >
                    <i class="fas fa-wine-bottle text-8xl text-gray-400"></i>
                </div>

                @if($product->is_on_sale)
                <div
                    class="bg-red-500 text-white px-4 py-2 rounded-lg text-center font-semibold"
                >
                    {{ $product->discount_percentage }}% OFF - Limited Time!
                </div>
                @endif
            </div>

            <!-- Product Details -->
            <div>
                <div class="mb-4">
                    <span
                        class="inline-block bg-amber-100 text-amber-800 text-sm font-semibold px-3 py-1 rounded-full"
                    >
                        {{ $product->category->name }}
                    </span>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-4">
                    {{ $product->name }}
                </h1>

                <div class="flex items-center space-x-4 mb-6">
                    <div class="flex items-center space-x-2">
                        <span
                            class="text-4xl font-bold text-gray-900"
                            >{{ $product->formatted_price }}</span
                        >
                        @if($product->compare_price)
                        <span
                            class="text-2xl text-gray-500 line-through"
                            >{{ '$' . number_format($product->compare_price, 2) }}</span
                        >
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-lg text-gray-700">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Product Specifications -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Product Details
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm text-gray-600">Brand:</span>
                            <span
                                class="text-sm font-medium text-gray-900 ml-2"
                                >{{ $product->brand ?? 'N/A' }}</span
                            >
                        </div>
                        <div>
                            <span class="text-sm text-gray-600"
                                >Alcohol Content:</span
                            >
                            <span
                                class="text-sm font-medium text-gray-900 ml-2"
                                >{{ $product->alcohol_content ?? 'N/A' }}</span
                            >
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Volume:</span>
                            <span
                                class="text-sm font-medium text-gray-900 ml-2"
                                >{{ $product->volume ?? 'N/A' }}</span
                            >
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Origin:</span>
                            <span
                                class="text-sm font-medium text-gray-900 ml-2"
                                >{{ $product->origin_country ?? 'N/A' }}</span
                            >
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">SKU:</span>
                            <span
                                class="text-sm font-medium text-gray-900 ml-2"
                                >{{ $product->sku }}</span
                            >
                        </div>
                        <div>
                            <span class="text-sm text-gray-600"
                                >Age Requirement:</span
                            >
                            <span class="text-sm font-medium text-gray-900 ml-2"
                                >{{ $product->min_age }}+</span
                            >
                        </div>
                    </div>
                </div>

                <!-- Age Verification Notice -->
                <div
                    class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6"
                >
                    <div class="flex items-center">
                        <i
                            class="fas fa-exclamation-triangle text-amber-600 mr-3"
                        ></i>
                        <div>
                            <h4 class="text-sm font-semibold text-amber-800">
                                Age Verification Required
                            </h4>
                            <p class="text-sm text-amber-700">
                                You must be {{ $product->min_age }} or older to
                                purchase this product.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Add to Cart -->
                <div class="flex space-x-4">
                    <div
                        class="flex items-center border border-gray-300 rounded-lg"
                    >
                        <button
                            class="px-4 py-2 text-gray-600 hover:text-gray-900"
                        >
                            <i class="fas fa-minus"></i>
                        </button>
                        <input
                            type="number"
                            value="1"
                            min="1"
                            class="w-16 text-center border-0 focus:outline-none"
                        />
                        <button
                            class="px-4 py-2 text-gray-600 hover:text-gray-900"
                        >
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <button
                        class="flex-1 bg-amber-600 hover:bg-amber-700 text-white py-3 px-6 rounded-lg font-semibold transition-colors"
                    >
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Add to Cart
                    </button>
                </div>

                <!-- Additional Actions -->
                <div class="flex space-x-4 mt-4">
                    <button
                        class="flex items-center text-gray-600 hover:text-gray-900"
                    >
                        <i class="fas fa-heart mr-2"></i>
                        Add to Wishlist
                    </button>
                    <button
                        class="flex items-center text-gray-600 hover:text-gray-900"
                    >
                        <i class="fas fa-share mr-2"></i>
                        Share
                    </button>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">
                Related Products
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div
                    class="product-card bg-white rounded-lg shadow-md overflow-hidden"
                >
                    <div
                        class="h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center relative"
                    >
                        <i
                            class="fas fa-wine-bottle text-4xl text-gray-400"
                        ></i>
                        @if($relatedProduct->is_on_sale)
                        <div
                            class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold"
                        >
                            {{ $relatedProduct->discount_percentage }}% OFF
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="text-xs text-gray-500 mb-1">
                            {{ $relatedProduct->category->name }}
                        </div>
                        <h3 class="text-sm font-semibold text-gray-900 mb-2">
                            {{ Str::limit($relatedProduct->name, 50) }}
                        </h3>
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-1">
                                <span
                                    class="text-lg font-bold text-gray-900"
                                    >{{ $relatedProduct->formatted_price }}</span
                                >
                                @if($relatedProduct->compare_price)
                                <span
                                    class="text-sm text-gray-500 line-through"
                                    >{{ '$' . number_format($relatedProduct->compare_price, 2) }}</span
                                >
                                @endif
                            </div>
                        </div>
                        <a
                            href="{{ route('products.show', $relatedProduct) }}"
                            class="w-full bg-gray-900 hover:bg-gray-800 text-white py-2 px-3 rounded-lg font-semibold transition-colors text-center block text-sm"
                        >
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection









