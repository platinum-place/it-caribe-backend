<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Skip strict CSP for file upload routes
        if ($this->isFileUploadRoute($request)) {
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('X-Frame-Options', 'SAMEORIGIN'); // Less restrictive for uploads
            $response->headers->set('X-XSS-Protection', '1; mode=block');
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
            $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
            $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
            // More permissive CSP for file uploads
            $response->headers->set('Content-Security-Policy', "default-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data: blob:;");
        } else {
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('X-Frame-Options', 'DENY');
            $response->headers->set('X-XSS-Protection', '1; mode=block');
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
            $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
            $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
            $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';");
        }

        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
        $response->headers->remove('X-AspNet-Version');
        $response->headers->remove('X-AspNetMvc-Version');
        $response->headers->remove('Location');

        return $response;
    }

    /**
     * Check if the current route is a file upload route
     */
    private function isFileUploadRoute(Request $request): bool
    {
        $uploadRoutes = [
            'livewire/upload-file',
            'api/quotes/upload-photos',
            'filament/forms/components/file-upload',
        ];

        $path = $request->path();

        foreach ($uploadRoutes as $route) {
            if (str_contains($path, $route)) {
                return true;
            }
        }

        return false;
    }
}
