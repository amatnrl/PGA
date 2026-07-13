<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductSpecificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'product_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'label'      => ['type' => 'varchar', 'constraint' => 100],
            'value'      => ['type' => 'varchar', 'constraint' => 255],
            'sort_order' => ['type' => 'int', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('product_id');
        $this->forge->addForeignKey('product_id', 'products', 'id', '', 'CASCADE');
        $this->forge->createTable('product_specifications');
    }

    public function down()
    {
        $this->forge->dropTable('product_specifications', true);
    }
}
