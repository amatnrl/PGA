<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Real-world video share links (YouTube/TikTok with tracking params) often
 * exceed 255 chars — widen the column so valid URLs aren't rejected.
 */
class WidenVideoUrlOnRecipes extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('recipes', [
            'video_url' => ['name' => 'video_url', 'type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('recipes', [
            'video_url' => ['name' => 'video_url', 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
    }
}
