@php
    $currentRoute = request()->route() ? request()->route()->getName() : '';
    $isTerms = in_array($currentRoute, ['terms', 'l.terms']) || request()->is('terms*');
    $isPrivacy = in_array($currentRoute, ['privacy', 'l.privacy']) || request()->is('privacy*');
    $isRefund = in_array($currentRoute, ['refund.policy', 'l.refund.policy']) || request()->is('refund*');

    $termsUrl = Route::has('terms') ? route('terms') : url('/terms');
    $privacyUrl = Route::has('privacy') ? route('privacy') : url('/privacy');
    $refundUrl = Route::has('refund.policy') ? route('refund.policy') : url('/refund-policy');
@endphp

<!-- Policy Top Header & Breadcrumb -->
<div class="policy-header-wrap mb-4">
    <div class="policy-breadcrumb d-flex align-items-center gap-2 mb-3">
        <a href="{{ route('home') }}" class="policy-back-btn" title="Back to Home" aria-label="Back to Home">
            <i data-lucide="chevron-left" class="icon"></i>
        </a>
        <div class="policy-crumbs text-muted" style="font-size: 0.85rem;">
            <a href="{{ route('home') }}" style="color: var(--text-dim); text-decoration: none;">Home</a>
            <span class="mx-1 text-dim">&bull;</span>
            <span style="color: var(--text-dim);">Legal &amp; Compliance</span>
            <span class="mx-1 text-dim">&bull;</span>
            <span style="color: var(--primary); font-weight: 600;">
                @if($isTerms) Terms of Service @elseif($isPrivacy) Privacy Policy @else Refund Policy @endif
            </span>
        </div>
    </div>

    <div class="policy-title-block">
        <div class="hero-badge mb-2" style="display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(31, 163, 126, 0.1); border: 1px solid rgba(31, 163, 126, 0.25); color: var(--primary); padding: 0.35rem 0.85rem; border-radius: 9999px; font-size: 0.78rem; font-weight: 700;">
            <i data-lucide="shield-check" class="icon" style="width: 14px; height: 14px;"></i>
            <span>RosTop Official Legal Documentation</span>
        </div>

        <h1 class="policy-main-title" style="font-size: clamp(1.75rem, 3.5vw, 2.35rem); font-weight: 900; letter-spacing: -0.02em; margin-bottom: 0.5rem; font-family: var(--font-heading); color: var(--text-main);">
            {{ $title ?? 'Legal Agreement & Consumer Policies' }}
        </h1>

        <p class="policy-main-subtext" style="color: var(--text-muted); font-size: 0.925rem; max-width: 720px; line-height: 1.6; margin-bottom: 1.25rem;">
            {{ $subtitle ?? 'Please read these guidelines carefully. By accessing or transacting on rostop.com, you agree to our transparent counterparty terms, privacy protections, and fair refund framework.' }}
        </p>

        <div class="policy-meta-bar d-flex flex-wrap align-items-center gap-3" style="font-size: 0.8rem; color: var(--text-dim); padding-bottom: 1rem; border-bottom: 1px solid var(--border-color);">
            <div class="d-inline-flex align-items-center gap-1">
                <i data-lucide="calendar" class="icon" style="width: 14px; height: 14px; color: var(--primary);"></i>
                <span>Last Updated: <strong>March 2026</strong></span>
            </div>
            <span class="text-dim">&bull;</span>
            <div class="d-inline-flex align-items-center gap-1">
                <i data-lucide="globe" class="icon" style="width: 14px; height: 14px; color: var(--primary);"></i>
                <span>Jurisdiction: <strong>Dhaka, Bangladesh</strong></span>
            </div>
            <span class="text-dim">&bull;</span>
            <div class="d-inline-flex align-items-center gap-1">
                <i data-lucide="check-circle-2" class="icon" style="width: 14px; height: 14px; color: var(--accent-emerald);"></i>
                <span>Direct Counterparty &bull; No P2P Risk</span>
            </div>
        </div>
    </div>

    <!-- 3-Policy Tab Switcher -->
    <div class="policy-tab-nav mt-3" role="tablist" aria-label="Legal document tabs">
        <a href="{{ $termsUrl }}" class="policy-tab-item {{ $isTerms ? 'active' : '' }}" role="tab" aria-selected="{{ $isTerms ? 'true' : 'false' }}">
            <i data-lucide="file-text" class="icon"></i>
            <span>Terms of Service</span>
            @if($isTerms)
                <span class="policy-tab-indicator"></span>
            @endif
        </a>

        <a href="{{ $privacyUrl }}" class="policy-tab-item {{ $isPrivacy ? 'active' : '' }}" role="tab" aria-selected="{{ $isPrivacy ? 'true' : 'false' }}">
            <i data-lucide="lock" class="icon"></i>
            <span>Privacy Policy</span>
            @if($isPrivacy)
                <span class="policy-tab-indicator"></span>
            @endif
        </a>

        <a href="{{ $refundUrl }}" class="policy-tab-item {{ $isRefund ? 'active' : '' }}" role="tab" aria-selected="{{ $isRefund ? 'true' : 'false' }}">
            <i data-lucide="rotate-ccw" class="icon"></i>
            <span>Refund Policy</span>
            @if($isRefund)
                <span class="policy-tab-indicator"></span>
            @endif
        </a>
    </div>
</div>
