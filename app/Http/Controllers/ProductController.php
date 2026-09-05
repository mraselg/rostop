<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Game Top-Up Directory
     */
    public function gameTopupIndex(): View
    {
        $products = Product::with('packages')
            ->whereHas('category', fn($q) => $q->where('type', 'game_topup'))
            ->where('is_active', true)
            ->get();

        return view('pages.game_topup', [
            'products' => $products,
            'title' => 'Game Top-Up & Diamond/UC Reload (UID Instant)',
            'description' => 'Fast & 100% safe in-game top-up in Bangladesh for Free Fire, PUBG Mobile, MLBB, Valorant & Roblox via bKash & Nagad.',
        ]);
    }

    /**
     * Single Game Top-up / Product Detail
     */
    public function show(string $slug): View
    {
        $slugAliases = [
            'mlbb-mobile-legends' => 'mobile-legends',
            'free-fire-diamond-top-up-bd' => 'free-fire',
            'pubg-mobile-uc' => 'pubg-mobile',
        ];
        $targetSlug = $slugAliases[$slug] ?? $slug;

        $product = Product::with(['packages', 'category'])
            ->where('slug', $targetSlug)
            ->where('is_active', true)
            ->firstOrFail();

        $related = Product::with('packages')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        $topGames = Product::where('category_id', $product->category_id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        // Category-specific detail template (each service gets its own design)
        $categoryType = optional($product->category)->type;
        $view = match ($categoryType) {
            'subscription' => 'pages.subscription_detail',
            'giftcard_buy' => 'pages.giftcard_detail',
            'software'     => 'pages.software_detail',
            default        => 'pages.product_detail', // games & fallback keep the game-centric page
        };

        return view($view, compact('product', 'related', 'topGames'));
    }

    /**
     * Buy Gift Cards Marketplace
     */
    public function giftCardsBuyIndex(): View
    {
        $products = Product::with(['packages', 'category'])
            ->whereHas('category', fn($q) => $q->where('type', 'giftcard_buy'))
            ->where('is_active', true)
            ->get();

        return view('pages.giftcard_buy', [
            'products' => $products,
            'title' => 'Buy Gift Cards with bKash, Nagad & Crypto',
            'description' => 'Purchase Google Play, Apple iTunes, Steam Wallet, PlayStation, Xbox, and Razer Gold codes with instant delivery.',
        ]);
    }

    /**
     * Digital Subscriptions & OTT
     */
    public function subscriptionsIndex(): View
    {
        $products = Product::with(['packages', 'category'])
            ->whereHas('category', fn($q) => $q->where('type', 'subscription'))
            ->where('is_active', true)
            ->get();

        return view('pages.subscriptions', [
            'products' => $products,
            'title' => 'Digital Subscriptions & OTT Accounts (Netflix, ChatGPT, Canva)',
            'description' => 'Buy Netflix UHD, ChatGPT Plus, Canva Pro, YouTube Premium & Spotify in BDT with warranty.',
        ]);
    }

    /**
     * Digital Products & Software Marketplace
     */
    public function digitalProductsIndex(): View
    {
        $products = Product::with(['packages', 'category'])
            ->whereHas('category', fn($q) => $q->where('type', 'software'))
            ->where('is_active', true)
            ->get();

        return view('pages.digital_products', [
            'products' => $products,
            'title' => 'Genuine Software License Keys & Digital Tools',
            'description' => 'Lifetime genuine license keys for Windows 10/11 Pro, Office 2021, Antivirus, and developer tools.',
        ]);
    }
}
