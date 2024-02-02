<?php

namespace App\Controllers;

use App\Models\MP_datamobil;
use App\Models\M_user;
use App\Models\M_pemilik;

class P_datamobil extends BaseController
{
    protected $MP_datamobil;
    protected $m_user;
    protected $m_pemilik;

    public function __construct()
    {
        $this->MP_datamobil = new MP_datamobil();
        $this->m_user = new M_user();
        $this->m_pemilik = new M_pemilik();
    }

    public function index()
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
            $data['data_mobil'] = $this->MP_datamobil->getDataMobilByIdUser($id_user);
            // Tampilkan data mobil
            return view('V_Pemilik/datamobil', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function tambah()
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
            $image = $this->request->getFile('foto_mbl');

            if ($image->isValid() && !$image->hasMoved()) {

                $newImageName = $this->MP_datamobil->uploadImage($image);
                // Ambil id_pemilik dari relasi pemilik_kendaraan
                $pemilik_kendaraan = $this->m_pemilik->where('id_user', $id_user)->first();
                $id_pemilik = $pemilik_kendaraan['id_pemilik'];

                $data = [
                    'no_polisi' => $this->request->getPost('no_polisi'),
                    'mobil' => $this->request->getPost('mobil'),
                    'type_mobil' => $this->request->getPost('type_mobil'),
                    'transmisi' => $this->request->getPost('transmisi'),
                    'kapasitas_penumpang' => $this->request->getPost('kapasitas_penumpang'),
                    'harga_sewa' => $this->request->getPost('harga_sewa'),
                    'foto_mbl' => $newImageName,
                    'id_pemilik' => $id_pemilik,
                ];

                //tambahkan data mobil ke database
                $this->MP_datamobil->insert($data);
                // Redirect kembali ke halaman data mobil
                return redirect()->to('/pemilik/V_Pemilik/datamobil')->with('success', 'Data Berhasil Ditambah');
            } else {
                return redirect()->to('/pemilik/V_Pemilik/datamobil')->with('errors', 'Data Gagal Ditambah');
            }
        }
    }

    public function edit($id_mobil)
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
            $image = $this->request->getFile('foto_mbl');
            $existingData = $this->MP_datamobil->find($id_mobil);

            if ($image->isValid() && !$image->hasMoved()) {

                $newImageName = $this->MP_datamobil->uploadImage($image);
                // Ambil id_pemilik dari relasi pemilik_kendaraan
                $pemilik_kendaraan = $this->m_pemilik->where('id_user', $id_user)->first();
                $id_pemilik = $pemilik_kendaraan['id_pemilik'];

                $data = [
                    'no_polisi' => $this->request->getPost('no_polisi'),
                    'mobil' => $this->request->getPost('mobil'),
                    'type_mobil' => $this->request->getPost('type_mobil'),
                    'transmisi' => $this->request->getPost('transmisi'),
                    'kapasitas_penumpang' => $this->request->getPost('kapasitas_penumpang'),
                    'harga_sewa' => $this->request->getPost('harga_sewa'),
                    'foto_mbl' => $newImageName,
                    'id_pemilik' => $id_pemilik,
                ];
            } else {
                // Jika tidak ada perubahan, tetap gunakan file gambar yang sudah ada
                $data = [
                    // ... data lain yang diubah
                    'foto_mbl' => $existingData['foto_mbl'], // Gunakan kembali nama file gambar yang sudah ada
                    // ...
                ];
            }
            //tambahkan data mobil ke database
            $this->MP_datamobil->updatePost($id_mobil, $data);
            // Redirect kembali ke halaman data mobil
            return redirect()->to('/pemilik/V_Pemilik/datamobil')->with('success', 'Data Berhasil Diperbaharui');
        }
    }
    public function hapus($id_mobil)
    {
        $this->MP_datamobil->deletePost($id_mobil);

        return redirect()->to('/pemilik/V_Pemilik/datamobil')->with('success', 'Data Berhasil Dihapus');
    }
}
