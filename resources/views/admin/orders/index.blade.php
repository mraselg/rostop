@extends('layouts.admin')

@section('title', 'Orders | RosTop Admin')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Orders</h1>
        <p class="adm-page-sub">সব অর্ডার — খুঁজুন, ফিল্টার করুন, বিস্তারিত দেখুন।</p>
    </div>
</div>

<div class="adm-filter-bar">
    <form action="{{ route('admin.orders.index') }}" method="GET">
        <input type="text" name="q" value="{{ request('q') }}" class="adm-input adm-input-sm" style="width: 220px;" placeholder="Order / phone / TrxID খুঁজুন...">
        <select name="status" class="adm-select adm-input-sm" style="width: 140px;">
            <option value="">All Status</option>
            @foreach(['pending', 'processing', 'completed', 'rejected', 'refunded'] as $st)
                <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
            @endforeach
        </select>
        <select name="type" class="adm-select adm-input-sm" style="width: 130px;">
            <option value="">All Types</option>
            @foreach(['buy', 'sell', 'topup'] as $tp)
                <option value="{{ $tp }}" {{ request('type') === $tp ? 'selected' : '' }}>{{ ucfirst($tp) }}</option>
            @endforeach
        </select>
        <button type="submit" class="adm-btn adm-btn-primary adm-btn-xs">Filter</button>
        <a href="{{ route('admin.orders.index') }}" class="adm-btn adm-btn-secondary adm-btn-xs">Reset</a>
    </form>
    <span class="adm-pill adm-pill-amber" style="margin-left: auto;">Pending: {{ $pendingCount }}</span>
</div>

<div class="adm-card">
    <div class="adm-table-wrap">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Type</th>
                    <th>Item</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" style="font-weight: 800; color: var(--primary); text-decoration: none;">{{ $order->order_code }}</a>
                        </td>
                        <td><span class="adm-pill {{ $order->order_type === 'sell' ? 'adm-pill-amber' : 'adm-pill-green' }}">{{ strtoupper($order->order_type) }}</span></td>
                        <td>
                            <div style="font-weight: 700;">{{ Str::limit($order->product_title, 34) }}</div>
                            <div style="font-size: 0.7rem; color: var(--text-dim);">{{ $order->package_title }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $order->customer_phone }}</div>
                            @if($order->user)
                                <div style="font-size: 0.68rem; color: var(--text-dim);">👤 {{ $order->user->name }}</div>
                            @endif
                        </td>
                        <td style="font-weight: 800; color: var(--primary); white-space: nowrap;">৳ {{ number_format($order->amount_bdt) }}</td>
                        <td>
                            <span class="adm-pill {{ $order->status === 'completed' ? 'adm-pill-green' : ($order->status === 'pending' ? 'adm-pill-amber' : ($order->status === 'processing' ? 'adm-pill-blue' : 'adm-pill-red')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td style="white-space: nowrap; font-size: 0.76rem; color: var(--text-muted);">{{ $order->created_at->format('d M, h:i A') }}</td>
                        <td style="text-align: right;">
                            <div class="adm-actions-row" style="justify-content: flex-end;">
                                @if($order->status !== 'completed')
                                    <form action="{{ route('admin.order.status', $order->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="adm-btn adm-btn-primary adm-btn-xs">✓ Complete</button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="adm-btn adm-btn-secondary adm-btn-xs">View</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" style="padding: 2rem; text-align: center; color: var(--text-dim);">কোনো অর্ডার পাওয়া যায়নি।</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
</div>
@endsection
