<?php
/**
 * 
 * @package rl_invoice3
 * @copyright Copyright 2005-2009 langheiter.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: http://demo.zen-cart.at/docs/rl_invoice3/ 
 * @version $Id$
 */

 // amazon|amazon_templ
 // col_templ_1|options_templ_1
$fi = DIR_FS_CATALOG . DIR_WS_INCLUDES . 'pdf/rl_invoice3_def_functions.php';
if(file_exists($fi)){
    include($fi);
}

// variables used at col-definitions 
$realPW = 210;
$tm = 88;

$dd = 20;
$lm1 = 194-$dd;
$rm1 = 168-$dd;

$lm2 = 129-$dd;
$rm2 = 103-$dd;

#######################################################################################################################
// amazon|amazon_templ
$colsP['amazon'] = array(   // product-table columns
     'subtotalI' => '...',  // do not change, its for summation
     'subtotalE' => '...',  // do not change
     'pos' => 'Pos.   ',
     'model' => TABLE_HEADING_PRODUCTS_MODEL,
     'model' => "Kunde Artikel-Nr.\n ",
     'modelF' => "FROEWIS Artikel-Nr. ",
     'name' => TABLE_HEADING_PRODUCTS . "\n  ",
     #'name_only' => TABLE_HEADING_PRODUCTS . "\n  ",
     'attrib_only' => 'Attribute' . "\n  ",
     'origin' => "Ursp.    ",  // additional field, define colsAddProd in optionsArray
     'customs_tariff_number' => 'Zolltarif- nummer',  // additional field
     'qty' => TABLE_HEADING_QTY,
     'qty' => 'Stück- menge',
     'singleE' => TABLE_HEADING_PRICE_EXCLUDING_TAX_AMAZON,
     'singleE' => "Einzelpreis\n ",
//     'tax' => TABLE_HEADING_TAX3,
     'sumE' => TABLE_HEADING_TOTAL_EXCLUDING_TAX_AMAZON,
     'sumE' => "Gesamtpreis\n ",
    );

$optionsP['amazon_templ'] = array(
    'subtotal'=>'subtotalE', 
    'paperOriantation'=>'P',    // P=Portrait, L=Landscape
    'fontSize' => 8,            // general fontsize
    'fontSizeProducts' => 7,    // fontsize products-table
    'fontSizeTotal' => 8,       // fontsize for order_totals
    'showHeadings' => 1,        // future
    'shaded' => 1,              // future
    'xPos' => 'left',           // future
    'xOrientation' => 'right',  // future
    'width' => $realPW-35,      // do not change !!!
    'lineHeightAddress' => 4,   // line spacing for adresses
    'lineHeightInvoiceNumber' => 5,     // line spacing for InvoiceNumber Block
    'fontSizeInvoiceNumber' => 8,       // fontsize for InvoiceNumber Block
    'fontSizeAddress' => 9,             // fontsize for address block
    'makeInvoiceNumber' => false,       // en/dis-able InvoiceNumber Block
    'bgPDFLang' => array('43'  => 'rl_invoice3_bg.pdf',          // language specific background pdf-file
                         '1'  => 'rl_invoice3_bg_en.pdf',
    ),
    'attachLang' =>                                 // language specific additional pdf-attachements
        array('43' => array('agb.pdf',
                            'widerruf.pdf',
                            ),
           ),
        array('1'  => array('agb_1.pdf',
                            'widerruf_1.pdf',
                            ),
        ),
     'cols' => array(                               //     
         'subtotalI' => array('justification' => 'R', 'width' => 0),
         'subtotalE' => array('justification' => 'R', 'width' => 0),
         'qty' => array('justification' => 'R', 'width' => 13),
         'model' => array('justification' => 'L', 'width' => 24),
         'name' => array('justification' => 'L', 'width' => 45, 'backcolor' => '89, 150, 89', 'textcolor'=>'246, 225, 97'),
         #'name_only' => array('justification' => 'L', 'width' => 40, 'textcolor' => '240, 0, 0'),
         'attrib_only' => array('justification' => 'L', 'width' => 53, 'backcolor' => '240, 0, 0'),
         'singleE' => array('justification' => 'R', 'width' => 20),
         'tax' => array('justification' => 'R', 'width' => 15),
         'sumE' => array('justification' => 'R', 'width' => 20),
        ),
     'addCols' => array(    // additional columns at absolute positions
        // x == horiz-postion, y == verti-position, 
        // if db==true, you must use the columnname from table orders
        // value == text OR a php-function which returns an ad-hoc-value
        'z1'            => array('x'=> 15, 'y'=>'35', 'db'=> false, 'value'=> RL_INVOICE3_ORDERINVOICE, 'fs'=>14),
        'z21_R'         => array('x'=> 15, 'y'=>'43', 'db'=> false, 'value'=> getInvNr($this->oID), 'fs'=>10),
        #'delivery_date' => array('x'=> 177, 'y'=>'43', 'db'=> true, 'value'=> '12.34.5678', 'fs'=>10),
        'citydate' => array('x'=> 147, 'y'=>'43', 'db'=> false, 'value'=> getOrtDatum(), 'fs'=>10),

        'rechdat_L'     => array('x'=> $lm1, 'y'=> $tm, 'db'=> false, 'value'=> RL_INVOICE3_INVOICEDATE, 'fs'=>8, 'LR'=>'R'),
        'rechdat_R'     => array('x'=> $rm1, 'y'=> $tm, 'db'=> false, 'value'=> getInvDate($this->oID), 'fs'=>8),
        'kontakt_L'     => array('x'=> $lm1, 'y'=> $tm+ 4, 'db'=> false, 'value'=> RL_INVOICE3_CONTACT, 'fs'=>8, 'LR'=>'R'),
        'kontakt_R'     => array('x'=> $rm1, 'y'=> $tm+ 4, 'db'=> false, 'value'=> STORE_OWNER, 'fs'=>8),
        'mobil_L'       => array('x'=> $lm1, 'y'=> $tm+ 8, 'db'=> false, 'value'=> RL_INVOICE3_TEL, 'fs'=>8, 'LR'=>'R'),
        'mobil_R'       => array('x'=> $rm1, 'y'=> $tm+ 8, 'db'=> false, 'value'=> '+423 787 0507', 'fs'=>8),
        'mail_L'        => array('x'=> $lm1, 'y'=> $tm+12, 'db'=> false, 'value'=> RL_INVOICE3_MAIL, 'fs'=>8, 'LR'=>'R'),
        'mail_R'        => array('x'=> $rm1, 'y'=> $tm+12, 'db'=> false, 'value'=> STORE_OWNER_EMAIL_ADDRESS, 'fs'=>8),
       
        'bestvom_L'     => array('x'=> $lm2, 'y'=> $tm, 'db'=> false, 'value'=> RL_INVOICE3_ORDERFROM, 'fs'=>8, 'LR'=>'R'),
        'date_purchased'=> array('x'=> $rm2, 'y'=> $tm, 'db'=> true, 'value'=> '13.11.2010', 'fs'=>8),
        'bestnr_L'      => array('x'=> $lm2, 'y'=> $tm+ 4, 'db'=> false, 'value'=> RL_INVOICE3_ORDERID, 'fs'=>8, 'LR'=>'R'),
        'orders_id'=> array('x'=> $rm2, 'y'=> $tm+ 4, 'db'=> true, 'value'=> '9999', 'fs'=>8),
        'besteller_L'   => array('x'=> $lm2, 'y'=> $tm+ 8, 'db'=> false, 'value'=> RL_INVOICE3_BUYER, 'fs'=>8, 'LR'=>'R'),
        'customers_name'=> array('x'=> $rm2, 'y'=> $tm+ 8, 'db'=> true, 'value'=> '', 'fs'=>8),
        'knr_L'         => array('x'=> $lm2, 'y'=> $tm+12, 'db'=> false, 'value'=> RL_INVOICE3_CUSTOMERNO, 'fs'=>8, 'LR'=>'R'),
        'customers_id'  => array('x'=> $rm2, 'y'=> $tm+12, 'db'=> true, 'fs'=>8),
        ),
       
     'colsAddProd' => array(    // additional columns for products-table; you must use column-name from table orders_products
                                // or you have to use the key func which defines the later used php-function
                                // look at rl_invoice3_def_functions
         'modelF' => array('justification' => 'L', 'width' => 0),
         'origin' => array('justification' => 'L', 'width' => 0),
         'customs_tariff_number' => array('justification' => 'L', 'width' => 0),
         'pos'   => array('justification' => 'L', 'width' => 8, 'func'=>'getPos'),
        ),
     'colsRest' => array(   // additional pseudo-columns added after products-table 
        'delta1' => array('x'=> $rm2, 'y'=>'100', 'db'=> true, 'value'=> "\n", 'fs'=>10, 'border'=>''),
        #'zb' => array('x'=> $rm2, 'y'=>'100', 'db'=> true, 'value'=> 'Zahlungsbedingungen: ' . getCustomerFieldValue($this->order->customer['id'], 'termpayment'), 'fs'=>10, 'border'=>''),
        'delta2' => array('x'=> $rm2, 'y'=>'100', 'db'=> true, 'value'=> "\n", 'fs'=>10, 'border'=>''),
        'zoll'   => array('x'=> $rm2, 'y'=>'100', 'db'=> true, 'value'=> RL_INVOICE3_THEEND, 'fs'=>12, 'border'=>''),
        'prodDetailWidth'   => array('x'=> $rm2, 'y'=>'100', 'db'=> false, 'fs'=>8, 'border'=>'', 'value'=>'ProdDetailBreite: ', 'func'=>'getProdDetailWidthE'),
        ),
    );
#######################################################################################################################
