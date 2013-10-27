###############################################################################################
# Ultimate SEO URL 2.3 Multilanguage Install 1.5.1 - 2013-10-27 - webchills
###############################################################################################


INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('Ultimate SEO URLs 2.3', 'Configure Ultimate SEO URL', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
('SEO enabled?', 'SEO_ENABLED', 'false', 'This is a global setting and can be used to enable or disable this module completely.', @gid, 1, NOW(),  NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('Generate cPath parameters', 'SEO_URL_CPATH', 'auto', 'By default Zen Cart generates a cPath parameter for product pages. These are used to keep linked products in the correct category. In automatic mode the cPath is removed only if not needed.', @gid, 2, NOW() , 'usu_check_cpath_option', 'zen_cfg_select_option(array(''enable-auto'', ''disable''),'),
('Rewritten URLs end with', 'SEO_URL_END', '.html', 'If you want your rewritten URLs to end with a certain suffix add one here. Common suffixes are \'.html\', \'.htm\', or leaving this field blank.', @gid, 3, NOW(),  NULL, NULL),
('Format of rewritten URLs', 'SEO_URL_FORMAT', 'original', 'You can select from a list of commonly generated formats.<br /><b>Original:</b><br /><i>Categories:</i> category-name-c-34<br /><i>Products:</i> product-name-p-54<br /><br /><b>Category Parent:</b><br /><i>Categories:</i> parent-category-name-c-34<br /><i>Products:</i> parent-product-name-p-54', @gid, 4, NOW(), 'usu_check_url_format_option', 'zen_cfg_select_option(array(''enable-original'', ''enable-parent''),'),
('Categories as directories', 'SEO_URL_CATEGORY_DIR', 'short', 'You can select from a list of commonly generated formats.<br /><b>Off:</b> disables displaying categories as directories<br /><br /><b>Short:</b> use the settings from \'Format of rewritten URLs\'<b>Full:</b> uses full category paths<br /><br />', @gid, 5, NOW(), 'usu_check_category_dir_option', 'zen_cfg_select_option(array(''disable'', ''enable-short'', ''enable-full''),'),
('Enter PCRE filter rules for generated URLs', 'SEO_URLS_FILTER_PCRE', 'ä=>ae,ö=>oe,ü=>ue,ß=>ss,é=>e,Ö=>Oe,Ä=>ae,Ü=>Ue,è=>e', 'This setting uses PCRE rules to filter generated urls.<br><br>The format <b>MUST</b> be in the form: <b>find1=>replace1,find2=>replace2</b>. This filter is run before character conversions and stripping of special characters. If you want a dash - in your URLS, use a single space. Also note you must double escape back slashes.', @gid, 6, NOW(),  NULL, NULL),
('Enter special character conversions', 'SEO_URLS_FILTER_CHARS', '', 'This setting will replace a single byte character with another single byte character.<br><br>The format <b>MUST</b> be in the form: <b>char=>conv,char2=>conv2</b>', @gid, 7, NOW(), NULL, NULL),
('Remove these characters from URLs', 'SEO_URLS_REMOVE_CHARS', 'punctuation', 'This allows you remove certain problematic characters from the generated URLs.<br /><br /><i>non-alphanumerical:</i> removes all non-alphanumerical characters<br /><i>punctuation:</i> removes all punctuation characters', @gid, 8, NOW(), 'usu_check_remove_chars_option', 'zen_cfg_select_option(array(''enable-non-alphanumerical'', ''enable-punctuation''),'),
('Filter Short Words', 'SEO_URLS_FILTER_SHORT_WORDS', '0', 'This setting will filter words less than or equal to the value from the URL.', @gid, 9, NOW(),  NULL, NULL),
('Enter pages to allow rewrite', 'SEO_URLS_ONLY_IN', 'index, product_info, product_music_info, document_general_info, document_product_info, product_free_shipping_info, products_new, products_all, shopping_cart, featured_products, specials, contact_us, conditions, privacy, reviews, shippinginfo, impressum, widerrufsrecht, faqs_all, site_map, gv_faq, discount_coupon, page, page_2, page_3, page_4', 'You can limit the pages which will be rewritten by specifying them here. If no pages are specified all pages will be rewritten. <br><br>The format is comma delimited and <b>MUST</b> be in the form: <b>page1,page2,page3</b> or <b>page1, page2, page3</b>', @gid, 10, NOW(), NULL, NULL),
('Choose URL Rewrite Engine', 'SEO_REWRITE_TYPE', 'rewrite', 'Choose which URL Rewrite Engine to use.', @gid, 11, NOW(), NULL, 'zen_cfg_select_option(array(''rewrite'',),'),
('Enable automatic redirects?', 'SEO_USE_REDIRECT', 'false', 'This will activate the automatic redirect code and send 301 headers for old to new URLs.', @gid, 12, NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
('Enable SEO cache to save queries?', 'SEO_USE_CACHE_GLOBAL', 'true', 'This is a global setting and will turn off caching completely.', @gid, 13, NOW(), 'usu_check_cache_options',   'zen_cfg_select_option(array(''enable'', ''disable''),'),
('Enable product cache?', 'SEO_USE_CACHE_PRODUCTS', 'true', 'This will turn off caching for the products.', @gid, 14, NOW(), 'usu_check_cache_options',  'zen_cfg_select_option(array(''enable-products'', ''disable-products''),'),
('Enable categories cache?', 'SEO_USE_CACHE_CATEGORIES', 'true', 'This will turn off caching for the categories.', @gid, 15, NOW(), 'usu_check_cache_options', 'zen_cfg_select_option(array(''enable-categories'', ''disable-categories''),'),
('Enable manufacturers cache?', 'SEO_USE_CACHE_MANUFACTURERS', 'true', 'This will turn off caching for the manufacturers.', @gid, 16, NOW(), 'usu_check_cache_options', 'zen_cfg_select_option(array(''enable-manufacturers'', ''disable-manufacturers''),'),
('Enable ez pages cache?', 'SEO_USE_CACHE_EZ_PAGES', 'true', 'This will turn off caching for ez pages.', @gid, 17, NOW(),  'usu_check_cache_options', 'zen_cfg_select_option(array(''enable-ez_pages'', ''disable-ez_pages''),'),
('Reset SEO URLs Cache', 'SEO_URLS_CACHE_RESET', 'false', 'This will reset the cache data for SEO', @gid, 18, NOW(),  'usu_reset_cache_data', 'zen_cfg_select_option(array(''true'', ''false''),');


##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Ultimate SEO URLs 2.3', 'Konfiguration von Ultimate SEO URL', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Ultimate SEO aktivieren?', 'SEO_ENABLED', 'Dies ist der Hauptschalter, um das Modul aus- und einzuschalten', 43),
('cPath anhängen', 'SEO_URL_CPATH', 'Zen Cart hängt an Artikel den cPath an (Kategorie ID), damit sichergestellt ist, dass verlinkte Artikel in der korrekten Kategorie erscheinen. Im Modus auto wird der cPath entfernt, falls er nicht nötig ist', 43),
('Endung der SEO URLs', 'SEO_URL_END', 'URLs können auf .html enden oder auf .htm. Wenn Sie gar keine Endung wollen, Feld leer lassen', 43),
('Format der SEO URLs', 'SEO_URL_FORMAT', 'Sie können aus folgenden voreingestellten Formaten wählen.<br /><b>Original:</b><br /><i>Kategorien:</i> kategoriename-c-34<br /><i>Artikel:</i> artikelname-p-54<br /><br /><b>Parent:</b><br /><i>Kategorien:</i> oberkategorie-kategorie-name-c-34<br /><i>Artikel:</i> oberkategorie-artikelname-p-54', 43),
('Kategorien als Verzeichnisse', 'SEO_URL_CATEGORY_DIR', 'Sie können aus folgenden voreingestellten Formaten wählen:<br /><br/><b>Off/Disable:</b> Kategorien werden nicht als Verzeichnisse dargestellt<br /><br /><b>Short:</b> Verwendet die Einstellung unter Format der SEO URLs<br/><br/><b>Full:</b> Verwendet den kompletten Kategoriepfad<br /><br />', 43),
('Umlaute umschreiben', 'SEO_URLS_FILTER_PCRE', 'Die gängigen Umlaute sind bereits voreingestellt. Diese Umschreibungen greifen bevor irgendetwas anderes umgeschrieben oder gefiltert wird. Wenn Sie die Liste ergänzen wollen, <b>MUSS</b> das Format so sein:<br/><b>find1=>replace1,find2=>replace2</b>', 43),
('Sonderzeichen umschreiben', 'SEO_URLS_FILTER_CHARS', 'Hier können zusätzlich 1Byte Zeichen umgeschrieben werden.<br><br>Das Format <b>MUSS</b> sein: <b>char=>conv,char2=>conv2</b>', 43),
('Zeichen aus URL entfernen', 'SEO_URLS_REMOVE_CHARS', 'Hiermit können bestimmte problematische Zeichen aus den URLs entfernt werden.<br/><br/>non-alphanumerical: entfernt alle nicht alphanumerischen Zeichen<br/><br/>punctuation: entfernt Punkte', 43),
('Kurze Worte ausfiltern', 'SEO_URLS_FILTER_SHORT_WORDS', 'Mit dieser Einstellung werden Worte kürzer als der hier eingestellte Wert aus den URLs entfernt.', 43),
('Seiten, die umgeschrieben werden sollen', 'SEO_URLS_ONLY_IN', 'Geben Sie hier die Seiten an, die umgeschrieben werden sollen. Es sind bereits alle nötigen voreingestellt. Wenn Sie z.B. eigene neue Define Pages anlegen, und auch die umschreiben wollen, dann müssen sie die hier ergänzen. Wird hier alles rausgelöscht, dann werden alle Seiten umgeschrieben.', 43),
('Umschreibungsart', 'SEO_REWRITE_TYPE', 'Derzeit wird nur mod_rewrite unterstützt.', 43),
('Automatische Redirects?', 'SEO_USE_REDIRECT', 'Veraltete/Umbenannte URLs werden per 301 Redirect automatisch auf die neuen URLs weitergeleitet', 43),
('SEO URL Cache aktivieren?', 'SEO_USE_CACHE_GLOBAL', 'Um Datenbankabfragen zu reduzieren, können die SEO URLs in der Tabelle seo_cache gespeichert werden und müssen dann nicht bei jedem Aufruf neu generiert werden. Wenn Sie dieses Feature nutzen wollen, stellen Sie hier auf true. Bitte beachten Sie, dass Sie bei Änderungen an der URL-Struktur dann immer den Cache zurücksetzen müssen!', 43),
('Cache für Artikel aktivieren?', 'SEO_USE_CACHE_PRODUCTS', 'Caching für Artikel', 43),
('Cache für Kategorien aktivieren?', 'SEO_USE_CACHE_CATEGORIES', 'Caching für Kategorien', 43),
('Cache für Hersteller aktivieren?', 'SEO_USE_CACHE_MANUFACTURERS', 'Caching für Hersteller', 43),
('Cache für EZ Pages aktivieren?', 'SEO_USE_CACHE_EZ_PAGES', 'Caching für EZ Pages', 43),
('Cache zurücksetzen', 'SEO_URLS_CACHE_RESET', 'Hiermit leeren Sie die Tabelle seo_cache', 43);



###################################
# Register for Admin Access Control
###################################


INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configUltimateSEO','BOX_CONFIGURATION_USU','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);


###################################
# Create new table
###################################

CREATE TABLE IF NOT EXISTS `seo_cache` (
  `cache_id` VARCHAR(32) NOT NULL default '',
  `cache_language_id` TINYINT(1) NOT NULL default '0',
  `cache_name` VARCHAR(255) NOT NULL default '',
	`cache_data` MEDIUMTEXT NOT NULL,
	`cache_global` TINYINT(1) NOT NULL default '1',
	`cache_gzip` TINYINT(1) NOT NULL default '1', 
	`cache_method` VARCHAR(20) NOT NULL default 'RETURN', 
	`cache_date` DATETIME NOT NULL default '0000-00-00 00:00:00', 
	`cache_expires` DATETIME NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`cache_id`,`cache_language_id`),
	KEY `cache_id` (`cache_id`), 
KEY `cache_language_id` (`cache_language_id`),
KEY `cache_global` (`cache_global`)
) ;

