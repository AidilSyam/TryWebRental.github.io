<?php

namespace App\Models;

use CodeIgniter\Model;

class M_sewa extends Model
{
    protected $table = 'data_sewa';
    protected $primaryKey = 'kode_sewa';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_pengguna', 'id_mobil', 'id_pemilik', 'tgl_sewa', 'tgl_kbl', 'lama_sewa', 'total_harga_sewa'];


    public function getSewa($kode_sewa)
    {
        return $this->where('kode_sewa', $kode_sewa)->first();
    }
}
