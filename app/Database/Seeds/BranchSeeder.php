<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Maluku Utara' => [
                'Ternate',
            ],
            'Sulawesi Tengah' => [
                'Palu',
                'Poso',
                'Luwuk',
                'Parigi',
                'Morowali',
                'Wonomulyo',
                'Malili',
                'Banggai',
                'Ampana Kota',
            ],
            'Sulawesi Barat' => [
                'Polewali Mandar',
                'Mamasa',
                'Mamuju',
                'Majene',
                'Pasangkayu',
            ],
            'Sulawesi Tenggara' => [
                'Kendari',
                'Kolaka',
                'Bau-Bau',
                'Buton',
                'Pulau Kabaena',
                'Pulau Muna',
                'Kolaka Utara',
                'Bombana',
                'Konawe',
            ],
            'Sulawesi Selatan' => [
                'Bantaeng',
                'Barru',
                'Bone',
                'Bulukumba',
                'Enrekang',
                'Gowa',
                'Jeneponto',
                'Kepulauan Selayar',
                'Luwu',
                'Luwu Timur',
                'Luwu Utara',
                'Maros',
                'Pangkajene dan Kepulauan',
                'Pinrang',
                'Sidenreng Rappang',
                'Sinjai',
                'Soppeng',
                'Takalar',
                'Tana Toraja',
                'Toraja Utara',
                'Wajo',
                'Makassar',
                'Palopo',
                'Parepare',
            ],
        ];

        $now  = date('Y-m-d H:i:s');
        $rows = [];

        foreach ($data as $region => $cities) {
            foreach ($cities as $city) {
                $rows[] = [
                    'region'     => $region,
                    'city'       => $city,
                    'status'     => 'active',
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        $this->db->table('branches')->insertBatch($rows);
    }
}
