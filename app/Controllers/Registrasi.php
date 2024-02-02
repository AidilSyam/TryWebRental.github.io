<?php

namespace App\Controllers;

use App\Models\M_registrasi;
use App\Models\M_registrasipemilik;

class Registrasi extends BaseController
{

    protected $registrasi;
    protected $registrasi_pemilik;
    function __construct()
    {
        $this->registrasi = new M_registrasi();
        $this->registrasi_pemilik = new M_registrasipemilik();
    }

    public function index()
    {
        return view('Pages/registrasi');
    }

    public function registrasi_pelanggan()
    {
        $image = $this->request->getFile('fotoktp');

        if ($image && !$image->hasMoved()) {
            if ($image->isValid()) {
                $newImageName = $this->registrasi->uploadImage($image);


                $dataPengguna = [
                    'nama' => $this->request->getPost('nama'),
                    'gender' => $this->request->getPost('gender'),
                    'tlp' => $this->request->getPost('tlp'),
                    'email' => $this->request->getPost('email'),
                    'noktp' => $this->request->getPost('noktp'),
                    'alamat' => $this->request->getPost('alamat'),
                    'fotoktp' => $newImageName,
                ];

                $dataUser = [
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'role' => 'pengguna',
                ];
                $this->registrasi->registrasi_akun($dataUser, $dataPengguna);
                // $this->registrasi->insertklien($dataPengguna);

                return redirect()->to('/login')->with('success', 'Berhasil Membuat Akun, silahkan login');
            } else {
                return redirect()->to('Pages/registrasi')->with('errors', 'Gagal Membuat akun');
            }
        }
    }

    public function registrasi_pemilik()
    {
        $image = $this->request->getFile('foto_pemilik');

        if ($image && !$image->hasMoved()) {
            if ($image->isValid()) {
                $newImageName = $this->registrasi_pemilik->uploadImage($image);


                $dataPemilik = [
                    'nama' => $this->request->getPost('nama'),
                    'gender' => $this->request->getPost('gender'),
                    'tlp' => $this->request->getPost('tlp'),
                    'email' => $this->request->getPost('email'),
                    'noktp' => $this->request->getPost('noktp'),
                    'alamat' => $this->request->getPost('alamat'),
                    'foto_pemilik' => $newImageName,
                ];

                $dataUser = [
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'role' => 'pemilik_kendaraan',
                ];
                $this->registrasi_pemilik->registrasi_akun_pemilik($dataUser, $dataPemilik);
                // $this->registrasi->insertklien($dataPengguna);

                return redirect()->to('/login')->with('success', 'Berhasil Membuat Akun, silahkan login');
            } else {
                return redirect()->to('Pages/registrasi')->with('errors', 'Gagal Membuat akun');
            }
        }
    }
}
