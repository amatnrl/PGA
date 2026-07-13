<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropContactMessagesTable extends Migration
{
    public function up()
    {
        $this->forge->dropTable('contact_messages', true);
    }

    public function down()
    {
        // Contact inbox has been retired in favor of a simple contact-info editor.
    }
}
