<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Galery extends Model
{
    protected $table = 'data_galery';
    protected $primaryKey = 'id_galery';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['foto', 'video'];
    // Tambahkan fungsi-fungsi lainnya sesuai kebutuhan

    public function getDataGalery()
    {
        return $this->findAll();
    }

    public function updatePost($id_galery)
    {
        return $this->update($id_galery);
    }

    // Fungsi untuk menghapus data
    public function deletePost($id_galery)
    {
        return $this->delete($id_galery);
    }

    public function uploadImage($imageFile)
    {
        $newName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/Assets', $newName);
        return $newName; // Kembalikan nama file baru untuk disimpan di database
    }
}
