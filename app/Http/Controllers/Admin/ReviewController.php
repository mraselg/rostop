<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    /**
     * All reviews (+inline create form).
     */
    public function index(): View
    {
        $reviews = Review::orderBy('id', 'desc')->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Store a new review (shown on the homepage as social proof).
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        Review::create($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', "রিভিউ '{$data['customer_name']}'-এর যুক্ত হয়েছে!");
    }

    /**
     * Update a review inline.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $review->update($this->validatedData($request));

        return back()->with('success', "রিভিউটি আপডেট হয়েছে!");
    }

    /**
     * Toggle verified / hidden.
     */
    public function toggle(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $review->is_verified = !$review->is_verified;
        $review->save();

        return back()->with('success', $review->is_verified
            ? "রিভিউটি সাইটে দেখানো হচ্ছে।"
            : "রিভিউটি সাইট থেকে লুকানো হয়েছে।");
    }

    /**
     * Delete a review.
     */
    public function destroy(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', "রিভিউটি ডিলিট করা হয়েছে।");
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'customer_name' => 'required|string|max:120',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'service_tag' => 'required|string|max:120',
            'payout_amount' => 'nullable|string|max:60',
            'time_ago' => 'nullable|string|max:60',
            'is_verified' => 'nullable|boolean',
        ]) + [
            'time_ago' => $request->input('time_ago') ?: 'Just now',
            'is_verified' => $request->boolean('is_verified', true),
        ];
    }
}
