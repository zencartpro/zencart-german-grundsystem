<?php
/**
 * Module Template - categories_tabs
 *
 * Template stub used to display categories-tabs output
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_categories_tabs.php 2932 2006-02-01 06:20:18Z drbyte $
 */

  include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_CATEGORIES_TABS));
?>
<div id="navCatTabsWrapper">
<div id="navCatTabs">
<ul>
<?php for ($i=0, $n=sizeof($links_list); $i<$n; $i++) { ?>
  <li><?php echo $links_list[$i];?></li>
<?php } ?>
</ul>
</div>
</div>