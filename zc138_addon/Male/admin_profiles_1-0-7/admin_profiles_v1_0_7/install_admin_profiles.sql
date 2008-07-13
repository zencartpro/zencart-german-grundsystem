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
INSERT INTO `admin_menu_headers` VALUES (0, 'Third Party Mods');
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

#
# Create table structure for table `admin_visible_headers`
#

DROP TABLE IF EXISTS `admin_visible_headers`;
CREATE TABLE `admin_visible_headers` (
  `header_id` int(11) NOT NULL default '0',
  `admin_id` int(11) NOT NULL default '0'
) TYPE=MyISAM;

#
# Insert data into table `admin_visible_headers`
#

INSERT INTO `admin_visible_headers` VALUES (1, 1);
INSERT INTO `admin_visible_headers` VALUES (2, 1);
INSERT INTO `admin_visible_headers` VALUES (3, 1);
INSERT INTO `admin_visible_headers` VALUES (4, 1);
INSERT INTO `admin_visible_headers` VALUES (5, 1);
INSERT INTO `admin_visible_headers` VALUES (6, 1);
INSERT INTO `admin_visible_headers` VALUES (7, 1);
INSERT INTO `admin_visible_headers` VALUES (8, 1);
INSERT INTO `admin_visible_headers` VALUES (9, 1);
INSERT INTO `admin_visible_headers` VALUES (10, 1);

#
# Create table structure for table `admin_files`
#

DROP TABLE IF EXISTS `admin_files`;
CREATE TABLE `admin_files` (
  `id` int(11) NOT NULL auto_increment,
  `page` varchar(64) NOT NULL default '',
  `header` tinyint(4) NOT NULL default 0,
  `submenu` tinyint(1) NOT NULL default 0,
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM;

#
# Insert data into table `admin_files`
#

INSERT INTO `admin_files` VALUES (1, 'My Store', 1, 0);
INSERT INTO `admin_files` VALUES (2, 'Minimum Values', 1, 0);
INSERT INTO `admin_files` VALUES (3, 'Maximum Values', 1, 0);
INSERT INTO `admin_files` VALUES (4, 'Images', 1, 0);
INSERT INTO `admin_files` VALUES (5, 'Customer Details', 1, 0);
INSERT INTO `admin_files` VALUES (6, 'Shipping/Packaging', 1, 0);
INSERT INTO `admin_files` VALUES (7, 'Product Listing', 1, 0);
INSERT INTO `admin_files` VALUES (8, 'Stock', 1, 0);
INSERT INTO `admin_files` VALUES (9, 'Logging', 1, 0);
INSERT INTO `admin_files` VALUES (10, 'E-Mail Options', 1, 0);
INSERT INTO `admin_files` VALUES (11, 'Attribute Settings', 1, 0);
INSERT INTO `admin_files` VALUES (12, 'GZip Compression', 1, 0);
INSERT INTO `admin_files` VALUES (13, 'Sessions', 1, 0);
INSERT INTO `admin_files` VALUES (14, 'Regulations', 1, 0);
INSERT INTO `admin_files` VALUES (15, 'GV Coupons', 1, 0);
INSERT INTO `admin_files` VALUES (16, 'Credit Cards', 1, 0);
INSERT INTO `admin_files` VALUES (17, 'Product Info', 1, 0);
INSERT INTO `admin_files` VALUES (18, 'Layout Settings', 1, 0);
INSERT INTO `admin_files` VALUES (19, 'Website Maintenance', 1, 0);
INSERT INTO `admin_files` VALUES (20, 'New Listing', 1, 0);
INSERT INTO `admin_files` VALUES (21, 'Featured Listing', 1, 0);
INSERT INTO `admin_files` VALUES (22, 'All Listing', 1, 0);
INSERT INTO `admin_files` VALUES (23, 'Index Listing', 1, 0);
INSERT INTO `admin_files` VALUES (24, 'Define Page Status', 1, 0);
INSERT INTO `admin_files` VALUES (81, 'EZ-Pages Settings', 1, 0);
INSERT INTO `admin_files` VALUES (25, 'categories', 2, 0);
INSERT INTO `admin_files` VALUES (26, 'product_types', 2, 0);
INSERT INTO `admin_files` VALUES (27, 'products_price_manager', 2, 0);
INSERT INTO `admin_files` VALUES (28, 'options_name_manager', 2, 0);
INSERT INTO `admin_files` VALUES (29, 'options_values_manager', 2, 0);
INSERT INTO `admin_files` VALUES (30, 'attributes_controller', 2, 0);
INSERT INTO `admin_files` VALUES (31, 'downloads_manager', 2, 0);
INSERT INTO `admin_files` VALUES (32, 'option_name', 2, 0);
INSERT INTO `admin_files` VALUES (33, 'option_values', 2, 0);
INSERT INTO `admin_files` VALUES (34, 'manufacturers', 2, 0);
INSERT INTO `admin_files` VALUES (35, 'reviews', 2, 0);
INSERT INTO `admin_files` VALUES (36, 'specials', 2, 0);
INSERT INTO `admin_files` VALUES (37, 'featured', 2, 0);
INSERT INTO `admin_files` VALUES (38, 'salemaker', 2, 0);
INSERT INTO `admin_files` VALUES (39, 'products_expected', 2, 0);
INSERT INTO `admin_files` VALUES (88, 'products_to_categories', 2, 1);
INSERT INTO `admin_files` VALUES (40, 'modulesset=payment', 3, 0);
INSERT INTO `admin_files` VALUES (41, 'modulesset=shipping', 3, 0);
INSERT INTO `admin_files` VALUES (42, 'modulesset=ordertotal', 3, 0);
INSERT INTO `admin_files` VALUES (43, 'customers', 4, 0);
INSERT INTO `admin_files` VALUES (44, 'orders', 4, 0);
INSERT INTO `admin_files` VALUES (45, 'group_pricing', 4, 0);
INSERT INTO `admin_files` VALUES (46, 'paypal', 4, 0);
INSERT INTO `admin_files` VALUES (78, 'invoice', 4, 1);
INSERT INTO `admin_files` VALUES (79, 'packingslip', 4, 1);
INSERT INTO `admin_files` VALUES (47, 'countries', 5, 0);
INSERT INTO `admin_files` VALUES (48, 'zones', 5, 0);
INSERT INTO `admin_files` VALUES (49, 'geo_zones', 5, 0);
INSERT INTO `admin_files` VALUES (50, 'tax_classes', 5, 0);
INSERT INTO `admin_files` VALUES (51, 'tax_rates', 5, 0);
INSERT INTO `admin_files` VALUES (52, 'currencies', 6, 0);
INSERT INTO `admin_files` VALUES (53, 'languages', 6, 0);
INSERT INTO `admin_files` VALUES (54, 'orders_status', 6, 0);
INSERT INTO `admin_files` VALUES (55, 'stats_products_viewed', 7, 0);
INSERT INTO `admin_files` VALUES (56, 'stats_products_purchased', 7, 0);
INSERT INTO `admin_files` VALUES (57, 'stats_customers', 7, 0);
INSERT INTO `admin_files` VALUES (58, 'stats_products_lowstock', 7, 0);
INSERT INTO `admin_files` VALUES (59, 'stats_customers_referrals', 7, 0);
INSERT INTO `admin_files` VALUES (60, 'template_select', 8, 0);
INSERT INTO `admin_files` VALUES (61, 'layout_controller', 8, 0);
INSERT INTO `admin_files` VALUES (62, 'banner_manager', 8, 0);
INSERT INTO `admin_files` VALUES (63, 'mail', 8, 0);
INSERT INTO `admin_files` VALUES (64, 'newsletters', 8, 0);
INSERT INTO `admin_files` VALUES (65, 'server_info', 8, 0);
INSERT INTO `admin_files` VALUES (66, 'whos_online', 8, 0);
INSERT INTO `admin_files` VALUES (67, 'admin', 8, 0);
INSERT INTO `admin_files` VALUES (68, 'email_welcome', 8, 0);
INSERT INTO `admin_files` VALUES (69, 'store_manager', 8, 0);
INSERT INTO `admin_files` VALUES (82, 'ezpages', 8, 0);
INSERT INTO `admin_files` VALUES (70, 'developers_tool_kit', 8, 0);
INSERT INTO `admin_files` VALUES (71, 'define_pages_editor', 8, 0);
INSERT INTO `admin_files` VALUES (80, 'sqlpatch', 8, 0);
INSERT INTO `admin_files` VALUES (76, 'admin_control', 0, 1);
INSERT INTO `admin_files` VALUES (72, 'coupon_admin', 9, 0);
INSERT INTO `admin_files` VALUES (73, 'gv_queue', 9, 0);
INSERT INTO `admin_files` VALUES (74, 'gv_mail', 9, 0);
INSERT INTO `admin_files` VALUES (75, 'gv_sent', 9, 0);
INSERT INTO `admin_files` VALUES (83, 'record_artists', 10, 0);
INSERT INTO `admin_files` VALUES (84, 'record_company', 10, 0);
INSERT INTO `admin_files` VALUES (85, 'music_genre', 10, 0);
INSERT INTO `admin_files` VALUES (86, 'media_manager', 10, 0);
INSERT INTO `admin_files` VALUES (87, 'media_types', 10, 0);

#
# Create table structure for table `admin_allowed_pages`
#

DROP TABLE IF EXISTS `admin_allowed_pages`;
CREATE TABLE `admin_allowed_pages` (
  `page_id` int(11) NOT NULL default '0',
  `admin_id` int(11) NOT NULL default '0'
) TYPE=MyISAM;

#
# Insert data into table `admin_allowed_pages`
#

INSERT INTO `admin_allowed_pages` VALUES (1, 1);
INSERT INTO `admin_allowed_pages` VALUES (2, 1);
INSERT INTO `admin_allowed_pages` VALUES (3, 1);
INSERT INTO `admin_allowed_pages` VALUES (4, 1);
INSERT INTO `admin_allowed_pages` VALUES (5, 1);
INSERT INTO `admin_allowed_pages` VALUES (6, 1);
INSERT INTO `admin_allowed_pages` VALUES (7, 1);
INSERT INTO `admin_allowed_pages` VALUES (8, 1);
INSERT INTO `admin_allowed_pages` VALUES (9, 1);
INSERT INTO `admin_allowed_pages` VALUES (10, 1);
INSERT INTO `admin_allowed_pages` VALUES (11, 1);
INSERT INTO `admin_allowed_pages` VALUES (12, 1);
INSERT INTO `admin_allowed_pages` VALUES (13, 1);
INSERT INTO `admin_allowed_pages` VALUES (14, 1);
INSERT INTO `admin_allowed_pages` VALUES (15, 1);
INSERT INTO `admin_allowed_pages` VALUES (16, 1);
INSERT INTO `admin_allowed_pages` VALUES (17, 1);
INSERT INTO `admin_allowed_pages` VALUES (18, 1);
INSERT INTO `admin_allowed_pages` VALUES (19, 1);
INSERT INTO `admin_allowed_pages` VALUES (20, 1);
INSERT INTO `admin_allowed_pages` VALUES (21, 1);
INSERT INTO `admin_allowed_pages` VALUES (22, 1);
INSERT INTO `admin_allowed_pages` VALUES (23, 1);
INSERT INTO `admin_allowed_pages` VALUES (24, 1);
INSERT INTO `admin_allowed_pages` VALUES (25, 1);
INSERT INTO `admin_allowed_pages` VALUES (26, 1);
INSERT INTO `admin_allowed_pages` VALUES (27, 1);
INSERT INTO `admin_allowed_pages` VALUES (28, 1);
INSERT INTO `admin_allowed_pages` VALUES (29, 1);
INSERT INTO `admin_allowed_pages` VALUES (30, 1);
INSERT INTO `admin_allowed_pages` VALUES (31, 1);
INSERT INTO `admin_allowed_pages` VALUES (32, 1);
INSERT INTO `admin_allowed_pages` VALUES (33, 1);
INSERT INTO `admin_allowed_pages` VALUES (34, 1);
INSERT INTO `admin_allowed_pages` VALUES (35, 1);
INSERT INTO `admin_allowed_pages` VALUES (36, 1);
INSERT INTO `admin_allowed_pages` VALUES (37, 1);
INSERT INTO `admin_allowed_pages` VALUES (38, 1);
INSERT INTO `admin_allowed_pages` VALUES (39, 1);
INSERT INTO `admin_allowed_pages` VALUES (40, 1);
INSERT INTO `admin_allowed_pages` VALUES (41, 1);
INSERT INTO `admin_allowed_pages` VALUES (42, 1);
INSERT INTO `admin_allowed_pages` VALUES (43, 1);
INSERT INTO `admin_allowed_pages` VALUES (44, 1);
INSERT INTO `admin_allowed_pages` VALUES (45, 1);
INSERT INTO `admin_allowed_pages` VALUES (46, 1);
INSERT INTO `admin_allowed_pages` VALUES (47, 1);
INSERT INTO `admin_allowed_pages` VALUES (48, 1);
INSERT INTO `admin_allowed_pages` VALUES (49, 1);
INSERT INTO `admin_allowed_pages` VALUES (50, 1);
INSERT INTO `admin_allowed_pages` VALUES (51, 1);
INSERT INTO `admin_allowed_pages` VALUES (52, 1);
INSERT INTO `admin_allowed_pages` VALUES (53, 1);
INSERT INTO `admin_allowed_pages` VALUES (54, 1);
INSERT INTO `admin_allowed_pages` VALUES (55, 1);
INSERT INTO `admin_allowed_pages` VALUES (56, 1);
INSERT INTO `admin_allowed_pages` VALUES (57, 1);
INSERT INTO `admin_allowed_pages` VALUES (58, 1);
INSERT INTO `admin_allowed_pages` VALUES (59, 1);
INSERT INTO `admin_allowed_pages` VALUES (60, 1);
INSERT INTO `admin_allowed_pages` VALUES (61, 1);
INSERT INTO `admin_allowed_pages` VALUES (62, 1);
INSERT INTO `admin_allowed_pages` VALUES (63, 1);
INSERT INTO `admin_allowed_pages` VALUES (64, 1);
INSERT INTO `admin_allowed_pages` VALUES (65, 1);
INSERT INTO `admin_allowed_pages` VALUES (66, 1);
INSERT INTO `admin_allowed_pages` VALUES (67, 1);
INSERT INTO `admin_allowed_pages` VALUES (68, 1);
INSERT INTO `admin_allowed_pages` VALUES (69, 1);
INSERT INTO `admin_allowed_pages` VALUES (70, 1);
INSERT INTO `admin_allowed_pages` VALUES (71, 1);
INSERT INTO `admin_allowed_pages` VALUES (72, 1);
INSERT INTO `admin_allowed_pages` VALUES (73, 1);
INSERT INTO `admin_allowed_pages` VALUES (74, 1);
INSERT INTO `admin_allowed_pages` VALUES (75, 1);
INSERT INTO `admin_allowed_pages` VALUES (76, 1);
INSERT INTO `admin_allowed_pages` VALUES (77, 1);
INSERT INTO `admin_allowed_pages` VALUES (78, 1);
INSERT INTO `admin_allowed_pages` VALUES (79, 1);
INSERT INTO `admin_allowed_pages` VALUES (80, 1);
INSERT INTO `admin_allowed_pages` VALUES (81, 1);
INSERT INTO `admin_allowed_pages` VALUES (82, 1);
INSERT INTO `admin_allowed_pages` VALUES (83, 1);
INSERT INTO `admin_allowed_pages` VALUES (84, 1);
INSERT INTO `admin_allowed_pages` VALUES (85, 1);
INSERT INTO `admin_allowed_pages` VALUES (86, 1);
INSERT INTO `admin_allowed_pages` VALUES (87, 1);
INSERT INTO `admin_allowed_pages` VALUES (88, 1);