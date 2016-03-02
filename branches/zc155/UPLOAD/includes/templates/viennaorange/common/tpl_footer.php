<?php
/**
 * Common Template - tpl_footer.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_footer.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_footer = true;<br />
 *
 * @package templateSystem
* @copyright Portions Copyright 2009-2010 12leaves.com
* @copyright Portions 2003-2012 Zen Cart Development Team
* @copyright Portions 2003-2012 webchills.at
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
* @version $Id: tpl_footer.php 846 2012-02-26 12:10:39Z webchills $
*/
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>

<?php
if (!isset($flag_disable_footer) || !$flag_disable_footer) {
?>

<div id="navSuppWrapper">
		<!--bof-navigation display -->
		<?php if (EZPAGES_STATUS_FOOTER == '1' or (EZPAGES_STATUS_FOOTER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
		<?php require($template->get_template_dir('tpl_ezpages_bar_footer.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_footer.php'); ?>
		<?php } ?>
		<!--eof-navigation display -->
	

	<!--bof- site copyright display -->
	<div id="siteinfoLegal" class="legalCopyright"><?php echo FOOTER_TEXT_BODY; ?></div> <br/>
	<!--eof- site copyright display -->

    
    <div class="clearBoth"></div>

	<!--bof-ip address display -->
	<?php
	if (SHOW_FOOTER_IP == '1') {
	?>
	<div id="siteinfoIP"><?php echo TEXT_YOUR_IP_ADDRESS . '  ' . $_SERVER['REMOTE_ADDR']; ?></div>
	<?php
	}
	?>
    <div class="clearBoth"></div>

    <!--eof-ip address display -->

	<div class="clearBoth"></div>



<!--bof-banner #5 display -->
<?php
  if (SHOW_BANNERS_GROUP_SET5 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET5)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerFive" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>
<!--eof-banner #5 display -->

<?php
} // flag_disable_footer
?>
<?php if (false || (isset($showValidatorLink) && $showValidatorLink == true)) { ?>
<a href="https://validator.w3.org/check?uri=<?php echo urlencode('http' . ($request_type == 'SSL' ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . (strstr($_SERVER['REQUEST_URI'], '?') ? '&' : '?') . zen_session_name() . '=' . zen_session_id()); ?>" target="_blank">VALIDATOR</a>
<?php } ?>
