<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['namakategori'];

    public function getAllKategori()
    {
        return $this->findAll();
    }

    public function getNamaKategori($id)
    {
        return $this->find($id)['namakategori'] ?? '';
    }


    public function tambahKategori($data)
    {
        return $this->insert($data);
    }

    public function simpanKategori($data)
    {
        return $this->insert($data);
    }

    public function getKategoriById($id)
    {
        return $this->find($id);
    }

    public function editKategori($id, $data)
    {
        return $this->update($id, $data);
    }

    public function hapusKategori($id)
    {
        return $this->delete($id);
    }
}
