#
# * This SQL script upgrades the core Zen Cart database structure from v1.5.4 to v1.5.5
# *
# * @package Installer
# * @access private
# * @copyright Copyright 2003-2018 Zen Cart Development Team
# * @copyright Portions Copyright 2003 osCommerce
# * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
# * @version $Id: mysql_upgrade_zencart_155.sql 15 2018-05-08 08:03:59Z webchills $
#

############ IMPORTANT INSTRUCTIONS ###############
#
# * Zen Cart uses the zc_install/index.php program to do database upgrades
# * This SQL script is intended to be used by running zc_install
# * It is *not* recommended to simply run these statements manually via any other means
# * ie: not via phpMyAdmin or via the Install SQL Patch tool in Zen Cart admin
# * The zc_install program catches possible problems and also handles table-prefixes automatically
# *
# * To use the zc_install program to do your database upgrade:
# * a. Upload the NEWEST zc_install folder to your server
# * b. Surf to zc_install/index.php via your browser
# * c. On the System Inspection page, scroll to the bottom and click on Database Upgrade
# *    NOTE: do NOT click on the "Install" button, because that will erase your database.
# * d. On the Database Upgrade screen, you will be presented with a list of checkboxes for
# *    various Zen Cart versions, with the recommended upgrades already pre-selected.
# * e. Verify the checkboxes, then scroll down and enter your Zen Cart Admin username
# *    and password, and then click on the Upgrade button.
# * f. If any errors occur, you will be notified.  Some warnings can be ignored.
# * g. When done, you will be taken to the Finished page.
#
#####################################################

# Set store to Down-For-Maintenance mode.  Must reset manually via admin after upgrade is done.
#UPDATE configuration set configuration_value = 'true' where configuration_key = 'DOWN_FOR_MAINTENANCE';

# Clear out active customer sessions
TRUNCATE TABLE whos_online;
TRUNCATE TABLE db_cache;

UPDATE configuration set configuration_group_id = 6 where configuration_key in ('PRODUCTS_OPTIONS_TYPE_SELECT', 'UPLOAD_PREFIX', 'TEXT_PREFIX');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product option type Select', 'PRODUCTS_OPTIONS_TYPE_SELECT', '0', 'The number representing the Select type of product option.', 6, NULL, now(), now(), NULL, NULL);
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Upload prefix', 'UPLOAD_PREFIX', 'upload_', 'Prefix used to differentiate between upload options and other options', 6, NULL, now(), now(), NULL, NULL);
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Text prefix', 'TEXT_PREFIX', 'txt_', 'Prefix used to differentiate between text option values and other option values', 6, NULL, now(), now(), NULL, NULL);

UPDATE countries set countries_name = 'Åland Islands' where countries_iso_code_3 = 'ALA';
UPDATE countries set countries_name = 'Réunion' where countries_iso_code_3 = 'REU';
UPDATE countries set countries_name = "Côte d'Ivoire" where countries_iso_code_3 = 'CIV';
UPDATE countries set countries_name = 'Bonaire, Sint Eustatius and Saba', countries_iso_code_2 = 'BQ', countries_iso_code_3 = 'BES' WHERE countries_iso_code_3 = 'ANT';
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (247,'Curaçao','CW','CUW','1');
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (248,'Sint Maarten (Dutch part)','SX','SXM','1');

UPDATE configuration SET configuration_title='Credit Card Enable Status - Debit', configuration_key = 'CC_ENABLED_DEBIT', configuration_value ='0', configuration_description='Accept Debit Cards 0= off 1= on<br>NOTE: This is not deeply integrated at this time, and this setting may be redundant if your payment modules do not yet specifically have code to honour this switch.', date_added=now() WHERE configuration_key='CC_ENABLED_SWITCH';

UPDATE configuration set configuration_title = 'Enable HTML Emails?', configuration_description = 'Send emails in HTML format if recipient has enabled it in their preferences.' WHERE configuration_key = 'EMAIL_USE_HTML';
UPDATE configuration set configuration_title = 'Email Admin Format?', configuration_description = 'Please select the Admin extra email format (Note: Enable HTML Emails must be on for HTML option to work)' WHERE configuration_key = 'ADMIN_EXTRA_EMAIL_FORMAT';

UPDATE configuration SET configuration_title='Prev/Next Navigation Page Links (Desktop)', configuration_description='Number of numbered pagination links to display.' WHERE configuration_key = 'MAX_DISPLAY_PAGE_LINKS';
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Prev/Next Navigation Page Links (Mobile)', 'MAX_DISPLAY_PAGE_LINKS_MOBILE', '3', 'Number of numbered pagination links to display on Mobile devices (assuming your template supports mobile-specific settings)', '3', '3', now());

UPDATE configuration set sort_order = '1', configuration_description = 'Send out e-mails?<br>Normally this is set to true.<br>Set to false to suppress ALL outgoing email messages from this store, such as when working with a test copy of your store offline.' WHERE configuration_key = 'SEND_EMAILS';
UPDATE configuration set sort_order = '2', configuration_description = 'Defines the method for sending mail.<br /><strong>PHP</strong> is the default, and uses built-in PHP wrappers for processing.<br />Servers running on Windows and MacOS should change this setting to <strong>SMTP</strong>.<br /><br /><strong>SMTPAUTH</strong> should be used if your server requires SMTP authorization to send messages. You must also configure your SMTPAUTH settings in the appropriate fields in this admin section.<br /><br /><strong>sendmail</strong> is for linux/unix hosts using the sendmail program on the server<br /><strong>"sendmail-f"</strong> is only for servers which require the use of the -f parameter to send mail. This is a security setting often used to prevent spoofing. Will cause errors if your host mailserver is not configured to use it.<br /><br /><strong>Qmail</strong> is mostly obsolete and only used for linux/unix hosts running Qmail as sendmail wrapper at /var/qmail/bin/sendmail.' WHERE configuration_key = 'EMAIL_TRANSPORT';
UPDATE configuration set configuration_description = 'Enter the IP port number that your SMTP mailserver operates on.<br />Only required if using SMTP Authentication for email.<br><br>Default: 25<br>Typical values are:<br>25 - normal unencrypted SMTP<br>587 - encrypted SMTP<br>465 - older MS SMTP port' WHERE configuration_key = 'EMAIL_SMTPAUTH_MAIL_SERVER_PORT';
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Currency Exchange Rate: Primary Source', 'CURRENCY_SERVER_PRIMARY', 'ecb', 'Where to request external currency updates from (Primary source)<br><br>Additional sources can be installed via plugins.', '1', '55', 'zen_cfg_pull_down_exchange_rate_sources(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Currency Exchange Rate: Secondary Source', 'CURRENCY_SERVER_BACKUP', 'boc', 'Where to request external currency updates from (Secondary source)<br><br>Additional sources can be installed via plugins.', '1', '55', 'zen_cfg_pull_down_exchange_rate_sources(', now());
DELETE FROM configuration where configuration_key = 'PHPBB_LINKS_ENABLED' && configuration_value != 'true';

UPDATE configuration_group SET configuration_group_description = 'Define Pages Options Settings' where configuration_group_title = 'Define Page Status';


ALTER TABLE paypal_payment_status_history MODIFY pending_reason varchar(32) default NULL;
ALTER TABLE coupons_description MODIFY coupon_name VARCHAR(64) NOT NULL DEFAULT '';
ALTER TABLE orders MODIFY shipping_method VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin MODIFY COLUMN pwd_last_change_date datetime NOT NULL default '0001-01-01 00:00:00', MODIFY COLUMN last_modified datetime NOT NULL default '0001-01-01 00:00:00', MODIFY COLUMN last_login_date datetime NOT NULL default '0001-01-01 00:00:00', MODIFY COLUMN last_failed_attempt datetime NOT NULL default '0001-01-01 00:00:00';
UPDATE admin SET pwd_last_change_date='0001-01-01' where pwd_last_change_date < '0001-01-01';
UPDATE admin SET last_modified='0001-01-01' where last_modified < '0001-01-01';
UPDATE admin SET last_login_date='0001-01-01' where last_login_date < '0001-01-01';
UPDATE admin SET last_failed_attempt='0001-01-01' where last_failed_attempt < '0001-01-01';
ALTER TABLE admin MODIFY admin_pass VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE admin MODIFY prev_pass1 VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE admin MODIFY prev_pass2 VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE admin MODIFY prev_pass3 VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE admin MODIFY reset_token VARCHAR( 255 ) NOT NULL DEFAULT '';
UPDATE customers SET customers_dob='0001-01-01' where customers_dob < '0001-01-01';
ALTER TABLE customers MODIFY customers_password VARCHAR( 255 ) NOT NULL DEFAULT '';
ALTER TABLE sessions MODIFY sesskey varchar(255) NOT NULL default '';
ALTER TABLE whos_online MODIFY session_id varchar(255) NOT NULL default '';
ALTER TABLE admin_menus MODIFY menu_key VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_pages MODIFY page_key VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_pages MODIFY main_page VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_pages MODIFY page_params VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_pages MODIFY menu_key VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_profiles MODIFY profile_name VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_pages_to_profiles MODIFY page_key varchar(255) NOT NULL default '';

ALTER TABLE currencies MODIFY symbol_left VARCHAR(32) DEFAULT NULL;
ALTER TABLE currencies MODIFY symbol_right VARCHAR(32) DEFAULT NULL;

ALTER TABLE counter_history MODIFY startdate char(8) NOT NULL default '';

UPDATE query_builder set query_string = 'select max(o.date_purchased) as date_purchased, c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o WHERE c.customers_id = o.customers_id AND c.customers_newsletter = 1 GROUP BY c.customers_email_address, c.customers_lastname, c.customers_firstname HAVING max(o.date_purchased) <= subdate(now(),INTERVAL 3 MONTH) ORDER BY c.customers_lastname, c.customers_firstname ASC' where query_name='Dormant Customers (>3months) (Subscribers)';
UPDATE query_builder set query_string = 'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address, c.customers_lastname, c.customers_firstname order by c.customers_lastname, c.customers_firstname ASC' where query_name='Active customers in past 3 months (Subscribers)';
UPDATE query_builder set query_string = 'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o WHERE c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address, c.customers_lastname, c.customers_firstname order by c.customers_lastname, c.customers_firstname ASC' where query_name='Active customers in past 3 months (Regardless of subscription status)';

ALTER TABLE products_description MODIFY products_id int(11) NOT NULL;

UPDATE orders SET ip_address = '' WHERE ip_address != '';

# Insert a default profile for managing orders, as a built-in example of profile functionality
INSERT INTO admin_profiles (profile_name) values ('Order Processing');
SET @profile_id=last_insert_id();
INSERT INTO admin_pages_to_profiles (profile_id, page_key) VALUES
(@profile_id, 'customers'),
(@profile_id, 'orders'),
(@profile_id, 'invoice'),
(@profile_id, 'packingslip'),
(@profile_id, 'paypal'),
(@profile_id, 'currencies'),
(@profile_id, 'reportCustomers'),
(@profile_id, 'reportLowStock'),
(@profile_id, 'reportProductsSold'),
(@profile_id, 'reportProductsViewed'),
(@profile_id, 'reportReferrals'),
(@profile_id, 'gvMail'),
(@profile_id, 'gvQueue'),
(@profile_id, 'gvSent'),
(@profile_id, 'whosOnline');

#############


#### New in 1.5.5 German ####


#
# Table structure for new table 'countries_name'
#

DROP TABLE IF EXISTS countries_name;
CREATE TABLE IF NOT EXISTS countries_name (
  id int(11) NOT NULL AUTO_INCREMENT,
  countries_id int(11) NOT NULL,
  language_id int(11) NOT NULL DEFAULT '1',
  countries_name varchar(64) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE countries (countries_id, language_id, countries_name),
  KEY idx_countries_name_zen (countries_name)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# default content for new table 'countries_name'
#

INSERT INTO countries_name (countries_id, language_id, countries_name) VALUES

(1, 1, 'Afghanistan'),
(2, 1,  'Albania'),
(3, 1,  'Algeria'),
(4, 1,  'American Samoa'),
(5, 1,  'Andorra'),
(6, 1,  'Angola'),
(7, 1,  'Anguilla'),
(8, 1,  'Antarctica'),
(9,  1, 'Antigua and Barbuda'),
(10, 1,  'Argentina'),
(11, 1,  'Armenia'),
(12,  1, 'Aruba'),
(13, 1,  'Australia'),
(14, 1,  'Austria'),
(15, 1,  'Azerbaijan'),
(16, 1,  'Bahamas'),
(17, 1,  'Bahrain'),
(18, 1,  'Bangladesh'),
(19, 1,  'Barbados'),
(20, 1,  'Belarus'),
(21, 1,  'Belgium'),
(22, 1,  'Belize'),
(23, 1,  'Benin'),
(24, 1,  'Bermuda'),
(25, 1,  'Bhutan'),
(26, 1,  'Bolivia'),
(27, 1,  'Bosnia and Herzegowina'),
(28, 1,  'Botswana'),
(29, 1,  'Bouvet Island'),
(30, 1,  'Brazil'),
(31, 1,  'British Indian Ocean Territory'),
(32, 1,  'Brunei Darussalam'),
(33, 1,  'Bulgaria'),
(34, 1,  'Burkina Faso'),
(35, 1,  'Burundi'),
(36, 1,  'Cambodia'),
(37, 1,  'Cameroon'),
(38, 1,  'Canada'),
(39, 1,  'Cape Verde'),
(40, 1,  'Cayman Islands'),
(41, 1,  'Central African Republic'),
(42, 1,  'Chad'),
(43, 1,  'Chile'),
(44, 1,  'China'),
(45, 1,  'Christmas Island'),
(46, 1,  'Cocos (Keeling) Islands'),
(47, 1,  'Colombia'),
(48, 1,  'Comoros'),
(49, 1,  'Congo'),
(50, 1,  'Cook Islands'),
(51, 1,  'Costa Rica'),
(52, 1,  'Côte d''Ivoire'),
(53, 1,  'Croatia'),
(54, 1,  'Cuba'),
(55, 1,  'Cyprus'),
(56, 1,  'Czech Republic'),
(57, 1,  'Denmark'),
(58, 1,  'Djibouti'),
(59, 1,  'Dominica'),
(60, 1,  'Dominican Republic'),
(61, 1,  'Timor-Leste'),
(62, 1,  'Ecuador'),
(63, 1,  'Egypt'),
(64, 1,  'El Salvador'),
(65, 1,  'Equatorial Guinea'),
(66, 1,  'Eritrea'),
(67, 1,  'Estonia'),
(68, 1,  'Ethiopia'),
(69, 1,  'Falkland Islands (Malvinas)'),
(70, 1,  'Faroe Islands'),
(71, 1,  'Fiji'),
(72, 1,  'Finland'),
(73, 1,  'France'),
(75, 1,  'French Guiana'),
(76, 1,  'French Polynesia'),
(77, 1,  'French Southern Territories'),
(78, 1,  'Gabon'),
(79, 1,  'Gambia'),
(80, 1,  'Georgia'),
(81, 1,  'Germany'),
(82, 1,  'Ghana'),
(83, 1,  'Gibraltar'),
(84, 1,  'Greece'),
(85, 1,  'Greenland'),
(86, 1,  'Grenada'),
(87, 1,  'Guadeloupe'),
(88, 1,  'Guam'),
(89, 1,  'Guatemala'),
(90, 1,  'Guinea'),
(91, 1,  'Guinea-bissau'),
(92, 1,  'Guyana'),
(93, 1,  'Haiti'),
(94, 1,  'Heard and Mc Donald Islands'),
(95, 1,  'Honduras'),
(96, 1,  'Hong Kong'),
(97, 1,  'Hungary'),
(98, 1,  'Iceland'),
(99, 1,  'India'),
(100, 1,  'Indonesia'),
(101, 1,  'Iran (Islamic Republic of)'),
(102, 1,  'Iraq'),
(103, 1,  'Ireland'),
(104, 1,  'Israel'),
(105, 1,  'Italy'),
(106, 1,  'Jamaica'),
(107, 1,  'Japan'),
(108, 1,  'Jordan'),
(109, 1,  'Kazakhstan'),
(110, 1, 'Kenya'),
(111, 1, 'Kiribati'),
(112, 1, 'Korea, Democratic People''s Republic of'),
(113, 1, 'Korea, Republic of'),
(114, 1, 'Kuwait'),
(115, 1, 'Kyrgyzstan'),
(116, 1, 'Lao People''s Democratic Republic'),
(117, 1, 'Latvia'),
(118, 1,  'Lebanon'),
(119, 1,  'Lesotho'),
(120, 1,  'Liberia'),
(121, 1,  'Libya'),
(122, 1,  'Liechtenstein'),
(123, 1,  'Lithuania'),
(124, 1,  'Luxembourg'),
(125, 1,  'Macao'),
(126, 1,  'Macedonia, The Former Yugoslav Republic of'),
(127, 1,  'Madagascar'),
(128, 1,  'Malawi'),
(129, 1,  'Malaysia'),
(130, 1,  'Maldives'),
(131, 1, 'Mali'),
(132, 1, 'Malta'),
(133, 1, 'Marshall Islands'),
(134, 1, 'Martinique'),
(135, 1, 'Mauritania'),
(136, 1, 'Mauritius'),
(137, 1, 'Mayotte'),
(138, 1, 'Mexico'),
(139, 1, 'Micronesia, Federated States of'),
(140, 1, 'Moldova'),
(141, 1, 'Monaco'),
(142, 1, 'Mongolia'),
(143, 1, 'Montserrat'),
(144, 1, 'Morocco'),
(145, 1, 'Mozambique'),
(146, 1, 'Myanmar'),
(147, 1, 'Namibia'),
(148, 1, 'Nauru'),
(149, 1, 'Nepal'),
(150, 1, 'Netherlands'),
(151, 1, 'Bonaire, Sint Eustatius and Saba'),
(152, 1, 'New Caledonia'),
(153, 1, 'New Zealand'),
(154, 1, 'Nicaragua'),
(155, 1, 'Niger'),
(156, 1, 'Nigeria'),
(157, 1, 'Niue'),
(158, 1, 'Norfolk Island'),
(159, 1, 'Northern Mariana Islands'),
(160, 1, 'Norway'),
(161, 1, 'Oman'),
(162, 1, 'Pakistan'),
(163, 1, 'Palau'),
(164, 1, 'Panama'),
(165, 1, 'Papua New Guinea'),
(166, 1, 'Paraguay'),
(167, 1, 'Peru'),
(168, 1, 'Philippines'),
(169, 1, 'Pitcairn'),
(170, 1, 'Poland'),
(171, 1, 'Portugal'),
(172, 1, 'Puerto Rico'),
(173, 1, 'Qatar'),
(174, 1, 'Réunion'),
(175, 1, 'Romania'),
(176, 1, 'Russian Federation'),
(177, 1, 'Rwanda'),
(178, 1, 'Saint Kitts and Nevis'),
(179, 1, 'Saint Lucia'),
(180, 1, 'Saint Vincent and the Grenadines'),
(181, 1, 'Samoa'),
(182, 1, 'San Marino'),
(183, 1, 'Sao Tome and Principe'),
(184, 1, 'Saudi Arabia'),
(185, 1, 'Senegal'),
(186, 1, 'Seychelles'),
(187, 1, 'Sierra Leone'),
(188, 1, 'Singapore'),
(189, 1, 'Slovakia (Slovak Republic)'),
(190, 1, 'Slovenia'),
(191, 1, 'Solomon Islands'),
(192, 1, 'Somalia'),
(193, 1, 'South Africa'),
(194, 1, 'South Georgia and the South Sandwich Islands'),
(195, 1, 'Spain'),
(196, 1, 'Sri Lanka'),
(197, 1, 'St. Helena'),
(198, 1, 'St. Pierre and Miquelon'),
(199, 1, 'Sudan'),
(200, 1, 'Suriname'),
(201, 1, 'Svalbard and Jan Mayen Islands'),
(202, 1, 'Swaziland'),
(203, 1, 'Sweden'),
(204, 1, 'Switzerland'),
(205, 1, 'Syrian Arab Republic'),
(206, 1, 'Taiwan'),
(207, 1, 'Tajikistan'),
(208, 1, 'Tanzania, United Republic of'),
(209, 1, 'Thailand'),
(210, 1, 'Togo'),
(211, 1, 'Tokelau'),
(212, 1, 'Tonga'),
(213, 1, 'Trinidad and Tobago'),
(214, 1, 'Tunisia'),
(215, 1, 'Turkey'),
(216, 1, 'Turkmenistan'),
(217, 1, 'Turks and Caicos Islands'),
(218, 1, 'Tuvalu'),
(219, 1, 'Uganda'),
(220, 1, 'Ukraine'),
(221, 1, 'United Arab Emirates'),
(222, 1, 'United Kingdom'),
(223, 1, 'United States'),
(224, 1, 'United States Minor Outlying Islands'),
(225, 1, 'Uruguay'),
(226, 1, 'Uzbekistan'),
(227, 1, 'Vanuatu'),
(228, 1, 'Vatican City State (Holy See)'),
(229, 1, 'Venezuela'),
(230, 1, 'Viet Nam'),
(231, 1, 'Virgin Islands (British)'),
(232, 1, 'Virgin Islands (U.S.)'),
(233, 1, 'Wallis and Futuna Islands'),
(234, 1, 'Western Sahara'),
(235, 1, 'Yemen'),
(236, 1, 'Serbia'),
(238, 1, 'Zambia'),
(239, 1, 'Zimbabwe'),
(240, 1, 'Åland Islands'),
(241, 1, 'Palestine, State of'),
(242, 1, 'Montenegro'),
(243, 1, 'Guernsey'),
(244, 1, 'Isle of Man'),
(245, 1, 'Jersey'),
(246, 1, 'South Sudan'),
(247, 1, 'Curaçao'),
(248, 1, 'Sint Maarten'),
(1, 43, 'Afghanistan'),
(2, 43,  'Albanien'),
(3, 43,  'Algerien'),
(4, 43,  'American Samoa'),
(5, 43,  'Andorra'),
(6, 43,  'Angola'),
(7, 43,  'Anguilla'),
(8, 43,  'Antarctica'),
(9,  43, 'Antigua and Barbuda'),
(10, 43,  'Argentinien'),
(11, 43,  'Armenien'),
(12, 43, 'Aruba'),
(13, 43,  'Australien'),
(14, 43,  'Österreich'),
(15, 43,  'Aserbaidschan'),
(16, 43,  'Bahamas'),
(17, 43,  'Bahrain'),
(18, 43,  'Bangladesch'),
(19, 43,  'Barbados'),
(20, 43,  'Weissrussland'),
(21, 43,  'Belgien'),
(22, 43,  'Belize'),
(23, 43,  'Benin'),
(24, 43,  'Bermuda'),
(25, 43,  'Bhutan'),
(26, 43,  'Bolivien'),
(27, 43,  'Bosnien Herzegowina'),
(28, 43,  'Botswana'),
(29, 43,  'Bouvet Island'),
(30, 43,  'Brasilien'),
(31, 43,  'British Indian Ocean Territory'),
(32, 43,  'Brunei Darussalam'),
(33, 43,  'Bulgarien'),
(34, 43,  'Burkina Faso'),
(35, 43,  'Burundi'),
(36, 43,  'Kambodscha'),
(37, 43,  'Kamerun'),
(38, 43,  'Kanada'),
(39, 43,  'Cape Verde'),
(40, 43,  'Cayman Islands'),
(41, 43,  'Zentralafrikanische Republik'),
(42, 43,  'Tschad'),
(43, 43,  'Chile'),
(44, 43,  'China'),
(45, 43,  'Christmas Island'),
(46, 43,  'Cocos (Keeling) Islands'),
(47, 43,  'Kolumbien'),
(48, 43,  'Komoren'),
(49, 43,  'Kongo'),
(50, 43,  'Cook Islands'),
(51, 43,  'Costa Rica'),
(52, 43,  'Elfenbeinküste'),
(53, 43,  'Kroatien'),
(54, 43,  'Kuba'),
(55, 43,  'Zypern'),
(56, 43,  'Tschechien'),
(57, 43,  'Dänemark'),
(58, 43,  'Djibouti'),
(59, 43,  'Dominica'),
(60, 43,  'Dominikanische Republik'),
(61, 43,  'Timor-Leste'),
(62, 43,  'Ecuador'),
(63, 43,  'Ägypten'),
(64, 43,  'El Salvador'),
(65, 43,  'Equatorial Guinea'),
(66, 43,  'Eritrea'),
(67, 43,  'Estland'),
(68, 43,  'Äthiopien'),
(69, 43,  'Falkland Inseln'),
(70, 43,  'Faroer Inseln'),
(71, 43,  'Fiji'),
(72, 43,  'Finnland'),
(73, 43,  'Frankreich'),
(75, 43,  'French Guiana'),
(76, 43,  'French Polynesia'),
(77, 43,  'French Southern Territories'),
(78, 43,  'Gabun'),
(79, 43,  'Gambia'),
(80, 43,  'Georgien'),
(81, 43,  'Deutschland'),
(82, 43,  'Ghana'),
(83, 43,  'Gibraltar'),
(84, 43,  'Griechenland'),
(85, 43,  'Grönland'),
(86, 43,  'Grenada'),
(87, 43,  'Guadeloupe'),
(88, 43,  'Guam'),
(89, 43,  'Guatemala'),
(90, 43,  'Guinea'),
(91, 43,  'Guinea-Bissau'),
(92, 43,  'Guyana'),
(93, 43,  'Haiti'),
(94, 43,  'Heard and Mc Donald Islands'),
(95, 43,  'Honduras'),
(96, 43,  'Hong Kong'),
(97, 43,  'Ungarn'),
(98, 43,  'Island'),
(99, 43,  'Indien'),
(100, 43,  'Indonesien'),
(101, 43,  'Iran'),
(102, 43,  'Irak'),
(103, 43,  'Irland'),
(104, 43,  'Israel'),
(105, 43,  'Italien'),
(106, 43,  'Jamaica'),
(107, 43,  'Japan'),
(108, 43,  'Jordanien'),
(109, 43,  'Kasachstan'),
(110, 43, 'Kenia'),
(111, 43, 'Kiribati'),
(112, 43, 'Nordkorea'),
(113, 43, 'Südkorea'),
(114, 43, 'Kuwait'),
(115, 43, 'Kyrgyzstan'),
(116, 43, 'Laos'),
(117, 43, 'Lettland'),
(118, 43,  'Libanon'),
(119, 43,  'Lesotho'),
(120, 43,  'Liberia'),
(121, 43,  'Libyen'),
(122, 43,  'Liechtenstein'),
(123, 43,  'Litauen'),
(124, 43,  'Luxembourg'),
(125, 43,  'Macao'),
(126, 43,  'Mazedonien'),
(127, 43,  'Madagaskar'),
(128, 43,  'Malawi'),
(129, 43,  'Malaysia'),
(130, 43,  'Malediven'),
(131, 43, 'Mali'),
(132, 43, 'Malta'),
(133, 43, 'Marshall Islands'),
(134, 43, 'Martinique'),
(135, 43, 'Mauretanien'),
(136, 43, 'Mauritius'),
(137, 43, 'Mayotte'),
(138, 43, 'Mexico'),
(139, 43, 'Micronesia, Federated States of'),
(140, 43, 'Moldova'),
(141, 43, 'Monaco'),
(142, 43, 'Mongolei'),
(143, 43, 'Montserrat'),
(144, 43, 'Marokko'),
(145, 43, 'Mozambique'),
(146, 43, 'Myanmar'),
(147, 43, 'Namibia'),
(148, 43, 'Nauru'),
(149, 43, 'Nepal'),
(150, 43, 'Niederlande'),
(151, 43, 'Bonaire, Sint Eustatius and Saba'),
(152, 43, 'New Caledonia'),
(153, 43, 'Neuseeland'),
(154, 43, 'Nicaragua'),
(155, 43, 'Niger'),
(156, 43, 'Nigeria'),
(157, 43, 'Niue'),
(158, 43, 'Norfolk Island'),
(159, 43, 'Northern Mariana Islands'),
(160, 43, 'Norwegen'),
(161, 43, 'Oman'),
(162, 43, 'Pakistan'),
(163, 43, 'Palau'),
(164, 43, 'Panama'),
(165, 43, 'Papua Neu Guinea'),
(166, 43, 'Paraguay'),
(167, 43, 'Peru'),
(168, 43, 'Philippinen'),
(169, 43, 'Pitcairn'),
(170, 43, 'Polen'),
(171, 43, 'Portugal'),
(172, 43, 'Puerto Rico'),
(173, 43, 'Qatar'),
(174, 43, 'Réunion'),
(175, 43, 'Rumänien'),
(176, 43, 'Russland'),
(177, 43, 'Ruanda'),
(178, 43, 'Saint Kitts and Nevis'),
(179, 43, 'Saint Lucia'),
(180, 43, 'Saint Vincent and the Grenadines'),
(181, 43, 'Samoa'),
(182, 43, 'San Marino'),
(183, 43, 'Sao Tome and Principe'),
(184, 43, 'Saudi Arabien'),
(185, 43, 'Senegal'),
(186, 43, 'Seychellen'),
(187, 43, 'Sierra Leone'),
(188, 43, 'Singapur'),
(189, 43, 'Slowakei'),
(190, 43, 'Slowenien'),
(191, 43, 'Solomon Islands'),
(192, 43, 'Somalia'),
(193, 43, 'Südafrika'),
(194, 43, 'South Georgia and the South Sandwich Islands'),
(195, 43, 'Spanien'),
(196, 43, 'Sri Lanka'),
(197, 43, 'St. Helena'),
(198, 43, 'St. Pierre and Miquelon'),
(199, 43, 'Sudan'),
(200, 43, 'Surinam'),
(201, 43, 'Svalbard and Jan Mayen Islands'),
(202, 43, 'Swaziland'),
(203, 43, 'Schweden'),
(204, 43, 'Schweiz'),
(205, 43, 'Syrian Arab Republic'),
(206, 43, 'Taiwan'),
(207, 43, 'Tajikistan'),
(208, 43, 'Tansania'),
(209, 43, 'Thailand'),
(210, 43, 'Togo'),
(211, 43, 'Tokelau'),
(212, 43, 'Tonga'),
(213, 43, 'Trinidad and Tobago'),
(214, 43, 'Tunesien'),
(215, 43, 'Türkei'),
(216, 43, 'Turkmenistan'),
(217, 43, 'Turks and Caicos Islands'),
(218, 43, 'Tuvalu'),
(219, 43, 'Uganda'),
(220, 43, 'Ukraine'),
(221, 43, 'Vereinigte Arabische Emirate'),
(222, 43, 'Großbritannien'),
(223, 43, 'USA'),
(224, 43, 'United States Minor Outlying Islands'),
(225, 43, 'Uruguay'),
(226, 43, 'Usbekistan'),
(227, 43, 'Vanuatu'),
(228, 43, 'Vatikanstaat'),
(229, 43, 'Venezuela'),
(230, 43, 'Vietnam'),
(231, 43, 'Virgin Islands (British)'),
(232, 43, 'Virgin Islands (U.S.)'),
(233, 43, 'Wallis and Futuna Islands'),
(234, 43, 'Western Sahara'),
(235, 43, 'Jemen'),
(236, 43, 'Serbien'),
(238, 43, 'Sambia'),
(239, 43, 'Zimbabwe'),
(240, 43, 'Åland Islands'),
(241, 43, 'Palästina'),
(242, 43, 'Montenegro'),
(243, 43, 'Guernsey'),
(244, 43, 'Isle of Man'),
(245, 43, 'Jersey'),
(246, 43, 'Südsudan'),
(247, 43, 'Curaçao'),
(248, 43, 'Sint Maarten');


### device in table orders ####

ALTER TABLE orders ADD order_device varchar(10) NOT NULL default '';

### Install Zen Colorbox ####

## Remove Old Zen Colorbox Entries
DELETE FROM configuration_group WHERE configuration_group_title = 'Zen Colorbox';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_STATUS';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_OVERLAY_OPACITY';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_RESIZE_DURATION';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_INITIAL_WIDTH';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_INITIAL_HEIGHT';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_COUNTER';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_CLOSE_OVERLAY';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_LOOP';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_SLIDESHOW';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_SLIDESHOW_AUTO';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_SLIDESHOW_SPEED';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_SLIDESHOW_START_TEXT';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_SLIDESHOW_STOP_TEXT';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_GALLERY_MODE';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_GALLERY_MAIN_IMAGE';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_EZPAGES';
DELETE FROM configuration WHERE configuration_key = 'ZEN_COLORBOX_FILE_TYPES';
DELETE FROM configuration_language WHERE configuration_key LIKE '%ZEN_COLORBOX%';
DELETE FROM admin_pages WHERE page_key='configZenColorbox';

INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('Zen Colorbox', 'Configure Zen Colorbox settings', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('<b>Zen Colorbox</b>', 'ZEN_COLORBOX_STATUS', 'true', '<br />If true, all product images on the following pages will be displayed within a lightbox:<br /><br />- document_general_info<br />- document_product_info<br />- page (EZ-Pages)<br />- product_free_shipping_info<br />- product_info<br />- product_music_info<br />- product_reviews<br />- product_reviews_info<br />- product_reviews_write<br /><br /><b>Default: true</b>', @gid, 100, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('Overlay Opacity', 'ZEN_COLORBOX_OVERLAY_OPACITY', '0.6', '<br />Controls the transparency of the overlay.<br /><br /><b>Default: 0.6</b>', @gid, 101, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''0'', ''0.1'', ''0.2'', ''0.3'', ''0.4'', ''0.5'', ''0.6'', ''0.7'', ''0.8'', ''0.9'', ''1''), '),
('Resize Duration', 'ZEN_COLORBOX_RESIZE_DURATION', '400', '<br />Controls the speed of the image resizing.<br /><br />Note: This value is measured in milliseconds.<br /><br /><b>Default: 400</b><br />', @gid, 102, NOW(), NOW(), NULL, NULL),
('Initial Width', 'ZEN_COLORBOX_INITIAL_WIDTH', '250', '<br />If Enable Resize Animations is set to true, the lightbox will resize its width from this value to the current image width, when first displayed.<br /><br />Note: This value is measured in pixels.<br /><br /><b>Default: 250</b><br />', @gid, 103, NOW(), NOW(), NULL, NULL),
('Initial Height', 'ZEN_COLORBOX_INITIAL_HEIGHT', '250', '<br />If Enable Resize Animations is set to true, the lightbox will resize its height from this value to the current image height, when first displayed.<br /><br />Note: This value is measured in pixels.<br /><br /><b>Default: 250</b><br />', @gid, 104, NOW(), NOW(), NULL, NULL),
('Display Image Counter', 'ZEN_COLORBOX_COUNTER', 'true', '<br />If true, the image counter will be displayed (below the caption of each image) within the lightbox.<br /><br /><b>Default: true</b>', @gid, 105, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('Close on Overlay Click', 'ZEN_COLORBOX_CLOSE_OVERLAY', 'false', '<br />If true, the lightbox will close when the overlay is clicked.<br /><br /><b>Default: false</b>', @gid, 106, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('Loop', 'ZEN_COLORBOX_LOOP', 'true', '<br />If true, Images will loop in both directions.<br /><br /><b>Default: true</b>', @gid, 107, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('<b>Slideshow</b>', 'ZEN_COLORBOX_SLIDESHOW', 'false', '<br />If true, Images will display as a slideshow.<br /><br /><b>Default: false</b>', @gid, 200, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('&nbsp; Slideshow Auto Start', 'ZEN_COLORBOX_SLIDESHOW_AUTO', 'true', '<br />If true, your slideshow will auto start.<br /><br /><b>Default: true</b>', @gid, 201, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('&nbsp; Slideshow Speed', 'ZEN_COLORBOX_SLIDESHOW_SPEED', '2500', '<br />Sets the speed of the slideshow <br /><br />Note: This value is measured in milliseconds.<br /><br /><b>Default: 2500</b>', @gid, 202, NOW(), NOW(), NULL, NULL),
('&nbsp; Slideshow Start Text', 'ZEN_COLORBOX_SLIDESHOW_START_TEXT', 'start slideshow', '<br />Link text to start the slideshow.<br /><br /><b>Default: start slideshow</b>', @gid, 203, NOW(), NOW(), NULL, NULL),
('&nbsp; Slideshow Stop Text', 'ZEN_COLORBOX_SLIDESHOW_STOP_TEXT', 'stop slideshow', '<br />Link text to stop the slideshow.<br /><br /><b>Default: stop slideshow</b>', @gid, 204, NOW(), NOW(), NULL, NULL),
('<b>Gallery Mode</b>', 'ZEN_COLORBOX_GALLERY_MODE', 'true', '<br />If true, the lightbox will allow additional images to quickly be displayed using previous and next buttons.<br /><br /><b>Default: true</b>', @gid, 300, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('&nbsp; Include Main Image in Gallery', 'ZEN_COLORBOX_GALLERY_MAIN_IMAGE', 'true', '<br />If true, the main product image will be included in the lightbox gallery.<br /><br /><b>Default: true</b>', @gid, 301, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('<b>EZ-Pages Support</b>', 'ZEN_COLORBOX_EZPAGES', 'true', '<br />If true, the lightbox effect will be used for linked images on all EZ-Pages.<br /><br /><b>Default: true</b>', @gid, 400, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('&nbsp; File Types', 'ZEN_COLORBOX_FILE_TYPES', 'jpg,png,gif', '<br />On EZ-Pages, the lightbox effect will be applied to all images with one of the following file types.<br /><br /><b>Default: jpg,png,gif</b><br />', @gid, 401, NOW(), NOW(), NULL, NULL);


##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Zen Colorbox', 'Zen Colorbox Einstellungen', '1', '1');


REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('<b>Zen Colorbox</b>', 'ZEN_COLORBOX_STATUS', 'Wollen Sie für die Vergrößerung Ihrer Artikelbilder einen Lightboxeffekt nutzen?<br/><br/>Voreinstellung = true<br/>', 43),
('Overlay Transparenz', 'ZEN_COLORBOX_OVERLAY_OPACITY', 'Gewünschte Transparenz des Overlays<br/><br/>Voreinstellung = 0.6<br/>', 43),
('Dauer der Bildvergrößerung', 'ZEN_COLORBOX_RESIZE_DURATION', 'Geschwindigkeit in Millisekunden<br/><br/>Voreinstellung = 400<br/>', 43),
('Anfangs Bildbreite', 'ZEN_COLORBOX_INITIAL_WIDTH', 'Breite des Artikelbildes beim ersten Aufruf<br/><br/>Voreinstellung = 250<br/>', 43),
('Anfangs Bildhöhe', 'ZEN_COLORBOX_INITIAL_HEIGHT', 'Höhe des Artikelbildes beim ersten Aufruf<br/><br/>Voreinstellung = 250<br/>', 43),
('Bildzähler anzeigen', 'ZEN_COLORBOX_COUNTER', 'Soll innerhalb der Lightbox eine Anzeige zur Anzahl der Bilder erscheinen?<br/><br/>Voreinstellung = true<br/>', 43),
('Beim Click aufs Overlay schließen?', 'ZEN_COLORBOX_CLOSE_OVERLAY', 'Soll die Lightbox beim Clicken auf das Overlay geschlossen werden?<br/><br/>Voreinstellung = false<br/>', 43),
('Loop', 'ZEN_COLORBOX_LOOP', 'Wenn auf true gestellt vergrößern sich die Bilder in beide Richtungen<br/><br/>Voreinstellung = true<br/>', 43),
('<b>Slideshow</b>', 'ZEN_COLORBOX_SLIDESHOW', 'Sollen die zusätzlichen Artikelbilder in einer Slideshow angezeigt werden?<br/><br/>Voreinstellung = false<br/>', 43),
('&nbsp; Slideshow Autostart', 'ZEN_COLORBOX_SLIDESHOW_AUTO', 'Slideshow automatisch starten?<br/><br/>Voreinstellung = true<br/>', 43),
('&nbsp; Slideshow Geschwindigkeit', 'ZEN_COLORBOX_SLIDESHOW_SPEED', 'Geschwindigkeit der Slideshow in Millisekunden<br/><br/>Voreinstellung = 2500<br/>', 43),
('&nbsp; Slideshow Start Text', 'ZEN_COLORBOX_SLIDESHOW_START_TEXT', 'Text des Links zum Starten der Slideshow<br/><br/>Voreinstellung = start slideshow<br/>', 43),
('&nbsp; Slideshow Stop Text', 'ZEN_COLORBOX_SLIDESHOW_STOP_TEXT', 'Text des Links zum Stoppen der Slideshow<br/><br/>Voreinstellung = stop slideshow<br/>', 43),
('<b>Galerie Modus</b>', 'ZEN_COLORBOX_GALLERY_MODE', 'Sollen die zusätzlichen Artikelbilder in einer Galerie zum Durchblättern erscheinen<br/><br/>Voreinstellung = true<br/>', 43),
('&nbsp; Hauptbild in Galerie aufnehmen?', 'ZEN_COLORBOX_GALLERY_MAIN_IMAGE', 'Soll das Hauptartikelbild Bestandteil der Galerieansicht sein?<br/><br/>Voreinstellung = true<br/>', 43),
('<b>EZ-Pages Unterstützung</b>', 'ZEN_COLORBOX_EZPAGES', 'Soll der Lightbox Effekt auch auf Bilder in den EZ Pages angewandt werden?<br/><br/>Voreinstellung = true<br/>', 43),
('&nbsp; Dateitypen', 'ZEN_COLORBOX_FILE_TYPES', 'Auf den EZ-Pages wird der Lightbox Effekt auf alle Bilder mit folgenden Dateitypen angewandt:<br/><br/>Voreinstellung = jpg,png,gif<br/>', 43);



###################################
# Register for Admin Access Control
###################################

INSERT INTO admin_pages (page_key ,language_key ,main_page ,page_params ,menu_key ,display_on_menu ,sort_order) VALUES 
('configZenColorbox', 'BOX_CONFIGURATION_ZEN_COLORBOX', 'FILENAME_CONFIGURATION', CONCAT('gID=',@gid), 'configuration', 'Y', @gid);


### additional entries in Google Analytics ####

SELECT @configuration_group_id:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'Google Analytics'
LIMIT 1;

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, use_function, set_function, date_added) VALUES
('Demographics and Interest Reports', 'GOOGLE_ANALYTICS_DIR', 'Disabled', 'Enables / Disables Demographics and Interest Reports<br /><br />', @configuration_group_id, 12, NOW(), NULL, 'zen_cfg_select_option(array(\'asc\', \'desc\'), ', NOW()),
('Google Conversion Label', 'GOOGLE_CONVERSION_LABEL', 'purchase', 'Enter your Google Conversion Label (can be generated in Google Adwords or you can create a custom label for tracking elsewhere)<br /><br />', @configuration_group_id, 13, NOW(), NULL, 'zen_cfg_textarea(', NOW());



### additional entries in Facebook Open Graph ####

SELECT @configuration_group_id:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'Facebook Support'
LIMIT 1;



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('Google Publisher', 'FACEBOOK_OPEN_GRAPH_GOOGLE_PUBLISHER', '', 'Please enter your full Google Publisher url/link (https://plus.google.com/+xxx/)', @configuration_group_id, 20, NOW(), NOW(), NULL, NULL),
('Your Logo', 'FACEBOOK_OPEN_GRAPH_LOGO', '', 'Please enter your full link to your logo url/link https:// is better!', @configuration_group_id, 21, NOW(), NOW(), NULL, NULL),
('Street Address', 'FACEBOOK_OPEN_GRAPH_STREET_ADDRESS', '', 'Please enter your street address', @configuration_group_id, 22, NOW(), NOW(), NULL, NULL),
('City', 'FACEBOOK_OPEN_GRAPH_CITY', '', 'Please enter your city', @configuration_group_id, 23, NOW(), NOW(), NULL, NULL),
('State', 'FACEBOOK_OPEN_GRAPH_STATE', '', 'Please enter your state', @configuration_group_id, 24, NOW(), NOW(), NULL, NULL),
('Postal Code', 'FACEBOOK_OPEN_GRAPH_ZIP', '', 'Please enter your postal code/zip', @configuration_group_id, 25, NOW(), NOW(), NULL, NULL),
('Country', 'FACEBOOK_OPEN_GRAPH_COUNTRY', '', 'Please enter your 2 letter country code such as US', @configuration_group_id, 26, NOW(), NOW(), NULL, NULL),
('Email', 'FACEBOOK_OPEN_GRAPH_EMAIL', '', 'Please enter your customer service email address (all lower case!)', @configuration_group_id, 27, NOW(), NOW(), NULL, NULL),
('Phone', 'FACEBOOK_OPEN_GRAPH_PHONE', '', 'Required. An internationalized version of the phone number, starting with the + symbol and country code (+1 in the US and Canada). Like this +1-330-871-4357', @configuration_group_id, 28, NOW(), NOW(), NULL, NULL),
('Twitter Handle', 'FACEBOOK_OPEN_GRAPH_TWUSER', '', 'Please enter your Twitter Handle like this @prowebs', @configuration_group_id, 29, NOW(), NOW(), NULL, NULL),
('Facebook Page', 'FACEBOOK_OPEN_GRAPH_FBPG', '', 'Please enter your full url/link to your facebook page (https://www.facebook.com/xxx)', @configuration_group_id, 30, NOW(), NOW(), NULL, NULL),
('Locale', 'FACEBOOK_OPEN_GRAPH_LOCALE', 'German', 'Optional details about the language spoken. Languages may be specified by their common English name. If omitted, the language defaults to English.', @configuration_group_id, 31, NOW(), NOW(), NULL, NULL),
('Currency', 'FACEBOOK_OPEN_GRAPH_CUR', 'EUR', 'Please enter your currency code such as USD', @configuration_group_id, 32, NOW(), NOW(), NULL, NULL),
('Lead Time', 'FACEBOOK_OPEN_GRAPH_DTS', '', 'Please enter the average days until you ship orders such as 2', @configuration_group_id, 33, NOW(), NOW(), NULL, NULL),
('Condition', 'FACEBOOK_OPEN_GRAPH_COND', '', 'Please enter your products condition (NewCondition, UsedCondition, RefurbishedCondition, DamagedCondition)', @configuration_group_id, 34, NOW(), NOW(), NULL, NULL),
('Payment Type 1', 'FACEBOOK_OPEN_GRAPH_PAY1', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', @configuration_group_id, 35, NOW(), NOW(), NULL, NULL),
('Payment Type 2', 'FACEBOOK_OPEN_GRAPH_PAY2', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', @configuration_group_id, 36, NOW(), NOW(), NULL, NULL),
('Payment Type 3', 'FACEBOOK_OPEN_GRAPH_PAY3', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', @configuration_group_id, 37, NOW(), NOW(), NULL, NULL),
('Payment Type 4', 'FACEBOOK_OPEN_GRAPH_PAY4', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', @configuration_group_id, 38, NOW(), NOW(), NULL, NULL),
('Payment Type 5', 'FACEBOOK_OPEN_GRAPH_PAY5', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', @configuration_group_id, 39, NOW(), NOW(), NULL, NULL),
('Payment Type 6', 'FACEBOOK_OPEN_GRAPH_PAY6', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', @configuration_group_id, 40, NOW(), NOW(), NULL, NULL),
('Tax ID', 'FACEBOOK_OPEN_GRAPH_TID', '', 'The Tax / Fiscal ID of the organization (e.g. the TIN in the US or the CIF/NIF in Spain))', @configuration_group_id, 41, NOW(), NOW(), NULL, NULL),
('DUNS', 'FACEBOOK_OPEN_GRAPH_DUNS', '', 'The Dun & Bradstreet DUNS number for identifying an organization or business person.', @configuration_group_id, 42, NOW(), NOW(), NULL, NULL),
('Fax', 'FACEBOOK_OPEN_GRAPH_FAX', '', 'Please enter your fax number like this +1-877-453-1304.', @configuration_group_id, 43, NOW(), NOW(), NULL, NULL),
('VAT ID', 'FACEBOOK_OPEN_GRAPH_VAT', '', 'Value-added Tax ID of your organization.)', @configuration_group_id, 44, NOW(), NOW(), NULL, NULL),
('Legal Name', 'FACEBOOK_OPEN_GRAPH_LEG', '', 'The official name of the organization, e.g. the registered company name.)', @configuration_group_id, 45, NOW(), NOW(), NULL, NULL),
('Area Served', 'FACEBOOK_OPEN_GRAPH_AREA', '', 'Optional. The geographical region served by the number, specified as a Schema.org/AdministrativeArea. Countries may be specified concisely using just their standard ISO-3166 two-letter code, as in the examples at right. If omitted, the number is assumed to be global..)', @configuration_group_id, 46, NOW(), NOW(), NULL, NULL),
('Twitter Page', 'FACEBOOK_OPEN_GRAPH_TWIT', '', 'Please enter your full url/link to your twitter page (https://twitter.com/xxx)', @configuration_group_id, 47, NOW(), NOW(), NULL, NULL),
('Linkedin Page', 'FACEBOOK_OPEN_GRAPH_LINK', '', 'Please enter your full url/link to your Linkedin page (http://www.linkedin.com/company/xxx/)', @configuration_group_id, 48, NOW(), NOW(), NULL, NULL),
('Another Profile Page', 'FACEBOOK_OPEN_GRAPH_PROF1', '', 'Please enter your full url/link to your profile page (https://www.dandb.com/businessdirectory/xxx.html)', @configuration_group_id, 49, NOW(), NOW(), NULL, NULL),
('Another Profile Page', 'FACEBOOK_OPEN_GRAPH_PROF2', '', 'Please enter your full url/link to your profile page (http://www.yelp.com/biz/xxx)', @configuration_group_id, 50, NOW(), NOW(), NULL, NULL),
('Shipping to', 'FACEBOOK_OPEN_GRAPH_ELER', '', 'The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is valid. Such as US', @configuration_group_id, 51, NOW(), NOW(), NULL, NULL);

REPLACE INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES 
(@configuration_group_id, 1, 'Facebook / Open Graph / Microdata', 'Settings for Facebook, Open Graph and Microdata Support', @configuration_group_id, 1),
(@configuration_group_id, 43, 'Facebook / Open Graph / Microdata', 'Einstellungen für die Unterstützung von Facebook, Open Graph und Microdata', @configuration_group_id, 1);


### CSS Buttons im Admin ####

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, use_function, set_function, date_added) VALUES
('Use CSS Buttons (Admin)?', 'ADMIN_USE_CSS_BUTTONS', 'true', 'Use CSS buttons instead of GIF images in admin?', 19, 148, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'), ', NOW());


### Neuer Report Deaktivierte Artikel ###

INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('stats_disabled_stock', 'BOX_REPORTS_DISABLED_STOCK', 'FILENAME_STATS_DISABLED_STOCK', '', 'reports', 'Y', 7);

### Adresskorrektur Berechtigung ###

INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('adresskorrekturvornehmen', 'DO_ADRESSKORREKTUR', 'FILENAME_ADRESSKORREKTUR', '', 'customers', 'N', 101);

### make sure that we use the latest translations for German configuration ###

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES

# Adminmenü ID 1 - Mein Shop
('Shopname', 'STORE_NAME', 43, 'Geben Sie hier einen Namen für Ihren Shop ein', now(), now()),
('Shopinhaber', 'STORE_OWNER', 43, 'Geben Sie hier einen Namen des Shopinhabers ein', now(), now()),
('Telefonnummer des Kundenservice', 'STORE_TELEPHONE_CUSTSERVICE', 43, 'Geben Sie hier die Telefonnumer an, unter der Kunden Ihren Kundenservice erreichen können.', now(), now()),
('Land', 'STORE_COUNTRY', 43, 'Geben Sie hier das Land an, in dem der Shop betrieben wird<br /><br /><strong><b>HINWEIS: Bitte nicht vergessen, ggf. das Bundesland des Shops zu aktualisieren</b></strong>', now(), now()),
('Zone/Bundesland', 'STORE_ZONE', 43, 'Geben Sie hier die Zone / das Bundesland an, in dem der Shop betrieben wird', now(), now()),
('Erwartete Artikel: Sortierung', 'EXPECTED_PRODUCTS_SORT', 43, 'Wie sollen die Artikel in der Box "Erwartete Artikel" sortiert werden?<br>ASC = Aufsteigend, DESC=Absteigend', now(), now()),
('Erwartete Artikel: Sortierung', 'EXPECTED_PRODUCTS_FIELD', 43, 'Nach welcher Spalte soll sortiert werden?<br>product_name = Artikelname, date_expected = Erscheinungsdatum', now(), now()),
('Automatisch zur Standardwährung der Sprache wechseln', 'USE_DEFAULT_LANGUAGE_CURRENCY', 43, 'Soll automatisch zu der zur Sprache passenden Währung gewechselt werden?', now(), now()),
('Sprachauswahl', 'LANGUAGE_DEFAULT_SELECTOR', 43, 'Default Sprache wird durch Shop festgelegt oder die Browsereinstellung?<br /><br />Standard: Shop', now(), now()),
('Suchmaschinenfeste (Kurz-)URLs verwenden (noch in der Entwicklung)', 'SEARCH_ENGINE_FRIENDLY_URLS', 43, 'Suchmaschinenfeste URLs (KurzURL) für alle Links im Shop verwenden', now(), now()),
('Warenkorb nach Hinzufügen eines Artikels anzeigen', 'DISPLAY_CART', 43, 'Soll der Warenkorb nach dem Hinzufügen eines Artikels angezeigt werden? (HINWEIS: false= nein, zurück zum Artikel)', now(), now()),
('Standard Suchoperator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 43, 'Standard Suchoperator<br />"AND": Wörter, die vorkommen müssen<br />"OR": Wörter, die vorkommen können<br />"NOT": Wörter, die nicht vorkommen sollen', now(), now()),
('Shopadresse und Telefonnummer', 'STORE_NAME_ADDRESS', 43, 'Diese Adresse wird auf ausdruckbaren Dokumenten und online im Shop angezeigt', now(), now()),
('Zähler hinter Kategorienamen anzeigen', 'SHOW_COUNTS', 43, 'Soll der Zähler, der die Anzahl von Artikel in der jeweiligen Kategorie anzeigt, hinter dem Kategorienamen sichtbar sein?', now(), now()),
('Dezimalstellen bei Steuern', 'TAX_DECIMAL_PLACES', 43, 'Wieviele Dezimalstellen sollen bei den Steuern angezeigt werden?', now(), now()),
('Bruttopreise im Shop verwenden', 'DISPLAY_PRICE_WITH_TAX', 43, 'Sollen die Bruttopreise im Shop angezeigt werden?<br />true= Bruttopreise (inkl. Steuern)<br />false= Nettopreise (exkl. Steuern)', now(), now()),
('Preise inkl. Steuern im Adminbereich anzeigen', 'DISPLAY_PRICE_WITH_TAX_ADMIN', 43, 'Preise inkl. Steuern (true) oder die Steuern am Ende (false) im Adminbereich anzeigen(Rechnungen)', now(), now()),
('Basis der Steuern für Artikel', 'STORE_PRODUCT_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern bei Artikeln berechnet werden? Die Optionen sind:<br />Versand (Shipping) - Berechnung erfolgt auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - Berechnung erfolgt auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - Berechnung erfolgt auf Basis der Shopadresse, wenn die Versand-/Rechnungsadresse innerhalb der Zone / des Bundeslandes des Shops liegt', now(), now()),
('Basis der Steuern für Versand', 'STORE_SHIPPING_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern bei Versandkosten berechnet werden? Die Optionen sind:<br />Versand (Shipping) - Berechnung erfolgt auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - Berechnung erfolgt auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - Berechnung erfolgt auf Basis der Shopadresse, wenn die Versand-/Rechnungsadresse innerhalb der Zone / des Bundeslandes des Shops liegt (kann vom Versandmodul überschrieben werden)', now(), now()),
('Steuern auch bei 0% anzeigen?', 'STORE_TAX_DISPLAY_STATUS', 43, 'Steuer auch dann anzeigen, wenn diese 0% betragen?<br/>0= NEIN<br/>1= JA ', now(), now()),
('Gesplittete Steueranzeige', 'SHOW_SPLIT_TAX_CHECKOUT', 43, 'Wenn Artikel mit verschiedenen Steuersätzen bestellt werden, soll dann im Bestellvorgang jeder Steuersatz in einer eigenen Zeile ausgewiesen werden?', now(), now()),
('Timeout der Admin-Sitzungen (in Sekunden)', 'SESSION_TIMEOUT_ADMIN', 43, 'Geben Sie die Zeit in Sekunden an. Standard=900<br /> Beispiel: 900= 15 Minuten<br /><b>WICHTIGER HINWEIS: Wenn Sie diesen Wert auf über 900 erHöhen, dann erfüllt Ihr Shop die Richtlinien der PA-DSS Zertifizierung nicht mehr!</b><br/><br/>Eine zu geringe Zeitangabe kann zu Problemen bei der Bearbeitung von Artikeln führen.', now(), now()),
('Maximale Zeit für die Ausführung von Prozessen', 'GLOBAL_SET_TIME_LIMIT', 43, 'Geben Sie die Zeit in Sekunden an. Standard=60<br />Beispiel: 60= 1 Minute<br /><br />HINWEIS: Diesen Wert sollte nur geändert werden, wenn es Probleme bei der Ausführung von Prozessen gibt.', now(), now()),
('Auf neue Version von Zen Cart prüfen', 'SHOW_VERSION_UPDATE_IN_HEADER', 43, 'Automatische Überprüfung auf eine neuere Version von Zen Cart bei der Anmeldung im Admin-Bereich. Zeigt dies dann im Header des Admin Bereichs an. Wenn dieses Feature aktiviert ist, kann es manchmal zu GeschwindigkeitseinbuCen im Admin Bereich kommen.', now(), now()),
('Art des Shops', 'STORE_STATUS', 43, 'Welcher Art ist Ihr Shop:<br />0= Normaler Shop<br />1= Showroom ohne Preise<br />2= Showroom mit Preisen<br> Showroom = Artikel werden angezeigt, können aber nicht gekauft werden!', now(), now()),
('Server Onlinestatus anzeigen', 'DISPLAY_SERVER_UPTIME', 43, 'Zeigt die Onlinezeit des Servers an.<br />HINWEIS: Das Aktivieren diese Einstellung kann bei einigen Server Einträge in den Fehlerprotokollen verursachen.  (true = anzeigen, false = nicht anzeigen)', now(), now()),
('Überprüfung auf fehlende Seiten', 'MISSING_PAGE_CHECK', 43, 'Zen Cart kann das Fehlen von Seiten in einer URL erkennen und leitet dann bei Bedarf auf die Startseite weiter.<br />für ein Debugging kann diese Funktion deaktiviert werden. (true = Auf fehlende Seiten prüfen, false = Keine Überprüfung auf fehlende Seiten)', now(), now()),
('cURL Proxy Status', 'CURL_PROXY_REQUIRED', 43, 'Verwenden Sie einen Web-Provider, der für die Kommunikation mit externen Seiten cURL via Proxy verwendet?', now(), now()),
('cURL Proxy Adresse', 'CURL_PROXY_SERVER_DETAILS', 43, 'Wenn Sie einen Provider einsetzen, der cURL verwendet (wie z.B. <em>GoDaddy</em> oder <em>Dreamhost</em>), welcher über einen Proxy via cURL mit externen Seiten kommuniziert, dann geben Sie hier die Adresse des Proxy Servers ein.<br />Format: adresse:port<br />z.B.: für GoDaddy geben Sie folgendes ein: 64.202.165.130:3128', now(), now()),
('HTML Editor', 'HTML_EDITOR_PREFERENCE', 43, 'Welchen HTML Editor wollen Sie zur Bearbeitung von E-Mails, Newslettern und Artikelbeschreibungen im Adminbereich verwenden?', now(), now()),
('phpBB Forumsynchronisierung aktivieren?', 'PHPBB_LINKS_ENABLED', 43, 'Soll Zen Cart neue Kundenkonten mit dem - bereits installierten - phpBB Forum synchronisieren?', now(), now()),
('Kategoriezähler im Adminbereich anzeigen', 'SHOW_COUNTS_ADMIN', 43, 'Soll der Kategoriezähler im Adminbereich angezeigt werden?', now(), now()),
('Multiplikator für Fremdwährungen', 'CURRENCY_UPLIFT_RATIO', 43, 'Wie hoch soll der Faktor für den Aufschlag von Fremdwährungen in Ihrem Shop bei der Aktualisierung der Währungskurse sein?<br /><br />BESCHREIBUNG:<br />Der Umrechnungskurs wird vom externen Wechselkurs-Server während der Abfrage festgestellt und mit Ihrem Shop abgeglichen.<br />Wird als Faktor z.B. der Wert <em>2.00</em> verwendet, werden Fremdwährungen mit diesem Wert multipliziert.<br /><br />BEISPIEL:<br />Die Währung <em>EURO</em> ist als <em>Standard</em> definiert:<br />Kurs: EURO = 1.00000000; USD = 1.40000000<br />Als Faktor wird <em>2.00</em> verwendet.<br />Ergebnis: Euro = 1.00000000; USD = 2.80000000<br /><br /><br />Standard: 1.05', now(), now()),
('EU Länder', 'EU_COUNTRIES_FOR_LAST_STEP', 43, 'Tragen Sie hier die Mitgliedsstaaten der Europäischen Union ein. Wenn an Länder geliefert wird, die nicht in dieser Liste stehen, dann erscheint im letzten Schritt des Bestellvorgangs ein Hinweis auf mögliche ZollGebühren. Zweistellige ISO Codes mit Komma getrennt.<br/><br/>Falls Sie Ihren Shop in der Schweiz betreiben, dann tragen Sie hier nur CH ein, so dass der Hinweis dann bei Lieferungen ausserhalb der Schweiz angezeigt wird!', now(), now()),
('Admin Timeout gemäss PA-DSS Zertifizierung?', 'PADSS_ADMIN_SESSION_TIMEOUT_ENFORCED', 43, 'Der Shop erfüllt nur dann die Richtlinien einer PA-DSS Zertifizierung, wenn die Adminsitzung nach 15 Minuten Inaktivität beendet wird. Nach 15 Minuten Inaktivität werden Sie aus der Administration ausgeloggt. Wenn Sie das nicht wollen, dann deaktivieren Sie hier diese Einstellung.<br/><b>Achtung: Durch das Deaktivieren dieser Einstellung erfüllt Ihr Shop die PA-DSS Richtlinien nicht mehr und ist daher für eine Zertifizierung ungeeignet!</b>', now(), now()),
('Admin Passwortregeln gemäss PA-DSS Zertifizierung?', 'PADSS_PWD_EXPIRY_ENFORCED', 43, 'Der Shop erfüllt nur dann die Richtlinien einer PA-DSS Zertifizierung, wenn die AdminpassWörter alle 90 Tage geändert werden und dabei nicht die 4 letzten PassWörter wiederverwendet werden dürfen. Wenn Sie das nicht wollen, dann deaktivieren Sie hier diese Einstellung.<br/><b>Achtung: Durch das Deaktivieren dieser Einstellung erfüllt Ihr Shop die PA-DSS Richtlinien nicht mehr und ist daher für eine Zertifizierung ungeeignet!</b>', now(), now()),
('Verlinkte Kategorien im Adminbereich anzeigen', 'SHOW_CATEGORY_PRODUCTS_LINKED_STATUS', 43, 'Soll im Adminbereich angezeigt werden, wenn Artikel auch in anderen Kategorien verlinkt sind (gelbes Symbol neben dem Artikel)?', now(), now()),
('PA-DSS Ajax Checkout?', 'PADSS_AJAX_CHECKOUT', 43, 'PA-DSS Compliance erfordert, dass für manche integrierte Zahlungsmodule Ajax zum Laden der Bestellbestätigungsseite verwendet wird. Das wird zwar nur geschehen, falls solche speziellen Zahlungsmodule verwendet werden, dennoch bevorzugen Sie vielleicht den traditionellen Checkout. <strong>Wenn Die diese Einstellung deaktivieren, dann erfüllt Ihr Shop nicht mehr die PA-DSS Vorgaben.</strong>', now(), now()),
('Aktualisierung der Wechselkurse: Primäre Quelle', 'CURRENCY_SERVER_PRIMARY', 43, 'Von welchem Server sollen die Kurse für das Update der Währungen bezogen werden? (Primäre Quelle)<br><br>Weitere Quellen können durch Plugins hinzugefügt werden.', now(), now()),
('Aktualisierung der Wechselkurse: Sekundäre Quelle', 'CURRENCY_SERVER_BACKUP', 43, 'Von welchem Server sollen die Kurse für das Update der Währungen bezogen werden? (Sekundäre Quelle falls erster Server nicht erreichbar)<br><br>Weitere Quellen können durch Plugins hinzugefügt werden.', now(), now()),


# Adminmenü ID 2
('Vorname', 'ENTRY_FIRST_NAME_MIN_LENGTH', 43, 'Minimale Zeichenlänge für den Vornamen', now(), now()),
('Nachname', 'ENTRY_LAST_NAME_MIN_LENGTH', 43, 'Minimale Zeichenlänge für den Nachnamen', now(), now()),
('Geburtsdatum', 'ENTRY_DOB_MIN_LENGTH', 43, 'Minimale Zeichenlänge für das Geburtsdatum', now(), now()),
('E-Mail Adresse', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', 43, 'Minimale Zeichenlänge für die E-Mail Adresse', now(), now()),
('Strasse', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', 43, 'Minimale Zeichenlänge für die Strasse', now(), now()),
('Firma', 'ENTRY_COMPANY_MIN_LENGTH', 43, 'Minimale Zeichenlänge der Firma', now(), now()),
('Postleitzahl', 'ENTRY_POSTCODE_MIN_LENGTH', 43, 'Minimale Zeichenlänge der Postleitzahl', now(), now()),
('Stadt', 'ENTRY_CITY_MIN_LENGTH', 43, 'Minimale Zeichenlänge der Stadt', now(), now()),
('Bundesland', 'ENTRY_STATE_MIN_LENGTH', 43, 'Minimale Zeichenlänge für das Bundesland', now(), now()),
('Telefonnummer', 'ENTRY_TELEPHONE_MIN_LENGTH', 43, 'Minimale Zeichenlänge für die Telefonnummer', now(), now()),
('Passwort', 'ENTRY_PASSWORD_MIN_LENGTH', 43, 'Minimale Zeichenlänge für das Passwort', now(), now()),
('Kreditkarteninhaber', 'CC_OWNER_MIN_LENGTH', 43, 'Minimale Zeichenlänge für den Namen des Kreditkarteninhabers', now(), now()),
('Kreditkartennummer', 'CC_NUMBER_MIN_LENGTH', 43, 'Minimale Zeichenlänge für die Kreditkartennummer', now(), now()),
('Kreditkarten Prüfziffer (CVV)', 'CC_CVV_MIN_LENGTH', 43, 'Minimale Zeichenlänge für den Kreditkarten Prüfziffer (CVV)', now(), now()),
('Zeichenlänge für Bewertungstexte', 'REVIEW_TEXT_MIN_LENGTH', 43, 'Minimale Zeichenlänge für den Text einer Bewertung', now(), now()),
('Bestseller', 'MIN_DISPLAY_BESTSELLERS', 43, 'Wieviele Bestseller/Top Artikel sollen mindestens angezeigt werden?', now(), now()),
('Empfohlene Artikel', 'MIN_DISPLAY_ALSO_PURCHASED', 43, 'Minimale Anzahl der anzuzeigenden Artikel in der Box Empfohlene Artikel', now(), now()),
('Nickname', 'ENTRY_NICK_MIN_LENGTH', 43, 'Minimale Zeichenlänge für Nicknamen', now(), now()),

# Adminmenü ID 3
('Adresseinträge im Adressbuch', 'MAX_ADDRESS_BOOK_ENTRIES', 43, 'Wieviele Adresseinträge dürfen Kunden in Ihrem Adressbuch haben?', now(), now()),
('Suchresultate pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS', 43, 'Wieviele Artikel sollen maximal in den Suchresultaten pro Seite angezeigt werden?', now(), now()),
('"Vorherige - Nächste" Navigation: Seitenlinks (Desktop)', 'MAX_DISPLAY_PAGE_LINKS', 43, 'Anzahl der Seitenlinks in der "Vorherige - Nächste" Navigation', now(), now()),
('"Vorherige - Nächste" Navigation: Seitenlinks (Mobil)', 'MAX_DISPLAY_PAGE_LINKS_MOBILE', 43, 'Anzahl der Seitenlinks in der "Vorherige - Nächste" Navigation auf Mobilgeräten (voruasgesetzt Ihr Template unterstützt spezielle Einstellungen für Mobilgeräte)', now(), now()),
('Anzuzeigende "Sonderangebote"', 'MAX_DISPLAY_SPECIAL_PRODUCTS', 43, 'Wieviele Sonderangebote sollen angezeigt werden?', now(), now()),
('Anzuzeigende "Neue Artikel"', 'MAX_DISPLAY_NEW_PRODUCTS', 43, 'Wieviele "Neue Artikel" sollen in den Kategorien angezeigt werden?', now(), now()),
('Anzuzeigende "Erwartete Artikel"', 'MAX_DISPLAY_UPCOMING_PRODUCTS', 43, 'Wieviele "erwartete Artikel" sollen angezeigt werden?', now(), now()),
('Hersteller - Listenfeld Grösse/Stil', 'MAX_MANUFACTURERS_LIST', 43, 'Anzahl der Hersteller, die im Listenfeld angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird eine Dropdown Liste angezeigt.', now(), now()),
('Hersteller Liste - Produktüberprüfung', 'PRODUCTS_MANUFACTURERS_STATUS', 43, 'Hersteller wird nur dann in der Liste angezeigt wenn mindestens 1 Produkt von Ihm Verfügbar ist.<br/>0=AUS<br/>1=EIN<br/>Anmerkung: Ein Aktivieren dieser Einstellung kann bei Shops mit vielen Artikeln zu Performance-EinbuCen führen.', now(), now()),
('Musik Genre - Listenfeld Grösse/Stil', 'MAX_MUSIC_GENRES_LIST', 43, 'Anzahl der Musik Genres, die im Listenfeld angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird eine Dropdown Liste angezeigt.', now(), now()),
('Plattenfirma - Listenfeld Grösse/Stil', 'MAX_RECORD_COMPANY_LIST', 43, 'Anzahl der Plattenfirmen, die im Listenfeld angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird eine Dropdown Liste angezeigt.', now(), now()),
('Länge der Namen von Plattenfirmen', 'MAX_DISPLAY_RECORD_COMPANY_NAME_LEN', 43, 'Wird in der Box "Plattenfirma" verwendet; Maximale Länge der anzuzeigenden Namen von Plattenfirmen. Längere Namen werden abgeschnitten.', now(), now()),
('Länge der Namen von Musik Genres', 'MAX_DISPLAY_MUSIC_GENRES_NAME_LEN', 43, 'Wird in der Box "Musik Genre" verwendet; Maximale Länge der anzuzeigenden Namen von Musik Genres. Längere Namen werden abgeschnitten.', now(), now()),
('Länge der Namen von Herstellern', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', 43, 'Wird in der Box "Hersteller" verwendet; Maximale Länge der anzuzeigenden Namen von Herstellern. Längere Namen werden abgeschnitten.', now(), now()),
('Neue Artikelbewertungen pro Seite', 'MAX_DISPLAY_NEW_REVIEWS', 43, 'Anzahl der Bewertungen auf jeder Seite', now(), now()),
('Box "Bewertungen": zufällige Artikel', 'MAX_RANDOM_SELECT_REVIEWS', 43, 'Wieviele Bewertungen sollen zufällig ausgewählt werden?<br/> Unabhängig davon wird immer nur EINE in der Box "Bewertungen" angezeigt.', now(), now()),
('Box "Neue Artikel": zufällige Artikel', 'MAX_RANDOM_SELECT_NEW', 43, 'Wieviele neue Artikel sollen in der Box "Neue Artikel" zufällig angezeigt werden?', now(), now()),
('Box "Sonderangebot": zufällige Artikel', 'MAX_RANDOM_SELECT_SPECIALS', 43, 'Wieviele Sonderangebote sollen in der Box "Sonderangebote" zufällig angezeigt werden?', now(), now()),
('Kategorien pro Reihe', 'MAX_DISPLAY_CATEGORIES_PER_ROW', 43, 'Wieviele Kategorien sollen pro Reihe angezeigt werden?', now(), now()),
('Liste "Neue Artikel": Artikel pro Seite', 'MAX_DISPLAY_PRODUCTS_NEW', 43, 'Wieviele Artikel sollen pro Seite in der Liste "Neue Artikel" angezeigt werden?', now(), now()),
('Box "Bestseller": Anzahl der Artikel', 'MAX_DISPLAY_BESTSELLERS', 43, 'Wieviele Bestseller sollen in der Box angezeigt werden?', now(), now()),
('Box "Empfohlene Artikel": Anzahl der Artikel', 'MAX_DISPLAY_ALSO_PURCHASED', 43, 'Wieviele Artikel sollen in der Box "Empfohlene Artikel angezeigt werden?', now(), now()),
('Box "Kürzlich bestellte Artikel" HINWEIS: Diese Box ist deaktiviert', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', 43, 'Wieviele Artikel sollen in der Box "Kürzlich bestellte Artikel" angezeigt werden?', now(), now()),
('Mein Konto: Anzahl Bestellungen pro Seite der Bestellhistorie', 'MAX_DISPLAY_ORDER_HISTORY', 43, 'Wieviele Bestellungen sollen pro Seite der Bestellhistorie in "Mein Konto" angezeigt werden?', now(), now()),
('Kunden pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER', 43, 'Wieviele Kunden sollen pro Seite im Adminbereich --> Kunden --> Kunden angezeigt werden?', now(), now()),
('Bestellungen pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_ORDERS', 43, 'Wieviele Bestellungen sollen pro Seite im Adminbereich unter --> Kunden --> Bestellungen angezeigt werden?', now(), now()),
('Artikel in Berichten pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_REPORTS', 43, 'Wieviele Artikel sollen Berichten/Statistiken (Adminbereich) pro Seite angezeigt werden?', now(), now()),
('Artikel in Kategorien pro Seite', 'MAX_DISPLAY_RESULTS_CATEGORIES', 43, 'Wieviele Artikel sollen im Adminbereich --> Artikel & Kategorien in den jeweiligen Kategorien pro Seite angezeigt werden?', now(), now()),
('Artikelliste: Anzahl der Artikel', 'MAX_DISPLAY_PRODUCTS_LISTING', 43, 'Wieviele Artikel in der Artikelliste der jeweiligen Kategorie im Shop angezeigt werden?', now(), now()),
('Artikelattribute: Ansicht Attributnamen und -werte', 'MAX_ROW_LISTS_OPTIONS', 43, 'Wieviele Attributnamen und -werte sollen auf der Seite der Artikelattribute maximal angezeigt werden?', now(), now()),
('Artikelattribute: Ansicht Attributmanager', 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER', 43, 'Wieviele Attribute sollen auf der Seite des Attributmanagers maximal angezeigt werden?', now(), now()),
('Artikelattribute - Downloadmanager', 'MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER', 43, 'Wieviele Downloadattribute sollen pro Seite im Downloadmanager angezeigt werden?', now(), now()),
('Empfohlene Artikel im Adminbereich', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN', 43, 'Anzahl empfohlener Artikel pro Seite im Adminbereich', now(), now()),
('Empfohlene Artikel auf der Startseite', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED', 43, 'Anzahl empfohlener Artikel auf der Startseite', now(), now()),
('Liste "Empfohlene Artikel": Artikel pro Seite', 'MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS', 43, 'Wieviele Artikel sollen pro Seite in der Liste "Empfohlene Artikel" angezeigt werden?', now(), now()),
('Box "Empfohlene Artikel": Anzahl der Artikel', 'MAX_RANDOM_SELECT_FEATURED_PRODUCTS', 43, 'Anzahl der zufällig angezeigten empfohlenen Artikel in der Box "Empfohlene Artikel"', now(), now()),
('Sonderangebote auf der Startseite', 'MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX', 43, 'Wieviele Sonderangebote sollen auf der Startseite angezeigt werden?', now(), now()),
('Liste "Neue Artikel" - Limitieren auf...', 'SHOW_NEW_PRODUCTS_LIMIT', 43, 'Limitiert die Liste der neuen Artikel auf<br />0= Alle absteigend<br />1= Aktueller Monat<br />30= Die letzten 30 Tage<br />60= Die letzten 60 Tage<br />90= Die letzten 90 Tage<br />120= Die letzten 120 Tage', now(), now()),
('Liste "Alle Artikel": Artikel pro Seite', 'MAX_DISPLAY_PRODUCTS_ALL', 43, 'Wieviele Artikel sollen pro Seite in dieser Liste angezeigt werden?', now(), now()),
('Box "Sprachen": Landesflaggen pro Zeile', 'MAX_LANGUAGE_FLAGS_COLUMNS', 43, 'Wieviele Landesflaggen sollen maximal pro Zeile angezeigt werden?', now(), now()),
('Grösse für Datei-Upload', 'MAX_FILE_UPLOAD_SIZE', 43, 'Wie lautet die maximale Grösse einer Datei, die hochgeladen werden kann?<br />Standard= 2048000 (2MB)', now(), now()),
('Erlaubte Dateierweiterungen für Datei-Upload', 'UPLOAD_FILENAME_EXTENSIONS', 43, 'Durch Komma getrennte Liste von Dateierweiterungen (ohne Punkt) welche für einen Datei-Upload zulässig sind. z.B. jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip', now(), now()),
('Max. Anzahl Bestellpositionen / Auftrag (Liste im Adminbereich)', 'MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING', 43, 'Max. Anzahl Bestellpositionen / Auftrag (Liste im Adminbereich)<br/>0= unbegrenzt', now(), now()),
('Max. Anzahl PayPal IPN Transaktionen pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN', 43, 'Max. Anzahl PayPal IPN Transaktionen pro Seite<br />Standard: 20', now(), now()),
('Max. Spaltenanzahl - Artikel zu Kategorien-Manager', 'MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS', 43, 'Max. Spaltenanzahl - Artikel zu Kategorien-Manager<br/>3= default', now(), now()),
('Max. Anzahl EZ-Pages', 'MAX_DISPLAY_SEARCH_RESULTS_EZPAGE', 43, 'Maximale Anzahl EZ-Pages<br />20 = Default', now(), now()),

# Adminmenü ID 4
('Kleine Bilder: Breite', 'SMALL_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der kleinen Bilder', now(), now()),
('Kleine Bilder: Höhe', 'SMALL_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der kleinen Bilder', now(), now()),
('Überschriftsbild im Adminbereich: Breite', 'HEADING_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Bilder in der Überschrift im Adminbereich<br>HINWEIS: Momentan regelt dieser Wert nur die Abstände zwischen den Einträgen im Adminbereich. Er kann aber auch dazu benutzt werden, eigene Überschriftsbilder im Adminbereich hinzuzufügen', now(), now()),
('Überschriftsbild im Adminbereich: Höhe', 'HEADING_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der Bilder in der Überschrift im Adminbereich<br>HINWEIS: Momentan regelt dieser Wert nur die Abstände zwischen den Einträgen im Adminbereich. Er kann aber auch dazu benutzt werden, eigene Überschriftsbilder im Adminbereich hinzuzufügen', now(), now()),
('Unterkategorien: Breite der Bilder', 'SUBCATEGORY_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Bilder für die Unterkategorien', now(), now()),
('Unterkategorien: Höhe der Bilder', 'SUBCATEGORY_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der Bilder für die Unterkategorien', now(), now()),
('BildGrösse berechnen', 'CONFIG_CALCULATE_IMAGE_SIZE', 43, 'Soll die Grösse der Bilder berechnet werden?', now(), now()),
('Platzhalter für fehlende Bilder anzeigen', 'IMAGE_REQUIRED', 43, 'Sollen fehlende Bilder "angezeigt" werden? (Hilfreich in der Entwicklungsphase)', now(), now()),
('Warenkorb: Artikelbilder anzeigen', 'IMAGE_SHOPPING_CART_STATUS', 43, 'Sollen Artikelbilder im Warenkorb angezeigt werden?<br />0= nein<br />1= ja', now(), now()),
('Warenkorb: Breite der Artikelbilder', 'IMAGE_SHOPPING_CART_WIDTH', 43, 'Standard = 50', now(), now()),
('Warenkorb: Höhe der Artikelbilder', 'IMAGE_SHOPPING_CART_HEIGHT', 43, 'Standard = 40', now(), now()),
('Kategorie: Bildbreite - Artikeldetails', 'CATEGORY_ICON_IMAGE_WIDTH', 43, 'Breite in Pixel für das Kategoriebild auf der Artikeldetailseite', now(), now()),
('Kategorie: BildHöhe - Artikeldetails', 'CATEGORY_ICON_IMAGE_HEIGHT', 43, 'Höhe in Pixel für das Kategoriebild auf der Artikeldetailseite', now(), now()),
('Bild Kategorie mit Unterkategorien: Bildbreite', 'SUBCATEGORY_IMAGE_TOP_WIDTH', 43, 'Die Breite in Pixel<br />Dieses Bild wird beim Klicken auf eine Kategorie oben angezeigt, wenn diese Unterkategorien enthält', now(), now()),
('Bild Kategorie mit Unterkategorien: BildHöhe', 'SUBCATEGORY_IMAGE_TOP_HEIGHT', 43, 'Die Höhe in Pixel<br />Dieses Bild wird beim Klicken auf eine Kategorie oben angezeigt, wenn diese Unterkategorien enthält', now(), now()),
('Artikelbeschreibung: Breite der Artikelbilder', 'MEDIUM_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Artikelbilder in der Produktbeschreibung', now(), now()),
('Artikelbeschreibung: Höhe der Artikelbilder', 'MEDIUM_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der Artikelbilder in der Produktbeschreibung', now(), now()),
('Artikelbeschreibung: Suffix der Bildmedien', 'IMAGE_SUFFIX_MEDIUM', 43, 'Dateizusatz für Bildmedien der zusätzlichen Bilder in der Artikelbeschreibung<br />Standard = _MED', now(), now()),
('Artikelbeschreibung: Suffix der Bildmedien für Grössere Bilder', 'IMAGE_SUFFIX_LARGE', 43, 'Dateizusatz für Bildmedien der grösseren Bilder in der Artikelbeschreibung<br />Standard = _LRG', now(), now()),
('Artikelbeschreibung: Anzahl der zusätzlichen Bilder pro Reihe', 'IMAGES_AUTO_ADDED', 43, 'Tragen Sie hier die Anzahl der pro Reihe anzuzeigenden zusätzlichen Bilder ein<br />Standard = 3', now(), now()),
('Artikelliste: Höhe der Artikelbilder', 'IMAGE_PRODUCT_LISTING_HEIGHT', 43, 'Standard = 80', now(), now()),
('Artikelliste: Breite der Artikelbilder', 'IMAGE_PRODUCT_LISTING_WIDTH', 43, 'Standard = 100', now(), now()),
('Liste "Neue Artikel": Breite der Artikelbilder in der Liste', 'IMAGE_PRODUCT_NEW_LISTING_WIDTH', 43, 'Standard = 100', now(), now()),
('Liste "Neue Artikel": Höhe der Artikelbilder in der Liste', 'IMAGE_PRODUCT_NEW_LISTING_HEIGHT', 43, 'Standard = 80', now(), now()),
('Neue Artikel: Breite der Artikelbilder', 'IMAGE_PRODUCT_NEW_WIDTH', 43, 'Standard = 100', now(), now()),
('Neue Artikel: Höhe der Artikelbilder', 'IMAGE_PRODUCT_NEW_HEIGHT', 43, 'Standard = 80', now(), now()),
('Liste "Empfohlene Artikel": Breite der Artikelbilder', 'IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH', 43, 'Standard = 100', now(), now()),
('Liste "Empfohlene Artikel": Höhe der Artikelbilder', 'IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT', 43, 'Standard = 80', now(), now()),
('Liste "Alle Artikel": Breite der Artikelbilder', 'IMAGE_PRODUCT_ALL_LISTING_WIDTH', 43, 'Standard = 100', now(), now()),
('Liste "Alle Artikel": Höhe der Artikelbilder', 'IMAGE_PRODUCT_ALL_LISTING_HEIGHT', 43, 'Standard = 80', now(), now()),
('Artikelbild: Status automatisch auf "kein Bild vorhanden"', 'PRODUCTS_IMAGE_NO_IMAGE_STATUS', 43, 'Soll der Status bei Artikelbildern automatisch auf "kein Bild vorhanden" gesetzt werden, wenn kein Bild dem Artikel hinzugefügt wurde? <br />0= nein<br />1= ja', now(), now()),
('Artikelbild: "Kein Bild vorhanden" Bild', 'PRODUCTS_IMAGE_NO_IMAGE', 43, 'Welches Bild soll als Eratzbild verwendet werden, wenn kein Bild dem Artikel hinzugefügt wurde?<br />Standard = no_picture.gif', now(), now()),
('Proportionale Bilder für Artikel & Kategorien verwenden', 'PROPORTIONAL_IMAGES_STATUS', 43, 'Artikel und Kategoriebilder werden proportional verkleinert, falls die vorgegebenen Werte für Höhe / Breite überschritten werden. Anmerkung: Nicht verwenden wenn für Höhe  bzw. Breite 0 verwendet wird.', now(), now()),
# Image Handler new since 1.5.3
('IH - Bildgrösse ändern und Caching verwenden', 'IH_RESIZE', 43, 'Entweder ''No'' für normales Zen-Cart Verhalten oder ''Yes'' um die automatische grössenänderung und das Caching von Bildern zu aktivieren. Wenn Sie ImageMagick verwenden wollen, müssen Sie den Pfad zur convert binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em> angeben.', now(), now()),
('IH - Kleine Bilder - Dateityp', 'SMALL_IMAGE_FILETYPE', 43, 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Internet Explorer hat noch immer Probleme transparente png darzustellen. Nehmen Sie besser ''gif'' für die Transparenz oder ''jpg'' für Grössere Bilder. ''no_change'' bedeutet normales Zen-Cart Verhalten. Es wird derselbe Dateityp für kleine Bilder wie für hochgeladene Bilder verwendet.', now(), now()),
('IH - Kleine Bilder - Hintergrund', 'SMALL_IMAGE_BACKGROUND', 43, 'Falls ein hochgeladenes Bild mit transparenten Bereichen konvertiert wurde, erhalten die transparenten Bereiche diese Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now()),
('IH - Kleine Bilder - Qualität', 'SMALL_IMAGE_QUALITY', 43, 'Geben Sie die gewünschte Qualität für die kleinen jpg Bilder an. Dezimalwerte von 0 bis 100. Je Höher desto bessere Qualität und desto Höhere DateigröCFCB8e. Voreingestellt ist 85.', now(), now()),
('IH - Kleine Bilder - Wasserzeichen', 'WATERMARK_SMALL_IMAGES', 43, 'Stellen Sie auf ''yes'', wenn Sie mit Wasserzeichen versehene kleine Bilder anzeigen wollen.', now(), now()),
('IH - Kleine Bilder - Zoom', 'ZOOM_SMALL_IMAGES', 43, 'Stellen Sie auf ''yes'', falls Sie den Zoom-Effekt bei Mouseover für die kleinen Bilder aktivieren wollen.', now(), now()),
('IH - Kleine Bilder - Bildgrösse bei Hover', 'ZOOM_IMAGE_SIZE', 43, 'Stellen Sie auf Medium wenn Sie beim Hover die grösse der mittleren Bilder haben wollen und auf Large, wenn Sie die Grösse der grossen Bilder verwenden wollen.', now(), now()),
('IH - Mittlere Bilder - Dateityp', 'MEDIUM_IMAGE_FILETYPE', 43, 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser ''gif'' oder ''jpg'' für grosse Bilder. ''no_change'' bedeutet normales Zen-Cart-Verhalten und für die mittleren Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.', now(), now()),
('IH - Mittlere Bilder - Hintergrund', 'MEDIUM_IMAGE_BACKGROUND', 43, 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now()),
('IH - Mittlere Bilder - Qualität', 'MEDIUM_IMAGE_QUALITY', 43, 'Geben Sie die gewünschte Qualität für die kleinen jpg Bilder an. Dezimalwerte von 0 bis 100. Je Höher desto bessere Qualität und desto Höhere Dateigrösse. Voreingestellt ist 85.', now(), now()),
('IH - Mittlere Bilder - Wasserzeichen', 'WATERMARK_MEDIUM_IMAGES', 43, 'Stellen Sie auf ''yes'', wenn Sie mittlere Bilder mit Wasserzeichen versehen anzeigen lassen wollen.', now(), now()),
('IH - Grosse Bilder - Dateityp', 'LARGE_IMAGE_FILETYPE', 43, 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser ''gif'' oder ''jpg'' für grosse Bilder. ''no_change'' bedeutet normales Zen-Cart-Verhalten und für die grossen Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.', now(), now()),
('IH - Grosse Bilder - Hintergrund', 'LARGE_IMAGE_BACKGROUND', 43, 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now()),
('IH - Grosse Bilder - Qualität', 'LARGE_IMAGE_QUALITY', 43, 'Geben Sie die gewünschte Bildqualität für grosse jpg Bilder an. Verwenden Sie Zehnerschritte von 0 bis 100. Höhere Werte bedeuten mehr Qualität und mehr Dateigrösse und damit Speicherplatz. Voreingestellt ist 85, was ein guter Wert ist, ausser Sie haben besondere Wünsche.', now(), now()),
('IH - Grosse Bilder - Wasserzeichen', 'WATERMARK_LARGE_IMAGES', 43, 'Stellen Sie auf ''yes'', wenn Sie grosse Bilder mit Wasserzeichen versehen anzeigen wollen.', now(), now()),
('IH - Grosse Bilder - Maximale Breite', 'LARGE_IMAGE_MAX_WIDTH', 43, 'Geben Sie eine maximale Breite für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer grösse nicht verändert.', now(), now()),
('IH - Wasserzeichen - Position', 'WATERMARK_GRAVITY', 43, 'Wählen Sie die Position für das Wasserzeichen. Voreingestellt ist <strong>Center (Zentriert)</strong>.', now(), now()),
('IH - Grosse Bilder - Maximale Höhe', 'LARGE_IMAGE_MAX_HEIGHT', 43, 'Geben Sie eine maximale Höhe für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer grösse nicht verändert.', now(), now()),

# Adminmenü ID 5
('Anrede', 'ACCOUNT_GENDER', 43, 'Auswahl der Anrede <br /> Diese wird bei Erstellung des Kundenkontos abgefragt und dann in allen E-Mails benutzt.<br /><br />Wenn diese Option auf FALSE gestellt wird, wird der Kunde stets mit Hallo VORNAME angesprochen.', now(), now()),
('Geburtsdatum', 'ACCOUNT_DOB', 43, 'Soll das Feld "Geburtsdatum" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Firma', 'ACCOUNT_COMPANY', 43, 'Soll das Feld "Firma" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Adresszeile 2', 'ACCOUNT_SUBURB', 43, 'Soll das Feld "Adresszeile 2" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Bundesland', 'ACCOUNT_STATE', 43, 'Soll das Feld "Bundesland" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Bundesländerliste - als Pulldownmenü anzeigen?', 'ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN', 43, 'Soll die Eingabe des Bundeslandes durch eine Auswahlliste dargestellt werden?', now(), now()),
('Kontoerstellung: Standard - Land', 'SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY', 43, 'Dieses Land als Standard in der Kontoerstellung anzeigen:<br />', now(), now()),
('Faxnummer', 'ACCOUNT_FAX_NUMBER', 43, 'Soll das Feld "Faxnummer" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Checkbox für Newsletter anzeigen', 'ACCOUNT_NEWSLETTER_STATUS', 43, 'Soll die Checkbox für Newsletter angezeigt werden?<br />0= nein<br />1= unmarkiert anzeigen<br />2= markiert anzeigen<br /><strong>HINWEIS: In einigen Ländern steht die Standardanzeige auf "markiert" im Konflikt mit den gesetzlichen Bestimmungen</strong>', now(), now()),
('E-Mail an Kunden im HTML Format senden', 'ACCOUNT_EMAIL_PREFERENCE', 43, 'Standard Einstellung für E-Mails an Kunden<br/>0=Text<br/>1=HTML', now(), now()),
('Artikelbenachrichtigung nach Bestellung abfragen', 'CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS', 43, 'Sollen Kunden nach ihrer Bestellung über Artikelbenachrichtigungen gefragt werden?<br />0= nie nachfragen<br />1= Immer nachfragen, auCer wenn die Abfrage Global gesetzt wurde<br /><br />HINWEIS: Die Sidebox muss separat ausgeschaltet werden', now(), now()),
('Kunden Shopstatus - Ansicht Shop und Preise', 'CUSTOMERS_APPROVAL', 43, 'benötigen Kunden eine Berechtigung, um im Shop einkaufen zu können?<br />0= Nein - normaler Shop<br />1= Artikelansicht erst nach Anmeldung<br />2= Artikelansicht ohne Preise, Preise werden erst nach Anmeldung sichtbar<br />3= Nur Showroom (Generell keine Preise sichtbar)<br /><br />Die Option 2 ist empfohlen, wenn Kunden Preise erst nach Anmeldung sehen sollen, aber der Zugriff für Webcrawler zugelassen werden soll.', now(), now()),
('Kunden Freigabestatus -  auf Freigabe warten', 'CUSTOMERS_APPROVAL_AUTHORIZATION', 43, 'benötigen Kunden eine gesonderte Freigabe, um im Shop einkaufen zu können?<br />0= Nein (normaler Shop)<br />1= Artikelansicht erst nach Freigabe<br />2= Artikelansicht ohne Preise, Preise werden erst nach Freigabe sichtbar<br />3= Artikelansicht mit Preise, einkaufen erst nach Freigabe<br /><br />Die Option 2 oder 3 ist empfohlen, wenn der Zugriff für Webcrawler zugelassen werden soll.', now(), now()),
('Kunden Autorisierung: Dateiname', 'CUSTOMERS_AUTHORIZATION_FILENAME', 43, 'Der Dateinamen der Kunden Autorisierung<br />HINWEIS: Angabe bitte OHNE Dateierweiterung<br />Standard=customers_authorization', now(), now()),
('Kunden Autorisierung: Überschrift ausblenden', 'CUSTOMERS_AUTHORIZATION_HEADER_OFF', 43, 'Kunden Autorisierung: Überschrift ausblenden <br />(true= ausblenden<br />false= anzeigen)', now(), now()),
('Kunden Autorisierung: linke Spalte ausblenden', 'CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF', 43, 'Kunden Autorisierung: linke Spalte ausblenden <br />(true= ausblenden<br />false= anzeigen)', now(), now()),
('Kunden Autorisierung: rechte Spalte ausblenden', 'CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF', 43, 'Kunden Autorisierung: rechte Spalte ausblenden <br />(true= ausblenden<br />false= anzeigen)', now(), now()),
('Kunden Autorisierung: Fusszeile ausblenden', 'CUSTOMERS_AUTHORIZATION_FOOTER_OFF', 43, 'Kunden Autorisierung: Fusszeile ausblenden<br />(true= ausblenden<br />false= anzeigen)', now(), now()),
('Kunden Autorisierung: Preise ausblenden', 'CUSTOMERS_AUTHORIZATION_PRICES_OFF', 43, 'Kunden Autorisierung: Preise ausblenden <br />(true= ausblenden<br />false= anzeigen)', now(), now()),
('Kundenempfehlung', 'CUSTOMERS_REFERRAL_STATUS', 43, 'Kunden Referer - Status<br /><br />0= AUS - Kundenempfehlung deaktiviert<br />1= Durch die erste Verwendung eines Aktionskupons<br />2= Kunde kann während der Erstellung des Kundenkontos die Empfehlung eintragen, falls diese leer ist<br /><br />HINWEIS: Wurde die Kundenempfehlung einmal erstellt, kann diese nur noch im Adminbereich geändert werden', now(), now()),

# Adminmenü ID 6 - Wird nicht im Adminbereich angezeigt, dient meist für die Module
('Installierte Zahlungsmodule', 'MODULE_PAYMENT_INSTALLED', 43, 'Eine Liste der installierten Zahlungsmodule, durch Semikolon getrennt. Die Liste wird automatisch aktualisiert und muss nicht editiert werden. (Beispiel: cc.php;cod.php;paypal.php)', now(), now()),
('Installierte Bestellmodule', 'MODULE_ORDER_TOTAL_INSTALLED', 43, 'Eine Liste der installierten Bestellmodule, durch Semikolon getrennt. Die Liste wird automatisch aktualisiert und muss nicht editiert werden. (Beispiel: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', now(), now()),
('Installierte Versandmodule', 'MODULE_SHIPPING_INSTALLED', 43, 'Eine Liste der installierten Versandmodule, durch Semikolon getrennt. Die Liste wird automatisch aktualisiert und muss nicht editiert werden. (Beispiel: ups.php;flat.php;item.php)', now(), now()),
('Versandkostenfreie Lieferung aktivieren', 'MODULE_SHIPPING_FREESHIPPER_STATUS', 43, 'Bieten Sie einen versandkostenfreien Versand an?', now(), now()),
('Versandkosten', 'MODULE_SHIPPING_FREESHIPPER_COST', 43, 'Welche Versandkosten fallen an?', now(), now()),
('BearbeitungsGebühr', 'MODULE_SHIPPING_FREESHIPPER_HANDLING', 43, 'BearbeitungsGebühr für diese Versandart:', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', 43, 'Welche Steuerklasse soll bei dieser Versandart angewendet werden?', now(), now()),
('Versandzone', 'MODULE_SHIPPING_FREESHIPPER_ZONE', 43, 'für welche Länder soll diese Versandart angeboten werden?<br/>Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now(), now()),
('Sortierung', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Versandarten.', now(), now()),
('Selbstabholung aktivieren', 'MODULE_SHIPPING_STOREPICKUP_STATUS', 43, 'Bieten Sie eine Selbstabholung an?', now(), now()),
('Orte für die Abholung', 'MODULE_SHIPPING_STOREPICKUP_LOCATIONS_LIST', 43, 'Hier können Sie verschiedene Orte für die Selbstabholung eintragen. Trennen Sie die Orte mit einem Strichpunkt (Semikolon).<br/>Optional können Sie je nach Abholort auch eine Gebühr verrechnen. Wird keine spezielle Gebühr definiert, dann gelten die normalen Kosten aus der näcjsten Einstellung.<br/><br/>Hier einige Beispiele:<br/><br/>Demogasse 17 - 1010 Wien;Beispielweg 15 - 8020 Graz<br/>Demogasse 17 - 1010 Wien,4.00;Beispielweg 15 - 8020 Graz,5.00<br/>Demogasse 17 - 1010 Wien,4.00;Beispielweg 15 - 8020 Graz,0.00<br/><br/>Wenn Sie in Ihrem Shop mehrere Sprachen aktiv haben und diese Ortsangaben je nach Sprache anders angeben wollen, dann beachten Sie bitte die Hinweise in der entsprechenden Sprachdatei (z.B. includes/languages/german/modules/shipping/storepickup.php)<br/>', now(), now()),
('Versandkosten', 'MODULE_SHIPPING_STOREPICKUP_COST', 43, 'Welche Versandkosten fallen an?', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_STOREPICKUP_TAX_CLASS', 43, 'Welche Steuerklasse soll bei dieser Versandart angewendet werden?', now(), now()),
('Basis der Steuern', 'MODULE_SHIPPING_STOREPICKUP_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern berechnet werden? Mögliche Optionen:<br />Versand (Shipping) - auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - auf Basis der Shopadresse, wenn die Rechnungs-/Versandadresse des Kunden innerhalb der Zone der Shopadresse liegt', now(), now()),
('Versandzone', 'MODULE_SHIPPING_STOREPICKUP_ZONE', 43, 'für welche Länder soll diese Versandart angeboten werden?<br/>Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now(), now()),
('Sortierung', 'MODULE_SHIPPING_STOREPICKUP_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Versandarten.', now(), now()),
('Versandkosten pro stück aktivieren', 'MODULE_SHIPPING_ITEM_STATUS', 43, 'Bieten Sie die Versandart Versandkosten pro stück an?', now(), now()),
('Versandkosten pro Artikel', 'MODULE_SHIPPING_ITEM_COST', 43, 'Die Versandkosten werden mit der Anzahl der Artikel in der Bestellung multipliziert.', now(), now()),
('BearbeitungsGebühr', 'MODULE_SHIPPING_ITEM_HANDLING', 43, 'BearbeitungsGebühr für diese Versandart:', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_ITEM_TAX_CLASS', 43, 'Welche Steuerklasse soll bei dieser Versandart angewendet werden?', now(), now()),
('Basis der Steuern', 'MODULE_SHIPPING_ITEM_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern berechnet werden? Mögliche Optionen:<br />Versand (Shipping) - auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - auf Basis der Shopadresse, wenn die Rechnungs-/Versandadresse des Kunden innerhalb der Zone der Shopadresse liegt', now(), now()),
('Versandzone', 'MODULE_SHIPPING_ITEM_ZONE', 43, 'für welche Länder soll diese Versandart angeboten werden?<br/>Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now(), now()),
('Sortierung', 'MODULE_SHIPPING_ITEM_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Versandarten.', now(), now()),
('Zahlungsart "Gratis" aktivieren', 'MODULE_PAYMENT_FREECHARGER_STATUS', 43, 'Wollen Sie die Zahlungsart "Gratis" anbieten?', now(), now()),
('Sortierung', 'MODULE_PAYMENT_FREECHARGER_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Zahlungsarten.', now(), now()),
('Zahlungszone', 'MODULE_PAYMENT_FREECHARGER_ZONE', 43, 'für welche Länder soll diese Zahlungsart angeboten werden?<br/>Die auswählbaren Zahlungszonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now(), now()),
('Bestellstatus', 'MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID', 43, 'Legt den Bestellstatus für diese Zahlungsart fest.', now(), now()),
('Vorkasse/Überweisung aktivieren', 'MODULE_PAYMENT_EUTRANSFER_STATUS', 43, 'Akzeptieren Sie Zahlungen per Vorkasse/Cberrweisung?', now(), now()),
('Bank Name:', 'MODULE_PAYMENT_EUTRANSFER_BANKNAM', 43, 'Tragen Sie hier den Namen Ihrer Bank ein.', now(), now()),
('Kontoinhaber:', 'MODULE_PAYMENT_EUTRANSFER_ACCNAM', 43, 'Tragen Sie hier den Namen des Kontoinhabers ein.', now(), now()),
('Kontonummer:', 'MODULE_PAYMENT_EUTRANSFER_ACCNUM', 43, 'Tragen Sie hier Ihre Kontonummer ein.', now(), now()),
('Bankleitzahl:', 'MODULE_PAYMENT_EUTRANSFER_BLZ', 43, 'Tragen Sie hier die Bankleitzahl ein.', now(), now()),
('IBAN:', 'MODULE_PAYMENT_EUTRANSFER_ACCIBAN', 43, 'Tragen Sie hier Ihre IBAN ein.', now(), now()),
('BIC/SWIFT:', 'MODULE_PAYMENT_EUTRANSFER_BANKBIC', 43, 'Tragen Sie hier Ihren BIC/SWIFT Code ein.', now(), now()),
('Sortierung', 'MODULE_PAYMENT_EUTRANSFER_SORT_ORDER', 43, 'Anzeigereigenfolge für dieses Modul. Der niedrigste Wert wird zuerst angezeigt.', now(), now()),
('Zahlungszone', 'MODULE_PAYMENT_EUTRANSFER_ZONE', 43, 'Wenn Sie hier eine Zone angeben, ist Banküberweisung nur für Kunden mit Rechnungsadresse in dieser Zone möglich. Es empfiehlt sich dafür eine Zone anzulegen, die nur die Länder mit EURO enthält.', now(), now()),
('Bestellstatus', 'MODULE_PAYMENT_EUTRANSFER_ORDER_STATUS_ID', 43, 'Welchen Bestellstatus sollen Bestellungen bekommen, die mit Banküberweisung bezahlt werden?', now(), now()),
('Länder', 'MODULE_PAYMENT_EUTRANSFER_COUNTRIES', 43, 'Geben Sie hier die Länder an, für die Banküberweisung möglich sein soll. Es empfiehlt sich hier nur Länder einzutragen, die den EURO haben, so dass eine EU-Standardüberweisung möglich ist. Zweistellige ISO-Codes durch Komma getrennt!', now(), now()),
('Inklusive MwSt.', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX', 43, 'Der Rabattbetrag enthält die MwSt.', now(), now()),
('Gruppenermässigung aktivieren', 'MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS', 43, 'Bieten Sie eine Ermässigung für bestimmte Kundengruppen an?', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER', 43, 'Bestimmt die Sortierung in der Bestellzusammenfassung', now(), now()),
('Inklusive Versandkosten', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING', 43, 'Die Gruppenermässigung wird auf den Rechnungsbeitrag inkl. der Versandkosten gewährt?', now(), now()),
('MwSt. Betrag neu berechnen', 'MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX', 43, 'Soll der MwSt. Betrag neu berechnet werden?<br/> Dieses ist nur notwendig, wenn die GruppenErmässigung inkl. MwSt. angezeigt werden soll', now(), now()),
('Steuerklasse', 'MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS', 43, '!!!TRANSLATE!!! Use the following tax class when treating Group Discount as Credit Note.', now(), now()),
('Einheitliche Versandkosten aktivieren', 'MODULE_SHIPPING_FLAT_STATUS', 43, 'Wollen Sie "Einheitliche Versandkosten" aktivieren?', now(), now()),
('Einheitliche Versandkosten', 'MODULE_SHIPPING_FLAT_COST', 43, 'Die Versandkosten für alle Bestellungen, die mit dieser Versandmethode getätigt werden.', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_FLAT_TAX_CLASS', 43, 'Folgende Steuerklasse für diese Versandmethode verwenden:', now(), now()),
('Basis der Steuern', 'MODULE_SHIPPING_FLAT_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern berechnet werden? Mögliche Optionen:<br />Versand (Shipping) - auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - auf Basis der Shopadresse, wenn die Rechnungs-/Versandadresse des Kunden innerhalb der Zone der Shopadresse liegt', now(), now()),
('Versandzone', 'MODULE_SHIPPING_FLAT_ZONE', 43, 'Wenn eine Zone ausgewählt wird, ist diese Versandmethode nur für diese Zone aktiviert.', now(), now()),
('Reihenfolge der Anzeige:', 'MODULE_SHIPPING_FLAT_SORT_ORDER', 43, 'Legt die Reihenfolge der Anzeige fest (Der kleinste Wert wird als erstes gezeigt)', now(), now()),
('Standardwährung', 'DEFAULT_CURRENCY', 43, 'Standardwährung', now(), now()),
('Standardsprache', 'DEFAULT_LANGUAGE', 43, 'Standardsprache', now(), now()),
('Bestellstatus für neue Bestellungen', 'DEFAULT_ORDERS_STATUS_ID', 43, 'Wenn eine neue Bestellung getätigt wird, ist dies der Status dem sie zugewiesen wird.', now(), now()),
('Admin configuration_key anzeigen', 'ADMIN_CONFIGURATION_KEY_ON', 43, 'Manuell auf Wert 1 wechseln um den configuration_key Namen in der Konfiguration anzuzeigen', now(), now()),

# Adminmenü ID 7
('Ursprungsland', 'SHIPPING_ORIGIN_COUNTRY', 43, 'Wählen Sie das Land, von dem aus die Versandkosten berechnet werden sollen.', now(), now()),
('Postleitzahl', 'SHIPPING_ORIGIN_ZIP', 43, 'Geben Sie die Postleitzahl an, von dem aus die Versandkosten berechnet werden sollen.', now(), now()),
('Maximales Versandgewicht', 'SHIPPING_MAX_WEIGHT', 43, 'Paketdienste haben im Allgemeinen eine Grenze für das Maximagewicht eines Paketes.<br />Tragen Sie dieses Gewicht stellvertretend für alle ein.', now(), now()),
('Kleine bis mittlere Pakete: prozentuelle Gewichtszunahme', 'SHIPPING_BOX_WEIGHT', 43, 'Wie hoch ist die Gewichtszunahme bei einem typischen kleineren Paketes bis mittleren Paket?<br />Beispiel: 10% + 1kg 10:1<br />10% + 0kg 10:0<br />0% + 5kg 0:5<br />0% + 0kg 0:0', now(), now()),
('Grössere Pakete: prozentuelle Gewichtszunahme', 'SHIPPING_BOX_PADDING', 43, 'Wie hoch ist die Zunahme des Gewichtes bei einem typischen grösseren Paket?<br />Beispiel: 10% + 1kg 10:1<br />10% + 0kg 10:0<br />0% + 5kg 0:5<br />0% + 0kg 0:0', now(), now()),
('Anzahl der Pakete und das Gewicht anzeigen', 'SHIPPING_BOX_WEIGHT_DISPLAY', 43, 'Soll die Anzahl der Pakete und das Gewicht angezeigt werden?<br /><br />0= nein<br />1= nur Anzahl der Pakete<br />2= nur das Gewicht<br />3= Anzahl der Pakete und das Gewicht', now(), now()),
('Einstellungen für Versandberechnung im Warenkorb anzeigen', 'SHOW_SHIPPING_ESTIMATOR_BUTTON', 43, '<br />0= AUS<br />1= Als Button im Warenkorb zeigen<br />2= Die voraussichtlichen Versandkosten werden unterhalb des Warenkorb angezeigt. Als Basis für die Berechnung wird die Hauptadresse des Kunden genommen.', now(), now()),
('Zeige Bestellkommentare auf der Admin Rechnung an', 'ORDER_COMMENTS_INVOICE', 43, 'Sollen Bestellkommentare auf der Admin Rechnung angezeigt werden?<br />0= AUS<br />1= Nur der erste Kommentar des Kunden<br />2= Alle Kommentare der Bestellung', now(), now()),
('Zeige Bestellkommentare auf dem Admin Lieferschein an', 'ORDER_COMMENTS_PACKING_SLIP', 43, 'Sollen Bestellkommentare auf dem Admin Lieferschein angezeigt werden?<br />0= AUS<br />1= Nur der erste Kommentar des Kunden<br />2= Alle Kommentare der Bestellung', now(), now()),
('Versandkostenfreier Versand wenn das Gesamtgewicht "0" ist', 'ORDER_WEIGHT_ZERO_STATUS', 43, 'Wenn in einer Bestellung das Gesamtgewicht "0" ist, soll die Bestellung als "versandkostenfrei" versendet werden?<br />0= nein<br />1= ja<br />HINWEIS: Wenn diese Option aktiviert ist, wird "versandkostenfrei" nur bei Artikel mit "0" Gewicht angezeigt.', now(), now()),

# Adminmenü ID 8
('Artikelbilder anzeigen', 'PRODUCT_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der das Artikelbild angezeigt wird', now(), now()),
('Hersteller anzeigen', 'PRODUCT_LIST_MANUFACTURER', 43, 'Wollen Sie den Hersteller in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der der Hersteller angezeigt wird', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_LIST_MODEL', 43, 'Wollen Sie Artikelnummern in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der die Artikelnummer angezeigt wird', now(), now()),
('Artikelnamen anzeigen', 'PRODUCT_LIST_NAME', 43, 'Wollen Sie Artikelnamen in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der der Artikelname angezeigt wird', now(), now()),
('Anzeigen von Preis/In den Warenkorb', 'PRODUCT_LIST_PRICE', 43, 'Wollen Sie den Preis und die Anzeige "In den Warenkorb" in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der "Preis/in den Warenkorb" angezeigt wird', now(), now()),
('Artikelstückzahl anzeigen', 'PRODUCT_LIST_QUANTITY', 43, 'Wollen Sie die vorhandene Artikelstückzahl in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der die Verfügbare Artikelstückzahl angezeigt wird', now(), now()),
('Artikelgewicht anzeigen', 'PRODUCT_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der das Artikelgewicht angezeigt wird', now(), now()),
('Preis/In den Warenkorb: Spaltenbreite', 'PRODUCTS_LIST_PRICE_WIDTH', 43, 'Definiert die Spaltenbreite von "Preis/In den Warenkorb"<br />Standard= 125', now(), now()),
('Kategorien-/Herstellerfilter anzeigen (0=nein; 1=ja)', 'PRODUCT_LIST_FILTER', 43, 'Wollen Sie den Filter für Kategorien-/Hersteller im Shop anzeigen?', now(), now()),
('"Vorheriger/Nächster" Navigation: Ansicht', 'PREV_NEXT_BAR_LOCATION', 43, 'Wo soll die "Vorheriger / Nächster" Navigation angezeigt werden?<br />(1= oben, 2= unten, 3= oben und unten)', now(), now()),
('Standardsortierung', 'PRODUCT_LISTING_DEFAULT_SORT_ORDER', 43, 'Standard Sortierung für Artikellisten<br />HINWEIS: für eine Sortierung nach Artikel bitte leer lassen.<br />Sortiert die Artikelliste in der gewünschten Reihenfolge mit der Sie beginnen möchten.<br>Wenn Sie z.B. nach Artikelnummer sortieren wollen, geben Sie die Nummer ein, die Sie oben bei Artikelnummer vergeben haben. Direkt dahinter geben Sie ein a für aufsteigende Sortierung oder ein d für absteigende Sortierung ein', now(), now()),
('Button "In den Warenkorb" anzeigen (0=nein; 1=ja; 2=Ja mit stückzahlfeld pro Artikel)', 'PRODUCT_LIST_PRICE_BUY_NOW', 43, 'Wollen Sie den Button "In den Warenkorb" anzeigen?<br /><br /><strong>HINWEIS:</strong> Um die pro Artikel ein stückzahlfeld angezeigt zu bekommen (Auswahl 2), setzen Sie bitte die Einstellung "Button "Ausgewählte Artikel in den Warenkorb" anzeigen" auf 0', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br/><br/>0= NEIN<br/>1= Oben<br/>2= Unten<br/>3= Oben und Unten', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_LIST_DESCRIPTION', 43, 'Soll die Artikelbeschreibung angezeigt werden?<br/><br/>0= Aus<br/>oder z.B. 150 = es werden die ersten 150 Zeichen der Artikelbeschreibung angezeigt', now(), now()),
('Zeichen für absteigende Sortierung', 'PRODUCT_LIST_SORT_ORDER_DESCENDING', 43, 'Welches Zeichen soll eine ansteigende Sortierung anzeigen?<br />Default = -', now(), now()),
('Zeichen für aufsteigende Sortierung', 'PRODUCT_LIST_SORT_ORDER_ASCENDING', 43, 'Welches Zeichen soll eine aufsteigende Sortierung anzeigen?<br />Default = +', now(), now()),
('Artikelfilter für Artikelnamen nach Alphabet anzeigen', 'PRODUCT_LIST_ALPHA_SORTER', 43, 'Soll der Filter für Artikel nach Alphabet in der Artikelliste angezeigt werden?', now(), now()),
('Bild für Unterkategorien anzeigen', 'PRODUCT_LIST_CATEGORIES_IMAGE_STATUS', 43, 'Wollen Sie die Bilder der Unterkategorien in der Artikelliste anzeigen?', now(), now()),
('Bild für ausgewählte Kategorie anzeigen', 'PRODUCT_LIST_CATEGORIES_IMAGE_STATUS_TOP', 43, 'Wollen Sie das Bild für die aktuell ausgewählte Kategorie oben in der Artikelliste anzeigen?', now(), now()),
('Unterkategorien anzeigen', 'PRODUCT_LIST_CATEGORY_ROW_STATUS', 43, 'Sollen die Unterkategorien in der Artikelliste beim Klick auf die Hauptkategorie angezeigt werden?<br /><br />0= Nein<br />1= Ja', now(), now()),
('Artikelliste - Layout Stil', 'PRODUCT_LISTING_LAYOUT_STYLE', 43, 'Wählen Sie das Layout Ihrer Artikelliste:<br/>Jeder Artikel kann in einer eigenen Zeile angezeigt werden (rows) oder die Artikel können nebeneinander in mehreren Spalten pro Reihe angezeigt werden (columns)', now(), now()),
('Artikelliste - Spalten pro Reihe', 'PRODUCT_LISTING_COLUMNS_PER_ROW', 43, 'Wieviele Spalten pro Reihe wollen Sie in der Artikelliste anzeigen. Voreinstellung: 3', now(), now()),


# Adminmenü ID 9
('Lagerbestand prüfen', 'STOCK_CHECK', 43, 'Überprüfen, ob der bestellte Artikel auch lagernd ist', now(), now()),
('Bestellungen vom Lagerbestand abziehen', 'STOCK_LIMITED', 43, 'Sollen bestellte Artikel vom Lagerbestand abgezogen werden?', now(), now()),
('Bestellung erlauben, wenn Lagerbestand unterschritten wird', 'STOCK_ALLOW_CHECKOUT', 43, 'Soll Kunden bei Unterschreitung des Lagerbestandes eine Bestellung ermöglicht werden?', now(), now()),
('Markierung für nicht lagernde Artikel', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', 43, 'Nicht lagernde Artikel werden bei der Bestellung markiert mit diesen Zeichen markiert<br>Standard: ***', now(), now()),
('Lagermindestbestand für Nachbestellungen', 'STOCK_REORDER_LEVEL', 43, 'Legen Sie hier fest, ab welcher Lagermenge ein Artikel nachbestellt werden muss<br>HINWEIS: Diese Einstellung gilt für alle Artikel, es kann keine Unterscheidung pro Artikel vorgenommen werden.', now(), now()),
('Artikel im Shop anzeigen, wenn nicht lagernd', 'SHOW_PRODUCTS_SOLD_OUT', 43, 'Sollen Artikel im Shop angezeigt werden, wenn sie nicht lagernd sind<br /><br />0= Nein - Artikelstatus auf AUS<br />1= Ja, Artikelstatus auf EIN', now(), now()),
('Artikel ist ausverkauft: Bild "Ausverkauft" anstelle von "in den Warenkorb" anzeigen', 'SHOW_PRODUCTS_SOLD_OUT_IMAGE', 43, 'Zeige für ausverkaufte Artikel das Bild "Ausverkauft" anstelle von "in den Warenkorb"<br /><br />0= nein<br />1= ja', now(), now()),
('Dezimalstellen der Artikelstückzahlen', 'QUANTITY_DECIMALS', 43, 'Wieviele Dezimalstellen sollen in der Artikelstückzahl angezeigt werden?<br /><br />0= keine', now(), now()),
('Warenkorb: Checkboxen und/oder Buttons zum Löschen anzeigen', 'SHOW_SHOPPING_CART_DELETE', 43, 'Zeigt im Warenkorb Buttons und/oder Checkboxen zum Löschen von Artikel an<br /><br />1= Nur Buttons<br />2= Nur Checkboxen<br />3= Buttons und Checkboxen', now(), now()),
('Warenkorb: Aktualisieren Schaltfläche anzeigen', 'SHOW_SHOPPING_CART_UPDATE', 43, 'Wo soll die Aktualisieren Schaltfläche im Warenkorb angezeigt werden?<br/><br/>1= Neben jedem Mengeneingabefeld<br/>2= Einmal unterhalb des Warenkorbes<br/>3= Neben jedem Mengeneingabefeld und unterhalb des Warenkorbes', now(), now()),
('Leerer Warenkorb: "Neue Artikel" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_NEW_PRODUCTS', 43, 'Sollen "Neue Artikel" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Leerer Warenkorb: "Empfohlene Artikel" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_FEATURED_PRODUCTS', 43, 'Sollen "Empfohlene Artikel" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Leerer Warenkorb: "Monatliche Sonderangebote" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_SPECIALS_PRODUCTS', 43, 'Sollen "Monatliche Sonderangebote" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Leerer Warenkorb: "Artikelankündigungen" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_UPCOMING', 43, 'Sollen "Artikelankündigungen" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Zeige Hinweis beim Login über den zusammengelegten Warenkorb an', 'SHOW_SHOPPING_CART_COMBINED', 43, 'Sobald ein Kunde sich anmeldet und von der letzten Anmeldung noch Artikel im Warenkorb hat, werden die aktuell im Warenkorb vorhandenen Artikel mit dem Warenkorb der letzten Anmeldung kombiniert.<br /><br />Soll der Kunde auf diesen Vorgang hingewiesen werden?<br /><br />0= NEIN, zeige keinen Hinweis an<br />1= JA, und gehe automatisch zum Warenkorb<br />2= JA, aber gehe nicht automatisch zum Warenkorb', now(), now()),

# Adminmenü ID 10
('Speichern der Zeit für Seitenaufbau', 'STORE_PAGE_PARSE_TIME', 43, 'Sollen die Zeiten für den Seitenaufbau einer Seite gespeichert werden?', now(), now()),
('Protokolldatei für Seitenaufbau: Speicherort', 'STORE_PAGE_PARSE_TIME_LOG', 43, 'Verzeichnis und Dateiname der Protokolldatei für Seitenaufbau', now(), now()),
('Protokolldatei für Seitenaufbau: Datumsformat', 'STORE_PARSE_DATE_TIME_FORMAT', 43, 'Datumsformat für die Protokolldatei', now(), now()),
('Zeit für Seitenaufbau im Shop anzeigen', 'DISPLAY_PAGE_PARSE_TIME', 43, 'Soll die Zeit für den Seitenaufbau im Shop unten angezeigt werden?<br />HINWEIS: Es ist nicht notwendig, die Protokolldatei für Seitenaufbau zu speichern, um sie im Shop anzeigen zu lassen.', now(), now()),
('Datenbankabfragen in Protokolldatei speichern', 'STORE_DB_TRANSACTIONS', 43, 'Sollen Datenbankabfragen in der Protokolldatei für Seitenabfragen gespeichert werden?<br />VORSICHT: Das Aktivieren dieser Einstellung kann Ihren Shop stark verlangsamen und unzählige Logfiles reduzieren Ihren Speicherplatz auf Ihrem Server! Nur für Troubleshooting aktivieren!', now(), now()),

# Adminmenü ID 12
('E-Mail Transportmethode', 'EMAIL_TRANSPORT', 43, 'Legt fest, ob dieser Server eine lokale Verbindung zu ''sendmail'' oder einen SMTP - Server über TCP/IP Verbindung verwendet.<br />HINWEIS: für Server, die unter Windows oder MacOS betrieben werden, sollten Sie die Einstellung ''SMTP'' verwenden.', now(), now()),
('SMTP E-Mail - Mailbox Benutzer', 'EMAIL_SMTPAUTH_MAILBOX', 43, 'Wenn Sie für den Versand von E-Mails SMTP Authentifizierung verwenden müssen, dann geben Sie hier den Namen Ihres SMTP Benutzerkontos ein z.B. ich@domain.com ', now(), now()),
('SMTP E-Mail - Mailbox Passwort', 'EMAIL_SMTPAUTH_PASSWORD', 43, 'Passwort für SMTP Authentifizierung', now(), now()),
('SMTP E-Mail - Mailserver Name', 'EMAIL_SMTPAUTH_MAIL_SERVER', 43, 'SMTP Mailserver für Authentifizierung z.B. smtp.domain.com', now(), now()),
('SMTP E-Mail - Mailserver Port', 'EMAIL_SMTPAUTH_MAIL_SERVER_PORT', 43, 'SMTP Mailserver Port', now(), now()),
('Währungssymbole für Text-Emails', 'CURRENCIES_TRANSLATIONS', 43, 'Welche Währungssymbole sollen für Text-Emails konvertiert werden?<br />Default = &pound;,CB#:&euro;,C"b B,:&reg;,CB.:&trade;,C"b B"', now(), now()),
('E-Mail Zeilenvorschub', 'EMAIL_LINEFEED', 43, 'Legen Sie hier die Zeichen fest, die Sie zur Trennung des E-Mail Headers verwenden wollen.', now(), now()),
('E-Mail als MIME HTML versenden', 'EMAIL_USE_HTML', 43, 'Wollen Sie e-Mails im HTML Format versenden falls der Empänger in seinen Einstellungen HTML statt Text angekreuzt hat?<br/>HINWEIS: Dies ist der generelle Hauptschalter. Wenn Sie hier auf false stellen, dann wird der Shop keinerlei HTML Emails versenden.', now(), now()),
('E-Mail durch DNS-Server verifizieren', 'ENTRY_EMAIL_ADDRESS_CHECK', 43, 'Soll die Gültigkeit von e-Mails durch DNS-Server verifiziert werden?', now(), now()),
('E-Mail senden', 'SEND_EMAILS', 43, 'E-Mails senden', now(), now()),
('E-Mail Archivierung aktiviert', 'EMAIL_ARCHIVE', 43, 'Wenn Sie E-Mail, die versendet werden, archivieren wollen, setzen Sie desen Wert auf "true".', now(), now()),
('E-Mail Fehlermeldungen', 'EMAIL_FRIENDLY_ERRORS', 43, 'Gibt lesbare Fehlermeldungen aus falls der E-Mail Versand scheitert (true). Bei (false) werden auch PHP Fehler angezeigt . Diese Einstellung ist nur für die Fehlersuche gedacht!', now(), now()),
('E-Mail Adresse (Kontaktadresse)', 'STORE_OWNER_EMAIL_ADDRESS', 43, 'Die E-Mail Adresse des Shopbetreibers / der Kontaktperson.', now(), now()),
('E-Mail Absender', 'EMAIL_FROM', 43, 'Die Absenderadresse, mit der E-Mails versendet werden sollen.', now(), now()),
('E-Mail Absenderdomain verwenden?', 'EMAIL_SEND_MUST_BE_STORE', 43, 'Alle vom Mailserver verschickten E-Mails müssen eine Absenderadresse "FROM" haben?<br /><br />Dies wird oft verwendet um das verschicken von SPAM mails zu verhindern. Bei JA wird der Wert der Einstellung "E-Mail Absender" als "FROM" Adresse für alle ausgehenden Mails verwendet.', now(), now()),
('E-Mail an Admin: Format', 'ADMIN_EXTRA_EMAIL_FORMAT', 43, 'Wählen Sie das Format für e-Mails, die zusätzlich an den Administrator versendet werden.<br/>HINWEIS: Wenn Sie hier HTML auswählen, dann muss auch der generelle Hauptschalter HTML Emails versenden auf true gestellt sein, sonst werden nur Text Emails versandt.', now(), now()),
('E-Mail Kopie bei Bestellungen versenden', 'SEND_EXTRA_ORDER_EMAILS_TO', 43, 'Versendet zusätzlich ein E-Mail bei Bestellungen an die unten angegebene(n) Adresse(n).<br />Die Adressen müssen in diesem Format eingegeben werden:<br/>Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Neues Konto erstellt": Benachrichtigung versenden', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS', 43, 'Benachrichtigung versenden, wenn ein neues Konto erstellt wurde?<br />0= nein<br />1= ja', now(), now()),
('"Neues Konto erstellt": Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO', 43, 'Eine Kopie an diese E-Mail Adresse(n) versenden, wenn ein neues Konto erstellt wurde?<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Gutschein versendet": Benachrichtigung versenden', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_STATUS', 43, '"Gutschein versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', now(), now()),
('"Gutschein versendet": Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO', 43, 'Eine Kopie bei "Gutschein versendet" an diese E-Mail Adresse(n) versenden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Admin Gutschein versendet": Benachrichtigung versenden', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO_STATUS', 43, '"Admin Gutschein versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', now(), now()),
('"Admin Gutschein versendet": Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO', 43, 'Eine Kopie bei "Admin Gutschein versendet" an diese E-Mail Adresse(n) versenden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Admin Aktionskupon versendet": Benachrichtigung versenden', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_STATUS', 43, '"Admin Aktionskupon versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', now(), now()),
('"Admin Aktionskupon versendet": Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO', 43, 'Eine Kopie bei "Admin Aktionskupon versendet" an diese E-Mail Adresse(n) versenden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Admin Bestellung": Benachrichtigung versenden', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS', 43, '"Admin Bestellung versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', now(), now()),
('"Admin Bestellung": Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO', 43, 'Eine Kopie bei "Admin Bestellung versendet" an diese E-Mail Adresse(n) versenden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Kunden Bewertung" : Benachrichtigung versenden', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS', 43, '0= Nein<br/>1= Ja', now(), now()),
('"Kunden Bewertung" : Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO', 43, 'Eine Kopie an diese E-Mail Adresse(n) versenden, wenn eine Bewertung abgegeben wurde?<br/>Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;\r\n', now(), now()),
('E-Mail Adressen für die "Schreiben Sie uns" Dropdown Liste', 'CONTACT_US_LIST', 43, 'Lassen Sie dieses Feld leer, wenn Sie kein Dropdown mit unterschiedlichen Kontaktadressen verwenden wollen, es wird dann automatisch die Shop Kontakadresse verwendet!<br/><br/>Geben Sie hier die für die "Schreiben Sie uns" E-Mail Dropdown Liste gewünschte(n) E-Mail Adresse(n) ein.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Schreiben Sie uns": Shopname und Adresse anzeigen', 'CONTACT_US_STORE_NAME_ADDRESS', 43, 'Shopname und Adresse im Formular "Schreiben Sie uns" anzeigen<br />0= nein<br />1= ja', now(), now()),
('"Lagermindestbestand unterschritten": Benachrichtigung versenden', 'SEND_LOWSTOCK_EMAIL', 43, 'Eine Benachrichtigung versenden, wenn der Lagermindestbestand erreicht oder unterschritten wurde?<br />0= nein<br />1= ja', now(), now()),
('"Lagermindestbestand unterschritten": an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_LOW_STOCK_EMAILS_TO', 43, 'Wenn der Lagermindestbestand erreicht oder unterschritten wurde, soll an diese E-Mail Adresse(n) eine Benachrichtigung versendet werden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('Link "Newsletter abbestellen" anzeigen?', 'SHOW_NEWSLETTER_UNSUBSCRIBE_LINK', 43, 'Soll in der Info Box ein Link für "Newsletter abbestellen" angezeigt werden?', now(), now()),
('Empfängerliste -  Zähleranzeige', 'AUDIENCE_SELECT_DISPLAY_COUNTS', 43, 'Wenn die Liste der Verfügbaren Empfänger angezeigt wird, soll der Empfängerzähler inkludiert werden? <br /><em>(HINWEIS: Es können GeschwindigkeitseinbuCen auftreten, wenn Sie viele Kunden oder komplexe Empfängerabfragen haben)</em>', now(), now()),
('Willkommensemail senden?', 'SEND_WELCOME_EMAIL', 43, 'Wollen Sie Neukunden nach der Registrierung ein Willkommensemail senden?', now(), now()),

# Adminmenü ID 13
('Downloads aktivieren', 'DOWNLOAD_ENABLED', 43, 'Wollen Sie Download-Artikel aktivieren?.', now(), now()),
('Downloads über Weiterleitung', 'DOWNLOAD_BY_REDIRECT', 43, 'Wollen Sie Browser-Weiterleitung für Download-Artikel aktivieren? (Ist auf nicht-UNIX Systemen deaktiviert).<br /><br />HINWEIS: Setzten Sie /pub auf CHMOD 777 bei aktivierter Weiterleitung', now(), now()),
('Streaming Download', 'DOWNLOAD_IN_CHUNKS', 43, 'Wenn Download via redirect gesperrt ist und ihr PHP Speicherlimit < 8 MB ist, sollten Sie diese Einstellung verwenden, da die Daten in kleineren Blöcken an den Browser übermittelt werden.<br /><br />Hat keine Bedeutung wenn Download via Redirect freigegeben ist.', now(), now()),
('Ablaufdatum für Downloads (Anzahl in Tagen)', 'DOWNLOAD_MAX_DAYS', 43, 'Geben Sie hier die Anzahl der Tagen ein, für wie lange ein Download-Artikel gültig sein soll. (0= Unlimitiert)', now(), now()),
('Anzahl erlaubter Downloads - pro Artikel', 'DOWNLOAD_MAX_COUNT', 43, 'Geben Sie hier die maximale Anzahl der erlaubten Downloads pro Artikel ein. (0= Download nicht erlaubt)', now(), now()),
('Downloadmanager: Wert für Aktualisierungsstatus', 'DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE', 43, 'Welcher Bestellstatus soll die Tage der Gültigkeitsdauer und die maximal erlaubte Downloadanzahl für Download-Artikel zurücksetzen? (Standard = 4)', now(), now()),
('Downloadmanager: Wert für Bestellstatus', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS', 43, 'Nur wenn der Auftragsstatus Grösser/gleich dem eingegebenen Wert ist, können Download-Artikel heruntergeladen werden. Standard: 2', now(), now()),
('Max. Auftragsstatus für Download-Artikel', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS_END', 43, 'Nur wenn der Auftragsstatus kleiner/gleich dem eingegebenen Wert ist, können Download-Artikel heruntergeladen werden. Standard: 4', now(), now()),
('Preis durch Attribute', 'ATTRIBUTES_ENABLED_PRICE_FACTOR', 43, 'Preise durch Attribute aktivieren?', now(), now()),
('Mengenrabatt aktivieren', 'ATTRIBUTES_ENABLED_QTY_PRICES', 43, 'Mengenrabatte ermöglichen?', now(), now()),
('Attributbilder', 'ATTRIBUTES_ENABLED_IMAGES', 43, 'Attributbilder aktivieren?', now(), now()),
('Textpreise aktivieren (Wort oder Buchstabe)', 'ATTRIBUTES_ENABLED_TEXT_PRICES', 43, 'Soll das Attribut "Textpreis nach Wort oder Buchstabe" aktiviert werden?', now(), now()),
('Textpreise: Leerzeichen sind kostenlos', 'TEXT_SPACES_FREE', 43, 'Sind bei Textpreisen die Leerzeichen kostenlos?<br /><br />0= nein 1= ja', now(), now()),
('Artikel mit Read-Only Attributen - Hinzufügen zum Warenkorb', 'PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED', 43, 'Können Artikel mit nur Read-Only Attributen in den Warenkorb gelegt werden?<br/>0=NEIN<br/>1=JA', now(), now()),

# Adminmenü ID 14
('GZip Komprimierung aktivieren', 'GZIP_LEVEL', 43, '0= nein 1= ja', now(), now()),

# Adminmenü ID 15
('Verzeichnis für Sitzungen', 'SESSION_WRITE_DIRECTORY', 43, 'Wenn das Speichern von Sitzungen sateibasierend ist, werden sie in dieses Verzeichnis gespeichert. Hier sollte dasselbe Verzeichnis angegeben werden wie in der Einstellun für DIR_FS_SQL_CACHE in Ihren beiden configure.php Dateien!', now(), now()),
('Cookies - Domänenname', 'SESSION_USE_FQDN', 43, 'Wenn für den Shop Cookies verwendet werden, benötigen Sie einen Domänennamen (z.B. www.meinedomain.at). Wenn nicht, wird nur ein teilweiser Domänenname benötigt (z.B. meinedomain.at) Wenn Sie sich nicht sicher sind, lassen Sie diese Option auf "true".', now(), now()),
('Cookies - Verwendung erzwingen', 'SESSION_FORCE_COOKIE_USE', 43, 'Die Verwendung von Cookies erzwingen.<br />HINWEIS: Wenn ein Kunde in den Browsereinstellungen die Verwendung von Cookies deaktiviert hat, kann dieser den Shop nicht verwenden..', now(), now()),
('Überprüfung der SSL Sitzungs- ID', 'SESSION_CHECK_SSL_SESSION_ID', 43, 'Überprüft die Sitzungs-ID bei jeder gesicherten HTTPS Seitenanfrage.', now(), now()),
('Browser des Kunden prüfen', 'SESSION_CHECK_USER_AGENT', 43, 'Überprüft den Browser des Kunden bei jeder Seitenanfrage.', now(), now()),
('IP Adresse überprüfen', 'SESSION_CHECK_IP_ADDRESS', 43, 'Überprüft die IP Adresse des Benutzers bei jeder Seitenanfrage.', now(), now()),
('Spider Sitzungen verhindern', 'SESSION_BLOCK_SPIDERS', 43, 'Verhindert das Starten von Sitzungen bei bekannten Spidern.', now(), now()),
('Sitzungen wiederherstellen', 'SESSION_RECREATE', 43, 'Sollen Sitzungen wiederhergestellt werden, um eine neue Sitzungs-ID zu erstellen, wenn ein Kunde sich anmeldet oder ein neues Konto erstellt? (benötigt PHP >=4.1).', now(), now()),
('Umwandlung IP Adresse zu Hostname', 'SESSION_IP_TO_HOST_ADDRESS', 43, 'Soll die IP-Adresse auf einen Hostnamen umgewandelt werden?<br/><br/>Anmerkung: Auf manchen Systemen kann dies zu einem langsameren Session Start und E-Mailversand führen. ', now(), now()),

# Adminmenü ID 16
('Länge der Aktionskupon-/Gutscheinnummer', 'SECURITY_CODE_LENGTH', 43, 'Tragen Sie hier die Länge der Aktionskupon-/Gutscheinnummer ein<br />Tipp: Je länger um so sicherer.', now(), now()),
('Standard Auftragsstatus bei Bestellsumme 0', 'DEFAULT_ZERO_BALANCE_ORDERS_STATUS_ID', 43, 'Auftragsstatus der Bestellungen mit der Bestellsumme 0 zugewiesen werden soll', now(), now()),
('Neuregistrierung: Aktionskupon ID#', 'NEW_SIGNUP_DISCOUNT_COUPON', 43, 'Wählen Sie einen Aktionskupon<br />(none= keine Aktiosnkupons bei Neuregistrierungen senden)', now(), now()),
('Neuregistrierung: Ermässigungsbetrag', 'NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', 43, 'Bitte leer lassen, falls Sie keine "Willkommensgeschenke" in Form eines Aktionskupons an Neukunden versenden wollen,<br />oder geben Sie den Betrag an (z.B. 10 für &euro;10.00)', now(), now()),
('Max. Anzahl Gutscheine pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS', 43, 'Max. Anzahl Gutscheine pro Seite', now(), now()),
('Max. Anzahl Gutscheine auf Reportseite', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS_REPORTS', 43, 'Max. Anzahl Gutscheine auf Reportseite', now(), now()),

# Adminmenü ID 17
('VISA', 'CC_ENABLED_VISA', 43, 'Akzeptieren Sie Zahlungen mit VISA Kreditkarten (0= nein 1= ja)', now(), now()),
('MasterCard', 'CC_ENABLED_MC', 43, 'Akzeptieren Sie Zahlungen mit MasterCard Kreditkarten (0= nein 1= ja)', now(), now()),
('AmericanExpress', 'CC_ENABLED_AMEX', 43, 'Akzeptieren Sie Zahlungen mit AmericanExpress Kreditkarten (0= nein 1= ja)', now(), now()),
('Diners Club', 'CC_ENABLED_DINERS_CLUB', 43, 'Akzeptieren Sie Zahlungen mit Diners Club Kreditkarten (0= nein 1= ja)', now(), now()),
('Discover Card', 'CC_ENABLED_DISCOVER', 43, 'Akzeptieren Sie Zahlungen mit Discover Card Kreditkarten  (0= nein 1= ja)', now(), now()),
('JCB', 'CC_ENABLED_JCB', 43, 'Akzeptieren Sie Zahlungen mit JCB Kreditkarten  (0= nein 1= ja)', now(), now()),
('AUSTRALIAN BANKCARD', 'CC_ENABLED_AUSTRALIAN_BANKCARD', 43, 'Akzeptieren Sie Zahlungen mit AUSTRALIAN BANKCARD Kreditkarten (0= nein 1= ja)', now(), now()),
('SOLO', 'CC_ENABLED_SOLO', 43, 'Akzeptieren Sie Zahlungen mit SOLO Kreditkarten (0= nein 1= ja)', now(), now()),
('Switch', 'CC_ENABLED_SWITCH', 43, 'Akzeptieren Sie Zahlungen mit Switch Kreditkarten  (0= nein 1= ja)', now(), now()),
('Maestro', 'CC_ENABLED_MAESTRO', 43, 'Akzeptieren Sie Zahlungen mit Maestro Kreditkarten (0= nein 1= ja)', now(), now()),
('Debit', 'CC_ENABLED_DEIBT', 43, 'Akzeptieren Sie Zahlungen mit Debit Kreditkarten (0= nein 1= ja)', now(), now()),
('Akzeptierte Kreditkarten in der Seite für Bezahlung anzeigen', 'SHOW_ACCEPTED_CREDIT_CARDS', 43, 'Sollen die akzeptierten Kreditkarten in der Seite für die Bezahlung angezeigt werden?<br />0= nicht anzeigen<br />1= als Text anzeigen<br />2= als Bild anzeigen<br /><br />HINWEIS: Die Bilder und Texte müssen sowohl in der Datenbank als auch in den Sprachfiles für die jeweilige Kreditkarte definiert sein.', now(), now()),

# Adminmenü ID 6 - Wird nicht angezeigt, dient meist für die Module
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_GV_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_GV_SORT_ORDER', 43, 'Legt die Sortierung fest.', now(), now()),
('Warteschlange für Gutscheinbestellungen aktivieren', 'MODULE_ORDER_TOTAL_GV_QUEUE', 43, 'Wollen Sie die Warteschlange für Gutscheinbestellungen aktivieren?', now(), now()),
('Versandkosten im Gutschein inkludieren', 'MODULE_ORDER_TOTAL_GV_INC_SHIPPING', 43, 'Sollen die Versandkosten in die Berechnung inkludiert werden?', now(), now()),
('Gutscheine inklusive Steuern', 'MODULE_ORDER_TOTAL_GV_INC_TAX', 43, 'Sollen die Steuern in die Berechnung inkludiert werden?', now(), now()),
('Steuern neu berechnen', 'MODULE_ORDER_TOTAL_GV_CALC_TAX', 43, 'Steuern neu berechnen', now(), now()),
('Steuerklasse für Gutscheine', 'MODULE_ORDER_TOTAL_GV_TAX_CLASS', 43, 'Folgende Steuerklasse wird bei Gutscheinen und im Kreditguthaben verwendet:', now(), now()),
('Kreditguthaben inklusive Steuern', 'MODULE_ORDER_TOTAL_GV_CREDIT_TAX', 43, 'Sollen die Steuern bei bestellten Gutscheinen im Kreditguthaben inkludiert werden?', now(), now()),
('Bestellstatus', 'MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID', 43, 'Legt den Bestellstatus fest, wenn der komplette Auftrag mit einem Gutschein vollständig bezahlt wurde.', now(), now()),

('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),
('Gebühr für Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 43, 'Wollen Sie einen Mindestbestellzuschlag aktivieren?', now(), now()),
('Gebühr bei Unterschreitung der Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', 43, 'Wie hoch ist Gebühr bei Unterschreitung der Mindestbestellmenge?', now(), now()),
('Gebühr für Mindestbestellmenge - Betrag', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', 43, 'für eine prozentuelle Kalkulation fügen Sie ein "%" Zeichen an. Beispiel: 10%<br />für eine pauschale Gebühr geben Sie den Betrag an. Beispiel: 5 für &euro;5.00', now(), now()),
('Gebühr für Mindestbestellmenge - nur bestimmte Bestellungen', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 43, 'Gebühren für Mindestbestellmengen werden nur für Bestellungen angewendet, die zum hier eingestellten Ziel gesendet werden.', now(), now()),
('Gebühr für Mindestbestellmenge - Steuerklasse', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', 43, 'Folgende Steuerklasse bei Gebühren für Mindestbestellmengen verwenden.', now(), now()),
('Virtuelle Artikel - keine Gebühr für Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL', 43, 'Soll bei Bestellungen, die nur virtuellen Artikel beinhalten, keine Gebühr für Mindestbestellmenge gerechnet werden?', now(), now()),
('Geschenkgutscheine - keine Gebühr für Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_GV', 43, 'Soll bei Bestellungen, die nur Geschenkgutscheine beinhalten, keine Gebühr für Mindestbestellmenge gerechnet werden?', now(), now()),

('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),
('Versandkostenfreie Lieferung erlauben', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 43, 'Wollen Sie Versandkostenfreie Lieferungen erlauben?', now(), now()),
('Versandkostenfreie Lieferung über', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', 43, 'Versandkostenfreie Lieferung über dem hier eingegebenen Bestellwert.', now(), now()),
('Versandkostenfreie Lieferung für diese Bestellung erlauben', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 43, 'Versandkostenfreie Lieferung für Bestellungen erlauben, die zum hier eingestellten Ziel gesendet werden.', now(), now()),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_TAX_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),

('Steuerklasse für das Einlösen von Aktionskupons', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', 43, 'Diese Steuerklasse beim Einlösen von Aktionskupons verwenden', now(), now()),
('Inklusive Steuern', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 43, 'Steuern in die Berechnung inkludieren', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),
('Inklusive Versandkosten', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 43, 'Versandkosten in die Berechnung inkludieren', now(), now()),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 43, '', now(), now()),
('Steuern neu berechnen', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 43, 'Steuern neu berechnen', now(), now()),
('Admin Demostatus', 'ADMIN_DEMO', 43, 'Soll die Admin Demofunktion aktiviert werden?<br />0= nein 1= ja', now(), now()),

('Artikeloptionstyp: Auswahltyp', 'PRODUCTS_OPTIONS_TYPE_SELECT', 43, 'Die Zahl repräsentiert den Auswahltyp der Artikeloptionen', now(), now()),
('Artikeloptionstyp: Text', 'PRODUCTS_OPTIONS_TYPE_TEXT', 43, 'Numerischer Wert des Textes des Artikeloptionstyps', now(), now()),
('Artikeloptionstyp: Radio Button', 'PRODUCTS_OPTIONS_TYPE_RADIO', 43, 'Numerischer Wert des Radio Buttons des Artikeloptionstyps', now(), now()),
('Artikeloptionstyp: Check Box', 'PRODUCTS_OPTIONS_TYPE_CHECKBOX', 43, 'Numerischer Wert der Check Box des Artikeloptionstyps', now(), now()),
('Artikeloptionstyp: Datei', 'PRODUCTS_OPTIONS_TYPE_FILE', 43, 'Numerischer Wert der Datei des Artikeloptionstyps', now(), now()),
('ID für Text und Datei des Artikeloption Wertes', 'PRODUCTS_OPTIONS_VALUES_TEXT_ID', 43, 'Numerischer Wert der Artikeloptionswert ID (products_options_values_id), die vom Text- und Dateiattribute verwendet wird', now(), now()),
('Upload Präfix', 'UPLOAD_PREFIX', 43, 'Präfix zu Unterscheidung zwischen Uploadoptionen und anderen Optionen', now(), now()),
('Text Präfix', 'TEXT_PREFIX', 43, 'Präfix zu Unterscheidung zwischen Textoptionen und anderen Optionen', now(), now()),
('Artikeloptionstyp: Nur lesen', 'PRODUCTS_OPTIONS_TYPE_READONLY', 43, 'Numerischer Wert des Status der Datei des Artikeloptionstyps', now(), now()),

# Adminmenü ID 18
('Artikelbeschreibung: Sortierung der Artikelattribute', 'PRODUCTS_OPTIONS_SORT_BY_PRICE', 43, 'Wie soll die Sortierung der Artikelattribute in der Artikelbeschreibung angezeigt werden?<br>0= Sortierung, Preis<br>1= Sortierung, Attributeigenschaften', now(), now()),
('Artikelbeschreibung: Sortierung der Artikeloptionen', 'PRODUCTS_OPTIONS_SORT_ORDER', 43, 'Wie soll die Sortierung der Artikeloptionen in der Artikelbeschreibung angezeigt werden?<br>0= Sortierung, Attributnamen<br>1= Attributnamen', now(), now()),
('Artikelbeschreibung: Namen des Attributmerkmales unter dem Attributbild anzeigen', 'PRODUCT_IMAGES_ATTRIBUTES_NAMES', 43, 'Soll der Name des Attributmerkmales unter dem Attributbild angezeigt werden?<br />0= nein 1= ja', now(), now()),
('Artikelbeschreibung: Anzeigen der Differenz der Preisreduktion ("sie sparen...")', 'SHOW_SALE_DISCOUNT_STATUS', 43, 'Soll die Differenz der Preisreduktion ("sie sparen...) angezeigt werden?<br />0= nein 1= ja', now(), now()),
('Artikelbeschreibung: Anzeige der Preisreduktion in Währung oder Prozent', 'SHOW_SALE_DISCOUNT', 43, 'Zeige den Preisreduktion an in:<br />1= %<br />2= Betrag', now(), now()),
('Artikelbeschreibung: Dezimalstellen bei Anzeige der Preisreduktion in Prozent', 'SHOW_SALE_DISCOUNT_DECIMALS', 43, 'Wieviel Dezimalstellen sollen bei Anzeige der Preisreduktion in Prozent dargestellt werden?<br />Standard= 0', now(), now()),
('Artikelbeschreibung: Kostenlose Artikel als Bild oder Text darstellen', 'OTHER_IMAGE_PRICE_IS_FREE_ON', 43, 'Soll "Artikel ist kostenlos" als Bild oder Text dargestellt werden?<br />0= Text<br />1= Bild', now(), now()),
('Artikelbeschreibung: "für Preis bitte anrufen" als Bild oder Text darstellen', 'PRODUCTS_PRICE_IS_CALL_IMAGE_ON', 43, 'Soll "für Preis bitte anrufen" als Bild oder Text dargestellt werden?<br />0= Text<br />1= Bild', now(), now()),
('Artikelanzahl: Bei neuen Artikel aktiviert', 'PRODUCTS_QTY_BOX_STATUS', 43, 'Wie soll die Box der Artikelanzahl für den Warenkorb bei neuen Artikel standardmässig eingestellt sein?<br /><br />0= aus<br />1= ein<br /><br />Hinweis:<br />EIN<br />Diese Option zeigt eine Box, die dem Kunden die Möglichkeit zur Eingabe der Artikelanzahl im Warenkorb anzeigt<br />AUS<br />Die Artikelanzahl wird auf nur "1" gesetzt, ohne der Möglichkeit zur Ã„ndern nderung der Artikelanzahl im Warenkorb', now(), now()),
('Artikelbewertungen benötigen Überprüfung', 'REVIEWS_APPROVAL', 43, 'Sollen Artikelbewertungen erst nach einer Überprüfung freigegeben werden?<br /><br />HINWEIS: Wenn der Bewertungsstatus deaktiviert ist, wird diese Option nicht aktiv<br /><br />0= nein 1= ja', now(), now()),
('Meta Tags: Artikelnummer im Titel integrieren', 'META_TAG_INCLUDE_MODEL', 43, 'Soll die Artikelnummer im Meta Tag Titel integriert werden?<br /><br />0= nein 1= ja', now(), now()),
('Meta Tags: Artikelpreis im Titel integrieren', 'META_TAG_INCLUDE_PRICE', 43, 'Sollen der Artikelpreis im Meta Tag Titel integriert werden?<br /><br />0= nein 1= ja', now(), now()),
('Max. Anzahl Wörter für Metatag "description"', 'MAX_META_TAG_DESCRIPTION_LENGTH', 43, 'Max. Anzahl Wörter für description Metatag. Default 50:', now(), now()),
('Artikelbeschreibung: Anzahl empfohlener Artikel pro Zeile ', 'SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS', 43, 'Anzahl empfohlener Artikel die pro Zeile angezeigt werden sollen', now(), now()),
('"Vorheriger - Nächster" Navigation: Position der Navigationsleite', 'PRODUCT_INFO_PREVIOUS_NEXT', 43, 'Geben Sie hier an, wo die "Vorheriger - Nächster" Navigation angezeigt werden soll<br />0= nicht anzeigen<br />1= oben auf der Seite anzeigen<br />2= unten auf der Seite anzeigen<br />3= oben und unten auf der Seite anzeigen', now(), now()),
('"Vorheriger - Nächster" Navigation: Sortierung der Artikel', 'PRODUCT_INFO_PREVIOUS_NEXT_SORT', 43, 'Geben Sie hier an, wie die Artikel in der "Vorheriger - Nächster" Navigation sortiert werden sollen<br />0= Artikel ID<br />1= Artikelname<br />2= Artikelnummer<br />3= Preis, Artikelname<br />4= Preis, Artikelnummer<br />5= Artikelname, Artikelnummer<br />6= ArtikelSortierung', now(), now()),
('"Vorheriger - Nächster" Navigation: Button und Artikelbilder', 'SHOW_PREVIOUS_NEXT_STATUS', 43, 'Sollen Buttons und Artikelbilder angezeigt werden?<br />0= nein<br />1= ja', now(), now()),
('"Vorheriger - Nächster" Navigation: Button und Artikelbilder - Einstellungen', 'SHOW_PREVIOUS_NEXT_IMAGES', 43, 'Wie sollen Buttons und Artikelbilder angezeigt werden?<br />0= nur Buttons<br />1= Buttons und Artikelbilder<br />2= nur Artikelbilder', now(), now()),
('"Vorheriger - Nächster" Navigation: Breite der Bilder', 'PREVIOUS_NEXT_IMAGE_WIDTH', 43, 'Geben Sie die Breite der Artikelbilder (in Pixel) an', now(), now()),
('"Vorheriger - Nächster" Navigation: Höhe der Bilder', 'PREVIOUS_NEXT_IMAGE_HEIGHT', 43, 'Geben Sie die Höhe der Artikelbilder (in Pixel) an', now(), now()),
('"Vorheriger - Nächster" Navigation: Kategorien anzeigen', 'PRODUCT_INFO_CATEGORIES', 43, 'Wie sollen Artikelkategorien, Kategoriebilder und Kategorienamen oberhalb der "Vorheriger - Nächster" Navigation angezeigt werden?<br />0= nicht anzeigen<br />1= Linksausrichtung<br />2= Zentriert<br />3= Rechtsausrichtung', now(), now()),
('"Vorheriger - Nächster" Navigation: Kategoriebezeichnung und -Bild anzeigen', 'PRODUCT_INFO_CATEGORIES_IMAGE_STATUS', 43, 'Wie sollen Kategoriename und Kategoriebild angezeigt werden?<br />0= Kategoriename und -Bild immer anzeigen<br />1= Nur Kategoriename<br />2= Kategoriename und -Bild falls vorhanden', now(), now()),

# Adminmenü ID 19
('Spaltenbreite: Linke Boxen', 'BOX_WIDTH_LEFT', 43, 'Die Breite der linken Boxen<br />"px" kann mit angegeben werden<br /><br />Standard = 150px', now(), now()),
('Spaltenbreite: Rechte Boxen', 'BOX_WIDTH_RIGHT', 43, 'Die Breite der rechten Boxen<br />"px" kann mit angegeben werden<br /><br />Standard = 150px', now(), now()),
('"Brotkrümel" Navigation (Bread Crumbs): Separator', 'BREAD_CRUMBS_SEPARATOR', 43, 'Geben Sie hier das Symbol für den Separator für die sog. Brotkrümel Navigation ein<br />HINWEIS: Leerzeichen müssen mit "& " angegeben.<br />Standard = & ::& ', now(), now()),
('"Brotkrümel" Navigationpfad anzeigen', 'DEFINE_BREADCRUMB_STATUS', 43, 'Soll ein Navigationspfad angezeigt werden?<br />0= AUS<br />1= EIN<br/>2= EIN aber nicht auf der Startseite', now(), now()),
('Bestseller: Einrücken der Zahlen', 'BEST_SELLERS_FILLER', 43, 'Wie wollen Sie die Zahlen für Bestseller einrücken?<br />Standard = & ', now(), now()),
('Bestseller: Artikelnamen kürzen', 'BEST_SELLERS_TRUNCATE', 43, 'Ab wie vielen Zeichen sollen Artikelnamen gekürzt werden?<br />Standard = 35', now(), now()),
('Bestseller: Kürze Artikelnamen ab dem folgenden...', 'BEST_SELLERS_TRUNCATE_MORE', 43, 'Artikelnamen werden gekürzt, gefolgt von...<br />Standard = true', now(), now()),
('Kategoriebox: Link für Sonderangebote anzeigen', 'SHOW_CATEGORIES_BOX_SPECIALS', 43, 'Soll der Link "Sonderangebote" in der Kategoriebox angezeigt werden?', now(), now()),
('Kategoriebox: Link für Neue Artikel anzeigen', 'SHOW_CATEGORIES_BOX_PRODUCTS_NEW', 43, 'Soll der Link "Neue Artikel" in der Kategoriebox angezeigt werden?', now(), now()),
('Warenkorb anzeigen', 'SHOW_SHOPPING_CART_BOX_STATUS', 43, 'Wie soll der Warenkorb angezeigt werden?<br />0= Immer<br />1= Nur wenn Artikel im Warenkorb sind<br />2= Nur wenn Artikel im Warenkorb sind und der Warenkorb angesehen wird', now(), now()),
('Kategorie Box - Zeige Link für "Empfohlene Artikel"', 'SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS', 43, 'Soll der Link "Empfohlene Artikel" in der Kategoriebox angezeigt werden?', now(), now()),
('Kategorie Box - Zeige Link für "Alle Artikel"', 'SHOW_CATEGORIES_BOX_PRODUCTS_ALL', 43, 'Soll der Link "Alle Artikel" in der Kategoriebox angezeigt werden?', now(), now()),
('Linke Spaltenansicht - Global', 'COLUMN_LEFT_STATUS', 43, 'Linke Spalte anzeigen?<br />0= Linke Spalte immer aus<br />1= Linke Spalte immer ein', now(), now()),
('Rechte Spaltenansicht - Global', 'COLUMN_RIGHT_STATUS', 43, 'Rechte Spalte anzeigen?<br />0= Rechte Spalte immer aus<br />1= Rechte Spalte immer ein', now(), now()),
('Spaltenbreite: Linke Spalte', 'COLUMN_WIDTH_LEFT', 43, 'Die Breite der linken Spalte<br />"px" kann mit angegeben werden<br />Standard = 150px', now(), now()),
('Spaltenbreite: Rechte Spalte', 'COLUMN_WIDTH_RIGHT', 43, 'Die Breite der rechten Spalte<br />"px" kann mit angegeben werden<br />Standard = 150px', now(), now()),
('Kategorien: Separator zwischen Kategorien und Links', 'SHOW_CATEGORIES_SEPARATOR_LINK', 43, 'Soll ein Separator zwischen Kategorien und Links angezeigt werden?<br />0= nein<br />1= ja', now(), now()),
('Kategorien: Trennzeichen zwischen Kategorienamen und -zähler', 'CATEGORIES_SEPARATOR', 43, 'Welches Trennzeichen soll zwischen Kategorienamen und -zähler verwendet werden?<br />Standard = -&gt;', now(), now()),
('Kategorien: Separator zwischen Kategorienamen und Unterkategorien', 'CATEGORIES_SEPARATOR_SUBS', 43, 'Welcher Separator soll zwischen Kategorienamen und Unterkategorien verwendet werden?<br />Standard = |_& ', now(), now()),
('Kategoriezähler Präfix', 'CATEGORIES_COUNT_PREFIX', 43, 'Welches Symbol wollen Sie für den Prefix für Kategoriezähler verwenden?<br />Standard= (', now(), now()),
('Kategoriezähler Suffix', 'CATEGORIES_COUNT_SUFFIX', 43, 'Welches Symbol wollen Sie für den Suffix für Kategoriezähler verwenden?<br />Standard= )', now(), now()),
('Unterkategorie einrücken mit', 'CATEGORIES_SUBCATEGORIES_INDENT', 43, 'Wie sollen Unterkategorien eingerückt werden?<br />Standard= & & ', now(), now()),
('Kategoriezähler für Kategorien mit 0 Artikel anzeigen', 'CATEGORIES_COUNT_ZERO', 43, 'Sollen Kategoriezähler für Kategorien, die keine Artikel enthalten, angezeigt werden?<br />0= nein<br />1= ja', now(), now()),
('Kategoriebox teilen', 'CATEGORIES_SPLIT_DISPLAY', 43, 'Soll die Kategoriebox nach Artikeltyp aufgeteilt werden?', now(), now()),
('Warenkorb: Summe anzeigen', 'SHOW_TOTALS_IN_CART', 43, 'Soll die Summe unter dem Warenkorb angezeigt werden?<br />0= nein<br />1= ja, Summe Artikel - Gewicht - Betrag<br />2= ja, Summe Artikel - Gewicht - Betrag, keine Anzeige des Gewichts, wenn dieses 0 ist<br />3= ja, Summe Artikel - Betrag', now(), now()),
('Willkommenstext auf Startseite zeigen?', 'SHOW_CUSTOMER_GREETING', 43, 'Willkommenstext auf Startseite zeigen?<br />0= AUS<br />1= EIN', now(), now()),
('Kategorien: Immer auf der Startseite anzeigen', 'SHOW_CATEGORIES_ALWAYS', 43, 'Sollen Top Level Kategorien immer auf der Startseite angezeigt werden?<br />0= nein<br />1= ja<br />Die Standardkategorie kann als "Top Level Kategorie" gesetzt sein oder eine bestimmte "Top Level Kategorie" sein', now(), now()),
('Startseite eröffnet mit Kategorien', 'CATEGORIES_START_MAIN', 43, '0= Top Level Kategorien<br />oder geben Sie eine Kategorie ID# ein<br />HINWEIS: Unterkategorien können ebenso verwendet werden. Beispiel: 3_10', now(), now()),
('Unterkategorien anzeigen?', 'SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS', 43, 'Sollen Unterkategorien im Navigationsmenü angezeigt werden, wenn die Hauptkategorie selektiert ist?<br/>0=AUS<br/>1=EIN', now(), now()),
('Bannergruppen: Überschrift Position 1', 'SHOW_BANNERS_GROUP_SET1', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Überschrift 1 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Überschrift Position 3', 'SHOW_BANNERS_GROUP_SET3', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Überschrift 3 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Überschrift Position 2', 'SHOW_BANNERS_GROUP_SET2', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Überschrift 2 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Fusszeile Position 1', 'SHOW_BANNERS_GROUP_SET4', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Fusszeile 1 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Fusszeile Position 2', 'SHOW_BANNERS_GROUP_SET5', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Fusszeile 2 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Fusszeile Position 3', 'SHOW_BANNERS_GROUP_SET6', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Standard Bannergruppe = Wide-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Fusszeile 3 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Sidebox banner_box', 'SHOW_BANNERS_GROUP_SET7', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br />Standard Bannergruppe = SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Sidebox - banner_box verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Sidebox banner_box2', 'SHOW_BANNERS_GROUP_SET8', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br />Standard Bannergruppe = SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Sidebox - banner_box2 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Banner Anzeigengruppe - Sidebox banner_box_all', 'SHOW_BANNERS_GROUP_SET_ALL', 43, 'Welche Banneranzeigengruppe soll in der Sidebox "banner_box_all" angezeigt werden? für keine Gruppe Feld leer lassen!', now(), now()),
('IP Adresse in der Fusszeile anzeigen', 'SHOW_FOOTER_IP', 43, 'Soll die IP Adresse des Kunden in der Fusszeile angezeigt werden?<br />0= nein<br />1= ja', now(), now()),
('Mengenrabatt: Anzahl leerer Rabatte', 'DISCOUNT_QTY_ADD', 43, 'Wieviele leere Mengenrabatte sollen bei der Artikel Bepreisung hinzugefügt werden?', now(), now()),
('Mengenrabatt: Anzahl Ansicht pro Reihe', 'DISCOUNT_QUANTITY_PRICES_COLUMN', 43, 'Wieviele Mengenrabatte sollen pro Reihe angezeigt werden?', now(), now()),
('Kategorie/Artikel Sortierung', 'CATEGORIES_PRODUCTS_SORT_ORDER', 43, 'Kategorie/Artikel Sortierung<br/><br/>0= Kategorie/Artikel Sortierung/Name<br/>1= Kategorie/Artikel Name<br/>2= Artikelnummer<br/>3= Artikelmenge aufsteigend, Artikelname<br/>4= Artikelmenge abteigend, Artikelname<br/>5= Artikelpreis aufsteigend, Artikelname<br/>6= Artikelpreis absteigend, Artikelname<br/>', now(), now()),
('Globale Attributfunktionen - Hinzufügen, Kopieren und Löschen   ', 'OPTION_NAMES_VALUES_GLOBAL_STATUS', 43, 'Globale Attributfunktionen (Attributname und Attributmerkmale) - Hinzufügen, Kopieren und Löschen<br/><br/>0= nicht Verfügbar<br/>1= Verfügbar<br/>2= Artikelnummer', now(), now()),
('Kategorie-Tabs Menü EIN/AUS', 'CATEGORIES_TABS_STATUS', 43, 'Kategorie-Tabs<br />Zeigt die Toplevel Kategorien unterhalb des Banners an. <br />0= Kategorie Tabs AUS<br />1= Kategorie Tabs EIN', now(), now()),
('Sitemap - Link für "Mein Konto" inkludieren', 'SHOW_ACCOUNT_LINKS_ON_SITE_MAP', 43, 'Soll der Link für "Mein Konto" in der Sitemap inkludiert werden?<br /><br />Standard: false', now(), now()),
('Überspringe Kategorien mit einem Artikel', 'SKIP_SINGLE_PRODUCT_CATEGORIES', 43, 'Überspringe Kategorien mit einem Artikel<br />Wenn true dann wird bei Klick auf die Kategorie gleich direkt die Artikelansicht angezeigt.<br />Standard: True', now(), now()),
('Anmeldeseite geteilt anzeigen', 'USE_SPLIT_LOGIN_MODE', 43, 'Die Anmeldeseite kann in zwei Varianten angezeigt werden: Geteilt oder vertikal.<br />Die geteilte Variante zeigt neben der Felder für die Anmeldung einen Text und einen "Neues Konto erstellen" Button, der auf die Seite zur <em>Kontoerstellung</em> weiterleitet. In der vertikalen Variante werden alle Felder zur Kontoerstellung unterhalb der Felder für die Anmeldung angezeigt.<br />Standard: False', now(), now()),
('CSS Schaltflächen im Frontend', 'IMAGE_USE_CSS_BUTTONS', 43, 'CSS Schaltflächen im Frontend<br />CSS Schaltflächen anstelle von Bildbuttons im Shop verwenden (GIF/JPG)?<br />CSS Schaltflächen-Stile müssen in den Stylesheets definiert werden.', now(), now()),
('CSS Schaltflächen im Admin', 'ADMIN_USE_CSS_BUTTONS', 43, 'CSS Schaltflächen im Admin<br />CSS Schaltflächen anstelle von Bildbuttons in der Shopadministration verwenden?', now(), now()),



# Adminmenü ID 20
('<strong>Wegen Shopwartung geschlossen:</strong>', 'DOWN_FOR_MAINTENANCE', 43, 'Wegen Shopwartung geschlossen <br>(true=ein false=aus)', now(), now()),
('Wegen Shopwartung geschlossen: Dateiname', 'DOWN_FOR_MAINTENANCE_FILENAME', 43, 'Welcher Dateinamen soll für den Status "Wegen Shopwartung geschlossen" verwendet werden?<br />HINWEIS: Bitte den Dateinamen ohne Dateierweiterung angeben<br />Standard= down_for_maintenance', now(), now()),
('Wegen Shopwartung geschlossen: Header ausblenden', 'DOWN_FOR_MAINTENANCE_HEADER_OFF', 43, 'Wegen Shopwartung geschlossen: Header ausblenden<br>(true= ausblenden<br />false= anzeigen)', now(), now()),
('Wegen Shopwartung geschlossen: Linke Spalte ausblenden', 'DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF', 43, 'Wegen Shopwartung geschlossen: Linke Spalte ausblenden<br>(true= ausblenden<br />false= anzeigen)', now(), now()),
('Wegen Shopwartung geschlossen: Rechte Spalte ausblenden', 'DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF', 43, 'Wegen Shopwartung geschlossen: Rechte Spalte ausblenden<br>(true= ausblenden<br />false= anzeigen)', now(), now()),
('Wegen Shopwartung geschlossen: Fusszeile ausblenden', 'DOWN_FOR_MAINTENANCE_FOOTER_OFF', 43, 'Wegen Shopwartung geschlossen: Fusszeile ausblenden<br>(true= ausblenden<br />false= anzeigen)', now(), now()),
('Wegen Shopwartung geschlossen: Preise ausblenden', 'DOWN_FOR_MAINTENANCE_PRICES_OFF', 43, 'Wegen Shopwartung geschlossen: Preise ausblenden<br>(true= ausblenden<br />false= anzeigen)', now(), now()),
('Wegen Shopwartung geschlossen: diese IP-Adresse(n) ausschliessen', 'EXCLUDE_ADMIN_IP_FOR_MAINTENANCE', 43, 'Diese IP Adresse(n) hat während der Shopwartung vollen Zugriff auf den Shop (z.B. Webmaster)<br />Bei Eingabe mehrerer IP Adressen werden diese mit einem Komma getrennt.<br /><br />TIP: Wenn Sie Ihre IP Adresse nicht kennen, finden Sie diese in der Fusszeile des Shops.', now(), now()),
('Ihre Besucher vor Beginn der Shopwartung informieren:', 'WARN_BEFORE_DOWN_FOR_MAINTENANCE', 43, 'Veröffentlicht eine bestimmte Zeit vor der Shopwartung einen Hinweis, wann die Shopwartung starten wird<br>(true=ein false=aus)<br>IWenn Sie die Option ''Wegen Shopwartung geschlossen'' auf "true" setzen,wird diese Option automatisch auf "false" gesetzt.', now(), now()),
('Datum und Stunden für Hinweis vor Beginn der Shopwartung', 'PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', 43, 'Datum und Stunden für den Hinweis vor der Shopwartung, geben Sie Datum und Stunden für die Zeit der Shopwartung ein', now(), now()),
('Anzeigen, wann mit der Shopwartung begonnen wurde', 'DISPLAY_MAINTENANCE_TIME', 43, 'Zeigt an, wann mit der Shopwartung begonnen wurde<br>(true=ein false=aus)<br />', now(), now()),
('Dauer der Shopwartung anzeigen', 'DISPLAY_MAINTENANCE_PERIOD', 43, 'Zeigt die Dauer der Shopwartung an<br>(true=ein false=aus)<br />', now(), now()),
('Dauer der Shopwartung', 'TEXT_MAINTENANCE_PERIOD_TIME', 43, 'Geben Sie die Dauer der Shopwartung an (hh:mm)', now(), now()),

# Adminmenü ID 11
('AGB Bestätigungsfeld bei der Bestellung anzeigen', 'DISPLAY_CONDITIONS_ON_CHECKOUT', 43, 'Den Kunden wird während der Bestellung das AGB Bestätigungsfeld angezeigt und sie müssen den AGB zustimmen.', now(), now()),
('Datenschutzbestimmungen Bestätigungsfeld bei der Kontoerstellung anzeigen', 'DISPLAY_PRIVACY_CONDITIONS', 43, 'Den Kunden wird während der Kontoerstellung das Datenschutzbestimmungen Bestätigungsfeld angezeigt und sie müssen den Datenschutzbestimmungen zustimmen.', now(), now()),
('Checkbox für Widerrufsrecht bei digitalen Downloads', 'DISPLAY_WIDERRUF_DOWNLOADS_ON_CHECKOUT_CONFIRMATION', 43, 'Wollen Sie auf der Bestellbestätigungsseite eine zusätzliche Checkbox für das Widerrufsrecht bei digitalen Downloads anzeigen? Der Kunde muss dann explizit zustimmen, dass sein Widerrufsrecht erlischt.<br/>Nur aktivieren, falls Sie digitale Downloads verkaufen!', now(), now()),

# Adminmenü ID 21
('Bild anzeigen', 'PRODUCT_NEW_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('stückzahl anzeigen', 'PRODUCT_NEW_LIST_QUANTITY', 43, 'Wollen Sie die Artikelstückzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"jetzt kaufen" - Button anzeigen', 'PRODUCT_NEW_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelname anzeigen', 'PRODUCT_NEW_LIST_NAME', 43, 'Wollen Sie den Artikelnamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_NEW_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Herstellernamen anzeigen', 'PRODUCT_NEW_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Preis anzeigen', 'PRODUCT_NEW_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Gewicht anzeigen', 'PRODUCT_NEW_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Hinzufügt am" anzeigen', 'PRODUCT_NEW_LIST_DATE_ADDED', 43, 'Wollen Sie "Hinzugefügt am" in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_NEW_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', now(), now()),
('Standardsortierung', 'PRODUCT_NEW_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzufügedatum, absteigend<br />7= nach Hinzufügedatum, aufsteigend<br />8= nach ArtikelSortierung', now(), now()),
('Gruppen ID für "neue Artikel"', 'PRODUCT_NEW_LIST_GROUP_ID', 43, 'WARNUNG: Ã„ndern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 21 geändert wurde<br />Wie lautet die configuration_group_id für die "neue Artikel" Liste?', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br/><br/>0= NEIN<br/>1= Oben<br/>2= Unten<br/>3= Oben und Unten', now(), now()),
('Artikelankündigungen als Neue Artikel anzeigen', 'SHOW_NEW_PRODUCTS_UPCOMING_MASKED', 43, 'Sollen Artikelankündigungen in Artikellisten, Seitenboxen und Centerboxen als neue Artikel angezeigt werden?<br />0= Nein<br />1= Ja', now(), now()),

# Adminmenü ID 22
('Bild anzeigen', 'PRODUCT_FEATURED_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Stückzahl anzeigen', 'PRODUCT_FEATURED_LIST_QUANTITY', 43, 'Wollen Sie die Artikelstückzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"jetzt kaufen" - Button anzeigen', 'PRODUCT_FEATURED_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelname anzeigen', 'PRODUCT_FEATURED_LIST_NAME', 43, 'Wollen Sie den Artikelnamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_FEATURED_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Herstellernamen anzeigen', 'PRODUCT_FEATURED_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Preis anzeigen', 'PRODUCT_FEATURED_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Gewicht anzeigen', 'PRODUCT_FEATURED_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Hinzufügt am" anzeigen', 'PRODUCT_FEATURED_LIST_DATE_ADDED', 43, 'Wollen Sie d"Hinzugefügt am" in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_FEATURED_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', now(), now()),
('Standardsortierung', 'PRODUCT_FEATURED_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzufügedatum, absteigend<br />7= nach Hinzufügedatum, aufsteigend<br />8= nach ArtikelSortierung', now(), now()),
('Gruppen ID für "Empfohlene Artikel"', 'PRODUCT_FEATURED_LIST_GROUP_ID', 43, 'WARNUNG: Ã„ndern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 22 geändert wurde<br />Wie lautet die configuration_group_id für die "Empfohlenen Artikel" Liste?', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br/><br/>0= NEIN<br/>1= Oben<br/>2= Unten<br/>3= Oben und Unten', now(), now()),

# Adminmenü ID 23
('Bild anzeigen', 'PRODUCT_ALL_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('stückzahl anzeigen', 'PRODUCT_ALL_LIST_QUANTITY', 43, 'Wollen Sie stückzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"jetzt kaufen" - Button anzeigen', 'PRODUCT_ALL_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelname anzeigen', 'PRODUCT_ALL_LIST_NAME', 43, 'Wollen Sie den Artikelname in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_ALL_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Herstellernamen anzeigen', 'PRODUCT_ALL_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Preis anzeigen', 'PRODUCT_ALL_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Gewicht anzeigen', 'PRODUCT_ALL_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Hinzugefügt am" Datum anzeigen', 'PRODUCT_ALL_LIST_DATE_ADDED', 43, 'Wollen Sie das "Hinzugefügt am" Datum in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_ALL_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', now(), now()),
('Standardsortierung', 'PRODUCT_ALL_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzufügedatum, absteigend<br />7= nach Hinzufügedatum, aufsteigend<br />8= nach ArtikelSortierung', now(), now()),
('Gruppen ID für "Alle Artikel"', 'PRODUCT_ALL_LIST_GROUP_ID', 43, 'WARNUNG: Ã„ndern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 23 geändert wurde<br />Wie lautet die configuration_group_id für die "Alle Artikel" Liste?', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br/><br/>0= NEIN<br/>1= Oben<br/>2= Unten<br/>3= Oben und Unten', now(), now()),

# Adminmenü ID 24
('Startseite: Neue Artikel anzeigen', 'SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS', 43, 'Sollen neue Artikel auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Startseite: Empfohlene Artikel anzeigen', 'SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS', 43, 'Sollen Empfohlene Artikel auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Startseite: Sonderangebote anzeigen', 'SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS', 43, 'Sollen Sonderangebote auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Startseite: Artikelankündigungen anzeigen', 'SHOW_PRODUCT_INFO_MAIN_UPCOMING', 43, 'Sollen kommende Artikel auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Kategorien mit Unterkategorien: "Neue Artikel" anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS', 43, 'Sollen neue Artikel in Kategorien mit Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Kategorien mit Unterkategorien: "Empfohlene Artikel" anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS', 43, 'Sollen empfohlene Artikel in Kategorien mit Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierunge fest)', now(), now()),
('Kategorien mit Unterkategorien: "Sonderangebote" anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS', 43, 'Sollen Sonderangebote in Kategorien mit Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Kategorien mit Unterkategorien: "Artikelankündigungen" anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_UPCOMING', 43, 'Sollen kommende Artikel in Kategorien mit Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Fehlerseiten: "Neue Artikel" anzeigen', 'SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS', 43, 'Sollen neue Artikel auf Fehlerseiten angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Fehlerseiten: "Empfohlene Artikel" anzeigen', 'SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS', 43, 'Sollen empfohlene Artikel auf Fehlerseiten angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Fehlerseiten: "Sonderangebote" anzeigen', 'SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS', 43, 'Sollen Sonderangebote auf Fehlerseiten angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Fehlerseiten: "Artikelankündigungen" anzeigen', 'SHOW_PRODUCT_INFO_MISSING_UPCOMING', 43, 'Sollen kommende Artikel auf Fehlerseiten angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Artikelliste: "Neue Artikel" anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS', 43, 'Neue Artikel unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Artikelliste: "Empfohlene Artikel" anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS', 43, 'Empfohlene Artikel unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Artikelliste: "Sonderangebote" anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS', 43, 'Sonderangebote unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Artikelliste: "Artikelankündigungen" anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING', 43, 'Artikelankündigungen unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Neue Artikel: Spalten pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS', 43, 'Wieviele Spalten wollen Sie pro Reihe anzeigen lassen?', now(), now()),
('Empfohlene Artikel: Spalten pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS', 43, 'Wieviele Spalten wollen Sie pro Reihe anzeigen lassen?', now(), now()),
('Sonderangebote: Spalten pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS', 43, 'Wieviele Spalten wollen Sie pro Reihe anzeigen lassen?', now(), now()),
('Artikelliste: Artikel in den Centerboxen filtern', 'SHOW_PRODUCT_INFO_ALL_PRODUCTS', 43, 'Filter für die Artikel in den Centerboxen "Neue Artikel", "Empfohlene Artikel", "Sonderangebot" und "Artikelankündigungen".<br><br>1= Filter ein. es werden nur Artikel aus der jeweiligen Hauptkategorie inkl. deren Unterkategorien angezeigt.<br>0= Filter aus, es werden Artikel aus allen Kategorien angezeigt.', now(), now()),

# Adminmenü ID 25
('Startseite', 'DEFINE_MAIN_PAGE_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_main_page.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Schreiben Sie uns', 'DEFINE_CONTACT_US_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_contact_us.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Datenschutz', 'DEFINE_PRIVACY_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_privacy.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Versandbedingungen', 'DEFINE_SHIPPINGINFO_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_shippinginfo.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('AGB', 'DEFINE_CONDITIONS_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_conditions.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Bestellung erfolgreich', 'DEFINE_CHECKOUT_SUCCESS_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_checkout_success.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Aktionskupons', 'DEFINE_DISCOUNT_COUPON_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_discount_coupon.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Sitemap', 'DEFINE_SITE_MAP_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_site_map.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('404 ERROR - Seite nicht gefunden', 'DEFINE_PAGE_NOT_FOUND_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_page_not_found.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Seite 2', 'DEFINE_PAGE_2_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_page_2.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Seite 3', 'DEFINE_PAGE_3_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_page_3.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Seite 4', 'DEFINE_PAGE_4_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_page_4.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Widerrufsrecht', 'DEFINE_WIDERRUFSRECHT_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_widerrufsrecht.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Impressum', 'DEFINE_IMPRESSUM_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_impressum.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Zahlungsarten', 'DEFINE_ZAHLUNGSARTEN_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_zahlungsarten.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),

# Adminmenü ID 30
('Kopfzeile anzeigen', 'EZPAGES_STATUS_HEADER', 43, 'Sollen die EZ-Pages Kopfzeilen global angezeigt werden?<br />0= NEIN<br />1= JA<br />2= JA (Nur Admin-IP: siehe Shopwartung)<br />Anmerkung: Seite kann nur von Admin gesehen werden', now(), now()),
('Fusszeile anzeigen', 'EZPAGES_STATUS_FOOTER', 43, 'Sollen die EZ-Pages Fusszeilen global angezeigt werden?<br />0= NEIN<br />1= JA<br />2= JA (Nur Admin-IP: siehe Shopwartung)<br />Anmerkung: Seite kann nur von Admin gesehen werden', now(), now()),
('Sidebox anzeigen', 'EZPAGES_STATUS_SIDEBOX', 43, 'Sollen die EZ-Pages Sidebox global angezeigt werden?<br />0= NEIN<br />1= JA<br />2= JA (Nur Admin-IP: siehe Shopwartung)<br />Anmerkung: Seite kann nur von Admin gesehen werden', now(), now()),
('Trennzeichen für Links in Kopfzeile', 'EZPAGES_SEPARATOR_HEADER', 43, 'Welche Trennzeichen sollen für Links in der EZ-Pages Kopfzeile angezeigt werden?<br />Standard = & ::& ', now(), now()),
('Trennzeichen für Links in Fusszeile', 'EZPAGES_SEPARATOR_FOOTER', 43, 'Welche Trennzeichen sollen für Links in der EZ-Pages Fusszeile angezeigt werden?<br />Standard = & ::& ', now(), now()),
('Vor/Zurück Schaltflächen', 'EZPAGES_SHOW_PREV_NEXT_BUTTONS', 43, 'Sollen Vor/Zurück Schaltflachen für EZ-Pages angezeigt werden?<br />0=NEIN (keine Schaltflächen)<br />1="Weiter"<br />2="Zurück/Weiter/Vor"<br /><br />Standard = 2', now(), now()),
('Inhaltsverzeichnis für Kapitel anzeigen', 'EZPAGES_SHOW_TABLE_CONTENTS', 43, 'Soll das EZ-Pages Inhaltsverzeichnis für Kapitel angezeigt werden?<br />0= NEIN<br />1= JA', now(), now()),
('In diesen Seiten keine Kopfzeile anzeigen', 'EZPAGES_DISABLE_HEADER_DISPLAY_LIST', 43, 'Geben Sie hier die "Seiten" der EZ-Pages an, in der keine Kopfzeile angezeigt werden sollen.<br />Seiten IDs durch Komma getrennt (ohne Leerzeichen) eingeben.<br />Seiten IDs können in der EZ-Pages Ansicht über <em>Admin->Tools->EZ-Pages</em> ermittelt werden.<br />z.B. 3,7<br />oder leer lassen.', now(), now()),
('In diesen Seiten keine Fusszeile anzeigen', 'EZPAGES_DISABLE_FOOTER_DISPLAY_LIST', 43, 'Geben Sie hier die "Seiten" der EZ-Pages an, in der keine Fusszeile angezeigt werden sollen.<br />Seiten IDs durch Komma getrennt (ohne Leerzeichen) eingeben.<br />Seiten IDs können in der EZ-Pages Ansicht über <em>Admin->Tools->EZ-Pages</em> ermittelt werden.<br />z.B. 3,7<br />oder leer lassen.', now(), now()),
('In diesen Seiten keine linke Spalte anzeigen', 'EZPAGES_DISABLE_LEFTCOLUMN_DISPLAY_LIST', 43, 'Geben Sie hier die "Seiten" der EZ-Pages an, in der keine linken Spalten (der Sideboxen) angezeigt werden sollen.<br />Seiten IDs durch Komma getrennt (ohne Leerzeichen) eingeben.<br />Seiten IDs können in der EZ-Pages Ansicht über <em>Admin->Tools->EZ-Pages</em> ermittelt werden.<br />z.B. 3,7<br />oder leer lassen.', now(), now()),
('In diesen Seiten keine rechte Spalte anzeigen', 'EZPAGES_DISABLE_RIGHTCOLUMN_DISPLAY_LIST', 43, 'Geben Sie hier die "Seiten" der EZ-Pages an, in der keine rechten Spalten (der Sideboxen) angezeigt werden sollen.<br />Seiten IDs durch Komma getrennt (ohne Leerzeichen) eingeben.<br />Seiten IDs können in der EZ-Pages Ansicht über <em>Admin->Tools->EZ-Pages</em> ermittelt werden.<br />z.B. 3,7<br />oder leer lassen.', now(), now()),

# Adminmenü ID 31
('Minify für Javascripts aktivieren', 'MINIFY_STATUS_JS', 43, 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. Javascripts werden kombiniert und komprimiert. Wollen Sie Minify für Javascripts aktivieren?', now(), now()),
('Minify für Stylesheets aktivieren', 'MINIFY_STATUS_CSS', 43, 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. CSS Dateien werden kombiniert und komprimiert. Wollen Sie Minify für CSS Stylesheets aktivieren?', now(), now()),
('Maximale URL Länge', 'MINIFY_MAX_URL_LENGHT', 43, 'Auf manchen Servern ist die Länge von POST/GET URLs beschränkt. Falls das auf Ihren Server zutrifft, können Sie hier den Wert verändern. Voreingestellt: 500', now(), now()),
('Minify Cache Zeit', 'MINIFY_CACHE_TIME_LENGHT', 43, 'Stellen Sie hier die Cache Zeit für Minify ein. Voreingestellt ist ein Jahr (31536000)', now(), now()),
('zuletzt gecached', 'MINIFY_CACHE_TIME_LATEST', 43, 'Hier müssen Sie normalerweise nichts einstellen. Falls Sie gerade Ã„nderungen an Ihren CSS und Javascripts vorgenommen haben und erzwingen wollen, dass diese Ã„nderungen sofort wirksam sind, stellen Sie auf 0.', now(), now()),

# Adminmenü ID 32
('GA - Google Analytics aktivieren?', 'GOOGLE_ANALYTICS_ENABLED', 43, 'Wollen Sie Google Analytics aktivieren? <br/><br/>Enabled = Ja<br/>Disabled = Nein', now(), now()),
('GA - Analytics Account', 'GOOGLE_ANALYTICS_UACCT', 43, 'Google Analytics:<br/><br/>Die ID, die Sie von Google bei der Anmeldung zu Google Analytics bekommen haben.<br/>Format:<br/>UA-XXXXXX-X<br/><br/><b>Tragen Sie hier Ihre Analytics Account Nummer ein:</b>', now(), now()),
('GA - E-Commerce Tracking Zieladresse', 'GOOGLE_ANALYTICS_TARGET', 43, 'Google Analytics:<br/><br/>Diese Einstellung bezieht sich auf das Google E-Commerce Tracking und legt fest, ob sie die Auswertung auf Basis von Kundenadresse (customers), Rechnungsadresse (billing) oder Lieferadresse (delivery) haben wollen.<br/><br/><b>Welchen Adresstyp wollen Sie für die Aufzeichnung der Transaktionen verwenden?</b>', now(), now()),
('GA - Affiliate', 'GOOGLE_ANALYTICS_AFFILIATION', 43, 'Google Analytics:<br/><br/>Falls ein Affiliate vorhanden ist (z.B. ein zweiter Shop) hier eintragen. Bei dieser Einstellung geht es darum auszuwerten, von welchem Partnershop/Partnerseite der Kunde ursprünglich kam.<br/><br/><b>Tragen Sie hier den Affiliate ein:</b>', now(), now()),
('GA - SKU Code', 'GOOGLE_ANALYTICS_SKU_CODE', 43, 'Google Analytics:<br/><br/>Diese Einstellung bezieht sich auf das Google E-Commerce Tracking und legt fest, ob die Artikel ID oder die Artikelnummer in den Statistiken angezeigt werden soll.<br/><br/><b>Wählen Sie hier aus, was angezeigt werden soll: product_id = interne Zen-Cart Artikel ID<br/>products_model = eingegebene Artikelnummer</b>', now(), now()),
('GA - Conversion Tracking aktivieren?', 'GOOGLE_CONVERSION_ACTIVE', 43, 'Google Analytics:<br/><br/><b>WICHTIG:<br/>Diese Einstellung nur aktivieren, wenn auch das kostenpflichtige Google Adwords genutzt wird!</b><br/><br/>Durch Aktivieren wird der Google Conversion Tracking Code in die Checkout Success Seite eingefügt. Dadurch kann die Effektivität der Adwords Kampagne ausgewertet werden. Wenn Sie hier das Conversion Tracking aktivieren, müssen Sie in der nächsten Option Ihre Conversion Tracking Nummer einstellen.<br/><br/><b>Wollen Sie Google AdWords Conversion Tracking aktivieren?</b>', now(), now()),
('GA - Adwords Conversion Tracking Nummer', 'GOOGLE_CONVERSION_IDNUM', 43, 'Google Analytics:<br/><br/>Wenn Sie oben Conversion Tracking aktiviert haben, geben Sie hier Ihre Conversion Tracking ID anstelle der XXXXXXXXXXX ein. Sollten Sie hier keine Nummer eingeben, wird das Conversion Tracking nicht funktionieren.<br/><br/><b>Geben Sie hier Ihre AdWords Conversion Tracking ID ein:</b>', now(), now()),
('GA - Google Adwords Sprache', 'GOOGLE_CONVERSION_LANG', 43, 'Google Analytics:<br/><br/>Spracheinstellung für Google Adwords. Voreingestellt ist: Deutsch<br/><br/><b>Wählen Sie die gewünschte Sprache aus:</b>', now(), now()),
('GA - Art des Tracking Codes', 'GOOGLE_ANALYTICS_TRACKING_TYPE', 43, 'Google Analytics:<br/><br/>Welchen Tracking Code Typ wollen Sie verwenden? Voreingestellt ist der neueste universal Typ. Sie können das auf den veralteten ga.js oder auf den früher von Google angebotenen Asynchronous Typ umstellen. Besuchen Sie die <a href="http://code.google.com/apis/analytics/docs/tracking/home.html" target="_blank">Google Analytics Website</a> für genauere Informationen zu den verschiedenen Varianten<br/><br/><b>Wählen Sie Ihren Tracking Typ:</b>', now(), now()),
('GA - Benutzerdefinierten Tracking Code nach dem Hauptcode einfügen?', 'GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED', 43, 'Google Analytics:<br/><br/>Wollen Sie einen weiteren benutzerdefinierten Trackingcode nach dem normalen Google Analytics Hauptcode einfügen? Das kann genutzt werden, um den Code an Ihre ganz individuellen Erfordernisse anzupassen. Fügen Sie Tracking Objekte entsprechend der Dokumentation der <a href="http://code.google.com/apis/analytics/docs/tracking/gaTrackingCustomVariables.html" target="_blank">Google Analytics Website</a> ein.<br/><br/>Voreingestellt ist: Deaktiviert.', now(), now()),
('GA - Benutzerdefinierter Tracking Code', 'GOOGLE_ANALYTICS_CUSTOM_CODE', 43, 'Google Analytics:<br/><br/>Falls Sie benutzerdefinierten Tracking Code aktiviert haben, fügen Sie diesen hier ein:', now(), now()),
('GA - Demographie und Interessen', 'GOOGLE_ANALYTICS_DIR', 43, 'Google Analytics:<br/><br/>Reports fuer demographische Daten und Interessen aktivieren/deaktivieren', now(), now()),
('GA - Conversion Label', 'GOOGLE_CONVERSION_LABEL', 43, 'Google Analytics:<br/><br/>Geben Sie Ihr Google Conversion Label ein (kann in Adwords generiert werden oder Sie verwenden ein eigenes Label)', now(), now()),

# Adminmenü ID 33 - Facebook Open Graph / Microdata
('Open Graph - Facebook Open Graph aktivieren', 'FACEBOOK_OPEN_GRAPH_STATUS', 43, 'Wollen Sie die Facebook Open Graph Metadaten aktivieren?', now(), now()),
('Open Graph - Anwendungsnummer', 'FACEBOOK_OPEN_GRAPH_APPID', 43, 'Tragen Sie hier Ihre Anwendungsnummer / Application ID ein. Falls Sie noch keine haben:<br/><a href="http://developers.facebook.com/setup/" target="_blank">Application ID beantragen</a>', now(), now()),
('Open Graph - Anwendungs Geheimcode', 'FACEBOOK_OPEN_GRAPH_APPSECRET', 43, 'Tragen Sie Ihren Anwendungs Geheimcode / Application Secret Key ein.', now(), now()),
('Open Graph - Admin ID', 'FACEBOOK_OPEN_GRAPH_ADMINID', 43, 'Geben Sie die Admin ID(s) des oder der Facebook User an, die Ihre Facebook Fanseite administrieren. Wenn das mehrere sind, geben Sie die IDs mit Komma getrennt ein. Infos dazu:<br/><a href="http://www.facebook.com/insights/" target="_blank">Insights for your domain</a>', now(), now()),
('Open Graph - Standard Bild', 'FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE', 43, 'Geben Sie den vollen Pfad zu einem Standardbild an oder lassen Sie dieses Feld leer, um kein Standardbild zu verwenden. Ein hier eingestelltes Standardbild wird nur verwendet, wenn kein Artikelbild gefunden wird und stellt so sicher, dass zumindest ein passendes Bild bei Facebook gepostet wird.', now(), now()),
('Open Graph - Objekt Typ', 'FACEBOOK_OPEN_GRAPH_TYPE', 43, 'Geben Sie hier einen Open Graph Object Type für Ihre Artikel ein. Beispiel: product<br/>Infos dazu:<br/><a href="https://developers.facebook.com/docs/reference/opengraph/" target="_blank">Open Graph Object Types</a>', now(), now()),
('Open Graph - Kategoriepfad in den URLs?', 'FACEBOOK_OPEN_GRAPH_CPATH', 43, 'Sollen Ihre URLs für Facebook den cPath enthalten?', now(), now()),
('Open Graph - Sprache in den Links?', 'FACEBOOK_OPEN_GRAPH_LANGUAGE', 43, 'Sollen Ihre URLs das Anhängsel für die Sprache enthalten?', now(), now()),
('Open Graph - Kanonische URLs verwenden?', 'FACEBOOK_OPEN_GRAPH_CANONICAL', 43, 'Wollen Sie die kanonische URL der Seite verwenden (empfohlen) oder versuchen, die URL neu zu generieren?', now(), now()),
('Like Button - Facebook Like Button aktivieren?', 'FACEBOOK_LIKE_BUTTON_STATUS', 43, 'Wollen Sie den Facebook Like Button aktivieren?', now(), now()),
('Like Button - Einbindungsart', 'FACEBOOK_LIKE_BUTTON_METHOD', 43, 'iframe, HTML5 oder XBFML', now(), now()),
('Like Button - Ausrichtung', 'FACEBOOK_LIKE_BUTTON_ALIGNMENT', 43, 'Soll der Button links, rechts oder gar nicht floaten?', now(), now()),
('Like Button - Layout Stil', 'FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE', 43, 'Wählen Sie das Grundlayout für den Button: Standard, Button mit Counter oder Box mit Counter', now(), now()),
('Like Button - Profilfotos?', 'FACEBOOK_LIKE_BUTTON_SHOW_FACES', 43, 'Sollen Profilfotos unter dem Button angezeigt werden (Falls ja setzen Sie die Höhe auf 80 und mehr. Nur im Standardlayout möglich)', now(), now()),
('Like Button - Aktion', 'FACEBOOK_LIKE_BUTTON_ACTION', 43, 'Aktion für den Button: like oder recommend', now(), now()),
('Like Button - Schriftart', 'FACEBOOK_LIKE_BUTTON_FONT', 43, 'Wählen Sie eine Schriftart aus:', now(), now()),
('Like Button - Farbschema', 'FACEBOOK_LIKE_BUTTON_COLOR_SCHEME', 43, 'Farbschema light oder dark', now(), now()),
('Like Button - Breite', 'FACEBOOK_LIKE_BUTTON_WIDTH', 43, 'Breite des Like Buttons (Standard => 450; Button mit Counter => 90; Box mit Counter =>55)', now(), now()),
('Like Button - Senden und Liken kombinieren?', 'FACEBOOK_LIKE_BUTTON_SEND', 43, 'Soll der Button die Funktionen Send und Like kombinieren?', now(), now()),
('Open Graph - Google Publisher', 'FACEBOOK_OPEN_GRAPH_GOOGLE_PUBLISHER', 43, 'Tragen Sie den vollständigen Link zu Ihrer Google Publisher / Google Plus URL ein  (https://plus.google.com/+xxx/)', now(), now()),
('Open Graph - Shoplogo', 'FACEBOOK_OPEN_GRAPH_LOGO', 43, 'Tragen Sie den vollständigen Link zu Ihrem Shoplogo ein, das für die Microdaten verwendet werden soll. Das Bild sollte per https erreichbar sein!  (https://www.meinshop.de/shoplogo.png)', now(), now()),
('Open Graph - Adresse des Shops - Strasse', 'FACEBOOK_OPEN_GRAPH_STREET_ADDRESS', 43, 'Tragen Sie die Strasse Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - Stadt', 'FACEBOOK_OPEN_GRAPH_CITY', 43, 'Tragen Sie die Stadt Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - Bundesland', 'FACEBOOK_OPEN_GRAPH_STATE', 43, 'Tragen Sie das Bundesland Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - PLZ', 'FACEBOOK_OPEN_GRAPH_ZIP', 43, 'Tragen Sie die Postleitzahl Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - Land', 'FACEBOOK_OPEN_GRAPH_COUNTRY', 43, 'Tragen Sie das Land Ihres Shops ein. Zweistelliger Ländercode, z.B. DE', now(), now()),
('Open Graph - Emailadresse Kundensevice', 'FACEBOOK_OPEN_GRAPH_EMAIL', 43, 'Tragen Sie die Emailadresse Ihres Kundenservice ein.', now(), now()),
('Open Graph - Telefonnummer Kundenservice', 'FACEBOOK_OPEN_GRAPH_PHONE', 43, 'Tragen Sie die Telefonnummer Ihres Kundenservice ein.', now(), now()),
('Open Graph - Twitter User', 'FACEBOOK_OPEN_GRAPH_TWUSER', 43, 'Tragen Sie Ihren Twitter Usernamen ein mit @ davor.<br/>Bsp: @meintwitteruser.', now(), now()),
('Open Graph - Facebook Page', 'FACEBOOK_OPEN_GRAPH_FBPG', 43, 'Tragen Sie die volle URL zu Ihrer Facebook Page ein.<br/>Bsp: https://www.facebook.com/meinonlineshop', now(), now()),
('Open Graph - Sprache', 'FACEBOOK_OPEN_GRAPH_LOCALE', 43, 'Tragen Sie Ihre Hauptsprache ein.<br/>Voreinstellung: German', now(), now()),
('Open Graph - Währung', 'FACEBOOK_OPEN_GRAPH_CUR', 43, 'Tragen Sie Ihre Währung ein ein.<br/>Voreinstellung: EUR', now(), now()),
('Open Graph - Lieferzeit', 'FACEBOOK_OPEN_GRAPH_DTS', 43, 'Tragen Sie Ihre durchschnittliche Lieferzeit in Tagen ein.<br/>Bsp: 2', now(), now()),
('Open Graph - Zustand der Artikel', 'FACEBOOK_OPEN_GRAPH_COND', 43, 'Tragen Sie den Zustand Ihrer Artikel ein.<br/>Mögliche Werte: NewCondition, UsedCondition, RefurbishedCondition, DamagedCondition', now(), now()),
('Open Graph - Zahlungsart 1', 'FACEBOOK_OPEN_GRAPH_PAY1', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Zahlungsart 2', 'FACEBOOK_OPEN_GRAPH_PAY2', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Zahlungsart 3', 'FACEBOOK_OPEN_GRAPH_PAY3', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Zahlungsart 4', 'FACEBOOK_OPEN_GRAPH_PAY4', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Zahlungsart 5', 'FACEBOOK_OPEN_GRAPH_PAY5', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Zahlungsart 6', 'FACEBOOK_OPEN_GRAPH_PAY6', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Steuernummer', 'FACEBOOK_OPEN_GRAPH_TID', 43, 'Tragen Sie Ihre Steuernummer ein.', now(), now()),
('Open Graph - DUNS Nummer', 'FACEBOOK_OPEN_GRAPH_DUNS', 43, 'Tragen Sie Ihre Dun & Bradstreet DUNS Nummer ein.', now(), now()),
('Open Graph - Faxnummer', 'FACEBOOK_OPEN_GRAPH_FAX', 43, 'Tragen Sie Ihre Faxnummer ein.', now(), now()),
('Open Graph - UID', 'FACEBOOK_OPEN_GRAPH_VAT', 43, 'Tragen Sie Ihre UID ein.', now(), now()),
('Open Graph - Firmenname', 'FACEBOOK_OPEN_GRAPH_LEG', 43, 'Tragen Sie Ihren offiziellen Firmennamen ein.', now(), now()),
('Open Graph - Region', 'FACEBOOK_OPEN_GRAPH_AREA', 43, 'Optional. The geographical region served by the number, specified as a Schema.org/AdministrativeArea. Countries may be specified concisely using just their standard ISO-3166 two-letter code, as in the examples at right. If omitted, the number is assumed to be global..', now(), now()),
('Open Graph - Twitter Page', 'FACEBOOK_OPEN_GRAPH_TWIT', 43, 'Tragen Sie die vollständige URL zu Ihrer Twitter Seite ein.<br/>Beispiel: https://twitter.com/xxx', now(), now()),
('Open Graph - Linkedin Page', 'FACEBOOK_OPEN_GRAPH_LINK', 43, 'Tragen Sie die vollständige URL zu Ihrer LinkedIn Page ein.<br/>Beispiel: http://www.linkedin.com/company/xxx/.', now(), now()),
('Open Graph - Weitere Profil Page', 'FACEBOOK_OPEN_GRAPH_PROF1', 43, 'Tragen Sie die vollständige URL zu einer weiteren Profil Seite ein, die Sie nutzen.<br/>Beispiel: https://www.dandb.com/businessdirectory/xxx.html', now(), now()),
('Open Graph - Weitere Profil Page 2', 'FACEBOOK_OPEN_GRAPH_PROF2', 43, 'Tragen Sie die vollständige URL zu einer weiteren Profil Seite ein, die Sie nutzen.<br/>Beispiel: http://www.yelp.com/biz/xxx', now(), now()),
('Open Graph - Belieferte Regionen', 'FACEBOOK_OPEN_GRAPH_ELER', 43, 'The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is valid. Such as US', now(), now()),



# Adminmenü ID 34 - RSS Feed

('RSS - RSS Feeds aktivieren?', 'RSS_FEED_ENABLED', 43, 'Wollen Sie die RSS Feeds aktivieren?', now(), now()),
('RSS - Titel', 'RSS_TITLE', 43, 'RSS Titel (falls leer verwende den Shopnamen)', now(), now()),
('RSS - Beschreibung', 'RSS_DESCRIPTION', 43, 'RSS Beschreibung', now(), now()),
('RSS - Bild', 'RSS_IMAGE', 43, 'ein GIF, JPEG oder PNG Bild, das das RSS Feed illustriert', now(), now()),
('RSS - Bild Name', 'RSS_IMAGE_NAME', 43, 'RSS Bild Name (falls leer verwende den Shopnamen)', now(), now()),
('RSS - Copyright', 'RSS_COPYRIGHT', 43, 'RSS Copyright (falls leer verwende den Shopinhaber)', now(), now()),
('RSS - Editor', 'RSS_MANAGING_EDITOR', 43, 'RSS Managing Editor (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', now(), now()),
('RSS - Webmaster', 'RSS_WEBMASTER', 43, 'RSS Webmaster (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', now(), now()),
('RSS - Author', 'RSS_AUTHOR', 43, 'RSS Autor (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', now(), now()),
('RSS - Home Page Feed', 'RSS_HOMEPAGE_FEED', 43, 'RSS Home Page Feed - Standardwert Neue Artikel', now(), now()),
('RSS - Default Feed', 'RSS_DEFAULT_FEED', 43, 'RSS Default Feed - Standarwert Neue Artikel', now(), now()),
('RSS - HTML Tags ausfiltern', 'RSS_STRIP_TAGS', 43, 'HTML Tags ausfiltern? Standardwert: false', now(), now()),
('RSS - Erzeuge Beschreibung', 'RSS_ITEMS_DESCRIPTION', 43, 'Soll die Artikelbeschreibung im Feed erscheinen?', now(), now()),
('RSS - Länge der Beschreibung', 'RSS_ITEMS_DESCRIPTION_MAX_LENGTH', 43, 'Wollen Sie den Beschreibungstext auf eine bestimmte Länge beschränken? (0 für kein Limit)', now(), now()),
('RSS - Lebensdauer des Feeds', 'RSS_TTL', 43, 'Lebensdauer - Zeit in Minuten nach der ein RSS Reader das Feed refreshen soll - Standardwert: 1440', now(), now()),
('RSS - Standard Artikel Limit', 'RSS_PRODUCTS_LIMIT', 43, 'Wieviele Artikel soll das RSS Feed enthalten? Standardwert: 100', now(), now()),
('RSS - Füge Artikelbild hinzu', 'RSS_PRODUCTS_DESCRIPTION_IMAGE', 43, 'Soll das Artikelbild im Feed erscheinen?', now(), now()),
('RSS - Füge Jetzt kaufen Button hinzu', 'RSS_PRODUCTS_DESCRIPTION_BUYNOW', 43, 'Soll der Jetzt kaufen Button im Feed erscheinen?', now(), now()),
('RSS - Kategorien für Artikel', 'RSS_PRODUCTS_CATEGORIES', 43, 'Wenn ein cPath mit angegeben wird, sollen die Artikel, dann nur aus der Masterkategorie kommen oder aus allen Kategorien? (wichtig bei verlinkten Artikeln)', now(), now()),
('RSS - Cache', 'RSS_CACHE_TIME', 43, 'Dauer des Feed Cachings in Minuten (es werden Feed Files im cache Ordner abgelegt). Wenn Sie kein Caching verwenden wollen stellen Sie auf 0', now(), now()),


# Adminmenü ID 35 - Zen Colorbox

('<b>Zen Colorbox</b>', 'ZEN_COLORBOX_STATUS', 43, 'Wollen Sie für die Vergrößerung Ihrer Artikelbilder einen Lightboxeffekt nutzen?<br/><br/>Voreinstellung = true<br/>', now(), now()),
('Overlay Transparenz', 'ZEN_COLORBOX_OVERLAY_OPACITY', 43, 'Gewünschte Transparenz des Overlays<br/><br/>Voreinstellung = 0.6<br/>', now(), now()),
('Dauer der Bildvergrößerung', 'ZEN_COLORBOX_RESIZE_DURATION', 43, 'Geschwindigkeit in Millisekunden<br/><br/>Voreinstellung = 400<br/>', now(), now()),
('Anfangs Bildbreite', 'ZEN_COLORBOX_INITIAL_WIDTH',  43, 'Breite des Artikelbildes beim ersten Aufruf<br/><br/>Voreinstellung = 250<br/>', now(), now()),
('Anfangs Bildhöhe', 'ZEN_COLORBOX_INITIAL_HEIGHT', 43, 'Höhe des Artikelbildes beim ersten Aufruf<br/><br/>Voreinstellung = 250<br/>', now(), now()),
('Bildzähler anzeigen', 'ZEN_COLORBOX_COUNTER', 43, 'Soll innerhalb der Lightbox eine Anzeige zur Anzahl der Bilder erscheinen?<br/><br/>Voreinstellung = true<br/>', now(), now()),
('Beim Click aufs Overlay schließen?', 'ZEN_COLORBOX_CLOSE_OVERLAY', 43, 'Soll die Lightbox beim Clicken auf das Overlay geschlossen werden?<br/><br/>Voreinstellung = false<br/>', now(), now()),
('Loop', 'ZEN_COLORBOX_LOOP', 43, 'Wenn auf true gestellt vergrößern sich die Bilder in beide Richtungen<br/><br/>Voreinstellung = true<br/>', now(), now()),
('<b>Slideshow</b>', 'ZEN_COLORBOX_SLIDESHOW',  43, 'Sollen die zusätzlichen Artikelbilder in einer Slideshow angezeigt werden?<br/><br/>Voreinstellung = false<br/>', now(), now()),
('&nbsp; Slideshow Autostart', 'ZEN_COLORBOX_SLIDESHOW_AUTO', 43, 'Slideshow automatisch starten?<br/><br/>Voreinstellung = true<br/>', now(), now()),
('&nbsp; Slideshow Geschwindigkeit', 'ZEN_COLORBOX_SLIDESHOW_SPEED', 43, 'Geschwindigkeit der Slideshow in Millisekunden<br/><br/>Voreinstellung = 2500<br/>', now(), now()),
('&nbsp; Slideshow Start Text', 'ZEN_COLORBOX_SLIDESHOW_START_TEXT', 43, 'Text des Links zum Starten der Slideshow<br/><br/>Voreinstellung = start slideshow<br/>', now(), now()),
('&nbsp; Slideshow Stop Text', 'ZEN_COLORBOX_SLIDESHOW_STOP_TEXT', 43, 'Text des Links zum Stoppen der Slideshow<br/><br/>Voreinstellung = stop slideshow<br/>', now(), now()),
('<b>Galerie Modus</b>', 'ZEN_COLORBOX_GALLERY_MODE', 43, 'Sollen die zusätzlichen Artikelbilder in einer Galerie zum Durchblättern erscheinen<br/><br/>Voreinstellung = true<br/>', now(), now()),
('&nbsp; Hauptbild in Galerie aufnehmen?', 'ZEN_COLORBOX_GALLERY_MAIN_IMAGE', 43, 'Soll das Hauptartikelbild Bestandteil der Galerieansicht sein?<br/><br/>Voreinstellung = true<br/>', now(), now()),
('<b>EZ-Pages Unterstützung</b>', 'ZEN_COLORBOX_EZPAGES', 43, 'Soll der Lightbox Effekt auch auf Bilder in den EZ Pages angewandt werden?<br/><br/>Voreinstellung = true<br/>', now(), now()),
('&nbsp; Dateitypen', 'ZEN_COLORBOX_FILE_TYPES', 43, 'Auf den EZ-Pages wird der Lightbox Effekt auf alle Bilder mit folgenden Dateitypen angewandt:<br/><br/>Voreinstellung = jpg,png,gif<br/>', now(), now()),


# Deutsche Einträge für Versandmodul Versandkostenfrei mit Optionen
('Versandkostenfrei mit Optionen aktivieren', 'MODULE_SHIPPING_FREEOPTIONS_STATUS', 43, 'Wollen Sie "Versandkostenfrei mit Optionen" aktivieren?', now(), now()),
('Versandkosten', 'MODULE_SHIPPING_FREEOPTIONS_COST', 43, 'Die Versandkosten betragen', now(), now()),
('Bearbeitungsgebühr', 'MODULE_SHIPPING_FREEOPTIONS_HANDLING', 43, 'Die Bearbeitungsgebühr beträgt', now(), now()),
('Ab Bestellsumme', 'MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN', 43, 'Versandkostenfrei ab einer Bestellsumme von', now(), now()),
('Bis Bestellsumme', 'MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX', 43, 'Versandkostenfrei bis zu einer Bestellsumme von', now(), now()),
('Ab Gewicht', 'MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MIN', 43, 'Versandkostenfrei ab einem Gewicht von', now(), now()),
('Bis Gewicht', 'MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MAX', 43, 'Versandkostenfrei bis zu einen Gewicht von', now(), now()),
('Ab Artikelanzahl', 'MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN', 43, 'Versandkostenfrei ab einer Artikelanzahl von', now(), now()),
('Bis Artikelanzahl', 'MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX', 43, 'Versandkostenfrei bis zu einer Artikelanzahl von', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_FREEOPTIONS_TAX_CLASS', 43, 'Welche Steuerklasse soll bei dieser Versandart angewendet werden?', now(), now()),
('Basis der Steuern', 'MODULE_SHIPPING_FREEOPTIONS_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern berechnet werden? Mögliche Optionen:<br />Versand (Shipping) - auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - auf Basis der Shopadresse, wenn die Rechnungs-/Versandadresse des Kunden innerhalb der Zone der Shopadresse liegt', now(), now()),
('Versandzone', 'MODULE_SHIPPING_FREEOPTIONS_ZONE', 43, 'für welche Länder soll diese Versandart angeboten werden?<br/>Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Länder.', now(), now()),
('Sortierung', 'MODULE_SHIPPING_FREEOPTIONS_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Versandarten.', now(), now()),

# Deutsche Einträge für Order Total Modul Nachnahmegebühr
('Nachnahmegebühr anzeigen', 'MODULE_ORDER_TOTAL_COD_STATUS', 43, 'Wollen Sie die Nachnahmegebühr anzeigen?', now(), now()),
('Sort Order', 'MODULE_ORDER_TOTAL_COD_SORT_ORDER', 43, 'Sortierung', now(), now()),
('Nachnahmegebühr für Versandkostenpauschale', 'MODULE_ORDER_TOTAL_COD_FEE_FLAT', 43, 'Versandkostenpauschale: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für standardmässige Frei Haus Lieferung', 'MODULE_ORDER_TOTAL_COD_FEE_FREE', 43, 'Standardmässige Frei Haus Lieferung: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für "Immer Versandkostenfrei"', 'MODULE_ORDER_TOTAL_COD_FEE_FREESHIPPER', 43, 'Immer Versandkostenfrei: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für Versandkosten mit Optionen', 'MODULE_ORDER_TOTAL_COD_FEE_FREEOPTIONS', 43, 'Versandkostenfrei mit Optionen: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für Versandkosten nach Gewicht', 'MODULE_ORDER_TOTAL_COD_FEE_PERWEIGHTUNIT', 43, 'Versandkosten nach Gewicht: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für Versandkosten pro stück', 'MODULE_ORDER_TOTAL_COD_FEE_ITEM', 43, 'Versandkosten pro stück: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für "Tabellarische Versandkosten"', 'MODULE_ORDER_TOTAL_COD_FEE_TABLE', 43, 'Tabellarische Versandkosten: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für UPS', 'MODULE_ORDER_TOTAL_COD_FEE_UPS', 43, 'UPS: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für USPS', 'MODULE_ORDER_TOTAL_COD_FEE_USPS', 43, 'USPS: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für Versandkosten nach Zonen', 'MODULE_ORDER_TOTAL_COD_FEE_ZONES', 43, 'Versandkosten nach Zonen: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für die Österreichische Post', 'MODULE_ORDER_TOTAL_COD_FEE_AP', 43, 'Ã–sterreichische Post: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für die deutsche Post', 'MODULE_ORDER_TOTAL_COD_FEE_DP', 43, 'Deutsche Post: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für Servicepakke', 'MODULE_ORDER_TOTAL_COD_FEE_SERVICEPAKKE', 43, 'Servicepakke: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für FedEx', 'MODULE_ORDER_TOTAL_COD_FEE_FEDEX', 43, 'FedEx: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Steuerklasse', 'MODULE_ORDER_TOTAL_COD_TAX_CLASS', 43, 'Welche Steuerklasse soll angewendet werden?', now(), now()),

# Vataddon
('Anzeige incl. Mwst. zzgl. Versandkosten', 'DISPLAY_VATADDON_WHERE', 43, 'Wollen Sie unterhalb der Preise den Zusatz incl. bzw. excl. Mwst. zzgl. Versandkosten anzeigen?<br/>O=Nein, Anzeige komplett deaktiviert<br/>ALL = Anzeige überall im Shop aktiv<br/>product_info = Anzeige nur auf der Artikeldetailseite<br/><br/>Hinweis: Den Text dieser Anzeige können Sie in folgender Datei ändern: includes/languages/german/extra_definitions/rl.vat_info.php', now(), now());

#####################################################################################################

# prevent issues with updates from damaged 1.3.9
# see https://www.zen-cart-pro.at/forum/threads/11976-Update-von-Version-1-3-9-auf-1-5-5?p=64085&viewfull=1#post64085

DROP TABLE IF EXISTS admin_activity_log;
CREATE TABLE admin_activity_log (
  log_id bigint(15) NOT NULL auto_increment,
  access_date datetime NOT NULL default '0001-01-01 00:00:00',
  admin_id int(11) NOT NULL default '0',
  page_accessed varchar(80) NOT NULL default '',
  page_parameters text,
  ip_address varchar(45) NOT NULL default '',
  flagged tinyint NOT NULL default '0',
  attention varchar(255) NOT NULL default '',
  gzpost mediumblob,
  logmessage mediumtext NOT NULL,
  severity varchar(9) NOT NULL default 'info',
  PRIMARY KEY  (log_id),
  KEY idx_page_accessed_zen (page_accessed),
  KEY idx_access_date_zen (access_date),
  KEY idx_flagged_zen (flagged),
  KEY idx_ip_zen (ip_address)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


#### VERSION UPDATE STATEMENTS
## THE FOLLOWING 2 SECTIONS SHOULD BE THE "LAST" ITEMS IN THE FILE, so that if the upgrade fails prematurely, the version info is not updated.
##The following updates the version HISTORY to store the prior version info (Essentially "moves" the prior version info from the "project_version" to "project_version_history" table
#NEXT_X_ROWS_AS_ONE_COMMAND:3
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM project_version;

## Now set to new version
UPDATE project_version SET project_version_major='1', project_version_minor='5.5f', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.4->1.5.5f', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';
UPDATE project_version SET project_version_major='1', project_version_minor='5.5', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.4->1.5.5f', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';

#####  END OF UPGRADE SCRIPT

