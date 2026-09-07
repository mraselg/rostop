@extends('layouts.app')

@section('title', 'Terms of Service | RosTop Official Agreement')
@section('meta_description', 'Review the Terms of Service for RosTop (rostop.com). Understand our direct counterparty transaction model, game top-up policies, voucher exchange rules, and consumer protections in Bangladesh.')

@section('content')
<div class="policy-page-container">
    <div class="container" style="max-width: 860px;">

        @include('partials.policy-nav', [
            'title' => 'Terms of Service',
            'subtitle' => 'These Terms govern your access to and use of RosTop (rostop.com). By placing an order, buying digital assets, or selling prepaid vouchers to us, you agree to comply with these terms.'
        ])

        <!-- Quick Summary Box -->
        <div class="policy-quick-box">
            <div class="policy-quick-title">
                <i data-lucide="zap" class="icon"></i>
                <span>Terms at a Glance (Key Summary)</span>
            </div>
            <div class="policy-quick-grid">
                <div class="policy-quick-item">
                    <i data-lucide="shield-check" class="icon"></i>
                    <div><strong>Direct Counterparty:</strong> No P2P escrow or third-party waiting. You buy from and sell directly to RosTop.</div>
                </div>
                <div class="policy-quick-item">
                    <i data-lucide="gamepad-2" class="icon"></i>
                    <div><strong>UID Accuracy:</strong> Double check your in-game UID. Top-ups delivered to the specified UID are instantaneous and irreversible.</div>
                </div>
                <div class="policy-quick-item">
                    <i data-lucide="wallet" class="icon"></i>
                    <div><strong>Voucher Sellers:</strong> You warrant that vouchers sold are legally owned, active, and unused. Fraudulent codes trigger immediate account ban.</div>
                </div>
                <div class="policy-quick-item">
                    <i data-lucide="check-circle" class="icon"></i>
                    <div><strong>Verified Payouts:</strong> Cashout to bKash, Nagad, or Rocket is completed within 15–45 minutes following verification.</div>
                </div>
            </div>
        </div>

        <!-- Clause 1: Acceptance -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">1</span>
                <h2 class="policy-clause-title">Acceptance of Agreement &amp; Eligibility</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    Welcome to <strong>RosTop</strong> ("Platform", "we", "us", or "our"), available at <strong>rostop.com</strong>. By accessing our website, creating an account, or conducting any digital transaction, you ("User", "Customer", or "Counterparty") signify your agreement to be bound by these Terms of Service.
                </p>
                <p>
                    <strong>Age Requirement:</strong> You must be at least 18 years of age, or at least 13 years of age with the express knowledge and consent of a parent or legal guardian, to purchase digital goods or exchange vouchers on this platform. If you do not agree with any portion of these terms, you must immediately refrain from using our services.
                </p>
            </div>
        </div>

        <!-- Clause 2: Direct Counterparty Architecture -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">2</span>
                <h2 class="policy-clause-title">Direct Counterparty Model (No P2P Risk)</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    Unlike peer-to-peer (P2P) platforms or unmonitored escrow forums where anonymous buyers and sellers trade with each other at high risk of scams, <strong>RosTop operates as a direct counterparty</strong>:
                </p>
                <ul>
                    <li>When you purchase game top-ups or gift cards, RosTop is the direct seller fulfilling your order through genuine authorized channels.</li>
                    <li>When you sell gift cards or prepaid vouchers (e.g. Paysafecard, Transcash, Apple, Neosurf), <strong>RosTop buys the card directly from you</strong> and transfers the payout to your bKash, Nagad, Rocket, or USDT account.</li>
                    <li>You will never be contacted by or forced to negotiate with unknown third parties. All financial settlements are made directly by RosTop.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 3: Game Top-Up Services -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">3</span>
                <h2 class="policy-clause-title">Game Top-Up &amp; Digital Currency Delivery</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    We provide automated direct top-ups for titles including Free Fire, PUBG Mobile, Mobile Legends: Bang Bang, Call of Duty Mobile, and Roblox:
                </p>
                <ul>
                    <li><strong>UID Accuracy:</strong> Most game top-ups require only your Player ID (UID) and Server/Zone ID. You are solely responsible for ensuring that the Player ID entered at checkout is 100% accurate.</li>
                    <li><strong>Irreversibility of UID Credits:</strong> Once diamonds, UC, or game credits have been successfully dispatched by game publisher API systems to the UID provided by you, the transaction cannot be cancelled, recalled, or transferred.</li>
                    <li><strong>No Password Required:</strong> RosTop will never ask for your game account password for direct UID top-ups. Never share your game password with anyone claiming to be RosTop support.</li>
                    <li><strong>Fulfillment Timelines:</strong> Automated game top-ups typically arrive in your game within 1 to 5 minutes. During server congestion or game patch maintenance, processing may take up to 30 minutes.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 4: Gift Card Purchases -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">4</span>
                <h2 class="policy-clause-title">Gift Card Purchases (Retail Codes)</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    When you buy digital vouchers (such as Google Play, Apple iTunes, Steam Wallet, Razer Gold, or PlayStation Network):
                </p>
                <ul>
                    <li><strong>Code Delivery:</strong> Codes are delivered digitally to your screen upon payment confirmation and saved in your order tracking dashboard.</li>
                    <li><strong>Region Compatibility:</strong> Digital gift cards are region-locked by their issuers (e.g. US, TR, EU, Global). You are responsible for ensuring your personal store account region matches the voucher purchased.</li>
                    <li><strong>Security of Delivered Codes:</strong> Once a digital code is displayed or sent to your provided email/WhatsApp, you are solely responsible for maintaining its confidentiality until redeemed.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 5: Selling Cards to RosTop -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">5</span>
                <h2 class="policy-clause-title">Selling Prepaid Vouchers to RosTop (Instant Payout Model)</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    Users selling digital vouchers and prepaid PINs (Paysafecard, Transcash, Apple, Neosurf, etc.) to RosTop agree to the following binding warranties:
                </p>
                <ul>
                    <li><strong>Lawful Ownership:</strong> You explicitly warrant that you are the lawful owner of the voucher and that the card was acquired legally. We strictly prohibit the submission of cards acquired via unauthorized carding, stolen credit cards, phishing, or illicit means.</li>
                    <li><strong>Unused &amp; Active:</strong> You warrant that the code has not been redeemed, partially used, blocked, or submitted to any other platform.</li>
                    <li><strong>Verification Window:</strong> Payout is released once our automated balance verification system or manual audit verifies the code. Normal processing requires <strong>15 to 45 minutes</strong>.</li>
                    <li><strong>Rate Fluctuations:</strong> Rates displayed on our platform at the moment of submission represent the locked payout rate for your transaction.</li>
                </ul>

                <div class="policy-callout policy-callout-warning">
                    <i data-lucide="alert-triangle" class="icon"></i>
                    <div>
                        <strong>Strict Anti-Fraud Notice:</strong> Submitting fake, altered, exhausted, or stolen voucher codes is a criminal violation. RosTop actively cooperates with law enforcement agencies and cybercrime authorities in Bangladesh and internationally to prosecute fraudulent submissions.
                    </div>
                </div>
            </div>
        </div>

        <!-- Clause 6: Subscriptions & Software -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">6</span>
                <h2 class="policy-clause-title">Digital Subscriptions &amp; Software Licenses</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    For entertainment subscriptions (Netflix 4K, ChatGPT Plus, Canva Pro, CapCut Pro) and software licenses (Windows 11 Pro, Office 365):
                </p>
                <ul>
                    <li><strong>Account Credentials:</strong> Credentials or activation keys are delivered with exact setup instructions. Users must not alter shared account configurations unless explicitly permitted by the package tier.</li>
                    <li><strong>Warranty Period:</strong> All digital subscriptions carry the full duration warranty specified at checkout (e.g. 1 month, 3 months, or 1 year). If an account experiences an interruption within the warranty window, RosTop will fix or replace it within 24 hours.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 7: Payments & TrxID -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">7</span>
                <h2 class="policy-clause-title">Payments, Fees &amp; Transaction Verification</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    All listed product prices on RosTop are in Bangladeshi Taka (BDT) unless alternative currency selection (USD, EUR, GBP) is selected:
                </p>
                <ul>
                    <li><strong>Payment Channels:</strong> We accept manual and automated Mobile Financial Services (bKash, Nagad, Rocket, Upay) as well as USDT (TRC20/BEP20) cryptocurrency.</li>
                    <li><strong>TrxID Verification:</strong> To prevent fraud, all payments must be accompanied by the sender phone/wallet number and unique Transaction ID (TrxID) issued by the payment provider.</li>
                    <li><strong>No Additional Surcharges:</strong> Prices displayed at checkout are inclusive of all platform handling fees.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 8: Prohibited Conduct -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">8</span>
                <h2 class="policy-clause-title">Prohibited Conduct &amp; Account Sanctions</h2>
            </div>
            <div class="policy-clause-body">
                <p>When using RosTop, you agree that you will not:</p>
                <ul>
                    <li>Attempt to exploit bugs, server latency, or discrepancies in the exchange rate calculator.</li>
                    <li>Use bots, automated scrapers, or DDoS tools against rostop.com infrastructure.</li>
                    <li>Submit falsified Transaction IDs (TrxID) or claim payments you did not make.</li>
                    <li>Engage in chargeback fraud or dispute legitimate completed transactions with payment networks.</li>
                </ul>
                <p>
                    Violations will lead to immediate account suspension, cancellation of outstanding payouts, and inclusion on industry-wide fraud registries.
                </p>
            </div>
        </div>

        <!-- Clause 9: Trademarks -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">9</span>
                <h2 class="policy-clause-title">Intellectual Property &amp; Third-Party Trademarks</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    All brand names, trademarks, logos, and game graphics mentioned on this platform (including but not limited to <em>Free Fire, Garena, PUBG Mobile, Tencent, Krafton, Google Play, Apple, Netflix, Microsoft, PlayStation, Valve Steam</em>) are the sole intellectual property of their respective trademark holders.
                </p>
                <p>
                    RosTop is an independent digital goods marketplace and exchange counterparty. The display of third-party trademarks is used strictly for descriptive purposes to identify product compatibility. RosTop is not directly affiliated with or endorsed by these third-party game publishers or streaming providers.
                </p>
            </div>
        </div>

        <!-- Clause 10: Limitation of Liability & Law -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">10</span>
                <h2 class="policy-clause-title">Limitation of Liability, Governing Law &amp; Jurisdiction</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    To the maximum extent permitted by applicable law, RosTop shall not be liable for any indirect, incidental, punitive, or consequential damages resulting from third-party game server downtime, publisher policy shifts, or account bans incurred from the user's violation of a game publisher's rules.
                </p>
                <p>
                    <strong>Governing Law:</strong> These Terms shall be interpreted and governed in accordance with the laws of the People's Republic of Bangladesh. Any dispute arising out of or in connection with these Terms shall first be resolved through good-faith mediation via RosTop Customer Support, or submitted to the jurisdiction of the courts of Dhaka, Bangladesh.
                </p>
            </div>
        </div>

        <!-- Support CTA Box -->
        <div class="policy-support-card">
            <i data-lucide="help-circle" class="icon mb-2" style="width: 32px; height: 32px; color: var(--primary);"></i>
            <h3 style="font-size: 1.15rem; font-weight: 800; font-family: var(--font-heading); margin-bottom: 0.35rem;">Have Questions About Our Terms?</h3>
            <p style="font-size: 0.875rem; color: var(--text-muted); max-width: 500px; margin: 0 auto 1.25rem;">
                Our legal and customer support specialists are available 24/7 to answer questions, resolve discrepancies, and clarify terms.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('support') }}" class="btn btn-primary btn-sm">
                    <i data-lucide="headphones" class="icon"></i> 24/7 Support Center
                </a>
                <a href="https://wa.me/8801700000000" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">
                    <i data-lucide="message-circle" class="icon"></i> WhatsApp Assistance
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
