-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2023 at 05:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_carwash`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cucimobil`
--

CREATE TABLE `tbl_cucimobil` (
  `cucimobil_id` int(11) NOT NULL,
  `cucimobil_idtransaksi` varchar(100) NOT NULL,
  `paket_id` int(11) NOT NULL,
  `cucimobil_tanggal` date NOT NULL DEFAULT current_timestamp(),
  `cucimobil_nama` varchar(200) NOT NULL,
  `cucimobil_tipe` varchar(100) NOT NULL,
  `cucimobil_plat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cucimobil`
--

INSERT INTO `tbl_cucimobil` (`cucimobil_id`, `cucimobil_idtransaksi`, `paket_id`, `cucimobil_tanggal`, `cucimobil_nama`, `cucimobil_tipe`, `cucimobil_plat`) VALUES
(21, 'TR-01', 3, '2023-02-03', 'Hilmi Kumodan', 'Avanxa', 'D 2023 EWE'),
(22, 'TR-02', 3, '2023-02-03', 'Hilmi Kumodon', 'avanza', 'D 2023 RDI'),
(23, 'TR-03', 2, '2023-02-03', 'Hilmi Kumodon', 'avanza', 'D 2023 ASW'),
(24, 'TR-04', 5, '2023-02-05', 'shafira', 'lamborgini', 'D 2023 SHF');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `paket_id` int(11) NOT NULL,
  `paket_nama` varchar(200) NOT NULL,
  `paket_jeniskendaraan` varchar(200) NOT NULL,
  `paket_harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_paket`
--

INSERT INTO `tbl_paket` (`paket_id`, `paket_nama`, `paket_jeniskendaraan`, `paket_harga`) VALUES
(2, 'Paket Standar ', 'Mobil Kecil', 35000),
(3, 'Paket Premium', 'Mini Bus', 70000),
(5, 'Paket Detailing', 'All Cars', 150000),
(6, 'standart', 'All Cars', 70000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_username`, `user_password`, `user_email`, `user_type`) VALUES
(13, 'adit', '357344787fa3d91429f000604af9667f', 'ferdisambo@gmail.com', 'kasir'),
(14, 'adit1', '357344787fa3d91429f000604af9667f', 'gonjo@gmail.com', 'admin'),
(15, 'kasir', 'de28f8f7998f23ab4194b51a6029416f', 'ferdi@gmail.com', 'kasir'),
(16, 'admin', '0192023a7bbd73250516f069df18b500', 'ferdisambo@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cucimobil`
--
ALTER TABLE `tbl_cucimobil`
  ADD PRIMARY KEY (`cucimobil_id`);

--
-- Indexes for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD PRIMARY KEY (`paket_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cucimobil`
--
ALTER TABLE `tbl_cucimobil`
  MODIFY `cucimobil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
  MODIFY `paket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
