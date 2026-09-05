@extends('layouts.app')

@section('title', 'Game Top-Up & Diamond Recharge (UID Instant) | RosTop')
@section('meta_description', 'Instant in-game top-up in Bangladesh for Free Fire, PUBG Mobile UC, Mobile Legends, and Valorant via bKash, Nagad & Rocket on rostop.com.')

@push('schema')
    {!! \App\Support\SeoSchema::render([
        \App\Support\SeoSchema::collectionPage(
            'Game Top-Up & Diamond Recharge (UID Instant)',
            'Instant in-game top-up in Bangladesh for Free Fire, PUBG Mobile UC, Mobile Legends, and Valorant via bKash, Nagad & Rocket.',
            url()->current(),
            \App\Support\SeoSchema::itemList($products, 'Game Top-Up Directory')
        ),
        \App\Support\SeoSchema::breadcrumbs([['Home', url(route('home'))], ['Games Top-Up', url()->current()]]),
    ]) !!}
@endpush

@section('content')
<div class="container pp-listing-container">
    
    <!-- Hero Header -->
    <div style="margin-bottom: 1.75rem;">
        <div class="hero-badge" style="background:rgba(255,140,0,0.12); color:var(--vb-orange); border:1px solid rgba(255,140,0,0.25);">
            <i data-lucide="zap" class="icon" style="width:14px;height:14px;"></i>
            <span>Instant 10-60 Second In-Game Reload &bull; Official Publisher Gateway</span>
        </div>
        <h1 class="pp-listing-hero-title">
            Games Top-Up &amp; Digital Currencies
        </h1>
        <p class="pp-listing-hero-desc">
            আপনার পছন্দের গেম সিলেক্ট করুন, প্লেয়ার আইডি (UID) দিন এবং বিকাশ বা নগদ দিয়ে তাৎক্ষণিক রিচার্জ করুন। ১০০% নিরাপদ ও ব্যান-মুক্ত সার্ভিস।
        </p>

        <!-- Trust Features Bar -->
        <div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:0.85rem;">
            <div class="pp-trust-badge">
                <i data-lucide="shield-check" class="icon" style="width:14px;height:14px;color:var(--vb-emerald);"></i>
                <span>100% Safe (No Password)</span>
            </div>
            <div class="pp-trust-badge">
                <i data-lucide="zap" class="icon" style="width:14px;height:14px;color:var(--vb-orange);"></i>
                <span>Direct UID Instant</span>
            </div>
            <div class="pp-trust-badge">
                <i data-lucide="headphones" class="icon" style="width:14px;height:14px;color:#38BDF8;"></i>
                <span>24/7 Live Support</span>
            </div>
        </div>
    </div>

    <!-- Category Filter Bar -->
    <div class="category-pills-bar pp-listing-cats" role="tablist" aria-label="Game categories">
        <button type="button" class="category-pill category-filter-pill active" data-category="all">
            <i data-lucide="layout-grid" class="icon"></i>
            <span>All Games ({{ $products->count() }})</span>
        </button>
        <button type="button" class="category-pill category-filter-pill" data-category="battle-royale">
            <i data-lucide="crosshair" class="icon"></i>
            <span>Battle Royale</span>
        </button>
        <button type="button" class="category-pill category-filter-pill" data-category="moba">
            <i data-lucide="swords" class="icon"></i>
            <span>MOBA / FPS</span>
        </button>
        <button type="button" class="category-pill category-filter-pill" data-category="sports-rpg">
            <i data-lucide="trophy" class="icon"></i>
            <span>Sports &amp; RPG</span>
        </button>
    </div>

    <!-- Games Cards Grid -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
        @foreach($products as $game)
            @php
                $isMlbb = str_contains($game->slug, 'mobile-legends') || str_contains($game->slug, 'mlbb');
                $isFf = str_contains($game->slug, 'free-fire');
                $isPubg = str_contains($game->slug, 'pubg');
                $isVal = str_contains($game->slug, 'valorant');
                $isRoblox = str_contains($game->slug, 'roblox');

                $gameImg = $game->image ? asset($game->image) : ($isMlbb ? asset('images/games/mlbb.jpg') : ($isFf ? asset('images/games/freefire.webp') : ($isPubg ? asset('images/games/pubg.png') : ($isVal ? asset('images/games/valorant.jpg') : ($isRoblox ? asset('images/games/roblox.jpg') : null)))));
                $isBdRegion = in_array($game->slug, ['free-fire', 'fc-mobile', 'honor-of-kings', 'blood-strike', 'super-sus', 'efootball']);
                $regionFlag = $isBdRegion ? '🇧🇩' : '🌐';
                $regionName = $isBdRegion ? 'BD' : 'Global';
                $soldCount = $isFf ? '142k+ Sold' : ($isPubg ? '2.4k+ Sold' : ($isMlbb ? '42k+ Sold' : '5k+ Sold'));
                $ratingVal = '5.0';
            @endphp
            <div class="col filterable-card" data-category="{{ in_array($game->slug, ['free-fire', 'pubg-mobile', 'blood-strike']) ? 'battle-royale' : (in_array($game->slug, ['mobile-legends', 'honor-of-kings', 'valorant']) ? 'moba' : 'sports-rpg') }}">
                <a href="{{ route('game.show', $game->slug) }}" class="hp-mini-card h-100" title="{{ $game->title }} - Top-Up">
                    <div class="hp-mini-thumb hp-thumb-square">
                        @if($gameImg)
                            <img src="{{ $gameImg }}" alt="{{ $game->title }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <div class="hp-mini-thumb-inner" style="background: radial-gradient(circle, {{ $game->brand_color }}22 0%, transparent 80%);">
                                <i data-lucide="gamepad-2" style="width: 44px; height: 44px; color: {{ $game->brand_color }}; opacity: 0.7;"></i>
                            </div>
                        @endif

                        <!-- Region Flag Chip (Top Left) -->
                        <span class="hp-mini-flag-chip" title="Region: {{ $regionName }}">
                            <span>{{ $regionFlag }}</span>
                            <span>{{ $regionName }}</span>
                        </span>

                        <!-- Automated Delivery Badge (Top Right) -->
                        <span class="hp-mini-badge {{ str_contains(strtolower($game->tag_badge ?? ''), 'instant') ? '' : 'hot' }}">
                            ⚡ Auto
                        </span>
                    </div>

                    <div class="hp-mini-body">
                        <h2 class="hp-mini-title" title="{{ $game->title }}">{{ $game->title }}</h2>
                        
                        <div class="hp-mini-rating-row">
                            <span class="star-rating">★ {{ $ratingVal }}</span>
                            <span class="sold-count">{{ $soldCount }}</span>
                        </div>

                        <div class="hp-mini-priceline">
                            <span class="hp-mini-from">From</span>
                            <span class="hp-mini-price" data-bdt="{{ $game->base_price_bdt }}">&#2547; {{ number_format($game->base_price_bdt) }}</span>
                        </div>

                        <div class="hp-mini-actions-row">
                            <span class="hp-mini-btn w-100">
                                <span>Top-Up</span>
                                <i data-lucide="arrow-right" class="icon" style="width:13px;height:13px;"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

</div>
@endsection
