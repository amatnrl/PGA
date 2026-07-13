<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactMessagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'varchar', 'constraint' => 150],
            'email'      => ['type' => 'varchar', 'constraint' => 150],
            'phone'      => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'subject'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'message'    => ['type' => 'text'],
            'status'     => ['type' => 'varchar', 'constraint' => 20, 'default' => 'new', 'comment' => 'new|read|replied'],
            'created_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->createTable('contact_messages');
    }

    public function down()
    {
        $this->forge->dropTable('contact_messages', true);
    }
}
