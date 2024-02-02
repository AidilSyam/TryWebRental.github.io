<?php

namespace App\Controllers;

use App\Models\MK_akun;
use App\Models\M_user;
use App\Models\M_pemilik;

class K_akun extends BaseController
{
    protected $MK_akun;
    protected $m_user;
    protected $m_pemilik;

    public function __construct()
    {
        $this->MK_akun = new MK_akun();
        $this->m_user = new M_user();
        $this->m_pemilik = new M_pemilik();
    }

    public function index()
    {
        //return view('V_Pemilik/akun');

        // Periksa apakah pengguna sudah login
        if (!session()->has('id_user')) {
            return redirect()->to('/');
        }

        // Ambil ID pengguna yang sedang login
        $id_user = session()->get('id_user');

        // Dapatkan data pengguna
        $userData = $this->m_user->find($id_user);

        // Periksa peran pengguna
        if ($userData && $userData['role'] == 'pengguna') {
            $data['data_klien'] = $this->MK_akun->getDataKlienByIdUser($id_user);
            $data['user'] = $this->MK_akun->getdatauser($id_user);
            // Tampilkan data akun
            return view('/Pages/akun', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id_pengguna)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->has('id_user')) {
            return redirect()->to('/');
        }

        // Ambil ID pengguna yang sedang login
        $id_user = session()->get('id_user');

        // Dapatkan data pengguna
        $userData = $this->m_user->find($id_user);

        // Periksa peran pengguna
        if ($userData && $userData['role'] == 'pengguna') {
            $image = $this->request->getFile('fotoktp');
            $existingData = $this->MK_akun->find($id_pengguna);

            if ($image->isValid() && !$image->hasMoved()) {

                $newImageName = $this->MK_akun->uploadImage($image);

                $data = [
                    'nama' => $this->request->getPost('nama'),
                    'gender' => $this->request->getPost('gender'),
                    'tlp' => $this->request->getPost('tlp'),
                    'email' => $this->request->getPost('email'),
                    'noktp' => $this->request->getPost('noktp'),
                    'alamat' => $this->request->getPost('alamat'),
                    'fotoktp' => $newImageName,
                    'id_user' => $id_user
                ];
            } else {
                // Jika tidak ada perubahan, tetap gunakan file gambar yang sudah ada
                $data = [
                    // ... data lain yang diubah
                    'fotoktp' => $existingData['fotoktp'], // Gunakan kembali nama file gambar yang sudah ada
                    // ...
                ];
            }
        }
        //tambahkan data mobil ke database
        $this->MK_akun->updatePost($id_pengguna, $data);
        // Redirect kembali ke halaman data akun
        return redirect()->to(base_url('/akun'))->with('success', 'Data Berhasil Diperbaharui');
    }

    public function edit_pengaturan($id_user)
    {
        // Periksa apakah pengguna sudah login
        if (!session()->has('id_user')) {
            return redirect()->to('/');
        }

        // Ambil ID pengguna yang sedang login
        $id_user = session()->get('id_user');

        // Dapatkan data pengguna
        $userData = $this->m_user->find($id_user);

        // Periksa peran pengguna
        if ($userData && $userData['role'] == 'pengguna') {
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ];
        }
        //tambahkan data mobil ke database
        $this->m_user->update($id_user, $data);
        // Redirect kembali ke halaman data akun
        return redirect()->to(base_url('/akun'))->with('success', 'Pengaturan Berhasil Diperbaharui');
    }
}
