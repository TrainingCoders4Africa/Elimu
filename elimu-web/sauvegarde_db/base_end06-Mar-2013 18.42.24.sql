-- ----------------------
-- dump de la base elimu au 06-Mar-2013
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table coefficients
-- -----------------------------
CREATE TABLE `coefficients` (
  `idcoef` int(11) NOT NULL AUTO_INCREMENT,
  `coef` varchar(20) NOT NULL DEFAULT '0',
  `discipline` varchar(50) NOT NULL DEFAULT '',
  `etude` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`idcoef`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

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
-- creation de la table contact
-- -----------------------------
CREATE TABLE `contact` (
  `contact_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `active` bit(1) NOT NULL,
  `emailAddress` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `otherPhoneNumber` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`contact_id`),
  UNIQUE KEY `contact_id` (`contact_id`),
  UNIQUE KEY `phoneNumber` (`phoneNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`idch`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table disciplines
-- -----------------------------
CREATE TABLE `disciplines` (
  `iddis` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `cycle` varchar(100) NOT NULL,
  PRIMARY KEY (`iddis`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

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
-- creation de la table email
-- -----------------------------
CREATE TABLE `email` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `date` bigint(20) DEFAULT NULL,
  `recipients` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `sender_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK3FF5B7C77FBC69D` (`sender_id`),
  CONSTRAINT `FK3FF5B7C77FBC69D` FOREIGN KEY (`sender_id`) REFERENCES `emailaccount` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table emailaccount
-- -----------------------------
CREATE TABLE `emailaccount` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `accountName` varchar(255) DEFAULT NULL,
  `accountPassword` varchar(255) DEFAULT NULL,
  `accountServer` varchar(255) DEFAULT NULL,
  `accountServerPort` int(11) DEFAULT NULL,
  `enabled` bit(1) DEFAULT NULL,
  `isForReceiving` bit(1) DEFAULT NULL,
  `lastCheck` bigint(20) DEFAULT NULL,
  `protocol` varchar(255) DEFAULT NULL,
  `useSsl` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `accountName` (`accountName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

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
-- creation de la table form
-- -----------------------------
CREATE TABLE `form` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `finalised` bit(1) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `permittedGroup_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK2180E4D3148215` (`permittedGroup_path`),
  CONSTRAINT `FK2180E4D3148215` FOREIGN KEY (`permittedGroup_path`) REFERENCES `frontline_group` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table form_formfield
-- -----------------------------
CREATE TABLE `form_formfield` (
  `Form_id` bigint(20) NOT NULL,
  `fields_id` bigint(20) NOT NULL,
  UNIQUE KEY `fields_id` (`fields_id`),
  KEY `FK891CCCDB1F476EAE` (`Form_id`),
  KEY `FK891CCCDBF2FF003` (`fields_id`),
  CONSTRAINT `FK891CCCDB1F476EAE` FOREIGN KEY (`Form_id`) REFERENCES `form` (`id`),
  CONSTRAINT `FK891CCCDBF2FF003` FOREIGN KEY (`fields_id`) REFERENCES `formfield` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table formfield
-- -----------------------------
CREATE TABLE `formfield` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) DEFAULT NULL,
  `positionIndex` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `form_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FKE1EB1E761F476EAE` (`form_id`),
  CONSTRAINT `FKE1EB1E761F476EAE` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table formresponse
-- -----------------------------
CREATE TABLE `formresponse` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `senderMsisdn` varchar(255) DEFAULT NULL,
  `parentForm_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK8325D545D92B32C4` (`parentForm_id`),
  CONSTRAINT `FK8325D545D92B32C4` FOREIGN KEY (`parentForm_id`) REFERENCES `form` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table formresponse_responsevalue
-- -----------------------------
CREATE TABLE `formresponse_responsevalue` (
  `FormResponse_id` bigint(20) NOT NULL,
  `results_id` bigint(20) NOT NULL,
  UNIQUE KEY `results_id` (`results_id`),
  KEY `FKCA47C8161674AB2E` (`FormResponse_id`),
  KEY `FKCA47C816F8F076C0` (`results_id`),
  CONSTRAINT `FKCA47C8161674AB2E` FOREIGN KEY (`FormResponse_id`) REFERENCES `formresponse` (`id`),
  CONSTRAINT `FKCA47C816F8F076C0` FOREIGN KEY (`results_id`) REFERENCES `responsevalue` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table formules
-- -----------------------------
CREATE TABLE `formules` (
  `libelle` varchar(100) NOT NULL DEFAULT '',
  `valeur` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table frontline_group
-- -----------------------------
CREATE TABLE `frontline_group` (
  `path` varchar(255) NOT NULL,
  `parentPath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`path`),
  UNIQUE KEY `path` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table frontlinemultimediamessagepart
-- -----------------------------
CREATE TABLE `frontlinemultimediamessagepart` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `binaryData` bit(1) DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table grades5
-- -----------------------------
CREATE TABLE `grades5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle1` varchar(35) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table groupmembership
-- -----------------------------
CREATE TABLE `groupmembership` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `contact_contact_id` bigint(20) NOT NULL,
  `group_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `contact_contact_id` (`contact_contact_id`,`group_path`),
  KEY `FKBA9C3F955A18C292` (`contact_contact_id`),
  KEY `FKBA9C3F95DAF23DFD` (`group_path`),
  CONSTRAINT `FKBA9C3F955A18C292` FOREIGN KEY (`contact_contact_id`) REFERENCES `contact` (`contact_id`),
  CONSTRAINT `FKBA9C3F95DAF23DFD` FOREIGN KEY (`group_path`) REFERENCES `frontline_group` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
-- creation de la table keyword
-- -----------------------------
CREATE TABLE `keyword` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `keyword` (`keyword`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table keywordaction
-- -----------------------------
CREATE TABLE `keywordaction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `commandInteger` int(11) NOT NULL,
  `commandString` longtext,
  `counter` int(11) NOT NULL,
  `emailRecipients` varchar(255) DEFAULT NULL,
  `emailSubject` varchar(255) DEFAULT NULL,
  `endDate` bigint(20) NOT NULL,
  `externalCommand` varchar(255) DEFAULT NULL,
  `externalCommandResponseActionType` int(11) DEFAULT NULL,
  `externalCommandResponseType` int(11) DEFAULT NULL,
  `externalCommandType` int(11) DEFAULT NULL,
  `startDate` bigint(20) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `emailAccount_id` bigint(20) DEFAULT NULL,
  `group_path` varchar(255) DEFAULT NULL,
  `keyword_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK822AE55FC5482473` (`keyword_id`),
  KEY `FK822AE55FDAF23DFD` (`group_path`),
  KEY `FK822AE55F3D2C2C41` (`emailAccount_id`),
  CONSTRAINT `FK822AE55F3D2C2C41` FOREIGN KEY (`emailAccount_id`) REFERENCES `emailaccount` (`id`),
  CONSTRAINT `FK822AE55FC5482473` FOREIGN KEY (`keyword_id`) REFERENCES `keyword` (`id`),
  CONSTRAINT `FK822AE55FDAF23DFD` FOREIGN KEY (`group_path`) REFERENCES `frontline_group` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table matrimonial5
-- -----------------------------
CREATE TABLE `matrimonial5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table message
-- -----------------------------
CREATE TABLE `message` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `keyword` varchar(20) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `cur_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `binaryMessageContent` tinyblob,
  `dtype` varchar(255) DEFAULT NULL,
  `recipientMsisdn` varchar(255) DEFAULT NULL,
  `recipientSmsPort` int(11) DEFAULT NULL,
  `retriesRemaining` int(11) DEFAULT NULL,
  `senderMsisdn` varchar(255) DEFAULT NULL,
  `smsPartsCount` int(11) DEFAULT NULL,
  `smscReference` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `textContent` longtext,
  `type` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table message_frontlinemultimediamessagepart
-- -----------------------------
CREATE TABLE `message_frontlinemultimediamessagepart` (
  `message_id` bigint(20) NOT NULL,
  `multimediaParts_id` bigint(20) NOT NULL,
  UNIQUE KEY `multimediaParts_id` (`multimediaParts_id`),
  KEY `FKAA958F0AFC9C3E5E` (`multimediaParts_id`),
  CONSTRAINT `FKAA958F0AFC9C3E5E` FOREIGN KEY (`multimediaParts_id`) REFERENCES `frontlinemultimediamessagepart` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `discipline` int(11) NOT NULL,
  `note` decimal(6,3) NOT NULL,
  `semestre` varchar(10) NOT NULL,
  `annee` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table notes
-- -----------------------------
CREATE TABLE `notes` (
  `eleve` varchar(20) NOT NULL DEFAULT '',
  `note` varchar(6) NOT NULL DEFAULT '0.000',
  `evaluation` varchar(20) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table reminder
-- -----------------------------
CREATE TABLE `reminder` (
  `occurrence` varchar(31) NOT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `enddate` bigint(20) DEFAULT NULL,
  `recipients` varchar(255) DEFAULT NULL,
  `startdate` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table responsevalue
-- -----------------------------
CREATE TABLE `responsevalue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table sexe5
-- -----------------------------
CREATE TABLE `sexe5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table smsinternetservicesettings
-- -----------------------------
CREATE TABLE `smsinternetservicesettings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `serviceClassName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table smsinternetservicesettings_smsinternetservicesettingvalue
-- -----------------------------
CREATE TABLE `smsinternetservicesettings_smsinternetservicesettingvalue` (
  `SmsInternetServiceSettings_id` bigint(20) NOT NULL,
  `properties_id` bigint(20) NOT NULL,
  `mapkey` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`SmsInternetServiceSettings_id`,`mapkey`),
  UNIQUE KEY `properties_id` (`properties_id`),
  KEY `FKA24BD3BD32373A6A` (`properties_id`),
  KEY `FKA24BD3BD6E7ADCE1` (`SmsInternetServiceSettings_id`),
  CONSTRAINT `FKA24BD3BD32373A6A` FOREIGN KEY (`properties_id`) REFERENCES `smsinternetservicesettingvalue` (`id`),
  CONSTRAINT `FKA24BD3BD6E7ADCE1` FOREIGN KEY (`SmsInternetServiceSettings_id`) REFERENCES `smsinternetservicesettings` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table smsinternetservicesettingvalue
-- -----------------------------
CREATE TABLE `smsinternetservicesettingvalue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table smsmodemsettings
-- -----------------------------
CREATE TABLE `smsmodemsettings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `deleteMessagesAfterReceiving` bit(1) NOT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `useDeliveryReports` bit(1) NOT NULL,
  `useForReceiving` bit(1) NOT NULL,
  `useForSending` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -----------------------------
-- creation de la table specialites
-- -----------------------------
CREATE TABLE `specialites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `professeur` varchar(50) NOT NULL DEFAULT '',
  `discipline` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
INSERT INTO apreciation_prof VALUES(1, '129/LO', 'Bon Travail, Ã  Encourager', '9', '2012/2013', 'S1', '654-op');
INSERT INTO apreciation_prof VALUES(2, '65421', 'Passable', '5', '2012/2013', 'S2', '1427-bn');
INSERT INTO apreciation_prof VALUES(3, '14274', 'Tres bon travail', '5', '2012/2013', 'S2', '1427-bn');
INSERT INTO apreciation_prof VALUES(4, '124242', 'Bien', '5', '2012/2013', 'S2', '1427-bn');
INSERT INTO apreciation_prof VALUES(5, '12457', 'A-Bien à encadrer', '5', '2012/2013', 'S2', '1427-bn');
INSERT INTO apreciation_prof VALUES(6, '65421', 'Trés bon travail', '18', '2012/2013', 'S2', '1427-bn');
INSERT INTO apreciation_prof VALUES(7, '14274', 'Abien', '18', '2012/2013', 'S2', '1427-bn');
INSERT INTO apreciation_prof VALUES(8, '124242', 'bien', '18', '2012/2013', 'S2', '1427-bn');
INSERT INTO apreciation_prof VALUES(9, '12457', 'TBien', '18', '2012/2013', 'S2', '1427-bn');
INSERT INTO apreciation_prof VALUES(10, '65421', 'Tbein', '1', '2012/2013', 'S2', '124');
INSERT INTO apreciation_prof VALUES(11, '14274', 'Bien', '1', '2012/2013', 'S2', '124');
INSERT INTO apreciation_prof VALUES(12, '124242', 'Abien', '1', '2012/2013', 'S2', '124');
INSERT INTO apreciation_prof VALUES(13, '12457', 'Bien', '1', '2012/2013', 'S2', '124');
INSERT INTO apreciation_prof VALUES(14, '65421', 'Tbien', '7', '2012/2013', 'S2', '1245/AM');
INSERT INTO apreciation_prof VALUES(15, '14274', 'Bien', '7', '2012/2013', 'S2', '1245/AM');
INSERT INTO apreciation_prof VALUES(16, '124242', 'Abien', '7', '2012/2013', 'S2', '1245/AM');
INSERT INTO apreciation_prof VALUES(17, '12457', 'Bien', '7', '2012/2013', 'S2', '1245/AM');
INSERT INTO apreciation_prof VALUES(18, '65421', 'TBien, à Encourager', '10', '2012/2013', 'S2', '1245/AM');
INSERT INTO apreciation_prof VALUES(19, '14274', 'Tbein', '10', '2012/2013', 'S2', '1245/AM');
INSERT INTO apreciation_prof VALUES(20, '124242', 'TBien', '10', '2012/2013', 'S2', '1245/AM');
INSERT INTO apreciation_prof VALUES(21, '12457', 'TBien', '10', '2012/2013', 'S2', '1245/AM');
INSERT INTO apreciation_prof VALUES(22, '65421', 'Trés bon Travail, éléve Sérieux, à Féliciter', '12', '2012/2013', 'S2', '124');
INSERT INTO apreciation_prof VALUES(23, '14274', 'ABien', '12', '2012/2013', 'S2', '124');
INSERT INTO apreciation_prof VALUES(24, '124242', 'Tbien,élève perturbateur', '12', '2012/2013', 'S2', '124');
INSERT INTO apreciation_prof VALUES(25, '12457', 'Tbien, Travailleur', '12', '2012/2013', 'S2', '124');

-- -----------------------------
-- insertions dans la table apreciations
-- -----------------------------
INSERT INTO apreciations VALUES(2, 'TRÃ‰S FAIBLE', '1', '5');

-- -----------------------------
-- insertions dans la table cahier_absence
-- -----------------------------
INSERT INTO cahier_absence VALUES('129/LO', 2012-11-28, '6', '2012/2013', 'S1', '');
INSERT INTO cahier_absence VALUES('14274', 2013-01-01, '12', '2012/2013', 'S1', '');
INSERT INTO cahier_absence VALUES('124242', 2013-01-01, '12', '2012/2013', 'S1', '');

-- -----------------------------
-- insertions dans la table cahier_retard
-- -----------------------------
INSERT INTO cahier_retard VALUES('65421', 2013-01-01, 13:28:51, '13', '2012/2013', 'S1', '478512/P');

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
INSERT INTO classes VALUES(67, '3', 'B', 'CE1B');
INSERT INTO classes VALUES(66, '3', 'A', 'CE1A');
INSERT INTO classes VALUES(65, '2', 'B', 'CPB');
INSERT INTO classes VALUES(64, '2', 'A', 'CPA');
INSERT INTO classes VALUES(63, '1', 'B', 'CIB');
INSERT INTO classes VALUES(62, '1', 'A', 'CIA');
INSERT INTO classes VALUES(61, '13', '', 'TleL2');
INSERT INTO classes VALUES(60, '12', '', '1erS2');
INSERT INTO classes VALUES(59, '11', '', '2ndL');
INSERT INTO classes VALUES(56, '9', 'B', '4i&eacute;meB');
INSERT INTO classes VALUES(58, '10', 'B', '3i&eacute;meB');
INSERT INTO classes VALUES(57, '10', 'A', '3i&eacute;meA');
INSERT INTO classes VALUES(55, '9', 'A', '4i&eacute;meA');
INSERT INTO classes VALUES(54, '8', '', '5i&eacute;me');
INSERT INTO classes VALUES(53, '7', 'B', '6i&eacute;meB');
INSERT INTO classes VALUES(52, '7', 'A', '6i&eacute;meA');
INSERT INTO classes VALUES(68, '4', 'A', 'CE2A');
INSERT INTO classes VALUES(69, '4', 'B', 'CE2B');
INSERT INTO classes VALUES(70, '5', 'A', 'CM1A');
INSERT INTO classes VALUES(71, '5', 'B', 'CM1B');
INSERT INTO classes VALUES(72, '6', 'A', 'CM2A');
INSERT INTO classes VALUES(73, '6', 'B', 'CM2B');

-- -----------------------------
-- insertions dans la table coefficients
-- -----------------------------
INSERT INTO coefficients VALUES(38, '2', '12', '10');
INSERT INTO coefficients VALUES(37, '2', '12', '9');
INSERT INTO coefficients VALUES(36, '2', '12', '8');
INSERT INTO coefficients VALUES(35, '2', '12', '7');
INSERT INTO coefficients VALUES(34, '2', '16', '10');
INSERT INTO coefficients VALUES(33, '2', '16', '9');
INSERT INTO coefficients VALUES(32, '1', '21', '10');
INSERT INTO coefficients VALUES(31, '1', '21', '9');
INSERT INTO coefficients VALUES(30, '1', '21', '8');
INSERT INTO coefficients VALUES(29, '1', '21', '7');
INSERT INTO coefficients VALUES(28, '4', '3', '7');
INSERT INTO coefficients VALUES(27, '4', '3', '8');
INSERT INTO coefficients VALUES(26, '4', '3', '9');
INSERT INTO coefficients VALUES(25, '4', '3', '10');
INSERT INTO coefficients VALUES(24, '2', '5', '7');
INSERT INTO coefficients VALUES(23, '2', '5', '8');
INSERT INTO coefficients VALUES(22, '2', '5', '9');
INSERT INTO coefficients VALUES(21, '2', '5', '10');
INSERT INTO coefficients VALUES(39, '2', '18', '9');
INSERT INTO coefficients VALUES(40, '2', '18', '10');
INSERT INTO coefficients VALUES(41, '5', '1', '10');
INSERT INTO coefficients VALUES(42, '5', '1', '9');
INSERT INTO coefficients VALUES(43, '5', '1', '8');
INSERT INTO coefficients VALUES(44, '5', '1', '7');
INSERT INTO coefficients VALUES(45, '2', '10', '10');
INSERT INTO coefficients VALUES(46, '2', '10', '9');
INSERT INTO coefficients VALUES(47, '2', '10', '8');
INSERT INTO coefficients VALUES(48, '2', '10', '7');
INSERT INTO coefficients VALUES(49, '2', '7', '10');
INSERT INTO coefficients VALUES(50, '2', '7', '9');
INSERT INTO coefficients VALUES(51, '2', '7', '8');
INSERT INTO coefficients VALUES(52, '2', '7', '7');
INSERT INTO coefficients VALUES(53, '2', '14', '10');
INSERT INTO coefficients VALUES(54, '2', '14', '9');
INSERT INTO coefficients VALUES(55, '2', '14', '8');
INSERT INTO coefficients VALUES(56, '2', '14', '7');

-- -----------------------------
-- insertions dans la table conduite
-- -----------------------------
INSERT INTO conduite VALUES('MOYEN');

-- -----------------------------
-- insertions dans la table connecter
-- -----------------------------
INSERT INTO connecter VALUES('654-op', 2013-03-01, 'PROFESSEUR');
INSERT INTO connecter VALUES('478512/P', 2013-03-01, 'SURVEILLANT');
INSERT INTO connecter VALUES('654-op', 2013-01-03, 'PROFESSEUR');
INSERT INTO connecter VALUES('478512/P', 2013-01-03, 'SURVEILLANT');
INSERT INTO connecter VALUES('654-op', 2012-12-26, 'PROFESSEUR');
INSERT INTO connecter VALUES('478512/P', 2012-12-26, 'SURVEILLANT');
INSERT INTO connecter VALUES('1427-bn', 2013-03-02, 'PROFESSEUR');
INSERT INTO connecter VALUES('124', 2013-03-02, 'PROFESSEUR');
INSERT INTO connecter VALUES('1245/AM', 2013-03-02, 'PROFESSEUR');

-- -----------------------------
-- insertions dans la table contact
-- -----------------------------
INSERT INTO contact VALUES(1, 1, '', 'Test Number', '', '', '000');

-- -----------------------------
-- insertions dans la table corps5
-- -----------------------------
INSERT INTO corps5 VALUES(1, 'corps12');

-- -----------------------------
-- insertions dans la table cours
-- -----------------------------
INSERT INTO cours VALUES('3i&eacute;meA', '5', 2012-11-28, 'test titre leÃ§on', '<p>detail test le&ccedil;on</p>', '2012/2013', 'S1');

-- -----------------------------
-- insertions dans la table credit_horaire
-- -----------------------------
INSERT INTO credit_horaire VALUES(52, '10', '20', '10', '10');
INSERT INTO credit_horaire VALUES(51, '10', '20', '10', '9');
INSERT INTO credit_horaire VALUES(50, '10', '20', '10', '8');
INSERT INTO credit_horaire VALUES(49, '10', '20', '10', '7');
INSERT INTO credit_horaire VALUES(48, '14', '30', '15', '10');
INSERT INTO credit_horaire VALUES(47, '14', '12', '6', '9');
INSERT INTO credit_horaire VALUES(46, '14', '10', '10', '8');
INSERT INTO credit_horaire VALUES(45, '14', '20', '20', '7');
INSERT INTO credit_horaire VALUES(44, '7', '15', '7', '10');
INSERT INTO credit_horaire VALUES(43, '7', '10', '5', '9');
INSERT INTO credit_horaire VALUES(42, '7', '20', '10', '8');
INSERT INTO credit_horaire VALUES(41, '7', '20', '10', '7');
INSERT INTO credit_horaire VALUES(40, '5', '20', '10', '10');
INSERT INTO credit_horaire VALUES(39, '5', '20', '10', '9');
INSERT INTO credit_horaire VALUES(38, '5', '20', '10', '8');
INSERT INTO credit_horaire VALUES(37, '5', '20', '10', '7');
INSERT INTO credit_horaire VALUES(36, '3', '40', '20', '10');
INSERT INTO credit_horaire VALUES(35, '3', '40', '20', '9');
INSERT INTO credit_horaire VALUES(34, '3', '40', '20', '8');
INSERT INTO credit_horaire VALUES(33, '3', '40', '20', '7');
INSERT INTO credit_horaire VALUES(32, '1', '10', '5', '10');
INSERT INTO credit_horaire VALUES(31, '1', '20', '10', '9');
INSERT INTO credit_horaire VALUES(30, '1', '20', '10', '8');
INSERT INTO credit_horaire VALUES(29, '1', '50', '25', '7');
INSERT INTO credit_horaire VALUES(53, '12', '20', '10', '7');
INSERT INTO credit_horaire VALUES(54, '12', '20', '10', '8');
INSERT INTO credit_horaire VALUES(55, '12', '10', '5', '9');
INSERT INTO credit_horaire VALUES(56, '12', '30', '15', '10');
INSERT INTO credit_horaire VALUES(57, '16', '0', '0', '7');
INSERT INTO credit_horaire VALUES(58, '16', '0', '0', '8');
INSERT INTO credit_horaire VALUES(59, '16', '20', '10', '9');
INSERT INTO credit_horaire VALUES(60, '16', '20', '10', '10');
INSERT INTO credit_horaire VALUES(61, '18', '0', '0', '7');
INSERT INTO credit_horaire VALUES(62, '18', '0', '0', '8');
INSERT INTO credit_horaire VALUES(63, '18', '20', '10', '9');
INSERT INTO credit_horaire VALUES(64, '18', '20', '10', '10');
INSERT INTO credit_horaire VALUES(65, '21', '10', '10', '7');
INSERT INTO credit_horaire VALUES(66, '21', '10', '10', '8');
INSERT INTO credit_horaire VALUES(67, '21', '10', '10', '9');
INSERT INTO credit_horaire VALUES(68, '21', '12', '12', '10');
INSERT INTO credit_horaire VALUES(69, '2', '30', '10', '11');
INSERT INTO credit_horaire VALUES(70, '2', '20', '10', '12');
INSERT INTO credit_horaire VALUES(71, '2', '50', '20', '13');
INSERT INTO credit_horaire VALUES(72, '4', '20', '10', '11');
INSERT INTO credit_horaire VALUES(73, '4', '50', '20', '12');
INSERT INTO credit_horaire VALUES(74, '4', '30', '15', '13');

-- -----------------------------
-- insertions dans la table decisions
-- -----------------------------
INSERT INTO decisions VALUES(1, 'ADMIS(E) EN CLASSE SUPÉRIEURE', 9.5, 21, '10');
INSERT INTO decisions VALUES(2, 'AUTORISÉ(E) À REDOUBLER EN CAS D`ECHEC', 8, 9.5, '10');

-- -----------------------------
-- insertions dans la table disciplines
-- -----------------------------
INSERT INTO disciplines VALUES(1, 'FRAN&Ccedil;AIS', 'MOYEN');
INSERT INTO disciplines VALUES(2, 'FRAN&Ccedil;AIS', 'SECONDAIRE');
INSERT INTO disciplines VALUES(3, 'MATH&Eacute;MATIQUES', 'MOYEN');
INSERT INTO disciplines VALUES(4, 'MATH&Eacute;MATIQUES', 'SECONDAIRE');
INSERT INTO disciplines VALUES(5, 'ANGLAIS', 'MOYEN');
INSERT INTO disciplines VALUES(6, 'ANGLAIS', 'SECONDAIRE');
INSERT INTO disciplines VALUES(7, 'HISTOIRE', 'MOYEN');
INSERT INTO disciplines VALUES(8, 'HISTOIRE', 'SECONDAIRE');
INSERT INTO disciplines VALUES(9, 'GEOGRAPHIE', 'ELEMENTAIRE');
INSERT INTO disciplines VALUES(10, 'GEOGRAPHIE', 'MOYEN');
INSERT INTO disciplines VALUES(11, 'GEOGRAPHIE', 'SECONDAIRE');
INSERT INTO disciplines VALUES(12, 'EPS', 'MOYEN');
INSERT INTO disciplines VALUES(13, 'EPS', 'SECONDAIRE');
INSERT INTO disciplines VALUES(14, 'SVT', 'MOYEN');
INSERT INTO disciplines VALUES(15, 'SVT', 'SECONDAIRE');
INSERT INTO disciplines VALUES(16, 'ARABE', 'MOYEN');
INSERT INTO disciplines VALUES(17, 'ARABE', 'SECONDAIRE');
INSERT INTO disciplines VALUES(18, 'ESPAGNOL', 'MOYEN');
INSERT INTO disciplines VALUES(19, 'ESPAGNOL', 'SECONDAIRE');
INSERT INTO disciplines VALUES(20, 'PHYLOSOPHIE', 'SECONDAIRE');
INSERT INTO disciplines VALUES(21, 'EDUCATION CIVIQUE', 'MOYEN');

-- -----------------------------
-- insertions dans la table echelons5
-- -----------------------------
INSERT INTO echelons5 VALUES(1, 'Echelon1');
INSERT INTO echelons5 VALUES(2, 'echelon2');

-- -----------------------------
-- insertions dans la table eleves
-- -----------------------------
INSERT INTO eleves VALUES('65421', 'KHADISSA', 'GOUDIABY', '2', 1996-10-05, 'YEUMBEUL', 'ANDALLA MBENGUE', 'amprojet@gmail.com', '7761260421', '', '', 'MÉDINA FASS MBAO', '', 'true');
INSERT INTO eleves VALUES('14274', 'LIMAMOU', 'KANE', '1', 1994-12-03, 'MÉDINA', 'ÉLIMA KANE', 'mbopame@yahoo.fr', '770333640', '', '', 'YEUMBEUL', '', 'true');
INSERT INTO eleves VALUES('124242', 'OUSMANE', 'KANE', '1', 1994-01-02, 'YEUMBEUL', 'PAPE KANE', 'andmbengue@hotmail.com', '766822529', '', '', 'MBOUR', '', 'true');
INSERT INTO eleves VALUES('12457', 'ELIASSE', 'Béye', '1', 1995-01-01, 'YEUMBEUL', 'MARÉMA SEYE', 'amprojet@gmail.com', '776126042', '', '', 'FASS MBAO', '', 'true');

-- -----------------------------
-- insertions dans la table email
-- -----------------------------

-- -----------------------------
-- insertions dans la table emailaccount
-- -----------------------------

-- -----------------------------
-- insertions dans la table emploi_temps
-- -----------------------------
INSERT INTO emploi_temps VALUES(15, 1, 08:00:00, 10:00:00, '3', '654-op', '2012/2013', '1', 'S2', '57');
INSERT INTO emploi_temps VALUES(14, 4, 15:00:00, 17:00:00, '3', '654-op', '2012/2013', '1', 'S1', '57');
INSERT INTO emploi_temps VALUES(12, 2, 08:00:00, 10:00:00, '3', '654-op', '2012/2013', '1', 'S1', '57');
INSERT INTO emploi_temps VALUES(11, 1, 15:00:00, 17:00:00, '5', '1427-bn', '2012/2013', '1', 'S1', '57');
INSERT INTO emploi_temps VALUES(13, 2, 12:00:00, 14:00:00, '7', '1245/AM', '2012/2013', '1', 'S1', '57');
INSERT INTO emploi_temps VALUES(9, 1, 08:00:00, 10:00:00, '1', '124', '2012/2013', '1', 'S1', '57');
INSERT INTO emploi_temps VALUES(16, 2, 10:00:00, 12:00:00, '3', '654-op', '2012/2013', '1', 'S2', '57');

-- -----------------------------
-- insertions dans la table enable5
-- -----------------------------
INSERT INTO enable5 VALUES(1, 'true');
INSERT INTO enable5 VALUES(2, 'retraite');
INSERT INTO enable5 VALUES(3, 'affectation');

-- -----------------------------
-- insertions dans la table enseignant
-- -----------------------------
INSERT INTO enseignant VALUES('', '', '');
INSERT INTO enseignant VALUES('1478-D', '71', '2012/2013');

-- -----------------------------
-- insertions dans la table enseigner
-- -----------------------------
INSERT INTO enseigner VALUES('654-op', '57', '3', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '58', '3', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '55', '3', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '56', '3', '2012/2013');
INSERT INTO enseigner VALUES('12354/54', '60', '4', '2012/2013');
INSERT INTO enseigner VALUES('12354/54', '59', '4', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '54', '14', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '52', '14', '2012/2013');
INSERT INTO enseigner VALUES('654-op', '53', '14', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '57', '5', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '58', '5', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '55', '5', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '56', '5', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '57', '18', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '58', '18', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '55', '18', '2012/2013');
INSERT INTO enseigner VALUES('1427-bn', '56', '18', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '57', '10', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '58', '10', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '55', '10', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '56', '10', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '57', '7', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '58', '7', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '55', '7', '2012/2013');
INSERT INTO enseigner VALUES('1245/AM', '56', '7', '2012/2013');
INSERT INTO enseigner VALUES('124', '57', '1', '2012/2013');
INSERT INTO enseigner VALUES('124', '58', '1', '2012/2013');
INSERT INTO enseigner VALUES('124', '55', '1', '2012/2013');
INSERT INTO enseigner VALUES('124', '56', '1', '2012/2013');
INSERT INTO enseigner VALUES('124', '57', '12', '2012/2013');
INSERT INTO enseigner VALUES('124', '58', '12', '2012/2013');
INSERT INTO enseigner VALUES('124', '55', '12', '2012/2013');
INSERT INTO enseigner VALUES('124', '56', '12', '2012/2013');

-- -----------------------------
-- insertions dans la table etablissements
-- -----------------------------
INSERT INTO etablissements VALUES(' DAKAR', ' GRAND YOFF', 'SAMIBOU', '', '', '2008-10-16', 'grand yoff', '338658585', '', '', '', 'contact@gmail.com', 'PRIVE', 2012-12-22);

-- -----------------------------
-- insertions dans la table etudes
-- -----------------------------
INSERT INTO etudes VALUES(1, 'CI', '', 'CI', 'ELEMENTAIRE');
INSERT INTO etudes VALUES(2, 'CP', '', 'CP', 'ELEMENTAIRE');
INSERT INTO etudes VALUES(3, 'CE1', '', 'CE1', 'ELEMENTAIRE');
INSERT INTO etudes VALUES(4, 'CE2', '', 'CE2', 'ELEMENTAIRE');
INSERT INTO etudes VALUES(5, 'CM1', '', 'CM1', 'ELEMENTAIRE');
INSERT INTO etudes VALUES(6, 'CM2', '', 'CM2', 'ELEMENTAIRE');
INSERT INTO etudes VALUES(7, '6i&eacute;me', '', '6i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES(8, '5i&eacute;me', '', '5i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES(9, '4i&eacute;me', '', '4i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES(10, '3i&eacute;me', '', '3i&eacute;me', 'MOYEN');
INSERT INTO etudes VALUES(11, '2nd', 'L', '2ndL', 'SECONDAIRE');
INSERT INTO etudes VALUES(12, '1er', 'S2', '1erS2', 'SECONDAIRE');
INSERT INTO etudes VALUES(13, 'Tle', 'L2', 'TleL2', 'SECONDAIRE');

-- -----------------------------
-- insertions dans la table evaluations
-- -----------------------------
INSERT INTO evaluations VALUES(9, 2013-03-07, 08:00:00, 10:00:00, '3', '57', 'COMPOSITION', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(8, 2013-03-04, 08:00:00, 10:00:00, '3', '57', 'DEVOIR', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(7, 2013-01-02, 08:00:00, 10:00:00, '3', '57', 'COMPOSITION', 'S1', '2012/2013', '1');
INSERT INTO evaluations VALUES(6, 2012-12-01, 08:00:00, 10:00:00, '3', '57', 'DEVOIR', 'S1', '2012/2013', '1');
INSERT INTO evaluations VALUES(10, 2013-03-09, 08:00:00, 10:00:00, '5', '57', 'DEVOIR', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(11, 2013-03-14, 08:00:00, 10:00:00, '18', '57', 'DEVOIR', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(12, 2013-03-12, 08:00:00, 10:00:00, '5', '57', 'COMPOSITION', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(13, 2013-03-19, 08:00:00, 10:00:00, '18', '57', 'COMPOSITION', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(14, 2013-03-14, 10:00:00, 12:00:00, '1', '57', 'DEVOIR', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(15, 2013-03-18, 08:00:00, 10:00:00, '1', '57', 'DEVOIR', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(16, 2013-03-22, 10:00:00, 12:00:00, '1', '57', 'COMPOSITION', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(17, 2013-03-16, 08:00:00, 10:00:00, '10', '57', 'DEVOIR', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(18, 2013-03-20, 10:00:00, 12:00:00, '10', '57', 'DEVOIR', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(19, 2013-04-06, 08:00:00, 10:00:00, '10', '57', 'COMPOSITION', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(20, 2013-03-28, 10:00:00, 12:00:00, '7', '57', 'DEVOIR', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(21, 2013-04-10, 08:00:00, 10:00:00, '7', '57', 'DEVOIR', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(22, 2013-05-01, 08:00:00, 10:00:00, '7', '57', 'COMPOSITION', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(23, 2013-04-20, 08:00:00, 10:00:00, '12', '57', 'DEVOIR', 'S2', '2012/2013', '1');
INSERT INTO evaluations VALUES(24, 2013-05-25, 10:00:00, 12:00:00, '12', '57', 'COMPOSITION', 'S2', '2012/2013', '1');

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
-- insertions dans la table form
-- -----------------------------

-- -----------------------------
-- insertions dans la table form_formfield
-- -----------------------------

-- -----------------------------
-- insertions dans la table formfield
-- -----------------------------

-- -----------------------------
-- insertions dans la table formresponse
-- -----------------------------

-- -----------------------------
-- insertions dans la table formresponse_responsevalue
-- -----------------------------

-- -----------------------------
-- insertions dans la table formules
-- -----------------------------
INSERT INTO formules VALUES('(MoySem1 + MoySem2)/2', '2');

-- -----------------------------
-- insertions dans la table frontline_group
-- -----------------------------

-- -----------------------------
-- insertions dans la table frontlinemultimediamessagepart
-- -----------------------------

-- -----------------------------
-- insertions dans la table grades5
-- -----------------------------
INSERT INTO grades5 VALUES(1, 'Grades1');

-- -----------------------------
-- insertions dans la table groupmembership
-- -----------------------------

-- -----------------------------
-- insertions dans la table honneurs
-- -----------------------------
INSERT INTO honneurs VALUES(2, 'BLAME', 1, 6);
INSERT INTO honneurs VALUES(3, 'AVERTISSEMENT', 6, 10);
INSERT INTO honneurs VALUES(4, 'TABLEAU D\'HONNEUR', 12, 13);
INSERT INTO honneurs VALUES(5, 'ENCOURAGEMENT', 13, 14);
INSERT INTO honneurs VALUES(6, 'FELICITATION', 14, 16);

-- -----------------------------
-- insertions dans la table horaires
-- -----------------------------

-- -----------------------------
-- insertions dans la table inscription
-- -----------------------------
INSERT INTO inscription VALUES('12457', '57', 'OUI', 2013-01-01, '2012/2013', '478512/P');
INSERT INTO inscription VALUES('124242', '57', 'NON', 2013-01-01, '2012/2013', '478512/P');
INSERT INTO inscription VALUES('14274', '57', 'NON', 2013-01-01, '2012/2013', '478512/P');
INSERT INTO inscription VALUES('65421', '57', 'OUI', 2013-01-01, '2012/2013', '478512/P');

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
-- insertions dans la table keyword
-- -----------------------------
INSERT INTO keyword VALUES(1, '', '');
INSERT INTO keyword VALUES(2, '', '<MMS>');

-- -----------------------------
-- insertions dans la table keywordaction
-- -----------------------------

-- -----------------------------
-- insertions dans la table matrimonial5
-- -----------------------------
INSERT INTO matrimonial5 VALUES(1, 'MariÃ©(e)');
INSERT INTO matrimonial5 VALUES(2, 'DivorcÃ©(e)');
INSERT INTO matrimonial5 VALUES(3, 'CÃ©libataire');
INSERT INTO matrimonial5 VALUES(4, 'Veuf(ve)');

-- -----------------------------
-- insertions dans la table message
-- -----------------------------
INSERT INTO message VALUES(1, 'ANDALLA MBENGUE', '+221776126042', 'PERSONNEL', '654-op PROFESSEUR', '2012201220122012-121', 2012-12-16 10:37:57, '', '', '', , , '', , , , '', , '');
INSERT INTO message VALUES(2, 'NGOUDA SARR', '+221774699099', 'PERSONNEL', '12354/A CENSEUR
- hrakotoarison@gmail.com
- Vous pouvez repondre', '2012201220122012-121', 2012-12-17 20:16:24, '', '', '', , , '', , , , '', , '');
INSERT INTO message VALUES(3, '', '+221779569485', '${keyword}', ' PERSONNEL 1270/AN SURVEILLANT', '2012201220122012-121', 2012-12-17 20:22:55, '', '', '', , , '', , , , '', , '');
INSERT INTO message VALUES(4, 'ABOUL AZIZ WADE', '+221779569485', 'PERSONNEL', '1270/AN SURVEILLANT', '2012201220122012-121', 2012-12-17 20:26:59, '', '', '', , , '', , , , '', , '');
INSERT INTO message VALUES(5, '', '', '', '', '1362422977054', 2013-03-04 18:49:37, '', 'FrontlineMessage', '+447716355738', 0, 0, '', 0, , 2, '? amprojet@gmail.com,1.6.16.3,AAABOnjeXLg,Windows NT (unknown) 6.1,04/12/2012,1,0,0,0,0,1,0,0,', 3, '');

-- -----------------------------
-- insertions dans la table message_frontlinemultimediamessagepart
-- -----------------------------

-- -----------------------------
-- insertions dans la table modulaire
-- -----------------------------

-- -----------------------------
-- insertions dans la table modules
-- -----------------------------

-- -----------------------------
-- insertions dans la table moyennediscipline
-- -----------------------------
INSERT INTO moyennediscipline VALUES('65421', 12, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 16, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 21, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 3, 13.500, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 5, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 18, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 1, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 10, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 7, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 14, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 12, 20.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 16, 0.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 21, 0.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 3, 15.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 5, 20.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 18, 20.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 1, 20.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 10, 19.250, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 7, 20.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('65421', 14, 0.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 12, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 16, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 21, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 3, 7.500, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 5, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 18, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 1, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 10, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 7, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 14, 0.000, 'S1', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 12, 16.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 16, 0.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 21, 0.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 3, 20.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 5, 14.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 18, 15.500, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 1, 15.000, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 10, 16.750, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 7, 12.250, 'S2', '2012/2013');
INSERT INTO moyennediscipline VALUES('124242', 14, 0.000, 'S2', '2012/2013');

-- -----------------------------
-- insertions dans la table moyennes
-- -----------------------------
INSERT INTO moyennes VALUES('124242', 1.92, 'S1', '2012/2013');
INSERT INTO moyennes VALUES('124242', 12.85, 'S2', '2012/2013');
INSERT INTO moyennes VALUES('65421', 2.84, 'S1', '2012/2013');
INSERT INTO moyennes VALUES('65421', 15.02, 'S2', '2012/2013');

-- -----------------------------
-- insertions dans la table note_conduite
-- -----------------------------
INSERT INTO note_conduite VALUES('65421', '18', 'S2', '2012/2013', 4, '478512/P');
INSERT INTO note_conduite VALUES('14274', '17', 'S2', '2012/2013', 5, '478512/P');
INSERT INTO note_conduite VALUES('124242', '18', 'S2', '2012/2013', 6, '478512/P');
INSERT INTO note_conduite VALUES('12457', '12', 'S2', '2012/2013', 7, '478512/P');
INSERT INTO note_conduite VALUES('65421', '15', 'S2', '2012/2013', 8, '1427-bn');
INSERT INTO note_conduite VALUES('14274', '12', 'S2', '2012/2013', 9, '1427-bn');
INSERT INTO note_conduite VALUES('124242', '15', 'S2', '2012/2013', 10, '1427-bn');
INSERT INTO note_conduite VALUES('12457', '12', 'S2', '2012/2013', 11, '1427-bn');
INSERT INTO note_conduite VALUES('65421', '17', 'S2', '2012/2013', 12, '124');
INSERT INTO note_conduite VALUES('14274', '15', 'S2', '2012/2013', 13, '124');
INSERT INTO note_conduite VALUES('124242', '18', 'S2', '2012/2013', 14, '124');
INSERT INTO note_conduite VALUES('12457', '10', 'S2', '2012/2013', 15, '124');
INSERT INTO note_conduite VALUES('65421', '18', 'S2', '2012/2013', 16, '1245/AM');
INSERT INTO note_conduite VALUES('14274', '18', 'S2', '2012/2013', 17, '1245/AM');
INSERT INTO note_conduite VALUES('124242', '18', 'S2', '2012/2013', 18, '1245/AM');
INSERT INTO note_conduite VALUES('12457', '18', 'S2', '2012/2013', 19, '1245/AM');
INSERT INTO note_conduite VALUES('12457', '17', 'S1', '2012/2013', 27, '478512/P');
INSERT INTO note_conduite VALUES('124242', '18', 'S1', '2012/2013', 26, '478512/P');
INSERT INTO note_conduite VALUES('14274', '15', 'S1', '2012/2013', 25, '478512/P');
INSERT INTO note_conduite VALUES('65421', '17', 'S1', '2012/2013', 24, '478512/P');

-- -----------------------------
-- insertions dans la table notes
-- -----------------------------
INSERT INTO notes VALUES('65421', '12', '6', 1);
INSERT INTO notes VALUES('14274', '15', '6', 2);
INSERT INTO notes VALUES('124242', '0', '6', 3);
INSERT INTO notes VALUES('12457', '0', '6', 4);
INSERT INTO notes VALUES('65421', '15', '7', 5);
INSERT INTO notes VALUES('14274', '12', '7', 6);
INSERT INTO notes VALUES('124242', '15', '7', 7);
INSERT INTO notes VALUES('12457', '10', '7', 8);
INSERT INTO notes VALUES('65421', '15', '8', 9);
INSERT INTO notes VALUES('14274', '17', '8', 10);
INSERT INTO notes VALUES('124242', '20', '8', 11);
INSERT INTO notes VALUES('12457', '10', '8', 12);
INSERT INTO notes VALUES('65421', '15', '9', 13);
INSERT INTO notes VALUES('14274', '10', '9', 14);
INSERT INTO notes VALUES('124242', '20', '9', 15);
INSERT INTO notes VALUES('12457', '10', '9', 16);
INSERT INTO notes VALUES('124242', '18', '10', 103);
INSERT INTO notes VALUES('14274', '15', '10', 102);
INSERT INTO notes VALUES('65421', '20', '10', 101);
INSERT INTO notes VALUES('65421', '20', '11', 21);
INSERT INTO notes VALUES('14274', '10', '11', 22);
INSERT INTO notes VALUES('124242', '18', '11', 23);
INSERT INTO notes VALUES('12457', '18', '11', 24);
INSERT INTO notes VALUES('124242', '10', '12', 99);
INSERT INTO notes VALUES('14274', '20', '12', 98);
INSERT INTO notes VALUES('65421', '20', '12', 97);
INSERT INTO notes VALUES('124242', '13', '13', 95);
INSERT INTO notes VALUES('14274', '15', '13', 94);
INSERT INTO notes VALUES('65421', '20', '13', 93);
INSERT INTO notes VALUES('124242', '10', '14', 83);
INSERT INTO notes VALUES('14274', '12', '14', 82);
INSERT INTO notes VALUES('65421', '20', '14', 81);
INSERT INTO notes VALUES('65421', '20', '15', 79);
INSERT INTO notes VALUES('14274', '15', '15', 78);
INSERT INTO notes VALUES('124242', '15', '16', 71);
INSERT INTO notes VALUES('14274', '17', '16', 70);
INSERT INTO notes VALUES('65421', '20', '16', 69);
INSERT INTO notes VALUES('65421', '20', '17', 116);
INSERT INTO notes VALUES('14274', '15.75', '17', 115);
INSERT INTO notes VALUES('124242', '18', '17', 114);
INSERT INTO notes VALUES('12457', '20', '17', 113);
INSERT INTO notes VALUES('65421', '17', '18', 49);
INSERT INTO notes VALUES('14274', '15', '18', 50);
INSERT INTO notes VALUES('124242', '15', '18', 51);
INSERT INTO notes VALUES('12457', '17', '18', 52);
INSERT INTO notes VALUES('124242', '14', '20', 119);
INSERT INTO notes VALUES('14274', '14', '20', 118);
INSERT INTO notes VALUES('65421', '20', '20', 117);
INSERT INTO notes VALUES('124242', '15', '21', 123);
INSERT INTO notes VALUES('14274', '12', '21', 122);
INSERT INTO notes VALUES('65421', '20', '21', 121);
INSERT INTO notes VALUES('65421', '20', '19', 61);
INSERT INTO notes VALUES('14274', '18', '19', 62);
INSERT INTO notes VALUES('124242', '17', '19', 63);
INSERT INTO notes VALUES('12457', '15', '19', 64);
INSERT INTO notes VALUES('124242', '10', '22', 107);
INSERT INTO notes VALUES('14274', '17', '22', 106);
INSERT INTO notes VALUES('65421', '20', '22', 105);
INSERT INTO notes VALUES('12457', '18.75', '16', 72);
INSERT INTO notes VALUES('124242', '20', '15', 77);
INSERT INTO notes VALUES('12457', '8', '15', 80);
INSERT INTO notes VALUES('12457', '15', '14', 84);
INSERT INTO notes VALUES('65421', '20', '23', 85);
INSERT INTO notes VALUES('14274', '15', '23', 86);
INSERT INTO notes VALUES('124242', '17', '23', 87);
INSERT INTO notes VALUES('12457', '18', '23', 88);
INSERT INTO notes VALUES('65421', '20', '24', 89);
INSERT INTO notes VALUES('14274', '12', '24', 90);
INSERT INTO notes VALUES('124242', '15', '24', 91);
INSERT INTO notes VALUES('12457', '15', '24', 92);
INSERT INTO notes VALUES('12457', '15', '13', 96);
INSERT INTO notes VALUES('12457', '15', '12', 100);
INSERT INTO notes VALUES('12457', '10', '10', 104);
INSERT INTO notes VALUES('12457', '15', '22', 108);
INSERT INTO notes VALUES('12457', '15', '20', 120);
INSERT INTO notes VALUES('12457', '17', '21', 124);

-- -----------------------------
-- insertions dans la table passer
-- -----------------------------

-- -----------------------------
-- insertions dans la table periodes
-- -----------------------------

-- -----------------------------
-- insertions dans la table personnels
-- -----------------------------
INSERT INTO personnels VALUES('654-op', '1', 'ANDALLA', 'MBENGUE', '1', '1', '1983-08-02', 'YEUMBEUL', '776126042', 'FASS MBAO, TALLY MAME DIARA, Q MODOU FALL', 'amprojet@gmail.com', 'perso654-op.JPG', '1', '1', '1', '2', '2012-11-06');
INSERT INTO personnels VALUES('4578-az', '3', 'NDÉYE', 'COLY', '3', '2', '1985-10-12', 'YEUMBEIL', '776541243', 'FASS MBAO', 'colynd@yahoo.fr', '', '1', '1', '1', '2', '2010-10-01');
INSERT INTO personnels VALUES('1427-bn', '1', 'ALIOUNE', 'GUEYE', '3', '1', '1990-10-01', 'SAINT LOUIS', '766521245', 'HLM GRAND YOFF', 'kothie@gmail.com', 'perso1427-bn.jpg', '1', '1', '1', '1', '2011-10-01');
INSERT INTO personnels VALUES('12354/A', '1', 'NGOUDA', 'SARR', '1', '1', '1980-10-08', 'CAMBÉRÉNE1', '766521245', 'CAMBÃ‰RÃ‰NE1', 'keurama@gmail.com', 'perso12354-A.JPG', '1', '1', '1', '1', '2008-10-01');
INSERT INTO personnels VALUES('478512/P', '2', 'ALIMATOU', 'MBAYE', '1', '2', '1978-07-01', 'BAMBÉYE', '778569210', 'PARCELLE ASSAINIE U14', 'alima@yahoo.fr', 'perso478512-P.jpg', '1', '1', '1', '2', '2008-10-01');
INSERT INTO personnels VALUES('1245/AM', '1', 'SAMBA', 'FALL', '3', '1', '1984-01-12', 'LOUGA', '776124875', 'PA U22 N°15', 'samba@gmail.com', '', '1', '1', '1', '1', '2009-10-01');
INSERT INTO personnels VALUES('1271/OP', '1', 'TAPHA', 'SYLLA', '3', '1', '1977-08-15', 'DAKAR,MÃ‰DINA', '776854582', 'MÃ‰DINA', 'taf47@yahoo.fr', '', '1', '1', '1', '1', '2000-10-01');
INSERT INTO personnels VALUES('12354/54', '1', 'NDIAGA', 'COLY', '3', '1', '1983-08-06', 'DAKAR', '776126042', 'FASS', 'colynd@gmail.com', '', '1', '1', '1', '1', '2007-09-03');
INSERT INTO personnels VALUES('124', '3', 'MARÉMA', 'SEYE', '1', '2', '1969-12-06', 'KOLDA', '776126042', 'FASS MBAO', 'and@gmail.com', '', '1', '1', '1', '1', '2009-12-06');
INSERT INTO personnels VALUES('1270/AN', '1', 'ABOUL AZIZ', 'WADE', '1', '1', '1972-09-02', 'KEUR MASSAR', '776126042', 'KEUR MASSAR', 'wadesoft@gmail.com', '', '1', '1', '1', '1', '2002-10-04');
INSERT INTO personnels VALUES('1478-D', '1', 'NDIAGA', 'FALL', '1', '1', '1983-12-02', 'GUÉOUL', '776124585', 'GUÉOUL,QUARTIER GUÉMBÉ', 'falldiaga@yahoo.fr', '', '1', '1', '1', '1', '2010-10-01');

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
INSERT INTO remarques VALUES(2, 'ELEVE TRES FAIBLE', 1, 7);
INSERT INTO remarques VALUES(3, 'ELEVE FAIBLE', 7, 10);
INSERT INTO remarques VALUES(4, 'ELEVE PASSABLE', 10, 12);
INSERT INTO remarques VALUES(5, 'ASSEZ BON ELEVE', 12, 14);
INSERT INTO remarques VALUES(6, 'BON ELEVE', 14, 16);
INSERT INTO remarques VALUES(7, 'TRES BON ELEVE', 16, 18);
INSERT INTO remarques VALUES(8, 'EXCELLENT(E) ELEVE', 18, 21);

-- -----------------------------
-- insertions dans la table reminder
-- -----------------------------

-- -----------------------------
-- insertions dans la table responsevalue
-- -----------------------------

-- -----------------------------
-- insertions dans la table retard
-- -----------------------------

-- -----------------------------
-- insertions dans la table salles
-- -----------------------------
INSERT INTO salles VALUES(1, 'SALLE1', '100');
INSERT INTO salles VALUES(2, 'SALLE2', '150');
INSERT INTO salles VALUES(5, 'SALLE3', '50');

-- -----------------------------
-- insertions dans la table semestres
-- -----------------------------
INSERT INTO semestres VALUES('S1', 'PREMIER SEMESTRE', 2012-10-04, 2013-02-28, 'SUPERIEURE', '2012/2013');
INSERT INTO semestres VALUES('S2', 'SECOND SEMESTRE', 2013-03-01, 2013-07-31, 'SUPERIEURE', '2012/2013');

-- -----------------------------
-- insertions dans la table series
-- -----------------------------
INSERT INTO series VALUES(1, 'L');
INSERT INTO series VALUES(2, 'S');
INSERT INTO series VALUES(3, 'S2');
INSERT INTO series VALUES(4, 'L2');

-- -----------------------------
-- insertions dans la table sexe5
-- -----------------------------
INSERT INTO sexe5 VALUES(1, 'Masculin');
INSERT INTO sexe5 VALUES(2, 'FÃ©minin');

-- -----------------------------
-- insertions dans la table smsinternetservicesettings
-- -----------------------------

-- -----------------------------
-- insertions dans la table smsinternetservicesettings_smsinternetservicesettingvalue
-- -----------------------------

-- -----------------------------
-- insertions dans la table smsinternetservicesettingvalue
-- -----------------------------

-- -----------------------------
-- insertions dans la table smsmodemsettings
-- -----------------------------

-- -----------------------------
-- insertions dans la table specialites
-- -----------------------------
INSERT INTO specialites VALUES(1, '654-op', '3');
INSERT INTO specialites VALUES(2, '12354/54', '4');
INSERT INTO specialites VALUES(3, '654-op', '14');
INSERT INTO specialites VALUES(4, '1427-bn', '5');
INSERT INTO specialites VALUES(5, '1427-bn', '18');
INSERT INTO specialites VALUES(6, '1245/AM', '10');
INSERT INTO specialites VALUES(7, '1245/AM', '7');
INSERT INTO specialites VALUES(8, '124', '1');
INSERT INTO specialites VALUES(9, '124', '12');

-- -----------------------------
-- insertions dans la table surveiller
-- -----------------------------
INSERT INTO surveiller VALUES('478512/P', '55', '2012/2013');
INSERT INTO surveiller VALUES('478512/P', '56', '2012/2013');
INSERT INTO surveiller VALUES('478512/P', '57', '2012/2013');
INSERT INTO surveiller VALUES('478512/P', '58', '2012/2013');

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

