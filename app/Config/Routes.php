<?php

namespace Config;

use CodeIgniter\Commands\Utilities\Routes;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');


$routes->get('Dasboards/masterlacak', 'Template_dasboards::masterlacak');
$routes->get('Dasboards/posisikendaraan', 'Template_dasboards::posisikendaraan');
$routes->get('Dasboards/masterview/masterview_galery', 'Template_dasboards::masterview_galery');


$routes->get('/', 'Pages::index');
$routes->get('home', 'Pages::home');
$routes->get('login', 'Pages::login');
$routes->get('profil', 'Pages::profil');
$routes->get('galeri', 'Pages::galeri');
$routes->get('kontak', 'Pages::kontak');

$routes->get('registrasi/pelanggan', 'Registrasi::index');
$routes->add('registrasi/pelanggan', 'Registrasi::registrasi_pelanggan');

$routes->get('registrasi/pemilik', 'Pages::registrasipemilik');
$routes->add('registrasi/pemilik', 'Registrasi::registrasi_pemilik');

$routes->group('', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function ($routes) {
    $routes->get('pemesanan?(:segment)', 'Pages::pemesanan');
    $routes->get('akun', 'K_akun::index');
    $routes->add('akun/ubah/(:segment)', 'K_akun::edit/$1');
    $routes->add('akun/pengaturan/ubah/(:segment)', 'K_akun::edit_pengaturan/$1');

    $routes->get('pesanan?(:segment)', 'Pages::pemesanan');
});

$routes->match(['get', 'post'], 'login/user', 'AuthController::login'); // Proses login

$routes->group('admin', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function ($routes) {
    $routes->get('Dasboards', 'Template_dasboards::index');
    $routes->get('Dasboards/mastermobil', 'MasterMobil::index');
    $routes->add('Dasboards/mastermobil', 'MasterMobil::tambah');
    $routes->add('Dasboards/mastermobil/ubah/(:segment)', 'MasterMobil::edit/$1');
    $routes->get('Dasboards/mastermobil/hapus/(:segment)', 'MasterMobil::hapus/$1');

    // Routes for Master Pemilik
    $routes->get('Dasboards/masterpemilik', 'MasterPemilik::index');
    $routes->add('Dasboards/masterpemilik', 'MasterPemilik::tambah');
    $routes->add('Dasboards/masterpemilik/ubah/(:segment)', 'MasterPemilik::edit/$1');
    $routes->get('Dasboards/masterpemilik/hapus/(:segment)', 'MasterPemilik::hapus/$1');

    // Routes for Master Pelanggan
    $routes->get('Dasboards/masterpelanggan', 'Klien::index');
    //$routes->get('Dasboards/masterpelanggan/login', 'User::login');
    $routes->add('Dasboards/masterpelanggan', 'Klien::tambah');
    $routes->add('Dasboards/masterpelanggan/ubah/(:segment)', 'Klien::edit/$1');
    $routes->get('Dasboards/masterpelanggan/hapus/(:segment)', 'Klien::hapus/$1');

    // Routes for Master Sewa
    $routes->get('Dasboards/mastersewa', 'MasterSewa::index');
    $routes->add('Dasboards/mastersewa', 'MasterSewa::tambah');
    $routes->add('Dasboards/mastersewa/ubah/(:segment)', 'MasterSewa::edit/$1');
    $routes->get('Dasboards/mastersewa/hapus/(:segment)', 'MasterSewa::hapus/$1');

    // Routes for Master Lacak
    $routes->get('Dasboards/masterlacak', 'MasterLacak::index');

    // Routes for Master Profil
    $routes->get('Dasboards/masterview/masterview_profil', 'MasterProfil::index');
    $routes->add('Dasboards/masterview/masterview_profil', 'MasterProfil::tambah');
    $routes->add('Dasboards/masterview/masterview_profil/ubah/(:segment)', 'MasterProfil::edit/$1');
    $routes->get('Dasboards/masterview/masterview_profil/hapus/(:segment)', 'MasterProfil::hapus/$1');

    // Routes for Master Galery
    $routes->get('Dasboards/masterview/masterview_galery', 'MasterGalery::index');
    $routes->add('Dasboards/masterview/masterview_galery', 'MasterGalery::tambah');
    $routes->add('Dasboards/masterview/masterview_galey/ubah/(:segment)', 'MasterGalery::edit/$1');
    $routes->get('Dasboards/masterview/masterview_galery/hapus/(:segment)', 'MasterGalery::hapus/$1');

    // Routes for Master Kontak
    $routes->get('Dasboards/masterview/masterview_kontak', 'MasterKontak::index');
    $routes->add('Dasboards/masterview/masterview_kontak', 'MasterKontak::tambah');
    $routes->add('Dasboards/masterview/masterview_kontak/ubah/(:segment)', 'MasterKontak::edit/$1');
    $routes->get('Dasboards/masterview/masterview_kontak/hapus/(:segment)', 'MasterKontak::hapus/$1');
});

$routes->group('pemilik', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function ($routes) {
    $routes->get('V_Pemilik', 'Templates_pemilik::index');
    $routes->get('V_Pemilik/datamobil', 'P_datamobil::index');
    $routes->add('V_Pemilik/datamobil', 'P_datamobil::tambah');
    $routes->add('V_Pemilik/datamobil/ubah/(:segment)', 'P_datamobil::edit/$1');
    $routes->get('V_Pemilik/datamobil/hapus/(:segment)', 'P_datamobil::hapus/$1');

    // Routes for datasewa pemilik
    $routes->get('V_Pemilik/datasewa', 'P_datasewa::index');
    //$routes->add('V_Pemilik/datasewa', 'P_datasewa::tambah');
    $routes->add('V_Pemilik/datasewa/ubah/(:segment)', 'P_datasewa::edit/$1');
    $routes->get('V_Pemilik/datasewa/hapus/(:segment)', 'P_datasewa::hapus/$1');

    // Routes for akun pemilik
    $routes->get('V_Pemilik/akun', 'P_akun::index');
    $routes->add('V_Pemilik/akun/ubah/(:segment)', 'P_akun::edit/$1');
    $routes->add('V_Pemilik/akun/pengaturan/ubah/(:segment)', 'P_akun::edit_pengaturan/$1');
});

$routes->get('logout', 'AuthController::logout'); // Proses logout
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
