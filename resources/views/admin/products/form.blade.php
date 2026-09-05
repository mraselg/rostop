@extends('layouts.admin')

@section('title', ($isEdit ? 'Edit: ' . $product->title : 'New Product') . ' | RosTop Admin')

@php
    $oldSchema = old('input_fields_schema_raw', $isEdit && $product->input_fields_schema ? json_encode($product->input_fields_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '');
    $packages = old() ? [] : ($isEdit ? $product->packages : collect());
@endphp

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">{{ $isEdit ? 'Edit Product' : 'New Product' }}</h1>
        <p class="adm-page-sub">{{ $isEdit ? $product->title : 'নতুন প্রোডাক্ট ও তার প্যাকেজগুলো যুক্ত করুন।' }}</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="adm-btn adm-btn-secondary adm-btn-xs">← All Products</a>
</div>

<form action="{{ $isEdit ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST">
    @csrf

    <div class="row g-3">
        <!-- Main Info -->
        <div class="col-12 col-lg-8">
            <div class="adm-card">
                <h2 class="adm-card-title">Basic Information</h2>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="adm-label">Title *</label>
                        <input type="text" name="title" class="adm-input" value="{{ old('title', $product->title) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="adm-label">Slug (URL)</label>
                        <input type="text" name="slug" class="adm-input adm-mono" value="{{ old('slug', $product->slug) }}" placeholder="auto-generated-from-title">
                    </div>
                    <div class="col-md-6">
                        <label class="adm-label">Category *</label>
                        <select name="category_id" class="adm-select" required>
                            <option value="">— Select —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ (string) old('category_id', $product->category_id) === (string) $cat->id ? 'selected' : '' }}>{{ $cat->name }} ({{ $cat->type }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="adm-label">Tag Badge (e.g. Instant 10s)</label>
                        <input type="text" name="tag_badge" class="adm-input" value="{{ old('tag_badge', $product->tag_badge) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="adm-label">Stock Type *</label>
                        <select name="stock_type" class="adm-select" required>
                            @foreach(['manual_topup' => 'Manual Top-Up (game reload)', 'auto_code' => 'Auto Code (digital code delivery)', 'account_login' => 'Account Login (subscription)'] as $val => $lbl)
                                <option value="{{ $val }}" {{ old('stock_type', $product->stock_type) === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="adm-label">Short Description</label>
                        <input type="text" name="short_desc" class="adm-input" value="{{ old('short_desc', $product->short_desc) }}" maxlength="500">
                    </div>
                    <div class="col-12">
                        <label class="adm-label">Full Description</label>
                        <textarea name="description" class="adm-textarea" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="adm-label">Order Instructions (customer দেখবে)</label>
                        <textarea name="instructions" class="adm-textarea" rows="2">{{ old('instructions', $product->instructions) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="adm-card">
                <h2 class="adm-card-title">Pricing & Media</h2>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="adm-label">Base Price (BDT) *</label>
                        <input type="number" name="base_price_bdt" class="adm-input" value="{{ old('base_price_bdt', $product->base_price_bdt ?? 0) }}" step="0.01" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <label class="adm-label">Base Price (USD)</label>
                        <input type="number" name="base_price_usd" class="adm-input" value="{{ old('base_price_usd', $product->base_price_usd ?? 0) }}" step="0.01" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="adm-label">Sell Rate (0-1, gift card sell)</label>
                        <input type="number" name="rate_percentage" class="adm-input" value="{{ old('rate_percentage', $product->rate_percentage ?? 0.85) }}" step="0.01" min="0" max="1">
                    </div>
                    <div class="col-md-8">
                        <label class="adm-label">Image Path (public/ এর ভেতর)</label>
                        <input type="text" name="image" class="adm-input adm-mono" value="{{ old('image', $product->image) }}" placeholder="images/games/freefire.webp">
                    </div>
                    <div class="col-md-4">
                        <label class="adm-label">Brand Color</label>
                        <input type="color" name="brand_color" class="adm-input" style="padding: 4px; height: 42px;" value="{{ old('brand_color', $product->brand_color ?? '#10B981') }}">
                    </div>
                </div>
            </div>

            <!-- Custom Input Fields Schema -->
            <div class="adm-card">
                <h2 class="adm-card-title">Custom Order Fields (JSON)</h2>
                <p class="adm-page-sub" style="margin-bottom: 0.75rem;">
                    কাস্টমার অর্ডারের সময় যে অতিরিক্ত ইনপুট দেবে (যেমন player_id, zone_id)। খালি রাখলে কিছুই জিজ্ঞেস হবে না।
                </p>
                <textarea name="input_fields_schema_raw" class="adm-textarea adm-mono" rows="5" placeholder='[{"name":"player_id","label":"Player ID (UID)","type":"text","placeholder":"UID দিন","required":true}]'>{{ $oldSchema }}</textarea>
            </div>

            <!-- Packages -->
            <div class="adm-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h2 class="adm-card-title" style="margin: 0;">Packages / Variants</h2>
                    <button type="button" class="adm-btn adm-btn-secondary adm-btn-xs" id="adm-add-pkg">
                        <i data-lucide="plus" class="icon"></i> Add Row
                    </button>
                </div>

                <div class="adm-pkg-row adm-pkg-row-head">
                    <span>Name *</span><span>Amount</span><span>Price ৳ *</span><span>Old Price ৳</span><span>Badge</span><span></span>
                </div>

                <div id="adm-pkg-list">
                    @foreach($packages as $pkg)
                        <div class="adm-pkg-row">
                            <input type="text" name="pkg_name[]" class="adm-input adm-input-sm" value="{{ $pkg->name }}" placeholder="e.g. 115 Diamonds" required>
                            <input type="number" name="pkg_amount[]" class="adm-input adm-input-sm" value="{{ $pkg->amount_val }}" step="0.01" placeholder="115">
                            <input type="number" name="pkg_price[]" class="adm-input adm-input-sm" value="{{ $pkg->price_bdt }}" step="0.01" placeholder="৳" required>
                            <input type="number" name="pkg_original[]" class="adm-input adm-input-sm" value="{{ $pkg->original_price_bdt }}" step="0.01" placeholder="Optional">
                            <input type="text" name="pkg_badge[]" class="adm-input adm-input-sm" value="{{ $pkg->badge }}" placeholder="e.g. Hot">
                            <button type="button" class="adm-icon-btn adm-pkg-remove" title="Remove row"><i data-lucide="trash-2" class="icon" style="width:14px;height:14px;"></i></button>
                        </div>
                    @endforeach
                </div>
                <p class="adm-page-sub" style="margin-top: 0.5rem;">⚠️ সেভ করলে প্যাকেজ তালিকা পুরোটা এই রো-গুলো দিয়ে রিপ্লেস হয়। কোনো রো খালি রাখলে সেটি বাদ যাবে।</p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-4">
            <div class="adm-card" style="position: sticky; top: 74px;">
                <h2 class="adm-card-title">Publish Settings</h2>
                <div class="mb-3">
                    <label class="adm-label">Sort Order</label>
                    <input type="number" name="sort_order" class="adm-input" value="{{ old('sort_order', $product->sort_order ?? 0) }}" min="0">
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="chk-active" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="chk-active" style="font-size: 0.85rem;">সাইটে দৃশ্যমান (Active)</label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="chk-featured" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="chk-featured" style="font-size: 0.85rem;">Featured (হোমপেজে হাইলাইট)</label>
                </div>
                <button type="submit" class="adm-btn adm-btn-primary w-100" style="min-height: 48px;">
                    <i data-lucide="save" class="icon"></i> {{ $isEdit ? 'Save Changes' : 'Create Product' }}
                </button>
                @if($isEdit)
                    <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="adm-btn adm-btn-secondary w-100 mt-2">
                        <i data-lucide="external-link" class="icon"></i> View on Site
                    </a>
                @endif
            </div>
        </div>
    </div>
</form>

<template id="adm-pkg-template">
    <div class="adm-pkg-row">
        <input type="text" name="pkg_name[]" class="adm-input adm-input-sm" placeholder="e.g. 115 Diamonds" required>
        <input type="number" name="pkg_amount[]" class="adm-input adm-input-sm" step="0.01" placeholder="115">
        <input type="number" name="pkg_price[]" class="adm-input adm-input-sm" step="0.01" placeholder="৳" required>
        <input type="number" name="pkg_original[]" class="adm-input adm-input-sm" step="0.01" placeholder="Optional">
        <input type="text" name="pkg_badge[]" class="adm-input adm-input-sm" placeholder="e.g. Hot">
        <button type="button" class="adm-icon-btn adm-pkg-remove" title="Remove row"><i data-lucide="trash-2" class="icon" style="width:14px;height:14px;"></i></button>
    </div>
</template>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var list = document.getElementById('adm-pkg-list');
    var tpl = document.getElementById('adm-pkg-template');
    var addBtn = document.getElementById('adm-add-pkg');

    function bindRemove(row) {
        var btn = row.querySelector('.adm-pkg-remove');
        if (btn) btn.addEventListener('click', function () { row.remove(); });
    }

    if (list) list.querySelectorAll('.adm-pkg-row').forEach(bindRemove);

    if (addBtn && tpl && list) {
        addBtn.addEventListener('click', function () {
            var row = tpl.content.firstElementChild.cloneNode(true);
            bindRemove(row);
            list.appendChild(row);
        });
    }
});
</script>
@endpush
