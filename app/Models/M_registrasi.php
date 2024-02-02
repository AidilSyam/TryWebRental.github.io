<?php

namespace App\Models;

use CodeIgniter\Model;

class M_registrasi extends Model
{
    protected $table = 'data_klien';
    protected $primaryKey = 'id_pengguna';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'gender', 'tlp', 'email', 'noktp', 'fotoktp', 'alamat', 'id_user', 'username', 'password', 'role'];

    public function registrasi_akun($dataUser, $dataPengguna)
    {
        // Mulai transaksi untuk memastikan konsistensi data
        $this->db->transBegin();

        // Masukkan data user
        $this->db->table('user')->insert($dataUser);

        // Dapatkan ID user yang baru dimasukkan
        $userId = $this->db->insertID();

        // Atur ID user pada data klien
        $dataPengguna['id_user'] = $userId;

        // Masukkan data klien
        $this->insert($dataPengguna);

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
