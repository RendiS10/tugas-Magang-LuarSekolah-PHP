-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 03:07 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuyngaji`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_kota_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `fotoadmin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_user`, `nama_lengkap`, `gender`, `tempat_kota_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `hobi`, `fotoadmin`) VALUES
(1, 5, 'Rendi Sutendi', 'Laki-laki', 'Bandung', '2002-06-10', 'Jalan Arjuna', '085721451615', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `konten` text NOT NULL,
  `tanggal_terbit` date DEFAULT curdate(),
  `penulis` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `konten`, `tanggal_terbit`, `penulis`) VALUES
(1, 'Pendaftaran Program Pelatihan Terbuka', 'Pendaftaran untuk program pelatihan telah dibuka.', '2024-11-07', 'Admin'),
(2, 'Kegiatan Muhasabah Akhir Tahun', 'Kegiatan muhasabah akan dilaksanakan pada akhir tahun.', '2024-11-07', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guru_ngaji`
--

CREATE TABLE `guru_ngaji` (
  `id_guru` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_kota_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `fotogurungaji` varchar(255) DEFAULT NULL,
  `mengajar_di_kelas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru_ngaji`
--

INSERT INTO `guru_ngaji` (`id_guru`, `id_user`, `nama_lengkap`, `gender`, `tempat_kota_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `hobi`, `fotogurungaji`, `mengajar_di_kelas`) VALUES
(5, 25, 'asal', 'Laki-laki', 'Bandung', '2024-11-10', 'dasda', '12345677', 'ada', 'asl', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(5, 'Baca Kitab'),
(3, 'Nahwu 1'),
(4, 'Nahwu 2'),
(1, 'Sharaf 1'),
(2, 'Sharaf 2');

-- --------------------------------------------------------

--
-- Table structure for table `login_user`
--

CREATE TABLE `login_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_user` enum('Peserta','Admin','Guru Ngaji') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_user`
--

INSERT INTO `login_user` (`id_user`, `username`, `password`, `role_user`) VALUES
(5, 'rendisutendi10@gmail.com', '$2y$10$LG1axnkrogDXj6yHWd8otuKhPi3Tyhw4yZyquE4sIsshCjjdzdYtC', 'Admin'),
(11, 'hilman@gmail.com', '$2y$10$0XCHo4Xrpm4VrXErcO9gTO4daxdP2IuARB8qGqmlzHvBvOoqM8a2m', 'Peserta'),
(25, 'asal@gmail.com', '$2y$10$ZqSbUDXIQKEkAPyG9fhB8OhtZw5CmJp6WVVK0o2m9RWesAF0.IkpS', 'Guru Ngaji');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `tempat_kota_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `fotopeserta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `id_user`, `nama_lengkap`, `gender`, `tempat_kota_lahir`, `tanggal_lahir`, `alamat`, `no_hp`, `hobi`, `fotopeserta`) VALUES
(21, 11, 'Hilmanns', 'Laki-laki', 'Bandung', '2024-11-09', 'Jalan Arjuna', '1234', 'Bermain Basket', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peserta_kelas`
--

CREATE TABLE `peserta_kelas` (
  `id_peserta` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peserta_program_pelatihan`
--

CREATE TABLE `peserta_program_pelatihan` (
  `id_peserta` int(11) NOT NULL,
  `id_program` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta_program_pelatihan`
--

INSERT INTO `peserta_program_pelatihan` (`id_peserta`, `id_program`) VALUES
(21, 1),
(21, 2),
(21, 3),
(21, 5);

-- --------------------------------------------------------

--
-- Table structure for table `program_pelatihan`
--

CREATE TABLE `program_pelatihan` (
  `id_program` int(11) NOT NULL,
  `nama_program` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `durasi` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_pelatihan`
--

INSERT INTO `program_pelatihan` (`id_program`, `nama_program`, `deskripsi`, `durasi`, `level`) VALUES
(1, 'Pelatihan Membaca Kitab Kuning', 'Pelatihan untuk pemula dalam membaca kitab kuning.', '5 Minggu', 'Pemula'),
(2, 'Pelatihan Tajwid', 'Kelas tajwid untuk memahami hukum-hukum dalam membaca Al-Quran.', '6 Minggu', 'Menengah'),
(3, 'Pelatihan Qiraat', 'Mempelajari berbagai macam qiraat dalam membaca Al-Quran.', '8 Minggu', 'Lanjutan'),
(5, 'Sharaf 1', 'Belajar Sharaf', '6 Bulan', '5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id_guru`,`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `guru_ngaji`
--
ALTER TABLE `guru_ngaji`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `nama_kelas` (`nama_kelas`);

--
-- Indexes for table `login_user`
--
ALTER TABLE `login_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `peserta_kelas`
--
ALTER TABLE `peserta_kelas`
  ADD PRIMARY KEY (`id_peserta`,`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `peserta_program_pelatihan`
--
ALTER TABLE `peserta_program_pelatihan`
  ADD PRIMARY KEY (`id_peserta`,`id_program`),
  ADD KEY `id_program` (`id_program`);

--
-- Indexes for table `program_pelatihan`
--
ALTER TABLE `program_pelatihan`
  ADD PRIMARY KEY (`id_program`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guru_ngaji`
--
ALTER TABLE `guru_ngaji`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_user`
--
ALTER TABLE `login_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `program_pelatihan`
--
ALTER TABLE `program_pelatihan`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login_user` (`id_user`);

--
-- Constraints for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD CONSTRAINT `guru_kelas_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `guru_ngaji` (`id_guru`),
  ADD CONSTRAINT `guru_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `guru_ngaji`
--
ALTER TABLE `guru_ngaji`
  ADD CONSTRAINT `guru_ngaji_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login_user` (`id_user`);

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login_user` (`id_user`);

--
-- Constraints for table `peserta_kelas`
--
ALTER TABLE `peserta_kelas`
  ADD CONSTRAINT `peserta_kelas_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`),
  ADD CONSTRAINT `peserta_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `peserta_program_pelatihan`
--
ALTER TABLE `peserta_program_pelatihan`
  ADD CONSTRAINT `peserta_program_pelatihan_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`),
  ADD CONSTRAINT `peserta_program_pelatihan_ibfk_2` FOREIGN KEY (`id_program`) REFERENCES `program_pelatihan` (`id_program`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
