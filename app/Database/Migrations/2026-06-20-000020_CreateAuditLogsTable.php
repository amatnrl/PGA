<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuditLogsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'action'     => ['type' => 'varchar', 'constraint' => 50, 'comment' => 'create|update|delete|login|logout'],
            'model'      => ['type' => 'varchar', 'constraint' => 100, 'null' => true],
            'model_id'   => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'old_data'   => ['type' => 'text', 'null' => true],
            'new_data'   => ['type' => 'text', 'null' => true],
            'ip_address' => ['type' => 'varchar', 'constraint' => 45, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('user_id');
        $this->forge->addKey(['model', 'model_id']);
        $this->forge->createTable('audit_logs');
    }

    public function down()
    {
        $this->forge->dropTable('audit_logs', true);
    }
}
