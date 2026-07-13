<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropSortOrderFromBranchesTable extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('branches', 'sort_order');
    }

    public function down()
    {
        $this->forge->addColumn('branches', [
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'status',
            ],
        ]);
    }
}
