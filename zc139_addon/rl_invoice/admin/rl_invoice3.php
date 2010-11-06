<?php
/**
 * @package rl_invoice3
 * @copyright Copyright 2005-2009 langheiter.com 
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: http://demo.zen-cart.at/docs/rl_invoice3/
 * 
 * @version $Id: rl_invoice3.php 467 2009-01-07 19:45:45Z hugo13 $
 */
 
require ('includes/application_top.php');
require (DIR_WS_CLASSES . 'currencies.php');
include (DIR_WS_CLASSES . 'order.php');
require_once (DIR_FS_CATALOG . DIR_WS_INCLUDES . 'classes/class.rl_invoice3.php');
require_once ('../' . DIR_WS_LANGUAGES . $_SESSION['language'] . '/extra_definitions/rl_invoice3.php');

$paper = rl_invoice3::getDefault(RL_INVOICE3_PAPER, array('format' => 'A4', 'unit' => 'mm', 'orientation' => 'P'));

if ($_GET['test'] == 'PDF') {
    $sql = 'SELECT MAX(orders_id) as oid FROM '. TABLE_ORDERS;
    $res = $db->Execute($sql);
    $oID = intval($res->fields['oid']);
    if($oID < 1){
        echo 'noch keine bestellung vorhanden';
        exit();
    }
    $pdfT = new rl_invoice3($oID, $paper['orientation'], $paper['unit'], $paper['format']); 
    $pdfT->pdf->SetFont($pdfT->fonts2['general'], '', 12);
    $pdfT->pdf->setXY(30, 75);
    $pdfT->pdf->SetFontSize(18);
    $pdfT->makeHC("TEMPLATES from: rl_invoice_def.php ");
    $pdfT->pdf->SetFontSize($pdfT->t1Opt['fontSize']);
    $opt =array();
    $tpl =array();
    foreach ($pdfT->optionsP as $key => $value) {
        $tpl[] = $key;
    }
    foreach ($pdfT->colsP as $key => $value) {
        $opt[] = $key;
    }
    foreach ($opt as $key => $value) {
        $pdfT->pdf->addPage('L'); 
        $pdfT->setTemplate($pdfT->colsP[$value], $pdfT->optionsP[$tpl[$key]]);
        $p = $pdfT->makeProductTestData();
        $pdfT->makeProducts($p);
        $pdfT->makeHC("colsP: {}   //  optionsP: $value");
    }
    $fn = $pdfT->writePDF(true, true);
    #echo '<a class="dl" href="' . $fn . '">Download TestInvoice</a><script language="javascript" src="../../ajax/jquery.media.js"></script><a class="fonttest" href="' . $fn . '">FontTest</a>';
    echo '<a class="dl" href="' . $fn . '">Download TestInvoice</a><a class="fonttest" href="' . $fn . '">FontTest</a>';
    exit();
} else {
    $pdfT = new rl_invoice3($_GET['oID'], $paper['orientation'], $paper['unit'], $paper['format']);       
    $pdfT->createPdfFile();    
}


