<?php
/**
 * Load the IPN checkout-language data 
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_ipn_postcfg.php 729 2011-08-09 15:49:16Z hugo13 $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

/**
 * require language defines
 * require('includes/languages/english/checkout_process.php');
 */
if (!isset($_SESSION['language'])) $_SESSION['language'] = 'english';
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'checkout_process.php')) {
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'checkout_process.php');
} else {
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/checkout_process.php');
}

?>