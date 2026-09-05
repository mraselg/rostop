@extends('layouts.app')

@section('title', 'Live Order & Payout Tracking | RosTop')
@section('meta_description', 'Track your in-game top-up, gift card purchase, or gift card sell payout status in real-time on rostop.com with your Order ID or phone number.')

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 4rem;">

    <div style="max-width: 730px; margin: 0 auto;">

        <div style="text-align: center; margin-bottom: 1.75rem;">
            <div class="hero-badge">
                <i data-lucide="map-pin" class="icon" style="width:14px;height:14px;"></i>
                <span>Real-Time Tracking Engine</span>
            </div>
            <h1 style="font-size: clamp(1.65rem, 4vw, 2rem); font-weight: 900; letter-spacing: -0.02em; margin-bottom: 0.4rem; font-family: var(--font-heading);">
                Track Your Order & Cashout
            </h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                Enter your order code (e.g. CL-92418), mobile number, or Transaction ID (TrxID) to check the latest status.
            </p>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('track.order') }}" method="GET" class="calc-card" style="padding: 1rem; margin-bottom: 2rem;">
            <div style="display: flex; gap: 0.65rem; flex-wrap: wrap;">
                <input type="text" name="query" class="calc-input" placeholder="Enter Order Code (e.g. CL-92418) or Phone Number..." value="{{ $query ?? '' }}" required style="flex: 1; min-width: 220px;">
                <button type="submit" class="btn btn-primary" style="padding: 0.7rem 1.5rem;">
                    <i data-lucide="search" class="icon"></i> Track Now
                </button>
            </div>
        </form>

        @if($searched)
            @if($order)

                <div class="glass-card" style="padding: 1.75rem; border-color: rgba(16, 185, 129, 0.3);">

                    <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 0.85rem; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.65rem;">
                        <div>
                            <span style="font-size: 0.7rem; color: var(--text-dim); text-transform: uppercase;">Order Reference</span>
                            <div style="font-size: 1.35rem; font-weight: 900; color: var(--primary); font-family: var(--font-heading);">
                                {{ $order->order_code }}
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-size: 0.7rem; color: var(--text-dim);">Created At</span>
                            <div style="font-size: 0.8rem; font-weight: 700; color: var(--text-muted);">
                                {{ $order->created_at->format('d M Y, h:i A') }}
                            </div>
                        </div>
                    </div>

                    <!-- Progress Stepper -->
                    @php
                        $isCompleted = ($order->status === 'completed');
                        $isProcessing = in_array($order->status, ['processing', 'completed']);
                        $isRejected = ($order->status === 'rejected');
                    @endphp

                    <div class="tracker-stepper">
                        <div class="tracker-step completed">
                            <div class="step-bubble"><i data-lucide="check" class="icon" style="width:16px;height:16px;stroke-width:3;"></i></div>
                            <span class="step-label">Submitted</span>
                        </div>

                        <div class="tracker-step {{ $isProcessing || $isCompleted ? 'completed' : 'active' }}">
                            <div class="step-bubble">
                                @if($isProcessing || $isCompleted)
                                    <i data-lucide="check" class="icon" style="width:16px;height:16px;stroke-width:3;"></i>
                                @else
                                    2
                                @endif
                            </div>
                            <span class="step-label">Verification</span>
                        </div>

                        <div class="tracker-step {{ $isCompleted ? 'completed' : ($isProcessing ? 'active' : '') }}">
                            <div class="step-bubble">
                                @if($isCompleted)
                                    <i data-lucide="check" class="icon" style="width:16px;height:16px;stroke-width:3;"></i>
                                @else
                                    3
                                @endif
                            </div>
                            <span class="step-label">{{ $order->order_type === 'sell' ? 'Payout Sent' : 'Processing' }}</span>
                        </div>

                        <div class="tracker-step {{ $isCompleted ? 'completed' : '' }}">
                            <div class="step-bubble">
                                @if($isCompleted)
                                    <i data-lucide="star" class="icon" style="width:16px;height:16px;"></i>
                                @else
                                    4
                                @endif
                            </div>
                            <span class="step-label">{{ $isCompleted ? 'Delivered' : 'Completed' }}</span>
                        </div>
                    </div>

                    @if($isRejected)
                        <div class="flash-message flash-error" style="margin: 1.25rem 0;">
                            <i data-lucide="x-circle" class="icon"></i>
                            <div><strong>Order Rejected / On Hold:</strong> {{ $order->admin_notes ?? 'Invalid TrxID or code already redeemed. Please contact WhatsApp support for assistance.' }}</div>
                        </div>
                    @endif

                    <!-- Delivered Codes -->
                    @if($order->delivered_codes)
                        <div style="background: rgba(16, 185, 129, 0.08); border: 1px dashed var(--primary); border-radius: var(--radius-md); padding: 1.1rem; margin: 1.25rem 0;">
                            <div style="font-size: 0.75rem; font-weight: 800; color: var(--accent-emerald); text-transform: uppercase; margin-bottom: 0.4rem; display: flex; justify-content: space-between; align-items: center;">
                                <span style="display: flex; align-items: center; gap: 0.3rem;">
                                    <i data-lucide="key-round" class="icon" style="width:14px;height:14px;"></i> Your Delivered Digital Code
                                </span>
                                <span>Instant Ready</span>
                            </div>
                            <div style="background: #0B0F19; border-radius: var(--radius-sm); padding: 0.75rem 0.85rem; font-family: monospace; font-size: 1rem; color: var(--accent-emerald); word-break: break-all; display: flex; align-items: center; justify-content: space-between;">
                                <span>{{ $order->delivered_codes }}</span>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="copyToClipboard('{{ $order->delivered_codes }}', 'Delivered Code')">
                                    <i data-lucide="copy" class="icon" style="width:14px;height:14px;"></i> Copy
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Order Details -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; font-size: 0.825rem; margin-top: 1.25rem; background: var(--bg-card); padding: 1.1rem; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
                        <div>
                            <span style="color: var(--text-dim); font-size: 0.725rem;">Item:</span>
                            <div style="font-weight: 700;">{{ $order->product_title }}</div>
                        </div>
                        <div>
                            <span style="color: var(--text-dim); font-size: 0.725rem;">Package / Amount:</span>
                            <div style="font-weight: 700; color: var(--primary);">{{ $order->package_title }} (৳ {{ number_format($order->amount_bdt) }})</div>
                        </div>
                        <div>
                            <span style="color: var(--text-dim); font-size: 0.725rem;">Customer Phone:</span>
                            <div style="font-weight: 700;">{{ $order->customer_phone }}</div>
                        </div>
                        <div>
                            <span style="color: var(--text-dim); font-size: 0.725rem;">Status:</span>
                            <div>
                                <span class="payout-rate-badge" style="background: {{ $order->status === 'completed' ? 'rgba(16, 185, 129, 0.15)' : 'rgba(31, 163, 126, 0.15)' }}; color: {{ $order->status === 'completed' ? 'var(--accent-emerald)' : 'var(--accent-amber)' }};">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        @if($order->player_id_input)
                            <div>
                                <span style="color: var(--text-dim); font-size: 0.725rem;">Player ID (UID):</span>
                                <div style="font-weight: 700;">{{ $order->player_id_input }}</div>
                            </div>
                        @endif
                        @if($order->payout_account)
                            <div>
                                <span style="color: var(--text-dim); font-size: 0.725rem;">Payout Account:</span>
                                <div style="font-weight: 700; color: var(--accent-emerald);">{{ strtoupper($order->payout_method) }}: {{ $order->payout_account }}</div>
                            </div>
                        @endif
                    </div>

                    <div style="margin-top: 1.25rem; text-align: center;">
                        <a href="https://wa.me/8801700000000?text=Hi%2C%20I%20need%20an%20update%20for%20order%20{{ $order->order_code }}" target="_blank" class="btn btn-secondary btn-sm">
                            <i data-lucide="message-circle" class="icon"></i> Need Help? Contact WhatsApp
                        </a>
                    </div>

                </div>

            @else
                <div class="glass-card" style="padding: 2.5rem 1.75rem; text-align: center; color: var(--text-dim);">
                    <div style="margin-bottom: 0.65rem;">
                        <i data-lucide="search-x" style="width: 48px; height: 48px; color: var(--text-dim); opacity: 0.5;"></i>
                    </div>
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.4rem; font-family: var(--font-heading);">
                        No Order Found for "{{ $query }}"
                    </h3>
                    <p style="font-size: 0.825rem; max-width: 420px; margin: 0 auto 1.25rem;">
                        Please check your correct order ID (e.g. CL-92418) or the mobile number used during checkout, and try again.
                    </p>
                    <a href="https://wa.me/8801700000000" target="_blank" class="btn btn-secondary">
                        <i data-lucide="message-circle" class="icon"></i> Contact WhatsApp Support
                    </a>
                </div>
            @endif
        @endif

    </div>

</div>
@endsection
