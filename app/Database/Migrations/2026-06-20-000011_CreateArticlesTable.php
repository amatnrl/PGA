<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'title'            => ['type' => 'varchar', 'constraint' => 220],
            'slug'             => ['type' => 'varchar', 'constraint' => 240],
            'excerpt'          => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'content'          => ['type' => 'text', 'null' => true],
            'featured_image'   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'type'             => ['type' => 'varchar', 'constraint' => 20, 'default' => 'industri', 'comment' => 'industri|perusahaan|tips'],
            'status'           => ['type' => 'varchar', 'constraint' => 20, 'default' => 'draft'],
            'meta_title'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'meta_description' => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'meta_keywords'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'published_at'     => ['type' => 'datetime', 'null' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('slug');
        $this->forge->addKey('category_id');
        $this->forge->addKey('status');
        $this->forge->addForeignKey('category_id', 'categories', 'id', '', 'CASCADE');
        $this->forge->createTable('articles');
    }

    public function down()
    {
        $this->forge->dropTable('articles', true);
    }
}
