<?php

namespace App\Controllers\Admin;

class GuideController extends AdminBaseController
{
    public function index()
    {
        $this->data['title'] = 'Panduan Penggunaan';

        return view('admin/guide/index', $this->data);
    }
}
