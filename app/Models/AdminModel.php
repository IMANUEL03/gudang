<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'nama', 'nip', 'bidang', 'jabatan'];

    public function getAdmin($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)
            ->first();
    }

    public function insertAdmin($data)
    {
        return $this->insert($data);
    }

    public function updateAdmin($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteAdmin($id)
    {
        return $this->delete($id);
    }
}
