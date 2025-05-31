<?php

namespace App\Models;
use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'servis'; // Sesuaikan nama tabel
    protected $allowedFields = ['tanggal', 'nama_pelanggan', 'kendaraan', 'jenis_servis', 'total'];

    public function getLaporan($start = null, $end = null)
    {
        $builder = $this->db->table('servis');
        $builder->select('servis.tanggal, pelanggan.nama as nama_pelanggan, kendaraan.nama_kendaraan as kendaraan, servis.jenis_servis, servis.total');
        $builder->join('pelanggan', 'pelanggan.id = servis.pelanggan_id');
        $builder->join('kendaraan', 'kendaraan.id = servis.kendaraan_id'); // sesuaikan nama kolom


        if ($start && $end) {
            $builder->where('tanggal >=', $start);
            $builder->where('tanggal <=', $end);
        }

        return $builder->get()->getResultArray();
    }

    public function getTotalPendapatan($start = null, $end = null)
    {
        $builder = $this->builder();
        if ($start && $end) {
            $builder->where('tanggal >=', $start);
            $builder->where('tanggal <=', $end);
        }

        return $builder->selectSum('total')->get()->getRow()->total ?? 0;
    }
}
