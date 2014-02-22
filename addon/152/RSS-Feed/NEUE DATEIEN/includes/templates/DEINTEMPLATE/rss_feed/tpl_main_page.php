<?php
/**
 * rss_feed tpl_main_page.php
 *
 * @package rss feed
 * @copyright Copyright 2004-2007 Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php, v 2.1.4 14.02.2008 15:26 Andrew Berezin $
 */

  $rss->rss_feed_out();

  require(DIR_WS_INCLUDES . 'application_bottom.php');

  zen_exit();
?>