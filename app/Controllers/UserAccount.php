<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserAccount extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));

        if (!$user) {
            return redirect()->to('/auth/login');
        }

        return view('akun', [
        'username' => $user['name'],
        'email' => $user['email'],
        'registered_date' => date('d-m-Y', strtotime($user['created_at'])),
        'vehicle' => $user['vehicle'] ?? 'Tidak ada kendaraan',
        'photo' => $user['photo'] ?? '', // Tambahkan ini
        'status' => session()->get('isLoggedIn') ? 'Aktif' : 'Tidak Aktif',
    ]);
    }

    public function edit()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/auth/login');
    }

    $userModel = new UserModel();
    $user = $userModel->find(session()->get('user_id'));

    return view('edit_akun', [
        'username' => $user['name'],
        'email' => $user['email'],
        'vehicle' => $user['vehicle'] ?? '',
        'user' => $user
    ]);
}

public function update()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/auth/login');
    }

    $userModel = new UserModel();
    $user = $userModel->find(session()->get('user_id'));

    // Validasi data
    $name = $this->request->getPost('name');
    $vehicle = $this->request->getPost('vehicle');

    // Validasi dan Upload Foto
    $photo = $this->request->getFile('photo');
    $newPhotoName = $user['photo'] ?? 'nmax.jpg'; // Default gunakan foto lama jika tidak ada

    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
        $newPhotoName = $photo->getRandomName();
        $photo->move('image/', $newPhotoName);
    }

    // Update user data
    $userModel->update($user['id'], [
        'name' => $name,
        'vehicle' => $vehicle,
        'photo' => $newPhotoName
    ]);

    // Refresh session dengan data terbaru
    session()->set('user_name', $name);

    // Redirect ke halaman profil
    return redirect()->to('/useraccount')->with('success', 'Profil berhasil diperbarui');
}
}
