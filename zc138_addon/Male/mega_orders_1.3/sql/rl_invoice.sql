# config-params for rl_invoice // 20041227-0.4
#
# if you have an other prefix-defined ==> change configuration to the right tablename


DELETE FROM configuration WHERE  configuration_key LIKE 'RL_INVOICE_%';
DELETE FROM configuration_language WHERE  configuration_key LIKE 'RL_INVOICE_%';

############################################################
# for admin => tools => install sql patches; inserts automaticaly the table_prefx
############################################################
INSERT INTO configuration_group VALUES ('725', '1', 'PDF Invoice', 'PDF', '725', '1');
INSERT INTO configuration_group VALUES ('725', '43', 'PDF Rechnung', 'PDF', '725', '1');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Invoice Header logo', 'RL_INVOICE_LOGO_SHOP_IMAGE', 'logo_shop2.jpg', 'Invoice Header logo<br />Example: admin/images/logo_shop2.jpg', 725, 4010, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL),
('defines the margins', 'RL_INVOICE_MARGIN', '30|30|30|60', 'defines the margines:<br />top|right|bottom|left<br />(Note: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />', 725, 4020, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL),
('Paper Size/Oriantation', 'RL_INVOICE_PAPER', 'A4|portrait', '1. papersize = all iso-defined (A4, A5,..) + us (legal, ...) see documentaion for reference 2. portrait OR landscape<br />', 725, 4030, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL),
('Templates for products table & total table', 'RL_INVOICE_TABLE_TEMPLATE', 'col_templ_1|options_templ_1|total_col_1|total_opt_1', 'templates for products_table & total_table; this is defined in rl_invoice_def.php; see also: docs/rl_invoice/readme_ezpdf.pdf<br />', 725, 4040, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL),
('Invoice Store Row 1', 'RL_INVOICE_ROW1', 'Das ist ein Beispieltext der ersten Zeile unter dem Logo|8', '1st Row after Logo<br />text|fontSize|x|y<br />', 725, 4050, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, 'zen_cfg_textarea('),
('Invoice Store Row 2', 'RL_INVOICE_ROW2', 'Das ist ein Beispieltext der zweiten Zeile unter dem Logo|8', '2nd Row after Logo<br />text|fontSize|x|y<br />', 725, 4060, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, 'zen_cfg_textarea('),
('Invoice Store Row 3', 'RL_INVOICE_ROW3', 'Das ist ein Beispieltext der dritten Kopfzeile|14|168|734', '3rd Row after Logo<br />text|fontSize|x|y<br />', 725, 4070, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, 'zen_cfg_textarea('),
('Y-position of first line after address', 'RL_INVOICE_ADDRESS_AFTER', '216|30', 'first value: y-absolute position<br />sec value: min delta; if y-pos + delta < y-pos<br />', 725, 4080, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL),
('Y-position of address position', 'RL_INVOICE_ADDRESS_TOP', '144', 'Y-position of address position<br />Default: 144 = 2inch', 725, 4090, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL),
('City ', 'RL_INVOICE_CITY', 'Wien, am @DATE@', 'City, 27.9.2004', 725, 4100, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL),
('invoice footer', 'RL_INVOICE_FOOTER', 'Alle Waren bleiben bis zur vollständigen Bezahlung Eigentum der Fa. FiloSoFisch. Bankverbindung: BankAustria-Creditanstalt: BLZ 12000, KtoNr: 52014 127 901 UID: ATU55705801|8|#|25<br />', 'last invoice-line', 725, 4110, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, 'zen_cfg_textarea('),
('prefix for OrderNo', 'RL_INVOICE_ORDER_ID_PREFIX', ': FsF/2004/', 'prefix for OrderNo<br />', 725, 4120, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL),
('fonts for invoice|products', 'RL_INVOICE_FONTS', '../fonts/arial.afm|../fonts/Courier.afm', 'fonts for <br />1. invoice in general <br >2. products & total-table<br />', 725, 4130, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL),
('logo link', 'RL_INVOICE_LOGO_LINK', 'http://www.FiloSoFisch.com/', 'logo link', 725, 4140, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL),
('filename and path to store the pdf-file', 'RL_INVOICE_PDF_PATH', '../pdf/|1\r\n\r\n', '1. path to store the pdf-file<br />Default: ../pdf/|1rnrn<br />', 725, 4150, '2004-10-04 00:01:00', '2004-10-04 00:01:00', NULL, NULL);


############################################################
# für alle die die MULTI-admin version installiert haben
# add language_id 43 to admin
############################################################

INSERT INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Link des Logos', 'RL_INVOICE_LOGO_LINK', 43, 'Geben Sie hier den Link für das Logo in der Rechnung an', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('Speicherort und -Name der PDF-Datei', 'RL_INVOICE_PDF_PATH', 43, '1. Wie sollen PDF-Dateien gespeichert werden?<br />Standard: ../pdf/|1rnrn<br />', '2007-10-04 00:01:00', '2007-10-04 00:01:00'),
('Präfix für Rechnungsnummer in der Rechnung', 'RL_INVOICE_ORDER_ID_PREFIX', 43, 'Präfix für Rechnungsnummer in der Rechnung<br />Beispiel: : FsF/2004/<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('Schriftarten für Rechnung und Artikel', 'RL_INVOICE_FONTS', 43, 'Welche Schriftarten wollen Sie verwenden? <br />1. F&uuml;r Rechnungstexte <br >2. F&uuml;r Artikel & Summe<br /><br />Standart: ../fonts/arial.afm|../fonts/Courier.afm<br />(Pfad/und Schriftart für Rechnung|Pfad/und Schriftart für Artikel+Summe<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('Ort und Datum in der Rechnung', 'RL_INVOICE_CITY', 43, 'Beispiel: Wien, am @DATE@ (= Wien, am 27.9.2004)<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('Fusszeile der Rechnung', 'RL_INVOICE_FOOTER', 43, 'Was soll in der Fusszeile der Rechnung angezeigt werden?<br /><br />Beispiel:<br />Alle Waren bleiben bis zur vollst&auml;ndigen Bezahlung Eigentum der Fa. FiloSoFisch. Bankverbindung: BankAustria-Creditanstalt: BLZ 12000, KtoNr: 52014 127 901 UID: ATU55705801|8|#|25<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('Y-Position der Adresse', 'RL_INVOICE_ADDRESS_TOP', 43, 'Y-Position der Adresse<br />Standard: 144 (= 2inch)<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('Y-Position der 1. Zeile nach der Adresse', 'RL_INVOICE_ADDRESS_AFTER', 43, '1.Wert: y-absolute position<br />2.Wert: min delta; wenn y-pos + delta < y-pos<br />Standard: 216|30', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('3. Zeile nach Logo im Rechnungskopf', 'RL_INVOICE_ROW3', 43, '3. Zeile nach Logo<br />Format: Text|Schriftgröße|X-Ausrichtung|Y-Ausrichtung<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('2. Zeile nach Logo im Rechnungskopf', 'RL_INVOICE_ROW2', 43, '2. Zeile nach Logo<br />Format: Text|Schriftgröße|X-Ausrichtung|Y-Ausrichtung<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('1. Zeile nach Logo im Rechnungskopf', 'RL_INVOICE_ROW1', 43, '1. Zeile nach Logo<br />Format: Text|Schriftgröße|X-Ausrichtung|Y-Ausrichtung<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('Template fr Artikel- und Summentabelle', 'RL_INVOICE_TABLE_TEMPLATE', 43, 'Template f&uuml;r Artikel- und Summentabelle<br />Definition ist in rl_invoice_def.php<br />Weitere Hilfe erhalten Sie in docs/rl_invoice/readme_ezpdf.pdf<br />Standard: col_templ_1|options_templ_1|total_col_1|total_opt_1<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('Papiergröße und Ausrichtung', 'RL_INVOICE_PAPER', 43, '1. Papiergr&ouml;ße: ISO-Norm (A4, A5,..) + US (legal,...)<br />2. Ausrichtung: portrait ODER landscape<br />Standard: A4|portrait<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('Logo im Rechnungskopf', 'RL_INVOICE_LOGO_SHOP_IMAGE', 43, 'Welches Logo soll im Rechnungskopf verwendet werden?<br />(zB. admin/images/logo_shop2.jpg)<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00'),
('Rändereinstellungen', 'RL_INVOICE_MARGIN', 43, 'Format: oben|rechts|unten|links<br />(Hinweis: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />Standard: 30|30|30|60<br />', '2004-10-04 00:01:00', '2004-10-04 00:01:00');

