<?php
/**
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 * 
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 */
 
function makeTRTD($name, $value){ 
     $tmpCont = '<tr> 
            <td class="main">' . $name . '</td> 
            <td class="main">' . $value . '</td> 
          </tr>'; 
     return $tmpCont; 
     } 
     
function displayGermanBanktransfer(){
    global $db;
    $sql = "select * from " . TABLE_GERMANBT . " where orders_id ='" . zen_db_input($_GET['oID']) . "'"; 
    $germanbt = $db -> Execute($sql); 
    $content = ''; 
    while(!$germanbt -> EOF){ 
        
         $content .= '<tr> 
                <td colspan="2">' . zen_draw_separator('pixel_trans.gif', '1', '10') . '</td> 
              </tr>' . 
         makeTRTD(TEXT_GERMANBT_NAME, $germanbt -> fields['banktransfer_bankname']) . 
         makeTRTD(TEXT_GERMANBT_BLZ, $germanbt -> fields['banktransfer_blz']) . 
         makeTRTD(TEXT_GERMANBT_NUMBER, $germanbt -> fields['banktransfer_number']) . 
         makeTRTD(TEXT_GERMANBT_OWNER, $germanbt -> fields['banktransfer_owner']); 
        
         if ($germanbt->fields['banktransfer_status'] == 0){ 
             $content .= makeTRTD(TEXT_GERMANBT_STATUS, 'OK'); 
             }else{ 
             $content .= makeTRTD(TEXT_GERMANBT_STATUS, $germanbt -> fields['banktransfer_status']); 
             } 
        
         switch ($germanbt -> fields['banktransfer_status']){ 
         case 1: $error_val = TEXT_GERMANBT_ERROR_1; 
             break; 
         case 2: $error_val = TEXT_GERMANBT_ERROR_2; 
             break; 
         case 3: $error_val = TEXT_GERMANBT_ERROR_3; 
             break; 
         case 4: $error_val = TEXT_GERMANBT_ERROR_4; 
             break; 
         case 5: $error_val = TEXT_GERMANBT_ERROR_5; 
             break; 
         case 8: $error_val = TEXT_GERMANBT_ERROR_8; 
             break; 
         case 9: $error_val = TEXT_GERMANBT_ERROR_9; 
             break; 
             } 
         $content .= makeTRTD(TEXT_GERMANBT_ERRORCODE, $error_val); 
         $content .= makeTRTD(TEXT_GERMANBT_PRZ, $germanbt -> fields['banktransfer_prz']); 
        
         if ($germanbt -> fields['banktransfer_fax']){ 
         $content .= makeTRTD(TEXT_GERMANBT_FAX, $germanbt -> fields['banktransfer_fax']); 
         } 
     $germanbt -> MoveNext(); 
    } 
     return $content ; 
}