DROP TABLE IF EXISTS user_tracking;
CREATE TABLE user_tracking (
  `customer_id` int(11) default NULL,
  `click_id` int(11) default NULL,
  `full_name` varchar(64) NOT NULL default '',
  `session_id` varchar(32) NOT NULL default '',
  `ip_address` varchar(15) NOT NULL default '',
  `time_entry` varchar(14) NOT NULL default '',
  `time_last_click` varchar(14) NOT NULL default '',
  `last_page_url` varchar(128) NOT NULL default '',
  `referer_url` varchar(254) NOT NULL default '',
  `page_desc` varchar(64) NOT NULL default '',
  `customers_host_address` varchar(64) NOT NULL default ''
) TYPE=MyISAM;




DELETE FROM configuration where configuration_group_id = '999';
INSERT INTO configuration_group (`configuration_group_id`, `configuration_group_title`, `configuration_group_description`, `sort_order`, `visible`) VALUES (999, 'User Tracking Config', 'User Tracking', 31, 1);
INSERT INTO configuration VALUES ('', 'User Tracking (ADMIN)', 'ADMIN_CONFIG_USER_TRACKING', 'true', 'Check the ADMINs behaviour ? (each click will be recorded)', 999, 2, '2003-03-03 11:19:26', '2003-02-09 21:20:07', NULL, 'zen_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES ('', 'User Tracking (exclude this IP-Address)', 'CONFIG_USER_TRACKING_EXCLUDED', 'your IP', 'Do NOT record this IP Address<br>(like webmaster/owners/Beta-testers)', 999, 10, '2003-03-04 23:08:38', '2003-02-09 21:20:07', NULL, NULL);
INSERT INTO configuration VALUES ('', 'User Tracking (Session Limit)', 'CONFIG_USER_TRACKING_SESSION_LIMIT', '50', 'Displaying the latest # sessions of this 24 hour period.<br>(SET to 999999 for unlimited per 24 hour period)<br>NOTE:<BR>Watch you space !', 999, 15, '2003-03-03 11:19:13', '2003-02-09 21:20:07', NULL, NULL);
INSERT INTO configuration VALUES ('', 'User Tracking (your favorite WHOIS URL)', 'USER_TRACKING_WHOIS_URL', 'http://www.dnsstuff.com/tools/whois.ch?ip=', 'Put here you favorite WHOIS tracking site<br>(the IP will follow automaticly after this url)', 999, 50, '2003-03-03 11:19:13', '2003-03-11 11:40:01', NULL, NULL);
INSERT INTO configuration VALUES ('', 'User Tracking Visitors', 'ZEN_CONFIG_USER_TRACKING', 'true', 'Check the Customers/Guests behaviour ? (each click will be recorded)', 999, 1, '2003-03-03 11:19:26', '2003-02-09 21:20:07', NULL, 'zen_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES ('', 'User Tracking (Show Product Category when tracking product clicks)', 'ZEN_CONFIG_SHOW_USER_TRACKING_CATEGORY', 'true', 'Show Product Category when tracking product clicks', 999, 60, '2006-12-05 11:19:26', '2006-12-05 21:20:07', NULL, 'zen_cfg_select_option(array(''true'', ''false''),');



