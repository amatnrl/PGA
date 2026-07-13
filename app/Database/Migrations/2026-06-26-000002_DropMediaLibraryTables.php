<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropMediaLibraryTables extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('media', 'media_folder_id_foreign');
        $this->forge->dropForeignKey('media_folders', 'media_folders_parent_id_foreign');

        $this->forge->dropTable('media', true);
        $this->forge->dropTable('media_folders', true);
    }

    public function down()
    {
        // Media Library has been retired; not recreated.
    }
}
