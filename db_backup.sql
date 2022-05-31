-- MySQL dump 10.19  Distrib 10.3.34-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: skripsi_riyondha
-- ------------------------------------------------------
-- Server version	10.3.34-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
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
  `foto_barang` text NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` VALUES (5,'REQ-00002','HJK637282211','Bulpoin',230,1500,'Pcs','Tidak Ada Cacat','2021-07-26',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/5_FT_BRG.jpeg'),(6,'REQ-00003','LKJ700921223','Penggaris',240,500,'Pcs','Tidak Ada Cacat','2021-07-26',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/6_FT_BRG.jpeg'),(7,'REQ-00003','JGD933221100','Pencil',170,500,'Pcs','-','2021-07-26',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/7_FT_BRG.jpeg'),(9,'REQ-00004','OOP930111223','Penghapus Papan',100,10000,'Pcs','-','2021-07-26',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/9_FT_BRG.jpeg'),(10,'REQ-00004','ERT093847563','Papan Tulis',100,30000,'Pcs','-','2021-07-26',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/10_FT_BRG.jpeg'),(11,'REQ-00004','KGO930756453','Keranjang Belanja',200,40000,'Pcs','-','2021-07-26',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/11_FT_BRG.jpeg'),(12,'REQ-00005','SDF938475899','TV LED',200,2000000,'Unit','-','2021-07-26',1,3,1,2,'http://localhost/safety-stock/halaman/images/barang/12_FT_BRG.jpeg'),(13,'REQ-00005','XCV038465720','TV Analog 2020',220,1500000,'Unit','-','2021-07-26',1,3,1,2,'http://localhost/safety-stock/halaman/images/barang/13_FT_BRG.jpeg'),(14,'REQ-00005','FGH635111101','Kipas Angin',230,600000,'Unit','-','2021-07-26',1,3,1,2,'http://localhost/safety-stock/halaman/images/barang/14_FT_BRG.jpeg'),(15,'REQ-00005','ASD922222117','Lampu Panjang',300,30000,'Unit','-','2021-07-26',1,3,1,2,'http://localhost/safety-stock/halaman/images/barang/15_FT_BRG.jpeg'),(16,'REQ-00005','LMK646392838','Lampu Bolam',300,20000,'Unit','-','2021-07-26',1,3,1,2,'http://localhost/safety-stock/halaman/images/barang/16_FT_BRG.jpeg'),(17,'REQ-00005','SDM9384000123','Komputer PC',300,3000000,'Unit','-','2021-07-26',1,3,1,2,'http://localhost/safety-stock/halaman/images/barang/17_FT_BRG.jpeg'),(18,'REQ-00005','QWE937888315','AC Ruangan',200,2000000,'Unit','-','2021-07-26',1,3,1,2,'http://localhost/safety-stock/halaman/images/barang/18_FT_BRG.jpeg'),(19,'REQ-00005','DFG933333846','Mesin Cuci',146,2500000,'Unit','-','2021-07-26',1,3,1,2,'http://localhost/safety-stock/halaman/images/barang/19_FT_BRG.jpeg'),(20,'REQ-00006','KKK938334432','Mesin Potong',100,3000000,'Unit','-','2021-07-26',1,4,1,2,'http://localhost/safety-stock/halaman/images/barang/20_FT_BRG.jpeg'),(21,'REQ-00007','XXX033948710','Mesin Kopi',100,5000000,'Unit','-','2021-07-26',1,4,1,2,'http://localhost/safety-stock/halaman/images/barang/21_FT_BRG.jpeg'),(22,'REQ-00008','WIR033228444','Gensed Listrik',150,2000000,'Unit','-','2021-07-26',1,4,1,2,'http://localhost/safety-stock/halaman/images/barang/22_FT_BRG.jpeg'),(23,'REQ-00008','III038443957','Pompa Air',100,1600000,'Unit','-','2021-07-26',1,4,1,2,'http://localhost/safety-stock/halaman/images/barang/23_FT_BRG.jpeg'),(24,'REQ-00008','NBV8326555555','Mesin Disel',150,6000000,'Unit','-','2021-07-26',1,4,1,2,'http://localhost/safety-stock/halaman/images/barang/24_FT_BRG.jpeg'),(25,'REQ-00008','YYY945678933','Pompa Ban Besar',150,900000,'Unit','-','2021-07-26',1,4,1,2,'http://localhost/safety-stock/halaman/images/barang/25_FT_BRG.jpeg'),(26,'REQ-00009','JLK938873330','Aqua Gelas',300,3000,'Box','-','2021-07-28',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/26_FT_BRG.jpeg'),(27,'REQ-00009','LLL822837373','Buku Tulis',200,15000,'Buah','-','2021-07-28',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/27_FT_BRG.jpeg'),(28,'REQ-00009','PPZ992999991','Kertas Bufalo',180,1000,'Buah','-','2021-07-28',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/28_FT_BRG.jpeg'),(29,'REQ-00010','NMJ92833011','Maps Transparan',160,1000,'Buah','-','2021-07-28',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/29_FT_BRG.jpeg'),(30,'REQ-00010','FPP928333311','Kipas Angin Besar',100,600000,'Unit','-','2021-07-28',1,3,1,2,'http://localhost/safety-stock/halaman/images/barang/30_FT_BRG.jpeg'),(31,'REQ-00010','FFY928456780','DVD Player',100,1000000,'Unit','-','2021-07-28',1,3,1,2,'http://localhost/safety-stock/halaman/images/barang/31_FT_BRG.jpeg'),(32,'REQ-00011','HHH000000112','Fas Bunga',300,100000,'Unit','-','2021-07-28',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/32_FT_BRG.jpeg'),(33,'REQ-00011','GYT009822216','Rak Buku',100,800000,'Unit','-','2021-07-28',1,2,1,2,'http://localhost/safety-stock/halaman/images/barang/33_FT_BRG.jpeg'),(34,'REQ-00018','sjcnjs','sjcjs',6,0,'','','2022-05-30',1,6,0,0,''),(35,'REQ-00019','ksncks','skmcksc',9,0,'','','2022-05-30',1,6,0,0,'');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_peminjaman`
--

DROP TABLE IF EXISTS `detail_peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_peminjaman` (
  `id_detail_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `no_peminjaman` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `status_peminjaman_barang` int(11) NOT NULL,
  `status_pengembalian_barang` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_peminjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_peminjaman`
--

LOCK TABLES `detail_peminjaman` WRITE;
/*!40000 ALTER TABLE `detail_peminjaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_permintaan_in`
--

DROP TABLE IF EXISTS `detail_permintaan_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_permintaan_in` (
  `id_detail_permintaan_in` int(11) NOT NULL AUTO_INCREMENT,
  `kode_permintaan_brg_in` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_permintaan_barang_in` int(11) NOT NULL,
  `jumlah_disetujui_in` int(11) NOT NULL,
  `keterangan_in` varchar(200) NOT NULL,
  `status_detail_permintaan_in` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_permintaan_in`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_permintaan_in`
--

LOCK TABLES `detail_permintaan_in` WRITE;
/*!40000 ALTER TABLE `detail_permintaan_in` DISABLE KEYS */;
INSERT INTO `detail_permintaan_in` VALUES (1,'IN-00001',13,10,10,'1',1),(2,'IN-00001',14,11,0,'',0),(3,'IN-00002',19,10,4,'d',1),(4,'IN-00002',30,10,0,'',0);
/*!40000 ALTER TABLE `detail_permintaan_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_permintaan_out`
--

DROP TABLE IF EXISTS `detail_permintaan_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_permintaan_out` (
  `id_detail_permintaan_out` int(11) NOT NULL AUTO_INCREMENT,
  `kode_permintaan_brg_out` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_permintaan_barang_out` int(11) NOT NULL,
  `jumlah_disetujui_out` int(11) NOT NULL,
  `keterangan_out` varchar(200) NOT NULL,
  `status_detail_permintaan_out` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_permintaan_out`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_permintaan_out`
--

LOCK TABLES `detail_permintaan_out` WRITE;
/*!40000 ALTER TABLE `detail_permintaan_out` DISABLE KEYS */;
INSERT INTO `detail_permintaan_out` VALUES (1,'OUT-00001',4,100,100,'Boleh ambil semua',1),(2,'OUT-00002',4,5,5,'Boleh ambil semua',1),(3,'OUT-00003',4,5,5,'Boleh ambil semua',1),(4,'OUT-00004',4,5,5,'Boleh ambil semua',1),(5,'OUT-00005',4,5,5,'Boleh ambil semua',1),(6,'OUT-00006',4,5,5,'Boleh ambil semua',1),(7,'OUT-00007',4,5,5,'Boleh ambil semua',1),(8,'OUT-00008',4,5,5,'Boleh ambil semua',1),(9,'OUT-00009',4,5,5,'Boleh ambil semua',1),(10,'OUT-00010',4,5,5,'Boleh ambil semua',1),(11,'OUT-00011',4,5,5,'Boleh ambil semua',1),(12,'OUT-00012',4,10,10,'Boleh ambil semua',1),(13,'OUT-00013',4,10,10,'Boleh ambil semua',1),(14,'OUT-00014',4,10,10,'Boleh ambil semua',1),(15,'OUT-00015',4,10,10,'Boleh ambil semua',1),(16,'OUT-00016',4,10,10,'Boleh ambil semua',1),(17,'OUT-00017',4,10,10,'Boleh ambil semua',1),(18,'OUT-00018',4,30,10,'Boleh ambil sebagian',1),(19,'OUT-00019',4,30,5,'Boleh ambil sebagian',1),(20,'OUT-00020',4,30,20,'Boleh ambil sebagian',1),(21,'OUT-00021',4,5,5,'Boleh ambil semua',1),(22,'OUT-00022',4,5,5,'Boleh ambil semua',1),(23,'OUT-00023',4,5,5,'Boleh ambil semua',1),(24,'OUT-00024',4,10,5,'Boleh ambil sebagian',1),(25,'OUT-00025',4,5,5,'Boleh ambil semua',1),(26,'OUT-00026',4,10,5,'Boleh ambil sebagian',1),(27,'OUT-00027',4,20,10,'Boleh ambil sebagian',1),(28,'OUT-00028',4,8,8,'Boleh ambil semua',1),(29,'OUT-00029',4,10,10,'silahkan diambil',1),(30,'OUT-00030',4,20,20,'silahkan',1),(31,'OUT-00032',16,19,0,'',0),(32,'OUT-00033',12,10,0,'',0),(33,'OUT-00034',12,10,0,'',0),(34,'OUT-00034',12,11,0,'',0),(35,'OUT-00034',5,12,0,'',0),(36,'OUT-00035',6,2,0,'',0);
/*!40000 ALTER TABLE `detail_permintaan_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman_barang`
--

DROP TABLE IF EXISTS `peminjaman_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peminjaman_barang` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `no_peminjaman` varchar(50) NOT NULL,
  `date_input_pinjam` date NOT NULL,
  `date_peminjaman_start` date NOT NULL,
  `date_peminjaman_end` date NOT NULL,
  `durasi_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_peminjaman` int(11) NOT NULL,
  PRIMARY KEY (`id_peminjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman_barang`
--

LOCK TABLES `peminjaman_barang` WRITE;
/*!40000 ALTER TABLE `peminjaman_barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `peminjaman_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengajuan_barang_baru`
--

DROP TABLE IF EXISTS `pengajuan_barang_baru`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengajuan_barang_baru` (
  `id_pengajuan_barang` int(11) NOT NULL AUTO_INCREMENT,
  `no_request` varchar(50) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status_pengajuan` int(11) NOT NULL,
  PRIMARY KEY (`id_pengajuan_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengajuan_barang_baru`
--

LOCK TABLES `pengajuan_barang_baru` WRITE;
/*!40000 ALTER TABLE `pengajuan_barang_baru` DISABLE KEYS */;
INSERT INTO `pengajuan_barang_baru` VALUES (1,'REQ-00001','2021-07-26',3),(2,'REQ-00002','2021-07-26',3),(3,'REQ-00003','2021-07-26',3),(4,'REQ-00004','2021-07-26',3),(5,'REQ-00005','2021-07-26',3),(6,'REQ-00006','2021-07-26',3),(7,'REQ-00007','2021-07-26',3),(8,'REQ-00008','2021-07-26',3),(9,'REQ-00009','2021-07-28',3),(10,'REQ-00010','2021-07-28',3),(11,'REQ-00011','2021-07-28',3),(12,'REQ-00012','2022-05-30',0),(13,'REQ-00013','2022-05-30',0),(14,'REQ-00014','2022-05-30',0),(15,'REQ-00014','2022-05-30',0),(16,'REQ-00014','2022-05-30',0),(17,'REQ-00014','2022-05-30',0),(18,'REQ-00014','2022-05-30',0),(19,'REQ-00014','2022-05-30',0),(20,'REQ-00014','2022-05-30',0),(21,'REQ-00015','2022-05-30',0),(22,'REQ-00015','2022-05-30',0),(23,'REQ-00015','2022-05-30',0),(24,'REQ-00015','2022-05-30',0),(25,'REQ-00015','2022-05-30',0),(26,'REQ-00015','2022-05-30',0),(27,'REQ-00015','2022-05-30',0),(28,'REQ-00016','2022-05-30',0),(29,'REQ-00017','2022-05-30',0),(30,'REQ-00017','2022-05-30',0),(31,'REQ-00018','2022-05-30',0),(32,'REQ-00019','2022-05-30',0);
/*!40000 ALTER TABLE `pengajuan_barang_baru` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permintaan_barang_in`
--

DROP TABLE IF EXISTS `permintaan_barang_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permintaan_barang_in` (
  `id_permintaan_brg_in` int(11) NOT NULL AUTO_INCREMENT,
  `kode_permintaan_brg_in` varchar(50) NOT NULL,
  `date_permintaan_brg_in` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_permintaan_brg_in` int(11) NOT NULL,
  PRIMARY KEY (`id_permintaan_brg_in`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permintaan_barang_in`
--

LOCK TABLES `permintaan_barang_in` WRITE;
/*!40000 ALTER TABLE `permintaan_barang_in` DISABLE KEYS */;
INSERT INTO `permintaan_barang_in` VALUES (1,'IN-00001','2022-05-30',2,1),(2,'IN-00002','2022-05-30',2,1);
/*!40000 ALTER TABLE `permintaan_barang_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permintaan_barang_out`
--

DROP TABLE IF EXISTS `permintaan_barang_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permintaan_barang_out` (
  `id_permintaan_brg_out` int(11) NOT NULL AUTO_INCREMENT,
  `kode_permintaan_brg_out` varchar(50) NOT NULL,
  `date_permintaan_brg_out` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_permintaan_brg_out` int(11) NOT NULL,
  PRIMARY KEY (`id_permintaan_brg_out`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permintaan_barang_out`
--

LOCK TABLES `permintaan_barang_out` WRITE;
/*!40000 ALTER TABLE `permintaan_barang_out` DISABLE KEYS */;
INSERT INTO `permintaan_barang_out` VALUES (1,'OUT-00001','2021-07-28',5,1),(2,'OUT-00002','2021-07-28',5,1),(3,'OUT-00003','2021-07-28',5,1),(4,'OUT-00004','2021-07-28',5,1),(5,'OUT-00005','2021-07-28',5,1),(6,'OUT-00006','2021-07-28',5,1),(7,'OUT-00007','2021-07-28',5,1),(8,'OUT-00008','2021-07-28',5,1),(9,'OUT-00009','2021-07-28',5,1),(10,'OUT-00010','2021-07-28',5,1),(11,'OUT-00011','2021-07-28',5,1),(12,'OUT-00012','2021-07-28',5,1),(13,'OUT-00013','2021-07-28',5,1),(14,'OUT-00014','2021-07-28',5,1),(15,'OUT-00015','2021-07-28',5,1),(16,'OUT-00016','2021-07-28',5,1),(17,'OUT-00017','2021-07-28',5,1),(18,'OUT-00018','2021-07-28',5,1),(19,'OUT-00019','2021-07-28',5,1),(20,'OUT-00020','2021-07-28',5,1),(21,'OUT-00021','2021-07-28',4,1),(22,'OUT-00022','2021-07-28',4,1),(23,'OUT-00023','2021-07-28',4,1),(24,'OUT-00024','2021-07-28',4,1),(25,'OUT-00025','2021-07-28',4,1),(26,'OUT-00026','2021-07-28',4,1),(27,'OUT-00027','2021-07-28',4,1),(28,'OUT-00028','2021-07-28',4,1),(29,'OUT-00029','2021-07-29',4,1),(30,'OUT-00030','2021-07-29',4,1),(31,'OUT-00031','2022-05-30',2,0),(32,'OUT-00032','2022-05-30',2,0),(33,'OUT-00032','2022-05-30',2,0),(34,'OUT-00032','2022-05-30',2,0),(35,'OUT-00032','2022-05-30',2,0),(36,'OUT-00032','2022-05-30',2,0),(37,'OUT-00033','2022-05-30',2,0),(38,'OUT-00034','2022-05-30',2,0),(39,'OUT-00035','2022-05-31',2,0);
/*!40000 ALTER TABLE `permintaan_barang_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `safety_stok`
--

DROP TABLE IF EXISTS `safety_stok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `safety_stok` (
  `id_safety_stok` int(11) NOT NULL AUTO_INCREMENT,
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
  `reorder_point` float NOT NULL,
  PRIMARY KEY (`id_safety_stok`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `safety_stok`
--

LOCK TABLES `safety_stok` WRITE;
/*!40000 ALTER TABLE `safety_stok` DISABLE KEYS */;
/*!40000 ALTER TABLE `safety_stok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `satuan_barang`
--

DROP TABLE IF EXISTS `satuan_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `satuan_barang` (
  `id_satuan_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satuan_barang` varchar(255) NOT NULL,
  PRIMARY KEY (`id_satuan_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `satuan_barang`
--

LOCK TABLES `satuan_barang` WRITE;
/*!40000 ALTER TABLE `satuan_barang` DISABLE KEYS */;
INSERT INTO `satuan_barang` VALUES (2,'pcs'),(3,'liter'),(4,'gram'),(6,'Lembar');
/*!40000 ALTER TABLE `satuan_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) NOT NULL,
  `alamat_user` varchar(255) NOT NULL,
  `telepon_user` varchar(20) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type_user` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ipe','Jl Pahlawan, Surabaya','081726222211','ipel@gmail.com','admin','202cb962ac59075b964b07152d234b70',0),(2,'Ilham Fatkur','Jl. Menganti, Surabaya','081622511211','ilham@gmail.com','ilham','202cb962ac59075b964b07152d234b70',1),(3,'Maria Ayu','Jl. Rungkut, Surabaya','081726221118','maria@gmail.com','maria','202cb962ac59075b964b07152d234b70',2),(4,'Dona Alviani','Jl. A Yani, Surabaya','081726282992','dona@gmail.com','dona','202cb962ac59075b964b07152d234b70',3),(5,'Puspita Ayu','Jl. Keputih, Surabaya','081627277778','puspita@gmail.com','puspita','202cb962ac59075b964b07152d234b70',3),(6,'skmkdms','ksmckmskc','08876','sjncj@gmail.com','akue','f221cb6fe4866e9ef28e389bcd8911ac',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-31 21:37:47
