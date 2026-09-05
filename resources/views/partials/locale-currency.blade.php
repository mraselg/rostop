{{--
    Shared Locale / Country / Currency selector (mock-exact 3-row card).
    Usage:
      @include('partials.locale-currency', ['scope' => 'modal', 'saveButton' => true])
      @include('partials.locale-currency', ['scope' => 'drawer'])
    JS hooks (class/data based, safe for multiple instances):
      [data-lc-scope] container, select[data-lc-country|data-lc-lang|data-lc-curr],
      [data-lc-save] save button, label spans [data-lc-*-text], [data-lc-country-flag]
--}}
@php
    $lcCountries  = config('locales.countries', []);
    $lcCurrencies = config('locales.currencies', []);
    $lcLocales    = config('locales.locales', []);
    $lcScope      = $scope ?? 'modal';
@endphp

<div class="lcs-panel" data-lc-scope="{{ $lcScope }}">

    <!-- Country row (auto-detected by IP) -->
    <label class="lcs-field" for="lcs-country-{{ $lcScope }}">
        <i data-lucide="map-pin" class="lcs-ico lcs-ico-pin"></i>
        <span class="lcs-text" data-lc-country-text>Bangladesh</span>
        <img class="lcs-country-flag" data-lc-country-flag src="{{ asset('images/flags/bd.svg') }}" alt="" width="22" height="16">
        <select class="lcs-input" id="lcs-country-{{ $lcScope }}" data-lc-country aria-label="{{ __('ui.settings_country') }}">
            @foreach($lcCountries as $c)
                <option value="{{ $c['code'] }}" data-name="{{ $c['name'] }}" data-flag="{{ $c['flag'] }}" data-currency="{{ $c['currency'] }}" {{ $c['code'] === 'BD' ? 'selected' : '' }}>
                    {{ $c['name'] }}
                </option>
            @endforeach
        </select>
    </label>

    <!-- Language row -->
    <label class="lcs-field" for="lcs-lang-{{ $lcScope }}">
        <i data-lucide="languages" class="lcs-ico"></i>
        <span class="lcs-text" data-lc-lang-text>English</span>
        <i data-lucide="chevron-down" class="lcs-caret"></i>
        <select class="lcs-input" id="lcs-lang-{{ $lcScope }}" data-lc-lang aria-label="{{ __('ui.settings_language') }}">
            @foreach($lcLocales as $l)
                <option value="{{ $l['code'] }}" data-label="{{ $l['label'] }}" {{ $l['code'] === 'en' ? 'selected' : '' }}>
                    {{ $l['native'] }} ({{ $l['label'] }})
                </option>
            @endforeach
        </select>
    </label>

    <!-- Currency row -->
    <label class="lcs-field" for="lcs-curr-{{ $lcScope }}">
        <span class="lcs-ico lcs-ico-sym" data-lc-curr-sym>৳</span>
        <span class="lcs-text" data-lc-curr-text>Bangladeshi Taka (৳)</span>
        <i data-lucide="chevron-down" class="lcs-caret"></i>
        <select class="lcs-input" id="lcs-curr-{{ $lcScope }}" data-lc-curr aria-label="{{ __('ui.settings_currency') }}">
            @foreach($lcCurrencies as $c)
                <option value="{{ $c['code'] }}" data-sym="{{ $c['sym'] }}" data-name="{{ $c['name'] }}" {{ $c['code'] === 'BDT' ? 'selected' : '' }}>
                    {{ $c['name'] }} ({{ $c['sym'] }})
                </option>
            @endforeach
        </select>
    </label>

    @if(!empty($saveButton))
        <button type="button" class="lcs-save" data-lc-save>
            {{ __('ui.settings_save') }}
        </button>
    @endif
</div>
