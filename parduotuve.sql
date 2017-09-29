-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015 m. Grd 19 d. 23:54
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parduotuve`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `kategorijos`
--

CREATE TABLE IF NOT EXISTS `kategorijos` (
  `katid` bigint(20) unsigned NOT NULL,
  `pavadinimas` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `kategorijos`
--

INSERT INTO `kategorijos` (`katid`, `pavadinimas`) VALUES
(1, 'Nerealus kompiuteriai'),
(2, 'Nerealus monitoriai'),
(5, 'aksesuarai'),
(6, 'Virtualus'),
(9, '15'),
(10, 'Nesvarbu');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `prekes`
--

CREATE TABLE IF NOT EXISTS `prekes` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `details` mediumtext NOT NULL,
  `rusis` varchar(30) DEFAULT NULL,
  `extension` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `prekes`
--

INSERT INTO `prekes` (`id`, `name`, `price`, `details`, `rusis`, `extension`) VALUES
(255, 'Redaguotas', 99, 'Redaguota preke', '2', 'jpg'),
(258, 'Redaguotas', 99, 'Redaguota preke', '5', 'jpg'),
(259, 'Redaguotas', 99, 'Redaguota preke', '1', 'jpg'),
(302, 'Marius', 15, 'sasdadsadasdasdasdas', '5', '');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `vartotojai`
--

CREATE TABLE IF NOT EXISTS `vartotojai` (
  `vartotojo_id` bigint(20) unsigned NOT NULL,
  `loginname` varchar(30) NOT NULL,
  `slaptazodis` varchar(30) NOT NULL,
  `pastas` varchar(100) NOT NULL,
  `adresas` varchar(300) NOT NULL,
  `vardas` varchar(30) NOT NULL,
  `pavarde` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `vartotojai`
--

INSERT INTO `vartotojai` (`vartotojo_id`, `loginname`, `slaptazodis`, `pastas`, `adresas`, `vardas`, `pavarde`) VALUES
(31, 'user', '123', 'sad@sad.asd', 'asdsadsadas', 'Marius', 'ksjfdlksjf'),
(32, 'admin', '123', 'admin@123.lt', 'Nesakysiu', 'Andministratorius', 'Andministratorius');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorijos`
--
ALTER TABLE `kategorijos`
  ADD UNIQUE KEY `katid` (`katid`);

--
-- Indexes for table `prekes`
--
ALTER TABLE `prekes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID` (`id`);

--
-- Indexes for table `vartotojai`
--
ALTER TABLE `vartotojai`
  ADD PRIMARY KEY (`vartotojo_id`),
  ADD UNIQUE KEY `vartotojo_id` (`vartotojo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorijos`
--
ALTER TABLE `kategorijos`
  MODIFY `katid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `prekes`
--
ALTER TABLE `prekes`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=303;
--
-- AUTO_INCREMENT for table `vartotojai`
--
ALTER TABLE `vartotojai`
  MODIFY `vartotojo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
