<?php
// +----------------------------------------------------------------------+
//  $Id$
//
/**
 * COLUMNS   #####
 */

 // amazon|amazon_templ
 // col_templ_1|options_templ_1
 
 
$realPW = 210;

// amazon|amazon_templ
$colsP['amazon'] = array(
     'subtotalI' => '...',
     'subtotalE' => '...',
     'qty' => TABLE_HEADING_QTY,
     'model' => TABLE_HEADING_PRODUCTS_MODEL,
     'name' => TABLE_HEADING_PRODUCTS,
     'singleE' => TABLE_HEADING_PRICE_EXCLUDING_TAX_AMAZON,
     'tax' => TABLE_HEADING_TAX3,
     'sumE' => TABLE_HEADING_TOTAL_EXCLUDING_TAX_AMAZON,
    );
$optionsP['amazon_templ'] = array(
    'subtotal'=>'subtotalE', 
    'paperOriantation'=>'P', 
    'fontSize' => 8, 
    'fontSizeProducts' => 7,
    'fontSizeTotal' => 8,   
    'showHeadings' => 1, 
    'shaded' => 1, 
    'xPos' => 'left', 
    'xOrientation' => 'right', 
    'width' => $realPW-35,
    'bgPDFLang' => array('43' => 'rl_invoice3_bg.pdf',
                         '1'  => 'rl_invoice3_bg_en.pdf',
    ),
    'attachLang' => 
        array('43' => array('agb.pdf',
                            'widerruf.pdf',
                            ),
           ),
        array('1'  => array('agb_1.pdf',
                            'widerruf_1.pdf',
                            ),
        ),
     'cols' => array(
         'subtotalI' => array('justification' => 'R', 'width' => 0),
         'subtotalE' => array('justification' => 'R', 'width' => 0),
         'qty' => array('justification' => 'L', 'width' => 15),
         'model' => array('justification' => 'L', 'width' => 25),
         'name' => array('justification' => 'L', 'width' => 75),
         'singleE' => array('justification' => 'R', 'width' => 25),
         'tax' => array('justification' => 'R', 'width' => 15),
         'sumE' => array('justification' => 'R', 'width' => 25),
        )
    );


//STEVE added to change format of columns
// MV1|MV1_options
$colsP['MV1'] = array(
     'subtotalI' => '...',
     'subtotalE' => '...',
     'model' => TABLE_HEADING_PRODUCTS_MODEL,
     'name' => TABLE_HEADING_PRODUCTS,
	 'singleE' => TABLE_HEADING_PRICE_EXCLUDING_TAX,
     'tax' => TABLE_HEADING_TAX3,
     'singleI' => TABLE_HEADING_PRICE_INCLUDING_TAX,
	 'qty' => TABLE_HEADING_QTY,
     'sumI' => TABLE_HEADING_TOTAL_INCLUDING_TAX,
    );    
$optionsP['MV1_options'] = array('subtotal'=>'subtotalE',
    'fontSize' => 7,
    'fontSizeDatos' => 9,
    'fontSizeProducts' => 7,
    'fontSizeTotal' => 10,   //STEVE added for bigger total 
    'showHeadings' => 1,
    'shaded' => 1,
    'xPos' => 'left',
    'xOrientation' => 'right',
    'width' => $realPW-35,
         'cols' => array(
             'subtotalI' => array('justification' => 'R', 'width' => 0),
             'subtotalE' => array('justification' => 'R', 'width' => 0),
             'model' => array('justification' => 'C', 'width' => 20),
             'name' => array('justification' => 'L', 'width' => 65),
		     'singleE' => array('justification' => 'R', 'width' => 25),
             'tax' => array('justification' => 'R', 'width' => 8),
             'singleI' => array('justification' => 'R', 'width' => 25),
		     'qty' => array('justification' => 'R', 'width' => 10),
             'sumI' => array('justification' => 'R', 'width' => 25),
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
$optionsP['T1_options'] = array(
    'subtotal'=>'subtotalE', 
    'fontSize' => 8, 
    'fontSizeProducts' => 7,
    'fontSizeTotal' => 8,   
    'showHeadings' => 1, 
    'shaded' => 1, 
    'xPos' => 'left', 
    'xOrientation' => 'right', 
    'width' => $realPW-35,
     'cols' => array(
         'subtotalI' => array('justification' => 'R', 'width' => 0),
         'subtotalE' => array('justification' => 'R', 'width' => 0),
         'qty' => array('justification' => 'L', 'width' => 15),
         'model' => array('justification' => 'L', 'width' => 25),
         'name' => array('justification' => 'L', 'width' => 55),
         'tax' => array('justification' => 'R', 'width' => 15),
         'singleI' => array('justification' => 'R', 'width' => 25),
         'extraI' => array('justification' => 'R', 'width' => 20),
         'sumI' => array('justification' => 'R', 'width' => 25),
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
$optionsP['all_options'] = array(
    'subtotal'=>'subtotalE', 
    'paperOriantation'=>'L', 
    'bgPDFLang' => array('DE' => 'rl_invoice3_bgL.pdf',
                        'EN' => 'rl_invoice3_bgL_en.pdf',
                        ),
    'fontSize' => 5, 
    'fontSizeProducts' => 7,
    'fontSizeTotal' => 8,   
    'showHeadings' => 1, 
    'shaded' => 1, 'xPos' => 
    'left', 
    'xOrientation' => 'right', 
    'width' => $realPW-35 + 235,
     'cols' => array(
         'subtotalI' => array('justification' => 'R', 'width' => 0),
         'subtotalE' => array('justification' => 'R', 'width' => 0),
         'qty' => array('justification' => 'L', 'width' => 6),
         'model' => array('justification' => 'L', 'width' => 15),
         'name' => array('justification' => 'L', 'width' => 40),
         'qty_name' => array('justification' => 'L', 'width' => 40),
         'qty_name_model' => array('justification' => 'L', 'width' => 54),
         'tax' => array('justification' => 'R', 'width' => 7),
         'singleE' => array('justification' => 'R', 'width' => 15),
         'singleI' => array('justification' => 'R', 'width' => 15),
         'extraI' => array('justification' => 'R', 'width' => 15),
         'extraE' => array('justification' => 'R', 'width' => 15),
         'sumE' => array('justification' => 'R', 'width' => 15),
         'sumI' => array('justification' => 'R', 'width' => 15),
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
$optionsP['T2_options'] = array(
    'subtotal'=>'subtotalE', 
    'fontSize' => 7, 
    'fontSizeProducts' => 7,
    'fontSizeTotal' => 8,   
    'showHeadings' => 1, 
    'shaded' => 1, 
    'xPos' => 'left', 
    'xOrientation' => 'right', 
    'width' => $realPW-35 + 235,
     'cols' => array(
         'subtotalI' => array('justification' => 'R', 'width' => 0),
         'subtotalE' => array('justification' => 'R', 'width' => 0),
         'qty_name' => array('justification' => 'L', 'width' => 30),
         'model' => array('justification' => 'L', 'width' => 15),
         'tax' => array('justification' => 'R', 'width' => 10),
         'singleE' => array('justification' => 'R', 'width' => 35),
         'singleI' => array('justification' => 'R', 'width' => 20),
         'sumE' => array('justification' => 'R', 'width' => 25),
         'sumI' => array('justification' => 'R', 'width' => 15),
        )
    );
        

// T3|T3_templ
$colsP['T3'] = array(
     'subtotalI' => '...',
     'subtotalE' => '...',
     'qty_name_model' => TABLE_HEADING_PRODUCTS,
     'singleE' => TABLE_HEADING_PRICE_EXCLUDING_TAX_AMAZON,
     'tax' => TABLE_HEADING_TAX3,
     'sumE' => TABLE_HEADING_TOTAL_EXCLUDING_TAX_AMAZON,
    );
$optionsP['T3_templ'] = array(
    'subtotal'=>'subtotalE', 
    'fontSize' => 8, 
    'fontSizeProducts' => 7,
    'fontSizeTotal' => 8,   
    'showHeadings' => 1, 
    'shaded' => 1, 
    'xPos' => 'left', 
    'xOrientation' => 'right', 
    'width' => $realPW-35,
     'cols' => array(
         'subtotalI' => array('justification' => 'R', 'width' => 0),
         'subtotalE' => array('justification' => 'R', 'width' => 0),
         'qty_name_model' => array('justification' => 'L', 'width' => 115),
         'singleE' => array('justification' => 'R', 'width' => 25),
         'tax' => array('justification' => 'R', 'width' => 15),
         'sumE' => array('justification' => 'R', 'width' => 25),
        )
    );
        
