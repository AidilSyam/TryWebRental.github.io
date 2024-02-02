<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Home extends Model
{
    protected $table = 'data_mobil';
    protected $primaryKey = 'no_polisi';
    protected $allowedFields = ['mobil', 'type_mobil', 'transmisi', 'kapasitas_penumpang', 'harga_sewa', 'foto_mbl', 'id_pemilik'];
    // Tambahkan fungsi-fungsi lainnya sesuai kebutuhan

    public function getDataMobil()
    {
        return $this->findAll();
    }
}
