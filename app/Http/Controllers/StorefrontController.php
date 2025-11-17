<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    /**
     * Display the homepage with featured products
     */
    public function home()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->with('category')
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        $sliders = Slider::active()
            ->ordered()
            ->get();

        return view('storefront.index', compact('featuredProducts', 'categories', 'sliders'));
    }

    /**
     * Display paginated products with category filtering
     */
    public function shop(Request $request)
    {
        $query = Product::where('is_active', true)->with('category');

        // Filter by category if specified
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by brand
        if ($request->has('brand') && $request->brand) {
            $query->where('brand', $request->brand);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('short_description', 'like', '%' . $request->search . '%')
                    ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        // Price filtering
        if ($request->has('min_price') && $request->min_price !== null && $request->min_price !== '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price !== null && $request->max_price !== '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        $sortBy = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');

        switch ($sortBy) {
            case 'price':
                $query->orderBy('price', $sortDirection);
                break;
            case 'created_at':
                $query->orderBy('created_at', $sortDirection);
                break;
            case 'name':
            default:
                $query->orderBy('name', $sortDirection);
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $brands = Product::where('is_active', true)
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->selectRaw('brand, COUNT(*) as products_count')
            ->groupBy('brand')
            ->orderBy('brand')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->brand => $item->products_count];
            });

        return view('storefront.products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Display a single product page by slug
     */
    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with('category')
            ->limit(4)
            ->get();

        return view('storefront.products.show', compact('product', 'relatedProducts'));
    }
}

