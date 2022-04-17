<?php

define('MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE', 'Online Bank Transfer.');
define('MODULE_PAYMENT_SOFORT_SU_TEXT_LOGO', '<br><img src="https://cdn.klarna.com/1.0/shared/image/generic/badge/de_de/pay_now/descriptive/pink.svg" height="30px" alt="Sofort."/>');

define('MODULE_PAYMENT_SOFORT_SU_DESCRIPTION', 'Simple and secure');

define('MODULE_PAYMENT_SOFORT_SU_STATUS_TITLE', 'Activate Online Bank Transfer. module');
define('MODULE_PAYMENT_SOFORT_SU_STATUS_DESC', 'Activates/deactivates the complete module');

define('MODULE_PAYMENT_SOFORT_SU_CONFIGURATION_KEY_TITLE', 'configuration key');
define('MODULE_PAYMENT_SOFORT_SU_CONFIGURATION_KEY_DESC', 'Assigned configuration key by SOFORT AG');

define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TITLE', 'recommended payment method');
define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_DESC', '"Mark this payment method as "recommended payment method". On the payment selection page a note will be displayed right behind the payment method."');

define('MODULE_PAYMENT_SOFORT_SU_REASON_ONE_TITLE', 'Reason 1');
define('MODULE_PAYMENT_SOFORT_SU_REASON_ONE_DESC', 'For purpose 1 the following options can be selected');

define('MODULE_PAYMENT_SOFORT_SU_REASON_TWO_TITLE', 'Reason 2');
define('MODULE_PAYMENT_SOFORT_SU_REASON_TWO_DESC', 'For purpose (maximum 27 characters) the following placeholders are replaced:<br> {{order_id}}<br>{{order_date}}<br>{{customer_id}}<br>{{customer_name}}<br>{{customer_company}}<br>{{customer_email}}');

define('MODULE_PAYMENT_SOFORT_SU_ZONE_TITLE', 'Payment zone');
define('MODULE_PAYMENT_SOFORT_SU_ZONE_DESC', 'When a zone is selected, the payment method applies only to this zone.');

define('MODULE_PAYMENT_SOFORT_PROF_SETTINGS_TITLE', '<span style="font-weight:bold; text-decoration:underline; font-size:1.4em;"><br>Professional settings</span> ');
define('MODULE_PAYMENT_SOFORT_PROF_SETTINGS_DESC', 'The following settings usually require no adjustment and should be already filled with the correct values.');

define('MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID_TITLE', 'Temporary order status');
define('MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID_DESC', 'Order state for non-completed transactions. The order has been created but the transaction has not yet been confirmed by SOFORT AG.');

define('MODULE_PAYMENT_SOFORT_SU_ABORTED_STATUS_ID_TITLE', 'Order state at aborted payment'); //Bestellstatus bei abgebrochener/erfolgloser Zahlung
define('MODULE_PAYMENT_SOFORT_SU_ABORTED_STATUS_ID_DESC', 'Order status for orders that were cancelled during the checkout process.'); //Bestellstatus bei Bestellungen, die whrend des Bestellvorgangs oder im Wizard abgebrochen wurden.

define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_TITLE', 'Confirmed order status');
define('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_DESC', 'Confirmed order status<br>Order status after successfully completing a transaction.'); // (pending-not_credited_yet)

define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_TITLE', 'Order status, when money is not received');
define('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_DESC', 'Status of the order if no money is credited on your account. (Prerequisite: account with Deutsche Handelsbank).'); // (loss-not_credited)

define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_TITLE', 'Receipt of money');
define('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_DESC', 'Status of orders when the money has been received on the account of Deutsche Handelsbank.'); // (received-credited)

define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_TITLE', 'Partial refund');
define('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_DESC', 'Status of orders where a partial amount was refunded to the buyer.');  // (refunded-compensation)

define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_TITLE', 'Full refund');
define('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_DESC', 'Status of orders where the full amount was refunded to the buyer.'); // (refunded-refunded)

define('MODULE_PAYMENT_SOFORT_SU_CREATE_ORDER_TITLE', 'Place order before redirect:');
define('MODULE_PAYMENT_SOFORT_SU_CREATE_ORDER_DESC', 'Place order before redirect:');

define('MODULE_PAYMENT_SOFORT_SU_LOGO_TITLE', 'Banner or text in the selection of payment methods');
define('MODULE_PAYMENT_SOFORT_SU_LOGO_DESC', 'Banner or text in the selection of payment methods');

define('MODULE_PAYMENT_SOFORT_SU_CUSTOMER_PROTECTION_TITLE', 'Customer protection activated');
define('MODULE_PAYMENT_SOFORT_SU_CUSTOMER_PROTECTION_DESC', 'Activate customer protection for SOFORT Banking');

define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_TITLE', 'sort sequence');
define('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_DESC', 'Order of display. Smallest number will show first.');

define('MODULE_PAYMENT_SOFORT_SU_COUNTRIES_TITLE', 'Countries');
define('MODULE_PAYMENT_SOFORT_SU_COUNTRIES_DESC', 'Enter the countries for which you want to offer SOFORT Banking. Two digit ISO codes, comma separated.');



define('MODULE_PAYMENT_SOFORT_SU_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE', '     <table border="0" cellspacing="0" cellpadding="0">      <tr>        <td valign="bottom">
	<a onclick="javascript:window.open(\'https://www.klarna.com/uk/\',\'customer information\',\'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1020, height=900\');" style="float:left; width:auto; cursor:pointer;">
		{{image}}
	</a>
	</td>      </tr>      <tr> <td class="main">{{text}}</td>      </tr>      </table>');

define('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_CHECKOUT', '(recommended payment method)');

define('MODULE_PAYMENT_SOFORT_SU_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT', 'Simple and secure');

define('MODULE_PAYMENT_SOFORT_SU_CHECKOUT_TEXT', 'Simple and secure');
define('MODULE_PAYMENT_SOFORT_SU_CHECKOUT_TEXT_KS', 'Simple and secure');
define('MODULE_PAYMENT_SOFORT_SU_CHECKOUT_INFOLINK_KS', 'https://www.klarna.com/uk/');

define('MODULE_PAYMENT_SOFORT_SU_TEXT_ERROR_MESSAGE', 'Payment is unfortunately not possible or has been cancelled by the customer. Please select another payment method.');