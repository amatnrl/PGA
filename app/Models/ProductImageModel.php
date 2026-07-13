<?php

namespace App\Models;

class ProductImageModel extends BaseModel
{
    protected $table         = 'product_images';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['product_id', 'kind', 'path', 'alt_text', 'is_primary', 'sort_order'];
    protected $useTimestamps = false;
}
