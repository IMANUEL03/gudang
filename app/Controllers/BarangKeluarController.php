<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\InventoryModel;
use App\Models\KategoriModel;
use App\Models\SupplierModel;
use App\Models\TempBarangModel;
use App\Models\RincBrgModel;
use App\Models\BarangKeluarModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BarangKeluarController extends BaseController
{

    public function barangkeluar()
    {
        $supplierModel = new SupplierModel();
        $data['suppliers'] = $supplierModel->getAllSupplier();
        $barangKeluarModel = new BarangKeluarModel();
        $data['laporan'] = $barangKeluarModel->getbarangKeluar();
        $inventoryModel = new InventoryModel();
        $data['inventories'] = $inventoryModel->findAll();

        // Tambahkan kode untuk mengambil data detail barang
        foreach ($data['laporan'] as $key => $laporan) {
            $rincBrgModel = new RincBrgModel();
            $detail_barang = $rincBrgModel->where('id_barang_keluar', $laporan['id_barang_keluar'])->findAll();
            $data['laporan'][$key]['detail_barang'] = $detail_barang;
        }

        return view('ArusBarang/barang_keluar', $data);
    }

    public function editbarangkeluar($id)
    {
        $peruntukan = $this->request->getPost('peruntukan');
        $tanggal_penyerahan = $this->request->getPost('tanggal_penyerahan');
        $penerima = $this->request->getPost('penerima');
        $bukti_pengambilan = $this->request->getPost('bukti_pengambilan');

        $barangKeluarModel = new BarangKeluarModel();

        $data = [
            'peruntukan' => $peruntukan,
            'tanggal_penyerahan' => $tanggal_penyerahan,
            'penerima' => $penerima,
            'bukti_pengambilan' => $bukti_pengambilan,
        ];

        $barangKeluarModel->updateBarangKeluar($id, $data);
    }

    public function hapusbarangkeluar($id)
    {
        $rincBrgModel = new RincBrgModel();

        $deletedDetail = $rincBrgModel->hapusDetailbarang($id);

        if ($deletedDetail) {
            $barangKeluarModel = new BarangKeluarModel();
            $deleted = $barangKeluarModel->deletebarangKeluar($id);

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

    public function tambahDetailBarang()
    {
        $id_barang_keluar = $this->request->getPost('id_barang_keluar');
        $nama_barang = $this->request->getPost('nama_barang');
        $merek = $this->request->getPost('merek');
        $harga = $this->request->getPost('harga');
        $jumlah = $this->request->getPost('jumlah');
        $kategori = $this->request->getPost('kategori');
        $satuan = $this->request->getPost('satuan');
        $deskripsi = $this->request->getPost('deskripsi');

        $data = [
            'id_barang_keluar' => $id_barang_keluar,
            'nama_barang' => $nama_barang,
            'merek' => $merek,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'kategori' => $kategori,
            'satuan' => $satuan,
            'deskripsi' => $deskripsi,
        ];

        $rincBrgKeluar = new RincBrgModel();
        $rincBrgKeluar->simpanBarang($data);
        $inventoryModel = new InventoryModel();
        $inventoryModel->tambahAtauPerbaruiInventory($data);

        return redirect()->back()->with('success', 'Data detail barang berhasil ditambahkan');
    }

    public function editDetailBarang()
    {
        // Periksa apakah permintaan merupakan permintaan POST
        if ($this->request->getMethod() === 'post') {
            $rincBrgModel = new RincBrgModel();

            // Ambil data yang dikirimkan dari form edit di modal
            $id_rinc_keluar = $this->request->getPost('id_rinc_keluar');
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

            $rincBrgModel->editBarang($id_rinc_keluar, $data);
            $inventoryModel = new InventoryModel();
            $inventoryModel->tambahAtauPerbaruiInventory($data);


            // Redirect atau kembalikan respon yang sesuai, misalnya dengan menggunakan JSON
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data barang berhasil diubah']);
        }
    }

    // Controller
    public function hapusDetailBarangKeluar($id_rinc_keluar)
    {
        $rincBrgModel = new RincBrgModel();
        $deleted = $rincBrgModel->hapusDetailbarang($id_rinc_keluar);

        if ($deleted) {
            // Data berhasil dihapus
            return $this->response->setJSON(['status' => 'success', 'message' => 'Detail barang keluar berhasil dihapus']);
        } else {
            // Gagal menghapus data
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus detail barang keluar']);
        }
    }


    // HALAMAN TAMBAH DATA BARANG KELUAR
    public function tambahbarangkeluar()
    {
        $barangKeluarModel = new BarangKeluarModel();
        $data['laporan'] = $barangKeluarModel->getbarangKeluar();
        $tempBarangModel = new TempBarangModel();
        $data['barang'] = $tempBarangModel->getAll();
        $supplierModel = new SupplierModel();
        $data['suppliers'] = $supplierModel->getAllSupplier();
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->getAllKategori();
        $inventoryModel = new InventoryModel();
        $data['inventories'] = $inventoryModel->findAll();

        return view('ArusBarang/tambah_barang_keluar', $data);
    }

    public function simpanbarangkeluar()
    {
        // Ambil data dari formulir
        $peruntukan = $this->request->getPost('peruntukan');
        $tanggal_penyerahan = $this->request->getPost('tanggal_penyerahan');
        $penerima = $this->request->getPost('penerima');

        // Tangani unggahan file
        $file = $this->request->getFile('bukti_pengambilan');
        $nama_file = '';

        if ($file && $file->isValid() && !$file->hasMoved()) { // Periksa apakah file ada sebelum mencoba mengakses metode isValid()
            $nama_file = $file->getRandomName(); // Beri nama acak pada file
            $file->move('./uploads', $nama_file); // Pindahkan file ke direktori uploads
        }

        // Simpan data ke dalam database
        $barangKeluarModel = new BarangKeluarModel();

        $dataBarangKeluar = [
            'peruntukan' => $peruntukan,
            'tanggal_penyerahan' => $tanggal_penyerahan,
            'penerima' => $penerima,
            'bukti_pengambilan' => $nama_file, // Simpan nama file di database
        ];

        $barangKeluarModel->insert($dataBarangKeluar);

        $lastInsertId = $barangKeluarModel->insertID();
        $tempBarangModel = new TempBarangModel();
        $tempBarang = $tempBarangModel->getAll(); // Ambil semua data barang sementara

        foreach ($tempBarang as $barang) {
            $dataBarang = [
                'id_barang_keluar' => $lastInsertId,
                'nama_barang' => $barang['nama_barang'],
                'merek' => $barang['merek'],
                'harga' => $barang['harga'],
                'jumlah' => $barang['jumlah'],
                'kategori' => $barang['kategori'],
                'satuan' => $barang['satuan'],
                'deskripsi' => $barang['deskripsi'],
            ];

            $rincBrgModel = new RincBrgModel();
            $rincBrgModel->insert($dataBarang);
            $inventoryModel = new InventoryModel();
            $inventoryModel->tambahAtauPerbaruiInventory($dataBarang);
        }

        $tempBarangModel->truncate(); // Hapus semua data barang sementara setelah disimpan ke tabel barang

        return redirect()->to(base_url('/barangkeluar'))->with('success', 'Data barang masuk berhasil disimpan');
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

    public function exportToPDF()
    {
        $tempBarangModel = new TempBarangModel();
        $data['barang'] = $tempBarangModel->getAll();

        $html = view('notaexport_pdf', $data); // Buat view untuk tampilan PDF

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('nota_barang_keluar.pdf');
    }
}
