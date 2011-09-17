SET @t4=0;
SELECT (@t4:=configuration_group_id) as t4 
FROM configuration_group
WHERE configuration_group_title= 'Live Help Configuration';
DELETE FROM configuration WHERE configuration_group_id = @t4;
DELETE FROM configuration_group WHERE configuration_group_id = @t4;

INSERT INTO configuration_group VALUES (NULL, 'Live Help Configuration', 'Set Live Help Options', '1', '1');
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

SET @t4=0;
SELECT (@t4:=configuration_group_id) as t4 
FROM configuration_group
WHERE configuration_group_title= 'Live Help Configuration';

INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Enable Skype?', 'LIVE_HELP_SKYPE', 'Disable', 'Do you want to enable Skype in Live Help?', @t4, 1, now(), now(), NULL, 'zen_cfg_select_option(array(''Enable'', ''Disable''),'),
(NULL, 'Skype Username', 'LIVE_HELP_SKYPE_USERNAME', 'Please enter your Skype username', 'Enter your Skype username', @t4, 2, now(), now(), NULL, NULL),
(NULL, 'Skype Style', 'LIVE_HELP_SKYPE_STYLE', 'chat', 'Choose your Skype Style', @t4, 3, now(), now(), NULL, 'zen_cfg_select_option(array(''chat'', ''call''),'),
(NULL, 'Enable Yahoo Messenger?', 'LIVE_HELP_YAHOO', 'Disable', 'Do you want to enable Yahoo Messenger in Live Help?', @t4, 4, now(), now(), NULL, 'zen_cfg_select_option(array(''Enable'', ''Disable''),'),
(NULL, 'Yahoo Messenger Username', 'LIVE_HELP_YAHOO_USERNAME', 'Please enter your Yahoo Messenger username', 'Enter your Yahoo Messenger username', @t4, 5, now(), now(), NULL, NULL),
(NULL, 'Yahoo Messenger Style', 'LIVE_HELP_YAHOO_STYLE', '1', 'Choose your Yahoo Messenger Style', @t4, 6, now(), now(), NULL, 'zen_cfg_select_option(array(''0'', ''1'', ''2'', ''3'', ''4'', ''5'', ''6'', ''7'', ''8'', ''9''),'),
(NULL, 'Enable Tencent QQ?', 'LIVE_HELP_QQ', 'Disable', 'Do you want to enable Tencent QQ in Live Help?', @t4, 7, now(), now(), NULL, 'zen_cfg_select_option(array(''Enable'', ''Disable''),'),
(NULL, 'Tencent QQ Number', 'LIVE_HELP_QQ_USERNAME', 'Please enter your Tencent QQ Number', 'Enter your Tencent QQ Number', @t4, 8, now(), now(), NULL, NULL),
(NULL, 'Tencent QQ Style', 'LIVE_HELP_QQ_STYLE', '12', 'Choose your Tencent QQ Style', @t4, 9, now(), now(), NULL, 'zen_cfg_select_option(array(''1'', ''2'', ''3'', ''4'', ''5'', ''6'', ''7'', ''8'', ''9'', ''10'', ''11'', ''12'', ''13'', ''14'', ''15'', ''16'', ''17''),'),
(NULL, 'Enable Tao Bao Wang Wang?', 'LIVE_HELP_WANGWANG', 'Disable', 'Do you want to enable Tao Bao Wang Wang in Live Help?', @t4, 10, now(), now(), NULL, 'zen_cfg_select_option(array(''Enable'', ''Disable''),'),
(NULL, 'Tao Bao Wang Wang Username', 'LIVE_HELP_WANGWANG_USERNAME', 'Please enter your Tao Bao Wang Wang username', 'Enter your Tao Bao Wang Wang username', @t4, 11, now(), now(), NULL, NULL),
(NULL, 'Tao Bao Wang Wang Style', 'LIVE_HELP_WANGWANG_STYLE', '2', 'Choose your Tao Bao Wang Wang Style', @t4, 12, now(), now(), NULL, 'zen_cfg_select_option(array(''1'', ''2''),');