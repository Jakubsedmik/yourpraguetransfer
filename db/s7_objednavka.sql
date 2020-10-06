-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 06. říj 2020, 20:59
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
-- Databáze: `yourpraguetransfer`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `s7_objednavka`
--

CREATE TABLE `s7_objednavka` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `telefon` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `destinace_z` varchar(511) COLLATE utf8_czech_ci NOT NULL,
  `destinace_do` varchar(511) COLLATE utf8_czech_ci NOT NULL,
  `cas` int(11) NOT NULL,
  `cas_zpet` int(11) DEFAULT NULL,
  `pocet_osob` int(11) NOT NULL,
  `znameni` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `poznamka` varchar(511) COLLATE utf8_czech_ci DEFAULT NULL,
  `detska_sedacka` tinyint(4) NOT NULL,
  `velka_zavazadla` tinyint(4) NOT NULL,
  `typ_platby` tinyint(4) NOT NULL,
  `mena` tinyint(4) NOT NULL,
  `cena` int(11) NOT NULL,
  `vozidlo_id` int(11) NOT NULL,
  `stav` int(11) NOT NULL,
  `hash` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `datum_zalozeni` int(11) NOT NULL,
  `datum_upravy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `s7_objednavka`
--
ALTER TABLE `s7_objednavka`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `s7_objednavka`
--
ALTER TABLE `s7_objednavka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
