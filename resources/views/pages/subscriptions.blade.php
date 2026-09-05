@extends('layouts.app')

@section('title', 'Digital Subscriptions & OTT Accounts (Netflix, ChatGPT, Canva) | RosTop')
@section('meta_description', 'Buy Netflix Premium 4K UHD, ChatGPT Plus, Canva Pro, and Spotify in Bangladesh on rostop.com with full replacement warranty and instant delivery.')

@push('schema')
    {!! \App\Support\SeoSchema::render([
        \App\Support\SeoSchema::collectionPage(
            'Digital Subscriptions & OTT Accounts',
            'Netflix Premium 4K UHD, ChatGPT Plus, Canva Pro and more with full replacement warranty and instant delivery.',
            url()->current(),
            \App\Support\SeoSchema::itemList($products, 'Digital Subscriptions')
        ),
        \App\Support\SeoSchema::breadcrumbs([['Home', url(route('home'))], ['Subscriptions', url()->current()]]),
    ]) !!}
@endpush

@section('content')
<div class="container" style="padding-top: 2rem; padding-bottom: 4rem;">

    @php
        // Sub-category pill map: [keyword in category name => [icon, short label]]
        $pillMap = [
            'AI Tools'             => ['bot', 'AI Tools'],
            'Design'               => ['palette', 'Design & Creative'],
            'Entertainment'        => ['tv', 'OTT & Streaming'],
            'Digital Subscriptions'=> ['crown', 'Subscriptions'],
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
            <span>Premium Accounts &bull; Full Warranty &bull; rostop.com</span>
        </div>
        <h1 style="font-size: 2.2rem; font-weight: 900; letter-spacing: -0.02em; margin-bottom: 0.5rem;">
            Digital Subscriptions & OTT
        </h1>
        <p style="color: var(--text-muted); font-size: 0.95rem;">
            নেটফ্লিক্স, চ্যাটজিপিটি প্লাস, ক্যানভা প্রো ও স্পটিফাই প্রিমিয়াম সাবস্ক্রিপশন কিনুন সাশ্রয়ী মূল্যে সরাসরি বিকাশ ও নগদের মাধ্যমে।
        </p>

        <!-- Trust Features Bar -->
        <div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:0.85rem;">
            <div class="pp-trust-badge">
                <i data-lucide="badge-check" class="icon" style="width:14px;height:14px;color:var(--vb-emerald);"></i>
                <span>Full Replacement Warranty</span>
            </div>
            <div class="pp-trust-badge">
                <i data-lucide="zap" class="icon" style="width:14px;height:14px;color:var(--vb-orange);"></i>
                <span>Instant Activation</span>
            </div>
            <div class="pp-trust-badge">
                <i data-lucide="headphones" class="icon" style="width:14px;height:14px;color:#38BDF8;"></i>
                <span>24/7 Live Support</span>
            </div>
        </div>
    </div>

    <!-- Sub-Category Filter Bar -->
    <div class="category-pills-bar" role="tablist" aria-label="Subscription categories">
        <button type="button" class="category-pill category-filter-pill active" data-category="all" aria-selected="true">
            <i data-lucide="layout-grid" class="icon"></i>
            <span>All Services ({{ $products->count() }})</span>
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
        @foreach($products as $sub)
            @include('partials.service-card', [
                'service'      => $sub,
                'route'        => 'subscriptions.show',
                'ctaLabel'     => 'Get Access',
                'fallbackIcon' => 'crown',
            ])
        @endforeach
    </div>

</div>
@endsection
