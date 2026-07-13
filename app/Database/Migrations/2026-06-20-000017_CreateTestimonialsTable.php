<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTestimonialsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'varchar', 'constraint' => 150],
            'position'   => ['type' => 'varchar', 'constraint' => 150, 'null' => true],
            'company'    => ['type' => 'varchar', 'constraint' => 150, 'null' => true],
            'photo'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'content'    => ['type' => 'text'],
            'rating'     => ['type' => 'tinyint', 'constraint' => 1, 'default' => 5],
            'status'     => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'sort_order' => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'datetime', 'null' => true],
            'updated_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('testimonials');
    }

    public function down()
    {
        $this->forge->dropTable('testimonials', true);
    }
}
