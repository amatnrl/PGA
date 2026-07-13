<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGalleriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category'   => ['type' => 'varchar', 'constraint' => 20, 'default' => 'factory', 'comment' => 'factory|office'],
            'image'      => ['type' => 'varchar', 'constraint' => 255],
            'caption'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'sort_order' => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'status'     => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('galleries');
    }

    public function down()
    {
        $this->forge->dropTable('galleries', true);
    }
}
