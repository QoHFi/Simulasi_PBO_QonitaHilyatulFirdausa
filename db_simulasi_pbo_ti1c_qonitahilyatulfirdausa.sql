-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2026 at 03:18 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_ti1c_qonitahilyatulfirdausa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `ID_Pendaftaran` int NOT NULL,
  `Nama_Calon` varchar(150) NOT NULL,
  `Nilai_Ujian` decimal(5,2) NOT NULL,
  `Biaya_Pendaftaran_Dasar` decimal(10,2) NOT NULL,
  `Jalur_Pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `Pilihan_Prodi` varchar(100) DEFAULT NULL,
  `Lokasi_Kampus` varchar(100) DEFAULT NULL,
  `Jenis_Prestasi` varchar(100) DEFAULT NULL,
  `Tingkat_Prestasi` varchar(50) DEFAULT NULL,
  `SK_Ikatan_Dinas` varchar(100) DEFAULT NULL,
  `Instansi_Sponsor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`ID_Pendaftaran`, `Nama_Calon`, `Nilai_Ujian`, `Biaya_Pendaftaran_Dasar`, `Jalur_Pendaftaran`, `Pilihan_Prodi`, `Lokasi_Kampus`, `Jenis_Prestasi`, `Tingkat_Prestasi`, `SK_Ikatan_Dinas`, `Instansi_Sponsor`) VALUES
(1, 'Budi Santoso', '85.50', '300000.00', 'Reguler', 'Teknik Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(2, 'Siti Aminah', '78.25', '300000.00', 'Reguler', 'Sistem Informasi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(3, 'Rian Hidayat', '92.00', '300000.00', 'Reguler', 'Kedokteran', 'Kampus Kota B', NULL, NULL, NULL, NULL),
(4, 'Dewi Lestari', '80.00', '300000.00', 'Reguler', 'Manajemen', 'Kampus Utama', NULL, NULL, NULL, NULL),
(5, 'Eko Prasetyo', '74.50', '300000.00', 'Reguler', 'Akuntansi', 'Kampus Kota B', NULL, NULL, NULL, NULL),
(6, 'Fitriani', '88.75', '300000.00', 'Reguler', 'Farmasi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(7, 'Gilang Permana', '81.20', '300000.00', 'Reguler', 'Hukum', 'Kampus Kota B', NULL, NULL, NULL, NULL),
(8, 'Ahmad Fauzi', '95.00', '150000.00', 'Prestasi', NULL, NULL, 'Olimpiade Matematika', 'Nasional', NULL, NULL),
(9, 'Hesti Purwanti', '91.50', '150000.00', 'Prestasi', NULL, NULL, 'Futsal', 'Provinsi', NULL, NULL),
(10, 'Irwan Saputra', '89.00', '150000.00', 'Prestasi', NULL, NULL, 'Karya Ilmiah Remaja', 'Internasional', NULL, NULL),
(11, 'Joko Widodo', '93.40', '150000.00', 'Prestasi', NULL, NULL, 'Pencak Silat', 'Nasional', NULL, NULL),
(12, 'Kartika Sari', '90.10', '150000.00', 'Prestasi', NULL, NULL, 'Debat Bahasa Inggris', 'Regional', NULL, NULL),
(13, 'Lutfi Hakim', '87.50', '150000.00', 'Prestasi', NULL, NULL, 'Tahfidz Al-Quran', 'Nasional', NULL, NULL),
(14, 'Mega Utami', '94.25', '150000.00', 'Prestasi', NULL, NULL, 'Bulu Tangkis', 'Provinsi', NULL, NULL),
(15, 'Nanda Pratama', '86.00', '500000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-990/KEDINASAN/2026', 'Kementerian Perhubungan'),
(16, 'Oki Setiawan', '83.20', '500000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-112/BUMN-PLN/2026', 'PT PLN (Persero)'),
(17, 'Putri Rahayu', '89.80', '500000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-554/DAGRI/2026', 'Kementerian Dalam Negeri'),
(18, 'Qori Sandria', '81.50', '500000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-023/KOMINFO/2026', 'Kementerian Kominfo'),
(19, 'Rendy Wijaya', '85.00', '500000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-887/FIN-PERTA/2026', 'PT Pertamina'),
(20, 'Siska Amelia', '90.50', '500000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-101/MENPAN/2026', 'KemenPAN-RB'),
(21, 'Taufik Hidayat', '84.10', '500000.00', 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-442/BUMN-TEL/2026', 'PT Telkom Indonesia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`ID_Pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `ID_Pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
