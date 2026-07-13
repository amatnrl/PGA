<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Banners are hero-only now: just an image, display order, and status.
 */
class SimplifyBannersTable extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('banners', [
            'title', 'mobile_image', 'link_url', 'position', 'starts_at', 'ends_at',
        ]);
    }

    public function down()
    {
        $this->forge->addColumn('banners', [
            'title'        => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true, 'after' => 'id'],
            'mobile_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'image'],
            'link_url'     => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true, 'after' => 'mobile_image'],
            'position'     => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'hero', 'after' => 'link_url'],
            'starts_at'    => ['type' => 'DATETIME', 'null' => true],
            'ends_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
    }
}
