<?php
/**
 * Zen Colorbox
 *
 * @author niestudio (daniel [dot] niestudio [at] gmail [dot] com)
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: zen_colorbox.php 1 2016-04-14 webchills $
 */

if (ZEN_COLORBOX_STATUS == 'true') {
	require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_colorbox/jquery_colorbox.php');
 	require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_colorbox/autoload_default.php');
}