-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 05:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(2, 'admin@gmail.com', '$2y$10$rW4RQjKmFa5QwdZL.p5M4u0EKW1uTgLTwc8XzT/NwLrooqbS8aVlG');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) UNSIGNED NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_kegiatan`
--

CREATE TABLE `daftar_kegiatan` (
  `no` int(11) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `rab` int(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `daftar_kegiatan`
--

INSERT INTO `daftar_kegiatan` (`no`, `nama_kegiatan`, `deskripsi`, `lokasi`, `rab`, `tgl_mulai`, `tgl_selesai`, `status`) VALUES
(2, 'Evakuasi Sibingung', 'Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet. Lorem Ipsum Dolor Sit Amet.', 'Sumatera Utara', 500000000, '2024-05-30', '2024-06-30', 'Dalam Proses');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_tugas`
--

CREATE TABLE `daftar_tugas` (
  `no` int(11) UNSIGNED NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `target_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `daftar_tugas`
--

INSERT INTO `daftar_tugas` (`no`, `nama_tugas`, `target_id`, `status`) VALUES
(2, 'Membuat Proposal 2', 1, 'Terlaksana'),
(3, 'Membuat Proposal 3', 1, 'Terlaksana'),
(4, 'Membuat Proposal 4', 1, 'Belum Terlaksana'),
(5, 'Mendirikan Tenda Pengungsian', 2, 'Belum Terlaksana'),
(6, 'Menyiapkan bahan makanan', 2, 'Belum Terlaksana'),
(11, 'laporan', 3, 'Belum Terlaksana'),
(19, 'Membuat Proposal', 1, 'Belum Terlaksana');

-- --------------------------------------------------------

--
-- Table structure for table `kecakapan`
--

CREATE TABLE `kecakapan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `warna` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kecakapan`
--

INSERT INTO `kecakapan` (`id`, `nama`, `warna`) VALUES
(2, 'Masak', 'warning'),
(3, 'Medis', 'success'),
(4, 'IT', 'info'),
(5, 'lari', 'primary');

-- --------------------------------------------------------

--
-- Table structure for table `kecakapan_user`
--

CREATE TABLE `kecakapan_user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `kecakapan_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kecakapan_user`
--

INSERT INTO `kecakapan_user` (`user_id`, `kecakapan_id`) VALUES
(2, 2),
(3, 2),
(3, 3),
(4, 3),
(5, 2),
(5, 3),
(6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_user`
--

CREATE TABLE `kegiatan_user` (
  `kegiatan_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koordinator_kecakapan`
--

CREATE TABLE `koordinator_kecakapan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ttl` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `ktp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kegiatan_id` int(11) DEFAULT NULL,
  `id_kecakapan` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `koordinator_kecakapan`
--

INSERT INTO `koordinator_kecakapan` (`id`, `nama`, `password`, `ttl`, `gender`, `jabatan`, `divisi`, `ktp`, `alamat`, `telp`, `email`, `kegiatan_id`, `id_kecakapan`) VALUES
(6, 'KrisTEN', '$2y$10$0OSMe4X3J7Hsz8HHWMFn0.xwsOFjFIqHrtBNJJOgsJ4Ufpt/0XUfm', '2000-12-01', 'pria', 'Staff', 'Kejiwaan', '1803051458560001', 'Natuna;Bunguran Timur;KAB. NATUNA;Kepulauan Riau', '082154585565', 'krisTN@gmail.com', 2, 5),
(7, 'KrisNine', '$2y$10$0OSMe4X3J7Hsz8HHWMFn0.xwsOFjFIqHrtBNJJOgsJ4Ufpt/0XUfm', '2000-12-01', 'pria', 'Staff', 'Kejiwaan', '1803051458560001', 'Natuna;Bunguran Timur;KAB. NATUNA;Kepulauan Riau', '082154585565', 'krisNN@gmail.com', 2, 2),
(8, 'KrisSeven', '$2y$10$0OSMe4X3J7Hsz8HHWMFn0.xwsOFjFIqHrtBNJJOgsJ4Ufpt/0XUfm', '2000-12-01', 'pria', 'Staff', 'Kejiwaan', '1803051458560001', 'Natuna;Bunguran Timur;KAB. NATUNA;Kepulauan Riau', '082154585565', 'kris7@gmail.com', NULL, 4),
(9, 'KrisEight', '$2y$10$0OSMe4X3J7Hsz8HHWMFn0.xwsOFjFIqHrtBNJJOgsJ4Ufpt/0XUfm', '2000-12-01', 'pria', 'Staff', 'Kejiwaan', '1803051458560001', 'Natuna;Bunguran Timur;KAB. NATUNA;Kepulauan Riau', '082154585565', 'krisEG@gmail.com', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_harian`
--

CREATE TABLE `laporan_harian` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `deskripsi_laporan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` set('valid','-') NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `laporan_harian`
--

INSERT INTO `laporan_harian` (`id`, `id_kegiatan`, `deskripsi_laporan`, `tanggal`, `status`) VALUES
(3, 2, 'asdasdasdddd', '2024-06-06', 'valid'),
(4, 2, 'Test Laporan kedua. Pada hari ini, saya melakukan update terhadap user dimana user dapat melakukan laporan harian.', '2024-06-07', 'valid'),
(8, 2, 'hfdsfgsgfxvxfgdsrgdfgxfgasdasd', '2024-06-08', '-'),
(10, 2, 'asdxcasdwqdsasxzasdwaqsdasd', '2024-06-09', '-'),
(12, 2, 'testtt laporaan nih boss', '2024-06-10', '-');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_harian_daftar_tugas`
--

CREATE TABLE `laporan_harian_daftar_tugas` (
  `id_laporan_harian` int(11) NOT NULL,
  `id_daftar_tugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_harian_daftar_tugas`
--

INSERT INTO `laporan_harian_daftar_tugas` (`id_laporan_harian`, `id_daftar_tugas`) VALUES
(2, 1),
(2, 2),
(3, 1),
(3, 3),
(4, 5),
(5, 6),
(6, 5),
(6, 6),
(7, 5),
(7, 6),
(9, 5),
(10, 6),
(11, 5),
(11, 6),
(8, 0),
(12, 5),
(12, 6);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-02-26-114507', 'App\\Database\\Migrations\\AddUser', 'default', 'App', 1714729395, 1),
(2, '2024-05-03-092708', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1714729395, 1),
(3, '2024-05-03-092722', 'App\\Database\\Migrations\\Agenda', 'default', 'App', 1714729395, 1),
(4, '2024-05-03-092739', 'App\\Database\\Migrations\\DaftarKegiatan', 'default', 'App', 1714729395, 1),
(5, '2024-05-03-092755', 'App\\Database\\Migrations\\DaftarTugas', 'default', 'App', 1714729395, 1),
(6, '2024-05-03-092808', 'App\\Database\\Migrations\\LaporanHarian', 'default', 'App', 1714729395, 1),
(7, '2024-05-03-092830', 'App\\Database\\Migrations\\LaporanKeuangan', 'default', 'App', 1714729395, 1),
(8, '2024-05-03-092858', 'App\\Database\\Migrations\\PendaftaranRelawan', 'default', 'App', 1714729395, 1),
(9, '2024-05-03-092909', 'App\\Database\\Migrations\\Pengeluaran', 'default', 'App', 1714729395, 1),
(10, '2024-05-03-092919', 'App\\Database\\Migrations\\RAB', 'default', 'App', 1714729395, 1),
(11, '2024-05-03-092929', 'App\\Database\\Migrations\\Target', 'default', 'App', 1714729395, 1),
(12, '2024-05-03-092935', 'App\\Database\\Migrations\\User', 'default', 'App', 1714729395, 1),
(13, '2024-05-03-092858', 'App\\Database\\Migrations\\User', 'default', 'App', 1714738652, 2),
(14, '2024-05-03-122346', 'App\\Database\\Migrations\\Kecakapan', 'default', 'App', 1714739428, 3),
(15, '2024-05-03-122546', 'App\\Database\\Migrations\\KecakapanUser', 'default', 'App', 1714739428, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `no` int(11) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `sumber_dana` varchar(255) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `id_kegiatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`no`, `tanggal`, `deskripsi`, `sumber_dana`, `jumlah`, `id_kegiatan`) VALUES
(1, '2024-05-26', 'Test', 'tseeet', 1000000, 2),
(2, '2024-05-26', 'sembako', 'PT sehat jasmani rohani', 5000000, 2),
(6, '2024-05-27', 'Sumbangan', 'PT sehat jasmani aja', 5000000, 2),
(7, '2024-05-26', 'Sumbangan', 'PT sehat rohani aja', 5000000, 2),
(9, '2024-06-01', 'uang halal', 'orang dalem', 5000000, 2),
(10, '2024-06-09', 'cekk', 'asdadasdasd', 5000000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) UNSIGNED NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `qty_pengeluaran` int(11) NOT NULL,
  `deskripsi_pengeluaran` text DEFAULT NULL,
  `nota_pengeluaran` varchar(255) DEFAULT NULL,
  `harga_pengeluaran` double NOT NULL,
  `total_pengeluaran` double NOT NULL,
  `id_kegiatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `tanggal_pengeluaran`, `qty_pengeluaran`, `deskripsi_pengeluaran`, `nota_pengeluaran`, `harga_pengeluaran`, `total_pengeluaran`, `id_kegiatan`) VALUES
(1, '2024-06-09', 3, 'test', '1719673806_2309ac5bfc5b262293de.jpeg', 50000, 150000, 2),
(2, '2024-06-09', 1, 'asdasdadad', NULL, 50000, 50000, 2),
(4, '2024-06-08', 5, 'cekk', NULL, 500000, 2500000, 2),
(6, '2024-06-09', 2, 'test tanpa nota', NULL, 50000, 100000, 2),
(9, '2024-06-06', 1, 'test nota', '1717957038_332634a53bf8d9f50d9e.png', 50000, 50000, 2),
(10, '2024-06-07', 1, 'test nota 2', '1717957657_37cc20e3df6f7b03351c.jpeg', 50000, 50000, 2),
(11, '2024-06-09', 3, 'test tanpa nota 2', NULL, 10000, 30000, 2),
(13, '2024-06-09', 2, 'test tanpa nota 3', NULL, 500000, 1000000, 2),
(14, '2024-05-31', 2, 'test tanpa nota 3', NULL, 500000, 1000000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rab`
--

CREATE TABLE `rab` (
  `no` int(11) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `proyek` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `harga` double NOT NULL,
  `ppn` double NOT NULL,
  `pajak_lain` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE `target` (
  `no` int(11) UNSIGNED NOT NULL,
  `nama_target` varchar(255) NOT NULL,
  `target_selesai` date NOT NULL,
  `progress` int(11) NOT NULL,
  `target_mulai` date NOT NULL,
  `kegiatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`no`, `nama_target`, `target_selesai`, `progress`, `target_mulai`, `kegiatan_id`) VALUES
(1, 'PRA-PELAKSANAAN', '2024-06-06', 75, '2024-05-30', 2),
(2, 'PELAKSANAAN', '2024-06-21', 0, '2024-06-07', 2),
(3, 'PASCA PELAKSANAAN', '2024-06-30', 0, '2024-06-22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ttl` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `pendidikan_terakhir` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `ktp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kegiatan_id` int(11) DEFAULT NULL,
  `role` set('Ketua','Anggota','-') NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `password`, `ttl`, `gender`, `pendidikan_terakhir`, `pekerjaan`, `ktp`, `alamat`, `telp`, `email`, `kegiatan_id`, `role`) VALUES
(2, 'Krisna Benedict Cummerbach', '$2y$10$ejNCDT3k3Zdplbg./GbfKuBl4RLEWAoRShhxn2mr1dxK9UHTPvL.W', '2000-12-14', 'pria', 'Sekolah Dasar', 'Anak Kecil', '1803100812010005', 'Jl Perintis MAN No.7, Kelapa Tujuh;Kotabumi Selatan;KAB. LAMPUNG UTARA;Lampung', '08121211212', 'kmbrps@gmail.com', 2, 'Ketua'),
(3, 'Achmad Romadoni', '$2y$10$YFM6bvQmJmVM/CsaXsTEf.if8cGflW/NlmDZ3Qg2fGLLXO9r.j3He', '2001-12-08', 'pria', 'Sekolah Menengah Atas', 'Mahasiswa', '1803100812010005', 'Jl Perintis MAN No.7, Kelapa Tujuh;Kotabumi Selatan;KAB. LAMPUNG UTARA;Lampung', '082368976503', 'acron@gmail.com', NULL, '-'),
(4, 'Tejo Sujatno', '$2y$10$IQ/FII7TFQ/oA694O4SnXejTbklLGqnNPcIRLF7jguc8BouJVpNVe', '1995-02-15', 'pria', 'Sekolah Menengah Atas', 'Akuntan', '181212356585', 'Jl. Kebangsaan No.8;Wedi;KAB. KLATEN;Jawa Tengah', '082356856985', 'tejo@gmail.com', 2, 'Anggota'),
(5, 'boni', '$2y$10$dMyWtSFxqSmyq2BbJq7Vm.rmmZL8tAAgHauqWYO/ru3D3PRjOYwfS', '2001-01-01', 'pria', 'Sekolah Menengah Atas', 'nganggur', '1231321546', 'bumi;Kemiling;KOTA BANDAR LAMPUNG;Lampung', '082125645235', 'boni@gmail.com', 2, 'Anggota'),
(6, 'Krisna beler', '$2y$10$0uau6DA4cy.ALoHxLNZUReTTR.xMVDp/qMLP.QttrlP7MiCoLjaHC', '2000-02-01', 'pria', 'Sekolah Menengah Atas', 'PNS', '198109827342', 'Natuna;Serasan Timur;KAB. NATUNA;Kepulauan Riau', '081219219234', 'kmbrpsB@gmail.com', NULL, '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_kegiatan`
--
ALTER TABLE `daftar_kegiatan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `daftar_tugas`
--
ALTER TABLE `daftar_tugas`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `kecakapan`
--
ALTER TABLE `kecakapan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecakapan_user`
--
ALTER TABLE `kecakapan_user`
  ADD KEY `kecakapan_user_user_id_foreign` (`user_id`),
  ADD KEY `kecakapan_user_kecakapan_id_foreign` (`kecakapan_id`);

--
-- Indexes for table `kegiatan_user`
--
ALTER TABLE `kegiatan_user`
  ADD KEY `fk_kegiatan_user` (`user_id`),
  ADD KEY `fk_user_kegiatan` (`kegiatan_id`);

--
-- Indexes for table `koordinator_kecakapan`
--
ALTER TABLE `koordinator_kecakapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kecakapan_kk` (`id_kecakapan`);

--
-- Indexes for table `laporan_harian`
--
ALTER TABLE `laporan_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rab`
--
ALTER TABLE `rab`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `daftar_kegiatan`
--
ALTER TABLE `daftar_kegiatan`
  MODIFY `no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `daftar_tugas`
--
ALTER TABLE `daftar_tugas`
  MODIFY `no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kecakapan`
--
ALTER TABLE `kecakapan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `koordinator_kecakapan`
--
ALTER TABLE `koordinator_kecakapan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `laporan_harian`
--
ALTER TABLE `laporan_harian`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rab`
--
ALTER TABLE `rab`
  MODIFY `no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `target`
--
ALTER TABLE `target`
  MODIFY `no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kecakapan_user`
--
ALTER TABLE `kecakapan_user`
  ADD CONSTRAINT `kecakapan_user_kecakapan_id_foreign` FOREIGN KEY (`kecakapan_id`) REFERENCES `kecakapan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kecakapan_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kegiatan_user`
--
ALTER TABLE `kegiatan_user`
  ADD CONSTRAINT `fk_kegiatan_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_user_kegiatan` FOREIGN KEY (`kegiatan_id`) REFERENCES `daftar_kegiatan` (`no`);

--
-- Constraints for table `koordinator_kecakapan`
--
ALTER TABLE `koordinator_kecakapan`
  ADD CONSTRAINT `fk_kecakapan_kk` FOREIGN KEY (`id_kecakapan`) REFERENCES `kecakapan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
