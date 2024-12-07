<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'id_inventory';
    protected $allowedFields = ['nama_barang', 'merek', 'harga', 'jumlah', 'kategori', 'satuan', 'deskripsi'];


    public function getAllInventory($kategori = null)
    {
        if ($kategori) {
            return $this->where('kategori', $kategori)->findAll();
        } else {
            return $this->findAll();
        }
    }


    public function getInventoryByNamaBarang($nama_barang)
    {
        return $this->where('nama_barang', $nama_barang)->first();
    }

    public function tambahAtauPerbaruiInventory($data)
    {
        $existing_inventory = $this->getInventoryByNamaBarang($data['nama_barang']);

        if ($existing_inventory) {
            // Jika ada inventory dengan nama barang yang sama, update jumlahnya
            $updated_jumlah = $existing_inventory['jumlah'] - $data['jumlah'];
            $this->update($existing_inventory['id_inventory'], ['jumlah' => $updated_jumlah]);
        } else {
            // Jika tidak ada inventory dengan nama barang yang sama, tambahkan data baru
            $this->insert($data);
        }
    }

    public function tambahAtauPerbaruiInventoryhapus($data)
    {
        $existing_inventory = $this->getInventoryByNamaBarang($data['nama_barang']);

        if ($existing_inventory) {
            // Jika ada inventory dengan nama barang yang sama, update jumlahnya
            $updated_jumlah = $existing_inventory['jumlah'] + $data['jumlah'];
            $this->update($existing_inventory['id_inventory'], ['jumlah' => $updated_jumlah]);
        } else {
            // Jika tidak ada inventory dengan nama barang yang sama, tambahkan data baru
            $this->insert($data);
        }
    }




    public function getInventoryById($id)
    {
        return $this->find($id);
    }

    public function tambahInventory($data)
    {
        return $this->insert($data);
    }

    public function editInventory($id, $data)
    {
        return $this->update($id, $data);
    }

    public function hapusInventory($id)
    {
        return $this->delete($id);
    }
}
