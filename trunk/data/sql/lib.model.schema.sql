
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- isern_organizations
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `isern_organizations`;


CREATE TABLE `isern_organizations`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`organization_type_id` INTEGER,
	`name` VARCHAR(255),
	`country` VARCHAR(100),
	`home_page` VARCHAR(255),
	`research_keywords` VARCHAR(255),
	`research_description` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `isern_organizations_FI_1` (`organization_type_id`),
	CONSTRAINT `isern_organizations_FK_1`
		FOREIGN KEY (`organization_type_id`)
		REFERENCES `isern_organization_types` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- isern_researchers
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `isern_researchers`;


CREATE TABLE `isern_researchers`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`organization_id` INTEGER,
	`name` VARCHAR(255),
	`email` VARCHAR(255),
	`picture_link` VARCHAR(255),
	`bio_statement` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `isern_researchers_FI_1` (`organization_id`),
	CONSTRAINT `isern_researchers_FK_1`
		FOREIGN KEY (`organization_id`)
		REFERENCES `isern_organizations` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- isern_collaborations
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `isern_collaborations`;


CREATE TABLE `isern_collaborations`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`description` TEXT,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- isern_collaboration_years
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `isern_collaboration_years`;


CREATE TABLE `isern_collaboration_years`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`collaboration_id` INTEGER,
	`year` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `isern_collaboration_years_FI_1` (`collaboration_id`),
	CONSTRAINT `isern_collaboration_years_FK_1`
		FOREIGN KEY (`collaboration_id`)
		REFERENCES `isern_collaborations` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- isern_organization_types
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `isern_organization_types`;


CREATE TABLE `isern_organization_types`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- isern_collaborating_organizations
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `isern_collaborating_organizations`;


CREATE TABLE `isern_collaborating_organizations`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`collaboration_id` INTEGER,
	`organization_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `isern_collaborating_organizations_FI_1` (`collaboration_id`),
	CONSTRAINT `isern_collaborating_organizations_FK_1`
		FOREIGN KEY (`collaboration_id`)
		REFERENCES `isern_collaborations` (`id`),
	INDEX `isern_collaborating_organizations_FI_2` (`organization_id`),
	CONSTRAINT `isern_collaborating_organizations_FK_2`
		FOREIGN KEY (`organization_id`)
		REFERENCES `isern_organizations` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- isern_users
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `isern_users`;


CREATE TABLE `isern_users`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`login` VARCHAR(50),
	`password` VARCHAR(50),
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- isern_collaboration_outcome_types
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `isern_collaboration_outcome_types`;


CREATE TABLE `isern_collaboration_outcome_types`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`collaboration_id` INTEGER,
	`outcome_type` VARCHAR(50),
	PRIMARY KEY (`id`),
	INDEX `isern_collaboration_outcome_types_FI_1` (`collaboration_id`),
	CONSTRAINT `isern_collaboration_outcome_types_FK_1`
		FOREIGN KEY (`collaboration_id`)
		REFERENCES `isern_collaborations` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- isern_organization_researcher_keywords
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `isern_organization_researcher_keywords`;


CREATE TABLE `isern_organization_researcher_keywords`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`organization_id` INTEGER,
	`keyword` VARCHAR(50),
	PRIMARY KEY (`id`),
	INDEX `isern_organization_researcher_keywords_FI_1` (`organization_id`),
	CONSTRAINT `isern_organization_researcher_keywords_FK_1`
		FOREIGN KEY (`organization_id`)
		REFERENCES `isern_organizations` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- isern_collaboration_types
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `isern_collaboration_types`;


CREATE TABLE `isern_collaboration_types`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`collaboration_id` INTEGER,
	`collaboration_type` VARCHAR(50),
	PRIMARY KEY (`id`),
	INDEX `isern_collaboration_types_FI_1` (`collaboration_id`),
	CONSTRAINT `isern_collaboration_types_FK_1`
		FOREIGN KEY (`collaboration_id`)
		REFERENCES `isern_collaborations` (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
