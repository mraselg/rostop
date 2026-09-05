<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Admin Overview Dashboard
     */
    public function dashboard(Request $request): View
    {
        $statusFilter = $request->query('status');
        $typeFilter = $request->query('type');

        $query = Order::with(['product', 'package'])->orderBy('id', 'desc');

        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }
        if ($typeFilter) {
            $query->where('order_type', $typeFilter);
        }

        $orders = $query->paginate(15);

        $totalRevenue = Order::where('status', 'completed')->where('order_type', '!=', 'sell')->sum('amount_bdt');
        $totalPayouts = Order::where('status', 'completed')->where('order_type', 'sell')->sum('amount_bdt');
        $pendingCount = Order::where('status', 'pending')->count();
        $completedCount = Order::where('status', 'completed')->count();

        $rates = ExchangeRate::orderBy('id')->get();
        $products = Product::with('category')->get();

        return view('admin.dashboard', compact(
            'orders',
            'totalRevenue',
            'totalPayouts',
            'pendingCount',
            'completedCount',
            'rates',
            'products'
        ));
    }

    /**
     * Update Order Status & Deliver Codes
     */
    public function updateOrderStatus(Request $request, int $id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,processing,completed,rejected',
            'delivered_codes' => 'nullable|string',
            'admin_notes' => 'nullable|string',
        ]);

        $order->status = $request->status;
        if ($request->filled('delivered_codes')) {
            $order->delivered_codes = $request->delivered_codes;
        }
        if ($request->filled('admin_notes')) {
            $order->admin_notes = $request->admin_notes;
        }
        if ($request->status === 'completed' && !$order->completed_at) {
            $order->completed_at = now();
        }
        $order->save();

        return back()->with('success', "Order {$order->order_code} marked as {$request->status}!");
    }

    /**
     * Update Exchange Rate
     */
    public function updateRate(Request $request, int $id): RedirectResponse
    {
        $rate = ExchangeRate::findOrFail($id);
        $request->validate([
            'sell_rate_percent' => 'required|numeric|min:50|max:100',
            'bdt_conversion_rate' => 'required|numeric|min:50',
        ]);

        $rate->update([
            'sell_rate_percent' => $request->sell_rate_percent,
            'bdt_conversion_rate' => $request->bdt_conversion_rate,
        ]);

        return back()->with('success', "Updated rate for {$rate->brand_name}!");
    }
}
