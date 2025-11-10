<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{
    /**
     * Display My Account page
     */
    public function index()
    {
        $customer = Auth::guard('customer')->user();

        // Get recent orders if customer is authenticated
        $recentOrders = collect();
        if ($customer) {
            $recentOrders = Order::where('customer_id', $customer->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }

        return view('storefront.my-account.index', compact('customer', 'recentOrders'));
    }

    /**
     * Update customer profile
     */
    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('login')->with('error', 'Please login to update your profile.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update customer information
        $customer->first_name = $validated['first_name'];
        $customer->last_name = $validated['last_name'];
        $customer->email = $validated['email'];
        $customer->phone = $validated['phone'] ?? null;
        $customer->address_line_1 = $validated['address_line_1'] ?? null;
        $customer->address_line_2 = $validated['address_line_2'] ?? null;
        $customer->city = $validated['city'] ?? null;
        $customer->state = $validated['state'] ?? null;
        $customer->postal_code = $validated['postal_code'] ?? null;
        $customer->country = $validated['country'] ?? null;

        // Update password if provided
        if (!empty($validated['password'])) {
            $customer->password = Hash::make($validated['password']);
        }

        $customer->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
