<?php
/**
 * paypalwpp_admin_notification.php admin display component
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright 2004 DevosC.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: paypalwpp_admin_notification.php 5445 2006-12-29 06:54:54Z drbyte $
 */

// strip slashes in case they were added to handle apostrophes:
  foreach ($ipn->fields as $key=>$value){
    $ipn->fields[$key] = stripslashes($value);
  }

// display all paypal status fields (in admin Orders page):
          $output = '<td><table>'."\n";
          $output .= '<tr style="background-color : #cccccc; border-style : dotted;">'."\n";

          $output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_FIRST_NAME."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['first_name']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_LAST_NAME."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['last_name']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_BUSINESS_NAME."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payer_business_name']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_NAME."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_name']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STREET."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_street']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_CITY."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_city']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_state']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_COUNTRY."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_country']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '</table></td>'."\n";

          $output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_EMAIL_ADDRESS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payer_email']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_EBAY_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['ebay_address_id']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payer_id']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_STATUS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payer_status']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATUS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_status']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_TXN_TYPE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['txn_type']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_TXN_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['txn_id']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PARENT_TXN_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['parent_txn_id']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '</table></td>'."\n";

          $output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_TYPE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payment_type']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_STATUS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payment_status']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PENDING_REASON."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['pending_reason']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_INVOICE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['invoice']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_DATE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= zen_datetime_short($ipn->fields['payment_date'])."\n";
          $output .= '</td></tr>'."\n";

          $output .= '</table></td>'."\n";

          $output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_CURRENCY."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['mc_currency']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_GROSS_AMOUNT."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['mc_gross']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_FEE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['mc_fee']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_EXCHANGE_RATE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['exchange_rate']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_CART_ITEMS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['num_cart_items']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '</table></td>'."\n";

  if (method_exists($this, '_doRefund')) {
    $output .= '<td><table class="noprint">'."\n";
    $output .= '<tr style="background-color : #eeeeee; border-style : dotted;">'."\n";
    $output .= '<td class="main">' . MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TITLE . '<br />'. "\n";
    $output .= zen_draw_form('pprefund', FILENAME_ORDERS, zen_get_all_get_params(array('action')) . 'action=doRefund', 'post', '', true);
// full refund
    $output .= MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_FULL;
    $output .= '<input type="submit" name="fullrefund" value="' . MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_FULL . '" title="' . MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_FULL . '" />' . ' ' . MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_FULL_CONFIRM_CHECK . zen_draw_checkbox_field('reffullconfirm', '', false);
//partial refund - input field
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_PARTIAL_TEXT . ' ' . zen_draw_input_field('refamt', 0, 'length="8"') . zen_hide_session_id();
    $output .= '<input type="submit" name="partialrefund" value="' . MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_PARTIAL . '" title="' . MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_PARTIAL . '" /><br />';
//comment field
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TEXT_COMMENTS . '<br />' . zen_draw_textarea_field('refnote', 'soft', '50', '2', MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_DEFAULT_MESSAGE);
//message text
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_SUFFIX;
    $output .= '</form>';
    $output .='</td></tr></table></td>'."\n";
  }
          $output .= '</tr>'."\n";
          $output .='</table></td>'."\n";

if ($response['TRANSACTION_TYPE'] == 'Authorization' || (isset($_GET['authcapt']) && $_GET['authcapt']=='on')) {
//------------
          $output .= '</tr>'."\n";
          $output .='</table></td>'."\n";
          $output .= '<td><table class="noprint">'."\n";
          $output .= '<tr style="background-color : #cccccc; border-style : dotted;">'."\n";

//------------

          $output .= '<td><table class="noprint">'."\n";
          $output .= '<tr style="background-color : #cccccc; border-style : dotted;">'."\n";

  if (method_exists($this, '_doAuth')) {
    $output .= '<td valign="top"><table class="noprint">'."\n";
    $output .= '<tr style="background-color : #eeeeee; border-style : dotted;">'."\n";
    $output .= '<td class="main">' . MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_TITLE . '<br />'. "\n";
    $output .= zen_draw_form('ppauth', FILENAME_ORDERS, zen_get_all_get_params(array('action')) . 'action=doAuth', 'post', '', true);
//partial auth - input field
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_PARTIAL_TEXT . ' ' . zen_draw_input_field('authamt', 0, 'length="8"') . zen_hide_session_id();
    $output .= '<input type="submit" name="orderauth" value="' . MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_BUTTON_TEXT_PARTIAL . '" title="' . MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_BUTTON_TEXT_PARTIAL . '" />' . MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_FULL_CONFIRM_CHECK . zen_draw_checkbox_field('authconfirm', '', false) . '<br />';
//message text
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_SUFFIX;
    $output .= '</form>';
    $output .='</td></tr></table></td>'."\n";
  }

  if (method_exists($this, '_doCapt')) {
    $output .= '<td valign="top"><table class="noprint">'."\n";
    $output .= '<tr style="background-color : #eeeeee; border-style : dotted;">'."\n";
    $output .= '<td class="main">' . MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_TITLE . '<br />'. "\n";
    $output .= zen_draw_form('ppcapture', FILENAME_ORDERS, zen_get_all_get_params(array('action')) . 'action=doCapture', 'post', '', true);
    $output .= MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_FULL;
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_AMOUNT_TEXT . ' ' . zen_draw_input_field('captamt', 0, 'length="8"') . zen_hide_session_id();
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_FINAL_TEXT . ' ' . zen_draw_checkbox_field('captfinal', '', true) . '<br />';
    $output .= '<input type="submit" name="btndocapture" value="' . MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_BUTTON_TEXT_FULL . '" title="' . MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_BUTTON_TEXT_FULL . '" />' . ' ' . MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_FULL_CONFIRM_CHECK . zen_draw_checkbox_field('captfullconfirm', '', false);
//comment field
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_TEXT_COMMENTS . '<br />' . zen_draw_textarea_field('captnote', 'soft', '50', '2', MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_DEFAULT_MESSAGE);
//message text
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_SUFFIX;
    $output .= '</form>';
    $output .='</td></tr></table></td>'."\n";
  }

  if (method_exists($this, '_doVoid')) {
    $output .= '<td valign="top"><table class="noprint">'."\n";
    $output .= '<tr style="background-color : #eeeeee; border-style : dotted;">'."\n";
    $output .= '<td class="main">' . MODULE_PAYMENT_PAYPAL_ENTRY_VOID_TITLE . '<br />'. "\n";
    $output .= zen_draw_form('ppvoid', FILENAME_ORDERS, zen_get_all_get_params(array('action')) . 'action=doVoid', 'post', '', true);
    $output .= MODULE_PAYMENT_PAYPAL_ENTRY_VOID . '<br />' . zen_draw_input_field('voidauthid', 0, 'length="8"');
    $output .= '<input type="submit" name="ordervoid" value="' . MODULE_PAYMENT_PAYPAL_ENTRY_VOID_BUTTON_TEXT_FULL . '" title="' . MODULE_PAYMENT_PAYPAL_ENTRY_VOID_BUTTON_TEXT_FULL . '" />' . ' ' . MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_CONFIRM_CHECK . zen_draw_checkbox_field('voidconfirm', '', false);
//comment field
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_VOID_TEXT_COMMENTS . '<br />' . zen_draw_textarea_field('voidnote', 'soft', '50', '2', MODULE_PAYMENT_PAYPAL_ENTRY_VOID_DEFAULT_MESSAGE);
//message text
    $output .= '<br />' . MODULE_PAYMENT_PAYPAL_ENTRY_VOID_SUFFIX;
    $output .= '</form>';
    $output .='</td></tr></table></td>'."\n";
  }


          $output .= '</tr>'."\n";
          $output .='</table></td>'."\n";
}

?>