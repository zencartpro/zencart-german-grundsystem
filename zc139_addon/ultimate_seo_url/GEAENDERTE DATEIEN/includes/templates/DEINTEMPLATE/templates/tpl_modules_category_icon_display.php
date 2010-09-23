<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_category_icon_display.php 683 for Ultimate SEO URL and ZC139 2010-09-22 14:16:57Z webchills $
 */
  require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_CATEGORY_ICON_DISPLAY));

?>

<div align="<?php echo $align; ?>" id="categoryIcon" class="categoryIcon"><?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath='.$cPath , 'NONSSL') . '">' . $category_icon_display_image . $category_icon_display_name .  '</a>'; ?></div> 