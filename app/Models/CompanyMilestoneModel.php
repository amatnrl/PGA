<?php

namespace App\Models;

class CompanyMilestoneModel extends BaseModel
{
    protected $table         = 'company_milestones';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['year', 'title', 'description', 'sort_order', 'status'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'year'  => 'required|max_length[4]',
        'title' => 'required|max_length[200]',
    ];
}
