<?php
/**
 * set some top level domain variables
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_tlds.php 729 2011-08-09 15:49:16Z hugo13 $
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
} 
$http_domain = zen_get_top_level_domain(HTTP_SERVER);
$https_domain = zen_get_top_level_domain(HTTPS_SERVER);
$cookieDomain = $current_domain = (($request_type == 'NONSSL') ? $http_domain : $https_domain);
if (defined('HTTP_COOKIE_DOMAIN') && ($request_type == 'NONSSL'))
{
  $cookieDomain = HTTP_COOKIE_DOMAIN;
} elseif (defined('HTTPS_COOKIE_DOMAIN') && ($request_type != 'NONSSL')) 
{
  $cookieDomain = HTTPS_COOKIE_DOMAIN;
}