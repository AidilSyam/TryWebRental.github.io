<?php

namespace App\Controllers;

use App\Models\M_user;;

use App\Models\MP_datasewa;

class P_datasewa extends BaseController
{
    protected $MP_datasewa;
    protected $m_user;

    function __construct()
    {
        $this->MP_datasewa = new MP_datasewa;
        $this->m_user = new M_user();
    }

    public function index()
    {
        //     $data['data_sewa'] = $this->datasewa->findAll();

        //     return view('V_Pemilik/datasewa', $data);
        // }

        // Periksa apakah pengguna sudah login
        if (!session()->has('id_user')) {
            return redirect()->to('/');
        }

        // Ambil ID pengguna yang sedang login
        $id_user = session()->get('id_user');

        // Dapatkan data pengguna
        $userData = $this->m_user->find($id_user);

        // Periksa peran pengguna
        if ($userData && $userData['role'] == 'pemilik_kendaraan') {
            $data['data_sewa'] = $this->MP_datasewa->getsewa($id_user);
            // Tampilkan data mobil
            return view('V_Pemilik/datasewa', $data);
        } else {
            return redirect()->to('/');
        }
    }
}
