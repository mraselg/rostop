@extends('layouts.admin')

@section('title', 'Edit Category | RosTop Admin')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Edit Category</h1>
        <p class="adm-page-sub">{{ $category->name }}</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="adm-btn adm-btn-secondary adm-btn-xs">← All Categories</a>
</div>

<div class="row">
    <div class="col-12 col-lg-6">
        <div class="adm-card">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="adm-label">Name *</label>
                    <input type="text" name="name" class="adm-input" value="{{ old('name', $category->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Slug</label>
                    <input type="text" name="slug" class="adm-input adm-mono" value="{{ old('slug', $category->slug) }}">
                </div>
                <div class="mb-3">
                    <label class="adm-label">Type *</label>
                    <select name="type" class="adm-select" required>
                        @foreach(['game_topup' => 'Game Top-Up', 'giftcard_buy' => 'Gift Card Buy', 'giftcard_sell' => 'Gift Card Sell', 'subscription' => 'Subscription / OTT', 'software' => 'Software & Licenses'] as $val => $lbl)
                            <option value="{{ $val }}" {{ old('type', $category->type) === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Icon (emoji)</label>
                    <input type="text" name="icon" class="adm-input" value="{{ old('icon', $category->icon) }}" maxlength="4">
                </div>
                <div class="mb-3">
                    <label class="adm-label">Description</label>
                    <textarea name="description" class="adm-textarea" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Sort Order</label>
                    <input type="number" name="sort_order" class="adm-input" value="{{ old('sort_order', $category->sort_order) }}" min="0">
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="chk-cat-feat" {{ old('is_featured', $category->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label" for="chk-cat-feat" style="font-size: 0.85rem;">Featured</label>
                </div>
                <button type="submit" class="adm-btn adm-btn-primary w-100">
                    <i data-lucide="save" class="icon"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
