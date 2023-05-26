-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2020 at 02:58 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia_baznas`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `no_akun` int(11) NOT NULL,
  `induk` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`no_akun`, `induk`, `level`, `nama_akun`, `keterangan`) VALUES
(114, 0, 0, 'hayo', 'untuk hayo'),
(1111, 0, 0, 'KAS', 'KAS AWAL'),
(1112, 0, 0, 'Peralatan', 'Peralatan Kantor'),
(1113, 0, 0, 'Perlengkapan', 'Perlengkapan'),
(1114, 114, 0, 'WKWKWK', '12'),
(1115, 0, 0, 'palsu', 'iyah');

-- --------------------------------------------------------

--
-- Table structure for table `detail_ju`
--

CREATE TABLE `detail_ju` (
  `id` int(11) NOT NULL,
  `no_jurnal` varchar(8) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_penyesuaian`
--

CREATE TABLE `jurnal_penyesuaian` (
  `no_jurnal` varchar(20) NOT NULL,
  `tgl_jurnal` date NOT NULL,
  `no_akun` int(11) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal_penyesuaian`
--

INSERT INTO `jurnal_penyesuaian` (`no_jurnal`, `tgl_jurnal`, `no_akun`, `debet`, `kredit`, `id_user`, `tgl_input`) VALUES
('20190919', '2019-12-29', 1111, 200000, 0, 1, '2019-12-01 03:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `ID_jurnal` int(11) NOT NULL,
  `no_jurnal` varchar(8) NOT NULL,
  `tgl_jurnal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `no_bukti` varchar(100) NOT NULL,
  `no_akun` int(11) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal_umum`
--

INSERT INTO `jurnal_umum` (`ID_jurnal`, `no_jurnal`, `tgl_jurnal`, `keterangan`, `no_bukti`, `no_akun`, `debet`, `kredit`, `id_user`, `tgl_input`) VALUES
(1, 'JU000001', '2020-01-01', 'ket', '18298', 1111, 900000, 0, 1, '2020-01-01 12:35:57'),
(2, 'JU000002', '2020-01-01', 'ket', '1789', 114, 0, 900000, 1, '2020-01-01 12:36:22'),
(3, 'JU000003', '2020-01-01', 'ket', '12312', 114, 45344, 0, 1, '2020-01-01 12:40:12'),
(24, 'JU000004', '2020-01-02', 'ket', 'sduio', 114, 9000, 0, 1, '2020-01-02 06:08:31'),
(25, 'JU000005', '2020-01-02', 'ket', 'tititp', 114, 7000, 0, 1, '2020-01-02 06:19:11'),
(26, 'JU000005', '2020-01-02', 'ket', 'wkwkw', 114, 0, 0, 1, '2020-01-02 06:20:09'),
(27, 'JU000006', '2020-01-02', 'ket', '324424', 1112, 90000, 0, 1, '2020-01-02 06:21:31'),
(28, 'JU000006', '2020-01-04', 'ket', '121', 1112, 0, 0, 1, '2020-01-02 06:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `saldo_awal`
--

CREATE TABLE `saldo_awal` (
  `periode` year(4) NOT NULL,
  `no_akun` int(11) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `tgl_insert` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldo_awal`
--

INSERT INTO `saldo_awal` (`periode`, `no_akun`, `debet`, `kredit`, `tgl_insert`, `id_user`) VALUES
(2019, 1111, 200000, 0, '2019-12-29', 1),
(2019, 1112, 0, 200000, '2019-12-29', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama`, `level`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'mimin', 'admin', '1.jpg'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'user', 'user.jpg'),
(36, 'asda', 'adbf5a778175ee757c34d0eba4e932bc', 'asdada', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`no_akun`);

--
-- Indexes for table `detail_ju`
--
ALTER TABLE `detail_ju`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnal_penyesuaian`
--
ALTER TABLE `jurnal_penyesuaian`
  ADD KEY `no_akun` (`no_akun`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Indexes for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`ID_jurnal`),
  ADD KEY `no_akun` (`no_akun`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `saldo_awal`
--
ALTER TABLE `saldo_awal`
  ADD KEY `no_akun` (`no_akun`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_ju`
--
ALTER TABLE `detail_ju`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `ID_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurnal_penyesuaian`
--
ALTER TABLE `jurnal_penyesuaian`
  ADD CONSTRAINT `jurnal_penyesuaian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `jurnal_penyesuaian_ibfk_2` FOREIGN KEY (`no_akun`) REFERENCES `akun` (`no_akun`);

--
-- Constraints for table `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD CONSTRAINT `jurnal_umum_ibfk_1` FOREIGN KEY (`no_akun`) REFERENCES `akun` (`no_akun`),
  ADD CONSTRAINT `jurnal_umum_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `saldo_awal`
--
ALTER TABLE `saldo_awal`
  ADD CONSTRAINT `saldo_awal_ibfk_1` FOREIGN KEY (`no_akun`) REFERENCES `akun` (`no_akun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
