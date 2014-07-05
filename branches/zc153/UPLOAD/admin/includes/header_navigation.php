<?php
/**
 * @package admin
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_navigation.php 729 2011-08-09 15:49:16Z hugo13 $
 */

if (!defined('IS_ADMIN_FLAG')) die('Illegal Access');

$menuTitles = zen_get_menu_titles();
?>
<div id="navbar">
  <ul class="nde-menu-system" onmouseover="hide_dropdowns('in');" onmouseout="hide_dropdowns('out');">
    <?php foreach (zen_get_admin_menu_for_user() as $menuKey => $pages) { ?>
    <li>
      <a class="top" href="<?php echo zen_href_link(FILENAME_ALT_NAV) ?>"><?php echo $menuTitles[$menuKey] ?></a>
      <ul>
        <?php foreach ($pages as $page) { ?>
        <li><a href="<?php echo zen_href_link($page['file'], $page['params']) ?>"><?php echo $page['name'] ?></a></li>
        <?php } ?>
      </ul>
    </li>
    <?php } ?>
  </ul>
</div>
