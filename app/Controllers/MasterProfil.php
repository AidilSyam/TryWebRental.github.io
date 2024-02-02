<?php

namespace App\Controllers;

use App\Models\M_profil;

class MasterProfil extends BaseController
{
    protected $masterprofil;

    function __construct()
    {
        $this->masterprofil = new M_profil();
    }

    public function index()
    {
        $data['data_profil'] = $this->masterprofil->findAll();

        return view('Dasboards/masterview/masterview_profil', $data);
    }

    public function tambah()
    {
        $image = $this->request->getFile('foto');

        if ($image->isValid() && !$image->hasMoved()) {
            $newImageName = $this->masterprofil->uploadImage($image);
            // Ambil data dari form dan tambahkan nama gambar ke data yang akan disimpan
            $data = [
                'text' => $this->request->getPost('text'),
                'foto' => $newImageName,
            ];
            $this->masterprofil->insert($data);
            return redirect()->to('/admin/Dasboards/masterview/masterview_profil')->with('success', 'Data Berhasil Ditambah');
        } else {
            return redirect()->to('/admin/Dasboards/masterview/masterview_profil')->with('errors', 'Data Gagal Ditambah');
        }
    }

    public function edit($id_profil)
    {
        $image = $this->request->getFile('foto');
        // Mengambil data profil berdasarkan ID
        $existingData = $this->masterprofil->find($id_profil);

        if ($image->isValid() && !$image->hasMoved()) {
            $newImageName = $this->masterprofil->uploadImage($image);
            // Ambil data dari form dan tambahkan nama gambar ke data yang akan disimpan
            $data = [
                'text' => $this->request->getPost('text'),
                'foto' => $newImageName,
            ];
        } else {
            // Jika tidak ada perubahan, tetap gunakan file gambar yang sudah ada
            $data = [
                // ... data lain yang diubah
                'foto' => $existingData['foto'], // Gunakan kembali nama file gambar yang sudah ada
                // ...
            ];
        }
        $this->masterprofil->updateDataProfil($id_profil, $data);
        return redirect()->to('/admin/Dasboards/masterview/masterview_profil')->with('success', 'Data Berhasil Diperbaharui');
    }

    public function hapus($id_profil)
    {
        $this->masterprofil->deleteDataProfil($id_profil);
        return redirect()->to('/admin/Dasboards/masterview/masterview_profil')->with('success', 'Data Berhasil Dihapus');
    }
}
