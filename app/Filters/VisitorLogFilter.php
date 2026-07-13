<?php

namespace App\Filters;

use App\Services\VisitorAnalyticsService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class VisitorLogFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (! $request->is('GET')) {
            return;
        }

        (new VisitorAnalyticsService())->recordVisit(
            current_url(),
            $request->getIPAddress(),
            $request->getUserAgent()->getAgentString()
        );
    }
}
