-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                10.1.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Versie:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Databasestructuur van wisa-db-test wordt geschreven
CREATE DATABASE IF NOT EXISTS `wisa-db-test` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `wisa-db-test`;

-- Structuur van  tabel wisa-db-test.tbl_adressen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_adressen` (
  `fld_adres_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_adres_straatnaam` varchar(255) NOT NULL,
  `fld_adres_huis_nr` int(11) DEFAULT '0',
  `fld_adres_bus_nr` varchar(255) DEFAULT NULL,
  `fld_adres_postcode_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_adres_gemeente_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_adres_land_id_fk` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fld_adres_id`),
  KEY `fld_adres_id` (`fld_adres_id`),
  KEY `fld_adres_postcode_id_fk` (`fld_adres_postcode_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_adressen: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_adressen` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_adressen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_antwoorden wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_antwoorden` (
  `fld_antwoord_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_persoon_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_vraag_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_antwoord_k_tekst` varchar(255) DEFAULT NULL,
  `fld_antwoord_l_tekst` longtext,
  `fld_antwoord_num` int(11) DEFAULT NULL,
  `fld_antwoord_datum` datetime DEFAULT NULL,
  `fld_antwoord_j/n` tinyint(1) DEFAULT '0',
  `fld_antwoord_lijst_id_fk` int(11) DEFAULT '0',
  PRIMARY KEY (`fld_antwoord_id`),
  KEY `fld_antwoord_id` (`fld_antwoord_id`),
  KEY `fld_vraag_id_fk` (`fld_vraag_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_antwoorden: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_antwoorden` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_antwoorden` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_antwoorden_lijst wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_antwoorden_lijst` (
  `fld_lijst_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_vraag_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_lijst_item` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_lijst_id`),
  KEY `fld_lijst_id` (`fld_lijst_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_antwoorden_lijst: ~6 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_antwoorden_lijst` DISABLE KEYS */;
INSERT INTO `tbl_antwoorden_lijst` (`fld_lijst_id`, `fld_vraag_id_fk`, `fld_lijst_item`) VALUES
	(20, 42, 'Te voet'),
	(21, 42, 'Fiets'),
	(22, 42, 'Auto'),
	(23, 43, 'Voetbal'),
	(24, 43, 'Volleyball'),
	(25, 43, 'Zwemmen');
/*!40000 ALTER TABLE `tbl_antwoorden_lijst` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_bestaande_lijsten wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_bestaande_lijsten` (
  `fld_bestaande_lijst_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_bestaande_lijst_naam` varchar(50) CHARACTER SET utf8 NOT NULL,
  `fld_bestaande_lijst_tabel` varchar(55) CHARACTER SET utf8 NOT NULL,
  `fld_bestaande_lijst_tabel_key` varchar(55) CHARACTER SET utf8 NOT NULL,
  `fld_bestaande_lijst_veld` varchar(55) CHARACTER SET utf8 NOT NULL,
  `fld_bestaande_lijst_beschrijving` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`fld_bestaande_lijst_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wisa-db-test.tbl_bestaande_lijsten: ~9 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_bestaande_lijsten` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `tbl_bestaande_lijsten` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_bestemmingen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_bestemmingen` (
  `fld_bestemming_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_bestemming_naam` varchar(255) NOT NULL,
  `fld_school_id_fk` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fld_bestemming_id`),
  KEY `fld_bestemming_id` (`fld_bestemming_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_bestemmingen: ~3 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_bestemmingen` DISABLE KEYS */;
INSERT INTO `tbl_bestemmingen` (`fld_bestemming_id`, `fld_bestemming_naam`, `fld_school_id_fk`) VALUES
	(1, 'Wisa', 0),
	(2, 'CLB', 0),
	(3, 'Smartschool', 0);
/*!40000 ALTER TABLE `tbl_bestemmingen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_docs wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_docs` (
  `fld_doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_doc_naam` varchar(255) NOT NULL,
  `fld_doc_soort` varchar(10) NOT NULL,
  `fld_doc_plaats` varchar(255) NOT NULL,
  `fld_doc_datum` datetime NOT NULL,
  PRIMARY KEY (`fld_doc_id`),
  KEY `fld_doc_id` (`fld_doc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_docs: ~6 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_docs` DISABLE KEYS */;
INSERT INTO `tbl_docs` (`fld_doc_id`, `fld_doc_naam`, `fld_doc_soort`, `fld_doc_plaats`, `fld_doc_datum`) VALUES
	(1, 'Print_Gebouwen1-Dak_Filmpje.png2018-02-28_04-11', 'png2018-02', 'Uploads/Print_Gebouwen1-Dak_Filmpje.png2018-02-28_04-11', '2018-02-28 04:11:00'),
	(2, 'Print_Gebouwen1-Deur_Filmpje.png2018-02-28_04-11', 'png2018-02', 'Uploads/Print_Gebouwen1-Deur_Filmpje.png2018-02-28_04-11', '2018-02-28 04:11:00'),
	(3, 'Print_Gebouwen1-DeurR_Filmpje.png2018-02-28_04-11', 'png2018-02', 'Uploads/Print_Gebouwen1-DeurR_Filmpje.png2018-02-28_04-11', '2018-02-28 04:11:00'),
	(4, '352018-02-28_04-16', '', 'Uploads/352018-02-28_04-16', '2018-02-28 04:16:00'),
	(5, '352018-02-28_04-16', '', 'Uploads/352018-02-28_04-16', '2018-02-28 04:16:00'),
	(6, '382018-02-28_04-16', '', 'Uploads/382018-02-28_04-16', '2018-02-28 04:16:00');
/*!40000 ALTER TABLE `tbl_docs` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_docs_links wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_docs_links` (
  `fld_doc_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_doc_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_loopbaan_id_fk` int(11) DEFAULT '0',
  `fld_persoon_id_fk` int(11) DEFAULT '0',
  `fld_school_id_fk` int(11) DEFAULT '0',
  `fld_klas_id_fk` int(11) DEFAULT '0',
  `fld_vraag_id_fk` int(11) DEFAULT '0',
  PRIMARY KEY (`fld_doc_link_id`),
  KEY `fld_doc_link_id` (`fld_doc_link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_docs_links: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_docs_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_docs_links` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_gebruikers wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_gebruikers` (
  `fld_gebruiker_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_school_id_fk` int(11) NOT NULL,
  `fld_gebruiker_naam` varchar(25) NOT NULL,
  `fld_gebruiker_wachtwoord` varchar(25) NOT NULL,
  `fld_gebruiker_instelling` varchar(50) NOT NULL,
  `fld_gebruiker_soort_id_fk` int(11) NOT NULL,
  `fld_gebruiker_beschrijving` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fld_gebruiker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_gebruikers: ~2 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_gebruikers` DISABLE KEYS */;
INSERT INTO `tbl_gebruikers` (`fld_gebruiker_id`, `fld_school_id_fk`, `fld_gebruiker_naam`, `fld_gebruiker_wachtwoord`, `fld_gebruiker_instelling`, `fld_gebruiker_soort_id_fk`, `fld_gebruiker_beschrijving`) VALUES
	(1, 1, 'testgebruiker2', '123', 'miniemen', 2, NULL),
	(2, 1, 'testgebruiker3', '123', 'miniemen', 3, NULL),
	(3, 1, 'testgebruiker4', '123', 'miniemen', 4, NULL);
/*!40000 ALTER TABLE `tbl_gebruikers` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_gebruikers_soorten wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_gebruikers_soorten` (
  `fld_gebruiker_soort_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_gebruiker_soort_naam` varchar(25) NOT NULL,
  `fld_gebruiker_soort_beschrijving` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fld_gebruiker_soort_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_gebruikers_soorten: ~3 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_gebruikers_soorten` DISABLE KEYS */;
INSERT INTO `tbl_gebruikers_soorten` (`fld_gebruiker_soort_id`, `fld_gebruiker_soort_naam`, `fld_gebruiker_soort_beschrijving`) VALUES
	(1, 'wisa', NULL),
	(2, 'admin', 'Vragen beheren'),
	(3, 'gebruiker', 'Leerlingen inschrijven'),
	(4, 'test', NULL);
/*!40000 ALTER TABLE `tbl_gebruikers_soorten` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_gegevens wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_gegevens` (
  `fld_gegeven_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_gegeven_inhoud` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fld_gegeven_soort_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`fld_gegeven_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wisa-db-test.tbl_gegevens: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_gegevens` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_gegevens` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_gegevens_soorten wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_gegevens_soorten` (
  `fld_gegeven_soort_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_gegeven_soort_naam` varchar(55) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`fld_gegeven_soort_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wisa-db-test.tbl_gegevens_soorten: ~2 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_gegevens_soorten` DISABLE KEYS */;
INSERT INTO `tbl_gegevens_soorten` (`fld_gegeven_soort_id`, `fld_gegeven_soort_naam`) VALUES
	(1, 'E-mail'),
	(2, 'Telefoon'),
	(3, 'GSM');
/*!40000 ALTER TABLE `tbl_gegevens_soorten` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_godsdiensten wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_godsdiensten` (
  `fld_godsdienst_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_godsdienst_naam` varchar(55) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`fld_godsdienst_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wisa-db-test.tbl_godsdiensten: ~4 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_godsdiensten` DISABLE KEYS */;
INSERT INTO `tbl_godsdiensten` (`fld_godsdienst_id`, `fld_godsdienst_naam`) VALUES
	(1, 'Christendom'),
	(2, 'Moslim'),
	(3, 'Hindoeïsme'),
	(4, 'Boeddhisme');
/*!40000 ALTER TABLE `tbl_godsdiensten` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_klassen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_klassen` (
  `fld_klas_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_klas_afkorting` varchar(255) DEFAULT NULL,
  `fld_klas_naam` varchar(255) NOT NULL,
  `fld_richting_id_fk` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_klas_id`),
  KEY `fld_klas_id` (`fld_klas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_klassen: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_klassen` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_klassen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_landen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_landen` (
  `fld_land_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_land_naam` varchar(55) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`fld_land_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wisa-db-test.tbl_landen: ~4 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_landen` DISABLE KEYS */;
INSERT INTO `tbl_landen` (`fld_land_id`, `fld_land_naam`) VALUES
	(1, 'België'),
	(2, 'Frankrijk'),
	(3, 'Nederland'),
	(4, 'Spanje');
/*!40000 ALTER TABLE `tbl_landen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_loopbanen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_loopbanen` (
  `fld_loopbaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_persoon_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_school_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_richting_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_klas_id_fk` int(11) DEFAULT '0',
  `fld_loopbaan_schooljaar` varchar(255) NOT NULL,
  `fld_loopbaan_b_datum` datetime DEFAULT NULL,
  `fld_loopbaan_e_datum` datetime DEFAULT NULL,
  PRIMARY KEY (`fld_loopbaan_id`),
  KEY `fld_loopbaan_id` (`fld_loopbaan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_loopbanen: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_loopbanen` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_loopbanen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_nationaliteiten wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_nationaliteiten` (
  `fld_nation_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_nation_nation` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_nation_id`),
  KEY `fld_nation_id` (`fld_nation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_nationaliteiten: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_nationaliteiten` DISABLE KEYS */;
INSERT INTO `tbl_nationaliteiten` (`fld_nation_id`, `fld_nation_nation`) VALUES
	(1, 'Belgisch');
/*!40000 ALTER TABLE `tbl_nationaliteiten` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_personen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_personen` (
  `fld_persoon_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_persoon_voornaam` varchar(255) NOT NULL,
  `fld_persoon_achternaam` varchar(255) NOT NULL,
  `fld_persoon_naam` varchar(255) NOT NULL,
  `fld_persoon_gb_datum` datetime DEFAULT NULL,
  `fld_persoon_geslacht` varchar(1) NOT NULL,
  `fld_godsdienst_id_fk` int(11) DEFAULT NULL,
  `fld_persoon_nation_id_fk` int(11) DEFAULT NULL,
  `fld_persoon_gb_plaats` varchar(55) DEFAULT NULL,
  `fld_persoon_register_nr` varchar(11) DEFAULT NULL COMMENT 'BE',
  `fld_persoon_bis_nr` varchar(11) DEFAULT NULL,
  `fld_persoon_leerling` tinyint(1) DEFAULT NULL,
  `fld_persoon_overleden` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`fld_persoon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_personen: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_personen` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_personen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_personen_adressen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_personen_adressen` (
  `fld_persoon_adres_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_persoon_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_adres_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_soort_id_fk` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fld_persoon_adres_id`),
  KEY `fld_persoon_id_fk` (`fld_persoon_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_personen_adressen: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_personen_adressen` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_personen_adressen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_personen_gegevens wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_personen_gegevens` (
  `fld_persoon_gegeven_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_persoon_id_fk` int(11) NOT NULL,
  `fld_gegeven_id_fk` int(11) NOT NULL,
  `fld_persoon_gegeven_beschrijving` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_persoon_gegeven_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wisa-db-test.tbl_personen_gegevens: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_personen_gegevens` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_personen_gegevens` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_personen_linken wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_personen_linken` (
  `fld_persoon_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_master_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_child_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_soort_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_persoon_link_beschrijving` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fld_persoon_link_id`),
  KEY `fld_child_id_fk` (`fld_child_id_fk`),
  KEY `fld_persoon_link_id` (`fld_persoon_link_id`),
  KEY `fld_master_id_fk` (`fld_master_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_personen_linken: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_personen_linken` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_personen_linken` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_postcodes wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_postcodes` (
  `fld_postcode_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_postcode_nr` int(11) NOT NULL,
  PRIMARY KEY (`fld_postcode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wisa-db-test.tbl_postcodes: ~2 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_postcodes` DISABLE KEYS */;
INSERT INTO `tbl_postcodes` (`fld_postcode_id`, `fld_postcode_nr`) VALUES
	(1, 3000),
	(2, 1030);
/*!40000 ALTER TABLE `tbl_postcodes` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_richtingen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_richtingen` (
  `fld_richting_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_richting_afkorting` varchar(255) DEFAULT NULL,
  `fld_richting_naam` varchar(255) NOT NULL,
  `fld_richting_graad` varchar(255) NOT NULL,
  `fld_richting_leerjaar` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_richting_id`),
  KEY `fld_richting_id` (`fld_richting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_richtingen: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_richtingen` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_richtingen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_scholen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_scholen` (
  `fld_school_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_school_naam` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_school_id`),
  KEY `fld_school_id` (`fld_school_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_scholen: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_scholen` DISABLE KEYS */;
INSERT INTO `tbl_scholen` (`fld_school_id`, `fld_school_naam`) VALUES
	(1, 'Miniemeninstituut');
/*!40000 ALTER TABLE `tbl_scholen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_soorten wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_soorten` (
  `fld_soort_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_soort_naam` varchar(255) NOT NULL,
  PRIMARY KEY (`fld_soort_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_soorten: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_soorten` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_soorten` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_vragen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_vragen` (
  `fld_vraag_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_vraag_vraag` varchar(255) NOT NULL,
  `fld_vraag_kernwoord` varchar(255) DEFAULT NULL,
  `fld_antwoord_type_k_tekst` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_l_tekst` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_num` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_datum` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_j/n` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_foto` tinyint(1) DEFAULT '0',
  `fld_antwoord_type_lijst` tinyint(1) DEFAULT '0',
  `fld_bestaande_lijst_id_fk` int(11) DEFAULT NULL,
  `fld_antwoord_aantal` int(11) NOT NULL DEFAULT '1',
  `fld_vraag_antwoord_verplicht` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fld_vraag_id`),
  KEY `fld_vraag_id` (`fld_vraag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_vragen: ~5 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_vragen` DISABLE KEYS */;
INSERT INTO `tbl_vragen` (`fld_vraag_id`, `fld_vraag_vraag`, `fld_vraag_kernwoord`, `fld_antwoord_type_k_tekst`, `fld_antwoord_type_l_tekst`, `fld_antwoord_type_num`, `fld_antwoord_type_datum`, `fld_antwoord_type_j/n`, `fld_antwoord_type_foto`, `fld_antwoord_type_lijst`, `fld_bestaande_lijst_id_fk`, `fld_antwoord_aantal`, `fld_vraag_antwoord_verplicht`) VALUES
	(35, 'Voornaam', 'Voornaam', 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1),
	(37, 'Achternaam', 'Achternaam', 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1),
	(38, 'Geboortedatum', 'Geboortedatum', 0, 0, 0, 1, 0, 0, 0, NULL, 1, 0),
	(42, 'Hoe kom je naar school?', 'Vervoer', 0, 0, 0, 0, 0, 0, 1, NULL, 1, 1),
	(43, 'Welke sport doe je graag?', 'Sport', 0, 0, 0, 0, 0, 0, 1, NULL, 1, 1);
/*!40000 ALTER TABLE `tbl_vragen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_vragen_bestemmingen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_vragen_bestemmingen` (
  `fld_vraag_bestemming_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_vraag_id_fk` int(11) NOT NULL DEFAULT '0',
  `fld_bestemming_id_fk` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fld_vraag_bestemming_id`),
  KEY `fld_vraag_bestemming_id` (`fld_vraag_bestemming_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- Dumpen data van tabel wisa-db-test.tbl_vragen_bestemmingen: ~11 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_vragen_bestemmingen` DISABLE KEYS */;
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
	(61, 42, 2),
	(62, 43, 2);
/*!40000 ALTER TABLE `tbl_vragen_bestemmingen` ENABLE KEYS */;

-- Structuur van  tabel wisa-db-test.tbl_woonplaatsen wordt geschreven
CREATE TABLE IF NOT EXISTS `tbl_woonplaatsen` (
  `fld_woonplaats_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld_woonplaats_naam` varchar(55) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`fld_woonplaats_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel wisa-db-test.tbl_woonplaatsen: ~4 rows (ongeveer)
/*!40000 ALTER TABLE `tbl_woonplaatsen` DISABLE KEYS */;
INSERT INTO `tbl_woonplaatsen` (`fld_woonplaats_id`, `fld_woonplaats_naam`) VALUES
	(1, 'Leuven'),
	(2, 'Kessel-Lo'),
	(3, 'Brussel'),
	(4, 'Antwerpen');
/*!40000 ALTER TABLE `tbl_woonplaatsen` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
