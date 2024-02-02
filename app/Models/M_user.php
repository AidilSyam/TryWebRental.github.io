<?php

namespace App\Models;

use CodeIgniter\Model;

class M_user extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'password', 'role'];

    public function checkLogin($username, $password)
    {
        $userData = $this->where(['username' => $username, 'password' => $password])->first();

        if ($userData) {
            // Simpan role ke dalam sesi (session)
            session()->set([
                'id_user' => $userData['id_user'],
                'role'    => $userData['role'],
            ]);

            return $userData;
        }

        return null;
    }
}
