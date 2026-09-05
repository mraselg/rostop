@extends('layouts.admin')

@section('title', 'Products | RosTop Admin')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Products</h1>
        <p class="adm-page-sub">সব প্রোডাক্ট ও প্যাকেজ — এডিট, দাম বদলান, দৃশ্যমানতা নিয়ন্ত্রণ করুন।</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="adm-btn adm-btn-primary">
        <i data-lucide="plus" class="icon"></i> New Product
    </a>
</div>

<div class="adm-filter-bar">
    <form action="{{ route('admin.products.index') }}" method="GET">
        <input type="text" name="q" value="{{ request('q') }}" class="adm-input adm-input-sm" style="width: 230px;" placeholder="Title বা slug খুঁজুন...">
        <select name="category_id" class="adm-select adm-input-sm" style="width: 200px;">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ (string) request('category_id') === (string) $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="adm-btn adm-btn-primary adm-btn-xs">Filter</button>
        <a href="{{ route('admin.products.index') }}" class="adm-btn adm-btn-secondary adm-btn-xs">Reset</a>
    </form>
</div>

<div class="adm-card">
    <div class="adm-table-wrap">
        <table class="adm-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Base Price</th>
                    <th>Packages</th>
                    <th>Stock Type</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr style="{{ !$product->is_active ? 'opacity: 0.55;' : '' }}">
                        <td>
                            <div style="font-weight: 700;">{{ Str::limit($product->title, 44) }}</div>
                            <div style="font-size: 0.7rem; color: var(--text-dim);">/{{ $product->slug }}
                                @if($product->is_featured)<span class="adm-pill adm-pill-blue" style="margin-left: 0.3rem;">Featured</span>@endif
                            </div>
                        </td>
                        <td style="font-size: 0.8rem;">{{ $product->category->name ?? '—' }}</td>
                        <td style="font-weight: 800; color: var(--primary); white-space: nowrap;">৳ {{ number_format($product->base_price_bdt) }}</td>
                        <td><span class="adm-pill adm-pill-gray">{{ $product->packages->count() }} pkgs</span></td>
                        <td style="font-size: 0.76rem; color: var(--text-muted);">{{ $product->stock_type }}</td>
                        <td>
                            <form action="{{ route('admin.products.toggle', $product->id) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="adm-pill {{ $product->is_active ? 'adm-pill-green' : 'adm-pill-gray' }}" style="cursor: pointer; border: none;" title="Click to toggle">
                                    ● {{ $product->is_active ? 'Active' : 'Hidden' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: right;">
                            <div class="adm-actions-row" style="justify-content: flex-end;">
                                <a href="{{ route('product.show', $product->slug) }}" class="adm-btn adm-btn-secondary adm-btn-xs" target="_blank" title="View on site">View</a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="adm-btn adm-btn-secondary adm-btn-xs">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="m-0" data-confirm="'{{ $product->title }}' এবং এর সব প্যাকেজ ডিলিট হবে। নিশ্চিত?">
                                    @csrf
                                    <button type="submit" class="adm-btn adm-btn-danger adm-btn-xs"><i data-lucide="trash-2" class="icon"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="padding: 2rem; text-align: center; color: var(--text-dim);">কোনো প্রোডাক্ট পাওয়া যায়নি।</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $products->links() }}
</div>
@endsection
