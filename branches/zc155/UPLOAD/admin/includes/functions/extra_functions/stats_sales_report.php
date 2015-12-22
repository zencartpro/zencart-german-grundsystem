<?php
/**
 * SALES REPORT 3.1
 *
 * @author     Frank Koehl (PM: BlindSide)
 * @author     Conor Kerr <conor.kerr_zen-cart@dev.ceon.net>
 * @updated by stellarweb to work with version 1.5.0 02-29-12 
 * @copyright  Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright  Portions Copyright 2003 osCommerce
 * @license    http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
*/


if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (function_exists('zen_register_admin_page')) {
    if (!zen_page_key_exists('stats_sales_report')) {
        // Add Monthly Report link to Reports menu
        zen_register_admin_page('stats_sales_report', 'BOX_REPORTS_SALES_REPORT','FILENAME_STATS_SALES_REPORT', '', 'reports', 'Y', 17);
    }
}