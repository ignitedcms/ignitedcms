#
# TABLE STRUCTURE FOR: assetfields
#

DROP TABLE IF EXISTS `assetfields`;

CREATE TABLE `assetfields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entryid` int(11),
  `filename` varchar(255),
  `kind` varchar(50),
  `width` varchar(10),
  `height` varchar(10),
  `size` int(11),
  `datecreated` datetime,
  `url` varchar(200),
  `thumb` varchar(300),
  `fieldname` varchar(200),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: IGS_routes
#

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(200),
  `controller` varchar(200),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `plugins` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255),
  `install` datetime,
  `status` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



#
# TABLE STRUCTURE FOR: cat_links
#

DROP TABLE IF EXISTS `cat_links`;

CREATE TABLE `cat_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11),
  `cat_id` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: cats
#

DROP TABLE IF EXISTS `cats`;

CREATE TABLE `cats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;




#
# TABLE STRUCTURE FOR: content
#

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entryid` int(11),
  `entrytitle` varchar(200),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;





#
# TABLE STRUCTURE FOR: entry
#

DROP TABLE IF EXISTS `entry`;

CREATE TABLE `entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sectionid` int(11),
  `type` varchar(200),
  `datecreated` date,
  `sort_order` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: fields
#

DROP TABLE IF EXISTS `fields`;

CREATE TABLE `fields` (
  `name` varchar(200),
  `type` varchar(50),
  `opts` text,
  `instructions` varchar(200) ,
  `maxchars` varchar(50),
  `limitamount` int(11),
  `formvalidation` text,
  `settings` text,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;




#
# TABLE STRUCTURE FOR: permission_groups
#

DROP TABLE IF EXISTS `permission_groups`;

CREATE TABLE `permission_groups` (
  `groupID` int(11) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



#
# TABLE STRUCTURE FOR: permission_map
#

DROP TABLE IF EXISTS `permission_map`;

CREATE TABLE `permission_map` (
  `groupID` int(11) NOT NULL DEFAULT '0',
  `permissionID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupID`,`permissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



#
# TABLE STRUCTURE FOR: permissions
#

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `permissionID` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(200),
  `order_position` int(11),
  PRIMARY KEY (`permissionID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;




#
# TABLE STRUCTURE FOR: section
#

DROP TABLE IF EXISTS `section`;

CREATE TABLE `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100),
  `sectiontype` varchar(200),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: section_layout
#

DROP TABLE IF EXISTS `section_layout`;

CREATE TABLE `section_layout` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `sectionid` int(11),
  `fieldid` int(11),
  `sortorder` int(11),
  `required` int(11),
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


#
# TABLE STRUCTURE FOR: blocks
#

DROP TABLE IF EXISTS `blocks`;

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fieldid` int(11),
  `typeid` int(11),
  `sortorder` int(11),
  `datecreated` datetime,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


#
# TABLE STRUCTURE FOR: user
#

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100),
  `password` varchar(500),
  `joindate` date,
  `logins` int(11),
  `is_logged_in` int(11),
  `email` varchar(50),
  `activ_status` int(11),
  `activ_key` varchar(1000),
  `permissiongroup` int(11),
  `fullname` varchar(200),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Table structure for table `paypal`
--

CREATE TABLE `paypal` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `sandbox` int(9),
  `paypal_email` varchar(100),
  `notify_url` varchar(512),
  `thanks_url` varchar(512),
  `currency_code` varchar(10),
  `created_at` datetime,
  `updated_at` datetime,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `IGS_ipn`
--

CREATE TABLE `ipn` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(512),
  `item_number` varchar(512),
  `payment_status` varchar(512),
  `payment_amount` varchar(512),
  `payment_currency` varchar(512),
  `txn_id` varchar(512),
  `receiver_email` varchar(512),
  `payer_email` varchar(512),
  `txn_type` varchar(512),
  `pending_reason` varchar(512),
  `payment_type` varchar(512),
  `custom` varchar(512),
  `invoice` varchar(512),
  `first_name` varchar(512),
  `last_name` varchar(512),
  `address_name` varchar(512),
  `address_country` varchar(512),
  `address_country_code` varchar(512),
  `address_zip` varchar(512),
  `address_state` varchar(512),
  `address_city` varchar(512),
  `address_street` varchar(512),
  `created_at` datetime,
  `updated_at` datetime,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




