<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['id_barang_masuk', 'nama_barang', 'merek', 'harga', 'jumlah', 'kategori', 'satuan',  'deskripsi'];


    public function getKategoriBarang()
    {
        return $this->distinct()->select('kategori')->findAll();
    }

    public function getAllBarang()
    {
        return $this->findAll();
    }

    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasukModel::class, 'id_barang_masuk', 'id_barang_masuk');
    }


    public function getBarangByBarangMasuk($idBarangMasuk)
    {
        return $this->where('id_barang_masuk', $idBarangMasuk)->findAll();
    }


    public function getNota($id_barang_masuk)
    {
        // Mengambil data nota berdasarkan ID barang masuk
        return $this->select('merek, harga, jumlah, jenis, satuan, deskripsi')
            ->where('id_barang_masuk', $id_barang_masuk)
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

    public function hapusDetailBarangMasuk($id_barang_masuk)
    {
        return $this->where('id_barang_masuk', $id_barang_masuk)->delete();
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
}
