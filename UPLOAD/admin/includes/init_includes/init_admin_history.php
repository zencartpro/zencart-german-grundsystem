<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_admin_history.php 732 2015-01-20 08:52:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// log page visit into admin activity history
$zco_notifier->notify('NOTIFY_ADMIN_ACTIVITY_LOG_EVENT', 'POST');
