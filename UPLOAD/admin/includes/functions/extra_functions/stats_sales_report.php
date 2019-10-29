<?php
/**
 * SALES REPORT 3.3.2
 *
 * @author     Frank Koehl (PM: BlindSide)
 * @author     Conor Kerr <conor.kerr_zen-cart@dev.ceon.net>
 * @updated by stellarweb to work with version 1.5.0 02-29-12
 * @updated by lat9, supporting zc1.5.5/1/5.6, 2019-06-20
 * @copyright  Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright  Portions Copyright 2003 osCommerce
 * @license    http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
*/
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// -----
// Bail if an admin isn't logged in, e.g. if a currency-cron is running.
//
if (empty($_SESSION['admin_id'])) {
    return;
}

// -----
// If the report's page-key entry doesn't net exist, add it.
//
if (!zen_page_key_exists('stats_sales_report')) {
    zen_register_admin_page('stats_sales_report', 'BOX_REPORTS_SALES_REPORT', 'FILENAME_STATS_SALES_REPORT', '', 'reports', 'Y');
}
