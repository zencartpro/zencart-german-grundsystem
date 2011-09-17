<?php
/**
 * @version sofortüberweisung 3.03 - $Date: 2011-08-12 11:08:11 +0200 (Fr, 08 Aug 2011) $
 * @author Payment Network AG (integration@payment-network.com)
 * @link http://www.payment-network.com/
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 of the License
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307
 * USA
 *
 ***********************************************************************************
 * this file contains code based on:
 * (c) 2000 - 2001 The Exchange Project
 * (c) 2001 - 2003 osCommerce, Open Source E-Commerce Solutions
 * (c) 2003 - 2011 Zen-Cart
 * Released under the GNU General Public License
 ***********************************************************************************
 *
 * $Id: pn_sofortueberweisung.php 80 2010-03-15 16:01:25Z thoma $
 * $Id: pn_sofortueberweisung.php 2011-08-12 11:09:25Z webchills $
 * 
 */

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_TITLE', 'sofortbanking');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_PUBLIC_TITLE', 'sofortbanking');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ALLOWED_TITLE' , 'Allowable zones');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ALLOWED_DESC' , 'Please enter <b>separately</b> the zones, which should be allowed for this module. (z.B. AT,DE (if empty, all zones are allowed))');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS_TITLE' , 'Activate sofortbanking direct module');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS_DESC' , 'Accept payment via prepayment with integrated sofortbanking?');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS_DESC', 'Do you want to accept payments by sofortbanking?');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID_TITLE' , 'Customer ID');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_USER_ID_DESC' , 'Your Customer ID at sofortbanking');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID_TITLE' , 'Project ID');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_ID_DESC' , 'The responsible project ID at sofortbanking, to which the payment is affiliate');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD_TITLE' , 'Project password:');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD_DESC' , 'The project password (at extended settings / passwords and hash algorithms)');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD_TITLE', 'Notification password:');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD_DESC', 'The notification password (extended settings / passwords and hash algorithms)');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM_TITLE', 'Hashing algorithm:');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM_DESC', 'The hashing algorithm (extended settings / passwords and hash algorithms)');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER_TITLE' , 'Sequence of display');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SORT_ORDER_DESC' , 'Sequence of display. Lowest number is shown first.');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE_TITLE' , 'Payment zone');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ZONE_DESC' , 'If a zone is selected, the payment method is only valid for this zone.');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_COUNTRIES_TITLE', 'Countries');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_COUNTRIES_DESC', 'Enter the countries for which sofortbanking should be possible. Two digit ISO codes, comma separated');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID_TITLE' , 'Confirmed order status');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID_DESC' , 'Order status after entry of an order, for which sofortbanking forwarded a successful payment affirmation');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID_TITLE','Temporary order status');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID_DESC','Order status for transactions that are not completed yet');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID_TITLE','Unconfirmed order status');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID_DESC','Order status after entry of an order, for which no or a faulty payment affirmation has been transfered');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1_TITLE','Reason line 1');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_REASON_1_DESC', 'In the reason line 1 the following options are available');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2_TITLE','Reason line 2');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_REASON_2_DESC', 'In the reason (max 27 characters) the following placeholders will be replaced:<br /> {{order_id}}<br />{{order_date}}<br />{{customer_id}}<br />{{customer_name}}<br />{{customer_company}}<br />{{customer_email}}');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE_TITLE','Payment selection graphic / text');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_IMAGE_DESC','Shown graphic / text in the selection of the payment options');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_TEXT', 'sofortbanking is the free, ISO certified online payment system of the Payment Network AG. Your advantages: no additional registration, automatic debiting from your online bank account, highest safety standards and immediate shipping of stock goods. In order to pay with sofortbanking you need your eBanking login data, that is bank connection, account number, PIN and TAN.');
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'sofortbanking is the free, ISO certified online payment system of the Payment Network AG. Your advantages: no additional registration, automatic debiting from your online bank account, highest safety standards and immediate shipping of stock goods. In order to pay with sofortbanking you need your eBanking login data, that is bank connection, account number, PIN and TAN.');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION', (MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_STATUS != 'True' ? 
	'<form action="'.zen_href_link(FILENAME_MODULES, '', 'SSL').'" method="get"><input type="hidden" name="set" value="payment">
	<input type="hidden" name="module" value="pn_sofortueberweisung"><input type="hidden" name="action" value="install">
	<input type="hidden" name="autoinstall" value="1"><input type="submit" value="Autoinstaller (recommended)" /></form><br />' : '').'<br />
	<b>sofortbanking</b><br>During the payment process the customer is informed about the payment system via customizable texts and pictures and is directly forwarded to sofortbanking after the order transaction is finished. The order is always written into the database even if a client aborts the payment process. He then is alternatively able to pay using a common bank transfer and can still be contacted respectively.');

define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '
     <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><a href="https://www.payment-network.com/deb_com_en/demo/home" target="_blank">{{image}}</a></td>
      </tr>
      <tr>
      	<td class="main"><br />%s</td>
      	</tr>	
    </table>');

  define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TEXT_DESCRIPTION_CHECKOUT_CONFIRMATION', '
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="main"><p>In order to pay with sofortbanking you need your eBanking login data, that is bank connection, account number, PIN and TAN.</p></td>
      </tr>
    </table>');