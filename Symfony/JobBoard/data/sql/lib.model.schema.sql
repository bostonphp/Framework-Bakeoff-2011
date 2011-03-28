
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- categories
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;


CREATE TABLE `categories`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `categories_U_1` (`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- jobs
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;


CREATE TABLE `jobs`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`location` VARCHAR(255),
	`company` VARCHAR(255)  NOT NULL,
	`email` VARCHAR(255)  NOT NULL,
	`category_id` INTEGER  NOT NULL,
	`title` VARCHAR(255),
	`keywords` VARCHAR(255),
	`position` TEXT,
	`description` TEXT,
	`token` VARCHAR(255),
	`is_activated` TINYINT default 0 NOT NULL,
	`agree_terms` TINYINT default 0 NOT NULL,
	`expires_at` DATETIME,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `jobs_U_1` (`token`),
	INDEX `jobs_FI_1` (`category_id`),
	CONSTRAINT `jobs_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `categories` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- job_index
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `job_index`;


CREATE TABLE `job_index`
(
	`term` VARCHAR(255)  NOT NULL,
	`job_id` INTEGER  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `job_index_FI_1` (`job_id`),
	CONSTRAINT `job_index_FK_1`
		FOREIGN KEY (`job_id`)
		REFERENCES `jobs` (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
