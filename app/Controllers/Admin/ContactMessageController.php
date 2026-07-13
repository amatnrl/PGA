<?php

namespace App\Controllers\Admin;

use App\Services\AuditService;
use App\Services\SettingService;

/**
 * Manages the contact info shown on the public Contact page:
 * WhatsApp number, email, and address (with a live Maps preview).
 */
class ContactMessageController extends AdminBaseController
{
    private SettingService $service;

    public function __construct()
    {
        $this->service = new SettingService();
    }

    public function index()
    {
        $this->data['title'] = 'Kontak';
        $this->data['site']  = $this->service->getSite();

        return view('admin/messages/index', $this->data);
    }

    public function update()
    {
        $data = [
            'whatsapp' => $this->request->getPost('whatsapp'),
            'email'    => $this->request->getPost('email'),
            'address'  => $this->request->getPost('address'),
        ];

        $this->service->saveSite($data);

        (new AuditService())->log('update', 'ContactInfo', null, null, $data);

        return redirect()->to('admin/messages')->with('message', 'Informasi kontak berhasil disimpan.');
    }
}
