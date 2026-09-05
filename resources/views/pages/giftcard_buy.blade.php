@extends('layouts.app')

@section('title', 'Buy Gift Cards with bKash, Nagad & Crypto | RosTop')
@section('meta_description', 'Buy Google Play US, Apple iTunes, Steam Wallet, PlayStation, Xbox, and Razer Gold codes in Bangladesh on rostop.com with instant digital code delivery.')

@push('schema')
    {!! \App\Support\SeoSchema::render([
        \App\Support\SeoSchema::collectionPage(
            'Buy Gift Cards with bKash, Nagad & Crypto',
            'Google Play, Apple iTunes, Steam Wallet, PlayStation, Xbox, and Razer Gold codes with instant digital delivery.',
            url()->current(),
            \App\Support\SeoSchema::itemList($products, 'Buy Gift Cards')
        ),
        \App\Support\SeoSchema::breadcrumbs([['Home', url(route('home'))], ['Buy Gift Cards', url()->current()]]),
    ]) !!}
@endpush

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 4rem;">

    <div style="margin-bottom: 1.75rem; display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 1rem;">
        <div>
            <div class="hero-badge">
                <i data-lucide="shield-check" class="icon" style="width:14px;height:14px;"></i>
                <span>100% Genuine Digital Redeem Codes &bull; rostop.com</span>
            </div>
            <h1 style="font-size: 2.2rem; font-weight: 900; letter-spacing: -0.02em; margin-bottom: 0.5rem;">
                Buy Gift Cards
            </h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">
                গুগল প্লে, অ্যাপল আইটিউনস, স্টিম ওয়ালেট ও প্লেস্টেশন গিফট কার্ড কিনুন বিকাশ ও নগদ দিয়ে। কোড ইনস্ট্যান্ট ড্যাশবোর্ড ও ইমেইলে পাঠিয়ে দেওয়া হয়।
            </p>

            <!-- Trust Features Bar -->
            <div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:0.85rem;">
                <div class="pp-trust-badge">
                    <i data-lucide="badge-check" class="icon" style="width:14px;height:14px;color:var(--vb-emerald);"></i>
                    <span>100% Genuine Codes</span>
                </div>
                <div class="pp-trust-badge">
                    <i data-lucide="zap" class="icon" style="width:14px;height:14px;color:var(--vb-orange);"></i>
                    <span>Instant Code Delivery</span>
                </div>
                <div class="pp-trust-badge">
                    <i data-lucide="wallet" class="icon" style="width:14px;height:14px;color:#38BDF8;"></i>
                    <span>bKash / Nagad / USDT</span>
                </div>
            </div>
        </div>

        <a href="{{ route('giftcards.sell') }}" class="btn btn-sell">
            <i data-lucide="wallet" class="icon"></i> Want to SELL cards? Click here &rarr;
        </a>
    </div>

    <div class="grid-cards">
        @foreach($products as $card)
            @include('partials.service-card', [
                'service'      => $card,
                'route'        => 'giftcards.buy.show',
                'ctaLabel'     => 'Buy Codes',
                'fallbackIcon' => 'gift',
            ])
        @endforeach
    </div>

</div>
@endsection
