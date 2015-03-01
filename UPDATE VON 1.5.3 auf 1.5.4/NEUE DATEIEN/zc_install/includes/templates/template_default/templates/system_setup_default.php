<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: system_setup_default.php 805 2011-11-30 11:28:24Z webchills $
 */

  if ($zc_install->error) include(DIR_WS_INSTALL_TEMPLATE . 'templates/display_errors.php');
?>

    <form method="post" action="index.php?main_page=system_setup<?php echo zcInstallAddSID(); ?>">
    <fieldset>
    <legend><?php echo SERVER_SETTINGS; ?></legend>
    <label for="physical_path"><?php echo PHYSICAL_PATH; ?></label>
      <?php echo PHYSICAL_PATH_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=4\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
  <br style="clear:both;" />
      <input type="text" id="physical_path" name="physical_path" tabindex="1" value="<?php echo PHYSICAL_PATH_VALUE; ?>" size="50" />
     <br style="clear:both;" /><hr/>
    <label for="newadmin_path"><?php echo NEWADMIN_PATH; ?></label>
      <?php echo NEWADMIN_PATH_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=96\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
    <br style="clear:both;" />
      <input type="text" id="newadmin_path" name="newadmin_path" tabindex="1" value="<?php echo NEWADMIN_PATH_VALUE; ?>" size="50" />
      <br style="clear:both;" /><hr/>
   <label for="virtual_http_path"><?php echo VIRTUAL_HTTP_PATH; ?></label>
      <?php echo VIRTUAL_HTTP_PATH_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=5\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
    <br style="clear:both;" />
      <input type="text" id="virtual_http_path" name="virtual_http_path" tabindex="2" value="<?php echo VIRTUAL_HTTP_PATH_VALUE; ?>" size="50" />
      
    </fieldset>
<hr/>
    <fieldset>
    <legend><?php echo SSL_OPTIONS; ?></legend>
    <p><?php echo TEXT_SSL_INTRO; ?></p>
    <label for="virtual_https_server"><?php echo VIRTUAL_HTTPS_SERVER; ?></label>
      <?php echo VIRTUAL_HTTPS_SERVER_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=6\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
   <br style="clear:both;" />
      <input type="text" id="virtual_https_server" name="virtual_https_server" tabindex="3" value="<?php echo VIRTUAL_HTTPS_SERVER_VALUE; ?>" size="50" />
      <br style="clear:both;" /><hr/>

     <label for="virtual_https_path"><?php echo VIRTUAL_HTTPS_PATH; ?></label>
     <?php echo VIRTUAL_HTTPS_PATH_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=7\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
    <br style="clear:both;" />
      <input type="text" id="virtual_https_path" name="virtual_https_path" tabindex="4" value="<?php echo VIRTUAL_HTTPS_PATH_VALUE; ?>" size="50" />
     

    <p class="attention"><?php echo TEXT_SSL_WARNING; ?></p>
    <span class="label"><?php echo ENABLE_SSL; ?></span>
      <?php echo ENABLE_SSL_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=8\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
       <br style="clear:both;" />
      <div class="input">
        <input type="radio" name="enable_ssl" id="enable_ssl_yes" tabindex="6" value="true" <?php echo ENABLE_SSL_TRUE; ?>/>
        <label for="enable_ssl_yes"><?php echo YES; ?></label>
        <input type="radio" name="enable_ssl" id="enable_ssl_no" tabindex="7" value="false" <?php echo ENABLE_SSL_FALSE; ?>/>
        <label for="enable_ssl_no"><?php echo NO; ?></label>
     
      
    </div>
     <br style="clear:both;" /><hr/>
    <span class="label"><?php echo ENABLE_SSL_ADMIN; ?></span>
      <?php echo ENABLE_SSL_ADMIN_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=8\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
    <br style="clear:both;" />
      <div class="input">
        <input type="radio" name="enable_ssl_admin" id="enable_ssl_admin_yes" tabindex="8" value="true" <?php echo ENABLE_SSL_TRUE; ?>/>
        <label for="enable_ssl_admin_yes"><?php echo YES; ?></label>
        <input type="radio" name="enable_ssl_admin" id="enable_ssl_admin_no" tabindex="9" value="false" <?php echo ENABLE_SSL_FALSE; ?>/>
        <label for="enable_ssl_admin_no"><?php echo NO; ?></label>
      </div>
      

    </fieldset>
    <input type="submit" name="submit" class="button" tabindex="10" value="<?php echo SAVE_SYSTEM_SETTINGS; ?>" />
    <input type="submit" name="rediscover" class="button" tabindex="11" value="<?php echo REDISCOVER; ?>" />
<?php echo $zc_install->getConfigKeysAsPost(); ?>
    </form>