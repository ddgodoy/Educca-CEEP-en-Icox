
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_simple_forum_category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_simple_forum_category`;


CREATE TABLE `sf_simple_forum_category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`stripped_name` VARCHAR(255),
	`description` TEXT,
	`rank` INTEGER,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_simple_forum_forum
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_simple_forum_forum`;


CREATE TABLE `sf_simple_forum_forum`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`stripped_name` VARCHAR(255),
	`description` TEXT,
	`rank` INTEGER,
	`category_id` INTEGER,
	`curso_id` BIGINT,
	`created_at` DATETIME,
	`nb_posts` BIGINT,
	`nb_threads` BIGINT,
	`latest_reply_author_name` VARCHAR(255),
	`latest_replied_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sf_simple_forum_forum_FI_1` (`category_id`),
	CONSTRAINT `sf_simple_forum_forum_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `sf_simple_forum_category` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_simple_forum_forum_FI_2` (`curso_id`),
	CONSTRAINT `sf_simple_forum_forum_FK_2`
		FOREIGN KEY (`curso_id`)
		REFERENCES `curso` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_simple_forum_post
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_simple_forum_post`;


CREATE TABLE `sf_simple_forum_post`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`content` TEXT,
	`is_sticked` INTEGER default 0,
	`user_id` BIGINT,
	`forum_id` INTEGER,
	`parent_id` INTEGER,
	`created_at` DATETIME,
	`stripped_title` VARCHAR(255),
	`author_name` VARCHAR(255),
	`nb_replies` BIGINT,
	`nb_views` BIGINT,
	`latest_reply_author_name` VARCHAR(255),
	`latest_replied_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `sf_simple_forum_post_FI_1` (`user_id`),
	CONSTRAINT `sf_simple_forum_post_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `usuario` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_simple_forum_post_FI_2` (`forum_id`),
	CONSTRAINT `sf_simple_forum_post_FK_2`
		FOREIGN KEY (`forum_id`)
		REFERENCES `sf_simple_forum_forum` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_simple_forum_post_FI_3` (`parent_id`),
	CONSTRAINT `sf_simple_forum_post_FK_3`
		FOREIGN KEY (`parent_id`)
		REFERENCES `sf_simple_forum_post` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
