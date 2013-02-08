-- ----------------------
-- dump de la base elimu au 07-Mar-2013
-- ----------------------


-- -----------------------------
-- creation de la table absence_eleve
-- -----------------------------
CREATE TABLE `absence_eleve` (
  `personnel` varchar(50) NOT NULL DEFAULT '',
  `date_debut` date NOT NULL DEFAULT '0000-00-00',
  `horaire_debut` time NOT NULL DEFAULT '00:00:00',
  `horaire_fin` time NOT NULL DEFAULT '00:00:00',
  `date_fin` date NOT NULL DEFAULT '0000-00-00',
  `motif` varchar(100) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table absence_personnel
-- -----------------------------
CREATE TABLE `absence_personnel` (
  `personnel` varchar(50) NOT NULL DEFAULT '',
  `date_debut` date NOT NULL DEFAULT '0000-00-00',
  `horaire_debut` time NOT NULL DEFAULT '00:00:00',
  `horaire_fin` time NOT NULL DEFAULT '00:00:00',
  `date_fin` date NOT NULL DEFAULT '0000-00-00',
  `motif` varchar(100) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table administrateurs
-- -----------------------------
CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Login1` varchar(20) NOT NULL DEFAULT '',
  `Mot_de_Passe7` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table apreciation_prof
-- -----------------------------
CREATE TABLE `apreciation_prof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eleve` varchar(50) NOT NULL DEFAULT '',
  `libelle` varchar(50) NOT NULL DEFAULT '',
  `discipline` varchar(50) NOT NULL DEFAULT '',
  `annee` varchar(14) NOT NULL DEFAULT '',
  `semestre` varchar(12) NOT NULL DEFAULT '',
  `personnel` varchar(50) NOT NULL DEFAULT '',
  `th` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table apreciations
-- -----------------------------
CREATE TABLE `apreciations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle1` varchar(50) NOT NULL DEFAULT '',
  `mini` varchar(11) NOT NULL DEFAULT '0',
  `maxi` varchar(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle` (`libelle1`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table cahier_absence
-- -----------------------------
CREATE TABLE `cahier_absence` (
  `eleve` varchar(50) NOT NULL DEFAULT '',
  `datejour` date NOT NULL DEFAULT '0000-00-00',
  `emploi` varchar(50) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  `semestre` varchar(20) NOT NULL DEFAULT '',
  `nature` varchar(50) NOT NULL COMMENT 'EVALUATION OU COURS',
  PRIMARY KEY (`eleve`,`datejour`,`emploi`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table cahier_retard
-- -----------------------------
CREATE TABLE `cahier_retard` (
  `eleve` varchar(50) NOT NULL DEFAULT '',
  `datejour` date NOT NULL DEFAULT '0000-00-00',
  `arrivee` time NOT NULL DEFAULT '00:00:00',
  `emploi` varchar(50) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  `semestre` varchar(20) NOT NULL DEFAULT '',
  `personnel` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`eleve`,`datejour`,`emploi`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table categories
-- -----------------------------
CREATE TABLE `categories` (
  `cycle` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`cycle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table classe_superieur
-- -----------------------------
CREATE TABLE `classe_superieur` (
  `classeinf` varchar(100) NOT NULL DEFAULT '',
  `classesup` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`classeinf`,`classesup`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table classes
-- -----------------------------
CREATE TABLE `classes` (
  `idclasse` int(11) NOT NULL AUTO_INCREMENT,
  `etude` varchar(50) NOT NULL DEFAULT '',
  `numero` varchar(50) DEFAULT NULL,
  `libelle` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`idclasse`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table coefficients
-- -----------------------------
CREATE TABLE `coefficients` (
  `idcoef` int(50) NOT NULL AUTO_INCREMENT,
  `coef` varchar(10) NOT NULL,
  `discipline` varchar(20) NOT NULL,
  `etude` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`idcoef`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table conduite
-- -----------------------------
CREATE TABLE `conduite` (
  `cycle` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table connecter
-- -----------------------------
CREATE TABLE `connecter` (
  `personnel` varchar(50) NOT NULL DEFAULT '',
  `date_connect` date NOT NULL DEFAULT '0000-00-00',
  `profile` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table corps5
-- -----------------------------
CREATE TABLE `corps5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle1` varchar(35) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table cours
-- -----------------------------
CREATE TABLE `cours` (
  `classe` varchar(50) NOT NULL DEFAULT '',
  `emploi` varchar(50) NOT NULL DEFAULT '',
  `datejour` date NOT NULL DEFAULT '0000-00-00',
  `titre` varchar(150) NOT NULL DEFAULT '',
  `cahier_texte` blob NOT NULL,
  `annee` varchar(12) NOT NULL DEFAULT '',
  `semestre` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table credit_horaire
-- -----------------------------
CREATE TABLE `credit_horaire` (
  `idch` int(11) NOT NULL AUTO_INCREMENT,
  `discipline` varchar(100) NOT NULL DEFAULT '',
  `credit_horaire` varchar(11) NOT NULL DEFAULT '0',
  `nbre_lesson` varchar(11) NOT NULL DEFAULT '0',
  `etude` varchar(50) NOT NULL DEFAULT '',
  `nature` int(11) NOT NULL,
  PRIMARY KEY (`idch`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table decisions
-- -----------------------------
CREATE TABLE `decisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL DEFAULT '',
  `mini` float NOT NULL DEFAULT '0',
  `maxi` float NOT NULL DEFAULT '0',
  `etude` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table disciplines
-- -----------------------------
CREATE TABLE `disciplines` (
  `iddis` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(55) NOT NULL,
  `cycle` varchar(20) NOT NULL,
  PRIMARY KEY (`iddis`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table echelons5
-- -----------------------------
CREATE TABLE `echelons5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle1` varchar(35) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table eleves
-- -----------------------------
CREATE TABLE `eleves` (
  `matricule` varchar(15) NOT NULL DEFAULT '',
  `prenom8` varchar(50) NOT NULL DEFAULT '',
  `nom8` varchar(50) NOT NULL DEFAULT '',
  `sexe8` varchar(20) NOT NULL DEFAULT '',
  `date_nais8` date NOT NULL DEFAULT '0000-00-00',
  `lieu_nais8` varchar(100) NOT NULL DEFAULT '',
  `tuteur8` varchar(100) NOT NULL DEFAULT '',
  `email_tuteur8` varchar(50) NOT NULL DEFAULT '',
  `tel_tuteur8` varchar(20) NOT NULL DEFAULT '',
  `tel_eleve8` varchar(20) NOT NULL DEFAULT '',
  `email_eleve8` varchar(50) NOT NULL DEFAULT '',
  `adresse8` varchar(100) DEFAULT NULL,
  `photo8` varchar(100) DEFAULT NULL,
  `enable8` varchar(20) NOT NULL DEFAULT 'true',
  PRIMARY KEY (`matricule`),
  KEY `tel_eleve` (`tel_eleve8`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table emploi_temps
-- -----------------------------
CREATE TABLE `emploi_temps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` int(50) NOT NULL DEFAULT '0',
  `debut` time NOT NULL DEFAULT '00:00:00',
  `fin` time NOT NULL DEFAULT '00:00:00',
  `discipline` varchar(50) NOT NULL DEFAULT '',
  `professeur` varchar(50) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  `salle` varchar(20) NOT NULL DEFAULT '',
  `semestre` varchar(20) NOT NULL DEFAULT '',
  `classe` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table enable5
-- -----------------------------
CREATE TABLE `enable5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table enseignant
-- -----------------------------
CREATE TABLE `enseignant` (
  `personnel` varchar(50) NOT NULL DEFAULT '',
  `classe` varchar(50) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`classe`,`personnel`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table enseigner
-- -----------------------------
CREATE TABLE `enseigner` (
  `personnel` varchar(50) NOT NULL DEFAULT '',
  `classe` varchar(50) NOT NULL DEFAULT '',
  `discipline` varchar(50) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`classe`,`discipline`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table etablissements
-- -----------------------------
CREATE TABLE `etablissements` (
  `ia` varchar(75) NOT NULL DEFAULT '',
  `iden` varchar(75) NOT NULL DEFAULT '',
  `libelle` varchar(100) NOT NULL DEFAULT '',
  `logo` tinytext NOT NULL,
  `slogan` varchar(100) NOT NULL DEFAULT 'EXCELLENCE',
  `date_ouverture` varchar(10) NOT NULL DEFAULT '0000-00-00',
  `adresse` varchar(100) NOT NULL DEFAULT '',
  `tel` varchar(100) NOT NULL DEFAULT '',
  `bp` varchar(10) NOT NULL DEFAULT '',
  `web` varchar(100) DEFAULT NULL,
  `faxe` varchar(20) NOT NULL DEFAULT '',
  `mail` varchar(100) NOT NULL DEFAULT '',
  `status` varchar(30) NOT NULL DEFAULT '',
  `date_installe` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`libelle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table etudes
-- -----------------------------
CREATE TABLE `etudes` (
  `idetude` int(11) NOT NULL AUTO_INCREMENT,
  `niveau` varchar(75) NOT NULL DEFAULT '',
  `serie` char(3) NOT NULL DEFAULT '',
  `libelle` varchar(75) NOT NULL DEFAULT '',
  `cycle` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`idetude`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table evaluations
-- -----------------------------
CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_prevue` date NOT NULL DEFAULT '0000-00-00',
  `heure_debut` time NOT NULL DEFAULT '00:00:00',
  `heure_fin` time NOT NULL DEFAULT '00:00:00',
  `discipline` varchar(50) NOT NULL DEFAULT '',
  `classe` varchar(20) NOT NULL DEFAULT '',
  `type` varchar(25) NOT NULL DEFAULT '',
  `semestre` varchar(10) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  `salle` varchar(50) NOT NULL DEFAULT '',
  `personnel` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table filieres
-- -----------------------------
CREATE TABLE `filieres` (
  `sigle1` varchar(10) NOT NULL DEFAULT '',
  `libelle1` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`sigle1`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table fonction
-- -----------------------------
CREATE TABLE `fonction` (
  `personnel` varchar(50) NOT NULL DEFAULT '',
  `profile` varchar(50) NOT NULL DEFAULT '',
  `cycle` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`personnel`,`profile`,`cycle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table formules
-- -----------------------------
CREATE TABLE `formules` (
  `libelle` varchar(100) NOT NULL DEFAULT '',
  `valeur` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table grades5
-- -----------------------------
CREATE TABLE `grades5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle1` varchar(35) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table honneurs
-- -----------------------------
CREATE TABLE `honneurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle1` varchar(50) NOT NULL DEFAULT '',
  `mini` decimal(11,0) NOT NULL DEFAULT '0',
  `maxi` decimal(11,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle1` (`libelle1`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table horaires
-- -----------------------------
CREATE TABLE `horaires` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `debut` time NOT NULL DEFAULT '00:00:00',
  `fin` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table inscription
-- -----------------------------
CREATE TABLE `inscription` (
  `eleve` varchar(15) NOT NULL DEFAULT '',
  `classe` varchar(15) NOT NULL DEFAULT '',
  `redoublant` char(3) NOT NULL DEFAULT '',
  `date_inscription` date NOT NULL DEFAULT '0000-00-00',
  `annee` varchar(12) NOT NULL DEFAULT '',
  `agent` varchar(50) NOT NULL DEFAULT '',
  `lv1` int(11) NOT NULL,
  `lv2` int(11) NOT NULL,
  `lc` int(11) NOT NULL,
  PRIMARY KEY (`eleve`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table jours
-- -----------------------------
CREATE TABLE `jours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table matrimonial5
-- -----------------------------
CREATE TABLE `matrimonial5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table modulaire
-- -----------------------------
CREATE TABLE `modulaire` (
  `module` varchar(100) NOT NULL DEFAULT '',
  `discipline` varchar(100) NOT NULL DEFAULT '',
  `etude` varchar(50) NOT NULL DEFAULT '',
  `notesup` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table modules
-- -----------------------------
CREATE TABLE `modules` (
  `libelle` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`libelle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table moyennediscipline
-- -----------------------------
CREATE TABLE `moyennediscipline` (
  `eleve` varchar(20) NOT NULL,
  `discipline` varchar(11) NOT NULL,
  `note` decimal(6,3) NOT NULL,
  `semestre` varchar(10) NOT NULL,
  `annee` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table moyennes
-- -----------------------------
CREATE TABLE `moyennes` (
  `eleve` varchar(50) NOT NULL DEFAULT '',
  `moyenne` double NOT NULL DEFAULT '0',
  `semestre` varchar(10) NOT NULL DEFAULT '0',
  `annee` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`eleve`,`moyenne`,`semestre`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table nature
-- -----------------------------
CREATE TABLE `nature` (
  `idnature` int(11) NOT NULL AUTO_INCREMENT,
  `nature` varchar(50) NOT NULL,
  PRIMARY KEY (`idnature`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table note_conduite
-- -----------------------------
CREATE TABLE `note_conduite` (
  `eleve` varchar(50) NOT NULL DEFAULT '',
  `note` varchar(12) NOT NULL DEFAULT '',
  `semestre` varchar(12) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `personnel` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table notes
-- -----------------------------
CREATE TABLE `notes` (
  `eleve` varchar(20) NOT NULL DEFAULT '',
  `note` varchar(6) NOT NULL DEFAULT '0.000',
  `evaluation` varchar(20) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table passer
-- -----------------------------
CREATE TABLE `passer` (
  `eleve` varchar(50) NOT NULL DEFAULT '',
  `proposition` varchar(50) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`eleve`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table periodes
-- -----------------------------
CREATE TABLE `periodes` (
  `numero` varchar(11) NOT NULL DEFAULT '',
  `mois` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`numero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table personnels
-- -----------------------------
CREATE TABLE `personnels` (
  `matricule` varchar(15) NOT NULL DEFAULT '0',
  `titre8` varchar(10) NOT NULL DEFAULT '',
  `prenom` varchar(50) NOT NULL DEFAULT '',
  `nom` varchar(50) NOT NULL DEFAULT '',
  `matrimonial8` varchar(12) NOT NULL DEFAULT '',
  `sexe8` varchar(15) NOT NULL DEFAULT '',
  `date_nais8` varchar(12) NOT NULL DEFAULT '0000-00-00',
  `lieu_nais8` varchar(50) NOT NULL DEFAULT '',
  `tel` varchar(15) NOT NULL DEFAULT '',
  `adresse` varchar(75) NOT NULL DEFAULT '',
  `email8` varchar(50) NOT NULL DEFAULT '',
  `photo8` varchar(50) NOT NULL DEFAULT '',
  `enable8` varchar(20) NOT NULL DEFAULT 'true',
  `corps5` varchar(20) NOT NULL DEFAULT '',
  `grades5` varchar(20) NOT NULL DEFAULT '',
  `echelons5` varchar(20) NOT NULL DEFAULT '',
  `date_entre8` varchar(11) NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`matricule`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table profiles
-- -----------------------------
CREATE TABLE `profiles` (
  `libelle` varchar(100) NOT NULL DEFAULT '',
  `cycle` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`libelle`,`cycle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table programmes
-- -----------------------------
CREATE TABLE `programmes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discipline` varchar(12) NOT NULL DEFAULT '',
  `num_ch` varchar(10) NOT NULL DEFAULT '',
  `chapitre` varchar(100) NOT NULL DEFAULT '',
  `num_l` varchar(10) NOT NULL DEFAULT '',
  `lesson` varchar(100) NOT NULL DEFAULT '',
  `duree` varchar(10) NOT NULL DEFAULT '',
  `etude` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table remarques
-- -----------------------------
CREATE TABLE `remarques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle1` varchar(50) NOT NULL DEFAULT '',
  `mini` decimal(11,0) NOT NULL DEFAULT '0',
  `maxi` decimal(11,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle` (`libelle1`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table retard
-- -----------------------------
CREATE TABLE `retard` (
  `eleve` varchar(50) NOT NULL DEFAULT '',
  `horaire` varchar(50) NOT NULL DEFAULT '',
  `datejour` date NOT NULL DEFAULT '0000-00-00',
  `enseigner` varchar(50) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`eleve`,`horaire`,`datejour`,`enseigner`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table salles
-- -----------------------------
CREATE TABLE `salles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle1` varchar(50) NOT NULL DEFAULT '',
  `capacite` varchar(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `libelle` (`libelle1`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table semestres
-- -----------------------------
CREATE TABLE `semestres` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `libelle` varchar(50) NOT NULL DEFAULT '',
  `date_debut` date NOT NULL DEFAULT '0000-00-00',
  `date_fin` date NOT NULL DEFAULT '0000-00-00',
  `cycle` varchar(50) NOT NULL DEFAULT '',
  `annee` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table series
-- -----------------------------
CREATE TABLE `series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle1` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table sexe5
-- -----------------------------
CREATE TABLE `sexe5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table sous_matiere
-- -----------------------------
CREATE TABLE `sous_matiere` (
  `idsm` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `discipline` int(11) NOT NULL,
  PRIMARY KEY (`idsm`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table specialites
-- -----------------------------
CREATE TABLE `specialites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `professeur` varchar(50) NOT NULL DEFAULT '',
  `discipline` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table surveiller
-- -----------------------------
CREATE TABLE `surveiller` (
  `personnel` varchar(50) NOT NULL DEFAULT '',
  `classe` varchar(50) NOT NULL DEFAULT '',
  `annee` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`personnel`,`classe`,`annee`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table tableau_prof
-- -----------------------------
CREATE TABLE `tableau_prof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programme` varchar(20) NOT NULL DEFAULT '',
  `classe` varchar(20) NOT NULL DEFAULT '',
  `duree` varchar(20) NOT NULL DEFAULT '',
  `debut` date NOT NULL DEFAULT '0000-00-00',
  `fin` date NOT NULL DEFAULT '0000-00-00',
  `personnel` varchar(20) NOT NULL DEFAULT '',
  `annee` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table titre5
-- -----------------------------
CREATE TABLE `titre5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table user
-- -----------------------------
CREATE TABLE `user` (
  `cdeetud` varchar(50) NOT NULL DEFAULT '0',
  `login1` varchar(10) NOT NULL DEFAULT '',
  `motdepasse7` varchar(10) NOT NULL DEFAULT '',
  `profile5` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`cdeetud`,`profile5`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



-- -----------------------------
-- insertions dans la table absence_eleve
-- -----------------------------

-- -----------------------------
-- insertions dans la table absence_personnel
-- -----------------------------

-- -----------------------------
-- insertions dans la table administrateurs
-- -----------------------------
INSERT INTO administrateurs VALUES(1, 'safia', 'safia');

-- -----------------------------
-- insertions dans la table apreciation_prof
-- -----------------------------
INSERT INTO apreciation_prof VALUES(30, '12457/OP', 'EXCELLENT TRAVAIL A ENCOURAGER', '28D', '2012/2013', 'S1', '1427-bn', '+');
INSERT INTO apreciation_prof VALUES(31, '12457/OP', 'BON TRAVAIL', '22D1', '2012/2013', 'S1', '1427-bn', '+');
INSERT INTO apreciation_prof VALUES(32, '12457/OP', 'BON TRAVAIL', '22D2', '2012/2013', 'S1', '1427-bn', '+');
INSERT INTO apreciation_prof VALUES(33, '12457/OP', 'BON TRAVAIL', '32D', '2012/2013', 'S2', '654-op', '+');
INSERT INTO apreciation_prof VALUES(34, '12457/OP', 'EXCELLENT TRAVAIL', '26D', '2012/2013', 'S2', '654-op', '+');
INSERT INTO apreciation_prof VALUES(35, '12457/OP', 'EXCELLENT TRAVAIL', '28D', '2012/2013', 'S2', '1427-bn', '+');
INSERT INTO apreciation_prof VALUES(36, '12457/OP', 'BON TRAVAIL', '22D1', '2012/2013', 'S2', '1427-bn', '+');
INSERT INTO apreciation_prof VALUES(38, '12457/OP', 'BON TRAVAIL', '22D3', '2012/2013', 'S2', '1427-bn', '+');

-- -----------------------------
-- insertions dans la table apreciations
-- -----------------------------
INSERT INTO apreciations VALUES(1, 'EXCELLENT TRAVAIL', '18', '21');
INSERT INTO apreciations VALUES(2, 'BON TRAVAIL', '15', '18');
INSERT INTO apreciations VALUES(3, 'ASSEZ BIEN', '12', '14');
INSERT INTO apreciations VALUES(4, 'MOYEN', '10', '12');

-- -----------------------------
-- insertions dans la table cahier_absence
-- -----------------------------

-- -----------------------------
-- insertions dans la table cahier_retard
-- -----------------------------

-- -----------------------------
-- insertions dans la table categories
-- -----------------------------
INSERT INTO categories VALUES('ELEMENTAIRE');
INSERT INTO categories VALUES('MOYEN');
INSERT INTO categories VALUES('PRESCOLAIRE');
INSERT INTO categories VALUES('SECONDAIRE');

-- -----------------------------
-- insertions dans la table classe_superieur
-- -----------------------------

-- -----------------------------
-- insertions dans la table classes
-- -----------------------------
INSERT INTO classes VALUES(80, '16', '', '6i&eacute;me');
INSERT INTO classes VALUES(81, '17', '', '5i&eacute;me');
INSERT INTO classes VALUES(82, '18', '', '4i&eacute;me');
INSERT INTO classes VALUES(83, '19', 'A', '3i&eacute;meA');
INSERT INTO classes VALUES(84, '19', 'B', '3i&eacute;meB');
INSERT INTO classes VALUES(121, '20', '', '1erL`1');
INSERT INTO classes VALUES(120, '21', '', 'TleL`1');

-- -----------------------------
-- insertions dans la table coefficients
-- -----------------------------
INSERT INTO coefficients VALUES(1, '2', '22D1', '16');
INSERT INTO coefficients VALUES(2, '2', '22D1', '17');
INSERT INTO coefficients VALUES(3, '2', '22D1', '18');
INSERT INTO coefficients VALUES(4, '2', '22D1', '19');
INSERT INTO coefficients VALUES(5, '2', '22D2', '16');
INSERT INTO coefficients VALUES(6, '2', '22D2', '17');
INSERT INTO coefficients VALUES(7, '2', '22D2', '18');
INSERT INTO coefficients VALUES(8, '2', '22D2', '19');
INSERT INTO coefficients VALUES(9, '2', '22D3', '16');
INSERT INTO coefficients VALUES(10, '2', '22D3', '17');
INSERT INTO coefficients VALUES(11, '2', '22D3', '18');
INSERT INTO coefficients VALUES(12, '2', '22D3', '19');
INSERT INTO coefficients VALUES(13, '2', '28D', '16');
INSERT INTO coefficients VALUES(14, '2', '28D', '17');
INSERT INTO coefficients VALUES(15, '2', '28D', '18');
INSERT INTO coefficients VALUES(16, '2', '28D', '19');
INSERT INTO coefficients VALUES(17, '2', '34D', '19');
INSERT INTO coefficients VALUES(18, '2', '34D', '18');
INSERT INTO coefficients VALUES(19, '2', '30D', '16');
INSERT INTO coefficients VALUES(20, '2', '30D', '17');
INSERT INTO coefficients VALUES(21, '2', '30D', '18');
INSERT INTO coefficients VALUES(22, '2', '30D', '19');
INSERT INTO coefficients VALUES(23, '2', '24D', '18');
INSERT INTO coefficients VALUES(24, '2', '24D', '19');
INSERT INTO coefficients VALUES(25, '4', '26D', '16');
INSERT INTO coefficients VALUES(26, '4', '26D', '17');
INSERT INTO coefficients VALUES(27, '4', '26D', '18');
INSERT INTO coefficients VALUES(28, '4', '26D', '19');
INSERT INTO coefficients VALUES(29, '2', '32D', '16');
INSERT INTO coefficients VALUES(30, '2', '32D', '17');
INSERT INTO coefficients VALUES(31, '2', '32D', '18');
INSERT INTO coefficients VALUES(32, '2', '32D', '19');

-- -----------------------------
-- insertions dans la table conduite
-- -----------------------------
INSERT INTO conduite VALUES('MOYEN');

-- -----------------------------
-- insertions dans la table connecter
-- -----------------------------
INSERT INTO connecter VALUES('478512/P', 2013-01-15, 'SURVEILLANT');
INSERT INTO connecter VALUES('654-op', 2013-01-16, 'PROFESSEUR');
INSERT INTO connecter VALUES('1427-bn', 2013-01-17, 'PROFESSEUR');
INSERT INTO connecter VALUES('478512/P', 2013-01-23, 'SURVEILLANT');
INSERT INTO connecter VALUES('654-op', 2013-03-01, 'PROFESSEUR');
INSERT INTO connecter VALUES('478512/P', 2013-03-01, 'SURVEILLANT');
INSERT INTO connecter VALUES('1427-bn', 2013-03-01, 'PROFESSEUR');
INSERT INTO connecter VALUES('12354/A', 2013-03-02, 'CENSEUR');

-- -----------------------------
-- insertions dans la table corps5
-- -----------------------------
INSERT INTO corps5 VALUES(1, 'corps12');

-- -----------------------------
-- insertions dans la table cours
-- -----------------------------

-- -----------------------------
-- insertions dans la table credit_horaire
-- -----------------------------
INSERT INTO credit_horaire VALUES(75, '22', '20', '10', '16', 4);
INSERT INTO credit_horaire VALUES(76, '22', '10', '5', '17', 4);
INSERT INTO credit_horaire VALUES(77, '22', '20', '10', '18', 4);
INSERT INTO credit_horaire VALUES(78, '22', '20', '10', '19', 4);
INSERT INTO credit_horaire VALUES(84, '34', '20', '10', '19', 2);
INSERT INTO credit_horaire VALUES(83, '34', '20', '10', '18', 2);
INSERT INTO credit_horaire VALUES(81, '24', '20', '10', '18', 2);
INSERT INTO credit_horaire VALUES(82, '24', '20', '10', '19', 2);
INSERT INTO credit_horaire VALUES(85, '28', '20', '10', '16', 1);
INSERT INTO credit_horaire VALUES(86, '28', '20', '10', '17', 1);
INSERT INTO credit_horaire VALUES(87, '28', '20', '10', '18', 1);
INSERT INTO credit_horaire VALUES(88, '28', '20', '10', '19', 1);
INSERT INTO credit_horaire VALUES(89, '30', '20', '10', '16', 4);
INSERT INTO credit_horaire VALUES(90, '30', '20', '10', '17', 4);
INSERT INTO credit_horaire VALUES(91, '30', '20', '10', '18', 4);
INSERT INTO credit_horaire VALUES(92, '30', '20', '10', '19', 4);
INSERT INTO credit_horaire VALUES(93, '32', '20', '10', '16', 4);
INSERT INTO credit_horaire VALUES(94, '32', '20', '10', '17', 4);
INSERT INTO credit_horaire VALUES(95, '32', '20', '10', '18', 4);
INSERT INTO credit_horaire VALUES(96, '32', '20', '10', '19', 4);
INSERT INTO credit_horaire VALUES(97, '23', '30', '15', '14', 4);
INSERT INTO credit_horaire VALUES(98, '23', '30', '15', '15', 1);
INSERT INTO credit_horaire VALUES(99, '25', '10', '5', '14', 2);
INSERT INTO credit_horaire VALUES(100, '25', '10', '5', '15', 2);
INSERT INTO credit_horaire VALUES(101, '26', '20', '10', '16', 4);
INSERT INTO credit_horaire VALUES(102, '26', '20', '10', '17', 4);
INSERT INTO credit_horaire VALUES(103, '26', '20', '10', '18', 4);
INSERT INTO credit_horaire VALUES(104, '26', '20', '10', '19', 4);

-- -----------------------------
-- insertions dans la table decisions
-- -----------------------------
INSERT INTO decisions VALUES(3, 'ADMIS(E) EN CLASSE SUPÉRIEURE', 10, 21, '14');
INSERT INTO decisions VALUES(4, 'ADMIS(E) EN CLASSE SUPÉRIEURE', 9, 21, '19');
INSERT INTO decisions VALUES(5, 'ADMIS(E) EN CLASSE SUPÉRIEURE', 10, 21, '18');
INSERT INTO decisions VALUES(6, 'ADMIS(E) EN CLASSE SUPÉRIEURE', 10, 21, '17');
INSERT INTO decisions VALUES(7, 'ADMIS(E) EN CLASSE SUPÉRIEURE', 10, 21, '16');
INSERT INTO decisions VALUES(8, 'ADMIS(E) EN CLASSE SUPÉRIEURE', 10, 21, '15');

-- -----------------------------
-- insertions dans la table disciplines
-- -----------------------------
INSERT INTO disciplines VALUES(22, 'FRAN&Ccedil;AIS', 'MOYEN');
INSERT INTO disciplines VALUES(23, 'FRAN&Ccedil;AIS', 'SECONDAIRE');
INSERT INTO disciplines VALUES(24, 'ESPAGNOL', 'MOYEN');
INSERT INTO disciplines VALUES(25, 'ESPAGNOL', 'SECONDAIRE');
INSERT INTO disciplines VALUES(26, 'mathématiques', 'MOYEN');
INSERT INTO disciplines VALUES(27, 'Mathématique', 'SECONDAIRE');
INSERT INTO disciplines VALUES(28, 'ANGLAIS', 'MOYEN');
INSERT INTO disciplines VALUES(29, 'ANGLAIS', 'SECONDAIRE');
INSERT INTO disciplines VALUES(30, 'EDUCATION PHYSIQUE', 'MOYEN');
INSERT INTO disciplines VALUES(31, 'EDUCATION PHYSIQUE', 'SECONDAIRE');
INSERT INTO disciplines VALUES(32, 'SVT', 'MOYEN');
INSERT INTO disciplines VALUES(33, 'SVT', 'SECONDAIRE');
INSERT INTO disciplines VALUES(34, 'ARABE', 'MOYEN');
INSERT INTO disciplines VALUES(35, 'ARABE', 'SECONDAIRE');

-- -----------------------------
-- insertions dans la table echelons5
-- -----------------------------
INSERT INTO echelons5 VALUES(1, 'Echelon1');
INSERT INTO echelons5 VALUES(2, 'echelon2');

-- -----------------------------
-- insertions dans la table eleves
-- -----------------------------
INSERT INTO eleves VALUES('12457/OP', 'BABACAR', 'COLY', '1', 1997-01-03, 'YEUMBEUL', 'IBOU COLY', 'amprojet@gmail.com', '776126042', '776457812', 'andmbengue@hotmail.com', 'FASS MBAO, KM 16', '', 'true');
INSERT INTO eleves VALUES('14572', 'IBRAHIMA', 'MBENGUE', '1', 1997-01-25, 'GUÉOUL', 'MAMADOU MBENGUE', 'hrakotoarison@gmail.com', '707854296', '', '', 'DVF', '', 'true');
INSERT INTO eleves VALUES('125487', 'YACINE', 'MBENGUE', '2', 1997-04-09, 'GUEOUL', 'MAMADOU MBENGUE', 'andmbengue@hotmail.com', '766822529', '', '', 'DVF', '', 'true');
INSERT INTO eleves VALUES('84579', 'MAGUETTE', 'FALL', '2', 1996-04-01, 'COKI', 'ALIMATOU FALL', 'amprojet@gmail.com', '776126042', '', '', 'GUÉOUL', '', 'true');
INSERT INTO eleves VALUES('12457-PO', 'FATOU', 'DIOP', '2', 1997-12-10, 'FATICK', 'NDÉYE SOKHNA FALL', 'andmbengue@hotmail.com', '766822529', '', '', 'TAMBA', '', 'true');

-- -----------------------------
-- insertions dans la table emploi_temps
-- -----------------------------
INSERT INTO emploi_temps VALUES(17, 1, 08:00:00, 10:00:00, '26', '654-op', '2012/2013', '1', 'S1', '83');
INSERT INTO emploi_temps VALUES(18, 1, 15:00:00, 17:00:00, '32', '654-op', '2012/2013', '1', 'S1', '83');
INSERT INTO emploi_temps VALUES(19, 6, 08:00:00, 10:00:00, '32', '654-op', '2012/2013', '1', 'S1', '83');
INSERT INTO emploi_temps VALUES(20, 3, 15:00:00, 17:00:00, '26', '654-op', '2012/2013', '1', 'S1', '83');
INSERT INTO emploi_temps VALUES(21, 2, 08:00:00, 10:00:00, '22', '1427-bn', '2012/2013', '1', 'S1', '83');
INSERT INTO emploi_temps VALUES(22, 4, 10:00:00, 12:00:00, '28', '1427-bn', '2012/2013', '1', 'S1', '83');
INSERT INTO emploi_temps VALUES(23, 5, 09:00:00, 11:00:00, '30', '1245/AM', '2012/2013', '6', 'S1', '83');
INSERT INTO emploi_temps VALUES(24, 4, 15:00:00, 17:00:00, '22', '1427-bn', '2012/2013', '1', 'S1', '83');
INSERT INTO emploi_temps VALUES(25, 1, 08:00:00, 10:00:00, '22', '1427-bn', '2012/2013', '1', 'S2', '83');
INSERT INTO emploi_temps VALUES(26, 1, 10:00:00, 12:00:00, '24', '1245/AM', '2012/2013', '1', 'S2', '83');
INSERT INTO emploi_temps VALUES(27, 2, 08:00:00, 10:00:00, '26', '654-op', '2012/2013', '1', 'S2', '83');
INSERT INTO emploi_temps VALUES(28, 2, 10:00:00, 12:00:00, '28', '1427-bn', '2012/2013', '1', 'S2', '83');
INSERT INTO emploi_temps VALUES(29, 3, 08:00:00, 10:00:00, '30', '1245/AM', '2012/2013', '6', 'S2', '83');
INSERT INTO emploi_temps VALUES(30, 5, 08:00:00, 10:00:00, '26', '654-op', '2012/2013', '1', 'S2', '83');

-- -----------------------------
-- insertions dans la table enable5
-- -----------------------------

-- -----------------------------
-- insertions dans la table enseignant
-- -----------------------------

-- -----------------------------
-- insertions dans la table enseigner
-- -----------------------------
INSERT INTO enseigner VALUES('654-op', '83', '26', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '84', '26', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '82', '26', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '81', '81', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '82', '82', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '83', '22', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '84', '22', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '83', '28', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '84', '28', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '82', '28', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '83', '24', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '84', '24', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '82', '24', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '83', '30', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '84', '30', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '82', '30', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '83', '', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '84', '', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '83', '83', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '84', '84', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '82', '32', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '84', '32', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '83', '32', '2012/2013');

-- -----------------------------
-- insertions dans la table etablissements
-- -----------------------------
INSERT INTO etablissements VALUES('LOUGA', 'KEBEMER', 'GROUPE SCOLAIRE KEUR MAR?MA', '', 'LA REUSSITE EST AU BOUT DE L\'EFFORT', '2009-10-01', 'guéoul, quartier dvf', '339879145', '002214575', 'http://www.abaim-computer.com', '339879154', 'contact@abaim-computer.com', 'PRIVE', 2010-11-01);

-- -----------------------------
-- insertions dans la table etudes
-- -----------------------------
INSERT INTO etudes VALUES(21, 'Tle', 'L`1', 'TleL`1', 'SECONDAIRE');
INSERT INTO etudes VALUES(20, '1er', 'L`1', '1erL`1', 'SECONDAIRE');
INSERT INTO etudes VALUES(16, '6i&eacute;me', '', '6i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES(17, '5i&eacute;me', '', '5i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES(18, '4i&eacute;me', '', '4i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES(19, '3i&eacute;me', '', '3i&eacute;me', 'MOYEN');

-- -----------------------------
-- insertions dans la table evaluations
-- -----------------------------
INSERT INTO evaluations VALUES(1, 2012-12-15, 08:00:00, 10:00:00, '26D', '83', 'DEVOIR', 'S1', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(2, 2012-12-23, 08:00:00, 10:00:00, '26D', '83', 'DEVOIR', 'S1', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(5, 2012-12-16, 08:00:00, 10:00:00, '28D', '83', 'DEVOIR', 'S1', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(6, 2012-12-15, 10:00:00, 12:00:00, '22D1', '83', 'DEVOIR', 'S1', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(7, 2012-12-16, 10:00:00, 12:00:00, '22D2', '83', 'DEVOIR', 'S1', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(8, 2013-02-20, 08:00:00, 10:00:00, '28D', '83', 'COMPOSITION', 'S1', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(9, 2013-02-22, 08:00:00, 10:00:00, '22D1', '83', 'COMPOSITION', 'S1', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(10, 2013-02-22, 10:00:00, 12:00:00, '22D2', '83', 'COMPOSITION', 'S1', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(11, 2013-02-23, 08:00:00, 10:00:00, '26D', '83', 'COMPOSITION', 'S1', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(12, 2013-01-04, 15:00:00, 17:00:00, '32D', '83', 'DEVOIR', 'S1', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(13, 2013-02-28, 08:00:00, 10:00:00, '32D', '83', 'COMPOSITION', 'S1', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(14, 2013-03-12, 08:00:00, 10:00:00, '26D', '83', 'DEVOIR', 'S2', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(15, 2013-03-13, 08:00:00, 10:00:00, '26D', '83', 'DEVOIR', 'S2', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(16, 2013-03-13, 15:00:00, 17:00:00, '32D', '83', 'DEVOIR', 'S2', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(17, 2013-03-28, 08:00:00, 10:00:00, '32D', '83', 'DEVOIR', 'S2', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(18, 2013-06-28, 08:00:00, 10:00:00, '26D', '83', 'COMPOSITION', 'S2', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(19, 2013-06-29, 08:00:00, 10:00:00, '32D', '83', 'COMPOSITION', 'S2', '2012/2013', '1', '654-op');
INSERT INTO evaluations VALUES(20, 2013-04-15, 15:00:00, 17:00:00, '28D', '83', 'DEVOIR', 'S2', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(21, 2013-05-15, 08:00:00, 10:00:00, '28D', '83', 'DEVOIR', 'S2', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(22, 2013-07-15, 08:00:00, 10:00:00, '28D', '83', 'COMPOSITION', 'S2', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(23, 2013-04-16, 08:00:00, 10:00:00, '22D1', '83', 'DEVOIR', 'S2', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(24, 2013-04-16, 10:00:00, 11:00:00, '22D2', '83', 'DEVOIR', 'S2', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(25, 2013-04-16, 17:00:00, 19:00:00, '22D3', '83', 'DEVOIR', 'S2', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(26, 2013-07-16, 08:00:00, 10:00:00, '22D1', '83', 'COMPOSITION', 'S2', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(27, 2013-07-16, 10:00:00, 11:00:00, '22D2', '83', 'COMPOSITION', 'S2', '2012/2013', '1', '1427-bn');
INSERT INTO evaluations VALUES(28, 2013-07-16, 15:00:00, 17:00:00, '22D3', '83', 'COMPOSITION', 'S2', '2012/2013', '1', '1427-bn');

-- -----------------------------
-- insertions dans la table filieres
-- -----------------------------

-- -----------------------------
-- insertions dans la table fonction
-- -----------------------------
INSERT INTO fonction VALUES('12354/54', 'PROFESSEUR', 'SECONDAIRE');
INSERT INTO fonction VALUES('12354/A', 'CENSEUR', 'SECONDAIRE');
INSERT INTO fonction VALUES('124', 'PROFESSEUR', 'MOYEN');
INSERT INTO fonction VALUES('1245/AM', 'PROFESSEUR', 'MOYEN');
INSERT INTO fonction VALUES('1270/AN', 'SURVEILLANT', 'SECONDAIRE');
INSERT INTO fonction VALUES('1271/OP', 'PROFESSEUR', 'SECONDAIRE');
INSERT INTO fonction VALUES('1271/OP', 'SURVEILLANT', 'SECONDAIRE');
INSERT INTO fonction VALUES('1427-bn', 'PROFESSEUR', 'MOYEN');
INSERT INTO fonction VALUES('1478-D', 'ENSEIGNANT', 'ELEMENTAIRE');
INSERT INTO fonction VALUES('4578-az', 'SURVEILLANT', 'MOYEN');
INSERT INTO fonction VALUES('478512/P', 'SURVEILLANT', 'MOYEN');
INSERT INTO fonction VALUES('654-op', 'PROFESSEUR', 'MOYEN');

-- -----------------------------
-- insertions dans la table formules
-- -----------------------------
INSERT INTO formules VALUES('(MoySem1 + MoySem2)/2', '2');

-- -----------------------------
-- insertions dans la table grades5
-- -----------------------------
INSERT INTO grades5 VALUES(1, 'Grades1');

-- -----------------------------
-- insertions dans la table honneurs
-- -----------------------------
INSERT INTO honneurs VALUES(7, 'FELICITATIONS', 16, 21);
INSERT INTO honneurs VALUES(8, 'ENCOURAGEMENTS', 14, 16);
INSERT INTO honneurs VALUES(9, 'TABLEAU D\'HONNEUR', 12, 14);
INSERT INTO honneurs VALUES(10, 'AVERTISSEMENT', 8, 10);
INSERT INTO honneurs VALUES(11, 'BLAME', 1, 8);

-- -----------------------------
-- insertions dans la table horaires
-- -----------------------------

-- -----------------------------
-- insertions dans la table inscription
-- -----------------------------
INSERT INTO inscription VALUES('12457/OP', '83', 'NON', 2013-01-15, '2012/2013', '478512/P', 88, 82, 0);
INSERT INTO inscription VALUES('14572', '83', 'NON', 2013-03-01, '2012/2013', '478512/P', 88, 84, 0);
INSERT INTO inscription VALUES('125487', '83', 'NON', 2013-03-01, '2012/2013', '478512/P', 88, 82, 0);
INSERT INTO inscription VALUES('84579', '83', 'NON', 2013-03-01, '2012/2013', '478512/P', 88, 84, 0);
INSERT INTO inscription VALUES('12457-PO', '83', 'OUI', 2013-03-01, '2012/2013', '478512/P', 88, 82, 0);

-- -----------------------------
-- insertions dans la table jours
-- -----------------------------
INSERT INTO jours VALUES(1, 'Lundi');
INSERT INTO jours VALUES(2, 'Mardi');
INSERT INTO jours VALUES(3, 'Mercredi');
INSERT INTO jours VALUES(4, 'Jeudi');
INSERT INTO jours VALUES(5, 'Vendredi');
INSERT INTO jours VALUES(6, 'Samedi');

-- -----------------------------
-- insertions dans la table matrimonial5
-- -----------------------------
INSERT INTO matrimonial5 VALUES(5, 'Célibataire');
INSERT INTO matrimonial5 VALUES(6, 'Divorcé(e)');
INSERT INTO matrimonial5 VALUES(7, 'veuf(ve)');

-- -----------------------------
-- insertions dans la table modulaire
-- -----------------------------

-- -----------------------------
-- insertions dans la table modules
-- -----------------------------

-- -----------------------------
-- insertions dans la table moyennediscipline
-- -----------------------------
INSERT INTO moyennediscipline VALUES('12457/OP', '32D', 17.938, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '26D', 20.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '0', 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '24D', 0.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '0', 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '30D', 0.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '28D', 18.750, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '22D3', 15.500, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '22D2', 15.500, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '22D1', 17.500, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '32D', 20.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '26D', 18.500, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '24D', 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '30D', 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '28D', 18.500, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '22D3', 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '22', 15.500, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '22', 15.500, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '22D2', 16.500, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('12457/OP', '22D1', 17.500, 'S1', '2012/2013');

-- -----------------------------
-- insertions dans la table moyennes
-- -----------------------------
INSERT INTO moyennes VALUES('12457/OP', 12.526, 'S1', '2012/2013');
INSERT INTO moyennes VALUES('12457/OP', 14.195, 'S2', '2012/2013');

-- -----------------------------
-- insertions dans la table nature
-- -----------------------------
INSERT INTO nature VALUES(1, 'Langue vivante I');
INSERT INTO nature VALUES(2, 'Langue vivante II');
INSERT INTO nature VALUES(3, 'Langue classique');
INSERT INTO nature VALUES(4, 'Autres');

-- -----------------------------
-- insertions dans la table note_conduite
-- -----------------------------
INSERT INTO note_conduite VALUES('12457/OP', '19', 'S1', '2012/2013', 28, '478512/P');
INSERT INTO note_conduite VALUES('12457/OP', '19', 'S2', '2012/2013', 29, '654-op');
INSERT INTO note_conduite VALUES('12457/OP', '19', 'S2', '2012/2013', 30, '478512/P');
INSERT INTO note_conduite VALUES('12457/OP', '20', 'S2', '2012/2013', 31, '1427-bn');

-- -----------------------------
-- insertions dans la table notes
-- -----------------------------
INSERT INTO notes VALUES('12457/OP', '17', '5', 1);
INSERT INTO notes VALUES('12457/OP', '18', '1', 2);
INSERT INTO notes VALUES('12457/OP', '20', '2', 3);
INSERT INTO notes VALUES('12457/OP', '18', '6', 4);
INSERT INTO notes VALUES('12457/OP', '15', '7', 5);
INSERT INTO notes VALUES('12457/OP', '20', '8', 6);
INSERT INTO notes VALUES('12457/OP', '18', '10', 7);
INSERT INTO notes VALUES('12457/OP', '17', '9', 8);
INSERT INTO notes VALUES('12457/OP', 'ABS', '12', 9);
INSERT INTO notes VALUES('12457/OP', '18', '11', 10);
INSERT INTO notes VALUES('12457/OP', '20', '13', 11);
INSERT INTO notes VALUES('12457/OP', '20', '14', 12);
INSERT INTO notes VALUES('12457/OP', '18', '16', 13);
INSERT INTO notes VALUES('12457/OP', '20', '15', 14);
INSERT INTO notes VALUES('12457/OP', '17.75', '17', 15);
INSERT INTO notes VALUES('12457/OP', 'ABS', '18', 16);
INSERT INTO notes VALUES('12457/OP', '18', '19', 17);
INSERT INTO notes VALUES('12457/OP', '15', '20', 18);
INSERT INTO notes VALUES('12457/OP', '12', '25', 19);
INSERT INTO notes VALUES('12457/OP', '12', '24', 20);
INSERT INTO notes VALUES('12457/OP', '15', '23', 21);
INSERT INTO notes VALUES('12457/OP', '20', '21', 22);
INSERT INTO notes VALUES('12457/OP', '20', '26', 23);
INSERT INTO notes VALUES('12457/OP', '19', '27', 24);
INSERT INTO notes VALUES('12457/OP', '19', '28', 25);
INSERT INTO notes VALUES('12457/OP', '20', '22', 26);

-- -----------------------------
-- insertions dans la table passer
-- -----------------------------

-- -----------------------------
-- insertions dans la table periodes
-- -----------------------------

-- -----------------------------
-- insertions dans la table personnels
-- -----------------------------
INSERT INTO personnels VALUES('654-op', '1', 'ANDALLA', 'MBENGUE', '5', '3', '1983-08-02', 'YEUMBEUL', '776126042', 'FASS MBAO, TALLY MAME DIARA, Q MODOU FALL', 'amprojet@gmail.com', 'perso654-op.JPG', '1', '1', '1', '2', '2012-11-06');
INSERT INTO personnels VALUES('4578-az', '3', 'ND?YE', 'COLY', '3', '2', '1985-10-12', 'YEUMBEIL', '776541243', 'FASS MBAO', 'colynd@yahoo.fr', '', '1', '1', '1', '2', '2010-10-01');
INSERT INTO personnels VALUES('1427-bn', '1', 'ALIOUNE', 'GUEYE', '3', '1', '1990-10-01', 'SAINT LOUIS', '766521245', 'HLM GRAND YOFF', 'kothie@gmail.com', 'perso1427-bn.jpg', '1', '1', '1', '1', '2011-10-01');
INSERT INTO personnels VALUES('12354/A', '1', 'NGOUDA', 'SARR', '5', '1', '1980-10-08', 'CAMB?R?NE1', '766521245', 'CAMBÉRÉNE1', 'keurama@gmail.com', 'perso12354-A.JPG', '1', '1', '1', '1', '2008-10-01');
INSERT INTO personnels VALUES('478512/P', '2', 'ALIMATOU', 'MBAYE', '1', '2', '1978-07-01', 'BAMB?YE', '778569210', 'PARCELLE ASSAINIE U14', 'alima@yahoo.fr', 'perso478512-P.jpg', '1', '1', '1', '2', '2008-10-01');
INSERT INTO personnels VALUES('1245/AM', '1', 'SAMBA', 'FALL', '3', '1', '1984-01-12', 'LOUGA', '776124875', 'PA U22 N?15', 'samba@gmail.com', '', '1', '1', '1', '1', '2009-10-01');
INSERT INTO personnels VALUES('1271/OP', '1', 'TAPHA', 'SYLLA', '3', '1', '1977-08-15', 'DAKAR,MÉDINA', '776854582', 'MÉDINA', 'taf47@yahoo.fr', '', '1', '1', '1', '1', '2000-10-01');
INSERT INTO personnels VALUES('12354/54', '1', 'NDIAGA', 'COLY', '3', '1', '1983-08-06', 'DAKAR', '776126042', 'FASS', 'colynd@gmail.com', '', '1', '1', '1', '1', '2007-09-03');
INSERT INTO personnels VALUES('124', '3', 'MAR?MA', 'SEYE', '1', '2', '1969-12-06', 'KOLDA', '776126042', 'FASS MBAO', 'and@gmail.com', '', '1', '1', '1', '1', '2009-12-06');
INSERT INTO personnels VALUES('1270/AN', '1', 'ABOUL AZIZ', 'WADE', '1', '1', '1972-09-02', 'KEUR MASSAR', '776126042', 'KEUR MASSAR', 'wadesoft@gmail.com', '', '1', '1', '1', '1', '2002-10-04');
INSERT INTO personnels VALUES('1478-D', '1', 'NDIAGA', 'FALL', '1', '1', '1983-12-02', 'GU?OUL', '776124585', 'GU?OUL,QUARTIER GU?MB', 'falldiaga@yahoo.fr', '', '1', '1', '1', '1', '2010-10-01');

-- -----------------------------
-- insertions dans la table profiles
-- -----------------------------
INSERT INTO profiles VALUES('AUTRES', 'ELEMENTAIRE');
INSERT INTO profiles VALUES('AUTRES', 'MOYEN');
INSERT INTO profiles VALUES('AUTRES', 'SECONDAIRE');
INSERT INTO profiles VALUES('CENSEUR', 'SECONDAIRE');
INSERT INTO profiles VALUES('COMPTABLE', 'ELEMENTAIRE');
INSERT INTO profiles VALUES('COMPTABLE', 'MOYEN');
INSERT INTO profiles VALUES('COMPTABLE', 'SECONDAIRE');
INSERT INTO profiles VALUES('DIRECTEUR', 'ELEMENTAIRE');
INSERT INTO profiles VALUES('ENSEIGNANT', 'ELEMENTAIRE');
INSERT INTO profiles VALUES('PRINCIPAL', 'MOYEN');
INSERT INTO profiles VALUES('PROFESSEUR', 'MOYEN');
INSERT INTO profiles VALUES('PROFESSEUR', 'SECONDAIRE');
INSERT INTO profiles VALUES('SURVEILLANT', 'MOYEN');
INSERT INTO profiles VALUES('SURVEILLANT', 'SECONDAIRE');

-- -----------------------------
-- insertions dans la table programmes
-- -----------------------------

-- -----------------------------
-- insertions dans la table remarques
-- -----------------------------
INSERT INTO remarques VALUES(9, 'EXCELLENT(E) ELEVE', 18, 21);
INSERT INTO remarques VALUES(10, 'TRES BON ELEVE', 16, 18);
INSERT INTO remarques VALUES(11, 'BON ELEVE', 14, 16);
INSERT INTO remarques VALUES(12, 'ASSEZ BON ELEVE', 12, 14);
INSERT INTO remarques VALUES(13, 'ELEVE PASSABLE', 10, 12);
INSERT INTO remarques VALUES(14, 'ELEVE FAIBLE', 8, 10);
INSERT INTO remarques VALUES(15, 'ELEVE TRES FAIBLE', 1, 8);

-- -----------------------------
-- insertions dans la table retard
-- -----------------------------

-- -----------------------------
-- insertions dans la table salles
-- -----------------------------
INSERT INTO salles VALUES(1, 'SALLE1', '100');
INSERT INTO salles VALUES(2, 'SALLE2', '150');
INSERT INTO salles VALUES(5, 'SALLE3', '50');
INSERT INTO salles VALUES(6, 'STADE ', '1500');

-- -----------------------------
-- insertions dans la table semestres
-- -----------------------------
INSERT INTO semestres VALUES('S1', 'PREMIER SEMESTRE', 2012-10-04, 2013-02-28, 'SUPERIEURE', '2012/2013');
INSERT INTO semestres VALUES('S2', 'SECOND SEMESTRE', 2013-03-01, 2013-07-31, 'SUPERIEURE', '2012/2013');

-- -----------------------------
-- insertions dans la table series
-- -----------------------------
INSERT INTO series VALUES(1, 'L`1');
INSERT INTO series VALUES(2, 'S');
INSERT INTO series VALUES(3, 'L');
INSERT INTO series VALUES(4, 'S2');
INSERT INTO series VALUES(5, 'G');

-- -----------------------------
-- insertions dans la table sexe5
-- -----------------------------
INSERT INTO sexe5 VALUES(1, 'Masculin');
INSERT INTO sexe5 VALUES(2, 'Féminin');

-- -----------------------------
-- insertions dans la table sous_matiere
-- -----------------------------
INSERT INTO sous_matiere VALUES(1, 'R&Eacute;DACTION', 22);
INSERT INTO sous_matiere VALUES(2, 'ORTHOGRAPHE &amp; GRAMMAIRE', 22);
INSERT INTO sous_matiere VALUES(3, 'TEXT &amp; R&Eacute;CITATION', 22);

-- -----------------------------
-- insertions dans la table specialites
-- -----------------------------
INSERT INTO specialites VALUES(1, '654-op', '26');
INSERT INTO specialites VALUES(2, '654-op', '32');
INSERT INTO specialites VALUES(3, '1427-bn', '22');
INSERT INTO specialites VALUES(4, '1427-bn', '28');
INSERT INTO specialites VALUES(5, '1245/AM', '24');
INSERT INTO specialites VALUES(6, '1245/AM', '30');

-- -----------------------------
-- insertions dans la table surveiller
-- -----------------------------
INSERT INTO surveiller VALUES('4578-az', '81', '2012/2013');
INSERT INTO surveiller VALUES('4578-az', '82', '2012/2013');
INSERT INTO surveiller VALUES('4578-az', '84', '2012/2013');
INSERT INTO surveiller VALUES('478512/P', '80', '2012/2013');
INSERT INTO surveiller VALUES('478512/P', '83', '2012/2013');

-- -----------------------------
-- insertions dans la table tableau_prof
-- -----------------------------

-- -----------------------------
-- insertions dans la table titre5
-- -----------------------------
INSERT INTO titre5 VALUES(1, 'M.');
INSERT INTO titre5 VALUES(2, 'Mme');
INSERT INTO titre5 VALUES(3, 'Mlle');

-- -----------------------------
-- insertions dans la table user
-- -----------------------------
INSERT INTO user VALUES('654-op', 'mbopame', 'mbopame', 'PROFESSEUR');
INSERT INTO user VALUES('1427-bn', 'gueye', 'gueye', 'PROFESSEUR');
INSERT INTO user VALUES('4578-az', 'coly', 'coly', 'SURVEILLANT');
INSERT INTO user VALUES('12354/A', 'sarr', 'sarr', 'CENSEUR');
INSERT INTO user VALUES('478512/P', 'mbaye', 'mbaye', 'SURVEILLANT');
INSERT INTO user VALUES('1245/AM', 'samba', 'samba', 'PROFESSEUR');
INSERT INTO user VALUES('1271/OP', 'sylla', 'sylla', 'SURVEILLANT');
INSERT INTO user VALUES('1271/OP', 'sylla', 'sylla', 'PROFESSEUR');
INSERT INTO user VALUES('12354/54', 'ndiaga', 'ndiaga', 'PROFESSEUR');
INSERT INTO user VALUES('124', 'seye', 'seye', 'PROFESSEUR');
INSERT INTO user VALUES('1270/AN', 'wade', 'wade', 'SURVEILLANT');
INSERT INTO user VALUES('1478-D', 'ndiaga', 'ndiaga', 'ENSEIGNANT');

