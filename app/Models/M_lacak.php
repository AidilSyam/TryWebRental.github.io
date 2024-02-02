<?php

namespace App\Models;

use CodeIgniter\Model;

class M_lacak extends Model
{
    protected $table = 'data_lacak';
    protected $primaryKey = 'id_lacak';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['waktu', 'latitude', 'longitude', 'id_mobil'];

    // Metode untuk memeriksa login pengguna
    public function getDataLacak()
    {
        // return $this->where('id_pemilik', $id_pemilik)->first();
        return $this->db->table('data_lacak')
            ->join('data_mobil', 'data_mobil.id_mobil=data_lacak.id_mobil')
            ->get()
            ->getResultArray();
    }
    public function getDataMobil()
    {
        return $this->db->table('data_mobil')->get()->getResultArray();
    }
}
