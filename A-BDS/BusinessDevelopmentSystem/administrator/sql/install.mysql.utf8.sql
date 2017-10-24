
CREATE TABLE IF NOT EXISTS `#__businesssystem_company` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `maincpa` int(11) NOT NULL,
  `cpaid` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
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
  `featured` tinyint(2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `#__businesssystem_config`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__businesssystem_config` (
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
-- Records of cpa_businesssystem_config
-- ----------------------------
INSERT INTO `#__businesssystem_config` VALUES ('1', '[{\"name\":\"Invoice 1\"},{\"name\":\"Invoice 2\"}]', '[{\"name\":\"Expenses 1\"},{\"name\":\"Expenses 2\"}]', '[{\"name\":\"Receipt 1\"},{\"name\":\"Receipt 2\"}]', '\"\"', '<p>Hi [USER_NAME],</p>\r\n<p>Project Name [PROJECT_NAME]22</p>\r\n<p>[MESSAGES]</p>\r\n<p>Project Time [COMPLETION_TIME]</p>\r\n<p>Username: [USER_USERNAME]</p>\r\n<p>Password: [USER_PASSWORD] Thanks</p>', '<p>Hi [USER_NAME],</p>\r\n<p>Project Name [PROJECT_NAME]11</p>\r\n<p>[MESSAGES]</p>\r\n<p>Project Time [COMPLETION_TIME]</p>\r\n<p>Username: [USER_USERNAME]</p>\r\n<p>Password: [USER_PASSWORD] Thanks</p>', '[{\"name\":\"Tax Form 1\"},{\"name\":\"Tax Form 2\"}]');

-- ----------------------------
-- Table structure for `#__businesssystem_cpas`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__businesssystem_cpas` (
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
  `state` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `#__businesssystem_customers`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__businesssystem_customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `maincpa` int(11) NOT NULL,
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
  `featured` tinyint(2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `#__businesssystem_expenses`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__businesssystem_expenses` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `#__businesssystem_invoices`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__businesssystem_invoices` (
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
-- Table structure for `#__businesssystem_links`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__businesssystem_links` (
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
-- Table structure for `#__businesssystem_locations`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__businesssystem_locations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cpaid` int(11) unsigned NOT NULL DEFAULT '0',
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
  `banner` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `created` datetime NOT NULL,
  `account` tinyint(2) NOT NULL,
  `featured` tinyint(2) NOT NULL,
  `state` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `serverip` varchar(255) NOT NULL,
  `dbname` varchar(255) NOT NULL,
  `dbuser` varchar(255) NOT NULL,
  `dbpass` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `#__businesssystem_mileages`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__businesssystem_mileages` (
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
-- Table structure for `#__businesssystem_receipts`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__businesssystem_receipts` (
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
-- Table structure for `#__businesssystem_taxreturns`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__businesssystem_taxreturns` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tax_firstname` varchar(255) NOT NULL,
  `tax_midname` varchar(255) NOT NULL,
  `tax_lastname` varchar(255) NOT NULL,
  `tax_birthday` varchar(255) NOT NULL,
  `tax_social_number` varchar(255) NOT NULL,
  `tax_filing_status` varchar(255) NOT NULL,
  `tax_license_id` varchar(255) NOT NULL,
  `tax_issue_date` varchar(255) NOT NULL,
  `tax_expiration_date` varchar(255) NOT NULL,
  `tax_occupation` varchar(255) NOT NULL,
  `tax_dependents` varchar(255) NOT NULL,
  `spouse_firstname` varchar(255) NOT NULL,
  `spouse_midname` varchar(255) NOT NULL,
  `spouse_lastname` varchar(255) NOT NULL,
  `spouse_birthday` varchar(255) NOT NULL,
  `spouse_social_number` varchar(255) NOT NULL,
  `spouse_filing_status` varchar(255) NOT NULL,
  `spouse_license_id` varchar(255) NOT NULL,
  `spouse_issue_date` varchar(255) NOT NULL,
  `spouse_expiration_date` varchar(255) NOT NULL,
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
  `dependent1_birthday` varchar(255) NOT NULL,
  `dependent1_social_number` varchar(255) NOT NULL,
  `dependent1_relationship` varchar(255) NOT NULL DEFAULT '0',
  `dependent1_is_student` varchar(255) NOT NULL,
  `dependent1_is_disable` varchar(255) NOT NULL,
  `dependent2_firstname` varchar(255) NOT NULL,
  `dependent2_midname` varchar(255) NOT NULL,
  `dependent2_lastname` varchar(255) NOT NULL,
  `dependent2_birthday` varchar(255) NOT NULL,
  `dependent2_social_number` varchar(255) NOT NULL,
  `dependent2_relationship` varchar(255) NOT NULL DEFAULT '0',
  `dependent2_is_student` varchar(255) NOT NULL,
  `dependent2_is_disable` varchar(255) NOT NULL,
  `dependent3_firstname` varchar(255) NOT NULL,
  `dependent3_midname` varchar(255) NOT NULL,
  `dependent3_lastname` varchar(255) NOT NULL,
  `dependent3_birthday` varchar(255) NOT NULL,
  `dependent3_social_number` varchar(255) NOT NULL,
  `dependent3_relationship` varchar(255) NOT NULL DEFAULT '0',
  `dependent3_is_student` varchar(255) NOT NULL,
  `dependent3_is_disable` varchar(255) NOT NULL,
  `dependent4_firstname` varchar(255) NOT NULL,
  `dependent4_midname` varchar(255) NOT NULL,
  `dependent4_lastname` varchar(255) NOT NULL,
  `dependent4_birthday` varchar(255) NOT NULL,
  `dependent4_social_number` varchar(255) NOT NULL,
  `dependent4_relationship` varchar(255) NOT NULL DEFAULT '0',
  `dependent4_is_student` varchar(255) NOT NULL,
  `dependent4_is_disable` varchar(255) NOT NULL,
  `dependent5_firstname` varchar(255) NOT NULL,
  `dependent5_midname` varchar(255) NOT NULL,
  `dependent5_lastname` varchar(255) NOT NULL,
  `dependent5_birthday` varchar(255) NOT NULL,
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

