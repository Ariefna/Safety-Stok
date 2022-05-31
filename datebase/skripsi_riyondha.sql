-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2022 at 02:48 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_riyondha`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `no_request` varchar(50) NOT NULL,
  `no_serial` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `keterangan_barang` text NOT NULL,
  `catatan_barang` text NOT NULL,
  `date_request` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_satuan_barang` int(11) NOT NULL,
  `status_request` int(11) NOT NULL,
  `status_po` int(11) NOT NULL,
  `foto_barang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `no_request`, `no_serial`, `nama_barang`, `jumlah_barang`, `harga_barang`, `keterangan_barang`, `catatan_barang`, `date_request`, `id_user`, `id_satuan_barang`, `status_request`, `status_po`, `foto_barang`) VALUES
(4, 'REQ-00001', 'AAA783327193', 'Kertas A4', 370, 1000, 'Lembar', 'Tidak Ada Cacat', '2021-07-26', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/4_FT_BRG.jpeg'),
(5, 'REQ-00002', 'HJK637282211', 'Bulpoin', 230, 1500, 'Pcs', 'Tidak Ada Cacat', '2021-07-26', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/5_FT_BRG.jpeg'),
(6, 'REQ-00003', 'LKJ700921223', 'Penggaris', 240, 500, 'Pcs', 'Tidak Ada Cacat', '2021-07-26', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/6_FT_BRG.jpeg'),
(7, 'REQ-00003', 'JGD933221100', 'Pencil', 170, 500, 'Pcs', '-', '2021-07-26', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/7_FT_BRG.jpeg'),
(8, 'REQ-00004', 'KBB922845468', 'Kabel USB Type C', 200, 15000, 'Roll', 'Tidak Ada Cacat', '2021-07-26', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/8_FT_BRG.jpeg'),
(9, 'REQ-00004', 'OOP930111223', 'Penghapus Papan', 100, 10000, 'Pcs', '-', '2021-07-26', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/9_FT_BRG.jpeg'),
(10, 'REQ-00004', 'ERT093847563', 'Papan Tulis', 100, 30000, 'Pcs', '-', '2021-07-26', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/10_FT_BRG.jpeg'),
(11, 'REQ-00004', 'KGO930756453', 'Keranjang Belanja', 200, 40000, 'Pcs', '-', '2021-07-26', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/11_FT_BRG.jpeg'),
(12, 'REQ-00005', 'SDF938475899', 'TV LED', 200, 2000000, 'Unit', '-', '2021-07-26', 1, 3, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/12_FT_BRG.jpeg'),
(13, 'REQ-00005', 'XCV038465720', 'TV Analog 2020', 230, 1500000, 'Unit', '-', '2021-07-26', 1, 3, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/13_FT_BRG.jpeg'),
(14, 'REQ-00005', 'FGH635111101', 'Kipas Angin', 230, 600000, 'Unit', '-', '2021-07-26', 1, 3, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/14_FT_BRG.jpeg'),
(15, 'REQ-00005', 'ASD922222117', 'Lampu Panjang', 300, 30000, 'Unit', '-', '2021-07-26', 1, 3, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/15_FT_BRG.jpeg'),
(16, 'REQ-00005', 'LMK646392838', 'Lampu Bolam', 300, 20000, 'Unit', '-', '2021-07-26', 1, 3, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/16_FT_BRG.jpeg'),
(17, 'REQ-00005', 'SDM9384000123', 'Komputer PC', 300, 3000000, 'Unit', '-', '2021-07-26', 1, 3, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/17_FT_BRG.jpeg'),
(18, 'REQ-00005', 'QWE937888315', 'AC Ruangan', 200, 2000000, 'Unit', '-', '2021-07-26', 1, 3, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/18_FT_BRG.jpeg'),
(19, 'REQ-00005', 'DFG933333846', 'Mesin Cuci', 150, 2500000, 'Unit', '-', '2021-07-26', 1, 3, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/19_FT_BRG.jpeg'),
(20, 'REQ-00006', 'KKK938334432', 'Mesin Potong', 100, 3000000, 'Unit', '-', '2021-07-26', 1, 4, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/20_FT_BRG.jpeg'),
(21, 'REQ-00007', 'XXX033948710', 'Mesin Kopi', 100, 5000000, 'Unit', '-', '2021-07-26', 1, 4, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/21_FT_BRG.jpeg'),
(22, 'REQ-00008', 'WIR033228444', 'Gensed Listrik', 150, 2000000, 'Unit', '-', '2021-07-26', 1, 4, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/22_FT_BRG.jpeg'),
(23, 'REQ-00008', 'III038443957', 'Pompa Air', 100, 1600000, 'Unit', '-', '2021-07-26', 1, 4, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/23_FT_BRG.jpeg'),
(24, 'REQ-00008', 'NBV8326555555', 'Mesin Disel', 150, 6000000, 'Unit', '-', '2021-07-26', 1, 4, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/24_FT_BRG.jpeg'),
(25, 'REQ-00008', 'YYY945678933', 'Pompa Ban Besar', 150, 900000, 'Unit', '-', '2021-07-26', 1, 4, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/25_FT_BRG.jpeg'),
(26, 'REQ-00009', 'JLK938873330', 'Aqua Gelas', 300, 3000, 'Box', '-', '2021-07-28', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/26_FT_BRG.jpeg'),
(27, 'REQ-00009', 'LLL822837373', 'Buku Tulis', 200, 15000, 'Buah', '-', '2021-07-28', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/27_FT_BRG.jpeg'),
(28, 'REQ-00009', 'PPZ992999991', 'Kertas Bufalo', 180, 1000, 'Buah', '-', '2021-07-28', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/28_FT_BRG.jpeg'),
(29, 'REQ-00010', 'NMJ92833011', 'Maps Transparan', 160, 1000, 'Buah', '-', '2021-07-28', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/29_FT_BRG.jpeg'),
(30, 'REQ-00010', 'FPP928333311', 'Kipas Angin Besar', 100, 600000, 'Unit', '-', '2021-07-28', 1, 3, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/30_FT_BRG.jpeg'),
(31, 'REQ-00010', 'FFY928456780', 'DVD Player', 100, 1000000, 'Unit', '-', '2021-07-28', 1, 3, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/31_FT_BRG.jpeg'),
(32, 'REQ-00011', 'HHH000000112', 'Fas Bunga', 300, 100000, 'Unit', '-', '2021-07-28', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/32_FT_BRG.jpeg'),
(33, 'REQ-00011', 'GYT009822216', 'Rak Buku', 100, 800000, 'Unit', '-', '2021-07-28', 1, 2, 1, 2, 'http://localhost/safety-stock/halaman/images/barang/33_FT_BRG.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_detail_peminjaman` int(11) NOT NULL,
  `no_peminjaman` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `status_peminjaman_barang` int(11) NOT NULL,
  `status_pengembalian_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan_out`
--

CREATE TABLE `detail_permintaan_out` (
  `id_detail_permintaan_out` int(11) NOT NULL,
  `kode_permintaan_brg_out` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_permintaan_barang_out` int(11) NOT NULL,
  `jumlah_disetujui_out` int(11) NOT NULL,
  `keterangan_out` varchar(200) NOT NULL,
  `status_detail_permintaan_out` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `detail_permintaan_in`
--

CREATE TABLE `detail_permintaan_in` (
  `id_detail_permintaan_in` int(11) NOT NULL,
  `kode_permintaan_brg_in` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_permintaan_barang_in` int(11) NOT NULL,
  `jumlah_disetujui_in` int(11) NOT NULL,
  `keterangan_in` varchar(200) NOT NULL,
  `status_detail_permintaan_in` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `permintaan_barang_in` (
  `id_permintaan_brg_in` int(11) NOT NULL,
  `kode_permintaan_brg_in` varchar(50) NOT NULL,
  `date_permintaan_brg_in` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_permintaan_brg_in` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_permintaan_out`
--

INSERT INTO `detail_permintaan_out` (`id_detail_permintaan_out`, `kode_permintaan_brg_out`, `id_barang`, `jumlah_permintaan_barang_out`, `jumlah_disetujui_out`, `keterangan_out`, `status_detail_permintaan_out`) VALUES
(1, 'OUT-00001', 4, 100, 100, 'Boleh ambil semua', 1),
(2, 'OUT-00002', 4, 5, 5, 'Boleh ambil semua', 1),
(3, 'OUT-00003', 4, 5, 5, 'Boleh ambil semua', 1),
(4, 'OUT-00004', 4, 5, 5, 'Boleh ambil semua', 1),
(5, 'OUT-00005', 4, 5, 5, 'Boleh ambil semua', 1),
(6, 'OUT-00006', 4, 5, 5, 'Boleh ambil semua', 1),
(7, 'OUT-00007', 4, 5, 5, 'Boleh ambil semua', 1),
(8, 'OUT-00008', 4, 5, 5, 'Boleh ambil semua', 1),
(9, 'OUT-00009', 4, 5, 5, 'Boleh ambil semua', 1),
(10, 'OUT-00010', 4, 5, 5, 'Boleh ambil semua', 1),
(11, 'OUT-00011', 4, 5, 5, 'Boleh ambil semua', 1),
(12, 'OUT-00012', 4, 10, 10, 'Boleh ambil semua', 1),
(13, 'OUT-00013', 4, 10, 10, 'Boleh ambil semua', 1),
(14, 'OUT-00014', 4, 10, 10, 'Boleh ambil semua', 1),
(15, 'OUT-00015', 4, 10, 10, 'Boleh ambil semua', 1),
(16, 'OUT-00016', 4, 10, 10, 'Boleh ambil semua', 1),
(17, 'OUT-00017', 4, 10, 10, 'Boleh ambil semua', 1),
(18, 'OUT-00018', 4, 30, 10, 'Boleh ambil sebagian', 1),
(19, 'OUT-00019', 4, 30, 5, 'Boleh ambil sebagian', 1),
(20, 'OUT-00020', 4, 30, 20, 'Boleh ambil sebagian', 1),
(21, 'OUT-00021', 4, 5, 5, 'Boleh ambil semua', 1),
(22, 'OUT-00022', 4, 5, 5, 'Boleh ambil semua', 1),
(23, 'OUT-00023', 4, 5, 5, 'Boleh ambil semua', 1),
(24, 'OUT-00024', 4, 10, 5, 'Boleh ambil sebagian', 1),
(25, 'OUT-00025', 4, 5, 5, 'Boleh ambil semua', 1),
(26, 'OUT-00026', 4, 10, 5, 'Boleh ambil sebagian', 1),
(27, 'OUT-00027', 4, 20, 10, 'Boleh ambil sebagian', 1),
(28, 'OUT-00028', 4, 8, 8, 'Boleh ambil semua', 1),
(29, 'OUT-00029', 4, 10, 10, 'silahkan diambil', 1),
(30, 'OUT-00030', 4, 20, 20, 'silahkan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_barang`
--

CREATE TABLE `peminjaman_barang` (
  `id_peminjaman` int(11) NOT NULL,
  `no_peminjaman` varchar(50) NOT NULL,
  `date_input_pinjam` date NOT NULL,
  `date_peminjaman_start` date NOT NULL,
  `date_peminjaman_end` date NOT NULL,
  `durasi_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_peminjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_barang_baru`
--

CREATE TABLE `pengajuan_barang_baru` (
  `id_pengajuan_barang` int(11) NOT NULL,
  `no_request` varchar(50) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status_pengajuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan_barang_baru`
--

INSERT INTO `pengajuan_barang_baru` (`id_pengajuan_barang`, `no_request`, `tanggal_pengajuan`, `status_pengajuan`) VALUES
(1, 'REQ-00001', '2021-07-26', 3),
(2, 'REQ-00002', '2021-07-26', 3),
(3, 'REQ-00003', '2021-07-26', 3),
(4, 'REQ-00004', '2021-07-26', 3),
(5, 'REQ-00005', '2021-07-26', 3),
(6, 'REQ-00006', '2021-07-26', 3),
(7, 'REQ-00007', '2021-07-26', 3),
(8, 'REQ-00008', '2021-07-26', 3),
(9, 'REQ-00009', '2021-07-28', 3),
(10, 'REQ-00010', '2021-07-28', 3),
(11, 'REQ-00011', '2021-07-28', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang_out`
--

CREATE TABLE `permintaan_barang_out` (
  `id_permintaan_brg_out` int(11) NOT NULL,
  `kode_permintaan_brg_out` varchar(50) NOT NULL,
  `date_permintaan_brg_out` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_permintaan_brg_out` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_barang_out`
--

INSERT INTO `permintaan_barang_out` (`id_permintaan_brg_out`, `kode_permintaan_brg_out`, `date_permintaan_brg_out`, `id_user`, `status_permintaan_brg_out`) VALUES
(1, 'OUT-00001', '2021-07-28', 5, 1),
(2, 'OUT-00002', '2021-07-28', 5, 1),
(3, 'OUT-00003', '2021-07-28', 5, 1),
(4, 'OUT-00004', '2021-07-28', 5, 1),
(5, 'OUT-00005', '2021-07-28', 5, 1),
(6, 'OUT-00006', '2021-07-28', 5, 1),
(7, 'OUT-00007', '2021-07-28', 5, 1),
(8, 'OUT-00008', '2021-07-28', 5, 1),
(9, 'OUT-00009', '2021-07-28', 5, 1),
(10, 'OUT-00010', '2021-07-28', 5, 1),
(11, 'OUT-00011', '2021-07-28', 5, 1),
(12, 'OUT-00012', '2021-07-28', 5, 1),
(13, 'OUT-00013', '2021-07-28', 5, 1),
(14, 'OUT-00014', '2021-07-28', 5, 1),
(15, 'OUT-00015', '2021-07-28', 5, 1),
(16, 'OUT-00016', '2021-07-28', 5, 1),
(17, 'OUT-00017', '2021-07-28', 5, 1),
(18, 'OUT-00018', '2021-07-28', 5, 1),
(19, 'OUT-00019', '2021-07-28', 5, 1),
(20, 'OUT-00020', '2021-07-28', 5, 1),
(21, 'OUT-00021', '2021-07-28', 4, 1),
(22, 'OUT-00022', '2021-07-28', 4, 1),
(23, 'OUT-00023', '2021-07-28', 4, 1),
(24, 'OUT-00024', '2021-07-28', 4, 1),
(25, 'OUT-00025', '2021-07-28', 4, 1),
(26, 'OUT-00026', '2021-07-28', 4, 1),
(27, 'OUT-00027', '2021-07-28', 4, 1),
(28, 'OUT-00028', '2021-07-28', 4, 1),
(29, 'OUT-00029', '2021-07-29', 4, 1),
(30, 'OUT-00030', '2021-07-29', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `safety_stok`
--

CREATE TABLE `safety_stok` (
  `id_safety_stok` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `max_stok` int(11) NOT NULL,
  `rata_rata_sty` float NOT NULL,
  `lead_time_sty` int(11) NOT NULL,
  `hasil_sty` float NOT NULL,
  `date_sty` date NOT NULL,
  `sts_sty` int(11) NOT NULL,
  `restok_sty` int(11) NOT NULL,
  `sts_sty_restok` int(11) NOT NULL,
  `date_restok` date NOT NULL,
  `sts_per_pin` int(11) NOT NULL,
  `reorder_point` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id_satuan_barang` int(11) NOT NULL,
  `nama_satuan_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan_barang`
--

INSERT INTO `satuan_barang` (`id_satuan_barang`, `nama_satuan_barang`) VALUES
(2, 'pcs'),
(3, 'liter'),
(4, 'gram'),
(5, 'lembar');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `alamat_user` varchar(255) NOT NULL,
  `telepon_user` varchar(20) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `alamat_user`, `telepon_user`, `email_user`, `username`, `password`, `type_user`) VALUES
(1, 'Ipel', 'Jl Pahlawan, Surabaya', '081726222211', 'ipel@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70', 0),
(2, 'Ilham Fatkur', 'Jl. Menganti, Surabaya', '081622511211', 'ilham@gmail.com', 'ilham', '202cb962ac59075b964b07152d234b70', 1),
(3, 'Maria Ayu', 'Jl. Rungkut, Surabaya', '081726221118', 'maria@gmail.com', 'maria', '202cb962ac59075b964b07152d234b70', 2),
(4, 'Dona Alviani', 'Jl. A Yani, Surabaya', '081726282992', 'dona@gmail.com', 'dona', '202cb962ac59075b964b07152d234b70', 3),
(5, 'Puspita Ayu', 'Jl. Keputih, Surabaya', '081627277778', 'puspita@gmail.com', 'puspita', '202cb962ac59075b964b07152d234b70', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_detail_peminjaman`);

--
-- Indexes for table `detail_permintaan_out`
--
ALTER TABLE `detail_permintaan_out`
  ADD PRIMARY KEY (`id_detail_permintaan_out`);

  ALTER TABLE `detail_permintaan_in`
  ADD PRIMARY KEY (`id_detail_permintaan_out`);

--
-- Indexes for table `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `pengajuan_barang_baru`
--
ALTER TABLE `pengajuan_barang_baru`
  ADD PRIMARY KEY (`id_pengajuan_barang`);

--
-- Indexes for table `permintaan_barang_out`
--
ALTER TABLE `permintaan_barang_out`
  ADD PRIMARY KEY (`id_permintaan_brg_out`);

  ALTER TABLE `permintaan_barang_in`
  ADD PRIMARY KEY (`id_permintaan_brg_in`);

--
-- Indexes for table `safety_stok`
--
ALTER TABLE `safety_stok`
  ADD PRIMARY KEY (`id_safety_stok`);

--
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id_satuan_barang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id_detail_peminjaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_permintaan_out`
--
ALTER TABLE `detail_permintaan_out`
  MODIFY `id_detail_permintaan_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `peminjaman_barang`
--
ALTER TABLE `peminjaman_barang`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_barang_baru`
--
ALTER TABLE `pengajuan_barang_baru`
  MODIFY `id_pengajuan_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permintaan_barang_out`
--
ALTER TABLE `permintaan_barang_out`
  MODIFY `id_permintaan_brg_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;


  ALTER TABLE `permintaan_barang_in`
  MODIFY `id_permintaan_brg_in` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `safety_stok`
--
ALTER TABLE `safety_stok`
  MODIFY `id_safety_stok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id_satuan_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
