<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $role = $session->get('user_role');

        if (!isset($role)) {
            return redirect()->to('/auth/login');
        }

        if (in_array('admin', $arguments) && $role !== 'admin') {
            return redirect()->to('/dashboard');
        }

        if (in_array('user', $arguments) && $role !== 'user') {
            return redirect()->to('/admindashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak diperlukan pengaturan khusus untuk after
    }
}
