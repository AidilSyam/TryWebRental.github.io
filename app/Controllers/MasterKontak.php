<?php

namespace App\Controllers;

use App\Models\M_kontak;

class MasterKontak extends BaseController
{
    protected $masterkontak;

    function __construct()
    {
        $this->masterkontak = new M_kontak();
    }

    public function index()
    {
        $data['data_kontak'] = $this->masterkontak->findAll();

        return view('Dasboards/masterview/masterview_kontak', $data);
    }

    public function tambah()
    {
        $this->masterkontak->insert([
            'alamat' => $this->request->getPost('alamat'),
            'tlp' => $this->request->getPost('tlp'),
            'email' => $this->request->getPost('email'),
        ]);
        return redirect()->to('/admin/Dasboards/masterview/masterview_kontak')->with('success', 'Data Added Successfully');
    }

    public function edit($id_kontak)
    {
        $this->masterkontak->update($id_kontak, [
            'alamat' => $this->request->getPost('alamat'),
            'tlp' => $this->request->getPost('tlp'),
            'email' => $this->request->getPost('email'),
        ]);
        return redirect()->to('/admin/Dasboards/masterview/masterview_kontak')->with('success', 'Data Update Successfully');
    }

    public function hapus($id_kontak)
    {
        $this->masterkontak->deletePost($id_kontak);
        return redirect()->to('/admin/Dasboards/masterview/masterview_kontak')->with('success', 'Data Delete Successfully');
    }
}
