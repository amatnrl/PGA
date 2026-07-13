<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductMarketplaceLinksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'product_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'platform'   => ['type' => 'varchar', 'constraint' => 20, 'comment' => 'shopee|tokopedia|tiktok'],
            'url'        => ['type' => 'varchar', 'constraint' => 500],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['product_id', 'platform']);
        $this->forge->addForeignKey('product_id', 'products', 'id', '', 'CASCADE');
        $this->forge->createTable('product_marketplace_links');
    }

    public function down()
    {
        $this->forge->dropTable('product_marketplace_links', true);
    }
}
