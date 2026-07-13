<?php

namespace App\Models;

class CertificationModel extends BaseModel
{
    protected $table         = 'certifications';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['name', 'image', 'issued_year', 'type', 'sort_order', 'status'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'name' => 'required|max_length[150]',
        'type' => 'permit_empty|in_list[certification,award]',
    ];
}
