<?php

namespace App\Models;

class BranchModel extends BaseModel
{
    protected $table         = 'branches';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'region',
        'city',
        'status',
    ];

    protected $validationRules = [
        'region' => 'required|max_length[120]',
        'city'   => 'required|max_length[120]',
        'status' => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'region' => [
            'required' => 'Wilayah wajib diisi.',
        ],
        'city' => [
            'required' => 'Nama cabang/kota wajib diisi.',
        ],
        'status' => [
            'in_list' => 'Status tidak valid.',
        ],
    ];
}
