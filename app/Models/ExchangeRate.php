<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'buy_rate_percent' => 'float',
        'sell_rate_percent' => 'float',
        'bdt_conversion_rate' => 'float',
        'min_value' => 'float',
        'max_value' => 'float',
        'is_active' => 'boolean',
    ];
}
