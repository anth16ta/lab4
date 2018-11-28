-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 19 nov 2018 kl 16:48
-- Serverversion: 10.1.36-MariaDB
-- PHP-version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `LabBooks`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `Author`
--

CREATE TABLE `Author` (
  `authorID` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `ssn` char(20) DEFAULT NULL,
  `birthYear` year(4) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Author`
--

INSERT INTO `Author` (`authorID`, `firstName`, `lastName`, `ssn`, `birthYear`, `url`) VALUES
(1, 'Armani', 'Rutherford', '25602328', 1987, 'http://padbergrowe.com/'),
(2, 'Nina', 'Kuhn', '84163884', 2017, 'http://nienowtorphy.com/'),
(3, 'Kolby', 'Eichmann', '61532135', 2010, 'http://www.roobmccullough.info/'),
(4, 'Reba', 'Dare', '93787607', 2018, 'http://www.schupperoob.net/'),
(5, 'Brannon', 'Sipes', '81396086', 2012, 'http://bosco.com/'),
(6, 'Luciano', 'Reilly', '92813898', 2005, 'http://www.schuppe.biz/'),
(7, 'Tessie', 'Pacocha', '99138658', 1986, 'http://www.hanevon.net/'),
(8, 'Bessie', 'Weber', '68565075', 1973, 'http://stamm.org/'),
(9, 'Luis', 'Zulauf', '93671909', 2000, 'http://bartell.com/'),
(10, 'Kaitlin', 'Homenick', '37261572', 1972, 'http://www.homenick.org/');

-- --------------------------------------------------------

--
-- Tabellstruktur `AuthorBook`
--

CREATE TABLE `AuthorBook` (
  `authorBookID` int(11) NOT NULL,
  `authorID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `AuthorBook`
--

INSERT INTO `AuthorBook` (`authorBookID`, `authorID`, `bookID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10);

-- --------------------------------------------------------

--
-- Tabellstruktur `Book`
--

CREATE TABLE `Book` (
  `bookID` int(11) NOT NULL,
  `isbn` char(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `pages` int(11) DEFAULT NULL,
  `edition` char(5) DEFAULT NULL,
  `pubYear` year(4) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Book`
--

INSERT INTO `Book` (`bookID`, `isbn`, `title`, `pages`, `edition`, `pubYear`, `publisher`) VALUES
(1, '782971768444607616', 'Doloribus dolor aspernatur', 369, '7', 1980, 'Miller-Senger'),
(2, '1791418250813466368', 'Minima rerum', 373, '6', 2000, 'Schamberger, Schultz and Stamm'),
(3, '5167828684187514880', 'Et nam eaque omnis', 790, '', 2010, 'Cremin PLC'),
(4, '5043267157510983680', 'Qui molestias autem similique', 565, '2', 2004, 'Keefe-Ernser'),
(5, '4425316297027159552', 'Sunt numquam qui laborum vel mollitia', 794, '1', 1981, 'Kulas, Pollich and Hansen'),
(6, '6233696119173352448', 'Id voluptatem itaque', 289, '', 1978, 'Lehner, Feest and Dietrich'),
(7, '1799044859597572096', 'Non natus sed', 525, '6', 1996, 'Kuphal-Schaefer'),
(8, '3340697172405872128', 'Molestias velit hic ex impedit', 478, '1', 1994, 'Reynolds-Bartoletti'),
(9, '1131639612928921728', 'Omnis cupiditate pariatur dolorem aut', 547, '5', 2009, 'Mraz Ltd'),
(10, '4564243537824840704', 'Numquam temporibus', 963, '5', 2002, 'Roob, DuBuque and Koepp');

-- --------------------------------------------------------

--
-- Tabellstruktur `Image`
--

CREATE TABLE `Image` (
  `imageID` int(11) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `Library`
--

CREATE TABLE `Library` (
  `libraryID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `barcode` char(30) NOT NULL,
  `shelf` char(10) NOT NULL,
  `includedSince` date DEFAULT NULL,
  `borrowed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Library`
--

INSERT INTO `Library` (`libraryID`, `bookID`, `barcode`, `shelf`, `includedSince`, `borrowed`) VALUES
(1, 1, '9163809514480', '94 kb', '1981-11-02', 1),
(2, 2, '6474451011214', '90 um', '1982-03-24', 1),
(3, 3, '4373835495065', '33 kr', '2011-04-24', 1),
(4, 4, '0029811372069', '07 pa', '2014-03-07', 0),
(5, 5, '6745707212571', '17 do', '1976-01-27', 0),
(6, 6, '0371007265113', '30 gt', '1991-09-12', 0),
(7, 7, '1797918574523', '89 nl', '1989-04-07', 0),
(8, 8, '0617328031090', '99 ft', '1977-01-17', 0),
(9, 9, '3015513133715', '10 tf', '2014-03-26', 0),
(10, 10, '8075256131794', '12 gc', '1989-09-22', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `User`
--

CREATE TABLE `User` (
  `userID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `User`
--

INSERT INTO `User` (`userID`, `username`, `password`, `type`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', 'browser');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `Author`
--
ALTER TABLE `Author`
  ADD PRIMARY KEY (`authorID`);

--
-- Index för tabell `AuthorBook`
--
ALTER TABLE `AuthorBook`
  ADD PRIMARY KEY (`authorBookID`);

--
-- Index för tabell `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`bookID`);

--
-- Index för tabell `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`imageID`);

--
-- Index för tabell `Library`
--
ALTER TABLE `Library`
  ADD PRIMARY KEY (`libraryID`);

--
-- Index för tabell `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `Author`
--
ALTER TABLE `Author`
  MODIFY `authorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT för tabell `AuthorBook`
--
ALTER TABLE `AuthorBook`
  MODIFY `authorBookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT för tabell `Book`
--
ALTER TABLE `Book`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT för tabell `Image`
--
ALTER TABLE `Image`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `Library`
--
ALTER TABLE `Library`
  MODIFY `libraryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT för tabell `User`
--
ALTER TABLE `User`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
