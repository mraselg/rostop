<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'input_fields_schema' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'rate_percentage' => 'float',
        'base_price_bdt' => 'float',
        'base_price_usd' => 'float',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function packages(): HasMany
    {
        return $this->hasMany(ProductPackage::class)->orderBy('sort_order', 'asc');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Stock & offer state (computed from the loaded packages relation).
     * manual_topup products are always available — codes are fulfilled by hand.
     */
    public function getIsOutOfStockAttribute(): bool
    {
        if ($this->stock_type === 'manual_topup') {
            return false;
        }

        $packages = $this->packages;

        return $packages->isEmpty() || (int) $packages->sum('stock_count') <= 0;
    }

    /** Scarcest remaining option count (0 when everything is empty). */
    public function getLowestPositiveStockAttribute(): int
    {
        $positive = $this->packages->pluck('stock_count')->map(fn($s) => (int) $s)->filter(fn($s) => $s > 0);

        return $positive->isEmpty() ? 0 : (int) $positive->min();
    }

    /** Low stock = any remaining option below the threshold, but not fully out. */
    public function getIsLowStockAttribute(): bool
    {
        if ($this->is_out_of_stock || $this->stock_type === 'manual_topup') {
            return false;
        }

        return $this->lowest_positive_stock < 20;
    }

    /** Best active discount percentage across packages, or null when no offer. */
    public function getBestDiscountPercentAttribute(): ?int
    {
        $best = null;
        foreach ($this->packages as $pkg) {
            if ($pkg->original_price_bdt && $pkg->price_bdt > 0 && $pkg->original_price_bdt > $pkg->price_bdt) {
                $pct  = (int) round((1 - ($pkg->price_bdt / $pkg->original_price_bdt)) * 100);
                $best = max($best ?? 0, $pct);
            }
        }

        return $best;
    }

    /** Original (pre-discount) price of the cheapest package — used for the strike-through. */
    public function getStrikeOriginalPriceAttribute(): ?float
    {
        $min = $this->packages->sortBy('price_bdt')->first();

        return ($min && $min->original_price_bdt > $min->price_bdt) ? (float) $min->original_price_bdt : null;
    }
}
