@extends('layouts.admin')

@section('title', 'Categories | RosTop Admin')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Categories</h1>
        <p class="adm-page-sub">প্রোডাক্ট ক্যাটাগরি ম্যানেজ করুন — সাইটের মেনু ও লিস্টিং এখান থেকেই চলে।</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-5">
        <div class="adm-card">
            <h2 class="adm-card-title">Add New Category</h2>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="adm-label">Name *</label>
                    <input type="text" name="name" class="adm-input" placeholder="e.g. VPN Subscriptions" required>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Type *</label>
                    <select name="type" class="adm-select" required>
                        @foreach(['game_topup' => 'Game Top-Up', 'giftcard_buy' => 'Gift Card Buy', 'giftcard_sell' => 'Gift Card Sell', 'subscription' => 'Subscription / OTT', 'software' => 'Software & Licenses'] as $val => $lbl)
                            <option value="{{ $val }}">{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Icon (emoji)</label>
                    <input type="text" name="icon" class="adm-input" placeholder="🎮" maxlength="4">
                </div>
                <div class="mb-3">
                    <label class="adm-label">Description</label>
                    <textarea name="description" class="adm-textarea" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Sort Order</label>
                    <input type="number" name="sort_order" class="adm-input" value="0" min="0">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="chk-cat-feat" checked>
                    <label class="form-check-label" for="chk-cat-feat" style="font-size: 0.85rem;">Featured</label>
                </div>
                <button type="submit" class="adm-btn adm-btn-primary w-100">
                    <i data-lucide="plus" class="icon"></i> Create Category
                </button>
            </form>
        </div>
    </div>

    <div class="col-12 col-lg-7">
        <div class="adm-card">
            <h2 class="adm-card-title">All Categories</h2>
            <div class="adm-table-wrap">
                <table class="adm-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Products</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                            <tr>
                                <td style="color: var(--text-dim);">{{ $cat->sort_order }}</td>
                                <td>
                                    <div style="font-weight: 700;">{{ $cat->icon }} {{ $cat->name }}</div>
                                    <div class="adm-mono" style="color: var(--text-dim);">/{{ $cat->slug }}</div>
                                </td>
                                <td><span class="adm-pill adm-pill-blue">{{ $cat->type }}</span></td>
                                <td><span class="adm-pill adm-pill-gray">{{ $cat->products_count }}</span></td>
                                <td style="text-align: right;">
                                    <div class="adm-actions-row" style="justify-content: flex-end;">
                                        <a href="{{ route('admin.categories.edit', $cat->id) }}" class="adm-btn adm-btn-secondary adm-btn-xs">Edit</a>
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="m-0" data-confirm="'{{ $cat->name }}' ডিলিট হবে (প্রোডাক্টগুলো থাকবে)। নিশ্চিত?">
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
    </div>
</div>
@endsection
