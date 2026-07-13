<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Re-adds video_url (dropped by SimplifyContentModules) so a recipe can show
 * an embedded video next to its description on the detail page.
 */
class AddVideoUrlToRecipes extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('video_url', 'recipes')) {
            $this->forge->addColumn('recipes', [
                'video_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'content'],
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('recipes', 'video_url');
    }
}
