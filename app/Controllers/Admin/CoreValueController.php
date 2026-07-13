<?php

namespace App\Controllers\Admin;

use App\Models\CoreValueModel;

class CoreValueController extends SimpleCrudController
{
    protected string $viewPath    = 'admin/core-values';
    protected string $redirectUrl = 'admin/core-values';
    protected string $moduleTitle = 'Core Value';
    protected string $auditModel  = 'CoreValue';
    protected array $searchFields = ['title'];

    public function __construct()
    {
        $this->model = new CoreValueModel();
    }
}
