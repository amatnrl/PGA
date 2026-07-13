<?php

namespace App\Controllers\Admin;

use App\Models\TeamMemberModel;

class TeamMemberController extends SimpleCrudController
{
    protected string $viewPath    = 'admin/team-members';
    protected string $redirectUrl = 'admin/team-members';
    protected string $moduleTitle = 'Team Member';
    protected string $auditModel  = 'TeamMember';
    protected array $searchFields = ['name'];

    public function __construct()
    {
        $this->model = new TeamMemberModel();
    }
}
