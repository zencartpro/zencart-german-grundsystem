CREATE TABLE IF NOT EXISTS `meta_tags_manufacturers_description` (
  `manufacturers_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL default '1',
  `metatags_title` varchar(255) NOT NULL default '',
  `metatags_keywords` text,
  `metatags_description` text,
  PRIMARY KEY  (`manufacturers_id`,`language_id`)
) ;