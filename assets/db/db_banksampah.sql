-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 06:58 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_banksampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nasabah`
--

CREATE TABLE `tbl_nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `poin_nasabah` varchar(11) DEFAULT NULL,
  `nama_nasabah` varchar(100) DEFAULT NULL,
  `pekerjaan_nasabah` varchar(100) DEFAULT NULL,
  `alamat` varchar(256) DEFAULT NULL,
  `alamat_rt` varchar(6) DEFAULT NULL,
  `alamat_rw` varchar(6) DEFAULT NULL,
  `email_nsb` varchar(100) DEFAULT NULL,
  `email_nsb_verif` varchar(1) DEFAULT NULL,
  `no_tlp_nsb` varchar(15) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `date_join_nsb` int(11) DEFAULT NULL,
  `status_nasabah` varchar(1) DEFAULT NULL,
  `img_nasabah` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_nasabah`
--

INSERT INTO `tbl_nasabah` (`id_nasabah`, `poin_nasabah`, `nama_nasabah`, `pekerjaan_nasabah`, `alamat`, `alamat_rt`, `alamat_rw`, `email_nsb`, `email_nsb_verif`, `no_tlp_nsb`, `username`, `password`, `date_join_nsb`, `status_nasabah`, `img_nasabah`) VALUES
(2306001, '67250', 'Ariq Muthi ', 'Karyawan', 'Kp. Cikarawang', '012', '009', 'ariq@gmail.com', '1', '8977689778', 'ariq', '$2y$10$Gy0FO4ueraQVzBtjXSH4zO2cYXL1If0wB8cAMyIOs1RPatdsFOkSa', NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partner`
--

CREATE TABLE `tbl_partner` (
  `id_partner` int(11) NOT NULL,
  `nama_partner` varchar(100) DEFAULT NULL,
  `status_partner` varchar(1) DEFAULT NULL,
  `img_partner` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_partner`
--

INSERT INTO `tbl_partner` (`id_partner`, `nama_partner`, `status_partner`, `img_partner`) VALUES
(1, 'pemerintahan desa kayangan', '1', 'IMG-Partnercf97ec94bd16be83d22b.png'),
(2, 'kementerian lingkungan', '1', 'IMG-Partner36d0ba83c001afffe8b9.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penukaran`
--

CREATE TABLE `tbl_penukaran` (
  `id_penukaran` varchar(20) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `date_penukaran` varchar(11) DEFAULT NULL,
  `kode` varchar(11) DEFAULT NULL,
  `jenis_penukaran` varchar(30) DEFAULT NULL,
  `poin_penukaran` int(11) DEFAULT NULL,
  `nominal_penukaran` int(11) DEFAULT NULL,
  `nama_tujuan` varchar(100) DEFAULT NULL,
  `send_tujuan` varchar(256) DEFAULT NULL,
  `deskripsi_penukaran` text DEFAULT NULL,
  `status_penukaran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_penukaran`
--

INSERT INTO `tbl_penukaran` (`id_penukaran`, `id_nasabah`, `date_penukaran`, `kode`, `jenis_penukaran`, `poin_penukaran`, `nominal_penukaran`, `nama_tujuan`, `send_tujuan`, `deskripsi_penukaran`, `status_penukaran`) VALUES
('TKR-1687710329', 2306001, '1687710329', 'TKR2305002', 'tukar_barang', 100000, 2999000, 'Ariq Muthi ', 'kp. cikarawang rt. 012 rw. 009', 'penukaran handphone', 'proses');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `id_review` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `rating_review` int(1) DEFAULT NULL,
  `deskripsi_review` text DEFAULT NULL,
  `status_review` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`id_review`, `id_nasabah`, `rating_review`, `deskripsi_review`, `status_review`) VALUES
(6, 2306001, 5, 'Test', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reward`
--

CREATE TABLE `tbl_reward` (
  `kode_reward` varchar(11) NOT NULL,
  `nama_reward` varchar(100) DEFAULT NULL,
  `poin_reward` varchar(11) DEFAULT NULL,
  `nominal_reward` int(11) DEFAULT NULL,
  `jenis_reward` enum('voucher','tukar_barang') DEFAULT NULL,
  `status_reward` varchar(1) DEFAULT NULL,
  `stok_reward` varchar(11) DEFAULT NULL,
  `on_thumbnail` varchar(1) DEFAULT NULL,
  `img_reward` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reward`
--

INSERT INTO `tbl_reward` (`kode_reward`, `nama_reward`, `poin_reward`, `nominal_reward`, `jenis_reward`, `status_reward`, `stok_reward`, `on_thumbnail`, `img_reward`) VALUES
('MID2306003', 'voucher rp. 100.000', '50000', 100000, 'voucher', '1', '0', '1', 'IMG-Rewardb6313f1322d6dae87c97.jpg'),
('TKR2305002', 'handphone', '100000', 2999000, 'tukar_barang', '1', '3', '1', 'IMG-Rewarda7ba474307cc12f60090.jpg'),
('VOU2306004', 'voucher rp. 50,000', '25000', 50000, 'voucher', '1', '0', '1', 'IMG-Reward28163b0f60dc844f42b0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sampah`
--

CREATE TABLE `tbl_sampah` (
  `id_sampah` int(11) NOT NULL,
  `nama_sampah` varchar(100) DEFAULT NULL,
  `satuan_sampah` varchar(5) DEFAULT NULL,
  `deskripsi_sampah` text DEFAULT NULL,
  `poin_sampah` varchar(11) DEFAULT NULL,
  `status_sampah` varchar(1) DEFAULT NULL,
  `id_sampah_kat` int(11) DEFAULT NULL,
  `img_sampah` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sampah`
--

INSERT INTO `tbl_sampah` (`id_sampah`, `nama_sampah`, `satuan_sampah`, `deskripsi_sampah`, `poin_sampah`, `status_sampah`, `id_sampah_kat`, `img_sampah`) VALUES
(1, 'kaleng bekas', 'kg', '<ul><li>Harap bersihkan terlebih dahulu</li><li>Pastikan telah dipilah</li></ul>', '1800', '1', 1, 'IMG-Sampahfb4b70fe4e1590139a41.jpg'),
(2, 'besi potongan', 'kg', '<ul><li>bersih</li><li>dan rapi</li></ul>', '2500', '1', 1, 'IMG-Sampah22ccee3813fe5adb26b8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sampah_kategori`
--

CREATE TABLE `tbl_sampah_kategori` (
  `id_sampah_kat` int(11) NOT NULL,
  `kode_sampah_kat` varchar(12) DEFAULT NULL,
  `nama_sampah_kat` varchar(100) DEFAULT NULL,
  `status_sampah_kat` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sampah_kategori`
--

INSERT INTO `tbl_sampah_kategori` (`id_sampah_kat`, `kode_sampah_kat`, `nama_sampah_kat`, `status_sampah_kat`) VALUES
(1, 'LGM', 'logam', '1'),
(2, 'KDS', 'kardus', '1'),
(4, 'PET', 'plastik', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setor`
--

CREATE TABLE `tbl_setor` (
  `id_setor` varchar(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `date_setor` varchar(11) DEFAULT NULL,
  `nama_sampah_setor` varchar(100) DEFAULT NULL,
  `poin_sampah_setor` varchar(11) DEFAULT NULL,
  `berat_setor` varchar(11) DEFAULT NULL,
  `poin_total` varchar(11) DEFAULT NULL,
  `status_setor` varchar(1) DEFAULT NULL,
  `petugas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_setor`
--

INSERT INTO `tbl_setor` (`id_setor`, `id_nasabah`, `date_setor`, `nama_sampah_setor`, `poin_sampah_setor`, `berat_setor`, `poin_total`, `status_setor`, `petugas`) VALUES
('23062500001', 2306001, '1687708253', 'besi potongan', '2500', '2', '5000', '1', 'aldy winata'),
('23062500002', 2306001, '1687708271', 'besi potongan', '2500', '2.45', '6125', '1', 'aldy winata'),
('23062500003', 2306001, '1687709098', 'besi potongan', '2500', '2.45', '6125', '1', 'aldy winata'),
('23062500004', 2306001, '1687709571', 'besi potongan', '2500', '10', '25000', '1', 'aldy winata'),
('23062500005', 2306001, '1687709599', 'besi potongan', '2500', '50', '125000', '1', 'aldy winata');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system_info`
--

CREATE TABLE `tbl_system_info` (
  `id_sysfo` int(1) NOT NULL,
  `icon_sysfo` varchar(100) DEFAULT NULL,
  `img_hero_sysfo` varchar(100) DEFAULT NULL,
  `img_hero2_sysfo` varchar(100) DEFAULT NULL,
  `nama_sysfo` varchar(50) DEFAULT NULL,
  `slogan_sysfo` varchar(256) DEFAULT NULL,
  `about_sysfo` text DEFAULT NULL,
  `no_sysfo` varchar(15) DEFAULT NULL,
  `email_sysfo` varchar(100) DEFAULT NULL,
  `hari_kerja_sysfo` varchar(50) DEFAULT NULL,
  `jam_kerja_sysfo` varchar(50) DEFAULT NULL,
  `alamat_sysfo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_system_info`
--

INSERT INTO `tbl_system_info` (`id_sysfo`, `icon_sysfo`, `img_hero_sysfo`, `img_hero2_sysfo`, `nama_sysfo`, `slogan_sysfo`, `about_sysfo`, `no_sysfo`, `email_sysfo`, `hari_kerja_sysfo`, `jam_kerja_sysfo`, `alamat_sysfo`) VALUES
(1, 'IMG-icon92cbe9a97ef8aef99786.png', 'IMG-icon92cbe9a97ef8aef99786.jpg', 'IMG-icon3763926bd94a6b6e35ea.png', 'sampahku', 'tukar sampahmu untuk mendapatkan penghasilan tambahan', 'sampahku merupakan website sistem informasi bank sampah yang menjadi salah satu solusi untuk permasalahan sampah yang ada di masyarakat  dan secara tidak langsung website sampahku mempunyai nilai edukasi terhadap kepedulian akan lingkungan sehingga dapat menciptakan lingkungan yang bersih dan bebas dari sampah dan dapat meningkatkan ekonomi bagi masyarakat.', '087654632563', 'infoku@sampahku.com', 'senin - jum\'at', '08:00 - 15:00', 'jl. pemkot bogor rt.001/001 kelurahan bogor kota bogor provinsi jawa barat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_token`
--

CREATE TABLE `tbl_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(130) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_users` int(11) NOT NULL,
  `nama_users` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `email_verif` varchar(1) DEFAULT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  `img_users` varchar(100) DEFAULT NULL,
  `status_users` varchar(1) DEFAULT NULL,
  `date_join` int(11) DEFAULT NULL,
  `id_users_role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_users`, `nama_users`, `username`, `password`, `email`, `email_verif`, `no_tlp`, `img_users`, `status_users`, `date_join`, `id_users_role`) VALUES
(1, 'aldy winata', 'admin', '$2y$10$sQvcImyD7.2xO2YkDY3Fru6IC9QUL7IG2kLXCQpDDyo1i59R/mVKu', 'aldyw.wt6@gmail.com', '1', '085782524604', 'IMG-Usersb99306e6e600c03d6967.jpg', '1', 1682940088, 1),
(2, 'dimas aji', 'pimpinan', '$2y$10$QjjbUPB7Ui23yaXIl9DPCOI788M9BRfMtPsIT5fYYIo7rP.FmI8iC', 'aw060800@gmail.com', '1', '0899', 'default_img.png', '1', 1683026488, 2),
(3, 'desi purnama sari', 'petugas', '$2y$10$ToOUBC1VxQf6fujZXZ27NOPimmZWLFp3RG6hAfYwOGo6gcogscub.', 'aldyw680@gmail.com', '1', '085712345', 'default_img.png', '1', 1683026488, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users_role`
--

CREATE TABLE `tbl_users_role` (
  `id_users_role` int(11) NOT NULL,
  `nama_role` varchar(50) DEFAULT NULL,
  `status_role` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users_role`
--

INSERT INTO `tbl_users_role` (`id_users_role`, `nama_role`, `status_role`) VALUES
(1, 'administrator', 1),
(2, 'pimpinan', 1),
(3, 'petugas', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_nasabah`
--
ALTER TABLE `tbl_nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indexes for table `tbl_partner`
--
ALTER TABLE `tbl_partner`
  ADD PRIMARY KEY (`id_partner`);

--
-- Indexes for table `tbl_penukaran`
--
ALTER TABLE `tbl_penukaran`
  ADD PRIMARY KEY (`id_penukaran`),
  ADD KEY `id_nasabah` (`id_nasabah`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_nasabah` (`id_nasabah`);

--
-- Indexes for table `tbl_reward`
--
ALTER TABLE `tbl_reward`
  ADD PRIMARY KEY (`kode_reward`);

--
-- Indexes for table `tbl_sampah`
--
ALTER TABLE `tbl_sampah`
  ADD PRIMARY KEY (`id_sampah`),
  ADD KEY `id_sampah_kat` (`id_sampah_kat`);

--
-- Indexes for table `tbl_sampah_kategori`
--
ALTER TABLE `tbl_sampah_kategori`
  ADD PRIMARY KEY (`id_sampah_kat`);

--
-- Indexes for table `tbl_setor`
--
ALTER TABLE `tbl_setor`
  ADD PRIMARY KEY (`id_setor`),
  ADD KEY `id_nasabah` (`id_nasabah`);

--
-- Indexes for table `tbl_system_info`
--
ALTER TABLE `tbl_system_info`
  ADD PRIMARY KEY (`id_sysfo`);

--
-- Indexes for table `tbl_token`
--
ALTER TABLE `tbl_token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `id_users_role` (`id_users_role`);

--
-- Indexes for table `tbl_users_role`
--
ALTER TABLE `tbl_users_role`
  ADD PRIMARY KEY (`id_users_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_nasabah`
--
ALTER TABLE `tbl_nasabah`
  MODIFY `id_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2306002;

--
-- AUTO_INCREMENT for table `tbl_partner`
--
ALTER TABLE `tbl_partner`
  MODIFY `id_partner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_sampah`
--
ALTER TABLE `tbl_sampah`
  MODIFY `id_sampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_sampah_kategori`
--
ALTER TABLE `tbl_sampah_kategori`
  MODIFY `id_sampah_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_system_info`
--
ALTER TABLE `tbl_system_info`
  MODIFY `id_sysfo` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_token`
--
ALTER TABLE `tbl_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users_role`
--
ALTER TABLE `tbl_users_role`
  MODIFY `id_users_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_penukaran`
--
ALTER TABLE `tbl_penukaran`
  ADD CONSTRAINT `tbl_penukaran_ibfk_1` FOREIGN KEY (`id_nasabah`) REFERENCES `tbl_nasabah` (`id_nasabah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD CONSTRAINT `tbl_review_ibfk_1` FOREIGN KEY (`id_nasabah`) REFERENCES `tbl_nasabah` (`id_nasabah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sampah`
--
ALTER TABLE `tbl_sampah`
  ADD CONSTRAINT `tbl_sampah_ibfk_1` FOREIGN KEY (`id_sampah_kat`) REFERENCES `tbl_sampah_kategori` (`id_sampah_kat`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_setor`
--
ALTER TABLE `tbl_setor`
  ADD CONSTRAINT `tbl_setor_ibfk_1` FOREIGN KEY (`id_nasabah`) REFERENCES `tbl_nasabah` (`id_nasabah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`id_users_role`) REFERENCES `tbl_users_role` (`id_users_role`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
