-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Apr 2016 um 05:59
-- Server-Version: 10.1.9-MariaDB
-- PHP-Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `upmoon`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mood_table`
--

CREATE TABLE `mood_table` (
  `id` int(100) UNSIGNED NOT NULL,
  `user_xid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `sleep_xid` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mood` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `mood_table`
--

INSERT INTO `mood_table` (`id`, `user_xid`, `sleep_xid`, `mood`) VALUES
(1, 'test', 'test', 5),
(2, 'test', 'test', 2),
(3, 'test', 'test', 3),
(4, 'test', 'test', 4),
(5, 'test', 'test', 5),
(6, 'test', 'test', 2),
(7, 'test', 'test', 1),
(8, 'test', 'test', 1),
(10, '', '', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `mood_table`
--
ALTER TABLE `mood_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `mood_table`
--
ALTER TABLE `mood_table`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
