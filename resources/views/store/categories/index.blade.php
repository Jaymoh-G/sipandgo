@extends('store.layout') @section('title', 'Categories - Sip & Go')
@section('description', 'Browse our liquor categories including whiskey, vodka,
rum, tequila, gin, wine, and more') @section('content')
<div class="bg-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                Shop by Category
            </h1>
            <p class="text-lg text-gray-600">
                Explore our premium collection organized by spirit type
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
            <div
                class="product-card bg-white rounded-lg shadow-md overflow-hidden"
            >
                <div
                    class="h-64 bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center"
                >
                    <i
                        class="fas fa-wine-glass-alt text-8xl text-amber-600"
                    ></i>
                </div>
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">
                        {{ $category->name }}
                    </h2>
                    <p class="text-gray-600 mb-6">
                        {{ $category->description }}
                    </p>
                    <a
                        href="{{ route('categories.show', $category) }}"
                        class="inline-flex items-center bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors"
                    >
                        Shop {{ $category->name }}
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">
                Can't find what you're looking for?
            </h2>
            <p class="text-lg text-gray-600 mb-6">
                Browse our complete product catalog
            </p>
            <a
                href="{{ route('products.index') }}"
                class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold transition-colors"
            >
                View All Products
            </a>
        </div>
    </div>
</div>
@endsection


















