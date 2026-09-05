@extends('layouts.admin')

@section('title', 'Reviews | RosTop Admin')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Reviews</h1>
        <p class="adm-page-sub">হোমপেজে দেখানো কাস্টমার রিভিউ — যুক্ত, এডিট ও নিয়ন্ত্রণ করুন।</p>
    </div>
</div>

<div class="row g-3">
    <!-- Create Form -->
    <div class="col-12 col-lg-4">
        <div class="adm-card" style="position: sticky; top: 74px;">
            <h2 class="adm-card-title">Add New Review</h2>
            <form action="{{ route('admin.reviews.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="adm-label">Customer Name *</label>
                    <input type="text" name="customer_name" class="adm-input" required>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Rating *</label>
                    <select name="rating" class="adm-select">
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}">{{ $i }} ★</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Comment *</label>
                    <textarea name="comment" class="adm-textarea" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Service Tag * (e.g. Free Fire 610💎)</label>
                    <input type="text" name="service_tag" class="adm-input" required>
                </div>
                <div class="mb-3">
                    <label class="adm-label">Payout Display (e.g. ৳ 430)</label>
                    <input type="text" name="payout_amount" class="adm-input">
                </div>
                <div class="mb-4">
                    <label class="adm-label">Time Text</label>
                    <input type="text" name="time_ago" class="adm-input" placeholder="Just now">
                </div>
                <button type="submit" class="adm-btn adm-btn-primary w-100">
                    <i data-lucide="plus" class="icon"></i> Add Review
                </button>
            </form>
        </div>
    </div>

    <!-- List -->
    <div class="col-12 col-lg-8">
        @forelse($reviews as $review)
            <div class="adm-card" style="{{ !$review->is_verified ? 'opacity: 0.55;' : '' }}">
                <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" class="m-0">
                    @csrf
                    <div class="row g-2 align-items-center mb-2">
                        <div class="col-md-4">
                            <input type="text" name="customer_name" class="adm-input adm-input-sm" value="{{ $review->customer_name }}">
                        </div>
                        <div class="col-md-2">
                            <select name="rating" class="adm-select adm-input-sm">
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ $review->rating === $i ? 'selected' : '' }}>{{ $i }} ★</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="service_tag" class="adm-input adm-input-sm" value="{{ $review->service_tag }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="time_ago" class="adm-input adm-input-sm" value="{{ $review->time_ago }}">
                        </div>
                    </div>
                    <textarea name="comment" class="adm-textarea mb-2" rows="2">{{ $review->comment }}</textarea>
                    <div class="d-flex align-items-center flex-wrap" style="gap: 0.5rem;">
                        <input type="text" name="payout_amount" class="adm-input adm-input-sm" style="width: 110px;" value="{{ $review->payout_amount }}" placeholder="৳ amount">
                        <span class="adm-pill {{ $review->is_verified ? 'adm-pill-green' : 'adm-pill-gray' }}">
                            {{ $review->is_verified ? 'Visible' : 'Hidden' }}
                        </span>
                        <div class="adm-actions-row ms-auto">
                            <button type="submit" class="adm-btn adm-btn-primary adm-btn-xs">Save</button>
                </form>
                            <form action="{{ route('admin.reviews.toggle', $review->id) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="adm-btn adm-btn-secondary adm-btn-xs">{{ $review->is_verified ? 'Hide' : 'Show' }}</button>
                            </form>
                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="m-0" data-confirm="রিভিউটি ডিলিট হবে। নিশ্চিত?">
                                @csrf
                                <button type="submit" class="adm-btn adm-btn-danger adm-btn-xs"><i data-lucide="trash-2" class="icon"></i></button>
                            </form>
                        </div>
                    </div>
            </div>
        @empty
            <div class="adm-card" style="text-align: center; color: var(--text-dim);">কোনো রিভিউ নেই।</div>
        @endforelse

        {{ $reviews->links() }}
    </div>
</div>
@endsection
