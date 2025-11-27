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

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Product Media -->
            <div class="lg:col-span-6 space-y-6">
                <div class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-100 rounded-3xl p-6 shadow-lg">
                    @if($product->primary_image_url)
                        <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain rounded-2xl">
                    @else
                        <div class="aspect-square flex items-center justify-center">
                            <i class="fas fa-wine-bottle text-8xl text-gray-300"></i>
                        </div>
                    @endif
                </div>

                @if($product->images && is_array($product->images))
                @php
                    $thumbnails = collect($product->images)
                        ->map(function ($image) {
                            return is_string($image) ? trim($image) : ($image['url'] ?? null);
                        })
                        ->filter()
                        ->take(4);
                @endphp
                @if($thumbnails->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($thumbnails as $thumb)
                    <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm">
                        <img src="{{ $thumb }}" alt="{{ $product->name }}" class="w-full h-28 object-contain">
                    </div>
                    @endforeach
                </div>
                @endif
                @endif
            </div>

            <!-- Product Details -->
            <div class="lg:col-span-6 space-y-6">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-2 bg-amber-100 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full">
                        <i class="fas fa-tag text-amber-600"></i>
                        {{ $product->category->name }}
                    </span>
                    <span class="text-sm text-gray-500">SKU: {{ $product->sku }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <h1 class="text-4xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-gray-900">{{ $product->formatted_price }}</div>
                        @if($product->compare_price)
                        <span class="text-sm text-gray-400 line-through">{{ '$' . number_format($product->compare_price, 2) }}</span>
                        @endif
                    </div>
                </div>

                <p class="text-lg text-gray-600 leading-relaxed">
                    {{ $product->short_description ?? $product->description }}
                </p>

                <div class="grid grid-cols-2 gap-4 bg-gray-50 rounded-3xl p-6 border border-gray-100">
                    <div>
                        <p class="text-sm text-gray-500">Brand</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $product->brand ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Alcohol Content</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $product->alcohol_content ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Volume</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $product->volume ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Origin</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $product->origin_country ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-3xl p-5 flex items-start gap-4">
                    <span class="flex h-12 w-12 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                        <i class="fas fa-shield-alt"></i>
                    </span>
                    <div>
                        <p class="font-semibold text-amber-900">Age Verification</p>
                        <p class="text-sm text-amber-800">You must be {{ $product->min_age }} or older to purchase this product.</p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 font-medium">Quantity</span>
                        <div class="flex rounded-full border border-gray-200 overflow-hidden">
                            <button class="px-4 py-2 text-gray-600 hover:bg-gray-50"><i class="fas fa-minus"></i></button>
                            <input type="number" min="1" value="1" class="w-16 text-center border-x border-gray-200 focus:outline-none">
                            <button class="px-4 py-2 text-gray-600 hover:bg-gray-50"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <button class="w-full flex items-center justify-center gap-3 bg-amber-600 hover:bg-amber-700 text-white py-4 rounded-full font-semibold shadow-lg shadow-amber-200 transition">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span><i class="fas fa-shipping-fast mr-2 text-amber-600"></i>Fast dispatch</span>
                        <span><i class="fas fa-undo mr-2 text-amber-600"></i>Easy Returns</span>
                        <span><i class="fas fa-lock mr-2 text-amber-600"></i>Secure Checkout</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection




















