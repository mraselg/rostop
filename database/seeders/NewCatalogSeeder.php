<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPackage;
use Illuminate\Database\Seeder;

/**
 * RosTop - New Multi-Category Product Catalog
 * AI Tools, Design & Creative Tools, OS & Productivity Software,
 * Developer & Education Tools, OTT Streaming, VPN / Email / Social Accounts.
 *
 * Idempotent: uses updateOrCreate by product slug and syncs packages by name.
 */
class NewCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catSubs = Category::where('type', 'subscription')->firstOrFail();
        $catSoftware = Category::where('type', 'software')->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Reusable Gmail-collecting input field (invite / activation link products)
        |--------------------------------------------------------------------------
        */
        $emailField = [
            ['name' => 'customer_email', 'label' => 'Your Gmail / Account Email', 'type' => 'email', 'placeholder' => 'e.g. youremail@gmail.com', 'required' => true],
        ];

        /*
        |--------------------------------------------------------------------------
        | 1. AI Tools (এআই টুলস)
        |--------------------------------------------------------------------------
        */
        $this->seedProduct($catSubs->id, [
            'slug' => 'gemini-advanced',
            'title' => 'জেমিনাই অ্যাডভান্সড ১৮ মাস অ্যাক্টিভেশন লিংক',
            'tag_badge' => 'AI Tool',
            'short_desc' => 'Gemini Advanced / Pro 18 Months Activation Link on your own personal Gmail.',
            'description' => 'নিজের পার্সোনাল জিমেইল অ্যাকাউন্টে ১৮ মাসের জন্য জেমিনাই অ্যাডভান্সড ব্যবহারের সরাসরি অ্যাক্টিভেশন লিংক। নো-ওয়ারেন্টি প্রোডাক্ট।',
            'brand_color' => '#4285F4',
            'base_price_bdt' => 500.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 20,
        ], [
            ['name' => '18 Months Activation Link (Standard)', 'amount_val' => 18, 'price_bdt' => 500.00, 'badge' => 'Personal Gmail'],
            ['name' => '18 Months Activation Link (Priority)', 'amount_val' => 18, 'price_bdt' => 625.00, 'badge' => 'Fast Delivery'],
        ]);

        // ChatGPT Plus — add the Non-Warranty ready account tier to the existing product
        $chatgpt = Product::where('slug', 'chatgpt-plus')->first();
        if ($chatgpt) {
            ProductPackage::updateOrCreate(
                ['product_id' => $chatgpt->id, 'name' => '1 Month Ready Account (Non-Warranty)'],
                ['amount_val' => 1, 'price_bdt' => 3750.00, 'badge' => 'Full Access', 'sort_order' => 90]
            );
        }

        $this->seedProduct($catSubs->id, [
            'slug' => 'chatgpt-go-coupon',
            'title' => 'চ্যাটজিপিটি ১ মাস কুপন কোড (ChatGPT GO)',
            'tag_badge' => 'AI Tool',
            'short_desc' => 'ChatGPT GO 1 Month promotional coupon code, redeemable on your own account.',
            'description' => 'নিজস্ব অ্যাকাউন্টে রিডিম করার উপযোগী ChatGPT GO ১ মাসের প্রমোশনাল কুপন কোড।',
            'brand_color' => '#10A37F',
            'base_price_bdt' => 620.00,
            'stock_type' => 'auto_code',
            'sort_order' => 21,
        ], [
            ['name' => '1 Month GO Coupon Code', 'amount_val' => 1, 'price_bdt' => 620.00, 'badge' => 'Redeem Code'],
        ]);

        $this->seedProduct($catSubs->id, [
            'slug' => 'super-grok',
            'title' => 'সুপার গ্রক এআই ৭ দিন অ্যাক্সেস (Super Grok)',
            'tag_badge' => 'AI Tool',
            'short_desc' => 'Super Grok AI 7 Days premium access on X (Twitter) with 5 days replacement warranty.',
            'description' => 'এক্স (টুইটার)-এর লেটেস্ট গ্রক এআই প্রিমিয়াম অ্যাক্সেস। ৫ দিনের রিপ্লেসমেন্ট ওয়ারেন্টি।',
            'brand_color' => '#000000',
            'base_price_bdt' => 2450.00,
            'stock_type' => 'account_login',
            'sort_order' => 22,
        ], [
            ['name' => '7 Days Premium Access (5 Days Warranty)', 'amount_val' => 1, 'price_bdt' => 2450.00, 'badge' => 'Replacement Warranty'],
        ]);

        $this->seedProduct($catSubs->id, [
            'slug' => 'elevenlabs-pro',
            'title' => 'ইলেভেনল্যাবস প্রো ১ মাস ৫০,০০০ ক্রেডিট (ElevenLabs)',
            'tag_badge' => 'AI Voice',
            'short_desc' => 'ElevenLabs Pro Plan 1 Month with 50,000 credits via workspace invite.',
            'description' => 'হাই-কোয়ালিটি এআই ভয়েস জেনারেট করার জন্য ৫০ হাজার ক্রেডিটের ওয়ার্কস্পেস ইনভাইটেশন।',
            'brand_color' => '#18181B',
            'base_price_bdt' => 1550.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 23,
        ], [
            ['name' => 'Pro Plan 1 Month (50k Credits Invite)', 'amount_val' => 1, 'price_bdt' => 1550.00, 'badge' => 'Workspace Invite'],
        ]);

        $this->seedProduct($catSubs->id, [
            'slug' => 'framer-ai',
            'title' => 'ফ্রেমার এআই ওয়েবসাইট বিল্ডার ১ বছর (Framer AI)',
            'tag_badge' => 'AI Builder',
            'short_desc' => 'Framer AI no-code website builder, 1 year full premium license.',
            'description' => 'নো-কোড ওয়েবসাইট ডিজাইন ও এআই পেজ জেনারেশনের ১ বছরের ফুল প্রিমিয়াম লাইসেন্স।',
            'brand_color' => '#0055FF',
            'base_price_bdt' => 3750.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 24,
        ], [
            ['name' => 'Framer AI 1 Year Plan', 'amount_val' => 12, 'price_bdt' => 3750.00, 'badge' => 'Full License'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. Design & Creative Tools (গ্রাফিক্স ও ভিডিও এডিটিং)
        |--------------------------------------------------------------------------
        */
        // Canva Pro — extend existing product with the Edu invite tiers
        $canva = Product::where('slug', 'canva-pro')->first();
        if ($canva) {
            ProductPackage::updateOrCreate(
                ['product_id' => $canva->id, 'name' => 'Edu Team Invite (1 Year Warranty)'],
                ['amount_val' => 12, 'price_bdt' => 375.00, 'badge' => 'Edu Invite', 'sort_order' => 90]
            );
            ProductPackage::updateOrCreate(
                ['product_id' => $canva->id, 'name' => 'Edu Team Invite (2 Year Warranty)'],
                ['amount_val' => 24, 'price_bdt' => 1250.00, 'badge' => 'Full Warranty', 'sort_order' => 91]
            );
        }

        $this->seedProduct($catSubs->id, [
            'slug' => 'canva-pro-admin-panel',
            'title' => 'ক্যানভা প্রো অ্যাডমিন প্যানেল (৫০০ ইনভাইটেশন)',
            'tag_badge' => 'Reseller',
            'short_desc' => 'Canva Pro Admin Panel with 500 invitations, valid for 3 years.',
            'description' => 'নিজস্ব রিসেলার ব্র্যান্ডের জন্য ৫০০ জনকে ক্যানভা প্রোতে ইনভাইট দেওয়ার অ্যাডমিন অ্যাক্সেস (৩ বছর মেয়াদ)।',
            'brand_color' => '#7D2AE8',
            'base_price_bdt' => 4700.00,
            'stock_type' => 'account_login',
            'sort_order' => 25,
        ], [
            ['name' => 'Admin Panel 500 Invites (3 Years)', 'amount_val' => 500, 'price_bdt' => 4700.00, 'badge' => 'Reseller Panel'],
        ]);

        $this->seedProduct($catSubs->id, [
            'slug' => 'capcut-pro',
            'title' => 'ক্যাপকাট প্রো প্রিমিয়াম (CapCut Pro)',
            'tag_badge' => 'Video Editing',
            'short_desc' => 'CapCut Pro premium: 4K export without watermark, pro transitions & effects (PC & Mobile).',
            'description' => 'পিসি ও মোবাইলে ওয়াটারমার্ক ছাড়া 4K এক্সপোর্ট, প্রো ট্রানজিশন ও এফেক্টস ব্যবহারের প্রিমিয়াম সাবস্ক্রিপশন। প্রাইভেট বা টিম স্লট।',
            'brand_color' => '#000000',
            'base_price_bdt' => 120.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 26,
        ], [
            ['name' => '7 Days (Shared Slot)', 'amount_val' => 7, 'price_bdt' => 120.00, 'badge' => 'Trial'],
            ['name' => '1 Month (Shared Slot)', 'amount_val' => 1, 'price_bdt' => 850.00, 'badge' => 'Popular'],
            ['name' => '1 Month (Private Account)', 'amount_val' => 1, 'price_bdt' => 1250.00, 'badge' => 'Private'],
            ['name' => '6 Months (Private Account)', 'amount_val' => 6, 'price_bdt' => 5950.00, 'badge' => 'Best Value'],
        ]);

        $this->seedProduct($catSubs->id, [
            'slug' => 'capcut-pro-admin-team',
            'title' => 'ক্যাপকাট প্রো অ্যাডমিন প্যানেল (৭ সিট)',
            'tag_badge' => 'Team Panel',
            'short_desc' => 'CapCut Pro Admin Team panel, 7 seats for 1 month.',
            'description' => '৭ জন মেম্বারকে ক্যাপকাট প্রো অ্যাক্সেস দেওয়ার ফুল অ্যাডমিন টিম ম্যানেজমেন্ট প্যানেল।',
            'brand_color' => '#0F172A',
            'base_price_bdt' => 2500.00,
            'stock_type' => 'account_login',
            'sort_order' => 27,
        ], [
            ['name' => 'Admin Team 1 Month (7 Seats)', 'amount_val' => 7, 'price_bdt' => 2500.00, 'badge' => 'Team Panel'],
        ]);

        $this->seedProduct($catSubs->id, [
            'slug' => 'adobe-express-premium',
            'title' => 'অ্যাডোবি এক্সপ্রেস প্রিমিয়াম ১২ মাস (Adobe Express)',
            'tag_badge' => 'Design',
            'short_desc' => 'Adobe Express Premium 12 months ready account with Firefly AI features.',
            'description' => 'অ্যাডোবির প্রিমিয়াম টেমপ্লেট ও ফায়ারফ্লাই এআই ফিচারের ফুল অ্যাক্সেসসহ রেডি অ্যাকাউন্ট।',
            'brand_color' => '#FA0F00',
            'base_price_bdt' => 500.00,
            'stock_type' => 'account_login',
            'sort_order' => 28,
        ], [
            ['name' => '12 Months Ready Account (Standard)', 'amount_val' => 12, 'price_bdt' => 500.00, 'badge' => 'Ready Account'],
            ['name' => '12 Months Ready Account (Priority)', 'amount_val' => 12, 'price_bdt' => 625.00, 'badge' => 'Fast Delivery'],
        ]);

        $this->seedProduct($catSubs->id, [
            'slug' => 'figma-pro-education',
            'title' => 'ফিগমা প্রো এডুকেশন প্ল্যান ২ বছর (Figma Pro)',
            'tag_badge' => 'UI/UX Design',
            'short_desc' => 'Figma Pro Education plan for 2 years with unlimited cloud storage & team sharing.',
            'description' => 'ইউআই/ইউএক্স ডিজাইনারদের জন্য আনলিমিটেড ক্লাউড স্টোরেজ ও টিম শেয়ারিং সুবিধাসহ ২ বছরের লাইসেন্স।',
            'brand_color' => '#F24E1E',
            'base_price_bdt' => 3000.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 29,
        ], [
            ['name' => 'Education Plan 2 Years (Standard)', 'amount_val' => 24, 'price_bdt' => 3000.00, 'badge' => 'Edu Plan'],
            ['name' => 'Education Plan 2 Years (Priority)', 'amount_val' => 24, 'price_bdt' => 3100.00, 'badge' => 'Fast Delivery'],
        ]);

        $this->seedProduct($catSubs->id, [
            'slug' => 'envato-elements',
            'title' => 'এনভাটো এলিমেন্টস ১ মাস সাবস্ক্রিপশন (Envato Elements)',
            'tag_badge' => 'Stock Assets',
            'short_desc' => 'Unlimited graphics templates, stock video, audio & premium website themes.',
            'description' => 'আনলিমিটেড গ্রাফিক্স টেমপ্লেট, স্টক ভিডিও, অডিও এবং প্রিমিয়াম ওয়েবসাইট থিম ডাউনলোডের সুবিধা। শেয়ারড বা প্রাইভেট।',
            'brand_color' => '#81B441',
            'base_price_bdt' => 1250.00,
            'stock_type' => 'account_login',
            'sort_order' => 30,
        ], [
            ['name' => '1 Month (Shared / Private)', 'amount_val' => 1, 'price_bdt' => 1250.00, 'badge' => 'Unlimited Downloads'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. OS & Productivity Software (অপারেটিং সিস্টেম ও প্রোডাক্টিভিটি)
        |--------------------------------------------------------------------------
        */
        // Windows — extend existing Windows 11 Pro product with 10/11 retail tiers
        $win = Product::where('slug', 'windows-11-pro')->first();
        if ($win) {
            ProductPackage::updateOrCreate(
                ['product_id' => $win->id, 'name' => 'Windows 10 Pro Retail Key (1 PC Lifetime)'],
                ['amount_val' => 1, 'price_bdt' => 625.00, 'badge' => 'Retail Key', 'sort_order' => 90]
            );
            ProductPackage::updateOrCreate(
                ['product_id' => $win->id, 'name' => 'Windows 11 Pro Retail Key (1 PC Lifetime)'],
                ['amount_val' => 1, 'price_bdt' => 1125.00, 'badge' => 'Retail Key', 'sort_order' => 91]
            );
        }

        $this->seedProduct($catSoftware->id, [
            'slug' => 'microsoft-365',
            'title' => 'মাইক্রোসফট ৩৬৫ অফিস ১ বছর (ফুল ওয়ারেন্টি)',
            'tag_badge' => 'Office Suite',
            'short_desc' => 'Microsoft 365: Word, Excel, PowerPoint + 1TB OneDrive cloud storage.',
            'description' => 'ওয়ার্ড, এক্সেল, পাওয়ারপয়েন্ট এবং ১TB ক্লাউড ওয়ানড্রাইভ স্টোরেজ সুবিধাসহ অফিশিয়াল সাবস্ক্রিপশন। ফ্যামিলি স্লট বা পার্সোনাল অ্যাকাউন্ট।',
            'brand_color' => '#D83B01',
            'base_price_bdt' => 215.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 20,
        ], [
            ['name' => 'Office 365 (1 Year Family Slot)', 'amount_val' => 12, 'price_bdt' => 215.00, 'badge' => 'Family Slot'],
            ['name' => 'Office 365 (1 Year Personal Account)', 'amount_val' => 12, 'price_bdt' => 3100.00, 'badge' => 'Personal Account'],
        ]);

        $this->seedProduct($catSoftware->id, [
            'slug' => 'ilovepdf-premium',
            'title' => 'আই-লাভ-পিডিএফ প্রিমিয়াম ১ বছর (iLovePDF)',
            'tag_badge' => 'PDF Tools',
            'short_desc' => 'PDF edit, compress, convert & unlimited document processing for 1 year.',
            'description' => 'পিডিএফ এডিট, সাইজ কমানো, কনভার্ট এবং আনলিমিটেড ডকুমেন্ট প্রসেসিংয়ের প্রিমিয়াম লাইসেন্স।',
            'brand_color' => '#E5322D',
            'base_price_bdt' => 400.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 21,
        ], [
            ['name' => 'Premium 1 Year Plan', 'amount_val' => 12, 'price_bdt' => 400.00, 'badge' => 'Unlimited'],
        ]);

        $this->seedProduct($catSoftware->id, [
            'slug' => 'notion-plus-business',
            'title' => 'নোশন প্লাস ও বিজনেস প্রিমিয়াম প্ল্যান (Notion)',
            'tag_badge' => 'Productivity',
            'short_desc' => 'Notion Plus (12M) & Business (3M) with unlimited blocks and team collaboration.',
            'description' => 'প্রোজেক্ট ও টাস্ক ম্যানেজমেন্টের জন্য আনলিমিটেড ব্লকস ও টিম কোলাবোরেশন সুবিধা।',
            'brand_color' => '#000000',
            'base_price_bdt' => 625.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 22,
        ], [
            ['name' => 'Notion Plus (12 Months)', 'amount_val' => 12, 'price_bdt' => 625.00, 'badge' => 'Best Value'],
            ['name' => 'Notion Business (3 Months)', 'amount_val' => 3, 'price_bdt' => 1550.00, 'badge' => 'Business'],
        ]);

        $this->seedProduct($catSoftware->id, [
            'slug' => 'miro-premium',
            'title' => 'মিরো হোয়াইটবোর্ড লাইফটাইম প্রিমিয়াম (Miro)',
            'tag_badge' => 'Whiteboard',
            'short_desc' => 'Miro visual collaboration & brainstorming — Edu activation link or 100-invite admin panel.',
            'description' => 'ভিজ্যুয়াল কোলাবোরেশন ও ব্রেইনস্টর্মিংয়ের প্রিমিয়াম অ্যাক্টিভেশন লিংক অথবা ১০০ জন যুক্ত করার অ্যাডমিন প্যানেল।',
            'brand_color' => '#4262FF',
            'base_price_bdt' => 190.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 23,
        ], [
            ['name' => 'Edu Activation Link (Lifetime)', 'amount_val' => 1, 'price_bdt' => 190.00, 'badge' => 'Activation Link'],
            ['name' => 'Admin Panel (100 Invites)', 'amount_val' => 100, 'price_bdt' => 5600.00, 'badge' => 'Reseller Panel'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4. Developer & Education Tools (ডেভেলপার ও এডুকেশন টুলস)
        |--------------------------------------------------------------------------
        */
        $this->seedProduct($catSoftware->id, [
            'slug' => 'jetbrains-edu-pack',
            'title' => 'জেটব্রেইনস এডু প্যাক ১ বছর লাইসেন্স (JetBrains)',
            'tag_badge' => 'Developer',
            'short_desc' => 'IntelliJ IDEA, PyCharm, WebStorm, PhpStorm — all JetBrains IDEs full premium for 12 months.',
            'description' => 'IntelliJ IDEA, PyCharm, WebStorm, PhpStorm সহ সব ধরনের আইডিই (IDE)-এর ফুল প্রিমিয়াম স্টুডেন্ট/এডু প্যাক।',
            'brand_color' => '#FE2857',
            'base_price_bdt' => 1875.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 24,
        ], [
            ['name' => 'JetBrains All Products (12 Months)', 'amount_val' => 12, 'price_bdt' => 1875.00, 'badge' => 'All IDEs'],
        ]);

        $this->seedProduct($catSoftware->id, [
            'slug' => 'autodesk-all-apps',
            'title' => 'অটোডেস্ক ১ বছর (AutoCAD, 3ds Max, Maya)',
            'tag_badge' => '3D & CAD',
            'short_desc' => 'Autodesk All Apps 1 year full access, or 3000-invite reseller admin panel.',
            'description' => 'স্থাপত্য ও থ্রিডি ডিজাইনারদের জন্য ১ বছরের ফুল অ্যাক্সেস অথবা ৩,০০০ ইনভাইটের রিসেলার অ্যাডমিন প্যানেল।',
            'brand_color' => '#0696D7',
            'base_price_bdt' => 625.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 25,
        ], [
            ['name' => 'Autodesk All Apps (1 Year Access)', 'amount_val' => 12, 'price_bdt' => 625.00, 'badge' => 'Full Access'],
            ['name' => 'Admin Panel (3000 Invites)', 'amount_val' => 3000, 'price_bdt' => 8750.00, 'badge' => 'Reseller Panel'],
        ]);

        $this->seedProduct($catSoftware->id, [
            'slug' => 'coursera-edx-premium',
            'title' => 'কোর্সেরা / ইডিএক্স প্রিমিয়াম ১২ মাস লার্নিং প্যাক',
            'tag_badge' => 'E-Learning',
            'short_desc' => 'Coursera / edX premium 12 months — professional certificates from top universities.',
            'description' => 'বিশ্বের শীর্ষ বিশ্ববিদ্যালয়ের প্রফেশনাল সার্টিফিকেট কোর্স সম্পূর্ণ করার সুবিধা। কোর্সেরা বা ইডিএক্স প্ল্যান বেছে নিন।',
            'brand_color' => '#0056D2',
            'base_price_bdt' => 815.00,
            'stock_type' => 'account_login',
            'sort_order' => 26,
        ], [
            ['name' => 'edX Premium (12 Months)', 'amount_val' => 12, 'price_bdt' => 815.00, 'badge' => 'Certificates'],
            ['name' => 'Coursera Premium (12 Months)', 'amount_val' => 12, 'price_bdt' => 940.00, 'badge' => 'Popular'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 5. OTT & Streaming (বিনোদন ও স্ট্রিমিং)
        |--------------------------------------------------------------------------
        */
        $this->seedProduct($catSubs->id, [
            'slug' => 'youtube-premium',
            'title' => 'ইউটিউব প্রিমিয়াম ১ বছর (ফুল ওয়ারেন্টি)',
            'tag_badge' => 'OTT',
            'short_desc' => 'YouTube Premium 12 months: ad-free videos, background play & YouTube Music Premium.',
            'description' => 'সম্পূর্ণ বিজ্ঞাপনহীন ভিডিও দেখা, ব্যাকগ্রাউন্ড প্লে এবং ইউটিউব মিউজিক প্রিমিয়ামের সুবিধা। ফুল ওয়ারেন্টিসহ ১২ মাস স্লট।',
            'brand_color' => '#FF0000',
            'base_price_bdt' => 9450.00,
            'stock_type' => 'account_login',
            'input_fields_schema' => $emailField,
            'sort_order' => 31,
        ], [
            ['name' => 'YouTube Premium 12 Months (Full Warranty)', 'amount_val' => 12, 'price_bdt' => 9450.00, 'badge' => 'Full Warranty'],
        ]);

        // Netflix — add full-account 5 profile tiers to the existing product
        $netflix = Product::where('slug', 'netflix-premium')->first();
        if ($netflix) {
            ProductPackage::updateOrCreate(
                ['product_id' => $netflix->id, 'name' => '1 Month (Private UHD Account)'],
                ['amount_val' => 1, 'price_bdt' => 1050.00, 'badge' => 'Private', 'sort_order' => 90]
            );
            ProductPackage::updateOrCreate(
                ['product_id' => $netflix->id, 'name' => '1 Month (Full Account 5 Profiles 4K)'],
                ['amount_val' => 1, 'price_bdt' => 1250.00, 'badge' => 'Full Access', 'sort_order' => 91]
            );
        }

        $this->seedProduct($catSubs->id, [
            'slug' => 'amazon-prime-video',
            'title' => 'অ্যামাজন প্রাইম ভিডিও ১ মাস (Prime Video)',
            'tag_badge' => 'OTT',
            'short_desc' => 'Amazon Prime Video 1 month — Prime Originals, movies & series in Full HD / 4K.',
            'description' => 'প্রাইম অরিজিনালস ও জনপ্রিয় সিনেমা-সিরিজ ফুল এইচডি বা 4K রেজল্যুশনে দেখার প্রিমিয়াম অ্যাকাউন্ট।',
            'brand_color' => '#00A8E1',
            'base_price_bdt' => 560.00,
            'stock_type' => 'account_login',
            'sort_order' => 32,
        ], [
            ['name' => 'Prime Video 1 Month', 'amount_val' => 1, 'price_bdt' => 560.00, 'badge' => 'HD / 4K'],
        ]);

        $this->seedProduct($catSubs->id, [
            'slug' => 'hbo-max',
            'title' => 'এইচবিও ম্যাক্স প্রিমিয়াম (HBO Max)',
            'tag_badge' => 'OTT',
            'short_desc' => 'HBO Max: Warner Bros, DC & HBO exclusive series streaming (1 or 3 months).',
            'description' => 'ওয়ার্নার ব্রাদার্স, ডিসি ও এইচবিও এক্সক্লুসিভ সিরিজের নিরবচ্ছিন্ন স্ট্রিমিং অ্যাক্সেস।',
            'brand_color' => '#5822B4',
            'base_price_bdt' => 625.00,
            'stock_type' => 'account_login',
            'sort_order' => 33,
        ], [
            ['name' => '3 Months (Standard)', 'amount_val' => 3, 'price_bdt' => 625.00, 'badge' => 'Best Value'],
            ['name' => '1 Month (Standard)', 'amount_val' => 1, 'price_bdt' => 875.00, 'badge' => 'Flexible'],
        ]);

        $this->seedProduct($catSubs->id, [
            'slug' => 'paramount-peacock',
            'title' => 'প্যারামাউন্ট প্লাস / পিকক টিভি ১ মাস (Paramount+ / Peacock)',
            'tag_badge' => 'OTT',
            'short_desc' => 'Paramount+ or Peacock Premium 1 month — US live sports & international drama.',
            'description' => 'ইউএস লাইভ স্পোর্টস ও ইন্টারন্যাশনাল ড্রামা স্ট্রিমিংয়ের প্রিমিয়াম রেডি অ্যাকাউন্ট। প্যারামাউন্ট প্লাস বা পিকক প্রিমিয়াম বেছে নিন।',
            'brand_color' => '#0064FF',
            'base_price_bdt' => 815.00,
            'stock_type' => 'account_login',
            'sort_order' => 34,
        ], [
            ['name' => 'Peacock Premium (1 Month)', 'amount_val' => 1, 'price_bdt' => 815.00, 'badge' => 'Live TV'],
            ['name' => 'Paramount+ Premium (1 Month)', 'amount_val' => 1, 'price_bdt' => 1060.00, 'badge' => 'Live Sports'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 6. VPN, Email & Social Accounts (ভিপিএন, ইমেইল ও সোশ্যাল অ্যাকাউন্টস)
        |--------------------------------------------------------------------------
        */
        $this->seedProduct($catSoftware->id, [
            'slug' => 'surfshark-vpn',
            'title' => 'সার্ফশার্ক ভিপিএন ২ মাস মেয়াদী সাবস্ক্রিপশন (Surfshark)',
            'tag_badge' => 'VPN',
            'short_desc' => 'Surfshark VPN 2 months — fast servers, IP protection & no-log policy.',
            'description' => 'ফাস্ট স্পিড সার্ভার, আইপি প্রোটেকশন এবং নো-লগ পলিসিসহ হাই-সিকিউরিটি ভিপিএন। ডিভাইস লগইন বা কুপন কোড বেছে নিন।',
            'brand_color' => '#17803C',
            'base_price_bdt' => 620.00,
            'stock_type' => 'account_login',
            'sort_order' => 27,
        ], [
            ['name' => '2 Months (Device Login)', 'amount_val' => 2, 'price_bdt' => 620.00, 'badge' => 'Device Login'],
            ['name' => '2 Months (Coupon Code)', 'amount_val' => 2, 'price_bdt' => 940.00, 'badge' => 'Coupon Code'],
        ]);

        $this->seedProduct($catSoftware->id, [
            'slug' => 'avira-prime',
            'title' => 'আভিরা প্রাইম সিকিউরিটি ৩ মাস (Avira Prime)',
            'tag_badge' => 'Antivirus',
            'short_desc' => 'Avira Prime 3 months: antivirus, real-time threat protection & unlimited VPN.',
            'description' => 'অ্যান্টিভাইরাস, রিয়েল-টাইম থ্রেট প্রোটেকশন এবং আনলিমিটেড ভিপিএন ফিচারযুক্ত প্রিমিয়াম প্যাক।',
            'brand_color' => '#E32219',
            'base_price_bdt' => 560.00,
            'stock_type' => 'account_login',
            'sort_order' => 28,
        ], [
            ['name' => 'Avira Prime (3 Months License)', 'amount_val' => 3, 'price_bdt' => 560.00, 'badge' => 'All-in-One'],
        ]);

        $this->seedProduct($catSoftware->id, [
            'slug' => 'outlook-hotmail-accounts',
            'title' => 'আউটলুক / হটমেইল ফ্রেশ ইমেইল অ্যাকাউন্ট',
            'tag_badge' => 'Email Accounts',
            'short_desc' => 'Fresh Outlook / Hotmail email accounts (single or bulk) created with fresh IP.',
            'description' => 'ফ্রেশ আইপি দিয়ে তৈরি বিভিন্ন কাজের জন্য ব্যবহার উপযোগী ইমেইল অ্যাকাউন্ট। সিঙ্গেল বা বাল্ক প্যাকেজ।',
            'brand_color' => '#0072C6',
            'base_price_bdt' => 15.00,
            'stock_type' => 'auto_code',
            'sort_order' => 29,
        ], [
            ['name' => '1 Account (Fresh)', 'amount_val' => 1, 'price_bdt' => 15.00, 'badge' => 'Per Piece'],
            ['name' => '10 Accounts (Bulk Pack)', 'amount_val' => 10, 'price_bdt' => 130.00, 'badge' => 'Bulk Deal'],
        ]);

        $this->seedProduct($catSoftware->id, [
            'slug' => 'gmail-verified-accounts',
            'title' => 'জিমেইল ভেরিফায়েড ফ্রেশ অ্যাকাউন্ট (Gmail PVA)',
            'tag_badge' => 'Email Accounts',
            'short_desc' => 'Phone-verified fresh Gmail accounts for social media & digital marketing.',
            'description' => 'সোশ্যাল মিডিয়া ও ডিজিটাল মার্কেটিং কাজের জন্য সম্পূর্ণ ফোন-ভেরিফায়েড (PVA) ফ্রেশ জিমেইল অ্যাকাউন্ট।',
            'brand_color' => '#EA4335',
            'base_price_bdt' => 500.00,
            'stock_type' => 'auto_code',
            'sort_order' => 30,
        ], [
            ['name' => '1 Gmail PVA (Fresh Verified)', 'amount_val' => 1, 'price_bdt' => 500.00, 'badge' => 'Phone Verified'],
        ]);

        $this->seedProduct($catSoftware->id, [
            'slug' => 'telegram-aged-account',
            'title' => 'টেলিগ্রাম ওল্ড / রেডি অ্যাকাউন্ট (Telegram Aged)',
            'tag_badge' => 'Social Account',
            'short_desc' => 'Aged Telegram account with ready session for instant login.',
            'description' => 'ইনস্ট্যান্ট লগইন উপযোগী রেডি সেশনসহ টেলিগ্রাম ওল্ড / রেডি অ্যাকাউন্ট।',
            'brand_color' => '#2AABEE',
            'base_price_bdt' => 560.00,
            'stock_type' => 'auto_code',
            'sort_order' => 31,
        ], [
            ['name' => 'Telegram Aged (Ready Session)', 'amount_val' => 1, 'price_bdt' => 560.00, 'badge' => 'Instant Login'],
        ]);
    }

    /**
     * Create or update a product and sync its packages (idempotent by slug + package name).
     */
    private function seedProduct(int $categoryId, array $data, array $packages): Product
    {
        $slug = $data['slug'];
        unset($data['slug']);

        $product = Product::updateOrCreate(
            ['slug' => $slug],
            array_merge($data, [
                'category_id' => $categoryId,
                'is_active' => true,
                'is_featured' => true,
            ])
        );

        $keptNames = [];
        foreach ($packages as $i => $pkg) {
            $keptNames[] = $pkg['name'];
            ProductPackage::updateOrCreate(
                ['product_id' => $product->id, 'name' => $pkg['name']],
                array_merge($pkg, ['sort_order' => $i + 1])
            );
        }
        ProductPackage::where('product_id', $product->id)->whereNotIn('name', $keptNames)->delete();

        return $product;
    }
}
