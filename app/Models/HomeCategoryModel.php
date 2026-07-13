<?php

namespace App\Models;

class HomeCategoryModel extends BaseModel
{
    protected $table         = 'home_categories';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['image', 'name', 'description', 'sort_order', 'status'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'image'  => 'required',
        'name'   => 'required|max_length[150]',
        'status' => 'permit_empty|in_list[active,inactive]',
    ];
}
