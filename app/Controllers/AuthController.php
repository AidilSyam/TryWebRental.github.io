<?php

namespace App\Controllers;

use App\Models\M_user;

class AuthController extends BaseController
{
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new M_user();

        //$userData = $userModel->select('password, role')->where('username', $username)->first();
        $userData = $userModel->checkLogin($username, $password);

        if ($userData) {

            session()->set('id_user', $userData['id_user']);
            session()->set('username', $userData['username']);
            session()->set('role', $userData['role']);

            switch ($userData['role']) {
                    // ...
                case 'admin':
                    return redirect()->to(base_url('admin/Dasboards')); // Redirect ke halaman Dashboard
                    break;
                case 'pemilik_kendaraan':
                    return redirect()->to(base_url('pemilik/V_Pemilik'));
                    break;
                case 'pengguna':
                    return redirect()->to(base_url('home'));
                    break;
                default:
                    return redirect()->to('/');
                    break;
            }
        } else {
            return redirect()->to(base_url('login'))->with('error', 'Gagal Login. Username dan password salah.');
        }
    }

    public function logout()
    {
        // Lakukan proses logout di sini, seperti menghapus data dari session
        session()->remove(['id_user', 'username', 'role']);
        return redirect()->to(base_url('/home'));
    }
}
