<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: phpbb_setup_default.php 7180 2007-10-05 12:24:30Z drbyte $
 */

  if ($zc_install->error) include(DIR_WS_INSTALL_TEMPLATE . 'templates/display_errors.php');
?>

    <form method="post" action="index.php?main_page=phpbb_setup<?php echo zcInstallAddSID(); ?>">
    <fieldset>
    <legend><?php echo PHPBB_INFORMATION; ?></legend>

    <div class="section">
      <div class="input">
        <input type="radio" name="phpbb_use" id="phpbb_use_yes" tabindex="1" value="true" <?php echo PHPBB_USE_TRUE; ?>/>
        <label for="phpbb_use_yes"><?php echo YES; ?></label>
        <input type="radio" name="phpbb_use" id="phpbb_use_no" tabindex="2" value="false" <?php echo PHPBB_USE_FALSE; ?>/>
        <label for="phpbb_use_no"><?php echo NO; ?></label>
      </div>
      <span class="label"><?php echo TEXT_PHPBB_USE; ?></span>
      <p><?php echo PHPBB_USE_INSTRUCTION. '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=64\')"> ' . TEXT_HELP_LINK . '</a>'; ?></p>
    </div>


    <div class="section">
      <input type="text" id="phpbb_dir" name="phpbb_dir" tabindex="3" value="<?php echo PHPBB_DIR_VALUE; ?>" size="35" />
      <label for="phpbb_dir"><?php echo TEXT_PHPBB_DIR; ?></label>
      <p><?php echo PHPBB_DIR_INSTRUCTION. '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=67\')"> ' . TEXT_HELP_LINK . '</a>'; ?></p>
    </div>
    </fieldset>
    <input type="submit" name="submit" class="button" tabindex="4" value="<?php echo SAVE_PHPBB_SETTINGS; ?>" />
<?php echo $zc_install->getConfigKeysAsPost(); ?>
    </form>