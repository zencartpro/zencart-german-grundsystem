<?php
/**
* Template designed by 12leaves.com
* 12leaves.com - Free ecommerce templates and design services
* 
* Page Template
*
* Displays EZ-Pages footer-bar content.<br />
*
* @package templateSystem
* @copyright Copyright 2008-2009 12leaves.com
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: tpl_ezpages_bar_footer.php 4225 2006-08-24 01:42:49Z drbyte $
*/

   /**
   * require code to show EZ-Pages list
   */
  include(DIR_WS_MODULES . zen_get_module_directory('ezpages_bar_footer.php'));
?>
<?php if (sizeof($var_linksList) >= 1) { ?>

<ul class="footer-links list-style-none float-right">
	<li><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'; ?><?php echo HEADER_TITLE_CATALOG; ?></a></li>
	<?php for ($i=1, $n=sizeof($var_linksList); $i<=$n; $i++) {  ?>
	<li><?php echo ($i <= $n ? EZPAGES_SEPARATOR_FOOTER : '') . "\n"; ?>
	<a href="<?php echo $var_linksList[$i]['link']; ?>"><?php echo $var_linksList[$i]['name']; ?></a></li>
	<?php } // end FOR loop ?>
</ul>
<?php } ?>