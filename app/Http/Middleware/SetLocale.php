<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Reads the {locale} route segment and applies the app locale for
 * prefixed public routes (/bn/..., /hi/...). All other requests
 * are left untouched (legacy unprefixed routes = English).
 */
class SetLocale
{
    public const SUPPORTED = ['en', 'bn', 'hi'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = (string) $request->route('locale');

        if (in_array($locale, self::SUPPORTED, true)) {
            app()->setLocale($locale);
            $request->attributes->set('ui_locale', $locale);
            session(['ui_locale' => $locale]);
        }

        return $next($request);
    }
}
