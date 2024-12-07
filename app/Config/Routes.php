<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


//  logout
$routes->get('/logout', 'LoginController::logout');

// register
$routes->get('/register', 'RegisterController::index');
$routes->post('/register', 'RegisterController::register');

// login
$routes->get('/', 'LoginController::index');
$routes->post('login', 'LoginController::login');
$routes->get('logout', 'LoginController::logout');

//Dashboard
$routes->get('/Dashboard', 'Main::dashboard');

//MasterData/Barang
$routes->get('/barang', 'BarangController::barang');
$routes->post('/simpanBarang', 'BarangController::SimpanBarang');
$routes->post('/updateBarang/(:num)', 'BarangController::editBarang/$1');
$routes->post('/hapusBarang/(:num)', 'BarangController::hapusBarang/$1');
$routes->get('printToWord', 'BarangController::exportWord');
$routes->get('printToExcell', 'BarangController::exportExcel');
$routes->get('exportPdf', 'BarangController::exportPdf');


//MasterData/Kategori
$routes->get('/kategori', 'KategoriController::kategori');
$routes->post('/simpanKategori', 'KategoriController::simpankategori');
$routes->post('/updatekategori/(:num)', 'KategoriController::updateKategori/$1');
$routes->post('/hapuskategori/(:num)', 'KategoriController::hapusKategori/$1');

//MasterData/Supplier
$routes->get('/supplier', 'SupplierController::supplier');
$routes->post('/simpansupplier', 'SupplierController::simpanSupplier');
$routes->post('/updatesupplier/(:num)', 'SupplierController::editSupplier/$1');
$routes->post('/hapussupplier/(:num)', 'SupplierController::hapusSupplier/$1');

// ArusBarang/barangmasuk
$routes->get('/barangmasuk', 'BarangMasukController::barangmasuk');
$routes->get('/barangmasuk/detail/(:num)', 'BarangMasukController::getDetailBarang/$1');
$routes->get('/tambahbarangmasuk', 'BarangMasukController::tambahbarangmasuk');
$routes->post('/simpanbarangmasuk', 'BarangMasukController::simpanBarangMasuk');
$routes->post('/editbarangmasuk/(:num)', 'BarangMasukController::editbarangmasuk/$1');
$routes->post('/hapusBarangMasuk/(:num)', 'BarangMasukController::hapusbarangmasuk/$1');
$routes->post('/tambahdetailbarang', 'BarangMasukController::tambahDetailBarang');
$routes->post('/editDetailBarang', 'BarangMasukController::editDetailBarang');
$routes->post('/hapusDetailBarangMasuk/(:num)', 'BarangMasukController::hapusDetailBarang/$1');

// Nota
$routes->post('/tambahnota', 'BarangMasukController::tambahnota');
$routes->post('/editnota/(:num)', 'BarangMasukController::editnota/$1');
$routes->post('/hapusnota/(:num)', 'SupplierController::hapusnota/$1');

// BarangKeluar
$routes->get('/barangkeluar', 'BarangKeluarController::barangkeluar');
$routes->post('/editbarangkeluar/(:num)', 'BarangKeluarController::editbarangkeluar/$1');
$routes->post('/hapusbarangkeluar/(:num)', 'SupplierController::hapusbarangkeluar/$1');
$routes->get('barangkeluar/download/(:segment)', 'BarangKeluarController::downloadFile/$1');
$routes->post('/tambahdetailbarangkeluar', 'BarangKeluarController::tambahDetailBarang');
$routes->post('/editDetailBarangKeluar', 'BarangKeluarController::editDetailBarang');
$routes->post('/hapusDetailBarangKeluar/(:num)', 'BarangKeluarController::hapusDetailBarangKeluar/$1');
//Tambah Data
$routes->get('/tambahbarangkeluar', 'BarangKeluarController::tambahBarangKeluar');
$routes->post('/simpanbarangkeluar', 'BarangKeluarController::simpanbarangkeluar');
$routes->get('/export/pdf', 'BarangKeluarController::exportToPDF');




//LaporanBarangMasuk
$routes->get('/laporanpenerimaan', 'LaporanBarangMasukController::penerimaanBarang');
$routes->post('laporan/penerimaanBarang', 'LaporanBarangMasukController::penerimaanBarang');

//LaporanBarangKeluar
$routes->get('/laporanpengeluaran', 'LaporanBarangKeluarController::pengeluaranbarang');
$routes->post('laporan/pengeluaranbarang', 'LaporanBarangKeluarController::pengeluaranbarang');

// KartuDataBarang
$routes->get('kartudatabarang', 'KartuDataBarangController::index');
$routes->post('kartudatabarang/filter', 'KartuDataBarangController::filter');
$routes->get('kartudatabarang/export', 'KartuDataBarangController::exportToExcel');
