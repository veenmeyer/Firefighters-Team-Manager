CREATE TABLE IF NOT EXISTS `#__firefighters_abteilungen` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`name` VARCHAR(500)  NOT NULL ,
`bild` VARCHAR(255)  NOT NULL ,
`beschreibung` TEXT NOT NULL ,
`abteilung_farbe` VARCHAR(255)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__firefighters_dienstgrade` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`name` VARCHAR(500)  NOT NULL ,
`bild` VARCHAR(255)  NOT NULL ,
`beschreibung` TEXT NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__firefighters_ausbildungen` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`name` VARCHAR(500)  NOT NULL ,
`bild` VARCHAR(255)  NOT NULL ,
`beschreibung` TEXT NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__firefighters` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`name` VARCHAR(500)  NOT NULL ,
`vorname` VARCHAR(500)  NOT NULL ,
`name_eiko` VARCHAR(500)  NOT NULL ,
`bild` VARCHAR(255)  NOT NULL ,
`dienstgrad` INT NOT NULL ,
`abteilungen` TEXT NOT NULL ,
`kommando` TINYINT(1)  NOT NULL ,
`funktion` VARCHAR(500)  NOT NULL ,
`mehr_funktionen` VARCHAR(500)  NOT NULL ,
`ausbildungen` TEXT NOT NULL ,
`geburtsdatum` DATE NOT NULL ,
`eintrittsdatum` DATE NOT NULL ,
`austrittsdatum` DATE NOT NULL ,
`emailadresse` VARCHAR(255)  NOT NULL ,
`missions_eiko` TEXT NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__firefighters_termine` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`name` VARCHAR(500)  NOT NULL ,
`bild` VARCHAR(255)  NOT NULL ,
`email` TINYINT(1)  NOT NULL ,
`abteilungen` TEXT NOT NULL ,
`beschreibung` TEXT NOT NULL ,
`datum_start` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`datum_ende` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`email_gesendet` TINYINT(10)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

