<?php

/**
 * Copyright notice
 * 
 * (c) 2003 -2004 The zen-cart developers
 * All rights reserved
 * 
 * Portions Copyright (c) 2003 osCommerce
 * 
 * This script is part of the zen-cart project. The zen-cart project is
 * free software;
 * 
 * This source file is subject to version 2.0 of the GPL license,
 * that is bundled with this package in the file LICENSE, and is
 * available through the world-wide-web at the following url:
 * http://www.zen-cart.com/license/2_0.txt.
 * If you did not receive a copy of the zen-cart license and are unable
 * to obtain it through the world-wide-web, please send a note to
 * license@zen-cart.com so we can mail you a copy immediately.
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * 
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * This copyright notice MUST APPEAR in all copies of the script!
 * 
 * goto zen admin > customers > orders > pdf-invoice
 * 
 * version: 0.3 // 20041005
 * 
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com

generates pdf-invoices; please read: readme_rl_invoice.pdf|txt 

 $Id: rl_invoice.php,v 3.6 2004/11/18 08:48:42 rainer Exp $
 */
function dpO($call, $cname = 'NIX')
{
     echo '<br />' . $cname . ":<pre>";
     if (!is_array($call)){
         $call = htmlspecialchars($call);
         }
     print_r($call);
     if (is_array($call)){
         reset($call);
         }
     echo "</pre><hr></hr>";
     }
// ########################################
require_once('includes/class.ezpdf.php');
require('includes/application_top.php');
require(DIR_WS_CLASSES . 'currencies.php');
include(DIR_WS_CLASSES . 'order.php');
//////////////////////////////////////////////////////////////////////////////////////////
// Fr patch angefgt gek 
function EuroPatch($zeile){

  if(strstr($zeile,'&euro;')){
	 return  str_replace('&euro;',' € ',$zeile);
  }
}

function ExtractNumber($number){
  return substr($number,strpos($number,';') + 1 );
}

//////////////////////////////////////////////////////////////////////////////////////////////

class rlInvoice{
     var $logoTop = RL_INVOICE_TOP1;
     var $logoFile = RL_INVOICE_LOGO_SHOP_IMAGE;
     var $logoRow1 = array();
     var $logoRow2 = array();
    
     function rlInvoice($oID){
         global $db;
         $this -> db = $db;
         $this -> oID = zen_db_prepare_input($_GET['oID']);
         $this -> currencies = new currencies();
         $this -> order = new order($this -> oID);
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
        
         $this -> logoFile = 'images/' . RL_INVOICE_LOGO_SHOP_IMAGE;
         $this -> addressAfter = $this -> getDefault(RL_INVOICE_ADDRESS_AFTER, array('y' => '216', 'deltaY' => '30'));
 
         $this -> logoRow1 = $this -> getDefault(RL_INVOICE_ROW1, array('text' => ' ', 'fontSize' => '9', 'x' => '0', 'y' => '0'));
         $this -> logoRow2 = $this -> getDefault(RL_INVOICE_ROW2, array('text' => ' ', 'fontSize' => '9', 'x' => '0', 'y' => '0'));
         $this -> logoRow3 = $this -> getDefault(RL_INVOICE_ROW3, array('text' => ' ', 'fontSize' => '9', 'x' => '0', 'y' => '0'));
        
         $this -> margin = $this -> getDefault(RL_INVOICE_MARGIN, array('top' => '10', 'right' => '30', 'bottom' => '30', 'left' => '60'));
         $this -> footer = $this -> getDefault(RL_INVOICE_FOOTER, array('text' => 'RL_INVOICE_FOOTER', 'fontsize' => '8', 'x' => $this -> margin['left'], 'y' => '25'));
         $this -> paper = $this -> getDefault(RL_INVOICE_PAPER, array('format' => 'A4', 'orientation' => 'portrait'));
         $this -> templates = $this -> getDefault(RL_INVOICE_TABLE_TEMPLATE, array('pCols' => 'col_templ_1', 'pOptions' => 'options_templ_1', 'tCols' => 'total_col_1', 'tOptions' => 'total_opt_1'));
         $this -> fonts = $this -> getDefaultCheck(RL_INVOICE_FONTS, array('general' => '../fonts/arial.afm', 'table' => '../fonts/Courier.afm'));
         $this -> pdfPath = $this -> getDefault(RL_INVOICE_PDF_PATH, array('path' => ' 	../pdf/', 'save' => '1'));
         $this -> fontsOk = $this -> checkFonts();
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
             # if(isset($tmp[$i]) || $tmp[$i] == '# '){
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
             # if(isset($tmp[$i]) || $tmp[$i] == '# '){
            if(isset($tmp[$i]) && $tmp[$i] != '' && $tmp[$i] != '#'){
                 $def[$key] = $tmp[$i];
                 }
             $i++;
             }
         return $def;
         }
     function setRowDef($rr, & $pdf){
         if($rr['y'] == 0){
             $rr['y'] = $pdf -> y - $rr['fontSize'];
             }
         $pdf -> addText($pdf -> ez['leftMargin'] + $rr['x'], $rr['y'], $rr['fontSize'], $rr['text']);
         $pdf -> ezSetDy(- $rr['fontSize']);
         }
     function setRowDefORI($rr, & $pdf){
         if(!isset($rr[1])){
             $rr[1] = 10;
             }
         if(!isset($rr[2])){
             $rr[2] = 0;
             }
         if(!isset($rr[3])){
             $rr[3] = ($pdf -> y) - $rr[1];
             }
         $pdf -> addText($pdf -> ez['leftMargin'] + $rr[2], $rr[3], $rr[1], $rr[0]);
         $pdf -> ezSetDy(- $rr[1]);
         }
     function NoCache(){
         header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
         header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
         header("Cache-Control: no-cache");
         header("Pragma: no-cache");
         header("Cache-Control: post-check=0, pre-check=0");
         }
     function createPDF(){
         global $colsT, $optionsP;
         $pdf = & new Cezpdf($this -> paper['format'], $this -> paper['orientation']);
         $pdf -> ezSetMargins($this -> margin['top'], $this -> margin['bottom'], $this -> margin['left'], $this -> margin['right']);
         $pdf -> selectFont($this -> fonts['general']);
        
         $pdf -> ezStartPageNumbers(565, $this -> margin['bottom'], 8, 'left', "{PAGENUM}/{TOTALPAGENUM}");
         $logoSize = GetImageSize ($this -> logoFile);

// Patch fr Logo am rechten Rand
// Die untere Zeile auskommentieren
//       $pdf -> addJpegFromFile($this -> logoFile, $pdf -> ez['leftMargin'], $pdf -> ez['pageHeight'] - $pdf -> ez['topMargin'] - $logoSize[1], $logoSize[0], $logoSize[1]);
// Logo soll an den rechten Rand
		 $x1  =  $pdf -> ez['pageWidth'] - $pdf -> ez['RightMargin'] - $logoSize[0] - 30;

         $pdf -> addJpegFromFile($this -> logoFile, 
                 $x1, 
                 $pdf -> ez['pageHeight']  - $pdf -> ez['topMargin'] - $logoSize[1], 
                 $logoSize[0], $logoSize[1]);
// Ende Logo am rechten Rand
        
         $y1 = $pdf -> ez['pageHeight'] - $pdf -> ez['topMargin'];
         $y2 = $pdf -> ez['pageHeight'] - $pdf -> ez['topMargin'] - $logoSize[1];
         $x1 = $pdf -> ez['topMargin'];
         $x2 = $pdf -> ez['topMargin'] + $logoSize[0];

         $pdf -> addLink(RL_INVOICE_LOGO_LINK, $pdf -> ez['leftMargin'], $pdf -> ez['pageHeight'] - $pdf -> ez['topMargin'], $pdf -> ez['leftMargin'] + $logoSize[0], $pdf -> ez['pageHeight'] - $pdf -> ez['topMargin'] - $logoSize[1]);
         $pdf -> ezSetDy(- $logoSize[1]);
         $this -> setRowDef($this -> logoRow1, $pdf);
         $this -> setRowDef($this -> logoRow2, $pdf);
         $this -> setRowDef($this -> logoRow3, $pdf);
        
        /**
         * billing address
         */
         $adressTop = RL_INVOICE_ADDRESS_TOP;
         $pdf -> ezSetY($pdf -> ez['pageHeight'] - $adressTop);
         $Y = $pdf -> y;
         $x[0] = str_replace('<br>', "\n", zen_address_format($this -> order -> billing['format_id'], $this -> order -> billing, 1, '', '<br>'));
         $x[0] = iconv("UTF-8","ISO-8859-1",$x[0]);
         $pdf -> ezText($x[0], 12);
        /**
         * ship-to address
         */
         $pdf -> ezSetY($Y);
         $realPW = $pdf -> ez['pageWidth'] - $pdf -> ez['leftMargin'] - $pdf -> ez['RightMargin'];
         include('rl_invoice_def.php');
         // $x[0] durch $xs ersetzen
         $xs = str_replace('<br>', "\n", zen_address_format($this -> order -> delivery['format_id'], $this -> order -> delivery, 1, '', '<br>'));
         $xs = iconv("UTF-8","ISO-8859-1",$xs);
         $aml = $realPW / 2;

////////////// Patch Anschrift == Lieferanschrift
		 // $pdf -> ezText($x[0], 12);	  // alt
		 if(strcmp($x[0],$xs) != 0){ // Neu
            $pdf -> ezText($xs, 12, array('left' => $aml));
			}
////////////////////////////////////////////////////


        /**
         * date, InvoiceNo, ..
         */
         if($this -> addressAfter['y'] + $this -> addressAfter['deltaY'] < $pdf -> y){
            
             }
         $yA = $pdf -> ez['pageHeight'] - $pdf -> ez['topMargin'] - $this -> addressAfter['y'];
         $yB = $pdf -> y - $this -> addressAfter['deltaY'];
         if ($yA <= $yB){
             $pdf -> ezSetY($yA);
             }else{
             $pdf -> ezSetY($yB);
             }
         $y = $pdf -> y;
         $dat = str_replace('@DATE@', strftime(DATE_FORMAT_LONG), RL_INVOICE_CITY);
         $dat = iconv("UTF-8","ISO-8859-1",$dat);
         $txtLen = $pdf -> getTextWidth(10, $dat);
         $tmp = ENTRY_ORDER_ID . sprintf("%s%05d", RL_INVOICE_ORDER_ID_PREFIX, $this -> oID) . "\n";
         $tmp .= ENTRY_DATE_PURCHASED . " " . zen_date_long($this -> order -> info['date_purchased']);
         $tmp = iconv("UTF-8","ISO-8859-1",$tmp);
         $pdf -> ezText($tmp, 10);
         $pdf -> addText($pdf -> ez['pageWidth'] - $pdf -> ez['leftMargin'] - $txtLen, $y-10, 10, $dat);
         $tmp = ENTRY_PAYMENT_METHOD . " " . $this -> order->info['payment_method'];
         $tmp = iconv("UTF-8","ISO-8859-1",$tmp);
         $pdf -> ezText($tmp, 10);
        /**
         * list products
         */
         $pdf -> selectFont($this -> fonts['table']);
         $data = array();
         $i = 0;
        
         foreach($this -> order -> products as $key => $val){
             $data[$i]['qty'] = $val['qty'];
             $data[$i]['model'] = $val['model'];
             $val['name'] = iconv("UTF-8","ISO-8859-1",$val['name']);
             $data[$i]['name'] = $val['name'];
             $data[$i]['qty_name'] = $val['qty'] . '* ' . $val['name'];
             $data[$i]['qty_name_model'] = $val['qty'] . '* ' . $val['name'] . ' (' . $val['model'] . ')';

             $data[$i]['tax'] = zen_display_tax_value($val['tax']) . '%';
             if (isset($val['attributes'])){
                 foreach($val['attributes'] as $key2 => $val2){
                     $val2['value'] = iconv("UTF-8","ISO-8859-1",$val2['value']);
                     $data[$i]['name'] .= "\n\t" . $val2['option'] . ': ' . $val2['value'];
                     $data[$i]['qty_name'] .= "\n\t" . $val2['option'] . ': ' . $val2['value'];
                     $data[$i]['qty_name_model'] .= "\n\t" . $val2['option'] . ': ' . $val2['value'];
                     }
                 }

//  Euro Patch startet hier

             $data[$i]['singleE'] = html_entity_decode($this -> currencies -> format($val['final_price'], 
                             true, $this -> order -> info['currency'], 
                             $this -> order -> info['currency_value']));

			 $data[$i]['singleE'] = EuroPatch($data[$i]['singleE']);  // Patch Zeile 

             $data[$i]['singleI'] = html_entity_decode($this -> currencies -> format($val['final_price'] + $val['final_price'] * $val['tax'] / 100, true, $this -> order -> info['currency'], $this -> order -> info['currency_value']));
 
             $data[$i]['singleI'] =	EuroPatch($data[$i]['singleI']);  // Patch Zeile 

             $data[$i]['extraE'] = html_entity_decode($this -> currencies -> format($val['onetime_charges'], true, $this -> order -> info['currency'], $this -> order -> info['currency_value']));

             $data[$i]['extraE'] = EuroPatch($data[$i]['extraE']); // Patch Zeile

             $data[$i]['extraI'] = html_entity_decode($this -> currencies -> format($val['onetime_charges'] + $val['tax'] * $val['onetime_charges'] / 100, true, $this -> order -> info['currency'], $this -> order -> info['currency_value']));

             $data[$i]['extraI'] = EuroPatch($data[$i]['extraI']); // Patch Zeile 

             $data[$i]['sumE'] = html_entity_decode($this -> currencies -> format($val['qty'] * 
                                                                                 ($val['final_price']) + $val['onetime_charges'], 
                                                                                 true, $this -> order -> info['currency'], 
                                                                                 $this -> order -> info['currency_value']));

			 $data[$i]['sumE'] = EuroPatch($data[$i]['sumE']); // Patch Zeile

             $data[$i]['sumI'] = html_entity_decode($this -> currencies -> format($val['qty'] * ($val['final_price'] + $val['final_price'] * $val['tax'] / 100) + ($val['onetime_charges'] + $val['tax'] * $val['onetime_charges'] / 100), 
                      true, 
                      $this -> order -> info['currency'], 
                      $this -> order -> info['currency_value']));

             $data[$i]['sumI'] = EuroPatch($data[$i]['sumI']); // Patch Zeile

             $i++;
             }
         $pdf -> ezSetDy(-15);
         if($_GET['test'] == 'PDF'){
             foreach($optionsP as $key => $val){
                 foreach($colsP as $key2 => $val2){
                     $pdf -> ezTable($data, $val2, $key . '|' . $key2, $val);
                     $pdf -> ezSetDy(-3);
                     }
                 }
             }
         $pdf -> ezTable($data, $colsP[$this -> templates['pCols']], '', $optionsP[$this -> templates['pOptions']]);
         $pdf -> ezSetDy(-3);
        /**
         * TOTALS
         */
        $i = 0;
        foreach($this -> order -> totals as $key => $val){
	    $val['title'] = iconv("UTF-8","ISO-8859-1",$val['title']);
            if ($val['title'] == "Summe:") {
                $data[$i]['title'] =  "<b>" . html_entity_decode($val['title']) . "</b>";
                $data[$i]['text'] = "<b>" . html_entity_decode($val['text']) . "</b>";
            } else {
                $data[$i]['title'] = html_entity_decode($val['title']);
                $data[$i]['text'] = html_entity_decode($val['text']);
            }
            if ($val['title'] == "Mengenrabatt:") {
                $data[$i]['text'] = "-" . html_entity_decode($val['text']);
            }
	    if ($val['title'] == "Gruppenermäßigung:") {
		$data[$i]['text'] = "-" . html_entity_decode($val['text']);
            }
	    if (strpos($val['title'],"Gutschein") !== false) {
		$data[$i]['text'] = "-" . html_entity_decode($val['text']);
            }
	    if (strpos($val['title'],"Aktionskupon") !== false) {
		$data[$i]['text'] = "-" . html_entity_decode($val['text']);
            }
        $data[$i]['text'] = EuroPatch($data[$i]['text']);
        $i++;
        }

        $pdf -> ezTable($data, $cols, '', $options);
        /**
         * footer
         */
         $pdf -> selectFont($this -> fonts['general']);
         $pdf -> ezSetY($pdf -> ez['bottomMargin'] + $this -> footer['y']);
         $pdf -> ezText($this -> footer['text'], $this -> footer['fontsize'],array('justification' => 'center'));
        /**
         * write pdf to screen / file
         */
         $this -> NoCache();
         $pdf -> ezStream(array('Content-Disposition' => 'rl_invoice.pdf', 'Accept-Ranges' => 1));
         if($this -> pdfPath['save'] == 1){
             $content = $pdf -> ezOutput();
             $filename = trim($this -> pdfPath['path']) . $this -> oID . '.pdf';
             if (is_writable('pdf')){
                 if (!$handle = fopen($filename, 'w')){
                     echo "Cannot open file ($filename)";
                     # exit;
                }
                 if (fwrite($handle, $content) === FALSE){
                     echo "Cannot write to file ($filename)";
                     exit;
                     }
                 echo "Success, wrote ($somecontent) to file ($filename)";
                 fclose($handle);
                 }else{
                 echo "The file $filename is not writable";
                 }
             }
         }
     }

$invoice = new rlInvoice(51);
if($invoice -> fontsOk == true){
     $invoice -> createPDF() ;
     }else{
     dpo($invoice -> fonts, 'WRONG FONT PATH<br>goto admin > config > shop > RL_INVOICE_FONTS!!');
     }
?>