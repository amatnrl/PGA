<?php

namespace App\Controllers\Admin;

use App\Models\ActivityModel;

class ActivityController extends ContentCrudController
{
    protected string $redirectUrl = 'admin/activities';
    protected string $moduleTitle = 'Activity';
    protected string $auditModel  = 'Activity';

    public function __construct()
    {
        $this->model = new ActivityModel();
    }
}
