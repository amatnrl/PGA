<?php

namespace App\Models;

class ArticleModel extends BaseModel
{
    protected $table          = 'articles';
    protected $primaryKey     = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields  = [
        'title', 'slug', 'content', 'featured_image', 'updated_by', 'status', 'published_at',
    ];
    protected $useTimestamps  = true;

    protected $validationRules = [
        'title'  => 'required|max_length[220]',
        'status' => 'permit_empty|in_list[draft,published]',
    ];
}
