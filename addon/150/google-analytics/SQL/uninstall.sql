###############################################################################
# Google Analytics Cleaner Zen-Cart 1.5 - 2011-11-28 - webchills
# ENTFERNT ALLE DATENBANKEINTRÄGE VON GOOGLE ANALYTICS VERSIONEN 1.5 UND ÄLTER
###############################################################################

DELETE FROM admin_pages WHERE page_key='configProdGoogleAnalytics';

DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_AFTER_CODE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_AFTER';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_LANG';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_TRACKING_TYPE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_IDNUM';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_ACTIVE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_SKUCODE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_AFFILIATION';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_TARGET';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_UACCT';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_CONVERSION_ACTIVE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_CONVERSION_IDNUM';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_CONVERSION_LANG';

DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_AFTER_CODE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_AFTER';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_LANG';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_TRACKING_TYPE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_IDNUM';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_ACTIVE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_SKUCODE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_AFFILIATION';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_TARGET';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_UACCT';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_CONVERSION_ACTIVE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_CONVERSION_IDNUM';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_CONVERSION_LANG';

DELETE FROM configuration_group WHERE configuration_group_title = 'Google Analytics Einstellungen';
DELETE FROM configuration_group WHERE configuration_group_title = 'Google Analytics Configuration';

DROP TABLE IF EXISTS google_analytics_languages;