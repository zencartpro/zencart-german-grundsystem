<?php
/**
 * @package ajax
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 *
 * version: 2.0.0 // 20070531
 *
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: readme_rl_invoice.pdf|txt
 */
require ('includes/application_top.php');
require (DIR_WS_CLASSES . 'currencies.php');
include (DIR_WS_CLASSES . 'order.php');
require_once (DIR_FS_CATALOG . DIR_WS_INCLUDES . 'classes/class.rl_invoice3.php');
require_once ('../' . DIR_WS_LANGUAGES . $_SESSION['language'] . '/extra_definitions/rl_invoice3.php');

$paper = rl_invoice3::getDefault(RL_INVOICE3_PAPER, array('format' => 'A4', 'unit' => 'mm', 'orientation' => 'P'));
$pdfT = new rl_invoice3($_GET['oID'], $paper['orientation'], $paper['unit'], $paper['format']);

if ($_GET['test'] == 'PDF') {
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
        $pdfT->makeProducts();
        $pdfT->makeHC("colsP: {}   //  optionsP: $value");
    }
    $pdfT->writePDF();
    exit();
}

$pdfT->createPdfFile();
