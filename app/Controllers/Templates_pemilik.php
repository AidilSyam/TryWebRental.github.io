<?php

namespace App\Controllers;

class Templates_pemilik extends BaseController
{
    public function index()
    {
        return view('V_Pemilik/Dasboards');
    }
    public function datamobil()
    {
        return view('V_Pemilik/datamobil');
    }
    public function datasewa()
    {
        return view('V_Pemilik/datasewa');
    }
    public function masterlacak()
    {
        return view('V_Pemilik/datamonitoring');
    }
}
