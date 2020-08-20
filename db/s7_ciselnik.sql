-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 20. srp 2020, 23:28
-- Verze serveru: 10.1.38-MariaDB
-- Verze PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `realsys`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `s7_ciselnik`
--

CREATE TABLE `s7_ciselnik` (
  `id` int(11) NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `property` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `value` varchar(511) COLLATE utf8mb4_czech_ci NOT NULL,
  `translation` varchar(511) COLLATE utf8mb4_czech_ci NOT NULL,
  `datum_zalozeni` int(11) DEFAULT '0',
  `datum_upravy` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci COMMENT='Tabulka pro překlad jednotlivých stavů';

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `s7_ciselnik`
--
ALTER TABLE `s7_ciselnik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `s7_ciselnik`
--
ALTER TABLE `s7_ciselnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
