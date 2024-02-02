<?php

namespace App\Controllers;

use App\Models\M_pemilik;

class MasterPemilik extends BaseController
{

    protected $pemilik;

    function __construct()
    {
        $this->pemilik = new M_pemilik();
    }

    //--------------------------------------------------------------------
    public function index()
    {
        $data['data_pemilik_kendaraan'] = $this->pemilik->getDataPemilik();
        $data['user'] = $this->pemilik->getDataUser();

        return view('Dasboards/masterpemilik', $data);
    }

    public function tambah()
    {
        $image = $this->request->getFile('foto_pemilik');

        // Periksa apakah file diunggah
        if ($image && !$image->hasMoved()) {
            if ($image->isValid()) {
                $newImageName = $this->pemilik->uploadImage($image);
                $dataPemilik = [
                    'nama' => $this->request->getPost('nama'),
                    'gender' => $this->request->getPost('gender'),
                    'tlp' => $this->request->getPost('tlp'),
                    'email' => $this->request->getPost('email'),
                    'noktp' => $this->request->getPost('noktp'),
                    'foto_pemilik' => $newImageName,
                    'alamat' => $this->request->getPost('alamat'),
                    'id_user' => $this->request->getPost('id_user')
                ];

                $userData = [
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'role' => $this->request->getPost('role')
                ];

                $userId = $this->pemilik->insertUserData($userData);

                if ($userId) {
                    $dataPemilik['id_user'] = $userId;
                    $this->pemilik->insertDataPemilik($dataPemilik);
                }
                return redirect()->to('/admin/Dasboards/masterpemilik')->with('success', 'Data Berhasil Ditambah');
            } else {
                return redirect()->to('/admin/Dasboards/masterpemilik')->with('errors', 'Data Gagal Ditambah');
            }
        }
    }

    public function edit($id_pemilik)
    {
        $image = $this->request->getFile('foto_pemilik');
        $existingData = $this->pemilik->find($id_pemilik);

        if ($image && !$image->hasMoved()) {
            if ($image->isValid()) {
                $newImageName = $this->pemilik->uploadImage($image);
            } else {
                $newImageName = $existingData['foto_pemilik'];
            }

            $dataPemilik = [
                'nama' => $this->request->getPost('nama'),
                'gender' => $this->request->getPost('gender'),
                'tlp' => $this->request->getPost('tlp'),
                'email' => $this->request->getPost('email'),
                'noktp' => $this->request->getPost('noktp'),
                'foto_pemilik' => $newImageName,
                'alamat' => $this->request->getPost('alamat')
                // Hapus 'id_user' dari data yang akan diupdate
            ];

            // Dapatkan 'id_user' dari data yang ada
            $userData = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'role' => $this->request->getPost('role')
                // Tetapkan 'id_user' yang ada pada data sebelumnya
            ];

            $this->pemilik->UpdateDataPemilik($id_pemilik, $dataPemilik);
            $this->pemilik->updateUserData($existingData['id_user'], $userData);
            return redirect()->to('/admin/Dasboards/masterpemilik')->with('success', 'Data Berhasil Diperbaharui');
        }
    }

    public function hapus($id_pemilik)
    {
        // Dapatkan data pemilik berdasarkan ID
        $pemilikData = $this->pemilik->find($id_pemilik);

        if ($pemilikData) {
            $userId = $pemilikData['id_user']; // Dapatkan ID pengguna yang terkait

            // Hapus data pemilik dari tabel 'data_pemilik_kendaraan'
            $this->pemilik->deletePost($id_pemilik);

            // Hapus data pengguna dari tabel 'user' berdasarkan ID pengguna yang terkait
            $this->pemilik->deleteUserData($userId);

            return redirect()->to('/admin/Dasboards/masterpemilik')->with('success', 'Data Berhasil Dihapus');
        }
    }
}
