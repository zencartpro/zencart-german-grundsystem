<?php
/**
 * logoff header_php.php 
 *
 * @package page
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2019-06-15 21:49:16Z webchills $
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
if (zen_is_logged_in() || !empty($_SESSION['customer_guest_id'])) {
  zen_session_destroy();
  zen_redirect(zen_href_link(FILENAME_LOGOFF, $logoff_lang));
}

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_LOGOFF');