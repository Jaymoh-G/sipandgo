<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->with('category')
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return view('storefront.index', compact('featuredProducts', 'categories'));
    }

    public function about()
    {
        return view('storefront.about');
    }

    public function contact()
    {
        return view('storefront.contact');
    }

    public function faq()
    {
        return view('storefront.faq');
    }

    /**
     * Display order tracking form
     */
    public function orderTracking()
    {
        return view('storefront.order-tracking');
    }

    /**
     * Search for order by order number and email
     */
    public function searchOrder(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
            'email' => 'required|email',
        ]);

        // Trim and normalize inputs
        $orderNumber = trim($request->order_number);
        $email = strtolower(trim($request->email));

        // First check if order exists
        $order = Order::where('order_number', $orderNumber)
            ->with(['customer', 'items.product', 'delivery'])
            ->first();

        if (!$order) {
            return back()->withInput()->with('error', 'Order not found. Please check your order number and try again.');
        }

        // Check if email matches (case-insensitive)
        if (!$order->customer) {
            \Log::warning('Order found but customer not found', ['order_id' => $order->id, 'order_number' => $orderNumber]);
            return back()->withInput()->with('error', 'Order found but customer information is missing. Please contact support.');
        }

        if (strtolower($order->customer->email) !== $email) {
            \Log::info('Order tracking email mismatch', [
                'order_number' => $orderNumber,
                'provided_email' => $email,
                'order_customer_email' => $order->customer->email
            ]);
            return back()->withInput()->with('error', 'The email address does not match this order. Please verify the email address you used when placing the order.');
        }

        return view('storefront.order-tracking', compact('order'));
    }
}
