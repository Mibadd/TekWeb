<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        return view('dashboard');
    }
}
