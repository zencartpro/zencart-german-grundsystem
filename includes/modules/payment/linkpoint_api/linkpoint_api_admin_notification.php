<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright 2003 Jason LeBaron 
 * @copyright Portions Copyright 2004 DevosC.com 
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: linkpoint_api_admin_notification.php 4612 2006-09-26 08:03:05Z drbyte $
 */

// strip slashes in case they were added to handle apostrophes:
  if (!is_array($lp_api->fields)) $lp_api->fields = array();
  foreach ($lp_api->fields as $key=>$value){
    $lp_api->fields[$key] = stripslashes($value);
  }

// display all Linkpoint API status fields (in admin Orders page):
          $output = '<td><table>'."\n";
          $output .= '<tr style="background-color : #cccccc; border-style : dotted;">'."\n";
          $output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_LINKPOINT_API_LINKPOINT_ORDER_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $lp_api->fields['lp_order_id']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_LINKPOINT_API_APPROVAL_CODE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $lp_api->fields['approval_code']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_REFERENCE_NUMBER."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $lp_api->fields['transaction_reference_number']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_LINKPOINT_API_AVS_RESPONSE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $lp_api->fields['avs_response']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_LINKPOINT_API_FRAUD_SCORE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $lp_api->fields['fraud_score']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_LINKPOINT_API_MESSAGE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $lp_api->fields['message']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '</table></td>'."\n";

          $output .= '</tr>'."\n";
          $output .='</table></td>'."\n";
?>