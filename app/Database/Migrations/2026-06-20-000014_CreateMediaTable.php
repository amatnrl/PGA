<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMediaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'folder_id'     => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'file_name'     => ['type' => 'varchar', 'constraint' => 255],
            'original_name' => ['type' => 'varchar', 'constraint' => 255],
            'mime_type'     => ['type' => 'varchar', 'constraint' => 100],
            'size'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'path'          => ['type' => 'varchar', 'constraint' => 255],
            'webp_path'     => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'sizes'         => ['type' => 'text', 'null' => true],
            'alt_text'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'uploaded_by'   => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'trashed_at'    => ['type' => 'datetime', 'null' => true],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('folder_id');
        $this->forge->addForeignKey('folder_id', 'media_folders', 'id', '', 'CASCADE');
        $this->forge->createTable('media');
    }

    public function down()
    {
        $this->forge->dropTable('media', true);
    }
}
