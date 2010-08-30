<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
?>
<!-- Menu bar #2. -->
<div id="navbar">
<ul class="nde-menu-system" onmouseover="hide_dropdowns('in')" onmouseout="hide_dropdowns('out')">
<?php

  require(DIR_WS_BOXES . 'configuration_dhtml.php');
  require(DIR_WS_BOXES . 'catalog_dhtml.php');
  require(DIR_WS_BOXES . 'modules_dhtml.php');
  require(DIR_WS_BOXES . 'customers_dhtml.php');
  require(DIR_WS_BOXES . 'taxes_dhtml.php');
  require(DIR_WS_BOXES . 'localization_dhtml.php');
  require(DIR_WS_BOXES . 'reports_dhtml.php');
  require(DIR_WS_BOXES . 'tools_dhtml.php');
  require(DIR_WS_BOXES . 'gv_admin_dhtml.php');
  require(DIR_WS_BOXES . 'extras_dhtml.php');
  require(DIR_WS_BOXES . 'zendeutsch_dhtml.php');

?>
</ul>
</div>
