#
# * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
# * Main Zen Cart SQL Load for MySQL databases
# * @access private
# * @copyright Copyright 2003-2023 Zen Cart Development Team
# * Zen Cart German Version - www.zen-cart-pro.at
# * @copyright Portions Copyright 2003 osCommerce
# * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
# * @version $Id: mysql_zencart.sql 2023-10-31 16:41:16Z webchills $
#

############ IMPORTANT INSTRUCTIONS ###############
#
# * Zen Cart uses the zc_install/index.php program to do installations
# * This SQL script is intended to be used by running zc_install
# * It is *not* recommended to simply run these statements manually via any other means
# * ie: not via phpMyAdmin or other SQL front-end tools
# * The zc_install program catches possible problems/exceptions
# * and also handles table-prefixes automatically, based on selections made during installation
#
#####################################################


# --------------------------------------------------------
#
# Table structure for table upgrade_exceptions
# (Placed at top so any exceptions during installation can be trapped as well)
#

DROP TABLE IF EXISTS upgrade_exceptions;
CREATE TABLE upgrade_exceptions (
  upgrade_exception_id smallint(5) NOT NULL auto_increment,
  sql_file varchar(128) default NULL,
  reason text default NULL,
  errordate datetime default NULL,
  sqlstatement text,
  PRIMARY KEY  (upgrade_exception_id)
) ENGINE=MyISAM;


# --------------------------------------------------------
#
# Table structure for table address_book
#

DROP TABLE IF EXISTS address_book;
CREATE TABLE address_book (
  address_book_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  entry_gender char(1) NOT NULL default '',
  entry_company varchar(64) default NULL,
  entry_firstname varchar(32) NOT NULL default '',
  entry_lastname varchar(32) NOT NULL default '',
  entry_street_address varchar(64) NOT NULL default '',
  entry_suburb varchar(32) default NULL,
  entry_postcode varchar(10) NOT NULL default '',
  entry_city varchar(32) NOT NULL default '',
  entry_state varchar(32) default NULL,
  entry_country_id int(11) NOT NULL default '0',
  entry_zone_id int(11) NOT NULL default '0',
  PRIMARY KEY  (address_book_id),
  KEY idx_address_book_customers_id_zen (customers_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'address_format'
#

DROP TABLE IF EXISTS address_format;
CREATE TABLE address_format (
  address_format_id int(11) NOT NULL auto_increment,
  address_format varchar(128) NOT NULL default '',
  address_summary varchar(48) NOT NULL default '',
  PRIMARY KEY  (address_format_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'admin'
#

DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
  admin_id int(11) NOT NULL auto_increment,
  admin_name varchar(32) NOT NULL default '',
  admin_email varchar(96) NOT NULL default '',
  admin_profile int(11) NOT NULL default '0',
  admin_pass varchar(255) NOT NULL default '',
  prev_pass1 varchar(255) NOT NULL default '',
  prev_pass2 varchar(255) NOT NULL default '',
  prev_pass3 varchar(255) NOT NULL default '',
  pwd_last_change_date datetime NOT NULL default '0001-01-01 00:00:00',
  reset_token varchar(255) NOT NULL default '',
  last_modified datetime NOT NULL default '0001-01-01 00:00:00',
  last_login_date datetime NOT NULL default '0001-01-01 00:00:00',
  last_login_ip varchar(45) NOT NULL default '',
  failed_logins smallint(4) unsigned NOT NULL default '0',
  lockout_expires int(11) NOT NULL default '0',
  last_failed_attempt datetime NOT NULL default '0001-01-01 00:00:00',
  last_failed_ip varchar(45) NOT NULL default '',
  PRIMARY KEY  (admin_id),
  KEY idx_admin_name_zen (admin_name),
  KEY idx_admin_email_zen (admin_email),
  KEY idx_admin_profile_zen (admin_profile)
) ENGINE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table 'admin_notifications'
#

DROP TABLE IF EXISTS admin_notifications;
CREATE TABLE admin_notifications (
  notification_key varchar(40) NOT NULL,
  admin_id int(11),
  dismissed char(1),
  UNIQUE KEY notification_key (notification_key)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'admin_activity_log'
#

DROP TABLE IF EXISTS admin_activity_log;
CREATE TABLE admin_activity_log (
  log_id bigint(15) NOT NULL auto_increment,
  access_date datetime NOT NULL default '0001-01-01 00:00:00',
  admin_id int(11) NOT NULL default '0',
  page_accessed varchar(80) NOT NULL default '',
  page_parameters text,
  ip_address varchar(45) NOT NULL default '',
  flagged tinyint NOT NULL default '0',
  attention MEDIUMTEXT,
  gzpost mediumblob,
  logmessage mediumtext NOT NULL,
  severity varchar(9) NOT NULL default 'info',
  PRIMARY KEY  (log_id),
  KEY idx_page_accessed_zen (page_accessed),
  KEY idx_access_date_zen (access_date),
  KEY idx_flagged_zen (flagged),
  KEY idx_ip_zen (ip_address)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'admin_menu'
#

DROP TABLE IF EXISTS admin_menus;
CREATE TABLE admin_menus (
  menu_key VARCHAR(191) NOT NULL DEFAULT '',
  language_key VARCHAR(255) NOT NULL DEFAULT '',
  sort_order INT(11) NOT NULL DEFAULT 0,
  UNIQUE KEY menu_key (menu_key)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'admin_pages'
#

DROP TABLE IF EXISTS admin_pages;
CREATE TABLE admin_pages (
  page_key VARCHAR(191) NOT NULL DEFAULT '',
  language_key VARCHAR(255) NOT NULL DEFAULT '',
  main_page varchar(255) NOT NULL default '',
  page_params varchar(255) NOT NULL default '',
  menu_key varchar(191) NOT NULL default '',
  display_on_menu char(1) NOT NULL default 'N',
  sort_order int(11) NOT NULL default 0,
  UNIQUE KEY page_key (page_key)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'admin_profiles'
#

DROP TABLE IF EXISTS admin_profiles;
CREATE TABLE admin_profiles (
  profile_id int(11) NOT NULL AUTO_INCREMENT,
  profile_name varchar(191) NOT NULL default '',
  PRIMARY KEY (profile_id),
  UNIQUE KEY idx_profile_name_zen (profile_name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'admin_pages_to_profiles'
#

DROP TABLE IF EXISTS admin_pages_to_profiles;
CREATE TABLE admin_pages_to_profiles (
  profile_id int(11) NOT NULL default '0',
  page_key varchar(191) NOT NULL default '',
  UNIQUE KEY profile_page (profile_id, page_key),
  UNIQUE KEY page_profile (page_key, profile_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'authorizenet'
#
DROP TABLE IF EXISTS authorizenet;
CREATE TABLE authorizenet (
  id int(11) unsigned NOT NULL auto_increment,
  customer_id int(11) NOT NULL default '0',
  order_id int(11) NOT NULL default '0',
  response_code int(1) NOT NULL default '0',
  response_text varchar(255) NOT NULL default '',
  authorization_type varchar(50) NOT NULL default '',
  transaction_id varchar(32) default NULL,
  sent longtext NOT NULL,
  received longtext NOT NULL,
  time varchar(50) NOT NULL default '',
  session_id varchar(255) NOT NULL default '',
  PRIMARY KEY  (id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'banners'
#

DROP TABLE IF EXISTS banners;
CREATE TABLE banners (
  banners_id int(11) NOT NULL auto_increment,
  banners_title varchar(64) NOT NULL default '',
  banners_url varchar(255) NOT NULL default '',
  banners_image varchar(255) NOT NULL default '',
  banners_group varchar(15) NOT NULL default '',
  banners_html_text text,
  expires_impressions int(7) default '0',
  expires_date datetime default NULL,
  date_scheduled datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  date_status_change datetime default NULL,
  status int(1) NOT NULL default '1',
  banners_open_new_windows int(1) NOT NULL default '1',
  banners_on_ssl int(1) NOT NULL default '1',
  banners_sort_order int(11) NOT NULL default '0',
  PRIMARY KEY  (banners_id),
  KEY idx_status_group_zen (status,banners_group),
  KEY idx_expires_date_zen (expires_date),
  KEY idx_date_scheduled_zen (date_scheduled)
) ENGINE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table 'banners_history'
#

DROP TABLE IF EXISTS banners_history;
CREATE TABLE banners_history (
  banners_history_id int(11) NOT NULL auto_increment,
  banners_id int(11) NOT NULL default '0',
  banners_shown int(5) NOT NULL default '0',
  banners_clicked int(5) NOT NULL default '0',
  banners_history_date datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (banners_history_id),
  KEY idx_banners_id_zen (banners_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'braintree'
#


DROP TABLE IF EXISTS braintree;
CREATE TABLE braintree (
  braintree_id int(11) NOT NULL auto_increment,
  order_id int(11) NOT NULL,
  txn_type varchar(256) NOT NULL,
  module_name text NOT NULL,
  reason_code text NOT NULL,
  payment_type varchar(256) NOT NULL,
  payment_status varchar(256) NOT NULL,
  pending_reason varchar(256) NOT NULL,
  first_name text NOT NULL,
  last_name text NOT NULL,
  payer_business_name text NOT NULL,
  address_name text NOT NULL,
  address_street text NOT NULL,
  address_city text NOT NULL,
  address_state text NOT NULL,
  address_zip varchar(256) NOT NULL,
  address_country varchar(256) NOT NULL,
  payer_email text NOT NULL,
  payer_phone text NOT NULL,
  payment_date datetime NOT NULL,
  txn_id varchar(256) NOT NULL,
  parent_txn_id varchar(256) NOT NULL,
  num_cart_items int(11) NOT NULL,
  settle_amount decimal(10,2) NOT NULL,
  settle_currency varchar(256) NOT NULL,
  exchange_rate decimal(10,0) NOT NULL,
  date_added datetime NOT NULL,
  module_mode text NOT NULL,
  PRIMARY KEY  (braintree_id),
  UNIQUE KEY order_id (order_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'categories'
#

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  categories_id int(11) NOT NULL auto_increment,
  categories_image varchar(255) default NULL,
  parent_id int(11) NOT NULL default '0',
  sort_order int(3) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  categories_status tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (categories_id),
  KEY idx_parent_id_cat_id_zen (parent_id,categories_id),
  KEY idx_status_zen (categories_status),
  KEY idx_sort_order_zen (sort_order)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'categories_description'
#

DROP TABLE IF EXISTS categories_description;
CREATE TABLE categories_description (
  categories_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  categories_name varchar(32) NOT NULL default '',
  categories_description text NOT NULL,
  PRIMARY KEY  (categories_id,language_id),
  KEY idx_categories_name_zen (categories_name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'configuration'
#

DROP TABLE IF EXISTS configuration;
CREATE TABLE configuration (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title text NOT NULL,
  configuration_key varchar(180) NOT NULL default '',
  configuration_value text NOT NULL,
  configuration_description text NOT NULL,
  configuration_group_id int(11) NOT NULL default '0',
  sort_order int(5) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  use_function text default NULL,
  set_function text default NULL,
  val_function text default NULL,
  PRIMARY KEY  (configuration_id),
  UNIQUE KEY unq_config_key_zen (configuration_key),
  KEY idx_key_value_zen (configuration_key,configuration_value(10)),
  KEY idx_cfg_grp_id_zen (configuration_group_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'configuration_group'
# Zen Cart German Specific

DROP TABLE IF EXISTS configuration_group;
CREATE TABLE configuration_group (
  configuration_group_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  configuration_group_title varchar(64) NOT NULL default '',
  configuration_group_description varchar(255) NOT NULL default '',
  sort_order int(5) default NULL,
  visible int(1) default '1',
  PRIMARY KEY  (configuration_group_id, language_id),
  KEY idx_visible_zen (visible)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'configuration_language'
# Zen Cart German Specific

DROP TABLE IF EXISTS configuration_language;
CREATE TABLE configuration_language (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title text NOT NULL,
  configuration_key varchar(191) NOT NULL DEFAULT '',
  configuration_language_id int(11) NOT NULL DEFAULT 1,
  configuration_description text NOT NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (configuration_id),
  UNIQUE KEY config_lang (configuration_key,configuration_language_id),
  KEY configuration_language_id (configuration_language_id)
) ENGINE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table 'counter'
#

DROP TABLE IF EXISTS counter;
CREATE TABLE counter (
  startdate char(8) default NULL,
  counter int(12) default NULL
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'counter_history'
#

DROP TABLE IF EXISTS counter_history;
CREATE TABLE counter_history (
  startdate char(8) NOT NULL default '',
  counter int(12) default NULL,
  session_counter int(12) default NULL,
  PRIMARY KEY  (startdate)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'count_product_views'
#

DROP TABLE IF EXISTS count_product_views;
CREATE TABLE count_product_views (
  product_id int(11) NOT NULL default 0,
  language_id int(11) NOT NULL default 1,
  date_viewed date NOT NULL,
  views int(11) default NULL,
  PRIMARY KEY (product_id, language_id, date_viewed),
  KEY idx_pid_lang_date_zen (language_id, product_id, date_viewed),
  KEY idx_date_pid_lang_zen (date_viewed, product_id, language_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'countries'
#

DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  countries_id int(11) NOT NULL auto_increment,
  countries_name varchar(64) NOT NULL default '',
  countries_iso_code_2 char(2) NOT NULL default '',
  countries_iso_code_3 char(3) NOT NULL default '',
  address_format_id int(11) NOT NULL default '0',
  status tinyint(1) default 1,
  PRIMARY KEY  (countries_id),
  KEY idx_countries_name_zen (countries_name),
  KEY idx_address_format_id_zen (address_format_id),
  KEY idx_iso_2_zen (countries_iso_code_2),
  KEY idx_iso_3_zen (countries_iso_code_3)
) ENGINE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table 'countries_name'
# Zen Cart German Specific

DROP TABLE IF EXISTS countries_name;
CREATE TABLE IF NOT EXISTS countries_name (
  id int(11) NOT NULL AUTO_INCREMENT,
  countries_id int(11) NOT NULL,
  language_id int(11) NOT NULL DEFAULT '1',
  countries_name varchar(64) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE countries (countries_id, language_id, countries_name),
  KEY idx_countries_name_zen (countries_name)
) ENGINE=MyISAM ;

# --------------------------------------------------------

#
# Table structure for table 'coupon_email_track'
#

DROP TABLE IF EXISTS coupon_email_track;
CREATE TABLE coupon_email_track (
  unique_id int(11) NOT NULL auto_increment,
  coupon_id int(11) NOT NULL default '0',
  customer_id_sent int(11) NOT NULL default '0',
  sent_firstname varchar(32) default NULL,
  sent_lastname varchar(32) default NULL,
  emailed_to varchar(96) default NULL,
  date_sent datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (unique_id),
  KEY idx_coupon_id_zen (coupon_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'coupon_gv_customer'
#

DROP TABLE IF EXISTS coupon_gv_customer;
CREATE TABLE coupon_gv_customer (
  customer_id int(5) NOT NULL default '0',
  amount decimal(15,4) NOT NULL default '0.0000',
  PRIMARY KEY  (customer_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'coupon_gv_queue'
#

DROP TABLE IF EXISTS coupon_gv_queue;
CREATE TABLE coupon_gv_queue (
  unique_id int(5) NOT NULL auto_increment,
  customer_id int(5) NOT NULL default '0',
  order_id int(5) NOT NULL default '0',
  amount decimal(15,4) NOT NULL default '0.0000',
  date_created datetime NOT NULL default '0001-01-01 00:00:00',
  ipaddr varchar(45) NOT NULL default '',
  release_flag char(1) NOT NULL default 'N',
  PRIMARY KEY  (unique_id),
  KEY idx_cust_id_order_id_zen (customer_id,order_id),
  KEY idx_release_flag_zen (release_flag)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'coupon_redeem_track'
#

DROP TABLE IF EXISTS coupon_redeem_track;
CREATE TABLE coupon_redeem_track (
  unique_id int(11) NOT NULL auto_increment,
  coupon_id int(11) NOT NULL default '0',
  customer_id int(11) NOT NULL default '0',
  redeem_date datetime NOT NULL default '0001-01-01 00:00:00',
  redeem_ip varchar(45) NOT NULL default '',
  order_id int(11) NOT NULL default '0',
  PRIMARY KEY  (unique_id),
  KEY idx_coupon_id_zen (coupon_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'coupon_restrict'
#

DROP TABLE IF EXISTS coupon_restrict;
CREATE TABLE coupon_restrict (
  restrict_id int(11) NOT NULL auto_increment,
  coupon_id int(11) NOT NULL default '0',
  product_id int(11) NOT NULL default '0',
  category_id int(11) NOT NULL default '0',
  coupon_restrict char(1) NOT NULL default 'N',
  PRIMARY KEY  (restrict_id),
  KEY idx_coup_id_prod_id_zen (coupon_id,product_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'coupons'
#

DROP TABLE IF EXISTS coupons;
CREATE TABLE coupons (
  coupon_id int(11) NOT NULL auto_increment,
  coupon_type char(1) NOT NULL default 'F',
  coupon_code varchar(32) NOT NULL default '',
  coupon_amount decimal(15,4) NOT NULL default '0.0000',
  coupon_minimum_order decimal(15,4) NOT NULL default '0.0000',
  coupon_start_date datetime NOT NULL default '0001-01-01 00:00:00',
  coupon_expire_date datetime NOT NULL default '0001-01-01 00:00:00',
  uses_per_coupon int(5) NOT NULL default 1,
  uses_per_user int(5) NOT NULL default 0,
  restrict_to_products varchar(255) default NULL,
  restrict_to_categories varchar(255) default NULL,
  restrict_to_customers text,
  coupon_active char(1) NOT NULL default 'Y',
  date_created datetime NOT NULL default '0001-01-01 00:00:00',
  date_modified datetime NOT NULL default '0001-01-01 00:00:00',
  coupon_zone_restriction int(11) NOT NULL default 0,
  coupon_calc_base tinyint(1) NOT NULL DEFAULT 0,
  coupon_order_limit int(4) NOT NULL default 0,
  coupon_is_valid_for_sales tinyint(1) NOT NULL DEFAULT 1,
  coupon_product_count tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (coupon_id),
  KEY idx_active_type_zen (coupon_active,coupon_type),
  KEY idx_coupon_code_zen (coupon_code),
  KEY idx_coupon_type_zen (coupon_type)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'coupons_description'
#

DROP TABLE IF EXISTS coupons_description;
CREATE TABLE coupons_description (
  coupon_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '0',
  coupon_name varchar(64) NOT NULL default '',
  coupon_description text,
  PRIMARY KEY (coupon_id,language_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'currencies'
#

DROP TABLE IF EXISTS currencies;
CREATE TABLE currencies (
  currencies_id int(11) NOT NULL auto_increment,
  title varchar(32) NOT NULL default '',
  code char(3) NOT NULL default '',
  symbol_left varchar(32) default NULL,
  symbol_right varchar(32) default NULL,
  decimal_point char(1) default NULL,
  thousands_point char(1) default NULL,
  decimal_places char(1) default NULL,
  value decimal(14,6) default NULL,
  last_updated datetime default NULL,
  PRIMARY KEY  (currencies_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'customers'
#

DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
  customers_id int(11) NOT NULL auto_increment,
  customers_gender char(1) NOT NULL default '',
  customers_firstname varchar(32) NOT NULL default '',
  customers_lastname varchar(32) NOT NULL default '',
  customers_dob datetime NOT NULL default '0001-01-01 00:00:00',
  customers_email_address varchar(96) NOT NULL default '',
  customers_nick varchar(96) NOT NULL default '',
  customers_default_address_id int(11) NOT NULL default '0',
  customers_telephone varchar(32) NOT NULL default '',
  customers_fax varchar(32) default NULL,
  customers_password varchar(255) NOT NULL default '',
  customers_secret varchar(64) NOT NULL default '',
  customers_newsletter char(1) default NULL,
  customers_group_pricing int(11) NOT NULL default '0',
  customers_email_format varchar(4) NOT NULL default 'TEXT',
  customers_authorization int(1) NOT NULL default '0',
  customers_referral varchar(32) NOT NULL default '',
  registration_ip varchar(45) NOT NULL default '',
  last_login_ip varchar(45) NOT NULL default '',
  customers_paypal_payerid VARCHAR(20) NOT NULL default '',
  customers_paypal_ec TINYINT(1) UNSIGNED DEFAULT 0 NOT NULL,
  PRIMARY KEY  (customers_id),
  KEY idx_email_address_zen (customers_email_address),
  KEY idx_referral_zen (customers_referral(10)),
  KEY idx_grp_pricing_zen (customers_group_pricing),
  KEY idx_nick_zen (customers_nick),
  KEY idx_newsletter_zen (customers_newsletter)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'customers_basket'
#

DROP TABLE IF EXISTS customers_basket;
CREATE TABLE customers_basket (
  customers_basket_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  products_id tinytext NOT NULL,
  customers_basket_quantity float NOT NULL default '0',
  customers_basket_date_added varchar(8) default NULL,
  PRIMARY KEY  (customers_basket_id),
  KEY idx_customers_id_zen (customers_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'customers_basket_attributes'
#

DROP TABLE IF EXISTS customers_basket_attributes;
CREATE TABLE customers_basket_attributes (
  customers_basket_attributes_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  products_id tinytext NOT NULL,
  products_options_id varchar(64) NOT NULL default '0',
  products_options_value_id int(11) NOT NULL default '0',
  products_options_value_text BLOB NULL,
  products_options_sort_order text NOT NULL,
  PRIMARY KEY  (customers_basket_attributes_id),
  KEY idx_cust_id_prod_id_zen (customers_id,products_id(36))
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'customers_info'
#

DROP TABLE IF EXISTS customers_info;
CREATE TABLE customers_info (
  customers_info_id int(11) NOT NULL default '0',
  customers_info_date_of_last_logon datetime default NULL,
  customers_info_number_of_logons int(5) default NULL,
  customers_info_date_account_created datetime default NULL,
  customers_info_date_account_last_modified datetime default NULL,
  global_product_notifications int(1) default '0',
  PRIMARY KEY  (customers_info_id),
  KEY idx_date_created_cust_id_zen (customers_info_date_account_created, customers_info_id)
) ENGINE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table customer_groups - new since 1.5.7g
#
DROP TABLE IF EXISTS customer_groups;
CREATE TABLE customer_groups (
  group_id int UNSIGNED NOT NULL AUTO_INCREMENT,
  group_name varchar(191) NOT NULL,
  group_comment varchar(255),
  date_added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (group_id),
  UNIQUE KEY idx_groupname_zen (group_name)
);

# --------------------------------------------------------

#
# Table structure for table customers_to_groups - new since 1.5.7g
#
DROP TABLE IF EXISTS customers_to_groups;
CREATE TABLE customers_to_groups (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  group_id int UNSIGNED NOT NULL,
  customer_id int UNSIGNED NOT NULL,
  date_added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY idx_custid_groupid_zen (customer_id, group_id),
  KEY idx_groupid_custid_zen (group_id, customer_id)
);

# --------------------------------------------------------

#
# Table structure for table db_cache
#
DROP TABLE IF EXISTS db_cache;
CREATE TABLE db_cache (
  cache_entry_name varchar(64) NOT NULL default '',
  cache_data mediumblob,
  cache_entry_created int(15) default NULL,
  PRIMARY KEY  (cache_entry_name)
) ENGINE=MyISAM;



# --------------------------------------------------------

#
# Table structure for table 'email_archive'
#

DROP TABLE IF EXISTS email_archive;
CREATE TABLE email_archive (
  archive_id int(11) NOT NULL auto_increment,
  email_to_name varchar(96) NOT NULL default '',
  email_to_address varchar(96) NOT NULL default '',
  email_from_name varchar(96) NOT NULL default '',
  email_from_address varchar(96) NOT NULL default '',
  email_subject varchar(255) NOT NULL default '',
  email_html text NOT NULL,
  email_text text NOT NULL,
  date_sent datetime NOT NULL default '0001-01-01 00:00:00',
  module varchar(64) NOT NULL default '',
  PRIMARY KEY  (archive_id),
  KEY idx_email_to_address_zen (email_to_address),
  KEY idx_module_zen (module)
) ENGINE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table 'ezpages'
# Neue Struktur für multilanguage EZ Pages seit 1.5.6, page_key bleibt für IT Recht Kanzlei erhalten
# Zen Cart German Specific

DROP TABLE IF EXISTS ezpages;
CREATE TABLE ezpages (
  pages_id int(11) NOT NULL auto_increment,
  alt_url varchar(255) NOT NULL default '',
  alt_url_external varchar(255) NOT NULL default '',
  status_header int(1) NOT NULL default '1',
  status_sidebox int(1) NOT NULL default '1',
  status_footer int(1) NOT NULL default '1',
  status_visible int(1) NOT NULL default '0',
  status_toc int(1) NOT NULL default '1',
  header_sort_order int(3) NOT NULL default '0',
  sidebox_sort_order int(3) NOT NULL default '0',
  footer_sort_order int(3) NOT NULL default '0',
  toc_sort_order int(3) NOT NULL default '0',
  page_open_new_window int(1) NOT NULL default '0',
  page_is_ssl int(1) NOT NULL default '0',
  toc_chapter int(11) NOT NULL default '0',
  page_key varchar(64) NOT NULL DEFAULT '0',
  PRIMARY KEY  (pages_id),
  KEY idx_ezp_status_header_zen (status_header),
  KEY idx_ezp_status_sidebox_zen (status_sidebox),
  KEY idx_ezp_status_footer_zen (status_footer),
  KEY idx_ezp_status_toc_zen (status_toc)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'ezpages_content'
# Neue Tabelle seit 1.5.6
# Seit 1.5.6d korrekte Länge für pages_html_text

DROP TABLE IF EXISTS ezpages_content;
CREATE TABLE ezpages_content (
  pages_id int(11) NOT NULL DEFAULT '0',
  languages_id int(11) NOT NULL DEFAULT '1',
  pages_title varchar(64) NOT NULL DEFAULT '',
  pages_html_text mediumtext,
  UNIQUE KEY idx_ezpages_content (pages_id,languages_id),
  KEY idx_lang_id_zen (languages_id)
) ENGINE=MyISAM;

# --------------------------------------------------------
#
# Table structure for table 'featured'
#

DROP TABLE IF EXISTS featured;
CREATE TABLE featured (
  featured_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  featured_date_added datetime default NULL,
  featured_last_modified datetime default NULL,
  expires_date date NOT NULL default '0001-01-01',
  date_status_change datetime default NULL,
  status int(1) NOT NULL default '1',
  featured_date_available date NOT NULL default '0001-01-01',
  PRIMARY KEY  (featured_id),
  KEY idx_status_zen (status),
  KEY idx_products_id_zen (products_id),
  KEY idx_date_avail_zen (featured_date_available),
  KEY idx_expires_date_zen (expires_date)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'files_uploaded'
#

DROP TABLE IF EXISTS files_uploaded;
CREATE TABLE files_uploaded (
  files_uploaded_id int(11) NOT NULL auto_increment,
  sesskey varchar(32) default NULL,
  customers_id int(11) default NULL,
  files_uploaded_name varchar(64) NOT NULL default '',
  PRIMARY KEY  (files_uploaded_id),
  KEY idx_customers_id_zen (customers_id)
) ENGINE=MyISAM COMMENT='Must always have either a sesskey or customers_id';

# --------------------------------------------------------

#
# Table structure for table 'geo_zones'
#

DROP TABLE IF EXISTS geo_zones;
CREATE TABLE geo_zones (
  geo_zone_id int(11) NOT NULL auto_increment,
  geo_zone_name varchar(32) NOT NULL default '',
  geo_zone_description varchar(255) NOT NULL default '',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (geo_zone_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'get_terms_to_filter'
#
DROP TABLE IF EXISTS get_terms_to_filter;
CREATE TABLE get_terms_to_filter (
  get_term_name varchar(191) NOT NULL default '',
  get_term_table varchar(64) NOT NULL,
  get_term_name_field varchar(64) NOT NULL,
  PRIMARY KEY  (get_term_name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'group_pricing'
#

DROP TABLE IF EXISTS group_pricing;
CREATE TABLE group_pricing (
  group_id int(11) NOT NULL auto_increment,
  group_name varchar(32) NOT NULL default '',
  group_percentage decimal(5,2) NOT NULL default '0.00',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (group_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'languages'
#

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
  languages_id int(11) NOT NULL auto_increment,
  name varchar(32) NOT NULL default '',
  code char(2) NOT NULL default '',
  image varchar(64) default NULL,
  directory varchar(32) default NULL,
  sort_order int(3) default NULL,
  PRIMARY KEY  (languages_id),
  KEY idx_languages_name_zen (name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'layout_boxes'
#

DROP TABLE IF EXISTS layout_boxes;
CREATE TABLE layout_boxes (
  layout_id int(11) NOT NULL auto_increment,
  layout_template varchar(64) NOT NULL default '',
  layout_box_name varchar(64) NOT NULL default '',
  layout_box_status tinyint(1) NOT NULL default '0',
  layout_box_location tinyint(1) NOT NULL default '0',
  layout_box_sort_order int(11) NOT NULL default '0',
  layout_box_sort_order_single int(11) NOT NULL default '0',
  layout_box_status_single tinyint(4) NOT NULL default '0',
  plugin_details varchar(100) NOT NULL default '',
  PRIMARY KEY  (layout_id),
  KEY idx_name_template_zen (layout_template,layout_box_name),
  KEY idx_layout_box_status_zen (layout_box_status),
  KEY idx_layout_box_sort_order_zen (layout_box_sort_order)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'manufacturers'
#

DROP TABLE IF EXISTS manufacturers;
CREATE TABLE manufacturers (
  manufacturers_id int(11) NOT NULL auto_increment,
  manufacturers_name varchar(32) NOT NULL default '',
  manufacturers_image varchar(255) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (manufacturers_id),
  KEY idx_mfg_name_zen (manufacturers_name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'manufacturers_info'
#

DROP TABLE IF EXISTS manufacturers_info;
CREATE TABLE manufacturers_info (
  manufacturers_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  manufacturers_url varchar(255) NOT NULL default '',
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (manufacturers_id,languages_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'media_clips'
#

DROP TABLE IF EXISTS media_clips;
CREATE TABLE media_clips (
  clip_id int(11) NOT NULL auto_increment,
  media_id int(11) NOT NULL default '0',
  clip_type smallint(6) NOT NULL default '0',
  clip_filename text NOT NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  last_modified datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (clip_id),
  KEY idx_media_id_zen (media_id),
  KEY idx_clip_type_zen (clip_type)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'media_manager'
#

DROP TABLE IF EXISTS media_manager;
CREATE TABLE media_manager (
  media_id int(11) NOT NULL auto_increment,
  media_name varchar(255) NOT NULL default '',
  last_modified datetime NOT NULL default '0001-01-01 00:00:00',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (media_id),
  KEY idx_media_name_zen (media_name(191))
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'media_to_products'
#

DROP TABLE IF EXISTS media_to_products;
CREATE TABLE media_to_products (
  media_id int(11) NOT NULL default '0',
  product_id int(11) NOT NULL default '0',
  KEY idx_media_product_zen (media_id,product_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'media_types'
#

DROP TABLE IF EXISTS media_types;
CREATE TABLE media_types (
  type_id int(11) NOT NULL auto_increment,
  type_name varchar(64) NOT NULL default '',
  type_ext varchar(8) NOT NULL default '',
  PRIMARY KEY  (type_id),
  KEY idx_type_name_zen (type_name)
) ENGINE=MyISAM;

INSERT INTO media_types (type_name, type_ext) VALUES ('MP3','.mp3');

# -------------------------------------------------------

#
# Table structure for table 'meta_tags_categories_description'
#

DROP TABLE IF EXISTS meta_tags_categories_description;
CREATE TABLE meta_tags_categories_description (
  categories_id int(11) NOT NULL,
  language_id int(11) NOT NULL default '1',
  metatags_title varchar(255) NOT NULL default '',
  metatags_keywords text,
  metatags_description text,
  PRIMARY KEY  (categories_id,language_id)
) ENGINE=MyISAM;

# -------------------------------------------------------

#
# Table structure for table 'meta_tags_manufacturers_description'
# Zen Cart German Specific

DROP TABLE IF EXISTS meta_tags_manufacturers_description;
CREATE TABLE meta_tags_manufacturers_description (
  manufacturers_id int(11) NOT NULL,
  language_id int(11) NOT NULL default '1',
  metatags_title varchar(255) NOT NULL default '',
  metatags_keywords text,
  metatags_description text,
  PRIMARY KEY  (manufacturers_id,language_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'meta_tags_products_description'
#

DROP TABLE IF EXISTS meta_tags_products_description;
CREATE TABLE meta_tags_products_description (
  products_id int(11) NOT NULL,
  language_id int(11) NOT NULL default '1',
  metatags_title varchar(255) NOT NULL default '',
  metatags_keywords text,
  metatags_description text,
  PRIMARY KEY  (products_id,language_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'music_genre'
#

DROP TABLE IF EXISTS music_genre;
CREATE TABLE music_genre (
  music_genre_id int(11) NOT NULL auto_increment,
  music_genre_name varchar(32) NOT NULL default '',
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (music_genre_id),
  KEY idx_music_genre_name_zen (music_genre_name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'newsletters'
#

DROP TABLE IF EXISTS newsletters;
CREATE TABLE newsletters (
  newsletters_id int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  content text NOT NULL,
  content_html text NOT NULL,
  module varchar(255) NOT NULL default '',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  date_sent datetime default NULL,
  status int(1) default NULL,
  locked int(1) default '0',
  PRIMARY KEY  (newsletters_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'orders'
# Zen Cart German Specific
# shipping_tax_rate new since 1.5.7g
DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  orders_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default 0,
  customers_name varchar(64) NOT NULL default '',
  customers_company varchar(64) default NULL,
  customers_street_address varchar(64) NOT NULL default '',
  customers_suburb varchar(32) default NULL,
  customers_city varchar(32) NOT NULL default '',
  customers_postcode varchar(10) NOT NULL default '',
  customers_state varchar(32) default NULL,
  customers_country varchar(64) NOT NULL default '',
  customers_telephone varchar(32) NOT NULL default '',
  customers_email_address varchar(96) NOT NULL default '',
  customers_address_format_id int(5) NOT NULL default 0,
  delivery_name varchar(64) NOT NULL default '',
  delivery_company varchar(64) default NULL,
  delivery_street_address varchar(64) NOT NULL default '',
  delivery_suburb varchar(32) default NULL,
  delivery_city varchar(32) NOT NULL default '',
  delivery_postcode varchar(10) NOT NULL default '',
  delivery_state varchar(32) default NULL,
  delivery_country varchar(64) NOT NULL default '',
  delivery_address_format_id int(5) NOT NULL default 0,
  billing_name varchar(64) NOT NULL default '',
  billing_company varchar(64) default NULL,
  billing_street_address varchar(64) NOT NULL default '',
  billing_suburb varchar(32) default NULL,
  billing_city varchar(32) NOT NULL default '',
  billing_postcode varchar(10) NOT NULL default '',
  billing_state varchar(32) default NULL,
  billing_country varchar(64) NOT NULL default '',
  billing_address_format_id int(5) NOT NULL default 0,
  payment_method varchar(128) NOT NULL default '',
  payment_module_code varchar(32) NOT NULL default '',
  shipping_method varchar(255) default NULL,
  shipping_module_code varchar(32) NOT NULL default '',
  coupon_code varchar(32) NOT NULL default '',
  cc_type varchar(20) default NULL,
  cc_owner varchar(64) default NULL,
  cc_number varchar(32) default NULL,
  cc_expires varchar(4) default NULL,
  cc_cvv blob,
  last_modified datetime default NULL,
  date_purchased datetime default NULL,
  orders_status int(5) NOT NULL default 0,
  orders_date_finished datetime default NULL,
  currency char(3) default NULL,
  currency_value decimal(14,6) default NULL,
  order_total decimal(15,4) default NULL,
  order_tax decimal(15,4) default NULL,
  shipping_tax_rate decimal(15,4) DEFAULT NULL,
  paypal_ipn_id int(11) NOT NULL default 0,
  ip_address varchar(96) NOT NULL default '',
  order_device varchar(10) NOT NULL default '',
  order_weight float default NULL,
  language_code char(2) NOT NULL default '',
  PRIMARY KEY  (orders_id),
  KEY idx_status_orders_cust_zen (orders_status,orders_id,customers_id),
  KEY idx_date_purchased_zen (date_purchased),
  KEY idx_cust_id_orders_id_zen (customers_id,orders_id),
  KEY idx_status_date_id_zen (orders_status,date_purchased,orders_id)
) ENGINE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table 'orders_products'
#

DROP TABLE IF EXISTS orders_products;
CREATE TABLE orders_products (
  orders_products_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  products_id int(11) NOT NULL default '0',
  products_model varchar(32) default NULL,
  products_name varchar(191) NOT NULL default '',
  products_price decimal(15,4) NOT NULL default '0.0000',
  final_price decimal(15,4) NOT NULL default '0.0000',
  products_tax decimal(7,4) NOT NULL default '0.0000',
  products_quantity float NOT NULL default '0',
  onetime_charges decimal(15,4) NOT NULL default '0.0000',
  products_priced_by_attribute tinyint(1) NOT NULL default 0,
  product_is_free tinyint(1) NOT NULL default 0,
  products_discount_type tinyint(1) NOT NULL default 0,
  products_discount_type_from tinyint(1) NOT NULL default 0,
  products_prid tinytext NOT NULL,
  products_weight FLOAT default NULL,
  products_virtual tinyint(1) default NULL,
  product_is_always_free_shipping tinyint(1) default NULL,
  products_quantity_order_min float default NULL,
  products_quantity_order_units float default NULL,
  products_quantity_order_max float default NULL,
  products_quantity_mixed tinyint(1) default NULL,
  products_mixed_discount_quantity tinyint(1) default NULL,
  PRIMARY KEY  (orders_products_id),
  KEY idx_orders_id_prod_id_zen (orders_id,products_id),
  KEY idx_prod_id_orders_id_zen (products_id,orders_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'orders_products_attributes'
#

DROP TABLE IF EXISTS orders_products_attributes;
CREATE TABLE orders_products_attributes (
  orders_products_attributes_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_products_id int(11) NOT NULL default '0',
  products_options varchar(32) NOT NULL default '',
  products_options_values text NOT NULL,
  options_values_price decimal(15,4) NOT NULL default '0.0000',
  price_prefix char(1) NOT NULL default '',
  product_attribute_is_free tinyint(1) NOT NULL default '0',
  products_attributes_weight float NOT NULL default '0',
  products_attributes_weight_prefix char(1) NOT NULL default '',
  attributes_discounted tinyint(1) NOT NULL default '1',
  attributes_price_base_included tinyint(1) NOT NULL default '1',
  attributes_price_onetime decimal(15,4) NOT NULL default '0.0000',
  attributes_price_factor decimal(15,4) NOT NULL default '0.0000',
  attributes_price_factor_offset decimal(15,4) NOT NULL default '0.0000',
  attributes_price_factor_onetime decimal(15,4) NOT NULL default '0.0000',
  attributes_price_factor_onetime_offset decimal(15,4) NOT NULL default '0.0000',
  attributes_qty_prices text,
  attributes_qty_prices_onetime text,
  attributes_price_words decimal(15,4) NOT NULL default '0.0000',
  attributes_price_words_free int(4) NOT NULL default '0',
  attributes_price_letters decimal(15,4) NOT NULL default '0.0000',
  attributes_price_letters_free int(4) NOT NULL default '0',
  products_options_id int(11) NOT NULL default '0',
  products_options_values_id int(11) NOT NULL default '0',
  products_prid tinytext NOT NULL,
  PRIMARY KEY  (orders_products_attributes_id),
  KEY idx_orders_id_prod_id_zen (orders_id,orders_products_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'orders_products_download'
#

DROP TABLE IF EXISTS orders_products_download;
CREATE TABLE orders_products_download (
  orders_products_download_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default 0,
  orders_products_id int(11) NOT NULL default 0,
  orders_products_filename varchar(255) NOT NULL default '',
  download_maxdays int(2) NOT NULL default 0,
  download_count int(2) NOT NULL default 0,
  products_prid tinytext NOT NULL,
  products_attributes_id int(11) default NULL,
  PRIMARY KEY  (orders_products_download_id),
  KEY idx_orders_id_zen (orders_id),
  KEY idx_orders_products_id_zen (orders_products_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'orders_status'
# Neu seit 1.5.6e: sort_order

DROP TABLE IF EXISTS orders_status;
CREATE TABLE orders_status (
  orders_status_id int(11) NOT NULL default 0,
  language_id int(11) NOT NULL default 1,
  orders_status_name varchar(32) NOT NULL default '',
  sort_order int(11) NOT NULL default 0,
  PRIMARY KEY  (orders_status_id,language_id),
  KEY idx_orders_status_name_zen (orders_status_name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'orders_status_history'
#

DROP TABLE IF EXISTS orders_status_history;
CREATE TABLE orders_status_history (
  orders_status_history_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_status_id int(5) NOT NULL default '0',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  customer_notified int(1) default '0',
  comments text,
  updated_by varchar(45) NOT NULL default '',
  PRIMARY KEY  (orders_status_history_id),
  KEY idx_orders_id_status_id_zen (orders_id,orders_status_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'orders_total'
#

DROP TABLE IF EXISTS orders_total;
CREATE TABLE orders_total (
  orders_total_id int(10) unsigned NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  text varchar(255) NOT NULL default '',
  value decimal(15,4) NOT NULL default '0.0000',
  class varchar(32) NOT NULL default '',
  sort_order int(11) NOT NULL default '0',
  PRIMARY KEY  (orders_total_id),
  KEY idx_ot_orders_id_zen (orders_id),
  KEY idx_ot_class_zen (class),
  KEY idx_oid_class_zen (orders_id, class)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'paypal'
#

DROP TABLE IF EXISTS paypal;
CREATE TABLE paypal (
  paypal_ipn_id int(11) unsigned NOT NULL auto_increment,
  order_id int(11) unsigned NOT NULL default '0',
  txn_type varchar(40) NOT NULL default '',
  module_name varchar(40) NOT NULL default '',
  module_mode varchar(40) NOT NULL default '',
  reason_code varchar(40) default NULL,
  payment_type varchar(40) NOT NULL default '',
  payment_status varchar(32) NOT NULL default '',
  pending_reason varchar(32) default NULL,
  invoice varchar(128) default NULL,
  mc_currency char(3) NOT NULL default '',
  first_name varchar(32) NOT NULL default '',
  last_name varchar(32) NOT NULL default '',
  payer_business_name varchar(128) default NULL,
  address_name varchar(64) default NULL,
  address_street varchar(254) default NULL,
  address_city varchar(120) default NULL,
  address_state varchar(120) default NULL,
  address_zip varchar(10) default NULL,
  address_country varchar(64) default NULL,
  address_status varchar(11) default NULL,
  payer_email varchar(128) NOT NULL default '',
  payer_id varchar(32) NOT NULL default '',
  payer_status varchar(10) NOT NULL default '',
  payment_date datetime NOT NULL default '0001-01-01 00:00:00',
  business varchar(128) NOT NULL default '',
  receiver_email varchar(128) NOT NULL default '',
  receiver_id varchar(32) NOT NULL default '',
  txn_id varchar(20) NOT NULL default '',
  parent_txn_id varchar(20) default NULL,
  num_cart_items tinyint(4) unsigned NOT NULL default '1',
  mc_gross decimal(15,4) NOT NULL default '0.00',
  mc_fee decimal(15,4) NOT NULL default '0.00',
  payment_gross decimal(15,4) default NULL,
  payment_fee decimal(15,4) default NULL,
  settle_amount decimal(15,4) default NULL,
  settle_currency char(3) default NULL,
  exchange_rate decimal(15,4) default NULL,
  notify_version varchar(6) NOT NULL default '',
  verify_sign varchar(128) NOT NULL default '',
  last_modified datetime NOT NULL default '0001-01-01 00:00:00',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  memo text,
  PRIMARY KEY (paypal_ipn_id,txn_id),
  KEY idx_order_id_zen (order_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'paypal_payment_status'
#

DROP TABLE IF EXISTS paypal_payment_status;
CREATE TABLE paypal_payment_status (
  payment_status_id int(11) NOT NULL auto_increment,
  payment_status_name varchar(64) NOT NULL default '',
  PRIMARY KEY (payment_status_id)
) ENGINE=MyISAM;

#
# Dumping data for table 'paypal_payment_status'
#

INSERT INTO paypal_payment_status VALUES (1, 'Completed');
INSERT INTO paypal_payment_status VALUES (2, 'Pending');
INSERT INTO paypal_payment_status VALUES (3, 'Failed');
INSERT INTO paypal_payment_status VALUES (4, 'Denied');
INSERT INTO paypal_payment_status VALUES (5, 'Refunded');
INSERT INTO paypal_payment_status VALUES (6, 'Canceled_Reversal');
INSERT INTO paypal_payment_status VALUES (7, 'Reversed');

# --------------------------------------------------------

#
# Table structure for table 'paypal_payment_status_history'
#

DROP TABLE IF EXISTS paypal_payment_status_history;
CREATE TABLE paypal_payment_status_history (
  payment_status_history_id int(11) NOT NULL auto_increment,
  paypal_ipn_id int(11) NOT NULL default '0',
  txn_id varchar(64) NOT NULL default '',
  parent_txn_id varchar(64) NOT NULL default '',
  payment_status varchar(17) NOT NULL default '',
  pending_reason varchar(32) default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY (payment_status_history_id),
  KEY idx_paypal_ipn_id_zen (paypal_ipn_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'paypal_session'
#

DROP TABLE IF EXISTS paypal_session;
CREATE TABLE paypal_session (
  unique_id int(11) NOT NULL auto_increment,
  session_id text NOT NULL,
  saved_session mediumblob NOT NULL,
  expiry int(17) NOT NULL default '0',
  PRIMARY KEY  (unique_id),
  KEY idx_session_id_zen (session_id(36))
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'paypal_testing'
#

DROP TABLE IF EXISTS paypal_testing;
CREATE TABLE paypal_testing (
  paypal_ipn_id int(11) unsigned NOT NULL auto_increment,
  order_id int(11) unsigned NOT NULL default '0',
  custom varchar(255) NOT NULL default '',
  txn_type varchar(40) NOT NULL default '',
  module_name varchar(40) NOT NULL default '',
  module_mode varchar(40) NOT NULL default '',
  reason_code varchar(40) default NULL,
  payment_type varchar(40) NOT NULL default '',
  payment_status varchar(32) NOT NULL default '',
  pending_reason varchar(32) default NULL,
  invoice varchar(128) default NULL,
  mc_currency char(3) NOT NULL default '',
  first_name varchar(32) NOT NULL default '',
  last_name varchar(32) NOT NULL default '',
  payer_business_name varchar(128) default NULL,
  address_name varchar(64) default NULL,
  address_street varchar(254) default NULL,
  address_city varchar(120) default NULL,
  address_state varchar(120) default NULL,
  address_zip varchar(10) default NULL,
  address_country varchar(64) default NULL,
  address_status varchar(11) default NULL,
  payer_email varchar(128) NOT NULL default '',
  payer_id varchar(32) NOT NULL default '',
  payer_status varchar(10) NOT NULL default '',
  payment_date datetime NOT NULL default '0001-01-01 00:00:00',
  business varchar(128) NOT NULL default '',
  receiver_email varchar(128) NOT NULL default '',
  receiver_id varchar(32) NOT NULL default '',
  txn_id varchar(20) NOT NULL default '',
  parent_txn_id varchar(20) default NULL,
  num_cart_items tinyint(4) unsigned NOT NULL default '1',
  mc_gross decimal(7,2) NOT NULL default '0.00',
  mc_fee decimal(7,2) NOT NULL default '0.00',
  payment_gross decimal(7,2) default NULL,
  payment_fee decimal(7,2) default NULL,
  settle_amount decimal(7,2) default NULL,
  settle_currency char(3) default NULL,
  exchange_rate decimal(4,2) default NULL,
  notify_version decimal(2,1) NOT NULL default '0.0',
  verify_sign varchar(128) NOT NULL default '',
  last_modified datetime NOT NULL default '0001-01-01 00:00:00',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  memo text,
  PRIMARY KEY  (paypal_ipn_id,txn_id),
  KEY idx_order_id_zen (order_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'plugin_control'
# new since 1.5.7g

DROP TABLE IF EXISTS plugin_control;
CREATE TABLE plugin_control (
  unique_key varchar(40) NOT NULL,
  name varchar(64) NOT NULL default '',
  description text,
  type varchar(11) NOT NULL default 'free',
  managed tinyint(1) NOT NULL default 0,
  status tinyint(1) NOT NULL default 0,
  author varchar(64) NOT NULL,
  version varchar(10),
  zc_versions text NOT NULL,
  zc_contrib_id int(11),
  infs tinyint(1) NOT NULL default 0,
  PRIMARY KEY  (unique_key)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'plugin_control_versions'
# new since 1.5.7g

DROP TABLE IF EXISTS plugin_control_versions;
CREATE TABLE plugin_control_versions (
  unique_key varchar(40) NOT NULL,
  version varchar(10),
  author varchar(64) NOT NULL,
  zc_versions text NOT NULL,
  infs tinyint(1) NOT NULL default 0,
  PRIMARY KEY  (unique_key, version)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'plugin_groups'
# new since 1.5.7g

DROP TABLE IF EXISTS plugin_groups;
CREATE TABLE plugin_groups (
  unique_key varchar(20) NOT NULL,
  PRIMARY KEY  (unique_key)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'plugin_groups_description'
# new since 1.5.7g

DROP TABLE IF EXISTS plugin_groups_description;
CREATE TABLE plugin_groups_description (
  plugin_group_unique_key varchar(20) NOT NULL,
  language_id int(11) NOT NULL default 1,
  name varchar(64) NOT NULL default '',
  PRIMARY KEY  (plugin_group_unique_key,language_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'product_music_extra'
#

DROP TABLE IF EXISTS product_music_extra;
CREATE TABLE product_music_extra (
  products_id int(11) NOT NULL default '0',
  artists_id int(11) NOT NULL default '0',
  record_company_id int(11) NOT NULL default '0',
  music_genre_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_id),
  KEY idx_music_genre_id_zen (music_genre_id),
  KEY idx_artists_id_zen (artists_id),
  KEY idx_record_company_id_zen (record_company_id)
) ENGINE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table 'product_type_layout'
#
DROP TABLE IF EXISTS product_type_layout;
CREATE TABLE product_type_layout (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title text NOT NULL,
  configuration_key varchar(180) NOT NULL default '',
  configuration_value text NOT NULL,
  configuration_description text NOT NULL,
  product_type_id int(11) NOT NULL default '0',
  sort_order int(5) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  use_function text default NULL,
  set_function text default NULL,
  PRIMARY KEY  (configuration_id),
  UNIQUE KEY unq_config_key_zen (configuration_key),
  KEY idx_key_value_zen (configuration_key,configuration_value(10)),
  KEY idx_type_id_sort_order_zen (product_type_id,sort_order)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'product_type_layout_language'
# Zen Cart German Specific

DROP TABLE IF EXISTS product_type_layout_language;
CREATE TABLE product_type_layout_language (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title text NOT NULL,
  configuration_key varchar(191) NOT NULL default '',
  languages_id int(11) NOT NULL default '1',
  configuration_description text NOT NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (configuration_id),
  UNIQUE KEY config_lang (configuration_key, languages_id),
  KEY languages_id (languages_id)
) ENGINE=MyISAM ;


# --------------------------------------------------------

#
# Table structure for table 'product_types'
#

DROP TABLE IF EXISTS product_types;
CREATE TABLE product_types (
  type_id int(11) NOT NULL auto_increment,
  type_name varchar(255) NOT NULL default '',
  type_handler varchar(255) NOT NULL default '',
  type_master_type int(11) NOT NULL default '1',
  allow_add_to_cart char(1) NOT NULL default 'Y',
  default_image varchar(255) NOT NULL default '',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  last_modified datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (type_id),
  KEY idx_type_master_type_zen (type_master_type)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'product_types_to_category'
#

DROP TABLE IF EXISTS product_types_to_category;
CREATE TABLE product_types_to_category (
  product_type_id int(11) NOT NULL default '0',
  category_id int(11) NOT NULL default '0',
  KEY idx_category_id_zen (category_id),
  KEY idx_product_type_id_zen (product_type_id)
) ENGINE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table 'products'
#

DROP TABLE IF EXISTS products;
CREATE TABLE products (
  products_id int(11) NOT NULL auto_increment,
  products_type int(11) NOT NULL default '1',
  products_quantity float NOT NULL default '0',
  products_model varchar(32) default NULL,
  products_image varchar(255) default NULL,
  products_price decimal(15,4) NOT NULL default '0.0000',
  products_virtual tinyint(1) NOT NULL default '0',
  products_date_added datetime NOT NULL default '0001-01-01 00:00:00',
  products_last_modified datetime default NULL,
  products_date_available datetime default NULL,
  products_weight float NOT NULL default '0',
  products_status tinyint(1) NOT NULL default '0',
  products_tax_class_id int(11) NOT NULL default '0',
  manufacturers_id int(11) default NULL,
  products_ordered float NOT NULL default '0',
  products_quantity_order_min float NOT NULL default '1',
  products_quantity_order_units float NOT NULL default '1',
  products_priced_by_attribute tinyint(1) NOT NULL default '0',
  product_is_free tinyint(1) NOT NULL default '0',
  product_is_call tinyint(1) NOT NULL default '0',
  products_quantity_mixed tinyint(1) NOT NULL default '0',
  product_is_always_free_shipping tinyint(1) NOT NULL default '0',
  products_qty_box_status tinyint(1) NOT NULL default '1',
  products_quantity_order_max float NOT NULL default '0',
  products_sort_order int(11) NOT NULL default '0',
  products_discount_type tinyint(1) NOT NULL default '0',
  products_discount_type_from tinyint(1) NOT NULL default '0',
  products_price_sorter decimal(15,4) NOT NULL default '0.0000',
  master_categories_id int(11) NOT NULL default '0',
  products_mixed_discount_quantity tinyint(1) NOT NULL default '1',
  metatags_title_status tinyint(1) NOT NULL default '0',
  metatags_products_name_status tinyint(1) NOT NULL default '0',
  metatags_model_status tinyint(1) NOT NULL default '0',
  metatags_price_status tinyint(1) NOT NULL default '0',
  metatags_title_tagline_status tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (products_id),
  KEY idx_products_date_added_zen (products_date_added),
  KEY idx_products_status_zen (products_status),
  KEY idx_products_date_available_zen (products_date_available),
  KEY idx_products_ordered_zen (products_ordered),
  KEY idx_products_model_zen (products_model),
  KEY idx_products_price_sorter_zen (products_price_sorter),
  KEY idx_master_categories_id_zen (master_categories_id),
  KEY idx_products_sort_order_zen (products_sort_order),
  KEY idx_manufacturers_id_zen (manufacturers_id)
) ENGINE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table 'products_attributes'
#

DROP TABLE IF EXISTS products_attributes;
CREATE TABLE products_attributes (
  products_attributes_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  options_id int(11) NOT NULL default '0',
  options_values_id int(11) NOT NULL default '0',
  options_values_price decimal(15,4) NOT NULL default '0.0000',
  price_prefix char(1) NOT NULL default '',
  products_options_sort_order int(11) NOT NULL default '0',
  product_attribute_is_free tinyint(1) NOT NULL default '0',
  products_attributes_weight float NOT NULL default '0',
  products_attributes_weight_prefix char(1) NOT NULL default '',
  attributes_display_only tinyint(1) NOT NULL default '0',
  attributes_default tinyint(1) NOT NULL default '0',
  attributes_discounted tinyint(1) NOT NULL default '1',
  attributes_image varchar(255) default NULL,
  attributes_price_base_included tinyint(1) NOT NULL default '1',
  attributes_price_onetime decimal(15,4) NOT NULL default '0.0000',
  attributes_price_factor decimal(15,4) NOT NULL default '0.0000',
  attributes_price_factor_offset decimal(15,4) NOT NULL default '0.0000',
  attributes_price_factor_onetime decimal(15,4) NOT NULL default '0.0000',
  attributes_price_factor_onetime_offset decimal(15,4) NOT NULL default '0.0000',
  attributes_qty_prices text,
  attributes_qty_prices_onetime text,
  attributes_price_words decimal(15,4) NOT NULL default '0.0000',
  attributes_price_words_free int(4) NOT NULL default '0',
  attributes_price_letters decimal(15,4) NOT NULL default '0.0000',
  attributes_price_letters_free int(4) NOT NULL default '0',
  attributes_required tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (products_attributes_id),
  KEY idx_id_options_id_values_zen (products_id,options_id,options_values_id),
  KEY idx_opt_sort_order_zen (products_options_sort_order)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'products_attributes_download'
#

DROP TABLE IF EXISTS products_attributes_download;
CREATE TABLE products_attributes_download (
  products_attributes_id int(11) NOT NULL default '0',
  products_attributes_filename varchar(255) NOT NULL default '',
  products_attributes_maxdays int(2) default '0',
  products_attributes_maxcount int(2) default '0',
  PRIMARY KEY  (products_attributes_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'products_description'
# Zen Cart German Specific

DROP TABLE IF EXISTS products_description;
CREATE TABLE products_description (
  products_id int(11) NOT NULL,
  language_id int(11) NOT NULL default '1',
  products_name varchar(191) NOT NULL default '',
  products_description text,
  products_merkmale varchar(255) NOT NULL default '',
  products_url varchar(255) default NULL,
  products_viewed int(5) default '0',
  PRIMARY KEY  (products_id,language_id),
  KEY idx_products_name_zen (products_name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'products_discount_quantity'
#
DROP TABLE IF EXISTS products_discount_quantity;
CREATE TABLE products_discount_quantity (
  discount_id int(4) NOT NULL default '0',
  products_id int(11) NOT NULL default '0',
  discount_qty float NOT NULL default '0',
  discount_price decimal(15,4) NOT NULL default '0.0000',
  KEY idx_id_qty_zen (products_id,discount_qty)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'products_notifications'
#

DROP TABLE IF EXISTS products_notifications;
CREATE TABLE products_notifications (
  products_id int(11) NOT NULL default '0',
  customers_id int(11) NOT NULL default '0',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (products_id,customers_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'products_options'
#

DROP TABLE IF EXISTS products_options;
CREATE TABLE products_options (
  products_options_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  products_options_name varchar(32) NOT NULL default '',
  products_options_sort_order int(11) NOT NULL default '0',
  products_options_type int(5) NOT NULL default '0',
  products_options_length smallint(2) NOT NULL default '32',
  products_options_comment varchar(256) default NULL,
  products_options_comment_position smallint(2) NOT NULL default '0',
  products_options_size smallint(2) NOT NULL default '32',
  products_options_images_per_row int(2) default '5',
  products_options_images_style int(1) default '0',
  products_options_rows smallint(2) NOT NULL default '1',
  PRIMARY KEY  (products_options_id,language_id),
  KEY idx_lang_id_zen (language_id),
  KEY idx_products_options_sort_order_zen (products_options_sort_order),
  KEY idx_products_options_name_zen (products_options_name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'products_options_types'
#

DROP TABLE IF EXISTS products_options_types;
CREATE TABLE products_options_types (
  products_options_types_id int(11) NOT NULL default '0',
  products_options_types_name varchar(32) default NULL,
  PRIMARY KEY  (products_options_types_id)
) ENGINE=MyISAM COMMENT='Track products_options_types';

# --------------------------------------------------------

#
# Table structure for table 'products_options_values'
#

DROP TABLE IF EXISTS products_options_values;
CREATE TABLE products_options_values (
  products_options_values_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  products_options_values_name varchar(64) NOT NULL default '',
  products_options_values_sort_order int(11) NOT NULL default '0',
  PRIMARY KEY (products_options_values_id,language_id),
  KEY idx_products_options_values_name_zen (products_options_values_name),
  KEY idx_products_options_values_sort_order_zen (products_options_values_sort_order)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'products_options_values_to_products_options'
#

DROP TABLE IF EXISTS products_options_values_to_products_options;
CREATE TABLE products_options_values_to_products_options (
  products_options_values_to_products_options_id int(11) NOT NULL auto_increment,
  products_options_id int(11) NOT NULL default '0',
  products_options_values_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_options_values_to_products_options_id),
  KEY idx_products_options_id_zen (products_options_id),
  KEY idx_products_options_values_id_zen (products_options_values_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'products_to_categories'
#

DROP TABLE IF EXISTS products_to_categories;
CREATE TABLE products_to_categories (
  products_id int(11) NOT NULL default '0',
  categories_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_id,categories_id),
  KEY idx_cat_prod_id_zen (categories_id,products_id)
) ENGINE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table 'products_xsell'
# Zen Cart German Specific
# changed table structure since 1.5.7 German

DROP TABLE IF EXISTS products_xsell;
CREATE TABLE products_xsell (
  ID int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL,
  xsell_id int(11) NOT NULL,
  sort_order int(11) NOT NULL default '1',
  PRIMARY KEY (ID), 
  KEY idx_products_id_xsell (products_id)
) ENGINE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table 'project_version'
#

DROP TABLE IF EXISTS project_version;
CREATE TABLE project_version (
  project_version_id tinyint(3) NOT NULL auto_increment,
  project_version_key varchar(40) NOT NULL default '',
  project_version_major varchar(20) NOT NULL default '',
  project_version_minor varchar(20) NOT NULL default '',
  project_version_patch1 varchar(20) NOT NULL default '',
  project_version_patch2 varchar(20) NOT NULL default '',
  project_version_patch1_source varchar(20) NOT NULL default '',
  project_version_patch2_source varchar(20) NOT NULL default '',
  project_version_comment varchar(250) NOT NULL default '',
  project_version_date_applied datetime NOT NULL default '0001-01-01 01:01:01',
  PRIMARY KEY  (project_version_id),
  UNIQUE KEY idx_project_version_key_zen (project_version_key)
) ENGINE=MyISAM COMMENT='Database Version Tracking';


# --------------------------------------------------------

#
# Table structure for table 'project_version_history'
#
DROP TABLE IF EXISTS project_version_history;
CREATE TABLE project_version_history (
  project_version_id tinyint(3) NOT NULL auto_increment,
  project_version_key varchar(40) NOT NULL default '',
  project_version_major varchar(20) NOT NULL default '',
  project_version_minor varchar(20) NOT NULL default '',
  project_version_patch varchar(20) NOT NULL default '',
  project_version_comment varchar(250) NOT NULL default '',
  project_version_date_applied datetime NOT NULL default '0001-01-01 01:01:01',
  PRIMARY KEY  (project_version_id)
) ENGINE=MyISAM COMMENT='Database Version Tracking History';

# --------------------------------------------------------

#
# Table structure for table 'query_builder'
# This table is used by audiences.php for building data-extraction queries
#
DROP TABLE IF EXISTS query_builder;
CREATE TABLE query_builder (
  query_id int(11) NOT NULL auto_increment,
  query_category varchar(40) NOT NULL default '',
  query_name varchar(80) NOT NULL default '',
  query_description TEXT NOT NULL,
  query_string TEXT NOT NULL,
  query_keys_list TEXT NOT NULL,
  PRIMARY KEY  (query_id),
  UNIQUE KEY query_name (query_name)
) ENGINE=MyISAM COMMENT='Stores queries for re-use in Admin email and report modules';

# --------------------------------------------------------

#
# Table structure for table 'record_artists'
#

DROP TABLE IF EXISTS record_artists;
CREATE TABLE record_artists (
  artists_id int(11) NOT NULL auto_increment,
  artists_name varchar(32) NOT NULL default '',
  artists_image varchar(255) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (artists_id),
  KEY idx_rec_artists_name_zen (artists_name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'record_artists_info'
#

DROP TABLE IF EXISTS record_artists_info;
CREATE TABLE record_artists_info (
  artists_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  artists_url varchar(255) NOT NULL default '',
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (artists_id,languages_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'record_company'
#

DROP TABLE IF EXISTS record_company;
CREATE TABLE record_company (
  record_company_id int(11) NOT NULL auto_increment,
  record_company_name varchar(32) NOT NULL default '',
  record_company_image varchar(255) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (record_company_id),
  KEY idx_rec_company_name_zen (record_company_name)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'record_company_info'
#

DROP TABLE IF EXISTS record_company_info;
CREATE TABLE record_company_info (
  record_company_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  record_company_url varchar(255) NOT NULL default '',
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (record_company_id,languages_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'reviews'
#

DROP TABLE IF EXISTS reviews;
CREATE TABLE reviews (
  reviews_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  customers_id int(11) default NULL,
  customers_name varchar(64) NOT NULL default '',
  reviews_rating int(1) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  reviews_read int(5) NOT NULL default '0',
  status int(1) NOT NULL default '1',
  PRIMARY KEY  (reviews_id),
  KEY idx_products_id_zen (products_id),
  KEY idx_customers_id_zen (customers_id),
  KEY idx_status_zen (status),
  KEY idx_date_added_zen (date_added)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'reviews_description'
#

DROP TABLE IF EXISTS reviews_description;
CREATE TABLE reviews_description (
  reviews_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  reviews_text text NOT NULL,
  PRIMARY KEY  (reviews_id,languages_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'salemaker_sales'
#

DROP TABLE IF EXISTS salemaker_sales;
CREATE TABLE salemaker_sales (
  sale_id int(11) NOT NULL auto_increment,
  sale_status tinyint(4) NOT NULL default '0',
  sale_name varchar(128) NOT NULL default '',
  sale_deduction_value decimal(15,4) NOT NULL default '0.0000',
  sale_deduction_type tinyint(4) NOT NULL default '0',
  sale_pricerange_from decimal(15,4) NOT NULL default '0.0000',
  sale_pricerange_to decimal(15,4) NOT NULL default '0.0000',
  sale_specials_condition tinyint(4) NOT NULL default '0',
  sale_categories_selected text,
  sale_categories_all text,
  sale_date_start date NOT NULL default '0001-01-01',
  sale_date_end date NOT NULL default '0001-01-01',
  sale_date_added date NOT NULL default '0001-01-01',
  sale_date_last_modified date NOT NULL default '0001-01-01',
  sale_date_status_change date NOT NULL default '0001-01-01',
  PRIMARY KEY  (sale_id),
  KEY idx_sale_status_zen (sale_status),
  KEY idx_sale_date_start_zen (sale_date_start),
  KEY idx_sale_date_end_zen (sale_date_end)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'sessions'
# NOTE: requires minimum MySQL 5.0.3 for varchar(256)
# NOTE: leaving it at (191) to be compatible with utf8mb4, but if PHP is configured to use 256 char session IDs then this will break.
#

DROP TABLE IF EXISTS sessions;
CREATE TABLE sessions (
  sesskey varchar(191) NOT NULL default '',
  expiry int(11) unsigned NOT NULL default 0,
  value mediumblob NOT NULL,
  PRIMARY KEY  (sesskey)
) ENGINE=InnoDB;

# --------------------------------------------------------

#
# Table structure for table 'specials'
#

DROP TABLE IF EXISTS specials;
CREATE TABLE specials (
  specials_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  specials_new_products_price decimal(15,4) NOT NULL default '0.0000',
  specials_date_added datetime default NULL,
  specials_last_modified datetime default NULL,
  expires_date date NOT NULL default '0001-01-01',
  date_status_change datetime default NULL,
  status int(1) NOT NULL default '1',
  specials_date_available date NOT NULL default '0001-01-01',
  PRIMARY KEY  (specials_id),
  KEY idx_status_zen (status),
  KEY idx_products_id_zen (products_id),
  KEY idx_date_avail_zen (specials_date_available),
  KEY idx_expires_date_zen (expires_date)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'tax_class'
#

DROP TABLE IF EXISTS tax_class;
CREATE TABLE tax_class (
  tax_class_id int(11) NOT NULL auto_increment,
  tax_class_title varchar(32) NOT NULL default '',
  tax_class_description varchar(255) NOT NULL default '',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (tax_class_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'tax_rates'
#

DROP TABLE IF EXISTS tax_rates;
CREATE TABLE tax_rates (
  tax_rates_id int(11) NOT NULL auto_increment,
  tax_zone_id int(11) NOT NULL default '0',
  tax_class_id int(11) NOT NULL default '0',
  tax_priority int(5) default '1',
  tax_rate decimal(7,4) NOT NULL default '0.0000',
  tax_description varchar(255) NOT NULL default '',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (tax_rates_id),
  KEY idx_tax_zone_id_zen (tax_zone_id),
  KEY idx_tax_class_id_zen (tax_class_id)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'template_select'
#

DROP TABLE IF EXISTS template_select;
CREATE TABLE template_select (
  template_id int(11) NOT NULL auto_increment,
  template_dir varchar(64) NOT NULL default '',
  template_language varchar(64) NOT NULL default '0',
  PRIMARY KEY  (template_id),
  KEY idx_tpl_lang_zen (template_language)
) ENGINE=MyISAM;

# --------------------------------------------------------


#
# Table structure for table 'whos_online'
# NOTE: session_id needs to be same length (er, at least as long) as sesskey in 'sessions' table.
#

DROP TABLE IF EXISTS whos_online;
CREATE TABLE whos_online (
  customer_id int(11) default NULL,
  full_name varchar(64) NOT NULL default '',
  session_id varchar(191) NOT NULL default '',
  ip_address varchar(45) NOT NULL default '',
  time_entry varchar(14) NOT NULL default '',
  time_last_click varchar(14) NOT NULL default '',
  last_page_url varchar(255) NOT NULL default '',
  host_address text NOT NULL,
  user_agent varchar(255) NOT NULL default '',
  KEY idx_ip_address_zen (ip_address),
  KEY idx_session_id_zen (session_id),
  KEY idx_customer_id_zen (customer_id),
  KEY idx_time_entry_zen (time_entry),
  KEY idx_time_last_click_zen (time_last_click),
  KEY idx_last_page_url_zen (last_page_url(191))
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'zones'
#

DROP TABLE IF EXISTS zones;
CREATE TABLE zones (
  zone_id int(11) NOT NULL auto_increment,
  zone_country_id int(11) NOT NULL default '0',
  zone_code varchar(32) NOT NULL default '',
  zone_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (zone_id),
  KEY idx_zone_country_id_zen (zone_country_id),
  KEY idx_zone_code_zen (zone_code)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'zones_to_geo_zones'
#

DROP TABLE IF EXISTS zones_to_geo_zones;
CREATE TABLE zones_to_geo_zones (
  association_id int(11) NOT NULL auto_increment,
  zone_country_id int(11) NOT NULL default '0',
  zone_id int(11) default NULL,
  geo_zone_id int(11) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (association_id),
  KEY idx_zones_zen (geo_zone_id,zone_country_id,zone_id)
) ENGINE=MyISAM;


# default data

INSERT INTO template_select (template_id, template_dir, template_language) VALUES (1, 'responsive_classic', '0');

# 1 - Default, 2 Latvia, 3-4 Historic, 5 - Germany, 6 - UK/GB default, 7 - USA / Austrailia, 8 - Hong Kong, 9 - Italy, 10 - Singapore, 11 - Brazil, 12 - Peru, 13 - Nigeria, 14 - Panama, 15 - Oman, 16 - Venezuela, 17 - Philippians, 18 - Vietnam, 19 - Hungary, 20 - Spain
INSERT INTO address_format VALUES (1, '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country','Default $city, $postcode / $state, $country');
INSERT INTO address_format VALUES (2, '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country','city, $state $postcode');
INSERT INTO address_format VALUES (3, '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','Historic $city / $postcode - $statecomma$country');
INSERT INTO address_format VALUES (4, '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', 'Historic $city ($postcode)');
INSERT INTO address_format VALUES (5, '$firstname $lastname$cr$streets$cr$postcode $city$cr$country','postcode $city');
INSERT INTO address_format VALUES (6, '$firstname $lastname$cr$streets$cr$city$cr$state$cr$postcode$cr$country','$city / $state / $postcode');
INSERT INTO address_format VALUES (7, '$firstname $lastname$cr$streets$cr$city $state $postcode$cr$country','$city $state $postcode');
INSERT INTO address_format VALUES (8,'$firstname $lastname$cr$streets$cr$city$cr$country','$city');
INSERT INTO address_format VALUES (9,'$firstname $lastname$cr$streets$cr$postcode $city $state$cr$country','$postcode $city $state');
INSERT INTO address_format VALUES (10,'$firstname $lastname$cr$streets$cr$city $postcode$cr$country','$city $postcode');
INSERT INTO address_format VALUES (11,'$firstname $lastname$cr$streets$cr$city $state$cr$postcode$cr$country','$city $state / $postcode');
INSERT INTO address_format VALUES (12,'$firstname $lastname$cr$streets$cr$postcode$cr$city $state$cr$country','$postcode / $city / $state');
INSERT INTO address_format VALUES (13,'$firstname $lastname$cr$streets$cr$city $postcode$cr$state$cr$country','$city $postcode / $state');
INSERT INTO address_format VALUES (14,'$firstname $lastname$cr$streets$cr$postcode $city$cr$state$cr$country','$postcode $city / $state');
INSERT INTO address_format VALUES (15,'$firstname $lastname$cr$streets$cr$postcode$cr$city$cr$state$cr$country','$postcode / $city / $state');
INSERT INTO address_format VALUES (16,'$firstname $lastname$cr$streets$cr$city $postcode $state$cr$country',' $city $postcode $state');
INSERT INTO address_format VALUES (17,'$firstname $lastname$cr$streets$cr$city$cr$postcode $state$cr$country',' $city / $postcode $state');
INSERT INTO address_format VALUES (18,'$firstname $lastname$cr$streets$cr$city$cr$state $postcode$cr$country','$city / $state $postcode');
INSERT INTO address_format VALUES (19,'$firstname $lastname$cr$city$cr$streets$cr$postcode$cr$country','$city $street / $postcode');
INSERT INTO address_format VALUES (20,'$firstname $lastname$cr$streets$cr$postcode $city ($state)$cr$country','$postcode $city ($state)');

INSERT INTO admin (admin_id, admin_name, admin_email, admin_pass, admin_profile, last_modified) VALUES
 (1, 'Admin', 'admin@localhost', '351683ea4e19efe34874b501fdbf9792:9b', 1, now());

# Insert default data into admin profiles table
INSERT INTO admin_profiles (profile_id, profile_name) VALUES (1, 'Superuser');

# Insert default data into admin_menus table
INSERT INTO admin_menus (menu_key, language_key, sort_order)
VALUES ('configuration', 'BOX_HEADING_CONFIGURATION', 1),
       ('catalog', 'BOX_HEADING_CATALOG', 2),
       ('modules', 'BOX_HEADING_MODULES', 3),
       ('customers', 'BOX_HEADING_CUSTOMERS', 4),
       ('taxes', 'BOX_HEADING_LOCATION_AND_TAXES', 5),
       ('localization', 'BOX_HEADING_LOCALIZATION', 6),
       ('reports', 'BOX_HEADING_REPORTS', 7),
       ('tools', 'BOX_HEADING_TOOLS', 8),
       ('gv', 'BOX_HEADING_GV_ADMIN', 9),
       ('access', 'BOX_HEADING_ADMIN_ACCESS', 10),
       ('extras', 'BOX_HEADING_EXTRAS', 11);

# Insert data into admin_pages table
# Zen Cart German Specific
INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order)
VALUES ('configMyStore', 'BOX_CONFIGURATION_MY_STORE', 'FILENAME_CONFIGURATION', 'gID=1', 'configuration', 'Y', 1),
       ('configMinimumValues', 'BOX_CONFIGURATION_MINIMUM_VALUES', 'FILENAME_CONFIGURATION', 'gID=2', 'configuration', 'Y', 2),
       ('configMaximumValues', 'BOX_CONFIGURATION_MAXIMUM_VALUES', 'FILENAME_CONFIGURATION', 'gID=3', 'configuration', 'Y', 3),
       ('configImages', 'BOX_CONFIGURATION_IMAGES', 'FILENAME_CONFIGURATION', 'gID=4', 'configuration', 'Y', 4),
       ('configCustomerDetails', 'BOX_CONFIGURATION_CUSTOMER_DETAILS', 'FILENAME_CONFIGURATION', 'gID=5', 'configuration', 'Y', 5),
       ('configShipping', 'BOX_CONFIGURATION_SHIPPING_PACKAGING', 'FILENAME_CONFIGURATION', 'gID=7', 'configuration', 'Y', 6),
       ('configProductListing', 'BOX_CONFIGURATION_PRODUCT_LISTING', 'FILENAME_CONFIGURATION', 'gID=8', 'configuration', 'Y', 7),
       ('configStock', 'BOX_CONFIGURATION_STOCK', 'FILENAME_CONFIGURATION', 'gID=9', 'configuration', 'Y', 8),
       ('configLogging', 'BOX_CONFIGURATION_LOGGING', 'FILENAME_CONFIGURATION', 'gID=10', 'configuration', 'Y', 9),
       ('configEmail', 'BOX_CONFIGURATION_EMAIL_OPTIONS', 'FILENAME_CONFIGURATION', 'gID=12', 'configuration', 'Y', 10),
       ('configAttributes', 'BOX_CONFIGURATION_ATTRIBUTE_OPTIONS', 'FILENAME_CONFIGURATION', 'gID=13', 'configuration', 'Y', 11),
       ('configGzipCompression', 'BOX_CONFIGURATION_GZIP_COMPRESSION', 'FILENAME_CONFIGURATION', 'gID=14', 'configuration', 'Y', 12),
       ('configSessions', 'BOX_CONFIGURATION_SESSIONS', 'FILENAME_CONFIGURATION', 'gID=15', 'configuration', 'Y', 13),
       ('configRegulations', 'BOX_CONFIGURATION_REGULATIONS', 'FILENAME_CONFIGURATION', 'gID=11', 'configuration', 'Y', 14),
       ('configGvCoupons', 'BOX_CONFIGURATION_GV_COUPONS', 'FILENAME_CONFIGURATION', 'gID=16', 'configuration', 'Y', 15),
       ('configCreditCards', 'BOX_CONFIGURATION_CREDIT_CARDS', 'FILENAME_CONFIGURATION', 'gID=17', 'configuration', 'Y', 16),
       ('configProductInfo', 'BOX_CONFIGURATION_PRODUCT_INFO', 'FILENAME_CONFIGURATION', 'gID=18', 'configuration', 'Y', 17),
       ('configLayoutSettings', 'BOX_CONFIGURATION_LAYOUT_SETTINGS', 'FILENAME_CONFIGURATION', 'gID=19', 'configuration', 'Y', 18),
       ('configWebsiteMaintenance', 'BOX_CONFIGURATION_WEBSITE_MAINTENANCE', 'FILENAME_CONFIGURATION', 'gID=20', 'configuration', 'Y', 19),
       ('configNewListing', 'BOX_CONFIGURATION_NEW_LISTING', 'FILENAME_CONFIGURATION', 'gID=21', 'configuration', 'Y', 20),
       ('configFeaturedListing', 'BOX_CONFIGURATION_FEATURED_LISTING', 'FILENAME_CONFIGURATION', 'gID=22', 'configuration', 'Y', 21),
       ('configAllListing', 'BOX_CONFIGURATION_ALL_LISTING', 'FILENAME_CONFIGURATION', 'gID=23', 'configuration', 'Y', 22),
       ('configIndexListing', 'BOX_CONFIGURATION_INDEX_LISTING', 'FILENAME_CONFIGURATION', 'gID=24', 'configuration', 'Y', 23),
       ('configDefinePageStatus', 'BOX_CONFIGURATION_DEFINE_PAGE_STATUS', 'FILENAME_CONFIGURATION', 'gID=25', 'configuration', 'Y', 24),
       ('configEzPagesSettings', 'BOX_CONFIGURATION_EZPAGES_SETTINGS', 'FILENAME_CONFIGURATION', 'gID=30', 'configuration', 'Y', 25),
       ('configMinifySettings', 'BOX_CONFIGURATION_MINIFY', 'FILENAME_CONFIGURATION', 'gID=31', 'configuration', 'Y', 31),   
       ('configSpamSettings', 'BOX_CONFIGURATION_SPAM_PROTECTION', 'FILENAME_CONFIGURATION', 'gID=32', 'configuration', 'Y', 32),     
       ('configFacebook','BOX_CONFIGURATION_FACEBOOK','FILENAME_CONFIGURATION', 'gID=33', 'configuration', 'Y', 33),
       ('configRSSFeed','BOX_CONFIGURATION_RSSFEED','FILENAME_CONFIGURATION', 'gID=34', 'configuration', 'Y', 34),
       ('configZenColorbox','BOX_CONFIGURATION_ZEN_COLORBOX','FILENAME_CONFIGURATION', 'gID=35', 'configuration', 'Y', 35),
       ('categories', 'BOX_CATALOG_CATEGORY', 'FILENAME_CATEGORIES', '', 'catalog', 'N', 18),
       ('categoriesProductListing', 'BOX_CATALOG_CATEGORIES_PRODUCTS', 'FILENAME_CATEGORY_PRODUCT_LISTING', '', 'catalog', 'Y', 1),
       ('productTypes', 'BOX_CATALOG_PRODUCT_TYPES', 'FILENAME_PRODUCT_TYPES', '', 'catalog', 'Y', 2),
       ('priceManager', 'BOX_CATALOG_PRODUCTS_PRICE_MANAGER', 'FILENAME_PRODUCTS_PRICE_MANAGER', '', 'catalog', 'Y', 3),
       ('optionNames', 'BOX_CATALOG_CATEGORIES_OPTIONS_NAME_MANAGER', 'FILENAME_OPTIONS_NAME_MANAGER', '', 'catalog', 'Y', 4),
       ('optionValues', 'BOX_CATALOG_CATEGORIES_OPTIONS_VALUES_MANAGER', 'FILENAME_OPTIONS_VALUES_MANAGER', '', 'catalog', 'Y', 5),
       ('attributes', 'BOX_CATALOG_CATEGORIES_ATTRIBUTES_CONTROLLER', 'FILENAME_ATTRIBUTES_CONTROLLER', '', 'catalog', 'Y', 6),
       ('downloads', 'BOX_CATALOG_CATEGORIES_ATTRIBUTES_DOWNLOADS_MANAGER', 'FILENAME_DOWNLOADS_MANAGER', '', 'catalog', 'Y', 7),
       ('optionNameSorter', 'BOX_CATALOG_PRODUCT_OPTIONS_NAME', 'FILENAME_PRODUCTS_OPTIONS_NAME', '', 'catalog', 'Y', 8),
       ('optionValueSorter', 'BOX_CATALOG_PRODUCT_OPTIONS_VALUES', 'FILENAME_PRODUCTS_OPTIONS_VALUES', '', 'catalog', 'Y', 9),
       ('manufacturers', 'BOX_CATALOG_MANUFACTURERS', 'FILENAME_MANUFACTURERS', '', 'catalog', 'Y', 10),
       ('reviews', 'BOX_CATALOG_REVIEWS', 'FILENAME_REVIEWS', '', 'catalog', 'Y', 11),
       ('specials', 'BOX_CATALOG_SPECIALS', 'FILENAME_SPECIALS', '', 'catalog', 'Y', 12),
       ('featured', 'BOX_CATALOG_FEATURED', 'FILENAME_FEATURED', '', 'catalog', 'Y', 13),
       ('salemaker', 'BOX_CATALOG_SALEMAKER', 'FILENAME_SALEMAKER', '', 'catalog', 'Y', 14),
       ('productsExpected', 'BOX_CATALOG_PRODUCTS_EXPECTED', 'FILENAME_PRODUCTS_EXPECTED', '', 'catalog', 'Y', 15),
       ('product', 'BOX_CATALOG_PRODUCT', 'FILENAME_PRODUCT', '', 'catalog', 'N', 16),
       ('productsToCategories', 'BOX_CATALOG_PRODUCTS_TO_CATEGORIES', 'FILENAME_PRODUCTS_TO_CATEGORIES', '', 'catalog', 'Y', 17),
       ('payment', 'BOX_MODULES_PAYMENT', 'FILENAME_MODULES', 'set=payment', 'modules', 'Y', 1),
       ('shipping', 'BOX_MODULES_SHIPPING', 'FILENAME_MODULES', 'set=shipping', 'modules', 'Y', 2),      
       ('plugins', 'BOX_MODULES_PLUGINS', 'FILENAME_PLUGIN_MANAGER', '', 'modules', 'Y', 4),
       ('orderTotal', 'BOX_MODULES_ORDER_TOTAL', 'FILENAME_MODULES', 'set=ordertotal', 'modules', 'Y', 3),
       ('customers', 'BOX_CUSTOMERS_CUSTOMERS', 'FILENAME_CUSTOMERS', '', 'customers', 'Y', 1),
       ('customerGroups', 'BOX_CUSTOMERS_CUSTOMER_GROUPS', 'FILENAME_CUSTOMER_GROUPS', '', 'customers', 'Y', 3),
       ('orders', 'BOX_CUSTOMERS_ORDERS', 'FILENAME_ORDERS', '', 'customers', 'Y', 2),
       ('groupPricing', 'BOX_CUSTOMERS_GROUP_PRICING', 'FILENAME_GROUP_PRICING', '', 'customers', 'Y', 3),
       ('paypal', 'BOX_CUSTOMERS_PAYPAL', 'FILENAME_PAYPAL', '', 'customers', 'Y', 4),
       ('invoice', 'BOX_CUSTOMERS_INVOICE', 'FILENAME_ORDERS_INVOICE', '', 'customers', 'N', 5),
       ('packingslip', 'BOX_CUSTOMERS_PACKING_SLIP', 'FILENAME_ORDERS_PACKINGSLIP', '', 'customers', 'N', 6),
       ('countries', 'BOX_TAXES_COUNTRIES', 'FILENAME_COUNTRIES', '', 'taxes', 'Y', 1),
       ('zones', 'BOX_TAXES_ZONES', 'FILENAME_ZONES', '', 'taxes', 'Y', 2),
       ('geoZones', 'BOX_TAXES_GEO_ZONES', 'FILENAME_GEO_ZONES', '', 'taxes', 'Y', 3),
       ('taxClasses', 'BOX_TAXES_TAX_CLASSES', 'FILENAME_TAX_CLASSES', '', 'taxes', 'Y', 4),
       ('taxRates', 'BOX_TAXES_TAX_RATES', 'FILENAME_TAX_RATES', '', 'taxes', 'Y', 5),
       ('currencies', 'BOX_LOCALIZATION_CURRENCIES', 'FILENAME_CURRENCIES', '', 'localization', 'Y', 1),
       ('languages', 'BOX_LOCALIZATION_LANGUAGES', 'FILENAME_LANGUAGES', '', 'localization', 'Y', 2),
       ('ordersStatus', 'BOX_LOCALIZATION_ORDERS_STATUS', 'FILENAME_ORDERS_STATUS', '', 'localization', 'Y', 3),
       ('reportCustomers', 'BOX_REPORTS_ORDERS_TOTAL', 'FILENAME_STATS_CUSTOMERS', '', 'reports', 'Y', 1),
       ('reportReferrals', 'BOX_REPORTS_CUSTOMERS_REFERRALS', 'FILENAME_STATS_CUSTOMERS_REFERRALS', '', 'reports', 'Y', 2),
       ('reportLowStock', 'BOX_REPORTS_PRODUCTS_LOWSTOCK', 'FILENAME_STATS_PRODUCTS_LOWSTOCK', '', 'reports', 'Y', 3),
       ('reportProductsSold', 'BOX_REPORTS_PRODUCTS_PURCHASED', 'FILENAME_STATS_PRODUCTS_PURCHASED', '', 'reports', 'Y', 4),
       ('reportProductsViewed', 'BOX_REPORTS_PRODUCTS_VIEWED', 'FILENAME_STATS_PRODUCTS_VIEWED', '', 'reports', 'Y', 5),
       ('stats_sales_report', 'BOX_REPORTS_SALES_REPORT', 'FILENAME_STATS_SALES_REPORT', '', 'reports', 'Y', 6),
       ('stats_disabled_stock', 'BOX_REPORTS_DISABLED_STOCK', 'FILENAME_STATS_DISABLED_STOCK', '', 'reports', 'Y', 7),
       ('templateSelect', 'BOX_TOOLS_TEMPLATE_SELECT', 'FILENAME_TEMPLATE_SELECT', '', 'tools', 'Y', 1),
       ('layoutController', 'BOX_TOOLS_LAYOUT_CONTROLLER', 'FILENAME_LAYOUT_CONTROLLER', '', 'tools', 'Y', 2),
       ('banners', 'BOX_TOOLS_BANNER_MANAGER', 'FILENAME_BANNER_MANAGER', '', 'tools', 'Y', 3),
       ('mail', 'BOX_TOOLS_MAIL', 'FILENAME_MAIL', '', 'tools', 'Y', 4),
       ('newsletters', 'BOX_TOOLS_NEWSLETTER_MANAGER', 'FILENAME_NEWSLETTERS', '', 'tools', 'Y', 5),
       ('server', 'BOX_TOOLS_SERVER_INFO', 'FILENAME_SERVER_INFO', '', 'tools', 'Y', 6),
       ('whosOnline', 'BOX_TOOLS_WHOS_ONLINE', 'FILENAME_WHOS_ONLINE', '', 'tools', 'Y', 7),
       ('storeManager', 'BOX_TOOLS_STORE_MANAGER', 'FILENAME_STORE_MANAGER', '', 'tools', 'Y', 9),
       ('developersToolKit', 'BOX_TOOLS_DEVELOPERS_TOOL_KIT', 'FILENAME_DEVELOPERS_TOOL_KIT', '', 'tools', 'Y', 10),
       ('ezpages', 'BOX_TOOLS_EZPAGES', 'FILENAME_EZPAGES_ADMIN', '', 'tools', 'Y', 11),
       ('definePagesEditor', 'BOX_TOOLS_DEFINE_PAGES_EDITOR', 'FILENAME_DEFINE_PAGES_EDITOR', '', 'tools', 'Y', 12),
       ('sqlPatch', 'BOX_TOOLS_SQLPATCH', 'FILENAME_SQLPATCH', '', 'tools', 'Y', 13),
       ('emailExport', 'BOX_TOOLS_EMAIL_EXPORT', 'FILENAME_EMAIL_EXPORT', '', 'tools', 'Y', 14),
       ('ImageHandler', 'BOX_TOOLS_IMAGE_HANDLER', 'FILENAME_IMAGE_HANDLER', '', 'tools', 'Y', 15),
       ('toolsImageHandlerViewConfig', 'BOX_TOOLS_IMAGE_HANDLER_VIEW_CONFIG', 'FILENAME_IMAGE_HANDLER_VIEW_CONFIG', '', 'tools', 'N', 99),
       ('emailArchive', 'BOX_TOOLS_EMAIL_ARCHIVE_MANAGER', 'FILENAME_EMAIL_HISTORY', '', 'tools', 'Y', 16),
       ('toolsDisplayLogs', 'BOX_TOOLS_DISPLAY_LOGS', 'FILENAME_DISPLAY_LOGS', '', 'tools', 'Y', 17),
       ('backup_mysql', 'BOX_TOOLS_BACKUP_MYSQL', 'FILENAME_BACKUP_MYSQL', '', 'tools', 'Y', 18),
       ('couponAdmin', 'BOX_COUPON_ADMIN', 'FILENAME_COUPON_ADMIN', '', 'gv', 'Y', 1),
       ('couponRestrict', 'BOX_COUPON_RESTRICT', 'FILENAME_COUPON_RESTRICT', '', 'gv', 'N', 1),
       ('gvQueue', 'BOX_GV_ADMIN_QUEUE', 'FILENAME_GV_QUEUE', '', 'gv', 'Y', 2),
       ('gvMail', 'BOX_GV_ADMIN_MAIL', 'FILENAME_GV_MAIL', '', 'gv', 'Y', 3),
       ('gvSent', 'BOX_GV_ADMIN_SENT', 'FILENAME_GV_SENT', '', 'gv', 'Y', 4),
       ('profiles', 'BOX_ADMIN_ACCESS_PROFILES', 'FILENAME_PROFILES', '', 'access', 'Y', 1),
       ('users', 'BOX_ADMIN_ACCESS_USERS', 'FILENAME_USERS', '', 'access', 'Y', 2),
       ('pageRegistration', 'BOX_ADMIN_ACCESS_PAGE_REGISTRATION', 'FILENAME_ADMIN_PAGE_REGISTRATION', '', 'access', 'Y', 3),
       ('adminlogs', 'BOX_ADMIN_ACCESS_LOGS', 'FILENAME_ADMIN_ACTIVITY', '', 'access', 'Y', 4),
       ('recordArtists', 'BOX_CATALOG_RECORD_ARTISTS', 'FILENAME_RECORD_ARTISTS', '', 'extras', 'Y', 1),
       ('recordCompanies', 'BOX_CATALOG_RECORD_COMPANY', 'FILENAME_RECORD_COMPANY', '', 'extras', 'Y', 2),
       ('musicGenre', 'BOX_CATALOG_MUSIC_GENRE', 'FILENAME_MUSIC_GENRE', '', 'extras', 'Y', 3),
       ('mediaManager', 'BOX_CATALOG_MEDIA_MANAGER', 'FILENAME_MEDIA_MANAGER', '', 'extras', 'Y', 4),
       ('mediaTypes', 'BOX_CATALOG_MEDIA_TYPES', 'FILENAME_MEDIA_TYPES', '', 'extras', 'Y', 5),
       ('adresskorrekturvornehmen', 'DO_ADRESSKORREKTUR', 'FILENAME_ADRESSKORREKTUR', '', 'customers', 'N', 101),
       ('customers_without_order', 'BOX_CUSTOMERS_WITHOUT_ORDER', 'FILENAME_CUSTOMERS_WITHOUT_ORDER', '', 'customers', 'Y', 30),
       ('dsgvo_kundenexport', 'BOX_DSGVO_KUNDENEXPORT', 'FILENAME_DSGVO_KUNDENEXPORT', '', 'customers', 'Y', 31),
       ('uploads', 'BOX_CUSTOMERS_UPLOADS', 'FILENAME_UPLOADS', '', 'customers', 'Y', 32),       
       ('configITRechtKanzlei', 'BOX_CONFIGURATION_IT_RECHT_KANZLEI', 'FILENAME_CONFIGURATION', 'gID=36', 'configuration', 'Y', 36),
       ('toolsITRechtKanzlei', 'BOX_TOOLS_IT_RECHT_KANZLEI', 'FILENAME_IT_RECHT_KANZLEI', '', 'tools', 'Y', 100),
       ('configPDF3', 'BOX_CONFIGURATION_PDF3', 'FILENAME_CONFIGURATION', 'gID=37', 'configuration', 'Y', 37),
       ('toolsPDF3', 'BOX_TOOLS_PDF3', 'RL_INVOICE3_ADMIN_FILENAME', '', 'tools', 'Y', 37),
       ('GeneratePDFInvoice', 'GENERATE_RL_INVOICE3', 'FILENAME_RL_INVOICE3', '', 'customers', 'N', 37),
       ('configShopvote', 'BOX_CONFIGURATION_SHOPVOTE', 'FILENAME_CONFIGURATION', 'gID=38', 'configuration', 'Y', 38),
       ('toolsShopvote', 'BOX_TOOLS_SHOPVOTE', 'FILENAME_SHOPVOTE', '', 'tools', 'Y', 101),
       ('findDuplicates', 'BOX_TOOLS_FINDDUPMODELS','FILENAME_FINDDUPMODELS', '', 'tools', 'Y', 102),
       ('configCrossSell','BOX_CONFIGURATION_XSELL','FILENAME_CONFIGURATION', 'gID=39', 'configuration','Y',39),
       ('catalogCrossSell','BOX_CATALOG_XSELL','FILENAME_XSELL','','catalog','Y',100), 
       ('customersBraintreeTransactions','BOX_CUSTOMERS_BRAINTREE_TRANSACTIONS','FILENAME_BRAINTREE_TRANSACTIONS','','customers','Y',100);    


# Insert a default profile for managing orders, as a built-in example of profile functionality
INSERT INTO admin_profiles (profile_name) values ('Bestellbearbeitung');
SET @profile_id=last_insert_id();
INSERT INTO admin_pages_to_profiles (profile_id, page_key) VALUES
(@profile_id, 'customers'),
(@profile_id, 'mail'),
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


INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Amnesty International', 'http://www.amnesty.at', 'banners/amnesty.gif', 'Wide-Banners', '', 0, NULL, NULL, '2013-09-25 20:59:12', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Zen Cart - Deutsche Version', 'https://www.zen-cart-pro.at', 'banners/125zen_logo.gif', 'SideBox-Banners', '', 0, NULL, NULL, '2013-09-25 20:59:12', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Aerzte ohne Grenzen', 'http://www.aerzte-ohne-grenzen.de', 'banners/aerzte-ohne-grenzen.gif', 'SideBox-Banners', '', 0, NULL, NULL, '2013-09-25 20:59:12', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('if you have to think ... you haven''t been Zenned!', 'http://www.zen-cart.com', 'banners/think_anim.gif', 'Wide-Banners', '', 0, NULL, NULL, '2013-01-12 20:53:18', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Zen Cart the art of e-commerce', 'http://www.zen-cart.com', 'banners/bw_zen_88wide.gif', 'BannersAll', '', 0, NULL, NULL, '2013-05-13 10:54:38', NULL, 1, 1, 1, 10);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Start Accepting Credit Cards For Your Business Today!', 'http://www.zen-cart.com/partners/payment', 'banners/cardsvcs_468x60.gif', 'Wide-Banners', '', 0, NULL, NULL, '2013-03-13 11:02:43', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('eStart Your Web Store with Zen Cart(R)', 'http://www.zen-cart.com/book', 'banners/big-book-ad.gif', 'Wide-Banners', '', '0', NULL, NULL, '2013-02-10 00:00:00',NULL,'1','1','1','1');
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Greenpeace', 'http://www.greenpeace.de', 'banners/greenpeace.gif', 'SideBox-Banners', '', '0', NULL, NULL, '2013-02-10 00:00:00',NULL,'1','1','1','1');
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Greenpeace', 'http://www.greenpeace.de', 'banners/greenpeace.gif', 'BannersAll', '', '0', NULL, NULL, '2013-02-10 00:00:00',NULL,'1','1','1','15');


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Store Name', 'STORE_NAME', '', 'The name of my store', '1', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Store Owner', 'STORE_OWNER', '', 'The name of my store owner', '1', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Telephone - Customer Service', 'STORE_TELEPHONE_CUSTSERVICE', '', 'Enter a telephone number for customers to reach your Customer Service department. This number may be sent as part of payment transaction details.', '1', '3', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Country', 'STORE_COUNTRY', '14', 'The country my store is located in <br /><br /><strong>Note: Please remember to update the store zone.</strong>', '1', '6', 'zen_get_country_name', 'zen_cfg_pull_down_country_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Zone', 'STORE_ZONE', '95', 'The zone my store is located in', '1', '7', 'zen_cfg_get_zone_name', 'zen_cfg_pull_down_zone_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Expected Sort Order', 'EXPECTED_PRODUCTS_SORT', 'desc', 'This is the sort order used in the expected products box.', '1', '8', 'zen_cfg_select_option(array(\'asc\', \'desc\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Expected Sort Field', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'The column to sort by in the expected products box.', '1', '9', 'zen_cfg_select_option(array(\'products_name\', \'date_expected\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Switch To Default Language Currency', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', 'Automatically switch to the language\'s currency when it is changed', '1', '10', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Language Selector', 'LANGUAGE_DEFAULT_SELECTOR', 'Default', 'Should the default language be based on the Store preferences, or the customer\'s browser settings?<br /><br />Default: Store\'s default settings', '1', '11', 'zen_cfg_select_option(array(\'Default\', \'Browser\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use Search-Engine Safe URLs (still in development)', 'SEARCH_ENGINE_FRIENDLY_URLS', 'false', 'Use search-engine safe urls for all site links', '6', '12', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Cart After Adding Product', 'DISPLAY_CART', 'true', 'Display the shopping cart after adding a product (or return back to their origin)', '1', '14', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Default Search Operator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Default search operators', '1', '17', 'zen_cfg_select_option(array(\'and\', \'or\'), ', now());
# New setting since 1.5.6e, enabling product meta-tags to be conditionally included in search results.
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) VALUES ('Include meta-tags in product search?', 'ADVANCED_SEARCH_INCLUDE_METATAGS', 'true', 'Should a product\'s meta-tag keywords and meta-tag descriptions be considered in any <code>advanced_search_results</code> displayed?', 1, 18, now(), 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Address and Phone', 'STORE_NAME_ADDRESS', 'Name des Shops\nAdresse des Shops\nLand\nTelefonnummer', 'This is the Store Name, Address and Phone used on printable documents and displayed online', '1', '7', 'zen_cfg_textarea(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Category Counts', 'SHOW_COUNTS', 'true', 'Count recursively how many products are in each category', '1', '19', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Tax Decimal Places', 'TAX_DECIMAL_PLACES', '0', 'Pad the tax value this amount of decimal places', '1', '20', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Prices with Tax', 'DISPLAY_PRICE_WITH_TAX', 'true', 'Display prices with tax included (true) or add the tax at the end (false)', '1', '21', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Prices with Tax in Admin', 'DISPLAY_PRICE_WITH_TAX_ADMIN', 'true', 'Display prices with tax included (true) or add the tax at the end (false) in Admin (Invoices)', '1', '21', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Basis of Product Tax', 'STORE_PRODUCT_TAX_BASIS', 'Shipping', 'On what basis is Product Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone', '1', '21', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Basis of Shipping Tax', 'STORE_SHIPPING_TAX_BASIS', 'Shipping', 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone - Can be overriden by correctly written Shipping Module', '1', '21', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Sales Tax Display Status', 'STORE_TAX_DISPLAY_STATUS', '0', 'Always show Sales Tax even when amount is $0.00?<br />0= Off<br />1= On', '1', '21', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Split Tax Lines', 'SHOW_SPLIT_TAX_CHECKOUT', 'true', 'If multiple tax rates apply, show each rate as a separate line at checkout', '1', '22', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('PA-DSS Admin Session Timeout Enforced?', 'PADSS_ADMIN_SESSION_TIMEOUT_ENFORCED', '1', 'PA-DSS Compliance requires that any Admin login sessions expire after 15 minutes of inactivity. <strong>Disabling this makes your site NON-COMPLIANT with PA-DSS rules, thus invalidating any certification.</strong>', 1, 30, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Non-Compliant\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('PA-DSS Strong Password Rules Enforced?', 'PADSS_PWD_EXPIRY_ENFORCED', '1', 'PA-DSS Compliance requires that admin passwords must be changed after 90 days and cannot re-use the last 4 passwords. <strong>Disabling this makes your site NON-COMPLIANT with PA-DSS rules, thus invalidating any certification.</strong>', 1, 30, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Non-Compliant\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('PA-DSS Ajax Checkout?', 'PADSS_AJAX_CHECKOUT', '1', 'PA-DSS Compliance requires that for some inbuilt payment methods, that we use ajax to draw the checkout confirmation screen. While this will only happen if one of those payment methods is actually present, some people may want the traditional checkout flow <strong>Disabling this makes your site NON-COMPLIANT with PA-DSS rules, thus invalidating any certification.</strong>', 1, 30, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Non-Compliant\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),');
# New since 1.5.7 - Admin storefront login configuration.  Using INSERT IGNORE followed by an UPDATE in consideration of shops with EMP already installed.
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Customer <em>Place Order</em>: Single Admin ID', 'EMP_LOGIN_ADMIN_ID', '0', 'Identify the ID number of an admin that is permitted to use the <em>Place Order</em> feature on the customers list, regardless of their assigned admin-profile. Set the value to 0 to disable the <em>Single Admin ID</em> feature.', 1, 300, now());
UPDATE configuration SET configuration_title = 'Customer <em>Place Order</em>: Single Admin ID', configuration_description = 'Identify the ID number of an admin that is permitted to use the <em>Place Order</em> feature on the customers list, regardless of their assigned admin-profile. Set the value to 0 to disable the <em>Single Admin ID</em> feature.' WHERE configuration_key = 'EMP_LOGIN_ADMIN_ID' LIMIT 1;
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) VALUES ('Customer <em>Place Order</em>: Passwordless Login', 'EMP_LOGIN_AUTOMATIC', 'true', 'Login directly to store without entering credentials', 1, 302, now(), 'zen_cfg_select_option(array(\'true\', \'false\'),');
UPDATE configuration SET configuration_title = 'Customer <em>Place Order</em>: Passwordless Login', configuration_description = 'Login directly to store without entering credentials' WHERE configuration_key = 'EMP_LOGIN_AUTOMATIC' LIMIT 1;
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Customer <em>Place Order</em>: Admin Profiles', 'EMP_LOGIN_ADMIN_PROFILE_ID', '1', 'Identify the admin <em>User Profile IDs</em> that are permitted to use the <em>Place Order</em> feature on the customers list &mdash; all admins that are in these profiles are permitted. Enter the value as a comma-separated list (intervening blanks are OK) of Admin Profile IDs, e.g. <b>1, 2, 3</b>. Set the value to 0 to disable the <em>Admin Profiles</em> feature.<br><br><b>Default: 0</b>', 1, 301, now());
UPDATE configuration SET configuration_title = 'Customer <em>Place Order</em>: Admin Profiles', configuration_description = 'Identify the admin <em>User Profile IDs</em> that are permitted to use the <em>Place Order</em> feature on the customers list &mdash; all admins that are in these profiles are permitted. Enter the value as a comma-separated list (intervening blanks are OK) of Admin Profile IDs, e.g. <b>1, 2, 3</b>. Set the value to 0 to disable the <em>Admin Profiles</em> feature.<br><br><b>Default: 0 </b>' WHERE configuration_key = 'EMP_LOGIN_ADMIN_PROFILE_ID' LIMIT 1;

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added) VALUES ('Admin Session Time Out in Seconds', 'SESSION_TIMEOUT_ADMIN', '900', 'Enter the time in seconds.<br />Max allowed is 900 for PCI Compliance Reasons.<br /> Default=900<br />Example: 900= 15 min <br /><br />Note: Too few seconds can result in timeout issues when adding/editing products', 1, 40, NULL, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Admin Set max_execution_time for processes', 'GLOBAL_SET_TIME_LIMIT', '60', 'Enter the time in seconds for how long the max_execution_time of processes should be. Default=60<br />Example: 60= 1 minute<br /><br />Note: Changing the time limit is only needed if you are having problems with the execution time of a process', 1, 42, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show if version update available', 'SHOW_VERSION_UPDATE_IN_HEADER', 'true', 'Automatically check to see if a new version of Zen Cart is available. Enabling this can sometimes slow down the loading of Admin pages. (Displayed on main Index page after login, and Server Info page.)', 1, 44, 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Status', 'STORE_STATUS', '0', 'What is your Store Status<br />0= Normal Store<br />1= Showcase no prices<br />2= Showcase with prices', '1', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Server Uptime', 'DISPLAY_SERVER_UPTIME', 'true', 'Displaying Server uptime can cause entries in error logs on some servers. (true = Display, false = don\'t display)', 1, 46, '2003-11-08 20:24:47', '0001-01-01 00:00:00', '', 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Missing Page Check', 'MISSING_PAGE_CHECK', 'Page Not Found', 'Zen Cart can check for missing pages in the URL and redirect to Index page. For debugging you may want to turn this off. <br /><br /><strong>Default=On</strong><br />On = Send missing pages to \'index\'<br />Off = Don\'t check for missing pages<br />Page Not Found = display the Page-Not-Found page', 1, 48, '2003-11-08 20:24:47', '0001-01-01 00:00:00', '', 'zen_cfg_select_option(array(\'On\', \'Off\', \'Page Not Found\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('cURL Proxy Status', 'CURL_PROXY_REQUIRED', 'False', 'Does your host require that you use a proxy for cURL communication?', 6, '50', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('cURL Proxy Address', 'CURL_PROXY_SERVER_DETAILS', '', 'If you have a hosting service that requires use of a proxy to talk to external sites via cURL, enter their proxy address here.<br />format: address:port<br />ie: 127.0.0.1:3128', 6, 51, NULL, now(), NULL, NULL);


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('HTML Editor', 'HTML_EDITOR_PREFERENCE', 'CKEDITOR', 'Please select the HTML/Rich-Text editor you wish to use for composing Admin-related emails, newsletters, and product descriptions', '1', '110', 'zen_cfg_pull_down_htmleditors(', now());
# New setting since 1.5.7, admin switch for default value for customer notification when editing an order.
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Default for Notify Customer on Order Status Update?', 'NOTIFY_CUSTOMER_DEFAULT', '1', 'Set the default email behavior on status update to Send Email, Do Not Send Email, or Hide Update.', 1, 140, now(), now(), NULL, 'zen_cfg_select_drop_down(array( array(\'id\'=>\'1\', \'text\'=>\'Email\'), array(\'id\'=>\'0\', \'text\'=>\'No Email\'), array(\'id\'=>\'-1\', \'text\'=>\'Hide\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Category Counts - Admin', 'SHOW_COUNTS_ADMIN', 'true', 'Show Category Counts in Admin?', '1', '19', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show linked status for categories', 'SHOW_CATEGORY_PRODUCTS_LINKED_STATUS', 'true', 'Show Category products linked status?', '1', '19', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Currency Conversion Ratio', 'CURRENCY_UPLIFT_RATIO', '1.05', 'When auto-updating currencies, what "uplift" ratio should be used to calculate the exchange rate used by your store?<br />ie: the bank rate is obtained from the currency-exchange servers; how much extra do you want to charge in order to make up the difference between the bank rate and the consumer rate?<br /><br /><strong>Default: 1.05 </strong><br />This will cause the published bank rate to be multiplied by 1.05 to set the currency rates in your store.', 1, 55, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Currency Exchange Rate: Primary Source', 'CURRENCY_SERVER_PRIMARY', 'ecb', 'Where to request external currency updates from (Primary source)<br><br>Additional sources can be installed via plugins.', '1', '55', 'zen_cfg_pull_down_exchange_rate_sources(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Currency Exchange Rate: Secondary Source', 'CURRENCY_SERVER_BACKUP', 'boc', 'Where to request external currency updates from (Secondary source)<br><br>Additional sources can be installed via plugins.', '1', '55', 'zen_cfg_pull_down_exchange_rate_sources(', now());


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('First Name', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', '{"error":"TEXT_MIN_ADMIN_FIRST_NAME_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of first name', '2', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Last Name', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', '{"error":"TEXT_MIN_ADMIN_LAST_NAME_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of last name', '2', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Date of Birth', 'ENTRY_DOB_MIN_LENGTH', '10', '{"error":"TEXT_MIN_ADMIN_DOB_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of date of birth', '2', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail Address', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', '{"error":"TEXT_MIN_ADMIN_EMAIL_ADDRESS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of e-mail address', '2', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Street Address', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', '{"error":"TEXT_MIN_ADMIN_STREET_ADDRESS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of street address', '2', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Company', 'ENTRY_COMPANY_MIN_LENGTH', '0', '{"error":"TEXT_MIN_ADMIN_COMPANY_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of company name', '2', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Post Code', 'ENTRY_POSTCODE_MIN_LENGTH', '4', '{"error":"TEXT_MIN_ADMIN_POSTCODE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of post code', '2', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('City', 'ENTRY_CITY_MIN_LENGTH', '2', '{"error":"TEXT_MIN_ADMIN_CITY_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of city', '2', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('State', 'ENTRY_STATE_MIN_LENGTH', '2', '{"error":"TEXT_MIN_ADMIN_STATE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of state', '2', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Telephone Number', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', '{"error":"TEXT_MIN_ADMIN_TELEPHONE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of telephone number', '2', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Password', 'ENTRY_PASSWORD_MIN_LENGTH', '7', '{"error":"TEXT_MIN_ADMIN_PASSWORD_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of password', '2', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card Owner Name', 'CC_OWNER_MIN_LENGTH', '3', '{"error":"TEXT_MIN_ADMIN_CC_OWNER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of credit card owner name', '2', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card Number', 'CC_NUMBER_MIN_LENGTH', '10', '{"error":"TEXT_MIN_ADMIN_CC_NUMBER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of credit card number', '2', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card CVV Number', 'CC_CVV_MIN_LENGTH', '3', '{"error":"TEXT_MIN_ADMIN_CC_CVV_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of credit card CVV number', '2', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Review Text', 'REVIEW_TEXT_MIN_LENGTH', '50', '{"error":"TEXT_MIN_ADMIN_REVIEW_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of product review text', '2', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Best Sellers', 'MIN_DISPLAY_BESTSELLERS', '1', '{"error":"TEXT_MIN_ADMIN_DISPLAY_BESTSELLERS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum number of best sellers to display', '2', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Also Purchased Products', 'MIN_DISPLAY_ALSO_PURCHASED', '1', '{"error":"TEXT_MIN_ADMIN_DISPLAY_ALSO_PURCHASED_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum number of products to display in the \'Also Purchased\' box', '2', '16', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Nick Name', 'ENTRY_NICK_MIN_LENGTH', '3', '{"error":"TEXT_MIN_ADMIN_ENTRY_NICK_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Minimum length of Nick Name', '2', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Admin Usernames', 'ADMIN_NAME_MINIMUM_LENGTH', '4', '{"error":"TEXT_MIN_ADMIN_USER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":4}}}', 'Minimum length of admin usernames (must be 4 or more)', '2', '18', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Address Book Entries', 'MAX_ADDRESS_BOOK_ENTRIES', '5', '{"error":"TEXT_MAX_ADMIN_ADDRESS_BOOK_ENTRIES_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum address book entries a customer is allowed to have', '3', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Admin Search Results Per Page', 'MAX_DISPLAY_SEARCH_RESULTS', '20', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of products to list on an Admin search result page', '3', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Prev/Next Navigation Page Links (Desktop)', 'MAX_DISPLAY_PAGE_LINKS', '5', '{"error":"TEXT_MAX_ADMIN_DISPLAY_PAGE_LINKS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of numbered pagination links to display.', '3', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Prev/Next Navigation Page Links (Mobile)', 'MAX_DISPLAY_PAGE_LINKS_MOBILE', '3', '{"error":"TEXT_MAX_ADMIN_DISPLAY_PAGE_LINKS_MOBILE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of numbered pagination links to display on Mobile devices (assuming your template supports mobile-specific settings)', '3', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products on Special ', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '9', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SPECIAL_PRODUCTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of products on special to display', '3', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Products Module', 'MAX_DISPLAY_NEW_PRODUCTS', '9', '{"error":"TEXT_MAX_ADMIN_DISPLAY_NEW_PRODUCTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of new products to display in a category', '3', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Upcoming Products ', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '10', '{"error":"TEXT_MAX_ADMIN_DISPLAY_UPCOMING_PRODUCTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of \'upcoming\' products to display', '3', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Manufacturers List - Scroll Box Size/Style', 'MAX_MANUFACTURERS_LIST', '3', '{"error":"TEXT_MAX_ADMIN_MANUFACTURERS_LIST_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of manufacturers names to be displayed in the scroll box window. Setting this to 1 or 0 will display a dropdown list.', '3', '7', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Manufacturers List - Verify Product Exist', 'PRODUCTS_MANUFACTURERS_STATUS', '1', 'Verify that at least 1 product exists and is active for the manufacturer name to show<br /><br />Note: When this feature is ON it can produce slower results on sites with a large number of products and/or manufacturers<br />0= off 1= on', 3, 7, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Music Genre List - Scroll Box Size/Style', 'MAX_MUSIC_GENRES_LIST', '3', '{"error":"TEXT_MAX_ADMIN_MUSIC_GENRES_LIST_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of music genre names to be displayed in the scroll box window. Setting this to 1 or 0 will display a dropdown list.', '3', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Record Company List - Scroll Box Size/Style', 'MAX_RECORD_COMPANY_LIST', '3', '{"error":"TEXT_MAX_ADMIN_RECORD_COMPANY_LIST_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of record company names to be displayed in the scroll box window. Setting this to 1 or 0 will display a dropdown list.', '3', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Length of Record Company Name', 'MAX_DISPLAY_RECORD_COMPANY_NAME_LEN', '15', '{"error":"TEXT_MAX_ADMIN_RECORD_COMPANY_NAME_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Used in record companies box; maximum length of record company name to display. Longer names will be truncated.', '3', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Length of Music Genre Name', 'MAX_DISPLAY_MUSIC_GENRES_NAME_LEN', '15', '{"error":"TEXT_MAX_ADMIN_MUSIC_GENRES_NAME_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Used in music genres box; maximum length of music genre name to display. Longer names will be truncated.', '3', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Length of Manufacturers Name', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', '{"error":"TEXT_MAX_ADMIN_DISPLAY_MANUFACTURERS_NAME_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Used in manufacturers box; maximum length of manufacturers name to display. Longer names will be truncated.', '3', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Product Reviews Per Page', 'MAX_DISPLAY_NEW_REVIEWS', '6', '{"error":"TEXT_MAX_ADMIN_DISPLAY_NEW_REVIEWS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of new reviews to display on each page', '3', '9', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random Product Reviews for SideBox', 'MAX_RANDOM_SELECT_REVIEWS', '1', '{"error":"TEXT_MAX_ADMIN_RANDOM_SELECT_REVIEWS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of random product REVIEWS to rotate in the sidebox<br />Enter the number of products to display in this sidebox at one time.<br /><br />How many products do you want to display in this sidebox?', '3', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random New Products for SideBox', 'MAX_RANDOM_SELECT_NEW', '3', '{"error":"TEXT_MAX_ADMIN_RANDOM_SELECT_NEW_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of random NEW products to rotate in the sidebox<br />Enter the number of products to display in this sidebox at one time.<br /><br />How many products do you want to display in this sidebox?', '3', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random Products On Special for SideBox', 'MAX_RANDOM_SELECT_SPECIALS', '2', '{"error":"TEXT_MAX_ADMIN_RANDOM_SELECT_SPECIALS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of random products on SPECIAL to rotate in the sidebox<br />Enter the number of products to display in this sidebox at one time.<br /><br />How many products do you want to display in this sidebox?', '3', '12', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Categories To List Per Row', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', '{"error":"TEXT_MAX_ADMIN_DISPLAY_CATEGORIES_PER_ROW_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'How many categories to list per row', '3', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Products Listing- Number Per Page', 'MAX_DISPLAY_PRODUCTS_NEW', '10', '{"error":"TEXT_MAX_ADMIN_DISPLAY_PRODUCTS_NEW_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of new products listed per page', '3', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Best Sellers For Box', 'MAX_DISPLAY_BESTSELLERS', '10', '{"error":"TEXT_MAX_ADMIN_DISPLAY_BESTSELLERS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of best sellers to display in box', '3', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Also Purchased Products', 'MAX_DISPLAY_ALSO_PURCHASED', '6', '{"error":"TEXT_MAX_ADMIN_DISPLAY_ALSO_PURCHASED_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of products to display in the \'Also Purchased\' box', '3', '16', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Order History Box', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', '{"error":"TEXT_MAX_ADMIN_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of products to display in the order history box', '3', '17', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Customer Order History List Per Page', 'MAX_DISPLAY_ORDER_HISTORY', '10', '{"error":"TEXT_MAX_ADMIN_DISPLAY_ORDER_HISTORY_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of orders to display in the order history list in \'My Account\'', '3', '18', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Customers on Customers Page', 'MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER', '20', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_CUSTOMER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', '', 3, 19, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Orders on Orders Page', 'MAX_DISPLAY_SEARCH_RESULTS_ORDERS', '20', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_ORDERS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', '', 3, 20, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Products on Reports', 'MAX_DISPLAY_SEARCH_RESULTS_REPORTS', '20', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_RESULTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', '', 3, 21, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Categories Products Display List', 'MAX_DISPLAY_RESULTS_CATEGORIES', '10', '{"error":"TEXT_MAX_ADMIN_DISPLAY_RESULTS_CATEGORIES_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of products to list per screen', 3, 22, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Listing- Number Per Page', 'MAX_DISPLAY_PRODUCTS_LISTING', '10', '{"error":"TEXT_MAX_ADMIN_DISPLAY_PRODUCTS_LISTING_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum Number of Products to list per page on main page', '3', '30', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Attributes - Option Names and Values Display', 'MAX_ROW_LISTS_OPTIONS', '10', '{"error":"TEXT_MAX_ADMIN_ROW_LISTS_OPTIONS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum number of option names and values to display in the products attributes page', '3', '24', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Attributes - Attributes Controller Display', 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER', '30', '{"error":"TEXT_MAX_ADMIN_ROW_LISTS_ATTRIBUTES_CONTROLLER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum number of attributes to display in the Attributes Controller page', '3', '25', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Attributes - Downloads Manager Display', 'MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER', '30', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum number of attributes downloads to display in the Downloads Manager page', '3', '26', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Featured Products - Number to Display Admin', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN', '10', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of featured products to list per screen - Admin', 3, 27, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Featured Products - Main Page', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED', '9', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_FEATURED_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of featured products to list on main page', 3, 28, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Featured Products Page', 'MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS', '10', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_FEATURED_PRODUCTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of featured products to list per screen', 3, 29, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random Featured Products for SideBox', 'MAX_RANDOM_SELECT_FEATURED_PRODUCTS', '2', '{"error":"TEXT_MAX_ADMIN_RANDOM_SELECT_FEATURED_PRODUCTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of random FEATURED products to rotate in the sidebox<br />Enter the number of products to display in this sidebox at one time.<br /><br />How many products do you want to display in this sidebox?', '3', '30', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Specials Products - Main Page', 'MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX', '9', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SPECIAL_PRODUCTS_INDEX_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of special products to list on main page', 3, 31, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('New Product Listing - Limited to ...', 'SHOW_NEW_PRODUCTS_LIMIT', '0', '{"error":"TEXT_MAX_ADMIN_SHOW_NEW_PRODUCTS_LIMIT_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Limit the New Product Listing to<br />0= All Products<br />1= Current Month<br />7= 7 Days<br />14= 14 Days<br />30= 30 Days<br />60= 60 Days<br />90= 90 Days<br />120= 120 Days', '3', '40', 'zen_cfg_select_option(array(\'0\', \'1\', \'7\', \'14\', \'30\', \'60\', \'90\', \'120\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Products All Page', 'MAX_DISPLAY_PRODUCTS_ALL', '10', '{"error":"TEXT_MAX_ADMIN_DISPLAY_PRODUCTS_ALL_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of products to list per screen', 3, 45, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Language Flags in Language Side Box', 'MAX_LANGUAGE_FLAGS_COLUMNS', '3', '{"error":"TEXT_MAX_ADMIN_LANGUAGE_FLAGS_COLUMNS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Number of Language Flags per Row', 3, 50, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum File Upload Size', 'MAX_FILE_UPLOAD_SIZE', '2048000', '{"error":"TEXT_MAX_ADMIN_FILE_UPLOAD_SIZE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'What is the Maximum file size for uploads?<br />Default= 2048000', 3, 60, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Orders Detail Display on Admin Orders Listing', 'MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING', '0', '{"error":"TEXT_MAX_ADMIN_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum number of Order Details<br />0 = Unlimited', 3, 65, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum PayPal IPN Display on Admin Listing', 'MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN', '20', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum number of PayPal IPN Listings in Admin<br />Default is 20', 3, 66, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display Columns Products to Multiple Categories Manager', 'MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS', '3', '{"error":"TEXT_MAX_ADMIN_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum Display Columns Products to Multiple Categories Manager<br />3 = Default', 3, 70, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display EZ-Pages', 'MAX_DISPLAY_SEARCH_RESULTS_EZPAGE', '20', '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_EZPAGE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum Display EZ-Pages<br />20 = Default', 3, 71, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Preview', 'MAX_PREVIEW', '100', '{"error":"TEXT_MAX_PREVIEW","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum Preview length<br />100 = Default', 3, 80, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Small Image Width', 'SMALL_IMAGE_WIDTH', '100', 'The pixel width of small images', '4', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Small Image Height', 'SMALL_IMAGE_HEIGHT', '100', 'The pixel height of small images', '4', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Heading Image Width - Admin', 'HEADING_IMAGE_WIDTH', '57', 'The pixel width of heading images in the Admin<br />NOTE: Presently, this adjusts the spacing on the pages in the Admin Pages or could be used to add images to the heading in the Admin', '4', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Heading Image Height - Admin', 'HEADING_IMAGE_HEIGHT', '40', 'The pixel height of heading images in the Admin<br />NOTE: Presently, this adjusts the spacing on the pages in the Admin Pages or could be used to add images to the heading in the Admin', '4', '4', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Subcategory Image Width', 'SUBCATEGORY_IMAGE_WIDTH', '100', 'The pixel width of subcategory images', '4', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Subcategory Image Height', 'SUBCATEGORY_IMAGE_HEIGHT', '57', 'The pixel height of subcategory images', '4', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Calculate Image Size', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calculate the size of images?', '4', '7', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image Required', 'IMAGE_REQUIRED', 'true', 'Enable to display broken images. Good for development.', '4', '8', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image - Shopping Cart Status', 'IMAGE_SHOPPING_CART_STATUS', '1', 'Show product image in the shopping cart?<br />0= off 1= on', 4, 9, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Shopping Cart Width', 'IMAGE_SHOPPING_CART_WIDTH', '60', 'Default = 60', 4, 10, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Shopping Cart Height', 'IMAGE_SHOPPING_CART_HEIGHT', '60', 'Default = 60', 4, 11, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Category Icon Image Width - Product Info Pages', 'CATEGORY_ICON_IMAGE_WIDTH', '57', 'The pixel width of Category Icon heading images for Product Info Pages', '4', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Category Icon Image Height - Product Info Pages', 'CATEGORY_ICON_IMAGE_HEIGHT', '40', 'The pixel height of Category Icon heading images for Product Info Pages', '4', '14', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Top Subcategory Image Width', 'SUBCATEGORY_IMAGE_TOP_WIDTH', '150', 'The pixel width of Top subcategory images<br />Top subcategory is when the Category contains subcategories', '4', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Top Subcategory Image Height', 'SUBCATEGORY_IMAGE_TOP_HEIGHT', '85', 'The pixel height of Top subcategory images<br />Top subcategory is when the Category contains subcategories', '4', '16', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Width', 'MEDIUM_IMAGE_WIDTH', '220', 'The pixel width of Product Info images', '4', '20', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Height', 'MEDIUM_IMAGE_HEIGHT', '220', 'The pixel height of Product Info images', '4', '21', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Medium Suffix', 'IMAGE_SUFFIX_MEDIUM', '_MED', 'Product Info Medium Image Suffix<br />Default = _MED', '4', '22', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Large Suffix', 'IMAGE_SUFFIX_LARGE', '_LRG', 'Product Info Large Image Suffix<br />Default = _LRG', '4', '23', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Number of Additional Images per Row', 'IMAGES_AUTO_ADDED', '3', 'Product Info - Enter the number of additional images to display per row<br />Default = 3', '4', '30', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product Listing Width', 'IMAGE_PRODUCT_LISTING_WIDTH', '150', 'Default = 150', 4, 40, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product Listing Height', 'IMAGE_PRODUCT_LISTING_HEIGHT', '150', 'Default = 150', 4, 41, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product New Listing Width', 'IMAGE_PRODUCT_NEW_LISTING_WIDTH', '150', 'Default = 150', 4, 42, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product New Listing Height', 'IMAGE_PRODUCT_NEW_LISTING_HEIGHT', '150', 'Default = 150', 4, 43, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - New Products Width', 'IMAGE_PRODUCT_NEW_WIDTH', '150', 'Default = 150', 4, 44, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - New Products Height', 'IMAGE_PRODUCT_NEW_HEIGHT', '150', 'Default = 150', 4, 45, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Featured Products Width', 'IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH', '150', 'Default = 150', 4, 46, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Featured Products Height', 'IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT', '150', 'Default = 150', 4, 47, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product All Listing Width', 'IMAGE_PRODUCT_ALL_LISTING_WIDTH', '150', 'Default = 150', 4, 48, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product All Listing Height', 'IMAGE_PRODUCT_ALL_LISTING_HEIGHT', '150', 'Default = 150', 4, 49, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Image - No Image Status', 'PRODUCTS_IMAGE_NO_IMAGE_STATUS', '1', 'Use automatic No Image when none is added to product<br />0= off<br />1= On', '4', '60', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Image - No Image picture', 'PRODUCTS_IMAGE_NO_IMAGE', 'no_picture.gif', 'Use automatic No Image when none is added to product<br />Default = no_picture.gif', '4', '61', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image - Use Proportional Images on Products and Categories', 'PROPORTIONAL_IMAGES_STATUS', '1', 'Use Proportional Images on Products and Categories?<br /><br />NOTE: Do not use 0 height or width settings for Proportion Images<br />0= off 1= on', 4, 75, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

#Image Handler 5.3.0 new since 1.5.5f, updated since 1.5.7
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH resize images', 'IH_RESIZE', 'yes', 'Select either ''no'' which is old Zen-Cart behaviour or ''yes'' to activate automatic resizing and caching of images. If you want to use ImageMagick you have to specify the location of the <strong>convert</strong> binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em>.', 4, 76, NULL, now(), NULL, 'zen_cfg_select_option(array(''yes'', ''no''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images filetype', 'SMALL_IMAGE_FILETYPE', 'no_change', 'Select one of -jpg-, -gif- or -png-. Older versions of Internet Explorer -v6.0 and older- will have issues displaying -png- images with transparent areas. You better stick to -gif- for transparency if you MUST support older versions of Internet Explorer. However -png- is a MUCH BETTER format for transparency. Use -jpg- or -png- for larger images. -no_change- is old zen-cart behavior, use the same file extension for small images as uploaded image', 4, 77, NULL, now(), NULL, 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images background', 'SMALL_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to -transparent- to keep transparency', 4, 82, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Image Handler Version', 'IH_VERSION', '5.3.3', 'This is used by image handler to check if the database is up to date with uploaded image handler files.', 0, 100, NULL, now(), NULL, 'zen_cfg_textarea_small(');
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

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Email Salutation', 'ACCOUNT_GENDER', 'true', 'Display salutation choice during account creation and with account information', '5', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Date of Birth', 'ACCOUNT_DOB', 'false', 'Display date of birth field during account creation and with account information<br />NOTE: Set Minimum Value Date of Birth to blank for not required<br />Set Minimum Value Date of Birth > 0 to require', '5', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Company', 'ACCOUNT_COMPANY', 'true', 'Display company field during account creation and with account information', '5', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Address Line 2', 'ACCOUNT_SUBURB', 'true', 'Display address line 2 field during account creation and with account information', '5', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('State', 'ACCOUNT_STATE', 'false', 'Display state field during account creation and with account information', '5', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('State - Always display as pulldown?', 'ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN', 'false', 'When state field is displayed, should it always be a pulldown menu?', 5, '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Create Account Default Country ID', 'SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY', '14', 'Set Create Account Default Country ID to:<br />Default is 14 for Austria', '5', '6', 'zen_get_country_name', 'zen_cfg_pull_down_country_list_none(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Fax Number', 'ACCOUNT_FAX_NUMBER', 'false', 'Display fax number field during account creation and with account information', '5', '10', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Newsletter Checkbox', 'ACCOUNT_NEWSLETTER_STATUS', '1', 'Show Newsletter Checkbox<br />0= off<br />1= Display Unchecked<br />2= Display Checked<br /><strong>Note: Defaulting this to accepted may be in violation of certain regulations for your state or country</strong>', 5, 45, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Default Email Preference', 'ACCOUNT_EMAIL_PREFERENCE', '0', 'Set the Default Customer Default Email Preference<br />0= Text<br />1= HTML<br />', 5, 46, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Product Notification Status', 'CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS', '0', 'Customer should be asked about product notifications after checkout success and in account preferences<br />0= Never ask<br />1= Ask (ignored on checkout if has already selected global notifications)<br /><br />Note: Sidebox must be turned off separately', '5', '50', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Shop Status - View Shop and Prices', 'CUSTOMERS_APPROVAL', '0', 'Customer must be approved to shop<br />0= Not required<br />1= Must login to browse<br />2= May browse but no prices unless logged in<br />3= Showroom Only<br /><br />It is recommended that Option 2 be used for the purposes of Spiders if you wish customers to login to see prices.', '5', '55', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

#customer approval to shop
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Approval Status - Authorization Pending', 'CUSTOMERS_APPROVAL_AUTHORIZATION', '0', 'Customer must be Authorized to shop<br />0= Not required<br />1= Must be Authorized to Browse<br />2= May browse but no prices unless Authorized<br />3= Customer May Browse and May see Prices but Must be Authorized to Buy<br /><br />It is recommended that Option 2 or 3 be used for the purposes of Spiders', '5', '65', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: filename', 'CUSTOMERS_AUTHORIZATION_FILENAME', 'customers_authorization', 'Customer Authorization filename<br />Note: Do not include the extension<br />Default=customers_authorization', '5', '66', '', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: Hide Header', 'CUSTOMERS_AUTHORIZATION_HEADER_OFF', 'false', 'Customer Authorization: Hide Header <br />(true=hide false=show)', '5', '67', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: Hide Column Left', 'CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF', 'false', 'Customer Authorization: Hide Column Left <br />(true=hide false=show)', '5', '68', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: Hide Column Right', 'CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF', 'false', 'Customer Authorization: Hide Column Right <br />(true=hide false=show)', '5', '69', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: Hide Footer', 'CUSTOMERS_AUTHORIZATION_FOOTER_OFF', 'false', 'Customer Authorization: Hide Footer <br />(true=hide false=show)', '5', '70', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: Hide Prices', 'CUSTOMERS_AUTHORIZATION_PRICES_OFF', 'false', 'Customer Authorization: Hide Prices <br />(true=hide false=show)', '5', '71', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customers Referral Status', 'CUSTOMERS_REFERRAL_STATUS', '0', 'Customers Referral Code is created from<br />0= Off<br />1= 1st Discount Coupon Code used<br />2= Customer can add during create account or edit if blank<br /><br />NOTE: Once the Customers Referral Code has been set it can only be changed in the Admin Customer', '5', '80', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_PAYMENT_INSTALLED', 'freecharger.php;eustandardtransfer.php', 'List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: freecharger.php;cod.php;paypal.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_shipping.php;ot_coupon.php;ot_group_pricing.php;ot_tax.php;ot_loworderfee.php;ot_gv.php;ot_total.php', 'List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_SHIPPING_INSTALLED', 'flat.php;freeshipper.php;item.php;storepickup.php', 'List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Enable Free Shipping', 'MODULE_SHIPPING_FREESHIPPER_STATUS', 'True', 'Do you want to offer Free shipping?', 6, 0, now(), NULL, 'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Free Shipping Cost', 'MODULE_SHIPPING_FREESHIPPER_COST', '0.00', 'What is the Shipping cost?', 6, 6, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Handling Fee', 'MODULE_SHIPPING_FREESHIPPER_HANDLING', '0', 'Handling fee for this shipping method.', 6, 0, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', 6, 0, now(), 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Shipping Zone', 'MODULE_SHIPPING_FREESHIPPER_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', 6, 0, now(), 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', '99', 'Sort order of display.', 6, 0, now(), NULL, NULL);

### preinstall storepickup
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function, val_function) VALUES
('Tax Basis', 'MODULE_SHIPPING_STOREPICKUP_TAX_BASIS', 'Shipping', 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone', 6, 0, NULL, now(), NULL, 'zen_cfg_select_option(array(\'Shipping\', \'Billing\'), ', NULL),
('Shipping Zone', 'MODULE_SHIPPING_STOREPICKUP_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', 6, 0, NULL, now(), 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', NULL),
('Tax Class', 'MODULE_SHIPPING_STOREPICKUP_TAX_CLASS', '2', 'Use the following tax class on the shipping fee.', 6, 0, NULL, now(), 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', NULL),
('Shipping Cost', 'MODULE_SHIPPING_STOREPICKUP_COST', '0.00', 'The shipping cost for all orders using this shipping method.', 6, 0, NULL, now(), NULL, NULL, NULL),
('Pickup Locations', 'MODULE_SHIPPING_STOREPICKUP_LOCATIONS_LIST', 'Demogasse 17 in 1010 Wien', 'Enter a list of locations, separated by semicolons (;).<br>Optionally you may specify a fee/surcharge for each location by adding a comma and an amount. If no amount is specified, then the generic Shipping Cost amount from the next setting will be applied.<br><br>Examples:<br>121 Main Street;20 Church Street<br>Sunnyside,4.00;Lee Park,5.00;High Street,0.00<br>Dallas;Tulsa,5.00;Phoenix,0.00<br>For multilanguage use, see the define-statement in the language file for this module.', 6, 0, NULL, now(), NULL, NULL, NULL),
('Enable Store Pickup Shipping', 'MODULE_SHIPPING_STOREPICKUP_STATUS', 'True', 'Do you want to offer In Store rate shipping?', 6, 0, NULL, now(), NULL, 'zen_cfg_select_option(array(\'True\', \'False\'), ', NULL),
('Sort Order', 'MODULE_SHIPPING_STOREPICKUP_SORT_ORDER', '10', 'Sort order of display.', 6, 0, NULL, '2022-03-07 17:01:03', NULL, NULL, NULL),
('Countries', 'MODULE_SHIPPING_STOREPICKUP_COUNTRIES', 'AT', 'Enter the countries for which you want to offer storepickup. Two digit ISO codes, comma separated.', 6, 11, NULL, now(), NULL, NULL, NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Enable Item Shipping', 'MODULE_SHIPPING_ITEM_STATUS', 'True', 'Do you want to offer per item rate shipping?', 6, 0, now(), NULL, 'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Shipping Cost', 'MODULE_SHIPPING_ITEM_COST', '2.50', 'The shipping cost will be multiplied by the number of items in an order that uses this shipping method.', 6, 0, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Handling Fee', 'MODULE_SHIPPING_ITEM_HANDLING', '0', 'Handling fee for this shipping method.', 6, 0, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_SHIPPING_ITEM_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', 6, 0, now(), 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Tax Basis', 'MODULE_SHIPPING_ITEM_TAX_BASIS', 'Shipping', 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone', 6, 0, now(), NULL, 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Shipping Zone', 'MODULE_SHIPPING_ITEM_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', 6, 0, now(), 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_SHIPPING_ITEM_SORT_ORDER', '0', 'Sort order of display.', 6, 0, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Enable Free Charge Module', 'MODULE_PAYMENT_FREECHARGER_STATUS', 'True', 'Do you want to accept Free Charge payments?', 6, 1, now(), NULL, 'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Sort order of display.', 'MODULE_PAYMENT_FREECHARGER_SORT_ORDER', '99', 'Sort order of display. Lowest is displayed first.', 6, 0, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Payment Zone', 'MODULE_PAYMENT_FREECHARGER_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, now(), 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Set Order Status', 'MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Enable Moneyorder/Bank Transfer Payment', 'MODULE_PAYMENT_EUTRANSFER_STATUS', 'True', 'Do you want to accept bank transfer order payments?', 6, 1, now(), NULL, 'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Bank Name:', 'MODULE_PAYMENT_EUTRANSFER_BANKNAM', '---', 'Your full bank name', 6, 1, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Bank Account Name:', 'MODULE_PAYMENT_EUTRANSFER_ACCNAM', '---', 'The name associated with the account', 6, 1, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Bank Account No.:', 'MODULE_PAYMENT_EUTRANSFER_ACCNUM', '---', 'Your account number', 6, 1, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Bank Code:', 'MODULE_PAYMENT_EUTRANSFER_BLZ', '---', 'Your Bank Code', 6, 1, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Bank Account IBAN:', 'MODULE_PAYMENT_EUTRANSFER_ACCIBAN', '---', 'International account id.<br>(ask your bank if you don\'t know it)', 6, 1, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Bank BIC/SWIFT:', 'MODULE_PAYMENT_EUTRANSFER_BANKBIC', '---', 'International bank id.<br>(ask your bank if you don\'t know it)', 6, 1, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Sort order of display.', 'MODULE_PAYMENT_EUTRANSFER_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Payment Zone', 'MODULE_PAYMENT_EUTRANSFER_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, now(), 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Set Order Status', 'MODULE_PAYMENT_EUTRANSFER_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Countries', 'MODULE_PAYMENT_EUTRANSFER_COUNTRIES', 'BE,DE,EE,FI,FR,GR,IE,IT,LU,NL,AT,PT,SK,SI,ES', 'Enter the countries for which you want to offer moneyorder. Two digit ISO codes, comma separated.', 6, 11, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Include Tax', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX', 'false', 'Include Tax value in amount before discount calculation?', 6, 6, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS', 'true', '', 6, 1, now(), NULL, 'zen_cfg_select_option(array(\'true\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER', '290', 'Sort order of display.', 6, 2, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Include Shipping', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING', 'false', 'Include Shipping value in amount before discount calculation?', 6, 5, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX', 'Standard', 'Re-Calculate Tax', 6, 7, now(), NULL, 'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS', '0', 'Use the following tax class when treating Group Discount as Credit Note.', 6, 0, now(), 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Flat Shipping', 'MODULE_SHIPPING_FLAT_STATUS', 'True', 'Do you want to offer flat rate shipping?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Shipping Cost', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'The shipping cost for all orders using this shipping method.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Tax Class', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Tax Basis', 'MODULE_SHIPPING_FLAT_TAX_BASIS', 'Shipping', 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone', '6', '0', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Shipping Zone', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Currency', 'DEFAULT_CURRENCY', 'EUR', 'Default Currency', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Language', 'DEFAULT_LANGUAGE', 'de', 'Default Language', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Admin configuration_key shows', 'ADMIN_CONFIGURATION_KEY_ON', '0', 'Manually switch to value of 1 to see the configuration_key name in configuration displays', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Country of Origin', 'SHIPPING_ORIGIN_COUNTRY', '14', 'Select the country of origin to be used in shipping quotes.', '7', '1', 'zen_get_country_name', 'zen_cfg_pull_down_country_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Postal Code', 'SHIPPING_ORIGIN_ZIP', 'NONE', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes. NOTE: For USA zip codes, only use your 5 digit zip code.', '7', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Enter the Maximum Package Weight you will ship', 'SHIPPING_MAX_WEIGHT', '50', 'Carriers have a max weight limit for a single package. This is a common one for all.', '7', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Package Tare Small to Medium - added percentage:weight', 'SHIPPING_BOX_WEIGHT', '0:3', 'What is the weight of typical packaging of small to medium packages?<br />Example: 10% + 1lb 10:1<br />10% + 0lbs 10:0<br />0% + 5lbs 0:5<br />0% + 0lbs 0:0', '7', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Larger packages - added packaging percentage:weight', 'SHIPPING_BOX_PADDING', '10:0', 'What is the weight of typical packaging for Large packages?<br />Example: 10% + 1lb 10:1<br />10% + 0lbs 10:0<br />0% + 5lbs 0:5<br />0% + 0lbs 0:0', '7', '5', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Number of Boxes and Weight Status', 'SHIPPING_BOX_WEIGHT_DISPLAY', '3', 'Display Shipping Weight and Number of Boxes?<br /><br />0= off<br />1= Boxes Only<br />2= Weight Only<br />3= Both Boxes and Weight', '7', '15', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Shipping Estimator Display Settings for Shopping Cart', 'SHOW_SHIPPING_ESTIMATOR_BUTTON', '2', '<br />0= Off<br />1= Display as Button on Shopping Cart<br />2= Display as Listing on Shopping Cart Page', '7', '20', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Display Order Comments on Admin Invoice', 'ORDER_COMMENTS_INVOICE', '1', 'Do you want to display the Order Comments on the Admin Invoice?<br />0= OFF<br />1= First Comment by Customer only<br />2= All Comments for the Order', 7, 25, now(), NULL, 'zen_cfg_select_option(array(''0'', ''1'', ''2''), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Display Order Comments on Admin Packing Slip', 'ORDER_COMMENTS_PACKING_SLIP', '1', 'Do you want to display the Order Comments on the Admin Packing Slip?<br />0= OFF<br />1= First Comment by Customer only<br />2= All Comments for the Order', 7, 26, now(), NULL, 'zen_cfg_select_option(array(''0'', ''1'', ''2''), ');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Order Free Shipping 0 Weight Status', 'ORDER_WEIGHT_ZERO_STATUS', '0', 'If there is no weight to the order, does the order have Free Shipping?<br />0= no<br />1= yes<br /><br />Note: When using Free Shipping, Enable the Free Shipping Module this will only show when shipping is free.', '7', '15', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_LIST_IMAGE', '1', 'Do you want to display the Product Image?', '8', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_LIST_MANUFACTURER', '0', 'Do you want to display the Product Manufacturer Name?', '8', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_LIST_MODEL', '0', 'Do you want to display the Product Model?', '8', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_LIST_NAME', '2', 'Do you want to display the Product Name?', '8', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price/Add to Cart', 'PRODUCT_LIST_PRICE', '3', 'Do you want to display the Product Price/Add to Cart', '8', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_LIST_QUANTITY', '0', 'Do you want to display the Product Quantity?', '8', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_LIST_WEIGHT', '0', 'Do you want to display the Product Weight?', '8', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price/Add to Cart Column Width', 'PRODUCTS_LIST_PRICE_WIDTH', '125', 'Define the width of the Price/Add to Cart column<br />Default= 125', '8', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Category/Manufacturer Filter (0=off; 1=on)', 'PRODUCT_LIST_FILTER', '1', 'Do you want to display the Category/Manufacturer Filter?', '8', '9', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Prev/Next Split Page Navigation (1-top, 2-bottom, 3-both)', 'PREV_NEXT_BAR_LOCATION', '3', 'Sets the location of the Prev/Next Split Page Navigation', '8', '10', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Listing Default Sort Order', 'PRODUCT_LISTING_DEFAULT_SORT_ORDER', '', 'Product Listing Default sort order?<br />NOTE: Leave Blank for Product Sort Order. Sort the Product Listing in the order you wish for the default display to start in to get the sort order setting. Example: 2a', '8', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Add to Cart Button (0=off; 1=on; 2=on with Qty Box per Product)', 'PRODUCT_LIST_PRICE_BUY_NOW', '1', 'Do you want to display the Add to Cart Button?<br /><br /><strong>NOTE:</strong> Turn OFF Display Multiple Products Qty Box Status to use Option 2 on with Qty Box per Product', '8', '20', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', '3', 'Do you want to display Add Multiple Products Qty Box and Set Button Location?<br />0= off<br />1= Top<br />2= Bottom<br />3= Both', '8', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Description', 'PRODUCT_LIST_DESCRIPTION', '150', 'Do you want to display the Product Description?<br /><br />0= OFF<br />150= Suggested Length, or enter the maximum number of characters to display', '8', '30', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing Ascending Sort Order', 'PRODUCT_LIST_SORT_ORDER_ASCENDING', '+', 'What do you want to use to indicate Sort Order Ascending?<br />Default = +', 8, 40, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing Descending Sort Order', 'PRODUCT_LIST_SORT_ORDER_DESCENDING', '-', 'What do you want to use to indicate Sort Order Descending?<br />Default = -', 8, 41, NULL, now(), NULL, 'zen_cfg_textarea_small(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Columns Per Row', 'PRODUCT_LISTING_COLUMNS_PER_ROW', '3', 'Select the number of columns of products to show per row in the product listing.<br>Recommended: 3<br>1=[rows] mode.', '8', '45', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Include Product Listing Alpha Sorter Dropdown', 'PRODUCT_LIST_ALPHA_SORTER', 'true', 'Do you want to include an Alpha Filter dropdown on the Product Listing?', '8', '50', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Include Product Listing Sub Categories Image', 'PRODUCT_LIST_CATEGORIES_IMAGE_STATUS', 'true', 'Do you want to include the Sub Categories Image on the Product Listing?', '8', '52', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Include Product Listing Top Categories Image', 'PRODUCT_LIST_CATEGORIES_IMAGE_STATUS_TOP', 'true', 'Do you want to include the Top Categories Image on the Product Listing?', '8', '53', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show SubCategories on Main Page while navigating', 'PRODUCT_LIST_CATEGORY_ROW_STATUS', '1', 'Show Sub-Categories on Main Page while navigating through Categories<br /><br />0= off<br />1= on', '8', '60', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check stock level', 'STOCK_CHECK', 'true', 'Check to see if sufficient stock is available', '9', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Subtract stock', 'STOCK_LIMITED', 'true', 'Subtract product in stock by product orders', '9', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Allow Checkout', 'STOCK_ALLOW_CHECKOUT', 'true', 'Allow customer to checkout even if there is insufficient stock', '9', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Mark product out of stock', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Display something on screen so customer can see which product has insufficient stock', '9', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Stock Re-order level', 'STOCK_REORDER_LEVEL', '5', 'Define when stock needs to be re-ordered', '9', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Products status in Catalog when out of stock should be set to', 'SHOW_PRODUCTS_SOLD_OUT', '0', 'Show Products when out of stock<br /><br />0= set product status to OFF<br />1= leave product status ON', '9', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Disabled Product Status for Search Engines', 'DISABLED_PRODUCTS_TRIGGER_HTTP200', 'false', 'When a product is marked Disabled (status=0) but is not deleted from the database, should Search Engines still show it as Available?<br>eg:<br>True = Return HTTP 200 response<br>False = Return HTTP 410<br>(Deleting it will return HTTP 404)<br><b>Default: false</b>', '9', '10', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Sold Out Image in place of Add to Cart', 'SHOW_PRODUCTS_SOLD_OUT_IMAGE', '1', 'Show Sold Out Image instead of Add to Cart Button<br /><br />0= off<br />1= on', '9', '11', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable disabled product by available date', 'ENABLE_DISABLED_UPCOMING_PRODUCT', 'Automatic', 'How should hidden (disabled) product with a future available date be made visible (active) to customers when the date is reached?<br />', '9', '12', 'zen_cfg_select_option(array(\'Manual\', \'Automatic\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Quantity Decimals', 'QUANTITY_DECIMALS', '0', 'Allow how many decimals on Quantity<br /><br />0= off', '9', '15', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Shopping Cart - Delete Checkboxes or Delete Button', 'SHOW_SHOPPING_CART_DELETE', '3', 'Show on Shopping Cart Delete Button and/or Checkboxes<br /><br />1= Delete Button Only<br />2= Checkbox Only<br />3= Both Delete Button and Checkbox', '9', '20', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Shopping Cart - Update Cart Button Location', 'SHOW_SHOPPING_CART_UPDATE', '1', 'Show on Shopping Cart Update Cart Button Location as:<br /><br />1= Next to each Qty Box<br />2= Below all Products<br />3= Both Next to each Qty Box and Below all Products', '9', '22', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show New Products on empty Shopping Cart Page', 'SHOW_SHOPPING_CART_EMPTY_NEW_PRODUCTS', '1', 'Show New Products on empty Shopping Cart Page<br />0= off or set the sort order', '9', '30', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Featured Products on empty Shopping Cart Page', 'SHOW_SHOPPING_CART_EMPTY_FEATURED_PRODUCTS', '2', 'Show Featured Products on empty Shopping Cart Page<br />0= off or set the sort order', '9', '31', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Special Products on empty Shopping Cart Page', 'SHOW_SHOPPING_CART_EMPTY_SPECIALS_PRODUCTS', '3', 'Show Special Products on empty Shopping Cart Page<br />0= off or set the sort order', '9', '32', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Upcoming Products on empty Shopping Cart Page', 'SHOW_SHOPPING_CART_EMPTY_UPCOMING', '4', 'Show Upcoming Products on empty Shopping Cart Page<br />0= off or set the sort order', '9', '33', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Notice of Combining Shopping Cart on Login', 'SHOW_SHOPPING_CART_COMBINED', '1', 'When a customer logs in and has a previously stored shopping cart, the products are combined with the existing shopping cart.<br /><br />Do you wish to display a Notice to the customer?<br /><br />0= OFF, do not display a notice<br />1= Yes show notice and go to shopping cart<br />2= Yes show notice, but do not go to shopping cart', '9', '35', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Log Page Parse Time', 'STORE_PAGE_PARSE_TIME', 'false', 'Record (to a log file) the time it takes to parse a page', '10', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Destination', 'STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/zen/page_parse_time.log', 'Directory and filename of the page parse time log', '10', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Date Format', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'The date format', '10', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display The Page Parse Time', 'DISPLAY_PAGE_PARSE_TIME', 'false', 'Display the page parse time on the bottom of each page<br />(Note: This DISPLAYS them. You do NOT need to LOG them to merely display them on your site.)', '10', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Log Database Queries', 'STORE_DB_TRANSACTIONS', 'false', 'Record the database queries to files in the system /logs/ folder. USE WITH CAUTION. This can seriously degrade your site performance and blow out your disk space storage quotas.<br><strong>Enabling this makes your site NON-COMPLIANT with PCI DSS rules, thus invalidating any certification.</strong>', '10', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
### New since 1.5.6 - Display Logs Options - since 1.5.7g Version 3.0.2
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function ) VALUES 
('Display Logs: Version', 'DISPLAY_LOGS_VERSION', '3.0.2', 'Current plugin version.', 10, 100, now(), NULL, 'trim('),
('Display Logs: Display Maximum', 'DISPLAY_LOGS_MAX_DISPLAY', '20', 'Identify the maximum number of logs to display.  (Default: <b>20</b>)', 10, 100, now(), NULL, NULL),
('Display Logs: Maximum File Size', 'DISPLAY_LOGS_MAX_FILE_SIZE', '80000', 'Identify the maximum size of any file to display.  (Default: <b>80000</b>)', 10, 101, now(), NULL, NULL),
('Display Logs: Included File Prefixes', 'DISPLAY_LOGS_INCLUDED_FILES', 'myDEBUG-|Paypal|paypal|ipn_|zcInstall|notifier', 'Identify the log-file <em>prefixes</em> to include in the display, separated by the pipe character (|).  Any intervening spaces are removed by the processing code.', 10, 102, now(), NULL, NULL),
('Display Logs: Excluded File Prefixes', 'DISPLAY_LOGS_EXCLUDED_FILES', '', 'Identify the log-file prefixes to <em>exclude</em> from the display, separated by the pipe character (|). Any intervening spaces are removed by the processing code.', 10, 103, now(), NULL, NULL),
('Display Logs: Show notice in Header', 'DISPLAY_LOGS_SHOW_IN_HEADER', 'true', 'If error logs are detected in the logs folder a notice in the header of the store administration will appear telling you that errors exist.<br>If you do not wnat this notice to appear set to false.', 10, 104, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'), ');
### New since 1.5.7 - Report All Errors
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors (Admin)?', 'REPORT_ALL_ERRORS_ADMIN', 'IgnoreDups', 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart admin\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.', 10, 40, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors (Store)?', 'REPORT_ALL_ERRORS_STORE', 'IgnoreDups', 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart store\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.<br /><br /><strong>Note:</strong> Choosing \'Yes\' is not suggested for a <em>live</em> store, since it will reduce performance significantly!', 10, 41, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors: Backtrace on Notice Errors?', 'REPORT_ALL_ERRORS_NOTICE_BACKTRACE', 'Yes', 'Include backtrace information on &quot;Notice&quot; errors?  These are usually isolated to the identified file and the backtrace information just fills the logs. Default (<b>No</b>).', 10, 42, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Transport Method', 'EMAIL_TRANSPORT', 'PHP', 'Defines the method for sending mail.<br /><strong>PHP</strong> is the default, and uses built-in PHP wrappers for processing.<br />Servers running on Windows and MacOS should change this setting to <strong>SMTP</strong>.<br /><br /><strong>SMTPAUTH</strong> should only be used if your server requires SMTP authorization to send messages. You must also configure your SMTPAUTH settings in the appropriate fields in this admin section.<br /><br /><strong>sendmail</strong> is for linux/unix hosts using the sendmail program on the server<br /><strong>"sendmail-f"</strong> is only for servers which require the use of the -f parameter to send mail. This is a security setting often used to prevent spoofing. Will cause errors if your host mailserver is not configured to use it.<br /><br /><strong>Qmail</strong> is used for linux/unix hosts running Qmail as sendmail wrapper at /var/qmail/bin/sendmail.', '12', '1', 'zen_cfg_select_option(array(\'PHP\', \'sendmail\', \'sendmail-f\', \'smtp\', \'smtpauth\', \'Qmail\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Account Mailbox', 'EMAIL_SMTPAUTH_MAILBOX', 'YourEmailAccountNameHere', 'Enter the mailbox account name (me@mydomain.com) supplied by your host. This is the account name that your host requires for SMTP authentication.<br />Only required if using SMTP Authentication for email.', '12', '101', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function) VALUES ('SMTP Email Account Password', 'EMAIL_SMTPAUTH_PASSWORD', 'YourPasswordHere', 'Enter the password for your SMTP mailbox. <br />Only required if using SMTP Authentication for email.', '12', '101', now(), 'zen_cfg_password_display');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Mail Host', 'EMAIL_SMTPAUTH_MAIL_SERVER', 'mail.EnterYourDomain.com', 'Enter the DNS name of your SMTP mail server.<br />ie: mail.mydomain.com<br />or 55.66.77.88<br />Only required if using SMTP Authentication for email.', '12', '101', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Mail Server Port', 'EMAIL_SMTPAUTH_MAIL_SERVER_PORT', '587', 'Enter the IP port number that your SMTP mailserver operates on.<br />Only required if using SMTP Authentication for email.<br><br>Default: 25<br>Typical values are:<br>25 - normal unencrypted SMTP<br>587 - encrypted SMTP<br>465 - older MS SMTP port', '12', '101', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails?<br>Normally this is set to true.<br>Set to false to suppress ALL outgoing email messages from this store, such as when working with a test copy of your store offline.', '12', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', '12', '2', 'zen_cfg_select_option(array(\'LF\', \'CRLF\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable HTML Emails?', 'EMAIL_USE_HTML', 'true', 'Send emails in HTML format if recipient has enabled it in their preferences.', '12', '3', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Verify E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verify e-mail address through a DNS server', '6', '6', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Send Welcome Email', 'SEND_WELCOME_EMAIL', 'true', 'Send Welcome Email to the customer after registration?', 12, 90, now(), now(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Email Archiving Active?', 'EMAIL_ARCHIVE', 'false', 'If you wish to have email messages archived/stored when sent, set this to "true".', '12', '6', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Friendly-Errors', 'EMAIL_FRIENDLY_ERRORS', 'true', 'Do you want to display friendly errors if emails fail?  Setting this to false will display PHP errors and likely cause the script to fail. Only set to false while troubleshooting, and true for a live shop.', '12', '7', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Email Address (Displayed to Contact you)', 'STORE_OWNER_EMAIL_ADDRESS', 'root@localhost', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'Email address of Store Owner.  Used as "display only" when informing customers of how to contact you.', '12', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Email Address (sent FROM)', 'EMAIL_FROM', 'Zen Cart <root@localhost>', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'Address from which email messages will be "sent" by default. Can be over-ridden at compose-time in admin modules.', '12', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function) VALUES ('Emails must send from known domain?', 'EMAIL_SEND_MUST_BE_STORE', 'Yes', 'Does your mailserver require that all outgoing emails have their "from" address match a known domain that exists on your webserver?<br /><br />This is often required in order to prevent spoofing and spam broadcasts.  If set to Yes, this will cause the email address (sent FROM) to be used as the "from" address on all outgoing mail.', 12, 11, NULL, 'zen_cfg_select_option(array(\'No\', \'Yes\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function) VALUES ('Email Admin Format?', 'ADMIN_EXTRA_EMAIL_FORMAT', 'TEXT', 'Please select the Admin extra email format (Note: Enable HTML Emails must be on for HTML option to work)', 12, 12, NULL, 'zen_cfg_select_option(array(\'TEXT\', \'HTML\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Order Confirmation Emails To', 'SEND_EXTRA_ORDER_EMAILS_TO', '', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'Send COPIES of order confirmation emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Create Account Emails To - Status', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS', '0', 'Send copy of Create Account Status<br />0= off 1= on', '12', '13', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Create Account Emails To', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO', '', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'Send copy of Create Account emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Customer GV Send Emails To - Status', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_STATUS', '0', 'Send copy of Customer GV Send Status<br />0= off 1= on', '12', '17', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Customer GV Send Emails To', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO', '', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'Send copy of Customer GV Send emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '18', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Admin GV Mail Emails To - Status', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO_STATUS', '0', 'Send copy of Admin GV Mail Status<br />0= off 1= on', '12', '19', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Customer Admin GV Mail Emails To', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO', '', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'Send copy of Admin GV Mail emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '20', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Admin Discount Coupon Mail Emails To - Status', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_STATUS', '0', 'Send copy of Admin Discount Coupon Mail Status<br />0= off 1= on', '12', '21', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Customer Admin Discount Coupon Mail Emails To', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO', '', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'Send copy of Admin Discount Coupon Mail emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '22', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Admin Orders Status Emails To - Status', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS', '0', 'Send copy of Admin Orders Status Status<br />0= off 1= on', '12', '23', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Admin Orders Status Emails To', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO', '', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'Send copy of Admin Orders Status emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '24', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Notice of Pending Reviews Emails To - Status', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS', '0', 'Send copy of Pending Reviews Status<br />0= off 1= on', '12', '25', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Notice of Pending Reviews Emails To', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO', '', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'Send copy of Pending Reviews emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '26', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Set "Contact Us" Email Dropdown List', 'CONTACT_US_LIST', '', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'On the "Contact Us" Page, set the list of email addresses , in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '40', 'zen_cfg_textarea(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Contact Us - Show Store Name and Address', 'CONTACT_US_STORE_NAME_ADDRESS', '1', 'Include Store Name and Address<br />0= off 1= on', '12', '50', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Send Low Stock Emails', 'SEND_LOWSTOCK_EMAIL', '0', 'When stock level is at or below low stock level send an email<br />0= off<br />1= on', '12', '60', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Low Stock Emails To', 'SEND_EXTRA_LOW_STOCK_EMAILS_TO', '', '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}', 'When stock level is at or below low stock level send an email to this address, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '61', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display "Newsletter Unsubscribe" Link?', 'SHOW_NEWSLETTER_UNSUBSCRIBE_LINK', 'true', 'Show "Newsletter Unsubscribe" link in the "Information" side-box?', '12', '70', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Audience-Select Count Display', 'AUDIENCE_SELECT_DISPLAY_COUNTS', 'true', 'When displaying lists of available audiences/recipients, should the recipients-count be included? <br /><em>(This may make things slower if you have a lot of customers or complex audience queries)</em>', '12', '90', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Downloads', 'DOWNLOAD_ENABLED', 'true', 'Enable the products download functions.', '13', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Download by Redirect', 'DOWNLOAD_BY_REDIRECT', 'false', 'Use browser redirection for download. Disable on non-Unix systems.<br /><br />Note: Set /pub to 777 when redirect is true', '13', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Download by streaming', 'DOWNLOAD_IN_CHUNKS', 'false', 'If download-by-redirect is disabled, and your PHP memory_limit setting is under 8 MB, you might need to enable this setting so that files are streamed in smaller segments to the browser.<br /><br />Has no effect if Download By Redirect is enabled.', '13', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Download Expiration (Number of Days)' ,'DOWNLOAD_MAX_DAYS', '7', 'Set number of days before the download link expires. 0 means no limit.', '13', '3', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Number of Downloads Allowed - Per Product' ,'DOWNLOAD_MAX_COUNT', '5', 'Set the maximum number of downloads. 0 means no download authorized.', '13', '4', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Downloads Controller Update Status Value', 'DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE', '4', 'What orders_status resets the Download days and Max Downloads - Default is 4', '13', '10', now(), now(), NULL , NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Downloads Controller Order Status Value >= lower value', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS', '2', 'Downloads Controller Order Status Value - Default >= 2<br /><br />Downloads are available for checkout based on the orders status. Orders with orders status greater than this value will be available for download. The orders status is set for an order by the Payment Modules. Set the lower range for this range.', '13', '12', now(), now(), NULL , NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Downloads Controller Order Status Value <= upper value', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS_END', '4', 'Downloads Controller Order Status Value - Default <= 4<br /><br />Downloads are available for checkout based on the orders status. Orders with orders status less than this value will be available for download. The orders status is set for an order by the Payment Modules.  Set the upper range for this range.', '13', '13', now(), now(), NULL , NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Price Factor', 'ATTRIBUTES_ENABLED_PRICE_FACTOR', 'true', 'Enable the Attributes Price Factor.', '13', '25', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Qty Price Discount', 'ATTRIBUTES_ENABLED_QTY_PRICES', 'true', 'Enable the Attributes Quantity Price Discounts.', '13', '26', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Attribute Images', 'ATTRIBUTES_ENABLED_IMAGES', 'true', 'Enable the Attributes Images.', '13', '28', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Text Pricing by word or letter', 'ATTRIBUTES_ENABLED_TEXT_PRICES', 'true', 'Enable the Attributes Text Pricing by word or letter.', '13', '35', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Text Pricing - Spaces are Free', 'TEXT_SPACES_FREE', '1', 'On Text pricing Spaces are Free<br /><br />0= off 1= on', '13', '36', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Read Only option type - Ignore for Add to Cart', 'PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED', '1', 'When a Product only uses READONLY attributes, should the Add to Cart button be On or Off?<br />0= OFF<br />1= ON', '13', '37', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable GZip Compression', 'GZIP_LEVEL', '0', '0= off 1= on', '14', '1', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Session Directory', 'SESSION_WRITE_DIRECTORY', '/tmp', 'This should point to the folder specified in your DIR_FS_SQL_CACHE setting in your configure.php files.', '15', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Cookie Domain', 'SESSION_USE_FQDN', 'True', 'If True the full domain name will be used to store the cookie, e.g. www.mydomain.com. If False only a partial domain name will be used, e.g. mydomain.com. If you are unsure about this, always leave set to true.', '15', '2', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Force Cookie Use', 'SESSION_FORCE_COOKIE_USE', 'False', 'Force the use of sessions when cookies are only enabled.', '15', '2', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check SSL Session ID', 'SESSION_CHECK_SSL_SESSION_ID', 'False', 'Validate the SSL_SESSION_ID on every secure HTTPS page request.', '15', '3', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check User Agent', 'SESSION_CHECK_USER_AGENT', 'False', 'Validate the clients browser user agent on every page request.', '15', '4', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check IP Address', 'SESSION_CHECK_IP_ADDRESS', 'False', 'Validate the clients IP address on every page request.', '15', '5', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Prevent Spider Sessions', 'SESSION_BLOCK_SPIDERS', 'True', 'Prevent known spiders from starting a session.', '15', '6', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Recreate Session', 'SESSION_RECREATE', 'True', 'Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).', '15', '7', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('IP to Host Conversion Status', 'SESSION_IP_TO_HOST_ADDRESS', 'true', 'Convert IP Address to Host Address<br /><br />Note: on some servers this can slow down the initial start of a session or execution of Emails', '15', '10', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Length of the redeem code', 'SECURITY_CODE_LENGTH', '10', 'Enter the length of the redeem code<br />The longer the more secure', 16, 1, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Default Order Status For Zero Balance Orders', 'DEFAULT_ZERO_BALANCE_ORDERS_STATUS_ID', '2', 'When an order\'s balance is zero, this order status will be assigned to it.', '16', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('New Signup Discount Coupon ID#', 'NEW_SIGNUP_DISCOUNT_COUPON', '', 'Select the coupon<br />', 16, 75, NULL, now(), NULL, 'zen_cfg_select_coupon_id(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('New Signup Gift Voucher Amount', 'NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', '', 'Leave blank for none<br />Or enter an amount ie. 10 for $10.00', 16, 76, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Discount Coupons Per Page', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS', '20', 'Number of Discount Coupons to list per Page', '16', '81', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Discount Coupon Report Results Per Page', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS_REPORTS', '20', 'Number of Discount Coupons to list on Reports Page', '16', '81', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - VISA', 'CC_ENABLED_VISA', '1', 'Accept VISA 0= off 1= on', '17', '1', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - MasterCard', 'CC_ENABLED_MC', '1', 'Accept MasterCard 0= off 1= on', '17', '2', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - AmericanExpress', 'CC_ENABLED_AMEX', '0', 'Accept AmericanExpress 0= off 1= on', '17', '3', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - Diners Club', 'CC_ENABLED_DINERS_CLUB', '0', 'Accept Diners Club 0= off 1= on', '17', '4', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - Discover Card', 'CC_ENABLED_DISCOVER', '0', 'Accept Discover Card 0= off 1= on', '17', '5', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - JCB', 'CC_ENABLED_JCB', '0', 'Accept JCB 0= off 1= on', '17', '6', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - AUSTRALIAN BANKCARD', 'CC_ENABLED_AUSTRALIAN_BANKCARD', '0', 'Accept AUSTRALIAN BANKCARD 0= off 1= on', '17', '7', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - SOLO', 'CC_ENABLED_SOLO', '0', 'Accept SOLO Card 0= off 1= on', '17', '8', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - Debit', 'CC_ENABLED_DEBIT', '0', 'Accept Debit Cards 0= off 1= on<br>NOTE: This is not deeply integrated at this time, and this setting may be redundant if your payment modules do not yet specifically have code to honour this switch.', '17', '9', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - Maestro', 'CC_ENABLED_MAESTRO', '0', 'Accept MAESTRO Card 0= off 1= on', '17', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enabled - Show on Payment', 'SHOW_ACCEPTED_CREDIT_CARDS', '0', 'Show accepted credit cards on Payment page?<br />0= off<br />1= As Text<br />2= As Images<br /><br />Note: images and text must be defined in both the database and language file for specific credit card types.', '17', '50', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_GV_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_GV_SORT_ORDER', '840', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:40', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Queue Purchases', 'MODULE_ORDER_TOTAL_GV_QUEUE', 'true', 'Do you want to queue purchases of the Gift Voucher?', 6, 3, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Shipping', 'MODULE_ORDER_TOTAL_GV_INC_SHIPPING', 'true', 'Include Shipping in calculation', 6, 5, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Tax', 'MODULE_ORDER_TOTAL_GV_INC_TAX', 'true', 'Include Tax in calculation.', 6, 6, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_GV_CALC_TAX', 'None', 'Re-Calculate Tax', 6, 7, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_ORDER_TOTAL_GV_TAX_CLASS', '0', 'Use the following tax class when treating Gift Voucher as Credit Note.', 6, 0, NULL, '2003-10-30 22:16:40', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Credit including Tax', 'MODULE_ORDER_TOTAL_GV_CREDIT_TAX', 'false', 'Add tax to purchased Gift Voucher when crediting to Account', 6, 8, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Set Order Status', 'MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID', '0', 'Set the status of orders made where GV covers full payment', 6, 0, NULL, now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Allow Gift Voucher Specials', 'MODULE_ORDER_TOTAL_GV_SPECIAL', 'false', 'Do you want to allow Gift Voucher to be placed on Special?', 6, 10, NULL, '2020-01-16 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:43', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', '400', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:43', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Allow Low Order Fee', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'false', 'Do you want to allow low order fees?', 6, 3, NULL, '2003-10-30 22:16:43', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Order Fee For Orders Under', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', '50', 'Add the low order fee to orders under this amount.', 6, 4, NULL, '2003-10-30 22:16:43', 'currencies->format', NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Order Fee', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', '5', 'For Percentage Calculation - include a % Example: 10%<br />For a flat amount just enter the amount - Example: 5 for $5.00', 6, 5, NULL, '2003-10-30 22:16:43', '', NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Attach Low Order Fee On Orders Made', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'both', 'Attach low order fee for orders sent to the set destination.', 6, 6, NULL, '2003-10-30 22:16:43', NULL, 'zen_cfg_select_option(array(\'national\', \'international\', \'both\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', '0', 'Use the following tax class on the low order fee.', 6, 7, NULL, '2003-10-30 22:16:43', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('No Low Order Fee on Virtual Products', 'MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL', 'false', 'Do not charge Low Order Fee when cart is Virtual Products Only', 6, 8, NULL, '2004-04-20 22:16:43', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('No Low Order Fee on Gift Vouchers', 'MODULE_ORDER_TOTAL_LOWORDERFEE_GV', 'false', 'Do not charge Low Order Fee when cart is Gift Vouchers Only', 6, 9, NULL, '2004-04-20 22:16:43', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:46', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '200', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:46', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Allow Free Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'false', 'Do you want to allow free shipping?', 6, 3, NULL, '2003-10-30 22:16:46', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Free Shipping For Orders Over', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '50', 'Provide free shipping for orders over the set amount.', 6, 4, NULL, '2003-10-30 22:16:46', 'currencies->format', NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Provide Free Shipping For Orders Made', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'Provide free shipping for orders sent to the set destination.', 6, 5, NULL, '2003-10-30 22:16:46', NULL, 'zen_cfg_select_option(array(\'national\', \'international\', \'both\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:49', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '100', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:49', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:52', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '300', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:52', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:55', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '999', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:55', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', '2', 'Use the following tax class when treating Discount Coupon as Credit Note.', 6, 0, NULL, '2003-10-30 22:16:36', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Tax', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'false', 'Include Tax in calculation.', 6, 6, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', '201', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Shipping', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'false', 'Include Shipping in calculation', 6, 5, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'Standard', 'Re-Calculate Tax', 6, 7, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product option type Select', 'PRODUCTS_OPTIONS_TYPE_SELECT', '0', 'The number representing the Select type of product option.', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Text product option type', 'PRODUCTS_OPTIONS_TYPE_TEXT', '1', 'Numeric value of the text product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Radio button product option type', 'PRODUCTS_OPTIONS_TYPE_RADIO', '2', 'Numeric value of the radio button product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Check box product option type', 'PRODUCTS_OPTIONS_TYPE_CHECKBOX', '3', 'Numeric value of the check box product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('File product option type', 'PRODUCTS_OPTIONS_TYPE_FILE', '4', 'Numeric value of the file product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('ID for text and file products options values', 'PRODUCTS_OPTIONS_VALUES_TEXT_ID', '0', 'Numeric value of the products_options_values_id used by the text and file attributes.', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Upload prefix', 'UPLOAD_PREFIX', 'upload_', 'Prefix used to differentiate between upload options and other options', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Text prefix', 'TEXT_PREFIX', 'txt_', 'Prefix used to differentiate between text option values and other option values', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Read Only option type', 'PRODUCTS_OPTIONS_TYPE_READONLY', '5', 'Numeric value of the file product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('login mode https', 'SSLPWSTATUSCHECK', '', 'System setting. Do not edit.', 6, 99, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order) VALUES ('Default Target Category (Products to Multiple Categories Manager)', 'P2C_TARGET_CATEGORY_DEFAULT', '', 'Default Target Category for Products to Multiple Categories Manager (set on page)', 6, 100);





INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Products Info - Products Option Name Sort Order', 'PRODUCTS_OPTIONS_SORT_ORDER', '0', 'Sort order of Option Names for Products Info<br />0= Sort Order, Option Name<br />1= Option Name', 18, 35, now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Products Info - Product Option Value of Attributes Sort Order', 'PRODUCTS_OPTIONS_SORT_BY_PRICE', '1', 'Sort order of Product Option Values of Attributes for Products Info<br />0= Sort Order, Price<br />1= Sort Order, Option Value Name', 18, 36, now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');

# test remove and only use products_options_images_per_row
#INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Number of Attribute Images per Row', 'PRODUCTS_IMAGES_ATTRIBUTES_PER_ROW', '5', 'Product Info - Enter the number of attribute images to display per row<br />Default = 5', '18', '40', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Show Option Values Name Below Attributes Image', 'PRODUCT_IMAGES_ATTRIBUTES_NAMES', '1', 'Product Info - Show the name of the Option Value beneath the Attribute Image?<br />0= off 1= on', 18, 41, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

# test remove and only use products_options_images_style
#INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Show Option Values and Attributes Images for Radio Buttons and Checkboxes', 'PRODUCT_IMAGES_ATTRIBUTES_NAMES_COLUMN', '0', '0= Images Below Option Names<br />1= Element, Image and Option Value<br />2= Element, Image and Option Name Below<br />3= Option Name Below Element and Image<br />4= Element Below Image and Option Name<br />5= Element Above Image and Option Name', 18, 42, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Show Sales Discount Savings Status', 'SHOW_SALE_DISCOUNT_STATUS', '1', 'Product Info - Show the amount of discount savings?<br />0= off 1= on', 18, 45, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Show Sales Discount Savings Dollars or Percentage', 'SHOW_SALE_DISCOUNT', '1', 'Product Info - Show the amount of discount savings display as:<br />1= % off 2= $amount off', 18, 46, 'zen_cfg_select_option(array(\'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Show Sales Discount Savings Percentage Decimals', 'SHOW_SALE_DISCOUNT_DECIMALS', '0', 'Product Info - Show discount savings display as a Percentage with how many decimals?:<br />Default= 0', 18, 47, NULL, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Price is Free Image or Text Status', 'OTHER_IMAGE_PRICE_IS_FREE_ON', '1', 'Product Info - Show the Price is Free Image or Text on Displayed Price<br />0= Text<br />1= Image', 18, 50, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Price is Call for Price Image or Text Status', 'PRODUCTS_PRICE_IS_CALL_IMAGE_ON', '1', 'Product Info - Show the Price is Call for Price Image or Text on Displayed Price<br />0= Text<br />1= Image', 18, 51, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Quantity Box Status - Adding New Products', 'PRODUCTS_QTY_BOX_STATUS', '1', 'What should the Default Quantity Box Status be set to when adding New Products?<br /><br />0= off<br />1= on<br />NOTE: This will show a Qty Box when ON and default the Add to Cart to 1', '18', '55', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Reviews Require Approval', 'REVIEWS_APPROVAL', '1', 'Do product reviews require approval?<br /><br />Note: When Review Status is off, it will also not show<br /><br />0= off 1= on', '18', '62', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product page generated &lt;title&gt; tag - include Product Model?', 'META_TAG_INCLUDE_MODEL', '1', 'When custom Keywords and Description meta tags are not set, include the Product Model in the generated page &lt;title&gt; tag?<br><br>0=no / 1=yes', '18', '69', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product page generated &lt;title&gt; tag - include Product Price?', 'META_TAG_INCLUDE_PRICE', '1', 'When custom Keywords and Description meta tags are not set, include the Product Price in the generated page &lt;title&gt; tag?<br><br>0=no / 1=yes', '18', '70', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product page generated &lt;meta - description&gt; tag - Maximum Length', 'MAX_META_TAG_DESCRIPTION_LENGTH', '50', 'When custom Keywords and Description meta tags are not set, limit the generated &lt;meta - description&gt; tag to this number of words. Default 50.', '18', '71', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Also Purchased Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS', '3', 'Also Purchased Products Columns per Row<br />0= off or set the sort order', '18', '72', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Navigation Bar Position', 'PRODUCT_INFO_PREVIOUS_NEXT', '1', 'Location of Previous/Next Navigation Bar<br />0= off<br />1= Top of Page<br />2= Bottom of Page<br />3= Both Top and Bottom of Page', 18, 21, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Top of Page\'), array(\'id\'=>\'2\', \'text\'=>\'Bottom of Page\'), array(\'id\'=>\'3\', \'text\'=>\'Both Top & Bottom of Page\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Sort Order', 'PRODUCT_INFO_PREVIOUS_NEXT_SORT', '1', 'Products Display Order by<br />0= Product ID<br />1= Product Name<br />2= Model<br />3= Price, Product Name<br />4= Price, Model<br />5= Product Name, Model<br />6= Product Sort Order', 18, 22, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Product ID\'), array(\'id\'=>\'1\', \'text\'=>\'Name\'), array(\'id\'=>\'2\', \'text\'=>\'Product Model\'), array(\'id\'=>\'3\', \'text\'=>\'Product Price - Name\'), array(\'id\'=>\'4\', \'text\'=>\'Product Price - Model\'), array(\'id\'=>\'5\', \'text\'=>\'Product Name - Model\'), array(\'id\'=>\'6\', \'text\'=>\'Product Sort Order\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Button and Image Status', 'SHOW_PREVIOUS_NEXT_STATUS', '0', 'Button and Product Image status settings are:<br />0= Off<br />1= On', 18, 20, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Button and Image Settings', 'SHOW_PREVIOUS_NEXT_IMAGES', '0', 'Show Previous/Next Button and Product Image Settings<br />0= Button Only<br />1= Button and Product Image<br />2= Product Image Only', 18, 21, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Button Only\'), array(\'id\'=>\'1\', \'text\'=>\'Button and Product Image\'), array(\'id\'=>\'2\', \'text\'=>\'Product Image Only\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Previous Next - Image Width?', 'PREVIOUS_NEXT_IMAGE_WIDTH', '50', 'Previous/Next Image Width?', '18', '22', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Previous Next - Image Height?', 'PREVIOUS_NEXT_IMAGE_HEIGHT', '40', 'Previous/Next Image Height?', '18', '23', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Navigation Includes Category Position', 'PRODUCT_INFO_CATEGORIES', '1', 'Product\'s Category Image and Name Alignment Above Previous/Next Navigation Bar<br />0= off<br />1= Align Left<br />2= Align Center<br />3= Align Right', 18, 20, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Align Left\'), array(\'id\'=>\'2\', \'text\'=>\'Align Center\'), array(\'id\'=>\'3\', \'text\'=>\'Align Right\')),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Navigation Includes Category Name and Image Status', 'PRODUCT_INFO_CATEGORIES_IMAGE_STATUS', '2', 'Product\'s Category Image and Name Status<br />0= Category Name and Image always shows<br />1= Category Name only<br />2= Category Name and Image when not blank', 18, 20, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Category Name and Image Always\'), array(\'id\'=>\'1\', \'text\'=>\'Category Name only\'), array(\'id\'=>\'2\', \'text\'=>\'Category Name and Image when not blank\')),');



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Column Width - Left Boxes', 'BOX_WIDTH_LEFT', '150px', 'Width of the Left Column Boxes<br />px may be included<br />Default = 150px', 19, 1, NULL, '2003-11-21 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Column Width - Right Boxes', 'BOX_WIDTH_RIGHT', '150px', 'Width of the Right Column Boxes<br />px may be included<br />Default = 150px', 19, 2, NULL, '2003-11-21 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Bread Crumbs Navigation Separator', 'BREAD_CRUMBS_SEPARATOR', '&nbsp;::&nbsp;', 'Enter the separator symbol to appear between the Navigation Bread Crumb trail<br />Note: Include spaces with the &amp;nbsp; symbol if you want them part of the separator.<br />Default = &amp;nbsp;::&amp;nbsp;', 19, 3, NULL, '2003-11-21 22:16:36', NULL, 'zen_cfg_textarea_small(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Define Breadcrumb Status', 'DEFINE_BREADCRUMB_STATUS', '2', 'Enable the Breadcrumb Trail Links?<br />0= OFF<br />1= ON<br />2= Off for Home Page Only', 19, 4, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Bestsellers - Number Padding', 'BEST_SELLERS_FILLER', '&nbsp;', 'What do you want to Pad the numbers with?<br />Default = &amp;nbsp;', 19, 5, NULL, '2003-11-21 22:16:36', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Bestsellers - Truncate Product Names', 'BEST_SELLERS_TRUNCATE', '35', 'What size do you want to truncate the Product Names?<br />Default = 35', 19, 6, NULL, '2003-11-21 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Bestsellers - Truncate Product Names followed by ...', 'BEST_SELLERS_TRUNCATE_MORE', 'true', 'When truncated Product Names follow with ...<br />Default = true', 19, 7, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Box - Show Specials Link', 'SHOW_CATEGORIES_BOX_SPECIALS', 'true', 'Show Specials Link in the Categories Box', 19, 8, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Box - Show Products New Link', 'SHOW_CATEGORIES_BOX_PRODUCTS_NEW', 'true', 'Show Products New Link in the Categories Box', 19, 9, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Shopping Cart Box Status', 'SHOW_SHOPPING_CART_BOX_STATUS', '1', 'Shopping Cart Shows<br />0= Always<br />1= Only when full<br />2= Only when full but not when viewing the Shopping Cart', 19, 10, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Box - Show Featured Products Link', 'SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS', 'true', 'Show Featured Products Link in the Categories Box', 19, 11, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Box - Show Products All Link', 'SHOW_CATEGORIES_BOX_PRODUCTS_ALL', 'true', 'Show Products All Link in the Categories Box', 19, 12, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Column Left Status - Global', 'COLUMN_LEFT_STATUS', '1', 'Show Column Left, unless page override exists?<br />0= Column Left is always off<br />1= Column Left is on, unless page override', 19, 15, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Column Right Status - Global', 'COLUMN_RIGHT_STATUS', '1', 'Show Column Right, unless page override exists?<br />0= Column Right is always off<br />1= Column Right is on, unless page override', 19, 16, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Column Width - Left', 'COLUMN_WIDTH_LEFT', '150px', 'Width of the Left Column<br />px may be included<br />Default = 150px', 19, 20, NULL, '2003-11-21 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Column Width - Right', 'COLUMN_WIDTH_RIGHT', '150px', 'Width of the Right Column<br />px may be included<br />Default = 150px', 19, 21, NULL, '2003-11-21 22:16:36', NULL, NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories Separator between links Status', 'SHOW_CATEGORIES_SEPARATOR_LINK', '1', 'Show Category Separator between Category Names and Links?<br />0= off<br />1= on', 19, 24, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Separator between the Category Name and Count', 'CATEGORIES_SEPARATOR', '-&gt;', 'What separator do you want between the Category name and the count?<br />Default = -&amp;gt;', 19, 25, NULL, '2003-11-21 22:16:36', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Separator between the Category Name and Sub Categories', 'CATEGORIES_SEPARATOR_SUBS', '|_&nbsp;', 'What separator do you want between the Category name and Sub Category Name?<br />Default = |_&amp;nbsp;', 19, 26, NULL, '2004-03-25 22:16:36', NULL, 'zen_cfg_textarea_small(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Count Prefix', 'CATEGORIES_COUNT_PREFIX', '&nbsp;(', 'What do you want to Prefix the count with?<br />Default= (', 19, 27, NULL, '2003-01-21 22:16:36', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Count Suffix', 'CATEGORIES_COUNT_SUFFIX', ')', 'What do you want as a Suffix to the count?<br />Default= )', 19, 28, NULL, '2003-01-21 22:16:36', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories SubCategories Indent', 'CATEGORIES_SUBCATEGORIES_INDENT', '&nbsp;&nbsp;', 'What do you want to use as the subcategories indent?<br />Default= &nbsp;&nbsp;', 19, 29, NULL, '2004-06-24 22:16:36', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories with 0 Products Status', 'CATEGORIES_COUNT_ZERO', '0', 'Show Category Count for 0 Products?<br />0= off<br />1= on', 19, 30, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Split Categories Box', 'CATEGORIES_SPLIT_DISPLAY', 'True', 'Split the categories box display by product type', 19, 31, 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Shopping Cart - Show Totals', 'SHOW_TOTALS_IN_CART', '1', 'Show Totals Above Shopping Cart?<br />0= off<br />1= on: Items Weight Amount<br />2= on: Items Weight Amount, but no weight when 0<br />3= on: Items Amount', 19, 31, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Greeting - Show on Index Page', 'SHOW_CUSTOMER_GREETING', '1', 'Always Show Customer Greeting on Index?<br />0= off<br />1= on', 19, 40, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories - Always Show on Main Page', 'SHOW_CATEGORIES_ALWAYS', '0', 'Always Show Categories on Main Page<br />0= off<br />1= on<br />Default category can be set to Top Level or a Specific Top Level', 19, 45, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Main Page - Opens with Category', 'CATEGORIES_START_MAIN', '0', '0= Top Level Categories<br />Or enter the Category ID#<br />Note: Sub Categories can also be used Example: 3_10', '19', '46', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories - Always Open to Show SubCategories', 'SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS', '1', 'Always Show Categories and SubCategories<br />0= off, just show Top Categories<br />1= on, Always show Categories and SubCategories when selected', 19, 47, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Header Position 1', 'SHOW_BANNERS_GROUP_SET1', '', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Header Position 1?<br />Leave blank for none', '19', '55', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Header Position 2', 'SHOW_BANNERS_GROUP_SET2', '', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Header Position 2?<br />Leave blank for none', '19', '56', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Header Position 3', 'SHOW_BANNERS_GROUP_SET3', '', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Header Position 3?<br />Leave blank for none', '19', '57', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Footer Position 1', 'SHOW_BANNERS_GROUP_SET4', '', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Footer Position 1?<br />Leave blank for none', '19', '65', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Footer Position 2', 'SHOW_BANNERS_GROUP_SET5', '', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Footer Position 2?<br />Leave blank for none', '19', '66', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Footer Position 3', 'SHOW_BANNERS_GROUP_SET6', 'Wide-Banners', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />Default Group is Wide-Banners<br /><br />What Banner Group(s) do you want to use in the Footer Position 3?<br />Leave blank for none', '19', '67', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Side Box banner_box', 'SHOW_BANNERS_GROUP_SET7', 'SideBox-Banners', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br />Default Group is SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Side Box - banner_box?<br />Leave blank for none', '19', '70', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Side Box banner_box2', 'SHOW_BANNERS_GROUP_SET8', 'SideBox-Banners', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br />Default Group is SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Side Box - banner_box2?<br />Leave blank for none', '19', '71', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Group - Side Box banner_box_all', 'SHOW_BANNERS_GROUP_SET_ALL', 'BannersAll', 'The Banner Display Group may only be from one (1) Banner Group for the Banner All sidebox<br /><br />Default Group is BannersAll<br /><br />What Banner Group do you want to use in the Side Box - banner_box_all?<br />Leave blank for none', '19', '72', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Footer - Show IP Address status', 'SHOW_FOOTER_IP', '0', 'Show Customer IP Address in the Footer<br />0= off<br />1= on<br />Should the Customer IP Address show in the footer?', 19, 80, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Product Discount Quantities - Add how many blank discounts?', 'DISCOUNT_QTY_ADD', '5', 'How many blank discount quantities should be added for Product Pricing?', '19', '90', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Product Discount Quantities - Display how many per row?', 'DISCOUNT_QUANTITY_PRICES_COLUMN', '5', 'How many discount quantities should show per row on Product Info Pages?', '19', '95', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories/Products Display Sort Order', 'CATEGORIES_PRODUCTS_SORT_ORDER', '0', 'Categories/Products Display Sort Order<br />0= Categories/Products Sort Order/Name<br />1= Categories/Products Name<br />2= Products Model<br />3= Products Qty+, Products Name<br />4= Products Qty-, Products Name<br />5= Products Price+, Products Name<br />6= Products Price-, Products Name', '19', '100', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Option Names and Values Global Add, Copy and Delete Features Status', 'OPTION_NAMES_VALUES_GLOBAL_STATUS', '1', 'Option Names and Values Global Add, Copy and Delete Features Status<br />0= Hide Features<br />1= Show Features<br />(Default=1)', '19', '110', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories-Tabs Menu ON/OFF', 'CATEGORIES_TABS_STATUS', '1', 'Categories-Tabs<br />This enables the display of your store\'s categories as a menu across the top of your header. There are many potential creative uses for this.<br />0= Hide Categories Tabs<br />1= Show Categories Tabs', '19', '112', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Site Map - include My Account Links?', 'SHOW_ACCOUNT_LINKS_ON_SITE_MAP', 'No', 'Should the links to My Account show up on the site-map?<br />Note: Spiders will try to index this page, and likely should not be sent to secure pages, since there is no benefit in indexing a login page.<br /><br />Default: false', 19, 115, 'zen_cfg_select_option(array(\'Yes\', \'No\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Skip 1-prod Categories', 'SKIP_SINGLE_PRODUCT_CATEGORIES', 'True', 'Skip single-product categories<br />If this option is set to True, then if the customer clicks on a link to a category which only contains a single item, then Zen Cart will take them directly to that product-page, rather than present them with another link to click in order to see the product.<br />Default: True', '19', '120', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use split-login page', 'USE_SPLIT_LOGIN_MODE', 'True', 'The login page can be displayed in two modes: Split or Vertical.<br />In Split mode, the create-account options are accessed by clicking a button to get to the create-account page.  In Vertical mode, the create-account input fields are all displayed inline, below the login field, making one less click for the customer to create their account.<br />Default: True', '19', '121', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());

# CSS Buttons switch
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('CSS Buttons (Frontend)', 'IMAGE_USE_CSS_BUTTONS', 'Yes', 'CSS Buttons<br />Use CSS buttons instead of images (GIF/JPG) in the frontend?<br />Button styles must be configured in the stylesheet if you enable this option.', '19', '147', 'zen_cfg_select_option(array(\'No\', \'Yes\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('<strong>Down for Maintenance: ON/OFF</strong>', 'DOWN_FOR_MAINTENANCE', 'false', 'Down for Maintenance <br />(true=on false=off)', '20', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: filename', 'DOWN_FOR_MAINTENANCE_FILENAME', 'down_for_maintenance', 'Down for Maintenance filename<br />Note: Do not include the extension<br />Default=down_for_maintenance', '20', '2', '', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Header', 'DOWN_FOR_MAINTENANCE_HEADER_OFF', 'false', 'Down for Maintenance: Hide Header <br />(true=hide false=show)', '20', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Column Left', 'DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF', 'false', 'Down for Maintenance: Hide Column Left <br />(true=hide false=show)', '20', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Column Right', 'DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF', 'false', 'Down for Maintenance: Hide Column Right <br />(true=hide false=show)', '20', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Footer', 'DOWN_FOR_MAINTENANCE_FOOTER_OFF', 'false', 'Down for Maintenance: Hide Footer <br />(true=hide false=show)', '20', '6', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Prices', 'DOWN_FOR_MAINTENANCE_PRICES_OFF', 'false', 'Down for Maintenance: Hide Prices <br />(true=hide false=show)', '20', '7', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Down For Maintenance (exclude this IP-Address)', 'EXCLUDE_ADMIN_IP_FOR_MAINTENANCE', 'your IP (ADMIN)', 'This IP Address is able to access the website while it is Down For Maintenance (like webmaster)<br />To enter multiple IP Addresses, separate with a comma. If you do not know your IP Address, check in the Footer of your Shop.', 20, 8, '2003-03-21 13:43:22', '2003-03-21 21:20:07', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('NOTICE PUBLIC Before going Down for Maintenance: ON/OFF', 'WARN_BEFORE_DOWN_FOR_MAINTENANCE', 'false', 'Give a WARNING some time before you put your website Down for Maintenance<br />(true=on false=off)<br />If you set the \'Down For Maintenance: ON/OFF\' to true this will automatically be updated to false', 20, 9, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Date and hours for notice before maintenance', 'PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', '15/05/2003  2-3 PM', 'Date and hours for notice before maintenance website, enter date and hours for maintenance website', 20, 10, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Display when webmaster has enabled maintenance', 'DISPLAY_MAINTENANCE_TIME', 'false', 'Display when Webmaster has enabled maintenance <br />(true=on false=off)<br />', 20, 11, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Display website maintenance period', 'DISPLAY_MAINTENANCE_PERIOD', 'false', 'Display Website maintenance period <br />(true=on false=off)<br />', 20, 12, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Website maintenance period', 'TEXT_MAINTENANCE_PERIOD_TIME', '2h00', 'Enter Website Maintenance period (hh:mm)', 20, 13, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Confirm Terms and Conditions During Checkout Procedure', 'DISPLAY_CONDITIONS_ON_CHECKOUT', 'true', 'Show the Terms and Conditions during the checkout procedure which the customer must agree to.', '11', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Confirm Privacy Notice During Account Creation Procedure', 'DISPLAY_PRIVACY_CONDITIONS', 'true', 'Show the Privacy Notice during the account creation procedure which the customer must agree to.', '11', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
# New since 1.5.4
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
('Display Revocation Checkbox on Checkout Confirmation Page?', 'DISPLAY_WIDERRUF_DOWNLOADS_ON_CHECKOUT_CONFIRMATION', 'false', 'Do you want to display a checkbox for the revocation clause for digital downloads on the checkout confirmation page?<br>Only activate if you are selling digital downloads!', 11, 3, NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), ');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_NEW_LIST_IMAGE', '1102', 'Do you want to display the Product Image?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_NEW_LIST_QUANTITY', '1202', 'Do you want to display the Product Quantity?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Buy Now Button', 'PRODUCT_NEW_BUY_NOW', '1300', 'Do you want to display the Product Buy Now Button<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_NEW_LIST_NAME', '2101', 'Do you want to display the Product Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_NEW_LIST_MODEL', '2201', 'Do you want to display the Product Model?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_NEW_LIST_MANUFACTURER', '2302', 'Do you want to display the Product Manufacturer Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price', 'PRODUCT_NEW_LIST_PRICE', '2402', 'Do you want to display the Product Price<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_NEW_LIST_WEIGHT', '2502', 'Do you want to display the Product Weight?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Date Added', 'PRODUCT_NEW_LIST_DATE_ADDED', '2601', 'Do you want to display the Product Date Added?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Description', 'PRODUCT_NEW_LIST_DESCRIPTION', '150', 'How many characters do you want to display of the Product Description?<br /><br />0= OFF<br />150= Suggested Length, or enter the maximum number of characters to display', '21', '10', now());


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Display - Default Sort Order', 'PRODUCT_NEW_LIST_SORT_DEFAULT', '6', 'What Sort Order Default should be used for New Products Display?<br />Default= 6 for Date New to Old<br /><br />1= Products Name<br />2= Products Name Desc<br />3= Price low to high, Products Name<br />4= Price high to low, Products Name<br />5= Model<br />6= Date Added desc<br />7= Date Added<br />8= Product Sort Order', '21', '11', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Products New Group ID', 'PRODUCT_NEW_LIST_GROUP_ID', '21', 'Warning: Only change this if your Products New Group ID has changed from the default of 21<br />What is the configuration_group_id for New Products Listings?', '21', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', '3', 'Do you want to display Add Multiple Products Qty Box and Set Button Location?<br />0= off<br />1= Top<br />2= Bottom<br />3= Both', '21', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Mask Upcoming Products from being include as New Products', 'SHOW_NEW_PRODUCTS_UPCOMING_MASKED', '0', 'Do you want to mask Upcoming Products from being included as New Products in Listing, Sideboxes and Centerbox?<br />0= off<br />1= on', '21', '30', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_FEATURED_LIST_IMAGE', '1102', 'Do you want to display the Product Image?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_FEATURED_LIST_QUANTITY', '1202', 'Do you want to display the Product Quantity?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Buy Now Button', 'PRODUCT_FEATURED_BUY_NOW', '1300', 'Do you want to display the Product Buy Now Button<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_FEATURED_LIST_NAME', '2101', 'Do you want to display the Product Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_FEATURED_LIST_MODEL', '2201', 'Do you want to display the Product Model?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_FEATURED_LIST_MANUFACTURER', '2302', 'Do you want to display the Product Manufacturer Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price', 'PRODUCT_FEATURED_LIST_PRICE', '2402', 'Do you want to display the Product Price<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_FEATURED_LIST_WEIGHT', '2502', 'Do you want to display the Product Weight?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Date Added', 'PRODUCT_FEATURED_LIST_DATE_ADDED', '2601', 'Do you want to display the Product Date Added?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Description', 'PRODUCT_FEATURED_LIST_DESCRIPTION', '150', 'How many characters do you want to display of the Product Description?<br /><br />0= OFF<br />150= Suggested Length, or enter the maximum number of characters to display', '22', '10', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Display - Default Sort Order', 'PRODUCT_FEATURED_LIST_SORT_DEFAULT', '1', 'What Sort Order Default should be used for Featured Product Display?<br />Default= 1 for Product Name<br /><br />1= Products Name<br />2= Products Name Desc<br />3= Price low to high, Products Name<br />4= Price high to low, Products Name<br />5= Model<br />6= Date Added desc<br />7= Date Added<br />8= Product Sort Order', '22', '11', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Featured Products Group ID', 'PRODUCT_FEATURED_LIST_GROUP_ID', '22', 'Warning: Only change this if your Featured Products Group ID has changed from the default of 22<br />What is the configuration_group_id for Featured Products Listings?', '22', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', '3', 'Do you want to display Add Multiple Products Qty Box and Set Button Location?<br />0= off<br />1= Top<br />2= Bottom<br />3= Both', '22', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_ALL_LIST_IMAGE', '1102', 'Do you want to display the Product Image?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_ALL_LIST_QUANTITY', '1202', 'Do you want to display the Product Quantity?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Buy Now Button', 'PRODUCT_ALL_BUY_NOW', '1300', 'Do you want to display the Product Buy Now Button<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_ALL_LIST_NAME', '2101', 'Do you want to display the Product Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_ALL_LIST_MODEL', '2201', 'Do you want to display the Product Model?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_ALL_LIST_MANUFACTURER', '2302', 'Do you want to display the Product Manufacturer Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price', 'PRODUCT_ALL_LIST_PRICE', '2402', 'Do you want to display the Product Price<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_ALL_LIST_WEIGHT', '2502', 'Do you want to display the Product Weight?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Date Added', 'PRODUCT_ALL_LIST_DATE_ADDED', '2601', 'Do you want to display the Product Date Added?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Description', 'PRODUCT_ALL_LIST_DESCRIPTION', '150', 'How many characters do you want to display of the Product Description?<br /><br />0= OFF<br />150= Suggested Length, or enter the maximum number of characters to display', '23', '10', now());


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Display - Default Sort Order', 'PRODUCT_ALL_LIST_SORT_DEFAULT', '1', 'What Sort Order Default should be used for All Products Display?<br />Default= 1 for Product Name<br /><br />1= Products Name<br />2= Products Name Desc<br />3= Price low to high, Products Name<br />4= Price high to low, Products Name<br />5= Model<br />6= Date Added desc<br />7= Date Added<br />8= Product Sort Order', '23', '11', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Products All Group ID', 'PRODUCT_ALL_LIST_GROUP_ID', '23', 'Warning: Only change this if your Products All Group ID has changed from the default of 23<br />What is the configuration_group_id for Products All Listings?', '23', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', '3', 'Do you want to display Add Multiple Products Qty Box and Set Button Location?<br />0= off<br />1= Top<br />2= Bottom<br />3= Both', '23', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show New Products on Main Page', 'SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS', '1', 'Show New Products on Main Page<br />0= off or set the sort order', '24', '65', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Featured Products on Main Page', 'SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS', '2', 'Show Featured Products on Main Page<br />0= off or set the sort order', '24', '66', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Special Products on Main Page', 'SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS', '3', 'Show Special Products on Main Page<br />0= off or set the sort order', '24', '67', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Upcoming Products on Main Page', 'SHOW_PRODUCT_INFO_MAIN_UPCOMING', '4', 'Show Upcoming Products on Main Page<br />0= off or set the sort order', '24', '68', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show New Products on Main Page - Category with SubCategories', 'SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS', '1', 'Show New Products on Main Page - Category with SubCategories<br />0= off or set the sort order', '24', '70', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Featured Products on Main Page - Category with SubCategories', 'SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS', '2', 'Show Featured Products on Main Page - Category with SubCategories<br />0= off or set the sort order', '24', '71', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Special Products on Main Page - Category with SubCategories', 'SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS', '3', 'Show Special Products on Main Page - Category with SubCategories<br />0= off or set the sort order', '24', '72', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Upcoming Products on Main Page - Category with SubCategories', 'SHOW_PRODUCT_INFO_CATEGORY_UPCOMING', '4', 'Show Upcoming Products on Main Page - Category with SubCategories<br />0= off or set the sort order', '24', '73', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show New Products on Main Page - Errors and Missing Products Page', 'SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS', '1', 'Show New Products on Main Page - Errors and Missing Product<br />0= off or set the sort order', '24', '75', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Featured Products on Main Page - Errors and Missing Products Page', 'SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS', '2', 'Show Featured Products on Main Page - Errors and Missing Product<br />0= off or set the sort order', '24', '76', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Special Products on Main Page - Errors and Missing Products Page', 'SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS', '3', 'Show Special Products on Main Page - Errors and Missing Product<br />0= off or set the sort order', '24', '77', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Upcoming Products on Main Page - Errors and Missing Products Page', 'SHOW_PRODUCT_INFO_MISSING_UPCOMING', '4', 'Show Upcoming Products on Main Page - Errors and Missing Product<br />0= off or set the sort order', '24', '78', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show New Products - below Product Listing', 'SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS', '1', 'Show New Products below Product Listing<br />0= off or set the sort order', '24', '85', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Featured Products - below Product Listing', 'SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS', '2', 'Show Featured Products below Product Listing<br />0= off or set the sort order', '24', '86', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Special Products - below Product Listing', 'SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS', '3', 'Show Special Products below Product Listing<br />0= off or set the sort order', '24', '87', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Upcoming Products - below Product Listing', 'SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING', '4', 'Show Upcoming Products below Product Listing<br />0= off or set the sort order', '24', '88', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('New Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS', '3', 'New Products Columns per Row', '24', '95', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Featured Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS', '3', 'Featured Products Columns per Row', '24', '96', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Special Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS', '3', 'Special Products Columns per Row', '24', '97', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Filter Product Listing for Current Top Level Category When Enabled', 'SHOW_PRODUCT_INFO_ALL_PRODUCTS', '1', 'Filter the products when Product Listing is enabled for current Main Category or show products from all categories?<br />0= Filter Off 1=Filter On ', '24', '100', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

#Define Page Status
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Main Page Status', 'DEFINE_MAIN_PAGE_STATUS', '1', 'Enable the Defined Main Page Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '60', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Contact Us Status', 'DEFINE_CONTACT_US_STATUS', '1', 'Enable the Defined Contact Us Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '61', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Privacy Status', 'DEFINE_PRIVACY_STATUS', '1', 'Enable the Defined Privacy Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '62', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Shipping & Returns', 'DEFINE_SHIPPINGINFO_STATUS', '1', 'Enable the Defined Shipping & Returns Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '63', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Conditions of Use', 'DEFINE_CONDITIONS_STATUS', '1', 'Enable the Defined Conditions of Use Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '64', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Checkout Success', 'DEFINE_CHECKOUT_SUCCESS_STATUS', '1', 'Enable the Defined Checkout Success Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '65', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Discount Coupon', 'DEFINE_DISCOUNT_COUPON_STATUS', '1', 'Enable the Defined Discount Coupon Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '66', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Site Map Status', 'DEFINE_SITE_MAP_STATUS', '1', 'Enable the Defined Site Map Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '67', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Page-Not-Found Status', 'DEFINE_PAGE_NOT_FOUND_STATUS', '1', 'Enable the Defined Page-Not-Found Text from define-pages?<br />0= Define Text OFF<br />1= Define Text ON', '25', '67', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Page 2', 'DEFINE_PAGE_2_STATUS', '1', 'Enable the Defined Page 2 Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '82', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Page 3', 'DEFINE_PAGE_3_STATUS', '1', 'Enable the Defined Page 3 Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '83', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Page 4', 'DEFINE_PAGE_4_STATUS', '1', 'Enable the Defined Page 4 Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '84', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Imprint', 'DEFINE_IMPRESSUM_STATUS', '1', 'Enable the Defined Imprint Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '85', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Right of Withdrawal', 'DEFINE_WIDERRUFSRECHT_STATUS', '1', 'Enable the Defined Right of Withdrawal Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '86', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Payment Methods', 'DEFINE_ZAHLUNGSARTEN_STATUS', '1', 'Enable the Defined Payment Methods Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '87', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');

#EZ-Pages settings
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('EZ-Pages Display Status - HeaderBar', 'EZPAGES_STATUS_HEADER', '1', 'Display of EZ-Pages content can be Globally enabled/disabled for the Header Bar<br />0 = Off<br />1 = On<br />2= On ADMIN IP ONLY located in Website Maintenance<br />NOTE: Warning only shows to the Admin and not to the public', 30, 10, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('EZ-Pages Display Status - FooterBar', 'EZPAGES_STATUS_FOOTER', '1', 'Display of EZ-Pages content can be Globally enabled/disabled for the Footer Bar<br />0 = Off<br />1 = On<br />2= On ADMIN IP ONLY located in Website Maintenance<br />NOTE: Warning only shows to the Admin and not to the public', 30, 11, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('EZ-Pages Display Status - Sidebox', 'EZPAGES_STATUS_SIDEBOX', '1', 'Display of EZ-Pages content can be Globally enabled/disabled for the Sidebox<br />0 = Off<br />1 = On<br />2= On ADMIN IP ONLY located in Website Maintenance<br />NOTE: Warning only shows to the Admin and not to the public', 30, 12, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Header Link Separator', 'EZPAGES_SEPARATOR_HEADER', '&nbsp;::&nbsp;', 'EZ-Pages Header Link Separator<br />Default = &amp;nbsp;::&amp;nbsp;', 30, 20, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Footer Link Separator', 'EZPAGES_SEPARATOR_FOOTER', '&nbsp;::&nbsp;', 'EZ-Pages Footer Link Separator<br />Default = &amp;nbsp;::&amp;nbsp;', 30, 21, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('EZ-Pages Prev/Next Buttons', 'EZPAGES_SHOW_PREV_NEXT_BUTTONS', '2', 'Display Prev/Continue/Next buttons on EZ-Pages pages?<br />0=OFF (no buttons)<br />1="Continue"<br />2="Prev/Continue/Next"<br /><br />Default setting: 2.', 30, 30, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Table of Contents for Chapters Status', 'EZPAGES_SHOW_TABLE_CONTENTS', '1', 'Enable EZ-Pages Table of Contents for Chapters?<br />0= OFF<br />1= ON', 30, 35, now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Pages to disable headers', 'EZPAGES_DISABLE_HEADER_DISPLAY_LIST', '', 'EZ-Pages "pages" on which to NOT display the normal "header" for your site.<br />Simply list page ID numbers separated by commas with no spaces.<br />Page ID numbers can be obtained from the EZ-Pages screen under Admin->Tools.<br />ie: 1,5,2<br />or leave blank.', 30, 40, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Pages to disable footers', 'EZPAGES_DISABLE_FOOTER_DISPLAY_LIST', '', 'EZ-Pages "pages" on which to NOT display the normal "footer" for your site.<br />Simply list page ID numbers separated by commas with no spaces.<br />Page ID numbers can be obtained from the EZ-Pages screen under Admin->Tools.<br />ie: 3,7<br />or leave blank.', 30, 41, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Pages to disable left-column', 'EZPAGES_DISABLE_LEFTCOLUMN_DISPLAY_LIST', '', 'EZ-Pages "pages" on which to NOT display the normal "left" column (of sideboxes) for your site.<br />Simply list page ID numbers separated by commas with no spaces.<br />Page ID numbers can be obtained from the EZ-Pages screen under Admin->Tools.<br />ie: 21<br />or leave blank.', 30, 42, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Pages to disable right-column', 'EZPAGES_DISABLE_RIGHTCOLUMN_DISPLAY_LIST', '', 'EZ-Pages "pages" on which to NOT display the normal "right" column (of sideboxes) for your site.<br />Simply list page ID numbers separated by commas with no spaces.<br />Page ID numbers can be obtained from the EZ-Pages screen under Admin->Tools.<br />ie: 3,82,13<br />or leave blank.', 30, 43, NULL, now(), NULL, 'zen_cfg_textarea_small(');

#Minify settings
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable Minify for Javascripts', 'MINIFY_STATUS_JS', 'true', 'Minifying will speed up your site\'s loading speed by combining and compressing Javascript files.', 31, 1, NULL, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable Minify for CSS', 'MINIFY_STATUS_CSS', 'true', 'Minifying will speed up your site\'s loading speed by combining and compressing CSS files.', 31, 2, NULL, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Max URL Lenght', 'MINIFY_MAX_URL_LENGHT', '500', 'On some server the maximum lenght of any POST/GET request URL is limited. If this is the case for your server, you can change the setting here', 31, 3, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Minify Cache Time', 'MINIFY_CACHE_TIME_LENGHT', '31536000', 'Set minify cache time (in second). Default is 1 year (31536000)', 31, 4, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Latest Cache Time', 'MINIFY_CACHE_TIME_LATEST', '0', 'Normally you don\'t have to set this, but if you have just made changes to your js/css files and want to make sure they are reloaded right away, you can reset this to 0.', 31, 5, NULL, now(), NULL, NULL);

#Spam Protection settings - new since 1.5.7 - replaces google analytics
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Spam Protection Version Info', 'SPAM_VERSION', '1.0.0', 'Since version 1.5.7 an improved honeypot spam protection is integrated in the German Zen Cart version. The pages Contact, Registration, Ask a question and Write review are equipped with 2 additional hidden form fields. Spambots try to fill in all existing form fields, if hidden ones are filled in, it can only be spam. To prevent spambots from adding the names of the hidden fields to their lists, the names of these fields are automatically changed on a regular basis in the time frame you set below.<br>This is a significant improvement over older Zen Cart versions, but please note that even this solution cannot provide 100% spam protection.<br>Should you continue to receive spam via the store contact forms, you must secure the forms with a real captcha.', 32, 1, now(), now(), NULL, 'zen_cfg_read_only(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Hidden radio field name', 'SPAM_TEST_TEXT', 'NVMBQgxicl', 'Current name of the hidden input field', 32, 2, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Hidden radio field name', 'SPAM_TEST_USER', 'lBv617bFNo', 'Current name of the hidden radio button field', 32, 3, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Number of days for the name change', 'SPAM_CHANGE_DAYS', '10', 'Set here the number of days after which the above named fields should be renamed automatically.<br>Default: 10', 32, 4, now(), now(), NULL, NULL);

#Open Graph / Microdata Settings
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Open Graph - Enable Open Graph/Microdata', 'FACEBOOK_OPEN_GRAPH_STATUS', 'false', 'Enable Facebook Open Graph meta data?', 33, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Open Graph - Application ID', 'FACEBOOK_OPEN_GRAPH_APPID', '', 'Please enter your application ID (<a href="http://developers.facebook.com/setup/" target="_blank">Get an application ID</a>)', 33, 2, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Open Graph - Application Secret', 'FACEBOOK_OPEN_GRAPH_APPSECRET', '', 'Please enter your application secret', 33, 3, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Open Graph - Admin ID', 'FACEBOOK_OPEN_GRAPH_ADMINID', '', 'Enter the Admin ID(s) of the Facebook user(s) that administer your Facebook fan page separated by commas (<a href="http://www.facebook.com/insights/" target="_blank">Insights for your domain</a>)', 33, 4, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Open Graph - Default Image', 'FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE', '', 'Enter the full path to your default image or leave blank to disable.  The default image is only used when the product image cannot be found.', 33, 5, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Open Graph - Object Type', 'FACEBOOK_OPEN_GRAPH_TYPE', 'product', 'Enter an Open Graph Object Type for your products (<a href="https://developers.facebook.com/docs/reference/opengraph/" target="_blank">Open Graph Object Types</a>)', 33, 6, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Open Graph - Use cPath', 'FACEBOOK_OPEN_GRAPH_CPATH', 'true', 'Include the cPath in your URLs?', 33, 7, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Open Graph - Include Language', 'FACEBOOK_OPEN_GRAPH_LANGUAGE', 'false', 'Include the language in your URLs?', 33, 8, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Open Graph - Use Canonical URL', 'FACEBOOK_OPEN_GRAPH_CANONICAL', 'true', 'Use the canonical URL from Zen Cart or try and recreate the URL?', 33, 9, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
# new since 1.5.5
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Google Publisher', 'FACEBOOK_OPEN_GRAPH_GOOGLE_PUBLISHER', '', 'Please enter your full Google Publisher url/link (https://plus.google.com/+xxx/)', 33, 20, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Your Logo', 'FACEBOOK_OPEN_GRAPH_LOGO', '', 'Please enter your full link to your logo url/link https:// is better!', 33, 21, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Street Address', 'FACEBOOK_OPEN_GRAPH_STREET_ADDRESS', '', 'Please enter your street address', 33, 22, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('City', 'FACEBOOK_OPEN_GRAPH_CITY', '', 'Please enter your city', 33, 23, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('State', 'FACEBOOK_OPEN_GRAPH_STATE', '', 'Please enter your state', 33, 24, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Postal Code', 'FACEBOOK_OPEN_GRAPH_ZIP', '', 'Please enter your postal code/zip', 33, 25, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Country', 'FACEBOOK_OPEN_GRAPH_COUNTRY', '', 'Please enter your 2 letter country code such as US', 33, 26, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Email', 'FACEBOOK_OPEN_GRAPH_EMAIL', '', 'Please enter your customer service email address (all lower case!)', 33, 27, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Phone', 'FACEBOOK_OPEN_GRAPH_PHONE', '', 'Required. An internationalized version of the phone number, starting with the + symbol and country code (+1 in the US and Canada). Like this +1-330-871-4357', 33, 28, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Twitter Handle', 'FACEBOOK_OPEN_GRAPH_TWUSER', '', 'Please enter your Twitter Handle like this @prowebs', 33, 29, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Facebook Page', 'FACEBOOK_OPEN_GRAPH_FBPG', '', 'Please enter your full url/link to your facebook page (https://www.facebook.com/xxx)', 33, 30, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Locale', 'FACEBOOK_OPEN_GRAPH_LOCALE', 'German', 'Optional details about the language spoken. Languages may be specified by their common English name. If omitted, the language defaults to English.', 33, 31, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Currency', 'FACEBOOK_OPEN_GRAPH_CUR', 'EUR', 'Please enter your currency code such as USD', 33, 32, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Lead Time', 'FACEBOOK_OPEN_GRAPH_DTS', '', 'Please enter the average days until you ship orders such as 2', 33, 33, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Condition', 'FACEBOOK_OPEN_GRAPH_COND', '', 'Please enter your products condition (NewCondition, UsedCondition, RefurbishedCondition, DamagedCondition)', 33, 34, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Payment Type 1', 'FACEBOOK_OPEN_GRAPH_PAY1', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', 33, 35, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Payment Type 2', 'FACEBOOK_OPEN_GRAPH_PAY2', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', 33, 36, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Payment Type 3', 'FACEBOOK_OPEN_GRAPH_PAY3', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', 33, 37, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Payment Type 4', 'FACEBOOK_OPEN_GRAPH_PAY4', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', 33, 38, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Payment Type 5', 'FACEBOOK_OPEN_GRAPH_PAY5', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', 33, 39, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Payment Type 6', 'FACEBOOK_OPEN_GRAPH_PAY6', '', 'Please enter ONE of the following payment types EXACTLY (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', 33, 40, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Tax ID', 'FACEBOOK_OPEN_GRAPH_TID', '', 'The Tax / Fiscal ID of the organization (e.g. the TIN in the US or the CIF/NIF in Spain))', 33, 41, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('DUNS', 'FACEBOOK_OPEN_GRAPH_DUNS', '', 'The Dun & Bradstreet DUNS number for identifying an organization or business person.', 33, 42, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Fax', 'FACEBOOK_OPEN_GRAPH_FAX', '', 'Please enter your fax number like this +1-877-453-1304.', 33, 43, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('VAT ID', 'FACEBOOK_OPEN_GRAPH_VAT', '', 'Value-added Tax ID of your organization.)', 33, 44, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Legal Name', 'FACEBOOK_OPEN_GRAPH_LEG', '', 'The official name of the organization, e.g. the registered company name.)', 33, 45, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Area Served', 'FACEBOOK_OPEN_GRAPH_AREA', '', 'Optional. The geographical region served by the number, specified as a Schema.org/AdministrativeArea. Countries may be specified concisely using just their standard ISO-3166 two-letter code, as in the examples at right. If omitted, the number is assumed to be global..)', 33, 46, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Twitter Page', 'FACEBOOK_OPEN_GRAPH_TWIT', '', 'Please enter your full url/link to your twitter page (https://twitter.com/xxx)', 33, 47, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Linkedin Page', 'FACEBOOK_OPEN_GRAPH_LINK', '', 'Please enter your full url/link to your Linkedin page (http://www.linkedin.com/company/xxx/)', 33, 48, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Another Profile Page', 'FACEBOOK_OPEN_GRAPH_PROF1', '', 'Please enter your full url/link to your profile page (https://www.dandb.com/businessdirectory/xxx.html)', 33, 49, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Another Profile Page', 'FACEBOOK_OPEN_GRAPH_PROF2', '', 'Please enter your full url/link to your profile page (http://www.yelp.com/biz/xxx)', 33, 50, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('Shipping to', 'FACEBOOK_OPEN_GRAPH_ELER', '', 'The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is valid. Such as US', 33, 51, NOW(), NOW(), NULL, NULL);

#RSS Feed Settings

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable RSS Feed?', 'RSS_FEED_ENABLED', 'true', 'Do you want to enable the RSS Feeds?', 34, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('RSS Title', 'RSS_TITLE', '', 'RSS Title (if empty use Store Name)', 34, 2, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('RSS Description', 'RSS_DESCRIPTION', '', 'RSS description', 34, 3, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('RSS Image', 'RSS_IMAGE', '', 'A GIF, JPEG or PNG image that represents the channel', 34, 4, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('RSS Image Name', 'RSS_IMAGE_NAME', '', 'RSS Image Name (if empty use Store Name)', 34, 5, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('RSS Copyright', 'RSS_COPYRIGHT', '', 'RSS Copyright (if empty use Store Owner)', 34, 6, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('RSS Managing Editor', 'RSS_MANAGING_EDITOR', '', 'RSS Managing Editor (if empty use Store Owner Email Address and Store Owner)', 34, 7, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('RSS Webmaster', 'RSS_WEBMASTER', '', 'RSS Webmaster (if empty use Store Owner Email Address and Store Owner)', 34, 8, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('RSS Author', 'RSS_AUTHOR', '', 'RSS Author (if empty use Store Owner Email Address and Store Owner)', 34, 9, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('RSS Home Page Feed', 'RSS_HOMEPAGE_FEED', 'new_products', 'RSS Home Page Feed', 34, 10, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'news\', \'new_products\', \'upcoming\', \'featured\', \'specials\', \'products\', \'categories\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('RSS Default Feed', 'RSS_DEFAULT_FEED', 'new_products', 'RSS Default Feed', 34, 11, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'new_products\', \'upcoming\', \'featured\', \'specials\', \'products\', \'categories\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Strip tags', 'RSS_STRIP_TAGS', 'false', 'Strip tags', 34, 12, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Generate Descriptions', 'RSS_ITEMS_DESCRIPTION', 'true', 'Generate Descriptions', 34, 13, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Descriptions Length', 'RSS_ITEMS_DESCRIPTION_MAX_LENGTH', '0', 'How many characters in description (0 for no limit)', 34, 14, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Time to live', 'RSS_TTL', '1440', 'Time to live - time after reader should refresh the info in minutes', 34, 15, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Default Products Limit', 'RSS_PRODUCTS_LIMIT', '100', 'Default Limit to Products Feed', 34, 16, NOW(), NOW(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Add Product image', 'RSS_PRODUCTS_DESCRIPTION_IMAGE', 'true', 'Add product image to product description tag', 34, 17, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Add "buy now" button', 'RSS_PRODUCTS_DESCRIPTION_BUYNOW', 'true', 'Add "buy now" button to product description tag', 34, 18, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories for Products', 'RSS_PRODUCTS_CATEGORIES', 'master', 'Use \'all\' or only \'master\' Categories for Products when specified cPath parameter', 34, 19, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'master\', \'all\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Feed Cache', 'RSS_CACHE_TIME', '10', 'Cache Time (in min). If you don\'t want caching, set it to 0. The cache feeds are generated into the cache folder.', 34, 20, NOW(), NOW(), NULL, NULL);


#Zen Colorbox Settings

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('<b>Zen Colorbox</b>', 'ZEN_COLORBOX_STATUS', 'true', '<br />If true, all product images on the following pages will be displayed within a lightbox:<br /><br />- document_general_info<br />- document_product_info<br />- page (EZ-Pages)<br />- product_free_shipping_info<br />- product_info<br />- product_music_info<br />- product_reviews<br />- product_reviews_info<br />- product_reviews_write<br /><br /><b>Default: true</b>', 35, 100, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('Overlay Opacity', 'ZEN_COLORBOX_OVERLAY_OPACITY', '0.6', '<br />Controls the transparency of the overlay.<br /><br /><b>Default: 0.6</b>', 35, 101, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''0'', ''0.1'', ''0.2'', ''0.3'', ''0.4'', ''0.5'', ''0.6'', ''0.7'', ''0.8'', ''0.9'', ''1''), '),
('Resize Duration', 'ZEN_COLORBOX_RESIZE_DURATION', '400', '<br />Controls the speed of the image resizing.<br /><br />Note: This value is measured in milliseconds.<br /><br /><b>Default: 400</b><br />', 35, 102, NOW(), NOW(), NULL, NULL),
('Initial Width', 'ZEN_COLORBOX_INITIAL_WIDTH', '250', '<br />If Enable Resize Animations is set to true, the lightbox will resize its width from this value to the current image width, when first displayed.<br /><br />Note: This value is measured in pixels.<br /><br /><b>Default: 250</b><br />', 35, 103, NOW(), NOW(), NULL, NULL),
('Initial Height', 'ZEN_COLORBOX_INITIAL_HEIGHT', '250', '<br />If Enable Resize Animations is set to true, the lightbox will resize its height from this value to the current image height, when first displayed.<br /><br />Note: This value is measured in pixels.<br /><br /><b>Default: 250</b><br />', 35, 104, NOW(), NOW(), NULL, NULL),
('Display Image Counter', 'ZEN_COLORBOX_COUNTER', 'true', '<br />If true, the image counter will be displayed (below the caption of each image) within the lightbox.<br /><br /><b>Default: true</b>', 35, 105, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('Close on Overlay Click', 'ZEN_COLORBOX_CLOSE_OVERLAY', 'false', '<br />If true, the lightbox will close when the overlay is clicked.<br /><br /><b>Default: false</b>', 35, 106, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('Loop', 'ZEN_COLORBOX_LOOP', 'true', '<br />If true, Images will loop in both directions.<br /><br /><b>Default: true</b>', 35, 107, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('<b>Slideshow</b>', 'ZEN_COLORBOX_SLIDESHOW', 'false', '<br />If true, Images will display as a slideshow.<br /><br /><b>Default: false</b>', 35, 200, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('&nbsp; Slideshow Auto Start', 'ZEN_COLORBOX_SLIDESHOW_AUTO', 'true', '<br />If true, your slideshow will auto start.<br /><br /><b>Default: true</b>', 35, 201, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('&nbsp; Slideshow Speed', 'ZEN_COLORBOX_SLIDESHOW_SPEED', '2500', '<br />Sets the speed of the slideshow <br /><br />Note: This value is measured in milliseconds.<br /><br /><b>Default: 2500</b>', 35, 202, NOW(), NOW(), NULL, NULL),
('&nbsp; Slideshow Start Text', 'ZEN_COLORBOX_SLIDESHOW_START_TEXT', 'start slideshow', '<br />Link text to start the slideshow.<br /><br /><b>Default: start slideshow</b>', 35, 203, NOW(), NOW(), NULL, NULL),
('&nbsp; Slideshow Stop Text', 'ZEN_COLORBOX_SLIDESHOW_STOP_TEXT', 'stop slideshow', '<br />Link text to stop the slideshow.<br /><br /><b>Default: stop slideshow</b>', 35, 204, NOW(), NOW(), NULL, NULL),
('<b>Gallery Mode</b>', 'ZEN_COLORBOX_GALLERY_MODE', 'true', '<br />If true, the lightbox will allow additional images to quickly be displayed using previous and next buttons.<br /><br /><b>Default: true</b>', 35, 300, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('&nbsp; Include Main Image in Gallery', 'ZEN_COLORBOX_GALLERY_MAIN_IMAGE', 'true', '<br />If true, the main product image will be included in the lightbox gallery.<br /><br /><b>Default: true</b>', 35, 301, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('<b>EZ-Pages Support</b>', 'ZEN_COLORBOX_EZPAGES', 'true', '<br />If true, the lightbox effect will be used for linked images on all EZ-Pages.<br /><br /><b>Default: true</b>', 35, 400, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('&nbsp; File Types', 'ZEN_COLORBOX_FILE_TYPES', 'jpg,png,gif', '<br />On EZ-Pages, the lightbox effect will be applied to all images with one of the following file types.<br /><br /><b>Default: jpg,png,gif</b><br />', 35, 401, NOW(), NOW(), NULL, NULL);

#IT Recht Kanzlei Settings
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('Version', 'IT_RECHT_KANZLEI_MODUL_VERSION', '1.0.0', 'Installierte Version:', 36, 0, NOW(), NOW(), NULL, 'zen_cfg_read_only('),
('IT Recht Kanzlei - Ist das Modul aktiv?', 'IT_RECHT_KANZLEI_STATUS', 'nein', 'Wollen Sie die Schnittstelle der IT Recht Kanzlei aktivieren?<br>Bitte erst dann aktivieren, wenn Sie sich mit der Funktionsweise vertraut gemacht haben.', 36, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''ja'', ''nein''),'),
('IT Recht Kanzlei - API Token', 'IT_RECHT_KANZLEI_TOKEN', '".md5(time() . rand(0,99999))."', 'Authentifizierungs-Token den Sie zur Übertragung im Mandantenportal der IT-Recht Kanzlei angeben.<br>Diese Token können Sie hier nicht ändern. Falls Sie eine neue Token erstellen wollen, nutzen Sie dazu die entsprechende Option unter Tools > IT Recht Kanzlei.', 36, 2, NOW(), NOW(), NULL, 'zen_cfg_read_only('),
('IT Recht Kanzlei - API Version', 'IT_RECHT_KANZLEI_VERSION', '1.0', 'API Version der IT Recht Kanzlei Schnittstelle', 36, 3, NOW(), NOW(), NULL, 'zen_cfg_read_only('),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext AGB', 'IT_RECHT_KANZLEI_PAGE_KEY_AGB', 'itrk-agb', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die AGB angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die AGB automatisch eingefügt.<br>Voreinstellung: itrk-agb', 36, 4, NOW(), NOW(), NULL, NULL),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Datenschutzerklärung', 'IT_RECHT_KANZLEI_PAGE_KEY_DATENSCHUTZ', 'itrk-datenschutz', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Datenschutzerklärung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Datenschutzerklärung automatisch eingefügt<br>Voreinstellung: itrk-datenschutz.', 36, 5, NOW(), NOW(), NULL, NULL),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Widerrufsbelehrung', 'IT_RECHT_KANZLEI_PAGE_KEY_WIDERRUF', 'itrk-widerruf', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Widerrufsbelehrung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Widerrufsbelehrung automatisch eingefügt<br>Voreinstellung: itrk-widerruf.', 36, 6, NOW(), NOW(), NULL, NULL),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Impressum', 'IT_RECHT_KANZLEI_PAGE_KEY_IMPRESSUM', 'itrk-impressum', 'Bitte geben Sie die Kennung der EZ Page an, die Sie für das Impressum angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für das Impressum automatisch eingefügt.<br>Voreinstellung: itrk-impressum', 36, 7, NOW(), NOW(), NULL, NULL),
('IT Recht Kanzlei - AGB auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_AGB', 'ja', 'Sollen die AGB auch als pdf verfügbar sein?', 36, 8, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''ja'', ''nein''),'),
('IT Recht Kanzlei - Datenschutzerklärung auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_DATENSCHUTZ', 'ja', 'Soll die Datenschutzerklärung auch als pdf verfügbar sein?', 36, 9, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''ja'', ''nein''),'),
('IT Recht Kanzlei - Widerrufsbelehrung auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_WIDERRUF', 'ja', 'Soll die Widerrufsbelehrung auch als pdf verfügbar sein?', 36, 10, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''ja'', ''nein''),'),
('IT Recht Kanzlei - Speicherort der pdf Dateien', 'IT_RECHT_KANZLEI_PDF_FILE', 'includes/pdf', 'In welchem Ordner am Server sollen die pdf Dateien gespeichert werden?<br>Lassen Sie diese Einstellung auf includes/pdf, damit das Modul pdf Rechnung falls installiert auf die pdfs zugreifen kann.', 36, 11, NOW(), NOW(), NULL, NULL);

#pdf Rechnung Settings

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('Version', 'RL_INVOICE3_MODUL_VERSION', '3.5.0', 'Version installed:', 37, 0, NOW(), NOW(), NULL, 'zen_cfg_read_only('),
('pdf Invoice - Status', 'RL_INVOICE3_STATUS', 'false', 'Do you want to activate the pdf invoice plugin?', 37, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('pdf Invoice - Date of invoice = Date of order?', 'RL_INVOICE3_ORDERDATE', 'true', 'Should the invoice date be the date of the order or the date of the creation of the invoice?', 37, 2, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('pdf Invoice - Customer ID', 'RL_INVOICE3_CUSTOMERID', 'true', 'Do you want to show the customer id on the pdf invoice?', 37, 4, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('pdf Invoice - Show shipping address?', 'RL_INVOICE3_SHIPPING_ADDRESS', 'true', 'Do you want to show the shipping address on the pdf invoice?', 37, 5, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('pdf Invoice - XY-position of address1 position', 'RL_INVOICE3_ADDRESS1_POS', '89|21', 'XY-position of address; its the margin delta <br />Default: 0|30', 37, 6, NOW(), NOW(), NULL, NULL),
('pdf Invoice - XY-position of address2 position', 'RL_INVOICE3_ADDRESS2_POS', '1|21', 'XY-position of address; its the margin delta <br />Default: 80|30', 37, 80, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Border Address1|2', 'RL_INVOICE3_ADDRESS_BORDER', '|', 'border Address1|2: LTRB (Left Top Right Bottom)<br />', 37, 70, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Width Address1|2', 'RL_INVOICE3_ADDRESS_WIDTH', '80|80', 'width Address1|2: 60|60<br />', 37, 40, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Deltas', 'RL_INVOICE3_DELTA', '5|8', 'delta address invoice|delta invoice products: 20|20<br />', 37, 50, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Fonts for invoice|products', 'RL_INVOICE3_FONTS', 'myriadpc|myriadpc', 'fonts for <br />1. invoice in general <br >2. products & total-table<br />', 37, 120, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Line Height', 'RL_INVOICE3_LINE_HEIGT', '1.25', 'Line Height', 37, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Line Total Thickness', 'RL_INVOICE3_LINE_THICK', '0.5', 'thickness off total-line', 37, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Margins', 'RL_INVOICE3_MARGIN', '20|20|20|20', 'defines the margins:<br />top|right|bottom|left<br />(Note: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />', 37, 20, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Accounting for free product', 'RL_INVOICE3_NOT_NULL_INVOICE', '0', 'Accounting for free product: send e-mail invoice', 37, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Send by orderstatus greater/equal than ', 'RL_INVOICE3_ORDERSTATUS', '3', 'only send invoice if orders_status greater or equal than', 37, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Prefix for OrderNo', 'RL_INVOICE3_ORDER_ID_PREFIX', ': 2022', 'prefix for OrderNo<br />', 37, 110, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Paper Size/Units/Oriantation', 'RL_INVOICE3_PAPER', 'A4|mm|P', '1. papersize = A3|A4|A5|Letter|Legal <br />2. units: pt|mm|cm|inch <br />3. Oriantation: L|P<br />', 37, 10, NOW(), NOW(), NULL, NULL),
('pdf Invoice - pdf background file', 'RL_INVOICE3_PDF_BACKGROUND', '" . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/rechnung_de.pdf', 'absolute path to pdf background file<br />', 37, 60, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Filename and path to store the pdf-file', 'RL_INVOICE3_PDF_PATH', '" . DIR_FS_CATALOG . "pdf/|1', 'absolute path to store the pdf-file (!!must be writeable !!)<br />Default: ../pdf/|1<br />', 37, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Additional attachements', 'RL_INVOICE3_SEND_ATTACH', 'agb_de.pdf|widerruf_de.pdf', 'RL_INVOICE3_SEND_PDF', 37, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - [RE]send order', 'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE', '3|7', '[RE]send invoice, if orderstatus changed to', 37, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Send pdf invoice with order', 'RL_INVOICE3_SEND_PDF', '0', 'Do you want to send the invoice with an order?', 37, 130, NOW(), NOW(), NULL, NULL),
('pdf Invoice - Templates for products table & total table', 'RL_INVOICE3_TABLE_TEMPLATE', 'amazon|amazon_templ|total_col_1|total_opt_1', 'templates for products_table & total_table; this is defined in rl_invoice3_def.php<br />', 37, 90, NOW(), NOW(), NULL, NULL),
('pdf Invoice - PDF-template on first page', 'RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE', 'false', 'print pdf-background-template omly on the first page', 37, 160, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('pdf Invoice - Delta 2.Page', 'RL_INVOICE3_DELTA_2PAGE', '10', 'Delta 2.Page', 37, 160, NOW(), NOW(), NULL, NULL);

#Shopvote Settings
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function, val_function) VALUES
('Shopvote - Version', 'SHOPVOTE_MODUL_VERSION', '1.1.0', 'Version installed:', 38, 0, NOW(), NOW(), NULL, 'zen_cfg_read_only(', NULL),
('Shopvote - Ist das Modul aktiv?', 'SHOPVOTE_STATUS', 'nein', 'Wollen Sie das Shopvote Siegel und die Easy Reviews Bewertungsanfragen aktivieren?<br>Bitte erst dann aktivieren, wenn Sie Zugriff auf die entsprechenden Javascript Snippets in Ihrer Shopvote Administration bekommen und die Einstellungen unten komplett vorgenommen haben.', 38, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''ja'', ''nein''),', NULL),
('Shopvote - Shop ID', 'SHOPVOTE_SHOP_ID', '', 'Tragen Sie hier Ihre Shopvote Shop ID ein', 38, 2, NOW(), NOW(), NULL, NULL, NULL),
('Shopvote - Easy Reviews Token', 'SHOPVOTE_EASY_REVIEWS_TOKEN', '', 'Tragen Sie hier Ihre Shopvote Token für Easy Reviews ein', 38, 3, NOW(), NOW(), NULL, NULL, NULL),
('Shopvote - Badge Typ', 'SHOPVOTE_BADGE_TYPE', '1', 'Wählen Sie die Art des Shopvote Siegels aus, das am unteren rechten Bildschirmrand angezeigt werden soll.<br>Zur Verfügung stehen hier die Badge Typen, die automatisch die Funktion Rating Stars (falls bei Shopvote gebucht) unterstützen, so dass Sie dafür keinerlei Code integrieren müssen.<br>Eine Vorschau der verschiedenen Badges finden Sie unter Grafiken & Siegel in Ihrer Shopvote Administration.<br>Für die Nutzung der All Votes Grafik müssen Sie bei Shopvote freigeschaltet sein.<br><br />1 = Vote Badge I (klein ohne Siegel)<br>2 = Vote Badge III (groß)<br>3 = Vote Badge II (klein)<br>4 = All Votes Grafik I<br /><br>', 38, 4, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''1'', ''2'', ''3'', ''4''), ', NULL),
('Shopvote - Vote Badge I - Abstand links/rechts', 'SHOPVOTE_SPACE_X', '2', 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>Abstand in Pixeln vom rechten/linken Bildschirmrand<br>darf nicht kleiner als 2 sein', 38, 5, NOW(), NOW(), NULL, NULL, NULL),
('Shopvote - Vote Badge I - Abstand oben/unten', 'SHOPVOTE_SPACE_Y', '5', 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>Abstand in Pixeln vom oberen/unteren Bildschirmrand<br>darf nicht kleiner als 5 sein', 38, 6, NOW(), NOW(), NULL, NULL, NULL),
('Shopvote - Vote Badge I - links oder rechts', 'SHOPVOTE_ALIGN_H', 'right', 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>horizontale Ausrichtung links oder rechts<br>left = links, right = rechts', 38, 7, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''right'', ''left''),', NULL),
('Shopvote - Vote Badge I - oben oder unten', 'SHOPVOTE_ALIGN_V', 'bottom', 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>vertikale Ausrichtung oben oder unten<br>top = oben, bottom = unten', 38, 8, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''bottom'', ''top''),', NULL),
('Shopvote - Vote Badge I - auf kleineren Display ausblenden', 'SHOPVOTE_DISPLAY_WIDTH', '480', 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>Display-Breite in Pixeln, bis zu der die Badget-Grafik ausgeblendet wird<br>Voreinstellung: 480<br>Dadurch wird die Grafik auf kleineren Smartphones nicht angezeigt und kann Ihre Seite nicht überlagern.', 38, 9, NOW(), NOW(), NULL, NULL, NULL);

#Cross Sell Settings
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Display Cross-Sell Products - Minimal', 'MIN_DISPLAY_XSELL', 1, 'This is the minimum number of configured Cross-Sell products required in order to cause the Cross Sell information to be displayed.<br />Default: 1', 39, 1, now() ,now(),NULL,NULL),
('Display Cross-Sell Products - Maximal', 'MAX_DISPLAY_XSELL', 6, 'Identify the maximum number of cross-sells to display on the storefront (default: <b>6</b>).<br><br>Set the value to <b>0</b> to disable the storefront display.', 39, 2, now(), now(),NULL,NULL),
('Cross-Sell Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS', 3, 'Identify the number of cross-sells to display per row (on the storefront).  Set the value to <em>0</em> to display <em>all</em> products on a single row.  Default: <b>3</b>.', 39, 3, now(), now(),NULL, 'zen_cfg_select_option(array(0, 1, 2, 3, 4), '),
('Cross-Sell - Display prices?', 'XSELL_DISPLAY_PRICE', 'false', 'Should the cross-sell product prices be displayed on the storefront (default: \'false\')?', 39, 4, now(), now(),NULL, 'zen_cfg_select_option(array(\'true\',\'false\'), '),
('Cross-Sell - Version', 'XSELL_VERSION', '2.0.1', 'Cross Sell Advanced Version', 39, 0, now(), now(), NULL, 'zen_cfg_read_only(');


#Vataddon
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Display Vat Addon', 'DISPLAY_VATADDON_WHERE', 'ALL', 'Do you want to display the text incl. or excl. VAT plus shipping costs near the prices?<br />0=off<br>ALL=everywhere<br>product_info=only on products details page<br />', '1', '120', NULL, now(), NULL, 'zen_cfg_select_option(array(\'0\', \'ALL\', \'product_info\'), ');

#EU Countries fuer Buttonloesung - Stand 01/2022
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EU Countries', 'EU_COUNTRIES_FOR_LAST_STEP', 'BE,BG,DK,DE,EE,FI,FR,GR,IE,IT,LV,LT,LU,MT,NL,AT,PL,PT,RO,SE,SK,SI,ES,CZ,HU,CY,HR', 'Enter the countries which are part of the European Union. Two digit ISO codes, comma separated.', '1', '100', now(), now(), NULL, NULL);

# New since 1.5.7 - global auth key
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('global auth key', 'GLOBAL_AUTH_KEY', '', '', 6, 30, now(), now(), NULL, NULL);

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES 
(1, 1, 'My Store', 'General information about my store', '1', '1'),
(2, 1 , 'Minimum Values', 'The minimum values for functions / data', '2', '1'),
(3, 1,  'Maximum Values', 'The maximum values for functions / data', '3', '1'),
(4, 1,  'Images', 'Image parameters', '4', '1'),
(5, 1,  'Customer Details', 'Customer account configuration', '5', '1'),
(6, 1,  'Module Options', 'Hidden from configuration', '6', '0'),
(7, 1,  'Shipping/Packaging', 'Shipping options available at my store', '7', '1'),
(8, 1,  'Product Listing', 'Product Listing configuration options', '8', '1'),
(9, 1,  'Stock', 'Stock configuration options', '9', '1'),
(10, 1,  'Logging', 'Logging configuration options', '10', '1'),
(11, 1,  'Regulations', 'Regulation options', '16', '1'),
(12, 1,  'Email', 'Email-related settings', '12', '1'),
(13, 1,  'Attribute Settings', 'Configure products attributes settings', '13', '1'),
(14, 1,  'GZip Compression', 'GZip compression options', '14', '1'),
(15, 1,  'Sessions', 'Session options', '15', '1'),
(16, 1,  'GV Coupons', 'Gift Vouchers and Coupons', '16', '1'),
(17, 1,  'Credit Cards', 'Credit Cards Accepted', '17', '1'),
(18, 1,  'Product Info', 'Product Info Display Options', '18', '1'),
(19, 1,  'Layout Settings', 'Layout Options', '19', '1'),
(20, 1,  'Website Maintenance', 'Website Maintenance Options', '20', '1'),
(21, 1,  'New Listing', 'New Products Listing', '21', '1'),
(22, 1,  'Featured Listing', 'Featured Products Listing', '22', '1'),
(23, 1,  'All Listing', 'All Products Listing', '23', '1'),
(24, 1,  'Index Listing', 'Index Products Listing', '24', '1'),
(25, 1,  'Define Page Status', 'Define Pages Options Settings', '25', '1'),
(30, 1,  'EZ-Pages Settings', 'EZ-Pages Settings', 30, '1'),
(31, 1,  'Minify Settings', 'Minify Settings', 31, '1'),
(32, 1,  'Spam Protection Settings', 'Spam Protection Settings', 32, '1'),
(33, 1,  'Open Graph/Microdata', 'Open Graph/Microdata', 33, '1'),
(34, 1,  'RSS Feed', 'RSS Feed Settings', 34, '1'),
(35, 1,  'Zen Colorbox', 'Zen Colorbox Settings', 35, '1'),
(36, 1,  'IT Recht Kanzlei', 'IT Recht Kanzlei Settings', 36, '1'),
(37, 1,  'pdf Invoice', 'pdf Invoice Settings', 37, '1'),
(38, 1,  'Shopvote', 'Shopvote Settings', 38, '1'),
(39, 1,  'Cross Sell Advanced', 'Cross Sell Settings', 39, '1');

# Set currencies

INSERT INTO currencies VALUES (1,'Euro', 'EUR', '', ' €', ',', '', '2', '1.000000', now());
INSERT INTO currencies VALUES (2,'US Dollar','USD','',' $','.',',','2','1.195740', now());
INSERT INTO currencies VALUES (3,'GB Pound','GBP','',' £','.',',','2','0.939593', now());
INSERT INTO currencies VALUES (4,'Canadian Dollar','CAD','',' $','.',',','2','1.575105', now());
INSERT INTO currencies VALUES (5,'Australian Dollar','AUD','',' $','.',',','2','1.715805', now());
INSERT INTO currencies VALUES (6,'Schweizer Franken','CHF','',' CHF','','','0','1.000000', now());


# Create Default IT-Recht Kanzlei EZ Pages - we reserve the first 4 pages for these special pages
INSERT INTO ezpages (pages_id, alt_url, alt_url_external, status_header, status_sidebox, status_footer, status_toc, header_sort_order, sidebox_sort_order, footer_sort_order, toc_sort_order, page_open_new_window, page_is_ssl, toc_chapter, page_key) VALUES
(1, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-datenschutz'),
(2, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-widerruf'),
(3, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-impressum'),
(4, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'itrk-agb');


# Create Default IT-Recht Kanzlei EZ Content Pages - we reserve the first 4 pages for these special pages
INSERT INTO ezpages_content (pages_id, languages_id, pages_title, pages_html_text) VALUES 
(1, 43, 'Datenschutzbestimmungen', ''),
(2, 43, 'Widerrufsrecht', ''),
(3, 43, 'Impressum', ''),
(4, 43, 'Allgemeine Geschäftsbedingungen', ''),
(1, 1, 'Privacy', ''),
(2, 1, 'Revocation Clause', ''),
(3, 1, 'Imprint', ''),
(4, 1, 'Terms and Conditions', '');

INSERT INTO languages VALUES (43,'Deutsch','de','icon.gif','german',1);
INSERT INTO languages VALUES (1,'English','en','icon.gif','english',2);

INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'banner_box_all.php', 1, 1, 5, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'banner_box.php', 1, 0, 300, 1, 127);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'banner_box2.php', 1, 1, 15, 1, 15);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'best_sellers.php', 1, 1, 30, 70, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'categories.php', 1, 0, 10, 10, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'currencies.php', 0, 1, 80, 60, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'document_categories.php', 1, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'ezpages.php', 1, 1, -1, 2, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'featured.php', 1, 0, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'information.php', 1, 0, 50, 40, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'languages.php', 0, 1, 70, 50, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'manufacturers.php', 1, 0, 30, 20, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'manufacturer_info.php', 1, 1, 35, 95, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'more_information.php', 1, 0, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'music_genres.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'order_history.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'product_notifications.php', 1, 1, 55, 85, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'record_companies.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'reviews.php', 1, 0, 40, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'search.php', 1, 1, 10, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'search_header.php', 0, 0, 0, 0, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'shopping_cart.php', 1, 1, 20, 30, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'specials.php', 1, 1, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'whats_new.php', 1, 0, 20, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'whos_online.php', 1, 1, 200, 200, 1);

INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'banner_box_all.php', 1, 1, 5, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'banner_box.php', 1, 0, 300, 1, 127);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'banner_box2.php', 1, 1, 15, 1, 15);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'best_sellers.php', 1, 1, 30, 70, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'categories.php', 1, 0, 10, 10, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'currencies.php', 0, 1, 80, 60, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'ezpages.php', 1, 1, -1, 2, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'featured.php', 1, 0, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'information.php', 1, 0, 50, 40, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'languages.php', 0, 1, 70, 50, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'manufacturers.php', 1, 0, 30, 20, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'manufacturer_info.php', 1, 1, 35, 95, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'more_information.php', 1, 0, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'my_broken_box.php', 1, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'order_history.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'product_notifications.php', 1, 1, 55, 85, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'reviews.php', 1, 0, 40, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'search.php', 1, 1, 10, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'search_header.php', 0, 0, 0, 0, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'shopping_cart.php', 1, 1, 20, 30, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'specials.php', 1, 1, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'whats_new.php', 1, 0, 20, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'whos_online.php', 1, 1, 200, 200, 1);

INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'banner_box.php', 1, 0, 300, 1, 127);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'banner_box2.php', 1, 1, 15, 1, 15);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'banner_box_all.php', 1, 1, 5, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'best_sellers.php', 1, 1, 30, 70, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'categories.php', 1, 0, 10, 10, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'currencies.php', 0, 1, 80, 60, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'document_categories.php', 1, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'ezpages.php', 1, 1, -1, 2, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'featured.php', 1, 0, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'information.php', 1, 0, 50, 40, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'languages.php', 0, 1, 70, 50, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'manufacturers.php', 1, 0, 30, 20, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'manufacturer_info.php', 1, 1, 35, 95, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'more_information.php', 1, 0, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'music_genres.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'order_history.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'product_notifications.php', 1, 1, 55, 85, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'record_companies.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'reviews.php', 1, 0, 40, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'search.php', 1, 1, 10, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'search_header.php', 0, 0, 0, 0, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'shopping_cart.php', 1, 1, 20, 30, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'specials.php', 1, 1, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'whats_new.php', 1, 0, 20, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'whos_online.php', 1, 1, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'banner_box.php', 1, 0, 300, 1, 127);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'banner_box2.php', 1, 1, 15, 1, 15);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'banner_box_all.php', 1, 1, 5, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'best_sellers.php', 1, 1, 30, 70, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'categories.php', 1, 0, 10, 10, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'currencies.php', 0, 1, 80, 60, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'document_categories.php', 1, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'ezpages.php', 1, 1, -1, 2, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'featured.php', 1, 0, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'information.php', 1, 0, 50, 40, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'languages.php', 0, 1, 70, 50, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'manufacturers.php', 1, 0, 30, 20, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'manufacturer_info.php', 1, 1, 35, 95, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'more_information.php', 1, 0, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'music_genres.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'order_history.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'product_notifications.php', 1, 1, 55, 85, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'record_companies.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'reviews.php', 1, 0, 40, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'search.php', 1, 1, 10, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'search_header.php', 0, 0, 0, 0, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'shopping_cart.php', 1, 1, 20, 30, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'specials.php', 1, 1, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'whats_new.php', 1, 0, 20, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('responsive_classic', 'whos_online.php', 1, 1, 200, 200, 1);

INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES ( '1', '1', 'Pending', 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES ( '2', '1', 'Processing', 10);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES ( '3', '1', 'Delivered', 20);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES ( '4', '1', 'Update', 30);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES ( '5', '1', 'Cancelled', 40);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES ( '6', '1', 'Test Order', 50);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES ( '7', '1', 'Resend Invoice', 60);

INSERT INTO product_types VALUES (1, 'Product - General', 'product', '1', 'Y', '', now(), now());
INSERT INTO product_types VALUES (2, 'Product - Music', 'product_music', '1', 'Y', '', now(), now());
INSERT INTO product_types VALUES (3, 'Document - General', 'document_general', '3', 'N', '', now(), now());
INSERT INTO product_types VALUES (4, 'Document - Product', 'document_product', '3', 'Y', '', now(), now());
INSERT INTO product_types VALUES (5, 'Product - Free Shipping', 'product_free_shipping', '1', 'Y', '', now(), now());

INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (0, 'Dropdown');
INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (1, 'Text');
INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (2, 'Radio');
INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (3, 'Checkbox');
INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (4, 'File');
INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (5, 'Read Only');

INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (0, 1, 'TEXT');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (0, 43, 'TEXT');

# Steuerkonfiguration EU/Export mit eigener Zone fuer jedes EU Land - seit 1.5.6f
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (3, 'Österreich', 'Österreich', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (4, 'Export', 'Staaten ausserhalb der EU', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (5, 'Belgien', 'Belgien', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (6, 'Bulgarien', 'Bulgarien', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (7, 'Dänemark', 'Dänemark', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (8, 'Deutschland', 'Deutschland', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (9, 'Estland', 'Estland', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (10, 'Finnland', 'Finnland', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (11, 'Frankreich', 'Frankreich', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (12, 'Griechenland', 'Griechenland', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (13, 'Spanien', 'Spanien', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (14, 'Kroatien', 'Kroatien', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (15, 'Ungarn', 'Ungarn', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (16, 'Irland', 'Irland', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (17, 'Italien', 'Italien', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (18, 'Litauen', 'Litauen', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (19, 'Luxembourg', 'Luxembourg', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (20, 'Lettland', 'Lettland', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (21, 'Malta', 'Malta', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (22, 'Niederlande', 'Niederlande', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (23, 'Polen', 'Polen', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (24, 'Portugal', 'Portugal', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (25, 'Rumänien', 'Rumänien', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (26, 'Schweden', 'Schweden', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (27, 'Slowenien', 'Slowenien', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (28, 'Slowakei', 'Slowakei', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (29, 'Zypern', 'Zypern', now(), now());
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (30, 'Tschechien', 'Tschechien', now(), now());

INSERT INTO tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) VALUES (1, 'reduzierter Steuersatz', 'reduzierter Steuersatz', NULL, '2020-07-09 19:46:30');
INSERT INTO tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) VALUES (2, 'Normalsteuersatz', 'Normalsteuersatz', NULL, '2020-07-09 19:46:30');
INSERT INTO tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) VALUES (3, 'Export', 'Export', NULL, '2020-07-09 19:46:30');
# Steuersaetze separat fuer jedes EU-Land - vorbefuellt mit AT Steuersatz - seit 1.5.6f
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (5, 3, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (6, 3, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (7, 4, 3, 30, '0.0000', '0%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (8, 5, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (9, 5, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (10, 6, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (11, 6, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (12, 29, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (13, 29, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (14, 30, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (15, 30, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (16, 8, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (17, 8, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (18, 7, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (19, 7, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (20, 9, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (21, 9, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (22, 12, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (23, 12, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (24, 13, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (25, 13, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (26, 10, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (27, 10, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (28, 11, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (29, 11, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (30, 14, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (31, 14, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (32, 15, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (33, 15, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (34, 16, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (35, 16, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (36, 17, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (37, 17, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (38, 18, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (39, 18, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (40, 19, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (41, 19, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (42, 20, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (43, 20, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (44, 21, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (45, 21, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (46, 22, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (47, 22, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (48, 23, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (49, 23, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (50, 24, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (51, 24, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (52, 25, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (53, 25, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (54, 26, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (55, 26, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (56, 27, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (57, 27, 1, 20, '10.0000', '10%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (58, 28, 2, 10, '20.0000', '20%', now(), now());
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (59, 28, 1, 20, '10.0000', '10%', now(), now());
# Neue Konfiguration seit 1.5.6f
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (252, 33, 0, 6, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (253, 57, 0, 7, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (254, 81, 0, 8, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (255, 67, 0, 9, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (256, 72, 0, 10, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (257, 73, 0, 11, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (249, 222, 0, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (17, 14, NULL, 3, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (275, 55, 0, 29, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (276, 56, 0, 30, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (29, 1, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (30, 2, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (31, 3, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (32, 4, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (33, 5, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (34, 6, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (35, 7, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (36, 8, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (37, 9, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (38, 10, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (39, 11, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (40, 12, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (41, 13, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (42, 15, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (43, 16, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (44, 17, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (45, 18, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (46, 19, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (47, 20, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (48, 22, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (49, 23, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (50, 24, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (51, 25, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (52, 26, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (53, 27, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (54, 28, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (55, 29, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (56, 30, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (57, 31, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (58, 32, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (59, 34, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (60, 35, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (61, 36, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (62, 37, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (63, 38, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (64, 39, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (65, 40, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (66, 41, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (67, 42, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (68, 43, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (69, 44, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (70, 45, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (71, 46, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (72, 47, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (73, 48, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (74, 49, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (75, 50, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (76, 51, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (77, 52, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (78, 54, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (79, 58, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (80, 59, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (81, 60, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (82, 61, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (83, 62, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (84, 63, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (85, 64, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (86, 65, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (87, 66, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (88, 68, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (89, 69, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (90, 70, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (91, 71, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (92, 74, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (93, 75, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (94, 76, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (95, 77, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (96, 78, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (97, 79, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (98, 80, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (99, 82, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (100, 83, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (101, 85, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (102, 86, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (103, 87, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (104, 88, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (105, 89, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (106, 90, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (107, 91, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (108, 92, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (109, 93, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (110, 94, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (111, 95, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (112, 96, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (113, 98, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (114, 99, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (115, 100, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (116, 101, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (117, 102, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (118, 104, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (119, 106, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (120, 107, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (121, 108, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (122, 109, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (123, 110, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (124, 111, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (125, 112, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (126, 113, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (127, 114, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (128, 115, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (129, 116, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (130, 118, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (131, 119, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (132, 120, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (133, 121, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (134, 122, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (135, 125, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (136, 126, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (137, 127, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (138, 128, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (139, 129, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (140, 130, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (141, 131, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (142, 133, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (143, 134, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (144, 135, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (145, 136, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (146, 137, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (147, 138, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (148, 139, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (149, 140, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (150, 141, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (151, 142, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (152, 143, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (153, 144, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (154, 145, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (155, 146, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (156, 147, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (157, 148, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (158, 149, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (159, 151, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (160, 152, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (161, 153, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (162, 154, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (163, 155, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (164, 156, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (165, 157, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (166, 158, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (167, 159, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (168, 160, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (169, 161, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (170, 162, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (171, 163, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (172, 164, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (173, 165, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (174, 166, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (175, 167, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (176, 168, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (177, 169, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (178, 172, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (179, 173, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (180, 174, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (181, 176, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (182, 177, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (183, 178, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (184, 179, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (185, 180, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (186, 181, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (187, 182, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (188, 183, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (189, 184, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (190, 185, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (191, 186, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (192, 187, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (193, 188, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (194, 191, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (195, 192, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (196, 193, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (197, 194, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (198, 196, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (199, 197, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (200, 198, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (201, 199, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (202, 200, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (203, 201, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (204, 202, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (205, 204, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (206, 205, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (207, 206, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (208, 207, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (209, 208, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (210, 209, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (211, 210, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (212, 211, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (213, 212, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (214, 213, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (215, 214, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (216, 215, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (217, 216, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (218, 217, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (219, 218, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (220, 219, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (221, 220, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (222, 221, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (223, 223, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (224, 224, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (225, 225, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (226, 226, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (227, 227, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (228, 228, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (229, 229, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (230, 230, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (231, 231, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (232, 232, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (233, 233, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (234, 234, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (235, 235, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (236, 236, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (237, 237, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (238, 238, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (239, 239, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (240, 240, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (241, 241, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (242, 242, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (243, 243, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (244, 244, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (245, 245, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (246, 246, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (247, 247, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (248, 248, NULL, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (250, 222, 0, 4, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (251, 21, 0, 5, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (258, 84, 0, 12, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (259, 195, 0, 13, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (260, 53, 0, 14, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (261, 97, 0, 15, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (262, 103, 0, 16, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (263, 105, 0, 17, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (264, 123, 0, 18, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (265, 124, 0, 19, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (266, 117, 0, 20, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (267, 132, 0, 21, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (268, 150, 0, 22, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (269, 170, 0, 23, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (270, 171, 0, 24, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (271, 175, 0, 25, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (272, 203, 0, 26, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (273, 190, 0, 27, now(), now());
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (274, 189, 0, 28, now(), now());


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Model Number', 'SHOW_PRODUCT_INFO_MODEL', '1', 'Display Model Number on Product Info 0= off 1= on', '1', '1', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Weight', 'SHOW_PRODUCT_INFO_WEIGHT', '1', 'Display Weight on Product Info 0= off 1= on', '1', '2', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Attribute Weight', 'SHOW_PRODUCT_INFO_WEIGHT_ATTRIBUTES', '1', 'Display Attribute Weight on Product Info 0= off 1= on', '1', '3', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Manufacturer', 'SHOW_PRODUCT_INFO_MANUFACTURER', '1', 'Display Manufacturer Name on Product Info 0= off 1= on', '1', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Shopping Cart', 'SHOW_PRODUCT_INFO_IN_CART_QTY', '1', 'Display Quantity in Current Shopping Cart on Product Info 0= off 1= on', '1', '5', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Stock', 'SHOW_PRODUCT_INFO_QUANTITY', '1', 'Display Quantity in Stock on Product Info 0= off 1= on', '1', '6', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_PRODUCT_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '1', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_PRODUCT_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '1', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_PRODUCT_INFO_DATE_AVAILABLE', '1', 'Display Date Available on Product Info 0= off 1= on', '1', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_PRODUCT_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '1', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product URL', 'SHOW_PRODUCT_INFO_URL', '1', 'Display URL on Product Info 0= off 1= on', '1', '11', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_PRODUCT_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '1', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Starting At text on Price', 'SHOW_PRODUCT_INFO_STARTING_AT', '1', 'Display Starting At text on products with attributes Product Info 0= off 1= on', '1', '12', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Image Status - Catalog', 'SHOW_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', '0', 'Show the Free Shipping image/text in the catalog?', '1', '16', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
#admin defaults
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, use_function, set_function, date_added) VALUES ('Product Price Tax Class Default - When adding new products?', 'DEFAULT_PRODUCT_TAX_CLASS_ID', '0', 'What should the Product Price Tax Class Default ID be when adding new products?', '1', '100', '', '', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address - When adding new products?', 'DEFAULT_PRODUCT_PRODUCTS_VIRTUAL', '0', 'Default Virtual Product status to be ON when adding new products?', '1', '101', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?', 'DEFAULT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '0', 'What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping', '1', '102', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ', now());


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Model Number', 'SHOW_PRODUCT_MUSIC_INFO_MODEL', '1', 'Display Model Number on Product Info 0= off 1= on', '2', '1', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Weight', 'SHOW_PRODUCT_MUSIC_INFO_WEIGHT', '0', 'Display Weight on Product Info 0= off 1= on', '2', '2', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Attribute Weight', 'SHOW_PRODUCT_MUSIC_INFO_WEIGHT_ATTRIBUTES', '1', 'Display Attribute Weight on Product Info 0= off 1= on', '2', '3', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Artist', 'SHOW_PRODUCT_MUSIC_INFO_ARTIST', '1', 'Display Artists Name on Product Info 0= off 1= on', '2', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Music Genre', 'SHOW_PRODUCT_MUSIC_INFO_GENRE', '1', 'Display Music Genre on Product Info 0= off 1= on', '2', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Record Company', 'SHOW_PRODUCT_MUSIC_INFO_RECORD_COMPANY', '1', 'Display Record Company on Product Info 0= off 1= on', '2', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Shopping Cart', 'SHOW_PRODUCT_MUSIC_INFO_IN_CART_QTY', '1', 'Display Quantity in Current Shopping Cart on Product Info 0= off 1= on', '2', '5', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Stock', 'SHOW_PRODUCT_MUSIC_INFO_QUANTITY', '0', 'Display Quantity in Stock on Product Info 0= off 1= on', '2', '6', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_PRODUCT_MUSIC_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '2', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_PRODUCT_MUSIC_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '2', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_PRODUCT_MUSIC_INFO_DATE_AVAILABLE', '1', 'Display Date Available on Product Info 0= off 1= on', '2', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_PRODUCT_MUSIC_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '2', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Starting At text on Price', 'SHOW_PRODUCT_MUSIC_INFO_STARTING_AT', '1', 'Display Starting At text on products with attributes Product Info 0= off 1= on', '2', '12', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_PRODUCT_MUSIC_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '2', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Image Status - Catalog', 'SHOW_PRODUCT_MUSIC_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', '0', 'Show the Free Shipping image/text in the catalog?', '2', '16', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
#admin defaults
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, use_function, set_function, date_added) VALUES ('Product Price Tax Class Default - When adding new products?', 'DEFAULT_PRODUCT_MUSIC_TAX_CLASS_ID', '0', 'What should the Product Price Tax Class Default ID be when adding new products?', '2', '100', '', '', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address - When adding new products?', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_VIRTUAL', '0', 'Default Virtual Product status to be ON when adding new products?', '2', '101', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '0', 'What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping', '2', '102', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ', now());


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_DOCUMENT_GENERAL_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '3', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_DOCUMENT_GENERAL_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '3', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_DOCUMENT_GENERAL_INFO_DATE_AVAILABLE', '1', 'Display Date Available on Product Info 0= off 1= on', '3', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_DOCUMENT_GENERAL_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '3', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product URL', 'SHOW_DOCUMENT_GENERAL_INFO_URL', '1', 'Display URL on Product Info 0= off 1= on', '3', '11', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_DOCUMENT_GENERAL_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '3', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

#admin defaults


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Model Number', 'SHOW_DOCUMENT_PRODUCT_INFO_MODEL', '1', 'Display Model Number on Product Info 0= off 1= on', '4', '1', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Weight', 'SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT', '0', 'Display Weight on Product Info 0= off 1= on', '4', '2', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Attribute Weight', 'SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT_ATTRIBUTES', '1', 'Display Attribute Weight on Product Info 0= off 1= on', '4', '3', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Manufacturer', 'SHOW_DOCUMENT_PRODUCT_INFO_MANUFACTURER', '1', 'Display Manufacturer Name on Product Info 0= off 1= on', '4', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Shopping Cart', 'SHOW_DOCUMENT_PRODUCT_INFO_IN_CART_QTY', '1', 'Display Quantity in Current Shopping Cart on Product Info 0= off 1= on', '4', '5', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Stock', 'SHOW_DOCUMENT_PRODUCT_INFO_QUANTITY', '0', 'Display Quantity in Stock on Product Info 0= off 1= on', '4', '6', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '4', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '4', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_DOCUMENT_PRODUCT_INFO_DATE_AVAILABLE', '1', 'Display Date Available on Product Info 0= off 1= on', '4', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_DOCUMENT_PRODUCT_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '4', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product URL', 'SHOW_DOCUMENT_PRODUCT_INFO_URL', '1', 'Display URL on Product Info 0= off 1= on', '4', '11', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_DOCUMENT_PRODUCT_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '4', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Starting At text on Price', 'SHOW_DOCUMENT_PRODUCT_INFO_STARTING_AT', '1', 'Display Starting At text on products with attributes Product Info 0= off 1= on', '4', '12', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Image Status - Catalog', 'SHOW_DOCUMENT_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', '0', 'Show the Free Shipping image/text in the catalog?', '4', '16', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
#admin defaults
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, use_function, set_function, date_added) VALUES ('Product Price Tax Class Default - When adding new products?', 'DEFAULT_DOCUMENT_PRODUCT_TAX_CLASS_ID', '0', 'What should the Product Price Tax Class Default ID be when adding new products?', '4', '100', '', '', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address - When adding new products?', 'DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_VIRTUAL', '0', 'Default Virtual Product status to be ON when adding new products?', '4', '101', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?', 'DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '0', 'What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping', '4', '102', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ', now());


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Model Number', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_MODEL', '1', 'Display Model Number on Product Info 0= off 1= on', '5', '1', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Weight', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT', '0', 'Display Weight on Product Info 0= off 1= on', '5', '2', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Attribute Weight', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT_ATTRIBUTES', '1', 'Display Attribute Weight on Product Info 0= off 1= on', '5', '3', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Manufacturer', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_MANUFACTURER', '1', 'Display Manufacturer Name on Product Info 0= off 1= on', '5', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Shopping Cart', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_IN_CART_QTY', '1', 'Display Quantity in Current Shopping Cart on Product Info 0= off 1= on', '5', '5', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Stock', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_QUANTITY', '1', 'Display Quantity in Stock on Product Info 0= off 1= on', '5', '6', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '5', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '5', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_AVAILABLE', '0', 'Display Date Available on Product Info 0= off 1= on', '5', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '5', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product URL', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_URL', '1', 'Display URL on Product Info 0= off 1= on', '5', '11', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '5', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Starting At text on Price', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_STARTING_AT', '1', 'Display Starting At text on products with attributes Product Info 0= off 1= on', '5', '12', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Image Status - Catalog', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', '1', 'Show the Free Shipping image/text in the catalog?', '5', '16', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
#admin defaults
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, use_function, set_function, date_added) VALUES ('Product Price Tax Class Default - When adding new products?', 'DEFAULT_PRODUCT_FREE_SHIPPING_TAX_CLASS_ID', '0', 'What should the Product Price Tax Class Default ID be when adding new products?', '5', '100', '', '', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address - When adding new products?', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_VIRTUAL', '0', 'Default Virtual Product status to be ON when adding new products?', '5', '101', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '1', 'What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping', '5', '102', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ', now());

#insert product type layout settings for meta-tags
#Product
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Product Name', 'SHOW_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.', '1', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Title Additional Text', 'SHOW_PRODUCT_INFO_METATAGS_TITLE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Title Additional text in the page &lt;title&gt; tag.', '1', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Product Model', 'SHOW_PRODUCT_INFO_METATAGS_MODEL_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Model in the page &lt;title&gt; tag.', '1', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Product Price', 'SHOW_PRODUCT_INFO_METATAGS_PRICE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Price in the page &lt;title&gt; tag.', '1', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use SITE_TAGLINE', 'SHOW_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the defined constant "SITE_TAGLINE" in the page &lt;title&gt; tag.', '1', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
#Product Music
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Product Name', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.', '2', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Title Additional Text', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.', '2', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Product Model', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_MODEL_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.', '2', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Product Price', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRICE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.', '2', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use SITE_TAGLINE', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.', '2', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
#Document General
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Document page &lt;title&gt; tag - default: use Document Title', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Document  Title in the page &lt;title&gt; tag.', '3', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Document page &lt;title&gt; tag - default: use Document Name', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Document  Name in the page &lt;title&gt; tag.', '3', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Document Tagline', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Document  Tagline in the page &lt;title&gt; tag.', '3', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
#Document Product
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Document Title', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Document  Title in the page &lt;title&gt; tag.', '4', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Document Name', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Document  Name in the page &lt;title&gt; tag.', '4', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Document Model', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_MODEL_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Document  Model in the page &lt;title&gt; tag.', '4', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Document Price', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRICE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Document  Price in the page &lt;title&gt; tag.', '4', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Document Tagline', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Document  Tagline in the page &lt;title&gt; tag.', '4', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
#Product Free Shipping
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Product Name', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.', '5', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Title Additional Text', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Title Additional text in the page &lt;title&gt; tag.', '5', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Product Model', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_MODEL_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Model in the page &lt;title&gt; tag.', '5', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use Product Price', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRICE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the Product Price in the page &lt;title&gt; tag.', '5', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product page &lt;title&gt; tag - default: use SITE_TAGLINE', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Default setting for a new product (can be modified per product).<br>Show the defined constant "SITE_TAGLINE" in the page &lt;title&gt; tag.', '5', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
### eof: meta tags database updates and changes

#insert product type layout settings
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Display Only - Default', 'DEFAULT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY', '0', 'PRODUCT Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes', '1', '200', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Free - Default', 'DEFAULT_PRODUCT_ATTRIBUTE_IS_FREE', '1', 'PRODUCT Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes', '1', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Default - Default', 'DEFAULT_PRODUCT_ATTRIBUTES_DEFAULT', '0', 'PRODUCT Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes', '1', '202', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Discounted - Default', 'DEFAULT_PRODUCT_ATTRIBUTES_DISCOUNTED', '1', 'PRODUCT Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes', '1', '203', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Included in Base Price - Default', 'DEFAULT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED', '1', 'PRODUCT Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes', '1', '204', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Required - Default', 'DEFAULT_PRODUCT_ATTRIBUTES_REQUIRED', '0', 'PRODUCT Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes', '1', '205', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute Price Prefix - Default', 'DEFAULT_PRODUCT_PRICE_PREFIX', '1', 'PRODUCT Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -', '1', '206', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute Weight Prefix - Default', 'DEFAULT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', '1', 'PRODUCT Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -', '1', '207', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Display Only - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISPLAY_ONLY', '0', 'MUSIC Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes', '2', '200', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Free - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTE_IS_FREE', '1', 'MUSIC Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes', '2', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Default - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DEFAULT', '0', 'MUSIC Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes', '2', '202', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Discounted - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISCOUNTED', '1', 'MUSIC Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes', '2', '203', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Included in Base Price - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_PRICE_BASE_INCLUDED', '1', 'MUSIC Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes', '2', '204', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Required - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_REQUIRED', '0', 'MUSIC Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes', '2', '205', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute Price Prefix - Default', 'DEFAULT_PRODUCT_MUSIC_PRICE_PREFIX', '1', 'MUSIC Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -', '2', '206', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute Weight Prefix - Default', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', '1', 'MUSIC Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -', '2', '207', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Display Only - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISPLAY_ONLY', '0', 'DOCUMENT GENERAL Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes', '3', '200', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Free - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTE_IS_FREE', '1', 'DOCUMENT GENERAL Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes', '3', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Default - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DEFAULT', '0', 'DOCUMENT GENERAL Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes', '3', '202', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Discounted - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISCOUNTED', '1', 'DOCUMENT GENERAL Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes', '3', '203', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Included in Base Price - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_PRICE_BASE_INCLUDED', '1', 'DOCUMENT GENERAL Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes', '3', '204', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Required - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_REQUIRED', '0', 'DOCUMENT GENERAL Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes', '3', '205', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute Price Prefix - Default', 'DEFAULT_DOCUMENT_GENERAL_PRICE_PREFIX', '1', 'DOCUMENT GENERAL Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -', '3', '206', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute Weight Prefix - Default', 'DEFAULT_DOCUMENT_GENERAL_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', '1', 'DOCUMENT GENERAL Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -', '3', '207', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Display Only - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY', '0', 'DOCUMENT PRODUCT Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes', '4', '200', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Free - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTE_IS_FREE', '1', 'DOCUMENT PRODUCT Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes', '4', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Default - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DEFAULT', '0', 'DOCUMENT PRODUCT Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes', '4', '202', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Discounted - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISCOUNTED', '1', 'DOCUMENT PRODUCT Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes', '4', '203', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Included in Base Price - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED', '1', 'DOCUMENT PRODUCT Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes', '4', '204', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Required - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_REQUIRED', '0', 'DOCUMENT PRODUCT Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes', '4', '205', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute Price Prefix - Default', 'DEFAULT_DOCUMENT_PRODUCT_PRICE_PREFIX', '1', 'DOCUMENT PRODUCT Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -', '4', '206', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute Weight Prefix - Default', 'DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', '1', 'DOCUMENT PRODUCT Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -', '4', '207', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Display Only - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISPLAY_ONLY', '0', 'PRODUCT FREE SHIPPING Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes', '5', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Free - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTE_IS_FREE', '1', 'PRODUCT FREE SHIPPING Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes', '5', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Default - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DEFAULT', '0', 'PRODUCT FREE SHIPPING Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes', '5', '202', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Discounted - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISCOUNTED', '1', 'PRODUCT FREE SHIPPING Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes', '5', '203', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Included in Base Price - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_PRICE_BASE_INCLUDED', '1', 'PRODUCT FREE SHIPPING Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes', '5', '204', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Required - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_REQUIRED', '0', 'PRODUCT FREE SHIPPING Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes', '5', '205', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute Price Prefix - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRICE_PREFIX', '1', 'PRODUCT FREE SHIPPING Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -', '5', '206', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute Weight Prefix - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', '1', 'PRODUCT FREE SHIPPING Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -', '5', '207', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
### eof: attribute default database updates and changes

### bof: Add control to enable/disable the display of the 'Ask a Question' block for each product type - new since 1.5.7
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show \"Ask a Question\" button?', 'SHOW_PRODUCT_INFO_ASK_A_QUESTION', '1', 'Display the \"Ask a Question\" button on product Info pages? (0 = False, 1 = True)', 1, 14, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show \"Ask a Question\" button?', 'SHOW_PRODUCT_MUSIC_INFO_ASK_A_QUESTION', '1', 'Display the \"Ask a Question\" button on product Info pages? (0 = False, 1 = True)', 2, 14, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show \"Ask a Question\" button?', 'SHOW_DOCUMENT_GENERAL_INFO_ASK_A_QUESTION', '1', 'Display the \"Ask a Question\" button on product Info pages? (0 = False, 1 = True)', 3, 14, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show \"Ask a Question\" button?', 'SHOW_DOCUMENT_PRODUCT_INFO_ASK_A_QUESTION', '1', 'Display the \"Ask a Question\" button on product Info pages? (0 = False, 1 = True)', 4, 14, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show \"Ask a Question\" button?', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ASK_A_QUESTION', '1', 'Display the \"Ask a Question\" button on product Info pages? (0 = False, 1 = True)', 5, 14, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
### eof: Add control to enable/disable the display of the 'Ask a Question' block for each product type

## Insert the default queries for "all customers" and "all newsletter subscribers"
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string , query_keys_list ) VALUES ( '1', 'email', 'All Customers', 'Returns all customers name and email address for sending mass emails (ie: for newsletters, coupons, GVs, messages, etc).', 'select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS order by customers_lastname, customers_firstname, customers_email_address', '');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string , query_keys_list ) VALUES ( '2', 'email,newsletters', 'All Newsletter Subscribers', 'Returns name and email address of newsletter subscribers', 'select customers_firstname, customers_lastname, customers_email_address from TABLE_CUSTOMERS where customers_newsletter = \'1\'', '');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string , query_keys_list ) VALUES ( '3', 'email,newsletters', 'Customers Dormant for 3+ months (Subscribers)', 'Subscribers who HAVE purchased something, but have NOT purchased for at least three months.', 'select max(o.date_purchased) as date_purchased, c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o WHERE c.customers_id = o.customers_id AND c.customers_newsletter = 1 GROUP BY c.customers_email_address, c.customers_lastname, c.customers_firstname HAVING max(o.date_purchased) <= subdate(now(),INTERVAL 3 MONTH) ORDER BY c.customers_lastname, c.customers_firstname ASC', '');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string , query_keys_list ) VALUES ( '4', 'email,newsletters', 'Active customers in past 3 months (Subscribers)', 'Newsletter subscribers who are also active customers (purchased something) in last 3 months.', 'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address, c.customers_lastname, c.customers_firstname order by c.customers_lastname, c.customers_firstname ASC', '');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string , query_keys_list ) VALUES ( '5', 'email,newsletters', 'Active customers in past 3 months (Regardless of subscription status)', 'All active customers (purchased something) in last 3 months, ignoring newsletter-subscription status.', 'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o WHERE c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address, c.customers_lastname, c.customers_firstname order by c.customers_lastname, c.customers_firstname ASC', '');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string , query_keys_list ) VALUES ( '6', 'email,newsletters', 'Administrator', 'Just the email account of the current administrator', 'select \'ADMIN\' as customers_firstname, admin_name as customers_lastname, admin_email as customers_email_address from TABLE_ADMIN where admin_id = $SESSION:admin_id', '');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string , query_keys_list ) VALUES ( '7', 'email,newsletters', 'Customers who have never completed a purchase', 'For sending newsletter to all customers who registered but have never completed a purchase', 'SELECT DISTINCT c.customers_email_address as customers_email_address, c.customers_lastname as customers_lastname, c.customers_firstname as customers_firstname FROM TABLE_CUSTOMERS c LEFT JOIN  TABLE_ORDERS o ON c.customers_id=o.customers_id WHERE o.date_purchased IS NULL', '');

#
# end of Query-Builder Setup
#

#
# Dumping data for table get_terms_to_filter
#

INSERT INTO get_terms_to_filter VALUES ('manufacturers_id', 'TABLE_MANUFACTURERS', 'manufacturers_name');
INSERT INTO get_terms_to_filter VALUES ('music_genre_id', 'TABLE_MUSIC_GENRE', 'music_genre_name');
INSERT INTO get_terms_to_filter VALUES ('record_company_id', 'TABLE_RECORD_COMPANY', 'record_company_name');


#
# Dumping data for table project_version
#

INSERT INTO project_version (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch1, project_version_patch1_source, project_version_patch2, project_version_patch2_source, project_version_comment, project_version_date_applied) VALUES (1, 'Zen-Cart Main', '1', '5.7g', '', '', '', '', 'New Installation-v157g', now());
INSERT INTO project_version (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch1, project_version_patch1_source, project_version_patch2, project_version_patch2_source, project_version_comment, project_version_date_applied) VALUES (2, 'Zen-Cart Database', '1', '5.7g', '', '', '', '', 'New Installation-v157g', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (1, 'Zen-Cart Main', '1', '5.7g', '', 'New Installation-v157g', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (2, 'Zen-Cart Database', '1', '5.7g', '', 'New Installation-v157g', now());

#
# German Version Special Definitions
#

INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES (1, 43, 'warten auf Zahlung', 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES (2, 43, 'Zahlung erhalten - in Arbeit', 10);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES (3, 43, 'Verschickt', 20);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES (4, 43, 'Information', 30);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES (5, 43, 'Storniert', 40);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES (6, 43, 'Testbestellung', 50);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, sort_order) VALUES (7, 43, 'Rechnung versenden', 60);
    
        
REPLACE INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES 
(1, 43, 'Mein Shop', 'Generelle Informationen über den Shop', 1, 1),
(2, 43, 'Minimale Werte', 'Die minimale Zeichenlänge für Funktionen / Daten', 2, 1),
(3, 43, 'Maximale Werte', 'Die maximale Zeichenlänge für Funktionen / Daten', 3, 1),
(4, 43, 'Bilder', 'Einstellungen der Bildparameter', 4, 1),
(5, 43, 'Kundendetails', 'Konfiguration der Kundenkonten', 5, 1),
(6, 43, 'Moduloptionen', 'Vom Konfigurationsmenü versteckt', 6, 0),
(7, 43, 'Versandoptionen', 'Im Shop verfügbare Versandoptionen', 7, 1),
(8, 43, 'Artikelliste', 'Konfiguration der Artikelliste', 8, 1),
(9, 43, 'Lagerverwaltung und Warenkorb', 'Konfigurationen der Lagerverwaltung', 9, 1),
(10, 43, 'Protokollierung', 'Konfiguration der Protokollierung', 10, 1),
(11, 43, 'AGB und Datenschutz', 'Konfiguration für die AGB', 16, 1),
(12, 43, 'E-Mail Optionen', 'Generelle Einstellungen für den E-Mail Transport (SMTP) und die HTML Optionen', 12, 1),
(13, 43, 'Attributeinstellungen', 'Konfiguration für die Einstellungen der Artikeloptionen', 13, 1),
(14, 43, 'GZip Komprimierung', 'Konfiguration der GZip Komprimierung', 14, 1),
(15, 43, 'Sitzungen/Sessions', 'Konfiguration der Sitzungsoptionen', 15, 1),
(16, 43, 'Gutscheine & Aktionskupons', 'Konfiguration der Gutsycheine und Aktionskupons', 16, 1),
(17, 43, 'Kreditkarten', 'Konfiguration der zu verwendeten Kreditkarten', 17, 1),
(18, 43, 'Artikeldetails', 'Konfiguration für die Anzeige von Artikeldetails', 18, 1),
(19, 43, 'Layouteinstellungen', 'Layouteinstellungen', 19, 1),
(20, 43, 'Shopwartung', 'Konfiguration der Shopwartung', 20, 1),
(21, 43, 'Liste - Neue Artikel', 'Listenansicht für neue Artikel', 21, 1),
(22, 43, 'Liste - Empfohlene Artikel', 'Listenansicht für Empfohlene Artikel', 22, 1),
(23, 43, 'Liste - Alle Artikel', 'Listenansicht für alle Artikel', 23, 1),
(24, 43, 'Liste - Artikelindex', 'Listenansicht für Artikelindex', 24, 1),
(25, 43, 'Eigene Seiten', 'Eigene Seiten, die über den im Seiteneditor eingegebenen Texte festgelegt werden', 25, 1),
(30, 43, 'EZ-Pages Einstellungen', 'EZ-Pages Einstellungen', 30, 1),
(31, 43, 'Minify Einstellungen', 'Minify Einstellungen', 31, 1),
(32, 43, 'Spamschutz Einstellungen', 'Spamschutz Einstellungen', 32, 1),
(33, 43, 'Open Graph/Microdata', 'Open Graph/Microdata Einstellungen', 33, 1),
(34, 43, 'RSS Feed', 'RSS Feed Einstellungen', 34, 1),
(35, 43, 'Zen Colorbox', 'Zen Colorbox Einstellungen', 35, 1),
(36, 43, 'IT Recht Kanzlei', 'Einstellungen für das IT Recht Kanzlei Modul', 36, 1),
(37, 43, 'pdf Rechnung', 'Einstellungen für das pdf Rechnung Modul', 37, 1),
(38, 43, 'Shopvote', 'Einstellungen für das Shopvote Modul', 38, 1),
(39, 43, 'Cross Sell Advanced', 'Einstellungen für Cross Sells', 39, 1);


INSERT INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES

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
('Steuern auch bei 0% anzeigen?', 'STORE_TAX_DISPLAY_STATUS', 43, 'Steuer auch dann anzeigen, wenn diese 0% betragen?<br>0= NEIN<br>1= JA ', now(), now()),
('Gesplittete Steueranzeige', 'SHOW_SPLIT_TAX_CHECKOUT', 43, 'Wenn Artikel mit verschiedenen Steuersätzen bestellt werden, soll dann im Bestellvorgang jeder Steuersatz in einer eigenen Zeile ausgewiesen werden?', now(), now()),
('Timeout der Admin-Sitzungen (in Sekunden)', 'SESSION_TIMEOUT_ADMIN', 43, 'Geben Sie die Zeit in Sekunden an. Standard=900<br /> Beispiel: 900= 15 Minuten<br /><b>WICHTIGER HINWEIS: Wenn Sie diesen Wert auf über 900 erHöhen, dann erfüllt Ihr Shop die Richtlinien der PA-DSS Zertifizierung nicht mehr!</b><br><br>Eine zu geringe Zeitangabe kann zu Problemen bei der Bearbeitung von Artikeln führen.', now(), now()),
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
('EU Länder', 'EU_COUNTRIES_FOR_LAST_STEP', 43, 'Tragen Sie hier die Mitgliedsstaaten der Europäischen Union ein. Wenn an Länder geliefert wird, die nicht in dieser Liste stehen, dann erscheint im letzten Schritt des Bestellvorgangs ein Hinweis auf mögliche ZollGebühren. Zweistellige ISO Codes mit Komma getrennt.<br><br>Falls Sie Ihren Shop in der Schweiz betreiben, dann tragen Sie hier nur CH ein, so dass der Hinweis dann bei Lieferungen ausserhalb der Schweiz angezeigt wird!', now(), now()),
('Admin Timeout gemäss PA-DSS Zertifizierung?', 'PADSS_ADMIN_SESSION_TIMEOUT_ENFORCED', 43, 'Der Shop erfüllt nur dann die Richtlinien einer PA-DSS Zertifizierung, wenn die Adminsitzung nach 15 Minuten Inaktivität beendet wird. Nach 15 Minuten Inaktivität werden Sie aus der Administration ausgeloggt. Wenn Sie das nicht wollen, dann deaktivieren Sie hier diese Einstellung.<br><b>Achtung: Durch das Deaktivieren dieser Einstellung erfüllt Ihr Shop die PA-DSS Richtlinien nicht mehr und ist daher für eine Zertifizierung ungeeignet!</b>', now(), now()),
('Admin Passwortregeln gemäss PA-DSS Zertifizierung?', 'PADSS_PWD_EXPIRY_ENFORCED', 43, 'Der Shop erfüllt nur dann die Richtlinien einer PA-DSS Zertifizierung, wenn die AdminpassWörter alle 90 Tage geändert werden und dabei nicht die 4 letzten PassWörter wiederverwendet werden dürfen. Wenn Sie das nicht wollen, dann deaktivieren Sie hier diese Einstellung.<br><b>Achtung: Durch das Deaktivieren dieser Einstellung erfüllt Ihr Shop die PA-DSS Richtlinien nicht mehr und ist daher für eine Zertifizierung ungeeignet!</b>', now(), now()),
('Verlinkte Kategorien im Adminbereich anzeigen', 'SHOW_CATEGORY_PRODUCTS_LINKED_STATUS', 43, 'Soll im Adminbereich angezeigt werden, wenn Artikel auch in anderen Kategorien verlinkt sind (gelbes Symbol neben dem Artikel)?', now(), now()),
('PA-DSS Ajax Checkout?', 'PADSS_AJAX_CHECKOUT', 43, 'PA-DSS Compliance erfordert, dass für manche integrierte Zahlungsmodule Ajax zum Laden der Bestellbestätigungsseite verwendet wird. Das wird zwar nur geschehen, falls solche speziellen Zahlungsmodule verwendet werden, dennoch bevorzugen Sie vielleicht den traditionellen Checkout. <strong>Wenn Sie diese Einstellung deaktivieren, dann erfüllt Ihr Shop nicht mehr die PA-DSS Vorgaben.</strong>', now(), now()),
('Aktualisierung der Wechselkurse: Primäre Quelle', 'CURRENCY_SERVER_PRIMARY', 43, 'Von welchem Server sollen die Kurse für das Update der Währungen bezogen werden? (Primäre Quelle)<br><br>Weitere Quellen können durch Plugins hinzugefügt werden.', now(), now()),
('Aktualisierung der Wechselkurse: Sekundäre Quelle', 'CURRENCY_SERVER_BACKUP', 43, 'Von welchem Server sollen die Kurse für das Update der Währungen bezogen werden? (Sekundäre Quelle falls erster Server nicht erreichbar)<br><br>Weitere Quellen können durch Plugins hinzugefügt werden.', now(), now()),
('Voreinstellung für Kundenbenachrichtigung beim Update einer Bestellung', 'NOTIFY_CUSTOMER_DEFAULT', 43, 'Was soll beim Aktualisieren einer Bestellung bezüglich Kundenbenachrichtigung voreingestellt sein?<br><br>1 = Email = Kunde wird über die Aktualisierung per Email informiert<br><br>2 = No Email = Es wird bei der Aktualisierung kein Mail an den Kunden geschickt<br><br>3 = Hide = Es wird kein Email geschickt und der Eintrag in der Bestellhistorie ist für den Kunden nicht sichtbar', now(), now()),
('Metatags in der Artikelsuche einbeziehen?', 'ADVANCED_SEARCH_INCLUDE_METATAGS', 43, 'Sollen die für einen Artikel definierten Meta Tag Keywords und Meta Tag Beschreibungen in der Erweiterten Suche miteinbezogen werden?', now(), now()),
('Admin <em>Login als Kunde</em>: Nur für einen Admin erlaubt?', 'EMP_LOGIN_ADMIN_ID', 43, 'Wenn das Login als Kunde (auf der Seite Kunden) nur für einen ganz bestimmten Administrator erlaubt sein soll, dann geben Sie hier die ID dieses Administrators ein. Setzen Sie den Wert auf 0, um die Funktion <em>Einzelne Admin-ID</em> zu deaktivieren und nutzen Sie stattdessen die Einstellung für die berechtigten Admin Profile weiter unten.', now(), now()),
('Admin <em>Login als Kunde</em>: Automatisches Login?', 'EMP_LOGIN_AUTOMATIC', 43, 'Soll bei Click auf den Button Login als Kunde direkt als Kunde eingeloggt werden, ohne das Administratorpasswort eingeben zu müssen? ', now(), now()),
('Admin <em>Login als Kunde</em>: Nur für bestimmte Admin Profile erlaubt?', 'EMP_LOGIN_ADMIN_PROFILE_ID', 43, 'Geben Sie die Administrator-<em>Benutzerprofil-IDs</em> an, die die Funktion <em>Login als Kunde</em> auf der Kundenliste verwenden dürfen &mdash; alle Administratoren, die in diesen Profilen sind, sind zugelassen. Geben Sie den Wert als kommagetrennte Liste (dazwischenliegende Leerzeichen sind OK) von Admin-Profil-IDs ein, z. B. <b>1,2,3</b>. Setzen Sie den Wert auf 0, um die Funktion <em>Admin-Profile</em> zu deaktivieren und stattdessen das Login für einen einzelnen Admin weiter oben zu nutzen.<br><br><b>Voreinstellung: 0</b>', now(), now()),

# Adminmenü ID 2 - Minimale Werte
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
('Admin Username', 'ADMIN_NAME_MINIMUM_LENGTH', 43, 'Minimale Zeichenlänge für Admin Usernamen (sollte minimal 4 Zeichen oder mehr sein!)', now(), now()),

# Adminmenü ID 3 - Maximale Werte
('Adresseinträge im Adressbuch', 'MAX_ADDRESS_BOOK_ENTRIES', 43, 'Wieviele Adresseinträge dürfen Kunden in Ihrem Adressbuch haben?', now(), now()),
('Suchresultate pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS', 43, 'Wieviele Artikel sollen maximal in den Suchresultaten pro Seite angezeigt werden?', now(), now()),
('"Vorherige - Nächste" Navigation: Seitenlinks (Desktop)', 'MAX_DISPLAY_PAGE_LINKS', 43, 'Anzahl der Seitenlinks in der "Vorherige - Nächste" Navigation', now(), now()),
('"Vorherige - Nächste" Navigation: Seitenlinks (Mobil)', 'MAX_DISPLAY_PAGE_LINKS_MOBILE', 43, 'Anzahl der Seitenlinks in der "Vorherige - Nächste" Navigation auf Mobilgeräten (voruasgesetzt Ihr Template unterstützt spezielle Einstellungen für Mobilgeräte)', now(), now()),
('Anzuzeigende "Sonderangebote"', 'MAX_DISPLAY_SPECIAL_PRODUCTS', 43, 'Wieviele Sonderangebote sollen angezeigt werden?', now(), now()),
('Anzuzeigende "Neue Artikel"', 'MAX_DISPLAY_NEW_PRODUCTS', 43, 'Wieviele "Neue Artikel" sollen in den Kategorien angezeigt werden?', now(), now()),
('Anzuzeigende "Erwartete Artikel"', 'MAX_DISPLAY_UPCOMING_PRODUCTS', 43, 'Wieviele "erwartete Artikel" sollen angezeigt werden?', now(), now()),
('Hersteller - Listenfeld Grösse/Stil', 'MAX_MANUFACTURERS_LIST', 43, 'Anzahl der Hersteller, die im Listenfeld angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird eine Dropdown Liste angezeigt.', now(), now()),
('Hersteller Liste - Produktüberprüfung', 'PRODUCTS_MANUFACTURERS_STATUS', 43, 'Der Hersteller wird nur dann in der Liste angezeigt wenn mindestens 1 Produkt von ihm Verfügbar ist.<br>0 = AUS<br>1 = EIN<br>Anmerkung: Ein Aktivieren dieser Einstellung kann bei Shops mit vielen Artikeln zu Performance-Einbussen führen.', now(), now()),
('Musik Genre - Listenfeld Grösse/Stil', 'MAX_MUSIC_GENRES_LIST', 43, 'Anzahl der Musik Genres, die im Listenfeld angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird eine Dropdown Liste angezeigt.', now(), now()),
('Plattenfirma - Listenfeld Grösse/Stil', 'MAX_RECORD_COMPANY_LIST', 43, 'Anzahl der Plattenfirmen, die im Listenfeld angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird eine Dropdown Liste angezeigt.', now(), now()),
('Länge der Namen von Plattenfirmen', 'MAX_DISPLAY_RECORD_COMPANY_NAME_LEN', 43, 'Wird in der Box "Plattenfirma" verwendet; Maximale Länge der anzuzeigenden Namen von Plattenfirmen. Längere Namen werden abgeschnitten.', now(), now()),
('Länge der Namen von Musik Genres', 'MAX_DISPLAY_MUSIC_GENRES_NAME_LEN', 43, 'Wird in der Box "Musik Genre" verwendet; Maximale Länge der anzuzeigenden Namen von Musik Genres. Längere Namen werden abgeschnitten.', now(), now()),
('Länge der Namen von Herstellern', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', 43, 'Wird in der Box "Hersteller" verwendet; Maximale Länge der anzuzeigenden Namen von Herstellern. Längere Namen werden abgeschnitten.', now(), now()),
('Neue Artikelbewertungen pro Seite', 'MAX_DISPLAY_NEW_REVIEWS', 43, 'Anzahl der Bewertungen auf jeder Seite', now(), now()),
('Box "Bewertungen": zufällige Artikel', 'MAX_RANDOM_SELECT_REVIEWS', 43, 'Wieviele Bewertungen sollen zufällig ausgewählt werden?<br> Unabhängig davon wird immer nur EINE in der Box "Bewertungen" angezeigt.', now(), now()),
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
('Max. Anzahl Bestellpositionen / Auftrag (Liste im Adminbereich)', 'MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING', 43, 'Max. Anzahl Bestellpositionen / Auftrag (Liste im Adminbereich)<br>0= unbegrenzt', now(), now()),
('Max. Anzahl PayPal IPN Transaktionen pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN', 43, 'Max. Anzahl PayPal IPN Transaktionen pro Seite<br />Standard: 20', now(), now()),
('Max. Spaltenanzahl - Artikel zu Kategorien-Manager', 'MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS', 43, 'Max. Spaltenanzahl - Artikel zu Kategorien-Manager<br>3= default', now(), now()),
('Max. Anzahl EZ-Pages pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_EZPAGE', 43, 'Wieviele EZ-Pages sollen maximal auf einer Seite der Administration anzeigt werden?<br />20 = Voreinstellung', now(), now()),
('Max. Anzahl Zeichen in Vorschauen', 'MAX_PREVIEW', 43, 'Wieviele Zeichen sollen in einer Vorschau maximal angezeigt werden?<br />100 = Voreinstellung', now(), now()),

# Adminmenü ID 4 - Bilder
('Kleine Bilder: Breite', 'SMALL_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der kleinen Bilder', now(), now()),
('Kleine Bilder: Höhe', 'SMALL_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der kleinen Bilder', now(), now()),
('Überschriftsbild im Adminbereich: Breite', 'HEADING_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Bilder in der Überschrift im Adminbereich<br>HINWEIS: Momentan regelt dieser Wert nur die Abstände zwischen den Einträgen im Adminbereich. Er kann aber auch dazu benutzt werden, eigene Überschriftsbilder im Adminbereich hinzuzufügen', now(), now()),
('Überschriftsbild im Adminbereich: Höhe', 'HEADING_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der Bilder in der Überschrift im Adminbereich<br>HINWEIS: Momentan regelt dieser Wert nur die Abstände zwischen den Einträgen im Adminbereich. Er kann aber auch dazu benutzt werden, eigene Überschriftsbilder im Adminbereich hinzuzufügen', now(), now()),
('Unterkategorien: Breite der Bilder', 'SUBCATEGORY_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Bilder für die Unterkategorien', now(), now()),
('Unterkategorien: Höhe der Bilder', 'SUBCATEGORY_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der Bilder für die Unterkategorien', now(), now()),
('Bildgrösse berechnen', 'CONFIG_CALCULATE_IMAGE_SIZE', 43, 'Soll die Grösse der Bilder berechnet werden?', now(), now()),
('Platzhalter für fehlende Bilder anzeigen', 'IMAGE_REQUIRED', 43, 'Sollen fehlende Bilder "angezeigt" werden? (Hilfreich in der Entwicklungsphase)', now(), now()),
('Warenkorb: Artikelbilder anzeigen', 'IMAGE_SHOPPING_CART_STATUS', 43, 'Sollen Artikelbilder im Warenkorb angezeigt werden?<br />0= nein<br />1= ja', now(), now()),
('Warenkorb: Breite der Artikelbilder', 'IMAGE_SHOPPING_CART_WIDTH', 43, 'Standard = 50', now(), now()),
('Warenkorb: Höhe der Artikelbilder', 'IMAGE_SHOPPING_CART_HEIGHT', 43, 'Standard = 40', now(), now()),
('Kategorie: Bildbreite - Artikeldetails', 'CATEGORY_ICON_IMAGE_WIDTH', 43, 'Breite in Pixel für das Kategoriebild auf der Artikeldetailseite', now(), now()),
('Kategorie: Bildhöhe - Artikeldetails', 'CATEGORY_ICON_IMAGE_HEIGHT', 43, 'Höhe in Pixel für das Kategoriebild auf der Artikeldetailseite', now(), now()),
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
('IH - Bildgrösse ändern und Caching verwenden', 'IH_RESIZE', 43, 'Entweder ''No'' für normales Zen-Cart Verhalten oder ''Yes'' um die automatische grössenänderung und das Caching von Bildern zu aktivieren. Wenn Sie ImageMagick verwenden wollen, müssen Sie den Pfad zur convert binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em> angeben.', now(), now()),
('IH - Kleine Bilder - Dateityp', 'SMALL_IMAGE_FILETYPE', 43, 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Internet Explorer hat noch immer Probleme transparente png darzustellen. Nehmen Sie besser ''gif'' für die Transparenz oder ''jpg'' für Grössere Bilder. ''no_change'' bedeutet normales Zen-Cart Verhalten. Es wird derselbe Dateityp für kleine Bilder wie für hochgeladene Bilder verwendet.', now(), now()),
('IH - Kleine Bilder - Hintergrund', 'SMALL_IMAGE_BACKGROUND', 43, 'Falls ein hochgeladenes Bild mit transparenten Bereichen konvertiert wurde, erhalten die transparenten Bereiche diese Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now()),
('IH - Kleine Bilder - Qualität', 'SMALL_IMAGE_QUALITY', 43, 'Geben Sie die gewünschte Qualität für die kleinen jpg Bilder an. Dezimalwerte von 0 bis 100. Je Höher desto bessere Qualität und desto höhere Dateigrösse. Voreingestellt ist 85.', now(), now()),
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
('IH - Benennung der Bilder im cache/images Ordner', 'IH_CACHE_NAMING', 43, 'Wählen Sie die Methode, die <em>Image Handler</em> verwendet, um die verkleinerten Bilder im Verzeichnis <code>cache/images</code> zu benennen.<br><br><em>Hashed</em>: Verwendet einen &quot;MD5&quot; Hash, um die Dateinamen zu erzeugen.  Es kann &quot;schwierig&quot; sein, die Originaldatei mit dieser Methode visuell zu identifizieren.<br><br><em>Readable (Lesbar)</em>: Dies ist eine gute Wahl für neue Installationen oder für aktualisierte Installationen, die keine hardcodierten Bildverknüpfungen zu alten Hashed Dateinamen haben. <br><br><em>Mirrored (Gespiegelt)</em>: Ähnlich wie <em>Readable</em>, aber die Verzeichnisstruktur unter <code>cache/images</code> spiegelt die Struktur der Unterverzeichnisse der Originalbilder wider.', now(), now()),

# Adminmenü ID 5 - Kundendetails
('Anrede', 'ACCOUNT_GENDER', 43, 'Auswahl der Anrede <br /> Diese wird bei Erstellung des Kundenkontos abgefragt und dann in allen E-Mails benutzt.<br /><br />Wenn diese Option auf FALSE gestellt wird, wird der Kunde stets mit Hallo VORNAME angesprochen.', now(), now()),
('Geburtsdatum', 'ACCOUNT_DOB', 43, 'Soll das Feld "Geburtsdatum" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Firma', 'ACCOUNT_COMPANY', 43, 'Soll das Feld "Firma" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Adresszeile 2', 'ACCOUNT_SUBURB', 43, 'Soll das Feld "Adresszeile 2" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Bundesland', 'ACCOUNT_STATE', 43, 'Soll das Feld "Bundesland" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Bundesländerliste - als Pulldownmenü anzeigen?', 'ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN', 43, 'Soll die Eingabe des Bundeslandes durch eine Auswahlliste dargestellt werden?', now(), now()),
('Kontoerstellung: Standard - Land', 'SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY', 43, 'Dieses Land als Standard in der Kontoerstellung anzeigen:<br />', now(), now()),
('Faxnummer', 'ACCOUNT_FAX_NUMBER', 43, 'Soll das Feld "Faxnummer" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Checkbox für Newsletter anzeigen', 'ACCOUNT_NEWSLETTER_STATUS', 43, 'Soll die Checkbox für Newsletter angezeigt werden?<br />0= nein<br />1= unmarkiert anzeigen<br />2= markiert anzeigen<br /><strong>HINWEIS: In einigen Ländern steht die Standardanzeige auf "markiert" im Konflikt mit den gesetzlichen Bestimmungen</strong>', now(), now()),
('E-Mail an Kunden im HTML Format senden', 'ACCOUNT_EMAIL_PREFERENCE', 43, 'Standard Einstellung für E-Mails an Kunden<br>0=Text<br>1=HTML', now(), now()),
('Artikelbenachrichtigung nach Bestellung abfragen', 'CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS', 43, 'Sollen Kunden nach ihrer Bestellung über Artikelbenachrichtigungen gefragt werden?<br />0 = nie nachfragen<br />1= Immer nachfragen, außer wenn die Abfrage global gesetzt wurde<br /><br />HINWEIS: Die Sidebox muss separat ausgeschaltet werden', now(), now()),
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
('Versandkostenfreie Lieferung aktivieren', 'MODULE_SHIPPING_FREESHIPPER_STATUS', 43, 'Bieten Sie einen versandkostenfreien Versand an?<br><br><b>Hinweis:<br>Lassen Sie dieses Versandmodul IMMER aktiv!</b><br>Es wird für bestimmte Funktionalitäten benötigt und aktiviert sich nur, falls ein Artikel wirklich versandkostenfrei ist. Es bedeutet NICHT, dass der Kunde einfach einen Gratisversand auswählen kann!<br><b>Nicht deinstallieren und auch nicht deaktivieren!</b>', now(), now()),
('Versandkosten', 'MODULE_SHIPPING_FREESHIPPER_COST', 43, 'Welche Versandkosten fallen an?', now(), now()),
('Bearbeitungsgebühr', 'MODULE_SHIPPING_FREESHIPPER_HANDLING', 43, 'BearbeitungsGebühr für diese Versandart:', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', 43, 'Welche Steuerklasse soll bei dieser Versandart angewendet werden?', now(), now()),
('Versandzone', 'MODULE_SHIPPING_FREESHIPPER_ZONE', 43, 'für welche Länder soll diese Versandart angeboten werden?<br>Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now(), now()),
('Sortierung', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Versandarten.', now(), now()),
('Versandkosten pro stück aktivieren', 'MODULE_SHIPPING_ITEM_STATUS', 43, 'Bieten Sie die Versandart Versandkosten pro stück an?', now(), now()),
('Versandkosten pro Artikel', 'MODULE_SHIPPING_ITEM_COST', 43, 'Die Versandkosten werden mit der Anzahl der Artikel in der Bestellung multipliziert.', now(), now()),
('BearbeitungsGebühr', 'MODULE_SHIPPING_ITEM_HANDLING', 43, 'BearbeitungsGebühr für diese Versandart:', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_ITEM_TAX_CLASS', 43, 'Welche Steuerklasse soll bei dieser Versandart angewendet werden?', now(), now()),
('Basis der Steuern', 'MODULE_SHIPPING_ITEM_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern berechnet werden? Mögliche Optionen:<br />Versand (Shipping) - auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - auf Basis der Shopadresse, wenn die Rechnungs-/Versandadresse des Kunden innerhalb der Zone der Shopadresse liegt', now(), now()),
('Versandzone', 'MODULE_SHIPPING_ITEM_ZONE', 43, 'für welche Länder soll diese Versandart angeboten werden?<br>Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now(), now()),
('Sortierung', 'MODULE_SHIPPING_ITEM_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Versandarten.', now(), now()),
('Zahlungsart "Gratis" aktivieren', 'MODULE_PAYMENT_FREECHARGER_STATUS', 43, 'Wollen Sie die Zahlungsart "Gratis" anbieten?<br><br><b>Hinweis: Lassen Sie dieses Zahlungsmodul IMMER aktiv!</b><br>Es wird für bestimmte Funktionalitäten benötigt und aktiviert sich nur, wenn der Gesamtbetrag wirklich 0 ist. Es bedeutet nicht, dass dem Kunden diese Zahlungsart zur Auswahl angeboten wird!<br><br><b>Nicht deinstallieren und auch nicht deaktivieren!</b>', now(), now()),
('Sortierung', 'MODULE_PAYMENT_FREECHARGER_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Zahlungsarten.', now(), now()),
('Zahlungszone', 'MODULE_PAYMENT_FREECHARGER_ZONE', 43, 'für welche Länder soll diese Zahlungsart angeboten werden?<br>Die auswählbaren Zahlungszonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now(), now()),
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
('MwSt. Betrag neu berechnen', 'MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX', 43, 'Soll der MwSt. Betrag neu berechnet werden?<br> Dieses ist nur notwendig, wenn die Gruppenermässigung inkl. MwSt. angezeigt werden soll', now(), now()),
('Steuerklasse', 'MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS', 43, 'Folgende Steuerklasse verwenden falls oben Credit Note eingestellt ist:', now(), now()),
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

# Adminmenü ID 7 - Versandoptionen
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

# Adminmenü ID 8- Artikelliste
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
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br><br>0= NEIN<br>1= Oben<br>2= Unten<br>3= Oben und Unten', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_LIST_DESCRIPTION', 43, 'Soll die Artikelbeschreibung angezeigt werden?<br><br>0= Aus<br>oder z.B. 150 = es werden die ersten 150 Zeichen der Artikelbeschreibung angezeigt', now(), now()),
('Zeichen für absteigende Sortierung', 'PRODUCT_LIST_SORT_ORDER_DESCENDING', 43, 'Welches Zeichen soll eine ansteigende Sortierung anzeigen?<br />Default = -', now(), now()),
('Zeichen für aufsteigende Sortierung', 'PRODUCT_LIST_SORT_ORDER_ASCENDING', 43, 'Welches Zeichen soll eine aufsteigende Sortierung anzeigen?<br />Default = +', now(), now()),
('Artikelfilter für Artikelnamen nach Alphabet anzeigen', 'PRODUCT_LIST_ALPHA_SORTER', 43, 'Soll der Filter für Artikel nach Alphabet in der Artikelliste angezeigt werden?', now(), now()),
('Bild für Unterkategorien anzeigen', 'PRODUCT_LIST_CATEGORIES_IMAGE_STATUS', 43, 'Wollen Sie die Bilder der Unterkategorien in der Artikelliste anzeigen?', now(), now()),
('Bild für ausgewählte Kategorie anzeigen', 'PRODUCT_LIST_CATEGORIES_IMAGE_STATUS_TOP', 43, 'Wollen Sie das Bild für die aktuell ausgewählte Kategorie oben in der Artikelliste anzeigen?', now(), now()),
('Unterkategorien anzeigen', 'PRODUCT_LIST_CATEGORY_ROW_STATUS', 43, 'Sollen die Unterkategorien in der Artikelliste beim Klick auf die Hauptkategorie angezeigt werden?<br /><br />0= Nein<br />1= Ja', now(), now()),
('Artikelliste - Layout Stil', 'PRODUCT_LISTING_LAYOUT_STYLE', 43, 'Wählen Sie das Layout Ihrer Artikelliste:<br>Jeder Artikel kann in einer eigenen Zeile angezeigt werden (rows) oder die Artikel können nebeneinander in mehreren Spalten pro Reihe angezeigt werden (columns)', now(), now()),
('Artikelliste - Spalten pro Reihe', 'PRODUCT_LISTING_COLUMNS_PER_ROW', 43, 'Wieviele Spalten pro Reihe wollen Sie in der Artikelliste anzeigen. Voreinstellung: 3 (columns Modus)<br/>1 bedeutet Anzeige in einer Spalte (rows Modus)', now(), now()),


# Adminmenü ID 9 - Lagerverwaltung und Warenkorb
('Lagerbestand prüfen', 'STOCK_CHECK', 43, 'Überprüfen, ob der bestellte Artikel auch lagernd ist', now(), now()),
('Bestellungen vom Lagerbestand abziehen', 'STOCK_LIMITED', 43, 'Sollen bestellte Artikel vom Lagerbestand abgezogen werden?', now(), now()),
('Bestellung erlauben, wenn Lagerbestand unterschritten wird', 'STOCK_ALLOW_CHECKOUT', 43, 'Soll Kunden bei Unterschreitung des Lagerbestandes eine Bestellung ermöglicht werden?', now(), now()),
('Markierung für nicht lagernde Artikel', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', 43, 'Nicht lagernde Artikel werden bei der Bestellung markiert mit diesen Zeichen markiert<br>Standard: ***', now(), now()),
('Lagermindestbestand für Nachbestellungen', 'STOCK_REORDER_LEVEL', 43, 'Legen Sie hier fest, ab welcher Lagermenge ein Artikel nachbestellt werden muss<br>HINWEIS: Diese Einstellung gilt für alle Artikel, es kann keine Unterscheidung pro Artikel vorgenommen werden.', now(), now()),
('Artikel im Shop anzeigen, wenn nicht lagernd', 'SHOW_PRODUCTS_SOLD_OUT', 43, 'Sollen Artikel im Shop angezeigt werden, wenn sie nicht lagernd sind<br /><br />0= Nein - Artikelstatus auf AUS<br />1= Ja, Artikelstatus auf EIN', now(), now()),
('Artikel ist ausverkauft: Bild "Ausverkauft" anstelle von "in den Warenkorb" anzeigen', 'SHOW_PRODUCTS_SOLD_OUT_IMAGE', 43, 'Zeige für ausverkaufte Artikel das Bild "Ausverkauft" anstelle von "in den Warenkorb"<br /><br />0= nein<br />1= ja', now(), now()),
('Dezimalstellen der Artikelstückzahlen', 'QUANTITY_DECIMALS', 43, 'Wieviele Dezimalstellen sollen in der Artikelstückzahl angezeigt werden?<br /><br />0= keine', now(), now()),
('Warenkorb: Checkboxen und/oder Buttons zum Löschen anzeigen', 'SHOW_SHOPPING_CART_DELETE', 43, 'Zeigt im Warenkorb Buttons und/oder Checkboxen zum Löschen von Artikel an<br /><br />1= Nur Buttons<br />2= Nur Checkboxen<br />3= Buttons und Checkboxen', now(), now()),
('Warenkorb: Aktualisieren Schaltfläche anzeigen', 'SHOW_SHOPPING_CART_UPDATE', 43, 'Wo soll die Aktualisieren Schaltfläche im Warenkorb angezeigt werden?<br><br>1= Neben jedem Mengeneingabefeld<br>2= Einmal unterhalb des Warenkorbes<br>3= Neben jedem Mengeneingabefeld und unterhalb des Warenkorbes', now(), now()),
('Leerer Warenkorb: "Neue Artikel" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_NEW_PRODUCTS', 43, 'Sollen "Neue Artikel" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Leerer Warenkorb: "Empfohlene Artikel" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_FEATURED_PRODUCTS', 43, 'Sollen "Empfohlene Artikel" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Leerer Warenkorb: "Monatliche Sonderangebote" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_SPECIALS_PRODUCTS', 43, 'Sollen "Monatliche Sonderangebote" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Leerer Warenkorb: "Artikelankündigungen" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_UPCOMING', 43, 'Sollen "Artikelankündigungen" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Zeige Hinweis beim Login über den zusammengelegten Warenkorb an', 'SHOW_SHOPPING_CART_COMBINED', 43, 'Sobald ein Kunde sich anmeldet und von der letzten Anmeldung noch Artikel im Warenkorb hat, werden die aktuell im Warenkorb vorhandenen Artikel mit dem Warenkorb der letzten Anmeldung kombiniert.<br /><br />Soll der Kunde auf diesen Vorgang hingewiesen werden?<br /><br />0= NEIN, zeige keinen Hinweis an<br />1= JA, und gehe automatisch zum Warenkorb<br />2= JA, aber gehe nicht automatisch zum Warenkorb', now(), now()),
('Deaktivierte Artikel bei Erreichen des Verfügbarkeitsdatums aktivieren', 'ENABLE_DISABLED_UPCOMING_PRODUCT', 43, 'Wie soll ein versteckter (deaktivierter) Artikel mit einem zukünftigen Verfügbarkeitsdatum für Kunden sichtbar (aktiv) gemacht werden, wenn das Datum erreicht ist?<br />Manual = Manuell aktivieren<br/>Automatic = Automatisch aktivieren<br/>', now(), now()),
('Deaktivierter Artikelstatus für Suchmaschinen', 'DISABLED_PRODUCTS_TRIGGER_HTTP200', 43, 'Wenn ein Artikel als deaktiviert (Status=0) eingestellt ist, aber nicht aus der Datenbank gelöscht wird, sollen Suchmaschinen ihn dann trotzdem als verfügbar anzeigen?<br><br>true = HTTP 200 Antwort zurückgeben<br>false = HTTP 410 zurückgeben<br><br/>(Löschen des Artikels gibt HTTP 404 zurück)<br><br/><b>Voreinstellung: false</b><br/><br/>', now(), now()),

 # Adminmenü ID 10 - Protokollierung und Logfiles
('Speichern der Zeit für Seitenaufbau', 'STORE_PAGE_PARSE_TIME', 43, 'Sollen die Zeiten für den Seitenaufbau einer Seite gespeichert werden?', now(), now()),
('Protokolldatei für Seitenaufbau: Speicherort', 'STORE_PAGE_PARSE_TIME_LOG', 43, 'Verzeichnis und Dateiname der Protokolldatei für Seitenaufbau', now(), now()),
('Protokolldatei für Seitenaufbau: Datumsformat', 'STORE_PARSE_DATE_TIME_FORMAT', 43, 'Datumsformat für die Protokolldatei', now(), now()),
('Zeit für Seitenaufbau im Shop anzeigen', 'DISPLAY_PAGE_PARSE_TIME', 43, 'Soll die Zeit für den Seitenaufbau im Shop unten angezeigt werden?<br />HINWEIS: Es ist nicht notwendig, die Protokolldatei für Seitenaufbau zu speichern, um sie im Shop anzeigen zu lassen.', now(), now()),
('Datenbankabfragen in Protokolldatei speichern', 'STORE_DB_TRANSACTIONS', 43, 'Sollen Datenbankabfragen in der Protokolldatei für Seitenabfragen gespeichert werden?<br />VORSICHT: Das Aktivieren dieser Einstellung kann Ihren Shop stark verlangsamen und unzählige Logfiles reduzieren Ihren Speicherplatz auf Ihrem Server! Nur für Troubleshooting aktivieren!', now(), now()),
('Logfiles anzeigen: Version', 'DISPLAY_LOGS_VERSION', 43, 'Version der Logfile Anzeige im Admin', now(), now()),
('Logfiles anzeigen: Maximale Anzahl', 'DISPLAY_LOGS_MAX_DISPLAY', 43, 'Wieviele Logfiles sollen maximal auf einer Seite angezeigt werden. (Voreinstellung: <b>20</b>)', now(), now()),
('Logfiles anzeigen: Maximale Dateigröße', 'DISPLAY_LOGS_MAX_FILE_SIZE', 43, 'Stellen Sie hier die maximale Dateigröße für die anzuzeigenden Logfiles ein.  (Voreinstellung: <b>80000</b>)', now(), now()),
('Logfiles anzeigen: Enthaltene Logfiletypen', 'DISPLAY_LOGS_INCLUDED_FILES', 43, 'Tragen Sie hier die <em>Präfixe</em> der Logfiles ein, die in der Anzeige berücksichtigt werden sollen, getrennt mit dem Pipe Zeichen (|). Leerzeichen werden von der Coderoutine entfernt.', now(), now()),
('Logfiles anzeigen: Ausgeschlossene Logfiletypen', 'DISPLAY_LOGS_EXCLUDED_FILES', 43, 'Tragen Sie hier die Präfixe der Logfiles ein, die von der Anzeige <em>ausgeschlossen</em> werden sollen, getrennt mit dem Pipe Zeichen (|). Leerzeichen werden von der Coderoutine entfernt.', now(), now()),
('Logfiles anzeigen: Hinweis im Header der Administration', 'DISPLAY_LOGS_SHOW_IN_HEADER', 43, 'Wenn Errorlogs vorhanden sind, wird im Header der Shopadministration ein entsprechender Hinweis angezeigt, um Sie darauf aufmerksam zu machen.<br>Wenn Sie diesen Hinweis nicht haben wollen, können Sie ihn hier deaktivieren<br>Hinweis anzeigen = true<br>Hinweis nicht anzeigen = false.', now(), now()),
('Logfiles Level: Adminbereich', 'REPORT_ALL_ERRORS_ADMIN', 43, 'Möchten Sie Debug-Logs für <b>alle</b> PHP-Fehler, auch Warnungen, erstellen, die während der Verarbeitung in Ihrem Zen Cart Adminbereich auftreten?<br> Wenn Sie alle PHP-Fehler <b>ausgenommen</b> doppelte Sprachdefinitionen protokollieren möchten, wählen Sie <em>IgnoreDups</em> (= Duplikate ignorieren).<br>Das ist die Voreinstellung, da doppelte Sprachdefinitionen in Zen Cart 1.5.x durch das Override System nicht komplett vermeidbar sind.<br>Die Einstellung Yes wird zu einigen Logfiles mit völlig harmlosen Warnings führen.', now(), now()),
('Logfiles Level: Frontend', 'REPORT_ALL_ERRORS_STORE', 43, 'Möchten Sie Debug-Logs für <b>alle</b> PHP-Fehler, auch Warnungen, erstellen, die während der Verarbeitung in Ihrem Zen Cart Frontend auftreten?<br> Wenn Sie alle PHP-Fehler <b>ausgenommen</b> doppelte Sprachdefinitionen protokollieren möchten, wählen Sie <em>IgnoreDups</em> (= Duplikate ignorieren).<br>Das ist die Voreinstellung, da doppelte Sprachdefinitionen in Zen Cart 1.5.x durch das Override System nicht komplett vermeidbar sind.<br>Die Einstellung Yes wird zu extrem vielen Logfiles mit völlig harmlosen Warnings führen und die Performance des Frontends negativ beeinflussen.', now(), now()),
('Logfiles Level: Backtrace auch bei Notices?', 'REPORT_ALL_ERRORS_NOTICE_BACKTRACE', 43, 'Wollen Sie Backtrace-Informationen zu &quot;Notice&quot; Fehlern einbeziehen?<br>Diese sind in der Regel auf die identifizierte Datei beschränkt und die Backtrace-Informationen füllen nur die Logs. Voreinstellung (<b>Nein</b>).<br>Nur zu detaillierten Fehleranalyse sinnvoll.', now(), now()),

# Adminmenü ID 11 - AGB und Datenschutz
('AGB Bestätigungsfeld bei der Bestellung anzeigen', 'DISPLAY_CONDITIONS_ON_CHECKOUT', 43, 'Den Kunden wird während der Bestellung das AGB Bestätigungsfeld angezeigt und sie müssen den AGB zustimmen.', now(), now()),
('Datenschutzbestimmungen Bestätigungsfeld bei der Kontoerstellung anzeigen', 'DISPLAY_PRIVACY_CONDITIONS', 43, 'Den Kunden wird während der Kontoerstellung das Datenschutzbestimmungen Bestätigungsfeld angezeigt und sie müssen den Datenschutzbestimmungen zustimmen.', now(), now()),
('Checkbox für Widerrufsrecht bei digitalen Downloads', 'DISPLAY_WIDERRUF_DOWNLOADS_ON_CHECKOUT_CONFIRMATION', 43, 'Wollen Sie auf der Bestellbestätigungsseite eine zusätzliche Checkbox für das Widerrufsrecht bei digitalen Downloads anzeigen? Der Kunde muss dann explizit zustimmen, dass sein Widerrufsrecht erlischt.<br>Nur aktivieren, falls Sie digitale Downloads verkaufen!', now(), now()),


# Adminmenü ID 12 - Email Optionen
('E-Mail Transportmethode', 'EMAIL_TRANSPORT', 43, 'Definiert die Methode für das Senden von Emails.<br /><br><strong>PHP</strong> ist voreingestellt, damit Sie den Mailversand gleich ohne weitere Einstellungen testen können. Diese Versandart sollte auf jedem Server funktionieren.<br><b>Im Livebetrieb sollten Sie aber die Versandart PHP KEINESFALLS verwenden!</b><br><br /><strong>SMTPAUTH</strong> sollte im Livebetrieb verwendet werden, da es den sicheren Versand von authentifizierten E-Mails über einen SMTP Server ermöglicht. Wenn Sie auf diese Methode umschalten, dann müssen Sie weiter unten auch Ihre SMTPAUTH-Einstellungen in den entsprechenden Feldern konfigurieren. <br /><br /><strong>Gmail</strong> wird für das Senden von E-Mails über den Mail-Service von Google verwendet und erfordert weiter unten Einstellungen aus Ihrem gmail-Konto.<br /><br /><strong>sendmail</strong> ist für Linux/Unix-Hosts, die das sendmail-Programm auf dem Server verwenden<br /><br><strong>"sendmail-f"</strong> ist nur für Server, die die Verwendung des Parameters -f benötigen, um sendmail zu verwenden. Dies ist eine Sicherheitseinstellung, die häufig verwendet wird, um Spoofing zu verhindern. Verursacht Fehler, wenn Ihr Host-Mailserver nicht für die Verwendung konfiguriert ist.<br /><br /><b>VERWENDEN SIE IM LIVEBETRIEB IMMER SMTPAUTH.</b>', now(), now()),
('SMTP E-Mail - Mailbox Benutzer', 'EMAIL_SMTPAUTH_MAILBOX', 43, 'Wenn Sie für den Versand von E-Mails SMTP Authentifizierung verwenden müssen, dann geben Sie hier den Namen Ihres SMTP Benutzerkontos ein z.B. ich@domain.com ', now(), now()),
('SMTP E-Mail - Mailbox Passwort', 'EMAIL_SMTPAUTH_PASSWORD', 43, 'Passwort für SMTP Authentifizierung', now(), now()),
('SMTP E-Mail - Mailserver Name', 'EMAIL_SMTPAUTH_MAIL_SERVER', 43, 'SMTP Mailserver für Authentifizierung z.B. smtp.domain.com', now(), now()),
('SMTP E-Mail - Mailserver Port', 'EMAIL_SMTPAUTH_MAIL_SERVER_PORT', 43, 'SMTP Mailserver Port', now(), now()),
('Währungssymbole für Text-Emails', 'CURRENCIES_TRANSLATIONS', 43, 'Welche Währungssymbole sollen für Text-Emails konvertiert werden?<br />Am besten lassen Sie die folgende Voreinstellung völlig unverändert:<br>&amp;pound; = £, &amp;euro; = €, &amp;reg; = ® , &amp;trade; = ™', now(), now()),
('E-Mail Zeilenvorschub', 'EMAIL_LINEFEED', 43, 'Legen Sie hier die Zeichen fest, die Sie zur Trennung des E-Mail Headers verwenden wollen.', now(), now()),
('E-Mail als MIME HTML versenden', 'EMAIL_USE_HTML', 43, 'Wollen Sie e-Mails im HTML Format versenden falls der Empänger in seinen Einstellungen HTML statt Text angekreuzt hat?<br>HINWEIS: Dies ist der generelle Hauptschalter. Wenn Sie hier auf false stellen, dann wird der Shop keinerlei HTML Emails versenden.', now(), now()),
('E-Mail durch DNS-Server verifizieren', 'ENTRY_EMAIL_ADDRESS_CHECK', 43, 'Soll die Gültigkeit von e-Mails durch DNS-Server verifiziert werden?', now(), now()),
('E-Mail senden', 'SEND_EMAILS', 43, 'E-Mails senden', now(), now()),
('E-Mail Archivierung aktiviert', 'EMAIL_ARCHIVE', 43, 'Wenn Sie E-Mail, die versendet werden, archivieren wollen, setzen Sie desen Wert auf "true".', now(), now()),
('E-Mail Fehlermeldungen', 'EMAIL_FRIENDLY_ERRORS', 43, 'Gibt lesbare Fehlermeldungen aus falls der E-Mail Versand scheitert (true). Bei (false) werden auch PHP Fehler angezeigt . Diese Einstellung ist nur für die Fehlersuche gedacht!', now(), now()),
('E-Mail Adresse (Kontaktadresse)', 'STORE_OWNER_EMAIL_ADDRESS', 43, 'Die E-Mail Adresse des Shopbetreibers / der Kontaktperson.', now(), now()),
('E-Mail Absender', 'EMAIL_FROM', 43, 'Die Absenderadresse, mit der E-Mails versendet werden sollen.', now(), now()),
('E-Mail Absenderdomain verwenden?', 'EMAIL_SEND_MUST_BE_STORE', 43, 'Alle vom Mailserver verschickten E-Mails müssen eine Absenderadresse "FROM" haben?<br /><br />Dies wird oft verwendet um das verschicken von SPAM mails zu verhindern. Bei JA wird der Wert der Einstellung "E-Mail Absender" als "FROM" Adresse für alle ausgehenden Mails verwendet.', now(), now()),
('E-Mail an Admin: Format', 'ADMIN_EXTRA_EMAIL_FORMAT', 43, 'Wählen Sie das Format für e-Mails, die zusätzlich an den Administrator versendet werden.<br>HINWEIS: Wenn Sie hier HTML auswählen, dann muss auch der generelle Hauptschalter HTML Emails versenden auf true gestellt sein, sonst werden nur Text Emails versandt.', now(), now()),
('E-Mail Kopie bei Bestellungen versenden', 'SEND_EXTRA_ORDER_EMAILS_TO', 43, 'Versendet zusätzlich ein E-Mail bei Bestellungen an die unten angegebene(n) Adresse(n).<br />Die Adressen müssen in diesem Format eingegeben werden:<br>Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
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
('"Kunden Bewertung" : Benachrichtigung versenden', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS', 43, '0= Nein<br>1= Ja', now(), now()),
('"Kunden Bewertung" : Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO', 43, 'Eine Kopie an diese E-Mail Adresse(n) versenden, wenn eine Bewertung abgegeben wurde?<br>Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;\r\n', now(), now()),
('E-Mail Adressen für die "Schreiben Sie uns" Dropdown Liste', 'CONTACT_US_LIST', 43, 'Lassen Sie dieses Feld leer, wenn Sie kein Dropdown mit unterschiedlichen Kontaktadressen verwenden wollen, es wird dann automatisch die Shop Kontakadresse verwendet!<br><br>Geben Sie hier die für die "Schreiben Sie uns" E-Mail Dropdown Liste gewünschte(n) E-Mail Adresse(n) ein.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Schreiben Sie uns": Shopname und Adresse anzeigen', 'CONTACT_US_STORE_NAME_ADDRESS', 43, 'Shopname und Adresse im Formular "Schreiben Sie uns" anzeigen<br />0= nein<br />1= ja', now(), now()),
('"Lagermindestbestand unterschritten": Benachrichtigung versenden', 'SEND_LOWSTOCK_EMAIL', 43, 'Eine Benachrichtigung versenden, wenn der Lagermindestbestand erreicht oder unterschritten wurde?<br />0= nein<br />1= ja', now(), now()),
('"Lagermindestbestand unterschritten": an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_LOW_STOCK_EMAILS_TO', 43, 'Wenn der Lagermindestbestand erreicht oder unterschritten wurde, soll an diese E-Mail Adresse(n) eine Benachrichtigung versendet werden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('Link "Newsletter abbestellen" anzeigen?', 'SHOW_NEWSLETTER_UNSUBSCRIBE_LINK', 43, 'Soll in der Info Box ein Link für "Newsletter abbestellen" angezeigt werden?', now(), now()),
('Empfängerliste -  Zähleranzeige', 'AUDIENCE_SELECT_DISPLAY_COUNTS', 43, 'Wenn die Liste der verfügbaren Empfänger angezeigt wird, soll der Empfängerzähler inkludiert werden? <br /><em>(HINWEIS: Es können Geschwindigkeitseinbußen auftreten, wenn Sie viele Kunden oder komplexe Empfängerabfragen haben)</em>', now(), now()),
('Willkommensemail senden?', 'SEND_WELCOME_EMAIL', 43, 'Wollen Sie Neukunden nach der Registrierung ein Willkommensemail senden?', now(), now()),

# Adminmenü ID 13 - Attributeinstellungen
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
('Artikel mit Read-Only Attributen - Hinzufügen zum Warenkorb', 'PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED', 43, 'Können Artikel mit nur Read-Only Attributen in den Warenkorb gelegt werden?<br>0=NEIN<br>1=JA', now(), now()),

# Adminmenü ID 14 - GZip Kompression
('GZip Komprimierung aktivieren', 'GZIP_LEVEL', 43, '0= nein 1= ja', now(), now()),

# Adminmenü ID 15 Sitzungen/Sessions
('Verzeichnis für Sitzungen', 'SESSION_WRITE_DIRECTORY', 43, 'Wenn das Speichern von Sitzungen sateibasierend ist, werden sie in dieses Verzeichnis gespeichert. Hier sollte dasselbe Verzeichnis angegeben werden wie in der Einstellun für DIR_FS_SQL_CACHE in Ihren beiden configure.php Dateien!', now(), now()),
('Cookies - Domänenname', 'SESSION_USE_FQDN', 43, 'Wenn für den Shop Cookies verwendet werden, benötigen Sie einen Domänennamen (z.B. www.meinedomain.at). Wenn nicht, wird nur ein teilweiser Domänenname benötigt (z.B. meinedomain.at) Wenn Sie sich nicht sicher sind, lassen Sie diese Option auf "true".', now(), now()),
('Cookies - Verwendung erzwingen', 'SESSION_FORCE_COOKIE_USE', 43, 'Die Verwendung von Cookies erzwingen.<br />HINWEIS: Wenn ein Kunde in den Browsereinstellungen die Verwendung von Cookies deaktiviert hat, kann dieser den Shop nicht verwenden..', now(), now()),
('Überprüfung der SSL Sitzungs- ID', 'SESSION_CHECK_SSL_SESSION_ID', 43, 'Überprüft die Sitzungs-ID bei jeder gesicherten HTTPS Seitenanfrage.', now(), now()),
('Browser des Kunden prüfen', 'SESSION_CHECK_USER_AGENT', 43, 'Überprüft den Browser des Kunden bei jeder Seitenanfrage.', now(), now()),
('IP Adresse überprüfen', 'SESSION_CHECK_IP_ADDRESS', 43, 'Überprüft die IP Adresse des Benutzers bei jeder Seitenanfrage.', now(), now()),
('Spider Sitzungen verhindern', 'SESSION_BLOCK_SPIDERS', 43, 'Verhindert das Starten von Sitzungen bei bekannten Spidern.', now(), now()),
('Sitzungen wiederherstellen', 'SESSION_RECREATE', 43, 'Sollen Sitzungen wiederhergestellt werden, um eine neue Sitzungs-ID zu erstellen, wenn ein Kunde sich anmeldet oder ein neues Konto erstellt? (benötigt PHP >=4.1).', now(), now()),
('Umwandlung IP Adresse zu Hostname', 'SESSION_IP_TO_HOST_ADDRESS', 43, 'Soll die IP-Adresse auf einen Hostnamen umgewandelt werden?<br><br>Anmerkung: Auf manchen Systemen kann dies zu einem langsameren Session Start und E-Mailversand führen. ', now(), now()),
('Basispfad für Cookiepfad verwenden', 'SESSION_USE_ROOT_COOKIE_PATH', 43, 'Normalerweise verwendet Zen Cart das Verzeichnis, in dem sich ein Shop befindet, als Cookie-Pfad. Dies kann bei einigen Servern zu Problemen führen. Mit dieser Einstellung können Sie den Cookie-Pfad auf das Stammverzeichnis des Servers und nicht auf das Speicherverzeichnis festlegen. Es sollte nur verwendet werden, wenn Sie Probleme mit Sitzungen haben.<br><b>Standardwert = false</b><br><br><b>Wenn Sie diese Einstellung ändern, kann es zu Problemen bei der Anmeldung in Ihrem Admin kommen, Sie sollten die Cookies Ihres Browsers löschen, um dies zu verhindern.</b>', now(), now()),
('Periodenpräfixes zur Cookie-Domäne hinzufügen', 'SESSION_ADD_PERIOD_PREFIX', 43, 'Normalerweise fügt Zen Cart der Cookie-Domain ein Periodenpräfix hinzu, z.B. .www.mydomain.com. Dies kann manchmal zu Problemen mit einigen Serverkonfigurationen führen. Wenn Sie Sessionprobleme haben, sollten Sie versuchen, dies auf False zu setzen.<br><b>Standardwert = True</b>', now(), now()),

# Adminmenü ID 16 - Gutscheine und Aktionskupons
('Länge der Aktionskupon-/Gutscheinnummer', 'SECURITY_CODE_LENGTH', 43, 'Tragen Sie hier die Länge der Aktionskupon-/Gutscheinnummer ein<br />Tipp: Je länger um so sicherer.', now(), now()),
('Standard Auftragsstatus bei Bestellsumme 0', 'DEFAULT_ZERO_BALANCE_ORDERS_STATUS_ID', 43, 'Auftragsstatus der Bestellungen mit der Bestellsumme 0 zugewiesen werden soll', now(), now()),
('Neuregistrierung: Aktionskupon ID#', 'NEW_SIGNUP_DISCOUNT_COUPON', 43, 'Wählen Sie einen Aktionskupon<br />(none= keine Aktiosnkupons bei Neuregistrierungen senden)', now(), now()),
('Neuregistrierung: Ermässigungsbetrag', 'NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', 43, 'Bitte leer lassen, falls Sie keine "Willkommensgeschenke" in Form eines Aktionskupons an Neukunden versenden wollen,<br />oder geben Sie den Betrag an (z.B. 10 für &euro;10.00)', now(), now()),
('Max. Anzahl Gutscheine pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS', 43, 'Max. Anzahl Gutscheine pro Seite', now(), now()),
('Max. Anzahl Gutscheine auf Reportseite', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS_REPORTS', 43, 'Max. Anzahl Gutscheine auf Reportseite', now(), now()),

# Adminmenü ID 17 - Kreditkarten
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
('Debit', 'CC_ENABLED_DEBIT', 43, 'Akzeptieren Sie Zahlungen mit Debit Kreditkarten (0= nein 1= ja)<br>HINWEIS: Dies ist zu diesem Zeitpunkt noch nicht tief integriert, und diese Einstellung kann überflüssig sein, wenn Ihre Zahlungsmodule noch keinen speziellen Code haben, um diesen Schalter zu unterstützen.', now(), now()),
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
('Gutschein Warteschlange im Header der Administration?', 'MODULE_ORDER_TOTAL_GV_SHOW_QUEUE_IN_ADMIN', 43, 'Wollen Sie den Button für die Gutschein-Warteschlange auf allen Seiten der Shopadministration anzeigen?<br>(Wird automatisch ausgeblendet, wenn sich nichts in der Warteschlange befindet, und wird auf derSeite \'Bestellungen\' immer angezeigt, unabhängig von dieser Einstellung.', now(), now()),
('Geschenkgutscheine als Sonderangebot möglich?', 'MODULE_ORDER_TOTAL_GV_SPECIAL', 43, 'Soll es möglich sein, dass Geschenkgutscheine als Sonderangebote eingestellt werden können?', now(), now()),

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

('Steuerklasse für das Einlösen von Aktionskupons', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', 43, 'Diese Steuerklasse beim Einlösen von Aktionskupons verwenden<br>empfohlene Voreinstellung: Normalsteuersatz<br>Nur wenn Sie hier einen Steuersatz auswählen, wird die Steuer korrekt berechnet und es kann bei Aktionskuponwerten mit Bruttopreisen gearbeitet werden.', now(), now()),
('Inklusive Steuern', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 43, 'Steuern in die Berechnung inkludieren<br>empfohlene Voreinstellung: false', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', 43, 'Sortierreihenfolge<br>empfohlene Voreinstellung: 201', now(), now()),
('Inklusive Versandkosten', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 43, 'Versandkosten in die Berechnung inkludieren<br>empfohlene Voreinstellung: false', now(), now()),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 43, '', now(), now()),
('Steuern neu berechnen', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 43, 'Steuern neu berechnen<br/>empfohlene Voreinstellung: Standard<br>Credit Note bedeutet, dass sämtliche Steuerausweisung bei Aktionskupons entfernt wird.', now(), now()),

('Artikeloptionstyp: Auswahltyp', 'PRODUCTS_OPTIONS_TYPE_SELECT', 43, 'Die Zahl repräsentiert den Auswahltyp der Artikeloptionen', now(), now()),
('Artikeloptionstyp: Text', 'PRODUCTS_OPTIONS_TYPE_TEXT', 43, 'Numerischer Wert des Textes des Artikeloptionstyps', now(), now()),
('Artikeloptionstyp: Radio Button', 'PRODUCTS_OPTIONS_TYPE_RADIO', 43, 'Numerischer Wert des Radio Buttons des Artikeloptionstyps', now(), now()),
('Artikeloptionstyp: Check Box', 'PRODUCTS_OPTIONS_TYPE_CHECKBOX', 43, 'Numerischer Wert der Check Box des Artikeloptionstyps', now(), now()),
('Artikeloptionstyp: Datei', 'PRODUCTS_OPTIONS_TYPE_FILE', 43, 'Numerischer Wert der Datei des Artikeloptionstyps', now(), now()),
('ID für Text und Datei des Artikeloption Wertes', 'PRODUCTS_OPTIONS_VALUES_TEXT_ID', 43, 'Numerischer Wert der Artikeloptionswert ID (products_options_values_id), die vom Text- und Dateiattribute verwendet wird', now(), now()),
('Upload Präfix', 'UPLOAD_PREFIX', 43, 'Präfix zu Unterscheidung zwischen Uploadoptionen und anderen Optionen', now(), now()),
('Text Präfix', 'TEXT_PREFIX', 43, 'Präfix zu Unterscheidung zwischen Textoptionen und anderen Optionen', now(), now()),
('Artikeloptionstyp: Nur lesen', 'PRODUCTS_OPTIONS_TYPE_READONLY', 43, 'Numerischer Wert des Status der Datei des Artikeloptionstyps', now(), now()),

# Adminmenü ID 18 - Artikeldetailseite
('Artikelbeschreibung: Sortierung der Artikelattribute', 'PRODUCTS_OPTIONS_SORT_BY_PRICE', 43, 'Wie soll die Sortierung der Artikelattribute in der Artikelbeschreibung angezeigt werden?<br>0= Sortierung, Preis<br>1= Sortierung, Attributeigenschaften', now(), now()),
('Artikelbeschreibung: Sortierung der Artikeloptionen', 'PRODUCTS_OPTIONS_SORT_ORDER', 43, 'Wie soll die Sortierung der Artikeloptionen in der Artikelbeschreibung angezeigt werden?<br>0 = Sortierung, Attributnamen<br>1 = Attributnamen', now(), now()),
('Artikelbeschreibung: Namen des Attributmerkmales unter dem Attributbild anzeigen', 'PRODUCT_IMAGES_ATTRIBUTES_NAMES', 43, 'Soll der Name des Attributmerkmales unter dem Attributbild angezeigt werden?<br />0 = nein<br>1 = ja', now(), now()),
('Artikelbeschreibung: Anzeigen der Differenz der Preisreduktion ("sie sparen...")', 'SHOW_SALE_DISCOUNT_STATUS', 43, 'Soll die Differenz der Preisreduktion ("sie sparen...) angezeigt werden?<br />0 = nein 1 = ja', now(), now()),
('Artikelbeschreibung: Anzeige der Preisreduktion in Währung oder Prozent', 'SHOW_SALE_DISCOUNT', 43, 'Zeige die Preisreduktion an in:<br />1 = %<br />2 = Betrag', now(), now()),
('Artikelbeschreibung: Dezimalstellen bei Anzeige der Preisreduktion in Prozent', 'SHOW_SALE_DISCOUNT_DECIMALS', 43, 'Wieviel Dezimalstellen sollen bei Anzeige der Preisreduktion in Prozent dargestellt werden?<br />Standard= 0', now(), now()),
('Artikelbeschreibung: Kostenlose Artikel als Bild oder Text darstellen', 'OTHER_IMAGE_PRICE_IS_FREE_ON', 43, 'Soll "Artikel ist kostenlos" als Bild oder Text dargestellt werden?<br />0 = Text<br />1 = Bild', now(), now()),
('Artikelbeschreibung: "für Preis bitte anrufen" als Bild oder Text darstellen', 'PRODUCTS_PRICE_IS_CALL_IMAGE_ON', 43, 'Soll "für Preis bitte anrufen" als Bild oder Text dargestellt werden?<br />0 = Text<br />1 = Bild', now(), now()),
('Artikelanzahl: Bei neuen Artikel aktiviert', 'PRODUCTS_QTY_BOX_STATUS', 43, 'Wie soll die Box der Artikelanzahl für den Warenkorb bei neuen Artikel standardmässig eingestellt sein?<br /><br />0 = aus<br />1 = ein<br /><br />Hinweis:<br />EIN<br />Diese Option zeigt eine Box, die dem Kunden die Möglichkeit zur Eingabe der Artikelanzahl im Warenkorb anzeigt<br />AUS<br />Die Artikelanzahl wird auf nur "1" gesetzt, ohne der Möglichkeit zur Änderung der Artikelanzahl im Warenkorb', now(), now()),
('Artikelbewertungen benötigen Überprüfung', 'REVIEWS_APPROVAL', 43, 'Sollen Artikelbewertungen erst nach einer Überprüfung freigegeben werden?<br /><br />HINWEIS: Wenn der Bewertungsstatus deaktiviert ist, wird diese Option nicht aktiv<br /><br />0 = nein<br>1 = ja', now(), now()),
('Meta Tags: Artikelnummer im Titel integrieren', 'META_TAG_INCLUDE_MODEL', 43, 'Soll die Artikelnummer im Meta Tag Titel integriert werden?<br /><br />0 = nein<br>1 = ja', now(), now()),
('Meta Tags: Artikelpreis im Titel integrieren', 'META_TAG_INCLUDE_PRICE', 43, 'Soll der Artikelpreis im Meta Tag Titel integriert werden?<br /><br />0 = nein<br>1= ja', now(), now()),
('Max. Anzahl Wörter für Metatag "description"', 'MAX_META_TAG_DESCRIPTION_LENGTH', 43, 'Maximale Anzahl Wörter für Description Metatag.<br> Voreinstellung: 50', now(), now()),
('Artikelbeschreibung: Anzahl empfohlener Artikel pro Zeile ', 'SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS', 43, 'Anzahl empfohlener Artikel die pro Zeile angezeigt werden sollen', now(), now()),
('"Vorheriger - Nächster" Navigation: Position der Navigationsleite', 'PRODUCT_INFO_PREVIOUS_NEXT', 43, 'Geben Sie hier an, wo die "Vorheriger - Nächster" Navigation angezeigt werden soll<br />0 = Off (nicht anzeigen)<br />1 = Top of Page (oben auf der Seite anzeigen)<br />2 = Bottom of Page (unten auf der Seite anzeigen)<br />3 = Both Top & Bottom of Page (oben und unten auf der Seite anzeigen', now(), now()),
('"Vorheriger - Nächster" Navigation: Sortierung der Artikel', 'PRODUCT_INFO_PREVIOUS_NEXT_SORT', 43, 'Geben Sie hier an, wie die Artikel in der "Vorheriger - Nächster" Navigation sortiert werden sollen<br />0 = Product ID (Artikel ID)<br />1 = Name (Artikelname)<br />2 = Product Model (Artikelnummer)<br />3 = Product Price - Name (Preis, Artikelname)<br />4 = Product Price - Model (Preis, Artikelnummer)<br />5 = Product Name - Model (Artikelname, Artikelnummer)<br />6 = Product Sort Order (Artikelsortierung)', now(), now()),
('"Vorheriger - Nächster" Navigation: Button und Artikelbilder', 'SHOW_PREVIOUS_NEXT_STATUS', 43, 'Sollen Buttons und Artikelbilder angezeigt werden?<br />0 = Off (nein)<br />1 = On (ja)', now(), now()),
('"Vorheriger - Nächster" Navigation: Button und Artikelbilder - Einstellungen', 'SHOW_PREVIOUS_NEXT_IMAGES', 43, 'Wie sollen Buttons und Artikelbilder angezeigt werden?<br />0 = Buttons Only (nur Buttons)<br />1 = Button and Product Image (Buttons und Artikelbilder)<br />2 = Product Image Only (nur Artikelbilder)', now(), now()),
('"Vorheriger - Nächster" Navigation: Breite der Bilder', 'PREVIOUS_NEXT_IMAGE_WIDTH', 43, 'Geben Sie die Breite der Artikelbilder (in Pixel) an', now(), now()),
('"Vorheriger - Nächster" Navigation: Höhe der Bilder', 'PREVIOUS_NEXT_IMAGE_HEIGHT', 43, 'Geben Sie die Höhe der Artikelbilder (in Pixel) an', now(), now()),
('"Vorheriger - Nächster" Navigation: Kategorien anzeigen', 'PRODUCT_INFO_CATEGORIES', 43, 'Wie sollen Artikelkategorien, Kategoriebilder und Kategorienamen oberhalb der "Vorheriger - Nächster" Navigation angezeigt werden?<br />0 = Off (nicht anzeigen)<br />1 = Align Left (Linksausrichtung)<br />2 = Align Center (Zentriert)<br />3 = Align Right (Rechtsausrichtung)', now(), now()),
('"Vorheriger - Nächster" Navigation: Kategoriebezeichnung und -Bild anzeigen', 'PRODUCT_INFO_CATEGORIES_IMAGE_STATUS', 43, 'Wie sollen Kategoriename und Kategoriebild angezeigt werden?<br />0 = Category name and Image Always (Kategoriename und -Bild immer anzeigen)<br />1 = Category Name Only (Nur Kategoriename)<br />2 = Category Name and Image when not blank (Kategoriename und -Bild falls vorhanden)', now(), now()),

# Adminmenü ID 19 - Layouteinstellungen
('Spaltenbreite: Linke Boxen', 'BOX_WIDTH_LEFT', 43, 'Die Breite der linken Boxen<br />"px" kann mit angegeben werden<br /><br />Standard = 150px', now(), now()),
('Spaltenbreite: Rechte Boxen', 'BOX_WIDTH_RIGHT', 43, 'Die Breite der rechten Boxen<br />"px" kann mit angegeben werden<br /><br />Standard = 150px', now(), now()),
('"Brotkrümel" Navigation (Bread Crumbs): Separator', 'BREAD_CRUMBS_SEPARATOR', 43, 'Geben Sie hier das Symbol für den Separator für die sog. Brotkrümel Navigation ein<br />HINWEIS: Leerzeichen müssen mit "& " angegeben.<br />Standard = & ::& ', now(), now()),
('"Brotkrümel" Navigationpfad anzeigen', 'DEFINE_BREADCRUMB_STATUS', 43, 'Soll ein Navigationspfad angezeigt werden?<br />0= AUS<br />1= EIN<br>2= EIN aber nicht auf der Startseite', now(), now()),
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
('Unterkategorien anzeigen?', 'SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS', 43, 'Sollen Unterkategorien im Navigationsmenü angezeigt werden, wenn die Hauptkategorie selektiert ist?<br>0=AUS<br>1=EIN', now(), now()),
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
('Kategorie/Artikel Sortierung', 'CATEGORIES_PRODUCTS_SORT_ORDER', 43, 'Kategorie/Artikel Sortierung<br><br>0= Kategorie/Artikel Sortierung/Name<br>1= Kategorie/Artikel Name<br>2= Artikelnummer<br>3= Artikelmenge aufsteigend, Artikelname<br>4= Artikelmenge abteigend, Artikelname<br>5= Artikelpreis aufsteigend, Artikelname<br>6= Artikelpreis absteigend, Artikelname<br>', now(), now()),
('Globale Attributfunktionen - Hinzufügen, Kopieren und Löschen   ', 'OPTION_NAMES_VALUES_GLOBAL_STATUS', 43, 'Globale Attributfunktionen (Attributname und Attributmerkmale) - Hinzufügen, Kopieren und Löschen<br><br>0= nicht Verfügbar<br>1= Verfügbar<br>2= Artikelnummer', now(), now()),
('Kategorie-Tabs Menü EIN/AUS', 'CATEGORIES_TABS_STATUS', 43, 'Kategorie-Tabs<br />Zeigt die Toplevel Kategorien unterhalb des Banners an. <br />0= Kategorie Tabs AUS<br />1= Kategorie Tabs EIN', now(), now()),
('Sitemap - Link für "Mein Konto" inkludieren', 'SHOW_ACCOUNT_LINKS_ON_SITE_MAP', 43, 'Soll der Link für "Mein Konto" in der Sitemap inkludiert werden?<br /><br />Standard: false', now(), now()),
('Überspringe Kategorien mit einem Artikel', 'SKIP_SINGLE_PRODUCT_CATEGORIES', 43, 'Überspringe Kategorien mit einem Artikel<br />Wenn true dann wird bei Klick auf die Kategorie gleich direkt die Artikelansicht angezeigt.<br />Standard: True', now(), now()),
('Anmeldeseite geteilt anzeigen', 'USE_SPLIT_LOGIN_MODE', 43, 'Die Anmeldeseite kann in zwei Varianten angezeigt werden: Geteilt oder vertikal.<br />Die geteilte Variante zeigt neben der Felder für die Anmeldung einen Text und einen "Neues Konto erstellen" Button, der auf die Seite zur <em>Kontoerstellung</em> weiterleitet. In der vertikalen Variante werden alle Felder zur Kontoerstellung unterhalb der Felder für die Anmeldung angezeigt.<br />Für die Verwendung von Paypal Express Checkout sollte diese Einstellung immer auf True bleiben!<br>Voreinstellung: True', now(), now()),
('CSS Schaltflächen im Frontend', 'IMAGE_USE_CSS_BUTTONS', 43, 'CSS Schaltflächen im Frontend<br />CSS Schaltflächen anstelle von Bildbuttons im Shop verwenden (GIF/JPG)?<br />CSS Schaltflächen-Stile müssen in den Stylesheets definiert werden.', now(), now()),
('CSS Schaltflächen im Admin', 'ADMIN_USE_CSS_BUTTONS', 43, 'CSS Schaltflächen im Admin<br />CSS Schaltflächen anstelle von Bildbuttons in der Shopadministration verwenden?', now(), now()),

# Adminmenü ID 20 - Shopwartung
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


# Adminmenü ID 21 - Liste Neue Artikel
('Bild anzeigen', 'PRODUCT_NEW_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Stückzahl anzeigen', 'PRODUCT_NEW_LIST_QUANTITY', 43, 'Wollen Sie die Artikelstückzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Jetzt kaufen" - Button anzeigen', 'PRODUCT_NEW_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelname anzeigen', 'PRODUCT_NEW_LIST_NAME', 43, 'Wollen Sie den Artikelnamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_NEW_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Herstellernamen anzeigen', 'PRODUCT_NEW_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Preis anzeigen', 'PRODUCT_NEW_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Gewicht anzeigen', 'PRODUCT_NEW_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Hinzufügt am" anzeigen', 'PRODUCT_NEW_LIST_DATE_ADDED', 43, 'Wollen Sie "Hinzugefügt am" in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_NEW_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', now(), now()),
('Standardsortierung', 'PRODUCT_NEW_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzufügedatum, absteigend<br />7= nach Hinzufügedatum, aufsteigend<br />8= nach ArtikelSortierung', now(), now()),
('Gruppen ID für "neue Artikel"', 'PRODUCT_NEW_LIST_GROUP_ID', 43, 'WARNUNG: Ändern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 21 geändert wurde<br />Wie lautet die configuration_group_id für die "neue Artikel" Liste?', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br><br>0= NEIN<br>1= Oben<br>2= Unten<br>3= Oben und Unten', now(), now()),
('Artikelankündigungen als Neue Artikel anzeigen', 'SHOW_NEW_PRODUCTS_UPCOMING_MASKED', 43, 'Sollen Artikelankündigungen in Artikellisten, Seitenboxen und Centerboxen als neue Artikel angezeigt werden?<br />0= Nein<br />1= Ja', now(), now()),

# Adminmenü ID 22 Liste Empfohlene Artikel
('Bild anzeigen', 'PRODUCT_FEATURED_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Stückzahl anzeigen', 'PRODUCT_FEATURED_LIST_QUANTITY', 43, 'Wollen Sie die Artikelstückzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Jetzt kaufen" - Button anzeigen', 'PRODUCT_FEATURED_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelname anzeigen', 'PRODUCT_FEATURED_LIST_NAME', 43, 'Wollen Sie den Artikelnamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_FEATURED_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Herstellernamen anzeigen', 'PRODUCT_FEATURED_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Preis anzeigen', 'PRODUCT_FEATURED_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Gewicht anzeigen', 'PRODUCT_FEATURED_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Hinzugefügt am" anzeigen', 'PRODUCT_FEATURED_LIST_DATE_ADDED', 43, 'Wollen Sie "Hinzugefügt am" in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_FEATURED_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', now(), now()),
('Standardsortierung', 'PRODUCT_FEATURED_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzufügedatum, absteigend<br />7= nach Hinzufügedatum, aufsteigend<br />8= nach ArtikelSortierung', now(), now()),
('Gruppen ID für "Empfohlene Artikel"', 'PRODUCT_FEATURED_LIST_GROUP_ID', 43, 'WARNUNG: Ändern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 22 geändert wurde<br />Wie lautet die configuration_group_id für die "Empfohlenen Artikel" Liste?', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br><br>0= NEIN<br>1= Oben<br>2= Unten<br>3= Oben und Unten', now(), now()),

# Adminmenü ID 23 - Liste Alle Artikel
('Bild anzeigen', 'PRODUCT_ALL_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Stückzahl anzeigen', 'PRODUCT_ALL_LIST_QUANTITY', 43, 'Wollen Sie stückzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Jetzt kaufen" - Button anzeigen', 'PRODUCT_ALL_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelname anzeigen', 'PRODUCT_ALL_LIST_NAME', 43, 'Wollen Sie den Artikelname in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_ALL_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Herstellernamen anzeigen', 'PRODUCT_ALL_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Preis anzeigen', 'PRODUCT_ALL_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Gewicht anzeigen', 'PRODUCT_ALL_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Hinzugefügt am" Datum anzeigen', 'PRODUCT_ALL_LIST_DATE_ADDED', 43, 'Wollen Sie das "Hinzugefügt am" Datum in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_ALL_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', now(), now()),
('Standardsortierung', 'PRODUCT_ALL_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzufügedatum, absteigend<br />7= nach Hinzufügedatum, aufsteigend<br />8= nach ArtikelSortierung', now(), now()),
('Gruppen ID für "Alle Artikel"', 'PRODUCT_ALL_LIST_GROUP_ID', 43, 'WARNUNG: Ändern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 23 geändert wurde<br />Wie lautet die configuration_group_id für die "Alle Artikel" Liste?', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br><br>0= NEIN<br>1= Oben<br>2= Unten<br>3= Oben und Unten', now(), now()),

# Adminmenü ID 24 - Liste Artikelindex
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

# Adminmenü ID 25 Eigene Seiten/Define Pages
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

# Adminmenü ID 30 - EZ Page Einstellungen
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

# Adminmenü ID 31 - Minify
('Minify für Javascripts aktivieren', 'MINIFY_STATUS_JS', 43, 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. Javascripts werden kombiniert und komprimiert. Wollen Sie Minify für Javascripts aktivieren?<br>HINWEIS: Achten Sie darauf, dass das Verzeichnis cache/minify Schreibrechte (chmod 777) hat!', now(), now()),
('Minify für Stylesheets aktivieren', 'MINIFY_STATUS_CSS', 43, 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. CSS Dateien werden kombiniert und komprimiert. Wollen Sie Minify für CSS Stylesheets aktivieren?<br>HINWEIS: Achten Sie darauf, dass das Verzeichnis cache/minify Schreibrechte (chmod 777) hat!', now(), now()),
('Maximale URL Länge', 'MINIFY_MAX_URL_LENGHT', 43, 'Auf manchen Servern ist die Länge von POST/GET URLs beschränkt. Falls das auf Ihren Server zutrifft, können Sie hier den Wert verändern. Voreingestellt: 500', now(), now()),
('Minify Cache Zeit', 'MINIFY_CACHE_TIME_LENGHT', 43, 'Stellen Sie hier die Cache Zeit für Minify ein. Voreingestellt ist ein Jahr (31536000)', now(), now()),
('zuletzt gecached', 'MINIFY_CACHE_TIME_LATEST', 43, 'Hier müssen Sie normalerweise nichts einstellen. Falls Sie gerade Änderungen an Ihren CSS und Javascripts vorgenommen haben und erzwingen wollen, dass diese Änderungen sofort wirksam sind, stellen Sie auf 0.', now(), now()),

# Adminmenü ID 32 - Spamschutz
('Spamschutz', 'SPAM_VERSION', 43, 'Seit Version 1.5.7 ist in der deutschen Zen Cart Version ein verbesserter Honeypot Spamschutz integriert. Die Seiten Kontakt, Registrierung, Frage zum Artikel und Bewertung schreiben sind mit 2 zusätzlichen versteckten Formularfeldern ausgestattet. Spambots versuchen alle vorhandenen Formularfelder auszufüllen, werden versteckte ausgefüllt, kann es sich nur um Spam handeln. Damit Spambots die Namen der versteckten Felder nicht in ihre Listen aufnehmen können, werden die Namen dieser Felder automatisch regelmäßig gewechselt in dem Zeitrahmen, den Sie unten einstellen.<br>Das ist eine deutliche Verbesserung gegenüber älteren Zen Cart Versionen, bitte beachten Sie aber, dass auch diese Lösung keinen 100% Spamschutz bieten kann.<br>Sollten Sie weiterhin Spam über die Shop Kontaktformulare bekommen, müssen Sie die Formulare mit einem echten Captcha absichern.', now(), now()),
('Name des versteckten Input Feldes', 'SPAM_TEST_TEXT', 43, 'Aktueller Name des versteckten Input Feldes', now(), now()),
('Name des versteckten Radio Buttons', 'SPAM_TEST_USER', 43, 'Aktueller Name des versteckten Radio Buttons', now(), now()),
('Anzahl der Tage für den Namenswechsel', 'SPAM_CHANGE_DAYS', 43, 'Stellen Sie hier die Anzahl der Tage ein, nach denen die oben benannten Felder automatisch umbenannt werden sollen.<br/>Voreinstellung: 10', now(), now()),

# Adminmenü ID 33 - Open Graph / Microdata
('Open Graph - Open Graph aktivieren', 'FACEBOOK_OPEN_GRAPH_STATUS', 43, 'Wollen Sie die Open Graph/Microdaten aktivieren?', now(), now()),
('Open Graph - Anwendungsnummer', 'FACEBOOK_OPEN_GRAPH_APPID', 43, 'Tragen Sie hier Ihre Anwendungsnummer / Application ID ein. Falls Sie noch keine haben:<br><a href="http://developers.facebook.com/setup/" target="_blank">Application ID beantragen</a>', now(), now()),
('Open Graph - Anwendungs Geheimcode', 'FACEBOOK_OPEN_GRAPH_APPSECRET', 43, 'Tragen Sie Ihren Anwendungs Geheimcode / Application Secret Key ein.', now(), now()),
('Open Graph - Admin ID', 'FACEBOOK_OPEN_GRAPH_ADMINID', 43, 'Geben Sie die Admin ID(s) des oder der Facebook User an, die Ihre Facebook Fanseite administrieren. Wenn das mehrere sind, geben Sie die IDs mit Komma getrennt ein. Infos dazu:<br><a href="http://www.facebook.com/insights/" target="_blank">Insights for your domain</a>', now(), now()),
('Open Graph - Standard Bild', 'FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE', 43, 'Geben Sie den vollen Pfad zu einem Standardbild an oder lassen Sie dieses Feld leer, um kein Standardbild zu verwenden. Ein hier eingestelltes Standardbild wird nur verwendet, wenn kein Artikelbild gefunden wird und stellt so sicher, dass zumindest ein passendes Bild bei Facebook gepostet wird.', now(), now()),
('Open Graph - Objekt Typ', 'FACEBOOK_OPEN_GRAPH_TYPE', 43, 'Geben Sie hier einen Open Graph Object Type für Ihre Artikel ein. Beispiel: product<br>Infos dazu:<br><a href="https://developers.facebook.com/docs/reference/opengraph/" target="_blank">Open Graph Object Types</a>', now(), now()),
('Open Graph - Kategoriepfad in den URLs?', 'FACEBOOK_OPEN_GRAPH_CPATH', 43, 'Sollen Ihre URLs für Facebook den cPath enthalten?', now(), now()),
('Open Graph - Sprache in den Links?', 'FACEBOOK_OPEN_GRAPH_LANGUAGE', 43, 'Sollen Ihre URLs das Anhängsel für die Sprache enthalten?', now(), now()),
('Open Graph - Kanonische URLs verwenden?', 'FACEBOOK_OPEN_GRAPH_CANONICAL', 43, 'Wollen Sie die kanonische URL der Seite verwenden (empfohlen) oder versuchen, die URL neu zu generieren?', now(), now()),
('Open Graph - Google Publisher', 'FACEBOOK_OPEN_GRAPH_GOOGLE_PUBLISHER', 43, 'Tragen Sie den vollständigen Link zu Ihrer Google Publisher / Google Plus URL ein  (https://plus.google.com/+xxx/)', now(), now()),
('Open Graph - Shoplogo', 'FACEBOOK_OPEN_GRAPH_LOGO', 43, 'Tragen Sie den vollständigen Link zu Ihrem Shoplogo ein, das für die Microdaten verwendet werden soll. Das Bild sollte per https erreichbar sein!  (https://www.meinshop.de/shoplogo.png)', now(), now()),
('Open Graph - Adresse des Shops - Strasse', 'FACEBOOK_OPEN_GRAPH_STREET_ADDRESS', 43, 'Tragen Sie die Strasse Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - Stadt', 'FACEBOOK_OPEN_GRAPH_CITY', 43, 'Tragen Sie die Stadt Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - Bundesland', 'FACEBOOK_OPEN_GRAPH_STATE', 43, 'Tragen Sie das Bundesland Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - PLZ', 'FACEBOOK_OPEN_GRAPH_ZIP', 43, 'Tragen Sie die Postleitzahl Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - Land', 'FACEBOOK_OPEN_GRAPH_COUNTRY', 43, 'Tragen Sie das Land Ihres Shops ein. Zweistelliger Ländercode, z.B. DE', now(), now()),
('Open Graph - Emailadresse Kundensevice', 'FACEBOOK_OPEN_GRAPH_EMAIL', 43, 'Tragen Sie die Emailadresse Ihres Kundenservice ein.', now(), now()),
('Open Graph - Telefonnummer Kundenservice', 'FACEBOOK_OPEN_GRAPH_PHONE', 43, 'Tragen Sie die Telefonnummer Ihres Kundenservice ein.', now(), now()),
('Open Graph - Twitter User', 'FACEBOOK_OPEN_GRAPH_TWUSER', 43, 'Tragen Sie Ihren Twitter Usernamen ein mit @ davor.<br>Bsp: @meintwitteruser.', now(), now()),
('Open Graph - Facebook Page', 'FACEBOOK_OPEN_GRAPH_FBPG', 43, 'Tragen Sie die volle URL zu Ihrer Facebook Page ein.<br>Bsp: https://www.facebook.com/meinonlineshop', now(), now()),
('Open Graph - Sprache', 'FACEBOOK_OPEN_GRAPH_LOCALE', 43, 'Tragen Sie Ihre Hauptsprache ein.<br>Voreinstellung: German', now(), now()),
('Open Graph - Währung', 'FACEBOOK_OPEN_GRAPH_CUR', 43, 'Tragen Sie Ihre Währung ein ein.<br>Voreinstellung: EUR', now(), now()),
('Open Graph - Lieferzeit', 'FACEBOOK_OPEN_GRAPH_DTS', 43, 'Tragen Sie Ihre durchschnittliche Lieferzeit in Tagen ein.<br>Bsp: 2', now(), now()),
('Open Graph - Zustand der Artikel', 'FACEBOOK_OPEN_GRAPH_COND', 43, 'Tragen Sie den Zustand Ihrer Artikel ein.<br>Mögliche Werte: NewCondition, UsedCondition, RefurbishedCondition, DamagedCondition', now(), now()),
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
('Open Graph - Region', 'FACEBOOK_OPEN_GRAPH_AREA', 43, 'Optional. Die geografische Region, die durch die Nummer bedient wird, die als Schema. org/Administrationsbereich angegeben ist. Länder können, wie in den Beispielen rechts gezeigt, nur mit ihrem Standard ISO-3166-Zweibuchstabencode präzise spezifiziert werden. Wenn diese Angabe weggelassen wird, wird davon ausgegangen, dass die Zahl global ist...', now(), now()),
('Open Graph - Twitter Page', 'FACEBOOK_OPEN_GRAPH_TWIT', 43, 'Tragen Sie die vollständige URL zu Ihrer Twitter Seite ein.<br>Beispiel: https://twitter.com/xxx', now(), now()),
('Open Graph - Linkedin Page', 'FACEBOOK_OPEN_GRAPH_LINK', 43, 'Tragen Sie die vollständige URL zu Ihrer LinkedIn Page ein.<br>Beispiel: http://www.linkedin.com/company/xxx/.', now(), now()),
('Open Graph - Weitere Profil Page', 'FACEBOOK_OPEN_GRAPH_PROF1', 43, 'Tragen Sie die vollständige URL zu einer weiteren Profil Seite ein, die Sie nutzen.<br>Beispiel: https://www.dandb.com/businessdirectory/xxx.html', now(), now()),
('Open Graph - Weitere Profil Page 2', 'FACEBOOK_OPEN_GRAPH_PROF2', 43, 'Tragen Sie die vollständige URL zu einer weiteren Profil Seite ein, die Sie nutzen.<br>Beispiel: http://www.yelp.com/biz/xxx', now(), now()),
('Open Graph - Belieferte Regionen', 'FACEBOOK_OPEN_GRAPH_ELER', 43, 'Der ISO 3166-1 (ISO 3166-1 alpha-2) oder ISO 3166-2 Code, oder die GeoShape für die geopolitische(n) Region(en), für die die Angebots- oder Lieferkostenangabe gültig ist. Wie z.B. US ', now(), now()),

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
('RSS - Default Feed', 'RSS_DEFAULT_FEED', 43, 'RSS Default Feed - Standardwert Neue Artikel', now(), now()),
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
('<b>Zen Colorbox</b>', 'ZEN_COLORBOX_STATUS', 43, 'Wollen Sie für die Vergrösserung Ihrer Artikelbilder einen Lightboxeffekt nutzen?<br><br>Voreinstellung = true<br>', now(), now()),
('Overlay Transparenz', 'ZEN_COLORBOX_OVERLAY_OPACITY', 43, 'Gewünschte Transparenz des Overlays<br><br>Voreinstellung = 0.6<br>', now(), now()),
('Dauer der Bildvergrösserung', 'ZEN_COLORBOX_RESIZE_DURATION', 43, 'Geschwindigkeit in Millisekunden<br><br>Voreinstellung = 400<br>', now(), now()),
('Anfangs Bildbreite', 'ZEN_COLORBOX_INITIAL_WIDTH',  43, 'Breite des Artikelbildes beim ersten Aufruf<br><br>Voreinstellung = 250<br>', now(), now()),
('Anfangs Bildhöhe', 'ZEN_COLORBOX_INITIAL_HEIGHT', 43, 'Höhe des Artikelbildes beim ersten Aufruf<br><br>Voreinstellung = 250<br>', now(), now()),
('Bildzähler anzeigen', 'ZEN_COLORBOX_COUNTER', 43, 'Soll innerhalb der Lightbox eine Anzeige zur Anzahl der Bilder erscheinen?<br><br>Voreinstellung = true<br>', now(), now()),
('Beim Click aufs Overlay schliessen?', 'ZEN_COLORBOX_CLOSE_OVERLAY', 43, 'Soll die Lightbox beim Clicken auf das Overlay geschlossen werden?<br><br>Voreinstellung = false<br>', now(), now()),
('Loop', 'ZEN_COLORBOX_LOOP', 43, 'Wenn auf true gestellt vergrößern sich die Bilder in beide Richtungen<br><br>Voreinstellung = true<br>', now(), now()),
('<b>Slideshow</b>', 'ZEN_COLORBOX_SLIDESHOW',  43, 'Sollen die zusätzlichen Artikelbilder in einer Slideshow angezeigt werden?<br><br>Voreinstellung = false<br>', now(), now()),
('&nbsp; Slideshow Autostart', 'ZEN_COLORBOX_SLIDESHOW_AUTO', 43, 'Slideshow automatisch starten?<br><br>Voreinstellung = true<br>', now(), now()),
('&nbsp; Slideshow Geschwindigkeit', 'ZEN_COLORBOX_SLIDESHOW_SPEED', 43, 'Geschwindigkeit der Slideshow in Millisekunden<br><br>Voreinstellung = 2500<br>', now(), now()),
('&nbsp; Slideshow Start Text', 'ZEN_COLORBOX_SLIDESHOW_START_TEXT', 43, 'Text des Links zum Starten der Slideshow<br><br>Voreinstellung = start slideshow<br>', now(), now()),
('&nbsp; Slideshow Stop Text', 'ZEN_COLORBOX_SLIDESHOW_STOP_TEXT', 43, 'Text des Links zum Stoppen der Slideshow<br><br>Voreinstellung = stop slideshow<br>', now(), now()),
('<b>Galerie Modus</b>', 'ZEN_COLORBOX_GALLERY_MODE', 43, 'Sollen die zusätzlichen Artikelbilder in einer Galerie zum Durchblättern erscheinen<br><br>Voreinstellung = true<br>', now(), now()),
('&nbsp; Hauptbild in Galerie aufnehmen?', 'ZEN_COLORBOX_GALLERY_MAIN_IMAGE', 43, 'Soll das Hauptartikelbild Bestandteil der Galerieansicht sein?<br><br>Voreinstellung = true<br>', now(), now()),
('<b>EZ-Pages Unterstützung</b>', 'ZEN_COLORBOX_EZPAGES', 43, 'Soll der Lightbox Effekt auch auf Bilder in den EZ Pages angewandt werden?<br><br>Voreinstellung = true<br>', now(), now()),
('&nbsp; Dateitypen', 'ZEN_COLORBOX_FILE_TYPES', 43, 'Auf den EZ-Pages wird der Lightbox Effekt auf alle Bilder mit folgenden Dateitypen angewandt:<br><br>Voreinstellung = jpg,png,gif<br>', now(), now()),


# Adminmenü ID 36 - IT Recht Kanzlei
('Version', 'IT_RECHT_KANZLEI_MODUL_VERSION', 43, 'Installierte Version:', now(), now()),
('IT Recht Kanzlei - Ist das Modul aktiv?', 'IT_RECHT_KANZLEI_STATUS', 43, 'Wollen Sie die Schnittstelle der IT Recht Kanzlei aktivieren?<br>Bitte erst dann aktivieren, wenn Sie sich mit der Funktionsweise vertraut gemacht haben.', now(), now()),
('IT Recht Kanzlei - API Token', 'IT_RECHT_KANZLEI_TOKEN', 43, 'Authentifizierungs-Token den Sie zur Übertragung im Mandantenportal der IT-Recht Kanzlei angeben.<br>Diese Token können Sie hier nicht ändern. Falls Sie eine neue Token erstellen wollen, nutzen Sie dazu die entsprechende Option unter Tools > IT Recht Kanzlei.', now(), now()),
('IT Recht Kanzlei - API Version', 'IT_RECHT_KANZLEI_VERSION',  43, 'API Version der IT Recht Kanzlei Schnittstelle', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext AGB', 'IT_RECHT_KANZLEI_PAGE_KEY_AGB', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die AGB angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die AGB automatisch eingefügt.<br>Voreinstellung: itrk-agb', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Datenschutzerklärung', 'IT_RECHT_KANZLEI_PAGE_KEY_DATENSCHUTZ', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Datenschutzerklärung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Datenschutzerklärung automatisch eingefügt<br>Voreinstellung: itrk-datenschutz.', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Widerrufsbelehrung', 'IT_RECHT_KANZLEI_PAGE_KEY_WIDERRUF', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Widerrufsbelehrung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Widerrufsbelehrung automatisch eingefügt<br>Voreinstellung: itrk-widerruf.', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Impressum', 'IT_RECHT_KANZLEI_PAGE_KEY_IMPRESSUM', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für das Impressum angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für das Impressum automatisch eingefügt.<br>Voreinstellung: itrk-impressum', now(), now()),
('IT Recht Kanzlei - AGB auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_AGB',  43, 'Sollen die AGB auch als pdf verfügbar sein?', now(), now()),
('IT Recht Kanzlei - Datenschutzerklärung auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_DATENSCHUTZ', 43, 'Soll die Datenschutzerklärung auch als pdf verfügbar sein?', now(), now()),
('IT Recht Kanzlei - Widerrufsbelehrung auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_WIDERRUF', 43, 'Soll die Widerrufsbelehrung auch als pdf verfügbar sein?', now(), now()),
('IT Recht Kanzlei - Speicherort der pdf Dateien', 'IT_RECHT_KANZLEI_PDF_FILE', 43, 'In welchem Ordner am Server sollen die pdf Dateien gespeichert werden?<br>Lassen Sie diese Einstellung auf includes/pdf, damit das Modul pdf Rechnung falls installiert auf die pdfs zugreifen kann.', now(), now()),

# Adminmenü ID 37 - pdf Rechnung
('Version', 'RL_INVOICE3_MODUL_VERSION', 43, 'Installierte Version:', now(), now()),
('pdf Rechnung - Status', 'RL_INVOICE3_STATUS', 43, 'Wollen Sie das Modul pdf Rechnung aktivieren?<br>In der Administration können Sie auch pdf Rechnungen erstellen, wenn Sie hier auf false stellen. Um die Funktionalität des Mitsendens von Rechnung und Anhängen in den Mails zu nutzen, müssen Sie aber hier auf true stellen.<br>Aktivieren Sie das Modul erst dann, wenn Sie Ihre Rechnungsvorlage und Anhänge wie AGB und Widerruf erstellt haben und sich mit der Funktionalität vertraut gemacht haben.', now(), now()),
('pdf Rechnung - Rechnungsdatum = Bestelldatum?', 'RL_INVOICE3_ORDERDATE', 43, 'Soll das Rechnungsdatum das Datum der Bestellung sein (true) oder das Datum, an dem die pdf Rechnung erzeugt wird? (false)', now(), now()),
('pdf Rechnung - Kundennummer auf der Rechnung?', 'RL_INVOICE3_CUSTOMERID', 43, 'Wollen Sie die Kundennummer auf der pdf Rechnung anzeigen?', now(), now()),
('pdf Rechnung - Lieferadresse anzeigen?', 'RL_INVOICE3_SHIPPING_ADDRESS', 43, 'Wollen Sie die Lieferadresse auf der pdf Rechnung anzeigen?', now(), now()),
('pdf Rechnung - XY-Position der Adresse1', 'RL_INVOICE3_ADDRESS1_POS', 43, 'XY-Position der Adresse1; es ist das Delta zu den Rändern einzugeben<br />Standard: 89|21', now(), now()),
('pdf Rechnung - XY-Postion der Adresse2', 'RL_INVOICE3_ADDRESS2_POS', 43, 'XY-Postion der Adresse2; es ist das Delta zu den Rändern einzugeben<br />Standard: 0|21', now(), now()),
('pdf Rechnung - Rändereinstellungen für Adresse1|2', 'RL_INVOICE3_ADDRESS_BORDER', 43, 'Rändereinstellungen für Adresse1|2<br />LTRB (Left Top Right Bottom)<br />Standard: |<br />Es wird also kein Rahmen um die Adressen angezeigt. Wollen Sie um die Adressen einen vollständigen Rahmen anzeigen, dann ändern Sie auf LTRB|LTRB', now(), now()),
('pdf Rechnung - Breite von Adressfeld1|2', 'RL_INVOICE3_ADDRESS_WIDTH', 43, '<br />Standard: 80|80', now(), now()),
('pdf Rechnung - Deltas', 'RL_INVOICE3_DELTA', 43, 'Abstand Adresse:Rechnungsnummer | Abstand Rechnungsnummer:Produktliste<br />Standard: 5|8<br />', now(), now()),
('pdf Rechnung - Schriftarten für Rechnung und Artikel', 'RL_INVOICE3_FONTS', 43, 'Welche Schriftarten wollen Sie verwenden? <br />1. Für Rechnungstexte <br >2. Für Artikel und Summe<br /><br />Standard: myriadpc|myriadpc<br />(Pfad/und Schriftart für Rechnung|Pfad/und Schriftart für Artikel und Summe<br />', now(), now()),
('pdf Rechnung - Zeilenhöhe', 'RL_INVOICE3_LINE_HEIGT', 43, 'Zeilenhöhe', now(), now()),
('pdf Rechnung - Dicke der Striche bei Gesamtsumme', 'RL_INVOICE3_LINE_THICK', 43, 'Wie dick soll der Strich bei der Gesamtsumme sein?', now(), now()),
('pdf Rechnung - Rändereinstellungen', 'RL_INVOICE3_MARGIN', 43, 'Format: oben|rechts|unten|links<br />(Hinweis: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />Standard: 20|20|20|20<br />', now(), now()),
('pdf Rechnung - Rechnung bei Gratisprodukt', 'RL_INVOICE3_NOT_NULL_INVOICE', 43, 'Soll die Rechnung auch bei einem Gratisprodukt dem Mail hinzugefügt werden?', now(), now()),
('pdf Rechnung - Rechnungsversand bei Bestellstatus', 'RL_INVOICE3_ORDERSTATUS', 43, 'Rechnung nur mitschicken, wenn der Bestellstatus grösser/gleich ist [default: 3 == verschickt]', now(), now()),
('pdf Rechnung - Präfix für Rechnungsnummer in der Rechnung', 'RL_INVOICE3_ORDER_ID_PREFIX', 43, 'Präfix für Rechnungsnummer in der Rechnung<br />Beispiel: : 2022/<br />', now(), now()),
('pdf Rechnung - Papiergrösse|Einheit|Orientierung', 'RL_INVOICE3_PAPER', 43, '1. Papiergrösse = A3|A4|A5|Letter|Legal <br />2. Einheit: pt|mm|cm|inch <br />3. Orientierung: L|P<br />', now(), now()),
('pdf Rechnung - PDF Hintergrunddatei', 'RL_INVOICE3_PDF_BACKGROUND', 43, 'PDF Hintergrunddatei<br />Standard: /www/htdocs/xxx/xxx/includes/pdf/rechnung_de.pdf<br />', now(), now()),
('pdf Rechnung - Speicherort und -name der PDF-Datei', 'RL_INVOICE3_PDF_PATH', 43, '1. Wo sollen PDF-Dateien gespeichert werden (!! muss beschreibbar sein !!)?<br />2. speichern ja|nein (1|0)<br />Standard: /www/htdocs/xxx/xxx/includes/pdf/|1<br />', now(), now()),
('pdf Rechnung - Anhänge', 'RL_INVOICE3_SEND_ATTACH', 43, 'Welche PDFs sollen noch angehängt werden; bei mehreren Dateien | (pipe) als Trenner verwenden)<br><br>Voreinstellung: agb_de.pdf|widerruf_de.pdf', now(), now()),
('pdf Rechnung - Rechnungsneuversand', 'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE', 43, 'Bei welcher Änderung des Bestellstatus soll die Rechnung [nochmals] versendet werden', now(), now()),
('pdf Rechnung - Rechnung bei Bestellung', 'RL_INVOICE3_SEND_PDF', 43, 'Soll die Rechnung gleich bei der Bestellung gesendet werden?', now(), now()),
('pdf Rechnung - Template für Artikel- und Summentabelle', 'RL_INVOICE3_TABLE_TEMPLATE', 43, 'Template für Artikel- und Summentabelle<br />Definition ist in includes/pdf/rl_invoice3_def.php<br />Standard: 30|30|30|60<br />Standard: amazon|amazon_templ|total_col_1|total_opt_1<br />', now(), now()),
('pdf Rechnung - PDF-Template auf 1.Seite', 'RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE', 43, 'PDF-Template nur auf 1.Seite drucken', now(), now()),
('pdf Rechnung - Abstand 2.Seite', 'RL_INVOICE3_DELTA_2PAGE', 43, 'Zusätzlicher Abstand auf 2. Seite', now(), now()),

# Adminmenü ID 38 - Shopvote
('Shopvote - Version', 'SHOPVOTE_MODUL_VERSION', 43, 'Installierte Version:', now(), now()),
('Shopvote - Ist das Modul aktiv?', 'SHOPVOTE_STATUS', 43, 'Wollen Sie das Shopvote Siegel und die Easy Reviews Bewertungsanfragen aktivieren?<br>Bitte erst dann aktivieren, wenn Sie Zugriff auf die entsprechenden Javascript Snippets in Ihrer Shopvote Administration bekommen und die Einstellungen unten komplett vorgenommen haben.', now(), now()),
('Shopvote - Shop ID', 'SHOPVOTE_SHOP_ID', 43, 'Tragen Sie hier Ihre Shopvote Shop ID ein', now(), now()),
('Shopvote - Easy Reviews Token', 'SHOPVOTE_EASY_REVIEWS_TOKEN', 43, 'Tragen Sie hier Ihre Shopvote Token für Easy Reviews ein', now(), now()),
('Shopvote - Badge Typ', 'SHOPVOTE_BADGE_TYPE', 43, 'Wählen Sie die Art des Shopvote Siegels aus, das am unteren rechten Bildschirmrand angezeigt werden soll.<br>Zur Verfügung stehen hier die Badge Typen, die automatisch die Funktion Rating Stars (falls bei Shopvote gebucht) unterstützen, so dass Sie dafür keinerlei Code integrieren müssen.<br>Eine Vorschau der verschiedenen Badges finden Sie unter Grafiken & Siegel in Ihrer Shopvote Administration.<br>Für die Nutzung der All Votes Grafik müssen Sie bei Shopvote freigeschaltet sein.<br><br />1 = Vote Badge I (klein, ohne Siegel)<br>2 = Vote Badge III (groß)<br>3 = Vote Badge II (klein)<br>4 = All Votes Grafik I<br /><br>', now(), now()),
('Shopvote - Vote Badge I - Abstand links/rechts', 'SHOPVOTE_SPACE_X', 43, 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>Abstand in Pixeln vom rechten/linken Bildschirmrand<br>darf nicht kleiner als 2 sein', now(), now()),
('Shopvote - Vote Badge I - Abstand oben/unten', 'SHOPVOTE_SPACE_Y', 43, 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>Abstand in Pixeln vom oberen/unteren Bildschirmrand<br>darf nicht kleiner als 5 sein', now(), now()),
('Shopvote - Vote Badge I - links oder rechts', 'SHOPVOTE_ALIGN_H', 43, 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>horizontale Ausrichtung links oder rechts<br>left = links, right = rechts', now(), now()),
('Shopvote - Vote Badge I - oben oder unten', 'SHOPVOTE_ALIGN_V', 43, 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>vertikale Ausrichtung oben oder unten<br>top = oben, bottom = unten', now(), now()),
('Shopvote - Vote Badge I - auf kleineren Display ausblenden', 'SHOPVOTE_DISPLAY_WIDTH', 43, 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>Display-Breite in Pixeln, bis zu der die Badget-Grafik ausgeblendet wird<br>Voreinstellung: 480<br>Dadurch wird die Grafik auf kleineren Smartphones nicht angezeigt und kann Ihre Seite nicht überlagern.', now(), now()),

# Adminmenü ID 39 - Cross Sell
('Minimale Anzeige Cross-Sell Artikel', 'MIN_DISPLAY_XSELL', 43, 'Anzahl der Cross Sell Artikel, die mindestens für den jeweiligen Artikel angelegt sein müssen, damit die Cross Sell Info erscheint.<br />Standardwert: 1', now(), now()),
('Maximale Anzeige Cross-Sell Artikel', 'MAX_DISPLAY_XSELL', 43, 'Geben Sie die maximale Anzahl der Cross-Sells an, die im Frontend angezeigt werden sollen (Standard: <b>6</b>).<br><br>Setzen Sie den Wert auf <b>0</b>, um die Anzeige im Frontend zu deaktivieren.', now(), now()),
('Cross-Sell Artikel pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS', 43, 'Geben Sie die Anzahl der Cross-Sells an, die pro Zeile (im Frontend) angezeigt werden sollen.  Setzen Sie den Wert auf <em>0</em>, um <em>alle</em> Produkte in einer einzigen Zeile anzuzeigen.  Voreinstellung: <b>3</b>.', now(), now()),
('Cross-Sell - Preis anzeigen?', 'XSELL_DISPLAY_PRICE', 43, 'Soll der Preis für die Cross Sell Artikel im Frontend angezeigt werden?<br />Standardwert: false', now(), now()),
('Cross-Sell Advanced Version', 'XSELL_VERSION', 43, 'Aktuell installierte Cross Sell Modul Version', now(), now()),

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
('Versandzone', 'MODULE_SHIPPING_FREEOPTIONS_ZONE', 43, 'für welche Länder soll diese Versandart angeboten werden?<br>Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Länder.', now(), now()),
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
('Anzeige incl. Mwst. zzgl. Versandkosten', 'DISPLAY_VATADDON_WHERE', 43, 'Wollen Sie unterhalb der Preise den Zusatz incl. bzw. excl. Mwst. zzgl. Versandkosten anzeigen?<br>O=Nein, Anzeige komplett deaktiviert<br>ALL = Anzeige überall im Shop aktiv<br>product_info = Anzeige nur auf der Artikeldetailseite<br><br>Hinweis: Den Text dieser Anzeige können Sie in folgender Datei ändern: includes/languages/german/extra_definitions/rl.vat_info.php', now(), now());


###########################################################################################################
UPDATE configuration SET configuration_value = 'de' WHERE configuration_key = 'DEFAULT_LANGUAGE' LIMIT 1 ;
###########################################################################################################

#
# Daten für Tabelle product_type_layout_language
#
INSERT INTO product_type_layout_language (configuration_title, configuration_key, languages_id, configuration_description, last_modified, date_added) VALUES
('Artikelnummer anzeigen', 'SHOW_PRODUCT_INFO_MODEL', 43, 'Soll die Artikelnummer auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Gewicht anzeigen', 'SHOW_PRODUCT_INFO_WEIGHT', 43, 'Soll das Gewicht auf der Produktinfoseite angezeigt werden<br> 0= AUS 1= AN', now(), now()),
('Attribut Gewicht anzeigen', 'SHOW_PRODUCT_INFO_WEIGHT_ATTRIBUTES', 43, 'Soll das Attribut Gewicht auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Hersteller anzeigen', 'SHOW_PRODUCT_INFO_MANUFACTURER', 43, 'Soll der Hersteller auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Menge im Warenkorb anzeigen', 'SHOW_PRODUCT_INFO_IN_CART_QTY', 43, 'Soll die bereits im Warenkorb vorhandene Menge diese Artikels auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Lagermenge anzeigen', 'SHOW_PRODUCT_INFO_QUANTITY', 43, 'Soll die aktuelle Lagermenge auf der Produktinfoseite angezeigt werden<br> 0= AUS 1= AN', now(), now()),
('Anzahl der Artikelbewertungen anzeigen', 'SHOW_PRODUCT_INFO_REVIEWS_COUNT', 43, 'Soll die Anzehl der Artikelbewertungen auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Button "Artikel bewerten" anzeigen', 'SHOW_PRODUCT_INFO_REVIEWS', 43, 'Soll der Button "Artikel bewerten" auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('"Verfügbar am" anzeigen', 'SHOW_PRODUCT_INFO_DATE_AVAILABLE', 43, 'Soll auf der Produktinfoseite "Verfügbar am" angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('"Hinzugefügt am" anzeigen', 'SHOW_PRODUCT_INFO_DATE_ADDED', 43, 'Soll auf der Produktinfoseite "Hinzugefügt am" angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Artikel URL anzeigen', 'SHOW_PRODUCT_INFO_URL', 43, 'Soll die Artikel URL auf der Produktinfoseite angezeigt werden? 0= AUS 1= AN', now(), now()),
('Zusätzliche Artikelbilder anzeigen', 'SHOW_PRODUCT_INFO_ADDITIONAL_IMAGES', 43, 'Sollen auf der Produktinfoseite zusätzliche Artikelbilder angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Preis "ab.." anzeigen', 'SHOW_PRODUCT_INFO_STARTING_AT', 43, 'Soll bei Produkten mit Attributen die Preisanzeige mit "ab" beginnen?<br> 0= AUS 1= AN', now(), now()),
('Bild "Versandkostenfreie Lieferung" anzeigen', 'SHOW_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', 43, 'Soll das Bild bzw. der Text für "Versandkostenfreie Lieferung" im Shop angezeigt werden?', now(), now()),
('Artikelpreis Steuerklasse - Standardeinstellung', 'DEFAULT_PRODUCT_TAX_CLASS_ID', 43, 'Welche Steuerklasse soll jeder neu angelegte Artikel haben<br>Bitte geben Sie die ID der Steuerklasse ein.', now(), now()),
('Artikel ist virtuell - Standardeinstellung', 'DEFAULT_PRODUCT_PRODUCTS_VIRTUAL', 43, 'Soll jeder neu angelegte Artikel ein virtueller sein?', now(), now()),
('Artikel "immer versandkostenfrei" - Standardeinstellung', 'DEFAULT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 43, 'Welche Einstellung soll beim Anlegen eines neuen Artikels standardmässig aktiviert werden?<br />JA, Immer versandkostenfrei AN<br />NEIN, Immer versandkostenfrei AUS<br />Spezial, Artikel/Download benötigt Versand', now(), now()),

('Artikelnummer anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_MODEL', 43, 'Soll die Artikelnummer auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Gewicht anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_WEIGHT', 43, 'Soll das Gewicht auf der Produktinfoseite angezeigt werden<br> 0= AUS 1= AN', now(), now()),
('Attribut Gewicht anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_WEIGHT_ATTRIBUTES', 43, 'Soll das Attribut Gewicht auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Künstler anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_ARTIST', 43, 'Soll der Künstler auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Musik Genre anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_GENRE', 43, 'Soll das Musik Genre auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Record Label anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_RECORD_COMPANY', 43, 'Soll das Record Label auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Menge im Warenkorb anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_IN_CART_QTY', 43, 'Soll die bereits im Warenkorb vorhandene Menge diese Artikels auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Lagermenge anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_QUANTITY', 43, 'Soll die aktuelle Lagermenge auf der Produktinfoseite angezeigt werden<br> 0= AUS 1= AN', now(), now()),
('Anzahl der Artikelbewertungen anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_REVIEWS_COUNT', 43, 'Soll die Anzehl der Artikelbewertungen auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Button "Artikel bewerten" anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_REVIEWS', 43, 'Soll der Button "Artikel bewerten" auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('"Verfügbar am" anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_DATE_AVAILABLE', 43, 'Soll auf der Produktinfoseite "Verfügbar am" angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('"Hinzugefügt am" anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_DATE_ADDED', 43, 'Soll auf der Produktinfoseite "Hinzugefügt am" angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Preis "ab.." anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_STARTING_AT', 43, 'Soll bei Produkten mit Attributen die Preisanzeige mit "ab" beginnen?<br> 0= AUS 1= AN', now(), now()),
('Zusätzliche Artikelbilder anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_ADDITIONAL_IMAGES', 43, 'Sollen auf der Produktinfoseite zusätzliche Artikelbilder angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Bild "Versandkostenfreie Lieferung" anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', 43, 'Soll das Bild bzw. der Text für "Versandkostenfreie Lieferung" im Shop angezeigt werden?', now(), now()),
('Artikelpreis Steuerklasse - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_TAX_CLASS_ID', 43, 'Welche Steuerklasse soll jeder neu angelegte Artikel haben<br>Bitte geben Sie die ID der Steuerklasse ein.', now(), now()),
('Artikel ist virtuell - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_VIRTUAL', 43, 'Soll jeder neu angelegte Artikel ein virtueller sein?', now(), now()),
('Artikel "immer versandkostenfrei" - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 43, 'Welche Einstellung soll beim Anlegen eines neuen Artikels standardmässig aktiviert werden?<br />JA, Immer versandkostenfrei AN<br />NEIN, Immer versandkostenfrei AUS<br />Spezial, Artikel/Download benötigt Versand', now(), now()),

('Anzahl der Artikelbewertungen anzeigen', 'SHOW_DOCUMENT_GENERAL_INFO_REVIEWS_COUNT', 43, 'Soll die Anzahl der Artikelbewertungen auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Button "Artikel bewerten" anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS', 43, 'Soll der Button "Artikel bewerten" auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('"Verfügbar am" anzeigen', 'SHOW_DOCUMENT_GENERAL_INFO_DATE_AVAILABLE', 43, 'Soll auf der Produktinfoseite "Verfügbar am" angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('"Hinzugefügt am" anzeigen', 'SHOW_DOCUMENT_GENERAL_INFO_DATE_ADDED', 43, 'Soll auf der Produktinfoseite "Hinzugefügt am" angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Artikel URL anzeigen', 'SHOW_DOCUMENT_GENERAL_INFO_URL', 43, 'Soll die Artikel URL auf der Produktinfoseite angezeigt werden? 0= AUS 1= AN', now(), now()),
('Zusätzliche Artikelbilder anzeigen', 'SHOW_DOCUMENT_GENERAL_INFO_ADDITIONAL_IMAGES', 43, 'Sollen auf der Produktinfoseite zusätzliche Artikelbilder angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Artikelnummer anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_MODEL', 43, 'Soll die Artikelnummer auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Gewicht anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT', 43, 'Soll das Gewicht auf der Produktinfoseite angezeigt werden<br> 0= AUS 1= AN', now(), now()),
('Attribut Gewicht anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT_ATTRIBUTES', 43, 'Soll das Attribut Gewicht auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Hersteller anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_MANUFACTURER', 43, 'Soll der Hersteller auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Menge im Warenkorb anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_IN_CART_QTY', 43, 'Soll die bereits im Warenkorb vorhandene Menge diese Artikels auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Lagermenge anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_QUANTITY', 43, 'Soll die aktuelle Lagermenge auf der Produktinfoseite angezeigt werden<br> 0= AUS 1= AN', now(), now()),
('Anzahl der Artikelbewertungen anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS_COUNT', 43, 'Soll die Anzehl der Artikelbewertungen auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('"Verfügbar am" anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_DATE_AVAILABLE', 43, 'Soll auf der Produktinfoseite "Verfügbar am" angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('"Hinzugefügt am" anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_DATE_ADDED', 43, 'Soll auf der Produktinfoseite "Hinzugefügt am" angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Artikel URL anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_URL', 43, 'Soll die Artikel URL auf der Produktinfoseite angezeigt werden? 0= AUS 1= AN', now(), now()),
('Zusätzliche Artikelbilder anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_ADDITIONAL_IMAGES', 43, 'Sollen auf der Produktinfoseite zusätzliche Artikelbilder angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Preis "ab.." anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_STARTING_AT', 43, 'Soll bei Produkten mit Attributen die Preisanzeige mit "ab" beginnen?<br> 0= AUS 1= AN', now(), now()),
('Bild "Versandkostenfreie Lieferung" anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', 43, 'Soll das Bild bzw. der Text für "Versandkostenfreie Lieferung" im Shop angezeigt werden?', now(), now()),
('Artikelpreis Steuerklasse - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_TAX_CLASS_ID', 43, 'Welche Steuerklasse soll jeder neu angelegte Artikel haben<br>Bitte geben Sie die ID der Steuerklasse ein.', now(), now()),
('Artikel ist virtuell - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_VIRTUAL', 43, 'Soll jeder neu angelegte Artikel ein virtueller sein?', now(), now()),
('Artikel "immer versandkostenfrei" - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 43, 'Welche Einstellung soll beim Anlegen eines neuen Artikels standardmässig aktiviert werden?<br />JA, Immer versandkostenfrei AN<br />NEIN, Immer versandkostenfrei AUS<br />Spezial, Artikel/Download benötigt Versand', now(), now()),

('Artikelnummer anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_MODEL', 43, 'Soll die Artikelnummer auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Gewicht anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT', 43, 'Soll das Gewicht auf der Produktinfoseite angezeigt werden<br> 0= AUS 1= AN', now(), now()),
('Attribut Gewicht anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT_ATTRIBUTES', 43, 'Soll das Attribut Gewicht auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Hersteller anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_MANUFACTURER', 43, 'Soll der Hersteller auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Menge im Warenkorb anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_IN_CART_QTY', 43, 'Soll die bereits im Warenkorb vorhandene Menge diese Artikels auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Lagermenge anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_QUANTITY', 43, 'Soll die aktuelle Lagermenge auf der Produktinfoseite angezeigt werden<br> 0= AUS 1= AN', now(), now()),
('Anzahl der Artikelbewertungen anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS_COUNT', 43, 'Soll die Anzehl der Artikelbewertungen auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Button "Artikel bewerten" anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS', 43, 'Soll der Button "Artikel bewerten" auf der Produktinfoseite angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('"Verfügbar am" anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_AVAILABLE', 43, 'Soll auf der Produktinfoseite "Verfügbar am" angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('"Hinzugefügt am" anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_ADDED', 43, 'Soll auf der Produktinfoseite "Hinzugefügt am" angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Artikel URL anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_URL', 43, 'Soll die Artikel URL auf der Produktinfoseite angezeigt werden? 0= AUS 1= AN', now(), now()),
('Zusätzliche Artikelbilder anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ADDITIONAL_IMAGES', 43, 'Sollen auf der Produktinfoseite zusätzliche Artikelbilder angezeigt werden?<br> 0= AUS 1= AN', now(), now()),
('Preis "ab.." anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_STARTING_AT', 43, 'Soll bei Produkten mit Attributen die Preisanzeige mit "ab" beginnen?<br> 0= AUS 1= AN', now(), now()),
('Bild "Versandkostenfreie Lieferung" anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', 43, 'Soll das Bild bzw. der Text für "Versandkostenfreie Lieferung" im Shop angezeigt werden?', now(), now()),
('Artikelpreis Steuerklasse - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_TAX_CLASS_ID', 43, 'Welche Steuerklasse soll jeder neu angelegte Artikel haben<br>Bitte geben Sie die ID der Steuerklasse ein.', now(), now()),
('Artikel ist virtuell - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_VIRTUAL', 43, 'Soll jeder neu angelegte Artikel ein virtueller sein?', now(), now()),
('Artikel "immer versandkostenfrei" - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 43, 'Welche Einstellung soll beim Anlegen eines neuen Artikels standardmässig aktiviert werden?<br />JA, Immer versandkostenfrei AN<br />NEIN, Immer versandkostenfrei AUS<br />Spezial, Artikel/Download benötigt Versand', now(), now()),

('Metatag Titel Standardeinstellung - Produkt Titel', 'SHOW_PRODUCT_INFO_METATAGS_TITLE_STATUS', 43, 'Soll der Produkt Titel im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikelname', 'SHOW_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS', 43, 'Soll der Artikelname im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikelnummer', 'SHOW_PRODUCT_INFO_METATAGS_MODEL_STATUS', 43, 'Soll die Artikelnummer im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikelpreis', 'SHOW_PRODUCT_INFO_METATAGS_PRICE_STATUS', 43, 'Soll der Artikelpreis im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikel Tagline', 'SHOW_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS', 43, 'Soll die Artikel Tagline im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Produkt Titel', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_STATUS', 43, 'Soll der Produkt Titel im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikelname', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRODUCTS_NAME_STATUS', 43, 'Soll der Artikelname im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikelnummer', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_MODEL_STATUS', 43, 'Soll die Artikelnummer im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikelpreis', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRICE_STATUS', 43, 'Soll der Artikelpreis im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikel Tagline', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_TAGLINE_STATUS', 43, 'Soll die Artikel Tagline im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Dokument Titel', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_STATUS', 43, 'Soll der Dokument Titel im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Dokumentname', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_PRODUCTS_NAME_STATUS', 43, 'Soll der Dokumentname im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Dokument Tagline', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_TAGLINE_STATUS', 43, 'Soll die Dokument Tagline im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Dokument Titel', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_STATUS', 43, 'Soll der Dokument Titel im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Dokumentname', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS', 43, 'Soll der Dokumentname im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Dokumentnummer', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_MODEL_STATUS', 43, 'Soll die Dokumentnummer im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Dokumentpreis', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRICE_STATUS', 43, 'Soll der Dokumentpreis im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Dokument Tagline', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS', 43, 'Soll die Dokument Tagline im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Produkt Titel', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_STATUS', 43, 'Soll der Produkt Titel im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikelname', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRODUCTS_NAME_STATUS', 43, 'Soll der Artikelname im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikelnummer', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_MODEL_STATUS', 43, 'Soll die Artikelnummer im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikelpreis', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRICE_STATUS', 43, 'Soll der Artikelpreis im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),
('Metatag Titel Standardeinstellung - Artikel Tagline', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_TAGLINE_STATUS', 43, 'Soll die Artikel Tagline im Metatag Titel angezeigt werden<br>0= AUS 1= AN', now(), now()),

('PRODUCT Attribut wird nur zur Darstellung benötigt - Standardeinstellung', 'DEFAULT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY', 43, 'PRODUCT Attribut wird nur zur Anzeige benötigt<br />0= NEIN 1= JA', now(), now()),
('PRODUCT Attribut ist kostenlos - Standardeinstellung', 'DEFAULT_PRODUCT_ATTRIBUTE_IS_FREE', 43, 'PRODUCT Attribut ist kostenlos<br />Attribut ist kostenlos, wenn der Artikel kostenlos ist.<br />0= NEIN 1= JA', now(), now()),
('PRODUCT Attribut ist standardmässig markiert - Standardeinstellung', 'DEFAULT_PRODUCT_ATTRIBUTES_DEFAULT', 43, 'PRODUCT Attribut ist standardmässig markiert<br />0= NEIN 1= JA', now(), now()),
('PRODUCT Attribut ist preisreduziert - Standardeinstellung', 'DEFAULT_PRODUCT_ATTRIBUTES_DISCOUNTED', 43, 'PRODUCT Attribut ist preisreduziert<br />Angewendete Rabatte des Artikels (Sonderpreis/Abverkauf) werden auch für die Attribute verwendet<br />0= NEIN 1= JA', now(), now()),
('PRODUCT Attribut ist inkludiert im Basispreis - Standardeinstellung', 'DEFAULT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED', 43, 'PRODUCT Attribut ist inkludiert im Basispreis<br />Inkludiert im Basispreis bei "Preis per Attribut"<br />0= NEIN 1= JA', now(), now()),
('PRODUCT Attribut wird benötigt - Standardeinstellung', 'DEFAULT_PRODUCT_ATTRIBUTES_REQUIRED', 43, 'PRODUCT Attribut wird benötigt<br />Attribut wird für Text benötigt<br />0= NEIN 1= JA', now(), now()),
('PRODUCT Attribut Preis Präfix - Standardeinstellung', 'DEFAULT_PRODUCT_PRICE_PREFIX', 43, 'PRODUCT Attribut Preis Präfix<br />Standard Preis Präfix<br />Leer, + oder -', now(), now()),
('PRODUCT Attribut Gewicht Präfix - Standardeinstellung', 'DEFAULT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', 43, 'PRODUCT Attribut Gewicht Präfix<br />Standard Gewicht Präfix<br />Leer, + oder -', now(), now()),

('MUSIC Attribut wird nur zur Darstellung benötigt - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISPLAY_ONLY', 43, 'MUSIC Attribut wird nur zur Anzeige benötigt<br />0= NEIN 1= JA', now(), now()),
('MUSIC Attribut ist kostenlos - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTE_IS_FREE', 43, 'MUSIC Attribut ist kostenlos<br />Attribut ist kostenlos, wenn der Artikel kostenlos ist.<br />0= NEIN 1= JA', now(), now()),
('MUSIC Attribut ist standardmässig markiert - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DEFAULT', 43, 'MUSIC Attribut ist standardmässig markiert<br />0= NEIN 1= JA', now(), now()),
('MUSIC Attribut ist preisreduziert - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISCOUNTED', 43, 'MUSIC Attribut ist preisreduziert<br />Angewendete Rabatte des Artikels (Sonderpreis/Abverkauf) werden auch für die Attribute verwendet<br />0= NEIN 1= JA', now(), now()),
('MUSIC Attribut ist inkludiert im Basispreis - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_PRICE_BASE_INCLUDED', 43, 'MUSIC Attribut ist inkludiert im Basispreis<br />Inkludiert im Basispreis bei "Preis per Attribut"<br />0= NEIN 1= JA', now(), now()),
('MUSIC Attribut wird benötigt - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_REQUIRED', 43, 'MUSIC Attribut wird benötigt<br />Attribut wird für Text benötigt<br />0= NEIN 1= JA', now(), now()),
('MUSIC Attribut Preis Präfix - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_PRICE_PREFIX', 43, 'MUSIC Attribut Preis Präfix<br />Standard Preis Präfix<br />Leer, + oder -', now(), now()),
('MUSIC Attribut Gewicht Präfix - Standardeinstellung', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', 43, 'MUSIC Attribut Gewicht Präfix<br />Standard Gewicht Präfix<br />Leer, + oder -', now(), now()),

('DOCUMENT GENERAL Attribut wird nur zur Darstellung benötigt - Standardeinstellung', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISPLAY_ONLY', 43, 'DOCUMENT GENERAL Attribut wird nur zur Anzeige benötigt<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT GENERAL Attribut ist kostenlos - Standardeinstellung', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTE_IS_FREE', 43, 'DOCUMENT GENERAL Attribut ist kostenlos<br />Attribut ist kostenlos, wenn der Artikel kostenlos ist.<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT GENERAL Attribut ist standardmässig markiert - Standardeinstellung', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DEFAULT', 43, 'DOCUMENT GENERAL Attribut ist standardmässig markiert<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT GENERAL Attribut ist preisreduziert - Standardeinstellung', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISCOUNTED', 43, 'DOCUMENT GENERAL Attribut ist preisreduziert<br />Angewendete Rabatte des Artikels (Sonderpreis/Abverkauf) werden auch für die Attribute verwendet<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT GENERAL Attribut ist inkludiert im Basispreis - Standardeinstellung', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_PRICE_BASE_INCLUDED', 43, 'DOCUMENT GENERAL Attribut ist inkludiert im Basispreis<br />Inkludiert im Basispreis bei "Preis per Attribut"<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT GENERAL Attribut wird benötigt - Standardeinstellung', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_REQUIRED', 43, 'DOCUMENT GENERAL Attribut wird benötigt<br />Attribut wird für Text benötigt<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT GENERAL Attribut Preis Präfix - Standardeinstellung', 'DEFAULT_DOCUMENT_GENERAL_PRICE_PREFIX', 43, 'DOCUMENT GENERAL Attribut Preis Präfix<br />Standard Preis Präfix<br />Leer, + oder -', now(), now()),
('DOCUMENT GENERAL Attribut Gewicht Präfix - Standardeinstellung', 'DEFAULT_DOCUMENT_GENERAL_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', 43, 'DOCUMENT GENERAL Attribut Gewicht Präfix<br />Standard Gewicht Präfix<br />Leer, + oder -', now(), now()),
('DOCUMENT PRODUCT Attribut wird nur zur Darstellung benötigt - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY', 43, 'DOCUMENT PRODUCT Attribut wird nur zur Anzeige benötigt<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT PRODUCT Attribut ist kostenlos - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTE_IS_FREE', 43, 'DOCUMENT PRODUCT Attribut ist kostenlos<br />Attribut ist kostenlos, wenn der Artikel kostenlos ist.<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT PRODUCT Attribut ist standardmässig markiert - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DEFAULT', 43, 'DOCUMENT PRODUCT Attribut ist standardmässig markiert<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT PRODUCT Attribut ist preisreduziert - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISCOUNTED', 43, 'DOCUMENT PRODUCT Attribut ist preisreduziert<br />Angewendete Rabatte des Artikels (Sonderpreis/Abverkauf) werden auch für die Attribute verwendet<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT PRODUCT Attribut ist inkludiert im Basispreis - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED', 43, 'DOCUMENT PRODUCT Attribut ist inkludiert im Basispreis<br />Inkludiert im Basispreis bei "Preis per Attribut"<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT PRODUCT Attribut wird benötigt - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_REQUIRED', 43, 'DOCUMENT PRODUCT Attribut wird benötigt<br />Attribut wird für Text benötigt<br />0= NEIN 1= JA', now(), now()),
('DOCUMENT PRODUCT Attribut Preis Präfix - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_PRICE_PREFIX', 43, 'DOCUMENT PRODUCT Attribut Preis Präfix<br />Standard Preis Präfix<br />Leer, + oder -', now(), now()),
('DOCUMENT PRODUCT Attribut Gewicht Präfix - Standardeinstellung', 'DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', 43, 'DOCUMENT PRODUCT Attribut Gewicht Präfix<br />Standard Gewicht Präfix<br />Leer, + oder -', now(), now()),

('PRODUCT FREE SHIPPING Attribut wird nur zur Darstellung benötigt - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISPLAY_ONLY', 43, 'PRODUCT FREE SHIPPING Attribut wird nur zur Anzeige benötigt<br />0= NEIN 1= JA', now(), now()),
('PRODUCT FREE SHIPPING Attribut ist kostenlos - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTE_IS_FREE', 43, 'PRODUCT FREE SHIPPING Attribut ist kostenlos<br />Attribut ist kostenlos, wenn der Artikel kostenlos ist.<br />0= NEIN 1= JA', now(), now()),
('PRODUCT FREE SHIPPING Attribut ist standardmässig markiert - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DEFAULT', 43, 'PRODUCT FREE SHIPPING Attribut ist standardmässig markiert<br />0= NEIN 1= JA', now(), now()),
('PRODUCT FREE SHIPPING Attribut ist preisreduziert - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISCOUNTED', 43, 'PRODUCT FREE SHIPPING Attribut ist preisreduziert<br />Angewendete Rabatte des Artikels (Sonderpreis/Abverkauf) werden auch für die Attribute verwendet<br />0= NEIN 1= JA', now(), now()),
('PRODUCT FREE SHIPPING Attribut ist inkludiert im Basispreis - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_PRICE_BASE_INCLUDED', 43, 'PRODUCT FREE SHIPPING Attribut ist inkludiert im Basispreis<br />Inkludiert im Basispreis bei "Preis per Attribut"<br />0= NEIN 1= JA', now(), now()),
('PRODUCT FREE SHIPPING Attribut wird benötigt - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_REQUIRED', 43, 'PRODUCT FREE SHIPPING Attribut wird benötigt<br />Attribut wird für Text benötigt<br />0= NEIN 1= JA', now(), now()),
('PRODUCT FREE SHIPPING Attribut Preis Präfix - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRICE_PREFIX', 43, 'PRODUCT FREE SHIPPING Attribut Preis Präfix<br />Standard Preis Präfix<br />Leer, + oder -', now(), now()),
('PRODUCT FREE SHIPPING Attribut Gewicht Präfix - Standardeinstellung', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', 43, 'PRODUCT FREE SHIPPING Attribut Gewicht Präfix<br />Standard Gewicht Präfix<br />Leer, + oder -', now(), now()),

##### new since 1.5.7 ####

('Frage zum Artikel Button anzeigen', 'SHOW_PRODUCT_INFO_ASK_A_QUESTION', 43, 'Den Button Frage zum Artikel auf der Artikeldetailseite anzeigen? (0 = AUS, 1 = AN)', now(), now()),
('Frage zum Artikel Button anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_ASK_A_QUESTION', 43, 'Den Button Frage zum Artikel auf der Artikeldetailseite anzeigen? (0 = AUS, 1 = AN)', now(), now()),
('Frage zum Artikel Button anzeigen', 'SHOW_DOCUMENT_GENERAL_INFO_ASK_A_QUESTION', 43, 'Den Button Frage zum Artikel auf der Artikeldetailseite anzeigen? (0 = AUS, 1 = AN)', now(), now()),
('Frage zum Artikel Button anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_ASK_A_QUESTION', 43, 'Den Button Frage zum Artikel auf der Artikeldetailseite anzeigen? (0 = AUS, 1 = AN)', now(), now()),
('Frage zum Artikel Button anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ASK_A_QUESTION', 43, 'Den Button Frage zum Artikel auf der Artikeldetailseite anzeigen? (0 = AUS, 1 = AN)', now(), now());


### preinstall storepickup german config ####
INSERT INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Selbstabholung anbieten?', 'MODULE_SHIPPING_STOREPICKUP_STATUS', 43, 'Wollen Sie Selbstabholung aktivieren?', NULL, now()),
('Orte für die Selbstabholung', 'MODULE_SHIPPING_STOREPICKUP_LOCATIONS_LIST', 43, 'Geben Sie eine Liste der Orte ein, getrennt durch Semikolon (;).<br>Optional können Sie für jeden Standort eine Gebühr/Zuschlag festlegen, indem Sie ein Komma und einen Betrag hinzufügen. Wenn kein Betrag angegeben ist, wird der normale Betrag aus der Einstellung Kosten für Selbstabholung übernommen.<br><br>Beispiele:<br><br>Demogasse 17 in 1010 Wien;Beispielweg 15 in 8020 Graz<br>Demogasse 17 in 1010 Wien,4.00;Beispielweg 15 in 8020 Graz,5.00<br>Demogasse 17 in 1010 Wien,4.00;Beispielweg 15 in 8020 Graz,0.00<br><br>Wenn Sie nur einen Ort für die Abholung anbieten, dann tragen Sie einfach ein z.B. Demogasse 17 in 1010 Wien<br><br>Wenn Sie einen mehrsprachigen Shop betreiben und diese Definitionen mehrsprachig haben wollen, dann hinterlegen Sie Ihre Texte in den entsprechenden Sprachdateien includes/languages/SPRACHE/modules/shipping/storepickup.php.', NULL, now()),
('Kosten für Selbstabholung', 'MODULE_SHIPPING_STOREPICKUP_COST', 43, 'Versandkosten für Selbstabholung', NULL, now()),
('Steuerklasse', 'MODULE_SHIPPING_STOREPICKUP_TAX_CLASS', 43, 'Falls Sie Versandkosten für Selbstabholung eingetragen haben, welche Steuerklasse soll auf die Versandkosten angewendet werden?', NULL, now()),
('Basis der Steuern', 'MODULE_SHIPPING_STOREPICKUP_TAX_BASIS', 43, 'Auf welcher Basis soll die Steuer für die Versandkosten berechnet werden? Mögliche Werte sind.<br>Shipping - basiert auf der Versandadresse des Kunden<br>Billing - basiert auf der Rechnungsadresse des Kunden<br>Store - basiert auf der Adresse des Shops wenn Versand- und Rechnungszone in derselben Zone liegen wie der Shop', NULL, now()),
('Versandzone', 'MODULE_SHIPPING_STOREPICKUP_ZONE', 43, 'Wenn Sie hier eine Zone auswählen, wird Selbstabholung nur in dieser Zone angeboten.', NULL, now()),
('Sortierreihenfolge', 'MODULE_SHIPPING_STOREPICKUP_SORT_ORDER', 43, 'Anzeigereihenfolge. Niedrigste Werte werden zuerst angezeigt.', NULL, now()),
('Länder', 'MODULE_SHIPPING_STOREPICKUP_COUNTRIES', 43, 'Geben Sie hier die Länder an, für die Selbstabholung möglich sein soll.<br>Zweistellige ISO-Codes durch Komma getrennt!', NULL, now());


REPLACE INTO product_type_layout_language (configuration_title , configuration_key , languages_id, configuration_description, last_modified, date_added)
VALUES ('20231031', 'LANGUAGE_VERSION', '43', 'Datum der deutschen Übersetzungen', now(), now());
##### End of SQL setup for Zen Cart German.