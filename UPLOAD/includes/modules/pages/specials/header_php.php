<?php
/**
 * Specials
 *
 * @package page
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 730 2019-04-12 12:49:16Z webchills $
 */
$zco_notifier->notify('NOTIFY_HEADER_START_SPECIALS');
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add(NAVBAR_TITLE);

//lines25-71 moved to main_template_vars
