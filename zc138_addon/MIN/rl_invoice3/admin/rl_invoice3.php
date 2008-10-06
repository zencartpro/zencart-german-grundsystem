<?php
/**
 * @package ajax
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: rl_invoice2.php 353 2008-09-11 11:49:20Z hugo13 $
 * 
 * version: 2.0.0 // 20070531
 * 
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: readme_rl_invoice.pdf|txt 
 */


require('includes/application_top.php');
require(DIR_WS_CLASSES . 'currencies.php');
include(DIR_WS_CLASSES . 'order.php');
require_once(DIR_FS_CATALOG . DIR_WS_INCLUDES . 'classes/class.rl_invoice3.php');



if($_GET['test'] == 'PDF'){
    $pdfT = new rl_invoice3($_GET['oID'], 'L', $paper['unit'], $paper['format']);
    $pdfT->pdf->setY(30);
    $pdfT->makeHC("combination from rl_invoice_def.php defintions\n\n");
    foreach($pdfT->optionsP as $key => $val){
        foreach($pdfT->colsP as $key2 => $val2){
            $pdfT->setTemplate($val2, $val);
            $pdfT -> makeProducts();
            $pdfT->makeHC("colsP: $key2   //  optionsP: $key");
        }
    }
    $pdfT->makeHC("combination from rl_invoice_def.php defintions");
    $pdfT -> writePDF();      
    exit();
}



$pdfT = new rl_invoice3($_GET['oID'], $paper['orientation'], $paper['unit'], $paper['format']);

$pdfT->createPdfFile();
    