<?php

namespace App\Models; //Menentukan bahwa class ini berada di folder Models.
use CodeIgniter\Model; //Mengimpor class Model dari CodeIgniter sebagai parent class, agar bisa menggunakan fitur ORM bawaan (seperti builder, db, dll).

class LaporanModel extends Model //Mendeklarasikan model dengan nama LaporanModel, turunan dari CodeIgniter\Model.
{
    protected $table = 'payments'; // Tetap ambil dari tabel payments
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'service_id', 'payment_method', 'payment_proof', 'payment_status', 'total_amount'];

    public function getLaporan($start = null, $end = null)
{
    $builder = $this->db->table('payments p');
    $builder->select('j.tanggal AS tanggal, u.name AS nama_pelanggan, j.jenis_motor AS kendaraan, j.jenis_servis, p.total_amount AS total');
    $builder->join('users u', 'u.id = p.user_id');
    $builder->join('jadwal_servis j', 'j.id = p.service_id');
    $builder->where('u.role', 'user');

    if ($start && $end) {
        $builder->where('j.tanggal >=', $start);
        $builder->where('j.tanggal <=', $end);
    }

    return $builder->get()->getResultArray();
}



public function getTotalPendapatan($start = null, $end = null)
{
    $builder = $this->db->table('payments p')
        ->selectSum('p.total_amount')
        ->join('users u', 'u.id = p.user_id')
        ->join('jadwal_servis j', 'j.id = p.service_id')
        ->where('u.role', 'user');

    if ($start && $end) {
        $builder->where('j.tanggal >=', $start);
        $builder->where('j.tanggal <=', $end);
    }

    $result = $builder->get()->getRow();
    return $result->total_amount ?? 0;
}


    public function getServisPerBulan()
{
    return $this->db->table('payments p')
        ->select("DATE_FORMAT(j.tanggal, '%M %Y') as bulan, COUNT(*) as jumlah")
        ->join('users u', 'u.id = p.user_id')
        ->join('jadwal_servis j', 'j.id = p.service_id')
        ->where('u.role', 'user')
        ->groupBy("DATE_FORMAT(j.tanggal, '%Y-%m')")
        ->orderBy("MIN(j.tanggal)", 'ASC')
        ->get()
        ->getResultArray();
}


public function countAllServis()
{
    return $this->db->table('payments')
        ->join('users', 'users.id = payments.user_id')
        ->where('users.role', 'user')
        ->countAllResults();
}



public function countPendingRequestsHariIni()
{
    return $this->db->table('payments p')
        ->join('users u', 'u.id = p.user_id')
        ->join('jadwal_servis j', 'j.id = p.service_id')
        ->where('u.role', 'user')
        ->where('DATE(j.tanggal)', date('Y-m-d'))
        ->countAllResults();
}


public function getPendapatanPerBulan()
{
    return $this->db->query("
        SELECT 
            DATE_FORMAT(j.tanggal, '%M %Y') AS bulan, 
            SUM(p.total_amount) AS total
        FROM payments p
        JOIN jadwal_servis j ON j.id = p.service_id
        JOIN users u ON u.id = p.user_id
        WHERE u.role = 'user'
        GROUP BY DATE_FORMAT(j.tanggal, '%Y-%m')
        ORDER BY MIN(j.tanggal)
    ")->getResultArray();
}


}
