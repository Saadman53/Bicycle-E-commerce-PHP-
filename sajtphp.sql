-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2018 at 04:17 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sajtphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `id_a` int(11) NOT NULL,
  `pitanje` text COLLATE utf8_unicode_ci NOT NULL,
  `aktivna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`id_a`, `pitanje`, `aktivna`) VALUES
(1, 'Da li volite adrenalin ? ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anketa_korisnik`
--

CREATE TABLE `anketa_korisnik` (
  `id_anketa_korisnik` int(11) NOT NULL,
  `id_anketa` int(11) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `id_anketa_odgovor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa_korisnik`
--

INSERT INTO `anketa_korisnik` (`id_anketa_korisnik`, `id_anketa`, `idKorisnik`, `id_anketa_odgovor`) VALUES
(8, 1, 60, 2),
(9, 1, 59, 3),
(25, 1, 61, 2);

-- --------------------------------------------------------

--
-- Table structure for table `anketa_odgovor`
--

CREATE TABLE `anketa_odgovor` (
  `id_a_o` int(11) NOT NULL,
  `id_anketa` int(11) NOT NULL,
  `id_odgovor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa_odgovor`
--

INSERT INTO `anketa_odgovor` (`id_a_o`, `id_anketa`, `id_odgovor`) VALUES
(2, 1, 1),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`) VALUES
(1, 'Bicikli'),
(2, 'Oprema');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idKorisnik` int(255) NOT NULL,
  `imePrezime` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `postanskiBroj` int(5) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sifra` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ulogaID` int(3) NOT NULL,
  `aktivan` bit(1) DEFAULT b'0',
  `polID` int(3) NOT NULL,
  `datum_registracije` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(32) COLLATE ucs2_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnik`, `imePrezime`, `adresa`, `grad`, `postanskiBroj`, `email`, `sifra`, `ulogaID`, `aktivan`, `polID`, `datum_registracije`, `token`) VALUES
(59, 'Patak Daca', 'Patkoviceva 1', 'Patkovac', 22413, 'PatakDaca@gmail.com', '5a875cb715237a1948f4ee67f94b8b42', 1, b'1', 1, '2018-06-19 01:15:18', ''),
(60, 'Micika Secer', 'Secerna Bolest 55', 'Sunoco', 12000, 'micika@gmail.com', 'f5580c8c3567fab9e75d5eab99ba68c5', 1, b'1', 2, '2018-06-19 10:47:50', ''),
(61, 'Nemanja Ranisa', 'Zdravka Celara 2', 'Beograd', 11000, 'Beka9977@gmail.com', '8e89badcaf3bd26068a053ac13200652', 2, b'1', 1, '2018-06-19 11:17:37', 'e5dd72c7ffb30928d14f6e338ca2da95'),
(63, 'Vesna Vesic', 'Vesiceva 45', 'Beograd', 11000, 'veca@gmail.com', '0599d208d0f51bf7db8292c4024d1aa2', 1, b'1', 2, '2018-06-20 14:55:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `idMeni` int(11) NOT NULL,
  `naziv` text COLLATE utf8_unicode_ci NOT NULL,
  `putanja` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roditelj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`idMeni`, `naziv`, `putanja`, `roditelj`) VALUES
(9, 'Cena', '', 0),
(10, 'Naziv', '', 0),
(11, 'Broj prikaza', '', 0),
(12, 'Rastuca', 'rastuca', 9),
(13, 'Opadajuca', 'opadajuca', 9),
(14, 'Od A-Z', 'aZ', 10),
(15, 'Od Z-A', 'Za', 10),
(16, 'Jedna kolona', 'jednaKolona', 11),
(17, 'Dve kolone', 'dveKolone', 11),
(18, 'Tri kolone', 'triKolone', 11);

-- --------------------------------------------------------

--
-- Table structure for table `odgovor`
--

CREATE TABLE `odgovor` (
  `id_odgovor` int(11) NOT NULL,
  `odgovor` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odgovor`
--

INSERT INTO `odgovor` (`id_odgovor`, `odgovor`) VALUES
(1, 'Da.'),
(2, 'Ne.');

-- --------------------------------------------------------

--
-- Table structure for table `pol`
--

CREATE TABLE `pol` (
  `polID` int(3) NOT NULL,
  `Naziv` varchar(11) COLLATE ucs2_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

--
-- Dumping data for table `pol`
--

INSERT INTO `pol` (`polID`, `Naziv`) VALUES
(1, 'Muski'),
(2, 'Zenski');

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `idProizvod` int(11) NOT NULL,
  `naslov` text COLLATE utf8_unicode_ci NOT NULL,
  `src` text COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cena` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idKategorija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`idProizvod`, `naslov`, `src`, `alt`, `cena`, `idKategorija`) VALUES
(1, 'Polar Blizzard', 'images/ikonicab1.jpg', 'Bicikl Polar Blizzard', '24 990 din', 1),
(2, 'Polar Pacific', 'images/ikonicab2.jpg', 'Polar Pacific', '17 990 din', 1),
(5, 'Scott Foil', 'images/ikonicab3.jpg', 'Scott foil', '295 490 din', 1),
(6, 'Scott Silence Speed', 'images/ikonicab4.jpg', 'Scott Silence Speed', '89 990 din', 1),
(8, 'Scott Speedster Gravel', 'images/ikonicab6.jpg', 'Scott Speed Gravel', '146 880 din', 1),
(9, 'Alpina Helium', 'images/ikonicab7.jpg', 'Alpina Helium', '13 990 din', 1),
(10, 'Alpina Buffalo', 'images/ikonicab8.jpg', 'Alpina Buffalo', '16 990 din', 1),
(11, 'Scott Volage', 'images/ikonicab9.jpg', 'Scott Volage', '73 380 din', 1),
(12, 'Polar Mirage Pro', 'images/ikonicab10.jpg', 'Polar Mirage Pro', '40 000 din', 1),
(13, 'Booster Galaxy', 'images/ikonicab11.jpg', 'Booster Galaxy', '12 490 din', 1),
(14, 'Scoot E-sub Tour', 'images/ikonicab12.jpg', 'Scot E-sub TOUR', '306 100 din', 1),
(15, 'Scott E-sub Cross', 'images/ikonicab13.jpg', 'Scott E-sub Cross', '244 880 din', 1),
(16, 'Guralica Bellelli', 'images/ikonicab14.jpg', 'Guralica Bellelli', '8 390 din', 1),
(17, 'Polar Blossom', 'images/ikonicab15.jpg', 'Polar Blossom', '11 000 din', 1),
(18, 'Adapter Bellelli', 'images/opremaIco1.jpg', 'Adapter za korpu deteta', '2 200 din', 2),
(19, 'Korpa za Dete Polisport', 'images/opremaIco2.jpg', 'Korpa Polisport', '5 600 din', 2),
(20, 'Korpa za dete Polisport Joy', 'images/opremaIco3.jpg', 'Korpa Polisport JOY', '7 290 din', 2),
(22, 'Alu Podesiva 24-28 cm', 'images/opremaIco5.jpg', 'Nogica Podesiva', '1 100 din', 2),
(23, 'Hot&Cold Termo', 'images/opremaIco6.jpg', 'Flasica ', '1 180 din', 2),
(24, 'Pak Treger Zekal ', 'images/opremaIco7.jpg', 'Pak treger za bicikl', '5 550 din ', 2),
(25, 'Cateyes Velo', 'images/opremaIco8.jpg', 'Brzinometar', '6 540 din', 2),
(27, 'Kaciga Polistport Blast', 'images/opremaIco10.jpg', 'Kaciga', '2 590 din', 2),
(28, 'Polisport Thunder Downhill', 'images/opremaIco11.jpg', 'kaciga Thunder Downhill', '8 700 din', 2),
(29, 'Rogovi Ritcney', 'images/opremaIco12.jpg', 'Rogovi Rithey', '4 700 din', 2),
(30, 'Traka Volana Syncros', 'images/opremaIco13.jpg', 'Traka za volan ', '2 670 din', 2),
(31, 'Kaciga Uvex Race', 'images/opremaIco15.jpg', 'Kaciga Uvex Race', '14 990 din', 2),
(32, 'Svetla & Brzinometar', 'images/opremaIco14.jpg', 'Brzinometar Zadnje svetlo', '5 400 din', 2);

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `id` int(100) NOT NULL,
  `naziv` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`id`, `naziv`) VALUES
(1, 'korisnik'),
(2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`id_a`);

--
-- Indexes for table `anketa_korisnik`
--
ALTER TABLE `anketa_korisnik`
  ADD PRIMARY KEY (`id_anketa_korisnik`),
  ADD KEY `idAnketa` (`id_anketa`),
  ADD KEY `idKorisnik` (`idKorisnik`),
  ADD KEY `idAnketaOdgovor` (`id_anketa_odgovor`);

--
-- Indexes for table `anketa_odgovor`
--
ALTER TABLE `anketa_odgovor`
  ADD PRIMARY KEY (`id_a_o`),
  ADD KEY `idOdgovor` (`id_odgovor`),
  ADD KEY `idAnketa` (`id_anketa`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idKorisnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `ulogaID` (`ulogaID`),
  ADD KEY `polID` (`polID`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`idMeni`);

--
-- Indexes for table `odgovor`
--
ALTER TABLE `odgovor`
  ADD PRIMARY KEY (`id_odgovor`);

--
-- Indexes for table `pol`
--
ALTER TABLE `pol`
  ADD PRIMARY KEY (`polID`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`idProizvod`),
  ADD KEY `idKategorija` (`idKategorija`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anketa_korisnik`
--
ALTER TABLE `anketa_korisnik`
  MODIFY `id_anketa_korisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `anketa_odgovor`
--
ALTER TABLE `anketa_odgovor`
  MODIFY `id_a_o` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idKorisnik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `idMeni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `odgovor`
--
ALTER TABLE `odgovor`
  MODIFY `id_odgovor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pol`
--
ALTER TABLE `pol`
  MODIFY `polID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `idProizvod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anketa_korisnik`
--
ALTER TABLE `anketa_korisnik`
  ADD CONSTRAINT `anketa_korisnik_ibfk_1` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnik` (`idKorisnik`),
  ADD CONSTRAINT `anketa_korisnik_ibfk_2` FOREIGN KEY (`id_anketa`) REFERENCES `anketa` (`id_a`),
  ADD CONSTRAINT `anketa_korisnik_ibfk_3` FOREIGN KEY (`id_anketa_odgovor`) REFERENCES `anketa_odgovor` (`id_a_o`);

--
-- Constraints for table `anketa_odgovor`
--
ALTER TABLE `anketa_odgovor`
  ADD CONSTRAINT `anketa_odgovor_ibfk_1` FOREIGN KEY (`id_anketa`) REFERENCES `anketa` (`id_a`),
  ADD CONSTRAINT `anketa_odgovor_ibfk_2` FOREIGN KEY (`id_odgovor`) REFERENCES `odgovor` (`id_odgovor`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`ulogaID`) REFERENCES `uloge` (`id`),
  ADD CONSTRAINT `korisnik_ibfk_2` FOREIGN KEY (`polID`) REFERENCES `pol` (`polID`);

--
-- Constraints for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD CONSTRAINT `proizvodi_ibfk_1` FOREIGN KEY (`idKategorija`) REFERENCES `kategorije` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
