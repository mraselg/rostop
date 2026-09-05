@extends('layouts.admin')

@section('title', 'Exchange Rates | RosTop Admin')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Exchange Rates</h1>
        <p class="adm-page-sub">গিফট কার্ড এক্সচেঞ্জ ইঞ্জিনের সব রেট — এডিট, যোগ ও সক্রিয়/নিষ্ক্রিয় করুন।</p>
    </div>
</div>

<!-- Inline Edit Table -->
<div class="adm-card">
    <h2 class="adm-card-title">All Brand Rates</h2>
    <div class="adm-table-wrap">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Currency</th>
                    <th>Sell %</th>
                    <th>BDT Rate</th>
                    <th>Active</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rates as $rate)
                    <tr style="{{ !$rate->is_active ? 'opacity: 0.55;' : '' }}">
                        <td>
                            <form action="{{ route('admin.rate.update', $rate->id) }}" method="POST" class="m-0" id="rt-form-{{ $rate->id }}">@csrf</form>
                            <div style="font-weight: 700;">{{ $rate->brand_name }}</div>
                            <div class="adm-mono" style="color: var(--text-dim);">{{ $rate->brand_key }}</div>
                        </td>
                        <td>
                            <span class="adm-pill adm-pill-blue">{{ $rate->currency_code }}</span>
                            <div style="font-size: 0.68rem; color: var(--text-dim); margin-top: 0.2rem;">Buy: {{ $rate->buy_rate_percent }}%</div>
                        </td>
                        <td>
                            <input form="rt-form-{{ $rate->id }}" type="number" name="sell_rate_percent" class="adm-input adm-input-sm" value="{{ $rate->sell_rate_percent }}" style="width: 84px;" min="50" max="100" step="0.5" required>
                        </td>
                        <td>
                            <input form="rt-form-{{ $rate->id }}" type="number" name="bdt_conversion_rate" class="adm-input adm-input-sm" value="{{ $rate->bdt_conversion_rate }}" style="width: 104px;" min="1" step="0.1" required>
                        </td>
                        <td>
                            <div class="adm-actions-row">
                                <span class="adm-pill {{ $rate->is_active ? 'adm-pill-green' : 'adm-pill-gray' }}">{{ $rate->is_active ? 'Active' : 'Off' }}</span>
                                <form action="{{ route('admin.rates.toggle', $rate->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="adm-btn adm-btn-secondary adm-btn-xs">{{ $rate->is_active ? 'Disable' : 'Enable' }}</button>
                                </form>
                            </div>
                        </td>
                        <td style="text-align: right;">
                            <div class="adm-actions-row" style="justify-content: flex-end;">
                                <button form="rt-form-{{ $rate->id }}" type="submit" class="adm-btn adm-btn-primary adm-btn-xs">Save</button>
                                <form action="{{ route('admin.rates.destroy', $rate->id) }}" method="POST" class="m-0" data-confirm="'{{ $rate->brand_name }}' রেট ডিলিট হবে। নিশ্চিত?">
                                    @csrf
                                    <button type="submit" class="adm-btn adm-btn-danger adm-btn-xs"><i data-lucide="trash-2" class="icon"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create New Rate -->
<div class="adm-card">
    <h2 class="adm-card-title">Add New Brand Rate</h2>
    <form action="{{ route('admin.rates.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-3">
                <label class="adm-label">Brand Key * (unique, no spaces)</label>
                <input type="text" name="brand_key" class="adm-input adm-mono" placeholder="e.g. xbox" required>
            </div>
            <div class="col-md-5">
                <label class="adm-label">Brand Name *</label>
                <input type="text" name="brand_name" class="adm-input" placeholder="e.g. Xbox Gift Card (US)" required>
            </div>
            <div class="col-md-2">
                <label class="adm-label">Currency *</label>
                <select name="currency_code" class="adm-select">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="adm-label">BDT per unit *</label>
                <input type="number" name="bdt_conversion_rate" class="adm-input" value="124.50" step="0.1" min="1" required>
            </div>
            <div class="col-md-3">
                <label class="adm-label">Buy Rate % (we sell at)</label>
                <input type="number" name="buy_rate_percent" class="adm-input" value="102" step="0.5" min="50" max="200" required>
            </div>
            <div class="col-md-3">
                <label class="adm-label">Sell Rate % (we pay)</label>
                <input type="number" name="sell_rate_percent" class="adm-input" value="86" step="0.5" min="50" max="100" required>
            </div>
            <div class="col-md-3">
                <label class="adm-label">Min Value</label>
                <input type="number" name="min_value" class="adm-input" value="10" step="1" min="0" required>
            </div>
            <div class="col-md-3">
                <label class="adm-label">Max Value</label>
                <input type="number" name="max_value" class="adm-input" value="500" step="1" min="0" required>
            </div>
            <div class="col-12">
                <button type="submit" class="adm-btn adm-btn-primary">
                    <i data-lucide="plus" class="icon"></i> Add Rate
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
