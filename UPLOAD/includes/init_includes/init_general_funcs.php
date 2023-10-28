<?php
/**
 * load the system wide functions
 * see  {@link  https://docs.zen-cart.com/dev/code/init_system/} for more details.
 * Zen Cart German Specific (158 code in 157)
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_general_funcs.php 2023-10-23 13:29:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
require DIR_WS_FUNCTIONS . 'database.php';
require DIR_WS_FUNCTIONS . 'functions_general.php';
require DIR_WS_FUNCTIONS . 'functions_general_shared.php';
require DIR_WS_FUNCTIONS . 'functions_attributes.php';
require DIR_WS_FUNCTIONS . 'functions_files.php';
require DIR_WS_FUNCTIONS . 'functions_traffic.php';
require DIR_WS_FUNCTIONS . 'functions_strings.php';
require DIR_WS_FUNCTIONS . 'functions_search.php';
require DIR_WS_FUNCTIONS . 'functions_addresses.php';
require DIR_WS_FUNCTIONS . 'functions_dates.php';
require DIR_WS_FUNCTIONS . 'functions_products.php';
require DIR_WS_FUNCTIONS . 'functions_categories.php';
require DIR_WS_FUNCTIONS . 'functions_prices.php';
require DIR_WS_FUNCTIONS . 'functions_taxes.php';
require DIR_WS_FUNCTIONS . 'functions_gvcoupons.php';
require DIR_WS_FUNCTIONS . 'functions_customers.php';
require DIR_WS_FUNCTIONS . 'functions_customer_groups.php';
require DIR_WS_FUNCTIONS . 'functions_lookups.php';
require DIR_WS_FUNCTIONS . 'functions_urls.php';
require DIR_WS_FUNCTIONS . 'html_output.php';
require DIR_WS_FUNCTIONS . 'functions_email.php';
require DIR_WS_FUNCTIONS . 'functions_ezpages.php';
require DIR_WS_FUNCTIONS . 'plugin_support.php';
require DIR_WS_FUNCTIONS . 'password_funcs.php';

include DIR_WS_MODULES . 'extra_functions.php';
