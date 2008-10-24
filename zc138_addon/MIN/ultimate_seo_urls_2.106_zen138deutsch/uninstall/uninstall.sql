DELETE FROM `configuration_group` WHERE `configuration_group_title` LIKE '%SEO%';
DELETE FROM `configuration` WHERE `configuration_key` LIKE '%SEO%';
DROP TABLE IF EXISTS seo_cache;