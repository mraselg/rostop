@php
    $isRail = $isRail ?? false;
@endphp
<div class="rp-sidebar-inner {{ $isRail ? 'rp-is-rail' : 'rp-is-drawer' }}">

    <!-- Top Profile & Greeting Bar -->
    <div class="rp-profile-bar">
        <div class="rp-profile-user">
            @auth
                <div class="rp-avatar" title="{{ auth()->user()->name }}">
                    <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    <span class="rp-avatar-badge" title="Verified Account"><i data-lucide="check" class="icon"></i></span>
                </div>
                <div class="rp-user-info">
                    <div class="rp-greeting">Good day</div>
                    <div class="rp-user-name">{{ auth()->user()->name }}</div>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="rp-login-link" style="background: none; border: none; padding: 0; cursor: pointer;">
                            <span>Logout</span>
                            <i data-lucide="log-out" class="icon"></i>
                        </button>
                    </form>
                </div>
            @else
                <div class="rp-avatar rp-avatar-guest" title="Guest User">
                    <i data-lucide="user" class="icon"></i>
                </div>
                <div class="rp-user-info">
                    <div class="rp-greeting">Welcome to RosTop</div>
                    <a href="{{ route('login') }}" class="rp-login-link" title="Sign in or Register">
                        <span>Login / Register</span>
                        <i data-lucide="arrow-up-right" class="icon"></i>
                    </a>
                </div>
            @endauth
        </div>

        <div class="rp-profile-actions">
            @if($isRail)
                <button type="button" class="rp-icon-btn rp-pin-btn" title="Pin / Unpin Sidebar" aria-label="Pin Sidebar">
                    <i data-lucide="pin" class="icon rp-pin-icon"></i>
                </button>
            @else
                <button type="button" class="rp-icon-btn rp-close-btn" id="mobile-drawer-close-btn" aria-label="Close Menu" title="Close Menu">
                    <i data-lucide="x" class="icon"></i>
                </button>
            @endif
        </div>
    </div>

    <!-- Quick Search Pill -->
    <div class="rp-search-wrap">
        <button type="button" class="rp-search-btn rp-search-trigger" title="Search services, cards, games (Ctrl+K)">
            <span class="rp-search-left">
                <i data-lucide="search" class="icon rp-search-icon"></i>
                <span class="rp-search-label">Quick Search</span>
            </span>
            <kbd class="rp-search-kbd">⌘K</kbd>
        </button>
    </div>

    <!-- Scrollable Navigation Area -->
    <div class="rp-scroll-area">

        <!-- Navigation Group: RosTop Services -->
        <div class="rp-nav-group">
            <div class="rp-group-title">Services</div>
            <ul class="rp-nav-list">
                <li>
                    <a href="{{ route('home') }}" class="rp-nav-item {{ request()->routeIs('home') ? 'active' : '' }}" title="Home">
                        <span class="rp-item-icon"><i data-lucide="home" class="icon"></i></span>
                        <span class="rp-item-label">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('game.topup') }}" class="rp-nav-item {{ request()->routeIs('game.*') ? 'active' : '' }}" title="Game Top-Up">
                        <span class="rp-item-icon"><i data-lucide="gamepad-2" class="icon"></i></span>
                        <span class="rp-item-label">Game Top-Up</span>
                        <span class="rp-chip-pill rp-chip-instant">Instant</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('giftcards.sell') }}" class="rp-nav-item {{ request()->routeIs('giftcards.sell*') ? 'active' : '' }}" title="Sell Cards">
                        <span class="rp-item-icon"><i data-lucide="wallet" class="icon"></i></span>
                        <span class="rp-item-label">Sell Cards</span>
                        <span class="rp-chip-amber">90%</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('giftcards.buy') }}" class="rp-nav-item {{ request()->routeIs('giftcards.buy*') ? 'active' : '' }}" title="Buy Cards">
                        <span class="rp-item-icon"><i data-lucide="gift" class="icon"></i></span>
                        <span class="rp-item-label">Buy Cards</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('subscriptions') }}" class="rp-nav-item {{ request()->routeIs('subscriptions*') ? 'active' : '' }}" title="Subscriptions">
                        <span class="rp-item-icon"><i data-lucide="tv" class="icon"></i></span>
                        <span class="rp-item-label">Subscriptions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('digital.products') }}" class="rp-nav-item {{ request()->routeIs('digital.products*') ? 'active' : '' }}" title="Software & Licenses">
                        <span class="rp-item-icon"><i data-lucide="key-round" class="icon"></i></span>
                        <span class="rp-item-label">Software</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Accordion Group: Sell Vouchers / Rates -->
        <div class="rp-nav-group rp-accordion-group">
            <button type="button" class="rp-nav-item rp-accordion-btn" aria-expanded="false" title="Sell Voucher Rates">
                <span class="rp-item-icon"><i data-lucide="badge-percent" class="icon"></i></span>
                <span class="rp-item-label">Sell Vouchers</span>
                <i data-lucide="chevron-down" class="icon rp-accordion-caret"></i>
            </button>
            <div class="rp-subnav-panel">
                <ul class="rp-subnav-list">
                    <li>
                        <a href="{{ route('giftcards.sell') }}" class="rp-subnav-item" title="Sell Paysafecard">
                            <span class="rp-subnav-bullet"></span>
                            <span class="rp-subnav-label">Paysafecard</span>
                            <span class="rp-rate-chip">86%</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('giftcards.sell') }}" class="rp-subnav-item" title="Sell Transcash">
                            <span class="rp-subnav-bullet"></span>
                            <span class="rp-subnav-label">Transcash</span>
                            <span class="rp-rate-chip rp-rate-best">90%</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('giftcards.sell') }}" class="rp-subnav-item" title="Sell Apple Gift Cards">
                            <span class="rp-subnav-bullet"></span>
                            <span class="rp-subnav-label">Apple / iTunes</span>
                            <span class="rp-rate-chip">88%</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('giftcards.sell') }}" class="rp-subnav-item" title="Sell Neosurf">
                            <span class="rp-subnav-bullet"></span>
                            <span class="rp-subnav-label">Neosurf PIN</span>
                            <span class="rp-rate-chip">84%</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Navigation Group: Orders & Support -->
        <div class="rp-nav-group">
            <div class="rp-group-title">Support &amp; Orders</div>
            <ul class="rp-nav-list">
                <li>
                    <a href="{{ route('track.order') }}" class="rp-nav-item {{ request()->routeIs('track.*') ? 'active' : '' }}" title="Track Order">
                        <span class="rp-item-icon"><i data-lucide="map-pin" class="icon"></i></span>
                        <span class="rp-item-label">Track Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('support') }}" class="rp-nav-item {{ request()->routeIs('support') ? 'active' : '' }}" title="24/7 Live Support">
                        <span class="rp-item-icon"><i data-lucide="headphones" class="icon"></i></span>
                        <span class="rp-item-label">Live Support</span>
                        <span class="rp-chip-pill rp-chip-live"><span class="rp-live-dot"></span> Live</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}#faq" class="rp-nav-item" title="FAQ">
                        <span class="rp-item-icon"><i data-lucide="help-circle" class="icon"></i></span>
                        <span class="rp-item-label">FAQ</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Region & Currency Card (Photo Style SaaS Card) -->
        <div class="rp-region-card">
            <div class="rp-region-card-top">
                <div class="rp-region-card-title">
                    <i data-lucide="globe" class="icon"></i>
                    <span>Region &amp; Currency</span>
                </div>
                <button type="button" class="rp-country-select-btn rp-open-curr-modal" title="Change Country">
                    <span class="rp-country-flag rp-dyn-flag">🇧🇩</span>
                    <span class="rp-country-name rp-dyn-country">Bangladesh</span>
                    <i data-lucide="chevron-right" class="icon rp-country-caret"></i>
                </button>
            </div>

            <!-- Currency Select Chips -->
            <div class="rp-curr-chips-grid" role="group" aria-label="Select Currency">
                <button type="button" class="rp-curr-chip active" data-curr="BDT" data-flag="🇧🇩" data-sym="৳" data-rate="1">BDT</button>
                <button type="button" class="rp-curr-chip" data-curr="USD" data-flag="🇺🇸" data-sym="$" data-rate="124.5">USD</button>
                <button type="button" class="rp-curr-chip" data-curr="EUR" data-flag="🇪🇺" data-sym="€" data-rate="135.2">EUR</button>
                <button type="button" class="rp-curr-chip" data-curr="GBP" data-flag="🇬🇧" data-sym="£" data-rate="158">GBP</button>
                <button type="button" class="rp-curr-chip" data-curr="INR" data-flag="🇮🇳" data-sym="₹" data-rate="1.49">INR</button>
                <button type="button" class="rp-curr-chip" data-curr="AED" data-flag="🇦🇪" data-sym="د.إ" data-rate="33.9">AED</button>
                <button type="button" class="rp-curr-chip" data-curr="SAR" data-flag="🇸🇦" data-sym="﷼" data-rate="33.2">SAR</button>
            </div>
            <div class="rp-region-hint">Instant price adaptation on site</div>
        </div>

    </div>

    <!-- Bottom Footer Area -->
    <div class="rp-footer-area">
        <div class="rp-footer-links">
            <a href="{{ auth()->check() && auth()->user()->is_admin ? route('admin.dashboard') : route('login') }}" class="rp-footer-btn" title="{{ auth()->check() && auth()->user()->is_admin ? 'Admin Portal' : 'Login / Register' }}">
                <i data-lucide="{{ auth()->check() && auth()->user()->is_admin ? 'settings' : 'user' }}" class="icon"></i>
                <span>{{ auth()->check() && auth()->user()->is_admin ? 'Admin' : 'Login' }}</span>
            </a>
            <a href="{{ route('support') }}" class="rp-footer-btn" title="Support Help Desk">
                <i data-lucide="life-buoy" class="icon"></i>
                <span>Support</span>
            </a>
        </div>

        <!-- Light | Dark Segmented Pill (Photo Exact) -->
        <div class="rp-theme-pill" role="radiogroup" aria-label="Theme mode switcher">
            <button type="button" class="rp-theme-opt rp-opt-light" data-theme-val="light" role="radio" aria-checked="false" title="Light Mode">
                <i data-lucide="sun" class="icon"></i>
                <span>Light</span>
            </button>
            <button type="button" class="rp-theme-opt rp-opt-dark" data-theme-val="dark" role="radio" aria-checked="false" title="Dark Mode">
                <i data-lucide="moon" class="icon"></i>
                <span>Dark</span>
            </button>
            <div class="rp-theme-slider" aria-hidden="true"></div>
        </div>
    </div>

</div>
