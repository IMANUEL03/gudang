<?php

namespace App\Models;

use CodeIgniter\Model;

class RincianBarangKeluarModel extends Model
{
    protected $table = 'rincian_barang_keluar';
    protected $primaryKey = 'id_rincianbarang_keluar';
    protected $allowedFields = ['id_barang_keluar', 'id_barang', 'id_kategori', 'id_supplier', 'nama_barang', 'merek', 'harga', 'jumlah', 'jenis', 'satuan', 'deskripsi'];

    public function getRincianBarangKeluar($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function insertRincianBarangKeluar($data)
    {
        return $this->insert($data);
    }

    public function updateRincianBarangKeluar($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteRincianBarangKeluar($id)
    {
        return $this->delete($id);
    }
}
