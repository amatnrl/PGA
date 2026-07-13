<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddContentToRecipesTable extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('content', 'recipes')) {
            $this->forge->addColumn('recipes', [
                'content' => ['type' => 'TEXT', 'null' => true, 'after' => 'slug'],
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('recipes', 'content');
    }
}
