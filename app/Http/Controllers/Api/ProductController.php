<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of products
     */
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with(['category', 'variants']);

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by category slug
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        // Price filter
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Featured filter
        if ($request->has('featured') && $request->featured) {
            $query->where('is_featured', true);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortDirection = $request->get('sort_direction', 'asc');

        $allowedSorts = ['name', 'price', 'created_at', 'sort_order'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDirection);
        }

        $perPage = $request->get('per_page', 15);
        $products = $query->paginate($perPage);

        return $this->success(
            ProductResource::collection($products)->response()->getData(true),
            'Products retrieved successfully'
        );
    }

    /**
     * Display the specified product
     */
    public function show(Product $product)
    {
        if (!$product->is_active) {
            return $this->error('Product not found', 404);
        }

        $product->load(['category', 'variants', 'inventory']);

        return $this->success(
            new ProductResource($product),
            'Product retrieved successfully'
        );
    }
}

