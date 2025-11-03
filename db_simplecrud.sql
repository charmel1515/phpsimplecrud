-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_simplecrud
CREATE DATABASE IF NOT EXISTS `db_simplecrud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `db_simplecrud`;

-- Dumping structure for table db_simplecrud.tb_mahasiswa
CREATE TABLE IF NOT EXISTS `tb_peserta` (
  `id_peserta` int(11) NOT NULL AUTO_INCREMENT,
  `nip_peserta` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nama_peserta` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `jurusan_peserta` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `kelas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(3) NOT NULL,
  `no_telepon` char(101) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lomba_diikuti` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `jenis_lomba` varchar(100) NOT NULL,
  PRIMARY KEY (`id_peserta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `tb_jurusan` (
  `kode_jurusan` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jurusan` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `tb_jurusan` (`kode_jurusan`, `nama_jurusan`) VALUES
	('IPA', 'Ilmu Pengetahuan Alam'),
	('IP', 'Ilmu Pengetahuan Sosial'),
	('BHS', 'Bahasa');



-- Dumping data for table db_simplecrud.tb_mahasiswa: ~0 rows (approximately)

-- Dumping structure for table db_simplecrud.tb_jurusan
CREATE TABLE IF NOT EXISTS `tb_jenislomba` (
  `kode_jenislomba` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jurusan` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_jenislomba`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_prodi: ~9 rows (approximately)
INSERT INTO `tb_jenislomba` (`id_jenislomba`, `nm_lomba`) VALUES
	('1', 'Lomba Pidato'),
	('2', 'Lomba Desain Poster'),
	('3', 'Lomba Menulis Cerpen'),
	('4', 'Lomba Fotografi'),
	('5', 'Lomba Videografi'),
	('6', 'Lomba Tari');
	

-- Dumping structure for table db_simplecrud.tb_kelas
CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id_kelas` smallint(3) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_kelas: ~6 rows (approximately)
INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
	(1, '10A'),
	(2, '10B'),
	(3, '11A'),
	(4, '11B'),
	(5, '12A'),
	(6, '12B');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
