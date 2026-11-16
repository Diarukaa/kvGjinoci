<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        $response = $next($request);

        // Clickjacking protection

        $response->headers->set(
            'X-Frame-Options',
            'DENY'
        );

        // MIME sniffing protection

        $response->headers->set(
            'X-Content-Type-Options',
            'nosniff'
        );

        // Referrer protection

        $response->headers->set(
            'Referrer-Policy',
            'same-origin'
        );

        // Browser permissions

        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=()'
        );

        // Content Security Policy

        $response->headers->set(
            'Content-Security-Policy',
            "frame-ancestors 'none'; "
            . "object-src 'none'; "
            . "base-uri 'self'; "
            . "form-action 'self'"
        );

        // Disable legacy XSS filter

        $response->headers->set(
            'X-XSS-Protection',
            '0'
        );

        // Private pages must not be cached

        $response->headers->set(
            'Cache-Control',
            'no-store, private, max-age=0'
        );

        $response->headers->set(
            'Pragma',
            'no-cache'
        );

        $response->headers->set(
            'Expires',
            '0'
        );

        // HTTPS protection in production

        if (
            app()->isProduction()
            && $request->isSecure()
        ) {

            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000'
            );

        }

        $response->headers->remove(
            'X-Powered-By'
        );

        return $response;
    }
}
