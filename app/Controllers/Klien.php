<?php

namespace App\Controllers;

use App\Models\M_klien;

class Klien extends BaseController
{

    protected $klien;

    function __construct()
    {
        $this->klien = new M_klien();
    }

    //--------------------------------------------------------------------
    public function index()
    {
        //$data['data_client'] = $this->user->getDataClient();
        $data['data_klien'] = $this->klien->getDataPelanggan();
        //$data['user'] = $this->klien->getDataUser();

        return view('Dasboards/masterpelanggan', $data);
        //return redirect()->to(base_url('/admin/Dasboards/masterpelanggan'))->with('success', 'Data Added Successfully');
    }

    public function tambah()
    {
        $image = $this->request->getFile('fotoktp');

        // Periksa apakah file diunggah
        if ($image && !$image->hasMoved()) {
            if ($image->isValid()) {
                $newImageName = $this->klien->uploadImage($image);
                $dataPengguna = [
                    'nama' => $this->request->getPost('nama'),
                    'gender' => $this->request->getPost('gender'),
                    'tlp' => $this->request->getPost('tlp'),
                    'email' => $this->request->getPost('email'),
                    'noktp' => $this->request->getPost('noktp'),
                    'fotoktp' => $newImageName,
                    'alamat' => $this->request->getPost('alamat'),
                    'id_user' => $this->request->getPost('id_user'),
                ];

                $userData = [
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'role' => $this->request->getPost('role')
                ];

                $userId = $this->klien->insertUserData($userData);

                if ($userId) {
                    $dataPengguna['id_user'] = $userId;
                    $this->klien->insertDataPelanggan($dataPengguna);
                }
                return redirect()->to('/admin/Dasboards/masterpelanggan')->with('success', 'Data Berhasil Ditambah');
            } else {
                return redirect()->to('/admin/Dasboards/masterpelanggan')->with('errors', 'Data Gagal Ditambah');
            }
        }
    }

    public function edit($id_pengguna)
    {
        $image = $this->request->getFile('fotoktp');
        $existingData = $this->klien->find($id_pengguna);

        if ($image && !$image->hasMoved()) {
            if ($image->isValid()) {
                $newImageName = $this->klien->uploadImage($image);
            } else {
                $newImageName = $existingData['fotoktp'];
            }

            $dataPengguna = [
                'nama' => $this->request->getPost('nama'),
                'gender' => $this->request->getPost('gender'),
                'tlp' => $this->request->getPost('tlp'),
                'email' => $this->request->getPost('email'),
                'noktp' => $this->request->getPost('noktp'),
                'fotoktp' => $newImageName,
                'alamat' => $this->request->getPost('alamat'),
                'id_user' => $this->request->getPost('id_user'),
            ];

            $userData = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'role' => $this->request->getPost('role')
            ];

            $this->klien->UpdateDataPelanggan($id_pengguna, $dataPengguna);
            $this->klien->updateUserData($existingData['id_user'], $userData);
            return redirect()->to('/admin/Dasboards/masterpelanggan')->with('success', 'Data Berhasil Diperbaharui');
        }
    }

    public function hapus($id_pengguna)
    {
        // Dapatkan data pemilik berdasarkan ID
        $dataPengguna = $this->klien->find($id_pengguna);

        if ($dataPengguna) {
            $userId = $dataPengguna['id_user']; // Dapatkan ID pengguna yang terkait

            // Hapus data pemilik dari tabel 'data_pemilik_kendaraan'
            $this->klien->deletePost($id_pengguna);

            // Hapus data pengguna dari tabel 'user' berdasarkan ID pengguna yang terkait
            $this->klien->deleteUserData($userId);

            return redirect()->to('/admin/Dasboards/masterpelanggan')->with('success', 'Data Berhasil Dihapus');
        }
    }
}
