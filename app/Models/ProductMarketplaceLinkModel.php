<?php

namespace App\Models;

class ProductMarketplaceLinkModel extends BaseModel
{
    protected $table         = 'product_marketplace_links';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['product_id', 'platform', 'url'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'platform' => 'required|in_list[shopee,tokopedia,tiktok]',
        'url'      => 'permit_empty|valid_url_strict',
    ];
}
