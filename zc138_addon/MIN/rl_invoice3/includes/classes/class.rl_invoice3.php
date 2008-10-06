<?php
/**
 * @package pdf_invoice3
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: rl_invoice3.php 15 2007-06-05 09:11:58Z rainer langheiter $
 * 
 * version: 3.0.0 // 20081006
 * 
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: readme_rl_invoice.pdf|txt 
 */


define('FPDF_FONTPATH', DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/font/');
include_once(DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/fpdi.php');      


function ExtractNumberX($number){
    return substr($number, strpos($number, ';') + 1);
    }


class rl_invoice3 extends fpdi{
    var $widths;
    var $aligns;           

    function rl_invoice3($oID, $orientation, $unit, $format){
        $this->pdf = new FPDI();      
        parent::fpdi($orientation, $unit, $format);
        global $db;
        $this -> db = $db;
        $this->oID = $oID;
        $this -> currencies = new currencies();
        $this->order = new order($this -> oID);
        $this -> order_check = $this -> db -> Execute("select cc_cvv, customers_name, customers_company, customers_street_address,
                    customers_suburb, customers_city, customers_postcode,
                    customers_state, customers_country, customers_telephone,
                    customers_email_address, customers_address_format_id, delivery_name,
                    delivery_company, delivery_street_address, delivery_suburb,
                    delivery_city, delivery_postcode, delivery_state, delivery_country,
                    delivery_address_format_id, billing_name, billing_company,
                    billing_street_address, billing_suburb, billing_city, billing_postcode,
                    billing_state, billing_country, billing_address_format_id,
                    payment_method, cc_type, cc_owner, cc_number, cc_expires, currency,
                    currency_value, date_purchased, orders_status, last_modified
                    from " . TABLE_ORDERS . "
                    where orders_id = '" . (int)$this -> oID . "'");
        
        $this -> margin = $this -> getDefault(RL_INVOICE3_MARGIN, array('top' => '10', 'right' => '30', 'bottom' => '30', 'left' => '60'));
        $this -> maxWidth = $this -> w - $this -> margin['left'] - $this -> margin['right'];
        
        $this -> address1Pos = $this -> getDefault(RL_INVOICE3_ADDRESS1_POS, array('X' => '0', 'Y' => '30'));
        $this -> address1Pos['X'] += $this -> margin['left'];
        $this -> address1Pos['Y'] += $this -> margin['top'];
        
        $this -> address2Pos = $this -> getDefault(RL_INVOICE3_ADDRESS2_POS, array('X' => '120', 'Y' => '30'));
        $this -> address2Pos['X'] += $this -> margin['left'];
        $this -> address2Pos['Y'] += $this -> margin['top'];
        
        $this -> addressWidth = $this -> getDefault(RL_INVOICE3_ADDRESS_WIDTH, array('addr1' => '80', 'addr2' => '80'));
        $this -> addressBorder = $this -> getDefault(RL_INVOICE3_ADDRESS_BORDER, array('addr1' => '', 'addr2' => ''));
        
        $this -> paper = $this -> getDefault(RL_INVOICE3_PAPER, array('format' => 'A4', 'unit' => 'mm', 'orientation' => 'P'));
        $this -> templates = $this -> getDefault(RL_INVOICE3_TABLE_TEMPLATE, array('pCols' => 'col_templ_1', 'pOptions' => 'options_templ_1', 'tCols' => 'total_col_1', 'tOptions' => 'total_opt_1'));
        $this -> fonts2 = $this -> getDefaultCheck(RL_INVOICE3_FONTS, array('general' => 'dejavusanscondensed', 'table' => 'freemono'));
        $this->pdf->AddFont($this->fonts2['general']);
        $this->pdf->AddFont($this->fonts2['table']);
        $this -> pdfPath = $this -> getDefault(RL_INVOICE3_PDF_PATH, array('path' => DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/', 'save' => '1'));
        $this -> delta = $this -> getDefault(RL_INVOICE3_DELTA, array('addrInvoice' => '20', 'invoiceProducts' => '30'));
        $this -> debug = $this -> getDefault(RL_INVOICE3_DEBUG, array('debug' => 0));
        $this -> fontsOk = $this -> checkFonts();
        $this->bgPDF = $this -> getDefault(RL_INVOICE3_PDF_BACKGROUND, array('file' => DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/rl_invoice3_bg.pdf')); ;
        $realPW = 999;
        include(DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/rl_invoice3_def.php');
        $this->colsP = $colsP;
        $this->optionsP = $optionsP;
        $this->cols = $cols;
        $this->options = $options;
        
        $this -> t1Col = $colsP[$this -> templates['pCols']];
        $this -> t1Opt = $optionsP[$this -> templates['pOptions']];
        
        $pagecount = $this->pdf->setSourceFile($this -> bgPDF['file']);
        $tplidx2 = $this->pdf->ImportPage(1);
        
        $this->pdf->addPage($this -> paper['orientation']);
        $this->pdf->useTemplate($tplidx2);
        
        $this->pdf->SetMargins($this -> margin['left'], $this -> margin['top'], $this -> margin['right']);
        $this->pdf->SetAutoPageBreak(true, $this -> margin['bottom']);
        if($this -> debug['debug'] == 1){   
            $this -> debugInfo = rldp($this, 'DebugInfo');
            }
        }
    
    function setTemplate($cp, $op){
        #rldp($this->colsP, '$this->colsP');
        $this -> t1Col = $cp;
        $this -> t1Opt = $op;
    }
    
    function checkInstall(){
        global $db;
        if(!defined('RL_INVOICE3_WITHOUTINVOICE')){
            if(rl_invoice3::isMultiLingual()){
                $multi = true;
            } else {
                $multi = false;
            }
            $sqlA = array(0=>1,1=>2,2=>2);  
            $sql = "DELETE FROM " . TABLE_CONFIGURATION_GROUP ." WHERE configuration_group_title LIKE 'PDF Invoice3' OR configuration_group_title LIKE 'PDF Rechnung3'";
            $db->Execute($sql);   
            $group = getNextConfigGroupID();
            if(!$multi){
                $sql = "INSERT INTO " . TABLE_CONFIGURATION_GROUP ." (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ($group, 'PDF Invoice3', 'PDF3', 726, 1)";
                $db->Execute($sql);
            } else {
                $sql = "INSERT INTO " . TABLE_CONFIGURATION_GROUP ." (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ($group, 1, 'PDF Invoice3', 'PDF3', 726, 1)";
                $db->Execute($sql);
                $sql = "INSERT INTO " . TABLE_CONFIGURATION_GROUP ." (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ($group, 43, 'PDF Rechnung3', 'PDF3', 726, 1)";
                $db->Execute($sql);
                $sqlA[3] = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE ." (configuration_key, configuration_language_id, configuration_title, configuration_description) VALUES 
                                ('RL_INVOICE3_PAPER', 43, 'papiergroesse|einheit|orientierung', '1. papiergroesse = A3|A4|A5|Letter|Legal <br />2. einheit: pt|mm|cm|inch <br />3. orientierung: L|P<br />'),
                                ('RL_INVOICE3_MARGIN', 43, 'Rändereinstellungen', 'Format: oben|rechts|unten|links<br />(Hinweis: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />Standard: 30|30|30|60<br />'),
                                ('RL_INVOICE3_TABLE_TEMPLATE', 43, 'Template für Artikel- und Summentabelle', 'Template für Artikel- und Summentabelle<br />Definition ist in rl_invoice_def.php<br />Standard: 30|30|30|60<br />Standard: col_templ_1|options_templ_1|total_col_1|total_opt_1<br />'),
                                ('RL_INVOICE3_ADDRESS1_POS', 43, 'XY-postion der adresse1', 'XY-postion der adresse1; es ist das delta zu den raendern einzugeben<br />Standard: 0|30'),
                                ('RL_INVOICE3_ADDRESS_WIDTH', 43, 'breite von adressfeld1|2', '<br />standard: 80|60'),
                                ('RL_INVOICE3_DELTA', 43, 'deltas', 'abstand adresse::rechnungsnummer | abstand rechnungsnummer:produktliste<br />Standard: 20|20<br />'),
                                ('RL_INVOICE3_PDF_BACKGROUND', 43, 'pdf hintergrunddatei', 'pdf hintergrunddatei<br />Standard: " . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/rl_invoice3_bg.pdf<br />'),
                                ('RL_INVOICE3_ADDRESS_BORDER', 43, 'rändereinstellungen für adresse1|2', 'rändereinstellungen für adresse1|2<br />LTRB (Left Top Right Bottom)<br />Standard: LTRB|LTRB<br />'),
                                ('RL_INVOICE3_ADDRESS2_POS', 43, 'XY-postion der adresse2', 'XY-postion der adresse2; es ist das delta zu den raendern einzugeben<br />Standard: 0|30'),
                                ('RL_INVOICE3_CITY', 43, 'Ort und Datum in der Rechnung', 'Beispiel: Wien, am @DATE@ (= Wien, am 06.10.2008)<br />'),
                                ('RL_INVOICE3_ORDER_ID_PREFIX', 43, 'Präfix für Rechnungsnummer in der Rechnung', 'Präfix für Rechnungsnummer in der Rechnung<br />Beispiel: : FsF/2008/<br />'),
                                ('RL_INVOICE3_FONTS', 43, 'Schriftarten für Rechnung und Artikel', 'Welche Schriftarten wollen Sie verwenden? <br />1. Für Rechnungstexte <br >2. Für Artikel & Summe<br /><br />Standart: dejavusanscondensed|freemono<br />(Pfad/und Schriftart für Rechnung|Pfad/und Schriftart für Artikel+Summe<br />'),
                                ('RL_INVOICE3_WITHOUTINVOICE', 43, 'Rechnungsadresse nicht drucken', 'Rechnungsadresse nicht drucken'),
                                ('RL_INVOICE3_PDF_PATH', 43, 'Speicherort und -Name der PDF-Datei', '1. Wo sollen PDF-Dateien gespeichert werden?<br />2. speichern ja|nein (1|0)<br />Standard: " . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/|1<br />'),
                                ('RL_INVOICE3_SEND_PDF', 43, 'Rechnung bei Bestellung', 'soll Rechnung bei Bestellung gesendet werden'),
                                ('RL_INVOICE3_SEND_ATTACH', 43, 'Anhänge', 'welche PDFs sollen noch angehängt werden; bei mehreren dateien | (pipe) als trenner verwenden)')
                                ;";
            }
            
            $sqlA[0] = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE  configuration_key LIKE 'RL_INVOICE3_%'";
            $sqlA[1] = "DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE . " WHERE  configuration_key LIKE 'RL_INVOICE3_%'";
            $sqlA[2] = "INSERT INTO  " . TABLE_CONFIGURATION . "  (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function) VALUES 
                        ('Paper Size/Units/Oriantation', 'RL_INVOICE3_PAPER', 'A4|mm|P', '1. papersize = A3|A4|A5|Letter|Legal <br />2. units: pt|mm|cm|inch <br />3. Oriantation: L|P<br />', $group, 10, NULL),
                        ('defines the margins', 'RL_INVOICE3_MARGIN', '25|10|10|20', 'defines the margines:<br />top|right|bottom|left<br />(Note: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />', $group, 20, NULL),
                        ('XY-position of address1 position', 'RL_INVOICE3_ADDRESS1_POS', '0|30', 'XY-position of address; its the margin delta <br />Default: 0|30', $group, 30, NULL),
                        ('width Address1|2', 'RL_INVOICE3_ADDRESS_WIDTH', '80|60', 'width Address1|2: 60|60<br />', $group, 40, NULL),
                        ('deltas', 'RL_INVOICE3_DELTA', '20|20', 'delta address invoice|delta invoice products: 20|30<br />', $group, 50, NULL),
                        ('pdf background file', 'RL_INVOICE3_PDF_BACKGROUND', '" . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/rl_invoice3_bg.pdf', 'pdf background file: " . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/rl_invoice3_bg.pdf<br />', $group, 60, NULL),
                        ('border Address1|2', 'RL_INVOICE3_ADDRESS_BORDER', 'LTRB|LTRB', 'border Address1|2: LTRB (Left Top Right Bottom)<br />', $group, 70, NULL),
                        ('XY-position of address2 position', 'RL_INVOICE3_ADDRESS2_POS', '90|36', 'XY-position of address; its the margin delta <br />Default: 80|30', $group, 80, NULL),
                        ('Templates for products table & total table', 'RL_INVOICE3_TABLE_TEMPLATE', 'col_templ_1|options_templ_1|total_col_1|total_opt_1', 'templates for products_table & total_table; this is defined in rl_invoice_def.php; see also: docs/rl_invoice/readme_ezpdf.pdf<br />', $group, 90, NULL),
                        ('City ', 'RL_INVOICE3_CITY', 'Wien, am @DATE@', 'City, 27.9.2004', $group, 100, NULL),
                        ('prefix for OrderNo', 'RL_INVOICE3_ORDER_ID_PREFIX', ': FsF/2008/', 'prefix for OrderNo<br />', $group, 110, NULL),
                        ('fonts for invoice|products', 'RL_INVOICE3_FONTS', 'dejavusanscondensed|freemono', 'fonts for <br />1. invoice in general <br >2. products & total-table<br />', $group, 120, NULL),
                        ('do not print invoice address', 'RL_INVOICE3_WITHOUTINVOICE', 'false', 'do not print invoice address', $group, 160, \"zen_cfg_select_option(array('true', 'false'), \"),
                        ('filename and path to store the pdf-file', 'RL_INVOICE3_PDF_PATH', '" . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/|1', '1. path to store the pdf-file<br />Default: ../pdf/|1<br />', $group, 130, NULL),
                        ('RL_INVOICE3_SEND_PDF', 'RL_INVOICE3_SEND_PDF', '1', 'RL_INVOICE3_SEND_PDF', $group, 130, NULL),
                        ('additional attachements', 'RL_INVOICE3_SEND_ATTACH', 'agb.pdf|widerruf.pdf', 'RL_INVOICE3_SEND_PDF', $group, 130, NULL)
                        ;";
            foreach ($sqlA as $key => $value) {
                $db->execute($value);
            }                        
            $link = HTTP_SERVER . DIR_WS_ADMIN . 'rl_invoice3.php?oID=' . zen_db_prepare_input($_GET['oID']);
            $link = HTTP_SERVER . DIR_WS_ADMIN . 'configuration.php?gID=' . $group;
            zen_redirect($link);
            die('LINK');  
        }
    }
    function SetWidths($w)
    {
        // Set the array of column widths
        $this -> widths = $w;
        }
    
    function SetAligns($a)
    {
        // Set the array of column alignments
        $this -> aligns = $a;
        }
    
    function mr($data){
        $such = array("\t", "&nbsp;", chr(160), '&euro;');
        $ers = array('   ', ' ', ' ', '€');
        return str_replace($such, $ers, $data);

    }
    function Row($data)
    {
        // Calculate the height of the row
        $nb = 0;
        for($i = 0;$i < count($data);$i++)
        $nb = max($nb, $this -> NbLines($this -> widths[$i], $data[$i]));
        $h = 3 * $nb;
        // Issue a page break first if needed
        $this -> CheckPageBreak($h);
        // Draw the cells of the row
        for($i = 0;$i < count($data);$i++)
        {
            $w = $this -> widths[$i];
            $a = isset($this -> aligns[$i]) ? $this -> aligns[$i] : 'L';
            // Save the current position
            $x = $this->pdf->GetX();
            $y = $this->pdf->GetY();
            // Draw the border
            $this->pdf->Rect($x, $y, $w, $h);
            // Print the text         
            $this->pdf->MultiCell($w, 3, $this->mr($data[$i]), 0, $a);
            // Put the position to the right of the cell
            $this->pdf->SetXY($x + $w, $y);
            }
        // Go to the next line
        $this->pdf->Ln($h);
        }
    
    function CheckPageBreak($h)
    {
        // If the height h would cause an overflow, add a new page immediately
        if($this->pdf->GetY() + $h > $this -> PageBreakTrigger)
            $this->pdf->addPage($this -> CurOrientation);
        }
    
    function NbLines($w, $txt)
    {
        // Computes the number of lines a MultiCell of width w will take
        $cw =  $this -> CurrentFont['cw'];
        if($w == 0)
            $w = $this -> w - $this -> rMargin - $this -> x;
        $wmax = ($w-2 * $this -> cMargin) * 1000 / $this->pdf->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if($nb > 0 and $s[$nb-1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i < $nb)
        {
            $c = $s[$i];
            if($c == "\n")
            {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
                }
            if($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if($l > $wmax)
            {
                if($sep == -1)
                {
                    if($i == $j)
                        $i++;
                    }
                else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                }
            else
                $i++;
            }
        return $nl;
        }
    
    
    function checkFonts(){
        $ok = false;
        if(is_array($this -> fonts)){
            $ok = true;
            }else{
            return false;
            }
        foreach($this -> fonts as $key => $fontPath){
            if(!file_exists($fontPath)){
                $ok = false;
                $this -> fonts[$key] = 'ERROR: ' . $fontPath . ' font not found: ';
                }
            }
        return $ok;
        }
    function getDefault($var = 'NIX', $def, $exp = '|'){
        $tmp = explode($exp, trim($var));
        $i = 0;
        foreach($def as $key => $val){
            if(isset($tmp[$i]) && $tmp[$i] != '' && $tmp[$i] != '#'){
                $def[$key] = $tmp[$i];
                }
            $i++;
            }
        return $def;
        }
    function getDefaultCheck($var = 'NIX', $def, $exp = '|'){
        $tmp = explode($exp, trim($var));
        $i = 0;
        foreach($def as $key => $val){
            if(isset($tmp[$i]) && $tmp[$i] != '' && $tmp[$i] != '#'){
                $def[$key] = $tmp[$i];
                }
            $i++;
            }
        return $def;
        }
    
    
    
    function makeAddr(){
        #echo rldp($this->order, 'ADR');
        $x['delivery'] = str_replace('<br>', "\n", zen_address_format($this -> order -> delivery['format_id'], $this -> order -> delivery, 1, '', '<br>'));
        if(strlen($x['delivery'])<9){
            $x['delivery'] = str_replace('<br>', "\n", zen_address_format($this -> order -> customer['format_id'], $this -> order -> customer, 1, '', '<br>'));
        }
        $x['billing'] = str_replace('<br>', "\n", zen_address_format($this -> order -> billing['format_id'], $this -> order -> billing, 1, '', '<br>'));
        $this->pdf->SetFont($this -> fonts2['general'], '', 12);
        
        $this->pdf->SetXY($this -> address1Pos['X'], $this -> address1Pos['Y']);
        $this ->pdf->Cell($this -> addressWidth['addr1'], 6, LIEFERADRESSE, $this -> addressBorder['addr1'], 2, 'L');
        $this->pdf->MultiCell($this -> addressWidth['addr1'], 6, $x['delivery'], $this -> addressBorder['addr1'], 1, 'L');
        
        if((RL_INVOICE3_WITHOUTINVOICE=='false') && ($x['delivery']!=$x['billing'])){
            $this->pdf->SetXY($this -> address2Pos['X'], $this -> address2Pos['Y']);
            $this->pdf->Cell($this -> addressWidth['addr2'], 6, RECHNUNGSADRESSE, $this -> addressBorder['addr2'], 2, 'L');
            $this->pdf->MultiCell($this -> addressWidth['addr2'], 6, $x['billing'], $this -> addressBorder['addr2'], 1, 'L');
            }
        }
    
    function makeInvoiceNumber(){
        $this->pdf->SetY($this -> delta['addrInvoice'] + $this->pdf->GetY());
        $dat = str_replace('@DATE@', strftime(DATE_FORMAT_SHORT), RL_INVOICE3_CITY);
        $tmp = ENTRY_ORDER_ID . sprintf("%s%05d", RL_INVOICE3_ORDER_ID_PREFIX, $this -> oID);
        $link = HTTP_SERVER . DIR_WS_CATALOG . 'index.php?main_page=account_history_info&order_id=' . $this -> oID;
        
        $this->pdf->Cell($this -> maxWidth, 6, $tmp, '', 1, 'L', 0, $link);
        
        
        $tmp = ENTRY_DATE_PURCHASED . " " . zen_date_short($this -> order -> info['date_purchased']);
        $this->pdf->Cell($this -> maxWidth, 6, $tmp, '', 0, 'L');
        
        $this->pdf->SetX(20);
        $this->pdf->Cell($this -> maxWidth, 6, $dat, '', 2, 'R');
        }
    
    function getProductData(){
        $data = array();
        $i = 0;
        foreach($this -> order -> products as $key => $val){
            $data[$i]['qty'] = $val['qty'];
            $data[$i]['model'] = $val['model'];
            $data[$i]['name'] = $val['name'];
            $data[$i]['qty_name'] = $val['qty'] . '* ' . $val['name'];
            $data[$i]['qty_name_model'] = $val['qty'] . '* ' . $val['name'] . ' (' . $val['model'] . ')';
            $data[$i]['tax'] = zen_display_tax_value($val['tax']) . '%';
            if (isset($val['attributes'])){
                foreach($val['attributes'] as $key2 => $val2){
                    $data[$i]['name'] .= "\n\t" . $val2['option'] . ': ' . $val2['value'];
                    $data[$i]['qty_name'] .= "\n\t" . $val2['option'] . ': ' . $val2['value'];
                    $data[$i]['qty_name_model'] .= "\n\t" . $val2['option'] . ': ' . $val2['value'];
                    }
                }
            $data[$i]['singleE'] = $this->mr(html_entity_decode($this -> currencies -> format($val['price'], true, $this -> order -> info['currency'], $this -> order -> info['currency_value'])));
            $data[$i]['singleI'] = $this->mr(html_entity_decode($this -> currencies -> format($val['price'] + $val['price'] * $val['tax'] / 100, true, $this -> order -> info['currency'], $this -> order -> info['currency_value'])));
            $data[$i]['extraE'] = $this->mr(html_entity_decode($this -> currencies -> format($val['onetime_charges'], true, $this -> order -> info['currency'], $this -> order -> info['currency_value'])));
            $data[$i]['extraI'] = $this->mr(html_entity_decode($this -> currencies -> format($val['onetime_charges'] + $val['tax'] * $val['onetime_charges'] / 100, true, $this -> order -> info['currency'], $this -> order -> info['currency_value'])));
            $data[$i]['sumE'] = $this->mr(html_entity_decode($this -> currencies -> format($val['qty'] * ($val['price']) + $val['onetime_charges'], true, $this -> order -> info['currency'], $this -> order -> info['currency_value'])));
            $data[$i]['sumI'] = $this->mr(html_entity_decode($this -> currencies -> format($val['qty'] * ($val['price'] + $val['price'] * $val['tax'] / 100) + ($val['onetime_charges'] + $val['tax'] * $val['onetime_charges'] / 100), true, $this -> order -> info['currency'], $this -> order -> info['currency_value'])));
            $i++;
            }
            #rldp($data, 'DATA');
            #die();
        return $data;
        }
    
    function getTotalData(){
        $data = array();
        $i = 0;
        foreach($this -> order -> totals as $key => $val){
            $data[$i]['title'] = html_entity_decode($val['title']);
            $data[$i]['text'] = $this->mr(html_entity_decode($val['text']));
            $data[$i]['class'] = $val['class'];
            $i++;
            }
        return $data;
        }
    
    function makeProducts(){
        $productData = $this -> getProductData();
        $this->pdf->SetFont($this -> fonts2['table'], '');
        $this->pdf->SetFontSize($this -> t1Opt['fontSize']);
        $this->pdf->SetY($this -> delta['invoiceProducts'] + $this->pdf->GetY());
        $this->pdf->SetX($this -> margin['left']);
        
        // table-header
        $this->pdf->SetFillColor(199);
        foreach ($this->t1Col as $key => $value){
                if(is_null($this -> t1Opt['cols'][$key]['width'])){
                    $wi = 10;
                } else {
                    $wi = $this -> t1Opt['cols'][$key]['width'];
                }
            $this->pdf->Cell($wi, $this -> t1Opt['fontSize'] / 2, $value , '1', 0 , $this -> t1Opt['cols'][$key]['justification'], 1);
            }
        
        $this->pdf->SetFont($this -> fonts2['general']);
        $this->pdf->SetXY($this -> margin['left'], $this->pdf->GetY() + $this -> t1Opt['fontSize'] / 2);
        $i = 0;
        
        $width = array();
        $allign = array();
        foreach ($this->t1Col as $key => $value){
            $width[] = $value;
            $allign[] = $this -> t1Opt['cols'][$key]['justification'];
            }
        $this -> SetAligns($allign);
        
        foreach ($productData as $pKey => $pValue){
            $mValue = array();
            $width = array();
            foreach ($this -> t1Col as $key => $value){
                if(is_null($this -> t1Opt['cols'][$key]['width'])){
                    $width[] = 10;
                } else {
                    $width[] = $this -> t1Opt['cols'][$key]['width'];
                }
                $mValue[] = $pValue[$key];
                }
            $this -> SetWidths($width);
            $this -> Row($mValue);
        }
        }
    
    function makeHC($txt){
        $this->pdf->Cell(122, 8, $txt, 0);  
    }
    
    function makeTotal(){
        $totalData = $this -> getTotalData();
        $this->pdf->SetFont($this -> fonts2['general'], '');
        $this->pdf->SetFontSize($this -> t1Opt['fontSize']);
        $this->pdf->SetFillColor(199);
        $this->pdf->SetX($this -> margin['left']);
        
        $w = 0;
        foreach ($this->widths as $value) {
            $w += $value;
        }
        $leftR = $w + $this->pdf->lMargin;
        $leftL = $w + $this->pdf->lMargin;
        
        $i = 0;
        $m = 1;
        
        foreach ($totalData as $key => $value){
            $y = $i % 2;
            $x = round($this->pdf->GetStringWidth($value['title']), 1);
            $m = max($m, $x);
            $leftL = $leftR - 20 - $m;
            if($value['class']=='ot_total'){
                $this->pdf->SetLineWidth(1);
                $this->pdf->line($leftL, $this->pdf->GetY(), $leftR, $this->pdf->GetY());
                $this->pdf->setY($this->pdf->GetY() + 0.8);
            }
            $this->pdf->Cell(160.5, $this -> t1Opt['fontSize'] / 2, $value['title'] , '0', 0 , 'R', $y);
            $this->pdf->Cell(20, $this -> t1Opt['fontSize'] / 2, $value['text'] , '0', 0 , 'R', $y);
            $this->pdf->SetXY($this -> margin['left'], $this->pdf->GetY() + $this -> t1Opt['fontSize'] / 2);
            $i++;
            }
        $this->pdf->SetLineWidth(1.3);
        $this->pdf->line($leftL, $this->pdf->GetY(), $leftR, $this->pdf->GetY());
        }
    
    function isMultiLingual(){
        global $db;
        $sql = "SHOW  TABLES  LIKE  '" . TABLE_CONFIGURATION_LANGUAGE . "'";
        $res = $db -> Execute($sql);
        if($res -> RecordCount() == 0){
            return false;
            }else{
            return true;
            }
        }
    
    function makeDebugInfo(){
        if($this -> debug['debug'] == 1){
            $this->pdf->addPage();
            $this->pdf->SetXY(10, 10);
            $this->pdf->SetFontSize(8);
            $this->pdf->MultiCell(0, 3, $this -> debugInfo, 1);
            }
        }
    function getPDFFileName(){
        $pdfName = $this -> oID . '_' . md5($this->order->customer['email_address']) . ".pdf";
        return $this->pdfPath['path'] . $pdfName;
    }
    
    function getPDFAttachments(){
        $attachArray = array();
        $attachArray[] = array('file'=>$this->getPDFFileName(), 'mime_type'=>'pdf');      
        $attachements = explode('|', RL_INVOICE3_SEND_ATTACH);
        foreach ($attachements as $value) {
            $file = DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/' . $value;
            if(file_exists($file)){
                $attachArray[] = array('file'=>$file, 'mime_type'=>'pdf');
            }
        }
        return $attachArray;
    }
        
    function writePDF($onlyFile = false){
        $pdfName = $this -> oID . ".pdf";
        if(!$onlyFile){
            $this->pdf->Output($pdfName, "I");   
        }
        if($this->pdfPath['save'] == 1){
            $this->pdf->Output($this->getPDFFileName(), "F");
            }
        $this->pdf->_closeParsers();   
        }
    function createPdfFile($onlyFile = false){
        if(file_exists($this->getPDFFileName())){
            #$onlyFile = 
        }
        $this -> makeAddr();
        $this -> makeInvoiceNumber();
        $this -> makeProducts();
        $this -> makeTotal();
        $this -> writePDF($onlyFile);

        }
    }
    
################

rl_invoice3::checkInstall();
$paper = rl_invoice3::getDefault(RL_INVOICE3_PAPER, array('format' => 'A4', 'unit' => 'mm', 'orientation' => 'P'));

