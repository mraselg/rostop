@extends('layouts.app')

@section('title', 'Sell Gift Cards & Prepaid Vouchers for bKash / Nagad | RosTop')
@section('meta_description', 'Direct exchange platform in Bangladesh on rostop.com. Turn Paysafecard, Transcash, Neosurf, Apple & Google Play gift cards into instant bKash, Nagad or USDT at 84-90% fixed rates.')

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 4rem;">

    <div style="text-align: center; max-width: 720px; margin: 0 auto 2rem;">
        <div class="hero-badge" style="background: rgba(31, 163, 126, 0.1); border-color: rgba(31, 163, 126, 0.3); color: var(--accent-amber);">
            <i data-lucide="wallet" class="icon" style="width:14px;height:14px;"></i>
            Direct Exchange Counterparty &bull; No P2P Waiting
        </div>
        <h1 style="font-size: clamp(1.65rem, 4vw, 2.15rem); font-weight: 900; letter-spacing: -0.02em; margin-bottom: 0.65rem; font-family: var(--font-heading);">
            Sell Prepaid Vouchers & Gift Cards for <span style="color: var(--primary);">bKash / Nagad</span>
        </h1>
        <p style="font-size: 0.925rem; color: var(--text-muted); line-height: 1.6;">
            We buy your gift cards and cash vouchers at fixed rates. Submit your code and receive money in your wallet within 15 to 45 minutes.
        </p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr; gap: 1.75rem; max-width: 1050px; margin: 0 auto; align-items: start;">

        <form action="{{ route('giftcards.sell.submit') }}" method="POST" class="calc-card" style="border-color: rgba(31, 163, 126, 0.25);">
            @csrf

            <h2 style="font-size: 1.2rem; font-weight: 800; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.4rem; font-family: var(--font-heading);">
                <i data-lucide="file-text" class="icon"></i> Instant Voucher Submission
            </h2>

            <!-- Step 1 -->
            <div class="calc-form-group">
                <label for="sell-brand-select" class="calc-label">
                    <span>1. Select Brand / Voucher Type</span>
                    <span style="color: var(--accent-amber); font-size: 0.7rem;">50+ Supported</span>
                </label>
                <select name="brand_key" id="sell-brand-select" class="calc-select" required>
                    @foreach($rates as $rate)
                        <option value="{{ $rate->brand_key }}" {{ $selectedBrand === $rate->brand_key ? 'selected' : '' }}>
                            {{ $rate->brand_name }} ({{ round($rate->sell_rate_percent) }}% Payout Rate)
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Step 2 -->
            <div style="display: grid; grid-template-columns: 1fr 1.3fr; gap: 0.65rem;">
                <div class="calc-form-group">
                    <label for="sell-currency-select" class="calc-label">Card Currency</label>
                    <select name="currency" id="sell-currency-select" class="calc-select" required>
                        <option value="USD" {{ $prefillCurrency === 'USD' ? 'selected' : '' }}>USD ($)</option>
                        <option value="EUR" {{ $prefillCurrency === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                        <option value="GBP" {{ $prefillCurrency === 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                    </select>
                </div>
                <div class="calc-form-group">
                    <label for="sell-amount-input" class="calc-label">Face Value (Card Amount)</label>
                    <input type="number" name="face_value" id="sell-amount-input" class="calc-input" value="{{ $prefillAmount }}" min="5" max="1000" step="5" required>
                </div>
            </div>

            <!-- Payout Display -->
            <div class="calc-payout-box" style="background: rgba(31, 163, 126, 0.06); border-color: rgba(31, 163, 126, 0.3);">
                <div>
                    <div id="payout-currency-label" style="font-size: 0.7rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700;">
                        You Will Receive in BDT
                    </div>
                    <span id="sell-rate-badge" class="payout-rate-badge" style="background: rgba(31, 163, 126, 0.15); color: var(--accent-amber);">
                        Rate: {{ round($initialRatePercent) }}%
                    </span>
                </div>
                <div id="sell-payout-total" class="payout-total-amount" style="color: var(--accent-amber);">
                    ৳ {{ number_format($initialBDT) }}
                </div>
            </div>

            <!-- Step 3: Card Codes -->
            <div class="calc-form-group">
                <label for="gift_card_codes" class="calc-label">
                    <span>2. Card Code / 16-Digit PIN / E-code</span>
                    <span style="color: var(--text-dim); font-size: 0.7rem; display: flex; align-items: center; gap: 0.25rem;">
                        <i data-lucide="lock" class="icon" style="width:12px;height:12px;"></i> Encrypted
                    </span>
                </label>
                <textarea name="gift_card_codes" id="gift_card_codes" class="calc-input" rows="3" placeholder="Enter voucher PIN or gift card code here. Multiple codes on separate lines." required></textarea>
            </div>

            <!-- Step 4: Payout Method -->
            <div class="calc-form-group">
                <label class="calc-label">3. Select Payout Method</label>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.6rem;">
                    <label class="package-item selected" style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.65rem;">
                        <input type="radio" name="payout_method" value="bkash" checked style="accent-color: var(--bkash-color);">
                        <strong style="color: var(--bkash-color);">bKash</strong>
                    </label>
                    <label class="package-item" style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.65rem;">
                        <input type="radio" name="payout_method" value="nagad" style="accent-color: var(--nagad-color);">
                        <strong style="color: var(--nagad-color);">Nagad</strong>
                    </label>
                    <label class="package-item" style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.65rem;">
                        <input type="radio" name="payout_method" value="rocket" style="accent-color: var(--rocket-color);">
                        <strong style="color: var(--rocket-color);">Rocket</strong>
                    </label>
                    <label class="package-item" style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.65rem;">
                        <input type="radio" name="payout_method" value="usdt" style="accent-color: var(--usdt-color);">
                        <strong style="color: var(--usdt-color);">USDT (TRC20)</strong>
                    </label>
                </div>
            </div>

            <!-- Step 5: Contact Info -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem;">
                <div class="calc-form-group">
                    <label for="payout_account" class="calc-label">Payout Number / Wallet</label>
                    <input type="text" name="payout_account" id="payout_account" class="calc-input" placeholder="e.g. 017XXXXXXXX or USDT Address" required>
                </div>
                <div class="calc-form-group">
                    <label for="customer_phone" class="calc-label">Your WhatsApp / Phone</label>
                    <input type="text" name="customer_phone" id="customer_phone" class="calc-input" placeholder="e.g. 018XXXXXXXX" required>
                </div>
            </div>

            <div class="calc-form-group">
                <label for="customer_notes" class="calc-label">Additional Notes (Optional)</label>
                <input type="text" name="customer_notes" id="customer_notes" class="calc-input" placeholder="Any extra information for verification...">
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-sell btn-lg" style="width: 100%; margin-top: 0.85rem;">
                <i data-lucide="send" class="icon"></i> Submit Voucher & Request Payout
            </button>

            <div style="text-align: center; margin-top: 0.75rem; font-size: 0.75rem; color: var(--text-dim); display: flex; align-items: center; justify-content: center; gap: 0.3rem;">
                <i data-lucide="lock" class="icon" style="width:12px;height:12px;"></i>
                Code verification takes approx. 15-45 minutes. Money is sent directly to your account.
            </div>

        </form>

        <!-- How It Works Cards -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.85rem; margin-top: 1.5rem;">

            <div class="glass-card step-info-card">
                <div class="step-number">1</div>
                <div class="step-title">Fill Out the Form</div>
                <div class="step-desc">Select the card brand, enter the face value, and input the 16-digit PIN code.</div>
            </div>

            <div class="glass-card step-info-card">
                <div class="step-number">2</div>
                <div class="step-title">Instant Verification</div>
                <div class="step-desc">Our team checks the code balance and confirms it immediately.</div>
            </div>

            <div class="glass-card step-info-card">
                <div class="step-number">3</div>
                <div class="step-title">bKash/Nagad Cashout</div>
                <div class="step-desc">The full amount at the fixed rate is sent to your provided wallet number.</div>
            </div>

        </div>

    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const brandSelect = document.getElementById('sell-brand-select');
    const currencySelect = document.getElementById('sell-currency-select');
    const amountInput = document.getElementById('sell-amount-input');
    const rateBadge = document.getElementById('sell-rate-badge');
    const payoutTotal = document.getElementById('sell-payout-total');
    const payoutMethods = document.querySelectorAll('input[name="payout_method"]');
    const accountInput = document.getElementById('payout_account');
    const accountLabel = document.querySelector('label[for="payout_account"]');
    const currLabel = document.getElementById('payout-currency-label');

    const CURRENCY_SYMBOLS = { 'USD': '$', 'EUR': '€', 'GBP': '£' };

    function currentPayoutMethod() {
        const checked = document.querySelector('input[name="payout_method"]:checked');
        return checked ? checked.value : 'bkash';
    }

    function updateSellCalc() {
        const brand = brandSelect.value;
        const currency = currencySelect.value;
        const amount = parseFloat(amountInput.value) || 0;
        const sym = CURRENCY_SYMBOLS[currency] || '$';

        fetch('{{ route("api.rates.calculate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ brand: brand, currency: currency, amount: amount })
        })
        .then(res => res.json())
        .then(data => {
            if (data.formatted_bdt) {
                if (currentPayoutMethod() === 'usdt') {
                    payoutTotal.innerHTML = `${data.payout_usd} <span style="font-size:0.75rem; color:var(--text-dim);">USDT (TRC20)</span>`;
                } else {
                    payoutTotal.innerHTML = `${data.formatted_bdt} <span style="font-size:0.75rem; color:var(--text-dim);">(${sym}${data.payout_usd})</span>`;
                }
                rateBadge.textContent = `Rate: ${data.rate_percent}%`;
            }
        })
        .catch(err => console.error(err));
    }

    function handlePayoutMethodChange() {
        if (currentPayoutMethod() === 'usdt') {
            if (currLabel) currLabel.textContent = 'You Will Receive in USDT (TRC20)';
            if (accountLabel) accountLabel.textContent = 'TRC20 Wallet Address';
            if (accountInput) {
                accountInput.placeholder = 'e.g. T9yD14Nj9j7xAB4dbGeiX9h8unkKHxuWwb (starts with T)';
                accountInput.pattern = '^T[a-zA-Z0-9]{33}$';
            }
        } else {
            if (currLabel) currLabel.textContent = 'You Will Receive in BDT';
            if (accountLabel) accountLabel.textContent = 'Payout Number / Wallet';
            if (accountInput) {
                accountInput.placeholder = 'e.g. 017XXXXXXXX';
                accountInput.removeAttribute('pattern');
            }
        }
    }

    brandSelect.addEventListener('change', updateSellCalc);
    currencySelect.addEventListener('change', updateSellCalc);
    amountInput.addEventListener('input', updateSellCalc);
    payoutMethods.forEach(radio => radio.addEventListener('change', () => {
        handlePayoutMethodChange();
        updateSellCalc();
    }));

    handlePayoutMethodChange();
    updateSellCalc();
});
</script>
@endpush
@endsection
