<?php

namespace App\Models;

use CodeIgniter\Model;

class MP_akun extends Model
{
    protected $table = 'data_pemilik_kendaraan';
    protected $primaryKey = 'id_pemilik';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'tlp', 'gender', 'email', 'foto_pemilik', 'noktp', 'alamat', 'id_user'];

    public function getDataPemilikByIdUser($id_user)
    {
        return $this->select('data_pemilik_kendaraan.id_pemilik, data_pemilik_kendaraan.nama,data_pemilik_kendaraan.tlp, data_pemilik_kendaraan.email, data_pemilik_kendaraan.foto_pemilik,data_pemilik_kendaraan.noktp, data_pemilik_kendaraan.alamat, data_pemilik_kendaraan.gender, data_pemilik_kendaraan.id_user')
            ->join('user', 'data_pemilik_kendaraan.id_user = user.id_user')
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

    public function updatePost($id_pemilik, $data)
    {
        return $this->update($id_pemilik, $data);
    }

    public function uploadImage($imageFile)
    {
        $newName = $imageFile->getRandomName();
        $imageFile->move(ROOTPATH . 'public/Assets', $newName);
        return $newName; // Kembalikan nama file baru untuk disimpan di database
    }
}
