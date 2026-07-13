<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBannersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'        => ['type' => 'varchar', 'constraint' => 200],
            'image'        => ['type' => 'varchar', 'constraint' => 255],
            'mobile_image' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'link_url'     => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'position'     => ['type' => 'varchar', 'constraint' => 30, 'default' => 'hero', 'comment' => 'hero|promo|other'],
            'sort_order'   => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'status'       => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'starts_at'    => ['type' => 'datetime', 'null' => true],
            'ends_at'      => ['type' => 'datetime', 'null' => true],
            'created_at'   => ['type' => 'datetime', 'null' => true],
            'updated_at'   => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('position');
        $this->forge->createTable('banners');
    }

    public function down()
    {
        $this->forge->dropTable('banners', true);
    }
}
