<?php

namespace App\Models;

class PartnerModel extends BaseModel
{
    protected $table         = 'partners';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['name', 'logo', 'website_url', 'sort_order', 'status'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'name' => 'required|max_length[150]',
        'logo' => 'required',
    ];
}
