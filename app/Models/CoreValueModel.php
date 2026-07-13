<?php

namespace App\Models;

class CoreValueModel extends BaseModel
{
    protected $table         = 'core_values';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['icon', 'title', 'description', 'sort_order', 'status'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'title' => 'required|max_length[150]',
    ];
}
