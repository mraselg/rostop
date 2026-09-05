@extends('layouts.app')

@section('title', 'RosTop - Game Top-Up, Sell Gift Cards for bKash/Nagad & Digital Subscriptions in Bangladesh')
@section('meta_description', 'RosTop (rostop.com) - Bangladesh\'s trusted platform for instant Free Fire & PUBG top-up, selling Paysafecard, Transcash & Apple gift cards for bKash/Nagad at 84-90% rates, plus Netflix & ChatGPT subscriptions.')

@push('preload')
    {{-- Preload first slide (LCP candidate) with responsive candidates matching the markup below --}}
    <link rel="preload" as="image" href="{{ asset('images/rostop_banner_topup-768w.webp') }}"
          imagesrcset="{{ asset('images/rostop_banner_topup-480w.webp') }} 480w, {{ asset('images/rostop_banner_topup-768w.webp') }} 768w, {{ asset('images/rostop_banner_topup-1280w.webp') }} 1280w"
          imagesizes="(max-width: 767.98px) 100vw, 680px" type="image/webp" fetchpriority="high">
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home-v2.css') }}?v={{ time() }}">
@endpush

@push('scripts')
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "How long does it take to receive bKash payment after selling a gift card?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Typically, after submitting your card code and details, our verification team checks the voucher within 15 to 45 minutes and transfers the BDT payment directly to your bKash, Nagad, or USDT wallet." }
        },
        {
          "@@type": "Question",
          "name": "Do I need to share my game password for Free Fire or PUBG top-up?",
          "acceptedAnswer": { "@@type": "Answer", "text": "No! Free Fire and PUBG top-ups do not require any password. You only provide your Player ID (UID) or Character ID, and the diamonds/UC will be credited directly to your account." }
        },
        {
          "@@type": "Question",
          "name": "Which payment methods are supported?",
          "acceptedAnswer": { "@@type": "Answer", "text": "We support bKash, Nagad, Rocket, Upay, SureCash, and international cryptocurrency USDT (TRC20 / BEP20) for both buying and cashouts." }
        },
        {
          "@@type": "Question",
          "name": "Do Netflix and ChatGPT subscriptions come with a warranty?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Yes! All our subscriptions come with a full-duration replacement guarantee. If any issue occurs, an immediate replacement profile or fix is provided via our WhatsApp support." }
        }
      ]
    }
    </script>
@endpush

@if(isset($trendingProducts) && $trendingProducts->count() > 0)
@push('schema')
    {!! \App\Support\SeoSchema::render([
        \App\Support\SeoSchema::itemList($trendingProducts, 'Trending Products'),
    ]) !!}
@endpush
@endif

@section('content')
<div class="hp-scope">

<!-- ===================== TOP SHOWCASE: TITLE + CATEGORIES + BANNER (IN SAME SECTION) ===================== -->
<section class="hp-top-showcase" aria-labelledby="hp-hero-heading">
    <div class="container-xxl">

        <!-- Top Section Header: Live Transactions Stream Only (View-Only, Steady LIVE Indicator) -->
        <div class="hp-top-header mb-3">
            <h1 class="visually-hidden" id="hp-hero-heading">RosTop - Instant Game Top-Up, Gift Cards & Digital Subscriptions</h1>
            <div class="hp-live-stream-bar" id="hp-live-stream-bar">
                <!-- Steady Icon Only ((•)) - Compact, No Text -->
                <div class="hp-live-steady-indicator" title="Live Transactions Stream" aria-label="Live">
                    <span class="hp-live-pulse-dot"></span>
                    <i data-lucide="radio" class="icon hp-live-radio-icon"></i>
                </div>

                <div class="hp-stream-divider"></div>

                <!-- Non-Clickable Vertical Sliding Ticker (ক্লিক করা যাবে না) -->
                <div class="hp-live-vertical-viewport" id="hp-live-viewport">
                    <div class="hp-live-vertical-track" id="hp-live-track">
                        @if(isset($liveTransactions) && $liveTransactions->count() > 0)
                            @foreach($liveTransactions as $index => $tx)
                                <div class="hp-live-vt-item">
                                    <span class="hp-live-vt-badge {{ $tx->category_class }}">{{ $tx->category_label }}</span>
                                    <span class="hp-live-vt-title">{{ $tx->product_title }}</span>
                                    <span class="hp-live-vt-amount">৳{{ number_format($tx->amount_bdt) }}</span>
                                    <span class="hp-live-vt-method">via {{ $tx->payment_method }}</span>
                                    <span class="hp-live-vt-time">{{ $tx->time_text }}</span>
                                    <span class="hp-live-vt-user">({{ $tx->customer_masked }})</span>
                                </div>
                            @endforeach
                        @else
                            <div class="hp-live-vt-item">
                                <span class="hp-live-vt-badge ticker-cat-topup">Top-Up</span>
                                <span class="hp-live-vt-title">Free Fire 115 Diamonds</span>
                                <span class="hp-live-vt-amount">৳85</span>
                                <span class="hp-live-vt-method">via bKash</span>
                                <span class="hp-live-vt-time">Just now</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Small Left / Right Navigation Controls for Slide -->
                <div class="hp-live-nav-controls" id="hp-live-nav-controls">
                    <button type="button" class="hp-live-nav-btn" id="hp-live-prev-btn" aria-label="Previous Transaction" title="Previous Transaction">
                        <i data-lucide="chevron-left" class="icon"></i>
                    </button>
                    <button type="button" class="hp-live-nav-btn" id="hp-live-next-btn" aria-label="Next Transaction" title="Next Transaction">
                        <i data-lucide="chevron-right" class="icon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- The Compact Responsive Banner Slider (Then hp-slide-overlay banner slider) -->
        <div class="hp-hero-compact-banner mb-3" id="hp-hero-slider" aria-roledescription="carousel">
            <div class="hp-slider-frame">
                <div class="hp-slider-track">
                    <!-- Slide 1: Game Top-Up -->
                    <div class="hp-slide active" data-index="0" role="group" aria-roledescription="slide" aria-label="1 of 4">
                        <a href="{{ route('game.topup') }}" class="hp-slide-link" title="Free Fire & PUBG In-Game Top-Up with bKash Nagad">
                            <picture>
                                <source type="image/webp"
                                    srcset="{{ asset('images/rostop_banner_topup-480w.webp') }} 480w, {{ asset('images/rostop_banner_topup-768w.webp') }} 768w, {{ asset('images/rostop_banner_topup-1280w.webp') }} 1280w"
                                    sizes="(max-width: 767.98px) 100vw, 1296px">
                                <img
                                    src="{{ asset('images/rostop_banner_topup-fallback.jpg') }}"
                                    srcset="{{ asset('images/rostop_banner_topup-fallback.jpg') }} 1280w"
                                    sizes="(max-width: 767.98px) 100vw, 1296px"
                                    alt="Instant Game Top-Up in Bangladesh - Free Fire Diamonds and PUBG Mobile UC Recharge"
                                    class="hp-slide-img"
                                    loading="eager"
                                    fetchpriority="high"
                                    width="1376"
                                    height="768">
                            </picture>
                            <div class="hp-slide-overlay">
                                <div class="hp-slide-top">
                                    <span class="hp-slide-badge hp-badge-emerald">
                                        <span class="hp-live-dot"></span> 60s UID Instant
                                    </span>
                                    <span class="hp-slide-badge hp-badge-glass">
                                        FF &bull; PUBG &bull; MLBB
                                    </span>
                                </div>
                                <div class="hp-slide-content">
                                    <h2 class="hp-slide-title">Direct In-Game Top-Up</h2>
                                    <p class="hp-slide-desc">115 Diamonds from &#2547;85 &bull; Instant Delivery via bKash & Nagad</p>
                                    <div class="hp-slide-action">
                                        <span class="hp-btn-slide hp-btn-emerald">
                                            <span>Top-Up Now</span> <i data-lucide="arrow-right" class="icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Slide 2: Sell Gift Cards -->
                    <div class="hp-slide" data-index="1" role="group" aria-roledescription="slide" aria-label="2 of 4">
                        <a href="{{ route('giftcards.sell') }}" class="hp-slide-link" title="Sell Paysafecard, Transcash & Apple Gift Cards for bKash Nagad">
                            <picture>
                                <source type="image/webp"
                                    srcset="{{ asset('images/rostop_banner_cashout-480w.webp') }} 480w, {{ asset('images/rostop_banner_cashout-768w.webp') }} 768w, {{ asset('images/rostop_banner_cashout-1280w.webp') }} 1280w"
                                    sizes="(max-width: 767.98px) 100vw, 1296px">
                                <img
                                    src="{{ asset('images/rostop_banner_cashout-fallback.jpg') }}"
                                    srcset="{{ asset('images/rostop_banner_cashout-fallback.jpg') }} 1280w"
                                    sizes="(max-width: 767.98px) 100vw, 1296px"
                                    alt="Sell Gift Cards in Bangladesh - Paysafecard, Transcash and Apple Cards for Instant bKash"
                                    class="hp-slide-img"
                                    loading="lazy"
                                    decoding="async"
                                    width="1376"
                                    height="768">
                            </picture>
                            <div class="hp-slide-overlay">
                                <div class="hp-slide-top">
                                    <span class="hp-slide-badge hp-badge-amber">
                                        <i data-lucide="wallet" class="icon"></i> Direct Cashout
                                    </span>
                                    <span class="hp-slide-badge hp-badge-glass">
                                        86%&ndash;90% Rates
                                    </span>
                                </div>
                                <div class="hp-slide-content">
                                    <h2 class="hp-slide-title">Sell Gift Cards for Instant Cash</h2>
                                    <p class="hp-slide-desc">Paysafecard, Transcash & Apple &bull; 15&ndash;45 Min Payout</p>
                                    <div class="hp-slide-action">
                                        <span class="hp-btn-slide hp-btn-amber">
                                            <span>Sell Cards Now</span> <i data-lucide="arrow-right" class="icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Slide 3: OTT Subscriptions -->
                    <div class="hp-slide" data-index="2" role="group" aria-roledescription="slide" aria-label="3 of 4">
                        <a href="{{ route('subscriptions') }}" class="hp-slide-link" title="Buy Netflix Premium 4K UHD, ChatGPT Plus, Canva Pro in Bangladesh">
                            <picture>
                                <source type="image/webp"
                                    srcset="{{ asset('images/rostop_banner_ott-480w.webp') }} 480w, {{ asset('images/rostop_banner_ott-768w.webp') }} 768w, {{ asset('images/rostop_banner_ott-1280w.webp') }} 1280w"
                                    sizes="(max-width: 767.98px) 100vw, 1296px">
                                <img
                                    src="{{ asset('images/rostop_banner_ott-fallback.jpg') }}"
                                    srcset="{{ asset('images/rostop_banner_ott-fallback.jpg') }} 1280w"
                                    sizes="(max-width: 767.98px) 100vw, 1296px"
                                    alt="Buy Netflix Premium 4K and ChatGPT Plus in Bangladesh with Replacement Warranty"
                                    class="hp-slide-img"
                                    loading="lazy"
                                    decoding="async"
                                    width="1376"
                                    height="768">
                            </picture>
                            <div class="hp-slide-overlay">
                                <div class="hp-slide-top">
                                    <span class="hp-slide-badge hp-badge-indigo">
                                        <i data-lucide="tv" class="icon"></i> 100% Replacement Warranty
                                    </span>
                                    <span class="hp-slide-badge hp-badge-glass">
                                        Netflix &bull; ChatGPT
                                    </span>
                                </div>
                                <div class="hp-slide-content">
                                    <h2 class="hp-slide-title">Digital Subscriptions & AI Pro</h2>
                                    <p class="hp-slide-desc">Netflix UHD &#2547;280/mo &bull; ChatGPT Plus Shared & Private</p>
                                    <div class="hp-slide-action">
                                        <span class="hp-btn-slide hp-btn-indigo">
                                            <span>Get Subscription</span> <i data-lucide="arrow-right" class="icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Slide 4: Buy Gift Cards -->
                    <div class="hp-slide" data-index="3" role="group" aria-roledescription="slide" aria-label="4 of 4">
                        <a href="{{ route('giftcards.buy') }}" class="hp-slide-link" title="Buy Google Play, Steam, PlayStation Digital Gift Cards in Bangladesh">
                            <picture>
                                <source type="image/webp"
                                    srcset="{{ asset('images/rostop_banner_buy-480w.webp') }} 480w, {{ asset('images/rostop_banner_buy-768w.webp') }} 768w, {{ asset('images/rostop_banner_buy-1280w.webp') }} 1280w"
                                    sizes="(max-width: 767.98px) 100vw, 1296px">
                                <img
                                    src="{{ asset('images/rostop_banner_buy-fallback.jpg') }}"
                                    srcset="{{ asset('images/rostop_banner_buy-fallback.jpg') }} 1280w"
                                    sizes="(max-width: 767.98px) 100vw, 1296px"
                                    alt="Buy Google Play Gift Cards and Steam Wallet Codes with bKash and Nagad"
                                    class="hp-slide-img"
                                    loading="lazy"
                                    decoding="async"
                                    width="1376"
                                    height="768">
                            </picture>
                            <div class="hp-slide-overlay">
                                <div class="hp-slide-top">
                                    <span class="hp-slide-badge hp-badge-cyan">
                                        <i data-lucide="gift" class="icon"></i> 100% Genuine Digital Codes
                                    </span>
                                    <span class="hp-slide-badge hp-badge-glass">
                                        Google Play &bull; Steam
                                    </span>
                                </div>
                                <div class="hp-slide-content">
                                    <h2 class="hp-slide-title">Buy Global Gift Cards Locally</h2>
                                    <p class="hp-slide-desc">Google Play, Steam & Apple Codes &bull; Instant Code Delivery</p>
                                    <div class="hp-slide-action">
                                        <span class="hp-btn-slide hp-btn-cyan">
                                            <span>Buy Gift Cards</span> <i data-lucide="arrow-right" class="icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Arrow navigation -->
                <button type="button" class="hp-slider-nav hp-slider-prev" id="hp-slide-prev-btn" aria-label="Previous Slide">
                    <i data-lucide="chevron-left" class="icon"></i>
                </button>
                <button type="button" class="hp-slider-nav hp-slider-next" id="hp-slide-next-btn" aria-label="Next Slide">
                    <i data-lucide="chevron-right" class="icon"></i>
                </button>

                <!-- Dot pagination -->
                <div class="hp-slider-dots">
                    <button type="button" class="hp-dot active" data-slide="0" aria-label="Go to slide 1"></button>
                    <button type="button" class="hp-dot" data-slide="1" aria-label="Go to slide 2"></button>
                    <button type="button" class="hp-dot" data-slide="2" aria-label="Go to slide 3"></button>
                    <button type="button" class="hp-dot" data-slide="3" aria-label="Go to slide 4"></button>
                </div>
            </div>
        </div>

        <!-- 6 Category Quick Tiles (Then hp-top-cats-grid mb-3) -->
        <div class="hp-top-cats-grid mb-3">
            <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6 g-2">
                <div class="col">
                    <a href="{{ route('game.topup') }}" class="hp-top-cat-card">
                        <div class="hp-top-cat-icon icon-emerald">
                            <i data-lucide="gamepad-2" class="icon"></i>
                        </div>
                        <div class="hp-top-cat-info">
                            <span class="hp-top-cat-title">Game Top-Up</span>
                            <span class="hp-top-cat-sub">FF, PUBG, MLBB</span>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('giftcards.sell') }}" class="hp-top-cat-card hp-top-cat-amber">
                        <div class="hp-top-cat-icon icon-amber">
                            <i data-lucide="wallet" class="icon"></i>
                        </div>
                        <div class="hp-top-cat-info">
                            <span class="hp-top-cat-title text-amber">Sell Cards</span>
                            <span class="hp-top-cat-sub text-amber-sub">84–90% Cashout</span>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('subscriptions') }}" class="hp-top-cat-card">
                        <div class="hp-top-cat-icon icon-indigo">
                            <i data-lucide="tv" class="icon"></i>
                        </div>
                        <div class="hp-top-cat-info">
                            <span class="hp-top-cat-title">Subscriptions</span>
                            <span class="hp-top-cat-sub">Netflix, ChatGPT</span>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('giftcards.buy') }}" class="hp-top-cat-card">
                        <div class="hp-top-cat-icon icon-cyan">
                            <i data-lucide="gift" class="icon"></i>
                        </div>
                        <div class="hp-top-cat-info">
                            <span class="hp-top-cat-title">Buy Gift Cards</span>
                            <span class="hp-top-cat-sub">Apple, Steam, PSN</span>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('digital.products') }}" class="hp-top-cat-card">
                        <div class="hp-top-cat-icon icon-sky">
                            <i data-lucide="key-round" class="icon"></i>
                        </div>
                        <div class="hp-top-cat-info">
                            <span class="hp-top-cat-title">Software</span>
                            <span class="hp-top-cat-sub">Windows, Office</span>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('digital.products') }}" class="hp-top-cat-card">
                        <div class="hp-top-cat-icon icon-purple">
                            <i data-lucide="wrench" class="icon"></i>
                        </div>
                        <div class="hp-top-cat-info">
                            <span class="hp-top-cat-title">More Tools</span>
                            <span class="hp-top-cat-sub">VPN, AI, Utilities</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@php
    $gamePackagesData = [];
    foreach ($gameTopups as $g) {
        $gamePackagesData[$g->slug] = $g->packages->map(function($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'price' => (float)$p->price_bdt,
            ];
        })->values()->all();
    }
    $firstGame = $gameTopups->first();
    $firstPkg = $firstGame && $firstGame->packages->count() ? $firstGame->packages->first() : null;

    /* Official brand logo assets (public/images/brands) mapped per product slug */
    $brandIcons = [
        // Game top-ups
        'free-fire' => 'free-fire.svg', 'pubg-mobile' => 'pubg.svg', 'mobile-legends' => 'mlbb.svg',
        'valorant' => 'valorant.svg', 'blood-strike' => 'blood-strike.svg', 'clash-of-clans' => 'coc.svg',
        'efootball' => 'efootball.svg', 'fc-mobile' => 'fc-mobile.svg', 'genshin-impact' => 'genshin.svg',
        'honor-of-kings' => 'hok.svg', 'roblox' => 'roblox.svg', 'super-sus' => 'super-sus.svg',
        // Gift cards (buy)
        'apple-gift-card' => 'apple.svg', 'google-play-us' => 'googleplay.svg', 'steam-wallet' => 'steam.svg',
        // Subscriptions / OTT / AI
        'netflix-premium' => 'netflix.svg', 'chatgpt-plus' => 'openai.svg', 'chatgpt-go-coupon' => 'openai.svg',
        'gemini-advanced' => 'googlebard.svg', 'super-grok' => 'xai.svg', 'elevenlabs-pro' => 'elevenlabs.svg',
        'framer-ai' => 'framer.svg', 'canva-pro' => 'canva.svg', 'canva-pro-admin-panel' => 'canva.svg',
        'canva-pro-edu-invite' => 'canva.svg', 'capcut-pro' => 'capcut.svg', 'capcut-pro-admin-team' => 'capcut.svg',
        'capcut-pro-slots' => 'capcut.svg', 'adobe-express-premium' => 'adobe.svg', 'figma-pro-education' => 'figma.svg',
        'envato-elements' => 'envato.svg', 'youtube-premium' => 'youtube.svg', 'amazon-prime-video' => 'primevideo.svg',
        'hbo-max' => 'hbomax.svg', 'paramount-peacock' => 'paramountplus.svg', 'coursera-edx-premium' => 'coursera.svg',
        // Software & utilities
        'windows-11-pro' => 'windows11.svg', 'microsoft-365' => 'microsoftoffice.svg', 'ilovepdf-premium' => 'ilovepdf.svg',
        'notion-plus-business' => 'notion.svg', 'miro-premium' => 'miro.svg', 'jetbrains-edu-pack' => 'jetbrains.svg',
        'autodesk-all-apps' => 'autodesk.svg', 'surfshark-vpn' => 'surfshark.svg', 'avira-prime' => 'avira.svg',
        'gmail-verified-accounts' => 'gmail.svg', 'telegram-aged-account' => 'telegram.svg',
        'outlook-hotmail-accounts' => 'microsoftoutlook.svg',
    ];
@endphp

<!-- ===================== RATE CALCULATOR & QUICK TOOLS HUB ===================== -->
<section class="hp-calc-section" aria-label="Gift Card Rate Calculator and Quick Tools Hub">
    <div class="container-xxl">

        <!-- Section Header (SEO-Rich H2 + Bilingual Subtitle) -->
        <div class="hp-dual-header mb-3">
            <div class="hp-section-tag mb-1">
                <i data-lucide="sparkles" class="icon" style="width:13px;height:13px;"></i>
                <span>⚡ Rate &amp; Quick Tools Hub</span>
            </div>
            <h2 class="hp-section-title mb-1">Gift Card Rate Calculator &amp; Quick Tools</h2>
            <p class="hp-hero-subtitle m-0 small" style="color:var(--text-muted);">
                ক্যালকুলেটর, প্রাইজ চেক ও কনভার্টার — মোবাইলে ডানে-বামে স্লাইড করুন
            </p>
        </div>

        <!-- Mobile Dual Tab Bar (Visible on <992px, Hidden on Desktop) -->
        <div class="hp-dual-tabs d-lg-none mb-3" role="tablist" aria-label="Calculator and quick tools">
            <button type="button" class="hp-dual-tab active" id="hp-tab-calc" role="tab" aria-controls="hp-dual-panel-calc" aria-selected="true" data-index="0">
                <i data-lucide="calculator" class="icon"></i>
                <div class="hp-dual-tab-text">
                    <span class="hp-dual-tab-main">Rate Calculator</span>
                    <span class="hp-dual-tab-sub">রেট ক্যালকুলেটর</span>
                </div>
            </button>
            <button type="button" class="hp-dual-tab" id="hp-tab-tools" role="tab" aria-controls="hp-dual-panel-tools" aria-selected="false" data-index="1">
                <i data-lucide="wrench" class="icon"></i>
                <div class="hp-dual-tab-text">
                    <span class="hp-dual-tab-main">Quick Tools</span>
                    <span class="hp-dual-tab-sub">দ্রুত টুলস</span>
                </div>
            </button>
        </div>

        <!-- Dual Terminal Viewport & Track -->
        <div class="hp-dual-viewport">
            <div class="row g-3 g-lg-4 align-items-stretch hp-dual-track" id="hp-dual-track" data-active-index="0">

                <!-- Panel 1 (Position 1): Rate Calculator Card (col-lg-7) -->
                <div class="col-12 col-lg-7 hp-dual-panel" id="hp-dual-panel-calc" role="tabpanel" aria-labelledby="hp-tab-calc">
                    <div class="hp-calc-card" role="region" aria-label="Exchange rate calculator">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="hp-calc-title">
                                <i data-lucide="calculator" class="icon" style="color:var(--primary); width:18px; height:18px;"></i>
                                <span>Rate Calculator</span>
                            </div>
                            <span class="hp-live-tag">Live Rates</span>
                        </div>

                        <div class="hp-calc-tabs" role="tablist" aria-label="Calculator mode">
                            <button type="button" id="tab-calc-sell" class="hp-calc-tab active sell-tab" role="tab" aria-selected="true">
                                <i data-lucide="wallet" class="icon" style="width:15px;height:15px;"></i><span>Sell Cards (Get BDT)</span>
                            </button>
                            <button type="button" id="tab-calc-buy" class="hp-calc-tab buy-tab" role="tab" aria-selected="false">
                                <i data-lucide="gift" class="icon" style="width:15px;height:15px;"></i><span>Buy Gift Cards</span>
                            </button>
                        </div>

                        <div class="mb-3">
                            <label for="calc-brand" class="form-label fw-bold small mb-1" style="color: var(--text-secondary);">1. Select Brand / Voucher</label>
                            <select id="calc-brand" class="form-select">
                                <option value="apple" selected>Apple / iTunes (US/Global)</option>
                                <option value="google-play">Google Play Store</option>
                                <option value="paysafecard">Paysafecard Cash PIN</option>
                                <option value="transcash">Transcash Top-up (France/EU)</option>
                                <option value="neosurf">Neosurf Cash Voucher</option>
                                <option value="pcs">PCS Mastercard Coupon</option>
                                <option value="razer-gold">Razer Gold PIN (Global)</option>
                                <option value="steam">Steam Wallet Card</option>
                                <option value="amazon">Amazon Gift Card (US/UK)</option>
                                <option value="roblox">Roblox Digital Card</option>
                            </select>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-5">
                                <label for="calc-currency" class="form-label fw-bold small mb-1" style="color: var(--text-secondary);">Currency</label>
                                <select id="calc-currency" class="form-select">
                                    <option value="USD">USD ($)</option>
                                    <option value="EUR">EUR (&euro;)</option>
                                    <option value="GBP">GBP (&pound;)</option>
                                </select>
                            </div>
                            <div class="col-7">
                                <label for="calc-amount" class="form-label fw-bold small mb-1" style="color: var(--text-secondary);">Face Value</label>
                                <input type="number" id="calc-amount" class="form-control" value="50" min="5" max="1000" step="5" inputmode="numeric">
                            </div>
                        </div>

                        <div class="hp-calc-payout" aria-live="polite">
                            <div style="min-width: 0;">
                                <div class="hp-payout-label">Estimated Payout in BDT</div>
                                <span id="calc-rate-badge" class="hp-payout-rate payout-rate-badge">We pay you 88%</span>
                            </div>
                            <div id="calc-payout-total" class="hp-payout-val payout-total-amount">
                                &#2547; 5,478
                            </div>
                        </div>

                        <button type="button" id="calc-action-btn" class="hp-btn hp-btn-sell w-100">
                            <span>Sell Apple Card Now</span>
                            <i data-lucide="arrow-right" class="icon" style="width:16px;height:16px;"></i>
                        </button>

                    </div>
                </div>

                <!-- Panel 2 (Position 2): Quick Tools Hub (col-lg-5) -->
                <div class="col-12 col-lg-5 hp-dual-panel" id="hp-dual-panel-tools" role="tabpanel" aria-labelledby="hp-tab-tools">
                    <div class="hp-qt-card" role="region" aria-label="Quick Tools Hub">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="hp-calc-title">
                                <i data-lucide="wrench" class="icon" style="color:var(--vb-orange); width:18px; height:18px;"></i>
                                <span>Quick Tools</span>
                            </div>
                            <span class="hp-live-tag" style="background:rgba(255,140,0,0.12); color:var(--vb-orange); border-color:rgba(255,140,0,0.28);">
                                <i data-lucide="zap" style="width:11px;height:11px;"></i> Free Tools
                            </span>
                        </div>

                        <!-- Mini Pill Tabs -->
                        <div class="hp-qt-tabs mb-3" role="tablist" aria-label="Quick tools tabs">
                            <button type="button" class="hp-qt-tab active" data-pane="hp-qt-pane-price" role="tab" aria-selected="true">
                                <span>💎 Price Check</span>
                            </button>
                            <button type="button" class="hp-qt-tab" data-pane="hp-qt-pane-usdt" role="tab" aria-selected="false">
                                <span>💵 USDT ⇄ BDT</span>
                            </button>
                            <button type="button" class="hp-qt-tab" data-pane="hp-qt-pane-rates" role="tab" aria-selected="false">
                                <span>📊 Live Rates</span>
                            </button>
                        </div>

                        <!-- Pane 1: Top-Up Price Check -->
                        <div class="hp-qt-pane active" id="hp-qt-pane-price" role="tabpanel">
                            <div class="mb-2">
                                <label for="hp-qt-game" class="form-label fw-bold small mb-1" style="color: var(--text-secondary);">Select Game</label>
                                <select id="hp-qt-game" class="form-select">
                                    @foreach($gameTopups as $g)
                                        <option value="{{ $g->slug }}">{{ $g->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="hp-qt-package" class="form-label fw-bold small mb-1" style="color: var(--text-secondary);">Select Package</label>
                                <select id="hp-qt-package" class="form-select">
                                    @if($firstGame)
                                        @foreach($firstGame->packages as $pkg)
                                            <option value="{{ $pkg->name }}" data-price="{{ (float)$pkg->price_bdt }}">{{ $pkg->name }} — ৳{{ number_format($pkg->price_bdt) }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="hp-qt-result mb-3" aria-live="polite">
                                <div>
                                    <div class="hp-payout-label" id="hp-qt-pkg-name">{{ $firstPkg->name ?? 'Select Package' }}</div>
                                    <span class="hp-payout-rate payout-rate-badge" style="background:rgba(255,140,0,0.15); color:var(--vb-orange);">Instant Recharge</span>
                                </div>
                                <div class="hp-payout-val" id="hp-qt-pkg-price" style="color:var(--vb-orange);">
                                    &#2547; {{ $firstPkg ? number_format($firstPkg->price_bdt) : '0' }}
                                </div>
                            </div>

                            <a id="hp-qt-go" href="{{ $firstGame ? route('game.show', $firstGame->slug) . ($firstPkg ? '?pkg=' . urlencode($firstPkg->name) : '') : '#' }}" class="hp-btn hp-btn-primary w-100" style="min-height:42px;">
                                <span>টপ-আপ পেজে কনফার্ম করুন</span>
                                <i data-lucide="arrow-right" class="icon" style="width:16px;height:16px;"></i>
                            </a>

                            <script type="application/json" id="hp-qt-packages">@json($gamePackagesData)</script>
                        </div>

                        <!-- Pane 2: USDT Converter -->
                        <div class="hp-qt-pane" id="hp-qt-pane-usdt" role="tabpanel">
                            <div class="d-flex gap-2 mb-3">
                                <button type="button" class="hp-qt-dir-btn active flex-fill" id="hp-qt-dir-usdt2bdt">USDT → BDT</button>
                                <button type="button" class="hp-qt-dir-btn flex-fill" id="hp-qt-dir-bdt2usdt">BDT → USDT</button>
                            </div>

                            <div class="mb-3">
                                <label for="hp-qt-usdt-amount" id="hp-qt-usdt-label" class="form-label fw-bold small mb-1" style="color: var(--text-secondary);">USDT Amount ($)</label>
                                <input type="number" id="hp-qt-usdt-amount" class="form-control" value="10" min="1" step="any" inputmode="decimal">
                            </div>

                            <div class="hp-qt-result mb-3" aria-live="polite">
                                <div>
                                    <div class="hp-payout-label" id="hp-qt-usdt-sublabel">Approximate Value</div>
                                    <span class="hp-payout-rate payout-rate-badge">1 USDT ≈ ৳128</span>
                                </div>
                                <div class="hp-payout-val" id="hp-qt-usdt-result" style="color:var(--vb-emerald);">
                                    &#2547; 1,280.00
                                </div>
                            </div>

                            <div class="hp-qt-footnote mt-2 text-center">
                                <i data-lucide="info" class="icon" style="width:12px;height:12px;"></i>
                                <span>আনুমানিক রেট ১ USDT ≈ ৳128 — লাইভ রেট ওয়াটসঅ্যাপে জেনে নিন</span>
                            </div>
                        </div>

                        <!-- Pane 3: Live Rates -->
                        <div class="hp-qt-pane" id="hp-qt-pane-rates" role="tabpanel">
                            <div class="hp-qt-rates-list mb-2">
                                <div class="hp-qt-rate-row">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="hp-qt-rate-avatar" style="background:rgba(2,132,199,0.18); color:#38BDF8;">P</div>
                                        <span class="hp-qt-rate-name">Paysafecard PIN</span>
                                    </div>
                                    <span class="hp-qt-rate-chip badge-numeric">Sell 86%</span>
                                </div>
                                <div class="hp-qt-rate-row">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="hp-qt-rate-avatar" style="background:rgba(234,88,12,0.18); color:#FB923C;">T</div>
                                        <span class="hp-qt-rate-name">Transcash Top-up</span>
                                    </div>
                                    <span class="hp-qt-rate-chip badge-numeric">Sell 90%</span>
                                </div>
                                <div class="hp-qt-rate-row">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="hp-qt-rate-avatar" style="background:rgba(148,163,184,0.18); color:#E2E8F0;">A</div>
                                        <span class="hp-qt-rate-name">Apple / iTunes</span>
                                    </div>
                                    <span class="hp-qt-rate-chip badge-numeric">Sell 88%</span>
                                </div>
                                <div class="hp-qt-rate-row">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="hp-qt-rate-avatar" style="background:rgba(168,85,247,0.18); color:#C084FC;">N</div>
                                        <span class="hp-qt-rate-name">Neosurf Cash</span>
                                    </div>
                                    <span class="hp-qt-rate-chip badge-numeric">Sell 84%</span>
                                </div>
                                <div class="hp-qt-rate-row">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="hp-qt-rate-avatar" style="background:rgba(34,197,94,0.18); color:#4ADE80;">G</div>
                                        <span class="hp-qt-rate-name">Google Play / Steam</span>
                                    </div>
                                    <span class="hp-qt-rate-chip badge-ask">Ask Rate</span>
                                </div>
                                <div class="hp-qt-rate-row">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="hp-qt-rate-avatar" style="background:rgba(234,179,8,0.18); color:#FACC15;">R</div>
                                        <span class="hp-qt-rate-name">Razer Gold / Amazon</span>
                                    </div>
                                    <span class="hp-qt-rate-chip badge-ask">Ask Rate</span>
                                </div>
                            </div>
                            <div class="hp-qt-footnote text-center">
                                <i data-lucide="info" class="icon" style="width:12px;height:12px;"></i>
                                <span>রেট প্রতিদিন পরিবর্তিত হয় — কনফার্ম করতে WhatsApp করুন</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Mobile Dual Footer (Dots & Swipe Hint, Hidden >=992px) -->
        <div class="hp-dual-footer d-lg-none mt-2 mb-3">
            <div class="hp-dual-dots" role="tablist" aria-label="Terminal slider dots">
                <button type="button" class="hp-dual-dot active" data-index="0" aria-label="Show Rate Calculator section"></button>
                <button type="button" class="hp-dual-dot" data-index="1" aria-label="Show Quick Tools section"></button>
            </div>
            <div class="hp-dual-swipe-hint">
                <i data-lucide="chevrons-left-right" class="icon" style="width:14px;height:14px;"></i>
                <span>ডানে-বামে স্লাইড করুন</span>
            </div>
        </div>

        <!-- Trust & Security Strip -->
        <div class="hp-hero-trust-strip mt-3" aria-label="Platform Trust and Payment Methods">
            <div class="hp-trust-strip-left">
                <span class="hp-trust-strip-item">
                    <i data-lucide="zap" class="icon" style="color:var(--vb-orange); width:15px; height:15px;"></i>
                    <span>~60s UID Top-Up</span>
                </span>
                <span class="hp-trust-divider" style="height:14px;"></span>
                <span class="hp-trust-strip-item">
                    <i data-lucide="clock" class="icon" style="color:var(--vb-emerald); width:15px; height:15px;"></i>
                    <span>15-45m bKash Cashout</span>
                </span>
                <span class="hp-trust-divider" style="height:14px;"></span>
                <span class="hp-trust-strip-item">
                    <i data-lucide="shield-check" class="icon" style="color:#06B6D4; width:15px; height:15px;"></i>
                    <span>100% Direct Escrow</span>
                </span>
            </div>
            <div class="hp-trust-strip-right">
                <span class="rate-tag">Paysafecard <strong>86%</strong></span>
                <span class="rate-tag">Transcash <strong>90%</strong></span>
                <span class="rate-tag">Apple <strong>88%</strong></span>
                <div class="d-none d-sm-inline-flex align-items-center gap-1 ms-1">
                    <div class="hp-pay-pill py-0 px-2" style="font-size:0.72rem; min-height:24px;"><span class="hp-pill-dot hp-dot-bkash"></span><span>bKash</span></div>
                    <div class="hp-pay-pill py-0 px-2" style="font-size:0.72rem; min-height:24px;"><span class="hp-pill-dot hp-dot-nagad"></span><span>Nagad</span></div>
                    <div class="hp-pay-pill py-0 px-2" style="font-size:0.72rem; min-height:24px;"><span class="hp-pill-dot hp-dot-usdt"></span><span>USDT</span></div>
                </div>
            </div>
        </div>

    </div>
</section>

@if(isset($trendingProducts) && $trendingProducts->count() > 0)
<!-- ===================== TRENDING / TOP-SOLD PRODUCTS ===================== -->
<section class="hp-section animate-in" aria-labelledby="hp-trending-heading">
    <div class="container-xxl">
        <div class="d-flex align-items-end justify-content-between gap-2 mb-3">
            <div>
                <div class="hp-section-tag hp-tag-amber">
                    <i data-lucide="flame" class="icon" style="width:14px;height:14px;"></i>
                    <span>Top Sellers Across Categories</span>
                </div>
                <h2 class="hp-section-title" id="hp-trending-heading">Trending Products</h2>
                <p class="hp-section-desc bn">সবচেয়ে বেশি বিক্রি হওয়া এআই টুলস, ওটিটি ও সফটওয়্যার — নতুন সার্ভিস এক জায়গায়</p>
            </div>
            <a href="{{ route('subscriptions') }}" class="hp-view-all">
                <span>View All</span>
                <i data-lucide="arrow-right" class="icon" style="width:14px;height:14px;"></i>
            </a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-3 tr-rail">
            @foreach($trendingProducts as $tp)
                @php
                    $tpRoute = match(optional($tp->category)->type) {
                        'game_topup' => route('game.show', $tp->slug),
                        'subscription' => route('subscriptions.show', $tp->slug),
                        'software' => route('digital.products.show', $tp->slug),
                        'giftcard_buy' => route('giftcards.buy.show', $tp->slug),
                        default => route('product.show', $tp->slug),
                    };
                    $tpIcons = [
                        'netflix-premium' => 'tv',
                        'chatgpt-plus' => 'bot',
                        'canva-pro' => 'palette',
                        'capcut-pro' => 'clapperboard',
                        'gemini-advanced' => 'sparkles',
                        'youtube-premium' => 'youtube',
                        'windows-11-pro' => 'monitor',
                        'super-grok' => 'zap',
                        'microsoft-365' => 'briefcase',
                    ];
                    $tpIcon = $tpIcons[$tp->slug] ?? (optional($tp->category)->type === 'software' ? 'key-round' : 'tv');
                    $tpCatLabels = [
                        'netflix-premium' => 'OTT',
                        'chatgpt-plus' => 'AI Tool',
                        'canva-pro' => 'Design',
                        'capcut-pro' => 'Video Editing',
                        'gemini-advanced' => 'AI Tool',
                        'youtube-premium' => 'OTT',
                        'windows-11-pro' => 'Software',
                        'super-grok' => 'AI Tool',
                        'microsoft-365' => 'Software',
                    ];
                    $tpCatLabel = $tpCatLabels[$tp->slug] ?? (optional($tp->category)->name ?? 'Digital');
                    $tpSold = [
                        'netflix-premium' => '28k+ Sold',
                        'chatgpt-plus' => '19k+ Sold',
                        'canva-pro' => '35k+ Sold',
                        'capcut-pro' => '21k+ Sold',
                        'gemini-advanced' => '9.5k+ Sold',
                        'youtube-premium' => '12k+ Sold',
                        'windows-11-pro' => '7.8k+ Sold',
                        'super-grok' => '4.2k+ Sold',
                        'microsoft-365' => '6.2k+ Sold',
                    ];
                    $tpSoldCount = $tpSold[$tp->slug] ?? '5k+ Sold';
                    $tpCheapest = $tp->packages->sortBy('price_bdt')->first();
                    $tpOriginal = $tpCheapest?->original_price_bdt;
                @endphp
                <div class="col">
                    <a href="{{ $tpRoute }}" class="tr-card h-100" title="{{ $tp->title }}" style="--tr-brand: {{ $tp->brand_color }};">
                        <span class="tr-card-glow" aria-hidden="true"></span>

                        <!-- Netflix-style Rank Number -->
                        <span class="tr-rank" aria-label="Trending rank {{ $loop->iteration }}">#{{ $loop->iteration }}</span>

                        <div class="tr-card-top">
                            <span class="tr-icon-tile">
                                @if(isset($brandIcons[$tp->slug]))
                                    <img src="{{ asset('images/brands/' . $brandIcons[$tp->slug]) }}" class="hp-brand-logo" width="30" height="30" loading="lazy" decoding="async" alt="{{ $tp->title }} brand logo">
                                @else
                                    <i data-lucide="{{ $tpIcon }}" class="icon"></i>
                                @endif
                            </span>
                            <div class="tr-card-headside">
                                <span class="tr-cat-chip">{{ $tpCatLabel }}</span>
                                @if($tp->tag_badge)
                                    <span class="tr-hot-chip">
                                        <i data-lucide="flame" style="width:10px;height:10px;"></i>
                                        <span>{{ $tp->tag_badge }}</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <h3 class="tr-card-title" title="{{ $tp->title }}">{{ $tp->title }}</h3>

                        <div class="tr-card-meta">
                            <span class="tr-meta-rating">★ 4.9</span>
                            <span class="tr-meta-dot" aria-hidden="true"></span>
                            <span class="tr-meta-sold">{{ $tpSoldCount }}</span>
                        </div>

                        <div class="tr-card-price">
                            <div class="tr-price-left">
                                <span class="tr-price-from">From</span>
                                <span class="tr-price-value" data-bdt="{{ $tp->base_price_bdt }}">&#2547;{{ number_format($tp->base_price_bdt) }}</span>
                            </div>
                            @if($tpOriginal && $tpOriginal > $tp->base_price_bdt)
                                <span class="tr-price-old">&#2547;{{ number_format($tpOriginal) }}</span>
                            @endif
                        </div>

                        <span class="tr-card-cta">
                            <span>Order Now</span>
                            <i data-lucide="arrow-right" class="icon" style="width:13px;height:13px;"></i>
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ===================== GAMES TOP-UP ===================== -->
<section class="hp-section animate-in" aria-labelledby="hp-topup-heading">
    <div class="container-xxl">
        <div class="d-flex align-items-end justify-content-between gap-2 mb-3">
            <div>
                <div class="hp-section-tag">
                    <i data-lucide="gamepad-2" class="icon" style="width:14px;height:14px;"></i>
                    <span>Instant UID Recharge</span>
                </div>
                <h2 class="hp-section-title" id="hp-topup-heading">Games Top-Up</h2>
            </div>
            <a href="{{ route('game.topup') }}" class="hp-view-all">
                <span>View All</span>
                <i data-lucide="arrow-right" class="icon" style="width:14px;height:14px;"></i>
            </a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-3">
            @foreach($gameTopups as $game)
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
                <div class="col">
                    <a href="{{ route('game.show', $game->slug) }}" class="hp-mini-card h-100" title="{{ $game->title }} - Top-Up">
                        <div class="hp-mini-thumb hp-thumb-square">
                            @if($gameImg)
                                <img src="{{ $gameImg }}" alt="{{ $game->title }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div class="hp-mini-thumb-inner" style="background: radial-gradient(circle, {{ $game->brand_color }}22 0%, transparent 80%);">
                                    @if(isset($brandIcons[$game->slug]))
                                        <img src="{{ asset('images/brands/' . $brandIcons[$game->slug]) }}" class="hp-brand-logo" width="46" height="46" loading="lazy" decoding="async" alt="{{ $game->title }} logo">
                                    @else
                                        <i data-lucide="gamepad-2" style="width: 38px; height: 38px; color: {{ $game->brand_color }}; opacity: 0.7;"></i>
                                    @endif
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
                            <h3 class="hp-mini-title" title="{{ $game->title }}">{{ $game->title }}</h3>
                            
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
</section>

<!-- ===================== SELL GIFT CARDS ===================== -->
<section class="container-xxl animate-in" aria-labelledby="hp-sell-heading">
    <div class="hp-sell-section">
        <div class="d-flex align-items-end justify-content-between gap-2 mb-3">
            <div>
                <div class="hp-section-tag hp-tag-amber">
                    <i data-lucide="trending-up" class="icon" style="width:14px;height:14px;"></i>
                    <span>Fixed Exchange Rates</span>
                </div>
                <h2 class="hp-section-title" id="hp-sell-heading">Sell Vouchers & Gift Cards for BDT</h2>
                <p class="hp-section-desc">Payment to bKash & Nagad within 15&ndash;45 minutes of verification.</p>
            </div>
            <a href="{{ route('giftcards.sell') }}" class="hp-rate-btn text-decoration-none">
                <span>Sell Now</span>
                <i data-lucide="arrow-right" class="icon" style="width:14px;height:14px;"></i>
            </a>
        </div>

        <div class="hp-rates-scroll">
            <a href="{{ route('giftcards.sell', ['brand' => 'paysafecard']) }}" class="hp-rate-card">
                <div class="hp-rate-top">
                    <div class="hp-rate-avatar" style="background: linear-gradient(135deg, #008ACA, #005A8C);" aria-hidden="true">P</div>
                    <div class="text-truncate">
                        <div class="hp-rate-name">Paysafecard</div>
                        <div class="hp-rate-info">16-Digit Cash PIN (EUR)</div>
                    </div>
                </div>
                <div class="hp-rate-bottom">
                    <div class="hp-rate-pct">86%</div>
                    <span class="hp-rate-btn">
                        <span>Sell</span>
                        <i data-lucide="arrow-right" class="icon" style="width:12px;height:12px;"></i>
                    </span>
                </div>
            </a>

            <a href="{{ route('giftcards.sell', ['brand' => 'transcash']) }}" class="hp-rate-card">
                <div class="hp-rate-top">
                    <div class="hp-rate-avatar" style="background: linear-gradient(135deg, #D6001C, #8C0012);" aria-hidden="true">T</div>
                    <div class="text-truncate">
                        <div class="hp-rate-name">Transcash</div>
                        <div class="hp-rate-info">Top-up Code &euro;20&ndash;500</div>
                    </div>
                </div>
                <div class="hp-rate-bottom">
                    <div class="hp-rate-pct" style="color: var(--primary);">90%</div>
                    <span class="hp-rate-btn">
                        <span>Sell</span>
                        <i data-lucide="arrow-right" class="icon" style="width:12px;height:12px;"></i>
                    </span>
                </div>
            </a>

            <a href="{{ route('giftcards.sell', ['brand' => 'apple']) }}" class="hp-rate-card">
                <div class="hp-rate-top">
                    <div class="hp-rate-avatar" style="background: #111827; border: 1px solid rgba(255,255,255,0.15);">
                        <i data-lucide="apple" class="icon" style="width:18px;height:18px;"></i>
                    </div>
                    <div class="text-truncate">
                        <div class="hp-rate-name">Apple iTunes</div>
                        <div class="hp-rate-info">US / Global Codes</div>
                    </div>
                </div>
                <div class="hp-rate-bottom">
                    <div class="hp-rate-pct">88%</div>
                    <span class="hp-rate-btn">
                        <span>Sell</span>
                        <i data-lucide="arrow-right" class="icon" style="width:12px;height:12px;"></i>
                    </span>
                </div>
            </a>

            <a href="{{ route('giftcards.sell', ['brand' => 'neosurf']) }}" class="hp-rate-card">
                <div class="hp-rate-top">
                    <div class="hp-rate-avatar" style="background: linear-gradient(135deg, #E72582, #A8125B);" aria-hidden="true">N</div>
                    <div class="text-truncate">
                        <div class="hp-rate-name">Neosurf</div>
                        <div class="hp-rate-info">10-Digit Voucher</div>
                    </div>
                </div>
                <div class="hp-rate-bottom">
                    <div class="hp-rate-pct">84%</div>
                    <span class="hp-rate-btn">
                        <span>Sell</span>
                        <i data-lucide="arrow-right" class="icon" style="width:12px;height:12px;"></i>
                    </span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- ===================== SUBSCRIPTIONS ===================== -->
<section class="hp-section animate-in" aria-labelledby="hp-subs-heading">
    <div class="container-xxl">
        <div class="d-flex align-items-end justify-content-between gap-2 mb-3">
            <div>
                <div class="hp-section-tag">
                    <i data-lucide="tv" class="icon" style="width:14px;height:14px;"></i>
                    <span>OTT & AI Tools</span>
                </div>
                <h2 class="hp-section-title" id="hp-subs-heading">Digital Subscriptions</h2>
            </div>
            <a href="{{ route('subscriptions') }}" class="hp-view-all">
                <span>View All</span>
                <i data-lucide="arrow-right" class="icon" style="width:14px;height:14px;"></i>
            </a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-3">
            @foreach($subscriptions as $sub)
                <div class="col">
                    <a href="{{ route('subscriptions.show', $sub->slug) }}" class="hp-mini-card h-100">
                            <div class="hp-mini-thumb">
                            <div class="hp-mini-thumb-inner" style="background: radial-gradient(circle, {{ $sub->brand_color }}22 0%, transparent 80%);">
                                @if(isset($brandIcons[$sub->slug]))
                                    <img src="{{ asset('images/brands/' . $brandIcons[$sub->slug]) }}" class="hp-brand-logo" width="46" height="46" loading="lazy" decoding="async" alt="{{ $sub->title }} logo">
                                @else
                                    <i data-lucide="tv" style="width: 38px; height: 38px; color: {{ $sub->brand_color }}; opacity: 0.7;"></i>
                                @endif
                            </div>
                            @if($sub->tag_badge)
                                <span class="hp-mini-badge">{{ $sub->tag_badge }}</span>
                            @endif
                        </div>

                        <div class="hp-mini-body">
                            <h3 class="hp-mini-title">{{ $sub->title }}</h3>
                            <div class="hp-mini-priceline">
                                <span class="hp-mini-from">Monthly</span>
                                <span class="hp-mini-price" data-bdt="{{ $sub->base_price_bdt }}">&#2547; {{ number_format($sub->base_price_bdt) }}</span>
                            </div>
                            <span class="hp-mini-btn">
                                <span>Get Account</span>
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== BUY GIFT CARDS ===================== -->
<section class="hp-section animate-in" aria-labelledby="hp-buy-heading">
    <div class="container-xxl">
        <div class="d-flex align-items-end justify-content-between gap-2 mb-3">
            <div>
                <div class="hp-section-tag hp-tag-cyan">
                    <i data-lucide="gift" class="icon" style="width:14px;height:14px;"></i>
                    <span>Instant Digital Codes</span>
                </div>
                <h2 class="hp-section-title" id="hp-buy-heading">Buy Gift Cards</h2>
            </div>
            <a href="{{ route('giftcards.buy') }}" class="hp-view-all">
                <span>View All</span>
                <i data-lucide="arrow-right" class="icon" style="width:14px;height:14px;"></i>
            </a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-3">
            @foreach($giftCardBuys as $card)
                <div class="col">
                    <a href="{{ route('giftcards.buy.show', $card->slug) }}" class="hp-mini-card h-100">
                            <div class="hp-mini-thumb">
                            <div class="hp-mini-thumb-inner" style="background: radial-gradient(circle, {{ $card->brand_color }}22 0%, transparent 80%);">
                                @if(isset($brandIcons[$card->slug]))
                                    <img src="{{ asset('images/brands/' . $brandIcons[$card->slug]) }}" class="hp-brand-logo" width="46" height="46" loading="lazy" decoding="async" alt="{{ $card->title }} logo">
                                @else
                                    <i data-lucide="gift" style="width: 38px; height: 38px; color: {{ $card->brand_color }}; opacity: 0.7;"></i>
                                @endif
                            </div>
                            @if($card->tag_badge)
                                <span class="hp-mini-badge">{{ $card->tag_badge }}</span>
                            @endif
                        </div>

                        <div class="hp-mini-body">
                            <h3 class="hp-mini-title">{{ $card->title }}</h3>
                            <div class="hp-mini-priceline">
                                <span class="hp-mini-from">From</span>
                                <span class="hp-mini-price" data-bdt="{{ $card->base_price_bdt }}">&#2547; {{ number_format($card->base_price_bdt) }}</span>
                            </div>
                            <span class="hp-mini-btn">
                                <span>Buy Code</span>
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@if(isset($softwareProducts) && $softwareProducts->count() > 0)
<!-- ===================== SOFTWARE & DIGITAL LICENSES ===================== -->
<section class="hp-section animate-in" aria-labelledby="hp-soft-heading">
    <div class="container-xxl">
        <div class="d-flex align-items-end justify-content-between gap-2 mb-3">
            <div>
                <div class="hp-section-tag" style="color: #38BDF8;">
                    <i data-lucide="key-round" class="icon" style="width:14px;height:14px;"></i>
                    <span>Genuine Licenses</span>
                </div>
                <h2 class="hp-section-title" id="hp-soft-heading">Software & Digital Keys</h2>
            </div>
            <a href="{{ route('digital.products') }}" class="hp-view-all">
                <span>View All</span>
                <i data-lucide="arrow-right" class="icon" style="width:14px;height:14px;"></i>
            </a>
        </div>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-3">
            @foreach($softwareProducts as $soft)
                <div class="col">
                    <a href="{{ route('digital.products.show', $soft->slug) }}" class="hp-mini-card h-100">
                            <div class="hp-mini-thumb">
                            <div class="hp-mini-thumb-inner" style="background: radial-gradient(circle, {{ $soft->brand_color }}22 0%, transparent 80%);">
                                @if(isset($brandIcons[$soft->slug]))
                                    <img src="{{ asset('images/brands/' . $brandIcons[$soft->slug]) }}" class="hp-brand-logo" width="46" height="46" loading="lazy" decoding="async" alt="{{ $soft->title }} logo">
                                @else
                                    <i data-lucide="key-round" style="width: 38px; height: 38px; color: {{ $soft->brand_color }}; opacity: 0.7;"></i>
                                @endif
                            </div>
                            @if($soft->tag_badge)
                                <span class="hp-mini-badge">{{ $soft->tag_badge }}</span>
                            @endif
                        </div>

                        <div class="hp-mini-body">
                            <h3 class="hp-mini-title">{{ $soft->title }}</h3>
                            <div class="hp-mini-priceline">
                                <span class="hp-mini-from">From</span>
                                <span class="hp-mini-price" data-bdt="{{ $soft->base_price_bdt }}">&#2547; {{ number_format($soft->base_price_bdt) }}</span>
                            </div>
                            <span class="hp-mini-btn">
                                <span>Get License</span>
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ===================== HOW IT WORKS ===================== -->
<section class="hp-section animate-in" aria-labelledby="hp-how-heading">
    <div class="container-xxl">
        <div class="text-center mb-4">
            <div class="hp-section-tag justify-content-center">
                <i data-lucide="sparkles" class="icon" style="width:14px;height:14px;"></i>
                <span>Fast & Simple Process</span>
            </div>
            <h2 class="hp-section-title" id="hp-how-heading">How RosTop Works</h2>
            <p class="hp-section-desc bn mx-auto" style="margin-top: 0.3rem;">
                ৩টি সহজ ধাপে যে কোনো ডিজিটাল সেবা বা ক্যাশআউট গ্রহণ করুন
            </p>
        </div>

        <div class="row g-3">
            <div class="col-12 col-md-4">
                <div class="hp-how-card">
                    <div class="hp-how-step" aria-hidden="true">1</div>
                    <h3 class="hp-how-title">প্রোডাক্ট বা ভাউচার সিলেক্ট করুন</h3>
                    <p class="hp-how-desc bn">
                        আপনার পছন্দের গেম টপ-আপ, গিফট কার্ড বা ওটিটি সাবস্ক্রিপশন প্যাকেজ নির্বাচন করুন অথবা বিক্রির জন্য ভাউচার বেছে নিন।
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="hp-how-card">
                    <div class="hp-how-step" style="background: rgba(245, 158, 11, 0.15); border-color: rgba(245, 158, 11, 0.35); color: var(--accent-amber);" aria-hidden="true">2</div>
                    <h3 class="hp-how-title">পেমেন্ট করুন বা কোড দিন</h3>
                    <p class="hp-how-desc bn">
                        বিকাশ, নগদ বা রকেট দিয়ে স্বয়ংক্রিয় পেমেন্ট সম্পন্ন করুন। গিফট কার্ড বিক্রির ক্ষেত্রে আপনার সিকিউর ভাউচার কোড সাবমিট করুন।
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="hp-how-card">
                    <div class="hp-how-step" style="background: rgba(56, 189, 248, 0.15); border-color: rgba(56, 189, 248, 0.35); color: #38BDF8;" aria-hidden="true">3</div>
                    <h3 class="hp-how-title">তাৎক্ষণিক ডেলিভারি ও ক্যাশআউট</h3>
                    <p class="hp-how-desc bn">
                        ইন-গেম টপ-আপ ৬০ সেকেন্ডে সরাসরি আপনার একাউন্টে পৌঁছে যাবে এবং গিফট কার্ড ক্যাশআউট ১৫-৪৫ মিনিটে আপনার ওয়ালেটে ট্রান্সফার হবে।
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($reviews) && $reviews->count() > 0)
<!-- ===================== VERIFIED REVIEWS ===================== -->
<section class="hp-section animate-in" aria-labelledby="hp-rev-heading">
    <div class="container-xxl">
        <div class="d-flex align-items-end justify-content-between gap-2 mb-3">
            <div>
                <div class="hp-section-tag" style="color: var(--accent-amber);">
                    <i data-lucide="star" class="icon" style="width:14px;height:14px; fill: var(--accent-amber);"></i>
                    <span>Real Customer Feedback</span>
                </div>
                <h2 class="hp-section-title" id="hp-rev-heading">Verified Customer Reviews</h2>
            </div>
            <div class="d-none d-sm-flex align-items-center gap-1 text-muted small">
                <i data-lucide="check-circle-2" class="icon text-primary" style="width:15px;height:15px;"></i>
                <span>100% Verified Purchases</span>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            @foreach($reviews as $rev)
                <div class="col">
                    <div class="hp-review-card">
                        <div class="hp-review-stars" aria-label="Rated {{ $rev->rating }} out of 5 stars">
                            @for($i = 0; $i < $rev->rating; $i++)
                                <i data-lucide="star" class="icon"></i>
                            @endfor
                        </div>
                        <p class="hp-review-comment">&ldquo;{{ $rev->comment }}&rdquo;</p>
                        <div class="hp-review-author">
                            <span class="hp-review-name">{{ $rev->user_name }}</span>
                            <span class="hp-review-service">{{ $rev->service_name }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ===================== TRUST STRIP ===================== -->
<section class="hp-section animate-in" aria-label="Platform guarantees">
    <div class="container-xxl">
        <div class="row row-cols-2 row-cols-lg-4 g-2 g-md-3">
            <div class="col">
                <div class="hp-trust-card h-100">
                    <div class="hp-trust-icon">
                        <i data-lucide="zap" class="icon"></i>
                    </div>
                    <div>
                        <h4 class="hp-trust-title">Instant Delivery</h4>
                        <p class="hp-trust-desc">Codes & top-ups processed automatically.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="hp-trust-card h-100">
                    <div class="hp-trust-icon" style="color: var(--accent-amber); background: rgba(245, 158, 11, 0.12);">
                        <i data-lucide="badge-percent" class="icon"></i>
                    </div>
                    <div>
                        <h4 class="hp-trust-title">Fixed Rates</h4>
                        <p class="hp-trust-desc">No hidden fees or bargaining.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="hp-trust-card h-100">
                    <div class="hp-trust-icon" style="color: #38BDF8; background: rgba(56, 189, 248, 0.12);">
                        <i data-lucide="shield-check" class="icon"></i>
                    </div>
                    <div>
                        <h4 class="hp-trust-title">100% Safe</h4>
                        <p class="hp-trust-desc">Direct platform. No P2P scam risk.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="hp-trust-card h-100">
                    <div class="hp-trust-icon" style="color: #25D366; background: rgba(37, 211, 102, 0.12);">
                        <i data-lucide="headphones" class="icon"></i>
                    </div>
                    <div>
                        <h4 class="hp-trust-title">24/7 Support</h4>
                        <p class="hp-trust-desc">Live WhatsApp help, anytime.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== FAQ ===================== -->
<section id="faq" class="hp-section animate-in" aria-labelledby="hp-faq-heading">
    <div class="container-xxl">
        <div class="text-center mb-4">
            <div class="hp-section-tag justify-content-center">
                <i data-lucide="help-circle" class="icon" style="width:14px;height:14px;"></i>
                <span>Have Questions?</span>
            </div>
            <h2 class="hp-section-title" id="hp-faq-heading">Frequently Asked Questions</h2>
            <p class="hp-section-desc bn mx-auto" style="margin-top: 0.3rem;">
                টপ-আপ, কার্ড বিক্রি ও পেমেন্ট সংক্রান্ত সাধারণ প্রশ্নের উত্তর
            </p>
        </div>

        <div class="hp-faq-wrap">
            <div class="faq-item active">
                <button type="button" class="faq-question" aria-expanded="true">
                    <span>How long does it take to receive bKash payment after selling a gift card?</span>
                    <i data-lucide="chevron-down" class="icon"></i>
                </button>
                <div class="faq-answer">
                    Typically, after submitting your card code and details, our verification team checks the voucher within 15 to 45 minutes and transfers the BDT payment directly to your bKash, Nagad, or USDT wallet.
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question" aria-expanded="false">
                    <span>Do I need to share my game password for Free Fire or PUBG top-up?</span>
                    <i data-lucide="chevron-down" class="icon"></i>
                </button>
                <div class="faq-answer">
                    No! Free Fire and PUBG top-ups do not require any password. You only provide your Player ID (UID) or Character ID, and the diamonds/UC will be credited directly to your account.
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question" aria-expanded="false">
                    <span>Which payment methods are supported?</span>
                    <i data-lucide="chevron-down" class="icon"></i>
                </button>
                <div class="faq-answer">
                    We support bKash, Nagad, Rocket, Upay, SureCash, and international cryptocurrency USDT (TRC20 / BEP20) for both buying and cashouts.
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question" aria-expanded="false">
                    <span>Do Netflix and ChatGPT subscriptions come with a warranty?</span>
                    <i data-lucide="chevron-down" class="icon"></i>
                </button>
                <div class="faq-answer">
                    Yes! All our subscriptions come with a full-duration replacement guarantee. If any issue occurs, an immediate replacement profile or fix is provided via our WhatsApp support.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===================== FINAL CTA ===================== -->
<section class="container-xxl animate-in">
    <div class="hp-cta-banner">
        <h2 class="hp-cta-title">Ready to Trade Digital Value Instantly?</h2>
        <p class="hp-cta-desc">
            Join 50,000+ customers who top-up games, buy subscriptions and cash out gift cards
            every day with RosTop's guaranteed exchange engine - বিকাশ, নগদ ও USDT সাপোর্ট সহ।
        </p>
        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a href="{{ route('game.topup') }}" class="hp-btn hp-btn-primary">
                <i data-lucide="gamepad-2" class="icon"></i>
                <span>Start Top-Up</span>
            </a>
            <a href="{{ route('giftcards.sell') }}" class="hp-btn hp-btn-outline">
                <i data-lucide="wallet" class="icon"></i>
                <span>Sell a Gift Card</span>
            </a>
        </div>
    </div>
</section>

</div><!-- /.hp-scope -->

<!-- Subcategory / Regional Editions Modal Component (Screenshots 4 & 5) -->
<div class="game-editions-modal" id="game-editions-modal" role="dialog" aria-modal="true" aria-labelledby="game-editions-title">
    <div class="game-editions-dialog">
        <div class="game-editions-header">
            <h3 class="game-editions-title" id="game-editions-title">GAME EDITIONS</h3>
            <button type="button" class="game-editions-close" id="game-editions-close" aria-label="Close modal">
                <i data-lucide="x" class="icon" style="width:18px;height:18px;"></i>
            </button>
        </div>
        <div class="game-editions-body">
            <div class="game-editions-grid" id="game-editions-grid">
                <!-- Dynamically populated via JS from EDITIONS_DATA -->
            </div>
        </div>
        <div class="game-editions-footer">
            <a href="{{ route('game.topup') }}" class="game-editions-all-btn" id="game-editions-all-link">
                <span>See All &rarr;</span>
            </a>
        </div>
    </div>
</div>
@endsection
