<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompanyMilestonesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'year'        => ['type' => 'varchar', 'constraint' => 4],
            'title'       => ['type' => 'varchar', 'constraint' => 200],
            'description' => ['type' => 'text', 'null' => true],
            'sort_order'  => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'status'      => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('company_milestones');
    }

    public function down()
    {
        $this->forge->dropTable('company_milestones', true);
    }
}
