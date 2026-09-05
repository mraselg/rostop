@extends('layouts.app')

@php
    $gcIcon = \App\Support\BrandLogos::logo($product->slug);
    $gcFirstPkg = $product->packages->sortBy('price_bdt')->first();
@endphp

@section('title', $product->title . ' — Instant Digital Code (bKash/Nagad) | RosTop')
@section('meta_description', $product->short_desc ?: 'Buy ' . $product->title . ' in Bangladesh. 100% genuine code delivered instantly to your email & orders page.')
@section('og_image', $product->image ? asset($product->image) : asset('images/og-banner.jpg'))

@push('schema')
    {!! \App\Support\SeoSchema::render([
        \App\Support\SeoSchema::product($product, \App\Support\SeoSchema::productUrl($product)),
        \App\Support\SeoSchema::breadcrumbs([
            ['Home', url(route('home'))],
            ['Buy Gift Cards', url(route('giftcards.buy'))],
            [$product->title, \App\Support\SeoSchema::productUrl($product)],
        ]),
    ]) !!}
@endpush

@section('content')
<div class="container sd-wrap" style="--sd-accent: #06B6D4; --sd-accent-soft: rgba(6,182,212,.12);">

    <nav class="pp-breadcrumb sd-breadcrumb" aria-label="Breadcrumb">
        <div class="pp-breadcrumb-track">
            <a href="{{ route('home') }}" class="pp-bc-link"><i data-lucide="home" class="icon"></i><span>Home</span></a>
            <i data-lucide="chevron-right" class="pp-bc-sep"></i>
            <a href="{{ route('giftcards.buy') }}" class="pp-bc-link"><i data-lucide="gift" class="icon"></i><span>Buy Gift Cards</span></a>
            <i data-lucide="chevron-right" class="pp-bc-sep"></i>
            <span class="pp-bc-current" title="{{ $product->title }}">{{ $product->title }}</span>
        </div>
    </nav>

    <div class="row g-3 g-lg-4 sd-hero-row">
        <div class="col-12 col-lg-7">
            <div class="sd-hero-card sd-accent-glow">
                <div class="sd-hero-top">
                    <div class="sd-brand-tile">
                        @if($gcIcon)
                            <img src="{{ asset('images/brands/' . $gcIcon) }}" alt="{{ $product->title }} logo" width="34" height="34">
                        @else
                            <i data-lucide="gift" class="icon" style="color: var(--sd-accent);"></i>
                        @endif
                    </div>
                    <div class="sd-hero-chips">
                        @if($product->tag_badge)<span class="sd-chip sd-chip-accent">{{ $product->tag_badge }}</span>@endif
                        <span class="sd-chip"><i data-lucide="globe" class="icon" style="width:11px;height:11px;margin-right:3px;"></i> Global Region</span>
                        <span class="sd-chip">💯 Genuine Code</span>
                    </div>
                </div>
                <h1 class="sd-title">{{ $product->title }}</h1>
                @if($product->short_desc)
                    <p class="sd-lead">{{ $product->short_desc }}</p>
                @endif
            </div>

            <div class="sd-card" style="margin-top: 0.9rem;">
                <h2 class="sd-card-title"><i data-lucide="mail-check" class="icon"></i> How You'll Receive the Code</h2>
                <div class="sd-steps">
                    <div class="sd-step"><span class="sd-step-num">1</span><div><strong>Pay with bKash / Nagad / USDT</strong><p>Select the denomination you need and complete payment in one minute.</p></div></div>
                    <div class="sd-step"><span class="sd-step-num">2</span><div><strong>Code lands instantly</strong><p>The 100% genuine redemption code appears on your order page and is emailed right away.</p></div></div>
                    <div class="sd-step"><span class="sd-step-num">3</span><div><strong>Redeem anywhere</strong><p>Paste the code on the official store/site exactly as shown in verification instructions.</p></div></div>
                </div>
            </div>

            <div class="sd-card" style="margin-top: 0.9rem;">
                <h2 class="sd-card-title"><i data-lucide="badge-check" class="icon"></i> Why Buy From RosTop</h2>
                <div class="sd-included-grid">
                    <div class="sd-include-item"><i data-lucide="badge-percent" class="icon"></i><div><strong>Sourced from authorized resellers</strong><small>Codes never recycled or pre-redeemed — verified before listing</small></div></div>
                    <div class="sd-include-item"><i data-lucide="clock" class="icon"></i><div><strong>Average delivery &lt; 5 minutes</strong><small>Automated stock — no queue, even at midnight</small></div></div>
                    <div class="sd-include-item"><i data-lucide="shield-alert" class="icon"></i><div><strong>24h invalid-code replacement</strong><small>If a rare code fails, instant replacement with proof of redemption</small></div></div>
                    <div class="sd-include-item"><i data-lucide="headphones" class="icon"></i><div><strong>WhatsApp support</strong><small>Live help for region or redemption questions — real humans</small></div></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="sd-buy-card" id="sd-denoms">
                <div class="sd-buy-head">
                    <i data-lucide="ticket" class="icon" style="color: var(--sd-accent);"></i>
                    <h2 class="sd-card-title" style="margin:0;">Select Denomination</h2>
                </div>

                <form action="{{ route('checkout') }}" method="GET">
                    <input type="hidden" name="package_id" id="sd-pkg-input" value="{{ $gcFirstPkg?->id }}">

                    <div class="sd-denom-grid" role="radiogroup" aria-label="Card denominations">
                        @foreach($product->packages->sortBy('amount_val') as $pkg)
                            <label class="sd-denom {{ $loop->first ? 'active' : '' }}" data-pkg-id="{{ $pkg->id }}" data-price="{{ $pkg->price_bdt }}">
                                <input type="radio" name="denom_{{ $product->slug }}" value="{{ $pkg->id }}" class="sd-plan-radio" {{ $loop->first ? 'checked' : '' }}>
                                @if($pkg->amount_val)<span class="sd-denom-val">{{ $pkg->amount_val }}</span>@endif
                                <span class="sd-denom-name">{{ $pkg->name }}</span>
                                <span class="sd-denom-price">৳{{ number_format($pkg->price_bdt) }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="sd-buy-summary">
                        <div class="sd-sum-row"><span>You'll pay</span><strong id="sd-total">৳{{ number_format($gcFirstPkg?->price_bdt ?? $product->base_price_bdt) }}</strong></div>
                        <div class="sd-sum-sub">Digital code delivered instantly — no shipping, no wait</div>
                    </div>

                    <button type="submit" class="sd-buy-cta" style="background: linear-gradient(135deg, #06B6D4, #0284C7);">
                        <span>Buy Digital Code</span>
                        <i data-lucide="arrow-right" class="icon"></i>
                    </button>

                    <div class="sd-buy-trust">
                        <span><i data-lucide="mail-check" class="icon"></i> Email + Order Page Delivery</span>
                        <span><i data-lucide="shield-check" class="icon"></i> 100% Genuine</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(isset($related) && $related->count())
    <div class="sd-card" style="margin-top: 1rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:0.5rem; margin-bottom: 0.75rem;">
            <h2 class="sd-card-title" style="margin:0;"><i data-lucide="layout-grid" class="icon"></i> More Gift Cards</h2>
            <a href="{{ route('giftcards.buy') }}" class="sd-viewall">View All <i data-lucide="arrow-right" class="icon" style="width:14px;height:14px;"></i></a>
        </div>
        <div class="row row-cols-2 row-cols-md-4 g-2">
            @foreach($related as $r)
                <div class="col">
                    @include('partials.service-mini-card', ['service' => $r, 'route' => 'giftcards.buy.show', 'ctaLabel' => 'Buy Codes', 'fallbackIcon' => 'gift'])
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const denoms = document.querySelectorAll('.sd-denom');
    const input = document.getElementById('sd-pkg-input');
    const totalEl = document.getElementById('sd-total');
    denoms.forEach(d => {
        d.addEventListener('click', () => {
            denoms.forEach(x => x.classList.remove('active'));
            d.classList.add('active');
            const radio = d.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;
            if (input) input.value = d.getAttribute('data-pkg-id');
            if (totalEl) totalEl.textContent = '৳' + Number(d.getAttribute('data-price')).toLocaleString('en-IN');
        });
    });
});
</script>
@endpush
@endsection
