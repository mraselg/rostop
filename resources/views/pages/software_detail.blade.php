@extends('layouts.app')

@php
    $swIcon = \App\Support\BrandLogos::logo($product->slug);
    $swFirstPkg = $product->packages->sortBy('price_bdt')->first();
@endphp

@section('title', $product->title . ' — Genuine License with Warranty | RosTop')
@section('meta_description', $product->short_desc ?: 'Buy ' . $product->title . ' in Bangladesh. OEM genuine key with activation guide and technical support.')
@section('og_image', $product->image ? asset($product->image) : asset('images/og-banner.jpg'))

@push('schema')
    {!! \App\Support\SeoSchema::render([
        \App\Support\SeoSchema::product($product, \App\Support\SeoSchema::productUrl($product)),
        \App\Support\SeoSchema::breadcrumbs([
            ['Home', url(route('home'))],
            ['Software & Digital Products', url(route('digital.products'))],
            [$product->title, \App\Support\SeoSchema::productUrl($product)],
        ]),
    ]) !!}
@endpush

@section('content')
<div class="container sd-wrap" style="--sd-accent: #38BDF8; --sd-accent-soft: rgba(56,189,248,.12);">

    <nav class="pp-breadcrumb sd-breadcrumb" aria-label="Breadcrumb">
        <div class="pp-breadcrumb-track">
            <a href="{{ route('home') }}" class="pp-bc-link"><i data-lucide="home" class="icon"></i><span>Home</span></a>
            <i data-lucide="chevron-right" class="pp-bc-sep"></i>
            <a href="{{ route('digital.products') }}" class="pp-bc-link"><i data-lucide="key-round" class="icon"></i><span>Software</span></a>
            <i data-lucide="chevron-right" class="pp-bc-sep"></i>
            <span class="pp-bc-current" title="{{ $product->title }}">{{ $product->title }}</span>
        </div>
    </nav>

    <div class="row g-3 g-lg-4 sd-hero-row">
        <div class="col-12 col-lg-7">
            <div class="sd-hero-card sd-accent-glow">
                <div class="sd-hero-top">
                    <div class="sd-brand-tile">
                        @if($swIcon)
                            <img src="{{ asset('images/brands/' . $swIcon) }}" alt="{{ $product->title }} logo" width="34" height="34">
                        @else
                            <i data-lucide="key-round" class="icon" style="color: var(--sd-accent);"></i>
                        @endif
                    </div>
                    <div class="sd-hero-chips">
                        @if($product->tag_badge)<span class="sd-chip sd-chip-accent">{{ $product->tag_badge }}</span>@endif
                        <span class="sd-chip">OEM / Retail Genuine</span>
                        <span class="sd-chip">Instant Key</span>
                    </div>
                </div>
                <h1 class="sd-title">{{ $product->title }}</h1>
                @if($product->short_desc)
                    <p class="sd-lead">{{ $product->short_desc }}</p>
                @endif
            </div>

            <div class="sd-card" style="margin-top: 0.9rem;">
                <h2 class="sd-card-title"><i data-lucide="download" class="icon"></i> Activation Steps</h2>
                <div class="sd-steps">
                    <div class="sd-step"><span class="sd-step-num">1</span><div><strong>Download officially</strong><p>Install the official app/ISO from the publisher — we never send pirated images.</p></div></div>
                    <div class="sd-step"><span class="sd-step-num">2</span><div><strong>Enter your genuine key</strong><p>Your 25-character license arrives on the order page immediately after payment.</p></div></div>
                    <div class="sd-step"><span class="sd-step-num">3</span><div><strong>Activate online</strong><p>Connect to the official activation server — one-time bind, genuine lifetime term.</p></div></div>
                </div>
            </div>

            <div class="sd-card" style="margin-top: 0.9rem;">
                <h2 class="sd-card-title"><i data-lucide="verified" class="icon"></i> Authenticity Guarantee</h2>
                <div class="sd-included-grid">
                    <div class="sd-include-item"><i data-lucide="scan-barcode" class="icon"></i><div><strong>OEM-registered keys</strong><small>Volume/retail keys that activate against official servers — traceable</small></div></div>
                    <div class="sd-include-item"><i data-lucide="wrench" class="icon"></i><div><strong>Activation support</strong><small>If activation fails (rare), free remote desk-fix or instant key swap</small></div></div>
                    <div class="sd-include-item"><i data-lucide="refresh-cw" class="icon"></i><div><strong>Lifetime reactivation</strong><small>Reinstall after format/new PC following the official reactivation policy</small></div></div>
                    <div class="sd-include-item"><i data-lucide="book-open" class="icon"></i><div><strong>Step-by-step manual</strong><small>English &amp; Bangla (বাংলা) illustrated activation guide included</small></div></div>
                </div>
            </div>

            @if($product->instructions)
            <div class="sd-card" style="margin-top: 0.9rem;">
                <h2 class="sd-card-title"><i data-lucide="file-text" class="icon"></i> Notes</h2>
                <div class="sd-notes">{!! nl2br(e($product->instructions)) !!}</div>
            </div>
            @endif
        </div>

        <div class="col-12 col-lg-5">
            <div class="sd-buy-card" id="sd-licenses">
                <div class="sd-buy-head">
                    <i data-lucide="badge-check" class="icon" style="color: var(--sd-accent);"></i>
                    <h2 class="sd-card-title" style="margin:0;">Select License Type</h2>
                </div>

                <form action="{{ route('checkout') }}" method="GET">
                    <input type="hidden" name="package_id" id="sd-pkg-input" value="{{ $swFirstPkg?->id }}">

                    <div class="sd-plan-list" role="radiogroup" aria-label="License types">
                        @foreach($product->packages->sortBy('price_bdt') as $pkg)
                            <label class="sd-plan {{ $loop->first ? 'active' : '' }}" data-pkg-id="{{ $pkg->id }}" data-price="{{ $pkg->price_bdt }}">
                                <input type="radio" name="lic_{{ $product->slug }}" value="{{ $pkg->id }}" class="sd-plan-radio" {{ $loop->first ? 'checked' : '' }}>
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
                        <div class="sd-sum-row"><span>Total (genuine key)</span><strong id="sd-total">৳{{ number_format($swFirstPkg?->price_bdt ?? $product->base_price_bdt) }}</strong></div>
                        <div class="sd-sum-sub">Instant key delivery + activation support included</div>
                    </div>

                    <button type="submit" class="sd-buy-cta" style="background: linear-gradient(135deg, #38BDF8, #0284C7); color: #062031;">
                        <span>Buy Genuine License</span>
                        <i data-lucide="arrow-right" class="icon"></i>
                    </button>

                    <div class="sd-buy-trust">
                        <span><i data-lucide="shield-check" class="icon"></i> Activation Warranty</span>
                        <span><i data-lucide="key-round" class="icon"></i> OEM Genuine</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(isset($related) && $related->count())
    <div class="sd-card" style="margin-top: 1rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:0.5rem; margin-bottom: 0.75rem;">
            <h2 class="sd-card-title" style="margin:0;"><i data-lucide="layout-grid" class="icon"></i> More Software</h2>
            <a href="{{ route('digital.products') }}" class="sd-viewall">View All <i data-lucide="arrow-right" class="icon" style="width:14px;height:14px;"></i></a>
        </div>
        <div class="row row-cols-2 row-cols-md-4 g-2">
            @foreach($related as $r)
                <div class="col">
                    @include('partials.service-mini-card', ['service' => $r, 'route' => 'digital.products.show', 'ctaLabel' => 'Get Key'])
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
