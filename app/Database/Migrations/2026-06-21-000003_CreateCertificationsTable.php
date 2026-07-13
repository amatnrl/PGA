<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCertificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'varchar', 'constraint' => 150],
            'image'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'issued_year' => ['type' => 'varchar', 'constraint' => 4, 'null' => true],
            'type'        => ['type' => 'varchar', 'constraint' => 20, 'default' => 'certification', 'comment' => 'certification|award'],
            'sort_order'  => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'status'      => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('certifications');
    }

    public function down()
    {
        $this->forge->dropTable('certifications', true);
    }
}
