<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Profil extends Model
{
    protected $table = 'data_profil';
    protected $primaryKey = 'id_profil';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['text', 'foto'];
    // Tambahkan fungsi-fungsi lainnya sesuai kebutuhan

    public function getDataProfil()
    {
        return $this->findAll();
        //return $this->where('id_profil', $id_profil)->first();
    }

    public function updateDataProfil($id_profil, $data)
    {
        return $this->update($id_profil, $data);
    }
    public function deleteDataProfil($id_profil)
    {
        // Ambil nama file gambar berdasarkan ID mobil
        $imageData = $this->find($id_profil);
        $imageName = $imageData['foto'];

        // Hapus file gambar dari direktori jika ada
        if ($imageName && file_exists(ROOTPATH . 'public/Assets/' . $imageName)) {
            unlink(ROOTPATH . 'public/Assets/' . $imageName);
        }

        // Hapus data dari database
        return $this->delete(['id_profil' => $id_profil]);
    }

    public function uploadImage($imageFile)
    {
        $newName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/Assets', $newName);
        return $newName; // Kembalikan nama file baru untuk disimpan di database
    }
}
