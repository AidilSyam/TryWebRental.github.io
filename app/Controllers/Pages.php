<?php

namespace App\Controllers;

use App\Models\M_home;
use App\Models\M_profil;
use App\Models\M_kontak;

class Pages extends BaseController
{
    public function index()
    {
        $mobilModel = new M_home();
        $data['data_mobil'] = $mobilModel->getDataMobil();
        return view('Pages/home1', $data);
    }

    public function home()
    {
        $mobilModel = new M_home();
        $data['data_mobil'] = $mobilModel->getDataMobil();

        return view('Pages/home1', $data);
    }

    public function profil()
    {
        $profilModel = new M_profil();
        $data['data_profil'] = $profilModel->getDataProfil();
        return view('Pages/profil', $data);
    }

    public function galeri()
    {
        return view('Pages/galeri');
    }

    public function kontak()
    {
        $kontakModel = new M_kontak();
        $data['data_kontak'] = $kontakModel->getDataKontak();
        return view('Pages/kontak', $data);
    }

    public function login()
    {
        return view('Pages/login');
    }
    public function registrasi()
    {
        return view('Pages/registrasi');
    }
    public function registrasipemilik()
    {
        return view('Pages/registrasipemilik');
    }
    public function pemesanan()
    {
        return view('Pages/pemesanan');
    }

    public function akun()
    {
        return view('Pages/akun');
    }
}
