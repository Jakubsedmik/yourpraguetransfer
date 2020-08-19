-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 19. srp 2020, 20:40
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
-- Struktura tabulky `s7_obrazek`
--

CREATE TABLE `s7_obrazek` (
  `id` int(11) NOT NULL,
  `titulek` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `popisek` varchar(511) COLLATE utf8_czech_ci DEFAULT NULL,
  `kod` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `url` varchar(511) COLLATE utf8_czech_ci NOT NULL,
  `inzerat_id` int(11) DEFAULT NULL,
  `front` tinyint(1) DEFAULT '0',
  `datum_upravy` int(11) DEFAULT '0',
  `datum_zalozeni` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='Tabulka slouží pro evidenci obrázků navázaných na inzeráty';

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `s7_obrazek`
--
ALTER TABLE `s7_obrazek`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `s7_obrazek`
--
ALTER TABLE `s7_obrazek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
