<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'name'              => ['type' => 'varchar', 'constraint' => 200],
            'slug'              => ['type' => 'varchar', 'constraint' => 220],
            'sku'               => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'short_description' => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'description'       => ['type' => 'text', 'null' => true],
            'usage_guide'       => ['type' => 'text', 'null' => true],
            'video_url'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'catalog_pdf'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'status'            => ['type' => 'varchar', 'constraint' => 20, 'default' => 'active'],
            'is_featured'       => ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
            'is_bestseller'     => ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
            'is_new'            => ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
            'meta_title'        => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'meta_description'  => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'meta_keywords'     => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'og_image'          => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'views_count'       => ['type' => 'int', 'constraint' => 11, 'default' => 0],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
            'deleted_at'        => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('slug');
        $this->forge->addKey('category_id');
        $this->forge->addKey('status');
        $this->forge->addForeignKey('category_id', 'categories', 'id', '', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products', true);
    }
}
