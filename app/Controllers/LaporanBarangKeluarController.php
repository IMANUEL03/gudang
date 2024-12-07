<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\SupplierModel;
use App\Models\BarangKeluarModel;
use App\Models\RincBrgModel;

class LaporanBarangKeluarController extends BaseController
{
    public function pengeluaranbarang()
    {
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $kategori = $this->request->getPost('kategori');

        $supplierModel = new SupplierModel();
        $data['suppliers'] = $supplierModel->getAllSupplier();

        $barangKeluarModel = new BarangKeluarModel();
        $laporan = $barangKeluarModel->getBarangKeluar();

        // Filter data berdasarkan bulan dan tahun jika bulan dan tahun dipilih
        if (!empty($bulan) && !empty($tahun)) {
            $filteredLaporan = [];
            foreach ($laporan as $data) {
                $tgl_spk = date('Y-m', strtotime($data['tanggal_penyerahan']));
                if ($tgl_spk == "$tahun-$bulan") {
                    $filteredLaporan[] = $data;
                }
            }
            $laporan = $filteredLaporan;
        }

        // Filter data berdasarkan kategori jika kategori dipilih
        if (!empty($kategori)) {
            $filteredLaporan = [];
            foreach ($laporan as $data) {
                $rincBrgModel = new RincBrgModel();
                $detail_barang = $rincBrgModel->where('id_barang_keluar', $data['id_barang_keluar'])
                    ->where('kategori', $kategori)
                    ->findAll();
                if (!empty($detail_barang)) {
                    $filteredLaporan[] = $data;
                }
            }
            $laporan = $filteredLaporan;
        }

        // Tambahkan kode untuk mengambil data detail barang
        foreach ($laporan as $key => $laporanItem) {
            // Pastikan $laporanItem memiliki kunci 'id_barang_keluar'
            $id_barang_keluar = $laporanItem['id_barang_keluar'] ?? null;

            // Cek apakah $id_barang_keluar tidak null sebelum menggunakan dalam query
            if ($id_barang_keluar) {
                $rincBrgModel = new RincBrgModel();
                $detail_barang = $rincBrgModel->where('id_barang_keluar', $id_barang_keluar)->findAll();
                $laporan[$key]['detail_barang'] = $detail_barang;
            } else {
                // Jika id_barang_keluar tidak tersedia, berikan peringatan atau lakukan penanganan yang sesuai
                // Misalnya:
                // log_message('warning', 'id_barang_keluar tidak tersedia untuk item ke-' . $key);
            }
        }

        // Simpan data yang sudah difilter ke dalam session
        session()->set('laporan_penerimaan_barang_keluar', $laporan);

        $rincBrgModel = new RincBrgModel();
        $data['kategori_barang'] = $rincBrgModel->getKategoriBarang();
        $data['laporan'] = $laporan;

        return view('laporan/pengeluaranbarangkeluar', $data);
    }

    public function exportPenerimaanExcel()
    {
        // Ambil data laporan dari session
        $laporan = session()->get('laporan_penerimaan_barang_keluar');

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('Your Name')
            ->setTitle('Laporan Pengeluaran Barang')
            ->setSubject('Laporan Pengeluaran Barang')
            ->setDescription('Laporan Pengeluaran Barang');

        // Add data to the spreadsheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Peruntukan');
        $sheet->setCellValue('C1', 'Tanggal Penyerahan');
        $sheet->setCellValue('D1', 'Penerima');
        $sheet->setCellValue('E1', 'Nama Barang');
        $sheet->setCellValue('F1', 'Merek');
        $sheet->setCellValue('G1', 'Jumlah');
        $sheet->setCellValue('H1', 'Kategori');
        $sheet->setCellValue('I1', 'Satuan');
        $sheet->setCellValue('J1', 'Deskripsi');

        $row = 2;
        $no = 1;
        foreach ($laporan as $i => $data) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $data['peruntukan']);
            $sheet->setCellValue('C' . $row, $data['tanggal_penyerahan']);
            $sheet->setCellValue('D' . $row, $data['penerima']);

            foreach ($data['detail_barang'] as $barang) {
                $sheet->setCellValue('E' . $row, $barang['nama_barang']);
                $sheet->setCellValue('F' . $row, $barang['merek']);
                $sheet->setCellValue('G' . $row, $barang['jumlah']);
                $sheet->setCellValue('H' . $row, $barang['kategori']);
                $sheet->setCellValue('I' . $row, $barang['satuan']);
                $sheet->setCellValue('J' . $row, $barang['deskripsi']);
                $row++;
            }

            $no++;
        }

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(15);

        // Set table style
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $sheet->getStyle('A1:N1')->applyFromArray($styleArray);

        // Create a new Excel file
        $writer = new Xlsx($spreadsheet);

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="laporan_pengeluaran_barang.xlsx"');
        header('Cache-Control: max-age=0');

        // Write the Excel file to the output
        $writer->save('php://output');
    }

    public function grafikBarangKeluarPerKategori()
    {
        $rincBrgModel = new RincBrgModel();
        $data = $rincBrgModel->getJumlahBarangKeluarPerKategori();

        return $this->response->setJSON($data);
    }
}
