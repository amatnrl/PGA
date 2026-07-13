<?php

namespace App\Controllers\Admin;

use Config\AuthGroups;

class PermissionController extends AdminBaseController
{
    public function index()
    {
        $config = config(AuthGroups::class);

        $this->data['title']       = 'Permission Management';
        $this->data['groups']      = $config->groups;
        $this->data['permissions'] = $config->permissions;
        $this->data['matrix']      = $config->matrix;

        return view('admin/permissions/index', $this->data);
    }
}
