<?php

namespace App\Support;

use App\Models\Product;

/**
 * SeoSchema — automatic schema.org JSON-LD builders (Product / Offer /
 * BreadcrumbList / ItemList / CollectionPage / FAQPage).
 *
 * Usage (Blade):
 * @push('schema')
 *   {!! \App\Support\SeoSchema::render([
 *        \App\Support\SeoSchema::product($product, url()->current()),
 *   ]) !!}
 * @endpush
 */
class SeoSchema
{
    /**
     * Render one <script type="application/ld+json"> tag with a @graph
     * containing every given graph object.
     */
    public static function render(array $graphs): string
    {
        $json = json_encode(
            [
                '@context' => 'https://schema.org',
                '@graph'   => array_values($graphs),
            ],
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_LINE_TERMINATORS
        );

        return '<script type="application/ld+json">' . $json . '</script>';
    }

    /**
     * schema.org/Product with real package offers (auto-generated per product).
     */
    public static function product(Product $product, string $url): array
    {
        $image = $product->image
            ? asset($product->image)
            : asset('images/og-banner.jpg');

        $description = trim(preg_replace('/\s+/', ' ', strip_tags(
            $product->short_desc ?: (string) $product->description
        )));
        if (mb_strlen($description) > 500) {
            $description = mb_substr($description, 0, 497) . '…';
        }

        $priceValidUntil = now()->endOfYear()->toDateString();
        $prices = [];

        if ($product->packages && $product->packages->count()) {
            foreach ($product->packages as $pkg) {
                if ($pkg->price_bdt !== null) {
                    $prices[] = (float) $pkg->price_bdt;
                }
            }
        }

        if ($product->base_price_bdt !== null) {
            $prices[] = (float) $product->base_price_bdt;
        }

        $prices = array_values(array_filter($prices, fn ($v) => $v > 0));

        if (count($prices) > 1) {
            $offers = [
                '@type'        => 'AggregateOffer',
                'priceCurrency'=> 'BDT',
                'lowPrice'     => min($prices),
                'highPrice'    => max($prices),
                'offerCount'   => $product->packages ? max($product->packages->count(), 1) : 1,
                'url'          => $url,
                'availability' => 'https://schema.org/InStock',
                'seller'       => ['@type' => 'Organization', 'name' => 'RosTop'],
                'priceValidUntil' => $priceValidUntil,
            ];
        } elseif (count($prices) === 1) {
            $offers = [
                '@type'        => 'Offer',
                'price'        => $prices[0],
                'priceCurrency'=> 'BDT',
                'url'          => $url,
                'availability' => 'https://schema.org/InStock',
                'itemCondition'=> 'https://schema.org/NewCondition',
                'seller'       => ['@type' => 'Organization', 'name' => 'RosTop'],
                'priceValidUntil' => $priceValidUntil,
            ];
        } else {
            $offers = [
                '@type'        => 'Offer',
                'priceCurrency'=> 'BDT',
                'price'        => 0,
                'url'          => $url,
                'availability' => 'https://schema.org/InStock',
                'seller'       => ['@type' => 'Organization', 'name' => 'RosTop'],
            ];
        }

        return [
            '@type'       => 'Product',
            'name'        => $product->title,
            'sku'         => $product->slug,
            'description' => $description ?: $product->title,
            'image'       => [$image],
            'url'         => $url,
            'category'    => optional($product->category)->name,
            'brand'       => [
                '@type' => 'Brand',
                'name'  => optional($product->category)->name ?? 'RosTop',
            ],
            'offers'      => $offers,
        ];
    }

    /**
     * schema.org/BreadcrumbList
     * @param array<int, array{0:string,1:string}> $items [name, absoluteUrl]
     */
    public static function breadcrumbs(array $items): array
    {
        $elements = [];
        foreach ($items as $i => [$name, $url]) {
            $elements[] = [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'name'     => $name,
                'item'     => $url,
            ];
        }

        return [
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $elements,
        ];
    }

    /**
     * schema.org/ItemList of products with canonical route per product type.
     */
    public static function itemList(iterable $products, string $name): array
    {
        $elements = [];
        $i = 0;

        foreach ($products as $product) {
            $i++;
            $type = optional($product->category)->type;
            $route = match ($type) {
                'game_topup'   => route('game.show', $product->slug),
                'giftcard_buy' => route('giftcards.buy.show', $product->slug),
                'subscription' => route('subscriptions.show', $product->slug),
                'software'     => route('digital.products.show', $product->slug),
                default        => route('product.show', $product->slug),
            };

            $elements[] = [
                '@type'    => 'ListItem',
                'position' => $i,
                'url'      => url($route),
                'name'     => $product->title,
            ];
        }

        return [
            '@type'           => 'ItemList',
            'name'            => $name,
            'itemListElement' => $elements,
        ];
    }

    /**
     * schema.org/CollectionPage wrapping an ItemList (for listing pages).
     */
    public static function collectionPage(string $title, string $description, string $url, array $itemList): array
    {
        return [
            '@type'        => 'CollectionPage',
            'name'         => $title,
            'description'  => $description,
            'url'          => $url,
            'inLanguage'   => ['en', 'bn'],
            'isPartOf'     => ['@type' => 'WebSite', '@id' => url('/')],
            'mainEntity'   => $itemList,
        ];
    }

    /**
     * Canonical show-route URL for a product by its category type.
     */
    public static function productUrl(Product $product): string
    {
        $type = optional($product->category)->type;

        $route = match ($type) {
            'game_topup'   => route('game.show', $product->slug),
            'giftcard_buy' => route('giftcards.buy.show', $product->slug),
            'subscription' => route('subscriptions.show', $product->slug),
            'software'     => route('digital.products.show', $product->slug),
            default        => route('product.show', $product->slug),
        };

        return url($route);
    }

    /**
     * Listing route for a category type ('game_topup' → game.topup).
     */
    public static function categoryUrl(?Product $product): array
    {
        $type = $product ? optional($product->category)->type : null;

        return match ($type) {
            'game_topup'   => [url(route('game.topup')), 'Games Top-Up'],
            'giftcard_buy' => [url(route('giftcards.buy')), 'Buy Gift Cards'],
            'subscription' => [url(route('subscriptions')), 'Subscriptions'],
            'software'     => [url(route('digital.products')), 'Software & Digital Products'],
            default        => [url(route('home')), 'Products'],
        };
    }
}
