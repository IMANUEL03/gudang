<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    protected $allowedFields = ['id_barang_keluar', 'peruntukan', 'tanggal_penyerahan', 'penerima', 'bukti_pengambilan'];

    public function barangs()
    {
        return $this->hasMany(RincBrgModel::class, 'id_barang_keluar', 'id_barang_keluar');
    }

    public function getbarangKeluar($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function insertbarangKeluar($data)
    {
        return $this->insert($data);
    }

    public function updatebarangKeluar($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deletebarangKeluar($id)
    {
        return $this->delete($id);
    }

    public function getRincianbarangKeluar($id_barang_keluar)
    {
        $rincBrgModel = new RincBrgModel();
        return $rincBrgModel->where('id_barang_keluar', $id_barang_keluar)->findAll();
    }

    public function getBarangKeluarByMonthYear($bulan, $tahun)
    {
        return $this->where('MONTH(tanggal_penyerahan)', $bulan)
            ->where('YEAR(tanggal_penyerahan)', $tahun)
            ->findAll();
    }

    public function getBarangKeluarByKategori($kategori)
    {
        return $this->where('kategori', $kategori)->findAll();
    }
}
