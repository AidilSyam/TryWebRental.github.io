<?php

namespace App\Controllers;

use App\Models\MP_akun;
use App\Models\M_user;
use App\Models\M_pemilik;

class P_akun extends BaseController
{
    protected $MP_akun;
    protected $m_user;
    protected $m_pemilik;

    public function __construct()
    {
        $this->MP_akun = new MP_akun();
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
        if ($userData && $userData['role'] == 'pemilik_kendaraan') {
            $data['data_pemilik_kendaraan'] = $this->MP_akun->getDataPemilikByIdUser($id_user);
            $data['user'] = $this->MP_akun->getdatauser($id_user);
            // Tampilkan data akun
            return view('V_Pemilik/akun', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function edit($id_pemilik)
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
        if ($userData && $userData['role'] == 'pemilik_kendaraan') {
            $image = $this->request->getFile('foto_pemilik');
            $existingData = $this->MP_akun->find($id_pemilik);

            if ($image->isValid() && !$image->hasMoved()) {

                $newImageName = $this->MP_akun->uploadImage($image);

                $data = [
                    'nama' => $this->request->getPost('nama'),
                    'gender' => $this->request->getPost('gender'),
                    'tlp' => $this->request->getPost('tlp'),
                    'email' => $this->request->getPost('email'),
                    'noktp' => $this->request->getPost('noktp'),
                    'alamat' => $this->request->getPost('alamat'),
                    'foto_pemilik' => $newImageName,
                    'id_user' => $id_user
                ];
            } else {
                // Jika tidak ada perubahan, tetap gunakan file gambar yang sudah ada
                $data = [
                    // ... data lain yang diubah
                    'foto_pemilik' => $existingData['foto_pemilik'], // Gunakan kembali nama file gambar yang sudah ada
                    // ...
                ];
            }
        }
        //tambahkan data mobil ke database
        $this->MP_akun->updatePost($id_pemilik, $data);
        // Redirect kembali ke halaman data akun
        return redirect()->to('/pemilik/V_Pemilik/akun')->with('success', 'Data Berhasil Diperbaharui');
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
        if ($userData && $userData['role'] == 'pemilik_kendaraan') {
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ];
        }
        //tambahkan data mobil ke database
        $this->m_user->update($id_user, $data);
        // Redirect kembali ke halaman data akun
        return redirect()->to('/pemilik/V_Pemilik/akun')->with('success', 'Pengaturan Berhasil Diperbaharui');
    }
}
