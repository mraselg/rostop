<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * All orders with status / type filters.
     */
    public function index(Request $request): View
    {
        $query = Order::with(['product', 'package', 'user'])->orderBy('id', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }
        if ($request->filled('type')) {
            $query->where('order_type', $request->query('type'));
        }
        if ($request->filled('q')) {
            $q = trim($request->query('q'));
            $query->where(function ($sub) use ($q) {
                $sub->where('order_code', 'like', "%{$q}%")
                    ->orWhere('customer_phone', 'like', "%{$q}%")
                    ->orWhere('transaction_id', 'like', "%{$q}%")
                    ->orWhere('product_title', 'like', "%{$q}%");
            });
        }

        $orders = $query->paginate(20)->withQueryString();
        $pendingCount = Order::where('status', 'pending')->count();

        return view('admin.orders.index', compact('orders', 'pendingCount'));
    }

    /**
     * Single order detail + edit.
     */
    public function show(int $id): View
    {
        $order = Order::with(['product', 'package', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status / delivery codes / notes / payment info.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,processing,completed,rejected,refunded',
            'delivered_codes' => 'nullable|string',
            'admin_notes' => 'nullable|string',
            'payment_method' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:120',
            'payout_method' => 'nullable|string|max:50',
            'payout_account' => 'nullable|string|max:190',
        ]);

        $order->status = $request->status;
        $order->delivered_codes = $request->delivered_codes;
        $order->admin_notes = $request->admin_notes;
        $order->payment_method = $request->payment_method ?: $order->payment_method;
        $order->transaction_id = $request->transaction_id;
        $order->payout_method = $request->payout_method;
        $order->payout_account = $request->payout_account;

        if ($request->status === 'completed' && !$order->completed_at) {
            $order->completed_at = now();
        }
        $order->save();

        return back()->with('success', "অর্ডার {$order->order_code} আপডেট হয়েছে!");
    }

    /**
     * Delete an order record permanently.
     */
    public function destroy(int $id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $code = $order->order_code;
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', "অর্ডার {$code} ডিলিট করা হয়েছে।");
    }
}
