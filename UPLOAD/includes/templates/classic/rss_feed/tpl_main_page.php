<?php
/**
 * tpl_main_page.php
 *
 * @package rss feed
 * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php, 2014-03-29 07:23:04 webchills $
 */

  $rss->rss_feed_out();

  require(DIR_WS_INCLUDES . 'application_bottom.php');

  zen_exit();
?>