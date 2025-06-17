<?php

namespace App\Models;

use CodeIgniter\Model;

class SukuCadangModel extends Model
{
    /**
     * Nama tabel yang dikelola oleh model ini.
     * Seharusnya 'sukucadang', bukan tabel relasi.
     */
    protected $table = 'sukucadang';
    protected $primaryKey = 'id';

    /**
     * Kolom yang diizinkan untuk diisi.
     * Properti ini hanya boleh dideklarasikan sekali.
     */
    protected $allowedFields = [
        'kode',
        'nama',
        'kategori',
        'stok',
        'harga',
        'status'
    ];

    /**
     * Mengaktifkan penggunaan timestamp otomatis (created_at, updated_at).
     */
    protected $useTimestamps = true;

    /**
     * Mengambil suku cadang yang stoknya menipis atau habis.
     *
     * @param int $batasStok Batas stok minimum.
     * @return array
     */
    public function getSukuCadangMenipis($batasStok = 5)
    {
        return $this->where('stok <=', $batasStok)->findAll();
    }
}
