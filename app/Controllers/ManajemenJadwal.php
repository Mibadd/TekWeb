<?php

namespace App\Controllers;

use App\Models\ServiceScheduleModel;
use App\Models\UserModel;

class ManajemenJadwal extends BaseController
{
    public function index()
    {
        $model = new ServiceScheduleModel();
        $data['schedules'] = $model->findAll();

        return view('admin/manajemenjadwal', $data);
    }


    // Tambahkan method add() di sini
    public function add()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('admin/jadwal/tambahjadwal', $data);
    }


    public function store()
    {
        $model = new ServiceScheduleModel();

        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'date' => $this->request->getPost('date'),
            'service_type' => $this->request->getPost('service_type'),
            'status' => $this->request->getPost('status'),
        ];

        $model->save($data);

        return redirect()->to('/manajemenjadwal');
    }

    // Tambahkan method edit() di sini
    public function edit($id)
    {
        $scheduleModel = new ServiceScheduleModel();
        $userModel = new UserModel();

        $data['schedule'] = $scheduleModel->find($id);
        $data['users'] = $userModel->findAll();

        return view('admin/jadwal/editjadwal', $data);
    }


    public function update($id)
    {
        $model = new ServiceScheduleModel();

        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'date' => $this->request->getPost('date'),
            'service_type' => $this->request->getPost('service_type'),
            'status' => $this->request->getPost('status'),
        ];

        $model->update($id, $data);

        return redirect()->to('/manajemenjadwal');
    }

    public function delete($id)
    {
        $model = new ServiceScheduleModel();
        $model->delete($id);

        return redirect()->to('/manajemenjadwal');
    }
}
