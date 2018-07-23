USE `%database%` ;

-- -----------------------------------------------------
-- Table `wesic`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(255) NOT NULL,
  `lastname` VARCHAR(45) NULL,
  `firstname` VARCHAR(45) NULL,
  `role` TINYINT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `status` TINYINT NOT NULL,
  `token` VARCHAR(200) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`slug`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`slug` (
  `slug` VARCHAR(200) NOT NULL,
  `type` TINYINT NOT NULL,
  PRIMARY KEY (`slug`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`media` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(125) NOT NULL,
  `path` VARCHAR(500) NULL,
  `type` TINYINT NOT NULL,
  `caption` VARCHAR(255) NULL,
  `alttext` VARCHAR(255) NULL,
  `description` VARCHAR(255) NULL,
  `url` VARCHAR(500) NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_media_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_media_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `%database%`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`post` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `type` TINYINT NOT NULL,
  `slug` VARCHAR(200) NOT NULL,
  `content` TEXT NOT NULL,
  `featured` INT NULL,
  `excerpt` VARCHAR(255) NULL,
  `description` VARCHAR(500) NULL,
  `parent` VARCHAR(255) NULL,
  `created_at` DATETIME NOT NULL,
  `published_at` DATETIME NOT NULL,
  `status` TINYINT NOT NULL,
  `user_id` INT NOT NULL,
  `visibility` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_page_user1_idx` (`user_id` ASC),
  INDEX `fk_post_slug1_idx` (`slug` ASC),
  INDEX `fk_post_media1_idx` (`featured` ASC),
  CONSTRAINT `fk_page_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `%database%`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_slug1`
    FOREIGN KEY (`slug`)
    REFERENCES `%database%`.`slug` (`slug`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_media1`
    FOREIGN KEY (`featured`)
    REFERENCES `%database%`.`media` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(45) NOT NULL,
  `type` TINYINT NOT NULL,
  `slug` VARCHAR(200) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_category_slug1_idx` (`slug` ASC),
  CONSTRAINT `fk_category_slug1`
    FOREIGN KEY (`slug`)
    REFERENCES `%database%`.`slug` (`slug`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;




-- -----------------------------------------------------
-- Table `wesic`.`event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`event` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `place` VARCHAR(150) NULL,
  `externalurl` VARCHAR(500) NULL,
  `description` VARCHAR(500) NOT NULL,
  `date` DATETIME NOT NULL,
  `featured` INT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_event_user1_idx` (`user_id` ASC),
  INDEX `fk_event_media1_idx` (`featured` ASC),
  CONSTRAINT `fk_event_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `%database%`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_media1`
    FOREIGN KEY (`featured`)
    REFERENCES `%database%`.`media` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`setting`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`setting` (
  `id` VARCHAR(45) NOT NULL,
  `type` INT NOT NULL,
  `value` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `key_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`theme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`theme` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `version` VARCHAR(45) NOT NULL,
  `author` VARCHAR(150) NOT NULL,
  `active` TINYINT NOT NULL,
  `path` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `path_UNIQUE` (`path` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `body` TEXT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `status` TINYINT NOT NULL,
  `type` INT NOT NULL,
  `post_id` INT NOT NULL,
  `email` VARCHAR(255) NULL,
  `name` VARCHAR(255) NULL,
  `user_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comment_post1_idx` (`post_id` ASC),
  INDEX `fk_comment_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_comment_post1`
    FOREIGN KEY (`post_id`)
    REFERENCES `%database%`.`post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `%database%`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`join_article_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`join_article_category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `category_id` INT NOT NULL,
  `post_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_join_article_category_category1_idx` (`category_id` ASC),
  INDEX `fk_join_article_category_post1_idx` (`post_id` ASC),
  CONSTRAINT `fk_join_article_category_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `%database%`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_join_article_category_post1`
    FOREIGN KEY (`post_id`)
    REFERENCES `%database%`.`post` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`passwordrecovery`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`passwordrecovery` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `token` VARCHAR(255) NOT NULL,
  `date` TIMESTAMP NOT NULL,
  `user_id` INT NOT NULL,
  `type` TINYINT NOT NULL,
  `slug` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_passwordrecovery_user1_idx` (`user_id` ASC),
  INDEX `fk_passwordrecovery_slug1_idx` (`slug` ASC),
  CONSTRAINT `fk_passwordrecovery_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `%database%`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_passwordrecovery_slug1`
    FOREIGN KEY (`slug`)
    REFERENCES `%database%`.`slug` (`slug`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`navbar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`navbar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `title` VARCHAR(45) NULL,
  `url` VARCHAR(500) NULL,
  `content_type` INT NULL,
  `content_id` INT NULL,
  `slug` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_navbar_slug1_idx` (`slug` ASC),
  CONSTRAINT `fk_navbar_slug1`
    FOREIGN KEY (`slug`)
    REFERENCES `%database%`.`slug` (`slug`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`stat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`stat` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` TINYINT NOT NULL,
  `date` DATETIME NOT NULL,
  `ip` VARCHAR(100) NULL,
  `useragent` TEXT NULL,
  `referer` TEXT NULL,
  `url` VARCHAR(350) NULL,
  `content_type` INT NULL,
  `content_id` INT NULL,
  `body` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wesic`.`newsletter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `%database%`.`newsletter` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NOT NULL,
  `description` VARCHAR(255) NULL,
  `dateCreation` DATETIME NULL,
  `datePublied` DATETIME NULL,
  `status` INT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_newsletter_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_newsletter_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `%database%`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


INSERT INTO `%database%`.`slug` (`slug`, `type`) VALUES
('non-classe', 3);

INSERT INTO `%database%`.`category` (`id`, `label`, `type`, `slug`) VALUES
(1, 'non classé', 3, 'non-classe');

INSERT INTO `%database%`.`setting` (`id`, `type`, `value`) VALUES
('comments', 1, '2'),
('datetype', 1, '1'),
('default-cat', 2, '1'),
('default-format', 2, '1'),
('display-post', 3, '1'),
('email', 1, null),
('favicon', 1, 'public/storage/favicon.png'),
('homepage', 3, '2'),
('left-1', 4, NULL),
('left-2', 4, NULL),
('left-3', 4, NULL),
('left-4', 4, NULL),
('left-5', 4, NULL),
('links-bloc', 4, '1'),
('mail-login', 2, null),
('mail-password', 2, null),
('mail-port', 2, null),
('mail-server', 2, null),
('pagination-posts', 3, '10'),
('pagination-rss', 3, '10'),
('right-1', 4, NULL),
('right-2', 4, NULL),
('right-3', 4, NULL),
('right-4', 4, NULL),
('right-5', 4, NULL),
('signup', 2, '1'),
('slogan', 1, null),
('tuto-modal', 4, 1),
('theme', 5, 'default'),
('timetype', 1, '1'),
('title', 1, null),
('url', 1, null),
('welcome-bloc', 4, '1');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
