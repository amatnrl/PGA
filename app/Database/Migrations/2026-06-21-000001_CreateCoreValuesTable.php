<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCoreValuesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'icon'        => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'title'       => ['type' => 'varchar', 'constraint' => 150],
            'description' => ['type' => 'text', 'null' => true],
            'sort_order'  => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'status'      => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('core_values');
    }

    public function down()
    {
        $this->forge->dropTable('core_values', true);
    }
}
