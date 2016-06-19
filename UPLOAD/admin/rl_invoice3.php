<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: rl_invoice3.php 2016-06-19 07:19:17Z webchills $
 */
 
require ('includes/application_top.php');
require (DIR_WS_CLASSES . 'currencies.php');
include (DIR_WS_CLASSES . 'order.php');
require_once (DIR_FS_CATALOG . DIR_WS_CLASSES . 'class.rl_invoice3.php');
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


