<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Lets a "Foto Hasil Produk" image be linked to the matching recipe, so
 * visitors can click through from the product page straight to the recipe.
 * No FK constraint — the relation is optional and resolved defensively
 * (checked against the recipes table) rather than enforced at the DB level.
 */
class AddRecipeIdToProductImages extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product_images', [
            'recipe_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'kind'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('product_images', 'recipe_id');
    }
}
