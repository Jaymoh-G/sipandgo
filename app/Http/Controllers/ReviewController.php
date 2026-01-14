<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Check if user already reviewed this product (by email)
        $existingReview = ProductReview::where('product_id', $product->id)
            ->where('email', $request->email)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already submitted a review for this product.');
        }

        ProductReview::create([
            'product_id' => $product->id,
            'customer_id' => auth()->id() ?? null,
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'review' => $request->review,
            'is_approved' => true, // Auto-approve for now, can be changed to require admin approval
        ]);

        return back()->with('success', 'Thank you for your review! It has been submitted successfully.');
    }
}
