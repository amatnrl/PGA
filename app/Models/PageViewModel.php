<?php

namespace App\Models;

class PageViewModel extends BaseModel
{
    protected $table         = 'page_views';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['url', 'ip_address', 'user_agent'];
    protected $useTimestamps = true;
    protected $updatedField  = '';
}
