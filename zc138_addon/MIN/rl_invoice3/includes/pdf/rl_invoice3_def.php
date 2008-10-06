<?php
// +----------------------------------------------------------------------+
//  $Id: rl_invoice3_def.php 4 2007-05-31 15:50:23Z rainer langheiter $
//
/**
 * COLUMNS   #####
 */
 // $Id: rl_invoice3_def.php 4 2007-05-31 15:50:23Z rainer langheiter $
 
$realPW = 210;

$colsP['col_templ_1'] = array(
    'qty' => TABLE_HEADING_QTY,
     'model' => TABLE_HEADING_PRODUCTS_MODEL,
     'name' => TABLE_HEADING_PRODUCTS,
     'tax' => TABLE_HEADING_TAX,
     'singleI' => TABLE_HEADING_PRICE_INCLUDING_TAX,
     'extraI' => TABLE_HEADING_EXTRA,
     'sumI' => TABLE_HEADING_TOTAL_INCLUDING_TAX,
    );
$colsP['all'] = array(
     'qty' => TABLE_HEADING_QTY,
     'model' => TABLE_HEADING_PRODUCTS_MODEL,
     'name' => TABLE_HEADING_PRODUCTS,
     'qty_name' => TABLE_HEADING_PRODUCTS,
     'qty_name_model' => TABLE_HEADING_PRODUCTS,
     'tax' => TABLE_HEADING_TAX,
     'singleE' => TABLE_HEADING_PRICE_EXCLUDING_TAX,
     'singleI' => TABLE_HEADING_PRICE_INCLUDING_TAX,
     'extraI' => TABLE_HEADING_EXTRA,
     'extraE' => TABLE_HEADING_EXTRA,
     'sumE' => TABLE_HEADING_TOTAL_EXCLUDING_TAX,
     'sumI' => TABLE_HEADING_TOTAL_INCLUDING_TAX,
    );
$colsP['templ2'] = array(
    'qty_name' => TABLE_HEADING_PRODUCTS,
     'model' => TABLE_HEADING_PRODUCTS_MODEL,
     'tax' => TABLE_HEADING_TAX,
     'singleE' => TABLE_HEADING_PRICE_EXCLUDING_TAX,
     'singleI' => TABLE_HEADING_PRICE_INCLUDING_TAX,
     'sumE' => TABLE_HEADING_TOTAL_EXCLUDING_TAX,
     'sumI' => TABLE_HEADING_TOTAL_INCLUDING_TAX,
    );
$colsP['templ3'] = array(
    'qty_name_model' => TABLE_HEADING_PRODUCTS,
     'tax' => TABLE_HEADING_TAX,
     'singleE' => TABLE_HEADING_PRICE_EXCLUDING_TAX,
     'singleI' => TABLE_HEADING_PRICE_INCLUDING_TAX,
     'sumE' => TABLE_HEADING_TOTAL_EXCLUDING_TAX,
     'sumI' => TABLE_HEADING_TOTAL_INCLUDING_TAX,
    );

/**
 * OPTIONS
 */
$optionsP['options_templ_1'] = array("fontSize" => 8, 'showHeadings' => 1, 'shaded' => 1, 'xPos' => 'left', 'xOrientation' => 'right', 'width' => $realPW-35,
     'cols' => array(
         'qty' => array("justification" => "L", "width" => 15),
         'tax' => array("justification" => "R", "width" => 10),
         'model' => array("justification" => "L", "width" => 25),
         'name' => array('justification' => 'L', "width" => 60),
         'singleI' => array('justification' => 'R', "width" => 25),
         'singleE' => array('justification' => 'R', "width" => 25),
         'extraI' => array('justification' => 'R', "width" => 20),
         'sumI' => array('justification' => 'R', "width" => 25),
        )
    );
$optionsP['all'] = array("fontSize" => 7, 'showHeadings' => 1, 'shaded' => 1, 'xPos' => 'left', 'xOrientation' => 'right', 'width' => $realPW-35 + 235,
     'cols' => array(
         'qty' => array("justification" => "L", "width" => 10),
         'model' => array("justification" => "L", "width" => 15),
         'name' => array('justification' => 'L', "width" => 30),
         'qty_name' => array('justification' => 'L', "width" => 30),
         'qty_name_model' => array('justification' => 'L', "width" => 40),
         'tax' => array("justification" => "R", "width" => 10),
         'singleE' => array('justification' => 'R', "width" => 35),
         'singleI' => array('justification' => 'R', "width" => 20),
         'extraI' => array('justification' => 'R', "width" => 15),
         'extraE' => array('justification' => 'R', "width" => 15),
         'sumE' => array('justification' => 'R', "width" => 25),
         'sumI' => array('justification' => 'R', "width" => 15),
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
 $options = array("fontSize" => 9, 'showHeadings' => 0, 'shaded' => 1, 'xPos' => 'left', 'showLines' => '0'
     , 'xOrientation' => 'right', 'width' => $realPW-35,
     'cols' => array(
        'title' => array('justification' => 'right'),
         'text' => array('justification' => 'right', "width" => 60)
        )
    );

