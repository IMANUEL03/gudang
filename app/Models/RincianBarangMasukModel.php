<?php

namespace App\Models;

use CodeIgniter\Model;

class RincianBarangMasukModel extends Model
{
    protected $table = 'rincian_barang_masuk';
    protected $primaryKey = 'id_rincianbarang_masuk';
    protected $allowedFields = ['id_barang_masuk', 'id_barang', 'id_kategori', 'id_supplier', 'nama_barang', 'merek', 'harga', 'jumlah', 'jenis', 'satuan', 'deskripsi'];

    public function getRincianBarangMasuk($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function getDetailBarangLaporan()
    {
        return $this->select('nama_barang, merek, harga, jumlah, jenis, satuan, deskripsi')->findAll();
    }

    public function insertRincianBarangMasuk($data)
    {
        return $this->insert($data);
    }

    public function updateRincianBarangMasuk($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteRincianBarangMasuk($id)
    {
        return $this->delete($id);
    }
}
