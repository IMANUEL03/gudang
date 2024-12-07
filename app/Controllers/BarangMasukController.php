<?php

namespace App\Controllers;

use App\Models\InventoryModel;
use App\Models\KategoriModel;
use App\Models\SupplierModel;
use App\Models\TempBarangModel;
use App\Models\BarangModel;
use App\Models\BarangMasukModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BarangMasukController extends BaseController
{
    public function barangmasuk()
    {
        $supplierModel = new SupplierModel();
        $data['suppliers'] = $supplierModel->getAllSupplier();
        $barangMasukModel = new BarangMasukModel();
        $data['laporan'] = $barangMasukModel->getBarangMasuk();
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->getAllKategori();


        // Tambahkan kode untuk mengambil data detail barang
        foreach ($data['laporan'] as $key => $laporan) {
            $barangModel = new BarangModel();
            $detail_barang = $barangModel->where('id_barang_masuk', $laporan['id_barang_masuk'])->findAll();
            $data['laporan'][$key]['detail_barang'] = $detail_barang;
        }

        return view('ArusBarang/barang_masuk', $data);
    }

    public function tambahbarangmasuk()
    {
        $barangMasukModel = new BarangMasukModel();
        $data['laporan'] = $barangMasukModel->getBarangMasuk();
        $tempBarangModel = new TempBarangModel();
        $data['barang'] = $tempBarangModel->getAll();
        $supplierModel = new SupplierModel();
        $data['suppliers'] = $supplierModel->getAllSupplier();
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->getAllKategori();
        return view('ArusBarang/tambah_barang_masuk', $data);
    }

    public function simpanBarangMasuk()
    {
        $no_spk = $this->request->getPost('no_spk');
        $tgl_spk = $this->request->getPost('tgl_spk');
        $no_ba_penerimaan = $this->request->getPost('no_ba_penerimaan');
        $tgl_ba_penerimaan = $this->request->getPost('tgl_ba_penerimaan');
        $supplier = $this->request->getPost('supplier');

        $barangMasukModel = new BarangMasukModel();

        $dataBarangMasuk = [
            'no_spk' => $no_spk,
            'tgl_spk' => $tgl_spk,
            'no_ba_penerimaan' => $no_ba_penerimaan,
            'tgl_ba_penerimaan' => $tgl_ba_penerimaan,
            'supplier' => $supplier,
        ];

        $barangMasukModel->insert($dataBarangMasuk);

        $lastInsertId = $barangMasukModel->insertID();
        $tempBarangModel = new TempBarangModel();
        $tempBarang = $tempBarangModel->getAll(); // Ambil semua data barang sementara

        foreach ($tempBarang as $barang) {
            $dataBarang = [
                'id_barang_masuk' => $lastInsertId,
                'nama_barang' => $barang['nama_barang'],
                'merek' => $barang['merek'],
                'harga' => $barang['harga'],
                'jumlah' => $barang['jumlah'],
                'kategori' => $barang['kategori'],
                'satuan' => $barang['satuan'],
                'deskripsi' => $barang['deskripsi'],
            ];

            $barangModel = new BarangModel();
            $barangModel->insert($dataBarang);
        }

        $tempBarangModel = new TempBarangModel();
        $tempBarang = $tempBarangModel->getAll(); // Ambil semua data barang sementara

        foreach ($tempBarang as $barang) {
            $dataBarang = [
                'nama_barang' => $barang['nama_barang'],
                'merek' => $barang['merek'],
                'harga' => $barang['harga'],
                'jumlah' => $barang['jumlah'],
                'kategori' => $barang['kategori'],
                'satuan' => $barang['satuan'],
                'deskripsi' => $barang['deskripsi'],
            ];

            $inventoryModel = new InventoryModel();
            $inventoryModel->tambahInventory($dataBarang);
        }
        $tempBarangModel->truncate(); // Hapus semua data barang sementara setelah disimpan ke tabel barang

        return redirect()->to(base_url('/barangmasuk'))->with('success', 'Data barang masuk berhasil disimpan');
    }

    public function editbarangmasuk($id)
    {
        $no_spk = $this->request->getPost('no_spk');
        $tgl_spk = $this->request->getPost('tgl_spk');
        $no_ba_penerimaan = $this->request->getPost('no_ba_penerimaan');
        $tgl_ba_penerimaan = $this->request->getPost('tgl_ba_penerimaan');
        $supplier = $this->request->getPost('supplier');

        $barangMasukModel = new BarangMasukModel();

        $data = [
            'no_spk' => $no_spk,
            'tgl_spk' => $tgl_spk,
            'no_ba_penerimaan' => $no_ba_penerimaan,
            'tgl_ba_penerimaan' => $tgl_ba_penerimaan,
            'supplier' => $supplier,
        ];

        $barangMasukModel->updateBarangMasuk($id, $data);
    }

    public function hapusbarangmasuk($id)
    {
        $barangModel = new BarangModel();

        // Hapus terlebih dahulu semua detail barang terkait dengan barang masuk
        $deletedDetail = $barangModel->hapusDetailBarangMasuk($id);


        if ($deletedDetail) {
            // Jika detail barang berhasil dihapus, lanjutkan untuk menghapus barang masuk
            $barangMasukModel = new BarangMasukModel();
            $deleted = $barangMasukModel->delete($id);


            if ($deleted) {
                // Jika barang masuk berhasil dihapus juga
                return $this->response->setJSON(['status' => 'success', 'message' => 'Barang masuk dan detailnya berhasil dihapus']);
            } else {
                // Jika gagal menghapus barang masuk
                return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus barang masuk']);
            }
        } else {
            // Jika gagal menghapus detail barang
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus detail barang masuk']);
        }
    }

    public function hapusDetailBarang($id_barang)
    {
        $barangModel = new BarangModel();
        $deleted = $barangModel->hapusBarang($id_barang);

        if ($deleted) {
            // Data berhasil dihapus
            return $this->response->setJSON(['status' => 'success', 'message' => 'Detail barang berhasil dihapus']);
        } else {
            // Gagal menghapus data
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus detail barang']);
        }
    }


    public function tambahDetailBarang()
    {
        $id_barang_masuk = $this->request->getPost('id_barang_masuk');
        $nama_barang = $this->request->getPost('nama_barang');
        $merek = $this->request->getPost('merek');
        $harga = $this->request->getPost('harga');
        $jumlah = $this->request->getPost('jumlah');
        $kategori = $this->request->getPost('kategori');
        $satuan = $this->request->getPost('satuan');
        $deskripsi = $this->request->getPost('deskripsi');

        $data = [
            'id_barang_masuk' => $id_barang_masuk,
            'nama_barang' => $nama_barang,
            'merek' => $merek,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'kategori' => $kategori,
            'satuan' => $satuan,
            'deskripsi' => $deskripsi,
        ];

        $barangModel = new BarangModel();
        $barangModel->insert($data);
        $inventoryModel = new InventoryModel();
        $inventoryModel->tambahInventory($data);


        return redirect()->back()->with('success', 'Data detail barang berhasil ditambahkan');
    }

    // Controller function to handle editing data in the detail modal
    public function editDetailBarang()
    {
        // Periksa apakah permintaan merupakan permintaan POST
        if ($this->request->getMethod() === 'post') {
            $barangModel = new BarangModel();

            // Ambil data yang dikirimkan dari form edit di modal
            $id_barang = $this->request->getPost('id_barang');
            $nama_barang = $this->request->getPost('nama_barang');
            $merek = $this->request->getPost('merek');
            $harga = $this->request->getPost('harga');
            $jumlah = $this->request->getPost('jumlah');
            $kategori = $this->request->getPost('kategori');
            $satuan = $this->request->getPost('satuan');
            $deskripsi = $this->request->getPost('deskripsi');

            // Lakukan validasi data jika diperlukan

            // Lakukan update data menggunakan model
            $data = [
                'nama_barang' => $nama_barang,
                'merek' => $merek,
                'harga' => $harga,
                'jumlah' => $jumlah,
                'kategori' => $kategori,
                'satuan' => $satuan,
                'deskripsi' => $deskripsi
            ];

            $barangModel->editBarang($id_barang, $data);

            // Redirect atau kembalikan respon yang sesuai, misalnya dengan menggunakan JSON
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data barang berhasil diubah']);
        }
    }

    public function hapusDetailBarangMasuk($id_barang_masuk)
    {
        $barangModel = new BarangModel();
        $deleted = $barangModel->where('id_barang_masuk', $id_barang_masuk)->delete();

        if ($deleted) {
            // Data berhasil dihapus
            return $this->response->setJSON(['status' => 'success', 'message' => 'Detail barang masuk berhasil dihapus']);
        } else {
            // Gagal menghapus data
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus detail barang masuk']);
        }
    }

    public function tambahNota()
    {
        $nama_barang = $this->request->getPost('nama_barang');
        $merek = $this->request->getPost('merek');
        $harga = $this->request->getPost('harga');
        $jumlah = $this->request->getPost('jumlah');
        $kategori = $this->request->getPost('kategori');
        $satuan = $this->request->getPost('satuan');
        $deskripsi = $this->request->getPost('deskripsi');

        $tempBarangModel = new TempBarangModel();

        $data = [
            'nama_barang' => $nama_barang,
            'merek' => $merek,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'kategori' => $kategori,
            'satuan' => $satuan,
            'deskripsi' => $deskripsi,
        ];

        $tempBarangModel->insert($data);
    }

    public function editnota($id)
    {
        $nama_barang = $this->request->getPost('nama_barang');
        $merek = $this->request->getPost('merek');
        $harga = $this->request->getPost('harga');
        $jumlah = $this->request->getPost('jumlah');
        $kategori = $this->request->getPost('kategori');
        $satuan = $this->request->getPost('satuan');
        $deskripsi = $this->request->getPost('deskripsi');

        $tempBarangModel = new TempbarangModel();

        $data = [
            'nama_barang' => $nama_barang,
            'merek' => $merek,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'kategori' => $kategori,
            'satuan' => $satuan,
            'deskripsi' => $deskripsi,
        ];

        $tempBarangModel->update($id, $data);
    }

    public function hapusnota($id)
    {
        $tempBarangModel = new TempBarangModel();
        $deleted = $tempBarangModel->deleteData($id);

        if ($deleted) {
            // Data berhasil dihapus
            return $this->response->setJSON(['status' => 'success', 'message' => 'kategori barang berhasil dihapus']);
        } else {
            // Gagal menghapus data
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus kategori barang']);
        }
    }
}
