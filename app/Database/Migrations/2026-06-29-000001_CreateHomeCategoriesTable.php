<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Home "category" tiles (section 4): image + category name + short description.
 */
class CreateHomeCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'image'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 150],
            'description' => ['type' => 'TEXT', 'null' => true],
            'sort_order'  => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'status'      => ['type' => 'ENUM', 'constraint' => ['active', 'inactive'], 'default' => 'active'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('home_categories');
    }

    public function down()
    {
        $this->forge->dropTable('home_categories');
    }
}
