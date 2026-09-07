@extends('layouts.app')

@section('title', 'Privacy Policy | RosTop Data Protection & Security')
@section('meta_description', 'Learn how RosTop (rostop.com) collects, secures, and handles your personal data, game IDs, payment details, and wallet information with 256-bit SSL encryption.')

@section('content')
<div class="policy-page-container">
    <div class="container" style="max-width: 860px;">

        @include('partials.policy-nav', [
            'title' => 'Privacy Policy',
            'subtitle' => 'Your privacy is paramount. This policy details what information RosTop collects, why we need it, and how we protect your personal and financial data under strict encryption.'
        ])

        <!-- Quick Summary Box -->
        <div class="policy-quick-box">
            <div class="policy-quick-title">
                <i data-lucide="lock" class="icon"></i>
                <span>Privacy at a Glance (Key Summary)</span>
            </div>
            <div class="policy-quick-grid">
                <div class="policy-quick-item">
                    <i data-lucide="shield-check" class="icon"></i>
                    <div><strong>Zero Data Selling:</strong> We never sell, monetize, or trade your personal or financial data to third-party advertisers.</div>
                </div>
                <div class="policy-quick-item">
                    <i data-lucide="key" class="icon"></i>
                    <div><strong>256-Bit SSL:</strong> All traffic, payment TrxIDs, and voucher submissions are encrypted using industry-standard TLS/SSL.</div>
                </div>
                <div class="policy-quick-item">
                    <i data-lucide="eye-off" class="icon"></i>
                    <div><strong>Minimal Data:</strong> We only collect what is strictly necessary to deliver diamonds, send payouts, and track orders.</div>
                </div>
                <div class="policy-quick-item">
                    <i data-lucide="user-check" class="icon"></i>
                    <div><strong>User Control:</strong> You have full rights to request your transaction history or account deletion at any time.</div>
                </div>
            </div>
        </div>

        <!-- Clause 1: Introduction -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">1</span>
                <h2 class="policy-clause-title">Commitment to Consumer Privacy</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    RosTop ("we", "us", or "our"), operating at <strong>rostop.com</strong>, recognizes the critical importance of digital privacy, particularly when dealing with gaming profiles, digital currencies, and mobile financial services in Bangladesh and internationally.
                </p>
                <p>
                    This Privacy Policy explains the collection, storage, processing, and safeguarding of personal data obtained when you interact with our website, buy digital items, sell vouchers, or communicate with our support specialists.
                </p>
            </div>
        </div>

        <!-- Clause 2: Information Collected -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">2</span>
                <h2 class="policy-clause-title">Information We Collect</h2>
            </div>
            <div class="policy-clause-body">
                <p>We gather only the information strictly required to facilitate seamless digital counterparty transactions:</p>
                <ul>
                    <li><strong>In-Game Identifiers:</strong> Player ID (UID), Zone ID, Server Region, or in-game character handle (strictly used to credit top-up diamonds, UC, or coins). We <em>never</em> request game login passwords.</li>
                    <li><strong>Contact Information:</strong> Your mobile phone number, WhatsApp contact, or email address (used to send order confirmations, digital activation keys, and transaction updates).</li>
                    <li><strong>Financial &amp; Settlement Data:</strong>
                        Sender phone number, Transaction ID (TrxID), bKash/Nagad/Rocket account numbers, or USDT wallet addresses.
                    </li>
                    <li><strong>Voucher PINs &amp; Codes:</strong> Gift card numbers and PINs submitted for direct cashout verification.</li>
                    <li><strong>Technical &amp; Device Information:</strong> IP address, browser type, operating system, and timestamp data gathered automatically to protect our infrastructure from DDoS and automated fraud.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 3: Use of Information -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">3</span>
                <h2 class="policy-clause-title">How We Use Your Data</h2>
            </div>
            <div class="policy-clause-body">
                <p>Your information is processed for specific, transparent purposes:</p>
                <ul>
                    <li><strong>Order Fulfillment:</strong> Communicating with publisher APIs (e.g. Free Fire, PUBG) to deliver diamonds or UC directly to your specified UID.</li>
                    <li><strong>Payout Disbursement:</strong> Transferring agreed funds via bKash, Nagad, Rocket, or USDT to your verified account when you sell gift cards to RosTop.</li>
                    <li><strong>Live Order Tracking:</strong> Enabling you to check your order's real-time progress via our <a href="{{ route('track.order') }}" style="color: var(--primary); font-weight: 600;">Track Order</a> engine.</li>
                    <li><strong>Fraud Prevention &amp; Cyber Defense:</strong> Validating Transaction IDs to prevent duplicate claim attempts, stolen card liquidation, and bot exploits.</li>
                    <li><strong>Customer Service:</strong> Assisting you via WhatsApp and Live Support to resolve technical inquiries and verify balance adjustments.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 4: Data Sharing & Non-Disclosure -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">4</span>
                <h2 class="policy-clause-title">Zero Selling &amp; Strict Non-Disclosure</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    <strong>RosTop will NEVER sell, monetize, rent, or trade your personal or financial data to third-party advertisers, data brokers, or marketing networks.</strong>
                </p>
                <p>We share data exclusively with trusted operational entities on a strictly need-to-know basis:</p>
                <ul>
                    <li><strong>Payment Networks:</strong> Telecom and Mobile Financial Services (bKash, Nagad, Rocket) for manual or automated payout dispatch.</li>
                    <li><strong>SMS Gateways:</strong> Authorized telecom providers for delivering one-time verification OTPs and order status SMS messages.</li>
                    <li><strong>Legal &amp; Regulatory Compliance:</strong> We may disclose transaction records only if compelled by a lawful court order or government warrant under the laws of the People's Republic of Bangladesh.</li>
                </ul>
            </div>
        </div>

        <!-- Clause 5: Security Standards -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">5</span>
                <h2 class="policy-clause-title">Data Storage, Encryption &amp; Security Standards</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    We deploy robust enterprise-grade safeguards to protect your records from unauthorized access, alteration, or interception:
                </p>
                <ul>
                    <li><strong>256-Bit SSL/TLS Encryption:</strong> All communications between your device and rostop.com servers are encrypted using modern cryptographic protocols.</li>
                    <li><strong>Restricted Access:</strong> Staff access to customer payout numbers and gift card PINs is restricted strictly to authorized compliance officers.</li>
                    <li><strong>Masked Customer Display:</strong> Public real-time transaction feeds display only masked telephone numbers (e.g. <code>017****2311</code>) to safeguard individual privacy.</li>
                    <li><strong>Credential Hashing:</strong> User passwords and sensitive authorization tokens are salted and hashed using modern cryptographic algorithms (Bcrypt).</li>
                </ul>
            </div>
        </div>

        <!-- Clause 6: Cookies & Local Storage -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">6</span>
                <h2 class="policy-clause-title">Cookies &amp; Local Storage</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    RosTop uses lightweight, non-invasive cookies and browser local storage strictly for functional, user-convenience purposes:
                </p>
                <ul>
                    <li><strong>Theme Preference:</strong> Storing your Light or Dark mode preference (<code>site-theme</code>) across page visits.</li>
                    <li><strong>Currency &amp; Language:</strong> Preserving your preferred currency (BDT, USD, EUR) and language (English, Bengali, Hindi).</li>
                    <li><strong>Session Authentication:</strong> Remembering active logins to allow secure account access.</li>
                </ul>
                <p>
                    We do not use invasive third-party cross-site behavioral tracking cookies.
                </p>
            </div>
        </div>

        <!-- Clause 7: User Rights -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">7</span>
                <h2 class="policy-clause-title">Your Rights &amp; Data Deletion Requests</h2>
            </div>
            <div class="policy-clause-body">
                <p>You have full ownership of your data. At any time, you have the right to:</p>
                <ul>
                    <li>Request a summary of personal information held in connection with your phone number or account.</li>
                    <li>Request correction of inaccurate contact or payment information.</li>
                    <li>Request complete erasure of your account and profile data (subject to mandatory legal retention periods required by financial anti-money laundering regulations).</li>
                </ul>
                <p>
                    To exercise any of these rights, contact our Data Protection Officer at <a href="mailto:privacy@rostop.com" style="color: var(--primary); font-weight: 600;">privacy@rostop.com</a>.
                </p>
            </div>
        </div>

        <!-- Clause 8: Policy Updates -->
        <div class="policy-clause-card">
            <div class="policy-clause-head">
                <span class="policy-clause-number">8</span>
                <h2 class="policy-clause-title">Policy Revisions &amp; Notifications</h2>
            </div>
            <div class="policy-clause-body">
                <p>
                    We may update this Privacy Policy periodically to reflect new platform capabilities, regulatory guidelines, or payment provider requirements. Whenever significant changes are enacted, we will update the "Last Updated" timestamp at the top of this document. Continued usage of rostop.com following modifications indicates your acknowledgement of the updated terms.
                </p>
            </div>
        </div>

        <!-- Support CTA Box -->
        <div class="policy-support-card">
            <i data-lucide="shield" class="icon mb-2" style="width: 32px; height: 32px; color: var(--primary);"></i>
            <h3 style="font-size: 1.15rem; font-weight: 800; font-family: var(--font-heading); margin-bottom: 0.35rem;">Privacy &amp; Data Concerns?</h3>
            <p style="font-size: 0.875rem; color: var(--text-muted); max-width: 500px; margin: 0 auto 1.25rem;">
                Our privacy compliance team is available to assist you with data requests, account anonymization, or security inquiries.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="mailto:privacy@rostop.com" class="btn btn-primary btn-sm">
                    <i data-lucide="mail" class="icon"></i> Email Data Officer
                </a>
                <a href="{{ route('support') }}" class="btn btn-secondary btn-sm">
                    <i data-lucide="headphones" class="icon"></i> 24/7 Support Desk
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
