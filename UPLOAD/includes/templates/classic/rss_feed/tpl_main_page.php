<?php
/**
 * Zen Cart German Specific *
 * @package rss feed
 * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_main_page.php 2022-01-16 19:04:04 webchills $
 */

$rss->rss_feed_out();
require(DIR_WS_INCLUDES . 'application_bottom.php');
zen_exit();