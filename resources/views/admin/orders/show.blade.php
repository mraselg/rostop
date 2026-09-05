@extends('layouts.admin')

@section('title', 'Order ' . $order->order_code . ' | RosTop Admin')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Order {{ $order->order_code }}</h1>
        <p class="adm-page-sub">তৈরি: {{ $order->created_at->format('d M Y, h:i A') }}
            @if($order->completed_at) &bull; সম্পন্ন: {{ $order->completed_at->format('d M Y, h:i A') }} @endif
        </p>
    </div>
    <div class="adm-actions-row">
        <a href="{{ route('admin.orders.index') }}" class="adm-btn adm-btn-secondary adm-btn-xs">← All Orders</a>
        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="m-0" data-confirm="অর্ডার {{ $order->order_code }} স্থায়ীভাবে ডিলিট হবে। নিশ্চিত?">
            @csrf
            <button type="submit" class="adm-btn adm-btn-danger adm-btn-xs">
                <i data-lucide="trash-2" class="icon"></i> Delete
            </button>
        </form>
    </div>
</div>

<div class="row g-3">
    <!-- Left: Order Info -->
    <div class="col-12 col-lg-7">
        <div class="adm-card">
            <h2 class="adm-card-title">Order Details</h2>
            <div class="adm-table-wrap">
                <table class="adm-table">
                    <tbody>
                        <tr>
                            <td style="color: var(--text-dim); width: 170px;">Status</td>
                            <td>
                                <span class="adm-pill {{ $order->status === 'completed' ? 'adm-pill-green' : ($order->status === 'pending' ? 'adm-pill-amber' : ($order->status === 'processing' ? 'adm-pill-blue' : 'adm-pill-red')) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr><td style="color: var(--text-dim);">Type</td><td><span class="adm-pill {{ $order->order_type === 'sell' ? 'adm-pill-amber' : 'adm-pill-green' }}">{{ strtoupper($order->order_type) }}</span></td></tr>
                        <tr><td style="color: var(--text-dim);">Product</td><td style="font-weight: 700;">{{ $order->product_title }}</td></tr>
                        <tr><td style="color: var(--text-dim);">Package</td><td>{{ $order->package_title ?? '—' }}</td></tr>
                        <tr><td style="color: var(--text-dim);">Amount</td><td style="font-weight: 800; color: var(--primary);">৳ {{ number_format($order->amount_bdt, 2) }} @if($order->amount_usd) <span style="color: var(--text-dim); font-weight: 600;">(${{ $order->amount_usd }})</span> @endif</td></tr>
                        <tr><td style="color: var(--text-dim);">Customer Name</td><td>{{ $order->customer_name ?? '—' }}</td></tr>
                        <tr><td style="color: var(--text-dim);">Phone</td><td style="font-weight: 700;">{{ $order->customer_phone }}</td></tr>
                        @if($order->customer_email)
                            <tr><td style="color: var(--text-dim);">E-mail</td><td>{{ $order->customer_email }}</td></tr>
                        @endif
                        @if($order->user)
                            <tr><td style="color: var(--text-dim);">Account</td><td>👤 {{ $order->user->name }} (ID: {{ $order->user->id }})</td></tr>
                        @endif
                        @if($order->player_id_input)
                            <tr><td style="color: var(--text-dim);">Player UID</td><td class="adm-mono">{{ $order->player_id_input }}</td></tr>
                        @endif
                        @if($order->server_input)
                            <tr><td style="color: var(--text-dim);">Server / Zone</td><td class="adm-mono">{{ $order->server_input }}</td></tr>
                        @endif
                        @if($order->customer_notes)
                            <tr><td style="color: var(--text-dim);">Customer Notes</td><td>{{ $order->customer_notes }}</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        @if($order->gift_card_codes)
            <div class="adm-card">
                <h2 class="adm-card-title">Submitted Voucher / Gift Card Codes</h2>
                <div class="adm-mono" style="background: var(--bg-surface); border: 1px dashed var(--border-color); border-radius: 10px; padding: 0.85rem; white-space: pre-wrap;">{{ $order->gift_card_codes }}</div>
                @if($order->gift_card_receipt)
                    <div style="margin-top: 0.6rem; font-size: 0.8rem; color: var(--text-muted);">Receipt: {{ $order->gift_card_receipt }}</div>
                @endif
            </div>
        @endif
    </div>

    <!-- Right: Edit Form -->
    <div class="col-12 col-lg-5">
        <div class="adm-card">
            <h2 class="adm-card-title">Update Order</h2>
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="adm-label">Status</label>
                    <select name="status" class="adm-select">
                        @foreach(['pending', 'processing', 'completed', 'rejected', 'refunded'] as $st)
                            <option value="{{ $st }}" {{ $order->status === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Delivered Codes / Credentials (customer এ দেখানো হবে)</label>
                    <textarea name="delivered_codes" class="adm-textarea" rows="3">{{ $order->delivered_codes }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Admin Notes (internal)</label>
                    <textarea name="admin_notes" class="adm-textarea" rows="2">{{ $order->admin_notes }}</textarea>
                </div>
                <hr style="border-color: var(--border-color);">
                <div class="mb-3">
                    <label class="adm-label">Payment Method</label>
                    <input type="text" name="payment_method" class="adm-input" value="{{ $order->payment_method }}">
                </div>
                <div class="mb-3">
                    <label class="adm-label">Transaction ID</label>
                    <input type="text" name="transaction_id" class="adm-input" value="{{ $order->transaction_id }}">
                </div>
                @if($order->order_type === 'sell')
                    <div class="mb-3">
                        <label class="adm-label">Payout Method</label>
                        <input type="text" name="payout_method" class="adm-input" value="{{ $order->payout_method }}">
                    </div>
                    <div class="mb-3">
                        <label class="adm-label">Payout Account</label>
                        <input type="text" name="payout_account" class="adm-input" value="{{ $order->payout_account }}">
                    </div>
                @endif
                <button type="submit" class="adm-btn adm-btn-primary w-100">
                    <i data-lucide="save" class="icon"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
