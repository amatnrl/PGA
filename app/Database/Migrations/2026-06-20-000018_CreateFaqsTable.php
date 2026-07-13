<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFaqsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category'   => ['type' => 'varchar', 'constraint' => 100, 'null' => true],
            'question'   => ['type' => 'varchar', 'constraint' => 500],
            'answer'     => ['type' => 'text'],
            'sort_order' => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'status'     => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('faqs');
    }

    public function down()
    {
        $this->forge->dropTable('faqs', true);
    }
}
