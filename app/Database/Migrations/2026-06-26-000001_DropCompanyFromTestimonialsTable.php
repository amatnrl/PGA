<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropCompanyFromTestimonialsTable extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('testimonials', 'company');
    }

    public function down()
    {
        $this->forge->addColumn('testimonials', [
            'company' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true, 'after' => 'position'],
        ]);
    }
}
