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
 * generates a rl_invoice3_fontest.pdf file with all available fonts
 */

require('fpdi.php');
require('../configure.php');
define('FPDF_FONTPATH', DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/font/');

$pdf = new FPDI();

$pagecount = $pdf->setSourceFile('rl_invoice3_bg.pdf');
$tplidx = $pdf->importPage(1);


$pdf->addPage();
$pdf->useTemplate($tplidx, 0, 0);

$fonts = array( 'dejavusansb',  'dejavusanscondensedbi',  'dejavusanscondensedb',  'dejavusanscondensedi',  
                'dejavusanscondensed',  'dejavusans-extralight',  'dejavusansi',  'dejavusansmonobi',  'dejavusansmonob',  'dejavusansmonoi', 
                'dejavusansmono',  'dejavusans',  'dejavuserifbi',  'dejavuserifb',  'dejavuserifcondensedbi',  'dejavuserifcondensedb',  
                'dejavuserifcondensedi',  'dejavuserifcondensed',  'dejavuserifi',  'dejavuserif',  'freemonobi',  'freemonob',  'freemonoi',  
                'freemono',  'freesansbi',  'freesansb',  'freesansi',  'freesans',  'freeserifbi',  'freeserifb',  'freeserifi',  'freeserif',  
                );
print_r($fonts);

$pdf->SetTitle("UFPDF is Cool.\näöüßƒ ıš ČŏōĹ");
$pdf->SetAuthor('hugo13');
$pdf->setLeftMargin(20);

$pdf->sety(40);
foreach ($fonts as $key => $value) {
    echo $value;
    $pdf->AddFont($value, '', $value . '.php');       
    
    for($i=8; $i<=14; $i=$i+2){
        $pdf->SetFont($value, '', $i);
        $pdf->Write(5, $value . ": $i : €@^°äöüßÄÖÜ    \n");
    }
    $pdf->Write($i, "\n");

    echo ' :: OK<br>';
}

$pdf->Output('rl_invoice3_fontest.pdf', 'F');
