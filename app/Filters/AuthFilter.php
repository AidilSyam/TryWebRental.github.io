<?php

namespace app\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    // public function before(RequestInterface $request, $arguments = null)
    // {
    //     $session = session();

    //     if (!$session->get('isLoggedIn')) {
    //         return redirect()->to('/login');
    //     }
    // }

    // public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    // {
    //     // ...
    // }

    public function before(RequestInterface $request, $arguments = null)
    {
        // Periksa apakah pengguna belum login
        if (!session()->has('id_user')) {
            // Alihkan ke halaman login atau lakukan tindakan lain
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak melakukan apa-apa setelah eksekusi kontrol
    }
}
