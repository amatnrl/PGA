<?php

namespace App\Models;

class TeamMemberModel extends BaseModel
{
    protected $table         = 'team_members';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['name', 'position', 'photo', 'sort_order', 'status'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'name' => 'required|max_length[150]',
    ];
}
