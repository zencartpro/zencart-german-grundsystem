<?php
/**
 * payer_auth_frame page
 *
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2005 CardinalCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2020-01-17 10:49:16Z webchills $
 */
/**
 * Purpose:
 * Creates a frame display so the the customer can complete
 * payer authentication but still have the experience that they have
 * not left the online store.
 */

if (!zen_is_logged_in() || empty($_SESSION['payment']) || empty($_SESSION['3Dsecure_acsURL'])) {
  die(WARNING_SESSION_TIMEOUT);
}

$_SESSION['3Dsecure_term_url'] = zen_href_link(FILENAME_PAYER_AUTH_VERIFIER, '', 'SSL', true, false);
$_SESSION['3Dsecure_auth_url'] = zen_href_link(FILENAME_PAYER_AUTH_AUTH, '', 'SSL', true, false);
$flag_disable_left = TRUE;
$flag_disable_right = TRUE;

header("Cache-Control: max-age=1");  // stores for only 1 second, which prevents page from being re-displayed
