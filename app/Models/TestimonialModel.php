<?php

namespace App\Models;

class TestimonialModel extends BaseModel
{
    protected $table         = 'testimonials';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['name', 'position', 'photo', 'content', 'rating', 'status', 'sort_order'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'name'    => 'required|max_length[150]',
        'content' => 'required',
        'rating'  => 'permit_empty|in_list[1,2,3,4,5]',
    ];
}
