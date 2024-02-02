<?php

namespace App\Models;

use CodeIgniter\Model;

class M_registrasipemilik extends Model
{
    protected $table = 'data_pemilik_kendaraan';
    protected $primaryKey = 'id_pemilik';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'gender', 'tlp', 'email', 'noktp', 'foto_pemilik', 'alamat', 'id_user', 'username', 'password', 'role'];

    public function registrasi_akun_pemilik($dataUser, $dataPemilik)
    {
        // Mulai transaksi untuk memastikan konsistensi data
        $this->db->transBegin();

        // Masukkan data user
        $this->db->table('user')->insert($dataUser);

        // Dapatkan ID user yang baru dimasukkan
        $userId = $this->db->insertID();

        // Atur ID user pada data pamilik_kendaraan
        $dataPemilik['id_user'] = $userId;

        // Masukkan data pemilik_kendaraan
        $this->insert($dataPemilik);

        // Commit transaksi
        $this->db->transCommit();
    }



    public function uploadImage($imageFile)
    {
        $newName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/Assets', $newName);
        return $newName; // Kembalikan nama file baru untuk disimpan di database
    }
}
