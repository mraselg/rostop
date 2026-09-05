@extends('layouts.app')

@section('title', 'Secure Checkout & Payment | RosTop')

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 4rem;">

    <div style="max-width: 850px; margin: 0 auto;">

        <div style="margin-bottom: 1.75rem;">
            <div class="hero-badge">
                <i data-lucide="lock" class="icon" style="width:14px;height:14px;"></i>
                <span>256-Bit SSL Encrypted Secure Checkout</span>
            </div>
            <h1 style="font-size: 1.85rem; font-weight: 900; letter-spacing: -0.02em; margin-bottom: 0.3rem; font-family: var(--font-heading);">
                Payment & Order Confirmation
            </h1>
            <p style="color: var(--text-muted); font-size: 0.875rem;">
                Complete your payment and enter the sender number & transaction ID (TrxID) below.
            </p>
        </div>

        <form action="{{ route('checkout.placeOrder') }}" method="POST">
            @csrf
            <input type="hidden" name="package_id" value="{{ $package->id }}">
            <input type="hidden" name="player_id_input" value="{{ $playerId ?? '' }}">
            <input type="hidden" name="server_input" value="{{ $zoneId ?? '' }}">

            <div style="display: grid; grid-template-columns: 1fr; gap: 1.75rem;">

                <!-- Order Summary Card -->
                <div class="glass-card" style="padding: 1.25rem;">
                    <h2 style="font-size: 1.05rem; font-weight: 800; margin-bottom: 0.85rem; display: flex; align-items: center; justify-content: space-between; font-family: var(--font-heading);">
                        <span style="display: flex; align-items: center; gap: 0.4rem;">
                            <i data-lucide="package" class="icon"></i> Selected Product
                        </span>
                        <span class="payout-rate-badge">Instant Processing</span>
                    </h2>

                    <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 0.85rem; border-bottom: 1px solid var(--border-color);">
                        <div>
                            <div style="font-size: 1.05rem; font-weight: 800; color: var(--text-main);">
                                {{ $package->product->title }}
                            </div>
                            <div style="font-size: 0.8rem; color: var(--primary); font-weight: 700; margin-top: 2px;">
                                Package: {{ $package->name }}
                            </div>
                            @if($playerId)
                                <div style="font-size: 0.725rem; color: var(--text-dim); margin-top: 3px;">
                                    Player ID (UID): <strong>{{ $playerId }}</strong>
                                </div>
                            @endif
                        </div>
                        <div style="text-align: right;">
                            <div style="font-size: 1.4rem; font-weight: 900; color: var(--primary); font-family: var(--font-heading);">
                                ৳ {{ number_format($package->price_bdt) }}
                            </div>
                            <span style="font-size: 0.7rem; color: var(--text-dim);">Inclusive of all fees</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Method & Instructions -->
                <div class="calc-card" style="border-color: rgba(16, 185, 129, 0.3);">
                    <h2 style="font-size: 1.15rem; font-weight: 800; margin-bottom: 1rem; font-family: var(--font-heading); display: flex; align-items: center; gap: 0.4rem;">
                        <span style="width: 24px; height: 24px; border-radius: 50%; background: var(--primary); color: var(--text-inverse); display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem;">1</span>
                        Select Payment Method
                    </h2>

                    @php
                        $selectedMethod = in_array($paymentMethod ?? '', ['bkash', 'nagad', 'rocket', 'upay', 'usdt']) ? $paymentMethod : 'bkash';
                    @endphp
                    <!-- Payment Method Radio Buttons -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.6rem; margin-bottom: 1.25rem;">
                        <label class="package-item {{ $selectedMethod === 'bkash' ? 'selected' : '' }}" id="method-opt-bkash" style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.75rem;">
                            <input type="radio" name="payment_method" value="bkash" {{ $selectedMethod === 'bkash' ? 'checked' : '' }} style="accent-color: var(--bkash-color);" onchange="switchPaymentMethod('bkash')">
                            <strong style="color: var(--bkash-color); font-size: 0.9rem;">bKash Send Money</strong>
                        </label>

                        <label class="package-item {{ $selectedMethod === 'nagad' ? 'selected' : '' }}" id="method-opt-nagad" style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.75rem;">
                            <input type="radio" name="payment_method" value="nagad" {{ $selectedMethod === 'nagad' ? 'checked' : '' }} style="accent-color: var(--nagad-color);" onchange="switchPaymentMethod('nagad')">
                            <strong style="color: var(--nagad-color); font-size: 0.9rem;">Nagad Send Money</strong>
                        </label>

                        <label class="package-item {{ $selectedMethod === 'rocket' ? 'selected' : '' }}" id="method-opt-rocket" style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.75rem;">
                            <input type="radio" name="payment_method" value="rocket" {{ $selectedMethod === 'rocket' ? 'checked' : '' }} style="accent-color: var(--rocket-color);" onchange="switchPaymentMethod('rocket')">
                            <strong style="color: var(--rocket-color); font-size: 0.9rem;">Rocket</strong>
                        </label>

                        <label class="package-item {{ $selectedMethod === 'upay' ? 'selected' : '' }}" id="method-opt-upay" style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.75rem;">
                            <input type="radio" name="payment_method" value="upay" {{ $selectedMethod === 'upay' ? 'checked' : '' }} style="accent-color: #00A3E0;" onchange="switchPaymentMethod('upay')">
                            <strong style="color: #00A3E0; font-size: 0.9rem;">Upay</strong>
                        </label>

                        <label class="package-item {{ $selectedMethod === 'usdt' ? 'selected' : '' }}" id="method-opt-usdt" style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.75rem; grid-column: span 2;">
                            <input type="radio" name="payment_method" value="usdt" {{ $selectedMethod === 'usdt' ? 'checked' : '' }} style="accent-color: var(--usdt-color);" onchange="switchPaymentMethod('usdt')">
                            <strong style="color: var(--usdt-color); font-size: 0.9rem;">USDT Crypto (Binance/TRC20)</strong>
                        </label>
                    </div>

                    <!-- Dynamic Payment Instructions -->
                    <div id="payment-instructions-box" style="background: rgba(11, 15, 25, 0.7); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 1rem; margin-bottom: 1.25rem;">

                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.65rem; flex-wrap: wrap; gap: 0.4rem;">
                            <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">
                                Send Money to this Personal Number:
                            </span>
                            <div style="display: flex; align-items: center; gap: 0.4rem;">
                                <strong id="pay-number-display" style="font-size: 1.15rem; color: var(--accent-emerald); letter-spacing: 0.04em; font-family: var(--font-heading);">
                                    01799-887766
                                </strong>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="copyToClipboard('01799887766', 'Payment Number')">
                                    <i data-lucide="copy" class="icon" style="width:14px;height:14px;"></i> Copy
                                </button>
                            </div>
                        </div>

                        <ol style="margin-left: 1.15rem; font-size: 0.8rem; color: var(--text-muted); line-height: 1.7;">
                            <li>Open your bKash app and select <strong>Send Money</strong>.</li>
                            <li>Paste the number above as the recipient and send exactly <strong>৳ {{ number_format($package->price_bdt) }}</strong>.</li>
                            <li>From the confirmation SMS, copy the <strong>TrxID (Transaction ID)</strong> and enter it below.</li>
                        </ol>

                    </div>

                    <!-- Transaction Input Fields -->
                    <h3 style="font-size: 1.05rem; font-weight: 800; margin-bottom: 0.85rem; font-family: var(--font-heading); display: flex; align-items: center; gap: 0.4rem;">
                        <span style="width: 24px; height: 24px; border-radius: 50%; background: var(--primary); color: var(--text-inverse); display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem;">2</span>
                        Enter Payment Details
                    </h3>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem; margin-bottom: 0.85rem;">
                        <div class="calc-form-group">
                            <label class="calc-label">Your bKash / Sender Number *</label>
                            <input type="text" name="sender_number" class="calc-input" placeholder="e.g. 017XXXXXXXX" required>
                        </div>
                        <div class="calc-form-group">
                            <label class="calc-label">Transaction ID (TrxID) *</label>
                            <input type="text" name="transaction_id" class="calc-input" placeholder="e.g. 9B8K928X" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem;">
                        <div class="calc-form-group">
                            <label class="calc-label">Your WhatsApp / Contact Number *</label>
                            <input type="text" name="customer_phone" class="calc-input" placeholder="e.g. 018XXXXXXXX" required>
                        </div>
                        <div class="calc-form-group">
                            <label class="calc-label">Your Email (for receipt)</label>
                            <input type="email" name="customer_email" class="calc-input" placeholder="e.g. user@gmail.com">
                        </div>
                    </div>

                    <div class="calc-form-group">
                        <label class="calc-label">Order Notes (Optional)</label>
                        <input type="text" name="customer_notes" class="calc-input" placeholder="Any special instructions...">
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 0.85rem;">
                        <i data-lucide="check-circle" class="icon"></i>
                        Confirm Payment & Submit Order (৳ {{ number_format($package->price_bdt) }})
                    </button>

                </div>

            </div>
        </form>

    </div>

</div>

@push('scripts')
<script>
function switchPaymentMethod(method) {
    document.querySelectorAll('.package-item').forEach(el => el.classList.remove('selected'));
    const selectedLabel = document.getElementById(`method-opt-${method}`);
    if (selectedLabel) selectedLabel.classList.add('selected');

    const numDisplay = document.getElementById('pay-number-display');
    if (method === 'bkash') {
        numDisplay.textContent = '01799-887766 (bKash Personal)';
    } else if (method === 'nagad') {
        numDisplay.textContent = '01833-221100 (Nagad Personal)';
    } else if (method === 'rocket') {
        numDisplay.textContent = '01922-334455-9 (Rocket Personal)';
    } else if (method === 'usdt') {
        numDisplay.textContent = 'TLz892K9481Xzq92... (USDT TRC20)';
    }
}
</script>
@endpush
@endsection
