<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTaggablesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'tag_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'taggable_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'taggable_type'  => ['type' => 'varchar', 'constraint' => 30, 'comment' => 'insight|recipe|article|activity'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['taggable_type', 'taggable_id']);
        $this->forge->addKey('tag_id');
        $this->forge->addForeignKey('tag_id', 'tags', 'id', '', 'CASCADE');
        $this->forge->createTable('taggables');
    }

    public function down()
    {
        $this->forge->dropTable('taggables', true);
    }
}
