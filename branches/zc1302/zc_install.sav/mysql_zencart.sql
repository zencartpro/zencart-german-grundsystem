#
# * Main Zen Cart SQL Load for MySQL databases
# * @package Installer
# * @access private
# * @copyright Copyright 2003-2006 Zen Cart Development Team
# * @copyright Portions Copyright 2003 osCommerce
# * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
# * @version $Id: mysql_zencart.sql 3787 2006-06-17 03:07:14Z drbyte $
#


# --------------------------------------------------------
#
# Table structure for table upgrade_exceptions
# (Placed at top so any exceptions during installation can be trapped as well)
#

DROP TABLE IF EXISTS upgrade_exceptions;
CREATE TABLE upgrade_exceptions (
  upgrade_exception_id smallint(5) NOT NULL auto_increment,
  sql_file varchar(50) default NULL,
  reason varchar(200) default NULL,
  errordate datetime default '0001-01-01 00:00:00',
  sqlstatement text,
  PRIMARY KEY  (upgrade_exception_id)
) TYPE=MyISAM;


# --------------------------------------------------------
#
# Table structure for table address_book
#

DROP TABLE IF EXISTS address_book;
CREATE TABLE address_book (
  address_book_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  entry_gender char(1) NOT NULL default '',
  entry_company varchar(32) default NULL,
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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table address_format
#

DROP TABLE IF EXISTS address_format;
CREATE TABLE address_format (
  address_format_id int(11) NOT NULL auto_increment,
  address_format varchar(128) NOT NULL default '',
  address_summary varchar(48) NOT NULL default '',
  PRIMARY KEY  (address_format_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table admin
#

DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
  admin_id int(11) NOT NULL auto_increment,
  admin_name varchar(32) NOT NULL default '',
  admin_email varchar(96) NOT NULL default '',
  admin_pass varchar(40) NOT NULL default '',
  admin_level tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (admin_id),
  KEY idx_admin_name_zen (admin_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#Admin Activity log

DROP TABLE IF EXISTS admin_activity_log;
CREATE TABLE admin_activity_log (
  log_id int(15) NOT NULL auto_increment,
  access_date datetime NOT NULL default '0001-01-01 00:00:00',
  admin_id int(11) NOT NULL default '0',
  page_accessed varchar(80) NOT NULL default '',
  page_parameters varchar(150) default NULL,
  ip_address varchar(15) NOT NULL default '',
  PRIMARY KEY  (log_id),
  KEY idx_page_accessed_zen (page_accessed),
  KEY idx_access_date_zen (access_date),
  KEY idx_ip_zen (ip_address)
) TYPE=MyISAM;


# --------------------------------------------------------

DROP TABLE IF EXISTS authorizenet;
CREATE TABLE authorizenet (
  id int(11) unsigned NOT NULL auto_increment,
  customer_id int(11) NOT NULL default '0',
  order_id int(11) NOT NULL default '0',
  response_code int(1) NOT NULL default '0',
  response_text varchar(255) NOT NULL default '',
  authorization_type text NOT NULL,
  transaction_id int(15) NOT NULL default '0',
  sent longtext NOT NULL,
  received longtext NOT NULL,
  time varchar(50) NOT NULL default '',
  session_id varchar(255) NOT NULL default '',
  UNIQUE KEY idx_auth_net_id (id)
) TYPE=MyISAM;

#
# Table structure for table banners
#

DROP TABLE IF EXISTS banners;
CREATE TABLE banners (
  banners_id int(11) NOT NULL auto_increment,
  banners_title varchar(64) NOT NULL default '',
  banners_url varchar(255) NOT NULL default '',
  banners_image varchar(64) NOT NULL default '',
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
  KEY idx_status_group_zen (status,banners_group)
) TYPE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table banners_history
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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table categories
#

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  categories_id int(11) NOT NULL auto_increment,
  categories_image varchar(64) default NULL,
  parent_id int(11) NOT NULL default '0',
  sort_order int(3) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  categories_status tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (categories_id),
  KEY idx_parent_id_cat_id_zen (parent_id,categories_id),
  KEY idx_status_zen (categories_status),
  KEY idx_sort_order_zen (sort_order)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table categories_description
#

DROP TABLE IF EXISTS categories_description;
CREATE TABLE categories_description (
  categories_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  categories_name varchar(32) NOT NULL default '',
  categories_description text NOT NULL,
  PRIMARY KEY  (categories_id,language_id),
  KEY idx_categories_name_zen (categories_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table configuration
#

DROP TABLE IF EXISTS configuration;
CREATE TABLE configuration (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title text NOT NULL,
  configuration_key varchar(255) NOT NULL default '',
  configuration_value text NOT NULL,
  configuration_description text NOT NULL,
  configuration_group_id int(11) NOT NULL default '0',
  sort_order int(5) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  use_function text default NULL,
  set_function text default NULL,
  PRIMARY KEY  (configuration_id),
  UNIQUE KEY unq_config_key_zen (configuration_key),
  KEY idx_key_value_zen (configuration_key,configuration_value(10)),
  KEY idx_cfg_grp_id_zen (configuration_group_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table configuration_group
#

DROP TABLE IF EXISTS configuration_group;
CREATE TABLE configuration_group (
  configuration_group_id int(11) NOT NULL auto_increment,
  configuration_group_title varchar(64) NOT NULL default '',
  configuration_group_description varchar(255) NOT NULL default '',
  sort_order int(5) default NULL,
  visible int(1) default '1',
  PRIMARY KEY  (configuration_group_id),
  KEY idx_visible_zen (visible)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table counter
#

DROP TABLE IF EXISTS counter;
CREATE TABLE counter (
  startdate char(8) default NULL,
  counter int(12) default NULL
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table counter_history
#

DROP TABLE IF EXISTS counter_history;
CREATE TABLE counter_history (
  startdate char(8) default NULL,
  counter int(12) default NULL,
  session_counter int(12) default NULL
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table countries
#

DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  countries_id int(11) NOT NULL auto_increment,
  countries_name varchar(64) NOT NULL default '',
  countries_iso_code_2 char(2) NOT NULL default '',
  countries_iso_code_3 char(3) NOT NULL default '',
  address_format_id int(11) NOT NULL default '0',
  PRIMARY KEY  (countries_id),
  KEY idx_countries_name_zen (countries_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupon_email_track
#

DROP TABLE IF EXISTS coupon_email_track;
CREATE TABLE coupon_email_track (
  unique_id int(11) NOT NULL auto_increment,
  coupon_id int(11) NOT NULL default '0',
  customer_id_sent int(11) NOT NULL default '0',
  sent_firstname varchar(32) default NULL,
  sent_lastname varchar(32) default NULL,
  emailed_to varchar(32) default NULL,
  date_sent datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (unique_id),
  KEY idx_coupon_id_zen (coupon_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupon_gv_customer
#

DROP TABLE IF EXISTS coupon_gv_customer;
CREATE TABLE coupon_gv_customer (
  customer_id int(5) NOT NULL default '0',
  amount decimal(8,4) NOT NULL default '0.0000',
  PRIMARY KEY  (customer_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupon_gv_queue
#

DROP TABLE IF EXISTS coupon_gv_queue;
CREATE TABLE coupon_gv_queue (
  unique_id int(5) NOT NULL auto_increment,
  customer_id int(5) NOT NULL default '0',
  order_id int(5) NOT NULL default '0',
  amount decimal(8,4) NOT NULL default '0.0000',
  date_created datetime NOT NULL default '0001-01-01 00:00:00',
  ipaddr varchar(32) NOT NULL default '',
  release_flag char(1) NOT NULL default 'N',
  PRIMARY KEY  (unique_id),
  KEY idx_cust_id_order_id_zen (customer_id,order_id),
  KEY idx_release_flag_zen (release_flag)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupon_redeem_track
#

DROP TABLE IF EXISTS coupon_redeem_track;
CREATE TABLE coupon_redeem_track (
  unique_id int(11) NOT NULL auto_increment,
  coupon_id int(11) NOT NULL default '0',
  customer_id int(11) NOT NULL default '0',
  redeem_date datetime NOT NULL default '0001-01-01 00:00:00',
  redeem_ip varchar(32) NOT NULL default '',
  order_id int(11) NOT NULL default '0',
  PRIMARY KEY  (unique_id),
  KEY idx_coupon_id_zen (coupon_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupon_restrict
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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupons
#

DROP TABLE IF EXISTS coupons;
CREATE TABLE coupons (
  coupon_id int(11) NOT NULL auto_increment,
  coupon_type char(1) NOT NULL default 'F',
  coupon_code varchar(32) NOT NULL default '',
  coupon_amount decimal(8,4) NOT NULL default '0.0000',
  coupon_minimum_order decimal(8,4) NOT NULL default '0.0000',
  coupon_start_date datetime NOT NULL default '0001-01-01 00:00:00',
  coupon_expire_date datetime NOT NULL default '0001-01-01 00:00:00',
  uses_per_coupon int(5) NOT NULL default '1',
  uses_per_user int(5) NOT NULL default '0',
  restrict_to_products varchar(255) default NULL,
  restrict_to_categories varchar(255) default NULL,
  restrict_to_customers text,
  coupon_active char(1) NOT NULL default 'Y',
  date_created datetime NOT NULL default '0001-01-01 00:00:00',
  date_modified datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (coupon_id),
  KEY idx_active_type_zen (coupon_active,coupon_type),
  KEY idx_coupon_code_zen (coupon_code),
  KEY idx_coupon_type_zen (coupon_type)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupons_description
#

DROP TABLE IF EXISTS coupons_description;
CREATE TABLE coupons_description (
  coupon_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '0',
  coupon_name varchar(32) NOT NULL default '',
  coupon_description text,
  PRIMARY KEY (coupon_id,language_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table currencies
#

DROP TABLE IF EXISTS currencies;
CREATE TABLE currencies (
  currencies_id int(11) NOT NULL auto_increment,
  title varchar(32) NOT NULL default '',
  code char(3) NOT NULL default '',
  symbol_left varchar(24) default NULL,
  symbol_right varchar(24) default NULL,
  decimal_point char(1) default NULL,
  thousands_point char(1) default NULL,
  decimal_places char(1) default NULL,
  value float(13,8) default NULL,
  last_updated datetime default NULL,
  PRIMARY KEY  (currencies_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table customers
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
  customers_password varchar(40) NOT NULL default '',
  customers_newsletter char(1) default NULL,
  customers_group_pricing int(11) NOT NULL default '0',
  customers_email_format varchar(4) NOT NULL default 'TEXT',
  customers_authorization int(1) NOT NULL default '0',
  customers_referral varchar(32) NOT NULL default '',
  PRIMARY KEY  (customers_id),
  KEY idx_email_address_zen (customers_email_address),
  KEY idx_referral_zen (customers_referral(10)),
  KEY idx_grp_pricing_zen (customers_group_pricing),
  KEY idx_nick_zen (customers_nick),
  KEY idx_newsletter_zen (customers_newsletter)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table customers_basket
#

DROP TABLE IF EXISTS customers_basket;
CREATE TABLE customers_basket (
  customers_basket_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  products_id tinytext NOT NULL,
  customers_basket_quantity float NOT NULL default '0',
  final_price decimal(15,4) NOT NULL default '0.0000',
  customers_basket_date_added varchar(8) default NULL,
  PRIMARY KEY  (customers_basket_id),
  KEY idx_customers_id_zen (customers_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table customers_basket_attributes
#

DROP TABLE IF EXISTS customers_basket_attributes;
CREATE TABLE customers_basket_attributes (
  customers_basket_attributes_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  products_id tinytext NOT NULL,
  products_options_id varchar(64) NOT NULL default '0',
  products_options_value_id int(11) NOT NULL default '0',
  products_options_value_text BLOB NULL default NULL,
  products_options_sort_order text NOT NULL,
  PRIMARY KEY  (customers_basket_attributes_id),
  KEY idx_cust_id_prod_id_zen (customers_id,products_id(36))
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table customers_info
#

DROP TABLE IF EXISTS customers_info;
CREATE TABLE customers_info (
  customers_info_id int(11) NOT NULL default '0',
  customers_info_date_of_last_logon datetime default NULL,
  customers_info_number_of_logons int(5) default NULL,
  customers_info_date_account_created datetime default NULL,
  customers_info_date_account_last_modified datetime default NULL,
  global_product_notifications int(1) default '0',
  PRIMARY KEY  (customers_info_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table db_cache
#
DROP TABLE IF EXISTS db_cache;
CREATE TABLE db_cache (
  cache_entry_name varchar(64) NOT NULL,
  cache_data blob,
  cache_entry_created int(15),
  PRIMARY KEY  (cache_entry_name)
) TYPE=MyISAM;


# --------------------------------------------------------


# Table structure for table email_archive

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
) TYPE=MyISAM;



#
# Table structure for table featured
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
  KEY idx_date_avail_zen (featured_date_available)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table files_uploaded
#

DROP TABLE IF EXISTS files_uploaded;
CREATE TABLE files_uploaded (
  files_uploaded_id int(11) NOT NULL auto_increment,
  sesskey varchar(32) default NULL,
  customers_id int(11) default NULL,
  files_uploaded_name varchar(64) NOT NULL default '',
  PRIMARY KEY  (files_uploaded_id),
  KEY idx_customers_id_zen (customers_id)
) TYPE=MyISAM COMMENT='Must always have either a sesskey or customers_id';

# --------------------------------------------------------

#
# Table structure for table geo_zones
#

DROP TABLE IF EXISTS geo_zones;
CREATE TABLE geo_zones (
  geo_zone_id int(11) NOT NULL auto_increment,
  geo_zone_name varchar(32) NOT NULL default '',
  geo_zone_description varchar(255) NOT NULL default '',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (geo_zone_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `get_terms_to_filter`
#
DROP TABLE IF EXISTS get_terms_to_filter;
CREATE TABLE get_terms_to_filter (
  get_term_name varchar(255) NOT NULL default '',
  PRIMARY KEY  (get_term_name)
) TYPE=MyISAM;

#
# Table structure for table geo_zones
#

DROP TABLE IF EXISTS group_pricing;
CREATE TABLE group_pricing (
  group_id int(11) NOT NULL auto_increment,
  group_name varchar(32) NOT NULL default '',
  group_percentage decimal(5,2) NOT NULL default '0',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (group_id)
) TYPE=MyISAM;
# --------------------------------------------------------


#
# Table structure for table ezpages
#

DROP TABLE IF EXISTS ezpages;
CREATE TABLE ezpages (
  pages_id int(11) NOT NULL auto_increment,
  languages_id int(11) NOT NULL default '1',
  pages_title varchar(64) NOT NULL default '',
  alt_url varchar(255) NOT NULL default '',
  alt_url_external varchar(255) NOT NULL default '',
  pages_html_text text,
  status_header int(1) NOT NULL default '1',
  status_sidebox int(1) NOT NULL default '1',
  status_footer int(1) NOT NULL default '1',
  status_toc int(1) NOT NULL default '1',
  header_sort_order int(3) NOT NULL default '0',
  sidebox_sort_order int(3) NOT NULL default '0',
  footer_sort_order int(3) NOT NULL default '0',
  toc_sort_order int(3) NOT NULL default '0',
  page_open_new_window int(1) NOT NULL default '0',
  page_is_ssl int(1) NOT NULL default '0',
  toc_chapter int(11) NOT NULL default '0',
  PRIMARY KEY  (pages_id),
  KEY idx_lang_id_zen (languages_id),
  KEY idx_ezp_status_header_zen (status_header),
  KEY idx_ezp_status_sidebox_zen (status_sidebox),
  KEY idx_ezp_status_footer_zen (status_footer),
  KEY idx_ezp_status_toc_zen (status_toc)
) TYPE=MyISAM;

#---------------------------------------------------

#
# Table structure for table languages
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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table layout_boxes
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
  PRIMARY KEY  (layout_id),
  KEY idx_name_template_zen (layout_template,layout_box_name),
  KEY idx_layout_box_status_zen (layout_box_status)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table manufacturers
#

DROP TABLE IF EXISTS manufacturers;
CREATE TABLE manufacturers (
  manufacturers_id int(11) NOT NULL auto_increment,
  manufacturers_name varchar(32) NOT NULL default '',
  manufacturers_image varchar(64) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (manufacturers_id),
  KEY idx_mfg_name_zen (manufacturers_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table manufacturers_info
#

DROP TABLE IF EXISTS manufacturers_info;
CREATE TABLE manufacturers_info (
  manufacturers_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  manufacturers_url varchar(255) NOT NULL default '',
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (manufacturers_id,languages_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table media_clips
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
  KEY idx_media_id_zen (media_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table media_manager
#

DROP TABLE IF EXISTS media_manager;
CREATE TABLE media_manager (
  media_id int(11) NOT NULL auto_increment,
  media_name varchar(255) NOT NULL default '',
  last_modified datetime NOT NULL default '0001-01-01 00:00:00',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (media_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table media_to_products
#

DROP TABLE IF EXISTS media_to_products;
CREATE TABLE media_to_products (
  media_id int(11) NOT NULL default '0',
  product_id int(11) NOT NULL default '0',
  KEY idx_media_product_zen (media_id,product_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table media_types
#

DROP TABLE IF EXISTS media_types;
CREATE TABLE media_types (
  type_id int(11) NOT NULL auto_increment,
  type_name varchar(64) NOT NULL default '',
  type_ext varchar(8) NOT NULL default '',
  PRIMARY KEY  (type_id)
) TYPE=MyISAM;

INSERT INTO media_types (type_name, type_ext) VALUES ('MP3','.mp3');

# -------------------------------------------------------

#
# Table structure for table meta_tags_categories_description
#

DROP TABLE IF EXISTS meta_tags_categories_description;
CREATE TABLE meta_tags_categories_description (
  categories_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  metatags_title VARCHAR(255) NOT NULL default '',
  metatags_keywords TEXT,
  metatags_description TEXT,
  PRIMARY KEY  (categories_id,language_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table meta_tags_products_description
#

DROP TABLE IF EXISTS meta_tags_products_description;
CREATE TABLE meta_tags_products_description (
  products_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  metatags_title VARCHAR(255) NOT NULL default '',
  metatags_keywords TEXT,
  metatags_description TEXT,
  PRIMARY KEY  (products_id,language_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table music_genre
#

DROP TABLE IF EXISTS music_genre;
CREATE TABLE music_genre (
  music_genre_id int(11) NOT NULL auto_increment,
  music_genre_name varchar(32) NOT NULL default '',
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (music_genre_id),
  KEY idx_music_genre_name_zen (music_genre_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table newsletters
#

DROP TABLE IF EXISTS newsletters;
CREATE TABLE newsletters (
  newsletters_id int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  content text NOT NULL,
  content_html TEXT NOT NULL,
  module varchar(255) NOT NULL default '',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  date_sent datetime default NULL,
  status int(1) default NULL,
  locked int(1) default '0',
  PRIMARY KEY  (newsletters_id)
) TYPE=MyISAM;

# --------------------------------------------------------


#
# Table structure for table orders
#

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  orders_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  customers_name varchar(64) NOT NULL default '',
  customers_company varchar(32) default NULL,
  customers_street_address varchar(64) NOT NULL default '',
  customers_suburb varchar(32) default NULL,
  customers_city varchar(32) NOT NULL default '',
  customers_postcode varchar(10) NOT NULL default '',
  customers_state varchar(32) default NULL,
  customers_country varchar(32) NOT NULL default '',
  customers_telephone varchar(32) NOT NULL default '',
  customers_email_address varchar(96) NOT NULL default '',
  customers_address_format_id int(5) NOT NULL default '0',
  delivery_name varchar(64) NOT NULL default '',
  delivery_company varchar(32) default NULL,
  delivery_street_address varchar(64) NOT NULL default '',
  delivery_suburb varchar(32) default NULL,
  delivery_city varchar(32) NOT NULL default '',
  delivery_postcode varchar(10) NOT NULL default '',
  delivery_state varchar(32) default NULL,
  delivery_country varchar(32) NOT NULL default '',
  delivery_address_format_id int(5) NOT NULL default '0',
  billing_name varchar(64) NOT NULL default '',
  billing_company varchar(32) default NULL,
  billing_street_address varchar(64) NOT NULL default '',
  billing_suburb varchar(32) default NULL,
  billing_city varchar(32) NOT NULL default '',
  billing_postcode varchar(10) NOT NULL default '',
  billing_state varchar(32) default NULL,
  billing_country varchar(32) NOT NULL default '',
  billing_address_format_id int(5) NOT NULL default '0',
  payment_method varchar(128) NOT NULL default '',
  payment_module_code varchar(32) NOT NULL default '',
  shipping_method varchar(128) NOT NULL default '',
  shipping_module_code varchar(32) NOT NULL default '',
  coupon_code varchar(32) NOT NULL default '',
  cc_type varchar(20) default NULL,
  cc_owner varchar(64) default NULL,
  cc_number varchar(32) default NULL,
  cc_expires varchar(4) default NULL,
  cc_cvv blob,
  last_modified datetime default NULL,
  date_purchased datetime default NULL,
  orders_status int(5) NOT NULL default '0',
  orders_date_finished datetime default NULL,
  currency char(3) default NULL,
  currency_value decimal(14,6) default NULL,
  order_total decimal(14,2) default NULL,
  order_tax decimal(14,2) default NULL,
  paypal_ipn_id int(11) NOT NULL default '0',
  ip_address varchar(96) NOT NULL default '',
  PRIMARY KEY  (orders_id),
  KEY idx_status_orders_cust_zen (orders_status,orders_id,customers_id)
) TYPE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table orders_products
#

DROP TABLE IF EXISTS orders_products;
CREATE TABLE orders_products (
  orders_products_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  products_id int(11) NOT NULL default '0',
  products_model varchar(32) default NULL,
  products_name varchar(64) NOT NULL default '',
  products_price decimal(15,4) NOT NULL default '0.0000',
  final_price decimal(15,4) NOT NULL default '0.0000',
  products_tax decimal(7,4) NOT NULL default '0.0000',
  products_quantity float NOT NULL default '0',
  onetime_charges decimal(15,4) NOT NULL default '0.0000',
  products_priced_by_attribute tinyint(1) NOT NULL default '0',
  product_is_free tinyint(1) NOT NULL default '0',
  products_discount_type tinyint(1) NOT NULL default '0',
  products_discount_type_from tinyint(1) NOT NULL default '0',
  products_prid tinytext NOT NULL,
  PRIMARY KEY  (orders_products_id),
  KEY idx_orders_id_prod_id_zen (orders_id,products_id)
) TYPE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table orders_products_attributes
#

DROP TABLE IF EXISTS orders_products_attributes;
CREATE TABLE orders_products_attributes (
  orders_products_attributes_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_products_id int(11) NOT NULL default '0',
  products_options varchar(32) NOT NULL default '',
  products_options_values BLOB NOT NULL default '',
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
  KEY idx_orders_id_prod_id_zen (orders_id , orders_products_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table orders_products_download
#

DROP TABLE IF EXISTS orders_products_download;
CREATE TABLE orders_products_download (
  orders_products_download_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_products_id int(11) NOT NULL default '0',
  orders_products_filename varchar(255) NOT NULL default '',
  download_maxdays int(2) NOT NULL default '0',
  download_count int(2) NOT NULL default '0',
  products_prid tinytext NOT NULL,
  PRIMARY KEY  (orders_products_download_id),
  KEY idx_orders_id_zen (orders_id),
  KEY idx_orders_products_id_zen (orders_products_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table orders_status
#

DROP TABLE IF EXISTS orders_status;
CREATE TABLE orders_status (
  orders_status_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  orders_status_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (orders_status_id,language_id),
  KEY idx_orders_status_name_zen (orders_status_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table orders_status_history
#

DROP TABLE IF EXISTS orders_status_history;
CREATE TABLE orders_status_history (
  orders_status_history_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_status_id int(5) NOT NULL default '0',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  customer_notified int(1) default '0',
  comments text,
  PRIMARY KEY  (orders_status_history_id),
  KEY idx_orders_id_status_id_zen (orders_id,orders_status_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table orders_total
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
  KEY idx_ot_class_zen (class)
) TYPE=MyISAM;

# --------------------------------------------------------


DROP TABLE IF EXISTS paypal_session;
CREATE TABLE paypal_session (
  unique_id int(11) NOT NULL auto_increment,
  session_id text NOT NULL,
  saved_session blob NOT NULL,
  expiry int(17) NOT NULL default '0',
  PRIMARY KEY  (unique_id),
  KEY idx_session_id_zen (session_id(36))
) TYPE=MyISAM;


DROP TABLE IF EXISTS paypal;
CREATE TABLE paypal (
  paypal_ipn_id int(11) unsigned NOT NULL auto_increment,
  zen_order_id int(11) unsigned NOT NULL default '0',
  txn_type varchar(10) NOT NULL default '',
  reason_code varchar(15) default NULL,
  payment_type varchar(7) NOT NULL default '',
  payment_status varchar(17) NOT NULL default '',
  pending_reason varchar(14) default NULL,
  invoice varchar(64) default NULL,
  mc_currency char(3) NOT NULL default '',
  first_name varchar(32) NOT NULL default '',
  last_name varchar(32) NOT NULL default '',
  payer_business_name varchar(64) default NULL,
  address_name varchar(32) default NULL,
  address_street varchar(64) default NULL,
  address_city varchar(32) default NULL,
  address_state varchar(32) default NULL,
  address_zip varchar(10) default NULL,
  address_country varchar(64) default NULL,
  address_status varchar(11) default NULL,
  payer_email varchar(96) NOT NULL default '',
  payer_id varchar(32) NOT NULL default '',
  payer_status varchar(10) NOT NULL default '',
  payment_date datetime NOT NULL default '0001-01-01 00:00:00',
  business varchar(96) NOT NULL default '',
  receiver_email varchar(96) NOT NULL default '',
  receiver_id varchar(32) NOT NULL default '',
  txn_id varchar(17) NOT NULL default '',
  parent_txn_id varchar(17) default NULL,
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
  PRIMARY KEY (paypal_ipn_id,txn_id),
  KEY idx_zen_order_id_zen (zen_order_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS paypal_testing;
CREATE TABLE paypal_testing (
  paypal_ipn_id int(11) unsigned NOT NULL auto_increment,
  zen_order_id int(11) unsigned NOT NULL default '0',
  custom varchar(255) NOT NULL default '',
  txn_type varchar(10) NOT NULL default '',
  reason_code varchar(15) default NULL,
  payment_type varchar(7) NOT NULL default '',
  payment_status varchar(17) NOT NULL default '',
  pending_reason varchar(14) default NULL,
  invoice varchar(64) default NULL,
  mc_currency char(3) NOT NULL default '',
  first_name varchar(32) NOT NULL default '',
  last_name varchar(32) NOT NULL default '',
  payer_business_name varchar(64) default NULL,
  address_name varchar(32) default NULL,
  address_street varchar(64) default NULL,
  address_city varchar(32) default NULL,
  address_state varchar(32) default NULL,
  address_zip varchar(10) default NULL,
  address_country varchar(64) default NULL,
  address_status varchar(11) default NULL,
  payer_email varchar(96) NOT NULL default '',
  payer_id varchar(32) NOT NULL default '',
  payer_status varchar(10) NOT NULL default '',
  payment_date datetime NOT NULL default '0001-01-01 00:00:00',
  business varchar(96) NOT NULL default '',
  receiver_email varchar(96) NOT NULL default '',
  receiver_id varchar(32) NOT NULL default '',
  txn_id varchar(17) NOT NULL default '',
  parent_txn_id varchar(17) default NULL,
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
  KEY idx_zen_order_id_zen (zen_order_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS paypal_payment_status;
CREATE TABLE paypal_payment_status (
  payment_status_id int(11) NOT NULL auto_increment,
  payment_status_name varchar(64) NOT NULL default '',
  PRIMARY KEY (payment_status_id)
) TYPE=MyISAM;

INSERT INTO paypal_payment_status VALUES (1, 'Completed');
INSERT INTO paypal_payment_status VALUES (2, 'Pending');
INSERT INTO paypal_payment_status VALUES (3, 'Failed');
INSERT INTO paypal_payment_status VALUES (4, 'Denied');
INSERT INTO paypal_payment_status VALUES (5, 'Refunded');
INSERT INTO paypal_payment_status VALUES (6, 'Canceled_Reversal');
INSERT INTO paypal_payment_status VALUES (7, 'Reversed');


DROP TABLE IF EXISTS paypal_payment_status_history;
CREATE TABLE paypal_payment_status_history (
  payment_status_history_id int(11) NOT NULL auto_increment,
  paypal_ipn_id int(11) NOT NULL default '0',
  txn_id varchar(64) NOT NULL default '',
  parent_txn_id varchar(64) NOT NULL default '',
  payment_status varchar(17) NOT NULL default '',
  pending_reason varchar(14) default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY (payment_status_history_id),
  KEY idx_paypal_ipn_id_zen (paypal_ipn_id)
) TYPE=MyISAM;



# --------------------------------------------------------

#
# Table structure for table product_music_extra
#

DROP TABLE IF EXISTS product_music_extra;
CREATE TABLE product_music_extra (
  products_id int(11) NOT NULL default '0',
  artists_id int(11) NOT NULL default '0',
  record_company_id int(11) NOT NULL default '0',
  music_genre_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_id),
  KEY idx_music_genre_id_zen (music_genre_id)
) TYPE=MyISAM;


# --------------------------------------------------------

DROP TABLE IF EXISTS product_type_layout;
CREATE TABLE product_type_layout (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title text NOT NULL,
  configuration_key varchar(255) NOT NULL default '',
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
  KEY idx_key_value_zen (configuration_key, configuration_value(10))
  )TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table product_types
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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table product_types_to_category
#

DROP TABLE IF EXISTS product_types_to_category;
CREATE TABLE product_types_to_category (
  product_type_id int(11) NOT NULL default '0',
  category_id int(11) NOT NULL default '0',
  KEY idx_category_id_zen (category_id),
  KEY idx_product_type_id_zen (product_type_id)
) TYPE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table products
#

DROP TABLE IF EXISTS products;
CREATE TABLE products (
  products_id int(11) NOT NULL auto_increment,
  products_type int(11) NOT NULL default '1',
  products_quantity float NOT NULL default '0',
  products_model varchar(32) default NULL,
  products_image varchar(64) default NULL,
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
  KEY idx_products_status_zen (products_status)
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table products_attributes
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
  attributes_image varchar(64) default NULL,
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
  KEY idx_id_options_id_values_zen (products_id,options_id,options_values_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_attributes_download
#

DROP TABLE IF EXISTS products_attributes_download;
CREATE TABLE products_attributes_download (
  products_attributes_id int(11) NOT NULL default '0',
  products_attributes_filename varchar(255) NOT NULL default '',
  products_attributes_maxdays int(2) default '0',
  products_attributes_maxcount int(2) default '0',
  PRIMARY KEY  (products_attributes_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_description
#

DROP TABLE IF EXISTS products_description;
CREATE TABLE products_description (
  products_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  products_name varchar(64) NOT NULL default '',
  products_description text,
  products_url varchar(255) default NULL,
  products_viewed int(5) default '0',
  PRIMARY KEY  (products_id,language_id),
  KEY idx_products_name_zen (products_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_discount_quantity
#
DROP TABLE IF EXISTS products_discount_quantity;
CREATE TABLE products_discount_quantity (
  discount_id int(4) NOT NULL default '0',
  products_id int(11) NOT NULL default '0',
  discount_qty float NOT NULL default '0',
  discount_price decimal(15,4) NOT NULL default '0.0000',
  KEY idx_id_qty_zen (products_id,discount_qty)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_notifications
#

DROP TABLE IF EXISTS products_notifications;
CREATE TABLE products_notifications (
  products_id int(11) NOT NULL default '0',
  customers_id int(11) NOT NULL default '0',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (products_id,customers_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_options
#

DROP TABLE IF EXISTS products_options;
CREATE TABLE products_options (
  products_options_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  products_options_name varchar(32) NOT NULL default '',
  products_options_sort_order int(11) NOT NULL default '0',
  products_options_type int(5) NOT NULL default '0',
  products_options_length smallint(2) NOT NULL default '32',
  products_options_comment varchar(64) default NULL,
  products_options_size smallint(2) NOT NULL default '32',
  products_options_images_per_row int(2) default '5',
  products_options_images_style int(1) default '0',
  products_options_rows smallint(2) NOT NULL default '1',
  PRIMARY KEY  (products_options_id,language_id),
  KEY idx_lang_id_zen (language_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_options_types
#

DROP TABLE IF EXISTS products_options_types;
CREATE TABLE products_options_types (
  products_options_types_id int(11) NOT NULL default '0',
  products_options_types_name varchar(32) default NULL,
  PRIMARY KEY  (products_options_types_id)
) TYPE=MyISAM COMMENT='Track products_options_types';

# --------------------------------------------------------

#
# Table structure for table products_options_values
#

DROP TABLE IF EXISTS products_options_values;
CREATE TABLE products_options_values (
  products_options_values_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  products_options_values_name varchar(64) NOT NULL default '',
  products_options_values_sort_order int(11) NOT NULL default '0',
  PRIMARY KEY (products_options_values_id,language_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_options_values_to_products_options
#

DROP TABLE IF EXISTS products_options_values_to_products_options;
CREATE TABLE products_options_values_to_products_options (
  products_options_values_to_products_options_id int(11) NOT NULL auto_increment,
  products_options_id int(11) NOT NULL default '0',
  products_options_values_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_options_values_to_products_options_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_to_categories
#

DROP TABLE IF EXISTS products_to_categories;
CREATE TABLE products_to_categories (
  products_id int(11) NOT NULL default '0',
  categories_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_id,categories_id),
  KEY idx_cat_prod_id_zen (categories_id,products_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `project_version`
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
) TYPE=MyISAM COMMENT='Database Version Tracking';


# --------------------------------------------------------

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
) TYPE=MyISAM COMMENT='Database Version Tracking History';

# --------------------------------------------------------

#
# Create table for query_builder tool (audiences.php)
#
DROP TABLE IF EXISTS query_builder;
CREATE TABLE query_builder (
query_id int(11) NOT NULL auto_increment ,
query_category varchar(40) NOT NULL default '' ,
query_name varchar(80) NOT NULL default '' ,
query_description TEXT NOT NULL default '' ,
query_string TEXT NOT NULL default '' ,
query_keys_list TEXT NOT NULL default '' ,
PRIMARY KEY  (query_id) ,
UNIQUE KEY query_name (query_name)
) Type=MyISAM COMMENT = 'Stores queries for re-use in Admin email and report modules';

# --------------------------------------------------------

#
# Table structure for table record_artists
#

DROP TABLE IF EXISTS record_artists;
CREATE TABLE record_artists (
  artists_id int(11) NOT NULL auto_increment,
  artists_name varchar(32) NOT NULL default '',
  artists_image varchar(64) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (artists_id),
  KEY idx_rec_artists_name_zen (artists_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table record_artists_info
#

DROP TABLE IF EXISTS record_artists_info;
CREATE TABLE record_artists_info (
  artists_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  artists_url varchar(255) NOT NULL default '',
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (artists_id,languages_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table record_company
#

DROP TABLE IF EXISTS record_company;
CREATE TABLE record_company (
  record_company_id int(11) NOT NULL auto_increment,
  record_company_name varchar(32) NOT NULL default '',
  record_company_image varchar(64) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (record_company_id),
  KEY idx_rec_company_name_zen (record_company_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table record_company_info
#

DROP TABLE IF EXISTS record_company_info;
CREATE TABLE record_company_info (
  record_company_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  record_company_url varchar(255) NOT NULL default '',
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (record_company_id,languages_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table reviews
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
  KEY idx_customers_id_zen (customers_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table reviews_description
#

DROP TABLE IF EXISTS reviews_description;
CREATE TABLE reviews_description (
  reviews_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  reviews_text text NOT NULL,
  PRIMARY KEY  (reviews_id,languages_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table salemaker_sales
#

DROP TABLE IF EXISTS salemaker_sales;
CREATE TABLE salemaker_sales (
  sale_id int(11) NOT NULL auto_increment,
  sale_status tinyint(4) NOT NULL default '0',
  sale_name varchar(30) NOT NULL default '',
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
  KEY idx_sale_status_zen (sale_status)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table sessions
#

DROP TABLE IF EXISTS sessions;
CREATE TABLE sessions (
  sesskey varchar(32) NOT NULL default '',
  expiry int(11) unsigned NOT NULL default '0',
  value text NOT NULL,
  PRIMARY KEY  (sesskey)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table specials
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
  KEY idx_date_avail_zen (specials_date_available)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table tax_class
#

DROP TABLE IF EXISTS tax_class;
CREATE TABLE tax_class (
  tax_class_id int(11) NOT NULL auto_increment,
  tax_class_title varchar(32) NOT NULL default '',
  tax_class_description varchar(255) NOT NULL default '',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (tax_class_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table tax_rates
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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table template_select
#

DROP TABLE IF EXISTS template_select;
CREATE TABLE template_select (
  template_id int(11) NOT NULL auto_increment,
  template_dir varchar(64) NOT NULL default '',
  template_language varchar(64) NOT NULL default '0',
  PRIMARY KEY  (template_id),
  KEY idx_tpl_lang_zen (template_language)
) TYPE=MyISAM;

# --------------------------------------------------------


#
# Table structure for table whos_online
#

DROP TABLE IF EXISTS whos_online;
CREATE TABLE whos_online (
  customer_id int(11) default NULL,
  full_name varchar(64) NOT NULL default '',
  session_id varchar(128) NOT NULL default '',
  ip_address varchar(15) NOT NULL default '',
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
  KEY idx_last_page_url_zen (last_page_url)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table zones
#

DROP TABLE IF EXISTS zones;
CREATE TABLE zones (
  zone_id int(11) NOT NULL auto_increment,
  zone_country_id int(11) NOT NULL default '0',
  zone_code varchar(32) NOT NULL default '',
  zone_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (zone_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table zones_to_geo_zones
#

DROP TABLE IF EXISTS zones_to_geo_zones;
CREATE TABLE zones_to_geo_zones (
  association_id int(11) NOT NULL auto_increment,
  zone_country_id int(11) NOT NULL default '0',
  zone_id int(11) default NULL,
  geo_zone_id int(11) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (association_id)
) TYPE=MyISAM;


#
# Database table for customers_wishlist
#

DROP TABLE IF EXISTS customers_wishlist;
CREATE TABLE customers_wishlist (
  products_id int(13) NOT NULL default '0',
  customers_id int(13) NOT NULL default '0',
  products_model varchar(13) default NULL,
  products_name varchar(64) NOT NULL default '',
  products_price decimal(8,2) NOT NULL default '0.00',
  final_price decimal(8,2) NOT NULL default '0.00',
  products_quantity int(2) NOT NULL default '0',
  wishlist_name varchar(64) default NULL
) TYPE=MyISAM;


















# data
INSERT INTO template_select VALUES (1, 'classic', '0');

# 1 - Default, 2 - USA, 3 - Spain, 4 - Singapore, 5 - Germany
INSERT INTO address_format VALUES (1, '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country','$city / $country');
INSERT INTO address_format VALUES (2, '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country','$city, $state / $country');
INSERT INTO address_format VALUES (3, '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','$state / $country');
INSERT INTO address_format VALUES (4, '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
INSERT INTO address_format VALUES (5, '$firstname $lastname$cr$streets$cr$postcode $city$cr$country','$city / $country');

INSERT INTO admin VALUES (1, 'Admin', 'admin@localhost', '351683ea4e19efe34874b501fdbf9792:9b', 1);

INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Zen Cart', 'http://www.zen-cart.com', 'banners/zencart_468_60_02.gif', 'Wide-Banners', '', 0, NULL, NULL, '2004-01-11 20:59:12', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Zen Cart the art of e-commerce', 'http://www.zen-cart.com', 'banners/125zen_logo.gif', 'SideBox-Banners', '', 0, NULL, NULL, '2004-01-11 20:59:12', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Zen Cart the art of e-commerce', 'http://www.zen-cart.com', 'banners/125x125_zen_logo.gif', 'SideBox-Banners', '', 0, NULL, NULL, '2004-01-11 20:59:12', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('if you have to think ... you haven''t been Zenned!', 'http://www.zen-cart.com', 'banners/think_anim.gif', 'Wide-Banners', '', 0, NULL, NULL, '2004-01-12 20:53:18', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Sashbox.net - the ultimate e-commerce hosting solution', 'http://www.sashbox.net/zencart/', 'banners/sashbox_125x50.jpg', 'BannersAll', '', 0, NULL, NULL, '2005-05-13 10:53:50', NULL, 1, 1, 1, 20);
INSERT INTO banners (banners_id, banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES (6, 'FiloSoFisch_468', 'http://www.filosofisch.com/categories/247_261.html', '', 'Wide-Banners', '<!--Start Partnerprogramm FiloSoFisch.com -->\r\n<a href="http://www.filosofisch.com/categories/247_261.html?partner=155004" target="_blank"> <img border="0" src="http://www.filosofisch.com/banner/filosofisch_468x60.gif" alt="FiloSoFisch.com - Zen-Cart gratis vorinstalliert"> </a>', 0, NULL, NULL, '2005-08-25 09:17:42', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_id, banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES (7, 'FiloSoFisch_130', 'http://www.filosofisch.com/categories/247_261.html?partner=155004', '', 'SideBox-Banners', '<!--Start Partnerprogramm FiloSoFisch.com -->\r\n<a href="http://www.filosofisch.com/categories/247_261.html?partner=155004" target="_blank"> <img border="0" src="http://www.filosofisch.com/banner/filosofisch_130x210.gif" alt="FiloSoFisch.com - Zen-Cart gratis vorinstalliert"> </a>', 0, NULL, NULL, '2005-08-25 09:29:54', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Sashbox.net - the ultimate e-commerce hosting solution', 'http://www.sashbox.net/zencart/', 'banners/sashbox_468x60.jpg', 'Wide-Banners', '', 0, NULL, NULL, '2005-05-13 10:55:11', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Start Accepting Credit Cards For Your Business Today!', 'http://www.zen-cart.com/modules/freecontent/index.php?id=29', 'banners/cardsvcs_468x60.gif', 'Wide-Banners', '', 0, NULL, NULL, '2006-03-13 11:02:43', NULL, 1, 1, 1, 0);



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Store Name', 'STORE_NAME', 'Zen Cart', 'The name of my store', '1', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Store Owner', 'STORE_OWNER', 'Team Zen Cart', 'The name of my store owner', '1', '2', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Country', 'STORE_COUNTRY', '223', 'The country my store is located in <br /><br /><strong>Note: Please remember to update the store zone.</strong>', '1', '6', 'zen_get_country_name', 'zen_cfg_pull_down_country_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Zone', 'STORE_ZONE', '18', 'The zone my store is located in', '1', '7', 'zen_cfg_get_zone_name', 'zen_cfg_pull_down_zone_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Expected Sort Order', 'EXPECTED_PRODUCTS_SORT', 'desc', 'This is the sort order used in the expected products box.', '1', '8', 'zen_cfg_select_option(array(\'asc\', \'desc\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Expected Sort Field', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'The column to sort by in the expected products box.', '1', '9', 'zen_cfg_select_option(array(\'products_name\', \'date_expected\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Switch To Default Language Currency', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', 'Automatically switch to the language\'s currency when it is changed', '1', '10', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Language Selector', 'LANGUAGE_DEFAULT_SELECTOR', 'Default', 'Should the default language be based on the Store preferences, or the customer\'s browser settings?<br /><br />Default: Store\'s default settings', '1', '11', 'zen_cfg_select_option(array(\'Default\', \'Browser\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use Search-Engine Safe URLs (still in development)', 'SEARCH_ENGINE_FRIENDLY_URLS', 'false', 'Use search-engine safe urls for all site links', '6', '12', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Cart After Adding Product', 'DISPLAY_CART', 'true', 'Display the shopping cart after adding a product (or return back to their origin)', '1', '14', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Default Search Operator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Default search operators', '1', '17', 'zen_cfg_select_option(array(\'and\', \'or\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Address and Phone', 'STORE_NAME_ADDRESS', 'Store Name\nAddress\nCountry\nPhone', 'This is the Store Name, Address and Phone used on printable documents and displayed online', '1', '18', 'zen_cfg_textarea(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Category Counts', 'SHOW_COUNTS', 'true', 'Count recursively how many products are in each category', '1', '19', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Tax Decimal Places', 'TAX_DECIMAL_PLACES', '0', 'Pad the tax value this amount of decimal places', '1', '20', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Prices with Tax', 'DISPLAY_PRICE_WITH_TAX', 'false', 'Display prices with tax included (true) or add the tax at the end (false)', '1', '21', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Prices with Tax in Admin', 'DISPLAY_PRICE_WITH_TAX_ADMIN', 'false', 'Display prices with tax included (true) or add the tax at the end (false) in Admin(Invoices)', '1', '21', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Basis of Product Tax', 'STORE_PRODUCT_TAX_BASIS', 'Shipping', 'On what basis is Product Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone', '1', '21', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Basis of Shipping Tax', 'STORE_SHIPPING_TAX_BASIS', 'Shipping', 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone - Can be overriden by correctly written Shipping Module', '1', '21', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Sales Tax Display Status', 'STORE_TAX_DISPLAY_STATUS', '0', 'Always show Sales Tax even when amount is $0.00?<br />0= Off<br />1= On', '1', '21', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Admin Session Time Out in Seconds', 'SESSION_TIMEOUT_ADMIN', '3600', 'Enter the time in seconds. Default=3600<br />Example: 3600= 1 hour<br /><br />Note: Too few seconds can result in timeout issues when adding/editing products', 1, 40, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Admin Set max_execution_time for processes', 'GLOBAL_SET_TIME_LIMIT', '60', 'Enter the time in seconds for how long the max_execution_time of processes should be. Default=60<br />Example: 60= 1 minute<br /><br />Note: Changing the time limit is only needed if you are having problems with the execution time of a process', 1, 42, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show if version update available', 'SHOW_VERSION_UPDATE_IN_HEADER', 'true', 'Automatically check to see if a new version of Zen Cart is available. Enabling this can sometimes slow down the loading of Admin pages. (Displayed on main Index page after login, and Server Info page.)', 1, 44, 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Status', 'STORE_STATUS', '0', 'What is your Store Status<br />0= Normal Store<br />1= Showcase no prices<br />2= Showcase with prices', '1', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Server Uptime', 'DISPLAY_SERVER_UPTIME', 'true', 'Displaying Server uptime can cause entries in error logs on some servers. (true = Display, false = don\'t display)', 1, 46, '2003-11-08 20:24:47', '0001-01-01 00:00:00', '', 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Missing Page Check', 'MISSING_PAGE_CHECK', 'true', 'Zen Cart can check for missing pages in the URL and redirect to Index page. For debugging you may want to turn this off. <br /><br /><strong>Default=On</strong><br />On = Send missing pages to \'index\'<br />Off = Don\'t check for missing pages<br />Page Not Found = display the Page-Not-Found page', 1, 48, '2003-11-08 20:24:47', '0001-01-01 00:00:00', '', 'zen_cfg_select_option(array(\'On\', \'Off\', \'Page Not Found\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('HTML Editor', 'HTML_EDITOR_PREFERENCE', 'NONE', 'Please select the HTML/Rich-Text editor you wish to use for composing Admin-related emails, newsletters, and product descriptions', '1', '110', 'zen_cfg_select_option(array(\'HTMLAREA\', \'NONE\'),', now());
#phpbb
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable phpBB linkage?', 'PHPBB_LINKS_ENABLED', 'false', 'Should Zen Cart synchronize new account information to your (already-installed) phpBB forum?', '1', '120', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Category Counts - Admin', 'SHOW_COUNTS_ADMIN', 'true', 'Show Category Counts in Admin?', '1', '130', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('First Name', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', 'Minimum length of first name', '2', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Last Name', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Minimum length of last name', '2', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Date of Birth', 'ENTRY_DOB_MIN_LENGTH', '10', 'Minimum length of date of birth', '2', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail Address', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Minimum length of e-mail address', '2', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Street Address', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Minimum length of street address', '2', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Company', 'ENTRY_COMPANY_MIN_LENGTH', '2', 'Minimum length of company name', '2', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Post Code', 'ENTRY_POSTCODE_MIN_LENGTH', '4', 'Minimum length of post code', '2', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('City', 'ENTRY_CITY_MIN_LENGTH', '3', 'Minimum length of city', '2', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('State', 'ENTRY_STATE_MIN_LENGTH', '2', 'Minimum length of state', '2', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Telephone Number', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', 'Minimum length of telephone number', '2', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Password', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Minimum length of password', '2', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card Owner Name', 'CC_OWNER_MIN_LENGTH', '3', 'Minimum length of credit card owner name', '2', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card Number', 'CC_NUMBER_MIN_LENGTH', '10', 'Minimum length of credit card number', '2', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card CVV Number', 'CC_CVV_MIN_LENGTH', '3', 'Minimum length of credit card CVV number', '2', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Review Text', 'REVIEW_TEXT_MIN_LENGTH', '50', 'Minimum length of product review text', '2', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Best Sellers', 'MIN_DISPLAY_BESTSELLERS', '1', 'Minimum number of best sellers to display', '2', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Also Purchased Products', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Minimum number of products to display in the \'This Customer Also Purchased\' box', '2', '16', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Nick Name', 'ENTRY_NICK_MIN_LENGTH', '3', 'Minimum length of Nick Name', '2', '1', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Address Book Entries', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Maximum address book entries a customer is allowed to have', '3', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Search Results Per Page', 'MAX_DISPLAY_SEARCH_RESULTS', '20', 'Number of products to list on a search result page', '3', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Prev/Next Navigation Page Links', 'MAX_DISPLAY_PAGE_LINKS', '5', 'Number of \'number\' links use for page-sets', '3', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products on Special ', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '9', 'Number of products on special to display', '3', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Products Module', 'MAX_DISPLAY_NEW_PRODUCTS', '9', 'Number of new products to display in a category', '3', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Upcoming Products ', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '10', 'Number of \'upcoming\' products to display', '3', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Manufacturers List - Scroll Box Size/Style', 'MAX_MANUFACTURERS_LIST', '3', 'Number of manufacturers names to be displayed in the scroll box window. Setting this to 1 or 0 will display a dropdown list.', '3', '7', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Manufacturers List - Verify Product Exist', 'PRODUCTS_MANUFACTURERS_STATUS', '1', 'Verify that at least 1 product exists and is active for the manufacturer name to show<br /><br />Note: When this feature is ON it can produce slower results on sites with a large number of products and/or manufacturers<br />0= off 1= on', 3, 7, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Music Genre List - Scroll Box Size/Style', 'MAX_MUSIC_GENRES_LIST', '3', 'Number of music genre names to be displayed in the scroll box window. Setting this to 1 or 0 will display a dropdown list.', '3', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Record Company List - Scroll Box Size/Style', 'MAX_RECORD_COMPANY_LIST', '3', 'Number of record company names to be displayed in the scroll box window. Setting this to 1 or 0 will display a dropdown list.', '3', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Length of Record Company Name', 'MAX_DISPLAY_RECORD_COMPANY_NAME_LEN', '15', 'Used in record companies box; maximum length of record company name to display. Longer names will be truncated.', '3', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Length of Music Genre Name', 'MAX_DISPLAY_MUSIC_GENRES_NAME_LEN', '15', 'Used in music genres box; maximum length of music genre name to display. Longer names will be truncated.', '3', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Length of Manufacturers Name', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Used in manufacturers box; maximum length of manufacturers name to display. Longer names will be truncated.', '3', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Product Reviews Per Page', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Number of new reviews to display on each page', '3', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random Product Reviews For Box', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'Number of random product reviews to rotate in the box', '3', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random New Products For Box', 'MAX_RANDOM_SELECT_NEW', '10', 'Number of random new product to display in box', '3', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random Products On Special For Box', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'Number of random products on special to display in box', '3', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Categories To List Per Row', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', 'How many categories to list per row', '3', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Products Listing- Number Per Page', 'MAX_DISPLAY_PRODUCTS_NEW', '10', 'Number of new products\' listings per page', '3', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Best Sellers For Box', 'MAX_DISPLAY_BESTSELLERS', '10', 'Number of best sellers to display in box', '3', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Also Purchased Products', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Number of products to display in the \'This Customer Also Purchased\' box', '3', '16', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Recent Purchases Box- NOTE: box is disabled ', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', 'Number of products to display in the recent purchases box', '3', '17', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Customer Order History List Per Page', 'MAX_DISPLAY_ORDER_HISTORY', '10', 'Number of orders to display in the order history list in \'My Account\'', '3', '18', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Customers on Customers Page', 'MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER', '20', '', 3, 19, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Orders on Orders Page', 'MAX_DISPLAY_SEARCH_RESULTS_ORDERS', '20', '', 3, 20, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Products on Reports', 'MAX_DISPLAY_SEARCH_RESULTS_REPORTS', '20', '', 3, 21, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Categories Products Display List', 'MAX_DISPLAY_RESULTS_CATEGORIES', '10', 'Number of products to list per screen', 3, 22, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Listing- Number Per Page', 'MAX_DISPLAY_PRODUCTS_LISTING', '10', 'Maximum Number of Products to list per page on main page', '3', '30', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Attributes - Option Names and Values Display', 'MAX_ROW_LISTS_OPTIONS', '10', 'Maximum number of option names and values to display in the products attributes page', '3', '24', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Attributes - Attributes Controller Display', 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER', '30', 'Maximum number of attributes to display in the Attributes Controller page', '3', '25', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Attributes - Downloads Manager Display', 'MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER', '30', 'Maximum number of attributes downloads to display in the Downloads Manager page', '3', '26', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Featured Products - Number to Display Admin', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN', '10', 'Number of featured products to list per screen - Admin', 3, 27, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Featured Products - Main Page', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED', '9', 'Number of featured products to list on main page', 3, 28, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Featured Products Page', 'MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS', '10', 'Number of featured products to list per screen', 3, 29, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random Featured Products For Box', 'MAX_RANDOM_SELECT_FEATURED_PRODUCTS', '10', 'Number of random featured products to display in box', '3', '30', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Specials Products - Main Page', 'MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX', '9', 'Number of special products to list on main page', 3, 31, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('New Product Listing - Limited to ...', 'SHOW_NEW_PRODUCTS_LIMIT', '0', 'Limit the New Product Listing to<br />0= All Products<br />1= Current Month<br />7= 7 Days<br />14= 14 Days<br />30= 30 Days<br />60= 60 Days<br />90= 90 Days<br />120= 120 Days', '3', '40', 'zen_cfg_select_option(array(\'0\', \'1\', \'7\', \'14\', \'30\', \'60\', \'90\', \'120\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Products All Page', 'MAX_DISPLAY_PRODUCTS_ALL', '10', 'Number of products to list per screen', 3, 45, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Language Flags in Language Side Box', 'MAX_LANGUAGE_FLAGS_COLUMNS', '3', 'Number of Language Flags per Row', 3, 50, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum File Upload Size', 'MAX_FILE_UPLOAD_SIZE', '2048000', 'What is the Maximum file size for uploads?<br />Default= 2048000', 3, 60, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Allowed Filename Extensions for uploading', 'UPLOAD_FILENAME_EXTENSIONS', 'jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip', 'List the permissible filetypes (filename extensions) to be allowed when files are uploaded to your site by customers. Separate multiple values with commas(,). Do not include the dot(.).<br /><br />Suggested setting: "jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip"', '3', '61', 'zen_cfg_textarea(', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Orders Detail Display on Admin Orders Listing', 'MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING', '0', 'Maximum number of Order Details<br />0 = Unlimited', 3, 65, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum PayPal IPN Display on Admin Listing', 'MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN', '20', 'Maximum number of PayPal IPN Lisings in Admin<br />Default is 20', 3, 66, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display Columns Products to Multiple Categories Manager', 'MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS', '3', 'Maximum Display Columns Products to Multiple Categories Manager<br />3 = Default', 3, 70, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display EZ-Pages', 'MAX_DISPLAY_SEARCH_RESULTS_EZPAGE', '20', 'Maximum Display EZ-Pages<br />20 = Default', 3, 71, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Small Image Width', 'SMALL_IMAGE_WIDTH', '100', 'The pixel width of small images', '4', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Small Image Height', 'SMALL_IMAGE_HEIGHT', '80', 'The pixel height of small images', '4', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Heading Image Width - Admin', 'HEADING_IMAGE_WIDTH', '57', 'The pixel width of heading images in the Admin<br />NOTE: Presently, this adjusts the spacing on the pages in the Admin Pages or could be used to add images to the heading in the Admin', '4', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Heading Image Height - Admin', 'HEADING_IMAGE_HEIGHT', '40', 'The pixel height of heading images in the Admin<br />NOTE: Presently, this adjusts the spacing on the pages in the Admin Pages or could be used to add images to the heading in the Admin', '4', '4', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Subcategory Image Width', 'SUBCATEGORY_IMAGE_WIDTH', '100', 'The pixel width of subcategory images', '4', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Subcategory Image Height', 'SUBCATEGORY_IMAGE_HEIGHT', '57', 'The pixel height of subcategory images', '4', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Calculate Image Size', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calculate the size of images?', '4', '7', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image Required', 'IMAGE_REQUIRED', 'true', 'Enable to display broken images. Good for development.', '4', '8', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image - Shopping Cart Status', 'IMAGE_SHOPPING_CART_STATUS', '1', 'Show product image in the shopping cart?<br />0= off 1= on', 4, 9, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Shopping Cart Width', 'IMAGE_SHOPPING_CART_WIDTH', '50', 'Default = 50', 4, 10, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Shopping Cart Height', 'IMAGE_SHOPPING_CART_HEIGHT', '40', 'Default = 40', 4, 11, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Category Icon Image Width - Product Info Pages', 'CATEGORY_ICON_IMAGE_WIDTH', '57', 'The pixel width of Category Icon heading images for Product Info Pages', '4', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Category Icon Image Height - Product Info Pages', 'CATEGORY_ICON_IMAGE_HEIGHT', '40', 'The pixel height of Category Icon heading images for Product Info Pages', '4', '14', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Width', 'MEDIUM_IMAGE_WIDTH', '150', 'The pixel width of Product Info images', '4', '20', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Height', 'MEDIUM_IMAGE_HEIGHT', '120', 'The pixel height of Product Info images', '4', '21', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Medium Suffix', 'IMAGE_SUFFIX_MEDIUM', '_MED', 'Product Info Medium Image Suffix<br />Default = _MED', '4', '22', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Large Suffix', 'IMAGE_SUFFIX_LARGE', '_LRG', 'Product Info Large Image Suffix<br />Default = _LRG', '4', '23', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Number of Additional Images per Row', 'IMAGES_AUTO_ADDED', '3', 'Product Info - Enter the number of additional images to display per row<br />Default = 3', '4', '30', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product Listing Width', 'IMAGE_PRODUCT_LISTING_WIDTH', '100', 'Default = 100', 4, 40, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product Listing Height', 'IMAGE_PRODUCT_LISTING_HEIGHT', '80', 'Default = 80', 4, 41, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product New Listing Width', 'IMAGE_PRODUCT_NEW_LISTING_WIDTH', '100', 'Default = 100', 4, 42, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product New Listing Height', 'IMAGE_PRODUCT_NEW_LISTING_HEIGHT', '80', 'Default = 80', 4, 43, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - New Products Width', 'IMAGE_PRODUCT_NEW_WIDTH', '100', 'Default = 100', 4, 44, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - New Products Height', 'IMAGE_PRODUCT_NEW_HEIGHT', '80', 'Default = 80', 4, 45, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Featured Products Width', 'IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH', '100', 'Default = 100', 4, 46, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Featured Products Height', 'IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT', '80', 'Default = 80', 4, 47, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product All Listing Width', 'IMAGE_PRODUCT_ALL_LISTING_WIDTH', '100', 'Default = 100', 4, 48, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product All Listing Height', 'IMAGE_PRODUCT_ALL_LISTING_HEIGHT', '80', 'Default = 80', 4, 49, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Image - No Image Status', 'PRODUCTS_IMAGE_NO_IMAGE_STATUS', '1', 'Use automatic No Image when none is added to product<br />0= off<br />1= On', '4', '60', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Image - No Image picture', 'PRODUCTS_IMAGE_NO_IMAGE', 'no_picture.gif', 'Use automatic No Image when none is added to product<br />Default = no_picture.gif', '4', '61', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image - Use Proportional Images on Products and Categories', 'PROPORTIONAL_IMAGES_STATUS', '1', 'Use Proportional Images on Products and Categories?<br /><br />NOTE: Do not use 0 height or width settings for Proportion Images<br />0= off 1= on', 4, 75, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Email Salutation', 'ACCOUNT_GENDER', 'true', 'Display salutation choice during account creation and with account information', '5', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Date of Birth', 'ACCOUNT_DOB', 'true', 'Display date of birth field during account creation and with account information<br />NOTE: Set Minimum Value Date of Birth to blank for not required<br />Set Minimum Value Date of Birth > 0 to require', '5', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Company', 'ACCOUNT_COMPANY', 'true', 'Display company field during account creation and with account information', '5', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Address Line 2', 'ACCOUNT_SUBURB', 'true', 'Display address line 2 field during account creation and with account information', '5', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('State', 'ACCOUNT_STATE', 'true', 'Display state field during account creation and with account information', '5', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('State - Always display as pulldown?', 'ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN', 'false', 'When state field is displayed, should it always be a pulldown menu?', 5, '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Create Account Default Country ID', 'SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY', '223', 'Set Create Account Default Country ID to:<br />Default is 223', '5', '6', 'zen_get_country_name', 'zen_cfg_pull_down_country_list_none(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Fax Number', 'ACCOUNT_FAX_NUMBER', 'true', 'Display fax number field during account creation and with account information', '5', '10', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Newsletter Checkbox', 'ACCOUNT_NEWSLETTER_STATUS', '1', 'Show Newsletter Checkbox<br />0= off<br />1= Display Unchecked<br />2= Display Checked<br /><strong>Note: Defaulting this to accepted may be in violation of certain regulations for your state or country</strong>', 5, 45, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Default Email Preference', 'ACCOUNT_EMAIL_PREFERENCE', '0', 'Set the Default Customer Default Email Preference<br />0= Text<br />1= HTML<br /><strong>Note: Defaulting this to accepted may be in violation of certain regulations for your state or country</strong>', 5, 46, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Product Notification Status', 'CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS', '1', 'Customer should be asked about product notifications after checkout success<br />0= Never ask<br />1= Ask, unless already set to global<br /><br />Note: Sidebox must be turned off separately', '5', '50', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
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

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_PAYMENT_INSTALLED', 'cc.php;cod.php', 'List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cc.php;cod.php;paypal.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_gv.php;ot_coupon.php;ot_total.php', 'List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_SHIPPING_INSTALLED', 'flat.php', 'List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Cash On Delivery Module', 'MODULE_PAYMENT_COD_STATUS', 'True', 'Do you want to accept Cash On Delevery payments?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Payment Zone', 'MODULE_PAYMENT_COD_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort order of display.', 'MODULE_PAYMENT_COD_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Order Status', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Credit Card Module', 'MODULE_PAYMENT_CC_STATUS', 'True', 'Do you want to accept credit card payments?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Split Credit Card E-Mail Address', 'MODULE_PAYMENT_CC_EMAIL', '', 'If an e-mail address is entered, the middle digits of the credit card number will be sent to the e-mail address (the outside digits are stored in the database with the middle digits censored)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Collect & store the CVV number', 'MODULE_PAYMENT_CC_COLLECT_CVV', 'True', 'Do you want to collect the CVV number. Note: If you do the CVV number will be stored in the database in an encoded format.', 6, 0, NULL, '2004-01-11 22:55:51', NULL, 'zen_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Store the Credit Card Number', 'MODULE_PAYMENT_CC_STORE_NUMBER', 'False', 'Do you want to store the Credit Card Number. Note: The Credit Card Number will be stored unenecrypted, and as such may represent a security problem', 6, 0, NULL, now(), NULL, 'zen_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort order of display.', 'MODULE_PAYMENT_CC_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0' , now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Payment Zone', 'MODULE_PAYMENT_CC_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Order Status', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Flat Shipping', 'MODULE_SHIPPING_FLAT_STATUS', 'True', 'Do you want to offer flat rate shipping?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Shipping Cost', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'The shipping cost for all orders using this shipping method.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Tax Class', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Tax Basis', 'MODULE_SHIPPING_FLAT_TAX_BASIS', 'Shipping', 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone', '6', '0', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Shipping Zone', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Currency', 'DEFAULT_CURRENCY', 'USD', 'Default Currency', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Language', 'DEFAULT_LANGUAGE', 'en', 'Default Language', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Admin configuration_key shows', 'ADMIN_CONFIGURATION_KEY_ON', '0', 'Manually switch to value of 1 to see the configuration_key name in configuration displays', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Country of Origin', 'SHIPPING_ORIGIN_COUNTRY', '223', 'Select the country of origin to be used in shipping quotes.', '7', '1', 'zen_get_country_name', 'zen_cfg_pull_down_country_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Postal Code', 'SHIPPING_ORIGIN_ZIP', 'NONE', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes. NOTE: For USA zip codes, only use your 5 digit zip code.', '7', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Enter the Maximum Package Weight you will ship', 'SHIPPING_MAX_WEIGHT', '50', 'Carriers have a max weight limit for a single package. This is a common one for all.', '7', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Package Tare Small to Medium - added percentage:weight', 'SHIPPING_BOX_WEIGHT', '0:3', 'What is the weight of typical packaging of small to medium packages?<br />Example: 10% + 1lb 10:1<br />10% + 0lbs 10:0<br />0% + 5lbs 0:5<br />0% + 0lbs 0:0', '7', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Larger packages - added packaging percentage:weight', 'SHIPPING_BOX_PADDING', '10:0', 'What is the weight of typical packaging for Large packages?<br />Example: 10% + 1lb 10:1<br />10% + 0lbs 10:0<br />0% + 5lbs 0:5<br />0% + 0lbs 0:0', '7', '5', now());

# moved to product_types
#INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address', 'PRODUCTS_VIRTUAL_DEFAULT', '0', 'What should the Default Virtual Product status be when adding new products?<br /><br />0= Virtual Product Defaults to OFF<br />1= Virtual Product Defaults to ON<br />NOTE: Virtual Products do not require a Shipping Address', '7', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
#INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules', 'PRODUCTS_IS_ALWAYS_FREE_SHIPPING_DEFAULT', '0', 'What should the Default Free Shipping status be when adding new products?<br /><br />0= Free Shipping Defaults to OFF<br />1= Free Shipping Defaults to ON<br />NOTE: Free Shipping Products require a Shipping Address', '7', '11', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Number of Boxes and Weight Status', 'SHIPPING_BOX_WEIGHT_DISPLAY', '3', 'Display Shipping Weight and Number of Boxes?<br /><br />0= off<br />1= Boxes Only<br />2= Weight Only<br />3= Both Boxes and Weight', '7', '15', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Shipping Estimator Display Settings for Shopping Cart', 'SHOW_SHIPPING_ESTIMATOR_BUTTON', '1', '<br />0= Off<br />1= Display as Button on Shopping Cart<br />2= Display as Listing on Shopping Cart Page', '7', '20', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());


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
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Add to Cart Button (0=off; 1=on)', 'PRODUCT_LIST_PRICE_BUY_NOW', '1', 'Do you want to display the Add to Cart Button?', '8', '20', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', '3', 'Do you want to display Add Multiple Products Qty Box and Set Button Location?<br />0= off<br />1= Top<br />2= Bottom<br />3= Both', '8', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Description', 'PRODUCT_LIST_DESCRIPTION', '150', 'Do you want to display the Product Description?<br /><br />0= OFF<br />150= Suggested Length, or enter the maximum number of characters to display', '8', '30', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing Ascending Sort Order', 'PRODUCT_LIST_SORT_ORDER_ASCENDING', '+', 'What do you want to use to indicate Sort Order Ascending?<br />Default = +', 8, 40, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing Descending Sort Order', 'PRODUCT_LIST_SORT_ORDER_DESCENDING', '-', 'What do you want to use to indicate Sort Order Descending?<br />Default = -', 8, 41, NULL, now(), NULL, 'zen_cfg_textarea_small(');


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check stock level', 'STOCK_CHECK', 'true', 'Check to see if sufficent stock is available', '9', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Subtract stock', 'STOCK_LIMITED', 'true', 'Subtract product in stock by product orders', '9', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Allow Checkout', 'STOCK_ALLOW_CHECKOUT', 'true', 'Allow customer to checkout even if there is insufficient stock', '9', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Mark product out of stock', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Display something on screen so customer can see which product has insufficient stock', '9', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Stock Re-order level', 'STOCK_REORDER_LEVEL', '5', 'Define when stock needs to be re-ordered', '9', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Products status in Catalog when out of stock should be set to', 'SHOW_PRODUCTS_SOLD_OUT', '0', 'Show Products when out of stock<br /><br />0= set product status to OFF<br />1= leave product status ON', '9', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Sold Out Image in place of Add to Cart', 'SHOW_PRODUCTS_SOLD_OUT_IMAGE', '1', 'Show Sold Out Image instead of Add to Cart Button<br /><br />0= off<br />1= on', '9', '11', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Quantity Decimals', 'QUANTITY_DECIMALS', '0', 'Allow how many decimals on Quantity<br /><br />0= off', '9', '15', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Shopping Cart - Delete Checkboxes or Delete Button', 'SHOW_SHOPPING_CART_DELETE', '3', 'Show on Shopping Cart Delete Button and/or Checkboxes<br /><br />1= Delete Button Only<br />2= Checkbox Only<br />3= Both Delete Button and Checkbox', '9', '20', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Shopping Cart - Update Cart Button Location', 'SHOW_SHOPPING_CART_UPDATE', '3', 'Show on Shopping Cart Update Cart Button Location as:<br /><br />1= Next to each Qty Box<br />2= Below all Products<br />3= Both Next to each Qty Box and Below all Products<br /><br />Note: this setting controls which of 3 tpl_shopping_cart_default files are called', '9', '22', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Page Parse Time', 'STORE_PAGE_PARSE_TIME', 'false', 'Store the time it takes to parse a page', '10', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Destination', 'STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/zen/page_parse_time.log', 'Directory and filename of the page parse time log', '10', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Date Format', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'The date format', '10', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display The Page Parse Time', 'DISPLAY_PAGE_PARSE_TIME', 'false', 'Display the page parse time on the bottom of each page<br />You do not need to store the times to display them in the Catalog', '10', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Database Queries', 'STORE_DB_TRANSACTIONS', 'false', 'Store the database queries in the page parse time log (PHP4 only)', '10', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Transport Method', 'EMAIL_TRANSPORT', 'sendmail', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.<br /><br />SMTPAUTH should only be used if your server requires SMTP authorization to send messages. You must also configure your SMTPAUTH settings in the appropriate fields in this admin section.<br /><br />"Sendmail -f" is only for servers which require the use of the -f parameter to send mail. This is a security setting often used to prevent spoofing. Will cause errors if your host mailserver is not configured to use it.', '12', '1', 'zen_cfg_select_option(array(\'sendmail\', \'sendmail-f\', \'smtp\', \'smtpauth\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Account Mailbox', 'EMAIL_SMTPAUTH_MAILBOX', 'YourEmailAccountNameHere', 'Enter the mailbox account name (me@mydomain.com) supplied by your host. This is the account name that your host requires for SMTP authentication.<br />Only required if using SMTP Authentication for email.', '12', '101', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Account Password', 'EMAIL_SMTPAUTH_PASSWORD', 'YourPasswordHere', 'Enter the password for your SMTP mailbox. <br />Only required if using SMTP Authentication for email.', '12', '101', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Mail Host', 'EMAIL_SMTPAUTH_MAIL_SERVER', 'mail.EnterYourDomain.com', 'Enter the DNS name of your SMTP mail server.<br />ie: mail.mydomain.com<br />or 55.66.77.88<br />Only required if using SMTP Authentication for email.', '12', '101', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Mail Server Port', 'EMAIL_SMTPAUTH_MAIL_SERVER_PORT', '25', 'Enter the IP port number that your SMTP mailserver operates on.<br />Only required if using SMTP Authentication for email.', '12', '101', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Convert currencies for Text emails', 'CURRENCIES_TRANSLATIONS', '&pound;,�:&euro;,�', 'What currency conversions do you need for Text emails?<br />Default = &amp;pound;,�:&amp;euro;,�', 12, 120, NULL, '2003-11-21 00:00:00', NULL, 'zen_cfg_textarea_small(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', '12', '2', 'zen_cfg_select_option(array(\'LF\', \'CRLF\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use MIME HTML When Sending Emails', 'EMAIL_USE_HTML', 'false', 'Send e-mails in HTML format', '12', '3', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Verify E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verify e-mail address through a DNS server', '12', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails', '12', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Email Archiving Active?', 'EMAIL_ARCHIVE', 'false', 'If you wish to have email messages archived/stored when sent, set this to "true".', '12', '6', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Friendly-Errors', 'EMAIL_FRIENDLY_ERRORS', 'false', 'Do you want to display friendly errors if emails fail?  Setting this to false will display PHP errors and likely cause the script to fail. Only set to false while troubleshooting, and true for a live shop.', '12', '7', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Email Address (Displayed to Contact you)', 'STORE_OWNER_EMAIL_ADDRESS', 'root@localhost', 'Email address of Store Owner.  Used as "display only" when informing customers of how to contact you.', '12', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Email Address (sent FROM)', 'EMAIL_FROM', 'Zen Cart <root@localhost>', 'Address from which email messages will be "sent" by default. Can be over-ridden at compose-time in admin modules.', '12', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function) VALUES ('Emails must send from known domain?', 'EMAIL_SEND_MUST_BE_STORE', 'No', 'Does your mailserver require that all outgoing emails have their "from" address match a known domain that exists on your webserver?<br /><br />This is often set in order to prevent spoofing and spam broadcasts.  If set to Yes, this will cause the email address (sent FROM) to be used as the "from" address on all outgoing mail.', 12, 11, NULL, 'zen_cfg_select_option(array(\'No\', \'Yes\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function) VALUES ('Email Admin Format?', 'ADMIN_EXTRA_EMAIL_FORMAT', 'TEXT', 'Please select the Admin extra email format', 12, 12, NULL, 'zen_cfg_select_option(array(\'TEXT\', \'HTML\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Order Confirmation Emails To', 'SEND_EXTRA_ORDER_EMAILS_TO', '', 'Send COPIES of order confirmation emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Create Account Emails To - Status', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS', '0', 'Send copy of Create Account Status<br />0= off 1= on', '12', '13', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Create Account Emails To', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO', '', 'Send copy of Create Account emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Tell a Friend Emails To - Status', 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS', '0', 'Send copy of Tell a Friend Status<br />0= off 1= on', '12', '15', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Tell a Friend Emails To', 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO', '', 'Send copy of Tell a Friend emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '16', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Customer GV Send Emails To - Status', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_STATUS', '0', 'Send copy of Customer GV Send Status<br />0= off 1= on', '12', '17', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Customer GV Send Emails To', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO', '', 'Send copy of Customer GV Send emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '18', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Admin GV Mail Emails To - Status', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO_STATUS', '0', 'Send copy of Admin GV Mail Status<br />0= off 1= on', '12', '19', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Customer Admin GV Mail Emails To', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO', '', 'Send copy of Admin GV Mail emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '20', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Admin Discount Coupon Mail Emails To - Status', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_STATUS', '0', 'Send copy of Admin Discount Coupon Mail Status<br />0= off 1= on', '12', '21', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Customer Admin Discount Coupon Mail Emails To', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO', '', 'Send copy of Admin Discount Coupon Mail emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '22', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Admin Orders Status Emails To - Status', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS', '0', 'Send copy of Admin Orders Status Status<br />0= off 1= on', '12', '23', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Admin Orders Status Emails To', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO', '', 'Send copy of Admin Orders Status emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '24', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Notice of Pending Reviews Emails To - Status', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS', '0', 'Send copy of Pending Reviews Status<br />0= off 1= on', '12', '25', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Notice of Pending Reviews Emails To', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO', '', 'Send copy of Pending Reviews emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '26', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Set "Contact Us" Email Dropdown List', 'CONTACT_US_LIST', '', 'On the "Contact Us" Page, set the list of email addresses , in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '40', 'zen_cfg_textarea(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Allow Guest To Tell A Friend', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', 'Allow guests to tell a friend about a product. <br />If set to [false], then tell-a-friend will prompt for login if user is not already logged in.', '12', '50', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Contact Us - Show Store Name and Address', 'CONTACT_US_STORE_NAME_ADDRESS', '1', 'Include Store Name and Address<br />0= off 1= on', '12', '50', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Send Low Stock Emails', 'SEND_LOWSTOCK_EMAIL', '0', 'When stock level is at or below low stock level send an email<br />0= off<br />1= on', '12', '60', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Low Stock Emails To', 'SEND_EXTRA_LOW_STOCK_EMAILS_TO', '', 'When stock level is at or below low stock level send an email to this address, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '61', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display "Newsletter Unsubscribe" Link?', 'SHOW_NEWSLETTER_UNSUBSCRIBE_LINK', 'true', 'Show "Newsletter Unsubscribe" link in the "Information" side-box?', '12', '70', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Audience-Select Count Display', 'AUDIENCE_SELECT_DISPLAY_COUNTS', 'true', 'When displaying lists of available audiences/recipients, should the recipients-count be included? <br /><em>(This may make things slower if you have a lot of customers or complex audience queries)</em>', '12', '90', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Downloads', 'DOWNLOAD_ENABLED', 'true', 'Enable the products download functions.', '13', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Download by Redirect', 'DOWNLOAD_BY_REDIRECT', 'true', 'Use browser redirection for download. Disable on non-Unix systems.<br /><br />Note: Set /pub to 777 when redirect is true', '13', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
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

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Session Directory', 'SESSION_WRITE_DIRECTORY', '/tmp', 'If sessions are file based, store them in this directory.', '15', '1', now());
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

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enabled - Show on Payment', 'SHOW_ACCEPTED_CREDIT_CARDS', '0', 'Show accepted credit cards on Payment page?<br />0= off<br />1= As Text<br />2= As Images<br /><br />Note: images and text must be defined in both the database and language file for specific credit card types.', '17', '50', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_GV_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_GV_SORT_ORDER', '840', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:40', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Queue Purchases', 'MODULE_ORDER_TOTAL_GV_QUEUE', 'true', 'Do you want to queue purchases of the Gift Voucher?', 6, 3, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Shipping', 'MODULE_ORDER_TOTAL_GV_INC_SHIPPING', 'true', 'Include Shipping in calculation', 6, 5, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Tax', 'MODULE_ORDER_TOTAL_GV_INC_TAX', 'true', 'Include Tax in calculation.', 6, 6, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_GV_CALC_TAX', 'None', 'Re-Calculate Tax', 6, 7, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_ORDER_TOTAL_GV_TAX_CLASS', '0', 'Use the following tax class when treating Gift Voucher as Credit Note.', 6, 0, NULL, '2003-10-30 22:16:40', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Credit including Tax', 'MODULE_ORDER_TOTAL_GV_CREDIT_TAX', 'false', 'Add tax to purchased Gift Voucher when crediting to Account', 6, 8, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
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
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', '0', 'Use the following tax class when treating Discount Coupon as Credit Note.', 6, 0, NULL, '2003-10-30 22:16:36', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Tax', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'true', 'Include Tax in calculation.', 6, 6, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', '280', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Shipping', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'false', 'Include Shipping in calculation', 6, 5, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'Standard', 'Re-Calculate Tax', 6, 7, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Admin Demo Status', 'ADMIN_DEMO', '0', 'Admin Demo should be on?<br />0= off 1= on', 6, 0, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product option type Select', 'PRODUCTS_OPTIONS_TYPE_SELECT', '0', 'The number representing the Select type of product option.', 0, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Text product option type', 'PRODUCTS_OPTIONS_TYPE_TEXT', '1', 'Numeric value of the text product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Radio button product option type', 'PRODUCTS_OPTIONS_TYPE_RADIO', '2', 'Numeric value of the radio button product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Check box product option type', 'PRODUCTS_OPTIONS_TYPE_CHECKBOX', '3', 'Numeric value of the check box product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('File product option type', 'PRODUCTS_OPTIONS_TYPE_FILE', '4', 'Numeric value of the file product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('ID for text and file products options values', 'PRODUCTS_OPTIONS_VALUES_TEXT_ID', '0', 'Numeric value of the products_options_values_id used by the text and file attributes.', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Upload prefix', 'UPLOAD_PREFIX', 'upload_', 'Prefix used to differentiate between upload options and other options', 0, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Text prefix', 'TEXT_PREFIX', 'txt_', 'Prefix used to differentiate between text option values and other option values', 0, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Read Only option type', 'PRODUCTS_OPTIONS_TYPE_READONLY', '5', 'Numeric value of the file product option type', 6, NULL, now(), now(), NULL, NULL);






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
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Meta Tags - Include Product Price in Title', 'META_TAG_INCLUDE_PRICE', '1', 'Do you want to include the Product Price in the Meta Tag Title?<br /><br />0= off 1= on', '18', '70', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Meta Tags Generated Description Maximum Length?', 'MAX_META_TAG_DESCRIPTION_LENGTH', '50', 'Set Generated Meta Tag Description Maximum Length to (words) Default 50:', '18', '71', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Also Purchased Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS', '3', 'Also Purchased Products Columns per Row<br />0= off or set the sort order', '18', '72', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Navigation Bar Position', 'PRODUCT_INFO_PREVIOUS_NEXT', '1', 'Location of Previous/Next Navigation Bar<br />0= off<br />1= Top of Page<br />2= Bottom of Page<br />3= Both Top and Bottom of Page', 18, 21, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Top of Page\'), array(\'id\'=>\'2\', \'text\'=>\'Bottom of Page\'), array(\'id\'=>\'3\', \'text\'=>\'Both Top & Bottom of Page\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Sort Order', 'PRODUCT_INFO_PREVIOUS_NEXT_SORT', '1', 'Products Display Order by<br />0= Product ID<br />1= Product Name<br />2= Model<br />3= Price, Product Name<br />4= Price, Model<br />5= Product Name, Model<br />6= Product Sort Order', 18, 22, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Product ID\'), array(\'id\'=>\'1\', \'text\'=>\'Name\'), array(\'id\'=>\'2\', \'text\'=>\'Product Model\'), array(\'id\'=>\'3\', \'text\'=>\'Product Price - Name\'), array(\'id\'=>\'4\', \'text\'=>\'Product Price - Model\'), array(\'id\'=>\'5\', \'text\'=>\'Product Name - Model\'), array(\'id\'=>\'6\', \'text\'=>\'Product Sort Order\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Button and Image Status', 'SHOW_PREVIOUS_NEXT_STATUS', '0', 'Button and Product Image status settings are:<br />0= Off<br />1= On', 18, 20, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Button and Image Settings', 'SHOW_PREVIOUS_NEXT_IMAGES', '0', 'Show Previous/Next Button and Product Image Settings<br />0= Button Only<br />1= Button and Product Image<br />2= Product Image Only', 18, 21, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Button Only\'), array(\'id\'=>\'1\', \'text\'=>\'Button and Product Image\'), array(\'id\'=>\'2\', \'text\'=>\'Product Image Only\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Previous Next - Image Width?', 'PREVIOUS_NEXT_IMAGE_WIDTH', '50', 'Previous/Next Image Width?', '18', '22', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Previous Next - Image Height?', 'PREVIOUS_NEXT_IMAGE_HEIGHT', '40', 'Previous/Next Image Height?', '18', '23', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Navigation Includes Category', 'PRODUCT_INFO_CATEGORIES', '1', 'Product\'s Category Image and Name Alignment Above Previous/Next Navigation Bar<br />0= off<br />1= Align Left<br />2= Align Center<br />3= Align Right', 18, 20, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Align Left\'), array(\'id\'=>\'2\', \'text\'=>\'Align Center\'), array(\'id\'=>\'3\', \'text\'=>\'Align Right\')),');



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Column Width - Left Boxes', 'BOX_WIDTH_LEFT', '150px', 'Width of the Left Column Boxes<br />px may be included<br />Default = 150px', 19, 1, NULL, '2003-11-21 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Column Width - Right Boxes', 'BOX_WIDTH_RIGHT', '150px', 'Width of the Right Column Boxes<br />px may be included<br />Default = 150px', 19, 2, NULL, '2003-11-21 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Bread Crumbs Navigation Separator', 'BREAD_CRUMBS_SEPARATOR', '&nbsp;::&nbsp;', 'Enter the separator symbol to appear between the Navigation Bread Crumb trail<br />Note: Include spaces with the &amp;nbsp; symbol if you want them part of the separator.<br />Default = &amp;nbsp;::&amp;nbsp;', 19, 3, NULL, '2003-11-21 22:16:36', NULL, 'zen_cfg_textarea_small(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Define Breadcrumb Status', 'DEFINE_BREADCRUMB_STATUS', '1', 'Enable the Breadcrumb Trail Links?<br />0= OFF<br />1= ON', 19, 4, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());


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

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Footer - Show IP Address status', 'SHOW_FOOTER_IP', '1', 'Show Customer IP Address in the Footer<br />0= off<br />1= on<br />Should the Customer IP Address show in the footer?', 19, 80, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Product Discount Quantities - Add how many blank discounts?', 'DISCOUNT_QTY_ADD', '5', 'How many blank discount quantities should be added for Product Pricing?', '19', '90', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Product Discount Quantities - Display how many per row?', 'DISCOUNT_QUANTITY_PRICES_COLUMN', '5', 'How many discount quantities should show per row on Product Info Pages?', '19', '95', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories/Products Display Sort Order', 'CATEGORIES_PRODUCTS_SORT_ORDER', '0', 'Categories/Products Display Sort Order<br />0= Categories/Products Sort Order/Name<br />1= Categories/Products Name<br />2= Products Model<br />3= Products Qty+, Products Name<br />4= Products Qty-, Products Name<br />5= Products Price+, Products Name<br />6= Products Price+, Products Name', '19', '100', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Option Names and Values Global Add, Copy and Delete Features Status', 'OPTION_NAMES_VALUES_GLOBAL_STATUS', '1', 'Option Names and Values Global Add, Copy and Delete Features Status<br />0= Hide Features<br />1= Show Features<br />2= Products Model', '19', '110', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories-Tabs Menu ON/OFF', 'CATEGORIES_TABS_STATUS', '1', 'Categories-Tabs<br />This enables the display of your store\'s categories as a menu across the top of your header. There are many potential creative uses for this.<br />0= Hide Categories Tabs<br />1= Show Categories Tabs', '19', '112', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Site Map - include My Account Links?', 'SHOW_ACCOUNT_LINKS_ON_SITE_MAP', 'No', 'Should the links to My Account show up on the site-map?<br />Note: Spiders will try to index this page, and likely should not be sent to secure pages, since there is no benefit in indexing a login page.<br /><br />Default: false', 19, 115, 'zen_cfg_select_option(array(\'Yes\', \'No\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Skip 1-prod Categories', 'SKIP_SINGLE_PRODUCT_CATEGORIES', 'True', 'Skip single-product categories<br />If this option is set to True, then if the customer clicks on a link to a category which only contains a single item, then Zen Cart will take them directly to that product-page, rather than present them with another link to click in order to see the product.<br />Default: True', '19', '120', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());

# CSS Buttons switch
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('CSS Buttons', 'IMAGE_USE_CSS_BUTTONS', 'No', 'CSS Buttons<br />Use CSS buttons instead of images (GIF/JPG)?<br />Button styles must be configured in the stylesheet if you enable this option.', '19', '147', 'zen_cfg_select_option(array(\'No\', \'Yes\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('<strong>Down for Maintenance: ON/OFF</strong>', 'DOWN_FOR_MAINTENANCE', 'false', 'Down for Maintenance <br />(true=on false=off)', '20', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: filename', 'DOWN_FOR_MAINTENANCE_FILENAME', 'down_for_maintenance', 'Down for Maintenance filename<br />Note: Do not include the extension<br />Default=down_for_maintenance', '20', '2', '', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Header', 'DOWN_FOR_MAINTENANCE_HEADER_OFF', 'false', 'Down for Maintenance: Hide Header <br />(true=hide false=show)', '20', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Column Left', 'DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF', 'false', 'Down for Maintenance: Hide Column Left <br />(true=hide false=show)', '20', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Column Right', 'DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF', 'false', 'Down for Maintenance: Hide Column Right <br />(true=hide false=show)', '20', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Footer', 'DOWN_FOR_MAINTENANCE_FOOTER_OFF', 'false', 'Down for Maintenance: Hide Footer <br />(true=hide false=show)', '20', '6', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Prices', 'DOWN_FOR_MAINTENANCE_PRICES_OFF', 'false', 'Down for Maintenance: Hide Prices <br />(true=hide false=show)', '20', '7', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Down For Maintenance (exclude this IP-Address)', 'EXCLUDE_ADMIN_IP_FOR_MAINTENANCE', 'your IP (ADMIN)', 'This IP Address is able to access the website while it is Down For Maintenance (like webmaster)<br />To enter multiple IP Addresses, separate with a comma. If you do not know your IP Address, check in the Footer of your Shop.', 20, 8, '2003-03-21 13:43:22', '2003-03-21 21:20:07', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('NOTICE PUBLIC Before going Down for Maintenance: ON/OFF', 'WARN_BEFORE_DOWN_FOR_MAINTENANCE', 'false', 'Give a WARNING some time before you put your website Down for Maintenance<br />(true=on false=off)<br />If you set the \'Down For Maintenance: ON/OFF\' to true this will automaticly be updated to false', 20, 9, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Date and hours for notice before maintenance', 'PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', '15/05/2003  2-3 PM', 'Date and hours for notice before maintenance website, enter date and hours for maintenance website', 20, 10, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Display when webmaster has enabled maintenance', 'DISPLAY_MAINTENANCE_TIME', 'false', 'Display when Webmaster has enabled maintenance <br />(true=on false=off)<br />', 20, 11, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Display website maintenance period', 'DISPLAY_MAINTENANCE_PERIOD', 'false', 'Display Website maintenance period <br />(true=on false=off)<br />', 20, 12, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Website maintenance period', 'TEXT_MAINTENANCE_PERIOD_TIME', '2h00', 'Enter Website Maintenance period (hh:mm)', 20, 13, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Confirm Terms and Conditions During Checkout Procedure', 'DISPLAY_CONDITIONS_ON_CHECKOUT', 'false', 'Show the Terms and Conditions during the checkout procedure which the customer must agree to.', '11', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Confirm Privacy Notice During Account Creation Procedure', 'DISPLAY_PRIVACY_CONDITIONS', 'false', 'Show the Privacy Notice during the account creation procedure which the customer must agree to.', '11', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_NEW_LIST_IMAGE', '1102', 'Do you want to display the Product Image?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_NEW_LIST_QUANTITY', '1202', 'Do you want to display the Product Quantity?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Buy Now Button', 'PRODUCT_NEW_BUY_NOW', '1300', 'Do you want to display the Product Buy Now Button<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_NEW_LIST_NAME', '2101', 'Do you want to display the Product Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_NEW_LIST_MODEL', '2201', 'Do you want to display the Product Model?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_NEW_LIST_MANUFACTURER', '2302', 'Do you want to display the Product Manufacturer Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price', 'PRODUCT_NEW_LIST_PRICE', '2402', 'Do you want to display the Product Price<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_NEW_LIST_WEIGHT', '2502', 'Do you want to display the Product Weight?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Date Added', 'PRODUCT_NEW_LIST_DATE_ADDED', '2601', 'Do you want to display the Product Date Added?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Description', 'PRODUCT_NEW_LIST_DESCRIPTION', '1', 'Do you want to display the Product Description - First 150 characters?<br />0= off<br />1= on', '21', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Display - Default Sort Order', 'PRODUCT_NEW_LIST_SORT_DEFAULT', '6', 'What Sort Order Default should be used for New Products Display?<br />Default= 6 for Date New to Old<br /><br />1= Products Name<br />2= Products Name Desc<br />3= Price low to high, Products Name<br />4= Price high to low, Products Name<br />5= Model<br />6= Date Added desc<br />7= Date Added<br />8= Product Sort Order', '21', '11', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Products New Group ID', 'PRODUCT_NEW_LIST_GROUP_ID', '21', 'Warning: Only change this if your Products New Group ID has changed from the default of 21<br />What is the configuration_group_id for New Products Listings?', '21', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', '3', 'Do you want to display Add Multiple Products Qty Box and Set Button Location?<br />0= off<br />1= Top<br />2= Bottom<br />3= Both', '21', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_FEATURED_LIST_IMAGE', '1102', 'Do you want to display the Product Image?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_FEATURED_LIST_QUANTITY', '1202', 'Do you want to display the Product Quantity?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Buy Now Button', 'PRODUCT_FEATURED_BUY_NOW', '1300', 'Do you want to display the Product Buy Now Button<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_FEATURED_LIST_NAME', '2101', 'Do you want to display the Product Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_FEATURED_LIST_MODEL', '2201', 'Do you want to display the Product Model?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_FEATURED_LIST_MANUFACTURER', '2302', 'Do you want to display the Product Manufacturer Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price', 'PRODUCT_FEATURED_LIST_PRICE', '2402', 'Do you want to display the Product Price<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_FEATURED_LIST_WEIGHT', '2502', 'Do you want to display the Product Weight?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Date Added', 'PRODUCT_FEATURED_LIST_DATE_ADDED', '2601', 'Do you want to display the Product Date Added?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Description', 'PRODUCT_FEATURED_LIST_DESCRIPTION', '1', 'Do you want to display the Product Description - First 150 characters?', '22', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
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
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Description', 'PRODUCT_ALL_LIST_DESCRIPTION', '1', 'Do you want to display the Product Description - First 150 characters?', '23', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
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
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Main Page Status', 'DEFINE_MAIN_PAGE_STATUS', '1', 'Enable the Defined Main Page Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '60', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Contact Us Status', 'DEFINE_CONTACT_US_STATUS', '1', 'Enable the Defined Contact Us Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '61', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Privacy Status', 'DEFINE_PRIVACY_STATUS', '1', 'Enable the Defined Privacy Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '62', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Shipping & Returns', 'DEFINE_SHIPPINGINFO_STATUS', '1', 'Enable the Defined Shipping & Returns Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '63', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Conditions of Use', 'DEFINE_CONDITIONS_STATUS', '1', 'Enable the Defined Conditions of Use Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '64', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Checkout Success', 'DEFINE_CHECKOUT_SUCCESS_STATUS', '1', 'Enable the Defined Checkout Success Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '65', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Discount Coupon', 'DEFINE_DISCOUNT_COUPON_STATUS', '1', 'Enable the Defined Discount Coupon Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '66', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Site Map Status', 'DEFINE_SITE_MAP_STATUS', '1', 'Enable the Defined Site Map Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '67', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Page 2', 'DEFINE_PAGE_2_STATUS', '1', 'Enable the Defined Page 2 Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '82', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Page 3', 'DEFINE_PAGE_3_STATUS', '1', 'Enable the Defined Page 3 Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '83', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Page 4', 'DEFINE_PAGE_4_STATUS', '1', 'Enable the Defined Page 4 Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '84', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');

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





INSERT INTO configuration_group VALUES ('1', 'My Store', 'General information about my store', '1', '1');
INSERT INTO configuration_group VALUES ('2', 'Minimum Values', 'The minimum values for functions / data', '2', '1');
INSERT INTO configuration_group VALUES ('3', 'Maximum Values', 'The maximum values for functions / data', '3', '1');
INSERT INTO configuration_group VALUES ('4', 'Images', 'Image parameters', '4', '1');
INSERT INTO configuration_group VALUES ('5', 'Customer Details', 'Customer account configuration', '5', '1');
INSERT INTO configuration_group VALUES ('6', 'Module Options', 'Hidden from configuration', '6', '0');
INSERT INTO configuration_group VALUES ('7', 'Shipping/Packaging', 'Shipping options available at my store', '7', '1');
INSERT INTO configuration_group VALUES ('8', 'Product Listing', 'Product Listing configuration options', '8', '1');
INSERT INTO configuration_group VALUES ('9', 'Stock', 'Stock configuration options', '9', '1');
INSERT INTO configuration_group VALUES ('10', 'Logging', 'Logging configuration options', '10', '1');
INSERT INTO configuration_group VALUES ('11', 'Regulations', 'Regulation options', '16', '1');
INSERT INTO configuration_group VALUES ('12', 'E-Mail Options', 'General settings for E-Mail transport and HTML E-Mails', '12', '1');
INSERT INTO configuration_group VALUES ('13', 'Attribute Settings', 'Configure products attributes settings', '13', '1');
INSERT INTO configuration_group VALUES ('14', 'GZip Compression', 'GZip compression options', '14', '1');
INSERT INTO configuration_group VALUES ('15', 'Sessions', 'Session options', '15', '1');
INSERT INTO configuration_group VALUES ('16', 'GV Coupons', 'Gift Vouchers and Coupons', '16', '1');
INSERT INTO configuration_group VALUES ('17', 'Credit Cards', 'Credit Cards Accepted', '17', '1');
INSERT INTO configuration_group VALUES ('18', 'Product Info', 'Product Info Display Options', '18', '1');
INSERT INTO configuration_group VALUES ('19', 'Layout Settings', 'Layout Options', '19', '1');
INSERT INTO configuration_group VALUES ('20', 'Website Maintenance', 'Website Maintenance Options', '20', '1');
INSERT INTO configuration_group VALUES ('21', 'New Listing', 'New Products Listing', '21', '1');
INSERT INTO configuration_group VALUES ('22', 'Featured Listing', 'Featured Products Listing', '22', '1');
INSERT INTO configuration_group VALUES ('23', 'All Listing', 'All Products Listing', '23', '1');
INSERT INTO configuration_group VALUES ('24', 'Index Listing', 'Index Products Listing', '24', '1');
INSERT INTO configuration_group VALUES ('25', 'Define Page Status', 'Define Main Pages and HTMLArea Options', '25', '1');
INSERT INTO configuration_group VALUES (30, 'EZ-Pages Settings', 'EZ-Pages Settings', 30, '1');

INSERT INTO countries VALUES (240,'Aaland Islands','AX','ALA','1');
INSERT INTO countries VALUES (1,'Afghanistan','AF','AFG','1');
INSERT INTO countries VALUES (2,'Albania','AL','ALB','1');
INSERT INTO countries VALUES (3,'Algeria','DZ','DZA','1');
INSERT INTO countries VALUES (4,'American Samoa','AS','ASM','1');
INSERT INTO countries VALUES (5,'Andorra','AD','AND','1');
INSERT INTO countries VALUES (6,'Angola','AO','AGO','1');
INSERT INTO countries VALUES (7,'Anguilla','AI','AIA','1');
INSERT INTO countries VALUES (8,'Antarctica','AQ','ATA','1');
INSERT INTO countries VALUES (9,'Antigua and Barbuda','AG','ATG','1');
INSERT INTO countries VALUES (10,'Argentina','AR','ARG','1');
INSERT INTO countries VALUES (11,'Armenia','AM','ARM','1');
INSERT INTO countries VALUES (12,'Aruba','AW','ABW','1');
INSERT INTO countries VALUES (13,'Australia','AU','AUS','1');
INSERT INTO countries VALUES (14,'Austria','AT','AUT','5');
INSERT INTO countries VALUES (15,'Azerbaijan','AZ','AZE','1');
INSERT INTO countries VALUES (16,'Bahamas','BS','BHS','1');
INSERT INTO countries VALUES (17,'Bahrain','BH','BHR','1');
INSERT INTO countries VALUES (18,'Bangladesh','BD','BGD','1');
INSERT INTO countries VALUES (19,'Barbados','BB','BRB','1');
INSERT INTO countries VALUES (20,'Belarus','BY','BLR','1');
INSERT INTO countries VALUES (21,'Belgium','BE','BEL','1');
INSERT INTO countries VALUES (22,'Belize','BZ','BLZ','1');
INSERT INTO countries VALUES (23,'Benin','BJ','BEN','1');
INSERT INTO countries VALUES (24,'Bermuda','BM','BMU','1');
INSERT INTO countries VALUES (25,'Bhutan','BT','BTN','1');
INSERT INTO countries VALUES (26,'Bolivia','BO','BOL','1');
INSERT INTO countries VALUES (27,'Bosnia and Herzegowina','BA','BIH','1');
INSERT INTO countries VALUES (28,'Botswana','BW','BWA','1');
INSERT INTO countries VALUES (29,'Bouvet Island','BV','BVT','1');
INSERT INTO countries VALUES (30,'Brazil','BR','BRA','1');
INSERT INTO countries VALUES (31,'British Indian Ocean Territory','IO','IOT','1');
INSERT INTO countries VALUES (32,'Brunei Darussalam','BN','BRN','1');
INSERT INTO countries VALUES (33,'Bulgaria','BG','BGR','1');
INSERT INTO countries VALUES (34,'Burkina Faso','BF','BFA','1');
INSERT INTO countries VALUES (35,'Burundi','BI','BDI','1');
INSERT INTO countries VALUES (36,'Cambodia','KH','KHM','1');
INSERT INTO countries VALUES (37,'Cameroon','CM','CMR','1');
INSERT INTO countries VALUES (38,'Canada','CA','CAN','1');
INSERT INTO countries VALUES (39,'Cape Verde','CV','CPV','1');
INSERT INTO countries VALUES (40,'Cayman Islands','KY','CYM','1');
INSERT INTO countries VALUES (41,'Central African Republic','CF','CAF','1');
INSERT INTO countries VALUES (42,'Chad','TD','TCD','1');
INSERT INTO countries VALUES (43,'Chile','CL','CHL','1');
INSERT INTO countries VALUES (44,'China','CN','CHN','1');
INSERT INTO countries VALUES (45,'Christmas Island','CX','CXR','1');
INSERT INTO countries VALUES (46,'Cocos (Keeling) Islands','CC','CCK','1');
INSERT INTO countries VALUES (47,'Colombia','CO','COL','1');
INSERT INTO countries VALUES (48,'Comoros','KM','COM','1');
INSERT INTO countries VALUES (49,'Congo','CG','COG','1');
INSERT INTO countries VALUES (50,'Cook Islands','CK','COK','1');
INSERT INTO countries VALUES (51,'Costa Rica','CR','CRI','1');
INSERT INTO countries VALUES (52,'Cote D\'Ivoire','CI','CIV','1');
INSERT INTO countries VALUES (53,'Croatia','HR','HRV','1');
INSERT INTO countries VALUES (54,'Cuba','CU','CUB','1');
INSERT INTO countries VALUES (55,'Cyprus','CY','CYP','1');
INSERT INTO countries VALUES (56,'Czech Republic','CZ','CZE','1');
INSERT INTO countries VALUES (57,'Denmark','DK','DNK','1');
INSERT INTO countries VALUES (58,'Djibouti','DJ','DJI','1');
INSERT INTO countries VALUES (59,'Dominica','DM','DMA','1');
INSERT INTO countries VALUES (60,'Dominican Republic','DO','DOM','1');
INSERT INTO countries VALUES (61,'East Timor','TP','TMP','1');
INSERT INTO countries VALUES (62,'Ecuador','EC','ECU','1');
INSERT INTO countries VALUES (63,'Egypt','EG','EGY','1');
INSERT INTO countries VALUES (64,'El Salvador','SV','SLV','1');
INSERT INTO countries VALUES (65,'Equatorial Guinea','GQ','GNQ','1');
INSERT INTO countries VALUES (66,'Eritrea','ER','ERI','1');
INSERT INTO countries VALUES (67,'Estonia','EE','EST','1');
INSERT INTO countries VALUES (68,'Ethiopia','ET','ETH','1');
INSERT INTO countries VALUES (69,'Falkland Islands (Malvinas)','FK','FLK','1');
INSERT INTO countries VALUES (70,'Faroe Islands','FO','FRO','1');
INSERT INTO countries VALUES (71,'Fiji','FJ','FJI','1');
INSERT INTO countries VALUES (72,'Finland','FI','FIN','1');
INSERT INTO countries VALUES (73,'France','FR','FRA','1');
INSERT INTO countries VALUES (74,'France, Metropolitan','FX','FXX','1');
INSERT INTO countries VALUES (75,'French Guiana','GF','GUF','1');
INSERT INTO countries VALUES (76,'French Polynesia','PF','PYF','1');
INSERT INTO countries VALUES (77,'French Southern Territories','TF','ATF','1');
INSERT INTO countries VALUES (78,'Gabon','GA','GAB','1');
INSERT INTO countries VALUES (79,'Gambia','GM','GMB','1');
INSERT INTO countries VALUES (80,'Georgia','GE','GEO','1');
INSERT INTO countries VALUES (81,'Germany','DE','DEU','5');
INSERT INTO countries VALUES (82,'Ghana','GH','GHA','1');
INSERT INTO countries VALUES (83,'Gibraltar','GI','GIB','1');
INSERT INTO countries VALUES (84,'Greece','GR','GRC','1');
INSERT INTO countries VALUES (85,'Greenland','GL','GRL','1');
INSERT INTO countries VALUES (86,'Grenada','GD','GRD','1');
INSERT INTO countries VALUES (87,'Guadeloupe','GP','GLP','1');
INSERT INTO countries VALUES (88,'Guam','GU','GUM','1');
INSERT INTO countries VALUES (89,'Guatemala','GT','GTM','1');
INSERT INTO countries VALUES (90,'Guinea','GN','GIN','1');
INSERT INTO countries VALUES (91,'Guinea-bissau','GW','GNB','1');
INSERT INTO countries VALUES (92,'Guyana','GY','GUY','1');
INSERT INTO countries VALUES (93,'Haiti','HT','HTI','1');
INSERT INTO countries VALUES (94,'Heard and Mc Donald Islands','HM','HMD','1');
INSERT INTO countries VALUES (95,'Honduras','HN','HND','1');
INSERT INTO countries VALUES (96,'Hong Kong','HK','HKG','1');
INSERT INTO countries VALUES (97,'Hungary','HU','HUN','1');
INSERT INTO countries VALUES (98,'Iceland','IS','ISL','1');
INSERT INTO countries VALUES (99,'India','IN','IND','1');
INSERT INTO countries VALUES (100,'Indonesia','ID','IDN','1');
INSERT INTO countries VALUES (101,'Iran (Islamic Republic of)','IR','IRN','1');
INSERT INTO countries VALUES (102,'Iraq','IQ','IRQ','1');
INSERT INTO countries VALUES (103,'Ireland','IE','IRL','1');
INSERT INTO countries VALUES (104,'Israel','IL','ISR','1');
INSERT INTO countries VALUES (105,'Italy','IT','ITA','1');
INSERT INTO countries VALUES (106,'Jamaica','JM','JAM','1');
INSERT INTO countries VALUES (107,'Japan','JP','JPN','1');
INSERT INTO countries VALUES (108,'Jordan','JO','JOR','1');
INSERT INTO countries VALUES (109,'Kazakhstan','KZ','KAZ','1');
INSERT INTO countries VALUES (110,'Kenya','KE','KEN','1');
INSERT INTO countries VALUES (111,'Kiribati','KI','KIR','1');
INSERT INTO countries VALUES (112,'Korea, Democratic People\'s Republic of','KP','PRK','1');
INSERT INTO countries VALUES (113,'Korea, Republic of','KR','KOR','1');
INSERT INTO countries VALUES (114,'Kuwait','KW','KWT','1');
INSERT INTO countries VALUES (115,'Kyrgyzstan','KG','KGZ','1');
INSERT INTO countries VALUES (116,'Lao People\'s Democratic Republic','LA','LAO','1');
INSERT INTO countries VALUES (117,'Latvia','LV','LVA','1');
INSERT INTO countries VALUES (118,'Lebanon','LB','LBN','1');
INSERT INTO countries VALUES (119,'Lesotho','LS','LSO','1');
INSERT INTO countries VALUES (120,'Liberia','LR','LBR','1');
INSERT INTO countries VALUES (121,'Libyan Arab Jamahiriya','LY','LBY','1');
INSERT INTO countries VALUES (122,'Liechtenstein','LI','LIE','1');
INSERT INTO countries VALUES (123,'Lithuania','LT','LTU','1');
INSERT INTO countries VALUES (124,'Luxembourg','LU','LUX','1');
INSERT INTO countries VALUES (125,'Macau','MO','MAC','1');
INSERT INTO countries VALUES (126,'Macedonia, The Former Yugoslav Republic of','MK','MKD','1');
INSERT INTO countries VALUES (127,'Madagascar','MG','MDG','1');
INSERT INTO countries VALUES (128,'Malawi','MW','MWI','1');
INSERT INTO countries VALUES (129,'Malaysia','MY','MYS','1');
INSERT INTO countries VALUES (130,'Maldives','MV','MDV','1');
INSERT INTO countries VALUES (131,'Mali','ML','MLI','1');
INSERT INTO countries VALUES (132,'Malta','MT','MLT','1');
INSERT INTO countries VALUES (133,'Marshall Islands','MH','MHL','1');
INSERT INTO countries VALUES (134,'Martinique','MQ','MTQ','1');
INSERT INTO countries VALUES (135,'Mauritania','MR','MRT','1');
INSERT INTO countries VALUES (136,'Mauritius','MU','MUS','1');
INSERT INTO countries VALUES (137,'Mayotte','YT','MYT','1');
INSERT INTO countries VALUES (138,'Mexico','MX','MEX','1');
INSERT INTO countries VALUES (139,'Micronesia, Federated States of','FM','FSM','1');
INSERT INTO countries VALUES (140,'Moldova, Republic of','MD','MDA','1');
INSERT INTO countries VALUES (141,'Monaco','MC','MCO','1');
INSERT INTO countries VALUES (142,'Mongolia','MN','MNG','1');
INSERT INTO countries VALUES (143,'Montserrat','MS','MSR','1');
INSERT INTO countries VALUES (144,'Morocco','MA','MAR','1');
INSERT INTO countries VALUES (145,'Mozambique','MZ','MOZ','1');
INSERT INTO countries VALUES (146,'Myanmar','MM','MMR','1');
INSERT INTO countries VALUES (147,'Namibia','NA','NAM','1');
INSERT INTO countries VALUES (148,'Nauru','NR','NRU','1');
INSERT INTO countries VALUES (149,'Nepal','NP','NPL','1');
INSERT INTO countries VALUES (150,'Netherlands','NL','NLD','1');
INSERT INTO countries VALUES (151,'Netherlands Antilles','AN','ANT','1');
INSERT INTO countries VALUES (152,'New Caledonia','NC','NCL','1');
INSERT INTO countries VALUES (153,'New Zealand','NZ','NZL','1');
INSERT INTO countries VALUES (154,'Nicaragua','NI','NIC','1');
INSERT INTO countries VALUES (155,'Niger','NE','NER','1');
INSERT INTO countries VALUES (156,'Nigeria','NG','NGA','1');
INSERT INTO countries VALUES (157,'Niue','NU','NIU','1');
INSERT INTO countries VALUES (158,'Norfolk Island','NF','NFK','1');
INSERT INTO countries VALUES (159,'Northern Mariana Islands','MP','MNP','1');
INSERT INTO countries VALUES (160,'Norway','NO','NOR','1');
INSERT INTO countries VALUES (161,'Oman','OM','OMN','1');
INSERT INTO countries VALUES (162,'Pakistan','PK','PAK','1');
INSERT INTO countries VALUES (163,'Palau','PW','PLW','1');
INSERT INTO countries VALUES (164,'Panama','PA','PAN','1');
INSERT INTO countries VALUES (165,'Papua New Guinea','PG','PNG','1');
INSERT INTO countries VALUES (166,'Paraguay','PY','PRY','1');
INSERT INTO countries VALUES (167,'Peru','PE','PER','1');
INSERT INTO countries VALUES (168,'Philippines','PH','PHL','1');
INSERT INTO countries VALUES (169,'Pitcairn','PN','PCN','1');
INSERT INTO countries VALUES (170,'Poland','PL','POL','1');
INSERT INTO countries VALUES (171,'Portugal','PT','PRT','1');
INSERT INTO countries VALUES (172,'Puerto Rico','PR','PRI','1');
INSERT INTO countries VALUES (173,'Qatar','QA','QAT','1');
INSERT INTO countries VALUES (174,'Reunion','RE','REU','1');
INSERT INTO countries VALUES (175,'Romania','RO','ROM','1');
INSERT INTO countries VALUES (176,'Russian Federation','RU','RUS','1');
INSERT INTO countries VALUES (177,'Rwanda','RW','RWA','1');
INSERT INTO countries VALUES (178,'Saint Kitts and Nevis','KN','KNA','1');
INSERT INTO countries VALUES (179,'Saint Lucia','LC','LCA','1');
INSERT INTO countries VALUES (180,'Saint Vincent and the Grenadines','VC','VCT','1');
INSERT INTO countries VALUES (181,'Samoa','WS','WSM','1');
INSERT INTO countries VALUES (182,'San Marino','SM','SMR','1');
INSERT INTO countries VALUES (183,'Sao Tome and Principe','ST','STP','1');
INSERT INTO countries VALUES (184,'Saudi Arabia','SA','SAU','1');
INSERT INTO countries VALUES (185,'Senegal','SN','SEN','1');
INSERT INTO countries VALUES (186,'Seychelles','SC','SYC','1');
INSERT INTO countries VALUES (187,'Sierra Leone','SL','SLE','1');
INSERT INTO countries VALUES (188,'Singapore','SG','SGP', '4');
INSERT INTO countries VALUES (189,'Slovakia (Slovak Republic)','SK','SVK','1');
INSERT INTO countries VALUES (190,'Slovenia','SI','SVN','1');
INSERT INTO countries VALUES (191,'Solomon Islands','SB','SLB','1');
INSERT INTO countries VALUES (192,'Somalia','SO','SOM','1');
INSERT INTO countries VALUES (193,'South Africa','ZA','ZAF','1');
INSERT INTO countries VALUES (194,'South Georgia and the South Sandwich Islands','GS','SGS','1');
INSERT INTO countries VALUES (195,'Spain','ES','ESP','3');
INSERT INTO countries VALUES (196,'Sri Lanka','LK','LKA','1');
INSERT INTO countries VALUES (197,'St. Helena','SH','SHN','1');
INSERT INTO countries VALUES (198,'St. Pierre and Miquelon','PM','SPM','1');
INSERT INTO countries VALUES (199,'Sudan','SD','SDN','1');
INSERT INTO countries VALUES (200,'Suriname','SR','SUR','1');
INSERT INTO countries VALUES (201,'Svalbard and Jan Mayen Islands','SJ','SJM','1');
INSERT INTO countries VALUES (202,'Swaziland','SZ','SWZ','1');
INSERT INTO countries VALUES (203,'Sweden','SE','SWE','1');
INSERT INTO countries VALUES (204,'Switzerland','CH','CHE','1');
INSERT INTO countries VALUES (205,'Syrian Arab Republic','SY','SYR','1');
INSERT INTO countries VALUES (206,'Taiwan','TW','TWN','1');
INSERT INTO countries VALUES (207,'Tajikistan','TJ','TJK','1');
INSERT INTO countries VALUES (208,'Tanzania, United Republic of','TZ','TZA','1');
INSERT INTO countries VALUES (209,'Thailand','TH','THA','1');
INSERT INTO countries VALUES (210,'Togo','TG','TGO','1');
INSERT INTO countries VALUES (211,'Tokelau','TK','TKL','1');
INSERT INTO countries VALUES (212,'Tonga','TO','TON','1');
INSERT INTO countries VALUES (213,'Trinidad and Tobago','TT','TTO','1');
INSERT INTO countries VALUES (214,'Tunisia','TN','TUN','1');
INSERT INTO countries VALUES (215,'Turkey','TR','TUR','1');
INSERT INTO countries VALUES (216,'Turkmenistan','TM','TKM','1');
INSERT INTO countries VALUES (217,'Turks and Caicos Islands','TC','TCA','1');
INSERT INTO countries VALUES (218,'Tuvalu','TV','TUV','1');
INSERT INTO countries VALUES (219,'Uganda','UG','UGA','1');
INSERT INTO countries VALUES (220,'Ukraine','UA','UKR','1');
INSERT INTO countries VALUES (221,'United Arab Emirates','AE','ARE','1');
INSERT INTO countries VALUES (222,'United Kingdom','GB','GBR','1');
INSERT INTO countries VALUES (223,'United States','US','USA', '2');
INSERT INTO countries VALUES (224,'United States Minor Outlying Islands','UM','UMI','1');
INSERT INTO countries VALUES (225,'Uruguay','UY','URY','1');
INSERT INTO countries VALUES (226,'Uzbekistan','UZ','UZB','1');
INSERT INTO countries VALUES (227,'Vanuatu','VU','VUT','1');
INSERT INTO countries VALUES (228,'Vatican City State (Holy See)','VA','VAT','1');
INSERT INTO countries VALUES (229,'Venezuela','VE','VEN','1');
INSERT INTO countries VALUES (230,'Viet Nam','VN','VNM','1');
INSERT INTO countries VALUES (231,'Virgin Islands (British)','VG','VGB','1');
INSERT INTO countries VALUES (232,'Virgin Islands (U.S.)','VI','VIR','1');
INSERT INTO countries VALUES (233,'Wallis and Futuna Islands','WF','WLF','1');
INSERT INTO countries VALUES (234,'Western Sahara','EH','ESH','1');
INSERT INTO countries VALUES (235,'Yemen','YE','YEM','1');
INSERT INTO countries VALUES (236,'Yugoslavia','YU','YUG','1');
INSERT INTO countries VALUES (237,'Zaire','ZR','ZAR','1');
INSERT INTO countries VALUES (238,'Zambia','ZM','ZMB','1');
INSERT INTO countries VALUES (239,'Zimbabwe','ZW','ZWE','1');

INSERT INTO currencies VALUES (2,'Euro','EURO','&euro;&nbsp;','','.',',','2','1.0000', now());
INSERT INTO currencies VALUES (1,'US Dollar','USD','$','','.',',','2','1.22360003', now());


#language id == 43 == telephone-countrycode
INSERT INTO languages VALUES (43,'Deutsch','de','icon.gif','german',2);
INSERT INTO languages VALUES (1,'English','en','icon.gif','english',1);

INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'banner_box_all.php', 1, 1, 5, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'banner_box.php', 1, 0, 300, 1, 127);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'banner_box2.php', 1, 1, 15, 1, 15);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'best_sellers.php', 1, 1, 30, 70, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'categories.php', 1, 0, 10, 10, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'currencies.php', 1, 1, 80, 60, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'document_categories.php', 1, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'ezpages.php', 1, 1, -1, 2, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'featured.php', 1, 0, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'information.php', 1, 0, 50, 40, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'languages.php', 1, 1, 70, 50, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'manufacturers.php', 1, 0, 30, 20, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'manufacturer_info.php', 1, 1, 35, 95, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'more_information.php', 1, 0, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'music_genres.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'order_history.php', 0, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'product_notifications.php', 1, 1, 55, 85, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'record_companies.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'reviews.php', 1, 0, 40, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'search.php', 1, 1, 10, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'search_header.php', 0, 0, 0, 0, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'shopping_cart.php', 1, 1, 20, 30, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'specials.php', 1, 1, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'tell_a_friend.php', 1, 1, 65, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'whats_new.php', 1, 0, 20, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'whos_online.php', 1, 1, 200, 200, 1);

INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'banner_box_all.php', 1, 1, 5, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'banner_box.php', 1, 0, 300, 1, 127);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'banner_box2.php', 1, 1, 15, 1, 15);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'best_sellers.php', 1, 1, 30, 70, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'categories.php', 1, 0, 10, 10, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'currencies.php', 1, 1, 80, 60, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'ezpages.php', 1, 1, -1, 2, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'featured.php', 1, 0, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'information.php', 1, 0, 50, 40, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'languages.php', 1, 1, 70, 50, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'manufacturers.php', 1, 0, 30, 20, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'manufacturer_info.php', 1, 1, 35, 95, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'more_information.php', 1, 0, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'my_broken_box.php', 1, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'order_history.php', 0, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'product_notifications.php', 1, 1, 55, 85, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'reviews.php', 1, 0, 40, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'search.php', 1, 1, 10, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'search_header.php', 0, 0, 0, 0, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'shopping_cart.php', 1, 1, 20, 30, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'specials.php', 1, 1, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'tell_a_friend.php', 1, 1, 65, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'whats_new.php', 1, 0, 20, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'whos_online.php', 1, 1, 200, 200, 1);

INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'banner_box.php', 1, 0, 300, 1, 127);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'banner_box2.php', 1, 1, 15, 1, 15);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'banner_box_all.php', 1, 1, 5, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'best_sellers.php', 1, 1, 30, 70, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'categories.php', 1, 0, 10, 10, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'currencies.php', 1, 1, 80, 60, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'document_categories.php', 1, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'ezpages.php', 1, 1, -1, 2, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'featured.php', 1, 0, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'information.php', 1, 0, 50, 40, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'languages.php', 1, 1, 70, 50, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'manufacturers.php', 1, 0, 30, 20, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'manufacturer_info.php', 1, 1, 35, 95, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'more_information.php', 1, 0, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'music_genres.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'order_history.php', 0, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'product_notifications.php', 1, 1, 55, 85, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'record_companies.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'reviews.php', 1, 0, 40, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'search.php', 1, 1, 10, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'search_header.php', 0, 0, 0, 0, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'shopping_cart.php', 1, 1, 20, 30, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'specials.php', 1, 1, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'tell_a_friend.php', 1, 1, 65, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'whats_new.php', 1, 0, 20, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'whos_online.php', 1, 1, 200, 200, 1);

INSERT INTO orders_status VALUES ( '1', '1', 'Pending');
INSERT INTO orders_status VALUES ( '2', '1', 'Processing');
INSERT INTO orders_status VALUES ( '3', '1', 'Delivered');
INSERT INTO orders_status VALUES ( '4', '1', 'Update');

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

# AUSTRIA
INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (4, 0, NULL, 3, '2004-09-29 10:09:11', '2004-09-29 09:52:37');
INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (3, 'ALL', 'ALL THE ZONES', '2004-09-29 10:54:26', '2004-09-29 09:49:27');
INSERT INTO tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) VALUES (2, '20%', '20%', NULL, '2004-08-06 19:46:30');
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (5, 3, 2, 10, '20.0000', '20%', '2004-09-29 10:24:32', '2004-09-29 10:03:07');
INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (6, 3, 1, 20, '10.0000', '10%', '2004-09-29 10:24:44', '2004-09-29 10:03:47');


# USA
INSERT INTO zones VALUES (1,223,'AL','Alabama');
INSERT INTO zones VALUES (2,223,'AK','Alaska');
INSERT INTO zones VALUES (3,223,'AS','American Samoa');
INSERT INTO zones VALUES (4,223,'AZ','Arizona');
INSERT INTO zones VALUES (5,223,'AR','Arkansas');
INSERT INTO zones VALUES (6,223,'AF','Armed Forces Africa');
INSERT INTO zones VALUES (7,223,'AA','Armed Forces Americas');
INSERT INTO zones VALUES (8,223,'AC','Armed Forces Canada');
INSERT INTO zones VALUES (9,223,'AE','Armed Forces Europe');
INSERT INTO zones VALUES (10,223,'AM','Armed Forces Middle East');
INSERT INTO zones VALUES (11,223,'AP','Armed Forces Pacific');
INSERT INTO zones VALUES (12,223,'CA','California');
INSERT INTO zones VALUES (13,223,'CO','Colorado');
INSERT INTO zones VALUES (14,223,'CT','Connecticut');
INSERT INTO zones VALUES (15,223,'DE','Delaware');
INSERT INTO zones VALUES (16,223,'DC','District of Columbia');
INSERT INTO zones VALUES (17,223,'FM','Federated States Of Micronesia');
INSERT INTO zones VALUES (18,223,'FL','Florida');
INSERT INTO zones VALUES (19,223,'GA','Georgia');
INSERT INTO zones VALUES (20,223,'GU','Guam');
INSERT INTO zones VALUES (21,223,'HI','Hawaii');
INSERT INTO zones VALUES (22,223,'ID','Idaho');
INSERT INTO zones VALUES (23,223,'IL','Illinois');
INSERT INTO zones VALUES (24,223,'IN','Indiana');
INSERT INTO zones VALUES (25,223,'IA','Iowa');
INSERT INTO zones VALUES (26,223,'KS','Kansas');
INSERT INTO zones VALUES (27,223,'KY','Kentucky');
INSERT INTO zones VALUES (28,223,'LA','Louisiana');
INSERT INTO zones VALUES (29,223,'ME','Maine');
INSERT INTO zones VALUES (30,223,'MH','Marshall Islands');
INSERT INTO zones VALUES (31,223,'MD','Maryland');
INSERT INTO zones VALUES (32,223,'MA','Massachusetts');
INSERT INTO zones VALUES (33,223,'MI','Michigan');
INSERT INTO zones VALUES (34,223,'MN','Minnesota');
INSERT INTO zones VALUES (35,223,'MS','Mississippi');
INSERT INTO zones VALUES (36,223,'MO','Missouri');
INSERT INTO zones VALUES (37,223,'MT','Montana');
INSERT INTO zones VALUES (38,223,'NE','Nebraska');
INSERT INTO zones VALUES (39,223,'NV','Nevada');
INSERT INTO zones VALUES (40,223,'NH','New Hampshire');
INSERT INTO zones VALUES (41,223,'NJ','New Jersey');
INSERT INTO zones VALUES (42,223,'NM','New Mexico');
INSERT INTO zones VALUES (43,223,'NY','New York');
INSERT INTO zones VALUES (44,223,'NC','North Carolina');
INSERT INTO zones VALUES (45,223,'ND','North Dakota');
INSERT INTO zones VALUES (46,223,'MP','Northern Mariana Islands');
INSERT INTO zones VALUES (47,223,'OH','Ohio');
INSERT INTO zones VALUES (48,223,'OK','Oklahoma');
INSERT INTO zones VALUES (49,223,'OR','Oregon');
INSERT INTO zones VALUES (50,223,'PW','Palau');
INSERT INTO zones VALUES (51,223,'PA','Pennsylvania');
INSERT INTO zones VALUES (52,223,'PR','Puerto Rico');
INSERT INTO zones VALUES (53,223,'RI','Rhode Island');
INSERT INTO zones VALUES (54,223,'SC','South Carolina');
INSERT INTO zones VALUES (55,223,'SD','South Dakota');
INSERT INTO zones VALUES (56,223,'TN','Tennessee');
INSERT INTO zones VALUES (57,223,'TX','Texas');
INSERT INTO zones VALUES (58,223,'UT','Utah');
INSERT INTO zones VALUES (59,223,'VT','Vermont');
INSERT INTO zones VALUES (60,223,'VI','Virgin Islands');
INSERT INTO zones VALUES (61,223,'VA','Virginia');
INSERT INTO zones VALUES (62,223,'WA','Washington');
INSERT INTO zones VALUES (63,223,'WV','West Virginia');
INSERT INTO zones VALUES (64,223,'WI','Wisconsin');
INSERT INTO zones VALUES (65,223,'WY','Wyoming');

# Canada
INSERT INTO zones VALUES (66,38,'AB','Alberta');
INSERT INTO zones VALUES (67,38,'BC','British Columbia');
INSERT INTO zones VALUES (68,38,'MB','Manitoba');
INSERT INTO zones VALUES (69,38,'NF','Newfoundland');
INSERT INTO zones VALUES (70,38,'NB','New Brunswick');
INSERT INTO zones VALUES (71,38,'NS','Nova Scotia');
INSERT INTO zones VALUES (72,38,'NT','Northwest Territories');
INSERT INTO zones VALUES (73,38,'NU','Nunavut');
INSERT INTO zones VALUES (74,38,'ON','Ontario');
INSERT INTO zones VALUES (75,38,'PE','Prince Edward Island');
INSERT INTO zones VALUES (76,38,'QC','Quebec');
INSERT INTO zones VALUES (77,38,'SK','Saskatchewan');
INSERT INTO zones VALUES (78,38,'YT','Yukon Territory');

# Germany
INSERT INTO zones VALUES (79,81,'NDS','Niedersachsen');
INSERT INTO zones VALUES (80,81,'BAW','Baden-W�rttemberg');
INSERT INTO zones VALUES (81,81,'BAY','Bayern');
INSERT INTO zones VALUES (82,81,'BER','Berlin');
INSERT INTO zones VALUES (83,81,'BRG','Brandenburg');
INSERT INTO zones VALUES (84,81,'BRE','Bremen');
INSERT INTO zones VALUES (85,81,'HAM','Hamburg');
INSERT INTO zones VALUES (86,81,'HES','Hessen');
INSERT INTO zones VALUES (87,81,'MEC','Mecklenburg-Vorpommern');
INSERT INTO zones VALUES (88,81,'NRW','Nordrhein-Westfalen');
INSERT INTO zones VALUES (89,81,'RHE','Rheinland-Pfalz');
INSERT INTO zones VALUES (90,81,'SAR','Saarland');
INSERT INTO zones VALUES (91,81,'SAS','Sachsen');
INSERT INTO zones VALUES (92,81,'SAC','Sachsen-Anhalt');
INSERT INTO zones VALUES (93,81,'SCN','Schleswig-Holstein');
INSERT INTO zones VALUES (94,81,'THE','Thringen');

# Austria
INSERT INTO zones VALUES (95,14,'WI','Wien');
INSERT INTO zones VALUES (96,14,'NO','Nieder�sterreich');
INSERT INTO zones VALUES (97,14,'OO','Ober�sterreich');
INSERT INTO zones VALUES (98,14,'SB','Salzburg');
INSERT INTO zones VALUES (99,14,'KN','K�rnten');
INSERT INTO zones VALUES (100,14,'ST','Steiermark');
INSERT INTO zones VALUES (101,14,'TI','Tirol');
INSERT INTO zones VALUES (102,14,'BL','Burgenland');
INSERT INTO zones VALUES (103,14,'VB','Voralberg');

# Swizterland
INSERT INTO zones VALUES (104,204,'AG','Aargau');
INSERT INTO zones VALUES (105,204,'AI','Appenzell Innerrhoden');
INSERT INTO zones VALUES (106,204,'AR','Appenzell Ausserrhoden');
INSERT INTO zones VALUES (107,204,'BE','Bern');
INSERT INTO zones VALUES (108,204,'BL','Basel-Landschaft');
INSERT INTO zones VALUES (109,204,'BS','Basel-Stadt');
INSERT INTO zones VALUES (110,204,'FR','Freiburg');
INSERT INTO zones VALUES (111,204,'GE','Genf');
INSERT INTO zones VALUES (112,204,'GL','Glarus');
INSERT INTO zones VALUES (113,204,'JU','Graubnden');
INSERT INTO zones VALUES (114,204,'JU','Jura');
INSERT INTO zones VALUES (115,204,'LU','Luzern');
INSERT INTO zones VALUES (116,204,'NE','Neuenburg');
INSERT INTO zones VALUES (117,204,'NW','Nidwalden');
INSERT INTO zones VALUES (118,204,'OW','Obwalden');
INSERT INTO zones VALUES (119,204,'SG','St. Gallen');
INSERT INTO zones VALUES (120,204,'SH','Schaffhausen');
INSERT INTO zones VALUES (121,204,'SO','Solothurn');
INSERT INTO zones VALUES (122,204,'SZ','Schwyz');
INSERT INTO zones VALUES (123,204,'TG','Thurgau');
INSERT INTO zones VALUES (124,204,'TI','Tessin');
INSERT INTO zones VALUES (125,204,'UR','Uri');
INSERT INTO zones VALUES (126,204,'VD','Waadt');
INSERT INTO zones VALUES (127,204,'VS','Wallis');
INSERT INTO zones VALUES (128,204,'ZG','Zug');
INSERT INTO zones VALUES (129,204,'ZH','Z�rich');

# Spain
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'A Corua','A Corua');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Alava','Alava');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Albacete','Albacete');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Alicante','Alicante');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Almeria','Almeria');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Asturias','Asturias');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Avila','Avila');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Badajoz','Badajoz');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Baleares','Baleares');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Barcelona','Barcelona');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Burgos','Burgos');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Caceres','Caceres');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cadiz','Cadiz');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cantabria','Cantabria');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Castellon','Castellon');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Ceuta','Ceuta');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Ciudad Real','Ciudad Real');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cordoba','Cordoba');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cuenca','Cuenca');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Girona','Girona');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Granada','Granada');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Guadalajara','Guadalajara');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Guipuzcoa','Guipuzcoa');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Huelva','Huelva');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Huesca','Huesca');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Jaen','Jaen');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'La Rioja','La Rioja');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Las Palmas','Las Palmas');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Leon','Leon');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Lleida','Lleida');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Lugo','Lugo');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Madrid','Madrid');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Malaga','Malaga');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Melilla','Melilla');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Murcia','Murcia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Navarra','Navarra');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Ourense','Ourense');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Palencia','Palencia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Pontevedra','Pontevedra');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Salamanca','Salamanca');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Santa Cruz de Tenerife','Santa Cruz de Tenerife');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Segovia','Segovia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Sevilla','Sevilla');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Soria','Soria');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Tarragona','Tarragona');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Teruel','Teruel');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Toledo','Toledo');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Valencia','Valencia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Valladolid','Valladolid');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Vizcaya','Vizcaya');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Zamora','Zamora');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Zaragoza','Zaragoza');


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

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Tell a Friend button', 'SHOW_PRODUCT_INFO_TELL_A_FRIEND', '1', 'Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on', '1', '15', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
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
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Record Company', 'SHOW_PRODUCT_MUSIC_INFO_RECORD_COMPANY', '1', 'Display Recoprd Company on Product Info 0= off 1= on', '2', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Shopping Cart', 'SHOW_PRODUCT_MUSIC_INFO_IN_CART_QTY', '1', 'Display Quantity in Current Shopping Cart on Product Info 0= off 1= on', '2', '5', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Stock', 'SHOW_PRODUCT_MUSIC_INFO_QUANTITY', '0', 'Display Quantity in Stock on Product Info 0= off 1= on', '2', '6', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_PRODUCT_MUSIC_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '2', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_PRODUCT_MUSIC_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '2', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_PRODUCT_MUSIC_INFO_DATE_AVAILABLE', '1', 'Display Date Available on Product Info 0= off 1= on', '2', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_PRODUCT_MUSIC_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '2', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Starting At text on Price', 'SHOW_PRODUCT_MUSIC_INFO_STARTING_AT', '1', 'Display Starting At text on products with attributes Product Info 0= off 1= on', '2', '12', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_PRODUCT_MUSIC_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '2', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Tell a Friend button', 'SHOW_PRODUCT_MUSIC_INFO_TELL_A_FRIEND', '1', 'Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on', '2', '15', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Image Status - Catalog', 'SHOW_PRODUCT_MUSIC_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', '0', 'Show the Free Shipping image/text in the catalog?', '2', '16', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
#admin defaults
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, use_function, set_function, date_added) VALUES ('Product Price Tax Class Default - When adding new products?', 'DEFAULT_PRODUCT_MUSIC_TAX_CLASS_ID', '0', 'What should the Product Price Tax Class Default ID be when adding new products?', '2', '100', '', '', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address - When adding new products?', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_VIRTUAL', '0', 'Default Virtual Product status to be ON when adding new products?', '2', '101', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '0', 'What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping', '2', '102', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ', now());


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_DOCUMENT_GENERAL_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '3', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_DOCUMENT_GENERAL_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '3', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_DOCUMENT_GENERAL_INFO_DATE_AVAILABLE', '1', 'Display Date Available on Product Info 0= off 1= on', '3', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_DOCUMENT_GENERAL_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '3', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Tell a Friend button', 'SHOW_DOCUMENT_GENERAL_INFO_TELL_A_FRIEND', '1', 'Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on', '3', '15', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
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

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Tell a Friend button', 'SHOW_DOCUMENT_PRODUCT_INFO_TELL_A_FRIEND', '1', 'Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on', '4', '15', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
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

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Tell a Friend button', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_TELL_A_FRIEND', '1', 'Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on', '5', '15', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Image Status - Catalog', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', '1', 'Show the Free Shipping image/text in the catalog?', '5', '16', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
#admin defaults
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, use_function, set_function, date_added) VALUES ('Product Price Tax Class Default - When adding new products?', 'DEFAULT_PRODUCT_FREE_SHIPPING_TAX_CLASS_ID', '0', 'What should the Product Price Tax Class Default ID be when adding new products?', '5', '100', '', '', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address - When adding new products?', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_VIRTUAL', '0', 'Default Virtual Product status to be ON when adding new products?', '5', '101', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '1', 'What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping', '5', '102', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ', now());

#insert product type layout settings for meta-tags
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Title', 'SHOW_PRODUCT_INFO_METATAGS_TITLE_STATUS', '1', 'Display Product Title in Meta Tags Title 0= off 1= on', '1', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Name', 'SHOW_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Display Product Name in Meta Tags Title 0= off 1= on', '1', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Model', 'SHOW_PRODUCT_INFO_METATAGS_MODEL_STATUS', '1', 'Display Product Model in Meta Tags Title 0= off 1= on', '1', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Price', 'SHOW_PRODUCT_INFO_METATAGS_PRICE_STATUS', '1', 'Display Product Price in Meta Tags Title 0= off 1= on', '1', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Tagline', 'SHOW_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Display Product Tagline in Meta Tags Title 0= off 1= on', '1', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Title', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_STATUS', '1', 'Display Product Title in Meta Tags Title 0= off 1= on', '2', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Name', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Display Product Name in Meta Tags Title 0= off 1= on', '2', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Model', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_MODEL_STATUS', '1', 'Display Product Model in Meta Tags Title 0= off 1= on', '2', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Price', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRICE_STATUS', '1', 'Display Product Price in Meta Tags Title 0= off 1= on', '2', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Tagline', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Display Product Tagline in Meta Tags Title 0= off 1= on', '2', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Title', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_STATUS', '1', 'Display Document Title in Meta Tags Title 0= off 1= on', '3', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Name', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Display Document Name in Meta Tags Title 0= off 1= on', '3', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Tagline', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Display Document Tagline in Meta Tags Title 0= off 1= on', '3', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Title', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_STATUS', '1', 'Display Document Title in Meta Tags Title 0= off 1= on', '4', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Name', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Display Document Name in Meta Tags Title 0= off 1= on', '4', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Model', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_MODEL_STATUS', '1', 'Display Document Model in Meta Tags Title 0= off 1= on', '4', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Price', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRICE_STATUS', '1', 'Display Document Price in Meta Tags Title 0= off 1= on', '4', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Tagline', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Display Document Tagline in Meta Tags Title 0= off 1= on', '4', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Title', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_STATUS', '1', 'Display Product Title in Meta Tags Title 0= off 1= on', '5', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Name', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Display Product Name in Meta Tags Title 0= off 1= on', '5', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Model', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_MODEL_STATUS', '1', 'Display Product Model in Meta Tags Title 0= off 1= on', '5', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Price', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRICE_STATUS', '1', 'Display Product Price in Meta Tags Title 0= off 1= on', '5', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Tagline', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Display Product Tagline in Meta Tags Title 0= off 1= on', '5', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
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


## Insert the default queries for "all customers" and "all newsletter subscribers"
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '1', 'email', 'All Customers', 'Returns all customers name and email address for sending mass emails (ie: for newsletters, coupons, GV\'s, messages, etc).', 'select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS order by customers_lastname, customers_firstname, customers_email_address');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '2', 'email,newsletters', 'All Newsletter Subscribers', 'Returns name and email address of newsletter subscribers', 'select customers_firstname, customers_lastname, customers_email_address from TABLE_CUSTOMERS where customers_newsletter = \'1\'');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '3', 'email,newsletters', 'Dormant Customers (>3months) (Subscribers)', 'Subscribers who HAVE purchased something, but have NOT purchased for at least three months.', 'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased < subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '4', 'email,newsletters', 'Active customers in past 3 months (Subscribers)', 'Newsletter subscribers who are also active customers (purchased something) in last 3 months.', 'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '5', 'email,newsletters', 'Active customers in past 3 months (Regardless of subscription status)', 'All active customers (purchased something) in last 3 months, ignoring newsletter-subscription status.', 'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o WHERE c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '6', 'email,newsletters', 'Administrator', 'Just the email account of the current administrator', 'select \'ADMIN\' as customers_firstname, admin_name as customers_lastname, admin_email as customers_email_address from TABLE_ADMIN where admin_id = $SESSION:admin_id');

#
# end of Query-Builder Setup
#

#
# Dumping data for table `get_terms_to_filter`
#

INSERT INTO get_terms_to_filter VALUES ('manufacturers_id');
INSERT INTO get_terms_to_filter VALUES ('music_genre_id');
INSERT INTO get_terms_to_filter VALUES ('record_company_id');

#
# Dumping data for table `project_version`
#

INSERT INTO project_version (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch1, project_version_patch1_source, project_version_patch2, project_version_patch2_source, project_version_comment, project_version_date_applied) VALUES (1, 'Zen-Cart Main', '1', '3.0.2', '', '', '', '', 'Fresh Installation', now());
INSERT INTO project_version (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch1, project_version_patch1_source, project_version_patch2, project_version_patch2_source, project_version_comment, project_version_date_applied) VALUES (2, 'Zen-Cart Database', '1', '3.0.2', '', '', '', '', 'Fresh Installation', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (1, 'Zen-Cart Main', '1', '3.0.2', '', 'Fresh Installation', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (2, 'Zen-Cart Database', '1', '3.0.2', '', 'Fresh Installation', now());

#################################################################
#  LANGUAGE SPECIFIC                                            #
#  questions to: zencart(AT)langheiter.at                       #
#################################################################

DROP TABLE IF EXISTS configuration_language;
CREATE TABLE configuration_language (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title text NOT NULL,
  configuration_key varchar(255) NOT NULL default '',
  configuration_language_id int(11) NOT NULL default '1',
  configuration_description text NOT NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (configuration_id),
  UNIQUE KEY config_lang (configuration_key,configuration_language_id),
  KEY configuration_language_id (configuration_language_id)
);

#
# Daten f�r Tabelle configuration_language
#
INSERT INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Shopname', 'STORE_NAME', 43, 'Geben Sie hier einen Name f&uuml;r den Shop ein', NULL, '2004-11-20 11:14:04'),
('Shopinhaber', 'STORE_OWNER', 43, 'Geben Sie hier einen Namen f&uuml;r den Shopinhaber ein', NULL, '2004-11-20 11:14:04'),
('Land', 'STORE_COUNTRY', 43, 'Geben Sie hier das Land an, in dem der Shop betrieben wird<br /><br /><strong><b>Hinweis: Bitte nicht vergessen, das Bundesland des Shops zu aktualisieren</b></strong>', NULL, '2004-11-20 11:14:04'),
('Bundesland', 'STORE_ZONE', 43, 'Geben Sie hier das Bundesland an, in dem der Shop betrieben wird', NULL, '2004-11-20 11:14:04'),
('Erwartete Artikel: Sortierreihenfolge', 'EXPECTED_PRODUCTS_SORT', 43, 'Wie sollen die Artikel in der Box "erwartete Artikel" sortiert werden?', NULL, '2004-11-20 11:14:04'),
('Erwartete Artikel: Sortierung', 'EXPECTED_PRODUCTS_FIELD', 43, 'Nach welcher Spalte soll sortiert werden?', NULL, '2004-11-20 11:14:04'),
('Automatisch zur Standardw&auml;hrung der Sprache wechseln', 'USE_DEFAULT_LANGUAGE_CURRENCY', 43, 'Soll automatischer zu der zur Sprache passenden W&auml;hrung gewechselt werden?', NULL, '2004-11-20 11:14:04'),
('Suchmaschinenfeste (Kurz-)URLs verwenden (noch in Entwicklung)', 'SEARCH_ENGINE_FRIENDLY_URLS', 43, 'Suchmaschinenfeste URLs (KurzURL) f&uuml;r alle Links im Shop verwenden', NULL, '2004-11-20 11:14:04'),
('Warenkorb nach hinzuf&uuml;gen eines Artikels anzeigen', 'DISPLAY_CART', 43, 'Soll der Warenkorb nach hinzuf&uuml;gen eines Artikels angezeigt werden? (Hinweis: false= nein, zur&uuml;ck zum Artikel)', NULL, '2004-11-20 11:14:04'),
('Standard Suchoperator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 43, 'Standard Suchoperator<br />"AND": W&ouml;rter, die vorkommen m&uuml;ssen<br />"OR": W&ouml;rter, die vorkommen k&ouml;nnen<br />"NOT": W&ouml;rter, die nicht vorkommen sollen', NULL, '2004-11-20 11:14:04'),
('Shopadresse und Telefonnummer', 'STORE_NAME_ADDRESS', 43, 'Diese Adresse wird auf ausdruckbaren Dokumenten und online im Shop angezeigt', NULL, '2004-11-20 11:14:04'),
('Z&auml;hler hinter Kategorienamen anzeigen', 'SHOW_COUNTS', 43, 'Soll der Z&auml;hler, der die Anzahl von Artikel in der jeweiligen Kategorie anzeigt,<br />hinter dem Kategorienamen sichtbar sein?', NULL, '2004-11-20 11:14:04'),
('Dezimalstellen bei Steuern', 'TAX_DECIMAL_PLACES', 43, 'Wieviele Dezimalstellen sollen bei den Steuern angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Bruttopreise im Shop verwenden', 'DISPLAY_PRICE_WITH_TAX', 43, 'Sollen die Bruttopreise im Shop angezeigt werden?<br />true= Bruttopreise (inkl. Steuern)<br />false= Nettopreise (exkl. Steuern)', NULL, '2004-11-20 11:14:04'),
('Preise inkl. Steuern im Adminbereich anzeigen', 'DISPLAY_PRICE_WITH_TAX_ADMIN', 43, 'Preise inkl. Steuern (true) oder die Steuern am Ende (false) im Adminbereich anzeigen(Rechnungen)', NULL, '2004-11-20 11:14:04'),
('Basis der Steuern f&uuml;r Artikel', 'STORE_PRODUCT_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern bei Artikel berechnet werden? Die Optionen sind:<br />Versand (Shipping) - Berechnung erfolgt auf Basis der Versandadresse<br />Rechnung (Billing) - Berechnung erfolgt auf Basis der Rechnungsadresse<br />Shop (Store) - Berechnung erfolgt auf Basis der Shopadresse, wenn die Versand-/Rechnungsadresse innerhalb der Zone des Shops liegt', NULL, '2004-11-20 11:14:04'),
('Basis der Steuern f&uuml;r Versand', 'STORE_SHIPPING_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern bei Versandkosten berechnet werden? Die Optionen sind:<br />Versand (Shipping) - Berechnung erfolgt auf Basis der Versandadresse<br />Rechnung (Billing) - Berechnung erfolgt auf Basis der Rechnungsadresse<br />Shop (Store) - Berechnung erfolgt auf Basis der Shopadresse, wenn die Versand-/Rechnungsadresse innerhalb der Zone des Shops liegt (kann vom Versandmodul &uuml;berschrieben werden)', NULL, '2004-11-20 11:14:04'),
('Timeout der Admin- Sitzungen (in Sekunden)', 'SESSION_TIMEOUT_ADMIN', 43, 'Geben Sie die Zeit in Sekunden an. Standard=3600<br /> Beispiel: 3600= 1 Stunde<br />Hinweis: Eine zu geringe Zeitangabe kann zu Problemen bei der Bearbeitung von Artikel f&uuml;hren.', NULL, '2004-11-20 11:14:04'),
('Maximale Zeit f&uuml;r die Ausf&uuml;hrung von Prozessen', 'GLOBAL_SET_TIME_LIMIT', 43, 'Geben Sie die Zeit in Sekunden an. Standard=60<br />Beispiel: 60= 1 Minute<br /><br />Hinweis: Diesen Wert sollte nur ge&auml;ndert werden, wenn es Probleme bei der Ausf&uuml;hrung von Prozessen gibt.', NULL, '2004-11-20 11:14:04'),
('Zen Cart Update - Check', 'SHOW_VERSION_UPDATE_IN_HEADER', 43, 'Automatische �berpr&uuml;fung auf eine neuere Version von Zen Cart und zeigt dies dann im Header des Admin Bereichs an. Wenn dieses Feature aktiviert ist, kann es manchmal zu Geschwindigkeitseinbu&szlig;en im Admin Bereich kommen.', NULL, '2004-11-20 11:14:04'),
('Shopstatus', 'STORE_STATUS', 43, 'Wie ist der Shopstatus:<br />0= Normaler Shop<br />1= Schauraum ohne Preise<br />2= Schauraum mit Preisen', NULL, '2004-11-20 11:14:04'),
('Server Onlinestatus anzeigen', 'DISPLAY_SERVER_UPTIME', 43, 'Zeigt die Onlinezeit des Servers an.<br />Hinweis: Das Aktivieren diese Einstellung kann bei einigen Server Eintr&auml;ge in den Fehlerprotokollen verursachen.  (true = anzeigen, false = nicht anzeigen)', '2003-11-08 20:24:47', '0001-01-01 00:00:00'),
('�berpr&uuml;fung auf fehlende Seiten', 'MISSING_PAGE_CHECK', 43, 'Zen Cart kann das Fehlen von Seiten in einer URL erkennen und leitet dann bei Bedarf auf die Indexseite weiter.<br />F&uuml;r ein Debugging kann diese Funktion deaktiviert werden. (true = Auf fehlende Seiten pr&uuml;fen, false = Keine �berpr&uuml;fung auf fehlende Seiten)', '2003-11-08 20:24:47', '0001-01-01 00:00:00'),
('HTML Editor', 'HTML_EDITOR_PREFERENCE', 43, 'Welchen HTML Editor wollen Sie zu Bearbeitung von Admin- relevanten e-Mails, Newsletters und Artikelbeschreibungen verwenden?', NULL, '2004-11-20 11:14:04'),
('phpBB Forumsynchronisierung aktivieren?', 'PHPBB_LINKS_ENABLED', 43, 'Soll Zen Cart neue Konten des - bereits installierten - phpBB Forums mit den Shopkonten synchronisieren?', NULL, '2004-11-20 11:14:04'),
('Kategoriez&auml;hler im Adminbereich anzeigen', 'SHOW_COUNTS_ADMIN', 43, 'Soll der Kategoriez&auml;hler im Adminbereich angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Vorname', 'ENTRY_FIRST_NAME_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r den Vornamen', NULL, '2004-11-20 11:14:04'),
('Nachname', 'ENTRY_LAST_NAME_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r den Nachnamen', NULL, '2004-11-20 11:14:04'),
('Geburtsdatum', 'ENTRY_DOB_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r das Geburtsdatum', NULL, '2004-11-20 11:14:04'),
('e-Mail Adresse', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r die e-Mail Adresse', NULL, '2004-11-20 11:14:04'),
('Strasse', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r die Strasse', NULL, '2004-11-20 11:14:04'),
('Firma', 'ENTRY_COMPANY_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge der Firma', NULL, '2004-11-20 11:14:04'),
('Postleitzahl', 'ENTRY_POSTCODE_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge der Postleitzahl', NULL, '2004-11-20 11:14:04'),
('Stadt', 'ENTRY_CITY_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge der Stadt', NULL, '2004-11-20 11:14:04'),
('Bundesland', 'ENTRY_STATE_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r das Bundesland', NULL, '2004-11-20 11:14:04'),
('Telefonnummer', 'ENTRY_TELEPHONE_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r die Telefonnummer', NULL, '2004-11-20 11:14:04'),
('Passwort', 'ENTRY_PASSWORD_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r das Passwort', NULL, '2004-11-20 11:14:04'),
('Kreditkarteninhaber', 'CC_OWNER_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r den Namen des Kreditkarteninhabers', NULL, '2004-11-20 11:14:04'),
('Kreditkartennummer', 'CC_NUMBER_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r die Kreditkartennummer', NULL, '2004-11-20 11:14:04'),
('Kreditkarten-Sicherheitscode (CVV)', 'CC_CVV_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r den Kreditkarten Sicherheitscode (CVV)', NULL, '2004-11-20 11:14:04'),
('Zeichenl&auml;nge f&uuml;r Text bei Bewertungen', 'REVIEW_TEXT_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r den Text einer Bewertung', NULL, '2004-11-20 11:14:04'),
('Bestseller', 'MIN_DISPLAY_BESTSELLERS', 43, 'Wieviele Bestseller sollen angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Verkaufsf&ouml;rderung (Kunden, die ... gekauft haben, haben auch ... gekauft)', 'MIN_DISPLAY_ALSO_PURCHASED', 43, 'Minimale Anzahl der anzuzeigenden Artikel  in der Box "Kunden, die ... kauften, haben auch ... gekauft"', NULL, '2004-11-20 11:14:04'),
('Nickname', 'ENTRY_NICK_MIN_LENGTH', 43, 'Minimale Zeichenl&auml;nge f&uuml;r Nicknamen', NULL, '2004-11-20 11:14:04'),
('Adresseintr&auml;ge im Adressbuch', 'MAX_ADDRESS_BOOK_ENTRIES', 43, 'Wieviele Adresseintr&auml;ge d&uuml;rfen Kunden in Ihrem Adressbuch haben?', NULL, '2004-11-20 11:14:04'),
('Suchresultate pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS', 43, 'Wieviele Artikel sollen maximal in den Suchresultaten pro Seite angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('"Vorherige - N&auml;chste" Navigation: Seitenlinks', 'MAX_DISPLAY_PAGE_LINKS', 43, 'Anzahl der Seitenlinks in der "Vorherige - N&auml;chste" Navigation', NULL, '2004-11-20 11:14:04'),
('Anzuzeigende "Sonderangebote"', 'MAX_DISPLAY_SPECIAL_PRODUCTS', 43, 'Wieviele Sonderangebote sollen angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Anzuzeigende "neue Artikel"', 'MAX_DISPLAY_NEW_PRODUCTS', 43, 'Wieviele "neue Artikel" sollen in den Kategorien angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Anzuzeigende "Erwartete Artikel"', 'MAX_DISPLAY_UPCOMING_PRODUCTS', 43, 'Wieviele "erwartete Artikel" sollen angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Hersteller - Scroll Box Gr&ouml;&szlig;e/Stil', 'MAX_MANUFACTURERS_LIST', 43, 'Anzahl der Hersteller, die im Scroll Box Fenster angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird ein Dropdown Liste angezeigt.', NULL, '2004-11-20 11:14:04'),
('Musik Genre - Scroll Box Gr&ouml;&szlig;e/Stil', 'MAX_MUSIC_GENRES_LIST', 43, 'Anzahl der Musik Genres, die im Scroll Box Fenster angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird ein Dropdown Liste angezeigt.', NULL, '2004-11-20 11:14:04'),
('Plattenfirma - Scroll Box Gr&ouml;&szlig;e/Stil', 'MAX_RECORD_COMPANY_LIST', 43, 'Anzahl der Plattenfirmen, die im Scroll Box Fenster angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird ein Dropdown Liste angezeigt.', NULL, '2004-11-20 11:14:04'),
('L&auml;nge der Namen von Plattenfirmen', 'MAX_DISPLAY_RECORD_COMPANY_NAME_LEN', 43, 'Wird in der Box "Plattenfirma" verwendet; Maximale L&auml;nge der anzuzeigenden Namen von Plattenfirmen. L&auml;ngere Namen werden abgeschnitten.', NULL, '2004-11-20 11:14:04'),
('L&auml;nge der Namen von Musik Genres', 'MAX_DISPLAY_MUSIC_GENRES_NAME_LEN', 43, 'Wird in der Box "Musik Genre" verwendet; Maximale L&auml;nge der anzuzeigenden Namen von Musik Genres. L&auml;ngere Namen werden abgeschnitten.', NULL, '2004-11-20 11:14:04'),
('L&auml;nge der Namen von Herstellern', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', 43, 'Wird in der Box "Hersteller" verwendet; Maximale L&auml;nge der anzuzeigenden Namen von Herstellern. L&auml;ngere Namen werden abgeschnitten.', NULL, '2004-11-20 11:14:04'),
('Bewertungen pro Seite', 'MAX_DISPLAY_NEW_REVIEWS', 43, 'Anzahl der Bewertungen auf jeder Seite', NULL, '2004-11-20 11:14:04'),
('Box "Bewertungen": zuf&auml;llige Artikel', 'MAX_RANDOM_SELECT_REVIEWS', 43, 'Wieviele Bewertungen sollen in der Box "Bewertungen" zuf&auml;llig angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Box "Neue Artikel": zuf&auml;llige Artikel', 'MAX_RANDOM_SELECT_NEW', 43, 'Wieviele neue Artikel sollen in der Box "Neue Artikel" zuf&auml;llig angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Box "Sonderangebot": zuf&auml;llige Artikel', 'MAX_RANDOM_SELECT_SPECIALS', 43, 'Vieviele Sonderangebote sollen in der Box "Sonderangebote" zuf&auml;llig angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Kategorien pro Reihe', 'MAX_DISPLAY_CATEGORIES_PER_ROW', 43, 'Wieviele Kategorien sollen pro Reihe angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Neue Artikel pro Seite', 'MAX_DISPLAY_PRODUCTS_NEW', 43, 'Wieviele neue Artikel sollen pro Seite angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Box "Bestseller": Anzahl der Artikel', 'MAX_DISPLAY_BESTSELLERS', 43, 'Wieviele Bestseller sollen in der Box angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Box "Verkaufsf&ouml;rderung" (Kunden, die ... bestellt haben, haben auch...)', 'MAX_DISPLAY_ALSO_PURCHASED', 43, 'Wieviele Artikel sollen in der Box f&uuml;r die Verkaufsf&ouml;rderung angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Box "k&uuml;rzlich bestellte Artikel" Hinweis: Diese Box ist deaktiviert', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', 43, 'Wieviele Artikel sollen in der Box "K&uuml;rzlich bestellte Artikel" angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Mein Konto: Anzahl Bestellungen pro Seite der Bestellhistorie', 'MAX_DISPLAY_ORDER_HISTORY', 43, 'Wieviele Bestellungen sollen pro Seite der Bestellhistorie in "Mein Konto" angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Kunden pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER', 43, 'Wieviele Kunden sollen pro Seite angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Bestellungen pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_ORDERS', 43, 'Wieviele Bestellungen sollen pro Seite angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Artikel in Berichten pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_REPORTS', 43, 'Wieviele Artikel sollen in Berichten pro Seite angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Artikel in Kategorien pro Seite', 'MAX_DISPLAY_RESULTS_CATEGORIES', 43, 'Wieviele Artikel sollen in den jeweiligen Kategorien pro Seite angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Artikel auf der Startseite', 'MAX_DISPLAY_PRODUCTS_LISTING', 43, 'Wieviele Artikel sollen pro Seite auf der Startseite angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Artikelattribute: Ansicht Attributnamen und -werte', 'MAX_ROW_LISTS_OPTIONS', 43, 'Wieviele Attributnamen und -werte sollen auf der Seite der Artikelattribute maximal angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Artikelattribute: Ansicht Attributmanager', 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER', 43, 'Wieviele Attribute sollen auf der Seite des Attribut Kontroller maximal angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Artikelattribute - Downloadmanager', 'MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER', 43, 'Wieviele Downloadattribute sollen pro Seite im Downloadmanager angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('�hnliche Artikel im Admin Bereich', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN', 43, 'Anzahl &auml;hnlicher Artikel pro Seite im Admin Bereich', NULL, '2004-11-20 11:14:04'),
('�hnliche Artikel auf der Startseite', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED', 43, 'Anzahl &auml;hnlicher Artikel auf der Startseite', NULL, '2004-11-20 11:14:04'),
('�hnliche Artikel pro Seite', 'MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS', 43, 'Anzahl &auml;hnlicher Artikel pro Seite', NULL, '2004-11-20 11:14:04'),
('�hnliche Artikel - zuf&auml;llige Ansicht in der Box "&auml;hnliche Artikel"', 'MAX_RANDOM_SELECT_FEATURED_PRODUCTS', 43, 'Anzahl der zuf&auml;llig angezeigten &auml;hnlichen Artikel in der Box "&auml;hnliche Artikel"', NULL, '2004-11-20 11:14:04'),
('Sonderangebote auf der Startseite', 'MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX', 43, 'Wieviele Sonderangebote sollen auf der Startseite angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Liste "Neue Artikel" - Limitieren auf...', 'SHOW_NEW_PRODUCTS_LIMIT', 43, 'Limitiert die Liste der neuen Artikel auf<br />0= Alle absteigend<br />1= Aktueller Monat<br />30= Die letzten 30 Tage<br />60= Die letzten 60 Tage<br />90= Die letzten 90 Tage<br />120= Die letzten 120 Tage', NULL, '2004-11-20 11:14:04'),
('Anzahl der Artikel auf allen Seiten', 'MAX_DISPLAY_PRODUCTS_ALL', 43, 'Wieviele Artikel sollen maximal pro Seite auf allen Seiten angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Landesflaggen pro Reihe in der Box "Sprachen"', 'MAX_LANGUAGE_FLAGS_COLUMNS', 43, 'Wieviele Landesflaggen sollen maximal pro Reihe angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Gr&ouml;&szlig;e f&uuml;r Datei-Upload', 'MAX_FILE_UPLOAD_SIZE', 43, 'Wie lautet die maximale Gr&ouml;&szlig;e einer Datei, die hochgeladen werden kann?<br />Standard= 2048000 (2MB)', NULL, '2004-11-20 11:14:04'),
('Kleine Bilder: Breite', 'SMALL_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der kleinen Bilder', NULL, '2004-11-20 11:14:04'),
('Kleine Bilder: H&ouml;he', 'SMALL_IMAGE_HEIGHT', 43, 'Die H&ouml;he (in Pixel) der kleinen Bilder', NULL, '2004-11-20 11:14:04'),
('�berschriftbild: Breite', 'HEADING_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Bilder in der �berschrift', NULL, '2004-11-20 11:14:04'),
('�berschriftbild: H&ouml;he', 'HEADING_IMAGE_HEIGHT', 43, 'Die H&ouml;he (in Pixel) der Bilder in der �berschrift', NULL, '2004-11-20 11:14:04'),
('Unterkategorien: Breite der Bilder', 'SUBCATEGORY_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Bilder f&uuml;r die Unterkategorien', NULL, '2004-11-20 11:14:04'),
('Unterkategorien: H&ouml;he der Bilder', 'SUBCATEGORY_IMAGE_HEIGHT', 43, 'Die H&ouml;he (in Pixel) der Bilder f&uuml;r die Unterkategorien', NULL, '2004-11-20 11:14:04'),
('Bildgr&ouml;&szlig;e berechnen', 'CONFIG_CALCULATE_IMAGE_SIZE', 43, 'Soll die Gr&ouml;&szlig;e   der Bilder berechnet werden?', NULL, '2004-11-20 11:14:04'),
('Platzhalter f&uuml;r fehlende Bilder anzeigen', 'IMAGE_REQUIRED', 43, 'Sollen fehlende Bilder "angezeigt" werden? (z.B. Hilfreich in der Entwicklungsphase)', NULL, '2004-11-20 11:14:04'),
('Warenkorb: Artikelbilder anzeigen', 'IMAGE_SHOPPING_CART_STATUS', 43, 'Sollen Artikelbilder im Warenkorb angezeigt werden?<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('Warenkorb: Breite der Artikelbilder', 'IMAGE_SHOPPING_CART_WIDTH', 43, 'Standard = 50', NULL, '2004-11-20 11:14:04'),
('Warenkorb: H&ouml;he der Artikelbilder', 'IMAGE_SHOPPING_CART_HEIGHT', 43, 'Standard = 40', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung: Breite der Artikelbilder', 'MEDIUM_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Artikelbilder in der Produktbeschreibung', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung: H&ouml;he der Artikelbilder', 'MEDIUM_IMAGE_HEIGHT', 43, 'Die H&ouml;he (in Pixel) der Artikelbilder in der Produktbeschreibung', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung: Suffix der Bildmedien', 'IMAGE_SUFFIX_MEDIUM', 43, 'Dateizusatz f&uuml;r Bildmedien der zus&auml;tzlichen Bilder in der Artikelbeschreibung<br />Standard = _MED', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung: Suffix der Bildmedien f&uuml;r gro&szlig;e Bilder', 'IMAGE_SUFFIX_LARGE', 43, 'Dateizusatz f&uuml;r Bildmedien der gro&szlig;en Bilder in der Artikelbeschreibung<br />Standard = _LRG', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung: Anzahl der zus&auml;tzlichen Bilder pro Reihe', 'IMAGES_AUTO_ADDED', 43, 'Tragen Sie hier die Anzahl der pro Reihe anzuzeigenden zus&auml;tzlichen Bilder ein<br />Standard = 3', NULL, '2004-11-20 11:14:04'),
('Artikelliste: Breite der Artikelbilder', 'IMAGE_PRODUCT_LISTING_WIDTH', 43, 'Standard = 100', NULL, '2004-11-20 11:14:04'),
('Artikelliste: H&ouml;he der Artikelbilder', 'IMAGE_PRODUCT_LISTING_HEIGHT', 43, 'Standard = 80', NULL, '2004-11-20 11:14:04'),
('Neue Artikel: Breite der Artikelbilder in der Liste', 'IMAGE_PRODUCT_NEW_LISTING_WIDTH', 43, 'Standard = 100', NULL, '2004-11-20 11:14:04'),
('Neue Artikel: H&ouml;he der Artikelbilder in der Liste', 'IMAGE_PRODUCT_NEW_LISTING_HEIGHT', 43, 'Standard = 80', NULL, '2004-11-20 11:14:04'),
('Neue Artikel: Breite der Artikelbilder', 'IMAGE_PRODUCT_NEW_WIDTH', 43, 'Standard = 100', NULL, '2004-11-20 11:14:04'),
('Neue Artikel: H&ouml;he der Artikelbilder', 'IMAGE_PRODUCT_NEW_HEIGHT', 43, 'Standard = 80', NULL, '2004-11-20 11:14:04'),
('�hnliche Artikel: Breite der Artikelbilder in der Liste', 'IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH', 43, 'Standard = 100', NULL, '2004-11-20 11:14:04'),
('�hnliche Artikel: H&ouml;he der Artikelbilder in der Liste', 'IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT', 43, 'Standard = 80', NULL, '2004-11-20 11:14:04'),
('Alle Artikel: Breite der Artikelbilder in der Liste', 'IMAGE_PRODUCT_ALL_LISTING_WIDTH', 43, 'Standard = 100', NULL, '2004-11-20 11:14:04'),
('Alle Artikel: H&ouml;he der Artikelbilder in der Liste', 'IMAGE_PRODUCT_ALL_LISTING_HEIGHT', 43, 'Standard = 80', NULL, '2004-11-20 11:14:04'),
('Artikelbild: Status automatisch auf "kein Bild"', 'PRODUCTS_IMAGE_NO_IMAGE_STATUS', 43, 'Soll der Status bei Artikelbildern automatisch auf "kein Bild vorhanden" gesetzt werden, wenn kein Bild dem Artikel hinzugef&uuml;gt wurde? <br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('Wenn kein Bild: verwendetes Bild', 'PRODUCTS_IMAGE_NO_IMAGE', 43, 'Welches Bild soll als Eratzbild verwendet werden, wenn kein Bild dem Artikel hinzugef&uuml;gt wurde?<br />Standard = no_picture.gif', NULL, '2004-11-20 11:14:04'),
('Begr&uuml;&szlig;ungsnachricht', 'ACCOUNT_GENDER', 43, 'Zeigt eine Begr&uuml;&szlig;ungsnachricht bei der Kontoerstellung und in den Kontodetails', NULL, '2004-11-20 11:14:04'),
('Geburtsdatum', 'ACCOUNT_DOB', 43, 'Soll das Feld "Geburtsdatum" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Firma', 'ACCOUNT_COMPANY', 43, 'Soll das Feld "Firma" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Adresszeile 2', 'ACCOUNT_SUBURB', 43, 'Soll das Feld "Adresszeile 2" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Land', 'ACCOUNT_STATE', 43, 'Soll das Feld "Land" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Kontoerstellung: Standard - Land', 'SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY', 43, 'Dieses Land als Standard in der Kontoerstellung anzeigen:<br />', NULL, '2004-11-20 11:14:04'),
('Checkbox f&uuml;r Newsletter anzeigen', 'ACCOUNT_NEWSLETTER_STATUS', 43, 'Soll die Checkbox f&uuml;r Newsletter angezeigt werden?<br />0= nein<br />1= unmarkiert anzeigen<br />2= markiert anzeigen<br /><strong>Hinweis: In einigen L&auml;ndern steht die Standardanzeige auf "markiert" im Konflikt mit den gesetzlichen Bestimmungen</strong>', NULL, '2004-11-20 11:14:04'),
('Artikelbenachrichtigung nach Bestellung abfragen', 'CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS', 43, 'Sollen Kunden nach ihrer Bestellung &uuml;ber Artikelbenachrichtigungen gefragt werden?<br />0= nie nachfragen<br />1= Immer nachfragen, au&szlig;er wenn die Abfrage Global gesetzt wurde<br /><br />Hinweis: Die Sideboxen m&uuml;ssen separat ausgeschalten werden', NULL, '2004-11-20 11:14:04'),
('Kunden Shopstatus - Ansicht Shop und Preise', 'CUSTOMERS_APPROVAL', 43, 'Ben&ouml;tigen Kunden eine Berechtigung f&uuml;r den Einkauf?<br />0= Nein - der Shop ist f&uuml;r alle zug&auml;nglich<br />1= Kunden m&uuml;ssen zum Browsen angemeldet sein<br />2= Kunden k&ouml;nnen browsen, sehen Preise aber erst nachdem sie sich angemeldet haben<br />3= Nur Schauraum<br /><br />Die Option "2" l&auml;sst Spider zu', NULL, '2004-11-20 11:14:04'),
('Kunden Autorisierungsstatus - auf Berechtigung warten', 'CUSTOMERS_APPROVAL_AUTHORIZATION', 43, 'Ben&ouml;tigen Kunden eine Berechtigung f&uuml;r den Shop?<br />0= Nicht ben&ouml;tigt<br />1= Kunden m&uuml;ssen zum Browsen berechtigt sein<br />2= Kunden k&ouml;nnen browsen, sehen Preise erst nach Erteilung einer Berechtigung<br /><br />Die Option "2" l&auml;sst Spider zu', NULL, '2004-11-20 11:14:04'),
('Kunden Autorisierung: Dateiname', 'CUSTOMERS_AUTHORIZATION_FILENAME', 43, 'Der Dateinamen der Kunden Autorisierung<br />Hinweis: Angabe bitte OHNE Dateierweiterung<br />Standard=customers_authorization', NULL, '2004-11-20 11:14:04'),
('Kunden Autorisierung: �berschrift verstecken', 'CUSTOMERS_AUTHORIZATION_HEADER_OFF', 43, 'Kunden Autorisierung: �berschrift verstecken <br />(true= verstecken<br />false= anzeigen)', NULL, '2004-11-20 11:14:04'),
('Kunden Autorisierung: linke Spalte verstecken', 'CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF', 43, 'Kunden Autorisierung: linke Spalte verstecken <br />(true= verstecken<br />false= anzeigen)', NULL, '2004-11-20 11:14:04'),
('Kunden Autorisierung: rechte Spalte verstecken', 'CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF', 43, 'Kunden Autorisierung: rechte Spalte verstecken <br />(true= verstecken<br />false= anzeigen)', NULL, '2004-11-20 11:14:04'),
('Kunden Autorisierung: Fu&szlig;zeile verstecken', 'CUSTOMERS_AUTHORIZATION_FOOTER_OFF', 43, 'Kunden Autorisierung: Fu&szlig;zeile verstecken<br />(true= verstecken<br />false= anzeigen)', NULL, '2004-11-20 11:14:04'),
('Kunden Autorisierung: Preise verstecken', 'CUSTOMERS_AUTHORIZATION_PRICES_OFF', 43, 'Kunden Autorisierung: Preise verstecken <br />(true= verstecken<br />false= anzeigen)', NULL, '2004-11-20 11:14:04'),
('Kunden Referer Status', 'CUSTOMERS_REFERRAL_STATUS', 43, 'Kunden Referer - Status<br /><br />0= AUS - Kundenempfehlung deaktiviert<br />1= Durch die erste Verwendung eines Geschenkgutscheines<br />2= Kunde kann w&auml;hrend der Erstellung des Kundenkontos die Empfehlung eintragen, falls diese leer ist<br /><br />HINWEIS: Wurde die Kundenempfehlung einmal erstellt, kann diese nur noch im Adminbereich ge&auml;ndert werden', NULL, '2004-11-20 11:14:04'),
('Installierte Zahlungsmodule', 'MODULE_PAYMENT_INSTALLED', 43, 'Eine Liste der installierten Zahlungsmodule, durch Semicolon getrennt. Die Liste wird automatisch aktualisiert und muss nicht editiert werden. (Beispiel: cc.php;cod.php;paypal.php)', NULL, '2004-11-20 11:14:04'),
('Installierte Bestellmodule', 'MODULE_ORDER_TOTAL_INSTALLED', 43, 'Eine Liste der installierten Bestellmodule, durch Semicolon getrennt. Die Liste wird automatisch aktualisiert und muss nicht editiert werden. (Beispiel: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', NULL, '2004-11-20 11:14:04'),
('Installierte Versandmodule', 'MODULE_SHIPPING_INSTALLED', 43, 'Eine Liste der installierten Versandmodule, durch Semicolon getrennt. Die Liste wird automatisch aktualisiert und muss nicht editiert werden. (Beispiel: ups.php;flat.php;item.php)', NULL, '2004-11-20 11:14:04'),
('"Zahlung per Nachnahme" aktivieren', 'MODULE_PAYMENT_COD_STATUS', 43, 'Wollen Sie "Zahlung per Nachnahme" aktivieren?', NULL, '2004-11-20 11:14:04'),
('Zahlungszone:', 'MODULE_PAYMENT_COD_ZONE', 43, 'Wenn eine Zone ausgew&auml;hlt wird, ist diese Zahlungsmethode nur f&uuml;r diese Zone aktiviert.', NULL, '2004-11-20 11:14:04'),
('Reihenfolge der Anzeige:', 'MODULE_PAYMENT_COD_SORT_ORDER', 43, 'Legt die Reihenfolge der Anzeige fest (Der kleinste Wert wird als erstes gezeigt)', NULL, '2004-11-20 11:14:04'),
('Bestellstatus:', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', 43, 'Legt den Bestellstatus f&uuml;r diese Zahlungsart fest', NULL, '2004-11-20 11:14:04'),
('"Zahlung per Kreditkarte" aktivieren', 'MODULE_PAYMENT_CC_STATUS', 43, 'Wollen Sie "Zahlung per Kreditkarte" aktivieren?', NULL, '2004-11-20 11:14:04'),
('Kreditkarten e-Mailversand teilen', 'MODULE_PAYMENT_CC_EMAIL', 43, 'Wenn hier eine e-Mail Adresse eingetragen wird, werden die mittleren Nummern der verwendeten Kreditkarte zu dieser e-Mail Adresse gesendet. (Die &auml;u&szlig;eren Nummern werden mit zensierten mittleren Nummern in der Datenbank gespeichert)', NULL, '2004-11-20 11:14:04'),
('Sammeln und Speichern von CVV Nummern', 'MODULE_PAYMENT_CC_COLLECT_CVV', 43, 'Sollen die CVV Nummern gespeichert werden?<br />Hinweis: Die Nummern werden in der Datenbank enkodiert gespeichert)', NULL, '2004-01-11 22:55:51'),
('Speichern von Kreditkartennummern', 'MODULE_PAYMENT_CC_STORE_NUMBER', 43, 'Wollen Sie Kreditkartennummern in der Datenbank speichern?<br />Hinweis: Die Nummern werden in der Datenbank unverschl&uuml;sselt gespeichert und k&ouml;nnen ein Sicherheitsrisiko darstellen!', NULL, '2004-11-20 11:14:04'),
('Reihenfolge der Anzeige:', 'MODULE_PAYMENT_CC_SORT_ORDER', 43, 'Legt die Reihenfolge der Anzeige fest (Der kleinste Wert wird als erstes gezeigt).', NULL, '2004-11-20 11:14:04'),
('Zahlungszone:', 'MODULE_PAYMENT_CC_ZONE', 43, 'Wenn eine Zone ausgew&auml;hlt wird, ist diese Zahlungsmethode nur f&uuml;r diese Zone aktiviert.', NULL, '2004-11-20 11:14:04'),
('Bestellstatus:', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', 43, 'Legt den Bestellstatus f&uuml;r diese Zahlungsart fest.', NULL, '2004-11-20 11:14:04'),
('Einheitliche Versandkosten aktivieren', 'MODULE_SHIPPING_FLAT_STATUS', 43, 'Wollen Sie "Einheitliche Versandkosten" aktivieren?', NULL, '2004-11-20 11:14:04'),
('Einheitliche Versandkosten', 'MODULE_SHIPPING_FLAT_COST', 43, 'Die Versandkosten f&uuml;r alle Bestellungen, die mit dieser Versandmethode get&auml;tigt werden.', NULL, '2004-11-20 11:14:04'),
('Steuerklasse', 'MODULE_SHIPPING_FLAT_TAX_CLASS', 43, 'Folgende Steuerklasse f&uuml;r diese Versandmethode verwenden:', NULL, '2004-11-20 11:14:04'),
('Basis der Steuern', 'MODULE_SHIPPING_FLAT_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern berechnet werden? M&ouml;gliche Optionen:<br />Versand (Shipping) - auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - auf Basis der Shopadresse, wenn die Rechnungs-/Versandadresse des Kunden innerhalb der Zone der Shopadresse liegt', NULL, '2004-11-20 11:14:04'),
('Versandzone', 'MODULE_SHIPPING_FLAT_ZONE', 43, 'Wenn eine Zone ausgew&auml;hlt wird, ist diese Versandmethode nur f&uuml;r diese Zone aktiviert.', NULL, '2004-11-20 11:14:04'),
('Reihenfolge der Anzeige:', 'MODULE_SHIPPING_FLAT_SORT_ORDER', 43, 'Legt die Reihenfolge der Anzeige fest (Der kleinste Wert wird als erstes gezeigt)', NULL, '2004-11-20 11:14:04'),
('Standardw&auml;hrung', 'DEFAULT_CURRENCY', 43, 'Standardw&auml;hrung', NULL, '2004-11-20 11:14:04'),
('Standardsprache', 'DEFAULT_LANGUAGE', 43, 'Standardsprache', NULL, '2004-11-20 11:14:04'),
('Bestellstatus f&uuml;r neue Bestellungen', 'DEFAULT_ORDERS_STATUS_ID', 43, 'Wenn eine neue Bestellungen get&auml;tigt wird, ist dies der Status dem sie zugewiesen wird.', NULL, '2004-11-20 11:14:04'),
('Admin configuration_key anzeigen', 'ADMIN_CONFIGURATION_KEY_ON', 43, 'Manuell auf Wert 1 wechseln um den configuration_key Namen in der Konfiguration anzuzeigen', NULL, '2004-11-20 11:14:04'),
('Ursprungsland', 'SHIPPING_ORIGIN_COUNTRY', 43, 'W&auml;hlen Sie das Land, von dem aus die Versandkosten berechnet werden sollen.', NULL, '2004-11-20 11:14:04'),
('Postleitzahl', 'SHIPPING_ORIGIN_ZIP', 43, 'Geben Sie die Postleitzahl an, von dem aus die Versandkosten berechnet werden sollen.', NULL, '2004-11-20 11:14:04'),
('Maximales Versandgewicht', 'SHIPPING_MAX_WEIGHT', 43, 'Paketdienste haben im Allgemeinen eine Grenze f&uuml;r das Maximagewicht eines Paketes.<br />Tragen Sie dieses Gewicht stellvertretend f&uuml;r alle ein.', NULL, '2004-11-20 11:14:04'),
('Kleine bis mittlere Pakete: prozentuelle Gewichtszunahme', 'SHIPPING_BOX_WEIGHT', 43, 'Wie hoch ist die Gewichtszunahme bei einem typischen kleineren Paketes bis mittleren Paket?<br />Beispiel: 10% + 1kg 10:1<br />10% + 0kg 10:0<br />0% + 5kg 0:5<br />0% + 0kg 0:0', NULL, '2004-11-20 11:14:04'),
('Gr&ouml;&szlig;ere Pakete: prozentuelle Gewichtszunahme', 'SHIPPING_BOX_PADDING', 43, 'Wie hoch ist die Zunahme des Gewichtes bei einem typischen gr&ouml;&szlig;eren Paket?<br />Beispiel: 10% + 1kg 10:1<br />10% + 0kg 10:0<br />0% + 5kg 0:5<br />0% + 0kg 0:0', NULL, '2004-11-20 11:14:04'),
('Anzahl der Pakete und das Gewicht anzeigen', 'SHIPPING_BOX_WEIGHT_DISPLAY', 43, 'Soll die Anzahl der Pakete und das Gewicht angezeigt werden?<br /><br />0= nein<br />1= nur Anzahl der Pakete<br />2= nur das Gewicht<br />3= Anzahl der Pakete und das Gewicht', NULL, '2004-11-20 11:14:04'),
('Einstellungen f&uuml;r Versandberechnung im Warenkorb anzeigen', 'SHOW_SHIPPING_ESTIMATOR_BUTTON', 43, '<br />0= AUS<br />1= Als Button im Warenkorb zeigen', NULL, '2004-11-20 11:14:04'),
('Versandkostenfreier Versand wenn das Gesamtgewicht "0" ist', 'ORDER_WEIGHT_ZERO_STATUS', 43, 'Wenn in einer Bestellung das Gesamtgewicht "0" ist, soll die Bestellung als "versandkostenfrei" versendet werden?<br />0= nein<br />1= ja<br />Hinweis: Wenn diese Option aktiviert ist, wird "versandkostenfrei" nur bei Artikel mit "0" Gewicht angezeigt.', NULL, '2004-11-20 11:14:04'),
('Artikelbilder anzeigen', 'PRODUCT_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder im Shop anzeigen?', NULL, '2004-11-20 11:14:04'),
('Artikelhersteller anzeigen', 'PRODUCT_LIST_MANUFACTURER', 43, 'Wollen Sie Artikelhersteller im Shop anzeigen?', NULL, '2004-11-20 11:14:04'),
('Artikelnummer anzeigen', 'PRODUCT_LIST_MODEL', 43, 'Wollen Sie Artikelnummern im Shop anzeigen?', NULL, '2004-11-20 11:14:04'),
('Artikelnamen anzeigen', 'PRODUCT_LIST_NAME', 43, 'Wollen Sie Artikelnamen im Shop anzeigen?', NULL, '2004-11-20 11:14:04'),
('Anzeigen von: Preis/In den Warenkorb', 'PRODUCT_LIST_PRICE', 43, 'Wollen Sie "Preis/In den Warenkorb" im Shop anzeigen?', NULL, '2004-11-20 11:14:04'),
('Artikelst&uuml;ckzahl anzeigen', 'PRODUCT_LIST_QUANTITY', 43, 'Wollen Sie die Artikelst&uuml;ckzahl im Shop anzeigen?', NULL, '2004-11-20 11:14:04'),
('Artikelgewicht anzeigen', 'PRODUCT_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht im Shop anzeigen?', NULL, '2004-11-20 11:14:04'),
('Preis/In den Warenkorb: Spaltenbreite', 'PRODUCTS_LIST_PRICE_WIDTH', 43, 'Definiert die Spaltenbreite von "Preis/In den Warenkorb"<br />Standard= 125', NULL, '2004-11-20 11:14:04'),
('Kategorien-/Herstellerfilter anzeigen (0=nein; 1=ja)', 'PRODUCT_LIST_FILTER', 43, 'Wollen Sie den Filter f&uuml;r Kategorien-/Hersteller im Shop anzeigen?', NULL, '2004-11-20 11:14:04'),
('"Vorheriger/N&auml;chster" Navigation: Ansicht', 'PREV_NEXT_BAR_LOCATION', 43, 'Wo soll die "Vorheriger / N&auml;chster" Navigation angezeigt werden?<br />(1= oben, 2= unten, 3= oben und unten)', NULL, '2004-11-20 11:14:04'),
('Artikelliste - Standardsortierung', 'PRODUCT_LISTING_DEFAULT_SORT_ORDER', 43, 'Standard Sortierreihenfolge f&uuml;r Artikellisten<br />HINWEIS: F&uuml;r eine Sortierung nach Artikel bitte leer lassen.<br />Sortiert die Artikelliste in der gew&uuml;nschten Reihenfolge mit der Sie beginnen m&ouml;chten. Beispiel: 2a', NULL, '2004-11-20 11:14:04'),
('Button "In den Warenkorb" anzeigen (0=nein; 1=ja)', 'PRODUCT_LIST_PRICE_BUY_NOW', 43, 'Wollen Sie den Button "In den Warenkorb" anzeigen?', NULL, '2004-11-20 11:14:04'),
('Lagerbestand pr&uuml;fen', 'STOCK_CHECK', 43, '�berpr&uuml;fen, ob der bestellte Artikel auch lagernd ist', NULL, '2004-11-20 11:14:04'),
('Bestellungen vom Lagerbestand abziehen', 'STOCK_LIMITED', 43, 'Sollen bestellte Artikel vom Lagerbestand abgezogen werden?', NULL, '2004-11-20 11:14:04'),
('Bestellung erlauben, wenn Lagerbestand unterschritten wird', 'STOCK_ALLOW_CHECKOUT', 43, 'Soll Kunden bei Unterschreitung des Lagerbestandes eine Bestellung erm&ouml;glicht werden?', NULL, '2004-11-20 11:14:04'),
('Platzhalter f&uuml;r nicht lagernde Artikel', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', 43, 'Soll bei nicht lagernden Artikel ein Platzhalter im Shop angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Lagermindestbestand f&uuml;r Nachbestellungen', 'STOCK_REORDER_LEVEL', 43, 'Legen Sie hier fest, ab welcher Lagermenge ein Artikel nachbestellt werden muss', NULL, '2004-11-20 11:14:04'),
('Artikel im Shop anzeigen, wenn nicht lagernd', 'SHOW_PRODUCTS_SOLD_OUT', 43, 'Sollen Artikel im Shop angezeigt werden, wenn sie nicht lagernd sind<br /><br />0= Nein - Artikelstatus auf AUS<br />1= Ja, Artikelstatus auf EIN', NULL, '2004-11-20 11:14:04'),
('Artikel ist ausverkauft: Bild "Ausverkauft" anstelle von "in den Warenkorb" anzeigen', 'SHOW_PRODUCTS_SOLD_OUT_IMAGE', 43, 'Zeige f&uuml;r ausverkaufte Artikel das Bild "Ausverkauft" anstelle von "in den Warenkorb"<br /><br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('Dezimalstellen der Artikelst&uuml;ckzahlen', 'QUANTITY_DECIMALS', 43, 'Wieviele Dezimalstellen sollen in der Artikelst&uuml;ckzahl angezeigt werden?<br /><br />0= keine', NULL, '2004-11-20 11:14:04'),
('Speichern der Zeit f&uuml;r Seitenaufbau', 'STORE_PAGE_PARSE_TIME', 43, 'Sollen die Zeiten f&uuml;r den Seitenaufbau einer Seite gespeichert werden?', NULL, '2004-11-20 11:14:04'),
('Warenkorb anzeigen - Checkboxen und/oder Buttons zum l&ouml;schen anzeigen', 'SHOW_SHOPPING_CART_DELETE', 43, 'Zeigt im Warenkorb Buttons und/oder Checkboxen zum L&ouml;schen von Artikel an<br /><br />1= Nur Buttons<br />2= Nur Checkboxen<br />3= Buttons und Checkboxen', NULL, '2004-11-20 11:14:04'),
('Protokolldatei f&uuml;r Seitenaufbau: Speicherort', 'STORE_PAGE_PARSE_TIME_LOG', 43, 'Verzeichnis und Dateiname der Protokolldatei f&uuml;r Seitenaufbau', NULL, '2004-11-20 11:14:04'),
('Protokolldatei f&uuml;r Seitenaufbau: Datumsformat', 'STORE_PARSE_DATE_TIME_FORMAT', 43, 'Datumsformat f&uuml;r die Protokolldatei', NULL, '2004-11-20 11:14:04'),
('Zeit f&uuml;r Seitenaufbau im Shop anzeigen', 'DISPLAY_PAGE_PARSE_TIME', 43, 'Soll die Zeit f&uuml;r den Seitenaufbau im Shop unten angezeigt werden?<br />Hinweis: Es ist nicht notwendig, die Protokolldatei f&uuml;r Seitenaufbau zu speichern, um sie im Shop anzeigen zu lassen.', NULL, '2004-11-20 11:14:04'),
('Datenbankabfragen in Protokolldatei speichern', 'STORE_DB_TRANSACTIONS', 43, 'Sollen Datenbankabfragen in der Protokolldatei f&uuml;r Seitenabfragen gespeichert werden?<br />Hinweis: Nur ab PHP 4 m&ouml;glich', NULL, '2004-11-20 11:14:04'),
('e-Mail Transportmethode', 'EMAIL_TRANSPORT', 43, 'Legt fest, ob dieser Server eine lokale Verbindung zu \'sendmail\' oder einen SMTP - Server &uuml;ber TCP/IP Verbindung verwendet.<br />Hinweis: F&uuml;r Server, die unter Windows oder MacOS betrieben werden, sollten Sie die Einstellung \'SMTP\' verwenden.', NULL, '2004-11-20 11:14:04'),
('e-Mail Zeilenvorschub', 'EMAIL_LINEFEED', 43, 'Legen Sie hier die Zeichen fest, die Sie zur Trennung des e-Mail Headers verwenden wollen.', NULL, '2004-11-20 11:14:04'),
('e-Mail als MIME HTML versenden', 'EMAIL_USE_HTML', 43, 'Wollen Sie e-Mails im HTML Format versenden?', NULL, '2004-11-20 11:14:04'),
('e-Mails durch DNS-Server verifizieren', 'ENTRY_EMAIL_ADDRESS_CHECK', 43, 'Soll die G&uuml;ltigkeit von e-Mails durch DNS-Server verifiziert werden?', NULL, '2004-11-20 11:14:04'),
('e-Mails senden', 'SEND_EMAILS', 43, 'e-Mails senden', NULL, '2004-11-20 11:14:04'),
('e-Mail Archivierung aktiviert', 'EMAIL_ARCHIVE', 43, 'Wenn Sie e-Mail, die versendet werden, archivieren wollen, setzen Sie desen Wert auf "true".', NULL, '2004-11-20 11:14:04'),
('e-Mail Adresse (Kontaktadresse)', 'STORE_OWNER_EMAIL_ADDRESS', 43, 'Die e-Mail Adresse des Shopbetreibers/ der Kontaktperson.', NULL, '2004-11-20 11:14:04'),
('e-Mail Absender', 'EMAIL_FROM', 43, 'Die Absenderadresse, mit der e-Mails versendet werden sollen.', NULL, '2004-11-20 11:14:04'),
('Zus&auml;tzliches e-Mail an Admin: Format', 'ADMIN_EXTRA_EMAIL_FORMAT', 43, 'W&auml;hlen Sie das Format f&uuml;r e-Mails, die zus&auml;tzlich an den Administrator versendet werden', NULL, '0001-01-01 00:00:00'),
('e-Mail Kopie bei Bestellungen versenden', 'SEND_EXTRA_ORDER_EMAILS_TO', 43, 'Versendet zus&auml;tzlich ein e-Mail bei Bestellungen an die unten angegebene(n) Adresse(n).<br />Die Adressen m&uuml;ssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', NULL, '2004-11-20 11:14:04'),
('"Neues Konto erstellt": Benachrichtigung versenden', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS', 43, 'Benachrichtigung versenden, wenn ein neues Konto erstellt wurde?<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('"Neues Konto erstellt": Kopie an diese e-Mail Adresse(n) versenden', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO', 43, 'Eine Kopie an diese e-Mail Adresse(n) versenden, wenn ein neues Konto erstellt wurde?<br />Die Adressen m&uuml;ssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', NULL, '2004-11-20 11:14:04'),
('"An einen Freund senden": Benachrichtigung senden', 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS', 43, '"An einen Freund senden": Benachrichtigung senden<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('"An einen Freund senden": Kopie an diese e-Mail Adresse(n) versenden', 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO', 43, 'Eine Kopie bei "An einen Freund senden" an diese e-Mail Adresse(n) versenden.<br />Die Adressen m&uuml;ssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', NULL, '2004-11-20 11:14:04'),
('"Gutschein versendet": Benachrichtigung versenden', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_STATUS', 43, '"Gutschein versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('"Gutschein versendet": Kopie an diese e-Mail Adresse(n) versenden', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO', 43, 'Eine Kopie bei "Gutschein versendet" an diese e-Mail Adresse(n) versenden.<br />Die Adressen m&uuml;ssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', NULL, '2004-11-20 11:14:04'),
('"Admin Gutschein versendet": Benachrichtigung versenden', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO_STATUS', 43, '"Admin Gutschein versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('"Admin Gutschein versendet": Kopie an diese e-Mail Adresse(n) versenden', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO', 43, 'Eine Kopie bei "Admin Gutschein versendet" an diese e-Mail Adresse(n) versenden.<br />Die Adressen m&uuml;ssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', NULL, '2004-11-20 11:14:04'),
('"Admin Kupon versendet": Benachrichtigung versenden', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_STATUS', 43, '"Admin Kupon versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('"Admin Kupon versendet": Kopie an diese e-Mail Adresse(n) versenden', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO', 43, 'Eine Kopie bei "Admin Kupon versendet" an diese e-Mail Adresse(n) versenden.<br />Die Adressen m&uuml;ssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', NULL, '2004-11-20 11:14:04'),
('"Admin Bestellung": Benachrichtigung versenden', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS', 43, '"Admin Bestellung versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('"Admin Bestellung": Kopie an diese e-Mail Adresse(n) versenden', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO', 43, 'Eine Kopie bei "Admin Bestellung versendet" an diese e-Mail Adresse(n) versenden.<br />Die Adressen m&uuml;ssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', NULL, '2004-11-20 11:14:04'),
('e-Mail Adressen f&uuml;r die "Schreiben Sie uns" Dropdown Liste', 'CONTACT_US_LIST', 43, 'Geben Sie hier die f&uuml;r die "Schreiben Sie uns" e-Mail Dropdown Liste gew&uuml;nschte(n) e-Mail Adresse(n) ein.<br />Die Adressen m&uuml;ssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', NULL, '2004-11-20 11:14:04'),
('G&auml;ste d&uuml;rfen "An einen Freund senden"', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 43, 'G&auml;ste d&uuml;rfen "An einen Freund senden"', NULL, '2004-11-20 11:14:04'),
('"Schreiben Sie uns": Shopname und Adresse anzeigen', 'CONTACT_US_STORE_NAME_ADDRESS', 43, 'Shopname und Adresse im Formular "Schreiben Sie uns" anzeigen<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('"Lagermindestbestand unterschritten": Benachrichtigung versenden', 'SEND_LOWSTOCK_EMAIL', 43, 'Eine Benachrichtigung versenden, wenn der Lagermindestbestand erreicht oder unterschritten wurde?<br />0= nein<br />1= ja', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('"Lagermindestbestand unterschritten": an diese e-Mail Adresse(n) versenden', 'SEND_EXTRA_LOW_STOCK_EMAILS_TO', 43, 'Wenn der Lagermindestbestand erreicht oder unterschritten wurde, soll an diese e-Mail Adresse(n) eine Benachrichtigung versendet werden.<br />Die Adressen m&uuml;ssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', NULL, '2004-11-20 11:14:04'),
('Link "Newsletter abbestellen" anzeigen?', 'SHOW_NEWSLETTER_UNSUBSCRIBE_LINK', 43, 'Soll in der Info Box ein Link f�r "Newsletter abbestellen" angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('Empf&auml;ngerliste -  Z&auml;hleranzeige', 'AUDIENCE_SELECT_DISPLAY_COUNTS', 43, 'Wenn die Liste der verf&uuml;gbaren Empf&auml;nger angezeigt wird, soll der Empf&auml;ngerz&auml;hler inkludiert werden? <br /><em>(Hinweis: Es k&ouml;nnen Geschwindigkeitseinbu&szlig;en auftreten, wenn Sie viele Kunden oder koplexe Empf&auml;ngerabfragen haben)</em>', NULL, '2004-11-20 11:14:04'),
('Neuregistrierung: Kupon ID#', 'NEW_SIGNUP_DISCOUNT_COUPON', 43, 'W&auml;hlen Sie einen Kupon<br />(none= keine Kupons bei Neuregistrierungen senden)', NULL, '2004-11-20 11:14:04'),
('Neuregistrierung: Erm&auml;&szlig;igungsbetrag', 'NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', 43, 'Bitte leer lassen, falls Sie keine Kupons an Neukunden versenden wollen,<br />oder geben Sie den Betrag an (z.B. 10 f&uuml;r &euro;10.00)', NULL, '2004-11-20 11:14:04'),
('Downloads aktivieren', 'DOWNLOAD_ENABLED', 43, 'Wollen Sie Download-Artikel aktivieren?.', NULL, '2004-11-20 11:14:04'),
('Downloads &uuml;ber Weiterleitung', 'DOWNLOAD_BY_REDIRECT', 43, 'Wollen Sie Browser- Weiterleitung f&uuml;r Download-Artikel aktivieren? (Ist auf nicht- UNIX Systemen deaktiviert).<br /><br />Hinweis: Setzten Sie /pub auf CHMOD 777 bei aktivierter Weiterleitung', NULL, '2004-11-20 11:14:04'),
('Ablaufdatum f&uuml;r Downloads (Anzahl in Tagen)', 'DOWNLOAD_MAX_DAYS', 43, 'Geben Sie hier die Anzahl der Tagen ein, f&uuml;r wie lange ein Download-Artikel g&uuml;ltig sein soll. (0= Unlimitiert)', NULL, '2004-11-20 11:14:04'),
('Anzahl erlaubter Downloads - pro Artikel', 'DOWNLOAD_MAX_COUNT', 43, 'Geben Sie hier die maximale Anzahl der erlaubten Downloads pro Artikel ein. (0= Download nicht erlaubt)', NULL, '2004-11-20 11:14:04'),
('Downloadmanager: Wert f&uuml;r Aktualisierungsstatus', 'DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE', 43, 'Welcher Bestellstatus soll die Tage der G&uuml;ltigkeitsdauer und die maximal erlaubte Downloadanzahl f&uuml;r Download-Artikel zur&uuml;cksetzen? (Standard = 4)', '2004-11-20 11:14:04', '0000-00-00 00:00:00'),
('Downloadmanager: Wert f&uuml;r Bestellstatus', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS', 43, 'Welcher Bestellstatus soll dem Downloadmanager zugewiesen werden? (Standard = 2)', '2004-11-20 11:14:04', '0000-00-00 00:00:00'),
('Preis durch Attribute', 'ATTRIBUTES_ENABLED_PRICE_FACTOR', 43, 'Preise durch Attribute aktivieren?', NULL, '2004-11-20 11:14:04'),
('Mengenrabatt aktivieren', 'ATTRIBUTES_ENABLED_QTY_PRICES', 43, 'Mengenrabatte erm&ouml;glichen?.', NULL, '2004-11-20 11:14:04'),
('Attributbilder', 'ATTRIBUTES_ENABLED_IMAGES', 43, 'Attributbilder aktivieren?', NULL, '2004-11-20 11:14:04'),
('Textpreise aktivieren (Wort oder Buchstabe)', 'ATTRIBUTES_ENABLED_TEXT_PRICES', 43, 'Soll das Attribut "Textpreis nach Wort oder Buchstabe" aktiviert werden?', NULL, '2004-11-20 11:14:04'),
('Textpreise: Leerzeichen sind kostenlos', 'TEXT_SPACES_FREE', 43, 'Sind bei Textpreisen die Leerzeichen kostenlos?<br /><br />0= nein 1= ja', NULL, '2004-11-20 11:14:04'),
('GZip Komprimierung aktivieren', 'GZIP_LEVEL', 43, '0= nein 1= ja', NULL, '2004-11-20 11:14:04'),
('Verzeichnis f&uuml;r Sitzungen', 'SESSION_WRITE_DIRECTORY', 43, 'Wenn das Speichern von Sitzungen Datei- basierend ist, werden sie in dieses Verzeichnis gespeichert.', NULL, '2004-11-20 11:14:04'),
('Cookies - Dom&auml;nenname', 'SESSION_USE_FQDN', 43, 'Wenn f&uuml;r den Shop Cookies verwendet werden, ben&ouml;tigen Sie einen Dom&auml;nennamen (z.B. www.meinedomain.at). Wenn nicht, wird nur ein teilweiser Dom&auml;nenname ben&ouml;tigt (z.B. meinedomain.at) Wenn Sie sich nicht sicher sind, lassen Sie diese Option auf "true".', NULL, '2004-11-20 11:14:04'),
('Cookies - Verwendung erzwingen', 'SESSION_FORCE_COOKIE_USE', 43, 'Die Verwendung von Cookies erzwingen.<br />Hinweis: Wenn ein Kunde in den Browsereinstellungen die Verwendung von Cookies deaktiviert hat, kann dieser den Shop nicht verwenden..', NULL, '2004-11-20 11:14:04'),
('�berpr&uuml;fung der SSL Sitzungs- ID', 'SESSION_CHECK_SSL_SESSION_ID', 43, '�berpr&uuml;ft die Sitzungs- ID bei jeder gesicherten HTTPS Seitenanfrage.', NULL, '2004-11-20 11:14:04'),
('Browser des Kunden pr&uuml;fen', 'SESSION_CHECK_USER_AGENT', 43, '�berpr&uuml;ft den Browser des Kunden bei jeder Seitenanfrage.', NULL, '2004-11-20 11:14:04'),
('IP Adresse &uuml;berpr&uuml;fen', 'SESSION_CHECK_IP_ADDRESS', 43, '�berpr&uuml;ft die IP Adresse des Benutzers bei jeder Seitenanfrage.', NULL, '2004-11-20 11:14:04'),
('Spider Sitzungen verhindern', 'SESSION_BLOCK_SPIDERS', 43, 'Verhindert das Starten von Sitzungen bei bekannten Spidern.', NULL, '2004-11-20 11:14:04'),
('Sitzungen wiederherstellen', 'SESSION_RECREATE', 43, 'Sollen Sitzungen wiederhergestellt werden, um eine neue Sitzungs- ID zu erstellen, wenn ein Kunde sich anmeldet oder ein neues Konto erstellt? (ben&ouml;tigt PHP >=4.1).', NULL, '2004-11-20 11:14:04'),
('L&auml;nge der Gutscheinnummer', 'SECURITY_CODE_LENGTH', 43, 'Tragen Sie hier die L&auml;nge der Gutscheinnummer ein<br />Tipp: Je l&auml;nger um so sicherer.', NULL, '2004-11-20 11:14:04'),
('Kreditkarte akzeptieren: VISA', 'CC_ENABLED_VISA', 43, 'Wollen Sie Zahlungen mit VISA Kreditkarten akzeptieren (0= nein 1= ja)', NULL, '2004-11-20 11:14:04'),
('Kreditkarte akzeptieren: MasterCard', 'CC_ENABLED_MC', 43, 'Wollen Sie Zahlungen mit MasterCard Kreditkarten akzeptieren (0= nein 1= ja)', NULL, '2004-11-20 11:14:04'),
('Kreditkarte akzeptieren: AmericanExpress', 'CC_ENABLED_AMEX', 43, 'Wollen Sie Zahlungen mit AmericanExpress Kreditkarten akzeptieren (0= nein 1= ja)', NULL, '2004-11-20 11:14:04'),
('Kreditkarte akzeptieren: Diners Club', 'CC_ENABLED_DINERS_CLUB', 43, 'Wollen Sie Zahlungen mit Diners Club Kreditkarten akzeptieren (0= nein 1= ja)', NULL, '2004-11-20 11:14:04'),
('Kreditkarte akzeptieren: Discover Card', 'CC_ENABLED_DISCOVER', 43, 'Wollen Sie Zahlungen mit Discover Card Kreditkarten akzeptieren (0= nein 1= ja)', NULL, '2004-11-20 11:14:04'),
('Kreditkarte akzeptieren: JCB', 'CC_ENABLED_JCB', 43, 'Wollen Sie Zahlungen mit JCB Kreditkarten akzeptieren (0= nein 1= ja)', NULL, '2004-11-20 11:14:04'),
('Kreditkarte akzeptieren: AUSTRALIAN BANKCARD', 'CC_ENABLED_AUSTRALIAN_BANKCARD', 43, 'Wollen Sie Zahlungen mit AUSTRALIAN BANKCARD Kreditkarten akzeptieren (0= nein 1= ja)', NULL, '2004-11-20 11:14:04'),
('Akzeptierte Kreditkarten in der Seite f&uuml;r Bezahlung anzeigen', 'SHOW_ACCEPTED_CREDIT_CARDS', 43, 'Sollen die akzeptierten Kreditkarten in der Seite f&uuml;r die Bezahlung angezeigt werden?<br />0= nicht anzeigen<br />1= als Text anzeigen<br />2= als Bild anzeigen<br /><br />Hinweis: Die Bilder und Texte m&uuml;ssen sowohl in der Datenbank als auch in den Sprachfiles f&uuml;r die jeweilige Kreditkarte definiert sein.', NULL, '2004-11-20 11:14:04'),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_GV_STATUS', 43, '', NULL, '2003-10-30 22:16:40'),
('Sortierreihenfolge', 'MODULE_ORDER_TOTAL_GV_SORT_ORDER', 43, 'Legt die Sortierreihenfolge fest.', NULL, '2003-10-30 22:16:40'),
('Warteschlange f&uuml;r Gutscheinbestellungen aktivieren', 'MODULE_ORDER_TOTAL_GV_QUEUE', 43, 'Wollen Sie die Warteschlange f&uuml;r Gutscheinbestellungen aktivieren?', NULL, '2003-10-30 22:16:40'),
('Versandkosten im Gutschein inkludieren', 'MODULE_ORDER_TOTAL_GV_INC_SHIPPING', 43, 'Sollen die Versandkosten in die Berechnung inkludiert werden?', NULL, '2003-10-30 22:16:40'),
('Gutscheine inklusive Steuern', 'MODULE_ORDER_TOTAL_GV_INC_TAX', 43, 'Sollen die Steuern in die Berechnung inkludiert werden?', NULL, '2003-10-30 22:16:40'),
('Steuern neu berechnen', 'MODULE_ORDER_TOTAL_GV_CALC_TAX', 43, 'Steuern neu berechnen', NULL, '2003-10-30 22:16:40'),
('Steuerklasse f&uuml;r Gutscheine', 'MODULE_ORDER_TOTAL_GV_TAX_CLASS', 43, 'Folgende Steuerklasse wird bei Gutscheinen und im Kreditguthaben verwendet:', NULL, '2003-10-30 22:16:40'),
('Kreditguthaben inklusive Steuern', 'MODULE_ORDER_TOTAL_GV_CREDIT_TAX', 43, 'Sollen die Steuern bei bestellten Gutscheinen im Kreditguthaben inkludiert werden?', NULL, '2003-10-30 22:16:40'),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 43, '', NULL, '2003-10-30 22:16:43'),
('Sortierreihenfolge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', 43, 'Sortierreihenfolge der Anzeige', NULL, '2003-10-30 22:16:43'),
('Geb&uuml;hr f&uuml;r Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 43, 'Wollen Sie einen Mindestbestellzuschlag aktivieren?', NULL, '2003-10-30 22:16:43'),
('Geb&uuml;hr bei Unterschreitung der Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', 43, 'Wie hoch ist Geb&uuml;hr bei Unterschreitung der Mindestbestellmenge?', NULL, '2003-10-30 22:16:43'),
('Geb&uuml;hr f&uuml;r Mindestbestellmenge - Betrag', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', 43, 'F&uuml;r eine prozentuelle Kalkulation f&uuml;gen Sie ein "%" Zeichen an. Beispiel: 10%<br />F&uuml;r eine pauschale Geb&uuml;hr geben Sie den Betrag an. Beispiel: 5 f&uuml;r &euro;5.00', NULL, '2003-10-30 22:16:43'),
('Geb&uuml;hr f&uuml;r Mindestbestellmenge - nur bestimmte Bestellungen', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 43, 'Geb&uuml;hren f&uuml;r Mindestbestellmengen werden nur f&uuml;r Bestellungen angewendet, die zum hier eingestellten Ziel gesendet werden.', NULL, '2003-10-30 22:16:43'),
('Geb&uuml;hr f&uuml;r Mindestbestellmenge - Steuerklasse', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', 43, 'Folgende Steuerklasse bei Geb&uuml;hren f&uuml;r Mindestbestellmengen verwenden.', NULL, '2003-10-30 22:16:43'),
('Virtuelle Artikel - keine Geb&uuml;hr f&uuml;r Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL', 43, 'Soll bei Bestellungen, die nur virtuellen Artikel beinhalten, keine Geb&uuml;hr f&uuml;r Mindestbestellmenge gerechnet werden?', NULL, '2004-04-20 22:16:43'),
('Geschenkgutscheine - keine Geb&uuml;hr f&uuml;r Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_GV', 43, 'Soll bei Bestellungen, die nur Geschenkgutscheinen beinhalten, keine Geb&uuml;hr f&uuml;r Mindestbestellmenge gerechnet werden?', NULL, '2004-04-20 22:16:43'),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 43, '', NULL, '2003-10-30 22:16:46'),
('Sortierreihenfolge', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', 43, 'Sortierreihenfolge der Anzeige', NULL, '2003-10-30 22:16:46'),
('Versandkostenfreie Lieferung erlauben', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 43, 'Wollen Sie Versandkostenfreie Lieferungen erlauben?', NULL, '2003-10-30 22:16:46'),
('Versandkostenfreie Lieferung &uuml;ber', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', 43, 'Versandkostenfreie Lieferung &uuml;ber dem hier eingegebenen Bestellwert.', NULL, '2003-10-30 22:16:46'),
('Versandkostenfreie Lieferung f&uuml;r diese Bestellung erlauben', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 43, 'Versandkostenfreie Lieferung f&uuml;r Bestellungen erlauben, die zum hier eingestellten Ziel gesendet werden.', NULL, '2003-10-30 22:16:46'),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 43, '', NULL, '2003-10-30 22:16:49'),
('Sortierreihenfolge', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', 43, 'Sortierreihenfolge der Anzeige', NULL, '2003-10-30 22:16:49'),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_TAX_STATUS', 43, '', NULL, '2003-10-30 22:16:52'),
('Sortierreihenfolge', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', 43, 'Sortierreihenfolge der Anzeige', NULL, '2003-10-30 22:16:52'),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 43, '', NULL, '2003-10-30 22:16:55'),
('Sortierreihenfolge', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', 43, 'Sortierreihenfolge der Anzeige', NULL, '2003-10-30 22:16:55'),
('Steuerklasse f&uuml;r das Einl&ouml;sen von Gutscheinen', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', 43, 'Diese Steuerklasse beim einl&ouml;sen von Gutscheinen verwenden', NULL, '2003-10-30 22:16:36'),
('Inklusive Steuern', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 43, 'Steuern in die Berechnung inkludieren', NULL, '2003-10-30 22:16:36'),
('Sortierreihenfolge', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', 43, 'Sortierreihenfolge der Anzeige', NULL, '2003-10-30 22:16:36'),
('Inklusive Versandkosten', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 43, 'Versandkosten in die Berechnung inkludieren', NULL, '2003-10-30 22:16:36'),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 43, '', NULL, '2003-10-30 22:16:36'),
('Steuern neu berechnen', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 43, 'Steuern neu berechnen', NULL, '2003-10-30 22:16:36'),
('Admin Demostatus', 'ADMIN_DEMO', 43, 'Soll die Admin Demofunktion aktiviert werden?<br />0= nein 1= ja', NULL, '2004-11-20 11:14:04'),
('Artikeloptionstyp: Auswahltyp', 'PRODUCTS_OPTIONS_TYPE_SELECT', 43, 'Die Zahl repr&auml;sentiert den Auswahltyp der Artikeloptionen', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Artikeloptionstyp: Text', 'PRODUCTS_OPTIONS_TYPE_TEXT', 43, 'Numerischer Wert des Textes des Artikeloptionstyps', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Artikeloptionstyp: Radio Button', 'PRODUCTS_OPTIONS_TYPE_RADIO', 43, 'Numerischer Wert des Radio Buttons des Artikeloptionstyps', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Artikeloptionstyp: Check Box', 'PRODUCTS_OPTIONS_TYPE_CHECKBOX', 43, 'Numerischer Wert der Check Box des Artikeloptionstyps', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Artikeloptionstyp: Datei', 'PRODUCTS_OPTIONS_TYPE_FILE', 43, 'Numerischer Wert der Datei des Artikeloptionstyps', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('ID f&uuml;r Text und Datei des Artikeloption Wertes', 'PRODUCTS_OPTIONS_VALUES_TEXT_ID', 43, 'Numerischer Wert der Artikeloptionswert ID (products_options_values_id), die vom Text- und Dateiattribute verwendet wird', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Upload Pr&auml;fix', 'UPLOAD_PREFIX', 43, 'Pr&auml;fix zu Unterscheidung zwischen Uploadoptionen und anderen Optionen', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Text Pr&auml;fix', 'TEXT_PREFIX', 43, 'Pr&auml;fix zu Unterscheidung zwischen Textoptionen und anderen Optionen', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Artikeloptionstyp: Nur lesen', 'PRODUCTS_OPTIONS_TYPE_READONLY', 43, 'Numerischer Wert des Status der Datei des Artikeloptionstyps', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Artikelbeschreibung: Sortierreihenfolge der Artikeloptionen', 'PRODUCTS_OPTIONS_SORT_ORDER', 43, 'Wie soll die Sortierreihenfolge der Artikeloptionen in der Artikelbeschreibung angezeigt werden?<br>0= Sortierreihenfolge, Attributnamen<br>1= Attributnamen', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Artikelbeschreibung: Sortierreihenfolge der Artikelattribute', 'PRODUCTS_OPTIONS_SORT_BY_PRICE', 43, 'Wie soll die Sortierreihenfolge der Artikelattribute in der Artikelbeschreibung angezeigt werden?<br>0= Sortierreihenfolge, Preis<br>1= Sortierreihenfolge, Attributeigenschaften', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Artikelbeschreibung: Namen des Attributmerkmales unter dem Attributbild anzeigen', 'PRODUCT_IMAGES_ATTRIBUTES_NAMES', 43, 'Soll der Name des Attributmerkmales unter dem Attributbild angezeigt werden?<br />0= nein 1= ja', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung: Anzeigen der Differenz der Preisreduktion ("sie sparen...")', 'SHOW_SALE_DISCOUNT_STATUS', 43, 'Soll die Differenz der Preisreduktion ("sie sparen...) angezeigt werden?<br />0= nein 1= ja', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung: Anzeige der Preisreduktion in W&auml;hrung oder Prozent', 'SHOW_SALE_DISCOUNT', 43, 'Zeige den Preisreduktion an in:<br />1= %<br />2= Betrag', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung: Dezimalstellen bei Anzeige der Preisreduktion in Prozent', 'SHOW_SALE_DISCOUNT_DECIMALS', 43, 'Wieviel Dezimalstellen sollen bei Anzeige der Preisreduktion in Prozent dargestellt werden?<br />Standard= 0', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung: Kostenlose Artikel als Bild oder Text darstellen', 'OTHER_IMAGE_PRICE_IS_FREE_ON', 43, 'Soll "Artikel ist kostenlos" als Bild oder Text dargestellt werden?<br />0= Text<br />1= Bild', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung: "F&uuml;r Preis bitte anrufen" als Bild oder Text darstellen', 'PRODUCTS_PRICE_IS_CALL_IMAGE_ON', 43, 'Soll "F&uuml;r Preis bitte anrufen" als Bild oder Text dargestellt werden?<br />0= Text<br />1= Bild', NULL, '2004-11-20 11:14:04'),
('Artikelanzahl: bei neuen Artikel aktiviert', 'PRODUCTS_QTY_BOX_STATUS', 43, 'Wie soll die Box der Artikelanzahl f&uuml;r den Warenkorb bei neuen Artikel standardm&auml;&szlig;ig eingestellt sein?<br /><br />0= aus<br />1= ein<br /><br />Hinweis:<br />EIN<br />Diese Option zeigt eine Box, die dem Kunden die M&ouml;glichkeit zur Eingabe der Artikelanzahl im Warenkorb anzeigt<br />AUS<br />Die Artikelanzahl wird auf nur "1" gesetzt, ohne der M&ouml;glichkeit zur �nderung der Artikelanzahl im Warenkorb', NULL, '2004-11-20 11:14:04'),
('Artikelberichte ben&ouml;tigen �berpr&uuml;fung', 'REVIEWS_APPROVAL', 43, 'Sollen Artikelberichte erst nach einer �berpr&uuml;fung freigegeben werden?<br /><br />Hinweis: Wenn der Bewertungsstatus deaktiviert ist, wird diese Option nicht aktiv<br /><br />0= nein 1= ja', NULL, '2004-11-20 11:14:04'),
('Meta Tags: Artikelpreis im Titel integrieren', 'META_TAG_INCLUDE_PRICE', 43, 'Sollen die Artikelpreise im Meta Tag Titel integriert werden?<br /><br />0= nein 1= ja', NULL, '2004-11-20 11:14:04'),
('"Vorheriger - N&auml;chster" Navigation: Position der Navigationsleite', 'PRODUCT_INFO_PREVIOUS_NEXT', 43, 'Geben Sie hier an, wo die "Vorheriger - N&auml;chster" Navigation angezeigt werden soll<br />0= nicht anzeigen<br />1= oben auf der Seite anzeigen<br />2= unten auf der Seite anzeigen<br />3= oben und unten auf der Seite anzeigen', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('"Vorheriger - N&auml;chster" Navigation: Sortierreihenfolge der Artikel', 'PRODUCT_INFO_PREVIOUS_NEXT_SORT', 43, 'Geben Sie hier an, wie die Artikel in der "Vorheriger - N&auml;chster" Navigation sortiert werden sollen<br />0= Artikel ID<br />1= Artikelname<br />2= Artikelnummer<br />3= Preis, Artikelname<br />4= Preis, Artikelnummer<br />5= Artikelname, Artikelnummer<br />6= Artikelsortierreihenfolge', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('"Vorheriger - N&auml;chster" Navigation: Button und Artikelbilder', 'SHOW_PREVIOUS_NEXT_STATUS', 43, 'Sollen Buttons und Artikelbilder angezeigt werden?<br />0= nein<br />1= ja', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('"Vorheriger - N&auml;chster" Navigation: Button und Artikelbilder - Einstellungen', 'SHOW_PREVIOUS_NEXT_IMAGES', 43, 'Wie sollen Buttons und Artikelbilder angezeigt werden?<br />0= nur Buttons<br />1= Buttons und Artikelbilder<br />2= nur Artikelbilder', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('"Vorheriger - N&auml;chster" Navigation: Breite der Bilder', 'PREVIOUS_NEXT_IMAGE_WIDTH', 43, 'Geben Sie die Breite der Artikelbilder (in Pixel) an', NULL, '2004-11-20 11:14:04'),
('"Vorheriger - N&auml;chster" Navigation: H&ouml;he der Bilder', 'PREVIOUS_NEXT_IMAGE_HEIGHT', 43, 'Geben Sie die H&ouml;he der Artikelbilder (in Pixel) an', NULL, '2004-11-20 11:14:04'),
('"Vorheriger - N&auml;chster" Navigation: Kategorien anzeigen', 'PRODUCT_INFO_CATEGORIES', 43, 'Wie sollen Artikelkategorien, Kategoriebilder und Kategorienamen oberhalb der "Vorheriger - N&auml;chster" Navigation angezeigt werden?<br />0= nicht anzeigen<br />1= Linksausrichtung<br />2= Zentriert<br />3= Rechtsausrichtung', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Spaltenbreite: Linke Boxen', 'BOX_WIDTH_LEFT', 43, 'Die Breite der linken Boxen<br />"px" kann mit angegeben werden<br /><br />Standard = 150px', NULL, '2003-11-21 22:16:36'),
('Spaltenbreite: Rechte Boxen', 'BOX_WIDTH_RIGHT', 43, 'Die Breite der rechten Boxen<br />"px" kann mit angegeben werden<br /><br />Standard = 150px', NULL, '2003-11-21 22:16:36'),
('"Brotkr&uuml;mel" Navigation (Bread Crumbs): Separator', 'BREAD_CRUMBS_SEPARATOR', 43, 'Geben Sie hier das Symbol f&uuml;r den Separator f&uuml;r die sog. Brotkr&uuml;mel Navigation ein<br />Hinweis: Leerzeichen m&uuml;ssen mit "&amp;nbsp;" angegeben.<br />Standard = &amp;nbsp;::&amp;nbsp;', NULL, '2003-11-21 22:16:36'),
('Bestseller: Einr&uuml;cken der Zahlen', 'BEST_SELLERS_FILLER', 43, 'Wie wollen Sie die Zahlen f&uuml;r Bestseller einr&uuml;cken?<br />Standard = &amp;nbsp;', NULL, '2003-11-21 22:16:36'),
('Bestseller: Artikelnamen k&uuml;rzen', 'BEST_SELLERS_TRUNCATE', 43, 'Ab wie vielen Zeichen sollen Artikelnamen gek&uuml;rzt werden?<br />Standard = 35', NULL, '2003-11-21 22:16:36'),
('Bestseller: K&uuml;rze Artikelnamen ab dem folgenden...', 'BEST_SELLERS_TRUNCATE_MORE', 43, 'Artikelnamen werden gek&uuml;rzt, gefolgt von...<br />Standard = true', '2003-03-21 13:08:25', '2003-03-21 11:42:47'),
('Kategoriebox: Link f&uuml;r Sonderangebote anzeigen', 'SHOW_CATEGORIES_BOX_SPECIALS', 43, 'Soll der Link "Sonderangebote" in der Kategoriebox angezeigt werden?', '2003-03-21 13:08:25', '2003-03-21 11:42:47'),
('Kategoriebox: Link f&uuml;r neue Artikel anzeigen', 'SHOW_CATEGORIES_BOX_PRODUCTS_NEW', 43, 'Soll der Link "neue Artikel" in der Kategoriebox angezeigt werden?', '2003-03-21 13:08:25', '2003-03-21 11:42:47'),
('Warenkorb anzeigen', 'SHOW_SHOPPING_CART_BOX_STATUS', 43, 'Wie soll der Warenkorb angezeigt werden?<br />0= Immer<br />1= Nur wenn Artikel im Warenkorb sind<br />2= Nur wenn Artikel im Warenkorb sind und der Warenkorb angesehen wird', NULL, '2004-11-20 11:14:04'),
('Kategorie Box - Zeige Link f&uuml;r "�hnliche Artikel"', 'SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS', 43, 'Soll der Link "&auml;hnliche Artikel" in der Kategoriebox angezeigt werden?', '2003-03-21 13:08:25', '2003-03-21 11:42:47'),
('Kategorie Box - Zeige Link f&uuml;r "Alle Artikel"', 'SHOW_CATEGORIES_BOX_PRODUCTS_ALL', 43, 'Soll der Link "alle Artikel" in der Kategoriebox angezeigt werden?', '2003-03-21 13:08:25', '2003-03-21 11:42:47'),
('Linke Spaltenansicht - Global', 'COLUMN_LEFT_STATUS', 43, 'Linke Spalte anzeigen?<br />0= Linke Spalte immer aus<br />1= Linke Spalte immer ein', NULL, '2004-11-20 11:14:04'),
('Rechte Spaltenansicht - Global', 'COLUMN_RIGHT_STATUS', 43, 'Rechte Spalte anzeigen?<br />0= Rechte Spalte immer aus<br />1= Rechte Spalte immer ein', NULL, '2004-11-20 11:14:04'),
('Spaltenbreite: Linke Spalte', 'COLUMN_WIDTH_LEFT', 43, 'Die Breite der linken Spalte<br />"px" kann mit angegeben werden<br />Standard = 150px', NULL, '2003-11-21 22:16:36'),
('Spaltenbreite: Rechte Spalte', 'COLUMN_WIDTH_RIGHT', 43, 'Die Breite der rechten Spalte<br />"px" kann mit angegeben werden<br />Standard = 150px', NULL, '2003-11-21 22:16:36'),
('Kategorien: Separator zwischen Kategorien und Links', 'SHOW_CATEGORIES_SEPARATOR_LINK', 43, 'Soll ein Separator zwischen Kategorien und Links angezeigt werden?<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('Kategorien: Separator zwischen Kategorienamen und -z&auml;hler', 'CATEGORIES_SEPARATOR', 43, 'Welcher Separator soll zwischen Kategorienamen und -z&auml;hler verwendet werden?<br />Standard = -&amp;gt;', NULL, '2003-11-21 22:16:36'),
('Kategorien: Separator zwischen Kategorienamen und Unterkategorien', 'CATEGORIES_SEPARATOR_SUBS', 43, 'Welcher Separator soll zwischen Kategorienamen und Unterkategorien verwendet werden?<br />Standard = |_&amp;nbsp;', NULL, '2004-03-25 22:16:36'),
('Kategoriez&auml;hler Pr&auml;fix', 'CATEGORIES_COUNT_PREFIX', 43, 'Welches Symbol wollen Sie f&uuml;r den Prefix f&uuml;r Kategoriez&auml;hler verwenden?<br />Standard= (', NULL, '2003-01-21 22:16:36'),
('Kategoriez&auml;hler Suffix', 'CATEGORIES_COUNT_SUFFIX', 43, 'Welches Symbol wollen Sie f&uuml;r den Suffix f&uuml;r Kategoriez&auml;hler verwenden?<br />Standard= )', NULL, '2003-01-21 22:16:36'),
('Unterategorie einr&uuml;cken mit', 'CATEGORIES_SUBCATEGORIES_INDENT', 43, 'Wie sollen Unterkategorien einger&uuml;ckt werden?<br />Standard= &nbsp;&nbsp;', NULL, '2004-06-24 22:16:36'),
('Kategoriez&auml;hler f&uuml;r Kategorien mit 0 Artikel anzeigen', 'CATEGORIES_COUNT_ZERO', 43, 'Sollen Kategoriez&auml;hler f&uuml;r Kategorien, die keine Artikel enthalten, angezeigt werden?<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('Kategoriebox teilen', 'CATEGORIES_SPLIT_DISPLAY', 43, 'Soll die Kategoriebox nach Artikeltyp aufgeteilt werden?', NULL, '2004-11-20 11:14:04'),
('Warenkorb: Summe anzeigen', 'SHOW_TOTALS_IN_CART', 43, 'Soll die Summe unter dem Warenkorb angezeigt werden?<br />0= nein<br />1= ja<br />2= ja, kein Gewicht wenn 0', NULL, '2004-11-20 11:14:04'),
('Kategorien: Immer auf der Startseite anzeigen', 'SHOW_CATEGORIES_ALWAYS', 43, 'Sollen Kategorien immer auf der Startseite angezeigt werden?<br />0= nein<br />1= ja<br />Die Standardkategorie kann als "Top Level Kategorie" gesetzt sein oder eine bestimmte "Top Level Kategorie" sein', NULL, '2004-11-20 11:14:04'),
('Startseite er&ouml;ffnet mit Kategorien', 'CATEGORIES_START_MAIN', 43, '0= Top Level Kategorien<br />oder geben Sie eine Kategorie ID# ein<br />Hinweis: Unterkategorien k&ouml;nnen ebenso verwendet werden. Beispiel: 3_10', NULL, '2004-11-20 11:14:04'),
('Bannergruppen: �berschrift Position 1', 'SHOW_BANNERS_GROUP_SET1', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />F&uuml;r mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der �berschrift 1 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', NULL, '2004-11-20 11:14:04'),
('Bannergruppen: �berschrift Position 2', 'SHOW_BANNERS_GROUP_SET2', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />F&uuml;r mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der �berschrift 2 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', NULL, '2004-11-20 11:14:04'),
('Bannergruppen: �berschrift Position 3', 'SHOW_BANNERS_GROUP_SET3', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />F&uuml;r mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der �berschrift 3 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', NULL, '2004-11-20 11:14:04'),
('Bannergruppen: Fu&szlig;zeile Position 1', 'SHOW_BANNERS_GROUP_SET4', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />F&uuml;r mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Fu&szlig;zeile 1 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', NULL, '2004-11-20 11:14:04'),
('Bannergruppen: Fu&szlig;zeile Position 2', 'SHOW_BANNERS_GROUP_SET5', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />F&uuml;r mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Fu&szlig;zeile 2 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', NULL, '2004-11-20 11:14:04'),
('Bannergruppen: Fu&szlig;zeile Position 3', 'SHOW_BANNERS_GROUP_SET6', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />F&uuml;r mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Standard Bannergruppe = Wide-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Fu&szlig;zeile 3 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', NULL, '2004-11-20 11:14:04'),
('Bannergruppen: Sidebox banner_box', 'SHOW_BANNERS_GROUP_SET7', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />F&uuml;r mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br />Standard Bannergruppe = SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Sidebox - banner_box verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', NULL, '2004-11-20 11:14:04'),
('Bannergruppen: Sidebox banner_box2', 'SHOW_BANNERS_GROUP_SET8', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />F&uuml;r mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br />Standard Bannergruppe = SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Sidebox - banner_box2 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', NULL, '2004-11-20 11:14:04'),
('IP Adresse anzeigen in der Fu&szlig;zeile anzeigen', 'SHOW_FOOTER_IP', 43, 'Soll die IP Adresse des Kunden in der Fu&szlig;zeile angezeigt werden?<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('Mengenrabatt: Anzahl leerer Rabatte', 'DISCOUNT_QTY_ADD', 43, 'Wieviele leere Mengenrabatte sollen bei der Artikel Bepreisung hinzugef&uuml;gt werden?', NULL, '2004-11-20 11:14:04'),
('Mengenrabatt: Anzahl Ansicht pro Reihe', 'DISCOUNT_QUANTITY_PRICES_COLUMN', 43, 'Wieviele Mengenrabatte sollen pro Reihe angezeigt werden?', NULL, '2004-11-20 11:14:04'),
('<strong>Wegen Shopwartung geschlossen:</strong>', 'DOWN_FOR_MAINTENANCE', 43, 'Wegen Shopwartung geschlossen <br>(true=ein false=aus)', NULL, '2004-11-20 11:14:04'),
('Wegen Shopwartung geschlossen: Dateiname', 'DOWN_FOR_MAINTENANCE_FILENAME', 43, 'Welcher Dateinamen soll f&uuml;r den Status "Wegen Shopwartung geschlossen" verwendet werden?<br />Hinweis: Bitte den Dateinamen ohne Dateierweiterung angeben<br />Standard= down_for_maintenance', NULL, '2004-11-20 11:14:04'),
('Wegen Shopwartung geschlossen: Header verstecken', 'DOWN_FOR_MAINTENANCE_HEADER_OFF', 43, 'Wegen Shopwartung geschlossen: Header verstecken<br>(true= verstecken<br />false= anzeigen)', NULL, '2004-11-20 11:14:04'),
('Wegen Shopwartung geschlossen: Linke Spalte verstecken', 'DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF', 43, 'Wegen Shopwartung geschlossen: Linke Spalte verstecken<br>(true= verstecken<br />false= anzeigen)', NULL, '2004-11-20 11:14:04'),
('Wegen Shopwartung geschlossen: Rechte Spalte verstecken', 'DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF', 43, 'Wegen Shopwartung geschlossen: Rechte Spalte verstecken<br>(true= verstecken<br />false= anzeigen)', NULL, '2004-11-20 11:14:04'),
('Wegen Shopwartung geschlossen: Fu&szlig;zeile verstecken', 'DOWN_FOR_MAINTENANCE_FOOTER_OFF', 43, 'Wegen Shopwartung geschlossen: Fu&szlig;zeile verstecken<br>(true= verstecken<br />false= anzeigen)', NULL, '2004-11-20 11:14:04'),
('Wegen Shopwartung geschlossen: Preise verstecken', 'DOWN_FOR_MAINTENANCE_PRICES_OFF', 43, 'Wegen Shopwartung geschlossen: Preise verstecken<br>(true= verstecken<br />false= anzeigen)', NULL, '2004-11-20 11:14:04'),
('Wegen Shopwartung geschlossen: diese IP-Adresse(n) ausschlie&szlig;en', 'EXCLUDE_ADMIN_IP_FOR_MAINTENANCE', 43, 'Diese IP Adresse(n) hat w&auml;hrend der Shopwartung vollen Zugriff auf den Shop (z.B. Webmaster)<br />Bei Eingabe mehrerer IP Adressen werden diese mit einem Komma getrennt.<br /><br />TIP: Wenn Sie Ihre IP Adresse nicht kennen, finden Sie diese in der Fu&szlig;zeile des Shops.', '2003-03-21 13:43:22', '2003-03-21 21:20:07'),
('Die �ffentlichkeit vor Beginn der Shopwartung informieren:', 'WARN_BEFORE_DOWN_FOR_MAINTENANCE', 43, 'Ver&ouml;ffentlicht eine bestimmte Zeit vor der Shopwartung einen Hinweis, wann die Shopwartung starten wird<br>(true=ein false=aus)<br>IWenn Sie die Option \'Wegen Shopwartung geschlossen\' auf "true" setzen,wird diese Option automatisch auf "false" gesetzt.', '2003-03-21 13:08:25', '2003-03-21 11:42:47'),
('Datum und Stunden f&uuml;r Hinweis vor Beginn der Shopwartung', 'PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', 43, 'Datum und Stunden f&uuml;r den Hinweis vor der Shopwartung, geben Sie Datum und Stunden f&uuml;r die Zeit der Shopwartung ein', '2003-03-21 13:08:25', '2003-03-21 11:42:47'),
('Anzeigen, wann mit der Shopwartung begonnen wurde', 'DISPLAY_MAINTENANCE_TIME', 43, 'Zeigt an, wann mit der Shopwartung begonnen wurde<br>(true=ein false=aus)<br />', '2003-03-21 13:08:25', '2003-03-21 11:42:47'),
('Dauer der Shopwartung anzeigen', 'DISPLAY_MAINTENANCE_PERIOD', 43, 'Zeigt die Dauer der Shopwartung an<br>(true=ein false=aus)<br />', '2003-03-21 13:08:25', '2003-03-21 11:42:47'),
('Dauer der Shopwartung', 'TEXT_MAINTENANCE_PERIOD_TIME', 43, 'Geben Sie die Dauer der Shopwartung an (hh:mm)', '2003-03-21 13:08:25', '2003-03-21 11:42:47'),
('AGB Best&auml;tigungsfeld bei der Bestellung anzeigen', 'DISPLAY_CONDITIONS_ON_CHECKOUT', 43, 'Den Kunden wird w&auml;hrend der Bestellung das AGB Best&auml;tigungsfeld angezeigt und m&uuml;ssen diesen zustimmen.', NULL, '2004-11-20 11:14:04'),
('AGB Best&auml;tigungsfeld bei der Kontoerstellung anzeigen', 'DISPLAY_PRIVACY_CONDITIONS', 43, 'Den Kunden wird w&auml;hrend der Kontoerstellung das AGB Best&auml;tigungsfeld angezeigt und m&uuml;ssen diesen zustimmen.', NULL, '2004-11-20 11:14:04'),
('Bild anzeigen', 'PRODUCT_NEW_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('St&uuml;ckzahl anzeigen', 'PRODUCT_NEW_LIST_QUANTITY', 43, 'Wollen Sie die Artikelst&uuml;ckzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('"jetzt kaufen" - Button anzeigen', 'PRODUCT_NEW_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Artikelname anzeigen', 'PRODUCT_NEW_LIST_NAME', 43, 'Wollen Sie den Artikelnamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Artikelnummer anzeigen', 'PRODUCT_NEW_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Herstellernamen anzeigen', 'PRODUCT_NEW_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Preis anzeigen', 'PRODUCT_NEW_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Gewicht anzeigen', 'PRODUCT_NEW_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Hinzuf&uuml;gedatum anzeigen', 'PRODUCT_NEW_LIST_DATE_ADDED', 43, 'Wollen Sie das Hinzuf&uuml;gedatum in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung anzeigen', 'PRODUCT_NEW_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('Standardsortierung', 'PRODUCT_NEW_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzuf&uuml;gedatum, absteigend<br />7= nach Hinzuf&uuml;gedatum, aufsteigend<br />8= nach Artikelsortierreihenfolge', NULL, '2004-11-20 11:14:04'),
('Gruppen ID f&uuml;r "neue Artikel"', 'PRODUCT_NEW_LIST_GROUP_ID', 43, 'Warnung: �ndern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 23 ge&auml;ndert wurde<br />Wie lautet die configuration_group_id f&uuml;r die "neue Artikel" Liste?', NULL, '2004-11-20 11:14:04'),
('Bild anzeigen', 'PRODUCT_FEATURED_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('St&uuml;ckzahl anzeigen', 'PRODUCT_FEATURED_LIST_QUANTITY', 43, 'Wollen Sie die Artikelst&uuml;ckzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('"jetzt kaufen" - Button anzeigen', 'PRODUCT_FEATURED_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Artikelname anzeigen', 'PRODUCT_FEATURED_LIST_NAME', 43, 'Wollen Sie den Artikelnamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Artikelnummer anzeigen', 'PRODUCT_FEATURED_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Herstellernamen anzeigen', 'PRODUCT_FEATURED_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Preis anzeigen', 'PRODUCT_FEATURED_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Gewicht anzeigen', 'PRODUCT_FEATURED_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Hinzuf&uuml;gedatum anzeigen', 'PRODUCT_FEATURED_LIST_DATE_ADDED', 43, 'Wollen Sie das Hinzuf&uuml;gedatum in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung anzeigen', 'PRODUCT_FEATURED_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('Standardsortierung', 'PRODUCT_FEATURED_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzuf&uuml;gedatum, absteigend<br />7= nach Hinzuf&uuml;gedatum, aufsteigend<br />8= nach Artikelsortierreihenfolge', NULL, '2004-11-20 11:14:04'),
('Gruppen ID f&uuml;r "&auml;hnliche Artikel"', 'PRODUCT_FEATURED_LIST_GROUP_ID', 43, 'Warnung: �ndern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 23 ge&auml;ndert wurde<br />Wie lautet die configuration_group_id f&uuml;r die "&auml;hnliche Artikel" Liste?', NULL, '2004-11-20 11:14:04'),
('Bild anzeigen', 'PRODUCT_ALL_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('St&uuml;ckzahl anzeigen', 'PRODUCT_ALL_LIST_QUANTITY', 43, 'Wollen Sie St&uuml;ckzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('"jetzt kaufen" - Button anzeigen', 'PRODUCT_ALL_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Artikelname anzeigen', 'PRODUCT_ALL_LIST_NAME', 43, 'Wollen Sie den Artikelname in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Artikelnummer anzeigen', 'PRODUCT_ALL_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Herstellernamen anzeigen', 'PRODUCT_ALL_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Preis anzeigen', 'PRODUCT_ALL_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Gewicht anzeigen', 'PRODUCT_ALL_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Hinzuf&uuml;gedatum anzeigen', 'PRODUCT_ALL_LIST_DATE_ADDED', 43, 'Wollen Sie das Hinzuf&uuml;gedatum in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierreihenfolge<br />4. Zahl = Anzahl der Leerzeilen danach<br />', NULL, '2004-11-20 11:14:04'),
('Artikelbeschreibung anzeigen', 'PRODUCT_ALL_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', NULL, '2004-11-20 11:14:04'),
('Standardsortierung', 'PRODUCT_ALL_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzuf&uuml;gedatum, absteigend<br />7= nach Hinzuf&uuml;gedatum, aufsteigend<br />8= nach Artikelsortierreihenfolge', NULL, '2004-11-20 11:14:04'),
('Gruppen ID f&uuml;r "Alle Artikel"', 'PRODUCT_ALL_LIST_GROUP_ID', 43, 'Warnung: �ndern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 23 ge&auml;ndert wurde<br />Wie lautet die configuration_group_id f&uuml;r die "alle Artikel" Liste?', NULL, '2004-11-20 11:14:04'),
('Startseite: Neue Artikel anzeigen', 'SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS', 43, 'Sollen neue Artikel auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Startseite: �hnliche Artikel anzeigen', 'SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS', 43, 'Sollen &auml;hnliche Artikel auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Startseite: Sonderangebote anzeigen', 'SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS', 43, 'Sollen Sonderangebote auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Startseite: Kommende Artikel anzeigen', 'SHOW_PRODUCT_INFO_MAIN_UPCOMING', 43, 'Sollen kommende Artikel auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Neue Artikel auf der Startseite: Kategorien mit Unterkategorien anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS', 43, 'Wenn neue Artikel auf der Startseite angezeigt werden, sollen auch Kategorien und Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('�hnliche Artikel auf der Startseite: Kategorien mit Unterkategorien anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS', 43, 'Wenn &auml;hnliche Artikel auf der Startseite angezeigt werden, sollen auch Kategorien und Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Sonderangebote auf der Startseite: Kategorien mit Unterkategorien anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS', 43, 'Wenn Soderangebote auf der Startseite angezeigt werden, sollen auch Kategorien und Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Kommende Artikel auf der Startseite: Kategorien mit Unterkategorien anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_UPCOMING', 43, 'Wenn kommende Artikel auf der Startseite angezeigt werden, sollen auch Kategorien und Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Neue Artikel auf der Startseite: Seite f&uuml;r Fehler und fehlende Artikel anzeigen', 'SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS', 43, 'Neue Artikel auf der Startseite: Seite f&uuml;r Fehler und fehlende Artikel anzeigen<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('�hnliche Artikel auf der Startseite: Seite f&uuml;r Fehler und fehlende Artikel', 'SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS', 43, '�hnliche Artikel auf der Startseite: Seite f&uuml;r Fehler und fehlende Artikel anzeigen<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Sonderangebote auf der Startseite: Seite f&uuml;r Fehler und fehlende Artikel', 'SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS', 43, 'Sonderangebote auf der Startseite: Seite f&uuml;r Fehler und fehlende Artikel anzeigen<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Kommende Artikel auf der Startseite: Seite f&uuml;r Fehler und fehlende Artikel', 'SHOW_PRODUCT_INFO_MISSING_UPCOMING', 43, 'Kommende Artikel auf der Startseite: Seite f&uuml;r Fehler und fehlende Artikel anzeigen<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Neue Artikel unter Artikelliste anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS', 43, 'Neue Artikel unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('�hnliche Artikel unter Artikelliste anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS', 43, '�hnliche Artikel unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Sonderangebote unter Artikelliste anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS', 43, 'Sonderangebote unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Kommende Artikel unter Artikelliste anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING', 43, 'Kommende Artikel unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierreihenfolge fest)', NULL, '2004-11-20 11:14:04'),
('Neue Artikel: Spalten pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS', 43, 'Wieviele Spalten wollen Sie pro Reihe anzeigen lassen?', NULL, '2004-11-20 11:14:04'),
('�hnliche Artikel: Spalten pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS', 43, 'Wieviele Spalten wollen Sie pro Reihe anzeigen lassen?', NULL, '2004-11-20 11:14:04'),
('Sonderangebote: Spalten pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS', 43, 'Wieviele Spalten wollen Sie pro Reihe anzeigen lassen?', NULL, '2004-11-20 11:14:04'),
('Artikelliste f&uuml;r aktuelle Top Level Kategorie filtern, wenn aktiviert', 'SHOW_PRODUCT_INFO_ALL_PRODUCTS', 43, 'Artikel filtern, wenn die Artikelliste f&uuml;r die aktuelle Hauptkategorie aktiviert ist<br />oder Artikel aus allen Kategorien anzeigen?<br />0= Filter aus 1=Filter ein', NULL, '2004-11-20 11:14:04'),
('Eigene Seite f&uuml;r "Startseite" verwenden', 'DEFINE_MAIN_PAGE_STATUS', 43, 'Wollen Sie die eigene Seite als Startseite verwenden?<br />0= NEIN<br />1= JA', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Eigene Seite f&uuml;r "Schreiben Sie uns" verwenden', 'DEFINE_CONTACT_US_STATUS', 43, 'Wollen Sie die eigene Seite f&uuml;r die Seite "Schreiben Sie uns" verwenden?<br />0= NEIN<br />1= JA', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Eigene Seite f&uuml;r "Privatsph&auml;re" verwenden', 'DEFINE_PRIVACY_STATUS', 43, 'Wollen Sie die eigene Seite f&uuml;r die Seite "Privatsph&auml;re" verwenden?<br />0= NEIN<br />1= JA', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Eigene Seite f&uuml;r "Versandbedingungen" verwenden', 'DEFINE_SHIPPINGINFO_STATUS', 43, 'Wollen Sie die eigene Seite f&uuml;r die Seite "Versandbedingungen" verwenden?<br />0= NEIN<br />1= JA', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Eigene Seite f&uuml;r "AGB" verwenden', 'DEFINE_CONDITIONS_STATUS', 43, 'Wollen Sie die eigene Seite f&uuml;r die Seite "AGB" verwenden?<br />0= NEIN<br />1= JA', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Eigene Seite f&uuml;r "Bestellung erfolgreich" verwenden', 'DEFINE_CHECKOUT_SUCCESS_STATUS', 43, 'Wollen Sie die eigene Seite f&uuml;r die Seite "Bestellung erfolgreich" verwenden?<br />0= NEIN<br />1= JA', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Eigene Seite f&uuml;r "Seite 2" verwenden', 'DEFINE_PAGE_2_STATUS', 43, 'Wollen Sie die eigene Seite f&uuml;r "Seite 2" verwenden?<br />0= NEIN<br />1= JA', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Eigene Seite f&uuml;r "Seite 3" verwenden', 'DEFINE_PAGE_3_STATUS', 43, 'Wollen Sie die eigene Seite f&uuml;r "Seite 3" verwenden?<br />0= NEIN<br />1= JA', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Eigene Seite f&uuml;r "Seite 4" verwenden', 'DEFINE_PAGE_4_STATUS', 43, 'Wollen Sie die eigene Seite f&uuml;r "Seite 4" verwenden?<br />0= NEIN<br />1= JA', '2004-11-20 11:14:04', '2004-11-20 11:14:04'),
('Image - Use Proportional Images on Products and Categories', 'PROPORTIONAL_IMAGES_STATUS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('E-Mail Friendly-Errors', 'EMAIL_FRIENDLY_ERRORS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Downloads Controller Order Status Value <= upper value', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS_END', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Default Order Status For Zero Balance Orders', 'DEFAULT_ZERO_BALANCE_ORDERS_STATUS_ID', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Customer Default Email Preference', 'ACCOUNT_EMAIL_PREFERENCE', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Categories - Always Open to Show SubCategories', 'SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Also Purchased Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Manufacturers List - Verify Product Exist', 'PRODUCTS_MANUFACTURERS_STATUS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Read Only option type - Ignore for Add to Cart', 'PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Show Shopping Cart - Update Cart Button Location', 'SHOW_SHOPPING_CART_UPDATE', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('SMTP Email Account Mailbox', 'EMAIL_SMTPAUTH_MAILBOX', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('SMTP Email Account Password', 'EMAIL_SMTPAUTH_PASSWORD', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('SMTP Email Mail Host', 'EMAIL_SMTPAUTH_MAIL_SERVER', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Allowed Filename Extensions for uploading', 'UPLOAD_FILENAME_EXTENSIONS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Banner Display Group - Side Box banner_box_all', 'SHOW_BANNERS_GROUP_SET_ALL', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Categories/Products Display Sort Order', 'CATEGORIES_PRODUCTS_SORT_ORDER', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Display Product Description', 'PRODUCT_LIST_DESCRIPTION', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('IP to Host Conversion Status', 'SESSION_IP_TO_HOST_ADDRESS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Maximum Discount Coupon Report Results Per Page', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS_REPORTS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Maximum Discount Coupons Per Page', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Maximum Display Columns Products to Multiple Categories Manager', 'MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Maximum Orders Detail Display on Admin Orders Listing', 'MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Option Names and Values Global Add, Copy and Delete Features Status', 'OPTION_NAMES_VALUES_GLOBAL_STATUS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Sales Tax Display Status', 'STORE_TAX_DISPLAY_STATUS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Send Copy of Pending Reviews Emails To', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('Send Copy of Pending Reviews Emails To - Status', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS', 43, '�bersetzen', NULL, '0001-01-01 00:00:00'),
('SMTP Email Mail Server Port', 'EMAIL_SMTPAUTH_MAIL_SERVER_PORT', 43, '�bersetzen', NULL, '0001-01-01 00:00:00');

# new field: language_id
ALTER TABLE configuration_group ADD language_id INT( 11 ) DEFAULT '1' NOT NULL AFTER configuration_group_id ;
ALTER TABLE configuration_group DROP PRIMARY KEY ,
ADD PRIMARY KEY ( configuration_group_id , language_id );

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (1, 43, 'Mein Shop', 'Generelle Informationen &uuml;ber den Shop', 1, 1),
(2, 43, 'Minimale Werte', 'Die minimale Zeichenl&auml;nge f&uuml;r Funktionen / Daten', 2, 1),
(3, 43, 'Maximale Werte', 'Die maximale Zeichenl&auml;nge f&uuml;r Funktionen / Daten', 3, 1),
(4, 43, 'Bilder', 'Einstellungen der Bildparameter', 4, 1),
(5, 43, 'Kundendetails', 'Konfiguration der Kundenkonten', 5, 1),
(6, 43, 'Moduloptionen', 'Vom Konfigurationsmen&uuml; versteckt', 6, 0),
(7, 43, 'Versandoptionen', 'Im Shop verf&uuml;gbare Versandoptionen', 7, 1),
(8, 43, 'Artikelliste', 'Konfiguration der Artikelliste', 8, 1),
(9, 43, 'Lagerverwaltung', 'Konfigurationen der Lagerverwaltung', 9, 1),
(10, 43, 'Protokollierung', 'Konfiguration der Protokollierung', 10, 1),
(11, 43, 'AGB', 'Konfiguration f&uuml;r die AGB', 16, 1),
(12, 43, 'e-Mail Optionen', 'Generelle Einstellungen f&uuml;r den e-Mail Transport (SMTP) und die HTML Optionen', 12, 1),
(13, 43, 'Attributeinstellungen', 'Konfiguration f&uuml;r die Einstellungen der Artikeloptionen', 13, 1),
(14, 43, 'GZip Komprimierung', 'Konfiguration der GZip Komprimierung', 14, 1),
(15, 43, 'Sitzungen', 'Konfiguration der Sitzungsoptionen', 15, 1),
(16, 43, 'Gutscheine und Kupons', 'Konfiguration der Gutscheine und Kupons', 16, 1),
(17, 43, 'Kreditkarten', 'Konfiguration der zu verwendeten Kreditkarten', 17, 1),
(18, 43, 'Artikeldetails', 'Konfiguration f&uuml;r die Anzeige von Artikeldetails', 18, 1),
(19, 43, 'Layouteinstellungen', 'Layouteinstellungen', 19, 1),
(20, 43, 'Shopwartung', 'Konfiguration der Shopwartung', 20, 1),
(21, 43, 'Liste - Neue Artikel', 'Listenansicht f�r neue Artikel', 21, 1),
(22, 43, 'Liste - �hnliche Artikel', 'Listenansicht f�r �hnliche Artikel', 22, 1),
(23, 43, 'Liste - Alle Artikel', 'Listenansicht f�r alle Artikel', 23, 1),
(24, 43, 'Liste - Artikelindex', 'Listenansicht f�r Artikelindex', 24, 1),
(25, 43, 'Definierte Seiten', 'Definierte Seiten des im Seiteneditor eingegebenen Textes festlegen und HTMLArea Optionen', 25, 1);


# MUST BE PLACED INTO mysql_demo.sql otherwise you get an catalog-tree error
# 43 == german
# category to language
# INSERT INTO categories_description ( categories_id, language_id, categories_name, categories_description ) SELECT categories_id, 43 AS language_id, categories_name, categories_description
# FROM categories_description;

# products_description to language
# INSERT INTO products_description ( products_id, language_id, products_name, products_description, products_url, products_viewed ) SELECT products_id, 43 AS language_id, products_name, products_description, products_url, products_viewed
# FROM products_description;
#
#

INSERT INTO orders_status VALUES (2, 43, 'In Arbeit');
INSERT INTO orders_status VALUES (1, 43, 'Wartet');
INSERT INTO orders_status VALUES (3, 43, 'Verschickt');
INSERT INTO orders_status VALUES (4, 43, 'Update');
##### End of SQL setup for Zen Cart.
