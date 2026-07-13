<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'parent_id'   => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'type'        => ['type' => 'varchar', 'constraint' => 20, 'comment' => 'product|insight|recipe|article|activity'],
            'name'        => ['type' => 'varchar', 'constraint' => 150],
            'slug'        => ['type' => 'varchar', 'constraint' => 170],
            'description' => ['type' => 'text', 'null' => true],
            'image'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'sort_order'  => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'status'      => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('slug');
        $this->forge->addKey('type');
        $this->forge->addKey('parent_id');
        $this->forge->addForeignKey('parent_id', 'categories', 'id', '', 'CASCADE');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories', true);
    }
}
