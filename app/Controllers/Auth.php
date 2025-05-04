<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function login_post()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('isLoggedIn', true);
            session()->set('user', $user);
            return redirect()->to('/dashboard');
        }

        session()->setFlashdata('error', 'Invalid email or password');
        return redirect()->to('auth/login');
    }

    public function signup()
    {
        return view('signup');
    }

    public function signup_post()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (empty($name) || empty($email) || empty($password)) {
            session()->setFlashdata('error', 'All fields are required');
            return redirect()->to('auth/signup');
        }

        $userModel = new UserModel();
        if ($userModel->where('email', $email)->first()) {
            session()->setFlashdata('error', 'Email is already registered');
            return redirect()->to('auth/signup');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userModel->save([
            'name'     => $name,
            'email'    => $email,
            'password' => $hashedPassword,
        ]);

        session()->setFlashdata('success', 'Registration successful. Please login.');
        return redirect()->to('auth/login');
    }

    public function logout()
    {
        // Hapus session
        session()->destroy();

        // Redirect ke halaman login
        return redirect()->to('/auth/login')->with('success', 'You have been logged out.');
    }
}
