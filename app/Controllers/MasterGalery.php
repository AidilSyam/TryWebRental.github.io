<?php

namespace App\Controllers;

use App\Models\M_Galery;

class MasterGalery extends BaseController
{
    protected $mastergalery;

    function __construct()
    {
        $this->mastergalery = new M_galery();
    }

    public function index()
    {
        $data['data_galery'] = $this->mastergalery->findAll();

        return view('Dasboards/masterview/masterview_galery', $data);
    }

    public function tambah()
    {
        // $this->mastergalery->insert([
        //     'foto' => $this->request->getPost('foto'),
        //     //'video' => $this->request->getPost('video'),
        // ]);
        // return redirect()->to('/admin/Dasboards/masterview/masterview_galery')->with('success', 'Data Added Successfully');

        $image = $this->request->getFile('foto');

        if ($image->isValid() && !$image->hasMoved()) {
            $newImageName = $this->mastergalery->uploadImage($image);
            // Ambil data dari form dan tambahkan nama gambar ke data yang akan disimpan
            $data = [
                'foto' => $newImageName,
            ];
            $this->mastergalery->insert($data);
            return redirect()->to('/admin/Dasboards/masterview/masterview_galery')->with('success', 'Data Berhasil Ditambah');
        } else {
            return redirect()->to('/admin/Dasboards/masterview/masterview_galery')->with('errors', 'Data Gagal Ditambah');
        }
    }

    public function edit($id_galery)
    {
        $this->mastergalery->update($id_galery, [
            'foto' => $this->request->getPost('foto'),
            'video' => $this->request->getPost('video'),
        ]);
        return redirect()->to('/admin/Dasboards/masterview/masterview_galery')->with('success', 'Data Update Successfully');
    }

    public function hapus($id_galery)
    {
        $this->mastergalery->deletePost($id_galery);
        return redirect()->to('/admin/Dasboards/masterview/masterview_galery')->with('success', 'Data Delete Successfully');
    }
}
