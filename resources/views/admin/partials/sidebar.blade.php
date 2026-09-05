<div class="adm-overlay" id="adm-overlay"></div>
<aside class="adm-sidebar" id="adm-sidebar">
    <nav class="adm-nav">
        <div class="adm-nav-title">Management</div>

        <a href="{{ route('admin.dashboard') }}" class="adm-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i data-lucide="layout-dashboard" class="icon"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="adm-nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <i data-lucide="shopping-cart" class="icon"></i>
            <span>Orders</span>
            @php $admPending = \App\Models\Order::where('status', 'pending')->count(); @endphp
            @if($admPending > 0)
                <span class="adm-nav-badge">{{ $admPending }}</span>
            @endif
        </a>

        <a href="{{ route('admin.products.index') }}" class="adm-nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i data-lucide="package" class="icon"></i>
            <span>Products</span>
        </a>

        <a href="{{ route('admin.categories.index') }}" class="adm-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i data-lucide="folder-tree" class="icon"></i>
            <span>Categories</span>
        </a>

        <a href="{{ route('admin.rates.index') }}" class="adm-nav-item {{ request()->routeIs('admin.rates.*') ? 'active' : '' }}">
            <i data-lucide="badge-percent" class="icon"></i>
            <span>Exchange Rates</span>
        </a>

        <a href="{{ route('admin.reviews.index') }}" class="adm-nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
            <i data-lucide="star" class="icon"></i>
            <span>Reviews</span>
        </a>

        <div class="adm-nav-title">Accounts</div>

        <a href="{{ route('admin.users.index') }}" class="adm-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i data-lucide="users" class="icon"></i>
            <span>Users</span>
        </a>

        <div class="adm-nav-title">Shortcuts</div>

        <a href="{{ route('home') }}" class="adm-nav-item">
            <i data-lucide="globe" class="icon"></i>
            <span>View Live Site</span>
        </a>
        <a href="{{ route('track.order') }}" class="adm-nav-item">
            <i data-lucide="map-pin" class="icon"></i>
            <span>Order Tracker</span>
        </a>
    </nav>
</aside>
