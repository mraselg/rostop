@extends('layouts.app')

@section('title', $product->title . ' - Buy Online in Bangladesh | RosTop')
@section('meta_description', $product->short_desc)
@section('og_image', $product->image ? asset($product->image) : asset('images/og-banner.jpg'))

@php
    [$rpCatUrl, $rpCatName] = \App\Support\SeoSchema::categoryUrl($product);
@endphp

@push('schema')
    {!! \App\Support\SeoSchema::render([
        \App\Support\SeoSchema::product($product, \App\Support\SeoSchema::productUrl($product)),
        \App\Support\SeoSchema::breadcrumbs([
            ['Home', url(route('home'))],
            [$rpCatName, $rpCatUrl],
            [$product->title, \App\Support\SeoSchema::productUrl($product)],
        ]),
    ]) !!}
@endpush

@section('content')
<div class="container pp-wrap">

    <!-- Breadcrumbs & Quick Category Navigation -->
    <div class="pp-top-nav-bar">
        <nav class="pp-breadcrumb" aria-label="Breadcrumb">
            <div class="pp-breadcrumb-track">
                <a href="{{ route('home') }}" class="pp-bc-link">
                    <i data-lucide="home" class="icon"></i>
                    <span>Home</span>
                </a>
                <i data-lucide="chevron-right" class="pp-bc-sep"></i>
                <a href="{{ route('game.topup') }}" class="pp-bc-link">
                    <i data-lucide="gamepad-2" class="icon"></i>
                    <span>Games Top-Up</span>
                </a>
                <i data-lucide="chevron-right" class="pp-bc-sep"></i>
                <span class="pp-bc-current" title="{{ $product->title }}">{{ $product->title }}</span>
            </div>
        </nav>

        @if(isset($topGames) && $topGames->count() > 1)
            <!-- Quick Games & Categories Strip -->
            <div class="pp-quick-cats-bar" role="navigation" aria-label="Popular Games">
                <a href="{{ route('game.topup') }}" class="pp-quick-cat-btn" title="View all games">
                    <i data-lucide="layout-grid" class="icon"></i>
                    <span>All Games</span>
                </a>
                @foreach($topGames as $tg)
                    @php
                        $isCurrentGame = ($tg->id === $product->id);
                        $tgImg = $tg->image ? asset($tg->image) : null;
                    @endphp
                    <a href="{{ route('game.show', $tg->slug) }}" class="pp-quick-game-chip {{ $isCurrentGame ? 'active' : '' }}" title="{{ $tg->title }}">
                        @if($tgImg)
                            <img src="{{ $tgImg }}" alt="{{ $tg->title }}" class="pp-qg-icon">
                        @else
                            <i data-lucide="gamepad-2" class="icon"></i>
                        @endif
                        <span>{{ $tg->title }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    @php
        $isMlbb = str_contains($product->slug, 'mobile-legends') || str_contains($product->slug, 'mlbb');
        $isFf = str_contains($product->slug, 'free-fire');
        $isPubg = str_contains($product->slug, 'pubg');
        $isVal = str_contains($product->slug, 'valorant');
        $isRoblox = str_contains($product->slug, 'roblox');

        $isBdRegion = in_array($product->slug, ['free-fire', 'fc-mobile', 'honor-of-kings', 'blood-strike', 'super-sus', 'efootball']);
        $coverImg = ($product->slug === 'free-fire') ? asset('images/games/freefire_banner.webp') : ($isMlbb ? asset('images/games/mlbb_cover.jpg') : asset('images/rostop_banner_topup.jpg'));
        $avatarImg = $product->image ? asset($product->image) : ($isMlbb ? asset('images/games/mlbb.jpg') : ($isFf ? asset('images/games/freefire.webp') : ($isPubg ? asset('images/games/pubg.png') : ($isVal ? asset('images/games/valorant.jpg') : ($isRoblox ? asset('images/games/roblox.jpg') : null)))));
        
        // Define dynamic editions/modes per game
        $editionList = [];
        if ($isFf) {
            $editionList = [
                [
                    'key' => 'ff-diamonds',
                    'name' => 'Free Fire BD (UID Instant)',
                    'flag' => '🇧🇩',
                    'badge' => '⚡ 10s Auto',
                    'speed' => '10-60 Seconds',
                    'input_label' => 'Player ID (UID)',
                    'input_placeholder' => 'আপনার Free Fire Player ID (UID) দিন (e.g. 192847582)',
                    'tip' => 'Free Fire গেমে ঢুকে আপনার প্রোফাইল থেকে Player ID (UID) কপি করে এখানে বসান। ১০-৬০ সেকেন্ডে ১০০% অটোমেটিক ডেলিভারি।',
                    'notice' => 'Free Fire BD Server Direct UID Top-Up: ১০-৬০ সেকেন্ডে সরাসরি প্লেয়ার আইডিতে ১০০% অটোমেটিক ও ব্যান-ফ্রি রিলোড।',
                    'match' => function($p) {
                        $n = strtolower($p->name);
                        return !str_contains($n, 'membership') && !str_contains($n, 'weekly lite') && !str_contains($n, 'level up pass') && !str_contains($n, 'id server') && !str_contains($n, 'garena shell');
                    }
                ],
                [
                    'key' => 'ff-membership',
                    'name' => 'Membership (Weekly / Monthly)',
                    'flag' => '👑',
                    'badge' => 'VIP Pass',
                    'speed' => '10-60 Seconds',
                    'input_label' => 'Player ID (UID)',
                    'input_placeholder' => 'আপনার Free Fire Player ID (UID) দিন',
                    'tip' => 'উইকলি ও মান্থলি মেম্বারশিপ সরাসরি আপনার প্লেয়ার আইডিতে যুক্ত হবে। প্রতিদিন গেমে ঢুকে ডায়মন্ড ক্লেইম করতে পারবেন।',
                    'notice' => 'Free Fire Weekly & Monthly Membership: সরাসরি আপনার UID-তে এক্টিভ হবে। কোনো পাসওয়ার্ড প্রয়োজন নেই।',
                    'match' => function($p) {
                        $n = strtolower($p->name);
                        return str_contains($n, 'membership') || str_contains($n, 'weekly lite') || str_contains($n, 'evo access');
                    }
                ],
                [
                    'key' => 'ff-pass',
                    'name' => 'Level Up Pass',
                    'flag' => '🎟️',
                    'badge' => 'Hot Pass',
                    'speed' => 'Instant',
                    'input_label' => 'Player ID (UID)',
                    'input_placeholder' => 'আপনার Free Fire Player ID (UID) দিন',
                    'tip' => 'লেভেল আপ পাস ক্লেইম করতে আপনার ফ্রি ফায়ার আইডির লেভেল উপযুক্ত হতে হবে (Level 6 / 10-25 / 30)।',
                    'notice' => 'লেভেল আপ পাস শুধুমাত্র একবারই নেওয়া যায়। আপনার একাউন্ট লেভেল অনুযায়ী পাস সিলেক্ট করুন।',
                    'match' => function($p) {
                        return str_contains(strtolower($p->name), 'level up pass');
                    }
                ],
                [
                    'key' => 'ff-indonesia',
                    'name' => 'Indonesia Server (ID)',
                    'flag' => '🇮🇩',
                    'badge' => 'Special Server',
                    'speed' => '1-5 Minutes',
                    'input_label' => 'Player ID (Indonesia Server)',
                    'input_placeholder' => 'আপনার ইন্দোনেশিয়া সার্ভার Player ID দিন',
                    'tip' => 'এটি শুধুমাত্র ইন্দোনেশিয়া সার্ভারের আইডির জন্য প্রযোজ্য। আইডি সঠিক কিনা তা নিশ্চিত করুন।',
                    'notice' => 'Free Fire Indonesia Server Direct Top-Up: ইন্দোনেশিয়া সার্ভারের খেলোয়াড়দের জন্য নির্ধারিত।',
                    'match' => function($p) {
                        return str_contains(strtolower($p->name), 'id server');
                    }
                ],
                [
                    'key' => 'ff-voucher',
                    'name' => 'Garena Shells (BD/SG)',
                    'flag' => '🔑',
                    'badge' => 'Digital PIN',
                    'speed' => 'Instant PIN',
                    'input_label' => 'WhatsApp / Email for PIN',
                    'input_placeholder' => 'আপনার WhatsApp নম্বর বা ইমেইল দিন',
                    'tip' => 'অর্ডার সম্পন্ন করার পর ভাউচার পিন কোড সরাসরি স্ক্রিনে এবং আপনার WhatsApp/ইমেইলে পেয়ে যাবেন।',
                    'notice' => 'Garena Shells Digital PIN: অফিসিয়াল গ্যারেনা টপ-আপ সেন্টারে শেল রিডিম করে ডায়মন্ড নেওয়া যায়।',
                    'match' => function($p) {
                        return str_contains(strtolower($p->name), 'garena shell');
                    }
                ],
            ];
        } elseif ($isMlbb) {
            $editionList = [
                [
                    'key' => 'mlbb-diamonds',
                    'name' => 'MLBB Diamonds (Direct UID)',
                    'flag' => '💎',
                    'badge' => '⚡ 1-3 Min',
                    'speed' => '1-3 Minutes',
                    'input_label' => 'User ID & Zone ID',
                    'input_placeholder' => 'User ID ও Zone ID দিন',
                    'tip' => 'ইন-গেম প্রোফাইল খুললে Avatar এর পাশে User ID (Server ID) দেখতে পাবেন, যেমন: 12345678 (2049)।',
                    'notice' => 'Mobile Legends Diamonds Top-Up: 100% Ban-Free official direct recharge to your User ID & Zone ID.',
                    'match' => function($p) {
                        $n = strtolower($p->name);
                        return !str_contains($n, 'weekly pass') && !str_contains($n, 'twilight') && !str_contains($p->name, '+') && !str_contains($n, 'elite');
                    }
                ],
                [
                    'key' => 'mlbb-pass',
                    'name' => 'Weekly Pass & Twilight',
                    'flag' => '🎟️',
                    'badge' => 'Hot Pass',
                    'speed' => '1-3 Minutes',
                    'input_label' => 'User ID & Zone ID',
                    'input_placeholder' => 'User ID ও Zone ID দিন',
                    'tip' => 'সরাসরি আপনার MLBB একাউন্টে উইকলি ডায়মন্ড পাস ও টোয়াইলাইট পাস যুক্ত হবে।',
                    'notice' => 'Weekly Diamond Pass & Twilight Pass: সরাসরি আইডি দিয়ে একটিভ করুন।',
                    'match' => function($p) {
                        $n = strtolower($p->name);
                        return str_contains($n, 'weekly pass') || str_contains($n, 'twilight');
                    }
                ],
                [
                    'key' => 'mlbb-bonus',
                    'name' => '100% Double Bonus (50+50)',
                    'flag' => '🎁',
                    'badge' => 'Double Deal',
                    'speed' => '1-3 Minutes',
                    'input_label' => 'User ID & Zone ID',
                    'input_placeholder' => 'User ID ও Zone ID দিন',
                    'tip' => '৫০+৫০, ১৫০+১৫০ এই ডাবল বোনাস অফারগুলো আপনার একাউন্টে প্রথমবার টপ-আপের জন্য প্রযোজ্য।',
                    'notice' => '50+50, 150+150, 250+250, 500+500 এই প্যাকেজ গুলো আপনার একাউন্টে থাকলে পাবেন। নয়তো রেগুলার প্যাকেজ পাবেন।',
                    'match' => function($p) {
                        return str_contains($p->name, '+') || str_contains(strtolower($p->name), 'bonus');
                    }
                ],
                [
                    'key' => 'mlbb-vip',
                    'name' => 'Elite & VIP Member Packs',
                    'flag' => '👑',
                    'badge' => 'VIP Pack',
                    'speed' => '1-3 Minutes',
                    'input_label' => 'User ID & Zone ID',
                    'input_placeholder' => 'User ID ও Zone ID দিন',
                    'tip' => 'উইকলি ও মান্থলি এলিট প্যাক ভিআইপি সুবিধার জন্য সরাসরি অ্যাক্টিভ হবে।',
                    'notice' => 'Elite & VIP Member Packs: বিশেষ স্ট্রিমিং ও ইন-গেম রিওয়ার্ড আনলক করতে ব্যবহার করুন।',
                    'match' => function($p) {
                        return str_contains(strtolower($p->name), 'elite');
                    }
                ],
            ];
        } elseif ($isPubg) {
            $editionList = [
                [
                    'key' => 'pubg-global',
                    'name' => 'PUBG Mobile Global (UC Voucher)',
                    'flag' => '🌐',
                    'badge' => 'Instant PIN',
                    'speed' => 'Instant Digital PIN',
                    'input_label' => 'Character ID (UID)',
                    'input_placeholder' => 'আপনার PUBG Character ID দিন',
                    'tip' => 'গ্লোবাল ইউসি ভাউচার রিডিম কোড পেয়ে যাবেন এবং সরাসরি একাউন্টেও রিচার্জ করতে পারেন।',
                    'notice' => 'PUBG Mobile UC Global Voucher: ২০৪টি দেশে সরাসরি Midasbuy দিয়ে রিডিমযোগ্য ডিজিটাল কোড।',
                    'match' => function($p) {
                        $n = strtolower($p->name);
                        return !str_contains($n, 'malaysia') && !str_contains($n, 'taiwan');
                    }
                ],
                [
                    'key' => 'pubg-malaysia',
                    'name' => 'PUBG Mobile Malaysia Server',
                    'flag' => '🇲🇾',
                    'badge' => 'Regional',
                    'speed' => '2-5 Minutes',
                    'input_label' => 'Character ID (Malaysia Server)',
                    'input_placeholder' => 'আপনার মালয়েশিয়া সার্ভার Character ID দিন',
                    'tip' => 'শুধুমাত্র মালয়েশিয়া রিজিওনের PUBG একাউন্টের জন্য প্রযোজ্য।',
                    'notice' => 'PUBG Mobile Malaysia Regional UC: মালয়েশিয়া রিজিওনের সার্ভারে দ্রুত রিচার্জ।',
                    'match' => function($p) {
                        return str_contains(strtolower($p->name), 'malaysia');
                    }
                ],
                [
                    'key' => 'pubg-taiwan',
                    'name' => 'PUBG Mobile Taiwan Server',
                    'flag' => '🇹🇼',
                    'badge' => 'Regional',
                    'speed' => '2-5 Minutes',
                    'input_label' => 'Character ID (Taiwan Server)',
                    'input_placeholder' => 'আপনার তাইওয়ান সার্ভার Character ID দিন',
                    'tip' => 'শুধুমাত্র তাইওয়ান রিজিওনের PUBG একাউন্টের জন্য প্রযোজ্য।',
                    'notice' => 'PUBG Mobile Taiwan Regional UC: তাইওয়ান সার্ভারের খেলোয়াড়দের জন্য নির্ধারিত।',
                    'match' => function($p) {
                        return str_contains(strtolower($p->name), 'taiwan');
                    }
                ],
            ];
        } elseif ($product->slug === 'fc-mobile') {
            $editionList = [
                [
                    'key' => 'fc-points',
                    'name' => 'FC Points (Direct UID)',
                    'flag' => '⚽',
                    'badge' => '⚡ Fast Reload',
                    'speed' => '2-5 Minutes',
                    'input_label' => 'EA / Player UID',
                    'input_placeholder' => 'আপনার FC Mobile UID দিন',
                    'tip' => 'FC Points সরাসরি আপনার FC Mobile একাউন্টে রিচার্জ হবে।',
                    'notice' => 'EA Sports FC Mobile Points: প্লেয়ার প্যাক আনলক ও টুর্নামেন্ট এন্ট্রির জন্য সরাসরি ইউআইডি রিচার্জ।',
                    'match' => function($p) {
                        return !str_contains(strtolower($p->name), 'silver');
                    }
                ],
                [
                    'key' => 'fc-silver',
                    'name' => 'FC Silver Packages',
                    'flag' => '🥈',
                    'badge' => 'Silver Pass',
                    'speed' => '2-5 Minutes',
                    'input_label' => 'EA / Player UID',
                    'input_placeholder' => 'আপনার FC Mobile UID দিন',
                    'tip' => 'FC Silver প্যাকেজ গেমের বিশেষ অফার আনলক করার জন্য ব্যবহৃত হয়।',
                    'notice' => 'EA Sports FC Mobile Silver: স্পেশাল প্যাকেজ ও সিজন প্রমোশনের জন্য সিলভার কারেন্সি।',
                    'match' => function($p) {
                        return str_contains(strtolower($p->name), 'silver');
                    }
                ],
            ];
        } elseif ($product->slug === 'honor-of-kings') {
            $editionList = [
                [
                    'key' => 'hok-tokens',
                    'name' => 'Tokens (Direct UID)',
                    'flag' => '🪙',
                    'badge' => '⚡ Instant',
                    'speed' => '1-3 Minutes',
                    'input_label' => 'Player ID (UID)',
                    'input_placeholder' => 'আপনার Honor of Kings UID দিন',
                    'tip' => 'টোকেন সরাসরি আপনার HOK আইডিতে রিচার্জ হবে।',
                    'notice' => 'Honor of Kings Direct Tokens: তাৎক্ষণিক টোকেন রিচার্জ। হিরো ও স্কিন কিনুন সহজে।',
                    'match' => function($p) {
                        return !str_contains(strtolower($p->name), 'card');
                    }
                ],
                [
                    'key' => 'hok-cards',
                    'name' => 'Weekly Card & Card Plus',
                    'flag' => '🎟️',
                    'badge' => 'Best Value',
                    'speed' => '1-3 Minutes',
                    'input_label' => 'Player ID (UID)',
                    'input_placeholder' => 'আপনার Honor of Kings UID দিন',
                    'tip' => 'উইকলি কার্ড ও কার্ড প্লাস দিয়ে প্রতিদিন ফ্রি টোকেন ও বোনাস ক্লেইম করুন।',
                    'notice' => 'HOK Weekly Card: ৭ দিন ধরে প্রতিদিন টোকেন বোনাস এবং এক্সক্লুসিভ রিওয়ার্ড লাভ করুন।',
                    'match' => function($p) {
                        return str_contains(strtolower($p->name), 'card');
                    }
                ],
            ];
        } elseif ($product->slug === 'blood-strike') {
            $editionList = [
                [
                    'key' => 'bs-golds',
                    'name' => 'Blood Strike Golds',
                    'flag' => '🪙',
                    'badge' => '⚡ Instant',
                    'speed' => '1-3 Minutes',
                    'input_label' => 'User ID',
                    'input_placeholder' => 'আপনার Blood Strike User ID দিন',
                    'tip' => 'গোল্ড সরাসরি আপনার Blood Strike একাউন্টে জমা হবে।',
                    'notice' => 'Blood Strike Direct Golds: ফাস্ট ডেলিভারি। অস্ত্র স্কিন ও ক্যারেক্টার আনলক করুন।',
                    'match' => function($p) {
                        return !str_contains(strtolower($p->name), 'pass');
                    }
                ],
                [
                    'key' => 'bs-pass',
                    'name' => 'Strike Pass & Season Pass',
                    'flag' => '🎟️',
                    'badge' => 'Season Pass',
                    'speed' => '1-3 Minutes',
                    'input_label' => 'User ID',
                    'input_placeholder' => 'আপনার Blood Strike User ID দিন',
                    'tip' => 'স্ট্রাইক পাস এলিট বা প্রিমিয়াম দিয়ে নতুন সিজন রিওয়ার্ড আনলক করুন।',
                    'notice' => 'Blood Strike Pass: সিজন ব্যাটল পাস অ্যাক্টিভেশন ও প্রিমিয়াম রিওয়ার্ড।',
                    'match' => function($p) {
                        return str_contains(strtolower($p->name), 'pass');
                    }
                ],
            ];
        } else {
            $editionList = [
                [
                    'key' => 'gen-direct',
                    'name' => 'Direct Top-Up (UID)',
                    'flag' => '⚡',
                    'badge' => 'Instant',
                    'speed' => '10-60 Seconds',
                    'input_label' => 'Player ID / Account',
                    'input_placeholder' => 'আপনার Player ID দিন',
                    'tip' => '১০০% অফিশিয়াল ডিরেক্ট রিলোড। নিশ্চিন্তে টপ-আপ সম্পন্ন করুন।',
                    'notice' => 'তাৎক্ষণিক অটোমেটিক রিচার্জ। বিকাশ, নগদ, রকেট বা ক্রিপ্টো USDT দিয়ে সহজে পেমেন্ট সম্পন্ন করুন।',
                    'match' => function($p) { return true; }
                ]
            ];
        }

        // Tag each package with its edition key
        $packageEditionMap = [];
        foreach ($product->packages as $pkg) {
            $assigned = $editionList[0]['key'];
            foreach ($editionList as $ed) {
                if ($ed['match']($pkg)) {
                    $assigned = $ed['key'];
                    break;
                }
            }
            $packageEditionMap[$pkg->id] = $assigned;
        }

        $requestedPkgId = request('pkg');
        $defaultPkg = $requestedPkgId ? ($product->packages->firstWhere('id', $requestedPkgId) ?? $product->packages->firstWhere('name', $requestedPkgId)) : null;
        
        // Active edition is the first one or matches requested package
        $activeEditionKey = $editionList[0]['key'];
        if ($defaultPkg && isset($packageEditionMap[$defaultPkg->id])) {
            $activeEditionKey = $packageEditionMap[$defaultPkg->id];
        }
        $activeEdition = collect($editionList)->firstWhere('key', $activeEditionKey) ?? $editionList[0];

        // Selected package defaults to first package in active edition
        $firstInActive = $product->packages->first(function($pkg) use ($activeEditionKey, $packageEditionMap) {
            return ($packageEditionMap[$pkg->id] ?? '') === $activeEditionKey;
        }) ?? $product->packages->first();

        $selectedPkg = $defaultPkg ?: $firstInActive;
        $basePriceBdt = $selectedPkg ? $selectedPkg->price_bdt : $product->base_price_bdt;
    @endphp

    <!-- Top Product Header Banner (SEAGM / VertexBazaar Style) -->
    <div class="pp-banner">
        <img src="{{ $coverImg }}" alt="{{ $product->title }} Banner" class="pp-banner-bg">
        <div class="pp-banner-overlay"></div>
        <div class="pp-banner-content">
            <div class="pp-avatar">
                @if($avatarImg)
                    <img src="{{ $avatarImg }}" alt="{{ $product->title }}">
                @else
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:radial-gradient(circle, {{ $product->brand_color }}33 0%, #0B0F19 100%);">
                        <i data-lucide="gamepad-2" style="width:32px;height:32px;color:{{ $product->brand_color }};"></i>
                    </div>
                @endif
            </div>
            <div class="pp-header-info">
                <h1 class="pp-title">{{ $product->title }}</h1>
                <div class="pp-meta-tags-row">
                    <span class="pp-cat-pill">
                        <i data-lucide="gamepad-2" class="icon"></i>
                        <span>Games Top-Up</span>
                    </span>
                    <span class="pp-badge pp-badge-orange">
                        <i data-lucide="zap" class="icon" style="width:11px;height:11px;"></i> Instant
                    </span>
                    <span class="pp-badge pp-badge-neutral">
                        <span class="pp-region-flag">
                            {{ $isBdRegion ? '🇧🇩' : '🌐' }}
                        </span>
                        <span id="pp-header-region-text">{{ $isBdRegion ? 'Bangladesh' : 'Global' }}</span>
                    </span>
                    <span class="pp-badge pp-badge-rating">
                        ★ 5.0 (42)
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Dedicated Game Edition / Recharge Mode Selector (Trigger Bar) -->
    @if(count($editionList) > 1)
        <div class="pp-edition-select-wrap">
            <div class="pp-edition-select-label">
                <i data-lucide="layers" class="icon" style="width:13px;height:13px;"></i>
                <span>টপ-আপ ধরন / এডিশন সিলেক্ট করতে এখানে ক্লিক করুন</span>
            </div>
            <button type="button" class="pp-edition-selected" id="pp-edition-selected-trigger" aria-haspopup="dialog" aria-controls="pp-edition-picker-modal" aria-expanded="false">
                <div class="pp-ed-sel-left">
                    <span class="pp-ed-flag-badge" id="pp-ed-sel-flag">{{ $activeEdition['flag'] }}</span>
                    <div class="pp-ed-sel-info">
                        <span class="pp-ed-name" id="pp-active-edition-status">● {{ $activeEdition['name'] }}</span>
                        <div class="pp-ed-sel-meta">
                            <span class="pp-ed-chip" id="pp-ed-sel-badge" style="{{ empty($activeEdition['badge']) ? 'display:none;' : '' }}">{{ $activeEdition['badge'] }}</span>
                            <span class="pp-ed-sel-speed" id="pp-ed-sel-speed">{{ $activeEdition['speed'] }}</span>
                        </div>
                    </div>
                </div>
                <i data-lucide="chevron-down" class="icon pp-ed-chevron" id="pp-ed-chevron" style="width:18px;height:18px;"></i>
            </button>
        </div>
    @endif

    <!-- Promotional Alert Box (Notice Callout) -->
    <div class="pp-notice-alert" id="pp-notice-alert-box">
        <i data-lucide="shield-check" class="icon" style="width:16px;height:16px;"></i>
        <div id="pp-notice-alert-text">
            {{ $product->instructions ?? ($activeEdition['notice'] ?? 'আপনার Player ID দিন।') }}
        </div>
    </div>

    <!-- Main 3-Step Checkout Form -->
    <form action="{{ route('checkout') }}" method="GET" id="game-checkout-form">
        <input type="hidden" name="package_id" id="selected-package-id" value="{{ $selectedPkg->id ?? '' }}">
        <input type="hidden" name="payment_method" id="selected-payment-method" value="bkash">

        <div class="row g-4">
            
            <!-- Left Column: Steps 1, 2, 3 & Tabs -->
            <div class="col-12 col-lg-8">

                <!-- STEP 1: Select Package -->
                <div class="pp-step-block">
                    <div class="pp-step-header">
                        <div class="pp-step-left">
                            <span class="pp-step-num">1</span>
                            <span class="pp-step-title">Select Package</span>
                        </div>
                        <span style="font-size:0.75rem; color:var(--vb-emerald); font-weight:700;" id="pp-stock-count-label">
                            ● {{ $product->packages->count() }} Packages In Stock
                        </span>
                    </div>

                    <div class="var-grid">
                        @foreach($product->packages as $index => $pkg)
                            @php
                                $usdtEquiv = number_format($pkg->price_bdt / 128, 2);
                                $pkgEdKey = $packageEditionMap[$pkg->id] ?? $editionList[0]['key'];
                                $isSelected = ($selectedPkg && $selectedPkg->id === $pkg->id);
                                $isVisible = ($pkgEdKey === $activeEditionKey);
                            @endphp
                            <div class="pp-var-card {{ $isSelected ? 'selected' : '' }}"
                                 data-id="{{ $pkg->id }}"
                                 data-edition="{{ $pkgEdKey }}"
                                 data-price="{{ number_format($pkg->price_bdt, 1) }}"
                                 data-name="{{ $pkg->name }}"
                                 style="{{ $isVisible ? '' : 'display:none;' }}">
                                <div class="pp-var-top">
                                    <div style="min-width:0;">
                                        <div class="pp-var-label" title="{{ $pkg->name }}">{{ $pkg->name }}</div>
                                        <div class="pp-var-stock">
                                            <span class="pp-var-stock-dot"></span> In Stock
                                        </div>
                                    </div>
                                    <div class="pp-var-prices">
                                        <div class="pp-var-price-bdt">&#2547;{{ number_format($pkg->price_bdt, 1) }}</div>
                                        <div class="pp-var-price-usdt">&asymp; ${{ $usdtEquiv }} USDT</div>
                                    </div>
                                </div>
                                @if($pkg->badge)
                                    <div class="pp-var-bonus-tag">
                                        🏷️ {{ $pkg->badge }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- STEP 2: Account Info -->
                <div class="pp-step-block" id="account-info-section">
                    <div class="pp-step-header">
                        <div class="pp-step-left">
                            <span class="pp-step-num">2</span>
                            <span class="pp-step-title">Account Info</span>
                        </div>
                        <a href="#tab-guide" class="pp-step-link" onclick="document.querySelector('[data-tab=guide]').click(); document.getElementById('product-tabs-section').scrollIntoView({behavior:'smooth'});">
                            How to place an order? &rarr;
                        </a>
                    </div>

                    <!-- Order Summary preview pill with Clear button -->
                    <div class="pp-order-summary-box">
                        <div class="pp-summary-text">
                            Order Summary: <strong class="pp-summary-item" id="summary-package-name">{{ $selectedPkg->name ?? 'None' }}</strong>
                            <span style="color:var(--text-dim); margin:0 4px;">&bull;</span>
                            <strong style="color:var(--vb-emerald);" id="summary-package-price">&#2547; {{ number_format($basePriceBdt, 1) }}</strong>
                        </div>
                        <button type="button" class="pp-clear-btn" id="pp-clear-pkg-btn">
                            &times; Clear
                        </button>
                    </div>

                    <!-- Dynamic Game Input Fields -->
                    @if($isMlbb)
                        <div class="pp-input-group">
                            <label class="pp-input-label" for="input-mlbb-user-id">
                                <span>User ID <span class="req">*</span></span>
                                <span style="font-size:0.7rem; color:var(--text-dim); font-weight:normal;">e.g. 12345678</span>
                            </label>
                            <input type="text"
                                   id="input-mlbb-user-id"
                                   name="player_id"
                                   class="pp-input"
                                   placeholder="আপনার User ID এখানে দিন"
                                   required>
                        </div>

                        <div class="pp-input-group">
                            <label class="pp-input-label" for="input-mlbb-zone-id">
                                <span>Server / Zone ID <span class="req">*</span></span>
                                <span style="font-size:0.7rem; color:var(--text-dim); font-weight:normal;">e.g. 2049</span>
                            </label>
                            <input type="text"
                                   id="input-mlbb-zone-id"
                                   name="zone_id"
                                   class="pp-input"
                                   placeholder="আপনার Server ID এখানে দিন"
                                   required>
                        </div>

                        <div class="pp-input-tip">
                            <i data-lucide="info" class="icon" style="width:13px;height:13px;color:var(--vb-orange);"></i>
                            <span>ইন-গেম প্রোফাইল খুললে Avatar এর পাশে User ID (Server ID) দেখতে পাবেন, যেমন: 12345678 (2049)</span>
                        </div>

                    @elseif($isFf)
                        <div class="pp-input-group" id="pp-ff-input-group">
                            <label class="pp-input-label" for="input-ff-player-id">
                                <span id="pp-ff-label-text">{{ $activeEdition['input_label'] ?? 'Player ID (UID)' }} <span class="req">*</span></span>
                                <span id="pp-ff-label-sub" style="font-size:0.7rem; color:var(--text-dim); font-weight:normal;">e.g. 192847582</span>
                            </label>
                            <input type="text"
                                   id="input-ff-player-id"
                                   name="player_id"
                                   class="pp-input"
                                   placeholder="{{ $activeEdition['input_placeholder'] ?? 'আপনার Free Fire Player ID (UID) দিন' }}"
                                   required>
                        </div>

                        <div class="pp-input-tip" id="pp-ff-tip-wrap">
                            <i data-lucide="info" class="icon" style="width:13px;height:13px;color:var(--vb-orange);"></i>
                            <span id="pp-ff-tip-text">{{ $activeEdition['tip'] ?? 'Free Fire গেমে ঢুকে আপনার প্রোফাইল থেকে Player ID (UID) কপি করে এখানে বসান।' }}</span>
                        </div>

                    @elseif($isPubg)
                        <div class="pp-input-group">
                            <label class="pp-input-label" for="input-pubg-player-id">
                                <span id="pp-pubg-label-text">{{ $activeEdition['input_label'] ?? 'Character ID (UID)' }} <span class="req">*</span></span>
                                <span style="font-size:0.7rem; color:var(--text-dim); font-weight:normal;">e.g. 5129482910</span>
                            </label>
                            <input type="text"
                                   id="input-pubg-player-id"
                                   name="player_id"
                                   class="pp-input"
                                   placeholder="{{ $activeEdition['input_placeholder'] ?? 'আপনার PUBG Character ID দিন' }}"
                                   required>
                        </div>

                        <div class="pp-input-group">
                            <label class="pp-input-label" for="input-pubg-player-name">
                                <span>In-Game Nickname (Optional)</span>
                                <span style="font-size:0.7rem; color:var(--text-dim); font-weight:normal;">e.g. ShadowHunter</span>
                            </label>
                            <input type="text"
                                   id="input-pubg-player-name"
                                   name="player_name"
                                   class="pp-input"
                                   placeholder="e.g. ShadowHunter">
                        </div>

                        <div class="pp-input-tip" id="pp-pubg-tip-wrap">
                            <i data-lucide="info" class="icon" style="width:13px;height:13px;color:var(--vb-orange);"></i>
                            <span id="pp-pubg-tip-text">{{ $activeEdition['tip'] ?? 'আপনার PUBG Character ID দিন।' }}</span>
                        </div>

                    @else
                        @if($product->input_fields_schema && count($product->input_fields_schema) > 0)
                            @foreach($product->input_fields_schema as $field)
                                <div class="pp-input-group">
                                    <label class="pp-input-label">
                                        <span>{{ $field['label'] }} @if($field['required'] ?? false)<span class="req">*</span>@endif</span>
                                    </label>
                                    <input type="{{ $field['type'] ?? 'text' }}"
                                           name="{{ $field['name'] }}"
                                           class="pp-input"
                                           placeholder="{{ $field['placeholder'] ?? '' }}"
                                           {{ ($field['required'] ?? false) ? 'required' : '' }}>
                                </div>
                            @endforeach
                        @endif
                    @endif
                </div>

                <!-- STEP 3: Payment Methods -->
                <div class="pp-step-block">
                    <div class="pp-step-header">
                        <div class="pp-step-left">
                            <span class="pp-step-num">3</span>
                            <span class="pp-step-title">Payment Methods</span>
                        </div>
                        <span style="font-size:0.75rem; color:var(--text-muted);">Instant Auto Payout</span>
                    </div>

                    <div class="pp-payment-list">
                        
                        <!-- 1. Wallet Pay -->
                        <div class="pp-payment-option" data-method="wallet">
                            <div class="pp-pay-left">
                                <input type="radio" name="payment_opt_radio" class="pp-pay-radio">
                                <div class="pp-pay-icon" style="background:rgba(255,140,0,0.15); color:var(--vb-orange);">
                                    <i data-lucide="wallet" class="icon" style="width:16px;height:16px;"></i>
                                </div>
                                <span class="pp-pay-title">Wallet Pay</span>
                            </div>
                            <span style="font-size:0.75rem; color:var(--text-dim);">৳0.0 Balance</span>
                        </div>

                        <!-- 2. bKash, Nagad, Card Payment (BDT) -->
                        <div class="pp-payment-option selected" data-method="bkash">
                            <div class="pp-pay-left">
                                <input type="radio" name="payment_opt_radio" class="pp-pay-radio" checked>
                                <div class="pp-pay-icon" style="background:rgba(226,19,110,0.15); color:#E2136E;">
                                    <i data-lucide="credit-card" class="icon" style="width:16px;height:16px;"></i>
                                </div>
                                <div>
                                    <span class="pp-pay-title">bKash, Nagad, Card Payment (BDT)</span>
                                    <div style="font-size:0.68rem; color:var(--vb-emerald);">● Automated Instant Gateway</div>
                                </div>
                            </div>
                            <span class="pp-badge pp-badge-orange" style="font-size:0.65rem;">Fastest</span>
                        </div>

                        <!-- 3. Binance / Bybit USDT -->
                        <div class="pp-payment-option" data-method="usdt">
                            <div class="pp-pay-left">
                                <input type="radio" name="payment_opt_radio" class="pp-pay-radio">
                                <div class="pp-pay-icon" style="background:rgba(38,161,123,0.15); color:#26A17B;">
                                    <i data-lucide="coins" class="icon" style="width:16px;height:16px;"></i>
                                </div>
                                <span class="pp-pay-title">Binance / Bybit (USDT TRC20)</span>
                            </div>
                            <span style="font-size:0.75rem; color:var(--vb-emerald); font-weight:700;">Zero Fee</span>
                        </div>

                        <!-- 4. bKash Send Money -->
                        <div class="pp-payment-option" data-method="bkash">
                            <div class="pp-pay-left">
                                <input type="radio" name="payment_opt_radio" class="pp-pay-radio">
                                <div class="pp-pay-icon" style="background:rgba(226,19,110,0.15); color:#E2136E; font-weight:900; font-size:11px;">
                                    bK
                                </div>
                                <span class="pp-pay-title">bKash Send Money (Manual)</span>
                            </div>
                            <span style="font-size:0.72rem; color:var(--text-dim);">Personal Number</span>
                        </div>

                        <!-- 5. Nagad Send Money -->
                        <div class="pp-payment-option" data-method="nagad">
                            <div class="pp-pay-left">
                                <input type="radio" name="payment_opt_radio" class="pp-pay-radio">
                                <div class="pp-pay-icon" style="background:rgba(247,148,29,0.15); color:#F7941D; font-weight:900; font-size:11px;">
                                    NG
                                </div>
                                <span class="pp-pay-title">Nagad Send Money</span>
                            </div>
                            <span style="font-size:0.72rem; color:var(--text-dim);">Personal Number</span>
                        </div>

                        <!-- 6. Rocket Send Money -->
                        <div class="pp-payment-option" data-method="rocket">
                            <div class="pp-pay-left">
                                <input type="radio" name="payment_opt_radio" class="pp-pay-radio">
                                <div class="pp-pay-icon" style="background:rgba(140,43,142,0.15); color:#8C2B8E; font-weight:900; font-size:11px;">
                                    RK
                                </div>
                                <span class="pp-pay-title">Rocket Send Money</span>
                            </div>
                            <span style="font-size:0.72rem; color:var(--text-dim);">Personal Number</span>
                        </div>

                        <!-- 7. Upay Send Money -->
                        <div class="pp-payment-option" data-method="upay">
                            <div class="pp-pay-left">
                                <input type="radio" name="payment_opt_radio" class="pp-pay-radio">
                                <div class="pp-pay-icon" style="background:rgba(0,163,224,0.15); color:#00A3E0; font-weight:900; font-size:11px;">
                                    UP
                                </div>
                                <span class="pp-pay-title">Upay Send Money</span>
                            </div>
                            <span style="font-size:0.72rem; color:var(--text-dim);">Personal Number</span>
                        </div>

                    </div>
                </div>

                <!-- Buy Now Button for Mobile View -->
                <button type="submit" class="pp-buy-now-btn d-lg-none" id="pp-buy-now-btn-mobile">
                    <span>Buy Now</span>
                    <span id="pp-buy-now-price-mobile">&mdash; &#2547; {{ number_format($basePriceBdt, 1) }}</span>
                    <i data-lucide="arrow-right" class="icon" style="width:18px;height:18px;"></i>
                </button>

                <!-- Information Tabs Section -->
                <div class="pp-step-block mt-4" id="product-tabs-section">
                    <div class="pp-tabs-bar">
                        <button type="button" class="pp-tab-nav-btn active" data-tab="desc">
                            <i data-lucide="info" class="icon" style="width:14px;height:14px;"></i> Description
                        </button>
                        <button type="button" class="pp-tab-nav-btn" data-tab="guide">
                            <i data-lucide="help-circle" class="icon" style="width:14px;height:14px;"></i> Guide
                        </button>
                        <button type="button" class="pp-tab-nav-btn" data-tab="reviews">
                            <i data-lucide="star" class="icon" style="width:14px;height:14px;"></i> Reviews (42)
                        </button>
                    </div>

                    <!-- Tab 1: Description -->
                    <div class="pp-tab-pane active" id="tab-desc">
                        <h3 style="font-size: 1rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.6rem;">
                            About {{ $product->title }}
                        </h3>
                        <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.7; margin-bottom: 1rem;">
                            {{ $product->description }}
                        </p>
                        <div style="background: rgba(16, 185, 129, 0.08); border-left: 3px solid var(--vb-emerald); padding: 0.75rem 1rem; border-radius: 0 10px 10px 0; font-size: 0.8rem; color: var(--text-main);">
                            <strong>⚡ Instant Delivery:</strong> Orders are processed directly via official publisher gateways within 10-60 seconds. 100% safe, ban-free and password-free.
                        </div>
                    </div>

                    <!-- Tab 2: Guide -->
                    <div class="pp-tab-pane" id="tab-guide">
                        <h3 style="font-size: 1rem; font-weight: 800; color: var(--text-main); margin-bottom: 0.6rem;">
                            How to Recharge & Find Your ID
                        </h3>
                        @if($isMlbb)
                            <ol style="font-size: 0.83rem; color: var(--text-muted); line-height: 1.75; padding-left: 1.25rem;">
                                <li>Mobile Legends গেম ওপেন করুন।</li>
                                <li>লবি স্ক্রিনের উপরের বাম কোণায় আপনার Avatar / Profile আইকনে ট্যাপ করুন।</li>
                                <li>আপনার প্রোফাইল পেজে ইউজারনেমের পাশে User ID এবং বন্ধনীর ভেতরে Server ID দেখতে পাবেন। যেমন: <code>12345678 (2049)</code>।</li>
                                <li>প্রথম অংশটি (যেমন <code>12345678</code>) <strong>User ID</strong> বক্সে এবং বন্ধনীর ভেতরের অংশটি (যেমন <code>2049</code>) <strong>Server ID</strong> বক্সে লিখুন।</li>
                                <li>প্যাকেজ ও পেমেন্ট মেথড সিলেক্ট করে <strong>Buy Now</strong> বাটনে ক্লিক করুন।</li>
                            </ol>
                        @elseif($isFf)
                            <ol style="font-size: 0.83rem; color: var(--text-muted); line-height: 1.75; padding-left: 1.25rem;">
                                <li>Free Fire গেম ওপেন করুন।</li>
                                <li>লবি স্ক্রিনের উপরের বাম পাশে আপনার প্রোফাইল ব্যানারে ট্যাপ করুন।</li>
                                <li>আপনার প্রোফাইল পেজে 8-10 ডিজিটের <strong>Player ID (UID)</strong> দেখতে পাবেন।</li>
                                <li>কপি বাটনে ট্যাপ করে UID কপি করুন এবং আমাদের ওয়েবসাইটে <strong>Player ID (UID)</strong> বক্সে পেস্ট করুন।</li>
                                <li>প্যাকেজ বেছে নিয়ে বিকাশ বা নগদ দিয়ে অর্ডার সম্পন্ন করুন। ১০ সেকেন্ডের মধ্যে ডায়মন্ড আপনার একাউন্টে যোগ হবে।</li>
                            </ol>
                        @else
                            <ol style="font-size: 0.83rem; color: var(--text-muted); line-height: 1.75; padding-left: 1.25rem;">
                                <li>গেমে লগইন করে আপনার প্রোফাইলে যান।</li>
                                <li>আপনার গেম আইডি (UID) কপি করুন।</li>
                                <li>আমাদের ফর্মের সংশ্লিষ্ট বক্সে আইডি বসান।</li>
                                <li>পেমেন্ট মেথড সিলেক্ট করে Buy Now ক্লিক করুন।</li>
                            </ol>
                        @endif
                    </div>

                    <!-- Tab 3: Reviews -->
                    <div class="pp-tab-pane" id="tab-reviews">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--vb-card-border);">
                            <div>
                                <div style="font-size: 1.4rem; font-weight: 900; color: var(--accent-cta);">5.0 ★★★★★</div>
                                <div style="font-size: 0.75rem; color: var(--text-dim);">Based on 42 verified customer orders</div>
                            </div>
                            <span class="pp-badge pp-badge-orange">100% Satisfaction</span>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <div style="padding: 10px 12px; border-radius: 10px; background: rgba(255, 255, 255, 0.02); border: 1px solid var(--vb-card-border);">
                                <div style="display: flex; justify-content: space-between; font-size: 0.8rem; font-weight: 700; margin-bottom: 3px;">
                                    <span>Sakib Al Hasan <span style="color:var(--vb-emerald); font-size:0.7rem;">✔ Verified Buyer</span></span>
                                    <span style="color:var(--accent-cta);">★★★★★</span>
                                </div>
                                <p style="font-size: 0.78rem; color: var(--text-muted); margin: 0;">অর্ডার করার সাথে সাথে মাত্র ৩০ সেকেন্ডে ডায়মন্ড পেয়েছি! RosTop সেরা সার্ভিস দিচ্ছে।</p>
                            </div>

                            <div style="padding: 10px 12px; border-radius: 10px; background: rgba(255, 255, 255, 0.02); border: 1px solid var(--vb-card-border);">
                                <div style="display: flex; justify-content: space-between; font-size: 0.8rem; font-weight: 700; margin-bottom: 3px;">
                                    <span>Tanvir Ahmed <span style="color:var(--vb-emerald); font-size:0.7rem;">✔ Verified Buyer</span></span>
                                    <span style="color:var(--accent-cta);">★★★★★</span>
                                </div>
                                <p style="font-size: 0.78rem; color: var(--text-muted); margin: 0;">VertexBazaar এর মতোই ফাস্ট ও নির্ভরযোগ্য। বিকাশ দিয়ে পেমেন্ট করা খুব সহজ।</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Right Column: Sticky Summary & Checkout Card (Desktop) -->
            <div class="col-12 col-lg-4">
                <div class="pp-step-block" style="position: sticky; top: 80px;">
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--text-main); margin-bottom: 1rem; border-bottom: 1px solid var(--vb-card-border); padding-bottom: 0.65rem;">
                        Order Summary
                    </h3>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.65rem; font-size: 0.82rem;">
                        <span style="color: var(--text-muted);">Product</span>
                        <strong style="color: var(--text-main);">{{ $product->title }}</strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.65rem; font-size: 0.82rem;">
                        <span style="color: var(--text-muted);">Selected Package</span>
                        <strong id="side-selected-pkg" style="color: var(--vb-orange);">
                            {{ $firstPkg->name ?? 'None' }}
                        </strong>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.65rem; font-size: 0.82rem;">
                        <span style="color: var(--text-muted);">Delivery Speed</span>
                        <span class="pp-badge pp-badge-orange">10-60 Seconds</span>
                    </div>

                    <div style="border-top: 1px solid var(--vb-card-border); margin: 1rem 0; padding-top: 0.85rem; display: flex; justify-content: space-between; align-items: flex-end;">
                        <div>
                            <div style="font-size: 0.7rem; color: var(--text-dim); text-transform: uppercase;">Total Payable</div>
                            <div id="side-selected-price" style="font-size: 1.6rem; font-weight: 900; color: var(--vb-orange); line-height: 1;">
                                &#2547; {{ number_format($basePriceBdt, 1) }}
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="pp-buy-now-btn" id="pp-buy-now-btn">
                        <span>Buy Now</span>
                        <span id="pp-buy-now-price">&mdash; &#2547; {{ number_format($basePriceBdt, 1) }}</span>
                        <i data-lucide="arrow-right" class="icon" style="width:18px;height:18px;"></i>
                    </button>

                    <div style="margin-top: 1.25rem; display: flex; flex-direction: column; gap: 0.45rem; font-size: 0.73rem; color: var(--text-dim);">
                        <div style="display: flex; align-items: center; gap: 0.4rem;">
                            <i data-lucide="check-circle" class="icon" style="width:14px;height:14px;color:var(--vb-emerald);"></i>
                            <span>100% Official Direct UID Reload</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.4rem;">
                            <i data-lucide="lock" class="icon" style="width:14px;height:14px;color:var(--vb-emerald);"></i>
                            <span>256-Bit SSL Encrypted &amp; Ban-Free</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.4rem;">
                            <i data-lucide="zap" class="icon" style="width:14px;height:14px;color:var(--vb-emerald);"></i>
                            <span>bKash, Nagad, Rocket &amp; USDT Accepted</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>

    @if(count($editionList) > 1)
        <!-- Edition Picker Modal (SEAGM / Vertex Style) -->
        <div class="pp-edition-modal" id="pp-edition-picker-modal" role="dialog" aria-modal="true" aria-labelledby="pp-edition-modal-title" hidden>
            <div class="pp-edition-modal-backdrop" data-edition-close></div>
            <div class="pp-edition-dialog">
                <div class="pp-edition-modal-header">
                    <h3 id="pp-edition-modal-title" class="pp-edition-modal-title">টপ-আপ ধরন / এডিশন সিলেক্ট করুন</h3>
                    <button type="button" class="pp-edition-modal-close" data-edition-close aria-label="Close modal">
                        <i data-lucide="x" style="width:18px;height:18px;"></i>
                    </button>
                </div>
                <ul class="pp-edition-modal-list" role="listbox" aria-labelledby="pp-edition-modal-title">
                    @foreach($editionList as $ed)
                        <li>
                            <button type="button"
                                    class="pp-edition-option {{ $ed['key'] === $activeEditionKey ? 'active' : '' }}"
                                    role="option"
                                    aria-selected="{{ $ed['key'] === $activeEditionKey ? 'true' : 'false' }}"
                                    data-edition-key="{{ $ed['key'] }}"
                                    data-edition-name="{{ $ed['name'] }}"
                                    data-edition-speed="{{ $ed['speed'] }}"
                                    data-edition-input-label="{{ $ed['input_label'] }}"
                                    data-edition-input-placeholder="{{ $ed['input_placeholder'] }}"
                                    data-edition-tip="{{ $ed['tip'] }}"
                                    data-edition-notice="{{ $ed['notice'] }}"
                                    data-edition-flag="{{ $ed['flag'] }}"
                                    data-edition-badge="{{ $ed['badge'] }}">
                                <span class="pp-ed-flag">{{ $ed['flag'] }}</span>
                                <div class="pp-ed-option-text">
                                    <div class="pp-ed-name">{{ $ed['name'] }}</div>
                                    <div class="pp-ed-option-meta">
                                        @if(!empty($ed['badge']))
                                            <span class="pp-ed-chip">{{ $ed['badge'] }}</span>
                                        @endif
                                        <span class="pp-ed-sel-speed">{{ $ed['speed'] }}</span>
                                    </div>
                                </div>
                                <span class="pp-ed-option-check" aria-hidden="true">
                                    <i data-lucide="check" style="width:12px;height:12px;"></i>
                                </span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

</div>
@endsection
