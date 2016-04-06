<?php
/**
 * Page Template
 *
 * Displays EZ-Pages footer-bar content.<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_ezpages_bar_footer.php 2 2016-04-06 11:33:58Z webchills $
 */

/**
 * require code to show EZ-Pages list
 */
  include(DIR_WS_MODULES . zen_get_module_directory('ezpages_bar_footer.php'));
?>
<?php if (sizeof($var_linksList) >= 1) { ?>
<?php for ($i=1, $n=sizeof($var_linksList); $i<=$n; $i++) {  ?>
  <li><a href="<?php echo $var_linksList[$i]['link']; ?>"><?php echo $var_linksList[$i]['name']; ?></a></li>
<?php } // end FOR loop ?>
<?php } // end sizeof loop ?>