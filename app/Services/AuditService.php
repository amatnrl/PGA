<?php

namespace App\Services;

use App\Models\AuditLogModel;

class AuditService
{
    public function log(string $action, string $model, ?int $modelId, ?array $old = null, ?array $new = null): void
    {
        $request = service('request');
        $user     = auth()->user();

        (new AuditLogModel())->insert([
            'user_id'    => $user?->id,
            'action'     => $action,
            'model'      => $model,
            'model_id'   => $modelId,
            'old_data'   => $old !== null ? json_encode($old) : null,
            'new_data'   => $new !== null ? json_encode($new) : null,
            'ip_address' => $request->getIPAddress(),
        ]);
    }
}
