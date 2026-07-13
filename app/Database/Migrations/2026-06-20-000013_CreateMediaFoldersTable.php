<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMediaFoldersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'parent_id'  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'name'       => ['type' => 'varchar', 'constraint' => 150],
            'created_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('parent_id');
        $this->forge->addForeignKey('parent_id', 'media_folders', 'id', '', 'CASCADE');
        $this->forge->createTable('media_folders');
    }

    public function down()
    {
        $this->forge->dropTable('media_folders', true);
    }
}
