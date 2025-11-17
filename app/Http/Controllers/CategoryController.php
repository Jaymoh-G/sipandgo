<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->paginate(8);

        return view('storefront.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        if (!$category->is_active) {
            abort(404);
        }

        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->with('category')
            ->orderBy('sort_order')
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('storefront.categories.show', compact('category', 'products', 'categories'));
    }
}
