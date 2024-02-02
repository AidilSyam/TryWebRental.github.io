<?php

namespace App\Models;

use CodeIgniter\Model;

class M_mastermobil extends Model
{
    protected $table = 'data_mobil';
    protected $primaryKey = 'id_mobil';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['no_polisi', 'mobil', 'type_mobil', 'transmisi', 'kapasitas_penumpang', 'harga_sewa', 'foto_mbl', 'id_pemilik',];


    public function getDataMobil()
    {
        return $this->db->table('data_mobil')
            ->join('data_pemilik_kendaraan', 'data_pemilik_kendaraan.id_pemilik=data_mobil.id_pemilik')
            ->get()
            ->getResultArray();
    }
    public function getDataPemilik()
    {
        return $this->db->table('data_pemilik_kendaraan')->get()->getResultArray();
    }

    public function updatePost($id_mobil, $data)
    {
        return $this->update($id_mobil, $data);
    }

    // Fungsi untuk menghapus data
    public function deletePost($id_mobil)
    {
        //return $this->delete(['id_mobil' => $id_mobil]);
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

    public function uploadImage($imageFile)
    {
        $newName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/Assets', $newName);
        return $newName; // Kembalikan nama file baru untuk disimpan di database
    }
}
