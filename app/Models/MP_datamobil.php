<?php

namespace App\Models;

use CodeIgniter\Model;

class MP_datamobil extends Model
{
    protected $table = 'data_mobil';
    protected $primaryKey = 'id_mobil';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['no_polisi', 'mobil', 'type_mobil', 'transmisi', 'kapasitas_penumpang', 'harga_sewa', 'foto_mbl', 'id_pemilik'];

    // Tambahkan method untuk mendapatkan data mobil berdasarkan ID user yang dimiliki oleh pemilik
    public function getDataMobilByIdUser($id_user)
    {
        return $this->select('data_mobil.id_mobil, data_mobil.mobil, data_mobil.no_polisi, data_mobil.type_mobil, data_mobil.transmisi, data_mobil.kapasitas_penumpang, data_mobil.harga_sewa, data_mobil.foto_mbl, data_mobil.id_pemilik')
            ->join('data_pemilik_kendaraan', 'data_mobil.id_pemilik = data_pemilik_kendaraan.id_pemilik')
            ->join('user', 'data_pemilik_kendaraan.id_user = user.id_user')
            ->where('data_pemilik_kendaraan.id_user', $id_user)
            ->findAll();
    }

    public function uploadImage($imageFile)
    {
        $newName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/Assets', $newName);
        return $newName; // Kembalikan nama file baru untuk disimpan di database
    }

    public function updatePost($id_mobil, $data)
    {
        return $this->update($id_mobil, $data);
    }

    public function deletePost($id_mobil)
    {
        // Ambil nama file gambar berdasarkan ID mobil
        $imageData = $this->find($id_mobil);
        $imageName = $imageData['foto_mbl'];

        // Hapus file gambar dari direktori jika ada
        if ($imageName && file_exists(ROOTPATH . 'public/Assets/' . $imageName)) {
            unlink(ROOTPATH . 'public/Assets/' . $imageName);
        }

        // Hapus data dari database
        return $this->delete(['id_mobil' => $id_mobil]);
    }
}
