<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// |                                                                      |
// |   DevosC, Developing open source Code                                |
// |   Copyright (c) 2004 DevosC.com                                      |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//

// strip slashes in case they were added to handle apostrophes:
  foreach ($apc->fields as $key=>$value){
    $apc->fields[$key] = stripslashes($value);
  }

// display all Nochex status fields (in admin Orders page):
          $output = '<td><table>'."\n";
          $output .= '<tr style="background-color : #cccccc; border-style : dotted;">'."\n";

          $output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_NOCHEX_ENTRY_TRANSACTION_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $apc->fields['nc_transaction_id']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_NOCHEX_ENTRY_TRANSACTION_DATE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $apc->fields['nc_transaction_date']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_NOCHEX_ENTRY_TO_EMAIL."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $apc->fields['nc_to_email']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_NOCHEX_ENTRY_FROM_EMAIL."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $apc->fields['nc_from_email']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_NOCHEX_ENTRY_ORDER_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $apc->fields['nc_order_id']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_NOCHEX_ENTRY_CUSTOM."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $apc->fields['nc_custom']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_NOCHEX_ENTRY_AMOUNT."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $apc->fields['nc_amount']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_NOCHEX_ENTRY_SECURITY_KEY."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $apc->fields['nc_security_key']."\n";
          $output .= '</td></tr>'."\n";

          //$output .= '</table></td>'."\n";
          //$output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_NOCHEX_ENTRY_STATUS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $apc->fields['nc_status']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_NOCHEX_ENTRY_NOCHEX_RESPONSE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $apc->fields['nochex_response']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '</table></td>'."\n";

          $output .= '</tr>'."\n";
          $output .='</table></td>'."\n";
?>