# Admin Profiles
# version 1.0
# 
# SQL to initialise user with admin_id = 1 for Admin Profiles
# -----------------------------------------------------------

#
# Create table structure for table `admin_menu_headers`
#

DROP TABLE IF EXISTS `admin_menu_headers`;
CREATE TABLE `admin_menu_headers` (
  `id` int(11) NOT NULL,
  `header` varchar(16) NOT NULL default '',
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM;

#
# Insert data into table `admin_menu_headers`
#
INSERT INTO `admin_menu_headers` VALUES (0, 'Contributions');
INSERT INTO `admin_menu_headers` VALUES (1, 'Configuration');
INSERT INTO `admin_menu_headers` VALUES (2, 'Catalog');
INSERT INTO `admin_menu_headers` VALUES (3, 'Modules');
INSERT INTO `admin_menu_headers` VALUES (4, 'Customers');
INSERT INTO `admin_menu_headers` VALUES (5, 'Taxes');
INSERT INTO `admin_menu_headers` VALUES (6, 'Localization');
INSERT INTO `admin_menu_headers` VALUES (7, 'Reports');
INSERT INTO `admin_menu_headers` VALUES (8, 'Tools');
INSERT INTO `admin_menu_headers` VALUES (9, 'GV_Admin');
INSERT INTO `admin_menu_headers` VALUES (10, 'Extras');
