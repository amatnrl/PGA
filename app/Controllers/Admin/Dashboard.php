<?php

namespace App\Controllers\Admin;

use App\Services\DashboardService;

class Dashboard extends AdminBaseController
{
    public function index()
    {
        $service = new DashboardService();
        $this->data['counters'] = $service->getCounters();
        $this->data['title']    = 'Dashboard';

        return view('admin/dashboard/index', $this->data);
    }
}
