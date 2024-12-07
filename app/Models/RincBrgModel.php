<?php

namespace App\Models;

use CodeIgniter\Model;

class RincBrgModel extends Model
{
    protected $table = 'rinc_brg_keluar';
    protected $primaryKey = 'id_rinc_keluar';
    protected $allowedFields = ['id_barang_keluar', 'id_inventory', 'nama_barang', 'merek', 'harga', 'jumlah', 'kategori', 'satuan',  'deskripsi'];

    public function getAllBarang()
    {
        return $this->findAll();
    }

    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluarModel::class, 'id_barang_keluar', 'id_barang_keluar');
    }


    public function getBarangBybarangKeluar($idBarangKeluar)
    {
        return $this->where('id_barang_keluar', $idBarangKeluar)->findAll();
    }


    public function getNota($id_barang_keluar)
    {
        return $this->select('merek, harga, jumlah, jenis, satuan, deskripsi')
            ->where('id_barang_keluar', $id_barang_keluar)
            ->findAll();
    }


    public function getNamaInputBarang()
    {
        return $this->select('nama_barang')->findAll();
    }

    public function getNamaBarang($id)
    {
        return $this->find($id)['nama_supplier'] ?? '';
    }

    public function simpanBarang($data)
    {
        return $this->insert($data);
    }

    public function getBarangById($id)
    {
        return $this->find($id);
    }

    public function editBarang($id, $data)
    {
        return $this->update($id, $data);
    }

    public function hapusBarang($id)
    {
        return $this->delete($id);
    }

    public function hapusDetailbarang($id_barang_keluar)
    {
        return $this->where('id_barang_keluar', $id_barang_keluar)->delete();
    }


    public function getKategori($id_barang)
    {
        return $this->db->table('barang_kategori')
            ->join('kategori', 'kategori.id_kategori = barang_kategori.id_kategori')
            ->where('id_barang', $id_barang)
            ->get()
            ->getResultArray();
    }

    public function getSupplier($id_barang)
    {
        return $this->db->table('barang_supplier')
            ->join('supplier', 'supplier.id_supplier = barang_supplier.id_supplier')
            ->where('id_barang', $id_barang)
            ->get()
            ->getResultArray();
    }

    public function getKategoriBarang()
    {
        return $this->distinct()->select('kategori')->findAll();
    }

    public function getJumlahBarangKeluarPerKategori()
    {
        $builder = $this->db->table('rinc_brg_keluar');
        $builder->select('kategori, COUNT(*) AS jumlah_barang');
        $builder->groupBy('kategori');
        $result = $builder->get()->getResultArray();

        return $result;
    }
}
