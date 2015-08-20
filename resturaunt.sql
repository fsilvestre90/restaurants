-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'cuisines'
--
-- ---

DROP TABLE IF EXISTS `cuisines`;

CREATE TABLE `cuisines` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `cuisine_type` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'restaurants'
--
-- ---

DROP TABLE IF EXISTS `restaurants`;

CREATE TABLE `restaurants` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `restaurant_name` VARCHAR(255) NULL DEFAULT NULL,
  `cuisine_id` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'reviews'
--
-- ---

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'resturaunt_reviews'
--
-- ---

DROP TABLE IF EXISTS `restaurant_reviews`;

CREATE TABLE `restaurant_reviews` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `restaurant_id` INTEGER NULL DEFAULT NULL,
  `review_id` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys
-- ---

ALTER TABLE `restaurants` ADD FOREIGN KEY (cuisine_id) REFERENCES `cuisines` (`id`);
ALTER TABLE `restaurant_reviews` ADD FOREIGN KEY (restaurant_id) REFERENCES `restaurants` (`id`);
ALTER TABLE `restaurant_reviews` ADD FOREIGN KEY (review_id) REFERENCES `reviews` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `cuisines` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `restaurants` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `reviews` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `restaurant_reviews` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
