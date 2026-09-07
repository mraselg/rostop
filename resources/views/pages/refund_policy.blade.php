@extends('layouts.app')

@section('title', 'Refund & Cancellation Policy | RosTop Buyer Protection')
@section('meta_description', 'Read the RosTop (rostop.com) Refund & Cancellation Policy. Clear guidelines for top-up failures, duplicate payments, gift card warranties, and bKash/Nagad reversal timelines.')

@section('content')
<div class="policy-page-container">
    <div class="container" style="max-width: 860px;">

        @include('partials.policy-nav', [
            'title' => 'Refund & Cancellation Policy',
            'subtitle' => 'Our commitment is transparent, fair, and fast. Learn when transactions are eligible for an immediate full refund, how our warranty protects you, and how reversals are processed to your bKash or Nagad wallet.'
        ])

        <!-- Quick Summary Box -->
        <div class="policy-quick-box">
            <div class="policy-quick-title">
                <i data-lucide="rotate-ccw" class="icon"></i>
                <span>Refund Policy at a Glance (Key Summary)</span>
            </div>
            <div class="policy-quick-grid">
                <div class="policy-quick-item">
                    <i data-lucide="check-circle" class="icon"></i>
                    <div><strong>Server Failure = 100% Refund:</strong> If diamonds or UC fail to credit due to system or server error, you receive a full refund.</div>
                </div>
                <div class="policy-quick-item">
                    <i data-lucide="alert-triangle" class="icon"></i>
                    <div><strong>UID Accuracy Responsibility:</strong> Credits sent to an incorrect UID entered by the customer cannot be cancelled or refunded.</div>
                </div>
                <div class="policy-quick-item">
                    <i data-lucide="clock" class="icon"></i>
                    <div><strong>Fast Reversals:</strong> Approved refunds are sent directly back to your original bKash, Nagad, or Rocket account in 10–30 minutes.</div>
                </div>
                <div class="policy-quick-item">
                    <i data-lucide="shield-check" class="icon"></i>
                    <div><strong>Warranty Guarantee:</strong> Subscriptions and software licenses carry full duration replacement warranty if issues arise.</div>
                </div>
            </div>
        </div>

        <!-- Clause 1: Digital Goods Nature -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">1</span>
                <h2 class="policy-clause-title">Nature of Digital Goods &amp; Direct Top-Ups</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    RosTop (rostop.com) specializes in intangible digital goods, direct in-game UID currency delivery, and prepaid digital vouchers. Due to the instantaneous nature of digital top-up fulfillment and digital code delivery:
                </p>
                <ul>
                    <li>Once digital currency has been successfully credited by game publishers (e.g. Garena, Tencent) to the in-game account specified by the customer, the transaction is definitive and cannot be recalled.</li>
                    <li>Unlike physical merchandise that can be returned to a warehouse, activated digital codes cannot be un-revealed.</li>
                </ul>
                <p>
                    Consequently, our refund policy is designed to protect honest buyers against technical failures, out-of-stock discrepancies, or duplicate charges while safeguarding against digital abuse.
                </p>
            </div>
        </div>

        <!-- Clause 2: Eligible for Refund -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">2</span>
                <h2 class="policy-clause-title">Scenarios Eligible for Full Refund</h2>
            </div>
            <div class="policy-clause-body">
                <p>You are entitled to an immediate <strong>100% full refund</strong> or order replacement in the following verified circumstances:</p>
                <ul>
                    <li><strong>Top-Up Delivery Failure:</strong> The order could not be fulfilled due to technical server error, game publisher API outage, or game maintenance, and diamonds/UC were not received.</li>
                    <li><strong>Out of Stock / Unfulfilled Orders:</strong> If an item or package is unexpectedly out of stock and we cannot deliver within our standard service window, you can request an instant full refund.</li>
                    <li><strong>Duplicate Charges:</strong> If you accidentally submitted payment multiple times for the same order or your payment method was billed twice for a single order code.</li>
                    <li><strong>Defective Digital Code:</strong> In the rare event that a purchased gift card or software license key is verified to be defective, expired, or invalid <em>at the exact moment of issuance</em>.</li>
                    <li><strong>Overpayment:</strong> If you accidentally sent an amount exceeding your package total, the excess balance will be refunded immediately to your sender number.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 3: Ineligible for Refund -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">3</span>
                <h2 class="policy-clause-title">Scenarios Ineligible for Refund (Non-Refundable)</h2>
            </div>
            <div class="policy-clause-body">
                <p>Refunds cannot be issued under the following circumstances:</p>
                <ul>
                    <li><strong>Incorrect Player ID (UID) Provided:</strong>
                        If you enter an incorrect Player ID, Server ID, or Zone ID, and the in-game currency is successfully delivered to that incorrect account, <strong>RosTop cannot reverse the delivery or issue a refund</strong>. Game servers do not permit the retrieval of delivered game items. Please verify your UID carefully before placing your order.
                    </li>
                    <li><strong>Redeemed or Revealed Codes:</strong> Once a genuine, working gift card PIN code or software activation key has been displayed to you, it cannot be refunded.</li>
                    <li><strong>Change of Mind / Buyer's Remorse:</strong> We cannot process refunds simply because you changed your mind after delivery has already taken place.</li>
                    <li><strong>Region Incompatibility:</strong> Purchasing a region-locked voucher for the wrong country (e.g. buying a US Google Play card for a BD account) where the code was delivered correctly.</li>
                    <li><strong>In-Game Penalties:</strong> Penalties or bans imposed on your personal game profile due to third-party game modifications, hacks, or abusive in-game behavior.</li>
                </ul>

                <div class="policy-callout policy-callout-warning">
                    <i data-lucide="alert-circle" class="icon"></i>
                    <div>
                        <strong>Always Double-Check Your Player ID:</strong> Use our top-up product page's UID verification tools to confirm your in-game nickname prior to submitting checkout.
                    </div>
                </div>
            </div>
        </div>

        <!-- Clause 4: Gift Card Selling Payouts -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">4</span>
                <h2 class="policy-clause-title">Gift Card Selling (Cashout) Rejection Policy</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    When submitting prepaid vouchers or gift cards to RosTop for cashout (e.g. Paysafecard, Transcash, Neosurf, Apple):
                </p>
                <ul>
                    <li><strong>Rejected Submissions:</strong> If a voucher submitted is found to have zero balance, was already redeemed earlier, is blocked by the card issuer, or does not match the stated currency/face value, <strong>no payout will be disbursed</strong>.</li>
                    <li><strong>Detailed Rejection Report:</strong> Our compliance team provides an explanation and verification timestamp if a code is rejected.</li>
                    <li><strong>Dispute Review:</strong> If you believe a card was mistakenly rejected, you may submit official purchase receipts from the original vendor within 24 hours for a secondary manual review.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 5: Subscription Warranties -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">5</span>
                <h2 class="policy-clause-title">Digital Subscriptions &amp; Software Warranty</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    All digital subscriptions (Netflix 4K UHD, ChatGPT Plus, Canva Pro, CapCut Pro) and software licenses purchased through RosTop are backed by a <strong>Full-Duration Warranty</strong>:
                </p>
                <ul>
                    <li>If account credentials stop functioning during the active warranty period, notify customer support.</li>
                    <li>We will restore or replace the account credentials within <strong>12 to 24 hours</strong>.</li>
                    <li>If a technical issue cannot be resolved within 48 hours, a pro-rated refund will be granted for the remaining unused duration.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 6: Refund Timelines & Methods -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">6</span>
                <h2 class="policy-clause-title">Refund Processing Timelines &amp; Settlement Channels</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    Refunds are transferred directly back to the original funding source used during checkout:
                </p>
                <ul>
                    <li><strong>bKash / Nagad / Rocket:</strong> Issued directly to your mobile financial wallet within <strong>10 to 30 minutes</strong> of approval.</li>
                    <li><strong>USDT (Cryptocurrency):</strong> Returned to your TRC20/BEP20 address (network gas fee may be deducted if the cancellation was initiated at the buyer's request).</li>
                    <li><strong>Zero Processing Deductions:</strong> For all verified platform failures or duplicate payments, RosTop absorbs any transaction fees — you receive 100% of your money back.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 7: How to Request a Refund -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">7</span>
                <h2 class="policy-clause-title">How to Submit a Refund Claim</h2>
            </div>
            <div class="policy-clause-body">
                <p>Submitting a refund claim is straightforward:</p>
                <ol>
                    <li>Have your <strong>Order Code</strong> (e.g. <code>CL-92418</code>) and the <strong>TrxID</strong> of your payment ready.</li>
                    <li>Go to our <a href="{{ route('support') }}" style="color: var(--primary); font-weight: 600;">Customer Support Center</a> or contact our official 24/7 WhatsApp helpdesk.</li>
                    <li>Select <strong>Payment &amp; Refund Issue</strong> and provide a screenshot of your payment confirmation SMS along with your in-game profile showing the issue.</li>
                    <li>Our support agent will verify the server log and process your refund or replacement on the spot.</li>
                </ol>
            </div>
        </div>

        <!-- Support CTA Box -->
        <div class="policy-support-card">
            <i data-lucide="rotate-ccw" class="icon mb-2" style="width: 32px; height: 32px; color: var(--primary);"></i>
            <h3 style="font-size: 1.15rem; font-weight: 800; font-family: var(--font-heading); margin-bottom: 0.35rem;">Need to Request a Refund or Check Status?</h3>
            <p style="font-size: 0.875rem; color: var(--text-muted); max-width: 500px; margin: 0 auto 1.25rem;">
                Our 24/7 customer care team is standing by to resolve any order issue or initiate instant bKash/Nagad reversals.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('support') }}" class="btn btn-primary btn-sm">
                    <i data-lucide="message-square" class="icon"></i> Open Support Ticket
                </a>
                <a href="{{ route('track.order') }}" class="btn btn-secondary btn-sm">
                    <i data-lucide="map-pin" class="icon"></i> Track Order Status
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
