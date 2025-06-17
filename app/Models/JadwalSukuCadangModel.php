<?php

// app/Models/JadwalSukuCadangModel.php
namespace App\Models;

use CodeIgniter\Model;

class JadwalSukuCadangModel extends Model
{
    protected $table = 'jadwal_sukucadang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jadwal_id', 'sukucadang_id', 'jumlah'];

    public function getDetailByJadwal($jadwalId)
{
    $rawData = $this->select('sukucadang.id AS suku_id, sukucadang.nama, sukucadang.harga, jadwal_sukucadang.jumlah')
                    ->join('sukucadang', 'sukucadang.id = jadwal_sukucadang.sukucadang_id')
                    ->where('jadwal_sukucadang.jadwal_id', $jadwalId)
                    ->findAll();

    // Gabungkan jika ada suku cadang yang sama
    $gabung = [];

    foreach ($rawData as $item) {
        $id = $item['suku_id'];
        if (!isset($gabung[$id])) {
            $gabung[$id] = [
                'nama' => $item['nama'],
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['harga'] * $item['jumlah']
            ];
        } else {
            $gabung[$id]['jumlah'] += $item['jumlah'];
            $gabung[$id]['subtotal'] += $item['harga'] * $item['jumlah'];
        }
    }

    return array_values($gabung); // reset index numerik
}


}
