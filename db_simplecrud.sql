-- --------------------------------------------------------
-- Database: db_simplecrud (versi diperbaiki)
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `db_simplecrud` 
DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_simplecrud`;

-- --------------------------------------------------------
-- Tabel: tb_peserta
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_peserta` (
  `id_peserta` INT(11) NOT NULL AUTO_INCREMENT,
  `nip` VARCHAR(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` VARCHAR(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` VARCHAR(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` VARCHAR(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lomba` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_peserta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabel: tb_jurusan
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_jurusan` (
  `kode_jurusan` CHAR(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jurusan` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tb_jurusan` (`kode_jurusan`, `nama_jurusan`) VALUES
('IPA', 'Ilmu Pengetahuan Alam'),
('IPS', 'Ilmu Pengetahuan Sosial'),
('BHS', 'Bahasa');

-- --------------------------------------------------------
-- Tabel: tb_jenislomba
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_jenislomba` (
  `kode_jenislomba` CHAR(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lomba` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_jenislomba`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tb_jenislomba` (`kode_jenislomba`, `nama_lomba`) VALUES
('LMB001', 'Lomba Pidato'),
('LMB002', 'Lomba Desain Poster'),
('LMB003', 'Lomba Menulis Cerpen'),
('LMB004', 'Lomba Fotografi'),
('LMB005', 'Lomba Videografi'),
('LMB006', 'Lomba Tari');

-- --------------------------------------------------------
-- Tabel: tb_kelas
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id_kelas` SMALLINT(3) NOT NULL AUTO_INCREMENT,
  `nama_kelas` VARCHAR(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, '10A'),
(2, '10B'),
(3, '11A'),
(4, '11B'),
(5, '12A'),
(6, '12B');
