<?php

namespace App\Controllers\Admin;

use App\Models\InsightModel;

class InsightController extends ContentCrudController
{
    protected string $redirectUrl = 'admin/insights';
    protected string $moduleTitle = 'Baking Insight';
    protected string $auditModel  = 'Insight';

    public function __construct()
    {
        $this->model = new InsightModel();
    }
}
