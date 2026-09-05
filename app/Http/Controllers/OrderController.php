<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductPackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Checkout View
     */
    public function checkout(Request $request): View
    {
        $packageId = $request->query('package_id');
        $package = ProductPackage::with('product')->findOrFail($packageId);
        $playerId = $request->query('player_id');
        $zoneId = $request->query('zone_id');
        $paymentMethod = $request->query('payment_method');

        return view('pages.checkout', compact('package', 'playerId', 'zoneId', 'paymentMethod'));
    }

    /**
     * Place Order (Buy or Topup)
     */
    public function placeOrder(Request $request): RedirectResponse
    {
        $request->validate([
            'package_id' => 'required|exists:product_packages,id',
            'customer_phone' => 'required|string',
            'customer_name' => 'nullable|string',
            'customer_email' => 'nullable|email',
            'payment_method' => 'required|in:bkash,nagad,rocket,upay,usdt,wallet',
            'sender_number' => 'required|string',
            'transaction_id' => 'required|string',
        ]);

        $package = ProductPackage::with('product')->findOrFail($request->package_id);
        $product = $package->product;

        $orderCode = 'CL-B' . mt_rand(10000, 99999);

        $order = Order::create([
            'order_code' => $orderCode,
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name ?? 'Valued Customer',
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'order_type' => $product->stock_type === 'manual_topup' ? 'topup' : 'buy',
            'product_id' => $product->id,
            'product_package_id' => $package->id,
            'product_title' => $product->title,
            'package_title' => $package->name,
            'quantity' => 1,
            'amount_bdt' => $package->price_bdt,
            'payment_method' => $request->payment_method,
            'sender_number' => $request->sender_number,
            'transaction_id' => $request->transaction_id,
            'player_id_input' => $request->player_id_input ?? $request->player_id,
            'server_input' => $request->server_input ?? $request->zone_id,
            'customer_notes' => $request->customer_notes,
            'status' => 'pending',
        ]);

        return redirect()->route('order.success', ['order_code' => $orderCode])
            ->with('success', 'Order placed successfully! We are verifying your payment.');
    }

    /**
     * Order Success & Invoice
     */
    public function success(string $orderCode): View
    {
        $order = Order::with(['product', 'package'])->where('order_code', $orderCode)->firstOrFail();
        return view('pages.order_success', compact('order'));
    }

    /**
     * Track Order View & Search
     */
    public function trackOrder(Request $request): View
    {
        $query = $request->input('query');
        $order = null;
        $searched = false;

        if ($query) {
            $searched = true;
            $order = Order::with(['product', 'package'])
                ->where('order_code', trim($query))
                ->orWhere('customer_phone', trim($query))
                ->orWhere('transaction_id', trim($query))
                ->orderBy('id', 'desc')
                ->first();
        }

        return view('pages.track_order', compact('order', 'searched', 'query'));
    }
}
