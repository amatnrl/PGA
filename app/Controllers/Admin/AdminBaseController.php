<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

abstract class AdminBaseController extends BaseController
{
    protected $helpers = ['form', 'url', 'text'];
    protected array $data = [];

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->data['currentUser'] = auth()->user();
    }
}
