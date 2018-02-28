-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 28 feb 2018 om 13:48
-- Serverversie: 10.1.28-MariaDB
-- PHP-versie: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisa-db-test`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_adressen`
--

CREATE TABLE `tbl_adressen` (
  `fld_adres_id` int(11) NOT NULL,
  `fld_adres_straatnaam` varchar(255) NOT NULL,
  `fld_adres_huis_nr` int(11) DEFAULT '0',
  `fld_adres_bus_nr` varchar(255) DEFAULT NULL,
  `fld_adres_postcode_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_adres_gemeente_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_adres_land_id_fk` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_antwoorden`
--

CREATE TABLE `tbl_antwoorden` (
  `fld_antwoord_id` int(11) NOT NULL,
  `fld_persoon_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_vraag_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_antwoord_k_tekst` varchar(255) DEFAULT NULL,
  `fld_antwoord_l_tekst` longtext,
  `fld_antwoord_num` int(11) DEFAULT NULL,
  `fld_antwoord_datum` datetime DEFAULT NULL,
  `fld_antwoord_j/n` tinyint(1) DEFAULT '0',
  `fld_antwoord_lijst_id_fk` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_antwoorden_lijst`
--

CREATE TABLE `tbl_antwoorden_lijst` (
  `fld_lijst_id` int(11) NOT NULL,
  `fld_vraag_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_lijst_item` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_antwoorden_lijst`
--

INSERT INTO `tbl_antwoorden_lijst` (`fld_lijst_id`, `fld_vraag_id_fk`, `fld_lijst_item`) VALUES
(1, 26, 'Appel'),
(2, 26, 'Peer'),
(3, 26, 'Banaan'),
(4, 26, 'Mango'),
(5, 26, 'Pizza'),
(9, 28, 'Fiets'),
(10, 28, 'Bus'),
(11, 28, 'Auto'),
(12, 28, 'Trein'),
(13, 28, 'Te voet'),
(14, 29, ''),
(15, 29, ''),
(16, 30, ''),
(17, 41, 'Test1'),
(18, 41, 'Test3'),
(19, 41, 'Test2'),
(20, 42, 'Te voet'),
(21, 42, 'Fiets'),
(22, 42, 'Auto');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_bestaande_lijsten`
--

CREATE TABLE `tbl_bestaande_lijsten` (
  `fld_bestaande_lijst_id` int(11) NOT NULL,
  `fld_bestaande_lijst_naam` varchar(50) CHARACTER SET utf8 NOT NULL,
  `fld_bestaande_lijst_tabel` varchar(55) CHARACTER SET utf8 NOT NULL,
  `fld_bestaande_lijst_tabel_key` varchar(55) CHARACTER SET utf8 NOT NULL,
  `fld_bestaande_lijst_veld` varchar(55) CHARACTER SET utf8 NOT NULL,
  `fld_bestaande_lijst_beschrijving` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_bestaande_lijsten`
--

INSERT INTO `tbl_bestaande_lijsten` (`fld_bestaande_lijst_id`, `fld_bestaande_lijst_naam`, `fld_bestaande_lijst_tabel`, `fld_bestaande_lijst_tabel_key`, `fld_bestaande_lijst_veld`, `fld_bestaande_lijst_beschrijving`) VALUES
(1, 'Godsdiensten', 'tbl_godsdiensten', 'fld_godsdienst_id', 'fld_godsdienst_naam', NULL),
(2, 'Klassen', 'tbl_klassen', 'fld_klas_id', 'fld_klas_naam', NULL),
(3, 'Landen', 'tbl_landen', 'fld_land_id', 'fld_land_naam', NULL),
(4, 'Nationaliteiten', 'tbl_nationaliteiten', 'fld_nation_id', 'fld_nation_nation', NULL),
(5, 'Personen', 'tbl_personen', 'fld_persoon_id', 'fld_persoon_naam', NULL),
(6, 'Postcodes', 'tbl_postcodes', 'fld_postcode_id', 'fld_postcode_nr', NULL),
(7, 'Richtingen', 'tbl_richtingen', 'fld_richting_id', 'fld_richting_naam', NULL),
(8, 'Scholen', 'tbl_scholen', 'fld_school_id', 'fld_school_naam', NULL),
(9, 'Woonplaatsen', 'tbl_woonplaatsen', 'fld_woonplaats_id', 'fld_woonplaats_naam', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_bestemmingen`
--

CREATE TABLE `tbl_bestemmingen` (
  `fld_bestemming_id` int(11) NOT NULL,
  `fld_bestemming_naam` varchar(255) NOT NULL,
  `fld_school_id_fk` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_bestemmingen`
--

INSERT INTO `tbl_bestemmingen` (`fld_bestemming_id`, `fld_bestemming_naam`, `fld_school_id_fk`) VALUES
(1, 'Wisa', 0),
(2, 'CLB', 0),
(3, 'Smartschool', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_docs`
--

CREATE TABLE `tbl_docs` (
  `fld_doc_id` int(11) NOT NULL,
  `fld_doc_naam` varchar(255) NOT NULL,
  `fld_doc_soort` varchar(10) NOT NULL,
  `fld_doc_plaats` varchar(255) NOT NULL,
  `fld_doc_datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_docs_links`
--

CREATE TABLE `tbl_docs_links` (
  `fld_doc_link_id` int(11) NOT NULL,
  `fld_doc_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_loopbaan_id_fk` int(11) DEFAULT '0',
  `fld_persoon_id_fk` int(11) DEFAULT '0',
  `fld_school_id_fk` int(11) DEFAULT '0',
  `fld_klas_id_fk` int(11) DEFAULT '0',
  `fld_vraag_id_fk` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_gebruikers`
--

CREATE TABLE `tbl_gebruikers` (
  `fld_gebruiker_id` int(11) NOT NULL,
  `fld_school_id_fk` int(11) NOT NULL,
  `fld_gebruiker_naam` varchar(25) NOT NULL,
  `fld_gebruiker_wachtwoord` varchar(25) NOT NULL,
  `fld_gebruiker_instelling` varchar(50) NOT NULL,
  `fld_gebruiker_soort_id_fk` int(11) NOT NULL,
  `fld_gebruiker_beschrijving` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_gebruikers`
--

INSERT INTO `tbl_gebruikers` (`fld_gebruiker_id`, `fld_school_id_fk`, `fld_gebruiker_naam`, `fld_gebruiker_wachtwoord`, `fld_gebruiker_instelling`, `fld_gebruiker_soort_id_fk`, `fld_gebruiker_beschrijving`) VALUES
(1, 1, 'testgebruiker2', '123', 'miniemen', 2, NULL),
(2, 1, 'testgebruiker3', '123', 'miniemen', 3, NULL),
(3, 1, 'testgebruiker4', '123', 'miniemen', 4, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_gebruikers_soorten`
--

CREATE TABLE `tbl_gebruikers_soorten` (
  `fld_gebruiker_soort_id` int(11) NOT NULL,
  `fld_gebruiker_soort_naam` varchar(25) NOT NULL,
  `fld_gebruiker_soort_beschrijving` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_gebruikers_soorten`
--

INSERT INTO `tbl_gebruikers_soorten` (`fld_gebruiker_soort_id`, `fld_gebruiker_soort_naam`, `fld_gebruiker_soort_beschrijving`) VALUES
(1, 'wisa', NULL),
(2, 'admin', 'Vragen beheren'),
(3, 'gebruiker', 'Leerlingen inschrijven'),
(4, 'test', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_godsdiensten`
--

CREATE TABLE `tbl_godsdiensten` (
  `fld_godsdienst_id` int(11) NOT NULL,
  `fld_godsdienst_naam` varchar(55) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_godsdiensten`
--

INSERT INTO `tbl_godsdiensten` (`fld_godsdienst_id`, `fld_godsdienst_naam`) VALUES
(1, 'Christendom'),
(2, 'Moslim'),
(3, 'Hindoeïsme'),
(4, 'Boeddhisme');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_klassen`
--

CREATE TABLE `tbl_klassen` (
  `fld_klas_id` int(11) NOT NULL,
  `fld_klas_afkorting` varchar(255) DEFAULT NULL,
  `fld_klas_naam` varchar(255) NOT NULL,
  `fld_richting_id_fk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_landen`
--

CREATE TABLE `tbl_landen` (
  `fld_land_id` int(11) NOT NULL,
  `fld_land_naam` varchar(55) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_landen`
--

INSERT INTO `tbl_landen` (`fld_land_id`, `fld_land_naam`) VALUES
(1, 'België'),
(2, 'Frankrijk'),
(3, 'Nederland'),
(4, 'Spanje');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_loopbanen`
--

CREATE TABLE `tbl_loopbanen` (
  `fld_loopbaan_id` int(11) NOT NULL,
  `fld_persoon_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_school_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_richting_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_klas_id_fk` int(11) DEFAULT '0',
  `fld_loopbaan_schooljaar` varchar(255) NOT NULL,
  `fld_loopbaan_b_datum` datetime DEFAULT NULL,
  `fld_loopbaan_e_datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_nationaliteiten`
--

CREATE TABLE `tbl_nationaliteiten` (
  `fld_nation_id` int(11) NOT NULL,
  `fld_nation_nation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_personen`
--

CREATE TABLE `tbl_personen` (
  `fld_persoon_id` int(11) NOT NULL,
  `fld_persoon_voornaam` varchar(255) NOT NULL,
  `fld_persoon_achternaam` varchar(255) NOT NULL,
  `fld_persoon_naam` varchar(255) NOT NULL,
  `fld_persoon_gb_datum` datetime DEFAULT NULL,
  `fld_persoon_geslacht` varchar(1) NOT NULL,
  `fld_godsdienst_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_personen_linken`
--

CREATE TABLE `tbl_personen_linken` (
  `fld_persoon_link_id` int(11) NOT NULL,
  `fld_master_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_child_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_soort_id_fk` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_personen_nationaliteiten`
--

CREATE TABLE `tbl_personen_nationaliteiten` (
  `fld_persoon_nation_id` int(11) NOT NULL,
  `fld_persoon_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_nation_id_fk` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_persoon_adressen`
--

CREATE TABLE `tbl_persoon_adressen` (
  `fld_persoon_adres_id` int(11) NOT NULL,
  `fld_persoon_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_adres_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_soort_id_fk` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_postcodes`
--

CREATE TABLE `tbl_postcodes` (
  `fld_postcode_id` int(11) NOT NULL,
  `fld_postcode_nr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_postcodes`
--

INSERT INTO `tbl_postcodes` (`fld_postcode_id`, `fld_postcode_nr`) VALUES
(1, 3000),
(2, 1030);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_richtingen`
--

CREATE TABLE `tbl_richtingen` (
  `fld_richting_id` int(11) NOT NULL,
  `fld_richting_afkorting` varchar(255) DEFAULT NULL,
  `fld_richting_naam` varchar(255) NOT NULL,
  `fld_richting_graad` varchar(255) NOT NULL,
  `fld_richting_leerjaar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_scholen`
--

CREATE TABLE `tbl_scholen` (
  `fld_school_id` int(11) NOT NULL,
  `fld_school_naam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_scholen`
--

INSERT INTO `tbl_scholen` (`fld_school_id`, `fld_school_naam`) VALUES
(1, 'Miniemeninstituut');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_soorten`
--

CREATE TABLE `tbl_soorten` (
  `fld_soort_id` int(11) NOT NULL,
  `fld_soort_naam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_vragen`
--

CREATE TABLE `tbl_vragen` (
  `fld_vraag_id` int(11) NOT NULL,
  `fld_vraag_vraag` varchar(255) NOT NULL,
  `fld_vraag_kernwoord` varchar(255) DEFAULT NULL,
  `fld_antwoord_type_k_tekst` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_l_tekst` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_num` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_datum` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_j/n` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_foto` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_lijst` tinyint(1) DEFAULT '0',
  `fld_antwoord_aantal` int(11) NOT NULL DEFAULT '1',
  `fld_vraag_antwoord_verplicht` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_vragen`
--

INSERT INTO `tbl_vragen` (`fld_vraag_id`, `fld_vraag_vraag`, `fld_vraag_kernwoord`, `fld_antwoord_type_k_tekst`, `fld_antwoord_type_l_tekst`, `fld_antwoord_type_num`, `fld_antwoord_type_datum`, `fld_antwoord_type_j/n`, `fld_antwoord_type_foto`, `fld_antwoord_type_lijst`, `fld_antwoord_aantal`, `fld_vraag_antwoord_verplicht`) VALUES
(35, 'Voornaam', 'Voornaam', 1, 0, 0, 0, 0, 0, 0, 1, 1),
(37, 'Achternaam', 'Achternaam', 1, 0, 0, 0, 0, 0, 0, 1, 1),
(38, 'Geboortedatum', 'Geboortedatum', 0, 0, 0, 1, 0, 0, 0, 1, 0),
(42, 'Hoe kom je naar school?', 'Vervoer', 0, 0, 0, 0, 0, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_vragen_bestemmingen`
--

CREATE TABLE `tbl_vragen_bestemmingen` (
  `fld_vraag_bestemming_id` int(11) NOT NULL,
  `fld_vraag_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_bestemming_id_fk` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_vragen_bestemmingen`
--

INSERT INTO `tbl_vragen_bestemmingen` (`fld_vraag_bestemming_id`, `fld_vraag_id_fk`, `fld_bestemming_id_fk`) VALUES
(47, 35, 1),
(48, 35, 2),
(49, 35, 3),
(53, 37, 1),
(54, 37, 2),
(55, 37, 3),
(56, 38, 1),
(57, 38, 2),
(58, 38, 3),
(59, 41, 2),
(60, 41, 3),
(61, 42, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_woonplaatsen`
--

CREATE TABLE `tbl_woonplaatsen` (
  `fld_woonplaats_id` int(11) NOT NULL,
  `fld_woonplaats_naam` varchar(55) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tbl_woonplaatsen`
--

INSERT INTO `tbl_woonplaatsen` (`fld_woonplaats_id`, `fld_woonplaats_naam`) VALUES
(1, 'Leuven'),
(2, 'Kessel-Lo'),
(3, 'Brussel'),
(4, 'Antwerpen');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tbl_adressen`
--
ALTER TABLE `tbl_adressen`
  ADD PRIMARY KEY (`fld_adres_id`),
  ADD KEY `fld_adres_id` (`fld_adres_id`),
  ADD KEY `fld_adres_postcode_id_fk` (`fld_adres_postcode_id_fk`);

--
-- Indexen voor tabel `tbl_antwoorden`
--
ALTER TABLE `tbl_antwoorden`
  ADD PRIMARY KEY (`fld_antwoord_id`),
  ADD KEY `fld_antwoord_id` (`fld_antwoord_id`),
  ADD KEY `fld_vraag_id_fk` (`fld_vraag_id_fk`);

--
-- Indexen voor tabel `tbl_antwoorden_lijst`
--
ALTER TABLE `tbl_antwoorden_lijst`
  ADD PRIMARY KEY (`fld_lijst_id`),
  ADD KEY `fld_lijst_id` (`fld_lijst_id`);

--
-- Indexen voor tabel `tbl_bestaande_lijsten`
--
ALTER TABLE `tbl_bestaande_lijsten`
  ADD PRIMARY KEY (`fld_bestaande_lijst_id`);

--
-- Indexen voor tabel `tbl_bestemmingen`
--
ALTER TABLE `tbl_bestemmingen`
  ADD PRIMARY KEY (`fld_bestemming_id`),
  ADD KEY `fld_bestemming_id` (`fld_bestemming_id`);

--
-- Indexen voor tabel `tbl_docs`
--
ALTER TABLE `tbl_docs`
  ADD PRIMARY KEY (`fld_doc_id`),
  ADD KEY `fld_doc_id` (`fld_doc_id`);

--
-- Indexen voor tabel `tbl_docs_links`
--
ALTER TABLE `tbl_docs_links`
  ADD PRIMARY KEY (`fld_doc_link_id`),
  ADD KEY `fld_doc_link_id` (`fld_doc_link_id`);

--
-- Indexen voor tabel `tbl_gebruikers`
--
ALTER TABLE `tbl_gebruikers`
  ADD PRIMARY KEY (`fld_gebruiker_id`);

--
-- Indexen voor tabel `tbl_gebruikers_soorten`
--
ALTER TABLE `tbl_gebruikers_soorten`
  ADD PRIMARY KEY (`fld_gebruiker_soort_id`);

--
-- Indexen voor tabel `tbl_godsdiensten`
--
ALTER TABLE `tbl_godsdiensten`
  ADD PRIMARY KEY (`fld_godsdienst_id`);

--
-- Indexen voor tabel `tbl_klassen`
--
ALTER TABLE `tbl_klassen`
  ADD PRIMARY KEY (`fld_klas_id`),
  ADD KEY `fld_klas_id` (`fld_klas_id`);

--
-- Indexen voor tabel `tbl_landen`
--
ALTER TABLE `tbl_landen`
  ADD PRIMARY KEY (`fld_land_id`);

--
-- Indexen voor tabel `tbl_loopbanen`
--
ALTER TABLE `tbl_loopbanen`
  ADD PRIMARY KEY (`fld_loopbaan_id`),
  ADD KEY `fld_loopbaan_id` (`fld_loopbaan_id`);

--
-- Indexen voor tabel `tbl_nationaliteiten`
--
ALTER TABLE `tbl_nationaliteiten`
  ADD PRIMARY KEY (`fld_nation_id`),
  ADD KEY `fld_nation_id` (`fld_nation_id`);

--
-- Indexen voor tabel `tbl_personen`
--
ALTER TABLE `tbl_personen`
  ADD PRIMARY KEY (`fld_persoon_id`);

--
-- Indexen voor tabel `tbl_personen_linken`
--
ALTER TABLE `tbl_personen_linken`
  ADD PRIMARY KEY (`fld_persoon_link_id`),
  ADD KEY `fld_child_id_fk` (`fld_child_id_fk`),
  ADD KEY `fld_persoon_link_id` (`fld_persoon_link_id`),
  ADD KEY `fld_master_id_fk` (`fld_master_id_fk`);

--
-- Indexen voor tabel `tbl_personen_nationaliteiten`
--
ALTER TABLE `tbl_personen_nationaliteiten`
  ADD PRIMARY KEY (`fld_persoon_nation_id`),
  ADD KEY `fld_nation_id_fk` (`fld_nation_id_fk`),
  ADD KEY `fld_persoon_nation_id` (`fld_persoon_nation_id`);

--
-- Indexen voor tabel `tbl_persoon_adressen`
--
ALTER TABLE `tbl_persoon_adressen`
  ADD PRIMARY KEY (`fld_persoon_adres_id`),
  ADD KEY `fld_persoon_id_fk` (`fld_persoon_id_fk`);

--
-- Indexen voor tabel `tbl_postcodes`
--
ALTER TABLE `tbl_postcodes`
  ADD PRIMARY KEY (`fld_postcode_id`);

--
-- Indexen voor tabel `tbl_richtingen`
--
ALTER TABLE `tbl_richtingen`
  ADD PRIMARY KEY (`fld_richting_id`),
  ADD KEY `fld_richting_id` (`fld_richting_id`);

--
-- Indexen voor tabel `tbl_scholen`
--
ALTER TABLE `tbl_scholen`
  ADD PRIMARY KEY (`fld_school_id`),
  ADD KEY `fld_school_id` (`fld_school_id`);

--
-- Indexen voor tabel `tbl_soorten`
--
ALTER TABLE `tbl_soorten`
  ADD PRIMARY KEY (`fld_soort_id`);

--
-- Indexen voor tabel `tbl_vragen`
--
ALTER TABLE `tbl_vragen`
  ADD PRIMARY KEY (`fld_vraag_id`),
  ADD KEY `fld_vraag_id` (`fld_vraag_id`);

--
-- Indexen voor tabel `tbl_vragen_bestemmingen`
--
ALTER TABLE `tbl_vragen_bestemmingen`
  ADD PRIMARY KEY (`fld_vraag_bestemming_id`),
  ADD KEY `fld_vraag_bestemming_id` (`fld_vraag_bestemming_id`);

--
-- Indexen voor tabel `tbl_woonplaatsen`
--
ALTER TABLE `tbl_woonplaatsen`
  ADD PRIMARY KEY (`fld_woonplaats_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tbl_adressen`
--
ALTER TABLE `tbl_adressen`
  MODIFY `fld_adres_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_antwoorden`
--
ALTER TABLE `tbl_antwoorden`
  MODIFY `fld_antwoord_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_antwoorden_lijst`
--
ALTER TABLE `tbl_antwoorden_lijst`
  MODIFY `fld_lijst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `tbl_bestaande_lijsten`
--
ALTER TABLE `tbl_bestaande_lijsten`
  MODIFY `fld_bestaande_lijst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `tbl_bestemmingen`
--
ALTER TABLE `tbl_bestemmingen`
  MODIFY `fld_bestemming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `tbl_docs`
--
ALTER TABLE `tbl_docs`
  MODIFY `fld_doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_docs_links`
--
ALTER TABLE `tbl_docs_links`
  MODIFY `fld_doc_link_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_gebruikers`
--
ALTER TABLE `tbl_gebruikers`
  MODIFY `fld_gebruiker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `tbl_gebruikers_soorten`
--
ALTER TABLE `tbl_gebruikers_soorten`
  MODIFY `fld_gebruiker_soort_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `tbl_godsdiensten`
--
ALTER TABLE `tbl_godsdiensten`
  MODIFY `fld_godsdienst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `tbl_klassen`
--
ALTER TABLE `tbl_klassen`
  MODIFY `fld_klas_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_landen`
--
ALTER TABLE `tbl_landen`
  MODIFY `fld_land_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `tbl_loopbanen`
--
ALTER TABLE `tbl_loopbanen`
  MODIFY `fld_loopbaan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_nationaliteiten`
--
ALTER TABLE `tbl_nationaliteiten`
  MODIFY `fld_nation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_personen`
--
ALTER TABLE `tbl_personen`
  MODIFY `fld_persoon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_personen_linken`
--
ALTER TABLE `tbl_personen_linken`
  MODIFY `fld_persoon_link_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_personen_nationaliteiten`
--
ALTER TABLE `tbl_personen_nationaliteiten`
  MODIFY `fld_persoon_nation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_persoon_adressen`
--
ALTER TABLE `tbl_persoon_adressen`
  MODIFY `fld_persoon_adres_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_postcodes`
--
ALTER TABLE `tbl_postcodes`
  MODIFY `fld_postcode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `tbl_richtingen`
--
ALTER TABLE `tbl_richtingen`
  MODIFY `fld_richting_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_scholen`
--
ALTER TABLE `tbl_scholen`
  MODIFY `fld_school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `tbl_soorten`
--
ALTER TABLE `tbl_soorten`
  MODIFY `fld_soort_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tbl_vragen`
--
ALTER TABLE `tbl_vragen`
  MODIFY `fld_vraag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT voor een tabel `tbl_vragen_bestemmingen`
--
ALTER TABLE `tbl_vragen_bestemmingen`
  MODIFY `fld_vraag_bestemming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT voor een tabel `tbl_woonplaatsen`
--
ALTER TABLE `tbl_woonplaatsen`
  MODIFY `fld_woonplaats_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
