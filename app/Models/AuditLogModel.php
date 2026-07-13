<?php

namespace App\Models;

class AuditLogModel extends BaseModel
{
    protected $table         = 'audit_logs';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['user_id', 'action', 'model', 'model_id', 'old_data', 'new_data', 'ip_address'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
}
