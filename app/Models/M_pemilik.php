<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pemilik extends Model
{
    protected $table = 'data_pemilik_kendaraan';
    protected $primaryKey = 'id_pemilik';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'gender', 'tlp', 'email', 'noktp', 'foto_pemilik', 'alamat', 'id_user'];

    // Metode untuk memeriksa login pengguna
    public function getDataPemilik()
    {
        // return $this->where('id_pemilik', $id_pemilik)->first();
        return $this->db->table('data_pemilik_kendaraan')
            ->join('user', 'user.id_user=data_pemilik_kendaraan.id_user')
            ->get()
            ->getResultArray();
    }
    public function getDataUser()
    {
        return $this->db->table('user')->get()->getResultArray();
    }

    public function insertDataPemilik($data)
    {
        return $this->insert($data);
    }

    public function insertUserData($userData)
    {
        $builder = $this->db->table('user');
        $builder->insert($userData);

        return $this->db->insertID();
    }

    public function UpdateDataPemilik($id_pemilik, $dataPemilik)
    {
        return $this->update($id_pemilik, $dataPemilik);
    }
    public function updateUserData($id_user, $userData)
    {
        $builder = $this->db->table('user');
        $builder->where('id_user', $id_user);
        $builder->update($userData);

        return $this->db->affectedRows(); // Mengembalikan jumlah baris yang terpengaruh oleh operasi update
    }


    public function deletePost($id_pemilik)
    {
        return $this->delete($id_pemilik);
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
