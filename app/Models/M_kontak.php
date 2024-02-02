<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kontak extends Model
{
    protected $table = 'data_kontak';
    protected $primaryKey = 'id_kontak';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['alamat', 'tlp', 'email'];
    // Tambahkan fungsi-fungsi lainnya sesuai kebutuhan

    public function getDataKontak()
    {
        return $this->findAll();
    }

    public function updatePost($id_kontak)
    {
        return $this->update($id_kontak);
    }

    // Fungsi untuk menghapus data
    public function deletePost($id_kontak)
    {
        return $this->delete($id_kontak);
    }
}
