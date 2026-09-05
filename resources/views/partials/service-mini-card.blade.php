{{--
    Compact marketplace card (mini) for related products & home sections.
    Required vars: $service (Product with packages loaded), $route (detail route name).
    Optional: $ctaLabel (default "View").
--}}
@php
    use App\Support\BrandLogos;

    $brand        = $service->brand_color ?: '#1FA37E';
    $isOutStock   = $service->is_out_of_stock;
    $isLowStock   = $service->is_low_stock;
    $stockLeft    = $service->lowest_positive_stock;
    $bestDiscount = $service->best_discount_percent;
    $hasOffer     = $bestDiscount !== null && !$isOutStock;
    $strike       = $service->strike_original_price;

    $logoFile  = BrandLogos::logo($service->slug);
    $icon      = BrandLogos::icon($service->slug, $fallbackIcon ?? 'key-round');
    $tileLight = !$logoFile && BrandLogos::isVeryDark($brand, 0.06);
    $overlay   = BrandLogos::overlay($brand);

    $ctaLabel = $ctaLabel ?? 'View';
@endphp

<a href="{{ route($route, $service->slug) }}"
   class="hp-mini-card h-100 hpm-card {{ $isOutStock ? 'is-out-of-stock' : '' }}"
   style="--brand: {{ $brand }};"
   title="{{ $service->title }}"
   aria-label="{{ $service->title }} - {{ $isOutStock ? 'currently out of stock' : 'price from BDT ' . number_format($service->base_price_bdt) }} on RosTop">

    <div class="hp-mini-thumb hpm-thumb" style="background: {{ $overlay }};">
        @if($logoFile)
            <div class="hpm-tile hpm-tile-logo">
                <img src="{{ asset('images/brands/' . $logoFile) }}" class="hpm-logo-img" width="30" height="30"
                     loading="lazy" decoding="async" alt="{{ $service->title }} brand logo">
            </div>
        @else
            <div class="hpm-tile {{ $tileLight ? 'hpm-tile-light' : '' }}">
                <i data-lucide="{{ $icon }}"></i>
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
            <span class="svc-chip tr off"><i data-lucide="ticket-percent" aria-hidden="true"></i> {{ $bestDiscount }}% OFF</span>
        @elseif($service->tag_badge)
            <span class="svc-chip tr tag">{{ \Illuminate\Support\Str::limit($service->tag_badge, 18) }}</span>
        @endif
    </div>

    <div class="hp-mini-body">
        <h3 class="hp-mini-title" title="{{ $service->title }}">{{ $service->title }}</h3>
        <div class="hp-mini-priceline">
            <span class="hp-mini-from">From</span>
            <span class="hp-mini-price" data-bdt="{{ $service->base_price_bdt }}">&#2547; {{ number_format($service->base_price_bdt) }}</span>
            @if($strike)
                <span class="hpm-price-old">&#2547; {{ number_format($strike) }}</span>
            @endif
        </div>
        @if($isOutStock)
            <span class="hpm-btn-out">
                <i data-lucide="circle-off" aria-hidden="true"></i> Out of Stock
            </span>
        @else
            <span class="hp-mini-btn"><span>{{ $ctaLabel }}</span></span>
        @endif
    </div>
</a>
