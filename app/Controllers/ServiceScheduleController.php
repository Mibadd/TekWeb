<?php

namespace App\Controllers;

use App\Models\ServiceScheduleModel;

class ServiceScheduleController extends BaseController
{
    public function index()
    {
        $scheduleModel = new ServiceScheduleModel();
        $data['schedules'] = $scheduleModel->findAll();
        return view('service_schedule', $data);
    }

    public function create()
    {
        return view('service_schedule_form');
    }

    public function store()
    {
        $scheduleModel = new ServiceScheduleModel();
        $scheduleModel->insert([ 
            'user_id' => session()->get('user_id'),
            'service_date' => $this->request->getPost('service_date'),
            'service_type' => $this->request->getPost('service_type'),
            'status' => 'Belum Dilaksanakan'
        ]);

        return redirect()->to('/service-schedule');
    }
    
    public function show($id)
    {
        $scheduleModel = new ServiceScheduleModel();
        $schedule = $scheduleModel->find($id);

        if (!$schedule) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Jadwal dengan ID $id tidak ditemukan.");
        }

        $data['schedule'] = $schedule;
        return view('service_schedule_detail', $data);
    }


    public function delete($id)
    {
        $scheduleModel = new ServiceScheduleModel();
        $scheduleModel->delete($id);
        return redirect()->to('/service-schedule');
    }
}