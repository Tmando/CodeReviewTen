-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 16. Sep 2017 um 17:07
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mandorfer_thomas_bigshop_2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Cart`
--

CREATE TABLE `Cart` (
  `cartID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `SUM` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Cart`
--

INSERT INTO `Cart` (`cartID`, `userID`, `SUM`) VALUES
(1, 1, NULL),
(2, 1, NULL),
(3, 1, NULL),
(4, 1, NULL),
(5, 1, NULL),
(6, 1, NULL),
(7, 1, NULL),
(8, 1, NULL),
(9, 1, NULL),
(10, 1, NULL),
(11, 1, NULL),
(12, 2, NULL),
(13, 2, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Checkout`
--

CREATE TABLE `Checkout` (
  `checkoutID` int(11) NOT NULL,
  `cartID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Checkout`
--

INSERT INTO `Checkout` (`checkoutID`, `cartID`) VALUES
(1, 4),
(2, 6),
(3, 7),
(4, 8),
(5, 9),
(6, 10),
(7, 11),
(8, 12);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `PRODUCT`
--

CREATE TABLE `PRODUCT` (
  `productID` int(11) NOT NULL,
  `productName` varchar(100) DEFAULT NULL,
  `productImage` varchar(300) DEFAULT NULL,
  `ProductPrice` float DEFAULT NULL,
  `productLink` varchar(300) DEFAULT NULL,
  `latidude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `PRODUCT`
--

INSERT INTO `PRODUCT` (`productID`, `productName`, `productImage`, `ProductPrice`, `productLink`, `latidude`, `longitude`) VALUES
(1, 'Anna copper', 'https://upload.wikimedia.org/wikipedia/commons/6/64/Anna_copper_by_Tamura_Perfumes.jpg', 80, '', 25.3016297, 55.4362476),
(2, 'Brilliant perfume', 'https://upload.wikimedia.org/wikipedia/commons/4/4c/Brilliant_perfume_by_Tamura_Perfumes.jpg', 100, NULL, 25.3016297, 55.4362476),
(3, 'Delmont', 'https://upload.wikimedia.org/wikipedia/commons/1/1f/Delmont_by_Tamura_Perfumes.jpg', 120, '', 25.3016297, 55.4362476),
(4, 'Event perfume', 'https://upload.wikimedia.org/wikipedia/commons/0/0d/Event_perfume_by_Tamura_Perfumes.jpg', 120, NULL, 25.3016297, 55.4362476),
(5, 'Delmont Femme', 'https://upload.wikimedia.org/wikipedia/commons/2/2b/Delmont_Femme_by_Tamura_Perfumes.jpg', 150, NULL, 25.3016297, 55.4362476),
(6, 'Eau-triple', 'https://upload.wikimedia.org/wikipedia/commons/e/e5/Mexx-Flacon.jpg', 120, NULL, 48.8671991, 2.3013936),
(7, 'Statement homme', 'https://upload.wikimedia.org/wikipedia/commons/d/db/Statement_homme_by_Tamura_Perfumes.jpg', 150, NULL, 25.3016297, 55.4362476),
(8, 'Sella white', 'https://upload.wikimedia.org/wikipedia/commons/f/f8/Sella_white_by_Tamura_Perfumes.jpg', 140, NULL, 25.3016297, 55.4362476),
(9, 'Armbanduhr', 'img/watch-123748_960_720.jpg', 180, NULL, 48.2208286, 16.2399753),
(10, 'Wedding Ring ', 'img/ring-260892_960_720.jpg', 90, NULL, 47.0736852, 15.3717498),
(11, 'QMAX', 'img/male-watch-144648_960_720.jpg', 180, NULL, 47.0736852, 15.3717498),
(12, 'Rider', 'img/analog-watch-1869928_960_720.jpg', 170, NULL, 47.0736852, 15.3717498),
(13, 'Armani', 'img/analog-watch-1845547_960_720.jpg', 190, NULL, 45.4453822, 9.1496882);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ProductInCart`
--

CREATE TABLE `ProductInCart` (
  `cartID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ProductInCart`
--

INSERT INTO `ProductInCart` (`cartID`, `productID`, `quantity`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, -2),
(2, 1, 27),
(2, 2, 1),
(2, 3, 4),
(2, 4, 4),
(2, 5, 15),
(2, 6, 3),
(2, 7, 2),
(2, 8, 3),
(2, 13, 1),
(3, 1, 2),
(3, 2, 3),
(3, 3, 0),
(3, 4, 1),
(3, 6, 1),
(3, 7, 3),
(3, 8, 0),
(4, 1, 7),
(4, 2, 9),
(4, 3, 7),
(4, 4, 8),
(4, 7, 0),
(4, 8, 0),
(5, 4, 3),
(6, 1, 1),
(6, 2, 5),
(6, 3, 5),
(6, 4, 3),
(6, 8, 3),
(7, 1, 5),
(7, 5, 3),
(7, 6, 3),
(7, 7, 3),
(8, 1, 8),
(8, 6, 3),
(8, 7, 3),
(8, 8, 6),
(9, 1, 1),
(9, 2, 4),
(9, 3, 4),
(9, 4, 3),
(9, 5, 3),
(9, 7, 3),
(9, 8, 3),
(10, 1, 7),
(10, 5, 4),
(10, 7, 4),
(10, 8, 4),
(10, 9, 2),
(10, 10, 2),
(10, 11, 3),
(10, 12, 3),
(11, 1, 5),
(11, 6, 5),
(11, 7, 4),
(11, 8, 3),
(12, 1, 1),
(12, 3, 2),
(12, 4, 2),
(12, 5, 7),
(12, 6, 3),
(12, 7, 3),
(12, 10, 1),
(12, 11, 1),
(12, 12, 1),
(13, 4, 5),
(13, 5, 1),
(13, 6, 1),
(13, 7, 10),
(13, 8, 15),
(13, 10, 2),
(13, 12, 8);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `USERS`
--

CREATE TABLE `USERS` (
  `userID` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `userPass` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `USERS`
--

INSERT INTO `USERS` (`userID`, `firstname`, `lastname`, `userPass`, `email`) VALUES
(1, 'Thomas', 'Mandorfer', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 't.mandorfer@gmail.com'),
(2, 'Max', 'Mustermann', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'max.mustermann@gmx.at');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `userID` (`userID`);

--
-- Indizes für die Tabelle `Checkout`
--
ALTER TABLE `Checkout`
  ADD PRIMARY KEY (`checkoutID`,`cartID`),
  ADD KEY `cartID` (`cartID`);

--
-- Indizes für die Tabelle `PRODUCT`
--
ALTER TABLE `PRODUCT`
  ADD PRIMARY KEY (`productID`);

--
-- Indizes für die Tabelle `ProductInCart`
--
ALTER TABLE `ProductInCart`
  ADD PRIMARY KEY (`cartID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Indizes für die Tabelle `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `Cart`
--
ALTER TABLE `Cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT für Tabelle `Checkout`
--
ALTER TABLE `Checkout`
  MODIFY `checkoutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT für Tabelle `USERS`
--
ALTER TABLE `USERS`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `Cart`
--
ALTER TABLE `Cart`
  ADD CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `USERS` (`userID`);

--
-- Constraints der Tabelle `Checkout`
--
ALTER TABLE `Checkout`
  ADD CONSTRAINT `Checkout_ibfk_1` FOREIGN KEY (`cartID`) REFERENCES `Cart` (`cartID`);

--
-- Constraints der Tabelle `ProductInCart`
--
ALTER TABLE `ProductInCart`
  ADD CONSTRAINT `ProductInCart_ibfk_1` FOREIGN KEY (`cartID`) REFERENCES `Cart` (`cartID`),
  ADD CONSTRAINT `ProductInCart_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `PRODUCT` (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
