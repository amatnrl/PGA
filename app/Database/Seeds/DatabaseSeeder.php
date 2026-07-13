<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('App\Database\Seeds\ProductSeeder');
        $this->call('App\Database\Seeds\ContentSeeder');
        $this->call('App\Database\Seeds\SupportingDataSeeder');
    }
}
