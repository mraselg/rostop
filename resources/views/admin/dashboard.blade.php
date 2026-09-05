@extends('layouts.admin')

@section('title', 'Dashboard | RosTop Admin')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Dashboard</h1>
        <p class="adm-page-sub">প্ল্যাটফর্মের সার্বিক চিত্র — রেভেনিউ, অর্ডার কিউ ও দ্রুত অ্যাকশন।</p>
    </div>
    <div class="adm-actions-row">
        <a href="{{ route('admin.products.create') }}" class="adm-btn adm-btn-primary">
            <i data-lucide="plus" class="icon"></i> New Product
        </a>
    </div>
</div>

<!-- Analytics Stats -->
<div class="adm-stats-grid">
    <div class="adm-stat-card">
        <div class="adm-stat-label">Total Revenue</div>
        <div class="adm-stat-val" style="color: var(--primary);">৳ {{ number_format($totalRevenue) }}</div>
        <div class="adm-stat-sub">Purchases & Top-Ups</div>
    </div>
    <div class="adm-stat-card">
        <div class="adm-stat-label">Total Payouts</div>
        <div class="adm-stat-val" style="color: var(--accent-amber);">৳ {{ number_format($totalPayouts) }}</div>
        <div class="adm-stat-sub">Sent to Sellers (bKash/Nagad)</div>
    </div>
    <div class="adm-stat-card">
        <div class="adm-stat-label">Pending Queue</div>
        <div class="adm-stat-val" style="color: {{ $pendingCount > 0 ? '#FB7185' : '#34D399' }};">{{ $pendingCount }}</div>
        <div class="adm-stat-sub">Orders need action</div>
    </div>
    <div class="adm-stat-card">
        <div class="adm-stat-label">Completed Orders</div>
        <div class="adm-stat-val" style="color: #38BDF8;">{{ $completedCount }}</div>
        <div class="adm-stat-sub">Successfully processed</div>
    </div>
</div>

<!-- Orders Queue -->
<div class="adm-card">
    <div class="adm-page-head" style="margin-bottom: 0.9rem;">
        <h2 class="adm-card-title" style="margin: 0;">Incoming Orders & Payout Requests</h2>
        <div class="adm-actions-row">
            <a href="{{ route('admin.orders.index') }}" class="adm-btn adm-btn-secondary adm-btn-xs">All Orders</a>
            <a href="{{ route('admin.dashboard') }}" class="adm-btn {{ !request('status') && !request('type') ? 'adm-btn-primary' : 'adm-btn-secondary' }} adm-btn-xs">Queue ({{ $orders->total() }})</a>
            <a href="{{ route('admin.dashboard', ['status' => 'pending']) }}" class="adm-btn {{ request('status') === 'pending' ? 'adm-btn-amber' : 'adm-btn-secondary' }} adm-btn-xs">Pending ({{ $pendingCount }})</a>
            <a href="{{ route('admin.dashboard', ['type' => 'sell']) }}" class="adm-btn {{ request('type') === 'sell' ? 'adm-btn-amber' : 'adm-btn-secondary' }} adm-btn-xs">Voucher Sells</a>
        </div>
    </div>

    <div class="adm-table-wrap">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Type</th>
                    <th>Item / Package</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Payment Info</th>
                    <th>Status</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" style="font-weight: 800; color: var(--primary); text-decoration: none;">
                                {{ $order->order_code }}
                            </a>
                            <div style="font-size: 0.68rem; color: var(--text-dim);">{{ $order->created_at->format('d M, h:i A') }}</div>
                        </td>
                        <td>
                            <span class="adm-pill {{ $order->order_type === 'sell' ? 'adm-pill-amber' : 'adm-pill-green' }}">
                                {{ strtoupper($order->order_type) }}
                            </span>
                        </td>
                        <td>
                            <div style="font-weight: 700;">{{ $order->product_title }}</div>
                            @if($order->player_id_input)
                                <div style="font-size: 0.72rem; color: var(--text-dim);">UID: <strong>{{ $order->player_id_input }}</strong></div>
                            @endif
                        </td>
                        <td style="font-weight: 600;">{{ $order->customer_phone }}</td>
                        <td style="font-weight: 800; color: var(--primary); white-space: nowrap;">৳ {{ number_format($order->amount_bdt) }}</td>
                        <td>
                            @if($order->order_type === 'sell')
                                <div style="font-size: 0.78rem; color: var(--accent-amber);"><strong>PIN:</strong> {{ Str::limit($order->gift_card_codes, 26) }}</div>
                                <div style="font-size: 0.72rem; color: #34D399;">→ {{ strtoupper($order->payout_method) }} {{ $order->payout_account }}</div>
                            @else
                                <div style="font-size: 0.78rem;">{{ strtoupper($order->payment_method) }}: {{ $order->sender_number }}</div>
                                <div style="font-size: 0.72rem; color: var(--text-dim);">TrxID: <strong>{{ $order->transaction_id }}</strong></div>
                            @endif
                        </td>
                        <td>
                            <span class="adm-pill {{ $order->status === 'completed' ? 'adm-pill-green' : ($order->status === 'pending' ? 'adm-pill-amber' : ($order->status === 'processing' ? 'adm-pill-blue' : 'adm-pill-red')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <div class="adm-actions-row" style="justify-content: flex-end;">
                                @if($order->status !== 'completed')
                                    <form action="{{ route('admin.order.status', $order->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="adm-btn adm-btn-primary adm-btn-xs" title="Approve & Complete">✓ Complete</button>
                                    </form>
                                @else
                                    <span style="font-size: 0.74rem; color: #34D399; font-weight: 700;">Delivered</span>
                                @endif
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="adm-btn adm-btn-secondary adm-btn-xs">View</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" style="padding: 2rem; text-align: center; color: var(--text-dim);">No orders in this queue.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $orders->links() }}
</div>

<!-- Exchange Rates Quick Manager -->
<div class="adm-card">
    <div class="adm-page-head" style="margin-bottom: 0.5rem;">
        <div>
            <h2 class="adm-card-title" style="margin: 0;">Exchange Rates — Quick Edit</h2>
            <p class="adm-page-sub">sell % ও BDT কনভার্সন রেট দ্রুত বদলান। নতুন ব্র্যান্ড যুক্ত করতে <a href="{{ route('admin.rates.index') }}" style="color: var(--primary);">Rates পেজে</a> যান।</p>
        </div>
        <a href="{{ route('admin.rates.index') }}" class="adm-btn adm-btn-secondary adm-btn-xs">Full Rates Manager</a>
    </div>

    <div class="adm-table-wrap">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Currency</th>
                    <th>Sell Payout (%)</th>
                    <th>BDT Rate</th>
                    <th>Active</th>
                    <th style="text-align: right;">Save</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rates as $rate)
                    <tr>
                        <td style="font-weight: 700;">
                            <form action="{{ route('admin.rate.update', $rate->id) }}" method="POST" class="m-0" id="qd-rate-{{ $rate->id }}">@csrf</form>
                            {{ $rate->brand_name }}
                        </td>
                        <td style="color: var(--text-dim);">{{ $rate->currency_code }}</td>
                        <td>
                            <div class="d-flex align-items-center" style="gap: 0.35rem;">
                                <input form="qd-rate-{{ $rate->id }}" type="number" name="sell_rate_percent" class="adm-input adm-input-sm" value="{{ $rate->sell_rate_percent }}" style="width: 80px;" min="50" max="100" step="0.5" required>
                                <span style="font-size: 0.75rem; color: var(--text-dim);">%</span>
                            </div>
                        </td>
                        <td>
                            <input form="qd-rate-{{ $rate->id }}" type="number" name="bdt_conversion_rate" class="adm-input adm-input-sm" value="{{ $rate->bdt_conversion_rate }}" style="width: 100px;" min="1" step="0.1" required>
                        </td>
                        <td>
                            <span class="adm-pill {{ $rate->is_active ? 'adm-pill-green' : 'adm-pill-gray' }}">{{ $rate->is_active ? 'Active' : 'Off' }}</span>
                        </td>
                        <td style="text-align: right;">
                            <button form="qd-rate-{{ $rate->id }}" type="submit" class="adm-btn adm-btn-secondary adm-btn-xs">Update</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
