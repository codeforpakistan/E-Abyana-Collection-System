<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $csp = "default-src 'self'; " .
               "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://code.jquery.com https://use.fontawesome.com https://cdn.tailwindcss.com https://cdn.datatables.net https://www.googletagmanager.com https://www.google-analytics.com; " .
               "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://use.fontawesome.com https://cdn.tailwindcss.com https://cdn.datatables.net; " .
               "img-src 'self' data: https://www.google-analytics.com; " .
               "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com https://use.fontawesome.com; " .
               "connect-src 'self' https://www.google-analytics.com https://www.googletagmanager.com; " .
               "frame-ancestors 'none';";

        $response->headers->set('Content-Security-Policy', $csp);
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Strict-Transport-Security', 'max-age=63072000; includeSubDomains; preload');

        return $response;
    }
}
