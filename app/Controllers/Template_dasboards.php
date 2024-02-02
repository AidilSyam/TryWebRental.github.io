<?php

namespace App\Controllers;

class Template_dasboards extends BaseController
{
    public function index()
    {
        //return view('Template_dasboards/TDasboard2');
        return view('Dasboards/dasboard');
    }
    public function mastermobil()
    {
        return view('Dasboards/mastermobil');
    }
    public function masterpelanggan()
    {
        return view('Dasboards/masterpelanggan');
    }
    public function mastersewa()
    {
        return view('Dasboards/mastersewa');
    }
    public function masterlacak()
    {
        return view('Dasboards/masterlacak');
    }
    public function posisikendaraan()
    {
        return view('Dasboards/posisikendaraan');
    }
    public function masterview_profil()
    {
        return view('Dasboards/masterview/masterview_profil');
    }
    public function masterview_galery()
    {
        return view('Dasboards/masterview/masterview_galery');
    }
    public function masterview_kontak()
    {
        return view('Dasboards/masterview/masterview_kontak');
    }
}
