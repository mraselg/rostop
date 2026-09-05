<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RateController extends Controller
{
    /**
     * All exchange rates (inline editable rows + create form).
     */
    public function index(): View
    {
        $rates = ExchangeRate::orderBy('brand_name')->get();
        return view('admin.rates.index', compact('rates'));
    }

    /**
     * Create a new brand rate.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'brand_key' => 'required|string|max:60|unique:exchange_rates,brand_key',
            'brand_name' => 'required|string|max:120',
            'buy_rate_percent' => 'required|numeric|min:50|max:200',
            'sell_rate_percent' => 'required|numeric|min:50|max:100',
            'currency_code' => 'required|string|max:5',
            'bdt_conversion_rate' => 'required|numeric|min:1',
            'min_value' => 'required|numeric|min:0',
            'max_value' => 'required|numeric|min:0',
        ]) + ['is_active' => true];

        ExchangeRate::create($data);

        return redirect()->route('admin.rates.index')
            ->with('success', "রেট '{$data['brand_name']}' যুক্ত হয়েছে!");
    }

    /**
     * Toggle active/inactive (hides the brand from the live calculator).
     */
    public function toggle(int $id): RedirectResponse
    {
        $rate = ExchangeRate::findOrFail($id);
        $rate->is_active = !$rate->is_active;
        $rate->save();

        return back()->with('success', $rate->is_active
            ? "{$rate->brand_name} সক্রিয় করা হয়েছে।"
            : "{$rate->brand_name} বন্ধ করা হয়েছে।");
    }

    /**
     * Delete a brand rate.
     */
    public function destroy(int $id): RedirectResponse
    {
        $rate = ExchangeRate::findOrFail($id);
        $name = $rate->brand_name;
        $rate->delete();

        return redirect()->route('admin.rates.index')
            ->with('success', "রেট '{$name}' ডিলিট করা হয়েছে।");
    }
}
