<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Theme Init (anti-FOUC): default LIGHT, restore saved dark preference -->
    <script>
        try {
            var savedTheme = localStorage.getItem('site-theme');
            document.documentElement.setAttribute('data-theme', savedTheme === 'dark' ? 'dark' : 'light');
        } catch (e) {}
    </script>

    <!-- SEO Primary Meta Tags -->
    <title>@yield('title', 'RosTop - Game Top-Up, Buy & Sell Gift Cards for bKash/Nagad & Digital Subscriptions')</title>
    <meta name="description" content="@yield('meta_description', 'RosTop (rostop.com) - Bangladesh\'s trusted platform for instant Free Fire & PUBG top-up, selling Paysafecard, Transcash, Apple gift cards for bKash/Nagad at 84-90% rates, plus Netflix & ChatGPT subscriptions.')">
    <meta name="keywords" content="rostop, rostop.com, sell gift cards bangladesh, buy gift cards bkash, free fire diamond top up bd, pubg uc top up nagad, netflix subscription bd, chatgpt plus bangladesh, paysafecard cashout bkash, transcash sell bd">
    <meta name="author" content="RosTop">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="geo.region" content="BD">
    <meta name="geo.placename" content="Dhaka">
    <link rel="canonical" href="{{ url()->current() }}">
    @include('partials.hreflang')

    <!-- Browser Chrome / System Theme Integration (matches app dark & light palettes) -->
    <meta name="color-scheme" content="dark light">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#0A1411">
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#F8FAF9">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="RosTop">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    <!-- Preconnect: speed up third-party font fetch (LCP correlates strongly with rankings) -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">

    @stack('preload')

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="RosTop">
    <meta property="og:locale" content="en_US">
    <meta property="og:locale:alternate" content="bn_BD">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'RosTop - Game Top-Up, Buy & Sell Gift Cards & Subscriptions')">
    <meta property="og:description" content="@yield('meta_description', 'Instant digital top-up, buy & sell gift cards for instant bKash/Nagad cashout, OTT subscriptions & genuine software at rostop.com.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-banner.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="RosTop - Bangladesh's trusted game top-up and gift card exchange platform">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'RosTop - Digital Marketplace & Exchange')">
    <meta name="twitter:description" content="@yield('meta_description', 'Instant digital codes, game top-up, and gift card cashout in Bangladesh - rostop.com.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-banner.jpg'))">
    <meta name="twitter:image:alt" content="RosTop - Game top-up and gift card exchange in Bangladesh">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "WebSite",
      "name": "RosTop",
      "alternateName": "rostop.com",
      "url": "https://rostop.com",
      "inLanguage": ["en", "bn"]
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Organization",
      "name": "RosTop",
      "url": "https://rostop.com",
      "logo": "https://rostop.com/images/logo.png",
      "description": "Bangladesh's premier digital marketplace for game top-ups, gift card exchange, OTT subscriptions and digital products.",
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "+8801700000000",
        "contactType": "Customer Support",
        "areaServed": "BD",
        "availableLanguage": ["English", "Bengali"]
      },
      "sameAs": [
        "https://facebook.com/rostopbd",
        "https://t.me/rostopbd"
      ]
    }
    </script>

    <!-- Google Fonts Preconnect & Optimized Loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Responsive CSS Library: Bootstrap 5 (Grid & Utilities) -->
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">

    <!-- Design System CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/game-topup.css') }}?v={{ time() }}">

    <!-- Auto-generated per-page schema.org JSON-LD (Product / Offer / BreadcrumbList / ItemList) -->
    @stack('schema')

    @stack('styles')
</head>
<body class="has-rp-rail">

    <!-- Accessibility: Keyboard & screen-reader shortcut to primary content -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- RosTop Desktop Icon Rail (Photo Concept SaaS Sidebar) -->
    <aside class="rp-rail rp-side d-none d-lg-flex" id="rp-desktop-rail" aria-label="RosTop Sidebar Rail">
        @include('partials.rp-sidebar', ['isRail' => true])
    </aside>

    <!-- Sticky Navigation -->
    <header class="header-sticky" id="main-header">
        <div class="container">
            <div class="navbar-wrapper">

                <!-- Brand Logo & Country/Currency Switcher -->
                <div class="brand-group">
                    <a href="{{ route('home') }}" class="brand-logo" title="RosTop Home">
                        <div class="brand-icon">
                            <i data-lucide="zap" class="icon"></i>
                        </div>
                        <span class="brand-title">Ros<span style="color: var(--primary);">Top</span></span>
                    </a>

                    <!-- Locale / Country / Currency Pill (mock: [flag] EN-BD / BDT) -->
                    <button type="button" class="lc-pill" id="currency-selector-btn" aria-label="Language and Currency Settings" title="Language & Currency Settings">
                        <img class="lc-pill-flag" id="lc-pill-flag" src="{{ asset('images/flags/bd.svg') }}" alt="" width="22" height="16">
                        <span class="lc-pill-lang" id="lc-pill-lang">EN-BD</span>
                        <span class="lc-pill-sep">/</span>
                        <span class="lc-pill-curr" id="active-curr-code">BDT</span>
                        <i data-lucide="chevron-down" class="icon lc-pill-caret"></i>
                    </button>
                </div>

                <!-- Desktop Nav Links -->
                <ul class="nav-menu d-none d-lg-flex">
                    <li>
                        <a href="{{ route('home') }}" class="nav-item-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            <i data-lucide="home" class="icon"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('game.topup') }}" class="nav-item-link {{ request()->routeIs('game.*') ? 'active' : '' }}">
                            <i data-lucide="gamepad-2" class="icon"></i> Game Top-Up
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('giftcards.sell') }}" class="nav-item-link {{ request()->routeIs('giftcards.sell*') ? 'active' : '' }}" style="color: var(--accent-amber);">
                            <i data-lucide="wallet" class="icon"></i> Sell Cards
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('giftcards.buy') }}" class="nav-item-link {{ request()->routeIs('giftcards.buy*') ? 'active' : '' }}">
                            <i data-lucide="gift" class="icon"></i> Buy Cards
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('subscriptions') }}" class="nav-item-link {{ request()->routeIs('subscriptions*') ? 'active' : '' }}">
                            <i data-lucide="tv" class="icon"></i> Subscriptions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('digital.products') }}" class="nav-item-link {{ request()->routeIs('digital.products*') ? 'active' : '' }}">
                            <i data-lucide="key-round" class="icon"></i> Software
                        </a>
                    </li>
                </ul>

                <!-- Nav Actions -->
                <div class="nav-actions">

                    <!-- Search Trigger (Icon-Only) -->
                    <button type="button" class="search-trigger" id="global-search-btn" aria-label="Quick Search" title="Quick Search (Ctrl+K)">
                        <i data-lucide="search" class="icon"></i>
                    </button>

                    <!-- Sell Highlight Button (Desktop Only - Mobile in Drawer) -->
                    <a href="{{ route('giftcards.sell') }}" class="btn btn-sell btn-sm header-sell-btn d-none d-lg-inline-flex">
                        <i data-lucide="wallet" class="icon"></i>
                        <span class="header-sell-text">Sell Voucher</span>
                    </a>

                    {{-- Theme toggle + profile/wallet/admin/logout intentionally removed from header:
                         they already live inside the sidebar (Light|Dark pill + bottom user card).
                         Header keeps only primary actions for a clean, uncrowded top bar. --}}

                    <!-- Mobile Hamburger Menu Button -->
                    <button type="button" class="mobile-menu-btn" id="mobile-menu-open-btn" aria-label="Open Navigation Menu" title="Open Navigation Menu">
                        <i data-lucide="menu" class="icon"></i>
                    </button>
                </div>

            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content" tabindex="-1">
        @if(session('success'))
            <div class="container" style="margin-top: 1.25rem;">
                <div class="flash-message flash-success">
                    <i data-lucide="check-circle" class="icon"></i>
                    <div>{{ session('success') }}</div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container" style="margin-top: 1.25rem;">
                <div class="flash-message flash-error">
                    <i data-lucide="alert-circle" class="icon"></i>
                    <div>{{ session('error') }}</div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Search Modal -->
    <div id="search-modal" class="modal-overlay">
        <div class="modal-box">
            <button type="button" id="search-close-btn" class="modal-close-btn" aria-label="Close">
                <i data-lucide="x" class="icon"></i>
            </button>
            <div style="margin-bottom: 1rem;">
                <div style="font-size: 1.15rem; font-weight: 800; margin-bottom: 0.2rem; font-family: var(--font-heading);">Quick Search</div>
                <div style="font-size: 0.8rem; color: var(--text-dim);">Find games, gift cards, subscriptions, or digital licenses</div>
            </div>

            <div style="position: relative; margin-bottom: 1rem;">
                <input type="text" id="search-input-field" class="calc-input" placeholder="Type here (e.g. Free Fire, Netflix, Apple, PUBG)..." autocomplete="off" style="padding-left: 2.5rem;">
                <i data-lucide="search" class="icon" style="position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: var(--text-dim); width: 16px; height: 16px;"></i>
            </div>

            <div id="search-results-list" style="max-height: 360px; overflow-y: auto;">
                <!-- Search results populated dynamically -->
            </div>
        </div>
    </div>

    <!-- Language / Country & Currency Settings Modal (mock-exact) -->
    <div id="currency-modal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="currency-modal-title">
        <div class="modal-box lc-modal-box">
            <button type="button" id="currency-close-btn" class="modal-close-btn" aria-label="Close">
                <i data-lucide="x" class="icon"></i>
            </button>
            <h2 id="currency-modal-title" class="lc-modal-title">{{ __('ui.settings_title') }}</h2>
            @include('partials.locale-currency', ['scope' => 'modal', 'saveButton' => true])
        </div>
    </div>

    {{-- Legacy currency-grid removed (mock redesign): pill + panel now drive prefs --}}
    @if(false)
    <div class="currency-grid" style="display:none;">
                <button type="button" class="currency-option-card active" data-currency="BDT" data-country="BD" data-flag="🇧🇩" data-symbol="৳" data-rate="1" data-methods="bKash, Nagad, Rocket, Upay">
                    <span class="curr-opt-flag">🇧🇩</span>
                    <div class="curr-opt-info">
                        <div class="curr-opt-top">
                            <span class="curr-opt-name">Bangladesh</span>
                            <span class="curr-opt-code">BDT (৳)</span>
                        </div>
                        <span class="curr-opt-methods"><i data-lucide="shield-check" class="icon"></i> bKash, Nagad, Rocket, Upay</span>
                    </div>
                    <i data-lucide="check" class="icon curr-check"></i>
                </button>

                <button type="button" class="currency-option-card" data-currency="USD" data-country="US" data-flag="🇺🇸" data-symbol="$" data-rate="124.5" data-methods="USDT (TRC20/BEP20), Binance Pay, Card">
                    <span class="curr-opt-flag">🇺🇸</span>
                    <div class="curr-opt-info">
                        <div class="curr-opt-top">
                            <span class="curr-opt-name">United States & Global</span>
                            <span class="curr-opt-code">USD ($)</span>
                        </div>
                        <span class="curr-opt-methods"><i data-lucide="shield-check" class="icon"></i> USDT, Binance Pay, Visa/MC</span>
                    </div>
                    <i data-lucide="check" class="icon curr-check"></i>
                </button>

                <button type="button" class="currency-option-card" data-currency="EUR" data-country="EU" data-flag="🇪🇺" data-symbol="€" data-rate="135.2" data-methods="Paysafecard, Transcash, SEPA Instant">
                    <span class="curr-opt-flag">🇪🇺</span>
                    <div class="curr-opt-info">
                        <div class="curr-opt-top">
                            <span class="curr-opt-name">Eurozone & Europe</span>
                            <span class="curr-opt-code">EUR (€)</span>
                        </div>
                        <span class="curr-opt-methods"><i data-lucide="shield-check" class="icon"></i> Paysafecard, Transcash, SEPA</span>
                    </div>
                    <i data-lucide="check" class="icon curr-check"></i>
                </button>

                <button type="button" class="currency-option-card" data-currency="GBP" data-country="GB" data-flag="🇬🇧" data-symbol="£" data-rate="158.0" data-methods="UK Bank Transfer, Apple Pay, Card">
                    <span class="curr-opt-flag">🇬🇧</span>
                    <div class="curr-opt-info">
                        <div class="curr-opt-top">
                            <span class="curr-opt-name">United Kingdom</span>
                            <span class="curr-opt-code">GBP (£)</span>
                        </div>
                        <span class="curr-opt-methods"><i data-lucide="shield-check" class="icon"></i> Faster Payments, Apple Pay</span>
                    </div>
                    <i data-lucide="check" class="icon curr-check"></i>
                </button>

                <button type="button" class="currency-option-card" data-currency="AED" data-country="AE" data-flag="🇦🇪" data-symbol="د.إ" data-rate="33.9" data-methods="PayBy, Botim, Card, USDT">
                    <span class="curr-opt-flag">🇦🇪</span>
                    <div class="curr-opt-info">
                        <div class="curr-opt-top">
                            <span class="curr-opt-name">United Arab Emirates</span>
                            <span class="curr-opt-code">AED (د.إ)</span>
                        </div>
                        <span class="curr-opt-methods"><i data-lucide="shield-check" class="icon"></i> PayBy, Botim, Card, USDT</span>
                    </div>
                    <i data-lucide="check" class="icon curr-check"></i>
                </button>

                <button type="button" class="currency-option-card" data-currency="SAR" data-country="SA" data-flag="🇸🇦" data-symbol="﷼" data-rate="33.2" data-methods="STC Pay, Urpay, Mada, USDT">
                    <span class="curr-opt-flag">🇸🇦</span>
                    <div class="curr-opt-info">
                        <div class="curr-opt-top">
                            <span class="curr-opt-name">Saudi Arabia</span>
                            <span class="curr-opt-code">SAR (﷼)</span>
                        </div>
                        <span class="curr-opt-methods"><i data-lucide="shield-check" class="icon"></i> STC Pay, Urpay, Mada</span>
                    </div>
                    <i data-lucide="check" class="icon curr-check"></i>
                </button>
            </div>
    @endif

    <!-- Categorized Live Transactions History Modal -->
    <div id="live-history-modal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="live-history-modal-title">
        <div class="modal-box live-history-modal-box">
            <button type="button" id="live-history-close-btn" class="modal-close-btn" aria-label="Close">
                <i data-lucide="x" class="icon"></i>
            </button>
            <div>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.2rem;">
                    <span class="live-pulse-dot"></span>
                    <div id="live-history-modal-title" style="font-size: 1.15rem; font-weight: 800; font-family: var(--font-heading);">Live Transactions Feed</div>
                </div>
                <div style="font-size: 0.8rem; color: var(--text-dim);">Real-time completed orders across all digital top-up & exchange categories</div>
            </div>

            <!-- Stats Bar -->
            <div class="live-modal-stats">
                <div class="live-stat-item">
                    <span class="live-stat-val">248+</span>
                    <span class="live-stat-lbl">Today's Orders</span>
                </div>
                <div class="live-stat-item">
                    <span class="live-stat-val" style="color: var(--primary);">~45s</span>
                    <span class="live-stat-lbl">Avg. Speed</span>
                </div>
                <div class="live-stat-item">
                    <span class="live-stat-val" style="color: var(--accent-amber);">100%</span>
                    <span class="live-stat-lbl">Success Rate</span>
                </div>
            </div>

            <!-- Category Filter Tabs & Search -->
            <div class="live-modal-controls">
                <div class="live-modal-tabs" role="tablist">
                    <button type="button" class="live-modal-tab active" data-filter="all">All</button>
                    <button type="button" class="live-modal-tab" data-filter="topup"><i data-lucide="gamepad-2" class="icon"></i> Top-Up</button>
                    <button type="button" class="live-modal-tab" data-filter="sell"><i data-lucide="wallet" class="icon"></i> Cashout</button>
                    <button type="button" class="live-modal-tab" data-filter="subscription"><i data-lucide="tv" class="icon"></i> OTT Hub</button>
                    <button type="button" class="live-modal-tab" data-filter="buy"><i data-lucide="gift" class="icon"></i> Gift Cards</button>
                    <button type="button" class="live-modal-tab" data-filter="software"><i data-lucide="cpu" class="icon"></i> Software</button>
                </div>
                <div class="live-modal-search">
                    <i data-lucide="search" class="icon search-icon"></i>
                    <input type="text" id="live-history-search-input" placeholder="Search order, product or payment method..." aria-label="Search transactions">
                </div>
            </div>

            <!-- Transaction List View -->
            <div class="live-modal-list" id="live-history-list">
                @if(isset($liveTransactions) && $liveTransactions->count() > 0)
                    @foreach($liveTransactions as $tx)
                        <div class="live-history-card" data-category="{{ $tx->order_type }}" data-title="{{ strtolower($tx->product_title) }}" data-method="{{ strtolower($tx->payment_method) }}">
                            <div class="live-hcard-left">
                                <span class="live-cat-badge {{ $tx->category_class }}">{{ $tx->category_label }}</span>
                                <div style="min-width: 0;">
                                    <div class="live-hcard-title">{{ $tx->product_title }}</div>
                                    <div class="live-hcard-meta">
                                        <span>Customer: <strong>{{ $tx->customer_masked }}</strong></span>
                                        <span>&bull;</span>
                                        <span>{{ $tx->time_text }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="live-hcard-right">
                                <div class="live-hcard-amount">৳{{ number_format($tx->amount_bdt) }}</div>
                                <span class="live-hcard-method"><i data-lucide="check-circle-2" class="icon"></i> {{ $tx->payment_method }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="live-modal-footer">
                <span class="live-sync-indicator"><span class="live-pulse-dot"></span> Live Sync Active</span>
                <span style="font-size: 0.7rem; color: var(--text-dim);">Auto-verified via RosTop Exchange Engine</span>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Drawer (Modern SaaS App Sidebar) -->
    <div id="mobile-drawer-overlay" class="mobile-drawer-overlay" aria-hidden="true">
        <aside class="mobile-drawer rp-side" id="mobile-drawer" aria-label="Navigation Drawer">
            @include('partials.rp-sidebar', ['isRail' => false])
        </aside>
    </div>

    <!-- Floating Support (Links to Dedicated Customer Care / Support Page) -->
    <a href="{{ route('support') }}" class="floating-support" title="24/7 Customer Care &amp; Support" aria-label="Customer Care">
        <i data-lucide="headphones" class="icon" style="width: 24px; height: 24px;"></i>
    </a>

    <!-- Mobile Bottom Navigation -->
    <nav class="bottom-nav" aria-label="Mobile Navigation">
        <a href="{{ route('home') }}" class="bottom-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <i data-lucide="home" class="icon"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('game.topup') }}" class="bottom-nav-item {{ request()->routeIs('game.*') ? 'active' : '' }}">
            <i data-lucide="gamepad-2" class="icon"></i>
            <span>Top-Up</span>
        </a>
        <a href="{{ route('giftcards.sell') }}" class="bottom-nav-item {{ request()->routeIs('giftcards.sell*') ? 'active' : '' }}">
            <div class="bottom-nav-sell-btn" title="Sell Card">
                <i data-lucide="wallet" class="icon"></i>
            </div>
            <span style="color: var(--accent-amber); font-weight: 700;">Sell</span>
        </a>
        <a href="{{ route('giftcards.buy') }}" class="bottom-nav-item {{ request()->routeIs('giftcards.buy*') ? 'active' : '' }}">
            <i data-lucide="gift" class="icon"></i>
            <span>Buy Card</span>
        </a>
        <a href="{{ route('track.order') }}" class="bottom-nav-item {{ request()->routeIs('track.*') ? 'active' : '' }}">
            <i data-lucide="clock" class="icon"></i>
            <span>Orders</span>
        </a>
    </nav>

    <!-- Footer -->
    <footer class="footer-wrap">
        <div class="container">
            <div class="footer-grid">

                <!-- Brand Info -->
                <div>
                    <a href="{{ route('home') }}" class="brand-logo" style="margin-bottom: 1rem; display: inline-flex;">
                        <div class="brand-icon"><i data-lucide="zap" class="icon"></i></div>
                        <div><span class="brand-title">Ros<span style="color: var(--primary);">Top</span></span></div>
                    </a>
                    <p style="font-size: 0.825rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1rem;">
                        Bangladesh's trusted and fastest digital platform. Game top-ups, gift card exchange, OTT subscriptions, and genuine software licenses at <strong>rostop.com</strong>.
                    </p>
                    <div style="display: flex; gap: 0.6rem; flex-wrap: wrap;">
                        <span class="payment-pill payment-bkash">bKash</span>
                        <span class="payment-pill payment-nagad">Nagad</span>
                        <span class="payment-pill payment-rocket">Rocket</span>
                        <span class="payment-pill payment-usdt">USDT TRC20</span>
                    </div>
                </div>

                <!-- Services Column -->
                <div>
                    <div class="footer-col-title">Services</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('game.topup') }}" class="footer-link">Free Fire Diamond Top-Up</a></li>
                        <li><a href="{{ route('game.topup') }}" class="footer-link">PUBG Mobile UC Reload</a></li>
                        <li><a href="{{ route('giftcards.sell') }}" class="footer-link">Sell Paysafecard for bKash</a></li>
                        <li><a href="{{ route('giftcards.sell') }}" class="footer-link">Sell Transcash & Apple Cards</a></li>
                        <li><a href="{{ route('giftcards.buy') }}" class="footer-link">Buy Google Play Gift Cards</a></li>
                    </ul>
                </div>

                <!-- Digital Products Column -->
                <div>
                    <div class="footer-col-title">Digital Products</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('subscriptions') }}" class="footer-link">Netflix Premium 4K UHD</a></li>
                        <li><a href="{{ route('subscriptions') }}" class="footer-link">ChatGPT Plus Account</a></li>
                        <li><a href="{{ route('subscriptions') }}" class="footer-link">Canva Pro Lifetime License</a></li>
                        <li><a href="{{ route('digital.products') }}" class="footer-link">Windows 11 Pro Genuine OEM</a></li>
                        <li><a href="{{ route('digital.products') }}" class="footer-link">Microsoft Office 2021 Pro</a></li>
                    </ul>
                </div>

                <!-- Help Column -->
                <div>
                    <div class="footer-col-title">Help & Trust</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('track.order') }}" class="footer-link">Live Order Tracker</a></li>
                        <li><a href="{{ route('giftcards.sell') }}" class="footer-link">Exchange Rates Policy</a></li>
                        <li><a href="https://wa.me/8801700000000" class="footer-link">24/7 WhatsApp Support</a></li>
                        <li><a href="#faq" class="footer-link">Frequently Asked Questions</a></li>
                        <li><a href="{{ route('admin.dashboard') }}" class="footer-link">Admin Portal Demo</a></li>
                    </ul>
                </div>

            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div>
                    &copy; {{ date('Y') }} <strong>RosTop</strong> (rostop.com). All rights reserved. Direct Platform &bull; No P2P Risk.
                </div>
                <div class="footer-trust-badges">
                    <span><i data-lucide="lock" class="icon"></i> 256-Bit SSL</span>
                    <span><i data-lucide="zap" class="icon"></i> Instant Delivery</span>
                    <span><i data-lucide="shield-check" class="icon"></i> Made for BD</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Lucide Icons (Self-Hosted Vendor) -->
    <script src="{{ asset('js/vendor/lucide.min.js') }}" defer></script>

    <!-- App JS -->
    <script src="{{ asset('js/app.js') }}?v={{ time() }}" defer></script>

    @stack('scripts')
</body>
</html>
