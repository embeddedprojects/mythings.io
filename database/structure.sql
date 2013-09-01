-- Adminer 3.7.0 MySQL dump

SET NAMES utf8;

DROP TABLE IF EXISTS `datei`;
CREATE TABLE `datei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datei` int(11) NOT NULL,
  `inhalt` blob NOT NULL,
  `titel` text NOT NULL,
  `beschreibung` text NOT NULL,
  `checksum` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `datei_stichwoerter`;
CREATE TABLE `datei_stichwoerter` (
  `datei` int(11) NOT NULL,
  `subjekt` varchar(255) NOT NULL,
  `artikel` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `thumbnailname` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` longblob NOT NULL,
  `imagetype` varchar(255) NOT NULL,
  `thumbnail` longblob NOT NULL,
  `thumbnailtype` varchar(255) NOT NULL,
  `datum` datetime NOT NULL,
  `thumbnaildatum` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kundendaten`;
CREATE TABLE `kundendaten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT 'benutzer',
  `name` varchar(255) NOT NULL,
  `firmenname` varchar(255) NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `kontoinhaber` varchar(255) NOT NULL,
  `konto` varchar(255) NOT NULL,
  `blz` varchar(255) NOT NULL,
  `institut` varchar(255) NOT NULL,
  `bic` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `paypal` varchar(255) NOT NULL,
  `kreditkartetyp` varchar(255) NOT NULL,
  `kreditkartennummer` varchar(255) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `pdf` int(1) NOT NULL,
  `journal` varchar(255) NOT NULL DEFAULT '0',
  `verlosung` varchar(255) NOT NULL DEFAULT '0',
  `newsletter` int(1) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `postbote` tinyint(1) NOT NULL DEFAULT '0',
  `sponsoring` tinyint(1) NOT NULL DEFAULT '0',
  `stellenanzeige` varchar(1) NOT NULL DEFAULT '0',
  `ticket` varchar(255) NOT NULL,
  `kundennummer` varchar(255) NOT NULL,
  `aktiv` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_id` int(11) DEFAULT '0',
  `description` varchar(100) DEFAULT NULL,
  `theme` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `keywords` varchar(250) NOT NULL DEFAULT '',
  `searchdes` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=0;


DROP TABLE IF EXISTS `pagevars`;
CREATE TABLE `pagevars` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL DEFAULT '',
  `name` varchar(200) NOT NULL DEFAULT '',
  `defvalue` text NOT NULL,
  `kind` varchar(20) NOT NULL DEFAULT 'page',
  `viewid` int(10) NOT NULL DEFAULT '0',
  `type` enum('file','row','text','image') NOT NULL DEFAULT 'file',
  `state` enum('public','private') NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Extra Parse Variablen abhÃ¤ngig von der Page';


DROP TABLE IF EXISTS `scans`;
CREATE TABLE `scans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `barcode` text NOT NULL,
  `description` text NOT NULL,
  `direction` int(1) NOT NULL,
  `image` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `shopnavigation`;
CREATE TABLE `shopnavigation` (
  `id` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `bezeichnung_en` varchar(255) NOT NULL,
  `plugin` varchar(255) NOT NULL,
  `pluginparameter` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `repassword` int(1) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `settings` text NOT NULL,
  `parentuser` int(11) DEFAULT NULL,
  `activ` int(11) DEFAULT '0',
  `type` varchar(100) DEFAULT '',
  `statusmails` int(1) NOT NULL DEFAULT '0',
  `adresse` int(10) NOT NULL,
  `kundendaten` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `useronline`;
CREATE TABLE `useronline` (
  `user_id` int(5) NOT NULL DEFAULT '0',
  `login` int(1) NOT NULL DEFAULT '0',
  `sessionid` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(200) NOT NULL DEFAULT '',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 2013-06-16 20:15:56

