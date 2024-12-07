<?php

namespace App\Models;

use CodeIgniter\Model;

class TempBarangModel extends Model
{
    protected $table = 'temp_barang';
    protected $primaryKey = 'id_barang'; // Sesuaikan dengan nama primary key pada tabel Anda
    protected $allowedFields = ['nama_barang', 'merek', 'harga', 'jumlah', 'kategori', 'satuan', 'deskripsi'];

    public function getAll()
    {
        return $this->findAll();
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function insertData($data)
    {
        return $this->insert($data);
    }

    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteData($id)
    {
        return $this->delete($id);
    }

    public function truncateTable()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->truncate();
    }
}
