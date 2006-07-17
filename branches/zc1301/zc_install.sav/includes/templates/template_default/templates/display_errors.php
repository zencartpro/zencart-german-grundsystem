<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: display_errors.php 2342 2005-11-13 01:07:55Z drbyte $
 */

?><fieldset>
<legend><?php echo TEXT_ERROR_WARNING; ?></legend>
  <div id="error">
<ul>
<?php
  foreach ($zc_install->error_array as $za_errors ) {
    echo '<li class="FAIL">' . $za_errors['text'] . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=' . $za_errors['code'] . '\')"> ' . TEXT_HELP_LINK . '</a></li>';
  }
?>
</ul>
  </div>
</fieldset>
  
<br /><br />