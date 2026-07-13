<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    public function generateUniqueSlug(string $text, ?int $excludeId = null): string
    {
        helper('text');
        $slug = url_title(strtolower($text), '-', true);
        $original = $slug;
        $i = 1;

        while (true) {
            $builder = $this->where('slug', $slug);
            if ($excludeId !== null) {
                $builder->where('id !=', $excludeId);
            }
            if ($builder->countAllResults() === 0) {
                break;
            }
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }
}
