<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SukuCadangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode' => 'R001',
                'nama' => 'Rantai Sepeda MTB',
                'kategori' => 'Rantai',
                'stok' => 10,
                'harga' => 150000,
                'status' => 'Tersedia'
            ],
            // Tambahkan data lainnya...
        ];

        foreach ($data as $item) {
            $this->db->table('sukucadang')->insert($item);
        }
    }
}