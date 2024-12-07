<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $allowedFields = ['nama_supplier', 'alamat', 'kontak'];

    public function getAllSupplier()
    {
        return $this->findAll();
    }

    public function getNamaSupplier($id)
    {
        return $this->find($id)['nama_supplier'] ?? '';
    }


    public function tambahSupplier($data)
    {
        return $this->insert($data);
    }

    public function simpanSupplier($data)
    {
        return $this->insert($data);
    }

    public function getSupplierById($id)
    {
        return $this->find($id);
    }

    public function editSupplier($id, $data)
    {
        return $this->update($id, $data);
    }

    public function hapusSupplier($id)
    {
        return $this->delete($id);
    }
}
