# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.27)
# Database: countrified
# Generation Time: 2013-06-26 14:51:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table basket_address
# ------------------------------------------------------------

DROP TABLE IF EXISTS `basket_address`;

CREATE TABLE `basket_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `street` varchar(255) NOT NULL,
  `postal` varchar(50) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `region` varchar(50) DEFAULT NULL,
  `country` varchar(50) NOT NULL DEFAULT '',
  `deleted` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table basket_customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `basket_customer`;

CREATE TABLE `basket_customer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `delivery_address_id` int(11) DEFAULT NULL,
  `billing_address_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  `listing_order` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table basket_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `basket_orders`;

CREATE TABLE `basket_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `delivery_address_id` int(11) NOT NULL,
  `billing_address_id` int(11) NOT NULL,
  `delivery_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering_done` tinyint(1) DEFAULT NULL,
  `ordering_confirmed` tinyint(1) DEFAULT NULL,
  `payment_method` int(11) NOT NULL,
  `comment` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '0',
  `deleted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_customer` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table basket_orders_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `basket_orders_items`;

CREATE TABLE `basket_orders_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `specifications` text NOT NULL,
  `shipping_method` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table basket_orders_payment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `basket_orders_payment`;

CREATE TABLE `basket_orders_payment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `payment_method` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table basket_payment_method
# ------------------------------------------------------------

DROP TABLE IF EXISTS `basket_payment_method`;

CREATE TABLE `basket_payment_method` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `basket_payment_method` WRITE;
/*!40000 ALTER TABLE `basket_payment_method` DISABLE KEYS */;

INSERT INTO `basket_payment_method` (`id`, `title`, `description`, `price`)
VALUES
	(1,'cash','You pay cash',0),
	(2,'advance Payment','You pay in advance, we deliver',0),
	(3,'cash on delivery','You pay when we deliver',0),
	(4,'invoice','We deliver and send a invoice',0),
	(5,'paypal','You pay by paypal',0);

/*!40000 ALTER TABLE `basket_payment_method` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table basket_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `basket_products`;

CREATE TABLE `basket_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `under_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `main_features` text COLLATE utf8_unicode_ci,
  `deal` text COLLATE utf8_unicode_ci,
  `important_information` text COLLATE utf8_unicode_ci,
  `overview` text COLLATE utf8_unicode_ci,
  `next_step` text COLLATE utf8_unicode_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `saving` decimal(10,2) DEFAULT NULL,
  `number_available` int(11) DEFAULT NULL,
  `number_available_at_insert` int(11) DEFAULT NULL,
  `terms` text COLLATE utf8_unicode_ci,
  `exclusive` tinyint(4) NOT NULL,
  `purchase_next_step` text COLLATE utf8_unicode_ci,
  `date_start` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `listing_order` int(11) DEFAULT '99',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `basket_products` WRITE;
/*!40000 ALTER TABLE `basket_products` DISABLE KEYS */;

INSERT INTO `basket_products` (`id`, `title`, `under_title`, `main_features`, `deal`, `important_information`, `overview`, `next_step`, `price`, `saving`, `number_available`, `number_available_at_insert`, `terms`, `exclusive`, `purchase_next_step`, `date_start`, `date_end`, `merchant_id`, `listing_order`, `created`, `updated`, `active`, `deleted`)
VALUES
	(1,'My Product',NULL,NULL,NULL,NULL,NULL,NULL,25.00,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,0,NULL,NULL,1,0);

/*!40000 ALTER TABLE `basket_products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table basket_products_delivery
# ------------------------------------------------------------

DROP TABLE IF EXISTS `basket_products_delivery`;

CREATE TABLE `basket_products_delivery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `delivery_cost` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `basket_products_delivery` WRITE;
/*!40000 ALTER TABLE `basket_products_delivery` DISABLE KEYS */;

INSERT INTO `basket_products_delivery` (`id`, `product_id`, `title`, `description`, `delivery_cost`)
VALUES
	(1,1,'7 days',NULL,5.00),
	(2,1,'Next Day',NULL,10.00);

/*!40000 ALTER TABLE `basket_products_delivery` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table basket_products_specification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `basket_products_specification`;

CREATE TABLE `basket_products_specification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `required` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `basket_products_specification` WRITE;
/*!40000 ALTER TABLE `basket_products_specification` DISABLE KEYS */;

INSERT INTO `basket_products_specification` (`id`, `title`, `required`)
VALUES
	(1,'Colour',1),
	(2,'Size',0),
	(3,'Fabric',0);

/*!40000 ALTER TABLE `basket_products_specification` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table basket_products_variation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `basket_products_variation`;

CREATE TABLE `basket_products_variation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `specification_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price_adjustion` decimal(10,2) NOT NULL,
  `listing_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `basket_products_variation` WRITE;
/*!40000 ALTER TABLE `basket_products_variation` DISABLE KEYS */;

INSERT INTO `basket_products_variation` (`id`, `product_id`, `specification_id`, `title`, `price_adjustion`, `listing_order`)
VALUES
	(3,1,1,'Pink',2.00,1),
	(4,1,1,'Red',2.00,2),
	(5,1,2,'Small',1.00,1),
	(6,1,2,'Large',4.00,2);

/*!40000 ALTER TABLE `basket_products_variation` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
