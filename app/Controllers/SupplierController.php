<?php

namespace App\Controllers;

use App\Models\SupplierModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class SupplierController extends Controller
{
    protected $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
    }

    public function supplier()
    {
        $supplierModel = new SupplierModel();
        $data['supplier'] = $supplierModel->getAllSupplier();

        return view('MasterData/supplier', $data);
    }

    public function simpansupplier()
    {
        $nama_supplier = $this->request->getPost('nama_supplier');
        $alamat = $this->request->getPost('alamat');
        $kontak = $this->request->getPost('kontak');

        $supplierModel = new SupplierModel();

        $data = [
            'nama_supplier' => $nama_supplier,
            'alamat' => $alamat,
            'kontak' => $kontak
        ];

        $supplierModel->insert($data);

        return 'Data supplier berhasil disimpan';
    }

    public function editSupplier($id)
    {
        $nama_supplier = $this->request->getPost('nama_supplier');
        $alamat = $this->request->getPost('alamat');
        $kontak = $this->request->getPost('kontak');

        $data = [
            'nama_supplier' => $nama_supplier,
            'alamat' => $alamat,
            'kontak' => $kontak
        ];

        $supplierModel = new SupplierModel();
        $supplierModel->update($id, $data);

        return 'Data supplier berhasil diupdate';
    }

    public function hapusSupplier($id)
    {
        $supplierModel = new SupplierModel();
        $deleted = $supplierModel->hapusSupplier($id);

        if ($deleted) {
            // Data berhasil dihapus
            return $this->response->setJSON(['status' => 'success', 'message' => 'Jenis barang berhasil dihapus']);
        } else {
            // Gagal menghapus data
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus jenis barang']);
        }
    }
}
