##########################################################################
# Ultimate SEO URLs UNINSTALLER - 2013-10-27 - webchills
# Entfernt Datenbankeinträge auch von älteren Ultimate SEO Versionen
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
##########################################################################

DELETE FROM configuration_group WHERE configuration_group_title LIKE '%SEO URL%';
DELETE FROM configuration WHERE configuration_key = 'SEO_ENABLED';
DELETE FROM configuration WHERE configuration_key = 'SEO_URL_CPATH';
DELETE FROM configuration WHERE configuration_key = 'SEO_URL_END';
DELETE FROM configuration WHERE configuration_key = 'SEO_URL_FORMAT';
DELETE FROM configuration WHERE configuration_key = 'SEO_URL_CATEGORY_DIR';
DELETE FROM configuration WHERE configuration_key = 'SEO_URLS_FILTER_PCRE';
DELETE FROM configuration WHERE configuration_key = 'SEO_URLS_FILTER_CHARS';
DELETE FROM configuration WHERE configuration_key = 'SEO_URLS_REMOVE_CHARS';
DELETE FROM configuration WHERE configuration_key = 'SEO_URLS_FILTER_SHORT_WORDS';
DELETE FROM configuration WHERE configuration_key = 'SEO_URLS_ONLY_IN';
DELETE FROM configuration WHERE configuration_key = 'SEO_REWRITE_TYPE';
DELETE FROM configuration WHERE configuration_key = 'SEO_USE_REDIRECT';
DELETE FROM configuration WHERE configuration_key = 'SEO_USE_CACHE_GLOBAL';
DELETE FROM configuration WHERE configuration_key = 'SEO_USE_CACHE_PRODUCTS';
DELETE FROM configuration WHERE configuration_key = 'SEO_USE_CACHE_CATEGORIES';
DELETE FROM configuration WHERE configuration_key = 'SEO_USE_CACHE_MANUFACTURERS';
DELETE FROM configuration WHERE configuration_key = 'SEO_USE_CACHE_EZ_PAGES';
DELETE FROM configuration WHERE configuration_key = 'SEO_URLS_CACHE_RESET';
DELETE FROM configuration WHERE configuration_key = 'SEO_ADD_CPATH_TO_PRODUCT_URLS';
DELETE FROM configuration WHERE configuration_key = 'SEO_ADD_CAT_PARENT';
DELETE FROM configuration WHERE configuration_key = 'SEO_URLS_USE_W3C_VALID';
DELETE FROM configuration WHERE configuration_key = 'USE_SEO_CACHE_GLOBAL';
DELETE FROM configuration WHERE configuration_key = 'USE_SEO_CACHE_PRODUCTS';
DELETE FROM configuration WHERE configuration_key = 'USE_SEO_CACHE_CATEGORIES';
DELETE FROM configuration WHERE configuration_key = 'USE_SEO_CACHE_MANUFACTURERS';
DELETE FROM configuration WHERE configuration_key = 'USE_SEO_CACHE_ARTICLES';
DELETE FROM configuration WHERE configuration_key = 'USE_SEO_CACHE_INFO_PAGES';
DELETE FROM configuration WHERE configuration_key = 'USE_SEO_REDIRECT';
DELETE FROM configuration WHERE configuration_key = 'SEO_CHAR_CONVERT_SET';
DELETE FROM configuration WHERE configuration_key = 'SEO_REMOVE_ALL_SPEC_CHARS';

DELETE FROM configuration_language WHERE configuration_key = 'SEO_ENABLED';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_URL_CPATH';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_URL_END';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_URL_FORMAT';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_URL_CATEGORY_DIR';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_URLS_FILTER_PCRE';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_URLS_FILTER_CHARS';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_URLS_REMOVE_CHARS';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_URLS_FILTER_SHORT_WORDS';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_URLS_ONLY_IN';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_REWRITE_TYPE';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_USE_REDIRECT';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_USE_CACHE_GLOBAL';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_USE_CACHE_PRODUCTS';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_USE_CACHE_CATEGORIES';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_USE_CACHE_MANUFACTURERS';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_USE_CACHE_EZ_PAGES';
DELETE FROM configuration_language WHERE configuration_key = 'SEO_URLS_CACHE_RESET';

DELETE FROM admin_pages WHERE page_key='configProdUltimateSEO';
DELETE FROM admin_pages WHERE page_key='configUltimateSEO';

DROP TABLE IF EXISTS seo_cache;