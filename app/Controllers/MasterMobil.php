<?php

namespace App\Controllers;

use App\Models\M_mastermobil;

class MasterMobil extends BaseController
{
    protected $mastermobil;

    function __construct()
    {
        $this->mastermobil = new M_mastermobil();
    }

    public function index()
    {
        $data['data_mobil'] = $this->mastermobil->getDataMobil();
        // Ambil data pemilik kendaraan dari model
        $data['data_pemilik_kendaraan'] = $this->mastermobil->getDataPemilik(); // Gantilah dengan metode yang sesuai untuk mendapatkan data pemilik kendaraan

        return view('Dasboards/mastermobil', $data);
    }

    public function tambah()
    {
        $image = $this->request->getFile('foto_mbl');

        if ($image->isValid() && !$image->hasMoved()) {
            $newImageName = $this->mastermobil->uploadImage($image);
            // Ambil data dari form dan tambahkan nama gambar ke data yang akan disimpan
            $data = [
                'no_polisi' => $this->request->getPost('no_polisi'),
                'mobil' => $this->request->getPost('mobil'),
                'type_mobil' => $this->request->getPost('type_mobil'),
                'transmisi' => $this->request->getPost('transmisi'),
                'kapasitas_penumpang' => $this->request->getPost('kapasitas_penumpang'),
                'harga_sewa' => $this->request->getPost('harga_sewa'),
                'foto_mbl' => $newImageName,
                'id_pemilik' => $this->request->getPost('id_pemilik'),
            ];
            $this->mastermobil->insert($data);
            return redirect()->to('/admin/Dasboards/mastermobil')->with('success', 'Data Berhasil Ditambah');
        } else {
            return redirect()->to('/admin/Dasboards/mastermobil')->with('errors', 'Data Gagal Ditambah');
        }
    }

    public function edit($id_mobil)
    {
        $image = $this->request->getFile('foto_mbl');
        // Mengambil data mobil berdasarkan ID
        $existingData = $this->mastermobil->find($id_mobil);

        if ($image->isValid() && !$image->hasMoved()) {
            $newImageName = $this->mastermobil->uploadImage($image);
            // Ambil data dari form dan tambahkan nama gambar ke data yang akan disimpan
            $data = [
                'no_polisi' => $this->request->getPost('no_polisi'),
                'mobil' => $this->request->getPost('mobil'),
                'type_mobil' => $this->request->getPost('type_mobil'),
                'transmisi' => $this->request->getPost('transmisi'),
                'kapasitas_penumpang' => $this->request->getPost('kapasitas_penumpang'),
                'harga_sewa' => $this->request->getPost('harga_sewa'),
                'foto_mbl' => $newImageName,
                'id_pemilik' => $this->request->getPost('id_pemilik'),
            ];
        } else {
            // Jika tidak ada perubahan, tetap gunakan file gambar yang sudah ada
            $data = [
                // ... data lain yang diubah
                'foto_mbl' => $existingData['foto_mbl'], // Gunakan kembali nama file gambar yang sudah ada
                // ...
            ];
        }
        $this->mastermobil->updatePost($id_mobil, $data);
        return redirect()->to('/admin/Dasboards/mastermobil')->with('success', 'Data Berhasil Diperbaharui');
    }

    public function hapus($id_mobil)
    {
        $this->mastermobil->deletePost($id_mobil);

        //return redirect('Dasboards/mastermobil')->with('success', 'Data Deleted Successfully');
        return redirect()->to('/admin/Dasboards/mastermobil')->with('success', 'Data Berhasil Dihapus');
    }
}
