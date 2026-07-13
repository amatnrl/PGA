<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePartnersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'varchar', 'constraint' => 150],
            'logo'        => ['type' => 'varchar', 'constraint' => 255],
            'website_url' => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'sort_order'  => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'status'      => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'created_at'  => ['type' => 'datetime', 'null' => true],
            'updated_at'  => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('partners');
    }

    public function down()
    {
        $this->forge->dropTable('partners', true);
    }
}
