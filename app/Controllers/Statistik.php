<?php

namespace App\Controllers;

use App\Models\StatistikModel;

class Statistik extends BaseController
{
    public function index()
    {
        $model = new StatistikModel();

        $data = [
            'total_users' => $model->getTotalUsers(),
            'per_hari'     => $model->getCustomerPerHari()['id'],
            'per_bulan'    => $model->getCustomerPerBulan()['id'],
            'per_tahun'    => $model->getCustomerPerTahun()['id'],
        ];

        return view('statistik_view', $data);
    }
}
