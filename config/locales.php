<?php

/*
| RosTop Localization & Currency tables (no DB changes required).
| Single source of truth for the language/country/currency pickers.
*/

return [

    'supported_locales' => ['en', 'bn', 'hi'],

    // Display order matters (English first = default)
    'locales' => [
        ['code' => 'en', 'label' => 'English', 'native' => 'English',  'hreflang' => 'en'],
        ['code' => 'bn', 'label' => 'Bangla',  'native' => 'বাংলা',   'hreflang' => 'bn-BD'],
        ['code' => 'hi', 'label' => 'Hindi',   'native' => 'हिन्दी',   'hreflang' => 'hi-IN'],
    ],

    'country_defaults' => [ /* ISO3166 alpha-2 → country key */ ],
    'default_country'  => 'BD',
    'default_currency' => 'BDT',
    'default_locale'   => 'en',

    'countries' => [
        ['code' => 'BD', 'name' => 'Bangladesh',      'flag' => 'bd', 'currency' => 'BDT',
         'methods' => 'bKash, Nagad, Rocket, Upay'],
        ['code' => 'IN', 'name' => 'India',           'flag' => 'in', 'currency' => 'INR',
         'methods' => 'UPI, PayTM, RuPay, USDT'],
        ['code' => 'US', 'name' => 'United States',   'flag' => 'us', 'currency' => 'USD',
         'methods' => 'USDT (TRC20/BEP20), Binance Pay, Visa/MC'],
        ['code' => 'AE', 'name' => 'United Arab Emirates', 'flag' => 'ae', 'currency' => 'AED',
         'methods' => 'PayBy, Botim, Card, USDT'],
        ['code' => 'SA', 'name' => 'Saudi Arabia',    'flag' => 'sa', 'currency' => 'SAR',
         'methods' => 'STC Pay, Urpay, Mada, USDT'],
        ['code' => 'GB', 'name' => 'United Kingdom',  'flag' => 'gb', 'currency' => 'GBP',
         'methods' => 'Faster Payments, Apple Pay, Card'],
        ['code' => 'EU', 'name' => 'Europe (Eurozone)', 'flag' => 'eu', 'currency' => 'EUR',
         'methods' => 'Paysafecard, Transcash, SEPA Instant'],
    ],

    'currencies' => [
        ['code' => 'BDT', 'name' => 'Bangladeshi Taka', 'sym' => '৳',    'rate' => 1.0],
        ['code' => 'INR', 'name' => 'Indian Rupee',     'sym' => '₹',    'rate' => 1.49],
        ['code' => 'USD', 'name' => 'US Dollar',        'sym' => '$',    'rate' => 124.50],
        ['code' => 'EUR', 'name' => 'Euro',             'sym' => '€',    'rate' => 135.20],
        ['code' => 'GBP', 'name' => 'British Pound',    'sym' => '£',    'rate' => 158.00],
        ['code' => 'AED', 'name' => 'UAE Dirham',       'sym' => 'AED',  'rate' => 33.90],
        ['code' => 'SAR', 'name' => 'Saudi Riyal',      'sym' => 'SAR',  'rate' => 33.20],
        ['code' => 'USDT','name' => 'Tether USD',       'sym' => '₮',    'rate' => 124.50],
    ],
];
