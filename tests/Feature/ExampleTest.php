<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('RosTop');
    }

    public function test_game_topup_page_loads(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get(route('game.topup'));
        $response->assertStatus(200);
        $response->assertSee('Free Fire');
    }

    public function test_giftcard_sell_page_loads_and_calculator_works(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get(route('giftcards.sell'));
        $response->assertStatus(200);
        $response->assertSee('Instant Voucher Submission');

        $calcResponse = $this->postJson(route('api.rates.calculate'), [
            'brand' => 'apple',
            'currency' => 'USD',
            'amount' => 50,
        ]);

        $calcResponse->assertStatus(200);
        $calcResponse->assertJsonStructure([
            'brand',
            'amount',
            'rate_percent',
            'payout_usd',
            'payout_bdt',
            'formatted_bdt',
        ]);
    }

    public function test_giftcard_buy_and_subscription_and_digital_pages(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->get(route('giftcards.buy'))->assertStatus(200)->assertSee('Google Play');
        $this->get(route('subscriptions'))->assertStatus(200)->assertSee('Netflix');
        $this->get(route('digital.products'))->assertStatus(200)->assertSee('Windows 11');
        $this->get(route('game.show', 'free-fire'))->assertStatus(200)->assertSee('115 Diamonds');
    }

    public function test_order_placement_flow(): void
    {
        $this->seed(DatabaseSeeder::class);

        $pkg = \App\Models\ProductPackage::first();

        $response = $this->post(route('checkout.placeOrder'), [
            'package_id' => $pkg->id,
            'payment_method' => 'bkash',
            'sender_number' => '01711223344',
            'transaction_id' => 'BK99887766',
            'customer_phone' => '01899887766',
            'player_id_input' => '1029384756',
        ]);

        $response->assertStatus(302);
        $order = \App\Models\Order::where('transaction_id', 'BK99887766')->first();
        $this->assertNotNull($order);
        $this->assertEquals('pending', $order->status);
    }

    public function test_giftcard_sell_submission_flow(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->post(route('giftcards.sell.submit'), [
            'brand_key' => 'apple',
            'currency' => 'USD',
            'face_value' => 100,
            'gift_card_codes' => 'AP-1234-5678-9012',
            'payout_method' => 'bkash',
            'payout_account' => '01700112233',
            'customer_phone' => '01700112233',
        ]);

        $response->assertStatus(302);
        $order = \App\Models\Order::where('gift_card_codes', 'AP-1234-5678-9012')->first();
        $this->assertNotNull($order);
        $this->assertEquals('sell', $order->order_type);
        $this->assertEquals('pending', $order->status);
    }

    public function test_admin_dashboard_and_status_updates(): void
    {
        $this->seed(DatabaseSeeder::class);

        $admin = \App\Models\User::where('is_admin', true)->first();
        $this->actingAs($admin)->get(route('admin.dashboard'))->assertStatus(200);

        $order = \App\Models\Order::first();
        $this->actingAs($admin)->post(route('admin.order.status', $order->id), [
            'status' => 'completed',
            'admin_notes' => 'Verified and delivered',
        ])->assertStatus(302);

        $order->refresh();
        $this->assertEquals('completed', $order->status);
    }
}
