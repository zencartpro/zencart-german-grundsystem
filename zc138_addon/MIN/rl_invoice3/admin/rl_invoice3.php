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
    foreach($pdfT->optionsP as $key => $val){
        foreach($pdfT->colsP as $key2 => $val2){
            #$pdfT->addPage('L');
            $pdfT->setTemplate($val2, $val);
            #$pdfT->setY($pdfT->getY()+90);
            #$pdfT -> makeAddr();
            #$pdfT -> makeInvoiceNumber();
            $pdfT->write(12, $key2 . ' :: ' . $key); 
            $pdfT -> makeProducts();
            $pdfT->write(12, $key2 . ' :: ' . $key);  
            #$pdfT -> makeTotal();

            #$pdfT -> writePDF();        
        }
    }
    $pdfT -> writePDF();      
    exit();
}



$pdfT = new rl_invoice3($_GET['oID'], $paper['orientation'], $paper['unit'], $paper['format']);



$pdfT -> makeAddr();
$pdfT -> makeInvoiceNumber();
$pdfT -> makeProducts();
$pdfT -> makeTotal();

$pdfT -> writePDF();

