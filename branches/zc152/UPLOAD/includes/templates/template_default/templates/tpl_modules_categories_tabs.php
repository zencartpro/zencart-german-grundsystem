<?php
/**
 * Module Template - categories_tabs
 *
 * Template stub used to display categories-tabs output
 *
 * @package templateSystem
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_categories_tabs.php 729 2011-08-09 15:49:16Z hugo13 $
 */

  include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_CATEGORIES_TABS));
?>
<?php if (CATEGORIES_TABS_STATUS == '1' && sizeof($links_list) >= 1) { ?>
<div id="navCatTabsWrapper">
<div id="navCatTabs">
<ul>
<?php for ($i=0, $n=sizeof($links_list); $i<$n; $i++) { ?>
  <li><?php echo $links_list[$i];?></li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>