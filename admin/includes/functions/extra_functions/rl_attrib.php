<?php
/**
 * @package admin
 * @copyright Copyright 2006 rainer langheiter; http://edv.langheiter.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 * $Id$
 */

function getAttrib($paramArray){
     global $db;
     
     define ('XAJAX_DEFAULT_CHAR_ENCODING', 'windows-1251' );
     
     $products_id = $paramArray['products_id'];
     $options_id = $paramArray['options_id'];
    
     $sqlA = "SELECT options_values_id FROM " . TABLE_PRODUCTS_ATTRIBUTES . " WHERE products_id='$products_id' AND options_id='$options_id'";
     $resA = $db -> execute($sqlA);
     $oivd = array();
     while(!$resA -> EOF){
         $ovid[] = $resA -> fields['options_values_id'];
         $resA -> MoveNext();
         }
     if(!empty($ovid)){
         $inStr = ' AND POV.products_options_values_id NOT IN (' . implode(', ', $ovid) . ')';
         }else{
         $inStr = '';
         }
    
     $sql = "SELECT POV.products_options_values_id, POV2PO.products_options_id, PO.products_options_name, POV.products_options_values_sort_order, POV.products_options_values_name, POV.products_options_values_id
                FROM " . TABLE_PRODUCTS_OPTIONS . " PO, " . TABLE_PRODUCTS_OPTIONS_VALUES . " POV, " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " POV2PO
                WHERE PO.products_options_id = POV2PO.products_options_id AND POV.products_options_values_id = POV2PO.products_options_values_id 
                    AND ((POV2PO.products_options_id=PO.products_options_id And POV2PO.products_options_id='$options_id') 
                    AND (POV2PO.products_options_values_id=POV.products_options_values_id) AND (POV.language_id=" . $_SESSION['languages_id'] . ") 
                    AND (PO.language_id=" . $_SESSION['languages_id'] . "))"  . $inStr ;
     $values_values = $db -> execute($sql);
     while (!$values_values -> EOF){
         $val[] = array('id' => $values_values -> fields['products_options_values_id'], 'text' => $values_values -> fields['products_options_values_name']);
         $values_values -> MoveNext();
         }
     if(empty($val)){
         $cont = 'nothing to select';
         }else{
         $cont = zen_draw_pull_down_menu('values_id[]', $val, '', ' multiple size="5" ');
         }
     $objResponse = new xajaxResponse();
     $objResponse -> addAssign("values_id", "innerHTML", $cont);
     return $objResponse -> getXML();
     }
function hideoptionname($id){
    $objResponse = new xajaxResponse();
    $objResponse -> addAssign($id, "innerHTML", 'WEG');
    return $objResponse -> getXML();     
}
?>