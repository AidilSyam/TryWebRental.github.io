<?php

namespace App\Models;

use CodeIgniter\Model;

class MP_datasewa extends Model
{
    protected $table = 'data_sewa';
    protected $primaryKey = 'kode_sewa';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_pengguna', 'id_mobil', 'id_pemilik', 'tgl_sewa', 'tgl_kbl', 'lama_sewa', 'total_harga_sewa'];


    public function getSewa($id_user)
    {
        //return $this->where('kode_sewa', $kode_sewa)->first();
        return $this->select('data_sewa.kode_sewa, data_sewa.id_pengguna, data_sewa.id_mobil, data_sewa.tgl_sewa, data_sewa.tgl_kbl,data_sewa.lama_sewa, data_sewa.total_harga_sewa, data_klien.nama, data_mobil.mobil, data_mobil.no_polisi')
            ->join('data_klien', 'data_sewa.id_pengguna = data_klien.id_pengguna')
            ->join('data_mobil', 'data_sewa.id_mobil = data_mobil.id_mobil')
            ->join('data_pemilik_kendaraan', 'data_sewa.id_pemilik = data_pemilik_kendaraan.id_pemilik')
            ->join('user', 'data_pemilik_kendaraan.id_user = user.id_user')
            ->where('data_pemilik_kendaraan.id_user', $id_user)
            ->findAll();
    }
}
