<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'type'             => ['type' => 'varchar', 'constraint' => 20, 'comment' => 'event|csr|seminar|workshop|pameran'],
            'title'            => ['type' => 'varchar', 'constraint' => 220],
            'slug'             => ['type' => 'varchar', 'constraint' => 240],
            'excerpt'          => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'content'          => ['type' => 'text', 'null' => true],
            'location'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'event_date'       => ['type' => 'date', 'null' => true],
            'featured_image'   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'gallery'          => ['type' => 'text', 'null' => true],
            'status'           => ['type' => 'varchar', 'constraint' => 20, 'default' => 'draft'],
            'meta_title'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'meta_description' => ['type' => 'varchar', 'constraint' => 500, 'null' => true],
            'meta_keywords'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
            'deleted_at'       => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('slug');
        $this->forge->addKey('type');
        $this->forge->addKey('status');
        $this->forge->createTable('activities');
    }

    public function down()
    {
        $this->forge->dropTable('activities', true);
    }
}
