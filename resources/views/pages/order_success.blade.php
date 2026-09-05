@extends('layouts.app')

@section('title', 'Order Confirmed - ' . $order->order_code . ' | RosTop')

@section('content')
<div class="container" style="padding-top: 2.5rem; padding-bottom: 4.5rem;">

    <div style="max-width: 660px; margin: 0 auto;">

        <div class="calc-card" style="text-align: center; padding: 2.25rem 1.75rem;">

            <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); border: 2px solid var(--primary); color: var(--primary); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; box-shadow: 0 0 20px var(--primary-glow);">
                <i data-lucide="check" style="width: 32px; height: 32px; stroke-width: 3;"></i>
            </div>

            <h1 style="font-size: 1.65rem; font-weight: 900; margin-bottom: 0.4rem; font-family: var(--font-heading);">
                {{ $order->order_type === 'sell' ? 'Voucher Submission Received!' : 'Order Placed Successfully!' }}
            </h1>

            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">
                {{ $order->order_type === 'sell'
                    ? 'Your gift card code has been accepted for verification. Once checked, the money will be transferred to your wallet.'
                    : 'Your payment verification is in progress. Delivery is typically completed within 1-5 minutes.' }}
            </p>

            <!-- Order Code Banner -->
            <div style="background: rgba(11, 15, 25, 0.85); border: 1px dashed var(--primary); border-radius: var(--radius-md); padding: 1rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.65rem;">
                <div style="text-align: left;">
                    <div style="font-size: 0.7rem; color: var(--text-dim); text-transform: uppercase;">Order Tracking Code</div>
                    <div style="font-size: 1.3rem; font-weight: 900; color: var(--primary); letter-spacing: 0.04em; font-family: var(--font-heading);">
                        {{ $order->order_code }}
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-sm" onclick="copyToClipboard('{{ $order->order_code }}', 'Order Code')">
                    <i data-lucide="copy" class="icon" style="width:14px;height:14px;"></i> Copy Code
                </button>
            </div>

            <!-- Receipt Breakdown -->
            <div style="background: var(--bg-card); border-radius: var(--radius-md); padding: 1.1rem; text-align: left; font-size: 0.825rem; margin-bottom: 1.5rem; border: 1px solid var(--border-color);">

                <div style="display: flex; justify-content: space-between; padding-bottom: 0.5rem; border-bottom: 1px solid var(--border-color);">
                    <span style="color: var(--text-muted);">Service / Item:</span>
                    <strong>{{ $order->product_title }}</strong>
                </div>

                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                    <span style="color: var(--text-muted);">Package / Rate:</span>
                    <span>{{ $order->package_title }}</span>
                </div>

                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                    <span style="color: var(--text-muted);">Status:</span>
                    <span class="payout-rate-badge" style="background: rgba(31, 163, 126, 0.15); color: var(--accent-amber);">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                @if($order->player_id_input)
                    <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        <span style="color: var(--text-muted);">Player ID (UID):</span>
                        <strong>{{ $order->player_id_input }}</strong>
                    </div>
                @endif

                @if($order->payout_account)
                    <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border-color);">
                        <span style="color: var(--text-muted);">Payout Destination:</span>
                        <strong style="color: var(--accent-emerald);">{{ strtoupper($order->payout_method) }}: {{ $order->payout_account }}</strong>
                    </div>
                @endif

                <div style="display: flex; justify-content: space-between; padding-top: 0.6rem; font-size: 0.95rem;">
                    <span style="color: var(--text-main); font-weight: 700;">
                        {{ $order->order_type === 'sell' ? 'Expected Payout:' : 'Paid Amount:' }}
                    </span>
                    <strong style="color: var(--primary); font-size: 1.15rem; font-family: var(--font-heading);">
                        ৳ {{ number_format($order->amount_bdt) }}
                    </strong>
                </div>

            </div>

            <!-- Action Buttons -->
            <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                <a href="{{ route('track.order', ['query' => $order->order_code]) }}" class="btn btn-primary btn-lg">
                    <i data-lucide="map-pin" class="icon"></i> Live Track Order Status
                </a>
                <a href="https://wa.me/8801700000000?text=Hello%20RosTop%20Support%2C%20my%20Order%20Code%20is%20{{ $order->order_code }}" target="_blank" class="btn btn-secondary">
                    <i data-lucide="message-circle" class="icon"></i> Contact Support on WhatsApp
                </a>
                <a href="{{ route('home') }}" class="btn btn-ghost" style="font-size: 0.8rem;">
                    <i data-lucide="arrow-left" class="icon" style="width:14px;height:14px;"></i> Back to Homepage
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
