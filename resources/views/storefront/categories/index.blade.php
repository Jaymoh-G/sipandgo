@extends('storefront.layout')

@section('title', 'Categories - Sip & Go')
@section('description', 'Browse all product categories')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">All Categories</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="{{ route('home') }}" class="text-main-600 flex-align gap-8">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                <li class="flex-align text-gray-500">
                    <i class="ph ph-caret-right"></i>
                </li>
                <li class="text-sm text-neutral-600">
                    Categories
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->

<!-- ============================ Category Section Start =============================== -->
<section class="category py-80 bg-gray-50">
    <div class="container container-lg">


        @if($categories->isEmpty())
        <div class="text-center py-80">
            <div class="mb-24">
                <i class="ph ph-folder-open text-6xl text-gray-400"></i>
            </div>
            <h4 class="text-heading mb-16">No Categories Available</h4>
            <p class="text-gray-600 mb-32">Check back soon for our premium collection!</p>
            <a href="{{ route('home') }}" class="btn btn-main rounded-pill">
                <i class="ph ph-house me-2"></i> Go to Home
            </a>
        </div>
        @else
        <div class="row gy-4">
            @foreach($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-duration="{{ 400 + ($loop->index * 100) }}">
                <div class="product-card h-100 border border-gray-100 hover-border-main-600 rounded-16 position-relative transition-2 bg-white hover-shadow-lg overflow-hidden">
                    <a href="{{ route('categories.show', $category->slug ?? $category) }}" class="product-card__thumb position-relative overflow-hidden" style="border-radius: 16px 16px 0 0;">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-100 transition-2" style="height: 280px; object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        @else
                            <div class="w-100 bg-main-50 flex-center position-relative overflow-hidden" style="height: 280px;">
                                <img src="{{ asset('assets/images/icon/category-5.png') }}" alt="{{ $category->name }}" class="w-80 transition-2">
                            </div>
                        @endif
                        <div class="position-absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.1) 50%, transparent 100%);"></div>
                        @if($category->products_count > 0)
                        <div class="position-absolute top-0 end-0 m-16">
                            <span class="badge bg-main-600 text-white px-12 py-6 rounded-pill fw-semibold">
                                {{ $category->products_count }} {{ Str::plural('Item', $category->products_count) }}
                            </span>
                        </div>
                        @endif
                    </a>
                    <div class="product-card__content p-24 text-center">
                        <h6 class="title text-lg fw-semibold mb-12">
                            <a href="{{ route('categories.show', $category->slug ?? $category) }}" class="link text-heading hover-text-main-600 transition-2">
                                {{ $category->name }}
                            </a>
                        </h6>
                        @if($category->description)
                        <p class="text-gray-600 text-sm mb-20" style="min-height: 40px;">
                            {{ Str::limit($category->description, 80) }}
                        </p>
                        @endif
                        <a href="{{ route('categories.show', $category->slug ?? $category) }}" class="btn bg-main-50 text-main-600 hover-bg-main-600 hover-text-white py-11 px-24 rounded-pill flex-align gap-8 w-100 justify-content-center transition-2 fw-medium">
                            Shop Now <i class="ph ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination Start -->
        <div class="mt-64">
            {{ $categories->links('vendor.pagination.marketpro') }}
        </div>
        <!-- Pagination End -->
        @endif
    </div>
</section>
<!-- ============================ Category Section End =============================== -->

@push('styles')
<style>
    /* Enhanced Category Cards */
    .category .product-card {
        transition: all 0.3s ease;
    }

    .category .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .category .product-card__thumb {
        position: relative;
    }

    .category .product-card__thumb::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.3) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .category .product-card:hover .product-card__thumb::after {
        opacity: 1;
    }

    /* Enhanced Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 64px;
        padding: 0;
    }

    .pagination .page-item {
        margin: 0;
    }

    .pagination .page-link {
        min-width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        color: #374151;
        text-decoration: none;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--main-600) 0%, var(--main-700) 100%);
        border-color: var(--main-600);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(225, 167, 67, 0.3);
        transform: scale(1.05);
    }

    .pagination .page-link:hover:not(.disabled) {
        background: var(--main-50);
        border-color: var(--main-300);
        color: var(--main-600);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .pagination .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f9fafb;
    }

    .pagination .page-item.disabled .page-link:hover {
        transform: none;
        box-shadow: none;
    }

    /* Badge Styling */
    .category .badge {
        font-size: 12px;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    /* Responsive Pagination */
    @media (max-width: 768px) {
        .pagination {
            gap: 8px;
            margin-top: 48px;
        }

        .pagination .page-link {
            min-width: 40px;
            height: 40px;
            font-size: 13px;
        }
    }

    @media (max-width: 576px) {
        .pagination .page-link {
            min-width: 36px;
            height: 36px;
            font-size: 12px;
            padding: 0 8px;
        }
    }
</style>
@endpush

@endsection

