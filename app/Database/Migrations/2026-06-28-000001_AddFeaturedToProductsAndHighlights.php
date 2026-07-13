<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFeaturedToProductsAndHighlights extends Migration
{
    public function up()
    {
        $this->forge->addColumn('products', [
            'is_featured' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0, 'after' => 'status'],
        ]);

        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'varchar', 'constraint' => 150],
            'image'      => ['type' => 'varchar', 'constraint' => 255],
            'sort_order' => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'status'     => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('product_highlights');
    }

    public function down()
    {
        $this->forge->dropColumn('products', 'is_featured');
        $this->forge->dropTable('product_highlights', true);
    }
}
