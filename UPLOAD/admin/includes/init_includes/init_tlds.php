<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_tlds.php 731 2019-04-12 08:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$http_domain = zen_get_top_level_domain(HTTP_SERVER);
$cookieDomain = $http_domain;
if (defined('HTTP_COOKIE_DOMAIN'))
{
  $cookieDomain = HTTP_COOKIE_DOMAIN;
}