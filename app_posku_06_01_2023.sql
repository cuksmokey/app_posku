-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for app_posku
CREATE DATABASE IF NOT EXISTS `app_posku` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `app_posku`;

-- Dumping structure for table app_posku.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table app_posku.barang: ~2 rows (approximately)
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
REPLACE INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`) VALUES
	(9, 'Kramas', 5000, 10),
	(10, 'Potong + Cuci', 5000, 2);
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table app_posku.jasa
CREATE TABLE IF NOT EXISTS `jasa` (
  `id_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jasa` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_jasa`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table app_posku.jasa: ~3 rows (approximately)
/*!40000 ALTER TABLE `jasa` DISABLE KEYS */;
REPLACE INTO `jasa` (`id_jasa`, `nama_jasa`, `harga`, `stok`) VALUES
	(9, 'Kramas1', 5000, NULL),
	(10, 'Potong + Cuci', 5000, NULL),
	(12, 'Cuci + gunting', 40000, NULL);
/*!40000 ALTER TABLE `jasa` ENABLE KEYS */;

-- Dumping structure for table app_posku.nourut
CREATE TABLE IF NOT EXISTS `nourut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` char(3) NOT NULL,
  `kode_urut` varchar(20) NOT NULL,
  `hedket` varchar(50) NOT NULL DEFAULT '',
  `param1` varchar(10) NOT NULL DEFAULT '',
  `param2` varchar(10) NOT NULL DEFAULT '0',
  `nourut` decimal(10,0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `koders` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table app_posku.nourut: ~0 rows (approximately)
/*!40000 ALTER TABLE `nourut` DISABLE KEYS */;
REPLACE INTO `nourut` (`id`, `kode`, `kode_urut`, `hedket`, `param1`, `param2`, `nourut`) VALUES
	(1, 'BND', 'TR', 'TRANSAKSI', 'TH', 'TR', 5);
/*!40000 ALTER TABLE `nourut` ENABLE KEYS */;

-- Dumping structure for table app_posku.operator
CREATE TABLE IF NOT EXISTS `operator` (
  `operator_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `last_login` date NOT NULL,
  PRIMARY KEY (`operator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table app_posku.operator: ~1 rows (approximately)
/*!40000 ALTER TABLE `operator` DISABLE KEYS */;
REPLACE INTO `operator` (`operator_id`, `nama_lengkap`, `username`, `password`, `last_login`) VALUES
	(6, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2023-01-06');
/*!40000 ALTER TABLE `operator` ENABLE KEYS */;

-- Dumping structure for table app_posku.tbl_namers
CREATE TABLE IF NOT EXISTS `tbl_namers` (
  `koders` char(3) NOT NULL,
  `namars` char(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `kota` char(40) NOT NULL,
  `phone` char(40) NOT NULL,
  `whatsapp` char(40) NOT NULL,
  `fax` char(40) NOT NULL,
  `email` char(40) NOT NULL,
  `website` char(50) NOT NULL,
  `pejabat1` char(100) NOT NULL,
  `jabatan1` char(100) NOT NULL,
  `ketbank` char(250) NOT NULL,
  `ketbank2` char(254) NOT NULL,
  `ketbank3` char(254) NOT NULL,
  `pejabat2` char(30) NOT NULL,
  `jabatan2` char(30) NOT NULL,
  `jabatan3` char(30) NOT NULL,
  `pejabat3` char(30) NOT NULL,
  `jabatan4` char(30) NOT NULL,
  `pejabat4` char(30) NOT NULL,
  `namaapotik` char(50) NOT NULL,
  `apoteker` char(100) NOT NULL,
  `jabatan` char(50) NOT NULL,
  `noijin` char(40) NOT NULL,
  `npwp` char(40) NOT NULL,
  `pkpno` char(40) NOT NULL,
  `tglpkp` date NOT NULL,
  `wahost` char(254) NOT NULL,
  `watoken` char(254) NOT NULL,
  `mou` char(100) DEFAULT 'NULL',
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `alamat2` varchar(255) DEFAULT 'NULL',
  `kodeurut` int(11) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'foto.jpg',
  PRIMARY KEY (`koders`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table app_posku.tbl_namers: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_namers` DISABLE KEYS */;
REPLACE INTO `tbl_namers` (`koders`, `namars`, `alamat`, `kota`, `phone`, `whatsapp`, `fax`, `email`, `website`, `pejabat1`, `jabatan1`, `ketbank`, `ketbank2`, `ketbank3`, `pejabat2`, `jabatan2`, `jabatan3`, `pejabat3`, `jabatan4`, `pejabat4`, `namaapotik`, `apoteker`, `jabatan`, `noijin`, `npwp`, `pkpno`, `tglpkp`, `wahost`, `watoken`, `mou`, `tgl_awal`, `tgl_akhir`, `alamat2`, `kodeurut`, `avatar`) VALUES
	('BND', 'BEAUTY N DREAM', 'JL. PAKEL NO. 59 BONANGAN - BATURAN\r\nCOLOMADU - JAWA TENGAH', 'DIY', '11', '22', '33', '', '', 'Haha', '1', '', '', '', 'Fifi', '2', '3', 'Dadah', '4', 'Nunu', 'ABI', 'Hyung', 'Kepala Apoteker', '1111111111111111111111111111', '0029938843', 'q', '0000-00-00', '', '', 'NULL', NULL, NULL, 'NULL', 4, 'ski3.jpg');
/*!40000 ALTER TABLE `tbl_namers` ENABLE KEYS */;

-- Dumping structure for table app_posku.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` date NOT NULL,
  `operator_id` int(11) NOT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table app_posku.transaksi: ~5 rows (approximately)
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
REPLACE INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `operator_id`, `invoice`) VALUES
	(1, '2022-12-30', 6, 'TR2023000001'),
	(2, '2022-12-31', 6, 'TR2023000002'),
	(3, '2023-01-02', 6, 'TR2023000003'),
	(7, '2023-01-02', 6, 'TR2023000004'),
	(8, '2023-01-06', 6, 'TR2023000005');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- Dumping structure for table app_posku.transaksi_dtl
CREATE TABLE IF NOT EXISTS `transaksi_dtl` (
  `id_transaksi_dtl` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `disc` int(11) DEFAULT NULL,
  `discrp2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_dtl`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table app_posku.transaksi_dtl: ~9 rows (approximately)
/*!40000 ALTER TABLE `transaksi_dtl` DISABLE KEYS */;
REPLACE INTO `transaksi_dtl` (`id_transaksi_dtl`, `id_barang`, `qty`, `id_transaksi`, `harga`, `status`, `disc`, `discrp2`) VALUES
	(1, 8, 1, 1, 1000, '1', 0, 0),
	(2, 9, 1, 2, 5000, '1', 0, 0),
	(3, 10, 1, 2, 5000, '1', 0, 0),
	(4, 9, 1, 2, 5000, '1', 0, 0),
	(5, 9, 11, 3, 5000, '1', 0, 0),
	(21, 9, 1, 7, 5000, '1', 0, 0),
	(22, 10, 1, 7, 5000, '1', 0, 0),
	(27, 10, 2, 8, 5000, '1', 50, 5000),
	(28, 9, 2, 8, 5000, '1', 10, 1000);
/*!40000 ALTER TABLE `transaksi_dtl` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
