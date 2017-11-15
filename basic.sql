/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 50715
 Source Host           : localhost
 Source Database       : basic

 Target Server Type    : MySQL
 Target Server Version : 50715
 File Encoding         : utf-8

 Date: 11/15/2017 04:01:18 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PKEY',
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL COMMENT 'Using varchar to support other chracters. ',
  `zip` varchar(255) DEFAULT NULL COMMENT ' Zip is a series of letters or digits or both',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `address`
-- ----------------------------
BEGIN;
INSERT INTO `address` VALUES ('1', 'Lahore', 'punjab', 'Pakistan', 'test', '+923004832103', '54810');
COMMIT;

-- ----------------------------
--  Table structure for `company`
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unsigned because id won''t be in minus',
  `name` varchar(50) NOT NULL COMMENT 'Company must have a name ',
  `description` varchar(200) DEFAULT NULL COMMENT 'Company may have description . ',
  `default_contact_person` int(10) unsigned DEFAULT NULL COMMENT 'Company must have default contact . Otherwise don''t add company.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `company`
-- ----------------------------
BEGIN;
INSERT INTO `company` VALUES ('4', 'TheENTERTIANERME', 'Buy One Get One Free', '1');
COMMIT;

-- ----------------------------
--  Table structure for `contact_person`
-- ----------------------------
DROP TABLE IF EXISTS `contact_person`;
CREATE TABLE `contact_person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unsigned because id won''t be in minus',
  `name` varchar(30) NOT NULL COMMENT 'Person must have a name',
  `address_id` int(10) unsigned NOT NULL DEFAULT '0',
  `company_id` int(10) unsigned NOT NULL DEFAULT '0',
  `is_default` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `contact_person`
-- ----------------------------
BEGIN;
INSERT INTO `contact_person` VALUES ('1', 'Waqas Shahzad', '1', '4', '1'), ('3', 'David Ashford', '1', '4', '0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
