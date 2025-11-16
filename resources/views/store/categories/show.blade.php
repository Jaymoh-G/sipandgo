@extends('store.layout') @section('title', $category->name . ' - Sip & Go')
@section('description', $category->description) @section('content')
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
                            href="{{ route('categories.index') }}"
                            class="text-gray-700 hover:text-amber-600"
                        >
                            Categories
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-500">{{ $category->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Category Header -->
        <div class="text-center mb-12">
            <div
                class="inline-block bg-gradient-to-br from-amber-100 to-amber-200 rounded-full p-8 mb-6"
            >
                <i class="fas fa-wine-glass-alt text-6xl text-amber-600"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                {{ $category->name }}
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ $category->description }}
            </p>
        </div>

        <!-- Products Count -->
        <div class="text-center mb-8">
            <p class="text-lg text-gray-600">
                {{ $products->total() }} products found
            </p>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
        >
            @foreach($products as $product)
            <div
                class="product-card bg-white rounded-lg shadow-md overflow-hidden"
            >
                <div
                    class="h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center relative"
                >
                    <i class="fas fa-wine-bottle text-6xl text-gray-400"></i>
                    @if($product->is_on_sale)
                    <div
                        class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold"
                    >
                        {{ $product->discount_percentage }}% OFF
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-1">
                        {{ $product->category->name }}
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        {{ $product->name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">
                        {{ Str::limit($product->short_description, 80) }}
                    </p>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <span
                                class="text-2xl font-bold text-gray-900"
                                >{{ $product->formatted_price }}</span
                            >
                            @if($product->compare_price)
                            <span
                                class="text-lg text-gray-500 line-through"
                                >{{ '$' . number_format($product->compare_price, 2) }}</span
                            >
                            @endif
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $product->alcohol_content ?? 'N/A' }}
                        </div>
                    </div>

                    <a
                        href="{{ route('products.show', $product) }}"
                        class="w-full bg-amber-600 hover:bg-amber-700 text-white py-2 px-4 rounded-lg font-semibold transition-colors text-center block"
                    >
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-wine-glass-alt text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                No products found
            </h3>
            <p class="text-gray-600 mb-4">
                We're working on adding more products to this category
            </p>
            <a
                href="{{ route('products.index') }}"
                class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors"
            >
                Browse All Products
            </a>
        </div>
        @endif

        <!-- Back to Categories -->
        <div class="text-center mt-12">
            <a
                href="{{ route('categories.index') }}"
                class="text-gray-600 hover:text-gray-900 font-semibold"
            >
                <i class="fas fa-arrow-left mr-2"></i>
                Back to All Categories
            </a>
        </div>
    </div>
</div>
@endsection

















