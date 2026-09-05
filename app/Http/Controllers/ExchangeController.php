<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ExchangeController extends Controller
{
    /**
     * RosTop Dedicated Gift Card Sell Portal
     */
    public function sellIndex(Request $request): View
    {
        $rates = ExchangeRate::where('is_active', true)->get();
        $selectedBrand = $request->query('brand', 'apple');
        $prefillAmount = (float) $request->query('amount', 50);
        $prefillCurrency = $request->query('currency', 'USD');

        // Pre-calculation: correct payout shown instantly on first paint (no wrong flash)
        $activeRateObj = $rates->firstWhere('brand_key', $selectedBrand) ?? $rates->first();
        $initialRatePercent = $activeRateObj ? (float) $activeRateObj->sell_rate_percent : 88.0;
        $conv = ['USD' => 124.50, 'EUR' => 135.20, 'GBP' => 158.00];
        $initialBDT = (int) round(($prefillAmount * ($initialRatePercent / 100)) * ($conv[$prefillCurrency] ?? 124.50));

        return view('pages.giftcard_sell', compact(
            'rates', 'selectedBrand', 'prefillAmount', 'prefillCurrency', 'initialRatePercent', 'initialBDT'
        ));
    }

    /**
     * API Rate Calculation
     */
    public function calculate(Request $request): JsonResponse
    {
        $brandKey = $request->input('brand');
        $amount = (float) $request->input('amount', 0);
        $currency = $request->input('currency', 'USD');

        $rate = ExchangeRate::where('brand_key', $brandKey)->where('is_active', true)->first();
        if (!$rate) {
            return response()->json(['error' => 'Brand not found'], 404);
        }

        $conversionRates = [
            'USD' => 124.50,
            'EUR' => 135.20,
            'GBP' => 158.00,
        ];

        $bdtPerUnit = $conversionRates[$currency] ?? 124.50;
        $payoutPercent = $rate->sell_rate_percent / 100.0;
        $payoutUSD = $amount * $payoutPercent;
        $payoutBDT = round($payoutUSD * $bdtPerUnit);

        return response()->json([
            'brand' => $rate->brand_name,
            'rate_percent' => $rate->sell_rate_percent,
            'amount' => $amount,
            'currency' => $currency,
            'payout_usd' => number_format($payoutUSD, 2),
            'payout_bdt' => $payoutBDT,
            'formatted_bdt' => '৳ ' . number_format($payoutBDT),
        ]);
    }

    /**
     * Handle Gift Card Sell Submission
     */
    public function submitSell(Request $request): RedirectResponse
    {
        $request->validate([
            'brand_key' => 'required|string',
            'face_value' => 'required|numeric|min:5',
            'currency' => 'required|string',
            'gift_card_codes' => 'required|string',
            'payout_method' => 'required|in:bkash,nagad,rocket,usdt',
            'payout_account' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_name' => 'nullable|string',
        ]);

        $rate = ExchangeRate::where('brand_key', $request->brand_key)->first();
        $brandName = $rate ? $rate->brand_name : ucfirst($request->brand_key);
        $ratePercent = $rate ? ($rate->sell_rate_percent / 100.0) : 0.85;

        $conversionRates = ['USD' => 124.50, 'EUR' => 135.20, 'GBP' => 158.00];
        $bdtRate = $conversionRates[$request->currency] ?? 124.50;

        $payoutUSD = (float) $request->face_value * $ratePercent;
        $payoutBDT = round($payoutUSD * $bdtRate);

        $orderCode = 'CL-S' . mt_rand(10000, 99999);

        $order = Order::create([
            'order_code' => $orderCode,
            'customer_name' => $request->customer_name ?? 'Valued Seller',
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'order_type' => 'sell',
            'product_title' => "Sell {$brandName} {$request->currency} {$request->face_value}",
            'package_title' => "Payout: {$request->currency} " . number_format($payoutUSD, 2) . " (" . round($ratePercent * 100) . "%)",
            'amount_bdt' => $payoutBDT,
            'amount_usd' => $payoutUSD,
            'payout_method' => $request->payout_method,
            'payout_account' => $request->payout_account,
            'gift_card_codes' => $request->gift_card_codes,
            'status' => 'pending',
            'customer_notes' => $request->customer_notes,
        ]);

        return redirect()->route('order.success', ['order_code' => $orderCode])
            ->with('success', 'Gift card submitted successfully! Payout will be sent to your ' . strtoupper($request->payout_method) . ' within 15-45 minutes.');
    }
}
