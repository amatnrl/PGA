<?php

namespace App\Models;

class BannerModel extends BaseModel
{
    protected $table         = 'banners';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['image', 'sort_order', 'status'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'image'  => 'required',
        'status' => 'permit_empty|in_list[active,inactive]',
    ];
}
