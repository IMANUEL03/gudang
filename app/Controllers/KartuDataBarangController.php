<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\InventoryModel;

use CodeIgniter\HTTP\ResponseInterface;

class KartuDataBarangController extends BaseController
{

    public function index()
    {
        helper(['form']);
        $kategori = $this->request->getPost('kategori');
        $inventoryModel = new InventoryModel();
        $data['kategori_options'] = $this->getKategoriOptions(); // Mengambil daftar kategori untuk dropdown filter

        if (!empty($kategori)) {
            // Jika filter kategori dipilih, ambil data barang berdasarkan kategori
            $data['barang'] = $inventoryModel->where('kategori', $kategori)->findAll();
        } else {
            // Jika tidak ada filter, tampilkan semua data barang
            $data['barang'] = $inventoryModel->getAllInventory();
        }
        session()->set('kartu_data_barang', $data);
        return view('laporan/kartudatabarang', $data);
    }


    public function getKategoriOptions()
    {
        $inventoryModel = new InventoryModel();
        $kategori = $inventoryModel->distinct()->select('kategori')->findAll();
        $options = [];
        foreach ($kategori as $row) {
            $options[$row['kategori']] = $row['kategori'];
        }
        return $options;
    }


    public function exportToExcel()
    {
        $data = session()->get('kartu_data_barang'); // Ganti 'laporan_penerimaan_barang' menjadi 'kartu_data_barang'
        if ($data) { // Pastikan $data tidak null
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama Barang');
            $sheet->setCellValue('C1', 'Merek');
            $sheet->setCellValue('D1', 'Harga');
            $sheet->setCellValue('E1', 'Jumlah');
            $sheet->setCellValue('F1', 'Kategori');
            $sheet->setCellValue('G1', 'Satuan');
            $sheet->setCellValue('H1', 'Deskripsi');
            $sheet->setCellValue('I1', 'QTY');


            $row = 2;
            $no = 1;
            foreach ($data['barang'] as $barang) {
                $sheet->setCellValue('A' . $row, $no);
                $sheet->setCellValue('B' . $row, $barang['nama_barang']);
                $sheet->setCellValue('C' . $row, $barang['merek']);
                $sheet->setCellValue('D' . $row, $barang['harga']);
                $sheet->setCellValue('E' . $row, $barang['jumlah']);
                $sheet->setCellValue('F' . $row, $barang['kategori']);
                $sheet->setCellValue('G' . $row, $barang['satuan']);
                $sheet->setCellValue('H' . $row, $barang['deskripsi']);
                $sheet->setCellValue('I' . $row, $barang['harga'] * $barang['jumlah']);
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


        $writer = new Xlsx($spreadsheet);
        $filename = 'inventory_data_' . date('YmdHis') . '.xlsx';
        $writer->save($filename);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($filename);
    }
}
