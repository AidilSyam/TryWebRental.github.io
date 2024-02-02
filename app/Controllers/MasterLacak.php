<?php

namespace App\Controllers;

use App\Models\M_lacak;

class MasterLacak extends BaseController
{

    protected $lacak;

    function __construct()
    {
        $this->lacak = new M_lacak();
    }

    //--------------------------------------------------------------------
    public function index()
    {
        $data['data_lacak'] = $this->lacak->getDataLacak();
        $data['data_mobil'] = $this->lacak->getDataMobil();
        return view('Dasboards/masterlacak', $data);
    }
}
