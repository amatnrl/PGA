<?php

namespace App\Controllers\Admin;

use App\Models\AuditLogModel;

class AuditLogController extends AdminBaseController
{
    public function index()
    {
        $model   = new AuditLogModel();
        $builder = $model->orderBy('id', 'desc');

        if ($model_filter = $this->request->getGet('model')) {
            $builder->where('model', $model_filter);
        }

        $this->data['title'] = 'Audit Log';
        $this->data['items'] = $builder->paginate(20);
        $this->data['pager'] = $model->pager;
        $this->data['models'] = $model->distinct()->select('model')->findAll();

        return view('admin/audit-logs/index', $this->data);
    }
}
