## $Id$

##########################################################################################################
## rl_invoice3/1
INSERT INTO `shop_configuration_group` (`language_id`, `configuration_group_title`, `configuration_group_description`, `sort_order`, `visible`) VALUES(1, 'PDF Invoice3', 'PDF3', 726, 1);
INSERT INTO `shop_configuration_group` (`language_id`, `configuration_group_title`, `configuration_group_description`, `sort_order`, `visible`) VALUES(43, 'PDF Rechnung3', 'PDF3', 726, 1);
##
## rl_invoice3/2
INSERT INTO configuration` (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function) VALUES
('XY-position of address1 position', 'RL_INVOICE3_ADDRESS1_POS', '0|30', 'XY-position of address; its the margin delta <br />Default: 0|30', 31, 30, NULL, NULL),
('XY-position of address2 position', 'RL_INVOICE3_ADDRESS2_POS', '90|36', 'XY-position of address; its the margin delta <br />Default: 80|30', 31, 80, NULL, NULL),
('border Address1|2', 'RL_INVOICE3_ADDRESS_BORDER', 'LTRB|LTRB', 'border Address1|2: LTRB (Left Top Right Bottom)<br />', 31, 70, NULL, NULL),
('width Address1|2', 'RL_INVOICE3_ADDRESS_WIDTH', '80|60', 'width Address1|2: 60|60<br />', 31, 40, NULL, NULL),
('City ', 'RL_INVOICE3_CITY', 'Wien, am @DATE@', 'City, 27.9.2004', 31, 100, NULL, NULL),
('deltas', 'RL_INVOICE3_DELTA', '20|20', 'delta address invoice|delta invoice products: 20|30<br />', 31, 50, NULL, NULL),
('fonts for invoice|products', 'RL_INVOICE3_FONTS', 'dejavusanscondensed|freemono', 'fonts for <br />1. invoice in general <br >2. products & total-table<br />', 31, 120, NULL, NULL),
('Line Height', 'RL_INVOICE3_LINE_HEIGT', '1.25', 'Line Height', 31, 130, NULL, NULL),
('Line Total Thickness', 'RL_INVOICE3_LINE_THICK', '0.5', 'thickness off total-line', 31, 130, NULL, NULL),
('defines the margins', 'RL_INVOICE3_MARGIN', '25|10|10|20', 'defines the margines:<br />top|right|bottom|left<br />(Note: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />', 31, 20, NULL, NULL),
('Accounting for free product', 'RL_INVOICE3_NOT_NULL_INVOICE', '0', 'Accounting for free product: send e-mail invoice', 31, 130, NULL, NULL),
('send by orderstatus greater/equal than ', 'RL_INVOICE3_ORDERSTATUS', '3', 'only send invoice if orders_status greater or equal than', 31, 130, NULL, NULL),
('prefix for OrderNo', 'RL_INVOICE3_ORDER_ID_PREFIX', ': FsF/2008/', 'prefix for OrderNo<br />', 31, 110, NULL, NULL),
('Paper Size/Units/Oriantation', 'RL_INVOICE3_PAPER', 'A4|mm|P', '1. papersize = A3|A4|A5|Letter|Legal <br />2. units: pt|mm|cm|inch <br />3. Oriantation: L|P<br />', 31, 10, NULL, NULL),
('pdf background file', 'RL_INVOICE3_PDF_BACKGROUND', '/var/www/html/freitter/includes/pdf/rl_invoice3_bg.pdf', 'pdf background file: /var/www/html/freitter/includes/pdf/rl_invoice3_bg.pdf<br />', 31, 60, NULL, NULL),
('filename and path to store the pdf-file', 'RL_INVOICE3_PDF_PATH', '/var/www/html/freitter/pdf/|1', '1. path to store the pdf-file (!!must be writeable !!)<br />Default: ../pdf/|1<br />', 31, 130, NULL, NULL),
('additional attachements', 'RL_INVOICE3_SEND_ATTACH', 'agb.pdf|widerruf.pdf', 'RL_INVOICE3_SEND_PDF', 31, 130, NULL, NULL),
('[RE]send order', 'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE', '3|100', '[RE]send invoice, if orderstatus changed to', 31, 130, NULL, NULL),
('RL_INVOICE3_SEND_PDF', 'RL_INVOICE3_SEND_PDF', '1', 'RL_INVOICE3_SEND_PDF', 31, 130, NULL, NULL),
('Templates for products table & total table', 'RL_INVOICE3_TABLE_TEMPLATE', 'col_templ_1|options_templ_1|total_col_1|total_opt_1', 'templates for products_table & total_table; this is defined in rl_invoice3_def.php; see also: docs/rl_invoice/readme_ezpdf.pdf<br />', 31, 90, NULL, NULL),
('do not print invoice address', 'RL_INVOICE3_WITHOUTINVOICE', 'false', 'do not print invoice address', 31, 160, NULL, 'zen_cfg_select_option(array(''true'', ''false''), ');
##
## rl_invoice3/3
INSERT INTO `shop_configuration_language` (`configuration_title`, `configuration_key`, `configuration_language_id`, `configuration_description`) VALUES
('XY-postion der adresse1', 'RL_INVOICE3_ADDRESS1_POS', 43, 'XY-postion der adresse1; es ist das delta zu den raendern einzugeben<br />Standard: 0|30'),
('XY-postion der adresse2', 'RL_INVOICE3_ADDRESS2_POS', 43, 'XY-postion der adresse2; es ist das delta zu den raendern einzugeben<br />Standard: 0|30'),
('rändereinstellungen für adresse1|2', 'RL_INVOICE3_ADDRESS_BORDER', 43, 'rändereinstellungen für adresse1|2<br />LTRB (Left Top Right Bottom)<br />Standard: LTRB|LTRB<br />'),
('breite von adressfeld1|2', 'RL_INVOICE3_ADDRESS_WIDTH', 43, '<br />standard: 80|60'),
('Ort und Datum in der Rechnung', 'RL_INVOICE3_CITY', 43, 'Beispiel: Wien, am @DATE@ (= Wien, am 06.10.2008)<br />'),
('deltas', 'RL_INVOICE3_DELTA', 43, 'abstand adresse::rechnungsnummer | abstand rechnungsnummer:produktliste<br />Standard: 20|20<br />'),
('Schriftarten für Rechnung und Artikel', 'RL_INVOICE3_FONTS', 43, 'Welche Schriftarten wollen Sie verwenden? <br />1. Für Rechnungstexte <br >2. Für Artikel & Summe<br /><br />Standart: dejavusanscondensed|freemono<br />(Pfad/und Schriftart für Rechnung|Pfad/und Schriftart für Artikel+Summe<br />'),
('Zeilenhöhe', 'RL_INVOICE3_LINE_HEIGT', 43, 'soll Rechnung bei Gratisprodukt dem Mail hinzugefügt werden'),
('dicke der TotalStriche', 'RL_INVOICE3_LINE_THICK', 43, 'wie dick soll der Strich bei der Gesamtsumme sein'),
('Rändereinstellungen', 'RL_INVOICE3_MARGIN', 43, 'Format: oben|rechts|unten|links<br />(Hinweis: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />Standard: 30|30|30|60<br />'),
('Rechnung bei Gratisprodukt', 'RL_INVOICE3_NOT_NULL_INVOICE', 43, 'soll Rechnung bei Gratisprodukt dem Mail hinzugefügt werden'),
('Rechnungsversand bei Bestellstatus', 'RL_INVOICE3_ORDERSTATUS', 43, 'Rechnung nur mitshicken, wenn der Bestellstatus grösser/gleich ist [default: 3 == verschickt]'),
('Präfix für Rechnungsnummer in der Rechnung', 'RL_INVOICE3_ORDER_ID_PREFIX', 43, 'Präfix für Rechnungsnummer in der Rechnung<br />Beispiel: : FsF/2008/<br />'),
('papiergroesse|einheit|orientierung', 'RL_INVOICE3_PAPER', 43, '1. papiergroesse = A3|A4|A5|Letter|Legal <br />2. einheit: pt|mm|cm|inch <br />3. orientierung: L|P<br />'),
('pdf hintergrunddatei', 'RL_INVOICE3_PDF_BACKGROUND', 43, 'pdf hintergrunddatei<br />Standard: /var/www/html/freitter/includes/pdf/rl_invoice3_bg.pdf<br />'),
('Speicherort und -Name der PDF-Datei', 'RL_INVOICE3_PDF_PATH', 43, '1. Wo sollen PDF-Dateien gespeichert werden (!! muss beschreibbar sein !!)?<br />2. speichern ja|nein (1|0)<br />Standard: /var/www/html/freitter/includes/pdf/|1<br />'),
('Anhänge', 'RL_INVOICE3_SEND_ATTACH', 43, 'welche PDFs sollen noch angehängt werden; bei mehreren dateien | (pipe) als trenner verwenden)'),
('Rechnungsneuversand', 'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE', 43, 'bei welcher Änderung des Bestellstatus soll die Rechnung [nochmals] versendet werden'),
('Rechnung bei Bestellung', 'RL_INVOICE3_SEND_PDF', 43, 'soll Rechnung bei Bestellung gesendet werden'),
('Template für Artikel- und Summentabelle', 'RL_INVOICE3_TABLE_TEMPLATE', 43, 'Template für Artikel- und Summentabelle<br />Definition ist in rl_invoice3_def.php<br />Standard: 30|30|30|60<br />Standard: col_templ_1|options_templ_1|total_col_1|total_opt_1<br />'),
('Rechnungsadresse nicht drucken', 'RL_INVOICE3_WITHOUTINVOICE', 43, 'Rechnungsadresse nicht drucken');



##########################################################################################################