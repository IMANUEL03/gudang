<?php

namespace App\Controllers;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Controllers\BaseController;
use App\Models\InventoryModel;

use CodeIgniter\HTTP\ResponseInterface;

class BarangController extends BaseController
{


    public function barang()
    {
        $inventoryModel = new InventoryModel();
        $data['barang'] = $inventoryModel->getAllInventory();
        return view('MasterData/barang', $data);
    }


    public function editBarang($id)
    {
        $nama_barang = $this->request->getPost('nama_barang');
        $merek = $this->request->getPost('merek');
        $harga = $this->request->getPost('harga');
        $jumlah = $this->request->getPost('jumlah');
        $kategori = $this->request->getPost('kategori');
        $satuan = $this->request->getPost('satuan');
        $deskripsi = $this->request->getPost('deskripsi');

        $inventoryModel = new InventoryModel();

        $data = [
            'nama_barang' => $nama_barang,
            'merek' => $merek,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'kategori' => $kategori,
            'satuan' => $satuan,
            'deskripsi' => $deskripsi,
        ];

        $inventoryModel->editInventory($id, $data);
    }

    public function hapusBarang($id)
    {
        $inventoryModel = new InventoryModel();
        $deleted = $inventoryModel->hapusInventory($id);

        if ($deleted) {
            // Data berhasil dihapus
            return $this->response->setJSON(['status' => 'success', 'message' => 'kategori barang berhasil dihapus']);
        } else {
            // Gagal menghapus data
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus kategori barang']);
        }
    }
}
