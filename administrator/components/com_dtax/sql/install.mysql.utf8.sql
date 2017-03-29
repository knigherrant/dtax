/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : dtax

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-03-29 20:46:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `#__dtax_config`
-- ----------------------------
DROP TABLE IF EXISTS `#__dtax_config`;
CREATE TABLE `#__dtax_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categories_invoice` text NOT NULL,
  `categories_expenses` text NOT NULL,
  `categories_receipt` text NOT NULL,
  `params` text NOT NULL,
  `notify_tax_en` text NOT NULL,
  `notify_tax_sn` text NOT NULL,
  `categories_taxform` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpa_dtax_config
-- ----------------------------
INSERT INTO `#__dtax_config` VALUES ('1', '[{\"name\":\"Invoice 1\"},{\"name\":\"Invoice 2\"}]', '[{\"name\":\"Expenses 1\"},{\"name\":\"Expenses 2\"}]', '[{\"name\":\"Receipt 1\"},{\"name\":\"Receipt 2\"}]', '\"\"', '<p>Hi [USER_NAME],</p>\r\n<p>Project Name [PROJECT_NAME]22</p>\r\n<p>[MESSAGES]</p>\r\n<p>Project Time [COMPLETION_TIME]</p>\r\n<p>Username: [USER_USERNAME]</p>\r\n<p>Password: [USER_PASSWORD] Thanks</p>', '<p>Hi [USER_NAME],</p>\r\n<p>Project Name [PROJECT_NAME]11</p>\r\n<p>[MESSAGES]</p>\r\n<p>Project Time [COMPLETION_TIME]</p>\r\n<p>Username: [USER_USERNAME]</p>\r\n<p>Password: [USER_PASSWORD] Thanks</p>', '[{\"name\":\"Tax Form 1\"},{\"name\":\"Tax Form 2\"}]');

-- ----------------------------
-- Table structure for `#__dtax_cpas`
-- ----------------------------
DROP TABLE IF EXISTS `#__dtax_cpas`;
CREATE TABLE `#__dtax_cpas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `midname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `cell_phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `serverip` varchar(255) NOT NULL,
  `dbname` varchar(255) NOT NULL,
  `dbuser` varchar(255) NOT NULL,
  `dbpass` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `created` datetime NOT NULL,
  `account` tinyint(2) NOT NULL,
  `featured` tinyint(2) NOT NULL,
  `location_id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpa_dtax_cpas
-- ----------------------------
INSERT INTO `#__dtax_cpas` VALUES ('1', '57', '1', '911', '43423zzzyy', '34324242', '423423', '43243', '4324', '4324', '2432432', '432423423', '432', '432423', '432432423', '423432', '43432', 'images/dtax/1489249459_anh-nen-canh-dong-hoa-huong-duong.jpg', '43423', '312', '312', '24342', 'images/dtax/1489249444_1471514129602_3899.jpg', '4324', '2017-03-21 14:57:59', '0', '0', '2', '33333333');

-- ----------------------------
-- Table structure for `#__dtax_customers`
-- ----------------------------
DROP TABLE IF EXISTS `#__dtax_customers`;
CREATE TABLE `#__dtax_customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `cpaid` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `midname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `cell_phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `federal_id` varchar(255) NOT NULL,
  `first_tax` varchar(255) NOT NULL,
  `first_fiscal` varchar(255) NOT NULL,
  `income_tax_form` varchar(255) NOT NULL,
  `tax_exempt_form` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `serverip` varchar(255) NOT NULL,
  `dbname` varchar(255) NOT NULL,
  `dbuser` varchar(255) NOT NULL,
  `dbpass` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `created` datetime NOT NULL,
  `account` tinyint(2) NOT NULL,
  `featured` tinyint(2) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpa_dtax_customers
-- ----------------------------
INSERT INTO `#__dtax_customers` VALUES ('1', '912', '1', '43423zzuuzziiiiiiiiiiiiii', 'Dinh', 'Van', 'Nam', '13 duong dinh dinh, tinh tinh dinh', '', 'Ho Chi MInh', '432', '432432', '4234242442342', '4242343442', '423432442422', 'knigherrant@gm43ail.com', '43432', '4234324234242', '4234324324242', '44233244242', '4242342342342342', 'images/dtax/1489327914_Captura.JPG', 'images/dtax/1489327914_1471514128408_3893.jpg', '3424242', '44242342342', '42342342342432', '423423434242', 'images/dtax/1489327914_1471514129462_3898.jpg', '4444444444444444444444444444444444444444444', '2017-03-21 17:17:02', '0', '0', '2', '911');
INSERT INTO `#__dtax_customers` VALUES ('2', '0', '1', 'tttt', 't', 't', 't', '', '', '', '', '', '', '', '', 'ttt@tt.xom', '', '', '', '', '', '', '', '', '', '', '', '', '', '2017-03-21 15:14:59', '0', '0', '0', '911');

-- ----------------------------
-- Table structure for `#__dtax_expenses`
-- ----------------------------
DROP TABLE IF EXISTS `#__dtax_expenses`;
CREATE TABLE `#__dtax_expenses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cpaid` int(10) unsigned NOT NULL DEFAULT '0',
  `company` varchar(255) NOT NULL,
  `merchant` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `comments` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `billable` tinyint(1) NOT NULL,
  `reimbursable` tinyint(1) NOT NULL,
  `total` varchar(225) NOT NULL,
  `start_point` varchar(225) NOT NULL,
  `destination` varchar(225) NOT NULL,
  `mileage_id` varchar(225) NOT NULL,
  `rate` varchar(225) NOT NULL,
  `odometer_start` varchar(225) NOT NULL,
  `odometer_end` varchar(225) NOT NULL,
  `total_mileage` varchar(225) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpa_dtax_expenses
-- ----------------------------
INSERT INTO `#__dtax_expenses` VALUES ('1', '1', '43423xxxxxxxx', 'xxxxxxxxxxxxxxxxx', '2017-03-21 15:18:41', 'ffffffffffffffffffffffff', 'Expenses 1', 'images/powered_by.png', '1', '0', '111', '33333', '333333333333', '', '55555', '66666', '77777', '888888', '911');
INSERT INTO `#__dtax_expenses` VALUES ('2', '1', 'tessyyy', 'yyyyyy', '2017-03-21 15:19:04', '', 'Expenses 1', 'images/joomla_black.png', '0', '0', '333', '', '', '', '', '', '', '', '911');

-- ----------------------------
-- Table structure for `#__dtax_invoices`
-- ----------------------------
DROP TABLE IF EXISTS `#__dtax_invoices`;
CREATE TABLE `#__dtax_invoices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cpaid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `storage_type` varchar(255) NOT NULL,
  `storage_path_file` varchar(255) NOT NULL,
  `storage_path_remote` varchar(255) NOT NULL,
  `filesize` varchar(255) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `icon_custom` tinyint(1) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `ext` varchar(10) NOT NULL,
  `access` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL,
  `publish_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `unpublish_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpa_dtax_invoices
-- ----------------------------
INSERT INTO `#__dtax_invoices` VALUES ('1', '1', 'tessttt', '43423xxxxxxxx', '', 'file', '1471430672696_3844.jpg', '', '135537', '', '', '0', '', 'jpg', '1', '1', '2017-03-18 22:26:47', '2017-03-24 22:26:48', '2017-03-18 15:41:10', '0', '0000-00-00 00:00:00', '0', '0');
INSERT INTO `#__dtax_invoices` VALUES ('2', '0', 'tesstttzztt', '43423xxxxxxxx', '', 'file', '1471430672696_3844.jpg', '', '135537', '', '', '0', '', 'jpg', '1', '1', '2017-03-18 22:19:38', '2017-03-18 22:19:43', '2017-03-18 15:31:28', '0', '0000-00-00 00:00:00', '0', '0');

-- ----------------------------
-- Table structure for `#__dtax_links`
-- ----------------------------
DROP TABLE IF EXISTS `#__dtax_links`;
CREATE TABLE `#__dtax_links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(255) NOT NULL,
  `cpaid` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `state` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpa_dtax_links
-- ----------------------------
INSERT INTO `#__dtax_links` VALUES ('1', '', '0', 'tessttt', '', 'http://phpkungfu.club/advertise', '0000-00-00 00:00:00', '1', '0');

-- ----------------------------
-- Table structure for `#__dtax_locations`
-- ----------------------------
DROP TABLE IF EXISTS `#__dtax_locations`;
CREATE TABLE `#__dtax_locations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `featured` int(1) unsigned NOT NULL DEFAULT '0',
  `phone` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpa_dtax_locations
-- ----------------------------
INSERT INTO `#__dtax_locations` VALUES ('2', 'test front-end', 'Viet Nam', '48.872130400777785', '2.3600425529480162', '0', '4324234234234', '911', '31312', '2017-03-06 00:00:00');
INSERT INTO `#__dtax_locations` VALUES ('3', 'Location 1', 'Ho chi minh', '48.87229270698384', '2.3559226799011412', '0', '01234567892', '911', 'dev@joomlavi.com2', '2017-03-11 00:00:00');
INSERT INTO `#__dtax_locations` VALUES ('4', '44', '44444444444444444444', '', '', '0', '44444', '911', 'info@kungfupups.com', '2017-03-11 00:00:00');
INSERT INTO `#__dtax_locations` VALUES ('5', 'Location 1', 'Ho chi minh', '', '', '0', '123456', '911', 'dev@joomlavi.com22', '2017-03-11 00:00:00');
INSERT INTO `#__dtax_locations` VALUES ('6', 'Location 1', '44444444444444tret', '', '', '0', '012345678922222', '911', 'dev@joomlavi.com2', '2017-03-11 00:00:00');
INSERT INTO `#__dtax_locations` VALUES ('7', 'Location 2222', '44444444444444tret', '', '', '0', '012345678933', '911', 'dev@joomlavi.com22', '2017-03-11 00:00:00');
INSERT INTO `#__dtax_locations` VALUES ('8', 'Location 222243', '44444444444444444444', '', '', '0', '42342342', '911', 'dev@joomlavi.com2', '0000-00-00 00:00:00');
INSERT INTO `#__dtax_locations` VALUES ('9', 'test 111', '111', '', '', '0', '111', '912', 'aa@aaa.com', '2017-03-22 00:00:00');

-- ----------------------------
-- Table structure for `#__dtax_mileages`
-- ----------------------------
DROP TABLE IF EXISTS `#__dtax_mileages`;
CREATE TABLE `#__dtax_mileages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cpaid` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `start_point` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `mileage` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `odometer_start` varchar(255) NOT NULL,
  `odometer_end` varchar(255) NOT NULL,
  `total_mileage` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpa_dtax_mileages
-- ----------------------------
INSERT INTO `#__dtax_mileages` VALUES ('1', '1', '43423xxxxxxxx', 'ewqeq', '333333333333', 'Mileage 1111', '55555', '66666', '77777', '888888', '2017-03-18 08:28:00', '0');
INSERT INTO `#__dtax_mileages` VALUES ('2', '1', '423423', '432423', '423', '432', '432', '', '', '', '2017-03-21 15:19:45', '911');

-- ----------------------------
-- Table structure for `#__dtax_receipts`
-- ----------------------------
DROP TABLE IF EXISTS `#__dtax_receipts`;
CREATE TABLE `#__dtax_receipts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cpaid` int(10) unsigned NOT NULL DEFAULT '0',
  `company` varchar(255) NOT NULL,
  `merchant` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `comments` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `billable` tinyint(1) NOT NULL,
  `reimbursable` tinyint(1) NOT NULL,
  `total` varchar(225) NOT NULL,
  `start_point` varchar(225) NOT NULL,
  `destination` varchar(225) NOT NULL,
  `mileage_id` varchar(225) NOT NULL,
  `rate` varchar(225) NOT NULL,
  `odometer_start` varchar(225) NOT NULL,
  `odometer_end` varchar(225) NOT NULL,
  `total_mileage` varchar(225) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpa_dtax_receipts
-- ----------------------------
INSERT INTO `#__dtax_receipts` VALUES ('1', '1', '43423xxxxxxxx', 'xxxxxxxxxxxxxxxxx', '2017-03-18 00:00:00', '', 'ewqewq', 'images/joomla_black.png', '0', '0', '', 'ewqeq', 'ewqeqw', '', '', '', '', '', '0');
INSERT INTO `#__dtax_receipts` VALUES ('2', '1', '42342', '43242', '2017-03-21 15:19:34', '', '4324', 'images/powered_by.png', '0', '0', '43423', '', '', '', '', '', '', '', '911');

-- ----------------------------
-- Table structure for `#__dtax_taxreturns`
-- ----------------------------
DROP TABLE IF EXISTS `#__dtax_taxreturns`;
CREATE TABLE `#__dtax_taxreturns` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tax_firstname` varchar(255) NOT NULL,
  `tax_midname` varchar(255) NOT NULL,
  `tax_lastname` varchar(255) NOT NULL,
  `tax_birthday` datetime NOT NULL,
  `tax_social_number` varchar(255) NOT NULL,
  `tax_filing_status` varchar(255) NOT NULL,
  `tax_license_id` varchar(255) NOT NULL,
  `tax_issue_date` datetime NOT NULL,
  `tax_expiration_date` datetime NOT NULL,
  `tax_occupation` varchar(255) NOT NULL,
  `tax_dependents` varchar(255) NOT NULL,
  `spouse_firstname` varchar(255) NOT NULL,
  `spouse_midname` varchar(255) NOT NULL,
  `spouse_lastname` varchar(255) NOT NULL,
  `spouse_birthday` datetime NOT NULL,
  `spouse_social_number` varchar(255) NOT NULL,
  `spouse_filing_status` varchar(255) NOT NULL,
  `spouse_license_id` varchar(255) NOT NULL,
  `spouse_issue_date` datetime NOT NULL,
  `spouse_expiration_date` datetime NOT NULL,
  `spouse_occupation` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `apartment` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dependent1_firstname` varchar(255) NOT NULL,
  `dependent1_midname` varchar(255) NOT NULL,
  `dependent1_lastname` varchar(255) NOT NULL,
  `dependent1_birthday` datetime NOT NULL,
  `dependent1_social_number` varchar(255) NOT NULL,
  `dependent1_relationship` varchar(255) NOT NULL DEFAULT '0',
  `dependent1_is_student` varchar(255) NOT NULL,
  `dependent1_is_disable` varchar(255) NOT NULL,
  `dependent2_firstname` varchar(255) NOT NULL,
  `dependent2_midname` varchar(255) NOT NULL,
  `dependent2_lastname` varchar(255) NOT NULL,
  `dependent2_birthday` datetime NOT NULL,
  `dependent2_social_number` varchar(255) NOT NULL,
  `dependent2_relationship` varchar(255) NOT NULL DEFAULT '0',
  `dependent2_is_student` varchar(255) NOT NULL,
  `dependent2_is_disable` varchar(255) NOT NULL,
  `dependent3_firstname` varchar(255) NOT NULL,
  `dependent3_midname` varchar(255) NOT NULL,
  `dependent3_lastname` varchar(255) NOT NULL,
  `dependent3_birthday` datetime NOT NULL,
  `dependent3_social_number` varchar(255) NOT NULL,
  `dependent3_relationship` varchar(255) NOT NULL DEFAULT '0',
  `dependent3_is_student` varchar(255) NOT NULL,
  `dependent3_is_disable` varchar(255) NOT NULL,
  `dependent4_firstname` varchar(255) NOT NULL,
  `dependent4_midname` varchar(255) NOT NULL,
  `dependent4_lastname` varchar(255) NOT NULL,
  `dependent4_birthday` datetime NOT NULL,
  `dependent4_social_number` varchar(255) NOT NULL,
  `dependent4_relationship` varchar(255) NOT NULL DEFAULT '0',
  `dependent4_is_student` varchar(255) NOT NULL,
  `dependent4_is_disable` varchar(255) NOT NULL,
  `dependent5_firstname` varchar(255) NOT NULL,
  `dependent5_midname` varchar(255) NOT NULL,
  `dependent5_lastname` varchar(255) NOT NULL,
  `dependent5_birthday` datetime NOT NULL,
  `dependent5_social_number` varchar(255) NOT NULL,
  `dependent5_relationship` varchar(255) NOT NULL DEFAULT '0',
  `dependent5_is_student` varchar(255) NOT NULL,
  `dependent5_is_disable` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `company_location` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `cpa` varchar(255) NOT NULL,
  `#__location` varchar(255) NOT NULL,
  `#__email` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cpa_dtax_taxreturns
-- ----------------------------
INSERT INTO `#__dtax_taxreturns` VALUES ('1', '4234211', '423423111', '4234111', '2017-03-18 00:00:00', '42341111', '4324231111', '423423111', '2017-03-16 00:00:00', '2011-11-11 00:00:00', '4242111', '4234231111', '42422222', '4242222', '423423222', '0000-00-00 00:00:00', '423432222222', '424232222', '423422222', '2017-03-18 00:00:00', '2017-03-23 00:00:00', '4234232222', '4242333', '4242342333', '42342333', '423423333', '423423333', '423423333', '42423433', '424236444', '423423444', '4242444', '2017-03-17 00:00:00', '42423444', '42423444', '0', '0', '555555555', '55555555555555', '5555555555555', '2017-03-18 00:00:00', '555555555555', '055555555555555555555', '0', '0', '66666666666', '6666666666666666', '66666666666666666666', '2017-03-18 00:00:00', '6666666666666', '06666666666666666', '0', '0', '77777777777', '777777777777777777', '777777777777777777', '2017-03-24 00:00:00', '77777777777777', '07777777777777', '0', '0', '8888888888888888888888', '88888888888888888', '8888888888888', '2017-03-17 00:00:00', '8888888888888', '088888888888888', '0', '0', '', '9999', '9999', '9999', '999', '9999', '99999', '2017-03-18 15:01:02', '0');
INSERT INTO `#__dtax_taxreturns` VALUES ('2', '444', '555', '6666', '2017-03-21 00:00:00', '4234', '77', '888', '2017-03-21 00:00:00', '2017-03-22 00:00:00', '99', '0000', '31231', '312', '3131', '0000-00-00 00:00:00', '313', '31', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '', '0', '0', '', '', '', '0000-00-00 00:00:00', '', '', '0', '0', '', '', '', '0000-00-00 00:00:00', '', '', '0', '0', '', '', '', '0000-00-00 00:00:00', '', '', '0', '0', '', '', '', '0000-00-00 00:00:00', '', '', '0', '0', '', '', '', '', '', '', '', '2017-03-21 15:21:12', '911');
