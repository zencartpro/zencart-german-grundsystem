<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: 3_5_0.php 2016-06-20 10:19:17Z webchills $
 */
 
$db->Execute(" SELECT @gid:=configuration_group_id
FROM ".TABLE_CONFIGURATION_GROUP."
WHERE configuration_group_title= 'pdf Rechnung'
LIMIT 1;");


// add rl_invoice3 config
            $confArr = array('RL_INVOICE3_MODUL_VERSION', 'RL_INVOICE3_STATUS', 'RL_INVOICE3_ORDERDATE', 'RL_INVOICE3_CUSTOMERID', 'RL_INVOICE3_SHIPPING_ADDRESS', 'RL_INVOICE3_ADDRESS1_POS', 'RL_INVOICE3_ADDRESS2_POS', 'RL_INVOICE3_ADDRESS_BORDER', 'RL_INVOICE3_ADDRESS_WIDTH', 
                            'RL_INVOICE3_DELTA', 'RL_INVOICE3_FONTS', 'RL_INVOICE3_LINE_HEIGT', 'RL_INVOICE3_LINE_THICK', 
                            'RL_INVOICE3_MARGIN', 'RL_INVOICE3_NOT_NULL_INVOICE', 'RL_INVOICE3_ORDERSTATUS', 'RL_INVOICE3_ORDER_ID_PREFIX', 
                            'RL_INVOICE3_PAPER', 'RL_INVOICE3_PDF_BACKGROUND', 'RL_INVOICE3_PDF_PATH', 'RL_INVOICE3_SEND_ATTACH', 
                            'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE', 'RL_INVOICE3_SEND_PDF', 'RL_INVOICE3_TABLE_TEMPLATE', 
                             'RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE', 'RL_INVOICE3_DELTA_2PAGE');
            $sql = ' SELECT configuration_key FROM ' . TABLE_CONFIGURATION . " WHERE configuration_key LIKE 'RL_INVOICE3%'";
            $res = $db->Execute($sql);
            
            $confArrAct = array();
            while (!$res->EOF) {
                $confArrAct[] = $res->fields['configuration_key'];
                $res->MoveNext();
            }
            $confDiffAdd = array_diff($confArr, $confArrAct);
            $confDiffDEL = array_diff($confArrAct, $confArr);
            // delete obsolete params
            if (!empty($confDiffDEL)) {
                $where = "'" . implode("', '", $confDiffDEL) . "'";
                $sql = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key IN ($where)";
                $db->Execute($sql);
                if ($multi) {
                    $sql = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE configuration_key IN ($where)";
                   $db->Execute($sql);
                }
            }
            // only insert new params; let the old ones live    
            $ins = "INSERT INTO  " . TABLE_CONFIGURATION . "  (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function) VALUES ";
            $confArrAdd = array(
                                'RL_INVOICE3_STATUS' => "('pdf Invoice - Status', 'RL_INVOICE3_STATUS', 'false', 'Do you want to activate the pdf invoice plugin?', @gid, 1, \"zen_cfg_select_option(array('true', 'false'), \")",
                                'RL_INVOICE3_ORDERDATE' => "('pdf Invoice - Date of invoice = Date of order?', 'RL_INVOICE3_ORDERDATE', 'true', 'Should the invoice date be the date of the order or the date of the creation of the invoice?', @gid, 2, \"zen_cfg_select_option(array('true', 'false'), \")",
                                'RL_INVOICE3_CUSTOMERID' => "('pdf Invoice - Customer ID', 'RL_INVOICE3_CUSTOMERID', 'true', 'Do you want to show the customer id on the pdf invoice?', @gid, 4, \"zen_cfg_select_option(array('true', 'false'), \")",
                                'RL_INVOICE3_SHIPPING_ADDRESS' => "('pdf Invoice - Show shipping address?', 'RL_INVOICE3_SHIPPING_ADDRESS', 'true', 'Do you want to show the shipping address on the pdf invoice?', @gid, 5, \"zen_cfg_select_option(array('true', 'false'), \")",
                                'RL_INVOICE3_ADDRESS1_POS' => "('pdf Invoice - XY-position of address1 position', 'RL_INVOICE3_ADDRESS1_POS', '89|21', 'XY-position of address; its the margin delta <br />Default: 0|30', @gid, 6, NULL)", 
                                'RL_INVOICE3_ADDRESS2_POS' => "('pdf Invoice - XY-position of address2 position', 'RL_INVOICE3_ADDRESS2_POS', '1|21', 'XY-position of address; its the margin delta <br />Default: 80|30', @gid, 80, NULL)",
                                'RL_INVOICE3_ADDRESS_BORDER' => "('pdf Invoice - Border Address1|2', 'RL_INVOICE3_ADDRESS_BORDER', '|', 'border Address1|2: LTRB (Left Top Right Bottom)<br />', @gid, 70, NULL)", 
                                'RL_INVOICE3_ADDRESS_WIDTH' => "('pdf Invoice - Width Address1|2', 'RL_INVOICE3_ADDRESS_WIDTH', '80|80', 'width Address1|2: 60|60<br />', @gid, 40, NULL)", 
                                'RL_INVOICE3_DELTA' => "('pdf Invoice - Deltas', 'RL_INVOICE3_DELTA', '5|8', 'delta address invoice|delta invoice products: 20|20<br />', @gid, 50, NULL)", 
                                'RL_INVOICE3_FONTS' => "('pdf Invoice - Fonts for invoice|products', 'RL_INVOICE3_FONTS', 'myriadpc|myriadpc', 'fonts for <br />1. invoice in general <br >2. products & total-table<br />', @gid, 120, NULL)", 
                                'RL_INVOICE3_LINE_HEIGT' => "('pdf Invoice - Line Height', 'RL_INVOICE3_LINE_HEIGT', '1.25', 'Line Height', @gid, 130, NULL)", 
                                'RL_INVOICE3_LINE_THICK' => "('pdf Invoice - Line Total Thickness', 'RL_INVOICE3_LINE_THICK', '0.5', 'thickness off total-line', @gid, 130, NULL)", 
                                'RL_INVOICE3_MARGIN' => "('pdf Invoice - Margins', 'RL_INVOICE3_MARGIN', '20|20|20|20', 'defines the margins:<br />top|right|bottom|left<br />(Note: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />', @gid, 20, NULL)", 
                                'RL_INVOICE3_NOT_NULL_INVOICE' => "('pdf Invoice - Accounting for free product', 'RL_INVOICE3_NOT_NULL_INVOICE', '0', 'Accounting for free product: send e-mail invoice', @gid, 130, NULL)", 
                                'RL_INVOICE3_ORDERSTATUS' =>  "('pdf Invoice - Send by orderstatus greater/equal than ', 'RL_INVOICE3_ORDERSTATUS', '3', 'only send invoice if orders_status greater or equal than', @gid, 130, NULL)", 
                                'RL_INVOICE3_ORDER_ID_PREFIX' => "('pdf Invoice - Prefix for OrderNo', 'RL_INVOICE3_ORDER_ID_PREFIX', ': 2016', 'prefix for OrderNo<br />', @gid, 110, NULL)", 
                                'RL_INVOICE3_PAPER' => "('pdf Invoice - Paper Size/Units/Oriantation', 'RL_INVOICE3_PAPER', 'A4|mm|P', '1. papersize = A3|A4|A5|Letter|Legal <br />2. units: pt|mm|cm|inch <br />3. Oriantation: L|P<br />', @gid, 10, NULL)", 
                                'RL_INVOICE3_PDF_BACKGROUND' => "('pdf Invoice - pdf background file', 'RL_INVOICE3_PDF_BACKGROUND', '" . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/rechnung_de.pdf', 'pdf background file: " . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/rl_invoice3_bg.pdf<br />', @gid, 60, NULL)", 
                                'RL_INVOICE3_PDF_PATH' => "('pdf Invoice - Filename and path to store the pdf-file', 'RL_INVOICE3_PDF_PATH', '" . DIR_FS_CATALOG . "pdf/|1', '1. path to store the pdf-file (!!must be writeable !!)<br />Default: ../pdf/|1<br />', @gid, 130, NULL)", 
                                'RL_INVOICE3_SEND_ATTACH' => "('pdf Invoice - Additional attachements', 'RL_INVOICE3_SEND_ATTACH', 'agb_de.pdf|widerruf_de.pdf', 'RL_INVOICE3_SEND_PDF', @gid, 130, NULL)", 
                                'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE' =>  "('pdf Invoice - [RE]send order', 'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE', '3|100', '[RE]send invoice, if orderstatus changed to', @gid, 130, NULL)", 
                                'RL_INVOICE3_SEND_PDF' => "('pdf Invoice - Send pdf invoice with order', 'RL_INVOICE3_SEND_PDF', '0', 'Do you want to send the invoice with an order?', @gid, 130, NULL)", 
                                'RL_INVOICE3_TABLE_TEMPLATE' => "('pdf Invoice - Templates for products table & total table', 'RL_INVOICE3_TABLE_TEMPLATE', 'amazon|amazon_templ|total_col_1|total_opt_1', 'templates for products_table & total_table; this is defined in rl_invoice3_def.php; see also: docs/rl_invoice/readme_ezpdf.pdf<br />', @gid, 90, NULL)",
                                'RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE' => "('pdf Invoice - PDF-template on first page', 'RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE', 'false', 'print pdf-background-template omly on the first page', @gid, 160, \"zen_cfg_select_option(array('true', 'false'), \")",
                                'RL_INVOICE3_DELTA_2PAGE' => "('pdf Invoice - Delta 2.Page', 'RL_INVOICE3_DELTA_2PAGE', '10', 'Delta 2.Page', @gid, 160, \"\")",
                                );
            foreach ($confDiffAdd as $value) {
               $sql = $ins . $confArrAdd[$value];
               $db->Execute($sql);
            }
            
               $ins = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_key, configuration_language_id, configuration_title, configuration_description) VALUES ";
               $confArrMultiAdd = array(
                                    'RL_INVOICE3_STATUS' => "('RL_INVOICE3_STATUS', 43, 'pdf Rechnung - Status', 'Wollen Sie das Modul pdf Rechnung aktivieren?<br/>In der Administration können Sie auch pdf Rechnungen erstellen, wenn Sie hier auf false stellen. Um die Funktionalität des Mitsendens von Rechnung und Anhängen in den Mails zu nutzen, müssen Sie aber hier auf true stellen.<br/>Aktivieren Sie das Modul erst dann, wenn Sie Ihre Rechnungsvorlage und Anhänge wie AGB und Widerruf erstellt haben und sich mit der Funktionalität vertraut gemacht haben.')",
                                    'RL_INVOICE3_ORDERDATE' => "('RL_INVOICE3_ORDERDATE', 43, 'pdf Rechnung - Rechnungsdatum = Bestelldatum?', 'Soll das Rechnungsdatum das Datum der Bestellung sein (true) oder das Datum, an dem die pdf Rechnung erzeugt wird? (false)')",
                                    'RL_INVOICE3_CUSTOMERID' => "('RL_INVOICE3_CUSTOMERID', 43, 'pdf Rechnung - Kundennummer auf der Rechnung?', 'Wollen Sie die Kundennummer auf der pdf Rechnung anzeigen?')",
                                    'RL_INVOICE3_SHIPPING_ADDRESS' => "('RL_INVOICE3_SHIPPING_ADDRESS', 43, 'pdf Rechnung - Lieferadresse anzeigen?', 'Wollen Sie die Lieferadresse auf der pdf Rechnung anzeigen?')",
                                    'RL_INVOICE3_ADDRESS1_POS' => "('RL_INVOICE3_ADDRESS1_POS', 43, 'pdf Rechnung - XY-Position der Adresse1', 'XY-Position der Adresse1; es ist das Delta zu den Rändern einzugeben<br />Standard: 89|21')", 
                                    'RL_INVOICE3_ADDRESS2_POS' => "('RL_INVOICE3_ADDRESS2_POS', 43, 'pdf Rechnung - XY-Postion der Adresse2', 'XY-Postion der Adresse2; es ist das Delta zu den Rändern einzugeben<br />Standard: 0|21')",
                                    'RL_INVOICE3_ADDRESS_BORDER' => "('RL_INVOICE3_ADDRESS_BORDER', 43, 'pdf Rechnung - Rändereinstellungen für Adresse1|2', 'Rändereinstellungen für Adresse1|2<br />LTRB (Left Top Right Bottom)<br />Standard: |<br />Es wird also kein Rahmen um die Adressen angezeigt. Wollen Sie um die Adressen einen vollständigen Rahmen anzeigen, dann ändern Sie auf LTRB|LTRB')", 
                                    'RL_INVOICE3_ADDRESS_WIDTH' => "('RL_INVOICE3_ADDRESS_WIDTH', 43, 'pdf Rechnung - Breite von Adressfeld1|2', '<br />Standard: 80|80')", 
                                    'RL_INVOICE3_DELTA' => "('RL_INVOICE3_DELTA', 43, 'pdf Rechnung - Deltas', 'Abstand Adresse:Rechnungsnummer | Abstand Rechnungsnummer:Produktliste<br />Standard: 5|8<br />')", 
                                    'RL_INVOICE3_FONTS' => "('RL_INVOICE3_FONTS', 43, 'pdf Rechnung - Schriftarten für Rechnung und Artikel', 'Welche Schriftarten wollen Sie verwenden? <br />1. Für Rechnungstexte <br >2. Für Artikel und Summe<br /><br />Standard: myriadpc|myriadpc<br />(Pfad/und Schriftart für Rechnung|Pfad/und Schriftart für Artikel und Summe<br />')", 
                                    'RL_INVOICE3_LINE_HEIGT' => "('RL_INVOICE3_LINE_HEIGT', 43, 'pdf Rechnung - Zeilenhöhe', 'Zeilenhöhe')", 
                                    'RL_INVOICE3_LINE_THICK' => "('RL_INVOICE3_LINE_THICK', 43, 'pdf Rechnung - Dicke der Striche bei Gesamtsumme', 'Wie dick soll der Strich bei der Gesamtsumme sein?')", 
                                    'RL_INVOICE3_MARGIN' => "('RL_INVOICE3_MARGIN', 43, 'pdf Rechnung - Rändereinstellungen', 'Format: oben|rechts|unten|links<br />(Hinweis: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />Standard: 20|20|20|20<br />')", 
                                    'RL_INVOICE3_NOT_NULL_INVOICE' => "('RL_INVOICE3_NOT_NULL_INVOICE', 43, 'pdf Rechnung - Rechnung bei Gratisprodukt', 'Soll die Rechnung auch bei einem Gratisprodukt dem Mail hinzugefügt werden?')", 
                                    'RL_INVOICE3_ORDERSTATUS' =>  "('RL_INVOICE3_ORDERSTATUS', 43, 'pdf Rechnung - Rechnungsversand bei Bestellstatus', 'Rechnung nur mitschicken, wenn der Bestellstatus grösser/gleich ist [default: 3 == verschickt]')", 
                                    'RL_INVOICE3_ORDER_ID_PREFIX' => "('RL_INVOICE3_ORDER_ID_PREFIX', 43, 'pdf Rechnung - Präfix für Rechnungsnummer in der Rechnung', 'Präfix für Rechnungsnummer in der Rechnung<br />Beispiel: : 2016/<br />')", 
                                    'RL_INVOICE3_PAPER' => "('RL_INVOICE3_PAPER', 43, 'pdf Rechnung - Papiergrösse|Einheit|Orientierung', '1. Papiergrösse = A3|A4|A5|Letter|Legal <br />2. Einheit: pt|mm|cm|inch <br />3. Orientierung: L|P<br />')", 
                                    'RL_INVOICE3_PDF_BACKGROUND' => "('RL_INVOICE3_PDF_BACKGROUND', 43, 'pdf Rechnung - PDF Hintergrunddatei', 'PDF Hintergrunddatei<br />Standard: " . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/rechnung_de.pdf<br />')", 
                                    'RL_INVOICE3_PDF_PATH' => "('RL_INVOICE3_PDF_PATH', 43, 'pdf Rechnung - Speicherort und -name der PDF-Datei', '1. Wo sollen PDF-Dateien gespeichert werden (!! muss beschreibbar sein !!)?<br />2. speichern ja|nein (1|0)<br />Standard: " . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/|1<br />')", 
                                    'RL_INVOICE3_SEND_ATTACH' => "('RL_INVOICE3_SEND_ATTACH', 43, 'pdf Rechnung - Anhänge', 'Welche PDFs sollen noch angehängt werden; bei mehreren Dateien | (pipe) als Trenner verwenden)<br/><br/>Voreinstellung: agb_de.pdf|widerruf_de.pdf')", 
                                    'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE' => "('RL_INVOICE3_SEND_ORDERSTATUS_CHANGE', 43, 'pdf Rechnung - Rechnungsneuversand', 'Bei welcher Änderung des Bestellstatus soll die Rechnung [nochmals] versendet werden')", 
                                    'RL_INVOICE3_SEND_PDF' => "('RL_INVOICE3_SEND_PDF', 43, 'pdf Rechnung - Rechnung bei Bestellung', 'Soll die Rechnung gleich bei der Bestellung gesendet werden?')", 
                                    'RL_INVOICE3_TABLE_TEMPLATE' => "('RL_INVOICE3_TABLE_TEMPLATE', 43, 'pdf Rechnung - Template für Artikel- und Summentabelle', 'Template für Artikel- und Summentabelle<br />Definition ist in includes/pdf/rl_invoice3_def.php<br />Standard: 30|30|30|60<br />Standard: amazon|amazon_templ|total_col_1|total_opt_1<br />')",
                                    'RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE' => "('RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE', 43, 'pdf Rechnung - PDF-Template auf 1.Seite', 'PDF-Template nur auf 1.Seite drucken')",
                                    'RL_INVOICE3_DELTA_2PAGE' => "('RL_INVOICE3_DELTA_2PAGE', 43, 'pdf Rechnung - Abstand 2.Seite', 'Zusätzlicher Abstand auf 2. Seite')",
                                    );
               foreach ($confDiffAdd as $value) {
                   $sql = $ins . $confArrMultiAdd[$value];
                   $db->Execute($sql);
               }
           



// add new order_status resend invoice

$sql = "SELECT * FROM " . TABLE_ORDERS_STATUS . " WHERE orders_status_id=100";
$res = $db->Execute($sql);
if($res->EOF){
$sql = "INSERT INTO " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) VALUES ('100', '1', 'Resend Invoice')";
$db->Execute($sql);               
$sql = "INSERT INTO " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) VALUES ('100', '43', 'Rechnung versenden')";
$db->Execute($sql);               
}

// register for admin menu

$admin_page = 'configPDF3';
$db->Execute("DELETE FROM " . TABLE_ADMIN_PAGES . " WHERE page_key = '" . $admin_page . "' LIMIT 1;");
$admin_page = 'toolsPDF3';
$db->Execute("DELETE FROM " . TABLE_ADMIN_PAGES . " WHERE page_key = '" . $admin_page . "' LIMIT 1;");
$admin_page = 'GeneratePDFInvoice';
$db->Execute("DELETE FROM " . TABLE_ADMIN_PAGES . " WHERE page_key = '" . $admin_page . "' LIMIT 1;");


// add configuration menu
if (!zen_page_key_exists($admin_page)) {
$db->Execute(" SELECT @gid:=configuration_group_id
FROM ".TABLE_CONFIGURATION_GROUP."
WHERE configuration_group_title= 'PDF Invoice'
LIMIT 1;");

$db->Execute("INSERT INTO " . TABLE_ADMIN_PAGES . " (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES 
('configPDF3','BOX_CONFIGURATION_PDF3','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid)");
$db->Execute("INSERT INTO " . TABLE_ADMIN_PAGES . " (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES 
('toolsPDF3','BOX_TOOLS_PDF3','RL_INVOICE3_ADMIN_FILENAME','','tools','Y',@gid)");
$db->Execute("INSERT INTO " . TABLE_ADMIN_PAGES . " (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES 
('GeneratePDFInvoice','GENERATE_RL_INVOICE3','FILENAME_RL_INVOICE3','','customers','N',@gid)");
$messageStack->add('pdf Rechnung Konfiguration erfolgreich hinzugefügt.', 'success');  
}