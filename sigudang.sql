-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 11:41 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `bidang` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `nip`, `bidang`, `jabatan`) VALUES
(12, 'rajsya', '$2y$10$Awv2OrSPh37WYQXoVecTV.rpOcZTfE/RQPlyw1NCB/isciiiI3z4.', 'Indra Rajsya', '333', 'pengembangan', 'anggota'),
(13, 'Lonte', '$2y$10$lnFYRCWaJvPuVyJaJ/YOeu1o89kBdNDiHBcB3qg2S7VgKixfiB0hS', 'Kogoya ', '123', 'pengembangan', 'anggota');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_barang_masuk` int(11) DEFAULT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merek` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_barang_masuk`, `nama_barang`, `merek`, `harga`, `jumlah`, `kategori`, `satuan`, `deskripsi`) VALUES
(119, 71, 'Asus Tuf RTX 3600', 'Asus', '25000000.00', 20, 'Barang Elektronik', 'unit', 'bbbbbbbbbbbbbb'),
(120, 71, 'lenovo pro', 'Lenovo', '25000000.00', 10, 'Barang Elektronik', 'unit', 'tes'),
(121, 72, 'Pensil', '2B', '3000.00', 500, 'Alat Tulis Kantor', 'Buah', 'tes'),
(122, 72, 'Bolpoin', 'Snowman', '5000.00', 500, 'Alat Tulis Kantor', 'tes', 'tes'),
(123, 73, 'Vario 150cc', 'vario', '25000000.00', 10, 'Kendaraan Dinas Pribadi', 'unit', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `id_rinc_keluar` int(11) DEFAULT NULL,
  `peruntukan` varchar(255) NOT NULL,
  `tanggal_penyerahan` date NOT NULL,
  `penerima` varchar(255) NOT NULL,
  `bukti_pengambilan` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `id_rinc_keluar`, `peruntukan`, `tanggal_penyerahan`, `penerima`, `bukti_pengambilan`) VALUES
(39, NULL, 'Pak Febrian', '2024-04-14', 'Pak Febrian', 0x313731333034323330325f65396436616533393332383866396663373833372e706466),
(40, NULL, 'Pak Indra', '2024-04-14', 'Pak Febrian', 0x313731333034323338325f64393937383737616333663039633036323530652e706466);

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `no_spk` varchar(255) NOT NULL,
  `tgl_spk` date NOT NULL,
  `no_ba_penerimaan` varchar(255) NOT NULL,
  `tgl_ba_penerimaan` date NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_rinc_keluar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `no_spk`, `tgl_spk`, `no_ba_penerimaan`, `tgl_ba_penerimaan`, `supplier`, `id_supplier`, `id_barang`, `id_rinc_keluar`) VALUES
(71, '027/1036/BAPPENDA', '2024-04-13', '1234567890', '2024-04-13', 'Master Komputer', NULL, NULL, NULL),
(72, '456/78910/BAPPENDA', '2024-04-13', '1234567890', '2024-04-13', 'Gramedia', NULL, NULL, NULL),
(73, '027/1036/BAPPENDA', '2024-04-14', '1234567890', '2024-04-14', 'Master Komputer', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id_inventory` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `merek` varchar(255) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id_inventory`, `id_barang`, `nama_barang`, `merek`, `harga`, `jumlah`, `kategori`, `satuan`, `deskripsi`) VALUES
(29, 0, 'Asus Tuf RTX 3600', 'Asus', '25000000.00', 15, 'Barang Elektronik', 'unit', 'bbbbbbbbbbbbbb'),
(30, 0, 'lenovo pro', 'Lenovo', '25000000.00', 8, 'Barang Elektronik', 'unit', 'tes'),
(31, 0, 'Pensil', '2B', '3000.00', 400, 'Alat Tulis Kantor', 'Buah', 'tes'),
(32, 0, 'Bolpoin', 'Snowman', '5000.00', 400, 'Alat Tulis Kantor', 'tes', 'tes'),
(33, 0, 'Vario 150cc', 'vario', '25000000.00', 10, 'Kendaraan Dinas Pribadi', 'unit', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `namakategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `namakategori`) VALUES
(28, 'Alat Tulis Kantor'),
(29, 'Barang Elektronik'),
(30, 'Perabotan Kantor'),
(31, 'Kendaraan Dinas Pribadi');

-- --------------------------------------------------------

--
-- Table structure for table `rinc_brg_keluar`
--

CREATE TABLE `rinc_brg_keluar` (
  `id_rinc_keluar` int(11) NOT NULL,
  `id_barang_keluar` int(11) DEFAULT NULL,
  `id_inventory` int(11) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `merek` varchar(100) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rinc_brg_keluar`
--

INSERT INTO `rinc_brg_keluar` (`id_rinc_keluar`, `id_barang_keluar`, `id_inventory`, `nama_barang`, `merek`, `harga`, `jumlah`, `kategori`, `satuan`, `deskripsi`, `id_supplier`) VALUES
(57, 39, NULL, 'Asus Tuf RTX 3600', 'Asus', NULL, 5, 'Barang Elektronik', 'unit', 'tes', NULL),
(58, 39, NULL, 'lenovo pro', 'Lenovo', NULL, 2, 'Barang Elektronik', 'unit', 'tes', NULL),
(59, 40, NULL, 'Pensil', '2B', NULL, 100, 'Alat Tulis Kantor', 'Buah', 'tes', NULL),
(60, 40, NULL, 'Bolpoin', 'Snowman', NULL, 100, 'Alat Tulis Kantor', 'Buah', 'tes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `kontak`) VALUES
(15, 'Master Komputer', 'Jl.Percetakan', '0812345678'),
(17, 'Gramedia', 'Jl.Pacifik Permai Ruko Dok II ', '0812345678910'),
(19, 'Toko Gudang Elektronik Jalan Baru', 'Jl. Baru Ps. Lama Abepura, Wai Mhorock, Kec. Abepura, Kota Jayapura, Papua', '0811-4958-558'),
(20, 'Utama Central Electronic', 'Jl. Irian No.21, Gurabesi, Kec. Jayapura Utara, Kota Jayapura, Papua', '12345678'),
(21, 'Graha Central', 'Saga Mall Lantai 1, Kota Baru, Kec. Abepura, Kota Jayapura', '0821-9792-1888'),
(22, 'Central Plaza Electronic', 'Alamat di Jl. Raya Abepura – Sentani No.18, Kota Baru, Kec. Abepura, Kota Jayapura', '0822-9086-8818'),
(23, 'Zona Elektronik', 'Alamat di Jl. Ps. Yotefa No.39, Wai Mhorock, Kec. Abepura, Kota Jayapura, Papua', '0813-4475-7707'),
(24, 'Honda', 'Jl.Pacific Permai Dok 2', '081247754308');

-- --------------------------------------------------------

--
-- Table structure for table `temp_barang`
--

CREATE TABLE `temp_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `merek` varchar(255) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `fk_barang_barang_masuk` (`id_barang_masuk`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_rinc_keluar` (`id_rinc_keluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `fk_barang_masuk_barang` (`id_barang`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id_inventory`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `rinc_brg_keluar`
--
ALTER TABLE `rinc_brg_keluar`
  ADD PRIMARY KEY (`id_rinc_keluar`),
  ADD KEY `fk_id_supplier` (`id_supplier`),
  ADD KEY `fk_id_barang_keluar` (`id_barang_keluar`),
  ADD KEY `fk_rinc_brg_keluar_inventory` (`id_inventory`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `temp_barang`
--
ALTER TABLE `temp_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id_inventory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `rinc_brg_keluar`
--
ALTER TABLE `rinc_brg_keluar`
  MODIFY `id_rinc_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `temp_barang`
--
ALTER TABLE `temp_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_barang_masuk` FOREIGN KEY (`id_barang_masuk`) REFERENCES `barang_masuk` (`id_barang_masuk`);

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_rinc_keluar`) REFERENCES `rinc_brg_keluar` (`id_rinc_keluar`);

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_barang_masuk_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `rinc_brg_keluar`
--
ALTER TABLE `rinc_brg_keluar`
  ADD CONSTRAINT `fk_id_barang_keluar` FOREIGN KEY (`id_barang_keluar`) REFERENCES `barang_keluar` (`id_barang_keluar`),
  ADD CONSTRAINT `fk_id_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  ADD CONSTRAINT `fk_rinc_brg_keluar_inventory` FOREIGN KEY (`id_inventory`) REFERENCES `inventory` (`id_inventory`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
