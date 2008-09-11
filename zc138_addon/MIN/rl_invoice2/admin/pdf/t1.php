<?php
error_reporting(E_ALL);
require('fpdi.php');
define('FPDF_FONTPATH','fonts/');


$pdf = new FPDI();

$pagecount = $pdf->setSourceFile('RL_INVOICE3_bg.pdf');
$tplidx = $pdf->importPage(1);


$pdf->addPage();
$pdf->useTemplate($tplidx, 0, 0);

$fonts = array('dejavusansbi',  'dejavusansb',  'dejavusanscondensedbi',  'dejavusanscondensedb',  'dejavusanscondensedi',  
                'dejavusanscondensed',  'dejavusans-extralight',  'dejavusansi',  'dejavusansmonobi',  'dejavusansmonob',  'dejavusansmonoi', 
                'dejavusansmono',  'dejavusans',  'dejavuserifbi',  'dejavuserifb',  'dejavuserifcondensedbi',  'dejavuserifcondensedb',  
                'dejavuserifcondensedi',  'dejavuserifcondensed',  'dejavuserifi',  'dejavuserif',  'freemonobi',  'freemonob',  'freemonoi',  
                'freemono',  'freesansbi',  'freesansb',  'freesansi',  'freesans',  'freeserifbi',  'freeserifb',  'freeserifi',  'freeserif',  
                );
print_r($fonts);

#$fonts = file('fonts/f.txt');
#print_r($fonts);

$pdf->SetTitle("UFPDF is Cool.\näöüßƒ ıš ČŏōĹ");
$pdf->SetAuthor('hugo13');
#$pdf->AddFont('courier', '', 'courier.php');
#$pdf->AddFont('facette', '', 'facette.php');
#$pdf->SetFont('facette', '', 14);
/*
$pdf->setxy(99, 99);
$pdf->Write(12, "UFPDF is Cool.\n");
$pdf->Write(12, "äöüßÄÖÜ");
$pdf->SetFont('freeserif', '', 14);  
$pdf->Write(12, "ıš ČŏōĹ.\n");

*/

$pdf->setxy(10, 40);
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

#$pdf->addFont('arial');
#$pdf->setxy(99, 99);
#$pdf-> Cell(111, 6, "Rechnungsadresse<br>", 1, 2, 'L');
#$pdf-> MultiCell(111, 6, 'äöüßÄÖÜ', 3, 1, 'L');




$pdf->Output('newpdf.pdf', 'F');
#$pdf->Output