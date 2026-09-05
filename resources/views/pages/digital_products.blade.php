@extends('layouts.app')

@section('title', 'Genuine Software License Keys & Digital Tools | RosTop')
@section('meta_description', 'Official OEM license keys for Windows 11 Pro, Windows 10, Microsoft Office 2021, Antivirus, and developer tools in Bangladesh on rostop.com.')

@push('schema')
    {!! \App\Support\SeoSchema::render([
        \App\Support\SeoSchema::collectionPage(
            'Genuine Software License Keys & Digital Tools',
            'OEM license keys for Windows, Microsoft Office, Antivirus, and developer tools with instant delivery.',
            url()->current(),
            \App\Support\SeoSchema::itemList($products, 'Software & Digital Products')
        ),
        \App\Support\SeoSchema::breadcrumbs([['Home', url(route('home'))], ['Software & Digital Products', url()->current()]]),
    ]) !!}
@endpush

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 4rem;">

    @php
        // Sub-category pill map: [keyword in category name => [icon, short label]]
        $pillMap = [
            'OS & Productivity' => ['app-window', 'Windows & Office'],
            'Developer'         => ['code-2', 'Dev & Education'],
            'VPN'               => ['shield', 'VPN & Accounts'],
            'License Keys'      => ['key-round', 'License Keys'],
        ];
        $resolvePill = function (string $name) use ($pillMap) {
            foreach ($pillMap as $kw => [$ico, $lbl]) {
                if (str_contains($name, $kw)) return [$lbl, $ico];
            }
            return [$name, 'layers'];
        };
        $catGroups = $products->groupBy('category_id');
    @endphp

    <div style="margin-bottom: 1.75rem;">
        <div class="hero-badge">
            <i data-lucide="shield-check" class="icon" style="width:14px;height:14px;"></i>
            <span>100% Genuine OEM & Retail Digital Keys &bull; rostop.com</span>
        </div>
        <h1 style="font-size: 2.2rem; font-weight: 900; letter-spacing: -0.02em; margin-bottom: 0.5rem;">
            Software License Keys & Marketplace
        </h1>
        <p style="color: var(--text-muted); font-size: 0.95rem;">
            উইন্ডোজ ১১ প্রো, মাইক্রোসফট অফিস এবং অন্যান্য প্রোডাক্টিভিটি সফটওয়্যারের আসল লাইফটাইম লাইসেন্স কী কিনুন সাশ্রয়ী মূল্যে।
        </p>

        <!-- Trust Features Bar -->
        <div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:0.85rem;">
            <div class="pp-trust-badge">
                <i data-lucide="badge-check" class="icon" style="width:14px;height:14px;color:var(--vb-emerald);"></i>
                <span>100% Genuine Keys</span>
            </div>
            <div class="pp-trust-badge">
                <i data-lucide="zap" class="icon" style="width:14px;height:14px;color:var(--vb-orange);"></i>
                <span>Instant Email Delivery</span>
            </div>
            <div class="pp-trust-badge">
                <i data-lucide="headphones" class="icon" style="width:14px;height:14px;color:#38BDF8;"></i>
                <span>24/7 Live Support</span>
            </div>
        </div>
    </div>

    <!-- Sub-Category Filter Bar -->
    <div class="category-pills-bar" role="tablist" aria-label="Software categories">
        <button type="button" class="category-pill category-filter-pill active" data-category="all" aria-selected="true">
            <i data-lucide="layout-grid" class="icon"></i>
            <span>All Software ({{ $products->count() }})</span>
        </button>
        @foreach($catGroups as $catId => $group)
            @php [$pillLabel, $pillIcon] = $resolvePill(optional($group->first()->category)->name ?? 'Other'); @endphp
            <button type="button" class="category-pill category-filter-pill" data-category="cat-{{ $catId }}" aria-selected="false">
                <i data-lucide="{{ $pillIcon }}" class="icon"></i>
                <span>{{ $pillLabel }} ({{ $group->count() }})</span>
            </button>
        @endforeach
    </div>

    <div class="grid-cards">
        @foreach($products as $soft)
            @include('partials.service-card', [
                'service'      => $soft,
                'route'        => 'digital.products.show',
                'ctaLabel'     => 'Get License Key',
                'fallbackIcon' => 'key-round',
            ])
        @endforeach
    </div>

</div>
@endsection
