<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Many-to-many: a recipe can use several products, and a product can show
 * up in several recipes — surfaced as "Resep Terkait" on the product page.
 */
class CreateRecipeProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'recipe_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'product_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addPrimaryKey(['recipe_id', 'product_id']);
        $this->forge->addKey('product_id');
        $this->forge->createTable('recipe_products');
    }

    public function down()
    {
        $this->forge->dropTable('recipe_products', true);
    }
}
