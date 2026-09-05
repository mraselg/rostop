<?php

namespace App\Support;

/**
 * Central product brand resolver.
 *
 * Maps any product slug (keyword-matched, so Bengali/duplicate slugs are covered too)
 * to its official SVG logo asset (public/images/brands) and a Lucide fallback icon.
 * Also exposes colour helpers used to generate per-product gradient overlays.
 */
class BrandLogos
{
    /**
     * Ordered keyword map — the FIRST matching slug keyword wins,
     * so more specific keywords must be listed before generic ones.
     *
     * keyword => [svg logo file (null = none), lucide fallback icon]
     */
    private const MAP = [
        // Games
        'free-fire'       => ['free-fire.svg', 'gamepad-2'],
        'pubg'            => ['pubg.svg', 'crosshair'],
        'mobile-legends'  => ['mlbb.svg', 'swords'],
        'mlbb'            => ['mlbb.svg', 'swords'],
        'valorant'        => ['valorant.svg', 'crosshair'],
        'blood-strike'    => ['blood-strike.svg', 'crosshair'],
        'clash-of-clans'  => ['coc.svg', 'swords'],
        'efootball'       => ['efootball.svg', 'trophy'],
        'fc-mobile'       => ['fc-mobile.svg', 'trophy'],
        'genshin'         => ['genshin.svg', 'sparkles'],
        'honor-of-kings'  => ['hok.svg', 'crown'],
        'roblox'          => ['roblox.svg', 'boxes'],
        'super-sus'       => ['super-sus.svg', 'gamepad-2'],

        // Gift cards (buy)
        'google-play'     => ['googleplay.svg', 'play'],
        'apple'           => ['apple.svg', 'apple'],
        'itunes'          => ['apple.svg', 'apple'],
        'steam'           => ['steam.svg', 'gamepad-2'],

        // OTT / entertainment
        'netflix'         => ['netflix.svg', 'clapperboard'],
        'youtube'         => ['youtube.svg', 'youtube'],
        'prime-video'     => ['primevideo.svg', 'monitor-play'],
        'amazon'          => ['amazon.svg', 'monitor-play'],
        'hbo'             => ['hbomax.svg', 'tv'],
        'paramount'       => ['paramountplus.svg', 'tv'],
        'peacock'         => ['paramountplus.svg', 'tv'],
        'coursera'        => ['coursera.svg', 'graduation-cap'],
        'edx'             => ['coursera.svg', 'graduation-cap'],

        // AI tools
        'chatgpt'         => ['openai.svg', 'bot'],
        'gemini'          => ['googlebard.svg', 'sparkles'],
        'grok'            => ['xai.svg', 'bot'],
        'elevenlabs'      => ['elevenlabs.svg', 'audio-lines'],
        'framer'          => ['framer.svg', 'framer'],

        // Design & creative
        'canva'           => ['canva.svg', 'palette'],
        'capcut'          => ['capcut.svg', 'video'],
        'adobe'           => ['adobe.svg', 'wand-2'],
        'figma'           => ['figma.svg', 'figma'],
        'envato'          => ['envato.svg', 'image'],

        // Software & utilities
        'windows'         => ['windows11.svg', 'app-window'],
        'microsoft'       => ['microsoftoffice.svg', 'file-text'],
        'office'          => ['microsoftoffice.svg', 'file-text'],
        'ilovepdf'        => ['ilovepdf.svg', 'file-text'],
        'notion'          => ['notion.svg', 'notebook-pen'],
        'miro'            => ['miro.svg', 'pencil-ruler'],
        'jetbrains'       => ['jetbrains.svg', 'code-2'],
        'autodesk'        => ['autodesk.svg', 'box'],
        'surfshark'       => ['surfshark.svg', 'wifi'],
        'avira'           => ['avira.svg', 'shield-check'],
        'vpn'             => [null, 'shield'],
        'antivirus'       => [null, 'shield-check'],
        'gmail'           => ['gmail.svg', 'mail'],
        'outlook'         => ['microsoftoutlook.svg', 'mail'],
        'hotmail'         => ['microsoftoutlook.svg', 'mail'],
        'telegram'        => ['telegram.svg', 'send'],
    ];

    /**
     * Official SVG logo filename for a slug, or null when none exists.
     */
    public static function logo(?string $slug): ?string
    {
        $match = self::match($slug);
        $file  = $match[0] ?? null;

        if ($file && file_exists(public_path('images/brands/' . $file))) {
            return $file;
        }

        return null;
    }

    /**
     * Lucide fallback icon name for a slug.
     */
    public static function icon(?string $slug, string $fallback = 'key-round'): string
    {
        $match = self::match($slug);

        return $match[1] ?? $fallback;
    }

    /**
     * Generated two-layer gradient overlay behind the logo tile.
     * Each product gets a deterministic backdrop derived from its brand colour:
     * a pastel glow on top + a deeper brand sweep — so no banner ever looks blank.
     */
    public static function overlay(string $brand): string
    {
        $lum  = self::luminance($brand);
        $glow = self::mix($brand, '#FFFFFF', $lum < 0.10 ? 0.62 : 0.26);
        $deep = self::mix($brand, '#000000', 0.45);

        return "radial-gradient(95% 90% at 50% 22%, {$glow}55 0%, transparent 62%), "
             . "linear-gradient(160deg, {$brand}38 0%, {$deep}42 100%)";
    }

    /**
     * True for near-black brand colours (Apple, Notion, CapCut, Steam...)
     * which need an ink-on-light tile instead of a brand-solid tile.
     */
    public static function isVeryDark(string $brand, float $threshold = 0.05): bool
    {
        return self::luminance($brand) < $threshold;
    }

    /**
     * sRGB relative luminance (0 = black, 1 = white).
     */
    public static function luminance(string $hex): float
    {
        $hex = self::normalize($hex);
        if ($hex === null) {
            return 1.0;
        }

        $lin = function (float $v): float {
            return $v <= 0.04045 ? $v / 12.92 : (($v + 0.055) / 1.055) ** 2.4;
        };

        $r = hexdec(substr($hex, 0, 2)) / 255;
        $g = hexdec(substr($hex, 2, 2)) / 255;
        $b = hexdec(substr($hex, 4, 2)) / 255;

        return 0.2126 * $lin($r) + 0.7152 * $lin($g) + 0.0722 * $lin($b);
    }

    /**
     * Blend a hex colour toward another by the given fraction, returns 6-digit hex.
     */
    public static function mix(string $hex, string $target, float $frac): string
    {
        $hex    = self::normalize($hex) ?? '1FA37E';
        $target = self::normalize($target) ?? 'FFFFFF';
        $frac   = max(0.0, min(1.0, $frac));

        $out = '';
        for ($i = 0; $i < 3; $i++) {
            $c = hexdec(substr($hex, $i * 2, 2));
            $t = hexdec(substr($target, $i * 2, 2));
            $out .= strtoupper(str_pad(dechex((int) round($c + ($t - $c) * $frac)), 2, '0', STR_PAD_LEFT));
        }

        return '#' . $out;
    }

    /**
     * Short display label for a category name.
     */
    public static function categoryShort(string $name): string
    {
        $short = [
            'OS & Productivity'     => 'Windows & Office',
            'Developer'             => 'Dev & Education',
            'VPN'                   => 'VPN & Accounts',
            'License Keys'          => 'License Keys',
            'AI Tools'              => 'AI Tools',
            'Design'                => 'Design & Creative',
            'Entertainment'         => 'OTT & Streaming',
            'Digital Subscriptions' => 'Subscriptions',
        ];
        foreach ($short as $kw => $label) {
            if (str_contains($name, $kw)) {
                return $label;
            }
        }

        return $name;
    }

    private static function match(?string $slug): ?array
    {
        if (!$slug) {
            return null;
        }
        $slug = strtolower($slug);
        foreach (self::MAP as $needle => $pair) {
            if (str_contains($slug, $needle)) {
                return $pair;
            }
        }

        return null;
    }

    /**
     * Normalize "#RGB"/"RGB"/"#RRGGBB" to uppercase RRGGBB (without #), or null.
     */
    private static function normalize(string $hex): ?string
    {
        $hex = ltrim(trim($hex), '#');
        if (strlen($hex) === 3) {
            $hex = preg_replace('/(.)/', '$1$1', $hex);
        }
        if (strlen($hex) !== 6 || !ctype_xdigit($hex)) {
            return null;
        }

        return strtoupper($hex);
    }
}
