<?php

namespace App\Controllers\Admin;

use App\Models\CompanyMilestoneModel;

class MilestoneController extends SimpleCrudController
{
    protected string $viewPath    = 'admin/milestones';
    protected string $redirectUrl = 'admin/milestones';
    protected string $moduleTitle = 'Milestone';
    protected string $auditModel  = 'CompanyMilestone';
    protected array $searchFields = ['title'];

    public function __construct()
    {
        $this->model = new CompanyMilestoneModel();
    }
}
