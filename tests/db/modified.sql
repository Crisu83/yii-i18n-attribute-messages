DROP TABLE IF EXISTS `chapter`;
DROP TABLE IF EXISTS `book`;
DROP TABLE IF EXISTS `image`;

CREATE TABLE `image` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `path` VARCHAR(255) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) );

CREATE TABLE `book` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `_title` VARCHAR(255) NULL DEFAULT NULL ,
  `_slug` VARCHAR(255) NULL DEFAULT NULL ,
  `image_id` BIGINT(20) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_book_image1`
    FOREIGN KEY (`image_id` )
    REFERENCES `image` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE `chapter` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT ,
  `_title` VARCHAR(255) NULL DEFAULT NULL ,
  `_slug` VARCHAR(255) NULL DEFAULT NULL ,
  `_book_id` BIGINT(20) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_chapter_book`
    FOREIGN KEY (`_book_id` )
    REFERENCES `book` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

DROP TABLE IF EXISTS `Message`;
DROP TABLE IF EXISTS `SourceMessage`;

CREATE TABLE `SourceMessage` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(32) NULL DEFAULT NULL,
  `message` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
COLLATE = utf8_bin;

CREATE TABLE `Message` (
  `id` INT(11) NOT NULL DEFAULT '0',
  `language` VARCHAR(16) NOT NULL DEFAULT '',
  `translation` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `language`),
  CONSTRAINT `FK_Message_SourceMessage`
    FOREIGN KEY (`id`)
    REFERENCES `SourceMessage` (`id`)
    ON DELETE CASCADE)
COLLATE = utf8_bin;