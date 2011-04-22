################################################################################
# Google Merchant Center Deutschland 2.0 German Install - 2011-04-22 - webchills
################################################################################

SET @configuration_group_id=0;
SELECT (@configuration_group_id:=configuration_group_id) 
FROM configuration_group 
WHERE configuration_group_title= 'Google Merchant Center Deutschland' 
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @configuration_group_id AND @configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @configuration_group_id AND @configuration_group_id != 0;

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (NULL, '43', 'Google Merchant Center Deutschland', 'Einstellungen für das Google Merchant Center Deutschland', '1', '1');
SET @configuration_group_id=last_insert_id();
UPDATE configuration_group SET sort_order = @configuration_group_id WHERE configuration_group_id = @configuration_group_id;

INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
(NULL, 'URL des Shops', 'GOOGLE_MCDE_ADDRESS', 'http://www.meinshop.de', 'Geben Sie die URL Ihres Shops ein', @configuration_group_id, 1, NOW(), NULL, NULL),
(NULL, 'Kurzbeschreibung Ihres Shops', 'GOOGLE_MCDE_DESCRIPTION', '', 'Geben Sie eine kurze Beschreibung Ihres Shops ein', @configuration_group_id, 2, NOW(), NULL, NULL),
(NULL, 'Google Merchant Center FTP Username', 'GOOGLE_MCDE_USERNAME', 'ftp_username', 'Geben Sie Ihren Google Merchant Center FTP Usernamen ein.', @configuration_group_id, 3, NOW(), NULL, NULL),
(NULL, 'Google Merchant Center FTP Passwort', 'GOOGLE_MCDE_PASSWORD', 'ftp_password', 'Gebne Sie Ihr Google Merchant Center FTP Passwort ein.', @configuration_group_id, 4, NOW(), NULL, NULL),
(NULL, 'Google Merchant Center Server', 'GOOGLE_MCDE_SERVER', 'uploads.google.com', 'Geben Sie den Namen der Google Merchant Center FTP Servers ein.<br />Voreinstellung: uploads.google.com', @configuration_group_id, 5, NOW(), NULL, NULL),
(NULL, 'Dateiname des Produktfeeds', 'GOOGLE_MCDE_OUTPUT_FILENAME', 'meinshop', 'Geben Sie den gewünschten Dateinamen für das Produktfeed an. Wird dann ergänzt mit _products.xml', @configuration_group_id, 6, NOW(), NULL, NULL),
(NULL, 'Produktfeeddatei komprimieren', 'GOOGLE_MCDE_COMPRESS', 'false', 'Produktfeed komrimieren?<br/>Voreinstellung: false', @configuration_group_id, 7, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'EAN im Produktfeed', 'GOOGLE_MCDE_EAN', 'false', 'Soll die EAN ins Produktfeed aufgenommen werden?<br/>Eigenes Feld für die EAN in der Tabelle products erforderlich!', @configuration_group_id, 8, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Marke im Produktfeed', 'GOOGLE_MCDE_BRAND', 'false', 'Soll die Marke ins Produktfeed aufgenommen werden?<br/>Eigenes Feld für die EAN in der Tabelle products erforderlich!', @configuration_group_id, 9, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'ISBN im Produktfeed', 'GOOGLE_MCDE_ISBN', 'false', 'Soll die ISBN ins Produktfeed aufgenommen werden?<br/>Eigenes Feld für die ISBN in der Tabelle products erforderlich!', @configuration_group_id, 10, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Online Only im Produktfeed', 'GOOGLE_MCDE_ONLINE_ONLY', 'false', 'Soll den Artikeln das Attribut Online Only zugeordnet werden?<br/>Nur auf yes stellen, falls alle Ihre Artikel nur online bestellbar sind und nicht vor Ort in Ihrem Ladenlokal erworben können!', @configuration_group_id, 11, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Ablaufdatum Basiseinstellung', 'GOOGLE_MCDE_EXPIRATION_BASE', 'now', 'Wovon soll das Ablaufdatum ausgehen?:<ul><li>now - vom jetzigen Datum;</li><li>product - vom beim Artikel hinterlegten Datum</li></ul>', @configuration_group_id, 12, NOW(), NULL, 'zen_cfg_select_option(array(\'now\', \'product\'),'),
(NULL, 'Ablaufdatum in Tagen', 'GOOGLE_MCDE_EXPIRATION_DAYS', '20', 'Wieviel Tage sollen beim Ablaufdatum hinzugezählt werden?<br/>Voreinstellung: 20', @configuration_group_id, 13, NOW(), NULL, NULL),
(NULL, 'Währung aufnehmen', 'GOOGLE_MCDE_CURRENCY_DISPLAY', 'true', 'Soll die Währung ins Produktfeed übernommen werden?', @configuration_group_id, 14, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Währung', 'GOOGLE_MCDE_CURRENCY', 'EUR', 'Welche Währung soll Ihr Produktfeed haben? Euro oder Dollar?<br/<Voreingestellt: EUR', @configuration_group_id, 15, NOW(), NULL, 'zen_cfg_select_option(array(\'EUR\', \'USD\'),'),
(NULL, 'Offer ID', 'GOOGLE_MCDE_OFFER_ID', 'id', 'Eine eindeutige ID für jeden Artikel<br/>die Produkt ID aus Zen-Cart', @configuration_group_id, 16, NOW(), NULL, 'zen_cfg_select_option(array(\'id\'),'),
(NULL, 'Menge im Produktfeed', 'GOOGLE_MCDE_IN_STOCK', 'false', 'Soll der Lagerbestand der Artikel ins Produktfeed übernommen werden?', @configuration_group_id, 17, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Artikel mit Menge Null aufnehmen', 'GOOGLE_MCDE_ZERO_QUANTITY', 'false', 'Sollen Artikel aufgenommen werden, deren Lagerbestand Null ist?', @configuration_group_id, 18, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Menge Voreinstellung', 'GOOGLE_MCDE_DEFAULT_QUANTITY', '0', 'Welche Mengenangabe wollen Sie für Artikel mit Lagerbestand Null?', @configuration_group_id, 19, NOW(), NULL, NULL), 
(NULL, 'Datum des Uploads', 'GOOGLE_MCDE_UPLOADED_DATE', '', 'Datum und Uhrzeit des letzen Uploads', @configuration_group_id, 20, NOW(), NULL, NULL),
(NULL, 'Verzeichnis des Produktfeeds', 'GOOGLE_MCDE_DIRECTORY', 'feed/googlemcde/', 'Geben Sie hier das Verzeichnis an, in dem das Produktfeed gespeichert werden soll.', @configuration_group_id, 21, NOW(), NULL, NULL),
(NULL, 'cPath in der URL verwenden', 'GOOGLE_MCDE_USE_CPATH', 'false', 'Sollen die Artikel URLs den cPath enthalten?', @configuration_group_id, 22, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Maximale Artikelanzahl', 'GOOGLE_MCDE_MAX_PRODUCTS', '0', 'Voreinstellung = 0 für unbegrenzte Artikelanzahl', @configuration_group_id, 23, NOW(), NULL, NULL),
(NULL, 'Startpunkt', 'GOOGLE_MCDE_START_PRODUCTS', '0', 'Soll erst ab einem bestimmten Eintrag gestartet werden (dies ist NICHT die Artikel ID, es geht hier darum die Zahl der Artikel zu begrenzen)<br />Voreinstellung=0', @configuration_group_id, 24, NOW(), NULL, NULL),
(NULL, 'Enthaltene Kategorien', 'GOOGLE_MCDE_POS_CATEGORIES', '', 'Geben Sie die Kategorienummern an, die enthalten sein sollen, durch Komma getrennt (z.B. 1,2,3)<br>Leer lassen, um alle Kategorien aufzunehmen (empfohlen)', @configuration_group_id, 25, NOW(), NULL, NULL),
(NULL, 'Ausgeschlossene Kategorien', 'GOOGLE_MCDE_NEG_CATEGORIES', '', 'Geben Sie die Kategorienummern an, die ausgeschlossen werden sollen durch Komma getrennt (z.B. 1,2,3)<br>Leer lassen, um alle Kategorien aufzunehmen (empfohlen)', @configuration_group_id, 26, NOW(), NULL, NULL),
(NULL, 'Gewicht im Produktfeed', 'GOOGLE_MCDE_SHIPPINGWEIGHT', 'false', 'Soll das beim Artikel hinterlegte Versandgewicht ins Produktfeed übernommen werden?', @configuration_group_id, 27, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Masseinheit Gewicht', 'GOOGLE_MCDE_UNITS', 'Kilogramm', 'In welcher Einheit geben Sie das Gewicht an?<br />Kilogramm oder Pounds', @configuration_group_id, 28, NOW(), NULL, 'zen_cfg_select_option(array(\'Kilogramm\', \'Pfund\'),'),
(NULL, 'Artikeltyp', 'GOOGLE_MCDE_PRODUCT_TYPE', 'top', 'Top-Level, Bottom-Level, oder Full-Path<br/>Sollte auf top gelassen werden', @configuration_group_id, 29, NOW(), NULL, 'zen_cfg_select_option(array(\'top\', \'bottom\', \'full\'),'),
(NULL, 'Alternative Bild URL', 'GOOGLE_MCDE_ALTERNATE_IMAGE_URL', '', 'Falls Ihre Artikelbilder woanders gehostet werden, geben Sie hier die alternative URL zu den Bildern an (z.B.. http://www.domain.com/images/).  Die Bilddatei wird dann ans Ende dieses speziellen Links angehängt.', @configuration_group_id, 30, NOW(), NULL, NULL),
(NULL, 'Image Handler', 'GOOGLE_MCDE_IMAGE_HANDLER', 'false', 'Bilder per Image Handler verkleinern? Nur auf true stellen, falls Sie das Modul Image Handler im Einsatz haben!', @configuration_group_id, 31, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Metatag Titel verwenden', 'GOOGLE_MCDE_META_TITLE', 'false', 'Soll als Artikelname der in den Metatags angegebene Titel verwendet werden?', @configuration_group_id, 32, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Debug', 'GOOGLE_MCDE_DEBUG', 'false', 'Debug Modus aktivieren? Beim Erstellen des Feeds werden dann Zusatzinfos angezeigt. Nur für Fehlersuche interessant.', @configuration_group_id, 33, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Sprache des Feeds', 'GOOGLE_MCDE_LANGUAGE', 'Deutsch', 'Sprache für das Artikelfeed. Nicht ändern! Nur falls in Ihrer Tabelle languages der Name für Deutsch anders lauten sollte!', @configuration_group_id, 34, NOW(), NULL, NULL);