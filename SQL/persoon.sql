-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Gegenereerd op: 31 mrt 2017 om 14:15
-- Serverversie: 5.7.17-0ubuntu0.16.04.1
-- PHP-versie: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectWeb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `persoon`
--

CREATE TABLE `persoon` (
  `persoonID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `naam` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `persoon`
--

INSERT INTO `persoon` (`persoonID`, `eventID`, `naam`) VALUES
(1, 1, 'Piper'),
(2, 2, 'Greco'),
(3, 3, 'Ortiz'),
(4, 4, 'McCaig');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `persoon`
--
ALTER TABLE `persoon`
  ADD PRIMARY KEY (`persoonID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
