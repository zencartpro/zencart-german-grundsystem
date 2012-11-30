<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: store_setup_default.php 730 2012-11-30 11:49:16Z webchills $
 */

  if ($zc_install->error) include(DIR_WS_INSTALL_TEMPLATE . 'templates/display_errors.php');
?>

  <form method="post" action="index.php?main_page=store_setup<?php echo zcInstallAddSID(); ?>">
    <fieldset>
    <legend><?php echo STORE_INFORMATION; ?></legend><hr/>
   <label for="store_name"><?php echo STORE_NAME; ?></label>
     <?php echo STORE_NAME_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=37\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
    <br style="clear:both;" />
      <input type="text" id="store_name" name="store_name" tabindex="1" size="40" value="<?php echo STORE_NAME_VALUE; ?>" />
      <br style="clear:both;" /><hr/>
    <label for="store_owner"><?php echo STORE_OWNER; ?></label>
      <?php echo STORE_OWNER_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=38\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
    <br style="clear:both;" />
      <input type="text" id="store_owner" name="store_owner" tabindex="2" size="40" value="<?php echo STORE_OWNER_VALUE; ?>" />
      <br style="clear:both;" /><hr/>
    <label for="store_owner_email"><?php echo STORE_OWNER_EMAIL; ?></label>
      <?php echo STORE_OWNER_EMAIL_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=39\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
   <br style="clear:both;" />
      <input type="text" id="store_owner_email" name="store_owner_email" tabindex="3"  size="40" value="<?php echo STORE_OWNER_EMAIL_VALUE; ?>" />
      <br style="clear:both;" /><hr/>
    <label for="store_country"><?php echo STORE_COUNTRY; ?></label>
     <?php echo STORE_COUNTRY_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=40\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
   <br style="clear:both;" />
      <select id="store-country" name="store_country" tabindex="4">
<?php echo $country_string; ?>
      </select>
       <br style="clear:both;" /><hr/>
     <label for="store_zone"><?php echo STORE_ZONE; ?></label>
      <?php echo STORE_ZONE_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=41\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
     <br style="clear:both;" />
      <select id="store_zone" name="store_zone" tabindex="5" >
<?php echo $zone_string; ?>
      </select>
        <br style="clear:both;" /><hr/>
         <label for="store_address"><?php echo STORE_ADDRESS; ?></label>
     <?php echo STORE_ADDRESS_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=42\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
    <br style="clear:both;" />
      <textarea rows="4" cols="20" id="store_address" tabindex="6" name="store_address"><?php echo STORE_ADDRESS_VALUE; ?></textarea>
      <br style="clear:both;" /><hr/>
     <label for="store_default_language"><?php echo STORE_DEFAULT_LANGUAGE; ?></label>
      <?php echo STORE_DEFAULT_LANGUAGE_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=43\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
    <br style="clear:both;" />
      <select id="store_default_language" tabindex="7" name="store_default_language">
<?php echo $language_string; ?>
      </select>
       <br style="clear:both;" /><hr/>
      <label for="store_default_currency"><?php echo STORE_DEFAULT_CURRENCY; ?></label>
      <?php echo STORE_DEFAULT_CURRENCY_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=44\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
   <br style="clear:both;" />
      <select id="store_default_currency" tabindex="8" name="store_default_currency">
<?php echo $currency_string; ?>
      </select>
       
    </fieldset>
    <br/><hr/><br/>
    <fieldset>
      <legend><?php echo DEMO_INFORMATION; ?></legend>
    <span class="label"><?php echo DEMO_INSTALL; ?></span>
      <?php echo DEMO_INSTALL_INSTRUCTION . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=45\')"> ' . TEXT_HELP_LINK . '</a>'; ?>
    <br style="clear:both;" />
      <div class="input">
        <input type="radio" name="demo_install" id="demo_install_yes" tabindex="9" value="true" <?php echo DEMO_INSTALL_TRUE; ?>/>
        <label for="demo_install_yes"><?php echo YES; ?></label>
        <input type="radio" name="demo_install" id="demo_install_no" tabindex="9" value="false" <?php echo DEMO_INSTALL_FALSE; ?>/>
        <label for="demo_install_no"><?php echo NO; ?></label>
      </div>
     
    </fieldset>
    <input type="submit" name="submit" class="button" tabindex="15" value="<?php echo SAVE_STORE_SETTINGS; ?>" />
    <?php echo $zc_install->getConfigKeysAsPost(); ?>
  </form>