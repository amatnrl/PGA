<?php

namespace App\Models;

class GalleryModel extends BaseModel
{
    protected $table         = 'galleries';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['category', 'image', 'caption', 'sort_order', 'status'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'category' => 'required|in_list[factory,office]',
        'image'    => 'required',
    ];
}
