<?php

namespace App\Models;

use CodeIgniter\Model;

class M_klien extends Model
{
    protected $table = 'data_klien';
    protected $primaryKey = 'id_pengguna';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'gender', 'tlp', 'email', 'noktp', 'fotoktp', 'alamat', 'id_user'];

    // Metode untuk memeriksa login pengguna
    public function getDataPelanggan()
    {
        //return $this->where('id_pengguna', $id_pengguna)->first();
        return $this->db->table('data_klien')
            ->join('user', 'user.id_user=data_klien.id_user')
            ->get()
            ->getResultArray();
    }
    public function getDataUser()
    {
        return $this->db->table('user')->get()->getResultArray();
    }
    public function insertDataPelanggan($dataPegguna)
    {
        return $this->insert($dataPegguna);
    }

    public function UpdateDataPelanggan($id_pengguna, $dataPengguna)
    {
        return $this->update($id_pengguna, $dataPengguna);
    }

    public function insertUserData($userData)
    {
        $builder = $this->db->table('user');
        $builder->insert($userData);
        return $this->db->insertID();
    }

    public function updateUserData($id_user, $userData)
    {
        $builder = $this->db->table('user');
        $builder->where('id_user', $id_user);
        $builder->update($userData);

        return $this->db->affectedRows(); // Mengembalikan jumlah baris yang terpengaruh oleh operasi update
    }

    public function deletePost($id_pengguna)
    {
        return $this->delete($id_pengguna);
    }
    public function deleteUserData($userId)
    {
        return $this->db->table('user')->where('id_user', $userId)->delete();
    }

    public function uploadImage($imageFile)
    {
        $newName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/Assets', $newName);
        return $newName; // Kembalikan nama file baru untuk disimpan di database
    }
}
