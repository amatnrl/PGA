<?php

namespace App\Controllers\Admin;

use App\Services\VisitorAnalyticsService;

class VisitorAnalyticsController extends AdminBaseController
{
    public function index()
    {
        $service = new VisitorAnalyticsService();

        $this->data['title']       = 'Visitor Analytics';
        $this->data['total']       = $service->totalVisitors();
        $this->data['dailyCounts'] = $service->dailyCounts(14);
        $this->data['topPages']    = $service->topPages(5);

        return view('admin/analytics/index', $this->data);
    }
}
