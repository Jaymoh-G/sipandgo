<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of categories
     */
    public function index(Request $request)
    {
        $query = Category::where('is_active', true)->withCount('products');

        // Filter by parent
        if ($request->has('parent_id')) {
            if ($request->parent_id === 'null' || $request->parent_id === null) {
                $query->whereNull('parent_id');
            } else {
                $query->where('parent_id', $request->parent_id);
            }
        }

        // Include children
        if ($request->has('with_children') && $request->with_children) {
            $query->with('children');
        }

        // Include parent
        if ($request->has('with_parent') && $request->with_parent) {
            $query->with('parent');
        }

        $query->orderBy('sort_order')->orderBy('name');

        $categories = $query->get();

        return $this->success(
            CategoryResource::collection($categories),
            'Categories retrieved successfully'
        );
    }

    /**
     * Display the specified category
     */
    public function show(Category $category)
    {
        if (!$category->is_active) {
            return $this->error('Category not found', 404);
        }

        $category->load(['parent', 'children', 'products' => function ($query) {
            $query->where('is_active', true)->limit(10);
        }]);

        return $this->success(
            new CategoryResource($category),
            'Category retrieved successfully'
        );
    }
}

