-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
-- author : Sabir Amhaida
-- Host: localhost:3306
-- Generation Time: Jun 08, 2019 at 01:58 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Database: `BDD_PFA1`
--

-- --------------------------------------------------------

--
-- Table structure for table `Documentation`
--



CREATE TABLE `Documentation` (
  `id_doc` int(11) NOT NULL,
  `Rapport` varchar(100) NOT NULL,
  `id_projet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Documentation`
--

INSERT INTO `Documentation` (`id_doc`, `Rapport`, `id_projet`) VALUES
(1, 'test', 12);

-- --------------------------------------------------------

--
-- Table structure for table `Encadrant`
--

CREATE TABLE `Encadrant` (
  `cin_encad` varchar(10) NOT NULL,
  `nom_encad` varchar(20) NOT NULL,
  `prenom_encad` varchar(20) NOT NULL,
  `email_encad` varchar(100) NOT NULL,
  `mdp_encad` varchar(40) NOT NULL,
  `type_encad` varchar(3) DEFAULT 'int'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Encadrant`
--

INSERT INTO `Encadrant` (`cin_encad`, `nom_encad`, `prenom_encad`, `email_encad`, `mdp_encad`, `type_encad`) VALUES
('12131415', 'Kijri', 'Laila', 'kijri_Leila@gmail.com', 'Kijri_Laila', 'int'),
('123456', 'Ettalbi', 'Ahmed', 'ettalbi1000@gmail.com', 'Ettalbi_Ahmed', 'int'),
('13516841', 'Kriouil', 'Abdellah', 'kriouil.abdellah@gmail.com', 'Kriouil_Abdellah', 'int'),
('1513846', 'Benabdessalam', 'Rim', 'rim.benabdeslam@gmail.com', 'Rim_Benabdessalam', 'int'),
('51516688', 'Mohammed', 'Nassar', 'mohammed.nassar@gmail.comn', 'Nassar_Mohammed', 'int'),
('6516865', 'Janati', 'Mohammed Abouh', 'Janati.MA@gmail.com', 'Janati_MA', 'int'),
('7891011', 'Guermah', 'Hatim', 'Guermah_hatim@gmail.com', '5', 'int'),
('92841688', 'Ahmed', 'Mohammed', 'Ahmed.Mohammed@gmail.com', 'Ahmed_Mohammed', 'ext');

-- --------------------------------------------------------

--
-- Table structure for table `Entreprise`
--

CREATE TABLE `Entreprise` (
  `nom_entreprise` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Adresse` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Entreprise`
--

INSERT INTO `Entreprise` (`nom_entreprise`, `email`, `Adresse`) VALUES
('Ese1', 'Ese@gmail.com', 'rabat'),
('Ese2', 'Ese2@gmail.com', 'Rabat'),
('Ese3', 'Ese3@gmail.com', 'Rabat,Maroc'),
('Ese4', 'Ese4@gmail.com', 'Casa,Maroc'),
('Ese5', 'Ese@gmail.com', 'Rabat,Maroc'),
('Ese6', 'Ese6@gmail.com', 'Casa,Maroc');

-- --------------------------------------------------------

--
-- Table structure for table `Etudiant`
--

CREATE TABLE `Etudiant` (
  `cne_etud` varchar(10) NOT NULL,
  `nom_etud` varchar(30) NOT NULL,
  `prenom_etud` varchar(30) NOT NULL,
  `email_etud` varchar(100) NOT NULL,
  `mdp_etud` varchar(40) NOT NULL,
  `annee` int(11) NOT NULL,
  `id_m_b` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Etudiant`
--

INSERT INTO `Etudiant` (`cne_etud`, `nom_etud`, `prenom_etud`, `email_etud`, `mdp_etud`, `annee`, `id_m_b`) VALUES
('1015781', 'Ouokki', 'Mohamed', 'ouokkimohamed@gmail.com', 'Mohamed_Ouokki', 1, 1),
('14182336', 'Amhaida', 'Sabir', 'sabiramhaida91@gmail.com', 'Sabir_Amhaida', 1, 2),
('1561835', 'Housni', 'Abdellatif', 'housn.abdellatif@gmail.com', 'Abdelaltif_Housni', 3, 9),
('1588771', 'Abdelouhab', 'Mohammed', 'abdelouhabmohammed15@gmail.com', 'Mohammed_Abdelouhab', 1, 1),
('1715692', 'SAOUDI', 'MEHDI', 'mehdisaoudi270@gmail.com', 'Mehdi_Saoudi', 1, 3),
('171819', 'Hadfi', 'Abdelmoumen', 'hadfi@gmail.com', '171819', 2, 7),
('1797841', 'EL MAHDI ', 'ZOUHAIR', 'elmahdi2zouhair@gmail.com', 'Zouhayr_ElMahdi', 1, 4),
('2', 'Bairouf', 'Redouane', 'red1bairouf@gmail.com', 'Redouane_Bairouf', 1, 3),
('48479798', 'Hafdi', 'Ahmed', 'ok@gmail.com', '5', 3, 7),
('6', 'NASRALLAH', 'Meriem ', 'nasrallah.mery@gmail.com ', 'Meriem_Nasrallah', 1, 5),
('7', 'Daoui', 'Khaoula', 'khaouladaoui16@gmail.com', 'Khaoula_Daoui', 1, 4),
('7798875', 'DADDA', 'Ziyad', 'ziyad.dadda.dossier@gmail.com', 'Ziyad_Dadda', 1, 5),
('78987', 'Ahmed', 'Ayoubi', 'ayoubi@gm.com', '55', 2, 8),
('86416', 'Makram', 'Ahmed', 'Makram.Ahmed@gmail.com', 'Makram_Ahmed', 2, 8),
('877914', 'Khouya', 'Oussama', 'khouya2604@gmail.com', 'Oussama_Khouya', 1, 6),
('971456', 'Ziane ', 'Mohammed', 'mohammedziane85@gmail.com', 'Mohammed_Ziane', 1, 6),
('R131243738', 'Amrani', 'Yassine', 'yassineamrani268@gmail.com', 'Yassine_Amrani', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Jury`
--

CREATE TABLE `Jury` (
  `cin_jury` varchar(10) NOT NULL,
  `nom_jury` varchar(20) NOT NULL,
  `prenom_jury` varchar(20) NOT NULL,
  `mdp_jury` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Jury`
--

INSERT INTO `Jury` (`cin_jury`, `nom_jury`, `prenom_jury`, `mdp_jury`) VALUES
('123456', 'Ettalbi', 'Ahmed', '55'),
('1513846', 'Benabdessalam', 'Rim', 'Rim_Benabdessalam'),
('16516', 'Kriouil', 'Abdellah', '55'),
('2468', 'Salah', 'Baina', '55'),
('369', 'Karim', 'Baina', '55'),
('6516865', 'Janati', 'Mohammed Abdou', 'Janati_MA');

-- --------------------------------------------------------

--
-- Table structure for table `monome_binome`
--

CREATE TABLE `monome_binome` (
  `id_m_b` int(11) NOT NULL,
  `type` varchar(4) NOT NULL,
  `id_projet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `monome_binome`
--

INSERT INTO `monome_binome` (`id_m_b`, `type`, `id_projet`) VALUES
(1, 'b', NULL),
(2, 'b', NULL),
(3, 'b', NULL),
(4, 'b', NULL),
(5, 'b', NULL),
(6, 'b', NULL),
(7, 'b', NULL),
(8, 'b', NULL),
(9, 'm', 19);

-- --------------------------------------------------------

--
-- Table structure for table `Notifications`
--

CREATE TABLE `Notifications` (
  `id_notif` int(11) NOT NULL,
  `Nom_destinateur` varchar(20) NOT NULL,
  `id_destinateur` varchar(10) DEFAULT NULL,
  `id_destinataire` varchar(10) NOT NULL,
  `Objet` varchar(300) NOT NULL,
  `msg_notif` varchar(355) NOT NULL,
  `statut_notif` int(1) NOT NULL DEFAULT '0',
  `datetime_notif` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `intitule_sujet` varchar(100) NOT NULL,
  `desciption` text,
  `annee_projet` int(11) NOT NULL DEFAULT '2019',
  `Type_projet` varchar(4) NOT NULL,
  `id_m_b` int(11) DEFAULT NULL,
  `nom_entreprise` varchar(20) DEFAULT NULL,
  `cin_encad` varchar(10) NOT NULL,
  `cin_jury` varchar(10) DEFAULT NULL,
  `id_soutenance` int(11) DEFAULT NULL,
  `note` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projet`
--

INSERT INTO `projet` (`id_projet`, `intitule_sujet`, `desciption`, `annee_projet`, `Type_projet`, `id_m_b`, `nom_entreprise`, `cin_encad`, `cin_jury`, `id_soutenance`, `note`) VALUES
(5, 'Conception et réalisation d’un site d’offres Discount', 'Description', 2019, 'PFA1', NULL, NULL, '12131415', NULL, NULL, NULL),
(6, 'Etude et réalisation d’une application de gestion des entretiens d’embauche dans une entreprise', 'Description', 2019, 'pfa1', NULL, NULL, '12131415', NULL, NULL, NULL),
(12, 'Gestion des projets des étudiants dans une école.', 'Description', 2019, 'pfa1', NULL, NULL, '123456', NULL, NULL, NULL),
(14, 'Application Web de suivi de maladie du cerveau chez un patient', 'Description', 2019, 'pfa2', NULL, NULL, '123456', NULL, NULL, NULL),
(15, 'Application mobile de gestion des Hopitaux', 'Description', 2019, 'pfa2', NULL, NULL, '7891011', NULL, NULL, NULL),
(19, 'Application Mobile pour le suivi des horaires de transports publiques.', 'Description', 2019, 'PFE', NULL, 'Ese3', '92841688', NULL, NULL, NULL),
(21, 'Application de gestion des information de la bourse', NULL, 2019, 'pfa2', NULL, NULL, '1513846', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Rendez_vous`
--

CREATE TABLE `Rendez_vous` (
  `id_rv` int(11) NOT NULL,
  `date_rv` date NOT NULL,
  `travail_a_faire` varchar(100) NOT NULL,
  `chemin_compte_rendu` varchar(40) DEFAULT NULL,
  `horaire_rv` time NOT NULL,
  `raison_report` varchar(355) DEFAULT NULL,
  `seconde_horaire` time DEFAULT NULL,
  `id_projet` int(11) NOT NULL,
  `seconde_date` date DEFAULT NULL,
  `statut_rv` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Rendez_vous`
--

INSERT INTO `Rendez_vous` (`id_rv`, `date_rv`, `travail_a_faire`, `chemin_compte_rendu`, `horaire_rv`, `raison_report`, `seconde_horaire`, `id_projet`, `seconde_date`, `statut_rv`) VALUES
(2, '2019-05-22', 'cdc', 'ok', '10:30:00', NULL, NULL, 6, NULL, 0),
(3, '2019-05-23', 'test', 'ok', '11:00:00', NULL, NULL, 12, NULL, 1),
(4, '2019-05-24', 'plan', 'ok', '09:30:00', NULL, NULL, 15, NULL, 0),
(5, '2019-05-24', 'plan', NULL, '14:30:00', NULL, NULL, 14, NULL, 1),
(7, '2019-05-24', 'chapitre', NULL, '09:00:00', 'ddddddd', '17:18:00', 12, '2019-05-27', 1),
(8, '2019-05-28', 'chaoitre', NULL, '18:18:00', NULL, NULL, 12, NULL, 1),
(9, '2019-06-27', 'cdc', NULL, '00:00:00', NULL, NULL, 12, NULL, 1),
(10, '2019-06-30', '18', NULL, '18:18:00', '00', '00:00:00', 12, '2019-06-18', 1),
(11, '2019-05-27', 'Chapitre1 et 2 du rapport', 'PresentationText.pdf', '09:00:00', NULL, NULL, 12, NULL, 1),
(12, '2019-05-28', 'cdc', 'PresentationText.pdf', '10:30:00', 'raison.', '10:10:00', 12, '2019-05-29', 1),
(13, '2019-05-23', 'MCD, MLD', NULL, '09:00:00', NULL, NULL, 14, NULL, 0),
(14, '2019-04-15', 'cdc', 'ok', '00:00:00', NULL, NULL, 19, NULL, 1),
(15, '2019-05-26', 'plan', 'ok', '11:00:00', NULL, NULL, 14, NULL, 1),
(16, '2019-05-28', 'modelisation', NULL, '12:21:00', NULL, NULL, 19, NULL, 0),
(17, '2019-05-28', 'modelisation', 'ok', '16:00:00', NULL, NULL, 14, NULL, 1),
(18, '2019-05-06', 'mcd', 'PresentationText.pdf', '09:30:00', NULL, NULL, 12, NULL, 1),
(19, '2019-05-31', 'mLD', NULL, '11:30:00', NULL, NULL, 12, NULL, 1),
(20, '2019-05-30', 'cdc', NULL, '09:00:00', NULL, NULL, 12, NULL, 1),
(21, '2019-05-31', 'mcd', NULL, '11:30:00', NULL, NULL, 12, NULL, 1),
(22, '2019-05-30', 'mLD', NULL, '09:00:00', NULL, NULL, 12, NULL, 1),
(23, '2019-05-30', 'mld', NULL, '13:00:00', NULL, NULL, 12, NULL, 0),
(24, '2019-05-30', 'mcd', 'basics.pdf', '09:00:00', NULL, NULL, 12, NULL, 1),
(25, '2019-05-30', 'mld', NULL, '12:00:00', NULL, NULL, 12, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salle_soutenance`
--

CREATE TABLE `salle_soutenance` (
  `num_salle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salle_soutenance`
--

INSERT INTO `salle_soutenance` (`num_salle`) VALUES
('L20'),
('L21'),
('L22'),
('L23'),
('L24'),
('L25'),
('L26'),
('L27'),
('L28'),
('L29'),
('L30');

-- --------------------------------------------------------

--
-- Table structure for table `soutenance`
--

CREATE TABLE `soutenance` (
  `id_soutenance` int(11) NOT NULL,
  `date_soutenance` date NOT NULL,
  `horaire_soutenance` varchar(5) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `num_salle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `soutenance`
--

INSERT INTO `soutenance` (`id_soutenance`, `date_soutenance`, `horaire_soutenance`, `id_projet`, `num_salle`) VALUES
(49, '2019-05-06', '9:30', 14, 'L21'),
(50, '2019-05-07', '14:30', 15, 'L25'),
(51, '2019-05-28', '10:30', 21, 'L27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Documentation`
--
ALTER TABLE `Documentation`
  ADD PRIMARY KEY (`id_doc`),
  ADD KEY `document_projet_FK` (`id_projet`);

--
-- Indexes for table `Encadrant`
--
ALTER TABLE `Encadrant`
  ADD PRIMARY KEY (`cin_encad`);

--
-- Indexes for table `Entreprise`
--
ALTER TABLE `Entreprise`
  ADD PRIMARY KEY (`nom_entreprise`);

--
-- Indexes for table `Etudiant`
--
ALTER TABLE `Etudiant`
  ADD PRIMARY KEY (`cne_etud`),
  ADD KEY `Etudiant_monome_binome0_FK` (`id_m_b`);

--
-- Indexes for table `Jury`
--
ALTER TABLE `Jury`
  ADD PRIMARY KEY (`cin_jury`);

--
-- Indexes for table `monome_binome`
--
ALTER TABLE `monome_binome`
  ADD PRIMARY KEY (`id_m_b`),
  ADD KEY `binome_projet_FK` (`id_projet`);

--
-- Indexes for table `Notifications`
--
ALTER TABLE `Notifications`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`),
  ADD UNIQUE KEY `UC_binome_proj2` (`id_m_b`),
  ADD KEY `projet_Entreprise1_FK` (`nom_entreprise`),
  ADD KEY `projet_Encadrant2_FK` (`cin_encad`),
  ADD KEY `projet_Jury3_FK` (`cin_jury`),
  ADD KEY `projet_soutenance4_FK` (`id_soutenance`);

--
-- Indexes for table `Rendez_vous`
--
ALTER TABLE `Rendez_vous`
  ADD PRIMARY KEY (`id_rv`),
  ADD KEY `Rendez_vous_projet_FK` (`id_projet`);

--
-- Indexes for table `salle_soutenance`
--
ALTER TABLE `salle_soutenance`
  ADD PRIMARY KEY (`num_salle`);

--
-- Indexes for table `soutenance`
--
ALTER TABLE `soutenance`
  ADD PRIMARY KEY (`id_soutenance`),
  ADD UNIQUE KEY `key_sout` (`horaire_soutenance`,`date_soutenance`,`num_salle`),
  ADD KEY `Soutenance_projet_FK0` (`id_projet`),
  ADD KEY `Soutenance_salle_FK1` (`num_salle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Documentation`
--
ALTER TABLE `Documentation`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `monome_binome`
--
ALTER TABLE `monome_binome`
  MODIFY `id_m_b` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `Notifications`
--
ALTER TABLE `Notifications`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `Rendez_vous`
--
ALTER TABLE `Rendez_vous`
  MODIFY `id_rv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `soutenance`
--
ALTER TABLE `soutenance`
  MODIFY `id_soutenance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Documentation`
--
ALTER TABLE `Documentation`
  ADD CONSTRAINT `document_projet_FK` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`);

--
-- Constraints for table `Etudiant`
--
ALTER TABLE `Etudiant`
  ADD CONSTRAINT `Etudiant_monome_binome0_FK` FOREIGN KEY (`id_m_b`) REFERENCES `monome_binome` (`id_m_b`);

--
-- Constraints for table `monome_binome`
--
ALTER TABLE `monome_binome`
  ADD CONSTRAINT `binome_projet_FK` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`);

--
-- Constraints for table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `projet_Encadrant2_FK` FOREIGN KEY (`cin_encad`) REFERENCES `Encadrant` (`cin_encad`),
  ADD CONSTRAINT `projet_Entreprise1_FK` FOREIGN KEY (`nom_entreprise`) REFERENCES `Entreprise` (`nom_entreprise`),
  ADD CONSTRAINT `projet_Jury3_FK` FOREIGN KEY (`cin_jury`) REFERENCES `Jury` (`cin_jury`),
  ADD CONSTRAINT `projet_monome_binome0_FK` FOREIGN KEY (`id_m_b`) REFERENCES `monome_binome` (`id_m_b`),
  ADD CONSTRAINT `projet_soutenance4_FK` FOREIGN KEY (`id_soutenance`) REFERENCES `soutenance` (`id_soutenance`);

--
-- Constraints for table `Rendez_vous`
--
ALTER TABLE `Rendez_vous`
  ADD CONSTRAINT `Rendez_vous_projet_FK` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`);

--
-- Constraints for table `soutenance`
--
ALTER TABLE `soutenance`
  ADD CONSTRAINT `Soutenance_projet_FK0` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`),
  ADD CONSTRAINT `Soutenance_salle_FK1` FOREIGN KEY (`num_salle`) REFERENCES `salle_soutenance` (`num_salle`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
