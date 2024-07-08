-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lip 08, 2024 at 05:56 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swetrydb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(50) DEFAULT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`, `opis`) VALUES
(1, 'Galowy', 'Opis kategorii Galowy'),
(2, 'Roboczy', 'Opis kategorii Roboczy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recenzje`
--

CREATE TABLE `recenzje` (
  `id` int(10) UNSIGNED NOT NULL,
  `idSwetra` int(10) UNSIGNED DEFAULT NULL,
  `nick` varchar(50) DEFAULT NULL,
  `ocena` int(11) DEFAULT NULL,
  `tresc` text DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `recenzje`
--

INSERT INTO `recenzje` (`id`, `idSwetra`, `nick`, `ocena`, `tresc`, `data`) VALUES
(12, 7, 'test', 5, '123', '2024-07-01 09:36:08'),
(14, 7, 'test', 5, 'tego typu', '2024-07-03 21:21:03'),
(15, 7, 'Admin', 5, 'Bardzo elegancki', '2024-07-04 09:11:55');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `swetry`
--

CREATE TABLE `swetry` (
  `id` int(10) UNSIGNED NOT NULL,
  `idKategorii` int(10) UNSIGNED DEFAULT NULL,
  `nazwa` varchar(50) DEFAULT NULL,
  `obrazek` varchar(50) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `gramatura` int(11) DEFAULT NULL,
  `wiek` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `swetry`
--

INSERT INTO `swetry` (`id`, `idKategorii`, `nazwa`, `obrazek`, `opis`, `gramatura`, `wiek`) VALUES
(7, 1, 'Sweter Wyborczy', 'wyborczy.jpg', 'wrwer', 250, 20),
(8, 1, 'Sweter Geometryczny', 'geometryczny.jpg', 'Opis swetra geometrycznego', 200, 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulubione`
--

CREATE TABLE `ulubione` (
  `id` int(10) UNSIGNED NOT NULL,
  `idSwetra` int(10) UNSIGNED DEFAULT NULL,
  `idUzytkownika` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `ulubione`
--

INSERT INTO `ulubione` (`id`, `idSwetra`, `idUzytkownika`) VALUES
(22, 7, 5),
(23, 7, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `haslo` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `rola` varchar(50) DEFAULT 'user',
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_picture` varchar(255) NOT NULL DEFAULT 'upload_profile_pics/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`, `rola`, `data`, `profile_picture`) VALUES
(1, '123', '202cb962ac59075b964b07152d234b70', '123', 'user', '2024-06-30 22:16:02', 'upload_profile_pics/default.png'),
(2, 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'cokolwiek.exe', 'user', '2024-06-30 22:48:17', 'upload_profile_pics/default.png'),
(5, 'test', '05a671c66aefea124cc08b76ea6d30bb', 'ewfgwe', 'user', '2024-06-30 21:03:38', 'upload_profile_pics/heart.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `recenzje`
--
ALTER TABLE `recenzje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDzbana` (`idSwetra`);

--
-- Indeksy dla tabeli `swetry`
--
ALTER TABLE `swetry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKategorii` (`idKategorii`);

--
-- Indeksy dla tabeli `ulubione`
--
ALTER TABLE `ulubione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDzbana` (`idSwetra`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recenzje`
--
ALTER TABLE `recenzje`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `swetry`
--
ALTER TABLE `swetry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ulubione`
--
ALTER TABLE `ulubione`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recenzje`
--
ALTER TABLE `recenzje`
  ADD CONSTRAINT `recenzje_ibfk_1` FOREIGN KEY (`idSwetra`) REFERENCES `swetry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `swetry`
--
ALTER TABLE `swetry`
  ADD CONSTRAINT `swetry_ibfk_1` FOREIGN KEY (`idKategorii`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulubione`
--
ALTER TABLE `ulubione`
  ADD CONSTRAINT `ulubione_ibfk_1` FOREIGN KEY (`idSwetra`) REFERENCES `swetry` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulubione_ibfk_2` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
