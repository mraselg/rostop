@extends('layouts.app')

@section('title', 'Government Verified Business | RosTop - Registered Taxpayer')
@section('meta_description', 'RosTop is a Government of Bangladesh verified and registered taxpayer. View our official TIN Certificate and Income Tax Return credentials to trust your transactions.')

@section('content')
<div class="policy-page-container">
    <div class="container" style="max-width: 860px;">

        {{-- Page Header --}}
        <div class="policy-header-wrap mb-4">
            <div class="policy-breadcrumb d-flex align-items-center gap-2 mb-3">
                <a href="{{ route('home') }}" class="policy-back-btn" title="Back to Home" aria-label="Back to Home">
                    <i data-lucide="chevron-left" class="icon"></i>
                </a>
                <div class="policy-crumbs text-muted" style="font-size: 0.85rem;">
                    <a href="{{ route('home') }}" style="color: var(--text-dim); text-decoration: none;">Home</a>
                    <span class="mx-1 text-dim">&bull;</span>
                    <span style="color: var(--text-dim);">Trust & Verification</span>
                    <span class="mx-1 text-dim">&bull;</span>
                    <span style="color: var(--primary); font-weight: 600;">Government Verification</span>
                </div>
            </div>

            <div class="policy-title-block">
                <div class="hero-badge mb-2" style="display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(31, 163, 126, 0.1); border: 1px solid rgba(31, 163, 126, 0.25); color: var(--primary); padding: 0.35rem 0.85rem; border-radius: 9999px; font-size: 0.78rem; font-weight: 700;">
                    <i data-lucide="badge-check" class="icon" style="width: 14px; height: 14px;"></i>
                    <span>Government of Bangladesh — Verified Entity</span>
                </div>

                <h1 class="policy-main-title" style="font-size: clamp(1.75rem, 3.5vw, 2.35rem); font-weight: 900; letter-spacing: -0.02em; margin-bottom: 0.5rem; font-family: var(--font-heading); color: var(--text-main);">
                    Government Verified Business
                </h1>

                <p class="policy-main-subtext" style="color: var(--text-muted); font-size: 0.925rem; max-width: 720px; line-height: 1.6; margin-bottom: 1.25rem;">
                    RosTop is a fully registered and tax-compliant digital business under the jurisdiction of the National Board of Revenue (NBR), Government of the People's Republic of Bangladesh. Below are our officially verified credentials with sensitive information masked for security.
                </p>

                <div class="policy-meta-bar d-flex flex-wrap align-items-center gap-3" style="font-size: 0.8rem; color: var(--text-dim); padding-bottom: 1rem; border-bottom: 1px solid var(--border-color);">
                    <div class="d-inline-flex align-items-center gap-1">
                        <i data-lucide="calendar" class="icon" style="width: 14px; height: 14px; color: var(--primary);"></i>
                        <span>Verified: <strong>August 2026</strong></span>
                    </div>
                    <span class="text-dim">&bull;</span>
                    <div class="d-inline-flex align-items-center gap-1">
                        <i data-lucide="map-pin" class="icon" style="width: 14px; height: 14px; color: var(--primary);"></i>
                        <span>Jurisdiction: <strong>Khulna, Bangladesh</strong></span>
                    </div>
                    <span class="text-dim">&bull;</span>
                    <div class="d-inline-flex align-items-center gap-1">
                        <i data-lucide="check-circle-2" class="icon" style="width: 14px; height: 14px; color: var(--accent-emerald);"></i>
                        <span>Tax Compliant &bull; NBR Registered</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Trust Summary Banner --}}
        <div class="gov-trust-banner">
            <div class="gov-trust-banner-inner">
                <div class="gov-trust-icon">
                    <i data-lucide="shield-check" class="icon"></i>
                </div>
                <div class="gov-trust-text">
                    <strong>Why does this matter?</strong>
                    <p>Government verification proves RosTop is a legally registered, tax-paying business — not an anonymous or fly-by-night operation. Your money and transactions are protected by Bangladeshi commercial law.</p>
                </div>
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- CERTIFICATE 1: TIN Certificate --}}
        {{-- ============================================= --}}
        <div class="gov-cert-card">
            <div class="gov-cert-header">
                <div class="gov-cert-badge gov-cert-badge-tin">
                    <i data-lucide="file-badge" class="icon"></i>
                </div>
                <div>
                    <h2 class="gov-cert-title">Taxpayer's Identification Number (TIN) Certificate</h2>
                    <p class="gov-cert-issuer">National Board of Revenue &mdash; Government of the People's Republic of Bangladesh</p>
                </div>
                <div class="gov-cert-status">
                    <span class="gov-status-pill gov-status-active">
                        <i data-lucide="check-circle" class="icon"></i> Active
                    </span>
                </div>
            </div>

            <div class="gov-cert-body">
                <div class="gov-cert-grid">
                    {{-- TIN Number (partially masked) --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="hash" class="icon"></i> TIN Number
                        </span>
                        <span class="gov-field-value gov-field-masked">
                            1680 •••• 4141
                            <span class="gov-mask-badge">
                                <i data-lucide="eye-off" class="icon"></i> Partially Masked
                            </span>
                        </span>
                    </div>

                    {{-- Registered Name --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="user" class="icon"></i> Taxpayer's Name
                        </span>
                        <span class="gov-field-value">
                            <strong>MD RASEL GAZI</strong>
                        </span>
                    </div>

                    {{-- Taxes Circle / Zone --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="building-2" class="icon"></i> Tax Circle / Zone
                        </span>
                        <span class="gov-field-value">
                            Taxes Circle-07 (Companies), Taxes Zone Khulna
                        </span>
                    </div>

                    {{-- Status --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="user-check" class="icon"></i> Status
                        </span>
                        <span class="gov-field-value">
                            Individual
                        </span>
                    </div>

                    {{-- Address (masked) --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="map-pin" class="icon"></i> Registered Address
                        </span>
                        <span class="gov-field-value gov-field-masked">
                            ••••••••, Khulna, Bangladesh
                            <span class="gov-mask-badge">
                                <i data-lucide="eye-off" class="icon"></i> Hidden
                            </span>
                        </span>
                    </div>

                    {{-- Issue Date --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="calendar" class="icon"></i> Certificate Date
                        </span>
                        <span class="gov-field-value">
                            August 19, 2026
                        </span>
                    </div>
                </div>
            </div>

            <div class="gov-cert-footer">
                <i data-lucide="info" class="icon"></i>
                <span>This is a government-issued system-generated certificate verified with the National Board of Revenue. Some personal details have been masked for privacy and security.</span>
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- CERTIFICATE 2: Income Tax Return Certificate --}}
        {{-- ============================================= --}}
        <div class="gov-cert-card">
            <div class="gov-cert-header">
                <div class="gov-cert-badge gov-cert-badge-tax">
                    <i data-lucide="receipt" class="icon"></i>
                </div>
                <div>
                    <h2 class="gov-cert-title">Income Tax Certificate (eReturn)</h2>
                    <p class="gov-cert-issuer">Income Tax Department, National Board of Revenue &mdash; Government of the People's Republic of Bangladesh</p>
                </div>
                <div class="gov-cert-status">
                    <span class="gov-status-pill gov-status-active">
                        <i data-lucide="check-circle" class="icon"></i> Filed
                    </span>
                </div>
            </div>

            <div class="gov-cert-body">
                <div class="gov-cert-grid">
                    {{-- Reference Number (masked) --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="hash" class="icon"></i> Reference Number
                        </span>
                        <span class="gov-field-value gov-field-masked">
                            2153 •••• 474
                            <span class="gov-mask-badge">
                                <i data-lucide="eye-off" class="icon"></i> Partially Masked
                            </span>
                        </span>
                    </div>

                    {{-- Taxpayer's Name --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="user" class="icon"></i> Taxpayer's Name
                        </span>
                        <span class="gov-field-value">
                            <strong>MD RASEL GAZI</strong>
                        </span>
                    </div>

                    {{-- TIN (masked, same as above) --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="fingerprint" class="icon"></i> TIN
                        </span>
                        <span class="gov-field-value gov-field-masked">
                            1680 •••• 4141
                            <span class="gov-mask-badge">
                                <i data-lucide="eye-off" class="icon"></i> Masked
                            </span>
                        </span>
                    </div>

                    {{-- Assessment Year --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="calendar-range" class="icon"></i> Assessment Year
                        </span>
                        <span class="gov-field-value">
                            <strong>2026–2027</strong>
                        </span>
                    </div>

                    {{-- Section --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="scroll-text" class="icon"></i> Section
                        </span>
                        <span class="gov-field-value">
                            180 (Self)
                        </span>
                    </div>

                    {{-- Taxpayer Status --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="flag" class="icon"></i> Status
                        </span>
                        <span class="gov-field-value">
                            Individual &rarr; Bangladeshi &rarr; NID Verified
                        </span>
                    </div>

                    {{-- Tax Zone --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="building-2" class="icon"></i> Tax Circle / Zone
                        </span>
                        <span class="gov-field-value">
                            Taxes Circle-07 (Companies), Taxes Zone Khulna
                        </span>
                    </div>

                    {{-- Address (masked) --}}
                    <div class="gov-cert-field">
                        <span class="gov-field-label">
                            <i data-lucide="map-pin" class="icon"></i> Registered Address
                        </span>
                        <span class="gov-field-value gov-field-masked">
                            ••••••••, Khulna, Bangladesh
                            <span class="gov-mask-badge">
                                <i data-lucide="eye-off" class="icon"></i> Hidden
                            </span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="gov-cert-footer">
                <i data-lucide="info" class="icon"></i>
                <span>This certificate confirms that the taxpayer has filed the return of income for the Assessment Year 2026–2027. This is a system-generated certificate requiring no manual signature.</span>
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- WHY TRUST ROSTOP Section --}}
        {{-- ============================================= --}}
        <div class="gov-why-trust">
            <h3 class="gov-why-title">
                <i data-lucide="shield" class="icon"></i>
                Why Trust RosTop?
            </h3>
            <div class="gov-why-grid">
                <div class="gov-why-item">
                    <div class="gov-why-icon" style="background: rgba(16, 185, 129, 0.12); color: #10b981;">
                        <i data-lucide="badge-check" class="icon"></i>
                    </div>
                    <div>
                        <strong>Government Registered</strong>
                        <p>Officially registered with TIN under the National Board of Revenue, Bangladesh.</p>
                    </div>
                </div>
                <div class="gov-why-item">
                    <div class="gov-why-icon" style="background: rgba(59, 130, 246, 0.12); color: #3b82f6;">
                        <i data-lucide="file-check-2" class="icon"></i>
                    </div>
                    <div>
                        <strong>Tax Return Filed</strong>
                        <p>Income tax return is filed and up-to-date for Assessment Year 2026–2027 via eReturn system.</p>
                    </div>
                </div>
                <div class="gov-why-item">
                    <div class="gov-why-icon" style="background: rgba(168, 85, 247, 0.12); color: #a855f7;">
                        <i data-lucide="landmark" class="icon"></i>
                    </div>
                    <div>
                        <strong>Legally Accountable</strong>
                        <p>As a registered taxpayer, RosTop is legally accountable under Bangladeshi law — protecting your consumer rights.</p>
                    </div>
                </div>
                <div class="gov-why-item">
                    <div class="gov-why-icon" style="background: rgba(245, 158, 11, 0.12); color: #f59e0b;">
                        <i data-lucide="lock" class="icon"></i>
                    </div>
                    <div>
                        <strong>Privacy Respected</strong>
                        <p>Sensitive personal details (full TIN, family names, full address) are masked — we believe in transparency without compromising security.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Support CTA --}}
        <div class="policy-support-card">
            <i data-lucide="help-circle" class="icon mb-2" style="width: 32px; height: 32px; color: var(--primary);"></i>
            <h3 style="font-size: 1.15rem; font-weight: 800; font-family: var(--font-heading); margin-bottom: 0.35rem;">Need More Verification?</h3>
            <p style="font-size: 0.875rem; color: var(--text-muted); max-width: 500px; margin: 0 auto 1.25rem;">
                If you need additional proof of our legitimacy or want to verify our TIN directly with the National Board of Revenue, contact our support team.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('support') }}" class="btn btn-primary btn-sm">
                    <i data-lucide="headphones" class="icon"></i> 24/7 Support Center
                </a>
                <a href="https://secure.incometax.gov.bd/TINHome" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-sm">
                    <i data-lucide="external-link" class="icon"></i> NBR TIN Verification Portal
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
