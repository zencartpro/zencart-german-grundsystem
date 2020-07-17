#
# * This SQL script upgrades the core Zen Cart database structure from v1.5.4 to v1.5.5
# * Zen Cart German Specific
# * @package Installer
# * @access private
# * @copyright Copyright 2003-2019 Zen Cart Development Team
# * @copyright Portions Copyright 2003 osCommerce
# * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
# * @version $Id: mysql_upgrade_zencart_155.sql 22 2020-07-17 20:40:59Z webchills $
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
UPDATE configuration set configuration_value = 'true' where configuration_key = 'DOWN_FOR_MAINTENANCE';

# Clear out active customer sessions
TRUNCATE TABLE whos_online;
TRUNCATE TABLE db_cache;

UPDATE configuration set configuration_group_id = 6 where configuration_key in ('PRODUCTS_OPTIONS_TYPE_SELECT', 'UPLOAD_PREFIX', 'TEXT_PREFIX');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product option type Select', 'PRODUCTS_OPTIONS_TYPE_SELECT', '0', 'The number representing the Select type of product option.', 6, NULL, now(), now(), NULL, NULL);
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Upload prefix', 'UPLOAD_PREFIX', 'upload_', 'Prefix used to differentiate between upload options and other options', 6, NULL, now(), now(), NULL, NULL);
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Text prefix', 'TEXT_PREFIX', 'txt_', 'Prefix used to differentiate between text option values and other option values', 6, NULL, now(), now(), NULL, NULL);

UPDATE countries set countries_name = 'Åland Islands' where countries_iso_code_3 = 'ALA';
UPDATE countries set countries_name = 'Réunion' where countries_iso_code_3 = 'REU';
UPDATE countries set countries_name = 'Côte d\'Ivoire' where countries_iso_code_3 = 'CIV';
UPDATE countries set countries_name = 'Bonaire, Sint Eustatius and Saba', countries_iso_code_2 = 'BQ', countries_iso_code_3 = 'BES' WHERE countries_iso_code_3 = 'ANT';
INSERT INTO countries (countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id, status) VALUES ('Curaçao','CW','CUW','1','0');
INSERT INTO countries (countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id, status) VALUES ('Sint Maarten (Dutch part)','SX','SXM','1','0');

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
) ENGINE=MyISAM;

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
('Demographics and Interest Reports', 'GOOGLE_ANALYTICS_DIR', 'Disabled', 'Enables / Disables Demographics and Interest Reports<br /><br />', @configuration_group_id, 12, NOW(), NULL, 'zen_cfg_select_option(array(\'Enabled\', \'Disabled\'), ', NOW()),
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

### New in 1.5.5f German ####

### Update Image Handler to version 5.1.0 ###

## Remove Old Image Handler Entries
DELETE FROM configuration WHERE configuration_key = 'IH_RESIZE';
DELETE FROM configuration WHERE configuration_key = 'IH_VERSION';
DELETE FROM configuration WHERE configuration_key = 'SMALL_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_SMALL_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'ZOOM_SMALL_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'ZOOM_IMAGE_SIZE';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_QUALITY';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_MEDIUM_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_QUALITY';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_LARGE_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_MAX_WIDTH';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_MAX_HEIGHT';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_GRAVITY';
DELETE FROM configuration_language WHERE configuration_key = 'IH_RESIZE';
DELETE FROM configuration_language WHERE configuration_key = 'IH_VERSION';
DELETE FROM configuration_language WHERE configuration_key = 'SMALL_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_SMALL_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'ZOOM_SMALL_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'ZOOM_IMAGE_SIZE';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_QUALITY';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_MEDIUM_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_QUALITY';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_LARGE_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_MAX_WIDTH';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_MAX_HEIGHT';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_GRAVITY';

DELETE FROM admin_pages WHERE language_key='BOX_TOOLS_IMAGE_HANDLER';

#Image Handler 5.1 new since 1.5.5f
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH resize images', 'IH_RESIZE', 'yes', 'Select either ''no'' which is old Zen-Cart behaviour or ''yes'' to activate automatic resizing and caching of images. If you want to use ImageMagick you have to specify the location of the <strong>convert</strong> binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em>.', 4, 76, NULL, now(), NULL, 'zen_cfg_select_option(array(''yes'', ''no''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images filetype', 'SMALL_IMAGE_FILETYPE', 'no_change', 'Select one of -jpg-, -gif- or -png-. Older versions of Internet Explorer -v6.0 and older- will have issues displaying -png- images with transparent areas. You better stick to -gif- for transparency if you MUST support older versions of Internet Explorer. However -png- is a MUCH BETTER format for transparency. Use -jpg- or -png- for larger images. -no_change- is old zen-cart behavior, use the same file extension for small images as uploaded image', 4, 77, NULL, now(), NULL, 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images background', 'SMALL_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to -transparent- to keep transparency', 4, 82, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Image Handler Version', 'IH_VERSION', '5.1.0', 'This is used by image handler to check if the database is up to date with uploaded image handler files.', 0, 100, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images watermark', 'WATERMARK_SMALL_IMAGES', 'no', 'Set to -yes-, if you want to show watermarked small images instead of unmarked small images.', 4, 78, NULL, now(), NULL, 'zen_cfg_select_option(array(''no'', ''yes''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images zoom on hover', 'ZOOM_SMALL_IMAGES', 'no', 'IH small images zoom on hover', 4, 79, now(), now(), NULL, 'zen_cfg_select_option(array(''no'', ''yes''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images zoom on hover size', 'ZOOM_IMAGE_SIZE', 'Medium', 'Set to -Medium-, if you want to the zoom on hover display to use the medium sized image. Otherwise, to use the large sized image on hover, set to -Large-', 4, 80, NULL, now(), NULL, 'zen_cfg_select_option(array(''Medium'', ''Large''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH medium images filetype', 'MEDIUM_IMAGE_FILETYPE', 'no_change', 'Select one of -jpg-, -gif- or -png-. Older versions of Internet Explorer -v6.0 and older- will have issues displaying -png- images with transparent areas. You better stick to -gif- for transparency if you MUST support older versions of Internet Explorer. However -png- is a MUCH BETTER format for transparency. Use -jpg- or -png- for larger images. -no_change- is old zen-cart behavior, use the same file extension for medium images as uploaded image-s.', 4, 81, NULL, now(), NULL, 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH medium images background', 'MEDIUM_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to -transparent- to keep transparency.', 4, 80, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH medium images compression quality', 'MEDIUM_IMAGE_QUALITY', '85', 'Specify the desired image quality for medium jpg images, decimal values ranging from 0 to 100. Higher is better quality and takes more space. Default is 85 which is ok unless you have very specific needs.', 4, 83, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH medium images watermark', 'WATERMARK_MEDIUM_IMAGES', 'no', 'Set to -yes-, if you want to show watermarked medium images instead of unmarked medium images.', 4, 84, NULL, now(), NULL, 'zen_cfg_select_option(array(''no'', ''yes''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images filetype', 'LARGE_IMAGE_FILETYPE', 'no_change', 'Select one of -jpg-, -gif- or -png-. Older versions of Internet Explorer -v6.0 and older- will have issues displaying -png- images with transparent areas. You better stick to -gif- for transparency if you MUST support older versions of Internet Explorer. However -png- is a MUCH BETTER format for transparency. Use -jpg- or -png- for larger images. -no_change- is old zen-cart behavior, use the same file extension for large images as uploaded image-s.', 4, 85, NULL, now(), NULL, 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images background', 'LARGE_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to -transparent- to keep transparency.', 4, 86, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images compression quality', 'LARGE_IMAGE_QUALITY', '85', 'Specify the desired image quality for large jpg images, decimal values ranging from 0 to 100. Higher is better quality and takes more space. Default is 85 which is ok unless you have very specific needs.', 4, 87, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images compression quality', 'SMALL_IMAGE_QUALITY', '85', 'Specify the desired image quality for small jpg images, decimal values ranging from 0 to 100. Higher is better quality and takes more space. Default is 85 which is ok unless you have very specific needs.', 4, 88, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images watermark', 'WATERMARK_LARGE_IMAGES', 'no', 'Set to -yes-, if you want to show watermarked large images instead of unmarked large images.', 4, 88, NULL, now(), NULL, 'zen_cfg_select_option(array(''no'', ''yes''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images maximum width', 'LARGE_IMAGE_MAX_WIDTH', '750', 'Specify a maximum width for your large images. If width and height are empty or set to 0, no resizing of large images is done.', 4, 89, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images maximum height', 'LARGE_IMAGE_MAX_HEIGHT', '550', 'Specify a maximum height for your large images. If width and height are empty or set to 0, no resizing of large images is done.', 4, 90, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH watermark gravity', 'WATERMARK_GRAVITY', 'Center', 'Select the position for the watermark relative to the image-s canvas. Default is <strong>Center</strong>.', 4, 91, NULL, now(), NULL, 'zen_cfg_select_drop_down(array(array(''id''=>''NorthWest'', ''text''=>''NorthWest''), array(''id''=>''North'', ''text''=>''North''), array(''id''=>''NorthEast'', ''text''=>''NorthEast''), array(''id''=>''West'', ''text''=>''West''), array(''id''=>''Center'', ''text''=>''Center''), array(''id''=>''East'', ''text''=>''East''), array(''id''=>''SouthWest'', ''text''=>''SouthWest''), array(''id''=>''South'', ''text''=>''South''), array(''id''=>''SouthEast'', ''text''=>''SouthEast'')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('IH Cache File-naming Convention', 'IH_CACHE_NAMING', 'Readable', 'Choose the method that <em>Image Handler</em> uses to name the resized images in the <code>cache/images</code> directory.<br /><br />The <em>Hashed</em> method was used by Image Handler versions prior to 4.3.4 and uses an &quot;MD5&quot; hash to produce the filenames.  It can be &quot;difficult&quot; to visually identify the original file using this method.  If you are upgrading Image Handler from a version prior to 4.3.4 <em>and</em> you have hard-coded links in product (or other) definitions to those images, <b>do not change</b> this setting from <em>Hashed</em>.<br /><br />Image Handler v4.3.4 (unreleased) introduced the concept of a <em>Readable</em> name for those resized images.  This is a good choice for new installations of <em>IH</em> or for upgraded installations that do not have hard-coded image links.', 4, 1006, now(), NULL, 'zen_cfg_select_option(array(\'Hashed\', \'Readable\'),');

INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('ImageHandler', 'BOX_TOOLS_IMAGE_HANDLER', 'FILENAME_IMAGE_HANDLER', '', 'tools', 'Y', 15);

##############################
# Add values for German admin
##############################

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES

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
('IH - Benennung der Bilder im cache/images Ordner', 'IH_CACHE_NAMING', 43, 'Wählen Sie die Methode aus, die Image Handler verwendet, um die skalierten Bilder im Verzeichnis cache/images zu benennen. <br /> <br /> Die <em> Hashed </ em> Methode wurde von Image Handler-Versionen vor 4.3.4 verwendet und verwendet einen MD5 - Hash, um die Dateinamen zu erzeugen. Es kann schwierig sein, die ursprüngliche Datei mithilfe dieser Methode visuell zu identifizieren. Wenn Sie in Ihren Produktbeschreibungen (oder anderen Seiten) fest codierte Links zu diesen Bildern haben, ändern Sie diese Einstellung auf <em> Hashed </ em>. <br /> <br />Seit Image Handler 5.1 können die Bilder mit einem <em> lesbaren Namen </ em> erzeugt werden. Dies ist eine gute Wahl für Neuinstallationen oder für aktualisierte Installationen ohne fest codierte Bildverknüpfungen und nun als Standard (Readable) voreingestellt.', now(), now());

####
### Update pdf Rechnung to version 3.5.1 ###
### It is not installed anymore after an installation or upgrade so we have to remove and reinstall the main config here #####
####

####
## Remove old pdf Invoice Entries
####

DELETE FROM configuration_group WHERE configuration_group_title = 'pdf Invoice';
DELETE FROM configuration_group WHERE configuration_group_title = 'pdf Rechnung';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_MODUL_VERSION';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_STATUS';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_ORDERDATE';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_CUSTOMERID';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_SHIPPING_ADDRESS';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_ADDRESS1_POS';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_ADDRESS2_POS';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_ADDRESS_BORDER';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_ADDRESS_WIDTH';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_DELTA';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_FONTS';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_LINE_HEIGT';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_LINE_THICK';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_MARGIN';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_NOT_NULL_INVOICE';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_ORDERSTATUS';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_ORDER_ID_PREFIX';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_PAPER';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_PDF_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_PDF_PATH';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_SEND_ATTACH';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_SEND_PDF';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_TABLE_TEMPLATE';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE';
DELETE FROM configuration WHERE configuration_key = 'RL_INVOICE3_DELTA_2PAGE';

DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_MODUL_VERSION';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_STATUS';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_ORDERDATE';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_CUSTOMERID';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_SHIPPING_ADDRESS';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_ADDRESS1_POS';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_ADDRESS2_POS';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_ADDRESS_BORDER';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_ADDRESS_WIDTH';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_DELTA';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_FONTS';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_LINE_HEIGT';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_LINE_THICK';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_MARGIN';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_NOT_NULL_INVOICE';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_ORDERSTATUS';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_ORDER_ID_PREFIX';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_PAPER';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_PDF_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_PDF_PATH';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_SEND_ATTACH';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_SEND_PDF';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_TABLE_TEMPLATE';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE';
DELETE FROM configuration_language WHERE configuration_key = 'RL_INVOICE3_DELTA_2PAGE';

DELETE FROM admin_pages WHERE language_key='GENERATE_RL_INVOICE3';
DELETE FROM admin_pages WHERE language_key='BOX_CONFIGURATION_PDF3';
DELETE FROM admin_pages WHERE language_key='BOX_TOOLS_PDF3';

INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('pdf Invoice', 'pdf Invoice Settings', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('Version', 'RL_INVOICE3_MODUL_VERSION', '3.5.0', 'Version installed:', @gid, 0, NOW(), NOW(), NULL, 'zen_cfg_read_only('),
('pdf Invoice - Status', 'RL_INVOICE3_STATUS', 'false', 'Do you want to activate the pdf invoice plugin?', @gid, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('pdf Invoice - Date of invoice = Date of order?', 'RL_INVOICE3_ORDERDATE', 'true', 'Should the invoice date be the date of the order or the date of the creation of the invoice?', @gid, 2, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('pdf Invoice - Customer ID', 'RL_INVOICE3_CUSTOMERID', 'true', 'Do you want to show the customer id on the pdf invoice?', @gid, 4, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('pdf Invoice - Show shipping address?', 'RL_INVOICE3_SHIPPING_ADDRESS', 'true', 'Do you want to show the shipping address on the pdf invoice?', @gid, 5, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('pdf Invoice - XY-position of address1 position', 'RL_INVOICE3_ADDRESS1_POS', '89|21', 'XY-position of address; its the margin delta <br />Default: 0|30', @gid, 6, NOW(), NOW(), NULL, NULL),
('pdf Invoice - XY-position of address2 position', 'RL_INVOICE3_ADDRESS2_POS', '1|21', 'XY-position of address; its the margin delta <br />Default: 80|30', @gid, 80, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Border Address1|2', 'RL_INVOICE3_ADDRESS_BORDER', '|', 'border Address1|2: LTRB (Left Top Right Bottom)<br />', @gid, 70, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Width Address1|2', 'RL_INVOICE3_ADDRESS_WIDTH', '80|80', 'width Address1|2: 60|60<br />', @gid, 40, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Deltas', 'RL_INVOICE3_DELTA', '5|8', 'delta address invoice|delta invoice products: 20|20<br />', @gid, 50, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Fonts for invoice|products', 'RL_INVOICE3_FONTS', 'myriadpc|myriadpc', 'fonts for <br />1. invoice in general <br >2. products & total-table<br />', @gid, 120, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Line Height', 'RL_INVOICE3_LINE_HEIGT', '1.25', 'Line Height', @gid, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Line Total Thickness', 'RL_INVOICE3_LINE_THICK', '0.5', 'thickness off total-line', @gid, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Margins', 'RL_INVOICE3_MARGIN', '20|20|20|20', 'defines the margins:<br />top|right|bottom|left<br />(Note: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />', @gid, 20, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Accounting for free product', 'RL_INVOICE3_NOT_NULL_INVOICE', '0', 'Accounting for free product: send e-mail invoice', @gid, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Send by orderstatus greater/equal than ', 'RL_INVOICE3_ORDERSTATUS', '3', 'only send invoice if orders_status greater or equal than', @gid, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Prefix for OrderNo', 'RL_INVOICE3_ORDER_ID_PREFIX', ': 2018', 'prefix for OrderNo<br />', @gid, 110, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Paper Size/Units/Oriantation', 'RL_INVOICE3_PAPER', 'A4|mm|P', '1. papersize = A3|A4|A5|Letter|Legal <br />2. units: pt|mm|cm|inch <br />3. Oriantation: L|P<br />', @gid, 10, NOW(), NOW(), NULL, NULL),
('pdf Invoice - pdf background file', 'RL_INVOICE3_PDF_BACKGROUND', '', 'absolute path to pdf background file<br />', @gid, 60, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Filename and path to store the pdf-file', 'RL_INVOICE3_PDF_PATH', '', 'absolute path to store the pdf-file (!!must be writeable !!)<br />Default: ../pdf/|1<br />', @gid, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Additional attachements', 'RL_INVOICE3_SEND_ATTACH', 'agb_de.pdf|widerruf_de.pdf', 'RL_INVOICE3_SEND_PDF', @gid, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - [RE]send order', 'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE', '3|7', '[RE]send invoice, if orderstatus changed to', @gid, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Send pdf invoice with order', 'RL_INVOICE3_SEND_PDF', '0', 'Do you want to send the invoice with an order?', @gid, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Templates for products table & total table', 'RL_INVOICE3_TABLE_TEMPLATE', 'amazon|amazon_templ|total_col_1|total_opt_1', 'templates for products_table & total_table; this is defined in rl_invoice3_def.php<br />', @gid, 90, NOW(), NOW(), NULL, NULL),
('pdf Invoice - PDF-template on first page', 'RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE', 'false', 'print pdf-background-template omly on the first page', @gid, 160, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('pdf Invoice - Delta 2.Page', 'RL_INVOICE3_DELTA_2PAGE', '10', 'Delta 2.Page', @gid, 160, NOW(), NOW(), NULL, NULL);

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'pdf Rechnung', 'Einstellungen für das pdf Rechnung Modul', '1', '1');

### pdf Rechnung Menüpunkte für Admin Access Control registrieren ####
INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('configPDF3', 'BOX_CONFIGURATION_PDF3', 'FILENAME_CONFIGURATION', CONCAT('gID=',@gid), 'configuration', 'Y', @gid),
('toolsPDF3', 'BOX_TOOLS_PDF3', 'RL_INVOICE3_ADMIN_FILENAME', '', 'tools', 'Y', @gid),
('GeneratePDFInvoice', 'GENERATE_RL_INVOICE3', 'FILENAME_RL_INVOICE3', '', 'customers', 'N', @gid);

####
### Update IT Recht Kanzlei to version 1.0.1 ###
### It is not installed anymore after an installation or upgrade so we have to remove and reinstall the main config here #####
####

####
## Remove old IT Recht Kanzlei Entries
####

DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_MODUL_VERSION';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_STATUS';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_TOKEN';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_VERSION';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_PAGE_KEY_AGB';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_PAGE_KEY_DATENSCHUTZ';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_PAGE_KEY_WIDERRUF';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_PAGE_KEY_IMPRESSUM';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_PDF_AGB';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_PDF_DATENSCHUTZ';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_PDF_WIDERRUF';
DELETE FROM configuration WHERE configuration_key = 'IT_RECHT_KANZLEI_PDF_FILE';

DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_MODUL_VERSION';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_STATUS';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_TOKEN';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_VERSION';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_PAGE_KEY_AGB';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_PAGE_KEY_DATENSCHUTZ';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_PAGE_KEY_WIDERRUF';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_PAGE_KEY_IMPRESSUM';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_PDF_AGB';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_PDF_DATENSCHUTZ';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_PDF_WIDERRUF';
DELETE FROM configuration_language WHERE configuration_key = 'IT_RECHT_KANZLEI_PDF_FILE';

DELETE FROM admin_pages WHERE language_key='BOX_CONFIGURATION_IT_RECHT_KANZLEI';
DELETE FROM admin_pages WHERE language_key='BOX_TOOLS_IT_RECHT_KANZLEI';

INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('IT Recht Kanzlei', 'IT Recht Kanzlei Settings', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('Version', 'IT_RECHT_KANZLEI_MODUL_VERSION', '1.0.0', 'Installierte Version:', @gid, 0, NOW(), NOW(), NULL, 'zen_cfg_read_only('),
('IT Recht Kanzlei - Ist das Modul aktiv?', 'IT_RECHT_KANZLEI_STATUS', 'nein', 'Wollen Sie die Schnittstelle der IT Recht Kanzlei aktivieren?<br/>Bitte erst dann aktivieren, wenn Sie sich mit der Funktionsweise vertraut gemacht haben.', @gid, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''ja'', ''nein''),'),
('IT Recht Kanzlei - API Token', 'IT_RECHT_KANZLEI_TOKEN', '', 'Authentifizierungs-Token den Sie zur Übertragung im Mandantenportal der IT-Recht Kanzlei angeben.<br/>Diese Token können Sie hier nicht ändern. Falls Sie eine neue Token erstellen wollen, nutzen Sie dazu die entsprechende Option unter Tools > IT Recht Kanzlei.', @gid, 2, NOW(), NOW(), NULL, 'zen_cfg_read_only('),
('IT Recht Kanzlei - API Version', 'IT_RECHT_KANZLEI_VERSION', '1.0', 'API Version der IT Recht Kanzlei Schnittstelle', @gid, 3, NOW(), NOW(), NULL, 'zen_cfg_read_only('),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext AGB', 'IT_RECHT_KANZLEI_PAGE_KEY_AGB', 'itrk-agb', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die AGB angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die AGB automatisch eingefügt.<br/>Voreinstellung: itrk-agb', @gid, 4, NOW(), NOW(), NULL, NULL),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Datenschutzerklärung', 'IT_RECHT_KANZLEI_PAGE_KEY_DATENSCHUTZ', 'itrk-datenschutz', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Datenschutzerklärung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Datenschutzerklärung automatisch eingefügt<br/>Voreinstellung: itrk-datenschutz.', @gid, 5, NOW(), NOW(), NULL, NULL),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Widerrufsbelehrung', 'IT_RECHT_KANZLEI_PAGE_KEY_WIDERRUF', 'itrk-widerruf', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Widerrufsbelehrung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Widerrufsbelehrung automatisch eingefügt<br/>Voreinstellung: itrk-widerruf.', @gid, 6, NOW(), NOW(), NULL, NULL),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Impressum', 'IT_RECHT_KANZLEI_PAGE_KEY_IMPRESSUM', 'itrk-impressum', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für das Impressum angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für das Impressum automatisch eingefügt.<br/>Voreinstellung: itrk-impressum', @gid, 7, NOW(), NOW(), NULL, NULL),
('IT Recht Kanzlei - AGB auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_AGB', 'ja', 'Sollen die AGB auch als pdf verfügbar sein?', @gid, 8, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''ja'', ''nein''),'),
('IT Recht Kanzlei - Datenschutzerklärung auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_DATENSCHUTZ', 'ja', 'Soll die Datenschutzerklärung auch als pdf verfügbar sein?', @gid, 9, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''ja'', ''nein''),'),
('IT Recht Kanzlei - Widerrufsbelehrung auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_WIDERRUF', 'ja', 'Soll die Widerrufsbelehrung auch als pdf verfügbar sein?', @gid, 10, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''ja'', ''nein''),'),
('IT Recht Kanzlei - Speicherort der pdf Dateien', 'IT_RECHT_KANZLEI_PDF_FILE', 'includes/pdf', 'In welchem Ordner am Server sollen die pdf Dateien gespeichert werden?<br/>Lassen Sie diese Einstellung auf includes/pdf, damit das Modul pdf Rechnung falls installiert auf die pdfs zugreifen kann.', @gid, 11, NOW(), NOW(), NULL, NULL);


INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'IT Recht Kanzlei', 'Einstellungen für das IT Recht Kanzlei Modul', '1', '1');

### IT Recht Kanzlei Menüpunkte für Admin Access Control registrieren ####
INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('configITRechtKanzlei', 'BOX_CONFIGURATION_IT_RECHT_KANZLEI', 'FILENAME_CONFIGURATION', CONCAT('gID=',@gid), 'configuration', 'Y', @gid),
('toolsITRechtKanzlei', 'BOX_TOOLS_IT_RECHT_KANZLEI', 'FILENAME_IT_RECHT_KANZLEI', '', 'tools', 'Y', 100);

INSERT INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Version', 'IT_RECHT_KANZLEI_MODUL_VERSION', 43, 'Installierte Version:', now(), now()),
('IT Recht Kanzlei - Ist das Modul aktiv?', 'IT_RECHT_KANZLEI_STATUS', 43, 'Wollen Sie die Schnittstelle der IT Recht Kanzlei aktivieren?<br/>Bitte erst dann aktivieren, wenn Sie sich mit der Funktionsweise vertraut gemacht haben.', now(), now()),
('IT Recht Kanzlei - API Token', 'IT_RECHT_KANZLEI_TOKEN', 43, 'Authentifizierungs-Token den Sie zur Übertragung im Mandantenportal der IT-Recht Kanzlei angeben.<br/>Diese Token können Sie hier nicht ändern. Falls Sie eine neue Token erstellen wollen, nutzen Sie dazu die entsprechende Option unter Tools > IT Recht Kanzlei.', now(), now()),
('IT Recht Kanzlei - API Version', 'IT_RECHT_KANZLEI_VERSION',  43, 'API Version der IT Recht Kanzlei Schnittstelle', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext AGB', 'IT_RECHT_KANZLEI_PAGE_KEY_AGB', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die AGB angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die AGB automatisch eingefügt.<br/>Voreinstellung: itrk-agb', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Datenschutzerklärung', 'IT_RECHT_KANZLEI_PAGE_KEY_DATENSCHUTZ', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Datenschutzerklärung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Datenschutzerklärung automatisch eingefügt<br/>Voreinstellung: itrk-datenschutz.', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Widerrufsbelehrung', 'IT_RECHT_KANZLEI_PAGE_KEY_WIDERRUF', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Widerrufsbelehrung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Widerrufsbelehrung automatisch eingefügt<br/>Voreinstellung: itrk-widerruf.', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Impressum', 'IT_RECHT_KANZLEI_PAGE_KEY_IMPRESSUM', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für das Impressum angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für das Impressum automatisch eingefügt.<br/>Voreinstellung: itrk-impressum', now(), now()),
('IT Recht Kanzlei - AGB auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_AGB',  43, 'Sollen die AGB auch als pdf verfügbar sein?', now(), now()),
('IT Recht Kanzlei - Datenschutzerklärung auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_DATENSCHUTZ', 43, 'Soll die Datenschutzerklärung auch als pdf verfügbar sein?', now(), now()),
('IT Recht Kanzlei - Widerrufsbelehrung auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_WIDERRUF', 43, 'Soll die Widerrufsbelehrung auch als pdf verfügbar sein?', now(), now()),
('IT Recht Kanzlei - Speicherort der pdf Dateien', 'IT_RECHT_KANZLEI_PDF_FILE', 43, 'In welchem Ordner am Server sollen die pdf Dateien gespeichert werden?<br/>Lassen Sie diese Einstellung auf includes/pdf, damit das Modul pdf Rechnung falls installiert auf die pdfs zugreifen kann.', now(), now());

### Neue DSGVO Menüpunkte unter Kunden für Admin Access Control registrieren ####

INSERT IGNORE INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('customers_without_order', 'BOX_CUSTOMERS_WITHOUT_ORDER', 'FILENAME_CUSTOMERS_WITHOUT_ORDER', '', 'customers', 'Y', 30),
('dsgvo_kundenexport', 'BOX_DSGVO_KUNDENEXPORT', 'FILENAME_DSGVO_KUNDENEXPORT', '', 'customers', 'Y', 31);

#####################################################################################################


### IT Recht Kanzlei EZ Pages - Neu seit 1.5.5 ###

### page key hinzufügen ###

ALTER TABLE ezpages ADD page_key varchar(64) NOT NULL default 0;

### IT Recht Kanzlei EZ Pages anlegen ###

INSERT IGNORE INTO ezpages (languages_id, pages_title, alt_url, alt_url_external, pages_html_text, status_header, status_sidebox, status_footer, status_toc, header_sort_order, sidebox_sort_order, footer_sort_order, toc_sort_order, page_open_new_window, page_is_ssl, toc_chapter, page_key) VALUES
(43, 'Datenschutzbestimmungen', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-datenschutz'),
(43, 'Widerrufsrecht', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-widerruf'),
(43, 'Impressum', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-impressum'),
(43, 'Allgemeine Geschäftsbedingungen', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-agb');


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

