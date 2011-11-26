#####################################################################
# RSS Feed 2.1.5 Multilanguage Install 1.5 - 2011-09-07 - webchills
#####################################################################


INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('RSS Feed', 'RSS Feed Configuration', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('RSS Title', 'RSS_TITLE', '', 'RSS Title (if empty use Store Name)', @gid, 1, NOW(), NOW(), NULL, NULL),
('RSS Description', 'RSS_DESCRIPTION', '', 'RSS description', @gid, 2, NOW(), NOW(), NULL, NULL),
('RSS Image', 'RSS_IMAGE', '', 'A GIF, JPEG or PNG image that represents the channel', @gid, 3, NOW(), NOW(), NULL, NULL),
('RSS Image Name', 'RSS_IMAGE_NAME', '', 'RSS Image Name (if empty use Store Name)', @gid, 4, NOW(), NOW(), NULL, NULL),
('RSS Copyright', 'RSS_COPYRIGHT', '', 'RSS Copyright (if empty use Store Owner)', @gid, 5, NOW(), NOW(), NULL, NULL),
('RSS Managing Editor', 'RSS_MANAGING_EDITOR', '', 'RSS Managing Editor (if empty use Store Owner Email Address and Store Owner)', @gid, 6, NOW(), NOW(), NULL, NULL),
('RSS Webmaster', 'RSS_WEBMASTER', '', 'RSS Webmaster (if empty use Store Owner Email Address and Store Owner)', @gid, 7, NOW(), NOW(), NULL, NULL),
('RSS Author', 'RSS_AUTHOR', '', 'RSS Author (if empty use Store Owner Email Address and Store Owner)', @gid, 8, NOW(), NOW(), NULL, NULL),
('RSS Home Page Feed', 'RSS_HOMEPAGE_FEED', 'new_products', 'RSS Home Page Feed', @gid, 8, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'news\', \'new_products\', \'upcoming\', \'featured\', \'specials\', \'products\', \'categories\'),'),
('RSS Default Feed', 'RSS_DEFAULT_FEED', 'new_products', 'RSS Default Feed', @gid, 10, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'news\', \'new_products\', \'upcoming\', \'featured\', \'specials\', \'products\', \'categories\'),'),
('Strip tags', 'RSS_STRIP_TAGS', 'false', 'Strip tags', @gid, 11, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Descriptions', 'RSS_ITEMS_DESCRIPTION', 'true', 'Generate Descriptions', @gid, 12, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Descriptions Length', 'RSS_ITEMS_DESCRIPTION_MAX_LENGTH', '0', 'How many characters in description (0 for no limit)', @gid, 13, NOW(), NOW(), NULL, NULL),
('Time to live', 'RSS_TTL', '1440', 'Time to live - time after reader should refresh the info in minutes', @gid, 14, NOW(), NOW(), NULL, NULL),
('Default Products Limit', 'RSS_PRODUCTS_LIMIT', '100', 'Default Limit to Products Feed', @gid, 15, NOW(), NOW(), NULL, NULL),
('Add Product image', 'RSS_PRODUCTS_DESCRIPTION_IMAGE', 'true', 'Add product image to product description tag', @gid, 16, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Add "buy now" button', 'RSS_PRODUCTS_DESCRIPTION_BUYNOW', 'true', 'Add "buy now" button to product description tag', @gid, 17, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Categories for Products', 'RSS_PRODUCTS_CATEGORIES', 'master', 'Use \'all\' or only \'master\' Categories for Products when specified cPath parameter', @gid, 18, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'master\', \'all\'),'),
('Generate Products Price', 'RSS_PRODUCTS_PRICE', 'true', 'Generate Products Price (extended tag &lt;g:price&gt;)', @gid, 19, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Products ID', 'RSS_PRODUCTS_ID', 'true', 'Generate Products ID (extended tag &lt;g:id&gt;)', @gid, 20, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Products Weight', 'RSS_PRODUCTS_WEIGHT', 'true', 'Generate Products Weight (extended tag &lt;g:weight&gt;)', @gid, 21, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Products Brand', 'RSS_PRODUCTS_BRAND', 'true', 'Generate Products Manufacturers Name (extended tag &lt;g:brand&gt;)', @gid, 22, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Products Currency', 'RSS_PRODUCTS_CURRENCY', 'true', 'Generate Products Currency (extended tag &lt;g:currency&gt;)', @gid, 23, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Products Quantity', 'RSS_PRODUCTS_QUANTITY', 'true', 'Generate Products Quantity (extended tag &lt;g:quantity&gt;)', @gid, 24, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Products Model', 'RSS_PRODUCTS_MODEL', 'true', 'Generate Products Model (extended tag &lt;g:model_number&gt;)', @gid, 25, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Products Rating', 'RSS_PRODUCTS_RATING', 'true', 'Generate Products Rating (extended tag &lt;g:rating&gt;)', @gid, 26, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Products Images', 'RSS_PRODUCTS_IMAGES', 'true', 'Generate Products Images (extended tag &lt;g:image_link&gt;)', @gid, 27, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Products Images Size', 'RSS_DEFAULT_IMAGE_SIZE', 'large', 'What image size Generate (extended tag &lt;g:image_link&gt;)', @gid, 28, NOW(), NOW(),  NULL, 'zen_cfg_select_option(array(\'small\', \'medium\', \'large\'),'),
('Feed Cache', 'RSS_CACHE_TIME', 'false', 'Cache Feeds in the cache folfer. If you don\'t want caching, set it to false', @gid, 29, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');

##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'RSS Feed', 'RSS Feed Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('RSS - Titel', 'RSS_TITLE', 'RSS Titel (falls leer verwende den Shopnamen)', 43),
('RSS - Beschreibung', 'RSS_DESCRIPTION', 'RSS Beschreibung', 43),
('RSS - Bild', 'RSS_IMAGE', 'ein GIF, JPEG oder PNG Bild, das das RSS Feed illustriert', 43),
('RSS - Bild Name', 'RSS_IMAGE_NAME', 'RSS Bild Name (falls leer verwende den Shopnamen)', 43),
('RSS - Copyright', 'RSS_COPYRIGHT', 'RSS Copyright (falls leer verwende den Shopinhaber)', 43),
('RSS - Editor', 'RSS_MANAGING_EDITOR', 'RSS Managing Editor (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', 43),
('RSS - Webmaster', 'RSS_WEBMASTER', 'RSS Webmaster (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', 43),
('RSS - Author', 'RSS_AUTHOR', 'RSS Autor (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', 43),
('RSS - Home Page Feed', 'RSS_HOMEPAGE_FEED', 'RSS Home Page Feed - Standardwert Neue Artikel', 43),
('RSS - Default Feed', 'RSS_DEFAULT_FEED', 'RSS Default Feed - Standarwert Neue Artikel', 43),
('RSS - HTML Tags ausfiltern', 'RSS_STRIP_TAGS', 'HTML Tags ausfiltern? Standardwert: false', 43),
('RSS - Erzeuge Beschreibung', 'RSS_ITEMS_DESCRIPTION', 'Soll die Artikelbeschreibung im Feed erscheinen?', 43),
('RSS - Länge der Beschreibung', 'RSS_ITEMS_DESCRIPTION_MAX_LENGTH', 'Wollen Sie den Beschreibungstext auf eine bestimmte Länge beschränken? (0 für kein Limit)',43),
('RSS - Lebensdauer des Feeds', 'RSS_TTL', 'Lebensdauer - Zeit in Minuten nach der ein RSS Reader das Feed refreshen soll - Standardwert: 1440', 43),
('RSS - Standard Artikel Limit', 'RSS_PRODUCTS_LIMIT', 'Wieviele Artikel soll das RSS Feed enthalten? Standardwert: 100', 43),
('RSS - Füge Artikelbild hinzu', 'RSS_PRODUCTS_DESCRIPTION_IMAGE', 'Soll das Artikelbild im Feed erscheinen?', 43),
('RSS - Füge Jetzt kaufen Button hinzu', 'RSS_PRODUCTS_DESCRIPTION_BUYNOW', 'Soll der Jetzt kaufen Button im Feed erscheinen?', 43),
('RSS - Kategorien für Artikel', 'RSS_PRODUCTS_CATEGORIES', 'Wenn ein cPath mit angegeben wird, sollen die Artikel, dann nur aus der Masterkategorie kommen oder aus allen Kategorien? (wichtig bei verlinkten Artikeln)', 43),
('RSS - Generiere Artikelpreis', 'RSS_PRODUCTS_PRICE', 'Artikelpreis generieren? (extended tag &lt;g:price&gt;)', 43),
('RSS - Generiere Artikelkennung', 'RSS_PRODUCTS_ID', 'Artikel ID generieren? (erweiterter Tag &lt;g:id&gt;)', 43),
('RSS - Generiere Artikelgewicht', 'RSS_PRODUCTS_WEIGHT', 'Artikelgewicht generieren? (erweiterter Tag &lt;g:weight&gt;)', 43),
('RSS - Generiere Artikelhersteller', 'RSS_PRODUCTS_BRAND', 'Herstellernamen generieren? (erweiterter Tag &lt;g:brand&gt;)', 43),
('RSS - Generiere Artikelwährung', 'RSS_PRODUCTS_CURRENCY', 'Währung des Artikels generieren? (erweiterter Tag &lt;g:currency&gt;)', 43),
('RSS - Generiere Artikelanzahl', 'RSS_PRODUCTS_QUANTITY', 'Mengenangabe generieren? (erweiterter Tag &lt;g:quantity&gt;)', 43),
('RSS - Generiere Artikelnummer', 'RSS_PRODUCTS_MODEL', 'Artikelnummer generieren? (erweiterter Tag &lt;g:model_number&gt;)', 43),
('RSS - Generiere Artikelbewertung', 'RSS_PRODUCTS_RATING', 'Artikelbewertung generieren? (erweiterter Tag &lt;g:rating&gt;)', 43),
('RSS - Generiere Artikelbilder', 'RSS_PRODUCTS_IMAGES', 'Artikelbilder generieren? (erweiterter Tag &lt;g:image_link&gt;)', 43),
('RSS - Bildgröße der Artikelbilder', 'RSS_DEFAULT_IMAGE_SIZE', 'Welche Bildgröße wird verwendet - Voreinstellung: large (erweiterter Tag &lt;g:image_link&gt;)', 43),
('RSS - Cache', 'RSS_CACHE_TIME', 'Feed Cache aktivieren (es werden Feed Files im cache Ordner abgelegt). Wenn Sie kein Caching verwenden wollen stellen Sie auf false', 43);

###################################
# Register for Admin Access Control
###################################

INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configProdRSSFeed','BOX_CONFIGURATION_PRODUCT_RSSFEED','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);