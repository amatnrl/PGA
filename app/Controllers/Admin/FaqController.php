<?php

namespace App\Controllers\Admin;

use App\Models\FaqModel;

class FaqController extends SimpleCrudController
{
    protected string $viewPath    = 'admin/faqs';
    protected string $redirectUrl = 'admin/faqs';
    protected string $moduleTitle = 'FAQ';
    protected string $auditModel  = 'Faq';
    protected array $searchFields = ['question'];

    public function __construct()
    {
        $this->model = new FaqModel();
    }
}
