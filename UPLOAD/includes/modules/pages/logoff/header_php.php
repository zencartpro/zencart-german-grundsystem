<?php
/**
 * logoff header_php.php 
 *
 * @package page
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 729 2011-08-09 15:49:16Z hugo13 $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_LOGOFF');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add(NAVBAR_TITLE);

/**
 * Check what language should be used on the logoff screen
 */
  $logoff_lang = ($_SESSION['languages_code'] != DEFAULT_LANGUAGE) ? 'language=' . $_SESSION['languages_code'] : '';

/**
  * Check if there is still a customer_id
  * If so, kill the session, and redirect back to the logoff page
  * This will cause the header logic to see that the customer_id is gone, and thus not display another logoff link
  */
if (!empty($_SESSION['customer_id']) || !empty($_SESSION['customer_guest_id'])) {
  zen_session_destroy();
  zen_redirect(zen_href_link(FILENAME_LOGOFF, $logoff_lang));
}

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_LOGOFF');
?>