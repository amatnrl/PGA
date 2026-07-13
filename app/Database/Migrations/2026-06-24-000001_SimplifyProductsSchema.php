<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SimplifyProductsSchema extends Migration
{
    public function up()
    {
        // products: drop category FK + bloat fields, add a fixed product "type".
        $this->forge->dropForeignKey('products', 'products_category_id_foreign');

        $this->db->disableForeignKeyChecks();
        $this->forge->dropColumn('products', [
            'category_id', 'sku', 'short_description', 'usage_guide', 'video_url',
            'catalog_pdf', 'is_featured', 'is_bestseller', 'is_new',
            'meta_title', 'meta_description', 'meta_keywords', 'og_image', 'views_count',
        ]);
        $this->db->enableForeignKeyChecks();

        $this->forge->addColumn('products', [
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'default'    => 'lainnya',
                'after'      => 'id',
            ],
        ]);

        // product_images: distinguish "foto produk" vs "foto hasil produk".
        $this->forge->addColumn('product_images', [
            'kind' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'product',
                'after'      => 'product_id',
            ],
        ]);

        // No longer used: benefits / specifications were removed from the product form.
        $this->forge->dropTable('product_benefits', true);
        $this->forge->dropTable('product_specifications', true);
    }

    public function down()
    {
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'product_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'text'       => ['type' => 'varchar', 'constraint' => 255],
            'sort_order' => ['type' => 'int', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('product_id');
        $this->forge->addForeignKey('product_id', 'products', 'id', '', 'CASCADE');
        $this->forge->createTable('product_benefits');

        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'product_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'label'      => ['type' => 'varchar', 'constraint' => 100],
            'value'      => ['type' => 'varchar', 'constraint' => 255],
            'sort_order' => ['type' => 'int', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('product_id');
        $this->forge->addForeignKey('product_id', 'products', 'id', '', 'CASCADE');
        $this->forge->createTable('product_specifications');

        $this->forge->dropColumn('product_images', 'kind');

        $this->forge->dropColumn('products', 'type');

        $this->forge->addColumn('products', [
            'category_id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'after' => 'id'],
            'sku'               => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'short_description' => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'usage_guide'       => ['type' => 'text', 'null' => true],
            'video_url'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'catalog_pdf'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'is_featured'       => ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
            'is_bestseller'     => ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
            'is_new'            => ['type' => 'tinyint', 'constraint' => 1, 'default' => 0],
            'meta_title'        => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'meta_description'  => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'meta_keywords'     => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'og_image'          => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'views_count'       => ['type' => 'int', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addForeignKey('category_id', 'categories', 'id', '', 'CASCADE');
    }
}
