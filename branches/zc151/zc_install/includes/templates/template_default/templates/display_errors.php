<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: display_errors.php 729 2011-08-09 15:49:16Z hugo13 $
 */

?>
<?php if (sizeof($zc_install->error_array) > 0) { ?>
<fieldset>
<legend><?php echo TEXT_ERROR_WARNING; ?></legend>
<div id="errorInformation">
<?php if ($_GET['main_page'] != 'database_upgrade') { ?>
  <div id="stopsign">
    <img src="includes/templates/template_default/images/stop.gif" border="0" alt="ERROR - Cannot proceed until problems are resolved." title="  ERROR - Cannot proceed until problems are resolved.  " />
  </div>
<?php } ?>
  <div id="error">
    <ul>
<?php
  foreach ($zc_install->error_array as $za_errors ) {
    if ($za_errors['code'] != 'information') {
      echo '      <li class="' . (strstr($za_errors['text'],'kipped upgrade statements') ? 'WARN' : 'FAIL') . '">' . $za_errors['text'] . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=' . $za_errors['code'] . '\')"> ' . TEXT_HELP_LINK . '</a></li>' . "\n";
    }
  }
?>
    </ul>
  </div>
</div>
</fieldset>
<?php } ?>
<br /><br />