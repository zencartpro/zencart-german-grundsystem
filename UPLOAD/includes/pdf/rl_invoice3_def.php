<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: rl_invoice3_def.php 2016-06-19 07:19:17Z webchills $
 */
/**
 * COLUMNS   #####
 */

 // amazon|amazon_templ|total_col_1|total_opt_1
 // col_templ_1|options_templ_1|total_col_1|total_opt_1
 
 
$realPW = 210;

// amazon|amazon_templ|total_col_1|total_opt_1 
$colsP['amazon'] = array(
     'subtotalI' => '...',
     'qty' => TABLE_HEADING_QTY,
     'model' => TABLE_HEADING_PRODUCTS_MODEL,
     'name' => TABLE_HEADING_PRODUCTS,
     'singleI' => TABLE_HEADING_PRICE_EXCLUDING_TAX_AMAZON,
     'tax' => TABLE_HEADING_TAX3,
     'sumI' => TABLE_HEADING_TOTAL_EXCLUDING_TAX_AMAZON,
    );
$optionsP['amazon_templ'] = array(
    "subtotal"=>'subtotalE', 
    //"paperOriantation"=>"P", 
    "fontSize" => 10, 
    'showHeadings' => 1, 
    'shaded' => 0, 
    'lineHeightInvoiceNumber' => 4,
    'fontSizeInvoiceNumber' => 10,
    'xPos' => 'left', 
    'xOrientation' => 'right', 
    'width' => $realPW-35,
    'bgPDFLang' => array('43' => 'rechnung_de.pdf',
                         '1'  => 'rechnung_en.pdf',
    ),
    'attachLang' => 
        array('43' => array('agb_de.pdf',
                            'widerruf_de.pdf',
                            ),
           ),
        array('1'  => array('agb_en.pdf',
                            'widerruf_en.pdf',
                            ),
        ),
     'cols' => array(
         'subtotalI' => array('justification' => 'R', "width" => 0),
         'qty' => array("justification" => "L", "width" => 16),
         'model' => array("justification" => "L", "width" => 28),
         'name' => array('justification' => 'L', "width" => 70),
         'singleI' => array('justification' => 'R', "width" => 22),
         'tax' => array("justification" => "R", "width" => 16),
         'sumI' => array('justification' => 'R', "width" => 24),
        )
    );

// T1|T1_options|total_col_1|total_opt_1    
$colsP['T1'] = array(
     'subtotalI' => '...',
     'subtotalE' => '...',
     'qty' => TABLE_HEADING_QTY,
     'model' => TABLE_HEADING_PRODUCTS_MODEL,
     'name' => TABLE_HEADING_PRODUCTS,
     'tax' => TABLE_HEADING_TAX3,
     'singleI' => TABLE_HEADING_PRICE_INCLUDING_TAX,
     'extraI' => TABLE_HEADING_EXTRA,
     'sumI' => TABLE_HEADING_TOTAL_INCLUDING_TAX,
    );    
$optionsP['T1_options'] = array("subtotal"=>'subtotalE', "fontSize" => 8, 'showHeadings' => 1, 'shaded' => 1, 'xPos' => 'left', 'xOrientation' => 'right', 'width' => $realPW-35,
     'cols' => array(
         'subtotalI' => array('justification' => 'R', "width" => 0),
         'subtotalE' => array('justification' => 'R', "width" => 0),
         'qty' => array("justification" => "L", "width" => 15),
         'model' => array("justification" => "L", "width" => 25),
         'name' => array('justification' => 'L', "width" => 55),
         'tax' => array("justification" => "R", "width" => 15),
         'singleI' => array('justification' => 'R', "width" => 25),
         'extraI' => array('justification' => 'R', "width" => 20),
         'sumI' => array('justification' => 'R', "width" => 25),
        )
    );
    
    
// all|all_options|total_col_1|total_opt_1        
$colsP['all'] = array(
     'subtotalI' => '...',
     'subtotalE' => '...',
     'qty' => TABLE_HEADING_QTY,
     'model' => TABLE_HEADING_PRODUCTS_MODEL,
     'name' => TABLE_HEADING_PRODUCTS,
     'qty_name' => TABLE_HEADING_PRODUCTS,
     'qty_name_model' => TABLE_HEADING_PRODUCTS,
     'tax' => TABLE_HEADING_TAX3,
     'singleE' => TABLE_HEADING_PRICE_EXCLUDING_TAX,
     'singleI' => TABLE_HEADING_PRICE_INCLUDING_TAX,
     'extraI' => TABLE_HEADING_EXTRA,
     'extraE' => TABLE_HEADING_EXTRA,
     'sumE' => TABLE_HEADING_TOTAL_EXCLUDING_TAX,
     'sumI' => TABLE_HEADING_TOTAL_INCLUDING_TAX,
    );
$optionsP['all_options'] = array("subtotal"=>'subtotalE', 
                                "paperOriantation"=>"L", 
                                'bgPDFLang' => array('DE' => 'rl_invoice3_bgL.pdf',
                                                     'EN' => 'rl_invoice3_bgL_en.pdf',
                                                    
                                ),
                                "fontSize" => 5, 
                                'showHeadings' => 1, 
                                'shaded' => 1, 'xPos' => 
                                'left', 
                                'xOrientation' => 'right', 
                                'width' => $realPW-35 + 235,
     'cols' => array(
         'subtotalI' => array('justification' => 'R', "width" => 0),
         'subtotalE' => array('justification' => 'R', "width" => 0),
         'qty' => array("justification" => "L", "width" => 6),
         'model' => array("justification" => "L", "width" => 15),
         'name' => array('justification' => 'L', "width" => 40),
         'qty_name' => array('justification' => 'L', "width" => 40),
         'qty_name_model' => array('justification' => 'L', "width" => 54),
         'tax' => array("justification" => "R", "width" => 7),
         'singleE' => array('justification' => 'R', "width" => 15),
         'singleI' => array('justification' => 'R', "width" => 15),
         'extraI' => array('justification' => 'R', "width" => 15),
         'extraE' => array('justification' => 'R', "width" => 15),
         'sumE' => array('justification' => 'R', "width" => 15),
         'sumI' => array('justification' => 'R', "width" => 15),
        )
    );
    
    
// T2|T2_options|total_col_1|total_opt_1 
$colsP['T2'] = array(
     'subtotalI' => '...',
     'subtotalE' => '...',
     'qty_name' => TABLE_HEADING_PRODUCTS,
     'model' => TABLE_HEADING_PRODUCTS_MODEL,
     'tax' => TABLE_HEADING_TAX3,
     'singleE' => TABLE_HEADING_PRICE_EXCLUDING_TAX,
     'singleI' => TABLE_HEADING_PRICE_INCLUDING_TAX,
     'sumE' => TABLE_HEADING_TOTAL_EXCLUDING_TAX,
     'sumI' => TABLE_HEADING_TOTAL_INCLUDING_TAX,
    );
$optionsP['T2_options'] = array("subtotal"=>'subtotalE', "fontSize" => 7, 'showHeadings' => 1, 'shaded' => 1, 'xPos' => 'left', 'xOrientation' => 'right', 'width' => $realPW-35 + 235,
     'cols' => array(
         'subtotalI' => array('justification' => 'R', "width" => 0),
         'subtotalE' => array('justification' => 'R', "width" => 0),
         'qty_name' => array('justification' => 'L', "width" => 30),
         'model' => array("justification" => "L", "width" => 15),
         'tax' => array("justification" => "R", "width" => 10),
         'singleE' => array('justification' => 'R', "width" => 35),
         'singleI' => array('justification' => 'R', "width" => 20),
         'sumE' => array('justification' => 'R', "width" => 25),
         'sumI' => array('justification' => 'R', "width" => 15),
        )
    );
        

// T3|T3_templ|total_col_1|total_opt_1 
$colsP['T3'] = array(
     'subtotalI' => '...',
     'subtotalE' => '...',
     'qty_name_model' => TABLE_HEADING_PRODUCTS,
     'singleE' => TABLE_HEADING_PRICE_EXCLUDING_TAX_AMAZON,
     'tax' => TABLE_HEADING_TAX3,
     'sumE' => TABLE_HEADING_TOTAL_EXCLUDING_TAX_AMAZON,
    );
$optionsP['T3_templ'] = array("subtotal"=>'subtotalE', "fontSize" => 8, 'showHeadings' => 1, 'shaded' => 1, 'xPos' => 'left', 'xOrientation' => 'right', 'width' => $realPW-35,
     'cols' => array(
         'subtotalI' => array('justification' => 'R', "width" => 0),
         'subtotalE' => array('justification' => 'R', "width" => 0),
         'qty_name_model' => array('justification' => 'L', "width" => 115),
         'singleE' => array('justification' => 'R', "width" => 25),
         'tax' => array("justification" => "R", "width" => 15),
         'sumE' => array('justification' => 'R', "width" => 25),
        )
    );
        

        
/**
 * TOTALS
 * COLUMNS
 */
 $cols = array(
    'title' => "<b>Anzahl</b>",
     'text' => '<b>ArtiklNr.</b>',
    );
 $options = array("fontSize" => 11, 'showHeadings' => 0, 'shaded' => 0, 'xPos' => 'left', 'showLines' => '0'
     , 'xOrientation' => 'right', 'width' => $realPW-35,
     'cols' => array(
        'title' => array('justification' => 'right'),
         'text' => array('justification' => 'right', "width" => 60)
        )
    );

