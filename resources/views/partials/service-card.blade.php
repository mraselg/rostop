{{--
    Reusable marketplace service/product card (v2).
    Required vars: $service (Product with packages + category), $route (detail route name).
    Optional: $ctaLabel (default "View Deal"), $fallbackIcon (lucide name used when no slug match).
--}}
@php
    use App\Support\BrandLogos;

    $packages    = $service->packages;
    $packagesCnt = $packages->count();
    $brand       = $service->brand_color ?: '#1FA37E';

    // Stock & offer state (centralized accessors on the Product model)
    $isOutStock     = $service->is_out_of_stock;
    $isLowStock     = $service->is_low_stock;
    $stockLeft      = $service->lowest_positive_stock;
    $bestDiscount   = $service->best_discount_percent;
    $hasOffer       = $bestDiscount !== null && !$isOutStock;
    $strikeOriginal = $service->strike_original_price;

    // Brand identity: official SVG logo first, luminance-aware lucide tile fallback
    $logoFile  = BrandLogos::logo($service->slug);
    $icon      = BrandLogos::icon($service->slug, $fallbackIcon ?? 'key-round');
    $tileLight = !$logoFile && BrandLogos::isVeryDark($brand, 0.06);
    $overlay   = BrandLogos::overlay($brand);

    // Short sub-category label + delivery hint
    $catShort = BrandLogos::categoryShort(optional($service->category)->name ?? 'Digital');
    $deliveryText = match ($service->stock_type) {
        'auto_code'      => 'Instant Auto Code',
        'account_login'  => 'Login Access',
        default          => 'Fast 5-30 Min',
    };

    $ctaLabel  = $ctaLabel ?? 'View Deal';
    $detailUrl = route($route, $service->slug);
@endphp

<a href="{{ $detailUrl }}"
   class="product-card svc-card filterable-card {{ $isOutStock ? 'is-out-of-stock' : '' }}"
   style="--brand: {{ $brand }};"
   data-category="cat-{{ $service->category_id }}"
   title="{{ $service->title }}"
   aria-label="{{ $service->title }} - {{ $isOutStock ? 'currently out of stock' : 'price from BDT ' . number_format($service->base_price_bdt) }} on RosTop">

    <div class="product-thumb-wrap svc-thumb" style="background: {{ $overlay }};">
        <i data-lucide="{{ $icon }}" class="svc-thumb-watermark" aria-hidden="true"></i>

        @if($logoFile)
            <div class="svc-logo-tile svc-tile-logo">
                <img src="{{ asset('images/brands/' . $logoFile) }}" class="svc-logo-img" width="30" height="30"
                     loading="lazy" decoding="async" alt="{{ $service->title }} brand logo">
            </div>
        @else
            <div class="svc-logo-tile {{ $tileLight ? 'svc-tile-light' : '' }}">
                <i data-lucide="{{ $icon }}" aria-hidden="true"></i>
            </div>
        @endif

        {{-- Stock status chip (top-left) --}}
        @if($isOutStock)
            <span class="svc-chip tl out"><i data-lucide="package-x" aria-hidden="true"></i> Out of Stock</span>
        @elseif($isLowStock)
            <span class="svc-chip tl low"><i data-lucide="package-check" aria-hidden="true"></i> Only {{ $stockLeft }} left</span>
        @else
            <span class="svc-chip tl in"><i data-lucide="package-check" aria-hidden="true"></i> In Stock</span>
        @endif

        {{-- Offer or tag badge (top-right) --}}
        @if($hasOffer)
            <span class="svc-chip tr off"><i data-lucide="ticket-percent" aria-hidden="true"></i> Up to {{ $bestDiscount }}% OFF</span>
        @elseif($service->tag_badge)
            <span class="svc-chip tr tag">{{ $service->tag_badge }}</span>
        @endif
    </div>

    <div class="product-content">
        <div class="svc-meta-row">
            <span class="svc-cat-chip">{{ $catShort }}</span>
            <span class="svc-delivery"><i data-lucide="zap" aria-hidden="true"></i> {{ $deliveryText }}</span>
        </div>

        <h2 class="product-title svc-title">{{ $service->title }}</h2>
        <p class="product-subtitle">{{ $service->short_desc }}</p>

        @if($packagesCnt > 0)
            <div style="margin: 0 0 0.75rem; display: flex; flex-wrap: wrap; gap: 4px;">
                @foreach($packages->take(3) as $pkg)
                    <span class="product-pkg-chip" title="{{ $pkg->name }} - ৳{{ number_format($pkg->price_bdt) }}">
                        {{ \Illuminate\Support\Str::limit($pkg->name, 22) }}
                    </span>
                @endforeach
                @if($packagesCnt > 3)
                    <span class="product-pkg-chip svc-chip-more" title="{{ $packagesCnt }} packages available">+{{ $packagesCnt - 3 }}</span>
                @endif
            </div>
        @endif

        <div class="product-footer">
            <div>
                <div class="product-price-label">Starts At</div>
                <div class="svc-price-line">
                    <span class="product-price-val svc-price">৳ {{ number_format($service->base_price_bdt) }}</span>
                    @if($strikeOriginal)
                        <span class="svc-price-old">৳ {{ number_format($strikeOriginal) }}</span>
                    @endif
                </div>
            </div>
            @if($isOutStock)
                <span class="btn btn-primary btn-sm svc-btn-disabled" aria-disabled="true">
                    <i data-lucide="circle-off" class="icon" style="width:13px;height:13px;"></i> Out of Stock
                </span>
            @else
                <span class="btn btn-primary btn-sm">{{ $ctaLabel }} →</span>
            @endif
        </div>
    </div>
</a>
