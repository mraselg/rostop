<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ExchangeRate;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the Flagship Multi-Service Homepage
     */
    public function index(): View
    {
        $categories = Category::where('is_featured', true)->orderBy('sort_order')->get();
        
        $gameTopups = Product::with('packages')
            ->whereHas('category', fn($q) => $q->where('type', 'game_topup'))
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $giftCardBuys = Product::with('packages')
            ->whereHas('category', fn($q) => $q->where('type', 'giftcard_buy'))
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $subscriptions = Product::with('packages')
            ->whereHas('category', fn($q) => $q->where('type', 'subscription'))
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $softwareProducts = Product::with('packages')
            ->whereHas('category', fn($q) => $q->where('type', 'software'))
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Trending / Top-Sold picks across multiple category types
        $trendingSlugs = [
            'netflix-premium',
            'chatgpt-plus',
            'canva-pro',
            'capcut-pro',
            'gemini-advanced',
            'youtube-premium',
            'windows-11-pro',
            'microsoft-365',
        ];
        $trendingProducts = Product::with(['packages', 'category'])
            ->whereIn('slug', $trendingSlugs)
            ->where('is_active', true)
            ->get()
            ->sortBy(fn ($p) => array_search($p->slug, $trendingSlugs))
            ->values();

        $exchangeRates = ExchangeRate::where('is_active', true)->get();

        $recentOrders = Order::where('status', 'completed')
            ->orderBy('completed_at', 'desc')
            ->take(8)
            ->get();

        $reviews = Review::where('is_verified', true)
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();

        return view('pages.home', compact(
            'categories',
            'gameTopups',
            'trendingProducts',
            'giftCardBuys',
            'subscriptions',
            'softwareProducts',
            'exchangeRates',
            'recentOrders',
            'reviews'
        ));
    }

    /**
     * Show the Dedicated Customer Care & Support Center
     */
    public function support(): View
    {
        return view('pages.support');
    }

    /**
     * Show Terms of Service Page
     */
    public function terms(): View
    {
        return view('pages.terms');
    }

    /**
     * Show Privacy Policy Page
     */
    public function privacy(): View
    {
        return view('pages.privacy');
    }

    /**
     * Show Refund & Cancellation Policy Page
     */
    public function refundPolicy(): View
    {
        return view('pages.refund_policy');
    }

    /**
     * Show Government Verification & Trust Page
     */
    public function governmentVerification(): View
    {
        return view('pages.government_verification');
    }
}
