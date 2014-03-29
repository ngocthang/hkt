SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `hyakkaten` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `hyakkaten` ;

-- -----------------------------------------------------
-- Table `hyakkaten`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hyakkaten`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `wallet` INT NOT NULL DEFAULT 0,
  `role` TINYINT(4) NULL COMMENT '0: UNAUTHORIZED - Can not login, 1: USER - Can login and buy items, 2: MODERATOR - Can buy, can create and sell items , 3: ADMIN - Can accept requests, authorize users, change role of user ..., 4: SUPER ADMIN - Most powerful user',
  `secret_key` VARCHAR(127) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  `wallet_updated_at` DATETIME NULL,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hyakkaten`.`item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hyakkaten`.`item` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `price` INT(11) NOT NULL DEFAULT 0,
  `type` INT(11) NOT NULL COMMENT '1: DEPOSIT - The wallet of users will be increased after users buy these items, 2: WITHDRAW - The wallet of users will be decreased after users buy these items, 3: NORMAL - The normal items. If an user buy these item, the money will be transfered to the seller, 4: SET - For special purpose. The price will be ignored. (For example: dishes for lunch), 5: SET_TICKET - Items to buy set of items.',
  `status` TINYINT(4) NULL COMMENT '0: UNAVAILABLE, 1: AVAILABLE',
  `description` TEXT NULL,
  `img` VARCHAR(45) NULL,
  `public_range` TINYINT(4) NULL COMMENT '1: ONY_CREATED_USER: Only the user who created this item can sell it, 2: PUBLIC: All users can sell it',
  `created_by` INT NULL,
  `approved_by` INT NULL COMMENT 'The admin who allow this item to be able to sell',
  `approved_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hyakkaten`.`shop`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hyakkaten`.`shop` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `status` TINYINT(4) NOT NULL DEFAULT 0 COMMENT '0: UNAUTHORIZED, 1: CLOSED, 2: OPEN',
  `description` TEXT NULL,
  `img` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hyakkaten`.`user_shop`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hyakkaten`.`user_shop` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `shop_id` INT NOT NULL,
  `role` INT NOT NULL COMMENT '1: FOUNDER - The user will take the money when an item is bought, 2: ASSISTANT - The users who help founder manage the shop',
  `sales` INT NOT NULL DEFAULT 0,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hyakkaten`.`item_shop`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hyakkaten`.`item_shop` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `item_id` INT NOT NULL,
  `shop_id` INT NOT NULL,
  `start_sale_date` DATETIME NULL,
  `end_sale_date` DATETIME NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hyakkaten`.`invoice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hyakkaten`.`invoice` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `from_user_id` INT NOT NULL,
  `to_user_id` INT NULL,
  `to_shop_id` INT NULL,
  `item_id` INT NOT NULL,
  `status` TINYINT(4) NOT NULL COMMENT '1: SENT, 2: REJECTED, 3: ACCEPTED',
  `set_items_id` VARCHAR(127) NULL COMMENT 'If user buy a set of items (for example: lunch), so all the items id will be stored here. The item_id field will store the price of the set.',
  `comment` TEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hyakkaten`.`request`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hyakkaten`.`request` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `from_user_id` INT NULL,
  `to_user_id` INT NULL COMMENT 'If the value is 0, this request is sent to all admins.',
  `from_shop_id` INT NULL,
  `to_shop_id` INT NULL,
  `type` TINYINT(4) NOT NULL COMMENT '1: REGISTER: A new user registered, 2: CREATE_ITEM: An user want to create an item,3: CREATE_SHOP: An user want to create an item, 4: BUY_ITEM: An user want to buy an item, 5: USER_SELL_ITEM: An user want to register an item to sell, 6: SHOP_SELL_ITEM: A shop want to register an item to sell.',
  `status` TINYINT(4) NOT NULL DEFAULT 0 COMMENT '1: SENT, 2: REJECTED, 3: ACCEPTED',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hyakkaten`.`item_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hyakkaten`.`item_user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `item_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `start_sale_date` DATETIME NULL,
  `end_sale_date` DATETIME NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
