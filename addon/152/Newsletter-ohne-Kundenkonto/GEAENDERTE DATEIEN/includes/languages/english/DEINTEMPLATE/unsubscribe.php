<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Originally Programmed By: Christopher Bradley (www.wizardsandwars.com) for OsCommerce
 * @copyright Modified by Jim Keebaugh for OsCommerce
 * @copyright Adapted for Zen Cart
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: unsubscribe.php for Newsletter Subscribe 2.3 2012-08-03 10:35:04Z webchills $
 */

define('NAVBAR_TITLE', 'Unsubscribe');
define('HEADING_TITLE', 'Unsubscribe from our Newsletter');

define('UNSUBSCRIBE_TEXT_INFORMATION', '<br />We\'re sorry to hear that you wish to unsubscribe from our newsletter. If you have concerns about your privacy, please see our <a href="' . zen_href_link(FILENAME_PRIVACY,'','NONSSL') . '"><span class="pseudolink">privacy notice</span></a>.<br /><br />Subscribers to our newsletter are kept notified of new products, price reductions, and site news.<br /><br />If you still do not wish to receive your newsletter, please click the button below. ');
define('UNSUBSCRIBE_TEXT_NO_ADDRESS_GIVEN', '<br />We\'re sorry to hear that you wish to unsubscribe from our newsletter. If you have concerns about your privacy, please see our <a href="' . zen_href_link(FILENAME_PRIVACY,'','NONSSL') . '"><span class="pseudolink">privacy notice</span></a>.<br /><br />Subscribers to our newsletter are kept notified of new products, price reductions, and site news.<br /><br />If you still do not wish to receive your newsletter, please click the button below. You will be taken to your account-preferences page, where you may edit your subscriptions. You may be prompted to log in first.');
define('UNSUBSCRIBE_DONE_TEXT_INFORMATION', '<br />Your email address, listed below, has been removed from our Newsletter Subscription list, as per your request. <br /><br />');
define('UNSUBSCRIBE_ERROR_INFORMATION', '<br />The email address you specified was not found in our newsletter database, or has already been removed from our newletter subscription list. <br /><br />');
// BEGIN newsletter_subscribe mod 1/1
//email unsubscribes
define('UNSUBSCRIBE_EMAIL_SUBJECT', 'Newsletter subscription discontinued');
define('UNSUBSCRIBE_EMAIL_WELCOME', '' . "\n" . '<p />Newsletter unsubscription confirmation from ' . STORE_NAME . '.<p />');
define('UNSUBSCRIBE_EMAIL_SEPARATOR', '--------------------');
define('UNSUBSCRIBE_EMAIL_TEXT', 'Your e-mail address is now unsubscribed from our newsletter.<br />' . "\n" . '<p />' . "\n\n" . 'If you ever decide that you want to receive our newsletter again, please visit our website and subscribe your e-mail address again.<p />' . "\n\n" . '');
define('UNSUBSCRIBE_EMAIL_CONTACT', '<br />If you have any questions please send us an email: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a><br />\n\n");
define('UNSUBSCRIBE_EMAIL_CLOSURE','Sincerely,' . "\n\n" . STORE_OWNER . "\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");
// send to admins when newsletter in unsubscribed
define('UNSUBSCRIBE_ADMIN_EMAIL_SUBJECT', 'Newsletter subscription discontinued');
define('UNSUBSCRIBE_ADMIN_EMAIL_TEXT', 'Newsletter unsubscribed for e-mail address: %s on %s');

// email disclaimer - this disclaimer is separate from all other email disclaimers
define('UNSUBSCRIBE_EMAIL_DISCLAIMER_NEW_CUSTOMER', 'This e-mail address was unsubscribed from our website. If this is incorrect, please inform us so we can investigate what may have caused this. You may re-subscribe in our webshop in the meanwhile, thank you.');
// END newsletter_subscribe mod 1/1