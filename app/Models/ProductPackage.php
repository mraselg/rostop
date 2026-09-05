<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPackage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'amount_val' => 'float',
        'price_bdt' => 'float',
        'payout_bdt' => 'float',
        'original_price_bdt' => 'float',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
