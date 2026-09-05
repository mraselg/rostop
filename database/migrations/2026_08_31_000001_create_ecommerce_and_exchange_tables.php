<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type'); // game_topup, giftcard_buy, giftcard_sell, subscription, software
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tag_badge')->nullable(); // Instant Delivery, 88% Rate, Hot, etc.
            $table->string('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('brand_color')->default('#10B981');
            $table->string('currency_symbol')->default('৳');
            $table->decimal('base_price_bdt', 10, 2)->default(0.00);
            $table->decimal('base_price_usd', 10, 2)->default(0.00);
            $table->decimal('rate_percentage', 5, 2)->default(0.85); // For selling gift cards (e.g. 0.88 = 88%)
            $table->string('stock_type')->default('manual_topup'); // auto_code, manual_topup, account_login
            $table->json('input_fields_schema')->nullable(); // [ { "name": "player_id", "label": "Player ID (UID)", "required": true } ]
            $table->text('instructions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Product Variations / Packages
        Schema::create('product_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // e.g. 115 Diamonds, $10 US Code, 1 Month UHD
            $table->decimal('amount_val', 10, 2)->default(0);
            $table->decimal('price_bdt', 10, 2)->default(0.00);
            $table->decimal('payout_bdt', 10, 2)->nullable();
            $table->decimal('original_price_bdt', 10, 2)->nullable();
            $table->integer('stock_count')->default(999);
            $table->string('badge')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Exchange Rates
        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('brand_key')->unique();
            $table->string('brand_name');
            $table->decimal('buy_rate_percent', 5, 2)->default(85.00);
            $table->decimal('sell_rate_percent', 5, 2)->default(88.00);
            $table->string('currency_code')->default('USD');
            $table->decimal('bdt_conversion_rate', 8, 2)->default(124.50);
            $table->decimal('min_value', 10, 2)->default(10.00);
            $table->decimal('max_value', 10, 2)->default(1000.00);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Orders & Sell Submissions
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->string('order_type')->default('buy'); // buy, sell, topup
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_package_id')->nullable()->constrained('product_packages')->nullOnDelete();
            $table->string('product_title');
            $table->string('package_title')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('amount_bdt', 10, 2);
            $table->decimal('amount_usd', 10, 2)->nullable();
            $table->string('payment_method')->nullable(); // bkash, nagad, rocket, upay, usdt, wallet
            $table->string('sender_number')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payout_method')->nullable(); // bkash, nagad, usdt
            $table->string('payout_account')->nullable(); // seller's bKash or USDT address
            $table->text('gift_card_codes')->nullable(); // Submitted card PIN / voucher code
            $table->text('gift_card_receipt')->nullable();
            $table->string('player_id_input')->nullable(); // Player UID
            $table->string('server_input')->nullable(); // Game Server or Zone ID
            $table->text('customer_notes')->nullable();
            $table->string('status')->default('pending'); // pending, processing, completed, rejected, refunded
            $table->text('delivered_codes')->nullable(); // Auto delivered voucher/code
            $table->text('admin_notes')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        // Reviews
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->integer('rating')->default(5);
            $table->text('comment');
            $table->string('service_tag'); // e.g. Free Fire, Apple Card Sell, Netflix
            $table->string('payout_amount')->nullable();
            $table->string('time_ago')->default('Just now');
            $table->boolean('is_verified')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function reverse(): void
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('exchange_rates');
        Schema::dropIfExists('product_packages');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
