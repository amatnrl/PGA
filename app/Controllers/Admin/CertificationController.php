<?php

namespace App\Controllers\Admin;

use App\Models\CertificationModel;

class CertificationController extends SimpleCrudController
{
    protected string $viewPath    = 'admin/certifications';
    protected string $redirectUrl = 'admin/certifications';
    protected string $moduleTitle = 'Certification';
    protected string $auditModel  = 'Certification';
    protected array $searchFields = ['name'];

    public function __construct()
    {
        $this->model = new CertificationModel();
    }
}
