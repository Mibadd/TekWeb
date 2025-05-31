<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use CodeIgniter\HTTP\UploadedFile;

class PaymentController extends BaseController
{
    public function history()
    {
        $paymentModel = new PaymentModel();
        $user_id = session()->get('user_id');
        
        // Mendapatkan riwayat pembayaran pengguna
        $payments = $paymentModel->where('user_id', $user_id)->findAll();

        return view('payment_history', ['payments' => $payments]);
    }
    
    public function index()
    {
        return view('payment_form');
    }

    public function process()
    {
        $paymentModel = new PaymentModel();

        $paymentData = [
            'user_id' => session()->get('user_id'),
            'service_id' => $this->request->getPost('service_id'),
            'payment_method' => $this->request->getPost('payment_method'),
            'total_amount' => $this->request->getPost('total_amount'),
            'payment_status' => 'Pending'
        ];

        $proof = $this->request->getFile('payment_proof');
        if ($proof && $proof->isValid() && !$proof->hasMoved()) {
            $newName = $proof->getRandomName();
            $proof->move('uploads/payment_proofs/', $newName);
            $paymentData['payment_proof'] = 'uploads/payment_proofs/' . $newName;
        }

        $paymentModel->insert($paymentData);

        return redirect()->to('/payment')->with('success', 'Pembayaran berhasil dikirim. Menunggu konfirmasi.');
    }
}
