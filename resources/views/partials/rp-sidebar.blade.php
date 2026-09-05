@php
    $isRail = $isRail ?? false;
@endphp
<div class="rp-sidebar-inner {{ $isRail ? 'rp-is-rail' : 'rp-is-drawer' }}">

    <!-- Slim Brand & Action Bar (profile moved to very bottom) -->
    <div class="rp-brand-bar">
        <div class="rp-brand-left">
            <span class="rp-brand-mark"><i data-lucide="zap" class="icon"></i></span>
            <span class="rp-brand-word">Ros<span style="color: var(--primary);">Top</span></span>
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

    <!-- Scrollable Navigation Area -->
    {{-- Quick Search pill removed per UX revamp: search lives in header icon + Ctrl+K --}}
    <div class="rp-scroll-area">

        <!-- Navigation Group: RosTop Services -->
        <div class="rp-nav-group">
            <div class="rp-group-title">Services</div>
            <ul class="rp-nav-list">
                <li>
                    <a href="{{ route('home') }}" class="rp-nav-item {{ request()->routeIs('home') || request()->routeIs('l.home') ? 'active' : '' }}" title="{{ __('ui.nav_home') }}">
                        <span class="rp-item-icon"><i data-lucide="home" class="icon"></i></span>
                        <span class="rp-item-label">{{ __('ui.nav_home') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('game.topup') }}" class="rp-nav-item {{ request()->routeIs('game.*') || request()->routeIs('l.game.*') ? 'active' : '' }}" title="{{ __('ui.nav_game_topup') }}">
                        <span class="rp-item-icon"><i data-lucide="gamepad-2" class="icon"></i></span>
                        <span class="rp-item-label">{{ __('ui.nav_game_topup') }}</span>
                        <span class="rp-chip-pill rp-chip-instant">Instant</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('giftcards.sell') }}" class="rp-nav-item {{ request()->routeIs('giftcards.sell*') || request()->routeIs('l.giftcards.sell*') ? 'active' : '' }}" title="{{ __('ui.nav_sell_cards') }}">
                        <span class="rp-item-icon"><i data-lucide="wallet" class="icon"></i></span>
                        <span class="rp-item-label">{{ __('ui.nav_sell_cards') }}</span>
                        <span class="rp-chip-amber">90%</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('giftcards.buy') }}" class="rp-nav-item {{ request()->routeIs('giftcards.buy*') || request()->routeIs('l.giftcards.buy*') ? 'active' : '' }}" title="{{ __('ui.nav_buy_cards') }}">
                        <span class="rp-item-icon"><i data-lucide="gift" class="icon"></i></span>
                        <span class="rp-item-label">{{ __('ui.nav_buy_cards') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('subscriptions') }}" class="rp-nav-item {{ request()->routeIs('subscriptions*') || request()->routeIs('l.subscriptions*') ? 'active' : '' }}" title="{{ __('ui.nav_subscriptions') }}">
                        <span class="rp-item-icon"><i data-lucide="tv" class="icon"></i></span>
                        <span class="rp-item-label">{{ __('ui.nav_subscriptions') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('digital.products') }}" class="rp-nav-item {{ request()->routeIs('digital.products*') || request()->routeIs('l.digital.products*') ? 'active' : '' }}" title="{{ __('ui.nav_software') }}">
                        <span class="rp-item-icon"><i data-lucide="key-round" class="icon"></i></span>
                        <span class="rp-item-label">{{ __('ui.nav_software') }}</span>
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
                    <a href="{{ route('track.order') }}" class="rp-nav-item {{ request()->routeIs('track.*') || request()->routeIs('l.track.*') ? 'active' : '' }}" title="{{ __('ui.nav_track_order') }}">
                        <span class="rp-item-icon"><i data-lucide="map-pin" class="icon"></i></span>
                        <span class="rp-item-label">{{ __('ui.nav_track_order') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('support') }}" class="rp-nav-item {{ request()->routeIs('support') || request()->routeIs('l.support') ? 'active' : '' }}" title="{{ __('ui.nav_support') }}">
                        <span class="rp-item-icon"><i data-lucide="headphones" class="icon"></i></span>
                        <span class="rp-item-label">{{ __('ui.nav_support') }}</span>
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

        <!-- Navigation Group: Preferences & Region -->
        <div class="rp-nav-group">
            <div class="rp-group-title">Preferences</div>
            <ul class="rp-nav-list">
                <li>
                    <button type="button" class="rp-nav-item rp-lc-trigger" id="drawer-lc-trigger" title="{{ __('ui.language_currency') ?? 'Language & Currency' }}" style="width: 100%; border: none; background: transparent; text-align: left; cursor: pointer;">
                        <span class="rp-item-icon">
                            <img src="{{ asset('images/flags/bd.svg') }}" alt="BD" class="rp-nav-flag" id="drawer-flag-img" style="width: 20px; height: 14px; border-radius: 3px; object-fit: cover; box-shadow: 0 0 0 1px rgba(255,255,255,0.15);">
                        </span>
                        <span class="rp-item-label" id="drawer-lc-label">BN-BD / BDT</span>
                        <span class="rp-chip-pill rp-chip-currency" id="drawer-curr-chip" style="font-size: 0.72rem; font-weight: 700; background: rgba(31, 163, 126, 0.15); color: var(--accent-cta); padding: 0.18rem 0.45rem; border-radius: 6px;">৳ BDT</span>
                    </button>
                </li>
            </ul>
        </div>

    </div>

    <!-- Bottom Footer Area (theme pill only — Support/Track links now live in the scroll area above) -->
    <div class="rp-footer-area">
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

    <!-- Profile / Login / Logout — pinned to bottom -->
    <div class="rp-user-card">
        @auth
            <div class="rp-profile-user">
                <div class="rp-avatar" title="{{ auth()->user()->name }}">
                    <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    <span class="rp-avatar-badge" title="Verified Member"><i data-lucide="check" class="icon"></i></span>
                </div>
                <div class="rp-user-info">
                    <div class="rp-user-meta">
                        <span class="rp-greeting rp-greeting-text">Welcome back</span>
                        @if(auth()->user()->is_admin)
                            <span class="rp-badge-admin">Admin</span>
                        @else
                            <span class="rp-badge-verified">Verified</span>
                        @endif
                    </div>
                    <div class="rp-user-name">{{ auth()->user()->name }}</div>
                    <div class="rp-user-balance-bar">
                        <span class="rp-balance-chip" title="Wallet Balance">
                            <i data-lucide="wallet" class="icon"></i>
                            <span class="rp-balance-val">৳ {{ number_format(auth()->user()->balance ?? 0, 2) }}</span>
                        </span>
                    </div>
                    <div class="rp-user-actions">
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="rp-btn-user-sub" title="Admin Portal">
                                <i data-lucide="shield" class="icon"></i>
                                <span>Admin</span>
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="m-0 d-inline-block">
                            @csrf
                            <button type="submit" class="rp-btn-logout" title="{{ __('ui.logout') }}">
                                <i data-lucide="log-out" class="icon"></i>
                                <span>{{ __('ui.logout') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="rp-profile-guest">
                <div class="rp-guest-header">
                    <div class="rp-avatar rp-avatar-guest" title="{{ __('ui.guest_user') }}">
                        <i data-lucide="user" class="icon"></i>
                    </div>
                    <div class="rp-user-info">
                        <div class="rp-greeting">{{ __('ui.welcome_guest') ?? 'Welcome to RosTop' }}</div>
                        <div class="rp-guest-subtext">Instant Top-Up &amp; Cashout</div>
                    </div>
                </div>
                <div class="rp-guest-buttons">
                    <a href="{{ route('login') }}" class="rp-btn-signin" title="{{ __('ui.login') ?? 'Sign In' }}">
                        <i data-lucide="log-in" class="icon"></i>
                        <span>{{ __('ui.login') ?? 'Sign In' }}</span>
                    </a>
                    <a href="{{ route('login') }}" class="rp-btn-signup" title="{{ __('ui.register') ?? 'Create Account' }}">
                        <i data-lucide="user-plus" class="icon"></i>
                        <span>{{ __('ui.register') ?? 'Sign Up' }}</span>
                    </a>
                </div>
            </div>
        @endauth
    </div>

</div>
