<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\Controller;

class KategoriController extends BaseController
{

    public function kategori()
    {
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->getAllKategori();

        return view('MasterData/viewkategori', $data);
    }

    public function simpankategori()
    {
        $request = $this->request->getPost();

        $kategoriModel = new KategoriModel();
        $inserted = $kategoriModel->tambahKategori($request);

        if ($inserted) {
            // Data berhasil ditambahkan
            return $this->response->setJSON(['status' => 'success', 'message' => 'Jenis barang berhasil ditambahkan']);
        } else {
            // Gagal menambahkan data
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menambahkan jenis barang']);
        }
    }

    public function updateKategori($id)
    {
        $request = $this->request->getPost();

        $kategoriModel = new KategoriModel();
        $updated = $kategoriModel->editKategori($id, $request);

        if ($updated) {
            // Data berhasil diubah
            return $this->response->setJSON(['status' => 'success', 'message' => 'Jenis barang berhasil diubah']);
        } else {
            // Gagal mengubah data
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengubah jenis barang']);
        }
    }

    public function hapusKategori($id)
    {
        $kategoriModel = new KategoriModel();
        $deleted = $kategoriModel->hapusKategori($id);

        if ($deleted) {
            // Data berhasil dihapus
            return $this->response->setJSON(['status' => 'success', 'message' => 'Jenis barang berhasil dihapus']);
        } else {
            // Gagal menghapus data
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus jenis barang']);
        }
    }
}
