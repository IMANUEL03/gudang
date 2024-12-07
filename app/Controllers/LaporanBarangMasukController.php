<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangMasukModel;

class LaporanBarangMasukController extends BaseController
{

    public function penerimaanBarang()
    {
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $kategori = $this->request->getPost('kategori');

        $barangMasukModel = new BarangMasukModel();
        $laporan = $barangMasukModel->getBarangMasuk();

        // Filter data berdasarkan bulan dan tahun jika bulan dan tahun dipilih
        if (!empty($bulan) && !empty($tahun)) {
            $filteredLaporan = [];
            foreach ($laporan as $data) {
                $tgl_spk = date('Y-m', strtotime($data['tgl_spk']));
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
                $barangModel = new BarangModel();
                $detail_barang = $barangModel->where('id_barang_masuk', $data['id_barang_masuk'])
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
            $barangModel = new BarangModel();
            $detail_barang = $barangModel->where('id_barang_masuk', $laporanItem['id_barang_masuk'])->findAll();
            $laporan[$key]['detail_barang'] = $detail_barang;
        }

        // Simpan data yang sudah difilter ke dalam session
        session()->set('laporan_penerimaan_barang', $laporan);

        $barangModel = new BarangModel();
        $data['kategori_barang'] = $barangModel->getKategoriBarang();
        $data['laporan'] = $laporan;

        return view('laporan/penerimaanbarangmasuk', $data);
    }


    public function exportPenerimaanExcel()
    {
        // Ambil data laporan dari session
        $laporan = session()->get('laporan_penerimaan_barang');

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()
            ->setCreator('Your Name')
            ->setTitle('Buku Penerimaan Barang')
            ->setSubject('Buku Penerimaan Barang')
            ->setDescription('Buku Penerimaan Barang');

        // Add data to the spreadsheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nomor SPK');
        $sheet->setCellValue('C1', 'Tanggal SPK');
        $sheet->setCellValue('D1', 'Nomor BA Penerimaan');
        $sheet->setCellValue('E1', 'Tanggal BA Penerimaan');
        $sheet->setCellValue('F1', 'Supplier');
        $sheet->setCellValue('G1', 'Nama Barang');
        $sheet->setCellValue('H1', 'Merek');
        $sheet->setCellValue('I1', 'Harga');
        $sheet->setCellValue('J1', 'Jumlah');
        $sheet->setCellValue('K1', 'Kategori');
        $sheet->setCellValue('L1', 'Satuan');
        $sheet->setCellValue('M1', 'Total Harga');
        $sheet->setCellValue('N1', 'Deskripsi');

        $row = 2;
        $no = 1;
        foreach ($laporan as $i => $data) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $data['no_spk']);
            $sheet->setCellValue('C' . $row, $data['tgl_spk']);
            $sheet->setCellValue('D' . $row, $data['no_ba_penerimaan']);
            $sheet->setCellValue('E' . $row, $data['tgl_ba_penerimaan']);
            $sheet->setCellValue('F' . $row, $data['supplier']);

            foreach ($data['detail_barang'] as $barang) {
                $sheet->setCellValue('G' . $row, $barang['nama_barang']);
                $sheet->setCellValue('H' . $row, $barang['merek']);
                $sheet->setCellValue('I' . $row, $barang['harga']);
                $sheet->setCellValue('J' . $row, $barang['jumlah']);
                $sheet->setCellValue('K' . $row, $barang['kategori']);
                $sheet->setCellValue('L' . $row, $barang['satuan']);
                $sheet->setCellValue('M' . $row, $barang['harga'] * $barang['jumlah']);
                $sheet->setCellValue('N' . $row, $barang['deskripsi']);
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
        $sheet->getColumnDimension('J')->setWidth(10);
        $sheet->getColumnDimension('K')->setWidth(15);
        $sheet->getColumnDimension('L')->setWidth(10);
        $sheet->getColumnDimension('M')->setWidth(15);
        $sheet->getColumnDimension('N')->setWidth(30);

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
        header('Content-Disposition: attachment;filename="buku_penerimaan_barang.xlsx"');
        header('Cache-Control: max-age=0');

        // Write the Excel file to the output
        $writer->save('php://output');
    }

    public function grafikBarangMasukPerKategori()
    {
        $barangModel = new BarangModel();
        $data = $barangModel->select('kategori, COUNT(*) as jumlah_barang')
            ->groupBy('kategori')
            ->findAll();

        return json_encode($data);
    }
}
