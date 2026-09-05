<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ExchangeRate;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductPackage;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin & Demo User
        User::updateOrCreate(
            ['email' => 'admin@rostop.com'],
            [
                'name' => 'RosTop Admin',
                'phone' => '01700000000',
                'password' => Hash::make('admin1234'),
                'email_verified_at' => now(),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Tanvir Ahmed',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Categories
        $catTopup = Category::updateOrCreate(
            ['slug' => 'game-topup'],
            [
                'name' => 'Game Top-Up & Reload',
                'type' => 'game_topup',
                'icon' => '🎮',
                'description' => 'Instant in-game currency reload with Player ID / UID for Free Fire, PUBG, MLBB & more.',
                'sort_order' => 1,
            ]
        );

        $catGiftBuy = Category::updateOrCreate(
            ['slug' => 'buy-gift-cards'],
            [
                'name' => 'Buy Gift Cards',
                'type' => 'giftcard_buy',
                'icon' => '🎁',
                'description' => 'Google Play, Apple iTunes, Steam, PlayStation, Xbox digital redeem codes delivered instantly.',
                'sort_order' => 2,
            ]
        );

        $catGiftSell = Category::updateOrCreate(
            ['slug' => 'sell-gift-cards'],
            [
                'name' => 'Sell Gift Cards to Us',
                'type' => 'giftcard_sell',
                'icon' => '💰',
                'description' => 'Direct exchange platform: sell Paysafecard, Transcash, Neosurf, Apple & get paid to bKash/Nagad.',
                'sort_order' => 3,
            ]
        );

        $catSubs = Category::updateOrCreate(
            ['slug' => 'subscriptions'],
            [
                'name' => 'Digital Subscriptions & OTT',
                'type' => 'subscription',
                'icon' => '🎬',
                'description' => 'Netflix, Spotify, ChatGPT Plus, Canva Pro, YouTube Premium shared & private accounts.',
                'sort_order' => 4,
            ]
        );

        $catSoftware = Category::updateOrCreate(
            ['slug' => 'digital-products'],
            [
                'name' => 'Digital License Keys & Marketplace',
                'type' => 'software',
                'icon' => '🔑',
                'description' => 'Genuine Windows 10/11 Pro keys, Microsoft Office, Antivirus, AI Tools & Software licenses.',
                'sort_order' => 5,
            ]
        );

        // 3. Products & Packages
        // --- GAME TOPUP ---
        // 1. Free Fire
        $ff = Product::updateOrCreate(
            ['slug' => 'free-fire'],
            [
                'category_id' => $catTopup->id,
                'title' => 'Free Fire Diamond Top-Up BD (UID Instant)',
                'tag_badge' => 'Instant 10s',
                'short_desc' => 'Buy Free Fire Diamonds in Bangladesh with instant top up via Player ID (UID). 100% safe & automated.',
                'description' => 'Garena Free Fire Diamond top-up via Player ID (UID) in Bangladesh. 100% official automated recharge processed in 10-60 seconds. Supports bKash, Nagad, Rocket and Crypto USDT. No password or login required.',
                'image' => 'images/games/freefire.webp',
                'brand_color' => '#FF6B00',
                'base_price_bdt' => 20.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'Player ID (UID)', 'type' => 'text', 'placeholder' => 'আপনার Free Fire Player ID (UID) দিন', 'required' => true],
                ],
                'instructions' => '⚡ Player ID (UID) দিয়ে সাথে সাথে Diamond টপ-আপ হবে। সঠিক Player ID দিন — ভুল ID দিলে diamond অন্য account-এ চলে যেতে পারে। সাধারণত ১–৫ মিনিটের মধ্যে ডেলিভারি সম্পন্ন হয়।',
                'is_featured' => true,
                'sort_order' => 1,
            ]
        );
        ProductPackage::where('product_id', $ff->id)->delete();
        $ffPackages = [
            ['name' => 'Free Fire Weekly Lite', 'amount_val' => 50, 'price_bdt' => 39.00, 'original_price_bdt' => 45.00, 'badge' => 'Lite Deal'],
            ['name' => 'Free Fire Weekly Membership (450💎)', 'amount_val' => 450, 'price_bdt' => 158.00, 'original_price_bdt' => 180.00, 'badge' => 'VIP Pass'],
            ['name' => 'Free Fire Monthly Membership (2600💎)', 'amount_val' => 2600, 'price_bdt' => 790.00, 'original_price_bdt' => 890.00, 'badge' => 'Mega Deal'],
            ['name' => '25 Diamonds', 'amount_val' => 25, 'price_bdt' => 20.00, 'original_price_bdt' => 25.00, 'badge' => 'Starter'],
            ['name' => '50 Diamonds', 'amount_val' => 50, 'price_bdt' => 35.00, 'original_price_bdt' => 45.00],
            ['name' => '100 Diamonds', 'amount_val' => 100, 'price_bdt' => 70.00, 'original_price_bdt' => 85.00],
            ['name' => '115 Diamonds', 'amount_val' => 115, 'price_bdt' => 79.00, 'original_price_bdt' => 95.00, 'badge' => 'Best Value'],
            ['name' => '240 Diamonds', 'amount_val' => 240, 'price_bdt' => 158.00, 'original_price_bdt' => 190.00, 'badge' => 'Popular'],
            ['name' => '355 Diamonds', 'amount_val' => 355, 'price_bdt' => 237.00, 'original_price_bdt' => 280.00, 'badge' => 'Hot'],
            ['name' => '480 Diamonds', 'amount_val' => 480, 'price_bdt' => 316.00, 'original_price_bdt' => 360.00],
            ['name' => '505 Diamonds', 'amount_val' => 505, 'price_bdt' => 336.00, 'original_price_bdt' => 390.00],
            ['name' => '610 Diamonds', 'amount_val' => 610, 'price_bdt' => 400.00, 'original_price_bdt' => 470.00, 'badge' => 'Best Value'],
            ['name' => '725 Diamonds', 'amount_val' => 725, 'price_bdt' => 479.00, 'original_price_bdt' => 540.00, 'badge' => 'Top Pick'],
            ['name' => '1090 Diamonds', 'amount_val' => 1090, 'price_bdt' => 716.00, 'original_price_bdt' => 810.00],
            ['name' => '1240 Diamonds', 'amount_val' => 1240, 'price_bdt' => 800.00, 'original_price_bdt' => 940.00, 'badge' => 'Pro Pack'],
            ['name' => '2530 Diamonds', 'amount_val' => 2530, 'price_bdt' => 1610.00, 'original_price_bdt' => 1900.00, 'badge' => 'Mega Pack'],
            ['name' => '5060 Diamonds', 'amount_val' => 5060, 'price_bdt' => 3220.00, 'original_price_bdt' => 3700.00, 'badge' => 'Whale Pack'],
            ['name' => '7590 Diamonds', 'amount_val' => 7590, 'price_bdt' => 4830.00, 'original_price_bdt' => 5500.00, 'badge' => 'Mega Pack'],
            ['name' => '10120 Diamonds', 'amount_val' => 10120, 'price_bdt' => 6440.00, 'original_price_bdt' => 7300.00, 'badge' => 'Whale Pack'],
            ['name' => '12,650 Diamonds', 'amount_val' => 12650, 'price_bdt' => 8050.00, 'original_price_bdt' => 9100.00, 'badge' => 'VIP Master'],
            ['name' => 'Free Fire Level Up Pass (Level 6)', 'amount_val' => 300, 'price_bdt' => 39.00, 'badge' => 'Pass'],
            ['name' => 'Free Fire Level Up Pass (Level 10-25)', 'amount_val' => 500, 'price_bdt' => 65.00, 'badge' => 'Pass'],
            ['name' => 'Free Fire Level Up Pass (Level 30)', 'amount_val' => 800, 'price_bdt' => 90.00, 'badge' => 'Pass'],
            ['name' => '100 ID Diamonds (🇮🇩 Server)', 'amount_val' => 100, 'price_bdt' => 75.00, 'badge' => 'ID Server'],
            ['name' => '355 ID Diamonds (🇮🇩 Server)', 'amount_val' => 355, 'price_bdt' => 245.00, 'badge' => 'ID Server'],
            ['name' => '720 ID Diamonds (🇮🇩 Server)', 'amount_val' => 720, 'price_bdt' => 485.00, 'badge' => 'ID Server'],
            ['name' => '100 Garena Shells (BD/SG)', 'amount_val' => 100, 'price_bdt' => 165.00, 'badge' => 'Voucher'],
            ['name' => '200 Garena Shells (BD/SG)', 'amount_val' => 200, 'price_bdt' => 325.00, 'badge' => 'Voucher'],
            ['name' => '500 Garena Shells (BD/SG)', 'amount_val' => 500, 'price_bdt' => 810.00, 'badge' => 'Voucher'],
        ];
        foreach ($ffPackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $ff->id, 'sort_order' => $i + 1]));
        }

        // 2. PUBG Mobile Voucher (Global)
        $pubg = Product::updateOrCreate(
            ['slug' => 'pubg-mobile'],
            [
                'category_id' => $catTopup->id,
                'title' => 'PUBG Mobile Voucher (Global) BD',
                'tag_badge' => 'Fast 2-5 Min',
                'short_desc' => 'Buy PUBG Mobile UC Voucher Global with instant digital redeem code in Bangladesh.',
                'description' => 'Direct UC reload & instant digital vouchers for PUBG Mobile Global. Fast, verified UC top-up for Royale Pass, crate openings, and mythic outfits.',
                'image' => 'images/games/pubg.png',
                'brand_color' => '#F59E0B',
                'base_price_bdt' => 122.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'Character ID', 'type' => 'text', 'placeholder' => 'e.g. 5129482910', 'required' => true],
                    ['name' => 'player_name', 'label' => 'In-Game Nickname', 'type' => 'text', 'placeholder' => 'e.g. ShadowHunter', 'required' => false],
                ],
                'is_featured' => true,
                'sort_order' => 2,
            ]
        );
        ProductPackage::where('product_id', $pubg->id)->delete();
        $pubgPackages = [
            ['name' => '60 UC Voucher ⚡️', 'amount_val' => 60, 'price_bdt' => 122.00, 'original_price_bdt' => 140.00, 'badge' => 'Instant'],
            ['name' => '325 UC Voucher ⚡️', 'amount_val' => 325, 'price_bdt' => 608.00, 'original_price_bdt' => 680.00, 'badge' => 'Popular'],
            ['name' => '660 UC Voucher ⚡️ (Royale Pass)', 'amount_val' => 660, 'price_bdt' => 1215.00, 'original_price_bdt' => 1350.00, 'badge' => 'Royale Pass'],
            ['name' => '1800 UC Voucher ⚡️', 'amount_val' => 1800, 'price_bdt' => 3038.00, 'original_price_bdt' => 3350.00, 'badge' => 'Elite'],
            ['name' => '3850 UC Voucher ⚡️', 'amount_val' => 3850, 'price_bdt' => 6061.00, 'original_price_bdt' => 6650.00, 'badge' => 'Pro Pack'],
            ['name' => '8100 UC Voucher ⚡️', 'amount_val' => 8100, 'price_bdt' => 12053.00, 'original_price_bdt' => 13200.00, 'badge' => 'Mythic Pack'],
            ['name' => '60 UC Voucher (🇲🇾 Malaysia)', 'amount_val' => 60, 'price_bdt' => 125.00, 'badge' => 'Malaysia'],
            ['name' => '325 UC Voucher (🇲🇾 Malaysia)', 'amount_val' => 325, 'price_bdt' => 615.00, 'badge' => 'Malaysia'],
            ['name' => '660 UC Voucher (🇲🇾 Malaysia)', 'amount_val' => 660, 'price_bdt' => 1230.00, 'badge' => 'Malaysia'],
            ['name' => '60 UC Voucher (🇹🇼 Taiwan)', 'amount_val' => 60, 'price_bdt' => 130.00, 'badge' => 'Taiwan'],
            ['name' => '325 UC Voucher (🇹🇼 Taiwan)', 'amount_val' => 325, 'price_bdt' => 625.00, 'badge' => 'Taiwan'],
        ];
        foreach ($pubgPackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $pubg->id, 'sort_order' => $i + 1]));
        }

        // 3. Mobile Legends (MLBB)
        $mlbb = Product::updateOrCreate(
            ['slug' => 'mobile-legends'],
            [
                'category_id' => $catTopup->id,
                'title' => 'Mobile Legends (MLBB) Diamonds Top Up BD',
                'tag_badge' => 'Instant Global',
                'short_desc' => 'Buy Mobile Legends (MLBB) Diamonds in Bangladesh with instant top up. Fast, secure & affordable via bKash, Nagad & Rocket.',
                'description' => 'Buy Mobile Legends Diamonds (MLBB) Top Up and Starlight members at RosTop. Friends come together in the brand new 5 versus 5 MOBA showdown against real human opponents, Mobile Legends! 100% official direct reload to your account within 1-5 minutes.',
                'image' => 'images/games/mlbb.jpg',
                'brand_color' => '#3B82F6',
                'base_price_bdt' => 101.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'User ID', 'type' => 'text', 'placeholder' => 'আপনার User ID এখানে দিন', 'required' => true],
                    ['name' => 'zone_id', 'label' => 'Server / Zone ID', 'type' => 'text', 'placeholder' => 'আপনার Server ID এখানে দিন', 'required' => true],
                ],
                'instructions' => '🏷️ 50+50, 150+150, 250+250, 500+500 এই প্যাকেজ গুলো আপনার একাউন্টে থাকলে পাবেন। নয়তো রেগুলার প্যাকেজ পাবেন। অর্ডার করার আগে গেমে দেখে নিন এই অফার আছে কিনা',
                'is_featured' => true,
                'sort_order' => 3,
            ]
        );
        ProductPackage::where('product_id', $mlbb->id)->delete();
        $mlbbPackages = [
            ['name' => 'Weekly Elite Pack', 'amount_val' => 100, 'price_bdt' => 103.00, 'badge' => 'Special'],
            ['name' => 'Monthly Elite Pack', 'amount_val' => 500, 'price_bdt' => 508.00, 'badge' => 'VIP'],
            ['name' => 'Weekly Pass', 'amount_val' => 210, 'price_bdt' => 197.00, 'badge' => 'Hot Pass'],
            ['name' => 'Twilight Pass', 'amount_val' => 1000, 'price_bdt' => 1033.00, 'badge' => 'Season Pass'],
            ['name' => '50+50 Diamonds', 'amount_val' => 100, 'price_bdt' => 101.00, 'badge' => '100% Bonus'],
            ['name' => '150+150 Diamonds', 'amount_val' => 300, 'price_bdt' => 301.00, 'badge' => '100% Bonus'],
            ['name' => '250+250 Diamonds', 'amount_val' => 500, 'price_bdt' => 482.00, 'badge' => 'Double Deal'],
            ['name' => '500+500 Diamonds', 'amount_val' => 1000, 'price_bdt' => 989.00, 'badge' => 'Mega Bonus'],
            ['name' => '55 Diamonds', 'amount_val' => 55, 'price_bdt' => 101.00, 'badge' => 'Starter'],
            ['name' => '86 Diamonds', 'amount_val' => 86, 'price_bdt' => 158.00],
            ['name' => '165 Diamonds', 'amount_val' => 165, 'price_bdt' => 301.00],
            ['name' => '275 Diamonds', 'amount_val' => 275, 'price_bdt' => 482.00, 'badge' => 'Popular'],
            ['name' => '565 Diamonds', 'amount_val' => 565, 'price_bdt' => 989.00, 'badge' => 'Hot'],
            ['name' => '706 Diamonds', 'amount_val' => 706, 'price_bdt' => 1232.00, 'badge' => 'Pro Gamer'],
            ['name' => '2195 Diamonds', 'amount_val' => 2195, 'price_bdt' => 3729.00],
            ['name' => '3688 Diamonds', 'amount_val' => 3688, 'price_bdt' => 6222.00],
            ['name' => '5532 Diamonds', 'amount_val' => 5532, 'price_bdt' => 9392.00],
            ['name' => '9288 Diamonds', 'amount_val' => 9288, 'price_bdt' => 15601.00, 'badge' => 'Whale Pack'],
        ];
        foreach ($mlbbPackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $mlbb->id, 'sort_order' => $i + 1]));
        }

        // 4. EA Sports FC Mobile (Jubaly Market Authentic)
        $fcMobile = Product::updateOrCreate(
            ['slug' => 'fc-mobile'],
            [
                'category_id' => $catTopup->id,
                'title' => 'EA Sports FC Mobile Points & Silver Top-Up BD',
                'tag_badge' => 'Instant 1-5m',
                'short_desc' => 'Instant EA FC Mobile FC Points and Silver recharge in Bangladesh via UID.',
                'description' => 'Fast and verified EA Sports FC Mobile Points and Silver top-up for Bangladesh server. Instant recharge directly to your account.',
                'image' => 'images/games/fc_mobile.webp',
                'brand_color' => '#107C10',
                'base_price_bdt' => 55.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'EA FC Mobile UID', 'type' => 'text', 'placeholder' => 'আপনার FC Mobile UID দিন', 'required' => true],
                ],
                'is_featured' => true,
                'sort_order' => 4,
            ]
        );
        ProductPackage::where('product_id', $fcMobile->id)->delete();
        $fcMobilePackages = [
            ['name' => '40 FC Point ⚡', 'amount_val' => 40, 'price_bdt' => 55.00, 'badge' => 'Starter'],
            ['name' => '100 FC Point ⚡', 'amount_val' => 100, 'price_bdt' => 155.00, 'badge' => 'Popular'],
            ['name' => '520 FC Point ⚡', 'amount_val' => 520, 'price_bdt' => 710.00, 'badge' => 'Best Value'],
            ['name' => '1070 FC Point ⚡', 'amount_val' => 1070, 'price_bdt' => 1445.00],
            ['name' => '2200 FC Point ⚡', 'amount_val' => 2200, 'price_bdt' => 2890.00, 'badge' => 'Pro Pack'],
            ['name' => '5750 FC Point ⚡', 'amount_val' => 5750, 'price_bdt' => 7250.00],
            ['name' => '12000 FC Point ⚡', 'amount_val' => 12000, 'price_bdt' => 14500.00, 'badge' => 'Whale Pack'],
            ['name' => '39 Silver ⚡', 'amount_val' => 39, 'price_bdt' => 60.00],
            ['name' => '99 Silver ⚡', 'amount_val' => 99, 'price_bdt' => 155.00],
            ['name' => '499 Silver ⚡', 'amount_val' => 499, 'price_bdt' => 710.00, 'badge' => 'Popular'],
            ['name' => '999 Silver ⚡', 'amount_val' => 999, 'price_bdt' => 1445.00],
            ['name' => '1999 Silver ⚡', 'amount_val' => 1999, 'price_bdt' => 2890.00],
        ];
        foreach ($fcMobilePackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $fcMobile->id, 'sort_order' => $i + 1]));
        }

        // 5. Honor of Kings (HOK)
        $hok = Product::updateOrCreate(
            ['slug' => 'honor-of-kings'],
            [
                'category_id' => $catTopup->id,
                'title' => 'Honor of Kings (HOK) Tokens Top-Up BD',
                'tag_badge' => 'Instant UID',
                'short_desc' => 'Fast & verified Honor of Kings Tokens top-up in Bangladesh with instant delivery via Player ID.',
                'description' => 'Buy Honor of Kings (HOK) Tokens and Weekly Cards at the lowest prices in Bangladesh. 100% safe, official direct UID recharge.',
                'image' => 'images/games/honor_of_kings.png',
                'brand_color' => '#CA8A04',
                'base_price_bdt' => 25.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'Player ID (UID)', 'type' => 'text', 'placeholder' => 'আপনার HOK Player ID দিন', 'required' => true],
                ],
                'is_featured' => true,
                'sort_order' => 5,
            ]
        );
        ProductPackage::where('product_id', $hok->id)->delete();
        $hokPackages = [
            ['name' => '16 Token', 'amount_val' => 16, 'price_bdt' => 25.00],
            ['name' => '80 Token', 'amount_val' => 80, 'price_bdt' => 120.00, 'badge' => 'Starter'],
            ['name' => '240 Token', 'amount_val' => 240, 'price_bdt' => 360.00],
            ['name' => '400 Token', 'amount_val' => 400, 'price_bdt' => 601.00, 'badge' => 'Popular'],
            ['name' => '560 Token', 'amount_val' => 560, 'price_bdt' => 842.00],
            ['name' => '830 Token', 'amount_val' => 830, 'price_bdt' => 1204.00, 'badge' => 'Best Value'],
            ['name' => '1245 Token', 'amount_val' => 1245, 'price_bdt' => 1806.00],
            ['name' => '2508 Token', 'amount_val' => 2508, 'price_bdt' => 3611.00],
            ['name' => '4180 Token', 'amount_val' => 4180, 'price_bdt' => 6019.00],
            ['name' => '8360 Token', 'amount_val' => 8360, 'price_bdt' => 12040.00, 'badge' => 'Whale Pack'],
            ['name' => 'Weekly Card', 'amount_val' => 100, 'price_bdt' => 136.00, 'badge' => 'Card'],
            ['name' => 'Weekly Card Plus', 'amount_val' => 300, 'price_bdt' => 397.00, 'badge' => 'Card Plus'],
        ];
        foreach ($hokPackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $hok->id, 'sort_order' => $i + 1]));
        }

        // 6. Blood Strike
        $bloodStrike = Product::updateOrCreate(
            ['slug' => 'blood-strike'],
            [
                'category_id' => $catTopup->id,
                'title' => 'Blood Strike Golds & Strike Pass Top-Up BD',
                'tag_badge' => 'Instant Top-Up',
                'short_desc' => 'Buy Blood Strike Golds & Strike Pass in Bangladesh with instant automated delivery via User ID.',
                'description' => 'Fast & verified Blood Strike Gold top up. Instant delivery to your Blood Strike account via User ID. 100% ban-free and official.',
                'image' => 'images/games/blood_strike.webp',
                'brand_color' => '#DC2626',
                'base_price_bdt' => 59.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'Blood Strike User ID', 'type' => 'text', 'placeholder' => 'আপনার Blood Strike User ID দিন', 'required' => true],
                ],
                'is_featured' => true,
                'sort_order' => 6,
            ]
        );
        ProductPackage::where('product_id', $bloodStrike->id)->delete();
        $bloodStrikePackages = [
            ['name' => '51 Golds', 'amount_val' => 51, 'price_bdt' => 59.00],
            ['name' => '105 Golds', 'amount_val' => 105, 'price_bdt' => 107.00],
            ['name' => '320 Golds', 'amount_val' => 320, 'price_bdt' => 321.00, 'badge' => 'Popular'],
            ['name' => '540 Golds', 'amount_val' => 540, 'price_bdt' => 535.00],
            ['name' => '1100 Golds', 'amount_val' => 1100, 'price_bdt' => 1068.00, 'badge' => 'Best Value'],
            ['name' => '2260 Golds', 'amount_val' => 2260, 'price_bdt' => 2136.00],
            ['name' => '5800 Golds', 'amount_val' => 5800, 'price_bdt' => 5365.00, 'badge' => 'Mega Pack'],
            ['name' => 'Season Pass', 'amount_val' => 100, 'price_bdt' => 115.00, 'badge' => 'Pass'],
            ['name' => 'Strike Pass Elite', 'amount_val' => 400, 'price_bdt' => 461.00, 'badge' => 'Elite Pass'],
            ['name' => 'Strike Pass Premium', 'amount_val' => 900, 'price_bdt' => 1039.00, 'badge' => 'Premium Pass'],
        ];
        foreach ($bloodStrikePackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $bloodStrike->id, 'sort_order' => $i + 1]));
        }

        // 7. Super Sus
        $superSus = Product::updateOrCreate(
            ['slug' => 'super-sus'],
            [
                'category_id' => $catTopup->id,
                'title' => 'Super Sus Golden Star Top-Up BD',
                'tag_badge' => 'Instant Top-Up',
                'short_desc' => 'Buy Super Sus Goldstar & Super Pass in Bangladesh with instant delivery via Space ID.',
                'description' => 'Fast, verified Super Sus Golden Star top up in Bangladesh. Instant reload via Space ID.',
                'image' => 'images/games/super_sus.webp',
                'brand_color' => '#9333EA',
                'base_price_bdt' => 95.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'Space ID', 'type' => 'text', 'placeholder' => 'আপনার Super Sus Space ID দিন', 'required' => true],
                ],
                'is_featured' => true,
                'sort_order' => 7,
            ]
        );
        ProductPackage::where('product_id', $superSus->id)->delete();
        $superSusPackages = [
            ['name' => '100 Goldstar', 'amount_val' => 100, 'price_bdt' => 95.00, 'badge' => 'Starter'],
            ['name' => '300+20 Goldstar', 'amount_val' => 320, 'price_bdt' => 285.00, 'badge' => 'Popular'],
            ['name' => '500+50 Goldstar', 'amount_val' => 550, 'price_bdt' => 475.00, 'badge' => 'Best Value'],
            ['name' => '1000+120 Goldstar', 'amount_val' => 1120, 'price_bdt' => 950.00, 'badge' => 'Pro Pack'],
            ['name' => 'Super Pass', 'amount_val' => 500, 'price_bdt' => 470.00, 'badge' => 'Pass'],
        ];
        foreach ($superSusPackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $superSus->id, 'sort_order' => $i + 1]));
        }

        // 8. eFootball Mobile
        $efootball = Product::updateOrCreate(
            ['slug' => 'efootball'],
            [
                'category_id' => $catTopup->id,
                'title' => 'eFootball Coins Top-Up BD',
                'tag_badge' => 'Instant Coins',
                'short_desc' => 'Buy eFootball Coins in Bangladesh at the lowest price with fast automated delivery.',
                'description' => 'Fast, verified eFootball coins top-up for mobile gamers. Safe and ban-free direct reload.',
                'image' => 'images/games/efootball.webp',
                'brand_color' => '#0284C7',
                'base_price_bdt' => 135.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'Konami ID / User ID', 'type' => 'text', 'placeholder' => 'আপনার Konami ID / User ID দিন', 'required' => true],
                ],
                'is_featured' => true,
                'sort_order' => 8,
            ]
        );
        ProductPackage::where('product_id', $efootball->id)->delete();
        $efootballPackages = [
            ['name' => '130 eFootball Coins', 'amount_val' => 130, 'price_bdt' => 135.00],
            ['name' => '320 eFootball Coins', 'amount_val' => 320, 'price_bdt' => 330.00, 'badge' => 'Popular'],
            ['name' => '550 eFootball Coins', 'amount_val' => 550, 'price_bdt' => 550.00],
            ['name' => '1050 eFootball Coins', 'amount_val' => 1050, 'price_bdt' => 1050.00, 'badge' => 'Best Value'],
            ['name' => '2130 eFootball Coins', 'amount_val' => 2130, 'price_bdt' => 2100.00],
            ['name' => '3250 eFootball Coins', 'amount_val' => 3250, 'price_bdt' => 3150.00, 'badge' => 'Mega Pack'],
        ];
        foreach ($efootballPackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $efootball->id, 'sort_order' => $i + 1]));
        }

        // 9. Genshin Impact
        $genshin = Product::updateOrCreate(
            ['slug' => 'genshin-impact'],
            [
                'category_id' => $catTopup->id,
                'title' => 'Genshin Impact Genesis Crystals Top-Up BD',
                'tag_badge' => 'Instant Crystals',
                'short_desc' => 'Buy Genshin Impact Genesis Crystals & Blessing of the Welkin Moon with instant UID top up.',
                'description' => 'Official Genshin Impact Genesis Crystals direct reload to your UID. Choose server and enter UID for 1-5 min automated delivery.',
                'image' => 'images/games/genshin_impact.webp',
                'brand_color' => '#4F46E5',
                'base_price_bdt' => 110.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'UID', 'type' => 'text', 'placeholder' => 'আপনার Genshin UID দিন', 'required' => true],
                    ['name' => 'zone_id', 'label' => 'Server (e.g. Asia, America, Europe)', 'type' => 'text', 'placeholder' => 'Asia / America / Europe', 'required' => true],
                ],
                'is_featured' => true,
                'sort_order' => 9,
            ]
        );
        ProductPackage::where('product_id', $genshin->id)->delete();
        $genshinPackages = [
            ['name' => '60 Genesis Crystals', 'amount_val' => 60, 'price_bdt' => 110.00],
            ['name' => '300+30 Genesis Crystals', 'amount_val' => 330, 'price_bdt' => 550.00],
            ['name' => '980+110 Genesis Crystals', 'amount_val' => 1090, 'price_bdt' => 1650.00, 'badge' => 'Popular'],
            ['name' => '1980+260 Genesis Crystals', 'amount_val' => 2240, 'price_bdt' => 3300.00],
            ['name' => '3280+600 Genesis Crystals', 'amount_val' => 3880, 'price_bdt' => 5500.00, 'badge' => 'Pro Pack'],
            ['name' => 'Blessing of the Welkin Moon (30 Days)', 'amount_val' => 3000, 'price_bdt' => 550.00, 'badge' => 'Best Deal'],
        ];
        foreach ($genshinPackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $genshin->id, 'sort_order' => $i + 1]));
        }

        // 10. Clash of Clans (COC)
        $coc = Product::updateOrCreate(
            ['slug' => 'clash-of-clans'],
            [
                'category_id' => $catTopup->id,
                'title' => 'Clash of Clans (COC) Gems & Gold Pass BD',
                'tag_badge' => 'Instant Player Tag',
                'short_desc' => 'Buy Clash of Clans Gems & Gold Pass in Bangladesh with instant top up via Player Tag.',
                'description' => 'Fast, verified Clash of Clans Gems and Gold Pass top up. Direct reload via Player Tag.',
                'image' => 'images/games/clash_of_clans.jpg',
                'brand_color' => '#D97706',
                'base_price_bdt' => 115.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'Player Tag (#TAG)', 'type' => 'text', 'placeholder' => 'e.g. #9LQ8VYPV', 'required' => true],
                ],
                'is_featured' => true,
                'sort_order' => 10,
            ]
        );
        ProductPackage::where('product_id', $coc->id)->delete();
        $cocPackages = [
            ['name' => '80 Gems', 'amount_val' => 80, 'price_bdt' => 115.00],
            ['name' => '500 Gems', 'amount_val' => 500, 'price_bdt' => 550.00, 'badge' => 'Popular'],
            ['name' => '1200 Gems', 'amount_val' => 1200, 'price_bdt' => 1100.00],
            ['name' => '2500 Gems', 'amount_val' => 2500, 'price_bdt' => 2200.00],
            ['name' => 'Gold Pass (Current Season)', 'amount_val' => 500, 'price_bdt' => 790.00, 'badge' => 'Gold Pass'],
        ];
        foreach ($cocPackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $coc->id, 'sort_order' => $i + 1]));
        }

        // 11. Valorant VP
        $valorant = Product::updateOrCreate(
            ['slug' => 'valorant'],
            [
                'category_id' => $catTopup->id,
                'title' => 'Valorant Points (Riot ID Instant)',
                'tag_badge' => 'Instant Riot ID',
                'short_desc' => 'Buy Valorant Points (VP) in Bangladesh directly to your Riot account with Riot ID & Tagline.',
                'description' => 'Fast, verified Valorant Points top-up via Riot ID & Tagline. Purchase weapon skins, Battle Pass, and Radianite Points safely.',
                'image' => 'images/games/valorant.jpg',
                'brand_color' => '#FA4454',
                'base_price_bdt' => 520.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'Riot ID & Tagline', 'type' => 'text', 'placeholder' => 'e.g. Jett#NA1 or RosTop#BD1', 'required' => true],
                ],
                'is_featured' => true,
                'sort_order' => 11,
            ]
        );
        ProductPackage::where('product_id', $valorant->id)->delete();
        $valPackages = [
            ['name' => '475 Valorant Points', 'amount_val' => 475, 'price_bdt' => 520.00, 'badge' => 'Starter'],
            ['name' => '1000 Valorant Points (Battle Pass)', 'amount_val' => 1000, 'price_bdt' => 1050.00, 'badge' => 'Battle Pass'],
            ['name' => '2050 Valorant Points', 'amount_val' => 2050, 'price_bdt' => 2100.00, 'badge' => 'Popular'],
            ['name' => '3650 Valorant Points', 'amount_val' => 3650, 'price_bdt' => 3650.00, 'badge' => 'Value'],
        ];
        foreach ($valPackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $valorant->id, 'sort_order' => $i + 1]));
        }

        // 12. Roblox Robux
        $roblox = Product::updateOrCreate(
            ['slug' => 'roblox'],
            [
                'category_id' => $catTopup->id,
                'title' => 'Roblox Robux (Username Instant)',
                'tag_badge' => 'Instant Robux',
                'short_desc' => 'Instant Robux digital reload for Roblox in Bangladesh via Username.',
                'description' => 'Direct Roblox Robux reload via official Roblox digital vouchers and username transfer.',
                'image' => 'images/games/roblox.jpg',
                'brand_color' => '#E02424',
                'base_price_bdt' => 120.00,
                'stock_type' => 'manual_topup',
                'input_fields_schema' => [
                    ['name' => 'player_id', 'label' => 'Roblox Username', 'type' => 'text', 'placeholder' => 'আপনার Roblox Username দিন', 'required' => true],
                ],
                'is_featured' => true,
                'sort_order' => 12,
            ]
        );
        ProductPackage::where('product_id', $roblox->id)->delete();
        $robloxPackages = [
            ['name' => '80 Robux', 'amount_val' => 80, 'price_bdt' => 120.00],
            ['name' => '400 Robux', 'amount_val' => 400, 'price_bdt' => 580.00, 'badge' => 'Popular'],
            ['name' => '800 Robux', 'amount_val' => 800, 'price_bdt' => 1150.00, 'badge' => 'Hot'],
            ['name' => '1700 Robux', 'amount_val' => 1700, 'price_bdt' => 2400.00, 'badge' => 'Mega'],
        ];
        foreach ($robloxPackages as $i => $pkg) {
            ProductPackage::create(array_merge($pkg, ['product_id' => $roblox->id, 'sort_order' => $i + 1]));
        }

        // --- BUY GIFT CARDS ---
        $gplay = Product::updateOrCreate(
            ['slug' => 'google-play-us'],
            [
                'category_id' => $catGiftBuy->id,
                'title' => 'Google Play Gift Card (US Store)',
                'tag_badge' => 'Instant Digital Code',
                'short_desc' => 'Official Google Play US digital redeem codes for apps, games, movies and in-app items.',
                'description' => 'Redeemable on United States Google Play Store. Code delivered instantly upon payment confirmation.',
                'brand_color' => '#4285F4',
                'base_price_bdt' => 640.00,
                'stock_type' => 'auto_code',
                'is_featured' => true,
                'sort_order' => 4,
            ]
        );

        $gplayPackages = [
            ['name' => '$5 US Code', 'amount_val' => 5, 'price_bdt' => 640.00],
            ['name' => '$10 US Code', 'amount_val' => 10, 'price_bdt' => 1270.00, 'badge' => 'Popular'],
            ['name' => '$15 US Code', 'amount_val' => 15, 'price_bdt' => 1890.00],
            ['name' => '$25 US Code', 'amount_val' => 25, 'price_bdt' => 3150.00, 'badge' => 'Hot'],
            ['name' => '$50 US Code', 'amount_val' => 50, 'price_bdt' => 6250.00],
        ];
        foreach ($gplayPackages as $i => $pkg) {
            ProductPackage::updateOrCreate(
                ['product_id' => $gplay->id, 'name' => $pkg['name']],
                array_merge($pkg, ['sort_order' => $i + 1])
            );
        }

        $apple = Product::updateOrCreate(
            ['slug' => 'apple-gift-card'],
            [
                'category_id' => $catGiftBuy->id,
                'title' => 'Apple / iTunes Gift Card (US & Global)',
                'tag_badge' => 'Instant Digital Code',
                'short_desc' => 'Redeem for App Store, iCloud+ storage, Apple Music, Apple Arcade and in-app purchases.',
                'description' => 'Official Apple gift card redeem code. Instant email & dashboard delivery.',
                'brand_color' => '#111827',
                'base_price_bdt' => 1260.00,
                'stock_type' => 'auto_code',
                'is_featured' => true,
                'sort_order' => 5,
            ]
        );

        $applePackages = [
            ['name' => '$10 US Apple Card', 'amount_val' => 10, 'price_bdt' => 1260.00, 'badge' => 'Popular'],
            ['name' => '$15 US Apple Card', 'amount_val' => 15, 'price_bdt' => 1880.00],
            ['name' => '$25 US Apple Card', 'amount_val' => 25, 'price_bdt' => 3120.00, 'badge' => 'Bestseller'],
            ['name' => '$50 US Apple Card', 'amount_val' => 50, 'price_bdt' => 6200.00],
        ];
        foreach ($applePackages as $i => $pkg) {
            ProductPackage::updateOrCreate(
                ['product_id' => $apple->id, 'name' => $pkg['name']],
                array_merge($pkg, ['sort_order' => $i + 1])
            );
        }

        $steam = Product::updateOrCreate(
            ['slug' => 'steam-wallet'],
            [
                'category_id' => $catGiftBuy->id,
                'title' => 'Steam Wallet Card (Global / USD)',
                'tag_badge' => 'Instant Code',
                'short_desc' => 'Add funds to Steam Wallet to buy PC games, DLCs, and community market items.',
                'description' => 'Global Steam Wallet digital card codes without region locks.',
                'brand_color' => '#1B2838',
                'base_price_bdt' => 650.00,
                'stock_type' => 'auto_code',
                'is_featured' => true,
                'sort_order' => 6,
            ]
        );

        $steamPackages = [
            ['name' => '$5 Global Steam Card', 'amount_val' => 5, 'price_bdt' => 650.00],
            ['name' => '$10 Global Steam Card', 'amount_val' => 10, 'price_bdt' => 1290.00, 'badge' => 'Popular'],
            ['name' => '$20 Global Steam Card', 'amount_val' => 20, 'price_bdt' => 2550.00],
            ['name' => '$50 Global Steam Card', 'amount_val' => 50, 'price_bdt' => 6350.00, 'badge' => 'Pro'],
        ];
        foreach ($steamPackages as $i => $pkg) {
            ProductPackage::updateOrCreate(
                ['product_id' => $steam->id, 'name' => $pkg['name']],
                array_merge($pkg, ['sort_order' => $i + 1])
            );
        }

        // --- SUBSCRIPTIONS ---
        $netflix = Product::updateOrCreate(
            ['slug' => 'netflix-premium'],
            [
                'category_id' => $catSubs->id,
                'title' => 'Netflix Premium Ultra HD 4K',
                'tag_badge' => 'Personal PIN Profile',
                'short_desc' => '1 Screen with private PIN or Full Account 4 Screens. 4K HDR streaming with warranty.',
                'description' => 'Enjoy unlimited Netflix movies & series in 4K HDR. Choose 1 Screen Private PIN or 4 Screens Full Private Account with 30-day replacement guarantee.',
                'brand_color' => '#E50914',
                'base_price_bdt' => 280.00,
                'stock_type' => 'account_login',
                'is_featured' => true,
                'sort_order' => 7,
            ]
        );

        $netflixPackages = [
            ['name' => '1 Month (1 Screen Private PIN)', 'amount_val' => 1, 'price_bdt' => 280.00, 'original_price_bdt' => 350.00, 'badge' => 'Top Seller'],
            ['name' => '3 Months (1 Screen Private PIN)', 'amount_val' => 3, 'price_bdt' => 790.00, 'original_price_bdt' => 950.00, 'badge' => 'Save 15%'],
            ['name' => '6 Months (1 Screen Private PIN)', 'amount_val' => 6, 'price_bdt' => 1490.00, 'original_price_bdt' => 1800.00, 'badge' => 'Mega Value'],
            ['name' => '1 Month (Full 4 Screens Account)', 'amount_val' => 1, 'price_bdt' => 980.00, 'original_price_bdt' => 1200.00, 'badge' => 'Family Plan'],
        ];
        foreach ($netflixPackages as $i => $pkg) {
            ProductPackage::updateOrCreate(
                ['product_id' => $netflix->id, 'name' => $pkg['name']],
                array_merge($pkg, ['sort_order' => $i + 1])
            );
        }

        $chatgpt = Product::updateOrCreate(
            ['slug' => 'chatgpt-plus'],
            [
                'category_id' => $catSubs->id,
                'title' => 'ChatGPT Plus (GPT-4o & Advanced Voice)',
                'tag_badge' => 'AI Tool',
                'short_desc' => 'Access OpenAI GPT-4o, DALL-E 3 image generator, Sora preview, canvas & custom GPTs.',
                'description' => 'Supercharge your productivity and coding with ChatGPT Plus. Private login or high-speed shared slot.',
                'brand_color' => '#10A37F',
                'base_price_bdt' => 450.00,
                'stock_type' => 'account_login',
                'is_featured' => true,
                'sort_order' => 8,
            ]
        );

        $chatgptPackages = [
            ['name' => '1 Month Shared Pro Slot', 'amount_val' => 1, 'price_bdt' => 450.00, 'original_price_bdt' => 600.00, 'badge' => 'Best Deal'],
            ['name' => '1 Month Private Email Upgrade', 'amount_val' => 1, 'price_bdt' => 2450.00, 'original_price_bdt' => 2800.00, 'badge' => 'Personal Account'],
            ['name' => '3 Months Shared Pro Slot', 'amount_val' => 3, 'price_bdt' => 1250.00, 'original_price_bdt' => 1600.00],
        ];
        foreach ($chatgptPackages as $i => $pkg) {
            ProductPackage::updateOrCreate(
                ['product_id' => $chatgpt->id, 'name' => $pkg['name']],
                array_merge($pkg, ['sort_order' => $i + 1])
            );
        }

        $canva = Product::updateOrCreate(
            ['slug' => 'canva-pro'],
            [
                'category_id' => $catSubs->id,
                'title' => 'Canva Pro (1 Year / Lifetime Team Access)',
                'tag_badge' => 'Graphic Design',
                'short_desc' => 'Upgrade your own email to Canva Pro. 100M+ stock photos, videos, AI Magic Studio tools.',
                'description' => 'Direct invite to your personal Gmail. Full access to background remover, brand kits, premium fonts.',
                'brand_color' => '#7D2AE8',
                'base_price_bdt' => 180.00,
                'stock_type' => 'account_login',
                'input_fields_schema' => [
                    ['name' => 'canva_email', 'label' => 'Your Canva Account Email', 'type' => 'email', 'placeholder' => 'e.g. designer@gmail.com', 'required' => true],
                ],
                'is_featured' => true,
                'sort_order' => 9,
            ]
        );

        $canvaPackages = [
            ['name' => '1 Year Pro License', 'amount_val' => 1, 'price_bdt' => 180.00, 'original_price_bdt' => 350.00, 'badge' => 'Hot Deal'],
            ['name' => 'Lifetime Pro Team Access', 'amount_val' => 99, 'price_bdt' => 350.00, 'original_price_bdt' => 700.00, 'badge' => 'Lifetime'],
        ];
        foreach ($canvaPackages as $i => $pkg) {
            ProductPackage::updateOrCreate(
                ['product_id' => $canva->id, 'name' => $pkg['name']],
                array_merge($pkg, ['sort_order' => $i + 1])
            );
        }

        // --- SOFTWARE & DIGITAL PRODUCTS ---
        $win11 = Product::updateOrCreate(
            ['slug' => 'windows-11-pro'],
            [
                'category_id' => $catSoftware->id,
                'title' => 'Windows 11 Pro Genuine OEM Key',
                'tag_badge' => 'Genuine Lifetime',
                'short_desc' => '1 PC Lifetime activation key for Windows 11 Professional (32/64 bit).',
                'description' => 'Official Microsoft OEM license key with online activation and lifetime updates.',
                'brand_color' => '#0078D4',
                'base_price_bdt' => 390.00,
                'stock_type' => 'auto_code',
                'is_featured' => true,
                'sort_order' => 10,
            ]
        );

        ProductPackage::updateOrCreate(['product_id' => $win11->id, 'name' => '1 PC Lifetime Key'], ['amount_val' => 1, 'price_bdt' => 390.00, 'original_price_bdt' => 950.00, 'badge' => 'Lifetime']);
        ProductPackage::updateOrCreate(['product_id' => $win11->id, 'name' => '3 PC Lifetime Multi-License'], ['amount_val' => 3, 'price_bdt' => 990.00, 'original_price_bdt' => 2400.00, 'badge' => 'Save 40%']);

        // 4. Exchange Rates (RosTop Direct Exchange Engine)
        $rates = [
            ['brand_key' => 'apple', 'brand_name' => 'Apple / iTunes (US/Global)', 'buy_rate_percent' => 102.00, 'sell_rate_percent' => 88.00, 'currency_code' => 'USD', 'bdt_conversion_rate' => 124.50, 'min_value' => 10, 'max_value' => 500],
            ['brand_key' => 'google-play', 'brand_name' => 'Google Play Gift Card', 'buy_rate_percent' => 102.00, 'sell_rate_percent' => 85.00, 'currency_code' => 'USD', 'bdt_conversion_rate' => 124.50, 'min_value' => 10, 'max_value' => 200],
            ['brand_key' => 'paysafecard', 'brand_name' => 'Paysafecard Voucher', 'buy_rate_percent' => 105.00, 'sell_rate_percent' => 86.00, 'currency_code' => 'EUR', 'bdt_conversion_rate' => 135.20, 'min_value' => 10, 'max_value' => 250],
            ['brand_key' => 'transcash', 'brand_name' => 'Transcash Top-up Code', 'buy_rate_percent' => 105.00, 'sell_rate_percent' => 90.00, 'currency_code' => 'EUR', 'bdt_conversion_rate' => 135.20, 'min_value' => 20, 'max_value' => 500],
            ['brand_key' => 'neosurf', 'brand_name' => 'Neosurf Cash PIN', 'buy_rate_percent' => 104.00, 'sell_rate_percent' => 84.00, 'currency_code' => 'EUR', 'bdt_conversion_rate' => 135.20, 'min_value' => 15, 'max_value' => 200],
            ['brand_key' => 'pcs', 'brand_name' => 'PCS Mastercard Coupon', 'buy_rate_percent' => 105.00, 'sell_rate_percent' => 90.00, 'currency_code' => 'EUR', 'bdt_conversion_rate' => 135.20, 'min_value' => 20, 'max_value' => 250],
            ['brand_key' => 'razer-gold', 'brand_name' => 'Razer Gold PIN (Global)', 'buy_rate_percent' => 102.00, 'sell_rate_percent' => 86.00, 'currency_code' => 'USD', 'bdt_conversion_rate' => 124.50, 'min_value' => 10, 'max_value' => 500],
            ['brand_key' => 'steam', 'brand_name' => 'Steam Wallet Card', 'buy_rate_percent' => 103.00, 'sell_rate_percent' => 87.00, 'currency_code' => 'USD', 'bdt_conversion_rate' => 124.50, 'min_value' => 10, 'max_value' => 200],
            ['brand_key' => 'amazon', 'brand_name' => 'Amazon Gift Card (US/UK)', 'buy_rate_percent' => 102.00, 'sell_rate_percent' => 88.00, 'currency_code' => 'USD', 'bdt_conversion_rate' => 124.50, 'min_value' => 25, 'max_value' => 1000],
            ['brand_key' => 'roblox', 'brand_name' => 'Roblox Digital Card', 'buy_rate_percent' => 102.00, 'sell_rate_percent' => 84.00, 'currency_code' => 'USD', 'bdt_conversion_rate' => 124.50, 'min_value' => 10, 'max_value' => 100],
        ];
        foreach ($rates as $r) {
            ExchangeRate::updateOrCreate(['brand_key' => $r['brand_key']], $r);
        }

        // 5. Recent Completed Orders (Proof & Live Ticker)
        $demoOrders = [
            [
                'order_code' => 'CL-92418',
                'customer_name' => 'Ariful Islam',
                'customer_phone' => '01712***849',
                'order_type' => 'topup',
                'product_id' => $ff->id,
                'product_title' => 'Free Fire 610 Diamonds',
                'package_title' => '610 Diamonds',
                'amount_bdt' => 430.00,
                'payment_method' => 'bkash',
                'sender_number' => '01712***849',
                'transaction_id' => 'BK92849182',
                'player_id_input' => '2019482910',
                'status' => 'completed',
                'completed_at' => now()->subMinutes(8),
            ],
            [
                'order_code' => 'CL-92415',
                'customer_name' => 'Mehedi Hasan',
                'customer_phone' => '01844***912',
                'order_type' => 'sell',
                'product_title' => 'Transcash €50 Voucher Cashout',
                'package_title' => '€50 (90% Payout)',
                'amount_bdt' => 6084.00,
                'amount_usd' => 45.00,
                'payout_method' => 'bkash',
                'payout_account' => '01844***912',
                'gift_card_codes' => 'TC-8924-XXXX-XXXX',
                'status' => 'completed',
                'completed_at' => now()->subMinutes(22),
            ],
            [
                'order_code' => 'CL-92412',
                'customer_name' => 'Shakil Chowdhury',
                'customer_phone' => '01931***753',
                'order_type' => 'buy',
                'product_id' => $netflix->id,
                'product_title' => 'Netflix Premium 1 Month UHD',
                'package_title' => '1 Month (1 Screen)',
                'amount_bdt' => 280.00,
                'payment_method' => 'nagad',
                'sender_number' => '01931***753',
                'transaction_id' => 'NG84918274',
                'delivered_codes' => 'Email: netflix.bd49@gmail.com | PIN: 8492',
                'status' => 'completed',
                'completed_at' => now()->subMinutes(35),
            ],
            [
                'order_code' => 'CL-92408',
                'customer_name' => 'Fahim Rahman',
                'customer_phone' => '01689***119',
                'order_type' => 'sell',
                'product_title' => 'Paysafecard €100 Cashout',
                'package_title' => '€100 (86% Payout)',
                'amount_bdt' => 11627.00,
                'amount_usd' => 86.00,
                'payout_method' => 'usdt',
                'payout_account' => 'TLz892...TrxAddress',
                'status' => 'completed',
                'completed_at' => now()->subMinutes(58),
            ],
            [
                'order_code' => 'CL-92401',
                'customer_name' => 'Sabbir Hossain',
                'customer_phone' => '01755***321',
                'order_type' => 'topup',
                'product_id' => $pubg->id,
                'product_title' => 'PUBG Mobile 660 UC',
                'package_title' => '660 UC (Royale Pass)',
                'amount_bdt' => 960.00,
                'payment_method' => 'bkash',
                'player_id_input' => '518294719',
                'status' => 'completed',
                'completed_at' => now()->subHours(2),
            ],
        ];
        foreach ($demoOrders as $order) {
            Order::updateOrCreate(['order_code' => $order['order_code']], $order);
        }

        // 6. Verified Customer Reviews
        $reviews = [
            [
                'customer_name' => 'Kamrul Hasan',
                'rating' => 5,
                'comment' => 'Transcash 100€ কার্ড সেল করেছিলাম, ২৫ মিনিটের মধ্যে বিকাশে টাকা চলে আসছে। ৮৯% রেট পেয়েছি, অনেক সৎ ও বিশ্বস্ত সার্ভিস!',
                'service_tag' => 'Transcash Sell to bKash',
                'payout_amount' => '৳ 12,168',
                'time_ago' => '25 mins ago',
                'is_verified' => true,
            ],
            [
                'customer_name' => 'Rakib Ahmed',
                'rating' => 5,
                'comment' => 'Free Fire UID Topup instant 1 minute e pelam. Payment bKash theke korar shathe shathe diamond add hoye geche. Highly recommended!',
                'service_tag' => 'Free Fire 610💎',
                'payout_amount' => '৳ 430',
                'time_ago' => '1 hour ago',
                'is_verified' => true,
            ],
            [
                'customer_name' => 'Farhana Akter',
                'rating' => 5,
                'comment' => 'Netflix 1 Month profile niyechi, video quality 4K HDR onek bhalo cholche, kono screen limit issue nai. Support o khub responsive.',
                'service_tag' => 'Netflix UHD',
                'payout_amount' => '৳ 280',
                'time_ago' => '3 hours ago',
                'is_verified' => true,
            ],
            [
                'customer_name' => 'Zubair Hossain',
                'rating' => 5,
                'comment' => 'Apple $50 card sell korlam, Nagad e payment nilam. RosTop theke payment nilam, khub fast peyechi. Rate transparent & exact.',
                'service_tag' => 'Apple Card Cashout',
                'payout_amount' => '৳ 5,478',
                'time_ago' => '5 hours ago',
                'is_verified' => true,
            ],
        ];
        foreach ($reviews as $rev) {
            Review::updateOrCreate(['customer_name' => $rev['customer_name'], 'service_tag' => $rev['service_tag']], $rev);
        }

        // 7. Extended Multi-Category Catalog (AI Tools, OTT, Software, VPN & Accounts)
        $this->call(NewCatalogSeeder::class);
    }
}
