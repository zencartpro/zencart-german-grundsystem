<?php
/**
 * @package Admin Profiles
 * @copyright Copyright Kuroi Web Design 2009-2010
 * @copyright Portions Copyright Yellow1912 2008
 * @copyright Portions Copyright 2003-2008 The Zen Cart Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_navigation.php 2011-05-12 06:38:09Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
?>
<div id="navbar">
  <ul class="nde-menu-system" onmouseover="hide_dropdowns('in');" onmouseout="hide_dropdowns('out');">
<?php
  if (menu_header_visible('Configuration')) require(DIR_WS_BOXES . 'configuration_dhtml.php');
  if (menu_header_visible('Catalog')) require(DIR_WS_BOXES . 'catalog_dhtml.php');
  if (menu_header_visible('Modules')) require(DIR_WS_BOXES . 'modules_dhtml.php');
  if (menu_header_visible('Customers')) require(DIR_WS_BOXES . 'customers_dhtml.php');
  if (menu_header_visible('Taxes')) require(DIR_WS_BOXES . 'taxes_dhtml.php');
  if (menu_header_visible('Localization')) require(DIR_WS_BOXES . 'localization_dhtml.php');
  if (menu_header_visible('Reports')) require(DIR_WS_BOXES . 'reports_dhtml.php');
  if (menu_header_visible('Tools')) require(DIR_WS_BOXES . 'tools_dhtml.php');
  if (menu_header_visible('GV_Admin')) require(DIR_WS_BOXES . 'gv_admin_dhtml.php');
  if (menu_header_visible('Extras')) require(DIR_WS_BOXES . 'extras_dhtml.php');
   ?>
  </ul>
</div>
