<?php

namespace App\Controllers;

use App\Models\M_sewa;

class MasterSewa extends BaseController
{
    protected $mastersewa;

    function __construct()
    {
        $this->mastersewa = new M_sewa();
    }

    public function index()
    {
        $data['data_sewa'] = $this->mastersewa->findAll();

        return view('Dasboards/mastersewa', $data);
    }
}
