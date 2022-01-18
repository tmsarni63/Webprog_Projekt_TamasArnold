-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 05, 2022 at 12:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `esemeny`
--

CREATE TABLE `esemeny` (
  `id` int(4) NOT NULL,
  `helyszin` varchar(200) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `elerhetoseg` varchar(10) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `esemenytipusa` varchar(150) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `szemelyszam` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `esemeny`
--

INSERT INTO `esemeny` (`id`, `helyszin`, `elerhetoseg`, `esemenytipusa`, `szemelyszam`) VALUES
(1, 'Csikszereda', 'elerheto', 'eskuvo', 100),
(2, 'Csikszereda', 'foglalt', 'szuletesnap', 50),
(3, 'Szekelyudvarhely', 'elerheto', 'eskuvo', 200),
(4, 'Sepsiszentgyorgy', 'elerheto', 'cegesrendezveny', 200),
(5, 'Sepsiszentgyorgy', 'foglalt', 'cegesrendezveny', 100),
(6, 'Marosvasarhely', 'elerheto', 'szuletesnap', 50),
(7, 'Marosvasarhely', 'elerheto', 'evfordulo', 50);

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `id` int(4) NOT NULL,
  `nev` varchar(70) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `felhasznalo_nev` varchar(70) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(70) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `jelszo` varchar(300) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `nev`, `felhasznalo_nev`, `email`, `jelszo`) VALUES
(18, 'Kiss Pista', 'kisspista77', 'kisspista@gmail.com', 'kisspista123'),
(19, 'Mekk Elek', 'mekkelek', 'mekkelek@yahoo.com', 'mekkelek123'),
(20, 'Nagy Lajos', 'nagylajos25', 'nagylajos@gmail.com', 'nagylajos123');

-- --------------------------------------------------------

--
-- Table structure for table `foglalas`
--

CREATE TABLE `foglalas` (
  `foglalas_id` int(11) NOT NULL,
  `esemeny_id` int(11) DEFAULT NULL,
  `szemely_nev` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `telefonszam` varchar(10) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `datumtol` date NOT NULL,
  `datumig` date NOT NULL,
  `felhasznalo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `esemeny`
--
ALTER TABLE `esemeny`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foglalas`
--
ALTER TABLE `foglalas`
  ADD PRIMARY KEY (`foglalas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `esemeny`
--
ALTER TABLE `esemeny`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `foglalas`
--
ALTER TABLE `foglalas`
  MODIFY `foglalas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
