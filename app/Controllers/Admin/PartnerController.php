<?php

namespace App\Controllers\Admin;

use App\Models\PartnerModel;

class PartnerController extends SimpleCrudController
{
    protected string $viewPath    = 'admin/partners';
    protected string $redirectUrl = 'admin/partners';
    protected string $moduleTitle = 'Partner';
    protected string $auditModel  = 'Partner';
    protected array $searchFields = ['name'];
    protected array $fileFields   = ['logo'];

    public function __construct()
    {
        $this->model = new PartnerModel();
    }
}
