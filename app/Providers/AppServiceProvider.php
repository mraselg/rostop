<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('layouts.app', function ($view) {
            try {
                $orders = \App\Models\Order::where('status', 'completed')
                    ->orderBy('completed_at', 'desc')
                    ->take(10)
                    ->get();
            } catch (\Throwable $e) {
                $orders = collect();
            }

            if ($orders->isEmpty()) {
                $transactions = collect([
                    (object)[
                        'order_type' => 'topup',
                        'product_title' => 'Free Fire 530 Diamonds',
                        'amount_bdt' => 380,
                        'payment_method' => 'bKash',
                        'time_text' => '2m ago',
                        'customer_masked' => '017***492',
                        'category_label' => 'Top-Up',
                        'category_class' => 'ticker-cat-topup',
                        'icon' => 'gamepad-2',
                    ],
                    (object)[
                        'order_type' => 'sell',
                        'product_title' => 'Paysafecard €100 Cashout',
                        'amount_bdt' => 11627,
                        'payment_method' => 'Nagad',
                        'time_text' => '5m ago',
                        'customer_masked' => '019***753',
                        'category_label' => 'Cashout',
                        'category_class' => 'ticker-cat-sell',
                        'icon' => 'wallet',
                    ],
                    (object)[
                        'order_type' => 'subscription',
                        'product_title' => 'Netflix Premium 4K UHD',
                        'amount_bdt' => 280,
                        'payment_method' => 'bKash',
                        'time_text' => '8m ago',
                        'customer_masked' => '018***119',
                        'category_label' => 'OTT Hub',
                        'category_class' => 'ticker-cat-ott',
                        'icon' => 'tv',
                    ],
                    (object)[
                        'order_type' => 'topup',
                        'product_title' => 'PUBG Mobile 660 UC',
                        'amount_bdt' => 960,
                        'payment_method' => 'Rocket',
                        'time_text' => '12m ago',
                        'customer_masked' => '016***842',
                        'category_label' => 'Top-Up',
                        'category_class' => 'ticker-cat-topup',
                        'icon' => 'gamepad-2',
                    ],
                    (object)[
                        'order_type' => 'buy',
                        'product_title' => 'Google Play $10 US Gift Card',
                        'amount_bdt' => 1245,
                        'payment_method' => 'Nagad',
                        'time_text' => '15m ago',
                        'customer_masked' => '015***330',
                        'category_label' => 'Gift Card',
                        'category_class' => 'ticker-cat-buy',
                        'icon' => 'gift',
                    ],
                    (object)[
                        'order_type' => 'sell',
                        'product_title' => 'Apple iTunes $50 Card',
                        'amount_bdt' => 5478,
                        'payment_method' => 'bKash',
                        'time_text' => '19m ago',
                        'customer_masked' => '017***671',
                        'category_label' => 'Cashout',
                        'category_class' => 'ticker-cat-sell',
                        'icon' => 'wallet',
                    ],
                    (object)[
                        'order_type' => 'software',
                        'product_title' => 'Windows 11 Pro Lifetime Key',
                        'amount_bdt' => 390,
                        'payment_method' => 'bKash',
                        'time_text' => '24m ago',
                        'customer_masked' => '013***982',
                        'category_label' => 'Software',
                        'category_class' => 'ticker-cat-software',
                        'icon' => 'cpu',
                    ],
                ]);
            } else {
                $transactions = $orders->map(function ($order) {
                    $cat = match ($order->order_type) {
                        'sell' => ['label' => 'Cashout', 'class' => 'ticker-cat-sell', 'icon' => 'wallet'],
                        'topup' => ['label' => 'Top-Up', 'class' => 'ticker-cat-topup', 'icon' => 'gamepad-2'],
                        'subscription' => ['label' => 'OTT Hub', 'class' => 'ticker-cat-ott', 'icon' => 'tv'],
                        'software' => ['label' => 'Software', 'class' => 'ticker-cat-software', 'icon' => 'cpu'],
                        default => ['label' => 'Gift Card', 'class' => 'ticker-cat-buy', 'icon' => 'gift'],
                    };
                    $phone = $order->customer_phone ?: '01700000000';
                    $maskedPhone = substr($phone, 0, 3) . '***' . substr($phone, -3);
                    $timeText = $order->completed_at ? $order->completed_at->diffForHumans(null, true) . ' ago' : 'Just now';

                    return (object)[
                        'order_type' => $order->order_type,
                        'product_title' => $order->product_title ?: ($order->product ? $order->product->title : 'Digital Voucher'),
                        'amount_bdt' => $order->amount_bdt,
                        'payment_method' => ucfirst($order->payment_method ?: ($order->payout_method ?: 'bKash')),
                        'time_text' => $timeText,
                        'customer_masked' => $maskedPhone,
                        'category_label' => $cat['label'],
                        'category_class' => $cat['class'],
                        'icon' => $cat['icon'],
                    ];
                });
            }

            $view->with('liveTransactions', $transactions);
        });
    }
}
