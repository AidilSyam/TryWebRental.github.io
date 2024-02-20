<?php

namespace App\Controllers;

use App\Models\M_klien;
use App\Models\M_pemilik;
use App\Models\M_mastermobil;

use App\Models\M_user;
use App\Models\M_sewa;

class Pemesanan extends BaseController
{
    public function pemesanan($id_mobil)
    {
        // Ambil data mobil berdasarkan ID mobil yang diterima
        $mobilModel = new M_mastermobil();
        $data['data_mobil'] = $mobilModel->find($id_mobil);

        // Ambil id_pemilik dari data mobil yang sesuai
        $id_pemilik = $data['data_mobil']['id_pemilik'];


        // Ambil data pengguna yang sedang login (misalnya dari session)
        $userModel = new M_user();
        $data['user'] = $userModel->find(session('id_user'));

        // Jika pengguna memiliki data klien terkait, ambil data klien
        if ($data['user']) {
            $klienModel = new M_klien();
            $data['data_klien'] = $klienModel->where('id_user', session('id_user'))->first();
        }

        // Kirim data ke tampilan pemesanan
        return view('Pages/pemesanan', $data + ['id_pemilik' => $id_pemilik]);
    }

    public function prosespemesanan()
    {
        // Ambil id_user dari session
        $id_user = session('id_user');

        // Ambil id_pengguna dari tabel data_klien berdasarkan id_user
        $klienModel = new M_klien();
        $klienData = $klienModel->where('id_user', $id_user)->first();

        $id_pengguna = $klienData['id_pengguna'];

        // Ambil data yang dikirim dari form pemesanan
        $id_mobil = $this->request->getPost('id_mobil');
        $id_pemilik = $this->request->getPost('id_pemilik');
        $tgl_sewa = $this->request->getPost('tgl_sewa');
        $tgl_kbl = $this->request->getPost('tgl_kbl');
        $lama_sewa = $this->request->getPost('lama_sewa');
        $total_harga_sewa = $this->request->getPost('total_harga_sewa');
        $nomor_pengantaran = $this->request->getPost('nomor_pengantaran');

        // Validasi data jika diperlukan

        // Simpan data pemesanan ke database
        $dataSewaModel = new M_sewa();
        $dataSewaModel->insert([
            'id_mobil' => $id_mobil,
            'id_pemilik' => $id_pemilik,
            'id_pengguna' => $id_pengguna,
            'tgl_sewa' => $tgl_sewa,
            'tgl_kbl' => $tgl_kbl,
            'lama_sewa' => $lama_sewa,
            'nomor_pengantaran' => $nomor_pengantaran,
            'total_harga_sewa' => $total_harga_sewa,
        ]);

        // Redirect ke halaman sukses atau tindakan selanjutnya
        return redirect()->to('pesanan');
    }


    public function pesanan()
    {
        // Ambil id_user dari session
        $id_user = session('id_user');

        // Ambil id_pengguna dari tabel data_klien berdasarkan id_user
        $klienModel = new M_klien();
        $klienData = $klienModel->where('id_user', $id_user)->first();

        // Periksa apakah data pengguna ditemukan
        if (!$klienData) {
            return redirect()->back()->with('error', 'Data pengguna tidak ditemukan.');
        }

        // Ambil id_pengguna dari data pengguna
        $id_pengguna = $klienData['id_pengguna'];

        // Ambil semua data pesanan berdasarkan id_pengguna
        $dataSewaModel = new M_sewa();
        $data['data_sewa'] = $dataSewaModel->where('id_pengguna', $id_pengguna)->findAll();

        // Kirim data ke tampilan pesanan
        return view('Pages/pesanan', $data);
    }
}
