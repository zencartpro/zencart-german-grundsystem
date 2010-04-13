# This SQL script upgrades the core Zen Cart database structure from v1.2.1 to v1.2.2
#
# $Id$
#

#################################################################
#  LANGUAGE SPECIFIC                                            #
#  questions to: zencart(AT)langheiter.com                      #
#################################################################
# insert language; id == 43 == telephone-countrycode

 # new field: language_id
ALTER TABLE configuration_group ADD language_id INT( 11 ) DEFAULT '1' NOT NULL AFTER configuration_group_id ;
ALTER TABLE configuration_group DROP PRIMARY KEY ,
ADD PRIMARY KEY ( configuration_group_id , language_id );

CREATE TABLE IF NOT EXISTS configuration_language(
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

#####################################################################################################
UPDATE configuration SET configuration_value = 'de' WHERE configuration_key = 'DEFAULT_LANGUAGE' LIMIT 1 ;
#####  END OF UPGRADE SCRIPT
