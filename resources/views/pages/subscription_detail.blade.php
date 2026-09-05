@extends('layouts.app')

@php
    $isV2 = true;
    $subIcon = \App\Support\BrandLogos::logo($product->slug);
    $subFirstPkg = $product->packages->sortBy('price_bdt')->first();
@endphp

@section('title', $product->title . ' — Subscription with Full Warranty | RosTop')
@section('meta_description', $product->short_desc ?: 'Buy ' . $product->title . ' in Bangladesh with instant delivery and replacement warranty. bKash/Nagad supported.')
@section('og_image', $product->image ? asset($product->image) : asset('images/og-banner.jpg'))

@push('schema')
    {!! \App\Support\SeoSchema::render([
        \App\Support\SeoSchema::product($product, \App\Support\SeoSchema::productUrl($product)),
        \App\Support\SeoSchema::breadcrumbs([
            ['Home', url(route('home'))],
            ['Subscriptions', url(route('subscriptions'))],
            [$product->title, \App\Support\SeoSchema::productUrl($product)],
        ]),
    ]) !!}
@endpush

@section('content')
<div class="container sd-wrap" style="--sd-accent: #6366F1; --sd-accent-soft: rgba(99,102,241,.12);">

    <!-- Breadcrumb -->
    <nav class="pp-breadcrumb sd-breadcrumb" aria-label="Breadcrumb">
        <div class="pp-breadcrumb-track">
            <a href="{{ route('home') }}" class="pp-bc-link"><i data-lucide="home" class="icon"></i><span>Home</span></a>
            <i data-lucide="chevron-right" class="pp-bc-sep"></i>
            <a href="{{ route('subscriptions') }}" class="pp-bc-link"><i data-lucide="tv" class="icon"></i><span>Subscriptions</span></a>
            <i data-lucide="chevron-right" class="pp-bc-sep"></i>
            <span class="pp-bc-current" title="{{ $product->title }}">{{ $product->title }}</span>
        </div>
    </nav>

    <div class="row g-3 g-lg-4 sd-hero-row">
        <!-- Hero: brand card -->
        <div class="col-12 col-lg-7">
            <div class="sd-hero-card sd-accent-glow">
                <div class="sd-hero-top">
                    <div class="sd-brand-tile">
                        @if($subIcon)
                            <img src="{{ asset('images/brands/' . $subIcon) }}" alt="{{ $product->title }} logo" width="34" height="34">
                        @elseif($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" width="34" height="34">
                        @else
                            <i data-lucide="tv" class="icon" style="color: var(--sd-accent);"></i>
                        @endif
                    </div>
                    <div class="sd-hero-chips">
                        @if($product->tag_badge)<span class="sd-chip sd-chip-accent">{{ $product->tag_badge }}</span>@endif
                        <span class="sd-chip">100% Warranty</span>
                        <span class="sd-chip">Auto Delivery</span>
                    </div>
                </div>
                <h1 class="sd-title">{{ $product->title }}</h1>
                @if($product->short_desc)
                    <p class="sd-lead">{{ $product->short_desc }}</p>
                @endif
            </div>

            <!-- What's included -->
            <div class="sd-card" style="margin-top: 0.9rem;">
                <h2 class="sd-card-title"><i data-lucide="package-check" class="icon"></i> What's Included</h2>
                <div class="sd-included-grid">
                    <div class="sd-include-item"><i data-lucide="user-plus" class="icon"></i><div><strong>Instant Credentials</strong><small>Login email &amp; password delivered to your orders page &amp; email within minutes</small></div></div>
                    <div class="sd-include-item"><i data-lucide="shield-check" class="icon"></i><div><strong>Replacement Warranty</strong><small>Any account issue = instant fixed / full-duration replacement</small></div></div>
                    <div class="sd-include-item"><i data-lucide="smartphone" class="icon"></i><div><strong>All Devices Supported</strong><small>Watch/use on mobile, TV, laptop &amp; tablet with one account</small></div></div>
                    <div class="sd-include-item"><i data-lucide="headphones" class="icon"></i><div><strong>24/7 Live Support</strong><small>WhatsApp help desk for setup or warranty claims — anytime</small></div></div>
                </div>
            </div>
        </div>

        <!-- Purchase card: plans -->
        <div class="col-12 col-lg-5">
            <div class="sd-buy-card" id="sd-plans">
                <div class="sd-buy-head">
                    <i data-lucide="crown" class="icon" style="color: var(--sd-accent);"></i>
                    <h2 class="sd-card-title" style="margin:0;">Choose Your Plan</h2>
                </div>

                <form action="{{ route('checkout') }}" method="GET">
                    <input type="hidden" name="package_id" id="sd-pkg-input" value="{{ $subFirstPkg?->id }}">

                    <div class="sd-plan-list" role="radiogroup" aria-label="Subscription plans">
                        @foreach($product->packages->sortBy('price_bdt') as $pkg)
                            <label class="sd-plan {{ $loop->first ? 'active' : '' }}" data-pkg-id="{{ $pkg->id }}" data-price="{{ $pkg->price_bdt }}">
                                <input type="radio" name="plan_{{ $product->slug }}" value="{{ $pkg->id }}" class="sd-plan-radio" {{ $loop->first ? 'checked' : '' }}>
                                <div class="sd-plan-main">
                                    <span class="sd-plan-name">{{ $pkg->name }}</span>
                                    @if($pkg->badge)<span class="sd-plan-badge">{{ $pkg->badge }}</span>@endif
                                </div>
                                <div class="sd-plan-price">
                                    @if($pkg->original_price_bdt && $pkg->original_price_bdt > $pkg->price_bdt)
                                        <del>৳{{ number_format($pkg->original_price_bdt) }}</del>
                                    @endif
                                    <strong>৳{{ number_format($pkg->price_bdt) }}</strong>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <div class="sd-buy-summary">
                        <div class="sd-sum-row"><span>{{ $subFirstPkg?->name ?? 'Selected plan' }}</span><strong id="sd-total">৳{{ number_format($subFirstPkg?->price_bdt ?? $product->base_price_bdt) }}</strong></div>
                        <div class="sd-sum-sub">Instant credential delivery + warranty included</div>
                    </div>

                    <button type="submit" class="sd-buy-cta">
                        <span>Get Account Now ({{ $product->base_price_bdt ? '৳' . number_format($product->base_price_bdt) . '+' : '' }})</span>
                        <i data-lucide="arrow-right" class="icon"></i>
                    </button>

                    <div class="sd-buy-trust">
                        <span><i data-lucide="shield-check" class="icon"></i> Replacement Warranty</span>
                        <span><i data-lucide="zap" class="icon"></i> Instant Delivery</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- How it works: subscribe flow -->
    <div class="sd-card" style="margin-top: 1rem;">
        <h2 class="sd-card-title"><i data-lucide="sparkles" class="icon"></i> How Subscription Delivery Works</h2>
        <div class="sd-steps">
            <div class="sd-step"><span class="sd-step-num">1</span><div><strong>Pick your plan</strong><p>Select duration &amp; account type (shared/private) above.</p></div></div>
            <div class="sd-step"><span class="sd-step-num">2</span><div><strong>Pay with bKash/Nagad</strong><p>Secure automated payment — no human delay.</p></div></div>
            <div class="sd-step"><span class="sd-step-num">3</span><div><strong>Get login instantly</strong><p>Email + password appears on your order page within minutes, warranty backed.</p></div></div>
        </div>
    </div>

    @if(isset($related) && $related->count())
    <div class="sd-card" style="margin-top: 1rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:0.5rem; margin-bottom: 0.75rem;">
            <h2 class="sd-card-title" style="margin:0;"><i data-lucide="layout-grid" class="icon"></i> More Subscriptions</h2>
            <a href="{{ route('subscriptions') }}" class="sd-viewall">View All <i data-lucide="arrow-right" class="icon" style="width:14px;height:14px;"></i></a>
        </div>
        <div class="row row-cols-2 row-cols-md-4 g-2">
            @foreach($related as $r)
                <div class="col">
                    @include('partials.service-mini-card', ['service' => $r, 'route' => 'subscriptions.show', 'ctaLabel' => 'Get Access', 'fallbackIcon' => 'crown'])
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const plans = document.querySelectorAll('.sd-plan');
    const input = document.getElementById('sd-pkg-input');
    const totalEl = document.getElementById('sd-total');
    plans.forEach(plan => {
        plan.addEventListener('click', () => {
            plans.forEach(p => p.classList.remove('active'));
            plan.classList.add('active');
            const radio = plan.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;
            if (input) input.value = plan.getAttribute('data-pkg-id');
            if (totalEl) totalEl.textContent = '৳' + Number(plan.getAttribute('data-price')).toLocaleString('en-IN');
        });
    });
});
</script>
@endpush
@endsection
