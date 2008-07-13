<?php
// +----------------------------------------------------------------------+
//  $Id: rl_invoice_def.php,v 1.1 2004/10/05 09:20:32 rainer Exp $
//
/**
 * COLUMNS   #####
 */
 // $Id: rl_invoice_def.php,v 1.1 2004/10/05 09:20:32 rainer Exp $

$colsP['col_templ_1'] = array(
    'qty' => '<b>' . TABLE_HEADING_QTY . '</b>',
     'model' => '<b>' . TABLE_HEADING_PRODUCTS_MODEL . '</b>',
     'name' => '<b>' . TABLE_HEADING_PRODUCTS . '</b>',
     'tax' => '<b>' . TABLE_HEADING_TAX . '</b>',
     'singleI' => '<b>' . TABLE_HEADING_PRICE_INCLUDING_TAX . '</b>',
     'sumI' => '<b>' . TABLE_HEADING_TOTAL_INCLUDING_TAX . '</b>',
    );
$colsP['all'] = array(
    'qty' => '<b>' . TABLE_HEADING_QTY . '</b>',
     'model' => '<b>' . TABLE_HEADING_PRODUCTS_MODEL . '</b>',
     'name' => '<b>' . TABLE_HEADING_PRODUCTS . '</b>',
     'qty_name' => '<b>' . TABLE_HEADING_PRODUCTS . '</b>',
     'qty_name_model' => '<b>' . TABLE_HEADING_PRODUCTS . '</b>',
     'tax' => '<b>' . TABLE_HEADING_TAX . '</b>',
     'singleE' => '<b>' . TABLE_HEADING_PRICE_EXCLUDING_TAX . '</b>',
     'singleI' => '<b>' . TABLE_HEADING_PRICE_INCLUDING_TAX . '</b>',
     'extraI' => '<b>' . TABLE_HEADING_EXTRA . '</b>',
     'sumE' => '<b>' . TABLE_HEADING_TOTAL_EXCLUDING_TAX . '</b>',
     'sumI' => '<b>' . TABLE_HEADING_TOTAL_INCLUDING_TAX . '</b>',
    );
$colsP['col_templ_2'] = array(
    'qty' => '<b>' . TABLE_HEADING_QTY . '</b>',
     'model' => '<b>' . TABLE_HEADING_PRODUCTS_MODEL . '</b>',
     'name' => '<b>' . TABLE_HEADING_PRODUCTS . '</b>',
     'singleE' => '<b>' . TABLE_HEADING_PRICE_EXCLUDING_TAX . '</b>',
     'tax' => '<b>' . TABLE_HEADING_TAX . '</b>',
     'singleI' => '<b>' . TABLE_HEADING_PRICE_INCLUDING_TAX . '</b>',
     'sumI' => '<b>' . TABLE_HEADING_TOTAL_INCLUDING_TAX . '</b>',
    );
$colsP['col_templ_3'] = array(
    'qty_name_model' => '<b>' . TABLE_HEADING_PRODUCTS . '</b>',
     'tax' => '<b>' . TABLE_HEADING_TAX . '</b>',
     'singleE' => '<b>' . TABLE_HEADING_PRICE_EXCLUDING_TAX . '</b>',
     'singleI' => '<b>' . TABLE_HEADING_PRICE_INCLUDING_TAX . '</b>',
     'sumE' => '<b>' . TABLE_HEADING_TOTAL_EXCLUDING_TAX . '</b>',
     'sumI' => '<b>' . TABLE_HEADING_TOTAL_INCLUDING_TAX . '</b>',
    );

/**
 * OPTIONS
 */
$optionsP['options_templ_1'] = array("fontSize" => 8, 'showHeadings' => 1, 'shaded' => 1, 'xPos' => 'left', 'xOrientation' => 'right', 'width' => $realPW-35,
     'cols' => array(
        'qty' => array("justification" => "center", "width" => 40),
         'tax' => array("justification" => "right", "width" => 35),
         'model' => array("justification" => "left", "width" => 85),
         'name' => array('justification' => 'left'),
         'singleI' => array('justification' => 'right', "width" => 65),
         'singleE' => array('justification' => 'right', "width" => 65),
         'sumI' => array('justification' => 'right', "width" => 60),
        )
    );
$optionsP['options_templ_2'] = array("fontSize" => 8, 'showHeadings' => 1, 'shaded' => 1, 'xPos' => 'left', 'xOrientation' => 'right', 'width' => $realPW-35,
     'cols' => array(
        'qty' => array("justification" => "left", "width" => 40),
         'tax' => array("justification" => "right", "width" => 50),
         'model' => array("justification" => "left", "width" => 60),
         'name' => array('justification' => 'left'),
         'singleI' => array('justification' => 'right', "width" => 60),
         'singleE' => array('justification' => 'right', "width" => 60),
         'extraI' => array('justification' => 'right', "width" => 60),
         'sumI' => array('justification' => 'right', "width" => 60),
        )
    );
$optionsP['all'] = array("fontSize" => 8, 'showHeadings' => 1, 'shaded' => 1, 'xPos' => 'left', 'xOrientation' => 'right', 'width' => $realPW-35 + 235,
     'cols' => array(
        'qty' => array("justification" => "left"),
         'tax' => array("justification" => "right"),
         'model' => array("justification" => "left"),
         'name' => array('justification' => 'left'),
         'singleI' => array('justification' => 'right'),
         'singleE' => array('justification' => 'right'),
         'extraE' => array('justification' => 'right'),
         'extraI' => array('justification' => 'right'),
         'sumI' => array('justification' => 'right'),
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

?>