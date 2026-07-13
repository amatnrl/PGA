<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

/**
 * Generic rate limiter. Usage in Filters config: 'throttle:10,60' = 10 requests / 60 seconds per IP+route.
 */
class ThrottleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $capacity = (int) ($arguments[0] ?? 10);
        $seconds  = (int) ($arguments[1] ?? 60);

        $throttler = Services::throttler();
        $key       = preg_replace('/[^a-zA-Z0-9_]/', '_', $request->getIPAddress() . '_' . $request->getUri()->getPath());

        if (! $throttler->check($key, $capacity, $seconds)) {
            return service('response')
                ->setStatusCode(429)
                ->setBody('Terlalu banyak permintaan. Silakan coba lagi beberapa saat.');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
