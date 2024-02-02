<?php

namespace App\Models;

use CodeIgniter\Model;

class MK_akun extends Model
{
    protected $table = 'data_klien';
    protected $primaryKey = 'id_pengguna';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'tlp', 'gender', 'email', 'fotoktp', 'noktp', 'alamat', 'id_user'];

    public function getDataKlienByIdUser($id_user)
    {
        return $this->select('data_klien.id_pengguna, data_klien.nama, data_klien.tlp, data_klien.email, data_klien.fotoktp, data_klien.noktp, data_klien.alamat, data_klien.gender, data_klien.id_user')
            ->join('user', 'data_klien.id_user = user.id_user')
            ->where('user.id_user', $id_user)
            ->findAll();
    }

    public function getdatauser($id_user)
    {
        return $this->db->table('user')
            ->select('user.id_user, user.username, user.password')
            ->where('user.id_user', $id_user)
            ->get()
            ->getResultArray();
    }

    public function updatePost($id_pengguna, $data)
    {
        return $this->update($id_pengguna, $data);
    }

    public function uploadImage($imageFile)
    {
        $newName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/Assets', $newName);
        return $newName; // Kembalikan nama file baru untuk disimpan di database
    }
}
