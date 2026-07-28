<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompressResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Skip semua request Livewire (path /livewire/*) agar tidak merusak JSON response-nya
        if ($request->is('livewire/*') || $request->header('X-Livewire')) {
            return $response;
        }

        // Skip jika response bukan HTML (misal: JSON, binary, dll)
        $contentType = $response->headers->get('Content-Type', '');
        $isHtml = str_contains($contentType, 'text/html');

        if (
            $isHtml &&
            str_contains($request->headers->get('Accept-Encoding', ''), 'gzip') &&
            strlen($response->getContent()) > 1000
        ) {
            $compressed = gzencode($response->getContent(), 6);
            if ($compressed !== false) {
                $response->setContent($compressed);
                $response->headers->set('Content-Encoding', 'gzip');
                $response->headers->set('Content-Length', strlen($compressed));
            }
        }

        return $response;
    }
}
