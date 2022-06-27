-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 07:24 PM
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
(36, 'REQ-00001', '1', 'Saos', 200, 0, '', '', '2022-06-02', 1, 6, 1, 0, ''),
(37, 'REQ-00002', '2', 'Kecap', 200, 0, '', '', '2022-06-02', 1, 3, 1, 0, ''),
(38, 'REQ-00003', '3', 'Garam', 200, 0, '', '', '2022-06-02', 1, 6, 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan_in`
--

CREATE TABLE `detail_permintaan_in` (
  `id_detail_permintaan_in` int(11) NOT NULL,
  `kode_permintaan_brg_in` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_permintaan_barang_in` int(11) NOT NULL,
  `status_in` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_permintaan_in`
--

INSERT INTO `detail_permintaan_in` (`id_detail_permintaan_in`, `kode_permintaan_brg_in`, `id_barang`, `jumlah_permintaan_barang_in`, `status_in`) VALUES
(1, 'IN-00001', 37, 100, 1),
(2, 'IN-00002', 38, 200, 1),
(3, 'IN-00003', 37, 600, 1),
(4, 'IN-00003', 38, 200, 1),
(5, 'IN-00004', 36, 500, 1),
(6, 'IN-00005', 37, 250, 1),
(7, 'IN-00006', 36, 500, 0),
(8, 'IN-00007', 37, 1000, 1),
(9, 'IN-00008', 37, 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan_out`
--

CREATE TABLE `detail_permintaan_out` (
  `id_detail_permintaan_out` int(11) NOT NULL,
  `kode_permintaan_brg_out` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_permintaan_barang_out` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_permintaan_out`
--

INSERT INTO `detail_permintaan_out` (`id_detail_permintaan_out`, `kode_permintaan_brg_out`, `id_barang`, `jumlah_permintaan_barang_out`) VALUES
(1, 'OUT-00001', 37, 400),
(2, 'OUT-00002', 37, 200),
(3, 'OUT-00003', 36, 100),
(4, 'OUT-00004', 36, 150),
(5, 'OUT-00005', 37, 550),
(6, 'OUT-00006', 36, 250),
(7, 'OUT-00007', 37, 500);

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

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang_in`
--

CREATE TABLE `permintaan_barang_in` (
  `id_permintaan_brg_in` int(11) NOT NULL,
  `kode_permintaan_brg_in` varchar(50) NOT NULL,
  `date_permintaan_brg_in` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_permintaan_brg_in` int(11) NOT NULL,
  `date_permintaan_brg_deliver_in` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_barang_in`
--

INSERT INTO `permintaan_barang_in` (`id_permintaan_brg_in`, `kode_permintaan_brg_in`, `date_permintaan_brg_in`, `id_user`, `status_permintaan_brg_in`, `date_permintaan_brg_deliver_in`) VALUES
(1, 'IN-00001', '2022-06-12', 2, 2, '2022-06-13'),
(2, 'IN-00002', '2022-06-12', 2, 2, '2022-06-13'),
(3, 'IN-00003', '2022-06-12', 2, 2, '2022-06-13'),
(4, 'IN-00004', '2022-06-12', 2, 2, '2022-06-13'),
(5, 'IN-00005', '2022-06-12', 2, 2, '2022-06-13'),
(8, 'IN-00006', '2022-06-13', 2, 1, '0000-00-00'),
(9, 'IN-00007', '2022-06-13', 2, 2, '2022-06-14'),
(10, 'IN-00008', '2022-06-13', 2, 2, '2022-06-14');

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
(1, 'OUT-00001', '2022-06-12', 2, 1),
(2, 'OUT-00002', '2022-06-12', 2, 1),
(3, 'OUT-00003', '2022-06-12', 2, 1),
(4, 'OUT-00004', '2022-06-12', 2, 1),
(6, 'OUT-00005', '2022-06-13', 2, 1),
(7, 'OUT-00006', '2022-06-13', 2, 1),
(8, 'OUT-00007', '2022-06-13', 2, 1);

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
(3, 'Botol'),
(4, 'gram'),
(6, 'Lembar');

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
(1, 'Riyondha', 'Jl Pahlawan, Surabaya', '081726222211', 'riyondha@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70', 0),
(2, 'Admin Cabang', 'Jl. Menganti, Surabaya', '081622511211', 'admin@gmail.com', 'cabang', '202cb962ac59075b964b07152d234b70', 1),
(3, 'Maria Ayu', 'Jl. Rungkut, Surabaya', '081726221118', 'gudang@gmail.com', 'gudang', '202cb962ac59075b964b07152d234b70', 2),
(4, 'Dona Alviani', 'Jl. A Yani, Surabaya', '081726282992', 'pimpinan@gmail.com', 'pimpinan', '202cb962ac59075b964b07152d234b70', 3),
(9, 'Habib', 'Sidoarjo', '08112238390', 'habib@gmail.com', 'habib', '3573dd3c8f7fa2075538bb9c8a3a4d48', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_permintaan_in`
--
ALTER TABLE `detail_permintaan_in`
  ADD PRIMARY KEY (`id_detail_permintaan_in`);

--
-- Indexes for table `detail_permintaan_out`
--
ALTER TABLE `detail_permintaan_out`
  ADD PRIMARY KEY (`id_detail_permintaan_out`);

--
-- Indexes for table `pengajuan_barang_baru`
--
ALTER TABLE `pengajuan_barang_baru`
  ADD PRIMARY KEY (`id_pengajuan_barang`);

--
-- Indexes for table `permintaan_barang_in`
--
ALTER TABLE `permintaan_barang_in`
  ADD PRIMARY KEY (`id_permintaan_brg_in`);

--
-- Indexes for table `permintaan_barang_out`
--
ALTER TABLE `permintaan_barang_out`
  ADD PRIMARY KEY (`id_permintaan_brg_out`);

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `detail_permintaan_in`
--
ALTER TABLE `detail_permintaan_in`
  MODIFY `id_detail_permintaan_in` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_permintaan_out`
--
ALTER TABLE `detail_permintaan_out`
  MODIFY `id_detail_permintaan_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengajuan_barang_baru`
--
ALTER TABLE `pengajuan_barang_baru`
  MODIFY `id_pengajuan_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permintaan_barang_in`
--
ALTER TABLE `permintaan_barang_in`
  MODIFY `id_permintaan_brg_in` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permintaan_barang_out`
--
ALTER TABLE `permintaan_barang_out`
  MODIFY `id_permintaan_brg_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `safety_stok`
--
ALTER TABLE `safety_stok`
  MODIFY `id_safety_stok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id_satuan_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
