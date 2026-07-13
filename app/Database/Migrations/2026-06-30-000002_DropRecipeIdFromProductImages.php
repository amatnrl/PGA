<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Superseded by the recipe_products many-to-many relation (a recipe can use
 * several products, and is linked once — not per individual result photo).
 */
class DropRecipeIdFromProductImages extends Migration
{
    public function up()
    {
        if ($this->db->fieldExists('recipe_id', 'product_images')) {
            $this->forge->dropColumn('product_images', 'recipe_id');
        }
    }

    public function down()
    {
        $this->forge->addColumn('product_images', [
            'recipe_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'kind'],
        ]);
    }
}
