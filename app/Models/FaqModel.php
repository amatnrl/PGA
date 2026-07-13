<?php

namespace App\Models;

class FaqModel extends BaseModel
{
    protected $table         = 'faqs';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['category', 'question', 'answer', 'sort_order', 'status'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'question' => 'required',
        'answer'   => 'required',
    ];
}
