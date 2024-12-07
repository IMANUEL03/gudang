<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_barang_masuk';
    protected $allowedFields = ['id_barang_masuk', 'no_spk', 'tgl_spk', 'no_ba_penerimaan', 'tgl_ba_penerimaan', 'supplier',];


    public function barangs()
    {
        return $this->hasMany(BarangModel::class, 'id_barang_masuk', 'id_barang_masuk');
    }

    public function getBarangMasuk($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function insertBarangMasuk($data)
    {
        return $this->insert($data);
    }

    public function updateBarangMasuk($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteBarangMasuk($id)
    {
        return $this->delete($id);
    }

    public function getRincianBarangMasuk($id_barang_masuk)
    {
        $barangModel = new BarangModel();
        return $barangModel->where('id_barang_masuk', $id_barang_masuk)->findAll();
    }

    public function getBarangMasukByMonth($bulan)
    {
        return $this->where('DATE_FORMAT(tgl_spk, "%Y-%m")', $bulan)->findAll();
    }
}
