<?php
/**
 * Page Template
 *
 * Displays EZ-Pages Header-Bar content.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_ezpages_bar_header.php 2022-04-08 21:33:58Z webchills $
 */

  /**
   * require code to show EZ-Pages list
   */
  include(DIR_WS_MODULES . zen_get_module_directory('ezpages_bar_header.php'));
?>
<?php if (!empty($var_linksList)) { ?>
<div id="navEZPagesTop">
  <ul>
<?php for ($i=1, $n=sizeof($var_linksList); $i<=$n; $i++) {  ?>
    <li><a href="<?php echo $var_linksList[$i]['link']; ?>"><?php echo $var_linksList[$i]['name']; ?></a></li>
<?php } // end FOR loop ?>
  </ul>
</div>
<?php } ?>
