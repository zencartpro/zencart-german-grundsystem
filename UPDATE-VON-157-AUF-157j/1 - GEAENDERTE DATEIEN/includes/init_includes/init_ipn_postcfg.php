<?php
/**
 * Load the IPN checkout-language data 
 * see  {@link  https://docs.zen-cart.com/dev/code/init_system/} for more details.
 * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_ipn_postcfg.php 2023-10-23 14:31:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

/**
 * require language defines
 * require('includes/languages/german/checkout_process.php');
 */
if (!isset($_SESSION['language'])) $_SESSION['language'] = 'german';

zen_include_language_file('checkout_process.php', '/', 'inline');

